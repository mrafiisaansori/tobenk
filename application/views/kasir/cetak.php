<?php
date_default_timezone_set('Asia/Jakarta');
$identitas = $this->db->query("SELECT * FROM m_identitas LIMIT 1")->row();
?>
<title>Cetak Struk</title>
<style type="text/css">
  table{
    font-size: 30pt;
      font-family: sans-serif;
  }
    @page { size 6.35in 16.51in; margin: 0.00001mm }
    div.page { page-break-after: always }
    
    hr.style-eight { padding: 0; border: none; border-top: thin dashed #333; color: #333; text-align: center; } 
    hr.style-eight:after { /*content: "§";*/ display: inline-block; position: relative; top: -0.7em; font-size: 1.5em; padding: 0 0.25em; background: white; }
</style>
<script type="text/javascript" src="<?php echo site_url('qr'); ?>/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo site_url('qr'); ?>/qrcode.js"></script>
<?php
$browser = getBrowser();
//echo $browser;

$body="";
if($browser=="Firefox"){
  $body = " onload='print();window.close()' ";
}
elseif($browser=="Mobile browser"){
  $body = " onload='window.print();window.onfocus=function(){ window.close(); }' ";
}
else{
  $body = " onload='print()' onafterprint='window.close()' ";
}
?>
<body <?php echo $body; ?>>

<div class="page">
<center>

<table width="100%" >


<tr>

  <td align="center"></td>

  <td ></td>

  <td></td>

</tr>
  <tr>

  <td align="center" style="font-size: 30pt;font-family: sans-serif;"><img width="290px" src="<?php echo site_url('upload/logo/logo-dark.png'); ?>" alt=""></td>

  </tr>
  <tr>

    <td align="center" style="font-size: 30pt;font-family: sans-serif;"><b><?php echo $identitas->NAMA; ?></b></td>

    </tr>

    <tr>

    <td align="center" style="font-size: 25pt;font-family: sans-serif;"><?php echo $identitas->ALAMAT; ?></td>

    </tr>

    <tr>
    <td align="center" style="font-size: 25pt;font-family: sans-serif;"><?php echo $identitas->NO_TELP; ?></td>
    </tr>
   <tr>
    <table width="500px">
        <tr>
            <td><hr class="" /></td>
        </tr>
      </table>
  </tr>

  <tr>

    <table width="500px" style="font-size: 25pt;font-family: sans-serif;font-style: italic;" >

        <tr>

          <td width="70px" align="center">#<?php echo sprintf("%06d",$data->ID); ?></td>

          <td width="80px" align="center"><?php echo date('d/m/Y'); ?></td>

          <td width="70px" align="right"><?php echo date('H:m:s'); ?></td>

        </tr>

    </table>

  </tr>
  <tr>
  <br>
  <table width="500px" style="font-size: 25pt;font-family: sans-serif;">
  <tr>

    <td style="font-weight: bold;">Customer</td>

    <td></td>

    <td align="right"><?php echo $data->NAMA_CUSTOMER; ?></td>

    </tr>

    <tr>

    <td style="font-weight: bold;">Petugas</td>

    <td></td>

    <td align="right"><?php echo $data->NAMA_KASIR; ?></td>

    </tr>
    <tr>

    <td style="font-weight: bold;">Est. Selesai</td>

    <td></td>

    <td align="right"><?php if($data->ESTIMASI_SELESAI=="0000-00-00") echo "-"; else echo tgl_indo_lengkap($data->ESTIMASI_SELESAI); ?></td>

    </tr>
    <tr>

    <td style="font-weight: bold;">Jenis Bayar</td>

    <td></td>

    <td align="right"><?php echo ($data->JENIS_BAYAR); ?></td>

    </tr>
    <tr>

    <td style="font-weight: bold;">Metode Bayar</td>

    <td></td>

    <td align="right"><?php  if($data->ID_METODE_BAYAR==1) echo "Full"; else echo "DP"; ?></td>

    </tr>
  </table>
  </tr>
  <tr>
    <table width="500px">
        <tr>
            <td><hr class="" /></td>
        </tr>
      </table>
  </tr>
  <tr>

  <br>

    <table width="500px" style="font-size: 25pt;font-family: sans-serif;">



<?php

foreach ($produk as $dat) {

  ?>

  <tr>

  <td width="170px" align="left"><b><?php echo $dat->NAMA_PRODUK." x ".$dat->QTY; ?></b></td>

  <td width="100px" align="right" style="vertical-align:top"><?php echo formatRupiah($dat->HARGA_JUAL*$dat->QTY); ?></td>

  <tr>

  <td colspan="" style="font-size: 20pt;font-family: sans-serif;"><?php echo $dat->KETERANGAN; ?></td>

  </tr>

  

  </tr>

  <?php

}

?>



</table>

  </tr>

  <tr>
    <tr>
    <table width="500px" style="font-size: 14pt;font-family: sans-serif;">
        <tr>
            <td><hr class="" /></td>
        </tr>
      </table>
  </tr>
  <tr>

    <table width="500px" style="font-size: 25pt;font-family: sans-serif;">

  <tr>

    <td></td>

    <td></td>

    <td align="right"><?php echo formatRupiah($data->TOTAL); ?></td>

  </tr>
  <tr>

<td colspan="3"><br></td>

</tr>
  <tr>

    <td style="font-weight: bold;">Diskon</td>

    <td></td>

    <td align="right"><?php echo formatRupiah($data->DISKON); ?></td>

  </tr>

  <tr>

    <td style="font-weight: bold;">Total Tagihan</td>

    <td></td>

    <td align="right"><?php $hd=$data->TOTAL-$data->DISKON; echo formatRupiah($hd); ?></td>

  </tr>

  <tr>

    <td style="font-weight: bold;">Total Bayar</td>

    <td></td>

    <td align="right"><?php echo formatRupiah($bayar); ?></td>

  </tr>
  <?php  if($data->ID_METODE_BAYAR==2){ ?>
  <tr>

    <td style="font-weight: bold;"><?php echo "Kurang Bayar"; ?></td>

    <td></td>

    <td align="right"><?php $tsemua = $bayar-$hd;  echo formatRupiah(abs($tsemua)); ?></td>

  </tr>
  <?php } ?>

</table>

  </tr>

  <tr>

  <br>

  </tr>

</table>
<br>
<br>
<span style="font-size: 14pt;font-family: sans-serif;"></span>
<input id="text" type="hidden" value="<?php echo site_url('cetak/'.$link); ?>" />
<div id="qrcode" style="width:250px; height:250px; margin-top:15px;"></div>
<div style="height:100px;margin-top:100px">
.
</div>
</center>

</div>


<script>
  function closeMe() {
        var win = window.open("","_self"); /* url = "" or "about:blank"; target="_self" */
        win.close();
    }
</script>
<script type="text/javascript">
var qrcode = new QRCode(document.getElementById("qrcode"), {
	width : 250,
	height : 250
});

function makeCode () {		
	var elText = document.getElementById("text");
	
	if (!elText.value) {
		alert("Input a text");
		elText.focus();
		return;
	}
	
	qrcode.makeCode(elText.value);
}

makeCode();

$("#text").
	on("blur", function () {
		makeCode();
	}).
	on("keydown", function (e) {
		if (e.keyCode == 13) {
			makeCode();
		}
	});
</script>





</body>