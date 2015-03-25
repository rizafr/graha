<div class="margin_center" style="width:1000px">	
	<div class="header_data">Cluster</div>
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
		<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="cursor:pointer;">
			<tr bgcolor="#FFFFFF">
				<td width="1000px" class="header_tabel"> Nama Cluster </td>
			</tr>
			
			<?php
			foreach($cluster as $data_cluster)
			{
				?>
				<tr id="<?php echo $data_cluster->id_cluster; ?>" onClick="javascript:detail(<?php echo $data_cluster->id_cluster.",".$posisi.",".$key; ?>); return false;" class="hover">
					<td class="isi_tabel" style="height:20px;"> <?php echo $data_cluster->nama_cluster; ?> </td>
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