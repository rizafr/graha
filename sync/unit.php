<?php 
include "conn.php";

function PMT($i, $n, $p)
{
	return $i * $p * pow((1 + $i), $n) / (1 - pow((1 + $i), $n));
}

if(isset($_REQUEST["import"]))
{			
	try
	{
		if($_FILES['file']['tmp_name'] == "")
		{
			throw new Exception("Pilih File Import .xls <br />");
		}
			
		$xlx = new Spreadsheet_Excel_Reader($_FILES['file']['tmp_name']);
		$baris = $xlx->rowcount($sheet_index=0);
		
		$persen_tanda_jadi	= (isset($_REQUEST["persen_tanda_jadi"])) ? trim($_REQUEST["persen_tanda_jadi"]) : 0;
		$persen_uang_muka	= (isset($_REQUEST["persen_uang_muka"])) ? trim($_REQUEST["persen_uang_muka"]) : 0;
		$suku_bunga			= (isset($_REQUEST["suku_bunga"])) ? trim($_REQUEST["suku_bunga"]) : 0;
		
		$persen_tanda_jadi	= floatval($persen_tanda_jadi);
		$persen_uang_muka	= floatval($persen_uang_muka);
		$suku_bunga			= floatval($suku_bunga);
		
		
		mysql_query("BEGIN");
		//mysql_query("TRUNCATE tbl_unit");
		for($i=4;$i<=$baris;$i++)
		{
			$nama_cluster = strtoupper(trim($xlx->val($i, 1)));
			$kode_unit = trim(str_replace(' ', '', $xlx->val($i, 2)));
			$kategori = strtoupper(trim($xlx->val($i, 3)));
			$nama_type = strtoupper(trim($xlx->val($i, 4)));
			$posisi = strtoupper(trim($xlx->val($i, 5)));
			$luas_tanah = $xlx->val($i, 6);
			$luas_bangunan = $xlx->val($i, 7);
			$harga_tanah_m2 = $xlx->val($i, 8);
			$fs = $xlx->val($i, 9);
			$harga_bangunan_m2 = $xlx->val($i, 10);
			$diskon_tanah = $xlx->val($i, 11);
			$diskon_bangunan = $xlx->val($i, 12);
			$harga_tanah = $xlx->val($i, 13);
			$harga_bangunan = $xlx->val($i, 14);
			$harga_jual_exc_ppn = $xlx->val($i, 15);
			$harga_jual_inc_ppn = $xlx->val($i, 19);
			$kelas_produk = $xlx->val($i, 20);
			
			$result = mysql_query("SELECT count(id_unit) AS tot FROM tbl_unit WHERE kode_unit = '$kode_unit'", $conn);
			$cek = mysql_fetch_array($result);
			if ($cek['tot'] > 0)
			{
				throw new Exception("Kode unit $kode_unit telah terdaftar row : $i <br />");
			}
			
			$result = mysql_query("
			SELECT c.id_cluster AS id_cluster, t.id_type AS id_type
			FROM tbl_cluster c
			INNER JOIN tbl_type t ON c.id_cluster = t.id_cluster
			WHERE c.nama_cluster = '$nama_cluster' AND t.nama_type = '$nama_type' LIMIT 1", $conn);
			
			$id = mysql_fetch_array($result);
			if (count($id['id_cluster']) < 1)
			{
				throw new Exception("Data tidak ditemukan Cluster : $nama_cluster & Type : $nama_type <br />");
			}
			
			$id_cluster = $id['id_cluster'];
			$id_type = $id['id_type'];
			
			$tanda_jadi = $harga_jual_inc_ppn * ($persen_tanda_jadi/100);
			$uang_muka = $harga_jual_inc_ppn * ($persen_uang_muka/100);
			$plafon_kpr = $harga_jual_inc_ppn - ($tanda_jadi+$uang_muka);
			
			$kpr_5_tahun = PMT($suku_bunga/100/12, 60, (0-$plafon_kpr));
			$kpr_10_tahun = PMT($suku_bunga/100/12, 120, (0-$plafon_kpr));
			$kpr_15_tahun = PMT($suku_bunga/100/12, 180, (0-$plafon_kpr));
			
			mysql_query("INSERT INTO tbl_unit (
			id_unit, 
			id_cluster, 
			id_type,
			posisi,		
			kode_unit, 
			kategori, 
			luas_tanah, 
			luas_bangunan, 
			harga_tanah_m2, 
			harga_bangunan_m2, 
			diskon_tanah, 
			diskon_bangunan, 
			harga_tanah, 
			harga_bangunan, 
			harga_jual_exc_ppn, 
			harga_jual_inc_ppn, 
			fs, 
			keterangan_fs, 
			tanda_jadi, 
			persen_tanda_jadi, 
			uang_muka, 
			persen_uang_muka, 
			plafon_kpr, 
			kpr_5_tahun, 
			kpr_10_tahun, 
			kpr_15_tahun, 
			suku_bunga, 
			status_unit, 
			status_transaksi, 
			tanggal_posting, 
			kelas_produk) 
			VALUES (
			'', 
			'$id_cluster', 
			'$id_type',
			'$posisi',
			'$kode_unit', 
			'$kategori', 
			'$luas_tanah', 
			'$luas_bangunan', 
			'$harga_tanah_m2', 
			'$harga_bangunan_m2', 
			'$diskon_tanah', 
			'$diskon_bangunan', 
			'".round($harga_tanah)."', 
			'".round($harga_bangunan)."', 
			'".round($harga_jual_exc_ppn)."', 
			'".round($harga_jual_inc_ppn)."', 
			'$fs', 
			'', 
			'".round($tanda_jadi)."', 
			'$persen_tanda_jadi', 
			'".round($uang_muka)."', 
			'$persen_uang_muka', 
			'".round($plafon_kpr)."', 
			'".round($kpr_5_tahun)."', 
			'".round($kpr_10_tahun)."', 
			'".round($kpr_15_tahun)."', 
			'$suku_bunga', 
			'Marketable', 
			'', 
			NOW(), 
			'$kelas_produk')");
		}
		
		mysql_query("COMMIT");
		echo "Import Data Unit Sukses !";
		
		# UPDATE BLOK TYPE
		$result = mysql_query("SELECT kode_unit, id_type FROM tbl_unit ORDER BY id_type ASC, kode_unit ASC" ,$conn);

		$id_type_head = "";
		$b = array();
		while($row = mysql_fetch_array($result))
		{
			$id_type = $row['id_type'];
			$ku = explode("/", $row['kode_unit']);
			$ku = explode("-", $ku[1]);
			$blok = $ku[0];
			
			if ($id_type_head != $id_type)
			{
				if ($id_type_head != "")
				{
					$kode_blok = implode(",", $b);
					mysql_query("UPDATE tbl_type SET kode_blok = '$kode_blok' WHERE id_type = '$id_type_head'");
				}
				$id_type_head = $id_type;
				$kode_blok = "";
				$b = array();
			}
			
			if (!in_array($blok, $b))
			{
				array_push($b, $blok);
			}
		}

		$kode_blok = implode(",", $b);
		mysql_query("UPDATE tbl_type SET kode_blok = '$kode_blok' WHERE id_type = '$id_type_head'");
		
	}
	catch(Exception $e)
	{
		mysql_query("ROLLBACK");
		echo $e->getMessage();
	}
	
	mysql_close($conn);
}
?>
<html>
<head>
<title>Unit</title>
</head>
<body>
<form name="form1" method="post" id="form1" enctype="multipart/form-data">
<table width="600px">
	<tr>
		<td colspan="2">
			<b>IMPORT UNIT</b>
		</td>
	</tr>
	<tr>
		<td width="100px" align="left">FILE</td>
		<td width="400px">
			<input type="file" size="60" name="file">
		</td>
	</tr>
	<tr>
		<td align="left">Tanda Jadi (%)</td>
		<td>
			<input type="text" size="5" name="persen_tanda_jadi" value="2.5">
		</td>
	</tr>
	<tr>
		<td align="left">Uang Muka (%)</td>
		<td>
			<input type="text" size="5" name="persen_uang_muka" value="27.5">
		</td>
	</tr>
	<tr>
		<td align="left">Asumsi Suku Bunga (%)</td>
		<td>
			<input type="text" size="5" name="suku_bunga" value="7.25">
		</td>
	</tr>
	<tr>
		<td align="left">&nbsp;</td>
		<td>
			<input type="submit" name="import" value="Import">
		</td>
	</tr>
</table>
</form>
</body>
</html>