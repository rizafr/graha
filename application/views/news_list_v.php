<?php include "format_tanggal.php"; ?>

<div class="margin_center" style="width:1000px;">	
	<div class="header_data">Hello Welcome</div>
	<div class="tombol_tambah">
		<a href="<?php echo base_url(); ?>home/add"><input type="button" value="Tambah Data &#43;"></a>
	</div>
	<div class="frame_tabel radius transparent">
		<table width="1000px">
			<thead>
				<th class="header_tabel_cust"> Title </th>
				<th class="header_tabel_cust" width="100px"> Status </th>
				<th  class="header_tabel_cust" colspan="3">Action</th>
			</tr>
			</thead>
			<tbody>
			<?php
			foreach($news as $data_news)
			{
			?>
			
				<tr id="<?php echo $data_news->id_news;?>" class="hover">
					<td class="isi_tabel">
						<?php echo $data_news->judul; ?>
					</td>
					
					<td class="isi_tabel center">
						<?php
						if($data_news->status == "Aktif")
						{
							echo "<font color='green'>".$data_news->status."</font>"; 
						}
						else if($data_news->status == "Tidak Aktif")
						{
							echo "<font color='red'>".$data_news->status."</font>"; 
						}
						?>
					</td>
					
					<td class="isi_tabel center">
						<a href="javascript:void(0);" title="Tampilkan" onClick="javascript:detail(<?php echo $posisi.",".$data_news->id_news; ?>); return false;">
							<img src="<?php echo base_url(); ?>files/images/view.png">
						</a>
					</td>
					
					<?php
					if ($data_news->id_user == $this->session->userdata('id_user') OR $this->session->userdata('level') == "Administrator")
					{
						?>
						<td class="isi_tabel center">
							<a href="<?php echo base_url()."home/edit/".$posisi."/".$data_news->id_news; ?>" title="Ubah">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</a>
						</td>
						
						<td class="isi_tabel center">
							<a href="javascript:void(0);" title="Hapus" onClick="javascript:hapus(<?php echo $data_news->id_news; ?>); return false;">
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
			</tbody>
		</table>
	</div>
	
	<div class="clear"></div>
	
	<div id="frame_pagging" class="shadow radius">
	
		<?php
		if($next < $total_news){
		?>
		
		<a href="" onClick="javascript:list_data(<?php echo $akhir; ?>); return false;">
			<div id="tombol_navigasi">Terakhir</div>
		</a>
		<a href="" onClick="javascript:list_data(<?php echo $next; ?>); return false;">
			<div id="tombol_navigasi">Berikutnya</div>
		</a>
		
		<?php
		}
		?>
		
		<div class="data_nav">
			Data ke <?php if($posisi == 0 AND count($news) == 0){ echo "0"; }else if(count($news) > 0){ echo $posisi+1; } ?> 
			sampai <?php echo count($news)+$posisi; ?>
		</div>
		
		<?php
		if($prev >= 0){
		?>
		
		<a href="" onClick="javascript:list_data(<?php echo $prev; ?>); return false;">
			<div id="tombol_navigasi">Sebelumnya</div>
		</a>
		<a href="" onClick="javascript:list_data(0); return false;">
			<div id="tombol_navigasi">Pertama</div>
		</a>
		
		<?php
		}
		?>
	
		<div class="info_data">Total <?php echo $total_news; ?> Data</div>
	</div>
</div>
