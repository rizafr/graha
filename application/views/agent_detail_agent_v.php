<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
	<tr bgcolor="#FFFFFF">
		<td width="150px" bgcolor="#999999"><div class="header_tabel_cust">Team</div></td>
		<td width="450px"><div class="isi_tabel"><?php echo $data_agent->team; ?></div></td>
	</tr>	
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#999999"><div class="header_tabel_cust">Nama Lengkap</div></td>
		<td><div class="isi_tabel"><?php echo $data_agent->sales_manager; ?></div></td>
	</tr>			
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#999999"><div class="header_tabel_cust">Email</div></td>
		<td><div class="isi_tabel"><?php echo $data_agent->email; ?></div></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#999999"><div class="header_tabel_cust">HP</div></td>
		<td><div class="isi_tabel"><?php echo $data_agent->hp; ?></div></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#999999"><div class="header_tabel_cust">Username</div></td>
		<td><div class="isi_tabel"><?php echo $data_agent->username; ?></div></td>
	</tr>
	<tr bgcolor="#FFFFFF">
		<td bgcolor="#999999"><div class="header_tabel_cust">Status Transaksi</div></td>
		<td><div class="isi_tabel">
			<?php
			switch($data_agent->status_transaksi)
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
</table>
