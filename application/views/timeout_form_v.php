	<?php include "fungsi_tanggal.php"; ?>
	<div class="margin_left" style="width:600px">		
		<div class="header_data"><?php echo $judul; ?></div>	
		<div class="tombol_tambah">
			<a href="" onClick="javascript:list_data(); return false;">
				<input type="button" value="&laquo; Kembali">
			</a>
		</div>
		<div class="frame_tabel radius transparent">
			<form name="form" id="form" method="post" action="<?php echo $action;?>" onSubmit="return post(this);">
			<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="200px" bgcolor="#999999"><div class="isi_tabel"><b>Status Pemesanan<span class="required_star">*</span></b></div></td>
					<td width="400px">
						<div class="isi_tabel">
							<select name="status_pemesanan" id="status_pemesanan">
								<option value=""> -- Pilih Status Pemesanan -- </option>
								
								<?php
								$list_status_pemesanan = array("Booking", "Tanda Jadi", "Locked (Siteplan)");
								foreach($list_status_pemesanan as $sp)
								{
									if($sp == $status_pemesanan)
									{
										?>
										<option value="<?php echo $sp; ?>" selected="selected""> <?php echo $sp; ?> </option>
										<?php
									}
									else
									{
										?>
										<option value="<?php echo $sp; ?>"> <?php echo $sp; ?> </option>
										<?php
									}
								}
								?>
							</select>
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="200px" bgcolor="#999999"><div class="isi_tabel"><b>Timeout<span class="required_star">*</span></b></div></td>
					<td width="400px">
						<div class="isi_tabel">
							<?php $dhm = dhm($timeout); ?>
							<input name="hari" type="text" id="hari" size="1" value="<?php echo $dhm['hari']; ?>" style="text-align:center;" onkeypress="return isNumberKey(event)"> Hari
							<input name="jam" type="text" id="jam" size="1" value="<?php echo $dhm['jam']; ?>" style="text-align:center;" onkeypress="return isNumberKey(event)"> Jam
							<input name="menit" type="text" id="menit" size="1" value="<?php echo $dhm['menit']; ?>" style="text-align:center;" onkeypress="return isNumberKey(event)"> Menit
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="200px" bgcolor="#999999"><div class="isi_tabel"><b>Status Timeout<span class="required_star">*</span></b></div></td>
					<td width="400px">
						<div class="isi_tabel">
							<select name="status" id="status">
								<option value=""> -- Pilih Status Timeout -- </option>
								<option value="1" <?php echo $status == "1" ? "Selected" : ""; ?>>Aktif</option>
								<option value="0" <?php echo $status == "0" ? "Selected" : ""; ?>>Tidak Aktif</option>
							</select>
						</div>
					</td>
				</tr>				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
					<td>
						<div class="isi_tabel">
							<input type="hidden" name="id_timeout" id="id_timeout" value="<?php echo $id_timeout; ?>">
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