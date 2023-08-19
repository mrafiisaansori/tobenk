<table id="datatable" class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th>No</th>
            <th>Produk</th>
            <th>Harga Pokok</th>
            <th>Prosentase</th>
            <th>Harga Pokok Penjualan</th>
            <th>Tanggal</th>
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
                <td><?php echo formatRupiah($db->HARGA_JUAL_AWAL); ?></td>
                <td><?php echo $db->PROSENTASE_PENYUSUTAN."%"; ?></td>
                <td><?php echo formatRupiah($db->HARGA_JUAL_AKHIR);?></td>
                <td><?php if($db->TANGGAL) $all = explode(" ", $db->TANGGAL); echo "<b>".tgl_indo_lengkap($all[0])."</b> ".$all[1]; ?></td>
            </tr>
            <?php $seq_num++;?>
        <?php }?>
    <?php }?>
    </tbody>
                        </table>
<script type="text/javascript">
    $('#datatable').DataTable();
</script>