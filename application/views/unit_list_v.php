<script type="text/javascript">
	
	$(document).ready(function(){
	
		$("#filter_cluster").change(function(){
		
			$('#filter_type').html('<option value=""> -- Type -- </option>');
			var id_cluster = $('#filter_cluster').val();
			
			if(id_cluster != "" )
			{
				$('#filter_type').load(base_url+'ajax/list_option_type_filter/'+id_cluster);
			}
		});
	
	});
	
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			return false;
		}
		
		return true;
	}
	
</script>

<div class="margin_center" style="width:98%">
	<div class="header_data">Master Stok</div>
	
	<div class="tombol_tambah">
		<?php
		if ($this->access_lib->_if("adm,stk"))
		{
			?>
			<a href="" onClick="javascript:add(<?php echo $posisi.", ".$show.", '".$key."'"; ?>); return false;"><input type="button" value="Tambah Stok &#43;"></a>
			<?php
		}
		?>	
	</div>
	
	<div class="frame_tabel radius transparent" style="margin-bottom: 3px;">
		<table cellspacing="1px" cellpadding="1px">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Filter</div></td>
				<td>
					<div class="isi_tabel">
						<select name="filter_kategori" id="filter_kategori">
							<option value=""> -- Kategori -- </option>
	
							<?php
							$sel = '';
							foreach($list_kategori as $kategori)
							{
								if($kategori == $filter_kategori)
								{
									$sel = 'selected="true"';
								}
								
								echo '<option value="'.$kategori.'" '.$sel.'>'.$kategori.'</option>';
								
								$sel = '';
							}
							?>
	
						</select>
						<select name="filter_cluster" id="filter_cluster">
							<option value=""> -- Cluster -- </option>
	
							<?php
							$sel = '';
							foreach($cluster as $data_cluster)
							{
								if($data_cluster->id_cluster == $filter_cluster)
								{
									$sel = 'selected="true"';
								}
								
								echo '<option value="'.$data_cluster->id_cluster.'" '.$sel.'>'.$data_cluster->nama_cluster.' ('.$data_cluster->kode_cluster.')</option>';
								
								$sel = '';
							}
							?>
	
						</select>
						
						<select name="filter_type" id="filter_type">
							<option value=""> -- Type -- </option>
	
							<?php
							$sel = '';
							foreach($type as $data_type)
							{
								if($data_type->id_type == $filter_type)
								{
									$sel = 'selected="true"';
								}
								
								echo '<option value="'.$data_type->id_type.'" '.$sel.'>'.$data_type->nama_type.'</option>';
								
								$sel = '';
							}
							?>
						</select>
						
						<span id="filter_expander_2">
	
							<select name="filter_status_unit" id="filter_status_unit">
								<option value=""> -- Status Stok -- </option>
	
								<?php
								$sel = '';
								foreach($list_status_unit as $status_unit)
								{
									if($status_unit == $filter_status_unit)
									{
										$sel = 'selected="true"';
									}
									
									echo '<option value="'.$status_unit.'" '.$sel.'>'.$status_unit.'</option>';
									
									$sel = '';
								}
								?>
	
							</select>
	
						</span>
						<span id="filter_expander_3">
						
							<select name="filter_status_transaksi" id="filter_status_transaksi">
								<option value=""> -- Status Transaksi -- </option>
	
								<?php
								$sel = '';
								foreach($list_status_transaksi as $status_transaksi)
								{
									if($status_transaksi == $filter_status_transaksi)
									{
										$sel = 'selected="true"';
									}
									
									echo '<option value="'.$status_transaksi.'" '.$sel.'>'.$status_transaksi.'</option>';
									
									$sel = '';
								}
								?>
							</select>
							
						</span>
					</div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Urutkan</div></td>
				<td>
					<div class="isi_tabel">
						<span id="frame_order_by">
							<select name="order_by" id="order_by">
								<option value=""> -- Kategori Pengurutan -- </option>
								<option value="u.kategori" <?php if($order_by == "u.kategori"){ echo "selected"; } ?>>Kategori</option>
								<option value="c.nama_cluster" <?php if($order_by == "c.nama_cluster"){ echo "selected"; } ?>>Cluster</option>
								<option value="t.nama_type" <?php if($order_by == "t.nama_type"){ echo "selected"; } ?>>Type</option>
								<option value="u.kode_unit" <?php if($order_by == "u.kode_unit"){ echo "selected"; } ?>>Kode Unit</option>
								<option value="u.status_unit" <?php if($order_by == "u.status_unit"){ echo "selected"; } ?>>Status Stok</option>
								<option value="u.status_transaksi" <?php if($order_by == "u.status_transaksi"){ echo "selected"; } ?>>Status Transaksi</option>
							</select>
						</span>
						<span id="frame_sort_by">
							<select name="sort_by" id="sort_by">
								<option value=""> -- Metode Pengurutan -- </option>
								<option value="ASC" <?php if($sort_by == "ASC"){ echo "selected"; } ?>>Kecil ke Besar</option>
								<option value="DESC" <?php if($sort_by == "DESC"){ echo "selected"; } ?>>Besar ke Kecil</option>
							</select>
						</span>
					</div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Pencarian</div></td><td>
					<div class="isi_tabel">
						<input type="text" value="<?php echo $filter_kode_cluster;?>" size="8" name="filter_kode_cluster" id="filter_kode_cluster" placeholder="Kd. Cluster" style="text-align:center;"> <strong>/</strong>
						<input type="text" value="<?php echo $filter_blok;?>" size="2" name="filter_blok" id="filter_blok" placeholder="Blok" style="text-align:center;"> <strong>-</strong>
						<input type="text" value="<?php echo $filter_nomor;?>" size="3" name="filter_nomor" id="filter_nomor" placeholder="Nomor" style="text-align:center;">
					</div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Data perhalaman</div></td><td>
					<div class="isi_tabel">
						<input type="text" value="<?php echo $show; ?>" name="show" id="show" size="4" style="text-align:center;" onkeypress="return isNumberKey(event)">
					</div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">&nbsp;</div></td>
				<td>
					<div class="isi_tabel">
						<a href="" onClick="javascript:list_data(0, document.getElementById('show').value, ''); return false;">
							<input type="button" value="Tampilkan">
						</a>
						<a href="" onClick="javascript:list_data(0, document.getElementById('show').value , 'all'); return false;">
							<input type="button" value="Tampilkan Semua">
						</a>
						
						<?php
						if ($this->access_lib->_if("adm,stk"))
						{
						?>
							<a href="" onClick="javascript:reset_promo(); return false;">
								<input type="button" value="Reset Promo">
							</a>
						<?php
						}
						?>
						
					</div>
				</td>
			</tr>
		</table>
	</div>
	
	<div class="clear"></div>
	
	<ul class="msg" style="float:right; margin-right:10px;">
		<?php echo validation_errors('<li>', '</li>'); ?>
		<?php echo $this->session->flashdata('msg'); ?>
	</ul>
	
	<div class="clear"></div>
		<script type="text/javascript">
			var winHeight = $(window).height();
			$('#unit_list').css('height', winHeight-80);
		</script>
	<div class="frame_tabel_cust radius transparent" id="unit_list" style="float:none; overflow:scroll;">
		<table style="white-space:nowrap;" width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<thead>
			<tr bgcolor="#FFFFFF">
				<td rowspan="3" class="header_tabel_cust center"> Kategori </td>
				<td rowspan="3" class="header_tabel_cust center"> Cluster </td>
				<td rowspan="3" class="header_tabel_cust center"> Unit </td>
				<td rowspan="3" class="header_tabel_cust center"> Type </td>
				<td rowspan="2" colspan="2" class="header_tabel_cust center"> Status </td>
				<td rowspan="2" colspan="2"class="header_tabel_cust center"> Luas (m&sup2;) </td>
				<td rowspan="3" class="header_tabel_cust center"> Harga Jual Incl. PPN </td>
				<td colspan="9" class="header_tabel_cust center"> KPR </td>
				
				<?php
				if ($this->access_lib->_if("adm,stk"))
				{
					?>
					<td width="5px" rowspan="3" class="header_tabel_cust center"><img src="<?php echo base_url(); ?>files/images/master.png"></td>
					<td width="5px" rowspan="3" class="header_tabel_cust center"><img src="<?php echo base_url(); ?>files/images/marketable.png"></td>
					<td width="5px" rowspan="3" class="header_tabel_cust center"><img src="<?php echo base_url(); ?>files/images/promo.png"></td>
					<td width="5px" colspan="3" rowspan="3" class="header_tabel_cust center">&nbsp;</td>	
					<?php
				}
				else
				{
					?>
					<td width="5px" colspan="6" rowspan="6" class="header_tabel_cust center">&nbsp;</td>
					<?php
				}
				?>
				
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td colspan="2" rowspan="2" class="header_tabel_cust center"> Tanda Jadi </td>
				<td colspan="2" rowspan="2" class="header_tabel_cust center"> Uang Muka </td>
				<td rowspan="2" class="header_tabel_cust center"> Plafon KPR </td>
				<td colspan="4" class="header_tabel_cust center"> Angsuran </td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td class="header_tabel_cust center"> Stok </td>
				<td class="header_tabel_cust center"> Transaksi </td>
				<td class="header_tabel_cust center"> Tnh </td>
				<td class="header_tabel_cust center"> Bang </td>
				<td class="header_tabel_cust center" width="5px"> ASB </td>
				<td class="header_tabel_cust center"> 5 Tahun </td>
				<td class="header_tabel_cust center"> 10 Tahun </td>
				<td class="header_tabel_cust center"> 15 Tahun </td>
			</tr>
			</thead>
			
			<?php
			foreach($unit as $data_unit)
			{
				?>
				<tr id="tr_<?php echo $data_unit->id_unit; ?>" class="hover">
					<td class="isi_tabel"> <?php echo $data_unit->kategori; ?> </td>
					<td class="isi_tabel"> <?php echo $data_unit->nama_cluster; ?> </td>
					<td class="isi_tabel"> <?php echo $data_unit->kode_unit; ?> </td>
					<td class="isi_tabel"> <?php echo $data_unit->nama_type." ".$data_unit->posisi; ?> </td>
					<td class="isi_tabel center" id="stu_<?php echo $data_unit->id_unit; ?>"> 
						<?php 
						if($data_unit->status_unit == "Promo")
						{
							echo "<font color='blue'>".$data_unit->status_unit."</font>"; 
						}
						else
						{
							echo $data_unit->status_unit;
						}
						?> 
					</td>
					<td class="isi_tabel center">
						<?php 
						if($data_unit->status_transaksi == "Booked")
						{
							echo "<font color='green'>".$data_unit->status_transaksi."</font>"; 
						}
						else
						{
							echo "<font color='red'>".$data_unit->status_transaksi."</font>";
						}
						?> 	
					</td>
					<td class="isi_tabel right"> <?php echo $data_unit->luas_tanah; ?> </td>
					<td class="isi_tabel right"> <?php echo $data_unit->luas_bangunan; ?> </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->harga_jual_inc_ppn), 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->persen_tanda_jadi, 2), 2); ?>% </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->tanda_jadi), 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->persen_uang_muka, 2), 2); ?>% </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->uang_muka), 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->plafon_kpr), 0); ?> </td>
					<td class="isi_tabel right"> <?php echo $data_unit->suku_bunga; ?>% </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->kpr_5_tahun), 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->kpr_10_tahun), 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format(round($data_unit->kpr_15_tahun), 0); ?> </td>
		
					<?php
					if ($this->access_lib->_if("adm,stk"))
					{
						
						$ceksum = '';
						$ceksua = '';
						$ceksue = '';
						if($data_unit->status_unit == "Master"){$ceksum = 'checked="checked"';}
						elseif($data_unit->status_unit == "Marketable"){$ceksua = 'checked="checked"';}
						elseif($data_unit->status_unit == "Promo"){$ceksue = 'checked="checked"';}
						
						if ($data_unit->status_transaksi != "")
						{
							$ceksum .= ' disabled="disabled"';
							$ceksua .= ' disabled="disabled"';
							$ceksue .= ' disabled="disabled"';
						}
						
						?>
						<td class="isi_tabel center">				
							<input type="radio" name="<?php echo $data_unit->id_unit; ?>" value="Master" onClick="javascript:update_status_unit(<?php echo $data_unit->id_unit; ?>, this);" <?php echo $ceksum ;?>>
						</td>
						<td class="isi_tabel center">				
							<input type="radio" name="<?php echo $data_unit->id_unit; ?>" value="Marketable" onClick="javascript:update_status_unit(<?php echo $data_unit->id_unit; ?>, this);" <?php echo $ceksua ;?>>
						</td>
						<td class="isi_tabel center">				
							<input type="radio" name="<?php echo $data_unit->id_unit; ?>" value="Promo" onClick="javascript:update_status_unit(<?php echo $data_unit->id_unit; ?>, this);" <?php echo $ceksue ;?>>
						</td>
						
						<td class="isi_tabel center">
							<a href="" title="Tampilkan" onClick="javascript:detail(<?php echo $data_unit->id_unit.",".$posisi.",".$show.", ''"; ?>); return false;">
								<img src="<?php echo base_url(); ?>files/images/view.png">
							</a>
						</td>
						
						<td class="isi_tabel center">
							<a href="" title="Ubah" onClick="javascript:edit(<?php echo $data_unit->id_unit.", ".$posisi.", ".$show.", '".$key."'"; ?>); return false;">
								<img src="<?php echo base_url(); ?>files/images/update.png">
							</a>
						</td>
						
						<td class="isi_tabel center">
							<a href="" title="Hapus" onClick="javascript:hapus(<?php echo $data_unit->id_unit.",".$posisi.", ".$show.", '".$key."'"; ?>); return false;">
								<img src="<?php echo base_url(); ?>files/images/delete.png">
							</a>
						</td>
						
					<?php
					}
					else
					{
						?>
						<td class="isi_tabel center">
							<a href="" title="Tampilkan" onClick="javascript:detail(<?php echo $data_unit->id_unit.",".$posisi.",".$show.", ''"; ?>); return false;">
								<img src="<?php echo base_url(); ?>files/images/view.png">
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
	
	<div id="frame_pagging" class="shadow radius" style="margin-bottom: 10px;">
	
		<?php
		if($next < $total_unit){
		?>
		
		<a href="" onClick="javascript:list_data(<?php echo $akhir.", ".$show.", ''"; ?>); return false;">
			<div id="tombol_navigasi">Terakhir</div>
		</a>
		<a href="" onClick="javascript:list_data(<?php echo $next.", ".$show.", ''"; ?>); return false;">
			<div id="tombol_navigasi">Berikutnya</div>
		</a>
		
		<?php
		}
		?>
		
		<div class="data_nav">
			Data ke <?php if($posisi == 0 AND count($unit) == 0){ echo "0"; }else if(count($unit) > 0){ echo $posisi+1; } ?> 
			sampai <?php echo count($unit)+$posisi; ?>
		</div>
		
		<?php
		if($prev >= 0){
		?>
		
		<a href="" onClick="javascript:list_data(<?php echo $prev.", ".$show.", ''"; ?>); return false;">
			<div id="tombol_navigasi">Sebelumnya</div>
		</a>
		<a href="" onClick="javascript:list_data(0, <?php echo $show.", ''"; ?>); return false;">
			<div id="tombol_navigasi">Pertama</div>
		</a>
		
		<?php
		}
		?>
	
		<div class="info_data" style="width:300px">Total <?php echo $total_unit; ?> Data</div>
	</div>
</div>