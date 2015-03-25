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
			<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="70" rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Kategori</div></td>
					<td width="100" rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Unit</div></td>
					<td width="100" rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Type</div></td>
					<td width="60" rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Status</div></td>
					<td rowspan="2" colspan="2"class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Luas (M2)</div></td>
					<td width="150" rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Harga Jual Incl. PPN</div></td>
					<td colspan="6" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">KPR (Asumsi Suku Bunga 7.25%)</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="70" rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Tanda Jadi</div></td>
					<td width="70" rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Uang Muka</div></td>
					<td width="70" rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Plafon KPR</div></td>
					<td width="70" colspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Angsuran</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="40" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Tanah</div></td>
					<td width="40" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Bangunan</div></td>
					<td width="70" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">5 Tahun</div></td>
					<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">10 Tahun</div></td>
					<td width="" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">15 Tahun</div></td>
				</tr>			
				
				<tr class="hover">
					<td><div class="isi_tabel"> <?php echo $data_unit->kategori; ?> </div></td>
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
			</table>
		</div>
		<div class="clear" style="height:40px;"></div>
		
		<div class="header_data">Form Kartu Keluarga</div>
		<div class="tombol_tambah">			
			<a href="<?php echo base_url(); ?>report/regular_form/<?php echo $id_unit."/".$id_kartu_keluarga."/".$id_pemesanan; ?>"><input type="button" value="&laquo; Kembali"></a>
		</div>
		<div class="frame_tabel radius transparent">

			<form name="form_anggota_keluarga" id="form_anggota_keluarga" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>report/regular_anggota_keluarga_add" onSubmit="return validasi();">
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
						<td bgcolor="#999999" valign="top">&nbsp;</td>
						<td>&nbsp;</td>
					</tr>	
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999">&nbsp;</td>
						<td colspan="3"><div class="isi_tabel">
							<input type="hidden" name="id_unit" id="id_unit" value="<?php echo $id_unit; ?>">
							<input type="hidden" name="id_kartu_keluarga" id="id_kartu_keluarga" value="<?php echo $id_kartu_keluarga; ?>">
							<input type="hidden" name="id_pemesanan" id="id_pemesanan" value="<?php echo $id_pemesanan; ?>">
							<input type="submit" value="Tambahkan &#10003;">
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
							<a href="<?php echo base_url(); ?>report/regular_preview/<?php echo $id_unit."/".$id_kartu_keluarga."/".$id_pemesanan; ?>"><input type="button" value="Berikutnya &raquo;"></a>
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