<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function base64_encode_fix($string)
{
	$base_64_string = base64_encode($string);
	$url_param = rtrim($base_64_string, '=');
    return $url_param;
}

function base64_decode_fix($string)
{
	$base_64_string = $string . str_repeat('=', strlen($string) % 4);
    return base64_decode($base_64_string);
}

function getBrowser()
{
    $user_agent = $_SERVER['HTTP_USER_AGENT'];
    $browser = "N/A";

    $browsers = [
        '/msie/i' => 'Internet explorer',
        '/firefox/i' => 'Firefox',
        '/safari/i' => 'Safari',
        '/chrome/i' => 'Chrome',
        '/edge/i' => 'Edge',
        '/opera/i' => 'Opera',
        '/mobile/i' => 'Mobile browser',
    ];

    foreach ($browsers as $regex => $value) {
        if (preg_match($regex, $user_agent)) {
            $browser = $value;
        }
    }

    return $browser;
}

if ( ! function_exists('alpha_sah_space')) {
    function alpha_dash_space($str)
    {
        return ( ! preg_match("/^([-a-z0-9_ ])+$/i", $str)) ? FALSE : TRUE;
    } 
}

if ( ! function_exists('generate_options'))
{
	function generate_options($value = NULL, $key, $print, $mode=NULL)
	{
		$CI =& get_instance();

        $options = array();

        if($value == NULL){

          $options[''] = '';

        }

        else{
          foreach($value as $options_value){

              if($mode == NULL) $options[$options_value->$key] = ucwords(strtolower($options_value->$print));
              elseif($mode == 'ori') $options[$options_value->$key] = $options_value->$print;

          }

        }

        return $options;
	}
}

/* to make easy generate options sequence int number values*/

if ( ! function_exists('generate_options_int_sequence'))
{
	function generate_options_int_sequence($start=NULL, $end=NULL)
	{
		$options = array();

        if( ($start == NULL) || ($end==NULL) ){

          $options[''] = '';

        }

        else{

          for($i=$start;$i<=$end;$i++){

              $options[$i] = $i;

          }

        }

        return $options;
	}
}

/* to make easy generate options months values*/

if ( ! function_exists('generate_options_month'))
{
	function generate_options_month()
	{
		$options = array(
                   '1' => 'Januari',
                   '2' => 'Februari',
                   '3' => 'Maret',
                   '4' => 'April',
                   '5' => 'Mei',
                   '6' => 'Juni',
                   '7' => 'Juli',
                   '8' => 'Agustus',
                   '9' => 'September',
                   '10'=> 'Oktober',
                   '11'=> 'November',
                   '12'=> 'Desember'
                   );

        return $options;
	}
}


/* pemendek pemanggilan url asset web, e.g images, css, javascript */
///based on rsrc.php
///folder on root only

if ( ! function_exists('shortener_rsrc_link'))
{
	function shortener_rsrc_link($file)
	{
		list($filename,$file_type) = explode(".",$file);

        /*switch ($file_type){
          case 'css': break;
          case 'js': break;
          default: echo 'nothing'; break;
        }*/

        $links = base_url().'rsrc.php/'.md5($filename).'.'.$file_type;

        return $links;
	}
}



/* to make easy generate options sequence for time format*/

if ( ! function_exists('generate_options_time_sequence'))
{
	function generate_options_time_sequence($start=0,$end=0)
	{
		$options = array();

        for($i=$start;$i<=$end;$i++){

              if($i<10) $i = "0".$i;
              $options[$i] = $i;

        }

        return $options;
	}
}

if ( ! function_exists('generate_options_dosen'))
{
	function generate_options_dosen($value = NULL, $key, $print, $mode=NULL)
	{
		$CI =& get_instance();

        $options = array();

        if($value == NULL){

          $options[''] = '';

        }

        else{
          foreach($value as $options_value){

              if($options_value->GELAR) $options[$options_value->$key] = $options_value->$print.', '.$options_value->GELAR;
              else $options[$options_value->$key] = $options_value->$print;

          }

        }

        return $options;
	}
}


if ( ! function_exists('generate_options_angkatan_sequence_desc'))
{
	function generate_options_angkatan_sequence_desc($start=NULL, $end=NULL)
	{
		$options = array();

        if( ($start == NULL) || ($end==NULL) ){

          $options[''] = '';

        }

        else{

          for($i=$end;$i>=$start;$i--){
              $j = substr($i, 1, 1);
              if($j == 0)
              {
                $j = substr($i, 2);
              }
              else
              {
                $j = substr($i, 1);
              }
              $options[$j] = $i;

          }

        }

        return $options;
	}
}



if ( ! function_exists('PopupMsg'))
{
function PopupMsg($namafile) {

echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript1.2">
  win2 = window.open("$namafile", "", "width=600, height=300, scrollbars, status");
  win2.creator = self;
  </SCRIPT>
EOF;
}
}

if ( ! function_exists('formatRupiah'))
{
	function formatRupiah($nilaiUang)
	{
    if($nilaiUang){
      $nilaiRupiah = "";
      $jumlahAngka = strlen($nilaiUang);
      while($jumlahAngka > 3)
      {
        $nilaiRupiah = "." . substr($nilaiUang,-3) . $nilaiRupiah;
        $sisaNilai = strlen($nilaiUang) - 3;
        $nilaiUang = substr($nilaiUang,0,$sisaNilai);
        $jumlahAngka = strlen($nilaiUang);
      }

      $nilaiRupiah = "Rp " . $nilaiUang . $nilaiRupiah . ",-";
    }
    else{
      $nilaiRupiah = "Rp 0,-";
    }
		return $nilaiRupiah;
	}
}

function tgl_indo($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulan(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;
	}

  if ( ! function_exists('tgl_jam_indo_lengkap')) {
    function tgl_jam_indo_lengkap($tgl){
          $all = explode(" ", $tgl);
          $jam = explode(":", $all[1]);
          $tanggal = substr($all[0],8,2);
          $bulan = getBulanLengkap(substr($all[0],5,2));
          $tahun = substr($all[0],0,4);
          return $tanggal.' '.$bulan.' '.$tahun. " (".$jam[0].":".$jam[1].")";
      } 
    }
	
function tgl_indo_lengkap($tgl){
			$tanggal = substr($tgl,8,2);
			$bulan = getBulanLengkap(substr($tgl,5,2));
			$tahun = substr($tgl,0,4);
			return $tanggal.' '.$bulan.' '.$tahun;
	}

  function tgl_luar($tgl){
    $tanggal = substr($tgl,8,2);
    $bulan = getMonth(substr($tgl,5,2));
    $tahun = substr($tgl,0,4);
    return $bulan.' '.$tanggal.', '.$tahun;
  }	
		
  function cleanText ($text,$html=true) {
        $text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
        $text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
        $text = preg_replace( '/<!--.+?-->/', '', $text );
        $text = preg_replace( '/{.+?}/', '', $text );
        $text = preg_replace( '/&nbsp;/', ' ', $text );
        $text = preg_replace( '/&amp;/', ' ', $text );
        $text = preg_replace( '/&quot;/', ' ', $text );
        $text = strip_tags( $text );
        $text = preg_replace("/\r\n\r\n\r\n+/", " ", $text);
        $text = $html ? htmlspecialchars( $text ) : $text;
        return $text;
}

	function getBulan($bln){
				switch ($bln){
					case 1: 
						return "Jan";
						break;
					case 2:
						return "Feb";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agust";
						break;
					case 9:
						return "Sept";
						break;
					case 10:
						return "Okt";
						break;
					case 11:
						return "Nov";
						break;
					case 12:
						return "Des";
						break;
				}
			}
function getBulanLengkap($bln){
				switch ($bln){
					case 1: 
						return "Januari";
						break;
					case 2:
						return "Februari";
						break;
					case 3:
						return "Maret";
						break;
					case 4:
						return "April";
						break;
					case 5:
						return "Mei";
						break;
					case 6:
						return "Juni";
						break;
					case 7:
						return "Juli";
						break;
					case 8:
						return "Agustus";
						break;
					case 9:
						return "September";
						break;
					case 10:
						return "Oktober";
						break;
					case 11:
						return "November";
						break;
					case 12:
						return "Desember";
						break;
				}
			}

  function getMonth($bln){
        switch ($bln){
          case 1: 
            return "January";
            break;
          case 2:
            return "February";
            break;
          case 3:
            return "March";
            break;
          case 4:
            return "April";
            break;
          case 5:
            return "May";
            break;
          case 6:
            return "June";
            break;
          case 7:
            return "July";
            break;
          case 8:
            return "August";
            break;
          case 9:
            return "September";
            break;
          case 10:
            return "October";
            break;
          case 11:
            return "November";
            break;
          case 12:
            return "December";
            break;
        }
      }
		
function smarty_modifier_rupiah_format($sString) {
    $iNegative = 0;
    
    if(preg_match("/^-/",$sString)) {
        $iNegative    = 0;
        $sString    = preg_replace("|-|","",$sString);
    }

    $sString    = preg_replace("|,|","",$sString);
    $sFull        = explode(".",$sString);
    $iCount        = count($sFull);
    
    if($iCount > 1) {
        $sFirst        = $sFull[0];
        $sSecond    = $sFull[1];
        $sNumCents    = strlen($sSecond);
        
        if($sNumCents == 2) {
        } else if($sNumCents < 2) {
            $sSecond = $sSecond . "0";
        } else if($sNumCents > 2) {
            $sTemp        = substr($sSecond,0,3);
            $Rounded    = round($sTemp,-10);
            $sSecond    = substr($Rounded,0,2);          
       }  
    } else {
        $sFirst        = $sFull[0];    
        $sSecond    = "00";
    }

    $iLength = strlen($sFirst);

    if( $iLength <= 3 ) {
        $sString = $sFirst . "." . $sSecond;    

        if($iNegative == 1) {    
            $sString = "-" . $sString;
        }

        return $sString;
    } else {
        $iLoopCount        = intval( ( $iLength / 3 ) );
        $iSectionLength = -3;

        for( $i = 0; $i < $iLoopCount; $i++ ) {
            $aSection[$i] = substr( $sFirst, $iSectionLength, 3 );
            $iSectionLength = $iSectionLength - 3;
        }

        $iStub = ( $iLength % 3 );    
        
        if( $iStub != 0 ) {
            $aSection[$i] = substr( $sFirst, 0, $iStub );
        }
        
        $iDone = implode( ".", array_reverse($aSection));
        $iDone = $iDone;

        if($iNegative == 1) {    
            $iDone = "-" . $iDone;
        }

        return  $iDone;
    }
} 
function smarty_function_date_diff($params, &$smarty) {
   $date1 = mktime(0,0,0,1,1,2000);
   $date2 = mktime(0,0,0,date("m"),date("d"),date("Y"));
   $assign = null;
   $interval = "days";
   
   extract($params);

   $i = 1/60/60/24;
   if($interval == "weeks") {
      $i = $i/7;
   } elseif($interval == "years") {
      $i = $i/365.25;
   }
   
   $date1 = ((is_string($date1))?strtotime($date1):$date1);
   $date2 = ((is_string($date2))?strtotime($date2):$date2);
   
   if($assign != null) {
      $smarty->assign($assign,floor(($date2 - $date1)*$i));
   } else {
      return floor(($date2 - $date1)*$i);
   }
}
if ( ! function_exists('huruf_to_angka'))
{
	function huruf_to_angka($kode)
	{
        if($kode=="A")
        return "1";
        else if($kode=="B")
        return "2";
		else if($kode=="C")
        return "3";
		else if($kode=="D")
        return "4";
		else if($kode=="E")
        return "5";
		else if($kode=="G")
        return "6";
	}
}


if ( ! function_exists('generate_options'))
{
	function generate_options($value = NULL, $key, $print, $mode=NULL)
	{
		$CI =& get_instance();

        $options = array();

        if($value == NULL){

          $options[''] = '';

        }

        else{
          foreach($value as $options_value){

              if($mode == NULL) $options[$options_value->$key] = ucwords(strtolower($options_value->$print));
              elseif($mode == 'ori') $options[$options_value->$key] = $options_value->$print;

          }

        }

        return $options;
	}
}

/* to make easy generate options sequence int number values*/

if ( ! function_exists('generate_options_int_sequence'))
{
	function generate_options_int_sequence($start=NULL, $end=NULL)
	{
		$options = array();

        if( ($start == NULL) || ($end==NULL) ){

          $options[''] = '';

        }

        else{

          for($i=$start;$i<=$end;$i++){

              $options[$i] = $i;

          }

        }

        return $options;
	}
}

/* to make easy generate options months values*/

if ( ! function_exists('generate_options_month'))
{
	function generate_options_month()
	{
		$options = array(
                   '1' => 'Januari',
                   '2' => 'Februari',
                   '3' => 'Maret',
                   '4' => 'April',
                   '5' => 'Mei',
                   '6' => 'Juni',
                   '7' => 'Juli',
                   '8' => 'Agustus',
                   '9' => 'September',
                   '10'=> 'Oktober',
                   '11'=> 'November',
                   '12'=> 'Desember'
                   );

        return $options;
	}
}

if ( ! function_exists('get_hari'))
{
  function get_hari($kode)
  {
    if($kode=="1")
        return "SENIN";
    else if($kode=="2")
        return "SELASA";
    else if($kode=="3")
        return "RABU";
    else if($kode=="4")
        return "KAMIS";
    else if($kode=="5")
        return "JUMAT";
    else if($kode=="6")
        return "SABTU";
    else if($kode=="7")
        return "MINGGU";
  }
}


/* pemendek pemanggilan url asset web, e.g images, css, javascript */
///based on rsrc.php
///folder on root only

if ( ! function_exists('shortener_rsrc_link'))
{
	function shortener_rsrc_link($file)
	{
		list($filename,$file_type) = explode(".",$file);

        /*switch ($file_type){
          case 'css': break;
          case 'js': break;
          default: echo 'nothing'; break;
        }*/

        $links = base_url().'rsrc.php/'.md5($filename).'.'.$file_type;

        return $links;
	}
}

/* to make easy generate options sequence for time format*/

if ( ! function_exists('generate_options_time_sequence'))
{
	function generate_options_time_sequence($start=0,$end=0)
	{
		$options = array();

        for($i=$start;$i<=$end;$i++){

              if($i<10) $i = "0".$i;
              $options[$i] = $i;

        }

        return $options;
	}
}

if ( ! function_exists('generate_options_dosen'))
{
	function generate_options_dosen($value = NULL, $key, $print, $mode=NULL)
	{
		$CI =& get_instance();

        $options = array();

        if($value == NULL){

          $options[''] = '';

        }

        else{
          foreach($value as $options_value){

              if($options_value->GELAR) $options[$options_value->$key] = $options_value->$print.', '.$options_value->GELAR;
              else $options[$options_value->$key] = $options_value->$print;

          }

        }

        return $options;
	}
}


if ( ! function_exists('generate_options_angkatan_sequence_desc'))
{
	function generate_options_angkatan_sequence_desc($start=NULL, $end=NULL)
	{
		$options = array();

        if( ($start == NULL) || ($end==NULL) ){

          $options[''] = '';

        }

        else{

          for($i=$end;$i>=$start;$i--){
              $j = substr($i, 1, 1);
              if($j == 0)
              {
                $j = substr($i, 2);
              }
              else
              {
                $j = substr($i, 1);
              }
              $options[$j] = $i;

          }

        }

        return $options;
	}
}


if ( ! function_exists('PopupMsg'))
{
function PopupMsg($namafile) {

echo <<<EOF
  <SCRIPT LANGUAGE="JavaScript1.2">
  win2 = window.open("$namafile", "", "width=600, height=300, scrollbars, status");
  win2.creator = self;
  </SCRIPT>
EOF;
}
}

if ( ! function_exists('formatRupiah'))
{
	function formatRupiah($nilaiUang)
	{
		$nilaiRupiah = "";
		$jumlahAngka = strlen($nilaiUang);
		while($jumlahAngka > 3)
		{
			$nilaiRupiah = "." . substr($nilaiUang,-3) . $nilaiRupiah;
			$sisaNilai = strlen($nilaiUang) - 3;
			$nilaiUang = substr($nilaiUang,0,$sisaNilai);
			$jumlahAngka = strlen($nilaiUang);
		}

		$nilaiRupiah = "Rp " . $nilaiUang . $nilaiRupiah . ",-";
		return $nilaiRupiah;
	}
}

function the_content_limit($max_char, $more_link_text = '(more...)', $content) {
    $content = str_replace(']]>', ']]&gt;', $content);

   if ((strlen($content)>$max_char) && ($espacio = strpos($content, " ", $max_char ))) {
        $content = substr($content, 0, $espacio);
        $content = $content;
        echo $content;
        echo $more_link_text;
   }
   else {
      echo $content;
   }
}

function time_elapsed_string($datefrom,$dateto=-1)
{
         date_default_timezone_set('Asia/Jakarta');

        // Defaults and assume if 0 is passed in that
        // its an error rather than the epoch

        if($datefrom==0) { return "A long time ago"; }
        if($dateto==-1) { $dateto = time(); }

        // Make the entered date into Unix timestamp from MySQL datetime field

        $datefrom = strtotime($datefrom);

        // Calculate the difference in seconds betweeen
        // the two timestamps

        $difference = $dateto - $datefrom;

        // Based on the interval, determine the
        // number of units between the two dates
        // From this point on, you would be hard
        // pushed telling the difference between
        // this function and DateDiff. If the $datediff
        // returned is 1, be sure to return the singular
        // of the unit, e.g. 'day' rather 'days'

        switch(true)
        {
            // If difference is less than 60 seconds,
            // seconds is a good interval of choice
            case(strtotime('-1 min', $dateto) < $datefrom):
                $datediff = $difference;
                $res = ($datediff==1) ? $datediff.' second ago' : $datediff.' seconds ago';
                break;
            // If difference is between 60 seconds and
            // 60 minutes, minutes is a good interval
            case(strtotime('-1 hour', $dateto) < $datefrom):
                $datediff = floor($difference / 60);
                $res = ($datediff==1) ? $datediff.' minute ago' : $datediff.' minutes ago';
                break;
            // If difference is between 1 hour and 24 hours
            // hours is a good interval
            case(strtotime('-1 day', $dateto) < $datefrom):
                $datediff = floor($difference / 60 / 60);
                $res = ($datediff==1) ? $datediff.' hour ago' : $datediff.' hours ago';
                break;
            // If difference is between 1 day and 7 days
            // days is a good interval
            case(strtotime('-1 week', $dateto) < $datefrom):
                $day_difference = 1;
                while (strtotime('-'.$day_difference.' day', $dateto) >= $datefrom)
                {
                    $day_difference++;
                }

                $datediff = $day_difference;
                $res = ($datediff==1) ? 'yesterday' : $datediff.' days ago';
                break;
            // If difference is between 1 week and 30 days
            // weeks is a good interval
            case(strtotime('-1 month', $dateto) < $datefrom):
                $week_difference = 1;
                while (strtotime('-'.$week_difference.' week', $dateto) >= $datefrom)
                {
                    $week_difference++;
                }

                $datediff = $week_difference;
                $res = ($datediff==1) ? 'last week' : $datediff.' weeks ago';
                break;
            // If difference is between 30 days and 365 days
            // months is a good interval, again, the same thing
            // applies, if the 29th February happens to exist
            // between your 2 dates, the function will return
            // the 'incorrect' value for a day
            case(strtotime('-1 year', $dateto) < $datefrom):
                $months_difference = 1;
                while (strtotime('-'.$months_difference.' month', $dateto) >= $datefrom)
                {
                    $months_difference++;
                }

                $datediff = $months_difference;
                $res = ($datediff==1) ? $datediff.' month ago' : $datediff.' months ago';

                break;
            // If difference is greater than or equal to 365
            // days, return year. This will be incorrect if
            // for example, you call the function on the 28th April
            // 2008 passing in 29th April 2007. It will return
            // 1 year ago when in actual fact (yawn!) not quite
            // a year has gone by
            case(strtotime('-1 year', $dateto) >= $datefrom):
                $year_difference = 1;
                while (strtotime('-'.$year_difference.' year', $dateto) >= $datefrom)
                {
                    $year_difference++;
                }

                $datediff = $year_difference;
                $res = ($datediff==1) ? $datediff.' year ago' : $datediff.' years ago';
                break;

        }

        echo $res;
}

function get_date_format()
{
	$CI =& get_instance();
	switch($CI->config->item('date_format'))
	{
		case "middle_endian":
			return "m/d/Y";
		case "little_endian":
			return "d-m-Y";
		case "big_endian":
			return "Y-m-d";
		default:
			return "m/d/Y";
	}
}




if ( ! function_exists('generate_options_month'))

{

	function generate_options_month()

	{

		$options = array(

                   '1' => 'Januari',

                   '2' => 'Februari',

                   '3' => 'Maret',

                   '4' => 'April',

                   '5' => 'Mei',

                   '6' => 'Juni',

                   '7' => 'Juli',

                   '8' => 'Agustus',

                   '9' => 'September',

                   '10'=> 'Oktober',

                   '11'=> 'November',

                   '12'=> 'Desember'

                   );



        return $options;

	}

}
if ( ! function_exists('generate_options_month_baru'))
{
	function generate_options_month_baru()
	{
		$options = array('Januari',
                   'Februari',
                   'Maret',
                   'April',
                   'Mei',
                   'Juni',
                   'Juli',
                   'Agustus',
                   'September',
                   'Oktober',
                   'November',
                   'Desember'
                   );

        return $options;
	}
}

 if ( ! function_exists('scan_modules'))
{
  function scan_modules($namanya) 
  {
    $CI =& get_instance();
     $CI->load->helper('directory');
     $map = directory_map('./application/modules');
     $ap=array();
     $a=array_keys($map);
        foreach($a as $b){
          $ex=explode("_",$b);
          array_push($ap,$ex[0]);
        }
     $l=array_unique($ap);
      if (in_array($namanya, $l))
        {
          $kembalian =TRUE;
        }
      else
        {
          $kembalian=NULL;
        }
      return $kembalian;

  } 

}
?>