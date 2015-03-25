<?php echo $header; ?>
<?php echo $this->session->flashdata('alert'); ?>



<script type="text/javascript">

	function interval_unlock()
	{
		window.setInterval(function(){
			scheduler_unlock();
		}, 5000);
	}
	
	function scheduler_unlock(){
		$.ajax({url: base_url+'scheduler/unlock', success:function(result){
			if(result == "found")
			{
				location.reload();
			}
		}});
	}
	
	scheduler_unlock();
	interval_unlock();
	
</script>

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
		margin-top:7px;
	}
	
	.siteplan_edit {
		display: block;
		margin:0 auto 0;
		box-shadow: 0 0 2px 2px #000000;
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
	
	#frame-sp {
		margin:15px auto 15px;
		overflow:scroll;
		position:relative;
		width:auto;
		height:auto;
		cursor:move;
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
	<div class="margin_center" style="width:1000px; margin-bottom:20px;">
		<div class="header_data">Unit Regular</div>
		<div class="tombol_tambah">	
			<a href="<?php echo base_url(); ?>booking">
				<input type="button" value="&laquo; Kembali">
			</a>
		</div>
		
		<div class="frame_tabel radius" >
			<table width="600px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Siteplan</strong></div></td>
					<td width="450px"><div class="isi_tabel"><strong><?php echo $data_siteplan->nama_siteplan; ?></strong></div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td width="150px" bgcolor="#999999"><div class="header_tabel"><strong>Cluster</strong></div></td>
					<td width="450px"><div class="isi_tabel"><strong><?php echo $data_siteplan->nama_cluster; ?></strong></div></td>
				</tr>
			</table>
		</div>
		
		<div id="keterangan-siteplan">
			<div style="float:left; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#00DD00;"></span><span> : Marketable</span></div>
			<div style="float:right; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#0099CC;"></span><span> : Booked</span></div>
			<div style="float:left; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#FFFF11;"></span><span> : Locked</span></div>
			<div style="float:right; width:150px;"><span style="display:inline-block; width:50px; height:10px; background:#FF3300;"></span><span> : Sold</span></div>
		</div>
		
		<div class="clear"></div>
		
	</div>
	
	<div id="detail-unit" style="display:none;"></div>
		
<script type="text/javascript">
$(document).ready(function() {
			
	var winWidth = $(window).width() -50;
	var winHeight = $(window).height() -30;
	
	$('#frame-sp').css('max-width', '97%');
	$('#frame-sp').css('height', winHeight);
				
	$(function() {
		$('.map').maphilight({
			fillColor: '00FF00',
			fillOpacity: 0.4,
			strokeColor: 'ffffff',
			shadow : true,
			shadowOpacity: 0,
			shadowBackground : 'ffffff',
			alwaysOn : true
		});
	});
			
	$(".area-over").mouseenter(function(e){
	
		$("#detail-unit").empty();
		
		var x = e.pageX + 50;
		var y = e.pageY - 350;
		
		var det = $(this).attr("data-detail-unit");
		det = det.split("~");
		
		var data_detail_unit = '<span>Blok : '+ det[0] +'</span><br /><span>Kategori : '+ det[1] +'</span><br /><span>Type : '+ det[2] +'</span><br /><span>Luas Tanah : '+ det[3] +' m&sup2;</span><br /><span>Luas Bangunan : '+ det[4] +' m&sup2;</span>';
		var new_margin = y+"px 0px 0px "+x+"px"
		
		$("#detail-unit").css({margin : new_margin});
		$("#detail-unit").html(data_detail_unit).show();
	});
		
	$(".area-over").mouseleave(function(){
		$("#detail-unit").hide();
	});
});
</script>

<div id="mapping-image">
	
	<div id="frame-sp">
		
		<img src="<?php echo base_url().'files/siteplan/'.$data_siteplan->image ;?>?clear=<?php echo mt_rand(1,100) ;?>"
				alt="<?php echo $data_siteplan->nama_siteplan ;?>"
				class="siteplan_edit map"
				title="<?php echo $data_siteplan->nama_siteplan ;?>"
				USEMAP="#NotNamed" 
				BORDER="0" />
		
		<map name="NotNamed">
		
		<?php
		foreach($unit as $data_unit)
		{
			$data_detail_unit = 'data-detail-unit="'.
			$data_unit->kode_unit.'~'.
			$data_unit->kategori.'~'.
			$data_unit->nama_type.' '.$data_unit->posisi.'~'.
			$data_unit->luas_tanah.'~'.
			$data_unit->luas_bangunan.'"';
				
				$color = '';
				if($data_unit->status_transaksi == "Sold")
				{
					$color = 'data-maphilight=\'{"fillColor":"FF3300"}\' href="javascript:void(0);"';
				}
				elseif($data_unit->status_transaksi == "Booked")
				{
					$color = 'data-maphilight=\'{"fillColor":"000099"}\' href="javascript:void(0);"';
				}
				elseif($data_unit->locked == "1")
				{
					$color = 'data-maphilight=\'{"fillColor":"FFFF11"}\' href="javascript:void(0);"';
				}
				else
				{
					$color = 'data-maphilight=\'{"fillColor":"00FF00"}\' href="'.base_url().'booking/form_pemesanan/add/'.$data_siteplan->id_siteplan.'/'.$data_unit->id_unit.'"';
				}	
			
			echo '<area shape="poly" class="area-over" coords="'.$data_unit->coords.'" '.$data_detail_unit.$color.' alt="'.$data_unit->kode_unit.'" title="'.$data_unit->kode_unit.'">';	
		}
		?>
		
		</map>
		
	</div>
</div>
</div>

<script type="text/javascript">
var elements = $$('#frame-sp');
new Drag.Scroll(elements[0], {
	axis: {x: true, y: true}    
});
</script>

</body>
</html>