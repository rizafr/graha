<script type="text/javascript">
		
	$('.map').maphilight({
		fillColor: '00FF00',
		fillOpacity: 0.4,
		strokeColor: 'ffffff',
		shadow : true,
		shadowOpacity: 0,
		shadowBackground : 'ffffff',
		alwaysOn : true
	});
	
	$(".area-over").mouseenter(function(e){
	
		$("#detail-unit").empty();
		
		var x = e.pageX + 50;
		var y = e.pageY - 400;
		
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
		
</script>
	
<img src="<?php echo base_url().'files/siteplan/mapping/'.$data_siteplan->image ;?>?clear=<?php echo mt_rand(1,100) ;?>"
	alt="<?php echo $data_siteplan->nama_siteplan ;?>"
	class="siteplan_edit map"
	title="<?php echo $data_siteplan->nama_siteplan ;?>"
	USEMAP="#NotNamed"
	onClick="javascript:coords(event);"
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
		elseif($data_unit->status_unit == "Marketable")
		{
			$color = 'data-maphilight=\'{"fillColor":"00FF00"}\' href="javascript:void(0);"';
		}
		elseif($data_unit->status_unit == "Promo")
		{
			$color = 'data-maphilight=\'{"fillColor":"FF00FF"}\' href="javascript:void(0);"';
		}
		elseif($data_unit->status_unit == "Master")
		{
			$color = 'data-maphilight=\'{"fillColor":"000000"}\' href="javascript:void(0);"';
		}
		
	echo '<area shape="poly" class="area-over" coords="'.$data_unit->coords.'" '.$data_detail_unit.$color.' alt="'.$data_unit->kode_unit.'" title="'.$data_unit->kode_unit.'">';
}
?>

</map>