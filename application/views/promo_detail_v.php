<?php include "fungsi_tanggal.php"; ?>

<script type="text/javascript">
$(document).ready(function(){
	
		$(".header_unit").click(function(){
			
			$(".detail_unit").hide();
			var id_unit = $(this).attr("id");
			$("#det_" + id_unit).fadeIn();
		});
		
});
</script>

<div class="margin_center" style="width:1000px">		
	<div class="header_data">Unit Promo</div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:list_data(<?php echo $posisi; ?>); return false;"><input type="button" value="&laquo; Kembali"></a>
	</div>
	
	<div class="frame_tabel radius transparent">
		<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="isi_tabel"><strong>Nama Promo</strong></div></td>
				<td width="450px"><div class="isi_tabel"><?php echo $promo->nama_promo; ?></div></td>
			</tr>	
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Mulai</strong></div></td>
				<td><div class="isi_tabel"><?php echo ubah_format_tanggal($promo->tanggal_mulai); ?></div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Akhir</strong></div></td>
				<td><div class="isi_tabel"><?php echo ubah_format_tanggal($promo->tanggal_akhir); ?></div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Status</strong></div></td>
				<td>
					<?php
					if($promo->status_promo == "1"){
					?>
					
					<div class="isi_tabel" style="color:#090;">Aktif</div>
					
					<?php
					}else if($promo->status_promo == "0"){
					?>
					
					<div class="isi_tabel" style="color:#090;">Tidak Aktif</div>
					
					<?php
					}
					?>
				</td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Deskripsi</strong></div></td>
				<td><div class="isi_tabel"><?php echo $promo->deskripsi; ?></div></td>
			</tr>
		</table>
	</div>
	
	<div class="clear"></div><br />
	
	<div id="data-unit-promo" class="frame_tabel radius transparent" style="width:1000px;">
		<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#0066FF">
				<td rowspan="2"><div class="header_tabel"> Kategori </div></td>
				<td rowspan="2"><div class="header_tabel"> Cluster </div></td>
				<td rowspan="2"><div class="header_tabel"> Unit </div></td>
				<td rowspan="2"><div class="header_tabel"> Type </div></td>
				<td colspan="2" width="170px"><div class="header_tabel"> Diskon </div></td>
				<td rowspan="2"><div class="header_tabel"> Status Transaksi </div></td>
			</tr>
			
			<tr bgcolor="#0066FF">
				<td width="85px"><div class="header_tabel"> Tanah </div></td>
				<td width="85px"><div class="header_tabel"> Bangunan </div></td>
			</tr>
			
			<?php
			foreach($unit as $data_unit)
			{
			?>
				<tr class="header_unit" id="<?php echo $data_unit->id_unit; ?>" class="hover" bgcolor="#FFFFFF">
					<td><div class="isi_tabel"> <?php echo $data_unit->kategori; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_unit->nama_cluster; ?> </div></td>
					<td><div class="isi_tabel nowrap"> <?php echo $data_unit->kode_unit; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_unit->nama_type." ".$data_unit->posisi; ?> </div></td>
					
					<td align="right">
						<div class="isi_tabel"> 
							<?php echo $data_unit->diskon_tanah; ?>% 
						</div>
					</td>
					
					<td align="right">
						<div class="isi_tabel"> 
							<?php echo $data_unit->diskon_bangunan; ?>% 
						</div>
					</td>
					
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
					
				</tr>
				
				<tr style="display:none;" class="detail_unit" id="det_<?php echo $data_unit->id_unit; ?>" bgcolor="#FFFFFF">
					<td colspan="3"><div class="isi_tabel">&nbsp;</div></td>
					<td colspan="3">
						<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
							<tr bgcolor="#FFFFFF">
								<td bgcolor="#0066FF"><div class="header_tabel"> Cara Pembayaran </div></td>
								<td bgcolor="#999999" colspan="2"><div class="header_tabel"> Maksimun Diskon </div></td>
							</tr>
							
							<?php
							
							$det_cb = $this->promo_m->get_max_diskon($data_unit->id_unit)->result();
							foreach ($det_cb AS $dcb)
							{
								?>
								<tr bgcolor="#FFFFFF">
									<td><div class="isi_tabel"><?php echo $dcb->cara_pembayaran; ?>x</div></td>
									
									<td width="84px" align="right">
										<div class="isi_tabel">
											<?php echo $dcb->max_diskon_tanah; ?>%
										</div>
									</td>
									
									<td width="84px" align="right">
										<div class="isi_tabel">
											<?php echo $dcb->max_diskon_bangunan; ?>%
										</div>
									</td>
								</tr>
								<?php
							}
							
							?>
							
							<tr>
								<td colspan="3"><div class="header_tabel"></div></td>
							</tr>
							
						</table>
					</td>
					<td colspan="2"><div class="isi_tabel">&nbsp;</div></td>
				</tr>

			<?php
			}
			?>
		</table>
	</div>
	
	<div class="clear" style="height:40px;"></div>
</div>