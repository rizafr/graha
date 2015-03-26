<?php echo $header; ?>

<script type="text/javascript">
	function loading()
	{
		$('#image_siteplan').html('<div class="loading"></div>');
	}
	
	function image_siteplan(id_siteplan)
	{
		loading();
		$('#image_siteplan').load(base_url+'mapping/image_siteplan/'+id_siteplan);
	}
	
	$(document).ready(function(){
	
		$("#id_siteplan").change(function(){
			
			$('#image_siteplan').empty();
			$('#id_unit').html('<option value=""> -- Pilih Unit -- </option>');
			$('#coords').val("");
			
			var id_siteplan = $(this).val();
			var id_cluster = $('option:selected', this).attr("data-id-cluster");
			
			if(id_cluster != "" && id_siteplan != "")
			{
				$('#id_unit').load(base_url+'ajax/list_option_unit/'+id_cluster+'/'+id_siteplan);
				image_siteplan(id_siteplan);
			}
		});
		
		$("#id_unit").change(function(){
			
			$('#coords').val("");
			var data_coords = $('option:selected', this).attr("data-coords");
			$('#coords').val(data_coords);
			
		});
	
	});
	
	function simpanCoords()
	{
		var id_siteplan	= $("#id_siteplan").val();
		var id_cluster = $('option:selected', "#id_siteplan").attr("data-id-cluster");
		var id_unit	= $("#id_unit").val();
		var coords	= $('#coords').val();
		
		if(id_siteplan == "" || id_unit == "")
		{
			alert("Silahkan Pilih Siteplan -> Unit.");
			return false;
		}
				
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>mapping/add_coords/",
			data: $("#form_add").serialize(),
			success: function(result)
			{
				$('#id_unit').load(base_url+'ajax/list_option_unit/'+id_cluster+'/'+id_siteplan+'/'+id_unit);
				$('#image_mapping').load(base_url+'mapping/image_mapping/'+id_siteplan);
			}
		 });		
	}
	
	function clearCoords()
	{
		$('#coords').val("");
	}
	
	// Fixed Form Add Coords
	$(function() {
		var offset = $("#fixed-form-add-coords").offset();
		var topPadding = 15;
		$(window).scroll(function() {
			if ($(window).scrollTop() > offset.top) {
				$("#fixed-form-add-coords").stop().animate({
					marginTop: $(window).scrollTop() - offset.top + topPadding
				});
			} else {
				$("#fixed-form-add-coords").stop().animate({
					marginTop: 0
				});
			};
		});
	});
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
<style type="text/css">
	#keterangan-siteplan {
		width:300px; 
		float:right;
		font-family: Verdana,Geneva,sans-serif;
		color: #FFFFFF;
		font-size: 11px;
		font-weight:bold;
		background:#555555; 
		padding:10px;
		margin:43px 0 0 30px;
	}
</style>
<div class="margin_center" style="width:1000px; margin-bottom:130px;">
	<div class="header_data">Mapping</div>
	<div class="tombol_tambah">
		<a href="<?php echo base_url(); ?>home">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	
	<div id="keterangan-siteplan">
		<div style="float:left; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#888888;"></span><span> : Master</span></div>
		<div style="float:right; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#0099CC;"></span><span> : Booked</span></div>
		<div style="float:left; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#00DD00;"></span><span> : Marketable</span></div>
		<div style="float:right; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#FF3300;"></span><span> : Sold</span></div>
		<div style="float:left; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#FF00FF;"></span><span> : Promo</span></div>
	</div>
	
	<div id="fixed-form-add-coords" class="frame_tabel radius" style="position:absolute;z-index:999999;">
		<form name="form_add" id="form_add" enctype="multipart/form-data" method="post" action="">
		<table width="620px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="100px" bgcolor="#999999"><div class="isi_tabel"><strong>Siteplan</strong></div></td>
				<td width="520px">
					<div class="isi_tabel">
						<strong>
							<select name="id_siteplan" id="id_siteplan">
								<option value=""> -- Pilih Siteplan -- </option>
	
								<?php
								foreach($siteplan as $data_siteplan)
								{
									echo '<option value="'.$data_siteplan->id_siteplan.'" data-id-cluster="'.$data_siteplan->id_cluster.'" data-image="'.$data_siteplan->image.'">'.$data_siteplan->nama_siteplan.'</option>';
								}
								?>
							</select>
						</strong>
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Unit</strong></div></td>
				<td>
					<div class="isi_tabel">
						<strong>
							<select name="id_unit" id="id_unit">
								<option value=""> -- Pilih Unit -- </option>
							</select>
						</strong>
					</div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Coords</strong></div></td>
				<td>
					<div class="isi_tabel">
						<strong>
							<input type="text" name="coords" id="coords" value="" size="60" readonly="true" />
							<input type="button" value="&#9003; Clear"  onClick="javascript:clearCoords(); return false;" />
							<input type="button" value="Simpan &#10003;"  onClick="javascript:simpanCoords(); return false;" />
						</strong>
					</div>
				</td>
			</tr>
		</table>
		</form>

	</div>
	
</div>

<div id="image_siteplan"></div>

</div>

</body>
</html>