<div class="margin_center" style="width:1000px">	
	<div class="header_data">Data Cluster</div>
	
	<div class="tombol_tambah">
		<?php
		if ($this->access_lib->_if("adm,stk"))
		{
			?>
			<a href="<?php echo base_url(); ?>cluster/add"><input type="button" value="Tambah Data &#43;"></a>
			<?php
		}
		?>
	</div>
	
	<div class="frame_tabel radius transparent" style="margin-bottom: 3px;">
		<table cellspacing="1px" cellpadding="1px">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#0066FF" class="header_tabel_cari" style="height: 100%;"> Nama Cluster </td>
				<td class="isi_tabel">
					<input type="text" name="nama_cluster" id="nama_cluster" size="60" value="<?php echo $nama_cluster; ?>">
				</td>
				<td class="isi_tabel" >
					<a href="" onClick="javascript:list_data(<?php echo $posisi; ?>, ''); return false;"><input type="button" value="Cari"></a>
					<a href="" onClick="javascript:list_data(0, 'all'); return false;"><input type="button" value="Tampilkan Semua"></a>
				</td>
			</tr>
		</table>			
	</div>
	
	<div class="clear"></div>
	
	<div class="frame_tabel radius transparent">
		<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="800px" class="header_tabel"> Nama Cluster </td>
				<td width="100px" class="header_tabel"> Kode Cluster </td>
				<td colspan="5" class="header_tabel">&nbsp;</td>
			</tr>
			
			<?php
			foreach($cluster as $data_cluster)
			{
				?>
				<tr id="<?php echo $data_cluster->id_cluster; ?>" class="hover">
					<td class="isi_tabel"> <?php echo $data_cluster->nama_cluster; ?> </td>
					<td class="isi_tabel center"> <?php echo $data_cluster->kode_cluster; ?> </td>
					<td class="isi_tabel center">
						<a href="" onClick="javascript:detail(<?php echo $data_cluster->id_cluster.",".$posisi.",".$key; ?>); return false;" title="Detail">
							<img src="<?php echo base_url(); ?>files/images/view.png">
						</a>
					</td>
					
					<?php
					if ($this->access_lib->_if("adm,stk"))
					{
						?>
						<td class="isi_tabel center">
							<a href="<?php echo base_url(); ?>cluster/edit/<?php echo $data_cluster->id_cluster; ?>" title="Ubah">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</a>
						</td>
						
						<td class="isi_tabel center">
							<a href="<?php echo base_url(); ?>type/index/<?php echo $data_cluster->id_cluster; ?>" title="Type">
								<img src="<?php echo base_url(); ?>files/images/type.png">
							</a>
						</td>
						
						<td class="isi_tabel center">
							<a href="<?php echo base_url(); ?>siteplan/index/<?php echo $data_cluster->id_cluster; ?>" title="Siteplan">
								<img src="<?php echo base_url(); ?>files/images/siteplan.png">
							</a>
						</td>
						
						<td class="isi_tabel center">
							<a href="" onClick="javascript:hapus(<?php echo $data_cluster->id_cluster; ?>); return false;" title="Hapus">
								<img src="<?php echo base_url(); ?>files/images/delete.png">
							</a>
						</td>
						<?php
					}
					?>
				</tr>
				<?php
			}
			?>
			
		</table>
	</div>
	
	<div class="clear"></div>
	
	<div id="frame_pagging" class="shadow radius">
	
		<?php
		if($next < $total_cluster){
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
			Data ke <?php if($posisi == 0 AND count($cluster) == 0){ echo "0"; }else if(count($cluster) > 0){ echo $posisi+1; } ?> 
			sampai <?php echo count($cluster)+$posisi; ?>
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
	
		<div class="info_data">Total <?php echo $total_cluster; ?> Data</div>
	</div>
</div>