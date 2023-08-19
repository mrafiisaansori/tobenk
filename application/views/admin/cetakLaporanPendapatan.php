<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Keluar Tanggal <?php echo tgl_indo_lengkap($tanggal);?></title>
</head>
<body onload="print()">
    <center><h2>Laporan Pendapatan Tanggal</h2> <h4>Status (<?php echo $nama_status; ?>)<br><?php echo tgl_indo_lengkap($tanggal);?></h4></center>
    <table width="800px" align="center" cellspacing="0" cellpadding="0" border='1'>
        <thead>
            <tr>
                <th>No</th>
                <th>Produk</th>
                <th>Qty</th>
                <th>Harga Jual</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php $seq_num = 1;$tot_qty=0;$tot_pendapatan = 0;?>
            <?php if($detail_penjualan){?>
                <?php foreach($detail_penjualan as $dp){?>
                    <tr align="center">
                        <td><?php echo $seq_num;?></td>
                        <td><?php echo $dp->NAMA_PRODUK;?></td>
                        <td><?php echo $dp->QTY;$tot_qty+=$dp->QTY;?></td>
                        <td><?php echo formatRupiah($dp->HARGA_JUAL);?></td>
                        <td><?php  $total_harga = $dp->QTY*$dp->HARGA_JUAL;echo formatRupiah($total_harga);$tot_pendapatan+=$total_harga;?></td>
                    </tr>
                    <?php $seq_num++;?>
                <?php }?>
            <?php }?>
            <tr align="center">
                <td colspan="2"//style="background-color:#9e9e9e">Total</td>
                <td><?php echo $tot_qty;?></td>
                <td></td>
                <td><?php echo formatRupiah($tot_pendapatan);?></td>
            </tr>
        </tbody>
    </table>
</body>
</html>
