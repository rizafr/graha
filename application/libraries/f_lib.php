<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class F_lib{

	function __construct()
	{
		$this->CI =& get_instance();
	}
	
	# Ambil Timestamp Tanggal Expire ( Option Date Format )
	function exp_order($timeout, $tanggal_status, $format = ""){

		$order = strtotime($tanggal_status);
		$res = $timeout+$order;
		
		if ($format == "H:i:s")
		{
			return $this->ubah_format_tanggal(date("Y-m-d H:i:s", $res), "H:i:s");
		}
		else
		{
			return $res;
		}
		
	}
	
	# "RETURN" Date Formated.
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
			
			return $res;
		}
		else
		{
			return "";
		}
	}
	
	# Detail Timeout
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
	
}

# End of file access_lib.php
# Location: ./applicaion/libraries/access_lib.php