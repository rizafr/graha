	<div class="margin_center" style="width:1000px">	
		<div class="header_data">Data Siteplan</div>
		<div class="tombol_tambah">
			<a href="<?php echo base_url(); ?>type/index/<?php echo $id_cluster; ?>">
				<input type="button" value="&laquo; Data Type">
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
				<a href="" onClick="javascript:add(<?php echo $id_cluster; ?>); return false;">
					<input type="button" value="Tambah Data &#43;">
				</a>
			</div>
			
			<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="820px"><div class="header_tabel">Siteplan</div></td>
					<td width="150px"><div class="header_tabel">Status</div></td>
					<td colspan="3"><div class="header_tabel">&nbsp;</div></td>
				</tr>
				
				<?php
				foreach($siteplan as $data_siteplan)
				{
					?>
					<tr id="<?php echo $data_siteplan->id_siteplan; ?>" class="hover">
						<td><div class="isi_tabel"> <?php echo $data_siteplan->nama_siteplan; ?> </div></td>
						<td align="center">
							<div class="isi_tabel">
								<?php
								switch($data_siteplan->status)
								{
								case "Aktif":
									echo "<font color='green'>Aktif</font>";
									break;
								case "Tidak Aktif":
									echo "<font color='red'>Tidak Aktif</font>";
									break;
								default:
									echo "Hubungi Administrator !";
								} 
								?>
							</div>
						</td>
						
						<td align="center">
							<a href="" onClick="javascript:detail(<?php echo $data_siteplan->id_siteplan; ?>); return false;" title="Detail">
								<div class="isi_tabel">
									<img src="<?php echo base_url(); ?>files/images/view.png">
								</div>
							</a>
						</td>
						
						<td align="center">
							<a href="" onClick="javascript:edit(<?php echo $data_siteplan->id_siteplan; ?>); return false;" title="Edit">
								<div class="isi_tabel">
									<img src="<?php echo base_url(); ?>files/images/update.png">
								</div>
							</a>
						</td>
						
						<td align="center">
							<a href="" onClick="javascript:hapus(<?php echo $data_siteplan->id_siteplan; ?>); return false;" title="Hapus">
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
				<a href="<?php echo base_url(); ?>cluster">
					<input type="button" value="Selesai &#10003;">
				</a>
			</div>
		</div>
		
		<div class="clear"></div>
		
	</div>