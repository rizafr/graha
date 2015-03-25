<?php
$disabled = '';
if (!$this->access_lib->_if("adm,mgr,ksr"))
{
	$disabled = 'disabled="disabled"';
}
?>
<?php include "fungsi_tanggal.php"; ?>
<?php echo $header; ?>


<script type="text/javascript">

$(document).ready(function()
{
	var cssObj = { 'box-shadow' : '#888 5px 10px 10px',
		'-webkit-box-shadow' : '#888 5px 10px 10px', 
		'-moz-box-shadow' : '#888 5px 10px 10px'};
	$("#suggestions").css(cssObj);
	
	 $("input").blur(function(){
	 	$('#suggestions').fadeOut();
	 });
});

function lookup(inputString) {
	if(inputString.length == 0) {
		$('#suggestions').fadeOut(); 
	} else {
		$.post("<?php echo base_url(); ?>booking/get_data_by_no_ktp/"+inputString, function(data) { 
			$('#suggestions').fadeIn(); 
			$('#suggestions').html(data); 
		});
	}
}

function select_suggest(id)
{
	$('#suggestions').fadeOut();
	$.post(base_url+'booking/get_data_customer/'+id, function(data){
		var obj = JSON.parse(data);
		
		$('#nama_lengkap').val(obj[0].nama_lengkap);
		$('#no_ktp').val(obj[0].no_ktp);
		$('#no_npwp').val(obj[0].no_npwp);
		$('#alamat_npwp').val(obj[0].alamat_npwp);
		$('#telpon').val(obj[0].telpon);
		$('#hp').val(obj[0].hp);
		$('#email').val(obj[0].email);
		$('#alamat_ktp').val(obj[0].alamat_ktp);
		$('#alamat_surat_menyurat').val(obj[0].alamat_surat_menyurat);
		$('#no_kartu_keluarga').val(obj[0].no_kartu_keluarga);
	});
}

function validasi()
{
	var nama_lengkap		= $('#nama_lengkap').val();
	var no_ktp				= $('#no_ktp').val();
	var no_npwp				= $('#no_npwp').val();
	var telpon				= $('#telpon').val();
	var hp					= $('#hp').val();
	var email				= $('#email').val();
	var cara_pembayaran		= $('#cara_pembayaran').val();
	var booking_fee			= $('#booking_fee').val();
	var ktp 				= $('#doc_ktp').val();
	
	if(nama_lengkap == "")
	{
		alert("Nama Lengkap harus diisi !");
		$('#nama_lengkap').focus();
		return false;
	}
	else if(no_ktp == "")
	{
		alert("No KTP harus diisi !");
		$('#no_ktp').focus();
		return false;
	}
	else if(no_npwp == "")
	{
		alert("No NPWP harus diisi !");
		$('#no_npwp').focus();
		return false;
	}
	else if(telpon == "")
	{
		alert("No. Telpon harus diisi !");
		$('#telpon').focus();
		return false;
	}
	else if(hp == "")
	{
		alert("Nomor HP harus diisi !");
		$('#hp').focus();
		return false;
	}
	else if(cara_pembayaran == "")
	{
		alert("Cara Pembayaran harus diisi !");
		$('#cara_pembayaran').focus();
		return false;
	}
	else if(booking_fee == "")
	{
		alert("Booking-Fee harus diisi !");
		$('#booking_fee').focus();
		return false;
	}
	else if(isNaN($('#no_ktp').val() / 1) == true)
	{
		alert("No. KTP harus numerik !");
		$('#no_ktp').focus();
		return false;
	}
	else if(isNaN($('#booking_fee').val() / 1) == true)
	{
		alert("Booking-Fee harus numerik !");
		$('#booking_fee').focus();
		return false;
	}
	else if(booking_fee < 5000000)
	{
		alert("Minimal Booking-Fee Rp. 5.000.000 !");
		$('#booking_fee').focus();
		return false;
	}
	else if(email != "")
	{
		if(!isValidEmailAddress(email)) 
		{
			alert("Format email yang anda masukkan tidak valid !");
			$('#email').focus();
			return false;
		}
	}
	else
	{
		return true;
	}
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    return pattern.test(emailAddress);
};

function add_input_file()
{
	$('#upload_area').append("<input type='file' name='doc[]' accept='image/*'>")
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

</script>

<style type="text/css">
#suggestions
{
	position: absolute;
}
#list_suggestion
{
	width: 250px;
	background-color: #FFF;
	cursor: pointer;
}
#list_suggestion:hover
{
	background-color: #CAE4FA;
}
.suggestion_name
{
	padding: 5px 5px 0 5px; 
	font-size: 12px; 
	color:#0B77D6; 
}
.suggestion_number
{
	padding: 3px 5px 5px 5px; 
	font-size:11px; 
	border-bottom: 1px #DDD solid; 
}

</style>

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
			<table width="100%" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
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
		
		<div class="header_data">Form Pemesanan</div>
		<div class="tombol_tambah">
			<a href="<?php echo base_url(); ?>report/regular"><input type="button" value="&laquo; Kembali"></a>
		</div>
		
		<style type="text/css">
			#td-height td { height:32px; }
		</style>

		<div class="frame_tabel radius transparent" style="width:1000px" id="td-height">
		<form action="<?php echo base_url(); ?>report/regular_edit" method="post" enctype="multipart/form-data" name="pemesanan" onSubmit="return validasi();">
			
			<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#0066FF"><div class="header_tabel">Data Pemesan</div></td>
				</tr>
			</table>
			
			<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				<tr bgcolor="#FFFFFF">
					<td width="200" bgcolor="#999999"><div class="isi_tabel"><strong>Nama Lengkap<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="nama_lengkap" id="nama_lengkap" size="40" value="<?php echo $customer->nama_lengkap; ?>">
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>No. KTP<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="no_ktp" id="no_ktp" size="40" onkeyup="lookup(this.value);" autocomplete="off" value="<?php echo $customer->no_ktp; ?>">
							<div id="suggestions"></div>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>No. Kartu Keluarga</strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="no_kartu_keluarga" id="no_kartu_keluarga" size="40" value="<?php echo $kartu_keluarga->no_kartu_keluarga; ?>">
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>No. NPWP<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="no_npwp" id="no_npwp" size="40" value="<?php echo $customer->no_npwp; ?>">
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Telpon<strong><span class="required_star">*</span></strong></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="telpon" id="telpon" size="40" value="<?php echo $customer->telpon; ?>">
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>HP<strong><span class="required_star">*</span></strong></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="hp" id="hp" size="40" value="<?php echo $customer->hp; ?>">
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Email</strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="email" id="email" size="40" value="<?php echo $customer->email; ?>">
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td style="height:65px;" valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Alamat Surat Menyurat</strong></div></td>
					<td valign="top">
						<div class="isi_tabel">
							<textarea name="alamat_surat_menyurat" id="alamat_surat_menyurat" cols="40" rows="2" style="width: 245px; height: 48px;"><?php echo $customer->alamat_surat_menyurat; ?></textarea>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td style="height:65px;" valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Alamat KTP<span class="required_star"></span></strong></div></td>
					<td valign="top">
						<div class="isi_tabel">
							<textarea name="alamat_ktp" id="alamat_ktp" cols="40" rows="2" style="width: 245px; height: 48px;"><?php echo $customer->alamat_ktp; ?></textarea> 
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td style="height:65px;" valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Alamat NPWP<span class="required_star"></span></strong></div></td>
					<td valign="top">
						<div class="isi_tabel">
							<textarea name="alamat_npwp" id="alamat_npwp" cols="40" rows="2" style="width: 245px; height: 48px;"><?php echo $customer->alamat_npwp; ?></textarea>
						</div>
					</td>
				</tr>
			</table>
			
			<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">				
				<tr bgcolor="#FFFFFF">
					<td width="200" bgcolor="#999999"><div class="isi_tabel"><strong></strong><strong>Cara Pembayaran<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<select name="cara_pembayaran" id="cara_pembayaran">
								<option value="">Pilih Cara Pembayaran</option>
									<?php			
									foreach($data_cara_pembayaran as $data_pembayaran)
									{
										if($data_pembayaran->cara_pembayaran == $pemesanan->cara_pembayaran)
										{
											?>
											<option value="<?php echo $data_pembayaran->cara_pembayaran; ?>" Selected><?php echo $data_pembayaran->cara_pembayaran; ?>x</option>
											<?php
										}
										else
										{
											?>
											<option value="<?php echo $data_pembayaran->cara_pembayaran; ?>"><?php echo $data_pembayaran->cara_pembayaran; ?>x</option>
											<?php
										}
									}
									?>
							</select>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Booking Fee<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="booking_fee" id="booking_fee" size="20" value="<?php echo $pemesanan->booking_fee; ?>" style="text-align:right;">
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Status Pemesanan</strong></div></td>
					<td>
						<div class="isi_tabel">
							<select name="status_pemesanan" id="status_pemesanan" <?php echo $disabled; ?>>
								
								<?php								
								$data_status = array("Booked", "Tanda Jadi", "Sold");

								foreach($data_status as $data_status_pembayaran)
								{
									if($data_status_pembayaran == $pemesanan->status_pemesanan)
									{
										?>
										<option value="<?php echo $data_status_pembayaran; ?>" Selected><?php echo $data_status_pembayaran; ?></option>
										<?php
									}
									else
									{
										?>
										<option value="<?php echo $data_status_pembayaran; ?>"><?php echo $data_status_pembayaran; ?></option>
										<?php
									}
								}
								?>
							
							</select>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Timeout<span class="required_star"></span></strong></td>
					<td>
						<div class="isi_tabel">
							<?php $dhm = dhm($pemesanan->timeout); ?>
							<input name="hari" type="text" id="hari" size="1" value="<?php echo $dhm['hari']; ?>" style="text-align:center;" onkeypress="return isNumberKey(event)" <?php echo $disabled; ?>> Hari
							<input name="jam" type="text" id="jam" size="1" value="<?php echo $dhm['jam']; ?>" style="text-align:center;" onkeypress="return isNumberKey(event)" <?php echo $disabled; ?>> Jam
							<input name="menit" type="text" id="menit" size="1" value="<?php echo $dhm['menit']; ?>" style="text-align:center;" onkeypress="return isNumberKey(event)" <?php echo $disabled; ?>> Menit
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
					<td><div class="isi_tabel"></div></td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. KTP<span class="required_star">*</span></strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="file" name="doc_ktp" id="doc_ktp">

							<?php
							if($customer->doc_ktp != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_ktp; ?>" target="_blank">KTP</a>
								<?php
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. NPWP</strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="file" name="doc_npwp" id="doc_npwp">

							<?php
							if($customer->doc_npwp != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_npwp; ?>" target="_blank">NPWP</a>
								<?php
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. Kartu Keluarga</strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="file" name="doc_kartu_keluarga" id="doc_kartu_keluarga">
							
							<?php
							if($customer->doc_kartu_keluarga != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_kartu_keluarga; ?>" target="_blank">KK</a>
								<?php
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. Akta Nikah</strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="file" name="doc_akta_nikah" id="doc_akta_nikah">

							<?php
							if($customer->doc_akta_nikah != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_akta_nikah; ?>" target="_blank">AN</a>
								<?php
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. SIUP</strong></div></td>
					<td>
						<div class="isi_tabel">
							<input type="file" name="doc_siup" id="doc_siup">

							<?php
							if($customer->doc_siup != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_siup; ?>" target="_blank">SIUP</a>
								<?php
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td style="height:98px;" valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Dok. Lainnya</strong></div></td>
					<td valign="top">
						<div class="isi_tabel" id="input_file">
							<div id="upload_area">
								<input name="doc[]" type="file" accept="image/*">
							</div>
							<input type="button" value="+" style="padding: 1px 10px;" onClick="javascript:add_input_file();">
						</div>
					</td>
				</tr>
			</table>
			
			<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#FFFFFF" align="right">
						<span class="required_star" style="float:left;margin-top:5px;">* Harus Diisi</span>
						<input type="hidden" name="id_pemesanan" id="id_pemesanan" value="<?php echo $id_pemesanan; ?>">
						<input type="hidden" name="id_unit" id="id_unit" value="<?php echo $id_unit; ?>">	
						<input type="hidden" name="id_kartu_keluarga" id="id_kartu_keluarga" value="<?php echo $id_kartu_keluarga; ?>">
						<input type="hidden" name="id_customer" id="id_customer" value="<?php echo $customer->id_customer; ?>">						
						<input type="submit" name="submit" value="Berikutnya &raquo;">
					</td>
				</tr>
			</table>
			
		</form>
		</div>
	</div>
	<div class="clear" style="height:40px;"></div>
</div>

</body>
</html>