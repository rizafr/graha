<div class="margin_center" style="width:98%;">
	<div class="header_data">Unit Promo Lainnya</div>
	<div class="tombol_tambah" style="padding-right: 5px;">
		<a href="<?php echo base_url(); ?>booking/promo"><input type="button" value="&laquo; Kembali"></a>
	</div>
	
	<div class="clear"></div>
	
	<div class="frame_tabel radius transparent">
		<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td rowspan="3" class="header_tabel_cust center"> Kategori </td>
				<td rowspan="3" class="header_tabel_cust center"> Cluster </td>
				<td rowspan="3" class="header_tabel_cust center"> Unit </td>
				<td rowspan="3" class="header_tabel_cust center"> Type </td>
				<td rowspan="3" class="header_tabel_cust center"> Status </td>
				<td rowspan="2" colspan="2"class="header_tabel_cust center"> Luas (m&sup2;) </td>
				<td rowspan="3" class="header_tabel_cust center"> Harga Jual Incl. PPN </td>
				<td colspan="7" class="header_tabel_cust center"> KPR </td>
				<td rowspan="3" class="header_tabel_cust center"></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td rowspan="2" class="header_tabel_cust center"> Tanda Jadi </td>
				<td rowspan="2" class="header_tabel_cust center"> Uang Muka </td>
				<td rowspan="2" class="header_tabel_cust center"> Plafon KPR </td>
				<td colspan="4" class="header_tabel_cust center"> Angsuran </td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td class="header_tabel_cust center"> Tnh </td>
				<td class="header_tabel_cust center"> Bang </td>
				<td class="header_tabel_cust center"> ASB </td>
				<td class="header_tabel_cust center"> 5 Tahun </td>
				<td class="header_tabel_cust center"> 10 Tahun </td>
				<td class="header_tabel_cust center"> 15 Tahun </td>
			</tr>			
			
			<?php
			foreach ($unit as $data_unit) 
			{
			?>

			<tr class="hover">
				<td><div class="isi_tabel"> <?php echo $data_unit->kategori; ?> </div></td>
				<td><div class="isi_tabel"> <?php echo $data_unit->nama_cluster; ?> </div></td>
				<td><div class="isi_tabel nowrap"> <?php echo $data_unit->kode_unit; ?> </div></td>
				<td><div class="isi_tabel"> <?php echo $data_unit->nama_type." ".$data_unit->posisi;; ?> </div></td>
				<td align="center">
					<div class="isi_tabel"> 				
					
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
						
					</div>
				</td>
				<td align="right"><div class="isi_tabel"> <?php echo $data_unit->luas_tanah; ?> </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo $data_unit->luas_bangunan; ?> </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->harga_jual_inc_ppn), 0); ?> </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->tanda_jadi), 0); ?> </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->uang_muka), 0); ?> </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->plafon_kpr), 0); ?> </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo $data_unit->suku_bunga; ?>% </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_5_tahun), 0); ?> </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_10_tahun), 0); ?> </div></td>
				<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_15_tahun), 0); ?> </div></td>
				<td style="padding:2px;">
					<a href="<?php echo base_url(); ?>booking/form_pemesanan/add/0/<?php echo $data_unit->id_unit; ?>">
						<input type="button" value="Pesan">
					</a>
				</td>
			</tr>

			<?
			}
			?>

		</table>
	</div>
	
	<div class="clear"></div>
	
	<div id="frame_pagging" class="shadow radius" style="margin-bottom: 10px;">
	
		<?php
		if($next < $total_unit){
		?>
		
		<a href="" onClick="javascript:list(<?php echo $akhir; ?>); return false;">
			<div id="tombol_navigasi">Terakhir</div>
		</a>
		<a href="" onClick="javascript:list(<?php echo $next; ?>); return false;">
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
		
		<a href="" onClick="javascript:list(<?php echo $prev; ?>); return false;">
			<div id="tombol_navigasi">Sebelumnya</div>
		</a>
		<a href="" onClick="javascript:list(0, <?php echo $show; ?>); return false;">
			<div id="tombol_navigasi">Pertama</div>
		</a>
		
		<?php
		}
		?>
	
		<div class="info_data" style="width:300px">Total <?php echo $total_unit; ?> Data</div>
	</div>
	
	<div class="clear" style="height:40px;"></div>	
</div>