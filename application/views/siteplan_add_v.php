<script type="text/javascript">

function validasi()
{
	var gambar_siteplan	= $('#gambar_siteplan').val();
	var nama_siteplan = $('#nama_siteplan').val();
	
	if(nama_siteplan == "")
	{
		alert("Nama siteplan harus diisi.");
		$('#nama_siteplan').focus();
		return false;
	}
	else if(gambar_siteplan == "")
	{
		alert("Pilih gambar.");
		$('#gambar_siteplan').focus();
		return false;
	}
	else
	{
		return true;
	}
}

</script>
	<div class="margin_left" style="width:600px">		
		<div class="header_data">Tambah Data Siteplan</div>
		<div class="tombol_tambah">
			<a href="" onClick="javascript:list_data(<?php echo $id_cluster; ?>); return false;">
				<input type="button" value="&laquo; Kembali">
			</a>
		</div>
		
		<div class="frame_tabel radius" style="margin-bottom:10px;">
			<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Cluster</strong></div></td>
					<td width="450px"><div class="isi_tabel"><strong><?php echo $nama_cluster; ?></strong></div></td>
				</tr>
			</table>
		</div>
		
		<div class="frame_tabel radius transparent">
			<form name="form_add" id="form_add" enctype="multipart/form-data" method="post" action="<?php echo $action;?>" onSubmit="return validasi();">
			<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="120px" bgcolor="#999999"><div class="isi_tabel"><b>Nama Siteplan<span class="required_star">*</span></b></div></td>
					<td width="480px">
						<div class="isi_tabel">
							<input name="nama_siteplan" type="text" id="nama_siteplan" size="71" value="<?php echo set_value('nama_siteplan'); ?>">
						</div>
					</td>
				</tr>			
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Gambar<span class="required_star">*</span></b></div></td>
					<td><div class="isi_tabel">
						<input type="file" name="gambar_siteplan" id="gambar_siteplan" size="60">
					</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Status Aktif</b></div></td>
					<td><div class="isi_tabel">
						<input type="radio" name="status" value="Aktif"> Ya <input type="radio" name="status" value="Tidak Aktif" checked="true"> Tidak
					</div></td>
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
	</div>