<?php include "fungsi_tanggal.php"; ?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Data Pemesanan / Reserved</title>
<style type="text/css">
body,td,th {
	font-size: 12px;
}
ul {
	margin-top:0px;
}
ul li {
	margin-left:-23px;
}
</style>
</head>
<?php
if ($this->agent->is_mobile())
{
	?>
	<body bgcolor="#666666">
	<?php
}
else
{
	?>
	<body onLoad="window.print(); window.close();"  bgcolor="#666666">
	<?php
}
?>
<div style="background:#FFFFFF; width:740px; margin:0 auto; padding:30px; position:relative;">

<div style="margin-top:10px; height:70px; text-align:center;">
	
</div>

<table width="100%" border="0" cellpadding="1">
	<tr>
		<td colspan="5" width="100%" height="20"></td>
	</tr>
	<tr>
		<td width="24%">NAMA</td>
		<td colspan="4">: <?php echo $pemesanan->nama_lengkap; ?></td>
	</tr>
	<tr>
		<td>ALAMAT KTP</td>
		<td colspan="4">: <?php echo $pemesanan->alamat_ktp; ?></td>
	</tr>
	<tr>
		<td>ALAMAT SURAT MENYURAT</td>
		<td colspan="4">: <?php echo $pemesanan->alamat_surat_menyurat; ?></td>
	</tr>
	<tr>
		<td>PEKERJAAN</td>
		<td colspan="4">: </td>
	</tr>
	<tr>
		<td>TELP. RUMAH</td>
		<td width="21%">: <?php echo $pemesanan->telpon; ?></td>
		<td width="28%" colspan="2">TELP.KANTOR :</td>
		<td width="25%">HP : <?php echo $pemesanan->hp; ?></td>
	</tr>
	<tr>
		<td>TIPE RUMAH</td>
		<td colspan="4">: <?php echo $data_unit->nama_type." ".$data_unit->posisi; ?></td>
	</tr>
	<tr>
		<td>KAV. BLOK / NO.</td>
		<td colspan="2">: <?php echo $data_unit->kode_unit; ?></td>
		<td colspan="2">SEKTOR : <?php echo $pemesanan->nama_cluster; ?></td>
	</tr>
	<tr>
		<td>NILAI RESERVED</td>
		<td colspan="4">: Rp. <?php echo number_format($pemesanan->booking_fee, 0); ?></td>
	</tr>
	<tr>
		<td>TANGGAL RESERVED DARI</td>
		<td colspan="2">: <?php echo ubah_format_tanggal($pemesanan->tanggal_pemesanan, "H:i:s"); ?></td>
		<td colspan="2">S/D. 
			
			<?php 
			echo exp_order($pemesanan->timeout, $pemesanan->tanggal_pemesanan);
			?> 
			
		</td>
	</tr>
	<tr>
		<td colspan="5" width="100%" height="10px"></td>
	</tr>
	<tr>
		<td colspan="5">
			<strong>Keterangan :</strong>
			<ul style="font-size: 13px; text-align:justify; text-justify:inter-word;">
				<li>
					Reserved berlaku sesuai jangka waktu di atas dan apabila sampai dengan jangka waktu tersebut belum ada pembayaran tanda jadi dari pemesan yang
					besarnya sesuai ketentuan PT. Jaya Real Property, Tbk, maka pemesan setuju bahwa reserved tersebut menjadi batal dan PT. Jaya Real Property, Tbk,
					berhak mengalihkan obyek reserved kepada pihak lain.
				</li>
				<li>
					Pemesan setuju bahwa apabila reserved menjadi batal atau dibatalkan oleh pemesan, maka uang reserved menjadi hangus/tidak dikembalikan oleh
					PT. Jaya Real Property, Tbk.
				</li>
				<li>
					Reserved ini berlaku apabila disertai dengan bukti tanda terima uang Reserved yang sah dari PT. Jaya Real Property, Tbk.
				</li>
			</ul>
		</td>
	</tr>
	<tr>
		<td colspan="5" width="100%" height="20px"></td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<table width="100%" border="0">
				<tr>
					<td width="31%" align="center"><p>Sales Coordinator</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>( <?php echo $pemesanan->nama_sales; ?> )</p>
					</td>
					<td width="39%" align="center"><p>Sales Manager</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>( <?php echo $pemesanan->sales_manager; ?> )</p>
					</td>
					<td width="30%" align="center"><p>Pemesan :</p>
						<p>&nbsp;</p>
						<p>&nbsp;</p>
						<p>( <?php echo $pemesanan->nama_lengkap; ?> )</p>
					</td>
				</tr>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="5" align="center">&nbsp;</td>
	</tr>
	<tr>
		<td colspan="5" align="center">
			<strong style="font-size:16px">PT. JAYA REAL PROPERTY, Tbk.</strong><br />
			<strong>Kantor Unit Graha Raya</strong>, Blok A1 No. 1<br />
			Jl. Bulevar Raya - Graha Raya Tangerang 15324<br />
			Telp. (62-21) 5312 3000, Fax. (62-21) 6212 4000<br />
			Website : www.graharaya.co.id
		</td>
	</tr>
	<tr>
		<td colspan="5" align="center" bgcolor="#980E0E" style="padding:10px -30px;">&nbsp;</td>
	</tr>
</table>

</div>
</body>
</html>