<script type="text/javascript">
	$(function() {
		$( "#datepicker1" ).datepicker();
	});
	
	$(function() {
		$( "#datepicker2" ).datepicker();
	});
</script>
<div class="margin_left" style="width:600px">	
	<div class="header_data"><?php echo $judul; ?></div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:list_data(<?php echo $posisi; ?>); return false;">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="frame_tabel radius transparent">
		<form id="form" name="form" method="post" action="<?php echo $action; ?>" onSubmit="return post(this, <?php echo $posisi; ?>);">
			<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="150px" bgcolor="#999999"><div class="isi_tabel"><strong>Nama Promo<span class="required_star">*</span></strong></div></td>
					<td width="450px">
						<div class="isi_tabel">
							<input type="text" name="nama_promo" id="nama_promo" size="40" value="<?php echo $nama_promo; ?>">
						</div>
					</td>
				</tr>	
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Mulai<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="datepicker1" id="datepicker1" value="<?php echo $datepicker1; ?>">
						</div>
					</td>
				</tr>			
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Akhir<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="datepicker2" id="datepicker2" value="<?php echo $datepicker2; ?>">
						</div>
					</td>
				</tr>			
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Status<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<select name="status" id="status">
								<option value="">Pilih Status Promo</option>
								<option value="1" <?php if($status_promo == "1"){ echo "selected"; }?>>Aktif</option>
								<option value="0" <?php if($status_promo == "0"){ echo "selected"; }?>>Tidak Aktif</option>
							</select>
						</div>
					</td>
				</tr>			
				<tr bgcolor="#FFFFFF">
					<td valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Deskripsi<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<textarea name="deskripsi" id="deskripsi" cols="50" rows="5"><?php echo $deskripsi; ?></textarea>
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td valign="top" bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
					<td>
						<div class="isi_tabel">
							<input type="hidden" name="id_promo" id="id_promo" value="<?php echo $id_promo; ?>">
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