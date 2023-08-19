<a target="_blank" href="<?php echo site_url('urgent/cetaklappendapatan/'.$tanggal_awal.'/'.$tanggal_akhir.'/'.$status); ?>" class="btn btn-primary mb-3"><i class="mdi mdi-printer"></i></a>

<table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Tanggal</th>
            <th>Belanja</th>
            <th>Diskon</th>
            <th>Pendapatan</th>
            <th>HPP</th>
            <th>Laba / Rugi</th>
        </tr>
    </thead>
    <tbody>
    <?php 
    $jumlah=0;
    $nominal=0; 
    $tot_pendapatan=0;
    $tot_biaya=0;
    $tot_labarugi=0;
    $tot_diskon=0;
    $hpp=0;
    $pen=0;
    ?>
    <?php if($detail_pembelian->num_rows()>0){?>
        <?php $seq_num=1;?>
        <?php foreach($detail_pembelian->result() as $db){?>
            <tr>
                <td><?php echo $seq_num;?></td>
                <td><a href="<?php echo base_url('urgent/cetak_laporan_pendapatan/'.$db->TANGGAL.'/'.$status)?>" class="btn btn-success" target="_blank"><?php echo tgl_indo_lengkap($db->TANGGAL);?></a></td>
                <td>
                    <?php
                    $total=0;
                    $biaya=0;
                    $semua=$this->db->query("SELECT * FROM view_detail_penjualan WHERE TANGGAL='$db->TANGGAL' AND `STATUS`='$status'");
                    if($semua->num_rows()>0)
                    {
                        foreach ($semua->result() as $key) 
                        {
                            $total+=$key->QTY*$key->HARGA_JUAL;
                            $biaya+=$key->QTY*$key->HARGA_BELI;
                        }
                    }
                    echo formatRupiah($total);
                    ?>
                </td>
                <td>
                    <?php 
                    $diskon=0;
                    $transaksi=$this->db->query("SELECT * FROM view_penjualan WHERE TANGGAL='$db->TANGGAL'  AND `STATUS`='$status'");
                    if($transaksi->num_rows()>0){
                        foreach ($transaksi->result() as $key) 
                        {
                            $diskon+=$key->DISKON;
                        }
                    }
                    echo formatRupiah($diskon);
                    ?>
                </td>
                <td>
                    <?php 
                    $pen+=$total-$diskon;
                    echo formatRupiah($total-$diskon); ?>
                </td>
                <td>
                    <?php
                    $hpp=$biaya;
                    echo formatRupiah($hpp); 
                    ?>
                </td>
                <td>
                    <?php
                    $laru=$total-$biaya-$diskon;
                    echo formatRupiah($laru); 

                    $tot_pendapatan+=$total;
                    $tot_biaya+=$hpp;
                    $tot_labarugi+=$laru;

                    ?>
                </td>
            </tr>
            <?php $seq_num++;?>
        <?php }?>
    <?php }?>
    </tbody>
    <tfoot>
        <tr style="background-color:#2fa97c!important;color:white;font-weight:bold;">
            <td colspan=2>Total</td>
            <td><?php echo formatRupiah($tot_pendapatan); ?></td>
            <td><?php echo formatRupiah($tot_diskon); ?></td>
            <td><?php echo formatRupiah($pen); ?></td>
            <td><?php echo formatRupiah($tot_biaya); ?></td>
            <td><?php echo formatRupiah($tot_labarugi); ?></td>
        </tr>
    </tfoot>
    </table>
<script type="text/javascript">
    //$('#datatable').DataTable();
</script>