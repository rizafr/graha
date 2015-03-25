<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data(id_cluster)
	{
		loading();
		$('#frame_data').load(base_url+'siteplan/list_data/'+id_cluster);
	}
	
	function add(id_cluster)
	{
		loading();
		$('#frame_data').load(base_url+'siteplan/add/'+id_cluster);
	}
	
	function edit(id_siteplan)
	{
		loading();
		$('#frame_data').load(base_url+'siteplan/edit/'+id_siteplan);
	}
	
	function hapus(id_siteplan)
	{
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'siteplan/delete/'+id_siteplan, function(result){
				if(result == "ok")
				{
					$('#'+id_siteplan).fadeOut();
				}
			});	
		}
	}
	
	function detail(id_siteplan)
	{
		loading();
		$('#frame_data').load(base_url+'siteplan/detail/'+id_siteplan);
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
	<div class="loading"></div>
</div>

<script type="text/javascript">
$(document).ready(function() {
	
	list_data(<?php echo $id_cluster; ?>);

})
</script>

</body>
</html>