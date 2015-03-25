<?php include "fungsi_tanggal.php"; ?>

<div class="margin_center" style="width:100%;">
<div class="header_data">Report Data Pemesanan Timeout</div>

<div class="clear"></div>

<div class="frame_tabel_cust radius transparent" style="float:none;">
	<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
		<tr bgcolor="#FFFFFF">
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Nomor Pemesanan</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Nama Pemesan</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Tgl Pemesanan</div></td>
			<td width="" class="header_tabel_cust nowrap"><div style="color:#FFF; text-align: center;">Tgl TJ</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Tgl Expire</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Timeout</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Kategori</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Cluster</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Unit</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Type</div></td>
			<td width="70px" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Status Transaksi</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Cara Pembayaran</div></td>
			<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Sales</div></td>
			<td colspan="3" width="50px" class="header_tabel_cust"><div>&nbsp;</div></td>
		</tr>
		
		<?php
		foreach($pemesanan as $data_pemesanan){
		?>
		
		<tr class="hover">
			<td><div class="isi_tabel"> <?php echo $data_pemesanan->nomor_pemesanan; ?> </div></td>
			<td><div class="isi_tabel"> <?php echo $data_pemesanan->nama_lengkap; ?> </div></td>
			<td align="center"><div class="isi_tabel"> <?php echo ubah_format_tanggal($data_pemesanan->tanggal_pemesanan, "H:i:s"); ?> </div></td>
			<td align="center">
				<div class="isi_tabel" id="tanggal_tanda_jadi_<?php echo $data_pemesanan->id_pemesanan; ?>"> 
					<?php echo ubah_format_tanggal($data_pemesanan->tanggal_tanda_jadi, "H:i:s"); ?> 
				</div>
			</td>
			<td align="center">
				<div class="isi_tabel" id="tanggal_exp_<?php echo $data_pemesanan->id_pemesanan; ?>"> 
					<?php 
					if($data_pemesanan->status_pemesanan == "Booked")
					{
						echo exp_order($data_pemesanan->timeout, $data_pemesanan->tanggal_pemesanan);
					}
					else if($data_pemesanan->status_pemesanan == "Tanda Jadi" OR $data_pemesanan->status_pemesanan == "Sold")
					{						
						echo exp_order($data_pemesanan->timeout, $data_pemesanan->tanggal_tanda_jadi);
					}
					?> 
				</div>
			</td>
			<td align="right"><div class="isi_tabel" style="color:red;"> <?php echo dhm($data_pemesanan->timeout, 'dhm'); ?> </div></td>	
			<td><div class="isi_tabel"> <?php echo $data_pemesanan->kategori; ?> </div></td>
			<td><div class="isi_tabel"> <?php echo $data_pemesanan->nama_cluster; ?> </div></td>
			<td><div class="isi_tabel nowrap"> <?php echo $data_pemesanan->kode_unit; ?> </div></td>
			<td><div class="isi_tabel"> <?php echo $data_pemesanan->nama_type." ".$data_pemesanan->posisi; ?> </div></td>
			<td align="center">
				<div class="isi_tabel" id="status_<?php echo $data_pemesanan->id_pemesanan?>"> 
				
				<?php 
				if($data_pemesanan->status_pemesanan == "Booked")
				{
					echo "<font color='green'>".$data_pemesanan->status_pemesanan."</font>"; 
				}
				else
				{
					echo "<font color='red'>".$data_pemesanan->status_pemesanan."</font>"; 
				}
				?>
				
				</div>
			</td>
			<td><div class="isi_tabel"> <?php echo $data_pemesanan->cara_pembayaran; ?>x </div></td>	
			<td><div class="isi_tabel"> <?php echo $data_pemesanan->nama_sales; ?> </div></td>
			
			<td align="center">
				<a href="<?php echo base_url(); ?>report/timeout_detail/<?php echo $data_pemesanan->id_unit."/".$data_pemesanan->id_kartu_keluarga."/".$data_pemesanan->id_pemesanan; ?>" title="Tampilkan" >
					<div class="isi_tabel">
						<img src="<?php echo base_url(); ?>files/images/view.png">
					</div>
				</a>
			</td>
			
			<?php
			if ($this->access_lib->_if("adm,mgr"))
			{
				?>
				<td align="center">
					<a href="<?php echo base_url(); ?>report/timeout_form/<?php echo $data_pemesanan->id_unit."/".$data_pemesanan->id_kartu_keluarga."/".$data_pemesanan->id_pemesanan; ?>" title="Ubah">
						<div class="isi_tabel">
							<img src="<?php echo base_url(); ?>files/images/update.png">
						</div>
					</a>
				</td>
				<td align="center">
					<a href="javascript:void(0)" title="Hapus" onClick="javascript:hapus_pemesanan(<?php echo $data_pemesanan->id_pemesanan.",".$data_pemesanan->id_unit.",".$posisi; ?>); return false;">
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
		?>
		
	</table>
</div>

<div class="clear"></div>

<div id="frame_pagging" class="shadow radius">

	<?php
	if($next < $total_pemesanan){
	?>
	
	<a href="javascript:void(0);" onClick="javascript:tampilkan_list(<?php echo $akhir; ?>); return false;">
		<div id="tombol_navigasi">Terakhir</div>
	</a>
	<a href="javascript:void(0);" onClick="javascript:tampilkan_list(<?php echo $next; ?>); return false;">
		<div id="tombol_navigasi">Berikutnya</div>
	</a>
	
	<?php
	}
	?>
	
	<div class="data_nav">
		Data ke <?php if($posisi == 0 AND count($pemesanan) == 0){ echo "0"; }else if(count($pemesanan) > 0){ echo $posisi+1; } ?> 
		sampai <?php echo count($pemesanan)+$posisi; ?>
	</div>
	
	<?php
	if($prev >= 0){
	?>
	
	<a href="javascript:void(0);" onClick="javascript:tampilkan_list(<?php echo $prev; ?>); return false;">
		<div id="tombol_navigasi">Sebelumnya</div>
	</a>
	<a href="javascript:void(0);" onClick="javascript:tampilkan_list(0); return false;">
		<div id="tombol_navigasi">Pertama</div>
	</a>
	
	<?php
	}
	?>

	<div class="info_data">Total <?php echo $total_pemesanan; ?> Data</div>
</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {	
		var jenis_transaksi	= $('#jenis_transaksi').val();
		if(jenis_transaksi == "Promo")
		{
			$('#id_promo').show();
		}
		else
		{
			$('#id_promo').hide();
		}		
	})
</script>