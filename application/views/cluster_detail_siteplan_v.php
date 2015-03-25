<script type="text/javascript">

	function show_siteplan(id_siteplan)
	{  
		$('#show_siteplan').load(base_url+'cluster/cluster_detail_siteplan_show/'+id_siteplan);
	}

</script>

<style type="text/css">
#each_siteplan {
    background-image: url("<?php echo base_url(); ?>files/images/transparent-black.png");
    border: 1px solid #888888;
    float: left;
    margin: 20px;
    padding: 10px;
}
#each_siteplan:hover {
   -webkit-box-shadow:	0px 0px 10px rgba(78, 101, 153, 1);
	-moz-box-shadow:	0px 0px 10px rgba(78, 101, 153, 1);
	box-shadow:			0px 0px 10px rgba(78, 101, 153, 1);
}
</style>

<?php
foreach($siteplan as $sp)
{
	?>
	
	<a href="" style="text-decoration: none;" onClick="javascript:show_siteplan(<?php echo $sp->id_siteplan; ?>); return false;">
		<div id="each_siteplan">
			<div style="color:#FFF;margin-bottom:10px;">
				<span style="font-weight: bold; font-size: 12px;"><?php echo $sp->nama_siteplan; ?></span><br>
			</div>
			<div class="frame_tabel radius transparent">
				<img width="150px" height="105px" src="<?php echo base_url(); ?>files/siteplan/thumbnail/<?php echo $sp->image; ?>">
			</div>
		</div>
	</a>
	
	<?php
}

?>


