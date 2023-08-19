<table class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr style="background-color: #2fa97c;color: white">
            <th rowspan="2">No</th>
            <th rowspan="2">Produk</th>
            <th rowspan="2">Stok Awal</th>
            <th colspan="2" align="center"><center>Barang</center></th>
            <th rowspan="2">Stok Akhir</th>
            <th rowspan="2">Harga Beli</th>
            <th rowspan="2">Jumlah</th>
        </tr>
        <tr style="background-color: #2fa97c;color: white">
            <th>Masuk</th>
            <th>Keluar</th>
        </tr>
    </thead>
    <tbody>
    <?php $jumlah=0;$nominal=0;?>
    <?php if($detail_pembelian->num_rows()>0){?>
        <?php $seq_num=1;?>
        <?php foreach($detail_pembelian->result() as $db){?>
            <tr>
                <td><?php echo $seq_num;?></td>
                <td><?php echo $db->NAMA; ?></td>
                <td>
                <?php 
                $awal = $this->db->query("SELECT QTY FROM t_rekam_stok WHERE ID_PRODUK='$db->ID' AND JENIS='1' AND KETERANGAN='Stok Opname' AND TANGGAL LIKE '$tahun%'"); 
                if($awal->num_rows()>0)
                {
                    echo $awal->row()->QTY;
                }
                else
                {
                    echo "-";
                }
                ?>
                </td>
                <td>
                <?php
                $masuk = $this->db->query("SELECT SUM(QTY) AS QTY FROM t_rekam_stok WHERE ID_PRODUK='$db->ID' AND JENIS='1' AND KETERANGAN!='Stok Opname' AND TANGGAL LIKE '$tahun%'"); 
                if($masuk->row()->QTY>0)
                {
                    echo $masuk->row()->QTY;
                }
                else
                {
                    echo "-";
                }
                ?>
                </td>
                <td>
                <?php
                $keluar = $this->db->query("SELECT SUM(QTY) AS QTY FROM t_rekam_stok WHERE ID_PRODUK='$db->ID' AND JENIS='2' AND TANGGAL LIKE '$tahun%'"); 
                
                    $penjualan = $this->db->query("SELECT SUM(QTY) AS QTY FROM view_detail_penjualan WHERE ID_PRODUK='$db->ID' AND TANGGAL LIKE '$tahun%'"); 
                    $kel = $keluar->row()->QTY+$penjualan->row()->QTY;
                    if($kel>0)
                    {
                        echo $kel;
                    }
                    else
                    {
                        echo "-";
                    }
                
                ?>
                </td>
                <td>
                    <?php echo $db->STOK ?>
                </td>
                <td>
                    <?php echo formatRupiah($db->HARGA_BELI); ?>
                </td>
                <td>
                    <?php echo formatRupiah($db->STOK*$db->HARGA_BELI); $nominal+=$db->STOK*$db->HARGA_BELI; ?>
                </td>
            </tr>
            <?php $seq_num++;?>
        <?php }?>
    <?php }?>
    </tbody>
    <tfoot>
        <tr style="background-color: #2fa97c;color: white">
            <td colspan="7">Total</td>
            <td ><?php echo formatRupiah($nominal); ?></td>
        </tr>
    </tfoot>
                        </table>
<script type="text/javascript">
    //$('#datatable').DataTable();
</script>