<?php
date_default_timezone_set('Asia/Jakarta');
$identitas = $this->db->query("SELECT * FROM m_identitas LIMIT 1")->row();
?>

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

<body onload="window.print()" >

<div class="page">
<center>

<table width="100%" >

<tr>

<td colspan="3"><br><br></td>

</tr>

<tr>

  <td align="center"></td>

  <td ></td>

  <td></td>

</tr>

  <tr>

    <td align="center" style="font-size: 30pt;font-family: sans-serif;"><b><?php echo $identitas->NAMA; ?></b></td>

    </tr>

    <tr>

    <td align="center" style="font-size: 22pt;font-family: sans-serif;"><?php echo $identitas->ALAMAT; ?></td>

    </tr>

    <tr>
    <td align="center" style="font-size: 22pt;font-family: sans-serif;"><?php echo $identitas->NO_TELP; ?></td>
    </tr>
    <tr>
    <td align="center" style="font-size: 22pt;font-family: sans-serif;"> <?php echo $identitas->EMAIL; ?></td>
    </tr>
   <tr>
    <table width="500px">
        <tr>
            <td><hr class="" /></td>
        </tr>
      </table>
  </tr>

  <tr>

    <table width="500px" style="font-size: 22pt;font-family: sans-serif;" >

        <tr>

          <td width="70px" align="center">#<?php echo sprintf("%06d",$data->ID); ?></td>

          <td width="80px" align="center"><?php echo date('d/m/Y'); ?></td>

          <td width="70px" align="right"><?php echo date('H:m:s'); ?></td>

        </tr>

    </table>

  </tr>

  <tr>

    <table width="500px" style="font-size: 22pt;font-family: sans-serif;">

        <tr>

          <td width="70px" align="center"><?php echo $data->NAMA_KASIR; ?></td>

          <td width="80px" align="center"></td>

          <td width="70px" align="right"></td>

        </tr>

    </table>

  </tr>

  <tr>

  <br>

    <table width="500px" style="font-size: 22pt;font-family: sans-serif;">



<?php

foreach ($produk as $dat) {

  ?>

  <tr>

  <td width="170px" align="left"><b><?php echo $dat->NAMA_PRODUK; ?></b></td>

  <td width="100px" align="right"><?php echo formatRupiah($dat->HARGA_JUAL*$dat->QTY); ?></td>

  <tr>

  <td colspan="" style="font-size: 18pt;font-family: sans-serif;"><i><?php echo $dat->HARGA_JUAL." x ".$dat->QTY; ?></i></td>

  </tr>

  

  </tr>

  <?php

}

?>



</table>

  </tr>

  <tr>
    <tr>
    <table width="500px" style="font-size: 22pt;font-family: sans-serif;">
        <tr>
            <td><hr class="" /></td>
        </tr>
      </table>
  </tr>
  <tr>

    <table width="500px" style="font-size: 22pt;font-family: sans-serif;">

  <tr>

    <td>Total</td>

    <td></td>

    <td align="right"><?php echo formatRupiah($data->TOTAL); ?></td>

  </tr>

</table>

  </tr>

  <tr>

  <br>

  </tr>

</table>
<br>
<br>
<span style="font-size: 22pt;font-family: sans-serif;"> Terima Kasih </span>

</center>
<br>
<br>
</div>








</body>
<script>

</script>