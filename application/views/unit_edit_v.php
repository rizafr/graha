<?php require("fungsi_kode.php"); ?>

<script type="text/javascript">
	
	$(document).ready(function(){
	
		$("#id_cluster").change(function(){
		
			$('#id_type').html('<option value=""> -- Pilih Type -- </option>');
			$('#kode_blok').html('<option value=""> -- Pilih Blok -- </option>');
			var kode_cluster = $('option:selected', this).attr("data-kode-cluster");
			$("#kode_cluster").val(kode_cluster);
			
			var id_cluster = $(this).val();
			
			if(id_cluster != "" )
			{
				$.ajax({
					type: "POST",
					url: "<?php echo base_url(); ?>ajax/list_option_type/"+id_cluster,
					success: function(result) {
						$('#id_type').html(result);
					}
				});
			}
		});
		
		$("#id_type").change(function(){
		
			$('#kode_blok').html('<option value=""> -- Pilih Blok -- </option>');
			var kode_blok = $('option:selected', this).attr("data-kode-blok");
			
			if(kode_blok != "" )
			{
				var opt = '<option value=""> -- Pilih Blok -- </option>';
				kode_blok = kode_blok.split(",");
				
				for(var i = 0; i < kode_blok.length; ++i)
				{
					opt += '<option value="'+kode_blok[i]+'"> '+kode_blok[i]+' </option>';
				}
				
				$('#kode_blok').html(opt);
			}
		});
		
	});
	
	function PMT(i, n, p)
	{
		return i * p * Math.pow((1 + i), n) / (1 - Math.pow((1 + i), n));
	}
	
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			return false;
		}
		
		return true;
	}
	
	function isDescimalKey(id)
	{
		var val = ufm($(id).val());
		if(isNaN(val))
		{
			$(id).val("0.00");
		}
		else
		{
			$(id).val(fm2(val));
		}
		
		auto(0, 0);
	}
	
	function isPercentKey(id)
	{
		var val = ufm($(id).val());
		if(isNaN(val) || val > 100 || val < 0)
		{
			$(id).val("0.00");
		}
		else
		{
			$(id).val(fm2(val));
		}
		
		auto(0, 0);
	}
	
	function isPercentKeyTj()
	{
		var val = ufm($("#persen_tanda_jadi").val());
		if(isNaN(val) || val > 100 || val < 0)
		{
			$("#persen_tanda_jadi").val("0.00");
		}
		else
		{
			$("#persen_tanda_jadi").val(fm10(val));
		}
		
		var harga_jual_inc_ppn = ufm($("#harga_jual_inc_ppn").val());
		var tanda_jadi = harga_jual_inc_ppn*val/100;
		$("#tanda_jadi").val(fm(tanda_jadi));
		
		auto(0, 0);
	}
	
	function isPercentKeyUm()
	{
		var val = ufm($("#persen_uang_muka").val());
		if(isNaN(val) || val > 100 || val < 0)
		{
			$("#persen_uang_muka").val("0.00");
		}
		else
		{
			$("#persen_uang_muka").val(fm10(val));
		}
		
		var harga_jual_inc_ppn = ufm($("#harga_jual_inc_ppn").val());
		var uang_muka = harga_jual_inc_ppn*val/100;
		$("#uang_muka").val(fm(uang_muka));
		
		auto(0, 0);
	}
	
	function tanda_jadi_auto()
	{
		var tanda_jadi = ufm($("#tanda_jadi").val());
		var harga_jual_inc_ppn = ufm($("#harga_jual_inc_ppn").val());
		var persen_tanda_jadi = (tanda_jadi/harga_jual_inc_ppn)*100;
		$("#persen_tanda_jadi").val(fm10(persen_tanda_jadi));
		
		auto(0, 0);
	}
	
	function uang_muka_auto()
	{
		var uang_muka = ufm($("#uang_muka").val());
		var harga_jual_inc_ppn = ufm($("#harga_jual_inc_ppn").val());
		var persen_uang_muka = (uang_muka/harga_jual_inc_ppn)*100;
		$("#persen_uang_muka").val(fm10(persen_uang_muka));
		
		auto(0, 0);
	}
	
	function auto(diskon_tanah, diskon_bangunan){
			
			var luas_tanah			= ufm($("#luas_tanah").val());
			var luas_bangunan		= ufm($("#luas_bangunan").val());
			var harga_tanah_m2		= ufm($("#harga_tanah_m2").val());
			var harga_bangunan_m2	= ufm($("#harga_bangunan_m2").val());
			var diskon_tanah		= ufm(diskon_tanah) / 100;
			var diskon_bangunan		= ufm(diskon_bangunan) / 100;
			var fs					= ufm($("#fs").val()) / 100;
			var tanda_jadi			= ufm($("#tanda_jadi").val());
			var uang_muka			= ufm($("#uang_muka").val());
			var suku_bunga			= ufm($("#suku_bunga").val()) / 100;
			
			var harga_tanah			= (luas_tanah * (harga_tanah_m2*(1 + fs)) * (1 - diskon_tanah));
			var harga_bangunan		= (luas_bangunan * harga_bangunan_m2) * (1 - diskon_bangunan);
			
			var harga_jual_exc_ppn	= harga_tanah + harga_bangunan;
			var ppn_tanah			= harga_tanah / 10;
			var ppn_bangunan		= harga_bangunan / 10;
			var total_ppn			= ppn_tanah + ppn_bangunan;
			
			var harga_jual_inc_ppn	= harga_jual_exc_ppn + total_ppn;
			var persen_tanda_jadi	= (tanda_jadi / harga_jual_inc_ppn) * 100;
			var persen_uang_muka	= (uang_muka / harga_jual_inc_ppn) * 100;
			
			var plafon_kpr			= harga_jual_inc_ppn - (tanda_jadi + uang_muka);
			var kpr_5_tahun			= PMT(suku_bunga / 12, 60, -plafon_kpr);
			var kpr_10_tahun		= PMT(suku_bunga / 12, 120, -plafon_kpr);
			var kpr_15_tahun		= PMT(suku_bunga / 12, 180, -plafon_kpr);
			
			$("#harga_tanah_m2").val(fm(harga_tanah_m2));
			$("#harga_bangunan_m2").val(fm(harga_bangunan_m2));
			$("#harga_tanah").val(fm(harga_tanah));
			$("#harga_bangunan").val(fm(harga_bangunan));
			
			$("#harga_jual_exc_ppn").val(fm(harga_jual_exc_ppn));
			$("#ppn_tanah").val(fm(ppn_tanah));
			$("#ppn_bangunan").val(fm(ppn_bangunan));
			$("#total_ppn").val(fm(total_ppn));
			
			$("#harga_jual_inc_ppn").val(fm(harga_jual_inc_ppn));
			$("#tanda_jadi").val(fm(tanda_jadi));
			$("#persen_uang_muka").val(fm10(persen_uang_muka));
			$("#uang_muka").val(fm(uang_muka));
			$("#persen_tanda_jadi").val(fm10(persen_tanda_jadi));
			$("#plafon_kpr").val(fm(plafon_kpr));
			
			$("#kpr_5_tahun").val(fm(kpr_5_tahun));
			$("#kpr_10_tahun").val(fm(kpr_10_tahun));
			$("#kpr_15_tahun").val(fm(kpr_15_tahun));
			
			var kelas_produk = "-";
			var kategori = $("#kategori").val();
			
			if (kategori == ""){}
			else if (kategori == "RUKO"){ kelas_produk = "RUKO"; }
			else if (harga_jual_exc_ppn < 200000000) { kelas_produk = "ML"; }
			else if (200000000 <= harga_jual_exc_ppn && harga_jual_exc_ppn < 300000000) { kelas_produk = "M"; }
			else if (300000000 <= harga_jual_exc_ppn && harga_jual_exc_ppn < 750000000) { kelas_produk = "MH"; }
			else if (750000000 <= harga_jual_exc_ppn && harga_jual_exc_ppn < 2000000000) { kelas_produk = "HM"; }
			else { kelas_produk = "HH"; }
			
			$("#kelas_produk").val(kelas_produk);
	}

</script>
<style type="text/css">
td { height:30px; }
</style>
<div class="margin_center" style="width:1000px">	
	<div class="header_data">Ubah Data Unit</div>
	<ul class="msg">
		<?php echo validation_errors('<li>', '</li>'); ?>
		<?php echo $this->session->flashdata('msg'); ?>
		<?php echo $msg; ?>
	</ul>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:list_data(<?php echo $posisi.", ".$show.", '".$key."'"; ?>); return false;">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="frame_tabel radius transparent" style="width:1000px">
		<form name="form_edit" id="form_edit" method="post" action="<?php echo $action; ?>">
			<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				<tr bgcolor="#FFFFFF">
					<td width="200" bgcolor="#999999"><div class="isi_tabel"><strong>Kategori<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<select name="kategori" id="kategori">
								<option value=""> -- Pilih Kategori -- </option>
	
								<?php
								$sel = '';
								foreach($list_kategori as $data_kategori)
								{
									if($data_kategori == $data_unit->kategori)
									{
										$sel = 'selected="true"';
									}
									
									echo '<option value="'.$data_kategori.'" '.$sel.'>'.$data_kategori.'</option>';
									
									$sel = '';
								}
								?>
							</select>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Cluster<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<select name="id_cluster" id="id_cluster">
								<option value="" data-kode-cluster=""> -- Pilih Cluster -- </option>
	
								<?php
								$sel = '';
								foreach($cluster as $data_cluster)
								{
									if($data_cluster->id_cluster == $data_unit->id_cluster)
									{
										$sel = 'selected="true"';
									}
									
									echo '<option value="'.$data_cluster->id_cluster.'" data-kode-cluster="'.$data_cluster->kode_cluster.'" '.$sel.'>'.$data_cluster->nama_cluster.'</option>';
									
									$sel = '';
								}
								?>
							</select>
							
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Type<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<select name="id_type" id="id_type">
								<option value=""> -- Pilih Type -- </option>
	
								<?php
								$blok = '';
								$sel = '';
								foreach($type as $data_type)
								{
									if($data_type->id_type == $data_unit->id_type)
									{
										$sel = 'selected="true"';
										$blok = $data_type->kode_blok;
									}
									
									echo '<option value="'.$data_type->id_type.'" data-kode-blok="'.$data_type->kode_blok.'" '.$sel.'>'.$data_type->nama_type.'</option>';
									
									$sel = '';
								}
								?>
							</select>
							
							<select name="posisi" id="posisi">
								<?php
								$sel = '';
								foreach($list_posisi as $val)
								{
									if($data_unit->posisi == $val)
									{
										$sel = 'selected="true"';
									}
									
									echo '<option value="'.$val.'" '.$sel.'>'.$val.'</option>';
									
									$sel = '';
								}
								?>
							</select>
						</div>
					</td>
				</tr>
				
				<?php
				$kode = kode_unit($data_unit->kode_unit);
				$kode_cluster = $kode["cluster"];
				$kode_blok = $kode["blok"];
				$nomor = $kode["nomor"];
				
				?>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Kode Unit<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="kode_cluster" id="kode_cluster" size="8" value="<?php echo $kode_cluster; ?>" placeholder="Kd. Cluster" style="text-align:center;">
							 / 
							<select name="kode_blok" id="kode_blok">
								<option value=""> -- Pilih Blok -- </option>
								<?php
								$blok = explode(",", $blok);
								$sel = '';
								foreach($blok as $data_blok)
								{
									if($data_blok == $kode_blok)
									{
										$sel = 'selected="true"';
									}
									
									echo '<option value="'.$data_blok.'" '.$sel.'>'.$data_blok.'</option>';
									
									$sel = '';
								}
								?>
							</select>
							 - 
							<input type="text" name="nomor" id="nomor" size="5" value="<?php echo $nomor; ?>" placeholder="Nomor" style="text-align:center;">
							
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Status Stok<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<select name="status_unit" id="status_unit">
								<?php
								$sel = '';
								foreach($list_status_unit as $data_status_unit)
								{
									if($data_status_unit == $data_unit->status_unit)
									{
										$sel = 'selected="true"';
									}
									
									echo '<option value="'.$data_status_unit.'" '.$sel.'>'.$data_status_unit.'</option>';
									
									$sel = '';
								}
								?>
							</select>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Luas Tanah<span class="required_star">*</span></strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="luas_tanah" id="luas_tanah" size="10" value="<?php echo number_format($data_unit->luas_tanah, 2, ".", ","); ?>" style="text-align:right;" onBlur="return isDescimalKey('#luas_tanah')"> m&sup2;
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Luas Bangunan<span class="required_star">*</span></strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="luas_bangunan" id="luas_bangunan" size="10" value="<?php echo number_format($data_unit->luas_bangunan, 2, ".", ","); ?>" style="text-align:right;" onBlur="return isDescimalKey('#luas_bangunan')"> m&sup2;
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Harga Tanah/m2<span class="required_star">*</span></strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="harga_tanah_m2" id="harga_tanah_m2" size="30" value="<?php echo number_format($data_unit->harga_tanah_m2, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" onblur="auto(0, 0)">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Harga Bangunan/m2<span class="required_star">*</span></strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="harga_bangunan_m2" id="harga_bangunan_m2" size="30" value="<?php echo number_format($data_unit->harga_bangunan_m2, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" onblur="auto(0, 0)">
					</div></td>
				</tr>

				<tr bgcolor="#0066FF">
					<td bgcolor="#0066FF" colspan="2"><div class="isi_tabel center"><font color="#FFFFFF">Diskon Promo</font></td>
				</div></td>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#0066FF"><div class="isi_tabel"><font color="#FFFFFF">Diskon Tanah</font></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="diskon_tanah" id="diskon_tanah" size="5" value="<?php echo $data_unit->diskon_tanah; ?>" style="text-align:right;" onBlur="return isPercentKey(this)"> %
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#0066FF"><div class="isi_tabel"><font color="#FFFFFF">Diskon Bangunan</font></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="diskon_bangunan" id="diskon_bangunan" size="5" value="<?php echo $data_unit->diskon_bangunan; ?>" style="text-align:right;" onBlur="return isPercentKey(this)"> %
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Faktor Strategis</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="fs" id="fs" size="5" value="<?php echo $data_unit->fs; ?>" style="text-align:right;"  onBlur="return isPercentKey(this)"> %
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Ket. Faktor Strategis</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="keterangan_fs" id="keterangan_fs" size="60" value="<?php echo $data_unit->keterangan_fs; ?>">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Harga Tanah</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="harga_tanah" id="harga_tanah" size="30" value="<?php echo number_format($data_unit->harga_tanah, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Harga Bangunan</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="harga_bangunan" id="harga_bangunan" size="30" value="<?php echo number_format($data_unit->harga_bangunan, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
			</table>
			
			<!-- Calculation -->
			
			<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Harga Jual Exc. PPN</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="harga_jual_exc_ppn" id="harga_jual_exc_ppn" size="30" value="<?php echo number_format($data_unit->harga_jual_exc_ppn, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>PPN Tanah</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="ppn_tanah" id="ppn_tanah" size="30" value="<?php echo number_format(round($data_unit->harga_tanah/10), 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>PPN Bangunan</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="ppn_bangunan" id="ppn_bangunan" size="30" value="<?php echo number_format(round($data_unit->harga_bangunan/10), 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Total PPN</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="total_ppn" id="total_ppn" size="30" value="<?php echo number_format((round($data_unit->harga_tanah/10) + round($data_unit->harga_bangunan/10)), 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong></strong></div></td>
					<td><div class="isi_tabel"></div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Harga Jual Inc. PPN</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="harga_jual_inc_ppn" id="harga_jual_inc_ppn" size="30" value="<?php echo number_format($data_unit->harga_jual_inc_ppn, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanda Jadi<span class="required_star">*</span></strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="tanda_jadi" id="tanda_jadi" size="30" value="<?php echo number_format($data_unit->tanda_jadi, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" onBlur="return tanda_jadi_auto()">&nbsp;
						<input type="text" name="persen_tanda_jadi" id="persen_tanda_jadi" size="15" value="<?php echo $data_unit->persen_tanda_jadi; ?>" style="text-align:right;" onBlur="return isPercentKeyTj()"> %
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					</td><td bgcolor="#999999"><div class="isi_tabel"><strong>Uang Muka<span class="required_star">*</span></strong></div>
					</td><td><div class="isi_tabel">
						<input type="text" name="uang_muka" id="uang_muka" size="30" value="<?php echo number_format($data_unit->uang_muka, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" onBlur="return uang_muka_auto()">&nbsp;
						<input type="text" name="persen_uang_muka" id="persen_uang_muka" size="15" value="<?php echo $data_unit->persen_uang_muka; ?>" style="text-align:right;" onBlur="return isPercentKeyUm()"> %
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Plafon KPR</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="plafon_kpr" id="plafon_kpr" size="30" value="<?php echo number_format($data_unit->plafon_kpr, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong></strong></div></td>
					<td><div class="isi_tabel"></div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Asumsi Suku Bunga</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="suku_bunga" id="suku_bunga" size="5" value="<?php echo $data_unit->suku_bunga; ?>" style="text-align:right;" onBlur="return isPercentKey(this)"> %
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Angsuran 5 Tahun</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="kpr_5_tahun" id="kpr_5_tahun" size="30" value="<?php echo number_format($data_unit->kpr_5_tahun, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Angsuran 10 Tahun</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="kpr_10_tahun" id="kpr_10_tahun" size="30" value="<?php echo number_format($data_unit->kpr_10_tahun, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Angsuran 15 Tahun</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="kpr_15_tahun" id="kpr_15_tahun" size="30" value="<?php echo number_format($data_unit->kpr_15_tahun, 0); ?>" style="text-align:right;" onkeypress="return isNumberKey(event)" readonly="readonly">
					</div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong></strong></div></td>
					<td><div class="isi_tabel"></div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Kelas Produk</strong></div></td>
					<td><div class="isi_tabel">
						<input type="text" name="kelas_produk" id="kelas_produk" size="5" value="<?php echo $data_unit->kelas_produk;; ?>" style="text-align:center;" readonly="readonly">
					</div></td>
				</tr>
			</table>
			
			
			<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				<tr bgcolor="#FFFFFF">
					<td align="right" style="padding-top:5px;">
						<div class="isi_tabel">
							<span class="required_star" style="float:left;margin-top:5px;">* Harus Diisi</span>
							<input type="submit" name="simpan" value="Simpan &#10003;" onClick="javascript:post_edit(<?php echo $data_unit->id_unit.", ".$posisi.", ".$show.", '".$key."'"; ?>); return false;">
						</div>
					</td>
				</tr>
			</table>
			
		</form>
	</div>
	
	<div class="clear"></div>
	<br />
</div>
<br />