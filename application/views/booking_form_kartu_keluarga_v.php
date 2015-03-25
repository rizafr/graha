<?php echo $header; ?>



<script type="text/javascript">
	
	function list_anggota_keluarga(id_kartu_keluarga){
		$("#nama_anggota_keluarga").val('');
		$("#tanggal_lahir").val('');
		$("#bulan_lahir").val('');
		$("#tahun_lahir").val('');
		$("#npwp").val('');
		$("#hubungan_keluarga").val('');
		$('#tabel_anggota_keluarga').load(base_url+'dashboard/booking/list_anggota_keluarga/'+id_kartu_keluarga);
	}
	
	function validasi(){
		var nama_anggota_keluarga 	= $("#nama_anggota_keluarga").val();
		var no_ktp 					= $("#no_ktp").val();
		var tanggal_lahir 			= $("#tanggal_lahir").val();
		var bulan_lahir				= $("#bulan_lahir").val();
		var tahun_lahir				= $("#tahun_lahir").val();		
		var	hubungan_keluarga		= $("#hubungan_keluarga").val();
		var	status_kawin			= $("#status_kawin").val();		
		
		if(nama_anggota_keluarga == "")
		{
			alert('Nama Anggota Keluarga tidak boleh kosong!');
			$("#nama_anggota_keluarga").focus();
			return false;
		}
		else if(no_ktp == "")
		{
			alert('No. KTP tidak boleh kosong!');
			$("#no_ktp").focus();
			return false;
		}
		else if(tanggal_lahir == "")
		{
			alert('Tanggal lahir tidak boleh kosong!');
			$("#tanggal_lahir").focus();
			return false;
		}
		else if(bulan_lahir == "")
		{
			alert('Bulan lahir tidak boleh kosong!');
			$("#bulan_lahir").focus();
			return false;
		}
		else if(tahun_lahir == "")
		{
			alert('Tahun lahir tidak boleh kosong!');
			$("#tahun_lahir").focus();
			return false;
		}		
		else if(hubungan_keluarga == "")
		{
			alert('Hubungan Keluarga tidak boleh kosong!');
			$("#hubungan_keluarga").focus();
			return false;
		}
		else if(status_kawin == "")
		{
			alert('Status Kawin tidak boleh kosong!');
			$("#status_kawin").focus();
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function hapus_data_anggota_keluarga(id_anggota_keluarga){
		$.post(base_url+'booking/delete_anggota_keluarga/'+id_anggota_keluarga, function(){
			$('#tbl_'+id_anggota_keluarga).fadeOut("Slow");
		});
	}

	
<?php
if ($status == "Promo")
{
?>
	
	$(document).ready(function(){
		
		auto();
	});
	
	function PMT(i, n, p)
	{
		return i * p * Math.pow((1 + i), n) / (1 - Math.pow((1 + i), n));
	}
	
	function auto(){
			
			var luas_tanah			= <?php echo $data_unit->luas_tanah; ?>;
			var luas_bangunan		= <?php echo $data_unit->luas_bangunan; ?>;
			var harga_tanah_m2		= <?php echo $data_unit->harga_tanah_m2; ?>;
			var harga_bangunan_m2	= <?php echo $data_unit->harga_bangunan_m2; ?>;
			var diskon_tanah		= <?php echo $pemesanan->diskon_tanah; ?> / 100;
			var diskon_bangunan		= <?php echo $pemesanan->diskon_bangunan; ?> / 100;
			
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
			
			$("#harga_jual_inc_ppn").html(fm(harga_jual_inc_ppn));
			$("#tanda_jadi").html(fm(tanda_jadi));
			$("#uang_muka").html(fm(uang_muka));
			$("#plafon_kpr").html(fm(plafon_kpr));
			
			$("#kpr_5_tahun").html(fm(kpr_5_tahun));
			$("#kpr_10_tahun").html(fm(kpr_10_tahun));
			$("#kpr_15_tahun").html(fm(kpr_15_tahun));
			
	}
	
<?php
}
?>
</script>

</head>
<body>

<?php
# Load profile
$this->load->view('top_profile_v');

# Load menu dashboard
$this->load->view('menu_v');
?>

<div id="frame_data">
	
	<div class="margin_center" style="width:1000px">
		<div class="header_data">Data Unit Dipesan</div>	
		<div class="frame_tabel radius transparent">	
			<table style="width:100%;" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Kategori</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Cluster</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Unit</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Type</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Status</div></td>
					<td rowspan="2" colspan="2"class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Luas (m&sup2;)</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Harga Jual Incl. PPN</div></td>
					<td colspan="6" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">KPR (Asumsi Suku Bunga <?php echo $data_unit->suku_bunga; ?>%)</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Tanda Jadi</div></td>
					<td rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Uang Muka</div></td>
					<td rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Plafon KPR</div></td>
					<td colspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Angsuran</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Tnh</div></td>
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Bang</div></td>
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">5 Tahun</div></td>
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">10 Tahun</div></td>
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">15 Tahun</div></td>
				</tr>
				</thead>		
				
				<tr class="hover">
					<td><div class="isi_tabel"> <?php echo $data_unit->kategori; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_unit->nama_cluster; ?> </div></td>
					<td><div class="isi_tabel nowrap"> <?php echo $data_unit->kode_unit; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_unit->nama_type." ".$data_unit->posisi; ?> </div></td>
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
					<td align="center"><div class="isi_tabel"> <?php echo $data_unit->luas_tanah; ?> </div></td>
					<td align="center"><div class="isi_tabel"> <?php echo $data_unit->luas_bangunan; ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->harga_jual_inc_ppn), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->tanda_jadi), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->uang_muka), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->plafon_kpr), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_5_tahun), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_10_tahun), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_15_tahun), 0); ?> </div></td>
				</tr>
				
				<?php
				if($status == "Promo")
				{
				?>
				
				<tr class="hover">
					<td colspan="7" class="header_tabel_cust">
						<div style="color:#FFF; text-align:right;"><b>Harga Setelah Diskon</b></div>
					</td>
					<td align="right"><div class="isi_tabel" id="harga_jual_inc_ppn"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="tanda_jadi"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="uang_muka"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="plafon_kpr"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="kpr_5_tahun"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="kpr_10_tahun"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="kpr_15_tahun"> 
						
					</div></td>
				</tr>
				
				<tr class="hover">
					<td class="header_tabel_cust">
						<div style="color:#FFF; text-align:center;">Promo</div>
					</td>
					<td colspan="13" align="left">
						<div class="isi_tabel"> 
							<?php echo "<strong>".$nama_promo."</strong><br />".$deskripsi; ?>
						</div>
					</td>
				</tr>
				
				<?php
				}
				?>
				
			</table>
		</div>
		<div class="clear" style="height:40px;"></div>
		
		<div class="header_data">Form Kartu Keluarga</div>
		<div class="tombol_tambah">
			<a href="<?php echo base_url(); ?>booking/form_pemesanan/edit/<?php echo $id_siteplan."/".$id_unit."/".$id_pemesanan; ?>"><input type="button" value="&laquo; Kembali"></a>
		</div>
		<div class="frame_tabel radius transparent">

			<form name="form_anggota_keluarga" id="form_anggota_keluarga" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>booking/add_anggota_keluarga" onSubmit="return validasi();">
				<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
					<tr bgcolor="#FFFFFF">
						<td colspan="4"><div class="header_tabel">Anggota Keluarga</div></td>
					</tr>	
					<tr bgcolor="#FFFFFF">
						<td width="20%" bgcolor="#999999"><div class="isi_tabel"><b>Nomor Kartu Keluarga</b></div></td>
						<td width="30%">
							<div class="isi_tabel"> <strong><?php echo $kartu_keluarga->no_kartu_keluarga; ?></strong> </div>
						</td>
						<td width="25%" bgcolor="#999999">
							<div class="isi_tabel">
								<b>NPWP</b>
							</div>
						</td>
						<td width="25%">
							<div class="isi_tabel">
								<input name="npwp" type="text" id="npwp" size="40">
							</div>
						</td>
					</tr>		
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999"><div class="isi_tabel"><b>Nama Lengkap<span class="required_star">*</span></b></div></td>
						<td>
							<div class="isi_tabel">
								<input name="nama_anggota_keluarga" type="text" id="nama_anggota_keluarga" size="40">
							</div>
						</td>
						<td bgcolor="#999999"><div class="isi_tabel">
							<b>Hubungan Keluarga<span class="required_star">*</span></b>
						</div></td>
						<td><div class="isi_tabel">
							<input name="hubungan_keluarga" type="text" id="hubungan_keluarga" size="40">
						</div></td>
					</tr>	
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999"><div class="isi_tabel"><b>No. KTP<span class="required_star">*</span></b></div></td>
						<td>
							<div class="isi_tabel">
								<input name="no_ktp" type="text" id="no_ktp" size="40">
							</div>
						</td>
						<td bgcolor="#999999"><div class="isi_tabel">
							<b>Status Kawin<span class="required_star">*</span></b>
						</div></td>
						<td><div class="isi_tabel">
							<select name="status_kawin" id="status_kawin">
								<option value="">Pilih Status</option>
								<?php
									$data_status = array("Kawin", "Belum Kawin", "Divorce");

									foreach ($data_status as $status) 
									{
									?>
									
									<option value="<?php echo $status; ?>"><?php echo $status; ?></option>
									
									<?php
									}
									?>

							</select>
						</div></td>
					</tr>		
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999" valign="top"><div class="isi_tabel"><b>Tanggal Lahir<span class="required_star">*</span></b></div></td>
						<td valign="top">
							<div class="isi_tabel">
								<select name="tanggal_lahir" id="tanggal_lahir">
									<option value="">Tanggal</option>
															
									<?php
									for($i=1; $i<=31; $i++){										
									?>
									
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>									
									
									<?										
									}
									?>		
												
								</select>
								<select name="bulan_lahir" id="bulan_lahir">
									<option value="">Bulan</option>
									
									<?php
									$bulan = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September",
												   "Oktober", "November", "Desember");
									$bln_angka = 0;
									foreach($bulan as $data_bulan)
									{
										$bln_angka++;										
									?>
									
									<option value="<?php echo $bln_angka; ?>"> <?php echo $data_bulan?> </option>
																		
									<?php									
									}
									?>
									
								</select>
								<select name="tahun_lahir" id="tahun_lahir">
									<option value="">Tahun</option>
									
									<?php
									for($i= date('Y'); $i > 1940; $i--){										
									?>
									
									<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
									
									<?									
									}
									?>
									
								</select>
							</div>
						</td>
						<td bgcolor="#999999" valign="top">
							<div class="isi_tabel">&nbsp;</div>
						</td>
						<td>
							<div class="isi_tabel" id="input_file">&nbsp;
							</div>
						</td>
					</tr>	
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999">&nbsp;</td>
						<td colspan="3"><div class="isi_tabel">
							<input type="hidden" name="id_siteplan" id="id_siteplan" value="<?php echo $id_siteplan; ?>">
							<input type="hidden" name="id_unit" id="id_unit" value="<?php echo $id_unit; ?>">
							<input type="hidden" name="id_kartu_keluarga" id="id_kartu_keluarga" value="<?php echo $id_kartu_keluarga; ?>">
							<input type="hidden" name="id_pemesanan" id="id_pemesanan" value="<?php echo $id_pemesanan; ?>">
							<input type="submit" value="Tambahkan &#43;">
						</div></td>
					</tr>
				</table>
			</form>
			
			<div id="tabel_anggota_keluarga">
				<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
					<tr bgcolor="#FFFFFF">
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Nama Anggota Keluarga</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">No. KTP</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Tanggal Lahir</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">NPWP</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Hubungan Keluarga</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Status Kawin</div></td>						
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">&nbsp;</div></td>
					</tr>

					<?php
					foreach($anggota_keluarga as $data_anggota)
					{
					?>

					<tr bgcolor="#FFFFFF" id="tbl_<?php echo $data_anggota->id_anggota_keluarga; ?>">
						<td><div class="isi_tabel"><?php echo  $data_anggota->nama_lengkap; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->no_ktp; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->tanggal_lahir."/".$data_anggota->bulan_lahir."/".$data_anggota->tahun_lahir; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->npwp; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->hubungan_keluarga; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->status_nikah; ?></div></td>
						<td>
							<div class="isi_tabel">
								<a href="#" onClick="javascript:hapus_data_anggota_keluarga(<?php echo $data_anggota->id_anggota_keluarga; ?>); return false;">
									<img src="<?php echo base_url(); ?>files/images/delete.png">
								</a>
							</div>
						</td>
					</tr>

					<?php
					}
					?>

				</table>
			</div>
			
			<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td colspan="5" align="right">
						<div style="padding:3px;">							
							<a href="<?php echo base_url(); ?>booking/pemesanan_detail/<?php echo $id_siteplan."/".$id_unit."/".$id_kartu_keluarga."/".$id_pemesanan; ?>"><input type="button" value="Berikutnya &raquo;"></a>
						</div>
					</td>
				</tr>
			</table>

		</div>
	</div>
	<div class="clear" style="height:40px;"></div>
</div>

</body>
</html>