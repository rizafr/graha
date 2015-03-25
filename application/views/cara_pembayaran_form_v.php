	<div class="margin_left" style="width:400px">		
		<div class="header_data"><?php echo $judul; ?></div>	
		<div class="tombol_tambah">
			<a href="" onClick="javascript:list_data(); return false;">
				<input type="button" value="&laquo; Kembali">
			</a>
		</div>
		<div class="frame_tabel radius transparent">
			<form name="form" id="form" method="post" action="<?php echo $action;?>" onSubmit="return post(this);">
			<table width="400px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				
				<tr bgcolor="#FFFFFF">
					<td width="150px" bgcolor="#999999"><div class="isi_tabel"><b>Tipe Pembayaran<span class="required_star">*</span></b></div></td>
					<td width="250px">
						<div class="isi_tabel">
							<input name="tipe_pembayaran" type="radio" value="Cash" <?php if ($tipe_pembayaran == "Cash") echo 'checked="checked"'; ?>> Cash &nbsp;&nbsp;
							<input name="tipe_pembayaran" type="radio" value="KPR"  <?php if ($tipe_pembayaran == "KPR") echo 'checked="checked"'; ?>> KPR
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Tahap Pembayaran<span class="required_star">*</span></b></div></td>
					<td>
						<div class="isi_tabel">
							<input class="center" name="tahap_pembayaran" type="text" size="1" value="<?php echo $tahap_pembayaran; ?>" onkeypress="return isNumberKey(event)"> x
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
					<td>
						<div class="isi_tabel">
							<input type="hidden" name="id_cara_pembayaran" id="id_cara_pembayaran" value="<?php echo $id_cara_pembayaran; ?>">
							<input type="submit" value="Simpan &#10003;">
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td colspan="2">
						<div class="isi_tabel"><span class="required_star">* Harus Diisi</span></div>
					</td>					
				</tr>			
			</table>
			</form>
		</div>
		
		<div class="clear"></div>
	</div>