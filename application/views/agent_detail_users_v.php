<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
	<tr bgcolor="#FFFFFF">
		<td width="200px"><div class="header_tabel">Nama Lengkap</div></td>
		<td width="200px"><div class="header_tabel">Email</div></td>
		<td width="150px"><div class="header_tabel">HP</div></td>
		<td width="150px"><div class="header_tabel">username</div></td>
		<td width="110px"><div class="header_tabel">Status Transaksi</div></td>
	</tr>
	
	<?php
	foreach($user as $data_user){
	?>
	
	<tr bgcolor="#FFFFFF">
		<td><div class="isi_tabel"> <?php echo $data_user->nama_lengkap; ?> </div></td>
		<td><div class="isi_tabel"> <?php echo $data_user->email; ?> </div></td>
		<td><div class="isi_tabel"> <?php echo $data_user->hp; ?> </div></td>
		<td><div class="isi_tabel"> <?php echo $data_user->username; ?> </div></td>
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
	</tr>
	
	<?php
	}
	?>
	
</table>
