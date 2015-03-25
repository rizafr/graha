<script type="text/javascript">
	$(document).ready(function() {

		$('#level').change(function(){
			var level = $(this).val();
			if(level == "Manager" || level == "Kasir" || level == "Stok")
			{
				$('#cek-level').hide();
			}
			else
			{
				$('#cek-level').show();
			}
		});
	});
	
	<?php
	if($level == "Manager" OR $level == "Kasir" OR $level == "Stok")
	{
		echo "$('#cek-level').hide();";
	}
	?>
	
</script>

<div class="margin_left" style="width:600px">		
	<div class="header_data"><?php echo $judul; ?></div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:list_data(<?php echo $posisi.",".$key; ?>); return false;">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="frame_tabel radius transparent">
		<form name="form" id="form" method="post" action="<?php echo $action;?>" onSubmit="return post(this, <?php echo $posisi.",".$key; ?>);">
		<input type="hidden" id="status_js" value="<?php echo $status; ?>">
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
							foreach($bulan as $data_bulan)
							{
								$bln_angka++;
								if($bln_angka == $bulan_lahir)
								{
									?>
									<option value="<?php echo $bln_angka?>" selected="selected"> <?php echo $data_bulan?> </option>
									<?php
								}
								else
								{
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
							for($i= date('Y'); $i > 1940; $i--)
							{
								if($i == $tahun_lahir)
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
				<td bgcolor="#999999"><div class="isi_tabel"><b>Telpon</b></div></td>
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
						<textarea name="alamat" id="alamat" cols="50" rows="3"><?php echo $alamat; ?></textarea>
					</div>
				</td>
			</tr>		
			<tr bgcolor="#FFFFFF" id="cek-level">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Team Sales<span class="required_star">*</span></b></div></td>
				<td><div class="isi_tabel">
					<select name="id_agent" id="id_agent">
	
							<option value="">Pilih Team Sales</option>
	
							<?php
							foreach($agent as $data_agent)
							{
								if($data_agent->id_agent == $id_agent)
								{
									?>
									<option value="<?php echo $data_agent->id_agent; ?>" selected> <?php echo $data_agent->team; ?> - <?php echo $data_agent->sales_manager; ?></option>
									<?php
								}
								else
								{
									?>
									<option value="<?php echo $data_agent->id_agent; ?>"> <?php echo $data_agent->team; ?> - <?php echo $data_agent->sales_manager; ?></option>
									<?php
								}
							}
							?>
	
					</select>
				</div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td colspan="2"><div class="header_tabel">Akun Login</div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Level<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<select name="level" id="level">
							<option value="">Level</option>
							
							<?php
							$akses = array("Manager", "Stok", "Kasir", "Sales");	
							foreach($akses as $data_akses)
							{
								if($data_akses == $level)
								{
									?>
									<option value="<?php echo $data_akses?>" selected="selected"> <?php echo $data_akses?> </option>
									<?php
								}
								else
								{
									?>
									<option value="<?php echo $data_akses?>"> <?php echo $data_akses?> </option>
									<?php
								}
							}
							?>
						</select>
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Status Transaksi<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<select name="status_transaksi" id="status_transaksi">
							<option value="">Status Transaksi</option>
							
							<?php
							$list_status_transaksi = array(
								"1" => "Aktif",
								"2" => "Tidak Aktif",
								"3" => "Banned");
							$sel = "";
							
							foreach($list_status_transaksi as $key => $val)
							{
								if($key == $status_transaksi)
								{
									$sel = 'selected="selected"';
								}
								
								echo '<option value="'.$key.'" '.$sel.'> '.$val.' </option>';
								
								$sel = "";
							}
							?>
						</select>
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Username<span class="required_star">*</span></b></div></td>
				<td>
					<div class="isi_tabel">
						<input type="text" name="username" id="username" size="50" value="<?php echo $username; ?>">
					</div>
				</td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Password<?php if($status == "add"){echo '<span class="required_star">*</span>';}?></b></div></td>
				<td>
					<div class="isi_tabel">
						<input type="password" name="password" id="password" size="50">
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><b>Konfimasi Password<?php if($status == "add"){echo '<span class="required_star">*</span>';}?></b></div></td>
				<td><div class="isi_tabel"><input type="password" name="password_conf" id="password_conf" size="50"></div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
				<td>
					<div class="isi_tabel">
						<input type="hidden" name="id_user" id="id_user" value="<?php echo $id_user; ?>">
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
	
