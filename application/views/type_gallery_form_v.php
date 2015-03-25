<?php echo $header; ?>
<script type="text/javascript" src="<?php echo base_url(); ?>files/js/ajaxupload.3.5.js" ></script>
<script type="text/javascript" >

	$(function()
	{
		var btnUpload=$('#upload');
		var status=$('#status');
		new AjaxUpload(btnUpload,
		{
			action: '<?php echo base_url(); ?>type/upload_gallery/<?php echo $data_type->id_type; ?>',
			name: 'gallery',
			onSubmit: function(file, ext)
			{
				if (! (ext && /^(jpg|png|jpeg|gif)$/.test(ext)))
				{
					status.text('Only JPG, PNG or GIF files are allowed');
					return false;
				}
				
				status.text('Sedang mengupload...');
			},
			onComplete: function(file, response)
			{
				$('#files').load(base_url+'type/gallery_list_data/<?php echo $data_type->id_type; ?>');
				status.text('');
			}
		});		
	});
	
	function hapus(id_gallery)
	{
		$.post(base_url+'type/delete_gallery/'+id_gallery, function()
		{
			$('#list_'+id_gallery).fadeOut('slow');
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
			<div class="margin_left" style="width:800px;">
			<div class="header_data">Data Type (Gallery)</div>
			<div class="tombol_tambah">
				<a href="<?php echo base_url(); ?>type/edit/<?php echo $data_type->id_type; ?>">
					<input type="button" value="&laquo; Kembali">
				</a>
			</div>
			
			<div class="clear"></div>
	
			<div class="frame_tabel radius" style="margin-bottom:10px;">
				<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
					<tr bgcolor="#FFFFFF">
						<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Cluster</strong></div></td>
						<td width="450px"><div class="isi_tabel"><strong><?php echo $data_type->nama_cluster; ?></strong></div></td>
					</tr>
					<tr bgcolor="#FFFFFF">
						<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Type</strong></div></td>
						<td width="450px"><div class="isi_tabel"><strong><?php echo $data_type->nama_type; ?></strong></div></td>
					</tr>
				</table>
			</div>
	
			<div class="frame_tabel radius">
				<table width="800px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
						<tr bgcolor="#FFFFFF">
							<td width="100px" bgcolor="#999999" valign="top"><div class="isi_tabel">
								<strong>File Foto</strong>
							</div></td>
							<td width="700px">
								<div class="isi_tabel">
									<div id="upload" style="width:65px;" class="button"><span>Upload File<span></div><span id="status" ></span>	
								</div>
							</td>
						</tr>	
						<tr bgcolor="#FFFFFF">
							<td bgcolor="#999999" valign="top">
								<div class="isi_tabel">
									<strong>Gallery</strong>
								</div>
							</td>
							<td>
								<div class="isi_tabel" id="files">
								</div>
							</td>
						</tr>			
						<tr bgcolor="#FFFFFF">
							<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
							<td>
								<div class="isi_tabel">
									<a href="<?php echo base_url(); ?>type/index/<?php echo $data_type->id_cluster; ?>">
										<input type="button" value="Selesai &#10003;">
									</a>
								</div>
							</td>
						</tr>			
					</table>
			</div>
			</div>
		</div>

		<div class="clear"></div>

		<script type="text/javascript">

			$(document).ready(function() 
			{			
				$('#files').load(base_url+'type/gallery_list_data/<?php echo $data_type->id_type; ?>');
			})

		</script>

	</body>
</html>

