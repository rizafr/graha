<div class="margin_center" style="width:1000px">	
	<div class="header_data">Data User</div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:add(<?php echo $posisi.",".$key; ?>); return false;"><input type="button" value="Tambah Data &#43;"></a>
	</div>
	<div class="frame_tabel radius transparent" style="margin-bottom: 3px;">
		<table cellspacing="1px" cellpadding="1px">
			<tr bgcolor="#FFFFFF">
				<td width="80px" bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Nama</div></td>
				<td>
					<div class="isi_tabel">
						<input type="text" name="s_nama_lengkap" id="s_nama_lengkap" size="60" value="<?php echo $s_nama_lengkap; ?>">
					</div>
				</td>
				<td>
					<div class="isi_tabel" style="margin-right:2px;">
						<a href="" onClick="javascript:list_data(<?php echo $posisi; ?>, ''); return false;">
							<input type="button" value="Cari">
						</a>
						<a href="" onClick="javascript:list_data(0, 'all'); return false;">
							<input type="button" value="Tampilkan Semua">
						</a>
					</div>
				</td>
			</tr>
		</table>			
	</div>
	<div class="frame_tabel radius transparent">
		<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#0066FF">
				<td rowspan="2"><div class="header_tabel"> Nama Lengkap </div></td>
				<td rowspan="2"><div class="header_tabel"> HP </div></td>
				<td rowspan="2"><div class="header_tabel"> Username </div></td>
				<td width="90px" rowspan="2"><div class="header_tabel"> Level </div></td>
				<td colspan="2"><div class="header_tabel"> Sales </div></td>
				<td width="130px" rowspan="2"><div class="header_tabel"> Status Transaksi </div></td>
				<td width="50px" rowspan="2" colspan="3"><div class="header_tabel">&nbsp;</div></td>
			</tr>
			
			<tr bgcolor="#0066FF">
				<td><div class="header_tabel"> Team </div></td>
				<td><div class="header_tabel"> Manager </div></td>
			</tr>
			
			<?php
			foreach($user as $data_user)
			{
				?>
				<tr id="<?php echo $data_user->id_user; ?>" class="hover">
					<td><div class="isi_tabel"> <?php echo $data_user->nama_lengkap; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_user->hp; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_user->username; ?> </div></td>
					<td align="center"><div class="isi_tabel"> <?php echo $data_user->level; ?> </div></td>
					<td align="center" <?php if($data_user->id_user == $data_user->id_sm){echo 'style="background:#EDD1D2;"';} ?>><div class="isi_tabel"> <?php echo $data_user->team; ?> </div></td>
					<td <?php if($data_user->id_user == $data_user->id_sm){echo 'style="background:#EDD1D2;"';} ?>><div class="isi_tabel"> <?php echo $data_user->sales_manager; ?> </div></td>
					<td align="center">
						<div class="isi_tabel"> 
							<?php
							switch($data_user->status_transaksi)
							{
							case "1":
								echo "<font color='green'>Aktif</font>";
								break;
							case "2":
								echo "<font color='red'>Tidak Aktif</font>";
								break;
							case "3":
								echo "<font color='#000000'>Banned</font>";
								break;
							default:
								echo "Hubungi Administrator !";
							} 
							?>
						</div>
					</td>

					<td align="center">
						<a href="" title="Detail" onClick="javascript:detail(<?php echo $data_user->id_user.",".$posisi.",".$key; ?>); return false;">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/view.png">
							</div>
						</a>
					</td>
					
					<td align="center">
						<a href="" title="Ubah" onClick="javascript:edit(<?php echo $data_user->id_user.", ".$posisi.",".$key; ?>); return false;">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</div>
						</a>
					</td>
						
					<td align="center">
						<a href="" title="Hapus" onClick="javascript:hapus(<?php echo $data_user->id_user; ?>); return false;">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/delete.png">
							</div>
						</a>
					</td>
					
				</tr>
				<?php
			}
			?>
			
		</table>
	</div>
	
	<div class="clear"></div>
	
	<div id="frame_pagging" class="shadow radius">
	
		<?php
		if($next < $total_user){
		?>
		
		<a href="" onClick="javascript:list_data(<?php echo $akhir.",".$key; ?>); return false;">
			<div id="tombol_navigasi">Terakhir</div>
		</a>
		<a href="" onClick="javascript:list_data(<?php echo $next.",".$key; ?>); return false;">
			<div id="tombol_navigasi">Berikutnya</div>
		</a>
		
		<?php
		}
		?>
		
		<div class="data_nav">
			Data ke <?php if($posisi == 0 AND count($user) == 0){ echo "0"; }else if(count($user) > 0){ echo $posisi+1; } ?> 
			sampai <?php echo count($user)+$posisi; ?>
		</div>
		
		<?php
		if($prev >= 0){
		?>
		
		<a href="" onClick="javascript:list_data(<?php echo $prev.",".$key; ?>); return false;">
			<div id="tombol_navigasi">Sebelumnya</div>
		</a>
		<a href="" onClick="javascript:list_data(0, <?php echo $key; ?>); return false;">
			<div id="tombol_navigasi">Pertama</div>
		</a>
		
		<?php
		}
		?>
	
		<div class="info_data">Total <?php echo $total_user; ?> Data</div>
	</div>
</div>

<div class="clear" style="height:40px;"></div>
