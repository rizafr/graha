<style type="text/css">	
	.siteplan_edit {
		display: block;
		margin:0 auto 0;
		box-shadow: 0 0 2px 2px #000000;
	}
	
	.siteplan_visible {
		display: block;
		margin:0 auto 0;
		box-shadow: 0 0 2px 2px #000000;
	}
	
	#frame-sp {
		margin:50px auto 0px;
		overflow:scroll;
		position:relative;
		width:100%;
		height:auto;
		margin-top: 130px;
		margin-left: 30px;
	}
	
	#detail-unit {
		position:absolute;
		font-family: Verdana,Geneva,sans-serif;
		color: #FFFFFF;
		font-size: 11px;
		font-weight:bold;
		width:auto;
		white-space:nowrap;
		background:#555555; 
		padding:10px;
		z-index:999999;
	}
	
	#image_mapping {
		position:absolute; 
		z-index:99999; 
		width:100%;
	}
</style>

<script type="text/javascript">
		
	var winWidth = $(window).width() -50;
	var winHeight = $(window).height() -30;
	
	$('#frame-sp').css('max-width', '100%');
	$('#frame-sp').css('height', winHeight);

	$(document).ready(function(){
	
		$('#image_mapping').load(base_url+'mapping/image_mapping/<?php echo $data_siteplan->id_siteplan; ?>');
	
	});
		
	function coords(event)
	{
		var elOffsetX = $(".siteplan_edit").offset().left;
		var elOffsetY = $(".siteplan_edit").offset().top;
		var x = event.pageX - elOffsetX;
		var y = event.pageY - elOffsetY;
			
		x = parseFloat(x.toFixed(4));
		y = parseFloat(y.toFixed(4));
		var old = $("#coords").val();
		
		if(old == "")
		{
			var nw = x + ", " + y;
		}
		else
		{
			var nw = ", " + x + ", " + y;
		}
			
		$("#coords").val(old + nw);
	}
	
</script>

<div id="detail-unit" style="display:none;"></div>

<div id="frame-sp">
	
	<div id="image_mapping"></div>
	
	<div>
		<img class="siteplan_visible" border="0" src="<?php echo base_url().'files/siteplan/'.$data_siteplan->image; ?>">
	</div>
</div>