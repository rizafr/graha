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
		<div class="header_data">Form Kartu Keluarga</div>
		<div class="tombol_tambah"></div>
		<div class="frame_tabel radius transparent">

			<form name="form_anggota_keluarga" id="form_anggota_keluarga" method="post" enctype="multipart/form-data" action="<?php echo base_url(); ?>report/customer_anggota_keluarga_add" onSubmit="return validasi();">
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
								<input name="npwp" type="text" id="npwp" autocomplete="off" size="40">
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
								<input name="no_ktp" type="text" id="no_ktp" size="40" autocomplete="off">
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
						<td bgcolor="#999999" valign="top"><div class="isi_tabel">
						</div></td>
						<td><div class="isi_tabel" id="input_file">
							<div id="upload_area">
							</div>
						</div></td>
					</tr>	
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999">&nbsp;</td>
						<td colspan="3"><div class="isi_tabel">
							<input type="hidden" name="id_kartu_keluarga" id="id_kartu_keluarga" value="<?php echo $id_kartu_keluarga; ?>">
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
							<a href="<?php echo base_url(); ?>report/customer"><input type="button" value="Selesai &#10003;"></a>
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