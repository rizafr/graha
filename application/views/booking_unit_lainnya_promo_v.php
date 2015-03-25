<?php echo $header; ?>
<?php echo $this->session->flashdata('alert'); ?>



<script>

	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}

	function list(posisi)
	{
		loading();
		$('#frame_data').load(base_url+'booking/unit_lainnya_data_promo/'+posisi);
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
		$('#frame_data').load(base_url+'booking/unit_lainnya_data_promo/0');
	})
</script>
</body>
</html>