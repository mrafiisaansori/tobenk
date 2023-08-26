<?php
if ($data->STATUS == 1) {
  if ($data->LUNAS == 1) { ?>
    <div class="alert alert-primary" role="alert">
      Pembayaran Lunas &nbsp; <i class="mdi mdi-progress-check" style="font-size:12pt"></i>
    </div>
  <?php } else { ?>
    <div class="alert alert-danger" role="alert">
      Pembayaran Belum Lunas &nbsp; <i class="mdi mdi-pause-circle" style="font-size:12pt"></i>
    </div>
  <?php }
} else {
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
            <b><?php echo sprintf("%06d", $data->ID); ?></b><br>
            <span style="font-size:10pt">
              Transaksi <?php echo tgl_indo_lengkap($data->TANGGAL); ?><br>
              Estimasi Selesai <?php echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?><br>
              Resep <?php echo ($data->RESEP); ?><br>
              Pembayaran <?php echo ($data->JENIS_BAYAR); ?><br>
              Metode <?php if ($data->ID_METODE_BAYAR == 1) echo "Full Payment";
                      else echo "Down Payment"; ?><br>
              <?php if ($data->STATUS == 1) {
                if ($data->STATUS_PENGERJAAN == 0) echo "<span class='badge badge-secondary' style='font-size:10pt;'>Diproses</span>";
                else if ($data->STATUS_PENGERJAAN == 1) echo "<span class='badge badge-warning' style='font-size:10pt;'>Desain Diupload</span>&nbsp;<span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_1) . "</span>";
                else if ($data->STATUS_PENGERJAAN == 2) echo "<span class='badge badge-danger' style='font-size:10pt;'>Revisi Desain</span>&nbsp;<span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_2) . "</span>";
                else if ($data->STATUS_PENGERJAAN == 3) echo "<span class='badge badge-success' style='font-size:10pt;'>Selesai Desain</span>&nbsp;<span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_3) . "</span>";
                else if ($data->STATUS_PENGERJAAN == 4) echo "<span class='badge badge-info' style='font-size:10pt;'>Selesai Produksi</span>&nbsp;<span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_4) . "</span>";
                else if ($data->STATUS_PENGERJAAN == 5) echo "<span class='badge badge-dark' style='font-size:10pt;'>Diambil</span>&nbsp;<span style='font-size:9pt'>" . tgl_jam_indo_lengkap($data->SP_5) . "</span>";
              } else {
                echo "<span style='font-size:10pt' class='badge badge-soft-secondary'>Dibatalkan</span>";
              }  ?>
              <br>
              File Dari Customer <?php if ($data->FILE_CUSTOMER) {
                                    echo "<a target='_blank' href='" . site_url("upload/file_customer/" . $data->FILE_CUSTOMER) . "'>" . ($data->FILE_CUSTOMER) . "</a>";
                                  } else {
                                    echo "-";
                                  } ?><br>
              File Mentah <?php if ($data->FILE_MENTAH) {
                            echo "<a target='_blank' href='" . $data->FILE_MENTAH . "'>" . ($data->FILE_MENTAH) . "</a>";
                          } else {
                            echo "-";
                          } ?><br>
            </span>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered">
      <thead>
        <tr style="background-color:#f8f9fa;font-size:10pt;font-weight:bold;">
          <th><i class="fas fa-file-alt mr-1"></i> Histori Revisi</th>
        </tr>
      </thead>
      <tbody>
        <?php
        if (count($histori_revisi) == 1) {
          $histori_revisi = null;
        }
        ?>
        <?php if ($histori_revisi) {
          $num_histori = 1; ?>
          <?php foreach ($histori_revisi as $hr) { ?>
            <?php if ($num_histori < count($histori_revisi)) {
              $num_histori++;
            } else {
              continue;
            } ?>
            <tr>
              <td>

                <?php
                if (file_exists('./upload/mockup/' . $hr->MOCKUP) && $hr->MOCKUP != null) {
                  echo "<a href='" . base_url() . "upload/mockup/" . $hr->MOCKUP . "' target='_blank' class='btn btn-sm btn-primary mr-2 mb-1'>Mock Up</a>";
                }

                if (file_exists('./upload/mockup/' . $hr->MOCKUP) && $hr->MOCKUP != null) {
                  echo "<a href='" . base_url() . "upload/mockup/" . $hr->MOCKUP . "' target='_blank' class='btn btn-sm btn-primary mb-1'>File Tambahan Customer</a>";
                }

                echo "<br>" . $hr->KETERANGAN
                ?>
              </td>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <tr>
            <td>Tidak Ada</td>
          </tr>
        <?php } ?>
      </tbody>
    </table>
  </div>
  <div class="col-xl-8">
    <table class="table table-bordered" style="font-size:12pt">
      <tbody>
        <tr style="background-color:#f8f9fa;font-size:10pt;font-weight:bold;">
          <td><i class="fas fa-file-alt mr-1"></i> Mockup</td>
        </tr>
        <tr>
          <td align="center">
            <?php if ($revisi) { ?>
              <img height="150px" src="<?php echo site_url('upload/mockup/' . $revisi->MOCKUP); ?>" alt="">
            <?php } ?>
          </td>
        </tr>
      </tbody>
    </table>
    <table class="table table-bordered" style="font-size:10pt">
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
      $tot = 0;
      $tot_beli = 0;
      $laba = 0;
      if ($produk->num_rows() > 0) {
        foreach ($produk->result() as $dat) {
      ?>
          <tr>
            <td><B><?php echo $dat->NAMA_PRODUK; ?> (<?php echo $dat->UKURAN; ?>)</B><br><span style="font-size:9pt"><?php echo $dat->KETERANGAN; ?></span></td>
            <td align="right"><?php echo formatRupiah($dat->HARGA_BELI); ?></td>
            <td align="right"><?php echo formatRupiah($dat->HARGA_JUAL); ?></td>
            <td align="center"><?php echo $dat->QTY; ?></td>
            <td align="right"><?php echo formatRupiah($dat->QTY * $dat->HARGA_BELI);
                              $bl = $dat->QTY * $dat->HARGA_BELI;
                              $tot_beli += $bl; ?></td>
            <td align="right"><?php echo formatRupiah($dat->QTY * $dat->HARGA_JUAL);
                              $jl = $dat->QTY * $dat->HARGA_JUAL;
                              $tot += $jl; ?></td>
            <td align="right"><?php echo formatRupiah($jl - $bl);
                              $laba += ($jl - $bl); ?></td>
          </tr>
      <?php
        }
      }
      ?>
      <tfoot>
        <tr style="background-color:#f8f9fa">
          <td align="center" colspan=4 style="font-weight:bold;">Grand Total</td>
          <td align="right" style="font-weight:bold;"><?php echo formatRupiah($tot_beli); ?></td>
          <td align="right" style="font-weight:bold;"><?php echo formatRupiah($tot); ?></td>
          <td align="right" style="font-weight:bold;"><?php echo formatRupiah($laba); ?></td>
        </tr>
      </tfoot>
    </table>

    <table class="table table-bordered" style="font-size:10pt">
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
        <td><?php echo formatRupiah($tot - $data->DISKON); ?></td>
      </tr>
      <tr>
        <td><b>Dibayar Oleh Customer</b></td>
        <td><?php if ($data->LUNAS == 1) {
              echo formatRupiah($tot - $data->DISKON);
              $byr = $tot - $data->DISKON;
            } else {
              echo formatRupiah($data->BAYAR);
              $byr = $data->BAYAR;
            } ?></td>
      </tr>
      <tr>
        <td><b>Hutang Customer</b></td>
        <td><?php echo formatRupiah(($tot - $byr) - $data->DISKON); ?></td>
      </tr>
      <tr>
        <td><b>Laba Bersih</b><span> (Grand Total Laba - Diskon)</span></td>
        <td><?php echo formatRupiah($laba - $data->DISKON); ?></td>
      </tr>


    </table>

  </div>
</div>