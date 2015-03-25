<?php echo $header; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>files/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>files/js/tinymce/jscripts/tiny_mce/tiny_mce_init.js"></script>

</head>
<body>

<?php
# Load profile
$this->load->view('top_profile_v');

# Load menu dashboard
$this->load->view('menu_v');
?>

<div id="frame_data">
	<div class="margin_center" style="width:1000px">		
		<div class="header_data">Tambah Data</div>
		<div class="tombol_tambah">
			<a href="<?php echo base_url()."home/index/".$posisi; ?>">
				<input type="button" value="&laquo; Kembali">
			</a>
		</div>
		
		<div class="clear"></div>
		
		<form name="form_add" id="form_add" enctype="multipart/form-data" method="post" action="<?php echo $action;?>">
		
		<div class="frame_tabel radius transparent">
			<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Judul<span class="required_star">*</span></b></div></td>
					<td>
						<div class="isi_tabel">
							<input name="judul" type="text" id="judul" size="110" value="<?php echo set_value('judul'); ?>">
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Gambar <i>700*500 (px)</i></b></div></td>
					<td>
						<div class="isi_tabel" id="sample">
							<input type="file" name="image" id="image" size="100">
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" valign="top"><div class="isi_tabel"><b>Deskripsi</b></div></td>
					<td>
						<div class="isi_tabel" id="sample">
							<textarea name="deskripsi" id="deskripsi" cols="150" rows="20"><?php echo set_value('deskripsi'); ?></textarea>
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Status</b></div></td>
					<td>
						<div class="isi_tabel">
							<select name="status" id="status">
								<option value="Aktif">Aktif</option>
								<option value="Tidak Aktif">Tidak Aktif</option>
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
		</div>
		</form>
		<div class="clear"></div>
	</div>
	<br />
</div>

</body>
</html>