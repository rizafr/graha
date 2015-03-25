<?php echo $header; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>files/js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>files/js/tinymce/jscripts/tiny_mce/tiny_mce_init.js"></script>
<script type="text/javascript">
function validasi()
{
	var nama_type = $('#nama_type').val();
	
	if(nama_type == "")
	{
		alert("Nama type harus diisi !");
		$('#nama_type').focus();
		return false;
	}

	else
	{
		return true;
	}
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
	<div class="margin_left" style="width:910px">		
		<div class="header_data">Tambah Data Type</div>
		<div class="tombol_tambah">
			<a href="<?php echo base_url(); ?>type/index/<?php echo $data_type->id_cluster; ?>">
				<input type="button" value="&laquo; Kembali">
			</a>
			
				<a href="<?php echo base_url(); ?>type/form_gallery/<?php echo $data_type->id_type; ?>">
				<input type="button" value="Gallery &raquo; ">
			</a>
		</div>
		
		<div class="clear"></div>
		
		<div class="frame_tabel radius" style="margin-bottom:10px;">
			<table width="700px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Cluster</strong></div></td>
					<td width="450px"><div class="isi_tabel"><strong><?php echo $data_type->nama_cluster; ?></strong></div></td>
				</tr>
			</table>
		</div>
		
		<form name="form_add" id="form_add" enctype="multipart/form-data" method="post" action="<?php echo $action;?>" onSubmit="return validasi();">
		<div class="frame_tabel radius transparent">
			<table width="700px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><b>Nama Type<span class="required_star">*</span></b></div></td>
					<td>
						<div class="isi_tabel">
							<input name="nama_type" type="text" id="nama_type" size="50" value="<?php echo $data_type->nama_type; ?>">
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999" valign="top"><div class="isi_tabel"><b>Spesifikasi</b></div></td>
					<td>
						<div class="isi_tabel" id="sample">
							<textarea name="deskripsi" id="deskripsi" cols="70" rows="15"><?php echo $data_type->spesifikasi; ?></textarea>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
					<td>
						<div class="isi_tabel"><input type="submit" value="Simpan &#10003;"></div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td colspan="2">
						<div class="isi_tabel"><span class="required_star">* Harus Diisi</span></div>
					</td>					
				</tr>	
				
			</table>
		</div>
		
		<script type="text/javascript">
		
			function kdb_add()
			{
				var totalN = parseInt( $("#nblok").val() );
				var n = totalN+1;
				$("#tr_add").before('<tr bgcolor="#FFFFFF" id="kdb-'+n+'"><td bgcolor="#999999"></td><td><div class="isi_tabel"><input name="kode_blok[]" type="text" size="5" value="" style="text-align:center;"> &nbsp;&nbsp;&nbsp; <input type="button" style="padding: 1px 10px;" value=" x " onClick="javascript:kdb_del('+n+')" /></div></td></tr>');
				$("#nblok").val(totalN+1);	
			}
			
			function kdb_del(x)
			{
				var totalN = parseInt( $("#nblok").val() );
				var n = x;
				$("#kdb-"+n).remove();
				$("#nblok").val(totalN-1);
			}
		
		</script>
	
		<div class="frame_tabel radius transparent" style="margin-left:30px;">
			<table width="170px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<?php
				$kode_blok = explode(",", $data_type->kode_blok);
				$i = 1;
				foreach($kode_blok AS $kb)
				{
					if($i == 1)
					{
						echo '
						<tr bgcolor="#FFFFFF">
							<td bgcolor="#999999"><div class="isi_tabel"><b>Blok</b></div></td>
							<td>
								<div class="isi_tabel">
									<input name="kode_blok[]" type="text" size="5" value="'.$kb.'" style="text-align:center;">
								</div>
							</td>
						</tr>
						';
					}
					else
					{
						echo '
						<tr bgcolor="#FFFFFF" id="kdb-'.$i.'">
							<td bgcolor="#999999"></td>
							<td>
								<div class="isi_tabel">
									<input name="kode_blok[]" type="text" size="5" value="'.$kb.'" style="text-align:center;"> &nbsp;&nbsp;&nbsp; <input type="button" style="padding: 1px 10px;" value=" x " onClick="javascript:kdb_del('.$i.')" />
								</div>
							</td>
						</tr>
						';
					}
					
					$i++;
				}
				
				?>
				<tr id="tr_add"><input type="hidden" name="nblok" id="nblok" value="<?php echo $i; ?>"></tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"></td>
					<td>
						<input type="button" style="padding: 1px 10px;" value=" + " onClick="javascript:kdb_add(); return false;">
					</td>
				</tr>
				
			</table>
		</div>
		
		</form>
		<div class="clear"></div>
	</div>
</div>

</body>
</html>