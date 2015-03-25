<?php echo $header; ?>

<link rel="stylesheet" href="<?php echo base_url(); ?>files/css/slidorion/slidorion.css" type="text/css" />

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data(posisi)
	{
		loading();
		$('#frame_data').load(base_url+'home/list_data/'+posisi);
	}
	
	function detail(posisi, id_news)
	{
		loading();
		$('#frame_data').load(base_url+'home/detail/'+posisi+'/'+id_news);
	}	
	
	function hapus(id_news){
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'home/delete/'+id_news, function(result){
				if(result == "ok")
				{
					$('#'+id_news).fadeOut();
				}
			});	
		}
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
	
	$('#frame_data').load(base_url+'home/list_data/<?php echo $posisi; ?>');

})
</script>

</body>
</html>