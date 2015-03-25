<?php
function kode_unit($kode_unit)
{
	$kode = array();
	$cluster_blok = explode("/", $kode_unit);
	$kode["cluster"] = $cluster_blok[0];
	$blok_nomor = explode("-", $cluster_blok[1]);
	$kode["blok"] = $blok_nomor[0];
	$kode["nomor"] = $blok_nomor[1];
	
	return $kode;
}

function PMT($i, $n, $p)
{
	return $i * $p * pow((1 + $i), $n) / (1 - pow((1 + $i), $n));
}
	
function hitung($data = array())
{
    $luas_tanah			= $data["luas_tanah"];
	$luas_bangunan		= $data["luas_bangunan"];
	$harga_tanah_m2		= $data["harga_tanah_m2"];
	$harga_bangunan_m2	= $data["harga_bangunan_m2"];
	$diskon_tanah		= $data["diskon_tanah"]/100;
	$diskon_bangunan	= $data["diskon_bangunan"]/100;
	$fs					= $data["fs"]/100;
			
	$harga_tanah		= ($luas_tanah * ($harga_tanah_m2*(1 + $fs)) * (1 - $diskon_tanah));
	$harga_bangunan		= ($luas_bangunan * $harga_bangunan_m2) * (1 - $diskon_bangunan);
			
	$harga_jual_exc_ppn	= $harga_tanah + $harga_bangunan;
	$ppn_tanah			= $harga_tanah / 10;
	$ppn_bangunan		= $harga_bangunan / 10;
	$total_ppn			= $ppn_tanah + $ppn_bangunan;
			
	$harga_jual_inc_ppn	= $harga_jual_exc_ppn + $total_ppn;
	
	$res = array(
		"harga_tanah"			=> $harga_tanah,
		"harga_bangunan"		=> $harga_bangunan,
		"harga_jual_exc_ppn"	=> $harga_jual_exc_ppn,
		"ppn_tanah"				=> $ppn_tanah,
		"ppn_bangunan"			=> $ppn_bangunan,
		"total_ppn"				=> $total_ppn,
		"harga_jual_inc_ppn"	=> $harga_jual_inc_ppn
	);
	
	return $res;
}

?>
