<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo site_url('theme/print') ?>/normalize.min.css">
    <link rel="stylesheet" href="<?php echo site_url('theme/print') ?>/paper.css">
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
    s{
    text-decoration : line-through;
    font-size:10pt!important;
    }
</style>
</head>
<body class="A4 landscape" onload="print()">
    <section class="sheet padding-10mm">
        <center><h2>Laporan Penjualan Tanggal</h2><h4>Kasir (<?php echo $nama_kasir; ?>)<br><?php echo tgl_indo_lengkap($tanggal_awal);?> s/d <?php echo tgl_indo_lengkap($tanggal_akhir);?></h4></center>
        <table width="100%" align="center" cellspacing="0" cellpadding="0" border='1'>
        <thead>
            <tr>
            <th>No</th>
            <th>Customer</th>
            <th>Tanggal</th>
            <th>Transaksi</th>
            <th>Diskon</th>
            <th>Tagihan</th>
            <th>Terbayar</th>
            <th>Status</th>
            <th>Laba</th>
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
                    <td style="vertical-align: top"><?php echo sprintf("%06d",$key->ID); ?></td>
                    <td style="vertical-align: top"><?php echo "<b>".($key->NAMA_CUSTOMER)."</b><br><span style='font-size:9pt'>".$key->ALAMAT."<br>".$key->NO_TELP."</span>"; ?></td>
                    <td style="vertical-align: top"><?php echo "<b>".tgl_indo_lengkap($key->TANGGAL)."</b><br><span>".$key->JAM."</span>"; ?></td>
                    <td style="vertical-align: top" ><?php if($key->ID_METODE_BAYAR==1) echo "<b>Full</b>"; else  echo "<b>DP</b>"; echo "<br>".$key->JENIS_BAYAR;  ?></td>
                    <?php   $total+=$key->TOTAL; ?>
                    <?php  $diskon+=$key->DISKON; ?>
                    <td style="vertical-align: top">
                        <?php echo formatRupiah($key->DISKON); ?>
                    </td>
                    <td style="vertical-align: top" ><?php $tp=$key->TOTAL-$key->DISKON;  echo formatRupiah($tp)."<br><s>".formatRupiah($key->TOTAL)."</s>"; $pendapatan+=$tp; ?></td>
                    <td style="vertical-align: top" ><?php if($key->ID_METODE_BAYAR==1) { echo formatRupiah($tp); $terbayar+=$tp; $fa=0; }  else  { echo formatRupiah($key->BAYAR); $terbayar+=$key->BAYAR; $fa=$tp-$key->BAYAR; }   $belum_bayar+=$fa;  ?></td>
                    <td style="vertical-align: top" ><?php  if($key->LUNAS==1) echo "<b>Lunas</b>"; else echo "<b>Belum Lunas</b><br><span style='font-size:9pt'>Kurang ".formatRupiah($fa)."</span>"; ?></td>
                    <td style="vertical-align: top" >
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
                   
                </tr>
                <?php 
                 if(($seq_num%6)==0){
                    echo '</tr></tbody></table></section><section class="sheet padding-10mm">
                    <center><h2>Laporan Penjualan Tanggal</h2><h4>Kasir ('.$nama_kasir.')<br>'.tgl_indo_lengkap($tanggal_awal).' s/d '. tgl_indo_lengkap($tanggal_akhir).'</h4></center>
                    <table width="100%" align="center" cellspacing="0" cellpadding="0" border=1>
                    <thead>
                        <tr>
                        <th>No</th>
                        <th>Customer</th>
                        <th>Tanggal</th>
                        <th>Transaksi</th>
                        <th>Diskon</th>
                        <th>Tagihan</th>
                        <th>Terbayar</th>
                        <th>Status</th>
                        <th>Laba</th>
                        
                        </tr>
                    </thead>
                    <tbody>';
                }
                $seq_num++;?>
            <?php } ?>
        <?php }?>
        </tbody>
        <tfoot style="font-weight:bold;">
            <tr>
                <td colspan=4 align=center>Total</td>
                <td>
                    <?php echo formatRupiah($diskon);?>
                </td>
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
               
            </tr>
        </tfoot>
    </table>
    <br>
    <h4>Laba Bersih : <?php echo formatRupiah($laba_total-$diskon);?></h4>
                    </section>

</body>
</html>
