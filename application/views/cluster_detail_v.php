<script type="text/javascript">

	function cluster_detail_type(id_cluster)
	{  
		$('#isi_tab').load(base_url+'cluster/cluster_detail_type/'+id_cluster);
	}
	
	function cluster_detail_siteplan(id_cluster)
	{
		$('#isi_tab').load(base_url+'cluster/cluster_detail_siteplan/'+id_cluster);
	}

</script>

<div class="margin_center" style="width:1000px; margin-bottom:20px;">
	<div class="header_data">Data Cluster Detail</div>
	<div class="tombol_tambah">	
		<a href="" onClick="javascript:list_data(<?php echo $posisi.",".$key; ?>);return false;">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="frame_tabel radius" >
		<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Nama Cluster</strong></div></td>
				<td width="450px"><div class="isi_tabel"><strong><?php echo $data_cluster->nama_cluster; ?></strong></div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="header_tabel"><strong>Kode Cluster</strong></div></td>
				<td><div class="isi_tabel"><strong><?php echo $data_cluster->kode_cluster; ?></strong></div></td>
			</tr>
		</table>
	</div>
	
	<div class="clear"></div>
	
	<div style="margin-top:10px; width:1000px;">
		
		<div id="tabContaier">
			<ul>
				<li><a class="active" href="#tab1" onClick="javascript:cluster_detail_type(<?php echo $data_cluster->id_cluster; ?>);return false;">Type</a></li>
				<li><a href="#tab2" onClick="javascript:cluster_detail_siteplan(<?php echo $data_cluster->id_cluster; ?>);return false;">Siteplan</a></li>
			</ul>
			<div class="tabDetails">
				<div id="isi_tab" class="tabContents" style="overflow-x:scroll;">
					Data Kosong
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#tabContaier ul li a").click(function(){
					
					$('#show_siteplan').empty();
					$('#frame-sp').empty();
					$('#isi_tab').html("Data Kosong");
					
					$("#tabContaier ul li a").removeClass("active");
					$(this).addClass("active");
				});
				
			});
			
			cluster_detail_type(<?php echo $data_cluster->id_cluster; ?>);
		</script>
		
	</div>
	
</div>
<div id="show_siteplan"></div>
		

