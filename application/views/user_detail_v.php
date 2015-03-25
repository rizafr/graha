<?php include "fungsi_tanggal.php"; ?>

<div class="margin_left" style="width:600px">		
	<div class="header_data">Data User Detail</div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:edit(<?php echo $user->id_user.", ".$posisi.",".$key; ?>); return false;"><input type="button" value="Ubah"></a>
		<a href="" onClick="javascript:list_data(<?php echo $posisi.",".$key; ?>); return false;"><input type="button" value="&laquo; Kembali"></a>
	</div>
	<div class="frame_tabel radius transparent">
		<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="isi_tabel"><strong>Nama Lengkap</strong></div></td>
				<td width="450px"><div class="isi_tabel"><?php echo $user->nama_lengkap; ?></div></td>
			</tr>	
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Tempat Tanggal Lahir</strong></div></td>
				<td><div class="isi_tabel"><?php echo $user->tempat_lahir.", "; ubah_format_tanggal($user->tanggal_lahir); ?></div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>eMail</strong></div></td>
				<td><div class="isi_tabel"><?php echo $user->email; ?></div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Telepon</strong></div></td>
				<td><div class="isi_tabel"><?php echo $user->telepon; ?></div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>HP</strong></div></td>
				<td><div class="isi_tabel"><?php echo $user->hp; ?></div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Alamat</strong></div></td>
				<td><div class="isi_tabel"><?php echo $user->alamat; ?></div></td>
			</tr>
			<?php
			if($user->level == "Sales")
			{
			?>
				<tr bgcolor="#FFFFFF">
					<td valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Team Sales</strong></div></td>
					<td><div class="isi_tabel"><?php echo $user->team; ?></div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Sales Manager</strong></div></td>
					<td><div class="isi_tabel"><?php echo $user->sales_manager; ?></div></td>
				</tr>
			<?php
			}
			?>
			<tr bgcolor="#FFFFFF">
				<td colspan="2"><div class="header_tabel">Akun Login</div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Level</strong></div></td>
				<td><div class="isi_tabel"><?php echo $user->level; ?></div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Status transaksi</strong></div></td>
				<td><div class="isi_tabel">
					<?php
					switch($user->status_transaksi)
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
				</div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Username</strong></div></td>
				<td><div class="isi_tabel"><?php echo $user->username; ?></div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Password</strong></div></td>
				<td><div class="isi_tabel">**********</div></td>
			</tr>			
		</table>
	</div>
	
	<div class="clear"></div>
</div>
	
