<?php
date_default_timezone_set('Asia/Jakarta');

function time_ago($date){
    if(empty($date)) {
        return "No date provided";
    }
   
    $totaldelay = time() - strtotime($date);
    if($totaldelay <= 0)
    {
        return '';
    }
    else
    {
        if($days=floor($totaldelay/86400))
        {
            $totaldelay = $totaldelay % 86400;
            return $days.' hari lalu.';
        }
        if($hours=floor($totaldelay/3600))
        {
            $totaldelay = $totaldelay % 3600;
            return $hours.' jam lalu.';
        }
        if($minutes=floor($totaldelay/60))
        {
            $totaldelay = $totaldelay % 60;
            return $minutes.' menit lalu.';
        }
        if($seconds=floor($totaldelay/1))
        {
            $totaldelay = $totaldelay % 1;
            return $seconds.' detik lalu.';
        }
    }
}

function ubah_format_tanggal($tanggal, $format = ""){

	if($tanggal != "0000-00-00 00:00:00")
	{
		$tanggal_ori 	= explode(' ', $tanggal);
		$data_tanggal 	= explode('-', $tanggal_ori[0]);
		
		if($data_tanggal[1] == '01' || $data_tanggal[1] == '1'){
			$bulan = 'Januari';
		}
		else if($data_tanggal[1] == '02' || $data_tanggal[1] == '2'){
			$bulan = 'Februari';
		}
		else if($data_tanggal[1] == '03' || $data_tanggal[1] == '3'){
			$bulan = 'Maret';
		}
		else if($data_tanggal[1] == '04' || $data_tanggal[1] == '4'){
			$bulan = 'April';
		}
		else if($data_tanggal[1] == '05' || $data_tanggal[1] == '5'){
			$bulan = 'Mei';
		}
		else if($data_tanggal[1] == '06' || $data_tanggal[1] == '6'){
			$bulan = 'Juni';
		}
		else if($data_tanggal[1] == '07' || $data_tanggal[1] == '7'){
			$bulan = 'Juli';
		}
		else if($data_tanggal[1] == '08' || $data_tanggal[1] == '8'){
			$bulan = 'Agustus';
		}
		else if($data_tanggal[1] == '09' || $data_tanggal[1] == '9'){
			$bulan = 'September';
		}
		else if($data_tanggal[1] == '10' || $data_tanggal[1] == '10'){
			$bulan = 'Oktober';
		}
		else if($data_tanggal[1] == '11' || $data_tanggal[1] == '11'){
			$bulan = 'November';
		}
		else if($data_tanggal[1] == '12' || $data_tanggal[1] == '12'){
			$bulan = 'Desember';
		}
		
		$res = $data_tanggal[2].' '.$bulan.' '.$data_tanggal[0];
		if ($format == "H:i:s")
		{
			$res .= " ".$tanggal_ori[1];
		}
		
		echo $res;
	}
	else
	{
		echo "";
	}
}

# Format yy-mm-dd
function get_bulan($bln){

	$bulan = "";
		
	if($bln == '01' || $bln == '1'){
		$bulan = 'Januari';
	}
	else if($bln == '02' || $bln == '2'){
		$bulan = 'Februari';
	}
	else if($bln == '03' || $bln == '3'){
		$bulan = 'Maret';
	}
	else if($bln == '04' || $bln == '4'){
		$bulan = 'April';
	}
	else if($bln == '05' || $bln == '5'){
		$bulan = 'Mei';
	}
	else if($bln == '06' || $bln == '6'){
			$bulan = 'Juni';
	}
	else if($bln == '07' || $bln == '7'){
		$bulan = 'Juli';
	}
	else if($bln == '08' || $bln == '8'){
		$bulan = 'Agustus';
	}
	else if($bln == '09' || $bln == '9'){
		$bulan = 'September';
	}
	else if($bln == '10' || $bln == '10'){
		$bulan = 'Oktober';
	}
	else if($bln == '11' || $bln == '11'){
		$bulan = 'November';
	}
	else if($bln == '12' || $bln == '12'){
		$bulan = 'Desember';
	}
		
	return $bulan;
}

function exp_order($timeout, $tanggal_status)
{
	$order = strtotime($tanggal_status);
	$res = $timeout+$order;
		
	echo ubah_format_tanggal(date("Y-m-d H:i:s", $res), "H:i:s");
}

function dhm($timeout, $format = "")
{
	$show = "";
	$res = array();
	$res['hari'] = floor($timeout/86400);
	$res['jam'] = floor(($timeout%86400)/3600);
	$res['menit'] = floor(($timeout%3600)/60);
	
	if ($format != "" )
	{
		if ($res['hari'] > 0)
		{
			$show .= $res['hari']." Hari";
		}
		if ($res['jam'] > 0)
		{
			if ($res['hari'] > 0)
			{
				$show .= ", ";
			}
			$show .= $res['jam']." Jam";
		}
		if ($res['menit'] > 0)
		{
			if (($res['hari'] > 0) OR ($res['jam'] > 0))
			{
				$show .= ", ";
			}
			$show .= $res['menit']." Menit";
		}
		
		return $show;
	}
	
	return $res;
}
?>
