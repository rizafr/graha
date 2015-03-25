<?php echo $header; ?>



<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data(id_cluster)
	{
		loading();
		$('#frame_data').load(base_url+'type/list_data/'+id_cluster);
	}
	
	function hapus(id_type)
	{
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'type/delete/'+id_type, function(result){
				if(result == "ok")
				{
					$('#'+id_type).fadeOut();
				}
			});	
		}
	}
	
	function detail(id_type)
	{
		$('#frame_data').load(base_url+'type/detail/'+id_type);
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