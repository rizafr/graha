<?php echo $header; ?>

<script>
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}

	function tampilkan_list(posisi)
	{
		loading();
		$('#frame_data').load(base_url+'report/timeout_list/'+posisi);
	}

	function hapus_pemesanan(id_pemesanan, id_unit, posisi){
		if(confirm("Yakin akan menghapus data?")){
			$.post(base_url+'report/timeout_delete/'+id_pemesanan+'/'+id_unit, function(){
				tampilkan_list(posisi);
			});
		}		
		return false;
	}
	
	function interval_timeout()
	{
		window.setInterval(function(){
			scheduler_timeout();
		}, 5000);
	}
	
	function scheduler_timeout(){
		$.ajax({url: base_url+'scheduler/timeout', success:function(result){
			if(result == "found")
			{
				tampilkan_list(0);
			}
		}});
	}
	
	scheduler_timeout();
	interval_timeout();
	
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
	$('#frame_data').load(base_url+'report/timeout_list/0');
})
</script>


</body>
</html>