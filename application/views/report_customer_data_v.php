<div class="margin_center" style="width:1000px;">	
	<div class="header_data">Report Data Customer</div>	
	<div class="tombol_tambah">
			<a href="<?php echo base_url(); ?>report/customer_form_data/add/0">
				<input type="button" value="Tambah Data &#43;">
			</a>
		</div>	
	<div class="frame_tabel radius transparent" style="margin-bottom: 3px;">
		<table cellspacing="1px" cellpadding="1px">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Nama Customer</div></td>
				<td>
					<div class="isi_tabel">
						<input type="text" name="katakunci" id="katakunci" size="60" value="<?php echo $katakunci; ?>">
					</div>
				</td>
				<td>
					<div class="isi_tabel" style="margin-right:2px;">
						<a href="#" onClick="javascript:tampilkan_list_cari(); return false;">
							<input type="button" value="Cari">
						</a>
						<a href="" onClick="javascript:tampilkan_list(0); return false;">
							<input type="button" value="Tampilkan Semua">
						</a>
					</div>
				</td>
			</tr>
		</table>			
	</div>	
	<div class="frame_tabel radius transparent">
		<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="220px"><div class="header_tabel">Nama Lengkap</div></td>
				<td width="200px"><div class="header_tabel">No. KTP</div></td>
				<td width="160px"><div class="header_tabel">Telpon</div></td>
				<td width="160px"><div class="header_tabel">HP</div></td>
				<td width="150px"><div class="header_tabel">eMail</div></td>
				<td width="150px"><div class="header_tabel">Alamat</div></td>
				<td colspan="3"><div class="header_tabel">&nbsp;</div></td>
			</tr>
			
			<?php
			if($customer != ""){
				foreach($customer as $data_customer){
			?>
			
			<tr bgcolor="#FFFFFF">
				<td><div class="isi_tabel"> <?php echo $data_customer->nama_lengkap; ?> </div></td>
				<td><div class="isi_tabel"> <?php echo $data_customer->no_ktp; ?> </div></td>
				<td><div class="isi_tabel"> <?php echo $data_customer->telpon; ?> </div></td>
				<td><div class="isi_tabel"> <?php echo $data_customer->hp; ?> </div></td>
				<td><div class="isi_tabel"> <?php echo $data_customer->email; ?> </div></td>
				<td><div class="isi_tabel"> <?php echo substr($data_customer->alamat_surat_menyurat, 0, 50); ?> </div></td>
				
				<td align="center">
					<a href="#" title="Tampilkan" onClick="javascript:tampilkan_detail_customer(<?php echo $data_customer->id_customer; ?>); return false;">
						<div class="isi_tabel">
							<img src="<?php echo base_url(); ?>files/images/view.png">
						</div>
					</a>
				</td>	
				
				<?php
				if ($this->access_lib->_if("adm,mgr,ksr"))
				{
					?>
					<td align="center">
						<a href="<?php echo base_url(); ?>report/customer_form_data/edit/<?php echo $data_customer->id_customer; ?>">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</div>
						</a>
					</td>
					<td align="center">					
						<a href="#" title="Hapus" onClick="javascript:hapus_data_customer(<?php echo $data_customer->id_customer; ?>); return false;">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/delete.png">
							</div>
						</a>
					</td>
					<?php
				}
				?>
				
			</tr>
			
			<?php
				}
			}
			?>
			
		</table>
	</div>
	
	<div class="clear"></div>
	
	<div id="frame_pagging" class="shadow radius">
	
		<?php
		if($next < $total_customer){
		?>
		
		<a href="<?php echo base_url(); ?>dashboard/customer/list_data/<?php echo $akhir; ?>" 
		onClick="javascript:tampilkan_list(<?php echo $akhir; ?>); return false;">
			<div id="tombol_navigasi">Terakhir</div>
		</a>
		<a href="<?php echo base_url(); ?>dashboard/customer/list_data/<?php echo $next; ?>" 
		onClick="javascript:tampilkan_list(<?php echo $next; ?>); return false;">
			<div id="tombol_navigasi">Berikutnya</div>
		</a>
		
		<?php
		}
		?>
		
		<div class="data_nav">
			Data ke <?php if($posisi == 0 AND count($customer) == 0){ echo "0"; }else if(count($customer) > 0){ echo $posisi+1; } ?> 
			sampai <?php echo count($customer)+$posisi; ?>
		</div>
		
		<?php
		if($prev >= 0){
		?>
		
		<a href="<?php echo base_url(); ?>dashboard/customer/list_data/<?php echo $prev; ?>" 
		onClick="javascript:tampilkan_list(<?php echo $prev; ?>); return false;">
			<div id="tombol_navigasi">Sebelumnya</div>
		</a>
		<a href="<?php echo base_url(); ?>dashboard/customer/list_data/0" 
		onClick="javascript:tampilkan_list(0); return false;">
			<div id="tombol_navigasi">Pertama</div>
		</a>
		
		<?php
		}
		?>
	
		<div class="info_data">Total <?php echo $total_customer; ?> Data</div>
	</div>
</div>
