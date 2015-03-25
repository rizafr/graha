<script type="text/javascript">

	function spesifikasi_detail(id_type)
	{  
		$('#isi_tab').load(base_url+'type/spesifikasi_detail/'+id_type);
	}
	
	function gallery_detail(id_type)
	{
		$('#isi_tab').load(base_url+'type/gallery_detail/'+id_type);
	}

</script>

<div class="margin_center" style="width:1000px; margin-bottom:20px;">
	<div class="header_data">Data Type Detail</div>
	<div class="tombol_tambah">	
		<a href="" onClick="javascript:list_data(<?php echo $data_type->id_cluster; ?>);return false;">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="frame_tabel radius" >
		<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Type</strong></div></td>
				<td width="450px"><div class="isi_tabel"><strong><?php echo $data_type->nama_type; ?></strong></div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Cluster</strong></div></td>
				<td width="450px"><div class="isi_tabel"><strong><?php echo $data_type->nama_cluster; ?></strong></div></td>
			</tr>
		</table>
	</div>
	
	<div class="clear"></div>
	
	<div style="margin-top:10px; width:1000px;">
		
		<div id="tabContaier">
			<ul>
				<li><a href="#tab1" onClick="javascript:spesifikasi_detail(<?php echo $data_type->id_type; ?>);return false;" class="active">Spesifikasi</a></li>
				<li><a href="#tab2" onClick="javascript:gallery_detail(<?php echo $data_type->id_type; ?>);return false;">Gallery</a></li>
			</ul>
			<div class="tabDetails">
				<div id="isi_tab" class="tabContents" style="min-height:300px;">
					Data Kosong
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#tabContaier ul li a").click(function(){ //Fire the click event
					
					var activeTab = $(this).attr("href"); // Catch the click link
					$("#tabContaier ul li a").removeClass("active"); // Remove pre-highlighted link
					$(this).addClass("active"); // set clicked link to highlight state
				});
				
			});
			
			spesifikasi_detail(<?php echo $data_type->id_type; ?>);
		</script>
		
	</div>
</div>
		

