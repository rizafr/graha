<?php echo $header; ?>

<script type="text/javascript">

function interval_promo()
{
	window.setInterval(function(){
		scheduler_promo();
	}, 5000);
}

function scheduler_promo(){
	$.ajax({url: base_url+'scheduler/promo', success:function(result){
		if(result == "found")
		{
			location.reload(); 
		}
	}});
}
	
scheduler_promo();
interval_promo();
</script>

<style type="text/css">

#each_siteplan
{
	margin:20px; 
	border:1px #666 solid; 
	width: 435px; 
	height:110px; 
	padding:10px; 
	background-image: url('<?php echo base_url(); ?>files/images/transparent-black.png'); 
	float:left;
}

#each_siteplan:hover
{
	-webkit-box-shadow: 0px 0px 10px rgba(78, 101, 153, 1);
	-moz-box-shadow: 0px 0px 10px rgba(78, 101, 153, 1);
	box-shadow: 0px 0px 10px rgba(78, 101, 153, 1);
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

<div id="frame_data" style="margin-left: 100px;">
	<div class="header_data">Booking Promo</div>
	<?php
	foreach($siteplan as $data_siteplan)
	{
		$jua = $this->siteplan_m->get_total_unit_promo_available($data_siteplan->id_siteplan);
	?>

	<a href="<?php echo base_url(); ?>booking/siteplan_detail_promo/<?php echo $data_siteplan->id_siteplan; ?>" style="text-decoration: none;">
		<div id="each_siteplan">
			<div class="frame_tabel radius transparent">
				<img src="<?php echo base_url();?>files/siteplan/thumbnail/<?php echo $data_siteplan->image; ?>" width="150px" height="105px">
			</div>
			<div style="color:#FFF; width:250px; position:absolute; margin:0 0 0 170px;">
				<span style="font-weight: bold; font-size: 12px;"><?php echo $data_siteplan->nama_siteplan; ?></span><br />
				<span style="display: inline-block; width:80px; font-size: 10px; padding-left:90px;">Jumlah Unit</span><span style="font-size: 10px; text-align:right;"> : <?php echo $jua->total; ?> Unit</span><br />
				<span style="display: inline-block; width:70px; font-size: 10px; padding-left:100px;">Available</span><span style="font-size: 10px; text-align:right;"> : <?php echo $jua->total_available; ?> Unit</span><br />
				<span style="display: inline-block; width:70px; font-size: 10px; padding-left:100px;">Booked</span><span style="font-size: 10px; text-align:right;"> : <?php echo $jua->total_booked; ?> Unit</span><br />
				<span style="display: inline-block; width:70px; font-size: 10px; padding-left:100px;">Sold</span><span style="font-size: 10px; text-align:right;"> : <?php echo $jua->total_sold; ?> Unit</span>
			</div>
		</div>
	</a>

	<?php
	}
	
	$jual = $this->siteplan_m->get_unit_promo_lainnya_available();
	?>

	<!-- Menampilkan tabel untuk unit yang tidak mempunyai siteplan -->
	<a href="<?php echo base_url(); ?>booking/unit_lainnya_detail_promo" style="text-decoration: none;">
		<div id="each_siteplan">
			<div class="frame_tabel radius transparent" style="width: 150px; height: 100px; background-color: #FFF;">				
			</div>
			<div style="color:#FFF; width:250px; position:absolute; margin:0 0 0 170px;">
				<span style="display: inline-block; margin-bottom:7px; font-weight: bold; font-size: 12px;">Unit Lainnya</span><br />
				<span style="display: inline-block; width:100px; font-size: 10px; padding-left:80px;">Jumlah Unit</span><span style="font-size: 10px; text-align:right;"> : <?php echo $jual->total; ?> Unit</span><br />
				<span style="display: inline-block; width:80px; font-size: 10px; padding-left:100px;">Available</span><span style="font-size: 10px; text-align:right;"> : <?php echo $jual->total_available; ?> Unit</span><br />
				<span style="display: inline-block; width:80px; font-size: 10px; padding-left:100px;">Booked</span><span style="font-size: 10px; text-align:right;"> : <?php echo $jual->total_booked; ?> Unit</span><br />
				<span style="display: inline-block; width:80px; font-size: 10px; padding-left:100px;">Sold</span><span style="font-size: 10px; text-align:right;"> : <?php echo $jual->total_sold; ?> Unit</span>
			</div>
		</div>
	</a>

</div>

</body>
</html>