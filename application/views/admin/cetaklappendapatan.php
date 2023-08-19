<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pendapatan</title>
</head>
<body onload="print()">
    <center><h2>Laporan Pendapatan Tanggal</h2> <h4>Status (<?php echo $nama_status; ?>)<br><?php echo tgl_indo_lengkap($tanggal_awal); ?> s/d <?php echo tgl_indo_lengkap($tanggal_akhir); ?></h4></center>
    <table width="800px" align="center" cellspacing="0" cellpadding="0" border='1'>
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
                <td align="center"><?php echo $seq_num;?></td>
                <td align="center"><?php echo tgl_indo_lengkap($db->TANGGAL);?></td>
                <td align="right">
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
                <td align="right">
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
                <td align="right">
                    <?php 
                    $pen+=$total-$diskon;
                    echo formatRupiah($total-$diskon); ?>
                </td>
                <td align="right">
                    <?php
                    $hpp=$biaya;
                    echo formatRupiah($hpp); 
                    ?>
                </td>
                <td align="right">
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
        <tr style="background-color:grey!important;color:white;font-weight:bold;">
            <td colspan=2 align="center">Total</td>
            <td align="right"><?php echo formatRupiah($tot_pendapatan); ?></td>
            <td align="right"><?php echo formatRupiah($tot_diskon); ?></td>
            <td align="right"><?php echo formatRupiah($pen); ?></td>
            <td align="right"><?php echo formatRupiah($tot_biaya); ?></td>
            <td align="right"><?php echo formatRupiah($tot_labarugi); ?></td>
        </tr>
    </tfoot>
    </table>




</body>
</html>
