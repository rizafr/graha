<script type="text/javascript">
$(document).ready(function(){
	
		$(".header_unit").click(function(){
			
			$(".detail_unit").hide();
			var id_unit = $(this).attr("id");
			$("#det_" + id_unit).fadeIn();
		});
		
});
</script>
		
		<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#0066FF">
				<td rowspan="2" class="header_tabel"> Kategori  </td>
				<td rowspan="2"  class="header_tabel"> Cluster  </td>
				<td rowspan="2"  class="header_tabel"> Unit  </td>
				<td rowspan="2"  class="header_tabel"> Type  </td>
				<td colspan="2" width="170px" class="header_tabel"> Diskon  </td>
				<td rowspan="2" class="header_tabel"> Status Transaksi  </td>
				<td rowspan="2"  class="header_tabel">&nbsp; </td>
			</tr>
			
			<tr bgcolor="#0066FF">
				<td width="85px"  class="header_tabel"> Tanah  </td>
				<td width="85px" class="header_tabel"> Bangunan  </td>
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
							<input type="text" size="5" class="post_<?php echo $data_unit->id_unit; ?>" name="diskon_tanah" value="<?php echo $data_unit->diskon_tanah; ?>" onBlur="return isPercentKey(this)" style="text-align:right;"> % 
						</div>
					</td>
					
					<td align="right">
						<div class="isi_tabel"> 
							<input type="text" size="5" class="post_<?php echo $data_unit->id_unit; ?>" name="diskon_bangunan" value="<?php echo $data_unit->diskon_bangunan; ?>" onBlur="return isPercentKey(this)" style="text-align:right;"> % 
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
					
					<td align="center">
						<a href="" title="Hapus" onClick="javascript:delete_unit_promo(<?php echo $data_unit->id_unit; ?>); return false;">
							<div class="isi_tabel">
								<img src="<?php echo base_url(); ?>files/images/delete.png">
							</div>
						</a>
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
									
									<td align="right" width="84px">
										<div class="isi_tabel">
											<input type="text" size="5" class="post_<?php echo $data_unit->id_unit; ?>" name="mx_tnh[<?php echo $dcb->id_cara_pembayaran; ?>]" value="<?php echo $dcb->max_diskon_tanah; ?>" style="text-align:right;" onBlur="return isPercentKey(this)" style="text-align:right;"> %
										</div>
									</td>
									
									<td align="right" width="84px">
										<div class="isi_tabel">
											<input type="text" size="5" class="post_<?php echo $data_unit->id_unit; ?>" name="mx_bgn[<?php echo $dcb->id_cara_pembayaran; ?>]" value="<?php echo $dcb->max_diskon_bangunan; ?>" style="text-align:right;" onBlur="return isPercentKey(this)" style="text-align:right;"> %
										</div>
									</td>
								</tr>
								<?php
							}
							
							?>
							<tr bgcolor="#FFFFFF">
								<td colspan="3" align="right">
									<div class="isi_tabel">
										<input type="submit" value="Simpan &#10003;" onClick="javascript:edit_unit_promo(<?php echo $data_unit->id_unit; ?>); return false;">
									</div>
								</td>
							</tr>
							
							<tr>
								<td colspan="3"><div class="header_tabel"></div></td>
							</tr>
							
						</table>
					</td>
					<td colspan="3"><div class="isi_tabel">&nbsp;</div></td>
				</tr>

			<?php
			}
			?>
		</table>