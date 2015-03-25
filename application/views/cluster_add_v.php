<?php echo $header; ?>

</head>
<body>

<?php
# Load profile
$this->load->view('top_profile_v');

# Load menu dashboard
$this->load->view('menu_v');
?>

<script type="text/javascript">
	
function validasi()
{
	var nama_cluster = $('#nama_cluster').val();
	var kode_cluster = $('#kode_cluster').val();
	
	if(nama_cluster == "")
	{
		alert("Nama cluster harus diisi !");
		$('#nama_cluster').focus();
		return false;
	}
	else if(kode_cluster == "")
	{
		alert("Kode cluster harus diisi !");
		$('#kode_cluster').focus();
		return false;
	}
	else
	{
		return true;
	}
}
	
</script>

<div id="frame_data">

<div class="margin_left" style="width:600px">		
	<div class="header_data">Tambah Data Cluster</div>
	<div class="tombol_tambah">
		<a href="<?php echo base_url(); ?>cluster">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="frame_tabel radius transparent">
		<form name="form_add" id="form_add" method="post" action="<?php echo $action; ?>" onSubmit="return validasi();">
		<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="200px" bgcolor="#999999"><div class="isi_tabel"><b>Nama Cluster<span class="required_star">*</span></b></div></td>
				<td width="400px">
					<div class="isi_tabel">
						<input type="text" name="nama_cluster" id="nama_cluster" size="70" value="<?php echo set_value('nama_cluster'); ?>">
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Kode Cluster<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<input type="text" name="kode_cluster" id="kode_cluster" size="10" value="<?php echo set_value('kode_cluster'); ?>">
					</div>
				</td>
			</tr>				
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
				<td>
					<div class="isi_tabel">
						<input type="submit" value="Simpan &#10003;">
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td colspan="2">
					<div class="isi_tabel"><span class="required_star">* Harus Diisi</span></div>
				</td>					
			</tr>			
		</table>
		</form>
	</div>
	
	<div class="clear"></div>
</div>

</div>

</body>
</html>