<!DOCTYPE html>
<html lang="en">
<head>
    <?php
    header("Content-type: application/vnd-ms-excel");
    header("Content-Disposition: attachment; filename=export-penjualan.xls");
    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <style>
    @page { size: A4 landscape }
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
    th, td {
    padding-top: 10px;
    padding-bottom: 10px;
    padding-left: 10px;
    padding-right: 10px;
    }
</style>
</head>
<body >
   
        <center><h2>Laporan Penjualan Tanggal</h2><h4>Kasir (<?php echo $nama_kasir; ?>)<br><?php echo tgl_indo_lengkap($tanggal_awal);?> s/d <?php echo tgl_indo_lengkap($tanggal_akhir);?></h4></center>
        <table width="100%" align="center" cellspacing="0" cellpadding="0" border='1'>
        <thead>
            <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Tanggal</th>
            <th>Transaksi</th>
            <th>Tagihan</th>
            <th>Terbayar</th>
            <th>Status</th>
            <th>Laba</th>
            <th>Diskon</th>
            </tr>
        </thead>
        <tbody>
        <?php 
        $total=0;
        $jumlah=0;
        $diskon=0;
        $pendapatan=0;
        $terbayar=0;
        $laba_total=0;
        $belum_bayar=0;
        ?>
        <?php if($penjualan){?>
            <?php $seq_num=1;?>
            <?php foreach($penjualan as $key){ 
                ?>
                <tr>
                    <td><?php echo sprintf("%06d",$key->ID); ?></td>
                    <td><?php echo "<b>".($key->NAMA_CUSTOMER)."</b><br><span style='font-size:9pt'>".$key->ALAMAT."<br>".$key->NO_TELP."</span>"; ?></td>
                    <td><?php echo "<b>".tgl_indo_lengkap($key->TANGGAL)."</b><br><span>".$key->JAM."</span>"; ?></td>
                    <td ><?php if($key->ID_METODE_BAYAR==1) echo "<b>Full</b>"; else  echo "<b>DP</b>"; echo "<br>".$key->JENIS_BAYAR;  ?></td>
                    <?php   $total+=$key->TOTAL; ?>
                    <?php  $diskon+=$key->DISKON; ?>
                    <td ><?php  echo formatRupiah($key->TOTAL); $pendapatan+=$key->TOTAL; ?></td>
                    <td ><?php if($key->ID_METODE_BAYAR==1) { echo formatRupiah($key->TOTAL); $terbayar+=$key->TOTAL; $fa=$key->TOTAL-$key->TOTAL; }  else  { echo formatRupiah($key->BAYAR); $terbayar+=$key->BAYAR; $fa=$key->TOTAL-$key->BAYAR; }   $belum_bayar+=$fa;  ?></td>
                    <td ><?php  if($key->LUNAS==1) echo "<b>Lunas</b>"; else echo "<b>Belum Lunas</b><br><span style='font-size:9pt'>Kurang ".formatRupiah($fa)."</span>"; ?></td>
                    <td >
                        <?php 
                        $laba=0;
                        $barang=$this->db->get_where("view_detail_penjualan",["ID_TRANSAKSI_PENJUALAN"=>$key->ID]);
                        //echo $this->db->last_query();
                        if($barang->num_rows()>0){
                            foreach ($barang->result() as $keys) {
                                $laba += ($keys->HARGA_JUAL-$keys->HARGA_BELI)*$keys->QTY;
                            }
                        }
                        echo formatRupiah($laba);
                        $laba_total+=$laba;
                        ?>
                    </td>
                    <td>
                        <?php echo formatRupiah($key->DISKON); ?>
                    </td>
                </tr>
                <?php
                $seq_num++;?>
            <?php } ?>
        <?php }?>
        </tbody>
        <tfoot style="font-weight:bold;">
            <tr>
                <td colspan=4 align=center>Total</td>
                <td>
                    <?php echo formatRupiah($pendapatan); ?>
                </td>
                <td>
                    <?php echo formatRupiah($terbayar); ?>
                </td>
                <td>
                    <?php echo formatRupiah($belum_bayar); ?>
                </td>
                <td>
                    <?php echo formatRupiah($laba_total);?>
                </td>
                <td>
                    <?php echo formatRupiah($diskon);?>
                </td>
            </tr>
        </tfoot>
    </table>
    <br>
    <h4>Laba Bersih : <?php echo formatRupiah($laba_total-$diskon);?></h4>
                    </section>

</body>
</html>
