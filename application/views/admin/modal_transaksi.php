<?php
  if($data->STATUS==1){ 
  if($data->LUNAS==1){ ?>
<div class="alert alert-primary" role="alert">
    Pembayaran Lunas &nbsp; <i class="mdi mdi-progress-check" style="font-size:12pt"></i>
</div>
<?php } else { ?>
<div class="alert alert-danger" role="alert">
    Pembayaran Belum Lunas &nbsp; <i class="mdi mdi-pause-circle" style="font-size:12pt"></i>
</div>
<?php }}
else{
?>
<div class="alert alert-danger" role="alert">
    Transaksi Dibatalkan &nbsp; <i class="mdi mdi-trash-o" style="font-size:12pt"></i>
</div>
<?php
}
?>
<div class="row">
    <div class="col-xl-4">
      <table class="table table-bordered" style="font-size:12pt">
        <tbody>
          <tr style="background-color:#f8f9fa;font-size:10pt;font-weight:bold;">
            <td><i class="fas fa-user-friends mr-1"></i> Customer</td>
          </tr>
          <tr>
            <td>
            <b><?php echo $data->NAMA_CUSTOMER ?></b><br>
            <span style="font-size:10pt"><?php echo $data->ALAMAT ?><br>
            <?php echo $data->NO_TELP ?></span>
            </td>
          </tr>
        </tbody>
      </table>
      <table class="table table-bordered" style="font-size:12pt">
        <tbody>
          <tr style="background-color:#f8f9fa;font-size:10pt;font-weight:bold;">
            <td><i class="fas fa-file-alt mr-1"></i> Transaksi</td>
          </tr>
          <tr>
            <td>
            <b><?php echo sprintf("%06d",$data->ID); ?></b><br>
            <span style="font-size:10pt">
              Transaksi <?php echo tgl_indo_lengkap($data->TANGGAL); ?><br>
              Estimasi <?php echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?><br>
              Resep <?php echo ($data->RESEP); ?><br>
              Pembayaran <?php echo ($data->JENIS_BAYAR); ?><br>
              Metode <?php if($data->ID_METODE_BAYAR==1) echo "Full Payment"; else echo "Down Payment"; ?><br>
              <?php if($data->STATUS==1){ if($data->STATUS_PENGERJAAN==1) echo "Pekerjaan Selesai ".tgl_jam_indo_lengkap($data->SELESAI).""; elseif($data->STATUS_PENGERJAAN==0)  echo "Proses Pengerjaan"; if($data->STATUS_PENGERJAAN==2) echo "Telah Diambil ".tgl_jam_indo_lengkap($data->AMBIL); } else { echo "Dibatalkan"; }  ?>
            </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="col-xl-8">
      <table class="table table-bordered"  style="font-size:10pt">
        <tr style="background-color:#f8f9fa">
          <td><b>Power Lensa</b></td>
          <td><b>SPH</b></td>
          <td><b>CYL</b></td>
          <td><b>AXIS</b></td>
          <td><b>ADD</b></td>
          <td><b>PD</b></td>
        </tr>
        <tr>
          <td><b>OD</b></td>
          <td><?php echo $data->OD_SPH; ?></td>
          <td><?php echo $data->OD_CYL; ?></td>
          <td><?php echo $data->OD_AXIS; ?></td>
          <td><?php echo $data->OD_ADD; ?></td>
          <td><?php echo $data->OD_PD; ?></td>
        </tr>
        <tr>
          <td><b>OS</b></td>
          <td><?php echo $data->OS_SPH; ?></td>
          <td><?php echo $data->OS_CYL; ?></td>
          <td><?php echo $data->OS_AXIS; ?></td>
          <td><?php echo $data->OS_ADD; ?></td>
          <td><?php echo $data->OS_PD; ?></td>
        </tr>
      </table>
      <table class="table table-bordered"  style="font-size:10pt">
        <tr style="background-color:#f8f9fa">
          <td style="font-weight:bold;" align="center">Produk</td>
          <td style="font-weight:bold;" align="center">Harga Beli</td>
          <td style="font-weight:bold;" align="center">Harga Jual</td>
          <td style="font-weight:bold;" align="center">Qty</td>
          <td style="font-weight:bold;" align="center">Beli</td>
          <td style="font-weight:bold;" align="center">Jual</td>
          <td style="font-weight:bold;" align="center">Laba</td>
        </tr>
        <?php
        $tot=0;
        $tot_beli=0;
        $laba=0;
        if($produk->num_rows()>0){
        foreach ($produk->result() as $dat) {
          ?>
          <tr>
            <td><B><?php echo $dat->NAMA_PRODUK; ?></B><br><span style="font-size:9pt"><?php echo $dat->KETERANGAN; ?></span></td>
            <td align="right"><?php echo formatRupiah($dat->HARGA_BELI); ?></td>
            <td align="right"><?php echo formatRupiah($dat->HARGA_JUAL); ?></td>
            <td align="center"><?php echo $dat->QTY; ?></td>
            <td align="right"><?php echo formatRupiah($dat->QTY*$dat->HARGA_BELI); $bl=$dat->QTY*$dat->HARGA_BELI; $tot_beli+=$bl; ?></td>
            <td align="right"><?php echo formatRupiah($dat->QTY*$dat->HARGA_JUAL); $jl=$dat->QTY*$dat->HARGA_JUAL; $tot+=$jl; ?></td>
            <td align="right"><?php echo formatRupiah($jl-$bl); $laba+=($jl-$bl); ?></td>
          </tr>
          <?php
        }
      }
        ?>
        <tfoot>
         <tr  style="background-color:#f8f9fa">
           <td align="center" colspan=4 style="font-weight:bold;">Grand Total</td>
           <td align="right" style="font-weight:bold;"><?php echo formatRupiah($tot_beli); ?></td>
           <td align="right" style="font-weight:bold;"><?php echo formatRupiah($tot); ?></td>
           <td align="right" style="font-weight:bold;"><?php echo formatRupiah($laba); ?></td>
         </tr>
        </tfoot>
      </table>

      <table class="table table-bordered"  style="font-size:10pt">
        <tr>
          <td><b>Grand Total Beli</b></td>
          <td><?php echo formatRupiah($tot_beli); ?></td>
        </tr>
        <tr>
          <td><b>Grand Total Jual</b></td>
          <td><?php echo formatRupiah($tot); ?></td>
        </tr>
        <tr>
          <td><b>Grand Total Laba</b></td>
          <td><?php echo formatRupiah($laba); ?></td>
        </tr>
        <tr>
          <td><b>Diskon</b></td>
          <td><?php echo formatRupiah($data->DISKON); ?></td>
        </tr>
        
        <tr>
          <td><b>Tagihan Ke Customer</b><span> (Grand Total Jual - Diskon)</span></td>
          <td><?php echo formatRupiah($tot-$data->DISKON); ?></td>
        </tr>
        <tr>
          <td><b>Dibayar Oleh Customer</b></td>
          <td><?php if($data->LUNAS==1) { echo formatRupiah($tot-$data->DISKON); $byr=$tot-$data->DISKON; } else { echo formatRupiah($data->BAYAR); $byr=$data->BAYAR; } ?></td>
        </tr>
        <tr>
          <td><b>Hutang Customer</b></td>
          <td><?php echo formatRupiah(($tot-$byr)-$data->DISKON); ?></td>
        </tr>
        <tr>
          <td><b>Laba Bersih</b><span> (Grand Total Laba - Diskon)</span></td>
          <td><?php echo formatRupiah($laba-$data->DISKON); ?></td>
        </tr>
        
        
      </table>

    </div>
</div>