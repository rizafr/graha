<?php include "fungsi_tanggal.php"; ?>
<?php include "fungsi_kode.php"; ?>

<?php
$ymd = explode('-', $tanggal);
$yy = $ymd[0];
$mm = strtoupper(get_bulan($ymd[1]));
$dd = $ymd[2];

$file_tanggal = "TANGGAL $dd $mm $yy";

$filename = "Laporan Stok $status $kategori $file_tanggal";
$filename = preg_replace('/[\/:*?"<>|]/', '', $filename);
$filename = preg_replace('!\s+!', ' ', $filename);
$filename = str_replace(' ', '_', $filename);

header("Content-type: application/msexcel");
header("Content-Disposition: attachment; filename=$filename.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>
<html>
<head>
<meta charset="utf-8">
</head>
<style type="text/css">

body{
	font-family: Arial, Helvetica, sans-serif;
	font-size: 10px;
}

table {
	border-collapse: collapse;
}

</style>
<body>


<?php

echo "<h3>LAPORAN STOK $status $kategori TANGGAL $dd $mm $yy - GRAHA RAYA</h3>";

?>

<table border="1" cellpadding="1" cellspacing="0">
	<TR BGCOLOR="#C0C0C0">
		<TH ROWSPAN="2"> CLUSTER </TH>
		<TH ROWSPAN="2"> KODE BLOK </TH>
		<TH ROWSPAN="2"> TIPE PRODUK </TH>
		<TH ROWSPAN="2"> TIPE BANGUNAN </TH>
		<TH COLSPAN="2"> LUAS (M&sup2;) </TH>
		<TH ROWSPAN="2"> HARGA TANAH/M&sup2; </TH> 
		<TH ROWSPAN="2"> T+ </TH>
		<TH ROWSPAN="2"> HARGA BANG/M&sup2; </TH> 
		<TH COLSPAN="2"> DISKON % </TH>
		<TH COLSPAN="2"> HARGA </TH>
		<TH ROWSPAN="2"> HARGA SEBELUM PPN </TH>
		<TH COLSPAN="2"> PAJAK </TH>
		<TH ROWSPAN="2"> TOTAL PPN </TH>
		<TH ROWSPAN="2"> HARGA SETELAH PPN </TH>
		<TH ROWSPAN="2"> KELAS PRODUK </TH>
	</TR>
	
	<TR BGCOLOR="#C0C0C0">
		<TH> TNH </TH>
		<TH> BANG </TH>
		<TH> TNH </TH>
		<TH> BANG </TH>
		<TH> TNH </TH>
		<TH> BANG </TH>
		<TH> TNH </TH>
		<TH> BANG </TH>
	</TR>
		
<?php
$no = 1;
$i = 5;
foreach($lap as $b)
{
	
	if ($b->status_unit == "Promo")
	{
		$data = array(
			"luas_tanah"		=> $b->luas_tanah,
			"luas_bangunan" 	=> $b->luas_bangunan,
			"harga_tanah_m2"	=> $b->harga_tanah_m2,
			"harga_bangunan_m2"	=> $b->harga_bangunan_m2,
			"diskon_tanah"		=> $b->diskon_tanah,
			"diskon_bangunan"	=> $b->diskon_bangunan,
			"fs"				=> $b->fs);
				
		$res = hitung($data);
		
		$diskon_tanah = $b->diskon_tanah;
		$diskon_bangunan = $b->diskon_bangunan;
		$harga_tanah = $res["harga_tanah"];
		$harga_bangunan = $res["harga_bangunan"];
		$harga_jual_exc_ppn = $res["harga_jual_exc_ppn"];
		$ppn_tanah = $res["ppn_tanah"];
		$ppn_bangunan = $res["ppn_bangunan"];
		$total_ppn = $res["total_ppn"];
		$harga_jual_inc_ppn = $res["harga_jual_inc_ppn"];
	}
	else
	{
		$diskon_tanah = 0.00;
		$diskon_bangunan = 0.00;
		$harga_tanah = $b->harga_tanah;
		$harga_bangunan = $b->harga_bangunan;
		$harga_jual_exc_ppn = $b->harga_jual_exc_ppn;
		$ppn_tanah = $b->ppn_tanah;
		$ppn_bangunan = $b->ppn_bangunan;
		$total_ppn = $b->total_ppn;
		$harga_jual_inc_ppn = $b->harga_jual_inc_ppn;
	}
	
	?>
		
	<tr>
		<td> <?php echo $b->nama_cluster; ?> </td>
		<td> <?php echo $b->kode_unit; ?> </td>
		<td> <?php echo $b->kategori; ?> </td>
		<td> <?php echo $b->tipe_bangunan; ?> </td>
		<td> <?php echo number_format($b->luas_tanah, 2); ?> </td>
		<td> <?php echo number_format($b->luas_bangunan, 2); ?> </td>
		<td> <?php echo number_format($b->harga_tanah_m2, 0); ?> </td>
		<td> <?php echo $b->fs; ?>% </td>
		<td> <?php echo number_format($b->harga_bangunan_m2, 0); ?> </td>
		<td> <?php echo number_format($diskon_tanah, 2); ?>% </td>
		<td> <?php echo number_format($diskon_bangunan, 2); ?>% </td>
		<td> <?php echo number_format($harga_tanah, 0); ?> </td>
		<td> <?php echo number_format($harga_bangunan, 0); ?> </td>
		<td> <?php echo number_format($harga_jual_exc_ppn, 0); ?> </td>
		<td> <?php echo number_format($ppn_tanah, 0); ?> </td>
		<td> <?php echo number_format($ppn_bangunan, 0); ?> </td>
		<td> <?php echo number_format($total_ppn, 0); ?> </td>
		<td> <?php echo number_format($harga_jual_inc_ppn, 0); ?> </td>
		<td align="center"> <?php echo $b->kelas_produk; ?> </td>
	</tr>
	
	<?php
	$no++;
	$i++;
}
$i--;
?>

	<tr bgcolor="#C0C0C0">
		
		<th colspan="4"> TOTAL </th>
		<th align="right"> <?php echo "=SUM(E5:E$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(F5:F$i)"; ?> </th>
		<th colspan="5"></th>
		<th align="right"> <?php echo "=SUM(L5:L$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(M5:M$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(N5:N$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(O5:O$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(P5:P$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(Q5:Q$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(R5:R$i)"; ?> </th>
		<th></th>
		
	</tr>

</table>
</body>
</html>