<?php include "fungsi_tanggal.php"; ?>
<?php include "fungsi_kode.php"; ?>

<?php
$ymd = explode('-', $tanggal);
$yy = $ymd[0];
$mm = strtoupper(get_bulan($ymd[1]));
$dd = $ymd[2];

$file_tanggal = "TANGGAL $dd $mm $yy";

$filename = "Laporan Trash Data $jenis_pemesanan $kategori $team $nama_sales $file_tanggal";
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

echo "<h3>LAPORAN TRASH DATA $jenis_pemesanan $kategori $team $nama_sales TANGGAL $dd $mm $yy - GRAHA RAYA</h3>";

?>

<table border="1" cellpadding="1" cellspacing="0">
	<tr bgcolor="#C0C0C0">
		<TH ROWSPAN="2"> NO. PEMESANAN </TH>
		<TH ROWSPAN="2"> STATUS TRANSAKSI </TH>
		<TH ROWSPAN="2"> STATUS VERIFY </TH>
		<TH ROWSPAN="2"> TGL PEMESANAN </TH>
		<TH ROWSPAN="2"> TGL TJ </TH>
		<TH ROWSPAN="2"> TGL DIHAPUS </TH>
		<TH ROWSPAN="2"> DIHAPUS OLEH </TH>
		<TH ROWSPAN="2"> CLUSTER </TH>
		<TH ROWSPAN="2"> KODE BLOK </TH>
		<TH ROWSPAN="2"> PEMBELI </TH>
		<TH ROWSPAN="2"> TIPE PRODUCT </TH>
		<TH ROWSPAN="2"> TIPE BANGUNAN </TH>
		<TH COLSPAN="2"> LUAS </TH>
		<TH ROWSPAN="2"> HARGA TANAH/M&sup2; </TH> 
		<TH ROWSPAN="2"> T+ </TH>
		<TH ROWSPAN="2"> HARGA BANG/M&sup2; </TH> 
		<TH COLSPAN="2"> DISKON </TH>
		<TH COLSPAN="2"> HARGA </TH>
		<TH ROWSPAN="2"> HARGA EXC. PPN </TH>
		<TH ROWSPAN="2"> HARGA INC. PPN </TH>
		<TH ROWSPAN="2"> SALES </TH>
		<TH ROWSPAN="2"> PEMBAYARAN </TH>
		<TH ROWSPAN="2"> BOOKING FEE (RP) </TH>
		<TH ROWSPAN="2"> TJ (RP) </TH>
	</TR>
		<tr bgcolor="#C0C0C0">
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
	if ($b->jenis_pemesanan == "Promo")
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
					
		$harga_tanah = $res["harga_tanah"];
		$harga_bangunan = $res["harga_bangunan"];
		$harga_jual_exc_ppn = $res["harga_jual_exc_ppn"];
		$harga_jual_inc_ppn = $res["harga_jual_inc_ppn"];
	}
	else
	{
		$harga_tanah = $b->harga_tanah;
		$harga_bangunan = $b->harga_bangunan;
		$harga_jual_exc_ppn = $b->harga_jual_exc_ppn;
		$harga_jual_inc_ppn = $b->harga_jual_inc_ppn;
	}
	
	?>
		
	<tr>
		<td> <?php echo $b->nomor_pemesanan; ?> </td>
		<td align="center"> 
		<?php
			if($b->status_pemesanan == "Booked")
			{
				echo "<font color='green'>".$b->status_pemesanan."</font>"; 
			}
			else
			{
				echo "<font color='red'>".$b->status_pemesanan."</font>"; 
			}
		?>
		</td>
		<td align="center"> <font color="green"><?php echo $b->status_verify; ?></font> </td>
		<td> <?php echo $b->tanggal_pemesanan; ?> </td>
		<td> <?php echo $b->tanggal_tanda_jadi; ?> </td>
		<td> <?php ubah_format_tanggal($b->delete_time, "H:i:s"); ?> </td>
		<td> <?php echo $b->delete_by; ?> </td>
		<td> <?php echo $b->nama_cluster; ?> </td>
		<td> <?php echo $b->kode_unit; ?> </td>
		<td> <?php echo $b->nama_pembeli; ?> </td>
		<td> <?php echo $b->kategori; ?> </td>
		<td> <?php echo $b->tipe_bangunan; ?> </td>
		<td> <?php echo number_format($b->luas_tanah, 2); ?> </td>
		<td> <?php echo number_format($b->luas_bangunan, 2); ?> </td>
		<td> <?php echo number_format($b->harga_tanah_m2, 0); ?> </td>
		<td> <?php echo number_format($b->fs, 2); ?>% </td>
		<td> <?php echo number_format($b->harga_bangunan_m2, 0); ?> </td>
		<td> <?php echo number_format($b->diskon_tanah, 2); ?>% </td>
		<td> <?php echo number_format($b->diskon_bangunan, 2); ?>% </td>
		<td> <?php echo number_format($harga_tanah, 0); ?> </td>
		<td> <?php echo number_format($harga_bangunan, 0); ?> </td>
		<td> <?php echo number_format($harga_jual_exc_ppn, 0); ?> </td>
		<td> <?php echo number_format($harga_jual_inc_ppn, 0); ?> </td>
		<td> <?php echo $b->nama_sales; ?> </td>
		<td> <?php echo $b->cara_pembayaran; ?>x </td>
		<td> <?php echo number_format($b->booking_fee, 0); ?> </td>
		<td> <?php echo number_format($b->tanda_jadi, 0); ?> </td>
	</tr>
	
	<?php
	$no++;
	$i++;
}
$i--;
?>

	<tr bgcolor="#C0C0C0">
		<th colspan="12"> TOTAL </th>
		<th align="right"> <?php echo "=SUM(M5:M$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(N5:N$i)"; ?> </th>
		<th colspan="5"></th>
		<th align="right"> <?php echo "=SUM(T5:T$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(U5:U$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(V5:V$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(W5:W$i)"; ?> </th>
		<th colspan="2"></th>
		<th align="right"> <?php echo "=SUM(Z5:Z$i)"; ?> </th>
		<th align="right"> <?php echo "=SUM(AA5:AA$i)"; ?> </th>
	</tr>

</table>
</body>
</html>