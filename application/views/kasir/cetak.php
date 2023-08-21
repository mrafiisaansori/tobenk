<?php
date_default_timezone_set('Asia/Jakarta');
$identitas = $this->db->query("SELECT * FROM m_identitas LIMIT 1")->row();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cetak</title>
  <style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font: 12pt "Tahoma";
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        width: 210mm;
        min-height: 297mm;
        padding: 20mm;
        margin: 10mm auto;
        border-radius: 5px;
        background: white;
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }
    .subpage {
        padding: 1cm;
        height: 257mm;
        outline: 2cm #FFEAEA solid;
    }
    
    @page {
        size: A4;
        margin: 0;
    }
    @media print {
        html, body {
            width: 210mm;
            height: 297mm;        
        }
        .page {
            margin: 0;
            border: initial;
            border-radius: initial;
            width: initial;
            min-height: initial;
            box-shadow: initial;
            background: initial;
            page-break-after: always;
        }
    }
    #qrcode {
        width:100px;
        height:100px;
    }
  </style>
</head>
<body onload="print()">
<div class="book">
  <div class="page">
      <table width="100%">
        <tr>
          <td align="center" width="80"><img width="100px" src="<?php echo site_url('upload/logo/logo-dark.png'); ?>" alt=""></td>
          <td align="center">
            <b><?php echo $identitas->NAMA; ?></b><br>
            <?php echo $identitas->ALAMAT; ?><br>
            <?php echo $identitas->NO_TELP; ?>
          </td>
        </tr>
      </table>
      <center>
        <hr>
        <h3>Bukti Transaksi</h3>
      </center>
      
      <table width="100%">
        <tr>
          <td width="150">No. Order</td>
          <td>:</td>
          <td><?php echo sprintf("%06d",$data->ID); ?></td>
          <td></td>
        </tr>
        <tr>
          <td width="150">Customer </td>
          <td>:</td>
          <td><?php echo $data->NAMA_CUSTOMER; ?> (<?php echo $data->NO_TELP; ?>)</td>
          <td></td>
        </tr>
        <tr>
          <td width="150">Tanggal Transaksi</td>
          <td>:</td>
          <td><?php if($data->TANGGAL=="0000-00-00") echo "-"; else echo tgl_indo_lengkap($data->TANGGAL); ?></td>
          <td></td>
        </tr>
        <tr>
          <td width="150">Estimasi Selesai </td>
          <td>:</td>
          <td><?php if($data->ESTIMASI_SELESAI=="0000-00-00") echo "-"; else echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?></td>
          <td></td>
        </tr>
        <tr>
          <td width="150">Pembayaran</td>
          <td>:</td>
          <td><?php echo ($data->JENIS_BAYAR); ?> (<?php  if($data->ID_METODE_BAYAR==1) echo "Full"; else echo "DP"; ?>)</td>
        </tr>
        <?php if($data->FILE_MENTAH){ ?>
        <tr>
          <td colspan="4" align="center">
            <table width="100%" style="margin-top:25px;border: 1px solid;">
              <tr>
                <td align="center">
                  <b>File Desain</b><br>
                  <?php echo $data->FILE_MENTAH; ?>
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <?php } 
        if($data->MOCKUP){ ?>
        <tr>
          <td colspan="4" align="center">
            <table width="100%" style="margin-top:25px;border: 1px solid;">
              <tr>
                <td align="center">
                  <b>Mockup Design</b><br>
                  <img height="150px" style="margin-top:10px" src="<?php echo site_url('upload/mockup/'.$data->MOCKUP); ?>" alt="">
                </td>
              </tr>
            </table>
          </td>
        </tr>
        <?php } ?>
      </table>

      <table width="100%" cellspacing='0' bordercolor='#000000'cellpadding='4' border='1' style='border: solid 1.5pt black; border-collapse: collapse;margin-top:20px;font-size:9pt'>
        <tr>
          <td style="font-weight:bold" align="center">Produk</td>
          <td style="font-weight:bold" align="center">@Harga</td>
          <td style="font-weight:bold" align="center">QTY</td>
          <td style="font-weight:bold" align="center">Total</td>
        </tr>
          <?php 
          $total=0;
          foreach ($produk as $dat) { ?>
            <tr>
              <td style=" vertical-align: top;">
                <b><?php echo $dat->NAMA_PRODUK." (".$dat->UKURAN.")"; ?></b>
                <br>
                <?php echo $dat->KETERANGAN; ?>
              </td>
              <td style=" vertical-align: top;">
                <?php echo formatRupiah($dat->HARGA_JUAL); ?>
              </td>
              <td style=" vertical-align: top;">
                <?php echo $dat->QTY; ?>
              </td>
              <td style=" vertical-align: top;" align="right">
              <?php $tot=$dat->HARGA_JUAL*$dat->QTY; echo formatRupiah($tot); $total+=$tot; ?>
              </td>
            </tr>
          <?php } ?>
          <tr>
            <td colspan="3" align="left">Total</td>
            <td align="right"><?php echo formatRupiah($total); ?></td>
          </tr>
          <tr>
            <td colspan="3" align="left">Diskon</td>
            <td align="right"><?php echo formatRupiah($data->DISKON); ?></td>
          </tr>
          <tr>
            <td colspan="3" align="left">Total Tagihan</td>
            <td align="right"><?php $hd=$data->TOTAL-$data->DISKON; echo formatRupiah($hd); ?></td>
          </tr>
          <tr>
            <td colspan="3" align="left">Total Bayar</td>
            <td align="right"><?php echo formatRupiah($data->BAYAR); ?></td>
          </tr>
          <?php if($data->ID_METODE_BAYAR==2){ ?>
            <tr>
              <td colspan="3" align="left">Kurang Bayar</td>
              <td align="right"><?php $tsemua = $data->BAYAR-$hd;  echo formatRupiah(abs($tsemua)); ?></td>
            </tr>
          <?php } ?>
      </table>

      <table width="100%" style="margin-top:20px">
        <tr>
          <td align="center">
            Kasir<br><br><br><br><br><br>(<?php echo $data->NAMA_KASIR; ?>)
          </td>
          <td align="center">
            Customer<br><br><br><br><br><br>(<?php echo $data->NAMA_CUSTOMER; ?>)
          </td>
          <td align="center" width="150px">
            <script>
            window.addEventListener("load", () => {
            var qrc = new QRCode(document.getElementById("qrcode"), {
                text: "<?php echo site_url('qr/'.base64_encode_fix($data->ID)); ?>",
                width: 100,
                height: 100,
                correctLevel : QRCode.CorrectLevel.H
            });
            });
            </script>
            <center>       
                <div id="qrcode" class="mt-2"></div>
            </center>
          </td>
        </tr>
      </table>
  </div>
</div>
</body>
</html>