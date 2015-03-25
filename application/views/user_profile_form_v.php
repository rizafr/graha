<div class="margin_left" style="width:600px">	
	<div class="header_data">Update Profile</div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:profile_detail(); return false;">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="frame_tabel radius transparent">
		<form name="form" id="form" method="post" action="<?php echo $action;?>" onSubmit="return post(this);">
		<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="200px" bgcolor="#999999"><div class="isi_tabel"><b>Nama Lengkap<span class="required_star">*</span></b></div></td>
				<td width="400px">
					<div class="isi_tabel">
						<input name="nama_lengkap" type="text" id="nama_lengkap" size="50" value="<?php echo $nama_lengkap; ?>">
					</div>
				</td>
			</tr>	
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Tempat Lahir<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<input name="tempat_lahir" type="text" id="tempat_lahir" size="50" value="<?php echo $tempat_lahir; ?>">
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Tanggal lahir<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<select name="tanggal_lahir" id="tanggal_lahir">
							<option value="">Tanggal</option>
													
							<?php
							for($i=1; $i<=31; $i++)
							{
								if($i == $tanggal_lahir)
								{
							?>
							
							<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
							
							<?php
								}
								else
								{
							?>
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							<?	
								}
							}
							?>		
														
						</select>
						<select name="bulan_lahir" id="bulan_lahir">
							<option value="">Bulan</option>
							
							<?php
							$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
										   "Oktober", "November", "Desember");
							$bln_angka = 0;
							foreach($bulan as $data_bulan){
								$bln_angka++;
								if($bln_angka == $bulan_lahir){
							?>
							
							<option value="<?php echo $bln_angka?>" selected="selected"> <?php echo $data_bulan?> </option>
							
							<?php
								}
								else{
							?>
							
							<option value="<?php echo $bln_angka?>"> <?php echo $data_bulan?> </option>
							
							<?php
								}
							}
							?>
							
						</select>
						<select name="tahun_lahir" id="tahun_lahir">
							<option value="">Tahun</option>
							
							<?php
							for($i= date('Y'); $i > 1940; $i--){
								if($i == $tahun_lahir){
							?>
							
							<option value="<?php echo $i; ?>" selected="selected"><?php echo $i; ?></option>
							
							<?php
								}else{
							?>
							
							<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
							
							<?
								}
							}
							?>
							
						</select>
					</div>
				</td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>eMail<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<input type="text" name="email" id="email" size="50" value="<?php echo $email; ?>">
					</div>
				</td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Telepon</b></div></td>
				<td>
					<div class="isi_tabel">
						<input type="text" name="telepon" id="telepon" size="50" value="<?php echo $telepon; ?>">
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>HP<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<input type="text" name="hp" id="hp" size="50" value="<?php echo $hp; ?>">
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td valign="top" bgcolor="#999999"><div class="isi_tabel"><b>Alamat<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<textarea name="alamat" id="alamat" cols="50"><?php echo $alamat; ?></textarea>
					</div>
				</td>
			</tr>
			<?php
			if ($level == "Sales")
			{
				?>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Team Sales</strong></div></td>
					<td style="padding:4px;"><div class="isi_tabel"><?php echo $team; ?></div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Sales Manager</strong></div></td>
					<td style="padding:4px;"><div class="isi_tabel"><?php echo $sales_manager; ?></div></td>
				</tr>
				<?php
			}
			?>
			<tr bgcolor="#FFFFFF">
				<td colspan="2"><div class="header_tabel">Akun Login</div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Level</b></div></td>
				<td style="padding:4px;">
					<div class="isi_tabel"><?php echo $level?></div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Status Transaksi</b></div></td>
				<td style="padding:4px;">
					<div class="isi_tabel">
						<?php
							switch($status_transaksi)
							{
							case 1:
								echo '<font color="green">Aktif</font>';
								break;
							case 2:
								echo '<font color="red">Tidak Aktif</font>';
								break;
							case 3:
								echo '<font color="black">Banned</font>';
								break;
							default:
								echo '<font color="red">Hubungi Administrator !</font>';
							} 
						?>
					</div>
				</td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Username</b></div></td>
				<td style="padding:4px;">
					<div class="isi_tabel">
						<?php echo $username; ?>
					</div>
				</td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Password</b></div></td>
				<td>
					<div class="isi_tabel">
						<input type="password" name="password" id="password" size="50">
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Konfirmasi Password</b></div></td>
				<td><div class="isi_tabel"><input type="password" name="password_conf" id="password_conf" size="50"></div></td>
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
	
