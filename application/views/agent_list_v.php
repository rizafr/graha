<div class="margin_left" style="width:550px;">	
	<div class="header_data">Data Team Sales</div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:add(); return false;"><input type="button" value="Tambah Data &#43;"></a>
	</div>
	<div class="frame_tabel radius transparent">
		<table width="550px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="200px"><div class="header_tabel">Team</div></td>
				<td width="250px"><div class="header_tabel">Sales Manager</div></td>
				<td colspan="3"><div class="header_tabel">&nbsp;</div></td>
			</tr>
			
			<?php
			foreach($agent as $data_agent)
			{
				?>
				<tr id="<?php echo $data_agent->id_agent; ?>" class="hover">
					<td><div class="isi_tabel center"><?php echo $data_agent->team; ?></div></td>
					<td><div class="isi_tabel"><?php echo $data_agent->sales_manager; ?></div></td>
					<td align="center">
						<a href="" title="Detail" onClick="javascript:detail(<?php echo $data_agent->id_agent; ?>); return false;">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/view.png">
							</div>
						</a>
					</td>
					
					<td align="center">
						<a href="" title="Ubah" onClick="javascript:edit(<?php echo $data_agent->id_agent; ?>); return false;">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</div>
						</a>
					</td>
					<td align="center">
						<a href="" title="Hapus" onClick="javascript:hapus(<?php echo $data_agent->id_agent; ?>); return false;">
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