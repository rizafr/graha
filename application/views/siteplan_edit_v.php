<script type="text/javascript">

function validasi()
{
	var nama_siteplan = $('#nama_siteplan').val();
	
	if(nama_siteplan == "")
	{
		alert("Nama siteplan harus diisi.");
		$('#nama_siteplan').focus();
		return false;
	}
	else
	{
		return true;
	}
}

</script>
	<div class="margin_left" style="width:1000px">		
		<div class="header_data">Ubah Data Siteplan</div>
		<div class="tombol_tambah">
			<a href="" onClick="javascript:list_data(<?php echo $data_siteplan->id_cluster; ?>); return false;">
				<input type="button" value="&laquo; Kembali">
			</a>
		</div>
		
		<div class="frame_tabel radius" style="margin-bottom:10px;">
			<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Cluster</strong></div></td>
					<td width="450px"><div class="isi_tabel"><strong><?php echo $data_siteplan->nama_cluster; ?></strong></div></td>
				</tr>
			</table>
		</div>
		
		<div class="frame_tabel radius transparent">
			<form name="form_add" id="form_add" enctype="multipart/form-data" method="post" action="<?php echo $action;?>" onSubmit="return validasi();">
			<table width="450px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="120px" bgcolor="#999999"><div class="isi_tabel"><b>Nama Siteplan<span class="required_star">*</span></b></div></td>
					<td width="330px">
						<div class="isi_tabel">
							<input name="nama_siteplan" type="text" id="nama_siteplan" size="57" value="<?php echo $data_siteplan->nama_siteplan; ?>">
						</div>
					</td>
				</tr>				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Gambar<span class="required_star">*</span></b></div></td>
					<td><div class="isi_tabel">
						<input type="file" name="gambar_siteplan" id="gambar_siteplan" size="35">
					</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Status Aktif</b></div></td>
					<td><div class="isi_tabel">
						<?php
						$ceky = '';
						$cekt = 'checked="checked"';
						if($data_siteplan->status == "Aktif"){$ceky = 'checked="checked"';$cekt = '';}
						?>
						<input type="radio" name="status" value="Aktif" <?php echo $ceky; ?>> Ya <input type="radio" name="status" value="Tidak Aktif" <?php echo $cekt; ?>> Tidak
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
		
		<div style="width:540px;float:right;">
			<style type="text/css">
			.siteplan_edit {
				display: block;
				max-width:530px;
				margin:0 auto 15px;
			}
			</style>
			<img src="<?php echo base_url().'files/siteplan/'.$data_siteplan->image ;?>?clear=<?php echo mt_rand(1,100) ;?>"
				alt="<?php echo $data_siteplan->image ;?>"
				class="siteplan_edit"
				title="<?php echo $data_siteplan->image ;?>" />
		</div>
		<div class="clear"></div>
	</div>
