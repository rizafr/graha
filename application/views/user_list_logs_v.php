<div class="margin_center" style="width:1000px">	
	<script type="text/javascript">
	
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			return false;
		}
		
		return true;
	}
	
	$(function() {
		$("#tanggal_mulai").datepicker({ dateFormat: 'dd M yy' }).datepicker("setDate", new Date(Date.parse("<?php echo $tanggal_mulai; ?>")));
		$("#tanggal_selesai").datepicker({ dateFormat: 'dd M yy' }).datepicker("setDate", new Date(Date.parse("<?php echo $tanggal_selesai; ?>")));
	});
	
	</script>

	<div class="header_data">User Logs</div>
	<div class="frame_tabel radius transparent" style="margin-bottom: 3px;">
		<table cellspacing="1px" cellpadding="1px">
			<tr bgcolor="#FFFFFF">
				<td width="80px" bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Jenis Pencarian</div></td>
				<td>
					<div class="isi_tabel">
						<select name="pencarian" id="pencarian">
							<option value="username" <?php if ($pencarian == "username") echo 'selected="selected"'; ?>>Username</option>
							<option value="keterangan" <?php if ($pencarian == "keterangan") echo 'selected="selected"'; ?>>Keterangan</option>
							<option value="ip_address" <?php if ($pencarian == "ip_address") echo 'selected="selected"'; ?>>IP Address</option>
						</select>
					
						<input type="text" name="cari" id="cari" size="60" value="<?php echo $cari; ?>">
					</div>
				</td>
				
				<tr bgcolor="#FFFFFF" id="tr-tanggal">
					<td bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Tanggal</div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" value="" name="tanggal_mulai" size="13" id="tanggal_mulai" style="text-align:center;" /> s/d
							<input type="text" value="" name="tanggal_selesai" size="13" id="tanggal_selesai" style="text-align:center;" />
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
							<a href="" onClick="javascript:list_data_logs(<?php echo $posisi; ?>, document.getElementById('show').value, ''); return false;">
								<input type="button" value="Tampilkan">
							</a>
							
							<a href="" onClick="javascript:hapus_log(); return false;">
								<input type="button" value="Hapus">
							</a>
						</div>
					</td>
				</tr>
			
			</tr>
		</table>			
	</div>
	<div class="frame_tabel radius transparent">
		<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#0066FF">
				<td width="150px"><div class="header_tabel"> Tanggal </div></td>
				<td width="120px"><div class="header_tabel"> Username </div></td>
				<td><div class="header_tabel"> Keterangan </div></td>
				<td width="120px"><div class="header_tabel"> IP Address </div></td>
			</tr>
			
			<?php
			foreach($logs as $data_logs)
			{
				?>
				<tr id="<?php echo $data_logs->id_logs; ?>" class="hover">
					<td><div class="isi_tabel"> <?php echo $data_logs->tanggal_posting; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_logs->username; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_logs->keterangan; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_logs->ip_address; ?> </div></td>					
				</tr>
				<?php
			}
			?>
			
		</table>
	</div>
	
	<div class="clear"></div>
	
	<div id="frame_pagging" class="shadow radius" style="margin-bottom: 20px;">
	
		<?php
		if($next < $total_logs){
		?>
		
		<a href="" onClick="javascript:list_data_logs(<?php echo $akhir; ?>, <?php echo $show.",".$key; ?>); return false;">
			<div id="tombol_navigasi">Terakhir</div>
		</a>
		<a href="" onClick="javascript:list_data_logs(<?php echo $next; ?>, <?php echo $show.",".$key; ?>); return false;">
			<div id="tombol_navigasi">Berikutnya</div>
		</a>
		
		<?php
		}
		?>
		
		<div class="data_nav">
			Data ke <?php if($posisi == 0 AND count($logs) == 0){ echo "0"; }else if(count($logs) > 0){ echo $posisi+1; } ?> 
			sampai <?php echo count($logs)+$posisi; ?>
		</div>
		
		<?php
		if($prev >= 0){
		?>
		
		<a href="" onClick="javascript:list_data_logs(<?php echo $prev; ?>, <?php echo $show.",".$key; ?>); return false;">
			<div id="tombol_navigasi">Sebelumnya</div>
		</a>
		<a href="" onClick="javascript:list_data_logs(0, <?php echo $show.",".$key; ?>); return false;">
			<div id="tombol_navigasi">Pertama</div>
		</a>
		
		<?php
		}
		?>
	
		<div class="info_data">Total <?php echo $total_logs; ?> Data</div>
	</div>
	
	<div class="clear"></div>
	
</div>
