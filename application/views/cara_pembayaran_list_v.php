<div class="margin_center" style="width:1000px">
	<div class="header_data">Data Cara Pembayaran</div>	
	<div class="tombol_tambah" style="margin-right:500px;">
		<a href="" onClick="javascript:add(); return false;"><input type="button" value="Tambah Data &#43;"></a>
	</div>
	<div class="clear"></div>
	<div class="frame_tabel radius transparent">
		<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#0066FF" width="470px"><div class="header_tabel">Cara Pembayaran</div></td>			
				<td bgcolor="#0066FF" colspan="2"><div class="header_tabel">&nbsp;</div></td>
			</tr>
			
			<?php
			foreach($cara_pembayaran as $data_cara_pembayaran)
			{
				?>
				<tr id="<?php echo $data_cara_pembayaran->id_cara_pembayaran; ?>" class="hover">
					<td><div class="isi_tabel"> <?php echo $data_cara_pembayaran->cara_pembayaran; ?>x </div></td>
					
					<td align="center">
						<a href="" onClick="javascript:edit(<?php echo $data_cara_pembayaran->id_cara_pembayaran; ?>); return false;" title="Ubah">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</div>
						</a>
					</td>
					
					<td align="center">
						<a href="" onClick="javascript:hapus(<?php echo $data_cara_pembayaran->id_cara_pembayaran; ?>); return false;" title="Hapus">
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