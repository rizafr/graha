<script type="text/javascript">

	function detail_agent(id_agent)
	{
		$('#isi_tab').load(base_url+'agent/detail_agent/'+id_agent);
	}

	function detail_users(id_agent)
	{  
		$('#isi_tab').load(base_url+'agent/detail_users/'+id_agent);
	}

</script>

	<div class="margin_center" style="width:1000px;">
	<div class="header_data">Detail Data Team Sales</div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:edit(<?php echo $agent->id_agent; ?>); return false;"><input type="button" value="Ubah"></a>
		<a href="" onClick="javascript:list_data(); return false;"><input type="button" value="&laquo; Kembali"></a>
	</div>
	
	<div style="margin-top:10px; width:1000px;" class="transparent">
		
		<div id="tabContaier">
			<ul>
				<li><a class="active" href="#tab1" onClick="javascript:detail_agent(<?php echo $agent->id_agent; ?>);return false;">Sales Manager</a></li>
				<li><a href="#tab2" onClick="javascript:detail_users(<?php echo $agent->id_agent; ?>);return false;">Sales</a></li>
			</ul>
			<div class="tabDetails">
				<div id="isi_tab" class="tabContents" style="min-height:300px;">
					Data Kosong
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(document).ready(function(){
				$("#tabContaier ul li a").click(function(){
					
					$('#isi_tab').html("Data Kosong");
					
					$("#tabContaier ul li a").removeClass("active");
					$(this).addClass("active");
				});
			});
			
			$('#isi_tab').load(base_url+'agent/detail_agent/<?php echo $agent->id_agent; ?>/');
		</script>
		
		</div>
		</div>
		
	</div>
	<div class="clear"></div>
</div>

