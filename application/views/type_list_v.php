<div class="margin_center" style="width:1000px">	
	<div class="header_data">Data Type</div>
	<div class="tombol_tambah">
		<a href="<?php echo base_url(); ?>cluster/edit/<?php echo $id_cluster; ?>">
			<input type="button" value="&laquo; Data Cluster">
		</a>
		
		<a href="<?php echo base_url(); ?>siteplan/index/<?php echo $id_cluster; ?>">
			<input type="button" value="Data Siteplan &raquo;">
		</a>
	</div>
	
	<div class="clear"></div>
	
	<div class="frame_tabel radius" style="margin-bottom:10px;">
		<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Cluster</strong></div></td>
				<td width="450px"><div class="isi_tabel"><strong><?php echo $nama_cluster; ?></strong></div></td>
			</tr>
		</table>
	</div>
	
	<div class="frame_tabel radius transparent">
		<div style="margin: 3px;">
			<a href="<?php echo base_url(); ?>type/add/<?php echo $id_cluster; ?>">
				<input type="button" value="Tambah Data &#43;">
			</a>
		</div>
		
		<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="600px"><div class="header_tabel">Type</div></td>
				<td width="300px"><div class="header_tabel">Blok</div></td>
				<td colspan="4"><div class="header_tabel">&nbsp;</div></td>
			</tr>
			
			<?php
			foreach($type as $data_type)
			{
				?>
				<tr id="<?php echo $data_type->id_type; ?>" class="hover">
					<td><div class="isi_tabel"> <?php echo $data_type->nama_type; ?> </div></td>
					<td><div class="isi_tabel" align="center"> <?php echo $data_type->kode_blok; ?> </div></td>
					<td align="center">
						<a href="" title="Detail" onClick="javascript:detail(<?php echo $data_type->id_type; ?>); return false;">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/view.png">
							</div>
						</a>
					</td>
					
					<td align="center">
						<a href="<?php echo base_url(); ?>type/edit/<?php echo $data_type->id_type; ?>" title="Ubah">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</div>
						</a>
					</td>
					
					<td align="center">
						<a href="<?php echo base_url(); ?>type/form_gallery/<?php echo $data_type->id_type; ?>" title="Image">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/type.png">
							</div>
						</a>
					</td>
					
					<td align="center">
						<a href="" title="Hapus" onClick="javascript:hapus(<?php echo $data_type->id_type; ?>); return false;">
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
		
		<div style="margin: 3px;">
			<a href="<?php echo base_url(); ?>cluster"><input type="button" value="Selesai &#10003;"></a>
		</div>
		
	</div>
	
	<div class="clear"></div>
	
</div>