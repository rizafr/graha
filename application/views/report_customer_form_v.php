<?php echo $header; ?>

<script type="text/javascript">

function validasi()
{
	var nama_lengkap		= $('#nama_lengkap').val();
	var no_ktp				= $('#no_ktp').val();
	var no_npwp				= $('#no_npwp').val();
	var telpon				= $('#telpon').val();
	var hp					= $('#hp').val();
	var email				= $('#email').val();
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
		alert("No. HP harus diisi !");
		$('#hp').focus();
		return false;
	}
	else if(isNaN($('#no_ktp').val() / 1) == true)
	{
		alert("No. KTP harus numerik !");
		$('#no_ktp').focus();
		return false;
	}
	else if(isNaN($('#telpon').val() / 1) == true)
	{
		alert("No. Telpon harus numerik !");
		$('#telpon').focus();
		return false;
	}
	else if(isNaN($('#hp').val() / 1) == true)
	{
		alert("No. hp harus numerik !");
		$('#hp').focus();
		return false;
	}
	else if(ktp == "")
	{
		<?php
		if($status_form == "add")
		{
			?>
			alert("Dokumen KTP (Upload) harus diisi !");
			$('#doc_ktp').focus();
			return false;
			<?php
		}
		else
		{
			?>
			return true;
			<?php
		}
		?>
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
	$('#upload_area').append("<input type='file' name='doc[]' accept='image/*'>");
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
		<div class="header_data"><?php echo $judul; ?></div>
		<div class="tombol_tambah">
			<a href="<?php echo base_url(); ?>report/customer"><input type="button" value="&laquo; Kembali"></a>
		</div>		
		<div class="frame_tabel radius transparent">
		<form name="pemesanan" method="post" action="<?php echo $action; ?>" onSubmit="return validasi();" enctype="multipart/form-data">
			<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td colspan="4"><div class="header_tabel">Data Customer</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="187" bgcolor="#999999">
						<div class="isi_tabel">
							<strong>Nama Lengkap<span class="required_star">*</span></strong>
						</div>
					</td>
					<td width="264">
						<div class="isi_tabel">
							<input type="text" name="nama_lengkap" id="nama_lengkap" size="40" value="<?php echo $nama_lengkap; ?>">
						</div>
					</td>
					<td width="173" rowspan="2" valign="top" bgcolor="#999999">
						<div class="isi_tabel">
							<strong>Alamat KTP<span class="required_star"></span></strong>
						</div>
					</td>
					<td width="353" rowspan="2" valign="top">
						<div class="isi_tabel">
							<textarea name="alamat_ktp" id="alamat_ktp" cols="40" rows="3"><?php echo $alamat_ktp; ?></textarea>
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999">
						<div class="isi_tabel">
							<strong>No. KTP<span class="required_star">*</span></strong>
						</div>
					</td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="no_ktp" id="no_ktp" size="40" autocomplete="off" value="<?php echo $no_ktp; ?>">
						</div>
					</td>
					</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999">
						<div class="isi_tabel">
							<strong>No. Kartu Keluarga</strong>
						</div>
					</td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="no_kartu_keluarga" id="no_kartu_keluarga" size="40" autocomplete="off" value="<?php echo $no_kartu_keluarga; ?>">
						</div>
					</td>
					<td rowspan="2" valign="top" bgcolor="#999999">
						<div class="isi_tabel">
							<strong>Alamat NPWP<span class="required_star"></span></strong>
						</div>
					</td>
					<td rowspan="2" valign="top">
						<div class="isi_tabel">
							<textarea name="alamat_npwp" id="alamat_npwp" cols="40" rows="3"><?php echo $alamat_npwp; ?></textarea>
						</div>
					</td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999">
						<div class="isi_tabel">
							<strong>No. NPWP<span class="required_star">*</span></strong>
						</div>
					</td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="no_npwp" id="no_npwp" size="40" autocomplete="off" value="<?php echo $no_npwp; ?>">
						</div>
					</td>
					</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999">
						<div class="isi_tabel">
							<strong>Telpon<strong><span class="required_star">*</span></strong></strong>
						</div>
					</td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="telpon" id="telpon" size="40" autocomplete="off" value="<?php echo $telpon; ?>">
						</div>
					</td>
					<td bgcolor="#999999"><div class="isi_tabel">
						<strong>Dok. KTP<span class="required_star">*</span></strong>
					</div></td>
					<td><div class="isi_tabel">
						<input type="hidden" name="now_doc_ktp" id="now_doc_ktp" value="<?php echo $doc_ktp; ?>">
							<input type="file" name="doc_ktp" id="doc_ktp">
						<?php
						if($doc_ktp != "")
						{
						?>
						<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $doc_ktp; ?>" target="_blank">KTP</a>
						<?php
						}
						?>
					</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999">
						<div class="isi_tabel">
							<strong>HP<strong><span class="required_star">*</span></strong></strong>
						</div>
					</td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="hp" id="hp" size="40" autocomplete="off" value="<?php echo $hp; ?>">
						</div>
					</td>
					<td bgcolor="#999999"><div class="isi_tabel">
						<strong>Dok. NPWP</strong>
					</div></td>
					<td><div class="isi_tabel">
						<input type="hidden" name="now_doc_npwp" id="now_doc_npwp" value="<?php echo $doc_npwp; ?>">
							<input type="file" name="doc_npwp" id="doc_npwp">
						<?php
						if($doc_npwp != "")
						{
						?>
						<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $doc_npwp; ?>" target="_blank">NPWP</a>
						<?php
						}
						?>
					</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999">
						<div class="isi_tabel">
							<strong>Email</strong>
						</div>
					</td>
					<td>
						<div class="isi_tabel">
							<input type="text" name="email" id="email" size="40" value="<?php echo $email; ?>">
						</div>
					</td>
					<td bgcolor="#999999"><div class="isi_tabel">
						<strong>Dok. Kartu Keluarga</strong>
					</div></td>
					<td><div class="isi_tabel">
						<input type="hidden" name="now_doc_kartu_keluarga" id="now_doc_kartu_keluarga" value="<?php echo $doc_kartu_keluarga; ?>">
							<input type="file" name="doc_kartu_keluarga" id="doc_kartu_keluarga">
						<?php
						if($doc_kartu_keluarga != "")
						{
						?>
						<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $doc_kartu_keluarga; ?>" target="_blank">Kartu Keluarga</a>
						<?php
						}
						?>
					</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td rowspan="2" valign="top" bgcolor="#999999">
						<div class="isi_tabel">
							<strong>Alamat Surat Menyurat</strong>
						</div>
					</td>
					<td rowspan="2">
						<div class="isi_tabel">
							<textarea name="alamat_surat_menyurat" id="alamat_surat_menyurat" cols="40" rows="3"><?php echo $alamat_surat_menyurat; ?></textarea>
						</div>
					</td>
					<td bgcolor="#999999"><div class="isi_tabel">
						<strong>Dok. Akta Nikah</strong>
					</div></td>
					<td><div class="isi_tabel">
						<input type="hidden" name="now_doc_akta_nikah" id="now_doc_akta_nikah" value="<?php echo $doc_akta_nikah; ?>">
						<input type="file" name="doc_akta_nikah" id="doc_akta_nikah">
						<?php
						if($doc_akta_nikah != "")
						{
						?>
						<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $doc_akta_nikah; ?>" target="_blank">Akta Nikah</a>
						<?php
						}
						?>
					</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel">
						<strong>Dok. SIUP</strong>
					</div></td>
					<td><div class="isi_tabel">
						<input type="hidden" name="now_doc_siup" id="now_doc_siup" value="<?php echo $doc_siup; ?>">
						<input type="file" name="doc_siup" id="doc_siup">
						<?php
						if($doc_siup != "")
						{
						?>
						<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $doc_siup; ?>" target="_blank">SIUP</a>
						<?php
						}
						?>
					</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td valign="top" bgcolor="#999999">&nbsp;</td>
					<td>&nbsp;</td>
					<td bgcolor="#999999"><div class="isi_tabel">
						<strong>Dok. Lainnya</strong>
					</div></td>
					<td><div class="isi_tabel" id="input_file">
						<div id="upload_area">
							<input name="doc[]" type="file" accept="image/*">
						</div>
						<input type="button" value="+" onClick="javascript:add_input_file();">
					</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td colspan="4">
						<div class="isi_tabel"><span class="required_star">* Harus Diisi</span></div>
					</td>					
				</tr>
				<tr bgcolor="#FFFFFF">
					<td valign="top" bgcolor="#FFFFFF" colspan="4" align="right">	
						<input type="hidden" name="id_customer" id="id_customer" value="<?php echo $id_customer; ?>">
						<input type="hidden" name="id_kartu_keluarga" id="id_kartu_keluarga" value="<?php echo $id_kartu_keluarga; ?>">
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