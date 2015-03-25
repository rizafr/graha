<?php include "fungsi_tanggal.php"; ?>
<div class="margin_center" style="width:1000px">
	<div class="header_data">Data Timeout</div>
	<div class="tombol_tambah" style="margin-right:500px;">
		<a href="" onClick="javascript:add(); return false;"><input type="button" value="Tambah Data &#43;"></a>
	</div>
	<div class="clear"></div>
	<div class="frame_tabel radius transparent">
		<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px"><div class="header_tabel">Status Pemesanan</div></td>
				<td width="180px"><div class="header_tabel">Timeout</div></td>
				<td width="120px"><div class="header_tabel">Status</div></td>
				<td colspan="2"><div class="header_tabel">&nbsp;</div></td>
			</tr>
			
			<?php
			foreach($timeout as $data_timeout)
			{
				?>
				<tr id="<?php echo $data_timeout->id_timeout; ?>" class="hover">
					<td><div class="isi_tabel"> <?php echo $data_timeout->status_pemesanan; ?> </div></td>
					<td align="center">
						<div class="isi_tabel right"> 
							<?php echo dhm($data_timeout->timeout, 'dhm'); ?>
						</div>
					</td>
					
					<td align="center">
						<div class="isi_tabel"> 
							<?php 
							if($data_timeout->status == "1") 
							{
								echo "<font color='green'>Aktif</font>";
							}
							else if($data_timeout->status == "0")
							{
								echo "<font color='red'>Tidak Aktif</font>";
							}
							?> 
						</div>
					</td>
					
					<td align="center">
						<a href="" onClick="javascript:edit(<?php echo $data_timeout->id_timeout; ?>); return false;" title="Ubah">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</div>
						</a>
					</td>
					<td align="center">
						<a href="" onClick="javascript:hapus(<?php echo $data_timeout->id_timeout; ?>); return false;" title="Hapus">
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
</div>