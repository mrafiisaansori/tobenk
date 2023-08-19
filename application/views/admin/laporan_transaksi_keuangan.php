<table class="table table-bordered table-striped" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
        <tr>
            <th >No</th>
            <th>Nama Transaksi</th>
            <th>Tanggal</th>
            <th >Debit</th>
            <th width="300px">Kredit</th>
            <th width="300px">Saldo</th>
        </tr>
    </thead>
    <tbody>
        <?php $seq_num = 1;$saldo = 0;$debit=0;$kredit=0;?>
        <?php if($transaksi){?>
            <?php foreach($transaksi as $t){?>
                <tr>
                    <td><?php echo $seq_num;?></td>
                    <td ><?php echo $t->NAMA_TRANSAKSI;?></td>
                    <td ><?php echo tgl_indo_lengkap($t->TANGGAL);?></td>
                    <td><?php if($t->JENIS_TRANSAKSI == 'D'){ echo formatRupiah($t->NOMINAL); $saldo += $t->NOMINAL;$debit += $t->NOMINAL;}?></td>
                    <td><?php if($t->JENIS_TRANSAKSI == 'K'){ echo formatRupiah($t->NOMINAL); $saldo -= $t->NOMINAL;$kredit += $t->NOMINAL;}?></td>
                    <td><?php if($saldo < 0){echo " - ".formatRupiah(substr($saldo,1));}else{echo formatRupiah($saldo);}?></td>
                </tr>
                <?php $seq_num++;?>
            <?php }?>
        <?php }else{?>
        <tr>
            <td colspan="5" align="center">Belum Ada Transaksi</td>
        </tr>
        <?php }?>
    </tbody>
</table>