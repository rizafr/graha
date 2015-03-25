	<div class="margin_left" style="width:550px;">	
	<div class="header_data">Tambah Data Team Sales</div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:list_data(); return false;">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="frame_tabel radius transparent">
		<form name="form" id="form" method="post" action="<?php echo $action;?>" onSubmit="return post(this);">
		<table width="550px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="isi_tabel"><b>Team<span class="required_star">*</span></b></div></td>
				<td width="350px">
					<div class="isi_tabel">
						<input name="team" type="text" id="team" size="50" value="<?php echo set_value('team'); ?>">
					</div>
				</td>
			</tr>	
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Sales Manager<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<select name="id_sm" id="id_sm">
							<option value="">-- Pilih Sales Manager --</option>
							<?php
							foreach($user AS $data_user)
							{
								?>
								<option value="<?php echo $data_user->id_user; ?>"> <?php echo $data_user->nama_lengkap; ?> </option>
								<?php
							}
							?>
						</select>
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