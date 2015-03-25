<script type="text/javascript">
	
	$(document).ready(function(){
	
		
	});
	
	function swap(){
		
		var status = $("#swap").val();
		
		var diskon_tanah = <?php echo $data_unit->diskon_tanah; ?>;
		var diskon_bangunan = <?php echo $data_unit->diskon_bangunan; ?>;
		
		if (status == 'Lihat Harga Promo')
		{
			auto(diskon_tanah, diskon_bangunan);
			$("#swap").val('Lihat Harga Regular');
		}
		else if (status == 'Lihat Harga Regular')
		{
			auto(0, 0);
			$("#swap").val('Lihat Harga Promo');
		}
		
	}
	
	
	function PMT(i, n, p)
	{
		return i * p * Math.pow((1 + i), n) / (1 - Math.pow((1 + i), n));
	}
	
	function auto(diskon_tanah, diskon_bangunan){
			
			var luas_tanah			= <?php echo $data_unit->luas_tanah; ?>;
			var luas_bangunan		= <?php echo $data_unit->luas_bangunan; ?>;
			var harga_tanah_m2		= <?php echo $data_unit->harga_tanah_m2; ?>;
			var harga_bangunan_m2	= <?php echo $data_unit->harga_bangunan_m2; ?>;
			var diskon_tanah		= ufm(diskon_tanah) / 100;
			var diskon_bangunan		= ufm(diskon_bangunan) / 100;
			var fs					= <?php echo $data_unit->fs; ?> / 100;
			var persen_tanda_jadi	= <?php echo $data_unit->persen_tanda_jadi; ?> / 100;
			var persen_uang_muka	= <?php echo $data_unit->persen_uang_muka; ?> / 100;
			var suku_bunga			= <?php echo $data_unit->suku_bunga; ?> / 100;
			
			var harga_tanah			= (luas_tanah * (harga_tanah_m2*(1 + fs)) * (1 - diskon_tanah));
			var harga_bangunan		= (luas_bangunan * harga_bangunan_m2) * (1 - diskon_bangunan);
			
			var harga_jual_exc_ppn	= harga_tanah + harga_bangunan;
			var ppn_tanah			= harga_tanah / 10;
			var ppn_bangunan		= harga_bangunan / 10;
			var total_ppn			= ppn_tanah + ppn_bangunan;
			
			var harga_jual_inc_ppn	= harga_jual_exc_ppn + total_ppn;
			var tanda_jadi			= harga_jual_inc_ppn * persen_tanda_jadi;
			var uang_muka			= harga_jual_inc_ppn * persen_uang_muka;
			
			var plafon_kpr			= harga_jual_inc_ppn - (tanda_jadi + uang_muka);
			var kpr_5_tahun			= PMT(suku_bunga / 12, 60, -plafon_kpr);
			var kpr_10_tahun		= PMT(suku_bunga / 12, 120, -plafon_kpr);
			var kpr_15_tahun		= PMT(suku_bunga / 12, 180, -plafon_kpr);
			
			$("#harga_tanah").html(fm(harga_tanah));
			$("#harga_bangunan").html(fm(harga_bangunan));
			
			$("#harga_jual_exc_ppn").html(fm(harga_jual_exc_ppn));
			$("#ppn_tanah").html(fm(ppn_tanah));
			$("#ppn_bangunan").html(fm(ppn_bangunan));
			$("#total_ppn").html(fm(total_ppn));
			
			$("#harga_jual_inc_ppn").html(fm(harga_jual_inc_ppn));
			$("#tanda_jadi").html(fm(tanda_jadi));
			$("#uang_muka").html(fm(uang_muka));
			$("#plafon_kpr").html(fm(plafon_kpr));
			
			$("#kpr_5_tahun").html(fm(kpr_5_tahun));
			$("#kpr_10_tahun").html(fm(kpr_10_tahun));
			$("#kpr_15_tahun").html(fm(kpr_15_tahun));
			
	}

</script>

<style type="text/css">
td { height:21px; }
</style>
<div class="margin_center" style="width:1000px">	
	<div class="header_data">Data Unit Detail</div>
	<div class="tombol_tambah">
	
		<a href="" onClick="javascript:list_data(<?php echo $posisi.", ".$show.", '".$key."'"; ?>); return false;"><input type="button" value="&laquo; Kembali"></a>
		<?php
		if ($this->access_lib->_if("adm"))
		{
			?>
			<a href="" onClick="javascript:edit(<?php echo $data_unit->id_unit.", ".$posisi.", ".$show.", '".$key."'"; ?>); return false;"><input type="button" value="Ubah"></a>
			<?php
		}
		?>
		<a href="" onClick="javascript:swap(); return false;"><input id="swap" type="button" value="Lihat Harga Promo"></a>
		
	</div>
	<div class="frame_tabel radius transparent" style="width:1000px">
			<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				<tr bgcolor="#FFFFFF">
					<td width="200" bgcolor="#999999" class="isi_tabel"><strong>Kategori</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->kategori; ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Cluster</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->nama_cluster; ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Type</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->nama_type." ".$data_unit->posisi; ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Kode Unit</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->kode_unit; ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Status Stok</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->status_unit; ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Luas Tanah</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->luas_tanah; ?> m&sup2;</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Luas Bangunan</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->luas_bangunan; ?> m&sup2;</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Harga Tanah/m2</strong></td>
					<td class="isi_tabel right"><?php echo number_format($data_unit->harga_tanah_m2, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Harga Bangunan/m2</strong></td>
					<td class="isi_tabel right"><?php echo number_format($data_unit->harga_bangunan_m2, 0); ?></td>
				</tr>

				<tr bgcolor="#0066FF">
					<td bgcolor="#0066FF" class="isi_tabel center" colspan="2"><font color="#FFFFFF">Diskon Promo</font></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#0066FF" class="isi_tabel"><font color="#FFFFFF">Diskon Tanah</font></td>
					<td class="isi_tabel right"><?php echo $data_unit->diskon_tanah; ?>%</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#0066FF" class="isi_tabel"><font color="#FFFFFF">Diskon Bangunan</font></td>
					<td class="isi_tabel right"><?php echo $data_unit->diskon_bangunan; ?>%</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Faktor Strategis</strong></td>
					<td class="isi_tabel right"><?php echo $data_unit->fs; ?>%</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Ket. Faktor Strategis</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->keterangan_fs; ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td width="200" bgcolor="#999999" class="isi_tabel"><strong>Harga Tanah</strong></td>
					<td class="isi_tabel right" id="harga_tanah"><?php echo number_format($data_unit->harga_tanah, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Harga Bangunan</strong></td>
					<td class="isi_tabel right" id="harga_bangunan"><?php echo number_format($data_unit->harga_bangunan, 0); ?></td>
				</tr>
			</table>
			
			<!-- Calculation -->
			
			<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				
				<tr bgcolor="#FFFFFF">
					<td width="200" bgcolor="#999999" class="isi_tabel"><strong>Harga Jual Exc. PPN</strong></td>
					<td class="isi_tabel right" id="harga_jual_exc_ppn"><?php echo number_format($data_unit->harga_jual_exc_ppn, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>PPN Tanah</strong></td>
					<td class="isi_tabel right" id="ppn_tanah"><?php echo number_format(round($data_unit->harga_tanah*0.1), 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>PPN Bangunan</strong></td>
					<td class="isi_tabel right" id="ppn_bangunan"><?php echo number_format(round($data_unit->harga_bangunan*0.1), 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Total PPN</strong></td>
					<td class="isi_tabel right" id="total_ppn"><?php echo number_format((round($data_unit->harga_tanah*0.1)+round($data_unit->harga_bangunan*0.1)), 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong></strong></td>
					<td class="isi_tabel"></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Harga Jual Inc. PPN</strong></td>
					<td class="isi_tabel right" id="harga_jual_inc_ppn"><?php echo number_format($data_unit->harga_jual_inc_ppn, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Tanda Jadi (<?php echo number_format(round($data_unit->persen_tanda_jadi, 2), 2); ?>%)</strong></td>
					<td class="isi_tabel right" id="tanda_jadi"><?php echo number_format($data_unit->tanda_jadi, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Uang Muka (<?php echo number_format(round($data_unit->persen_uang_muka, 2), 2); ?>%)</strong></td>
					<td class="isi_tabel right" id="uang_muka"><?php echo number_format($data_unit->uang_muka, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Plafon KPR</strong></td>
					<td class="isi_tabel right" id="plafon_kpr"><?php echo number_format($data_unit->plafon_kpr, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong></strong></td>
					<td class="isi_tabel"></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Asumsi Suku Bunga</strong></td>
					<td class="isi_tabel right"><?php echo $data_unit->suku_bunga; ?>%</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Angsuran 5 Tahun</strong></td>
					<td class="isi_tabel right" id="kpr_5_tahun"><?php echo number_format($data_unit->kpr_5_tahun, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Angsuran 10 Tahun</strong></td>
					<td class="isi_tabel right" id="kpr_10_tahun"><?php echo number_format($data_unit->kpr_10_tahun, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Angsuran 15 Tahun</strong></td>
					<td class="isi_tabel right" id="kpr_15_tahun"><?php echo number_format($data_unit->kpr_15_tahun, 0); ?></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong></strong></td>
					<td class="isi_tabel"></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" class="isi_tabel"><strong>Kelas Produk</strong></td>
					<td class="isi_tabel"><?php echo $data_unit->kelas_produk; ?></td>
				</tr>
				
			</table>
	</div>
	<div class="clear"></div>
</div>
	
