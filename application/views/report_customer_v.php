<?php echo $header; ?>


<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}

	function tampilkan_list(posisi)
	{
		loading();
		$('#frame_data').load(base_url+'report/customer_list/'+posisi);
	}
	
	function tampilkan_list_cari()
	{
		var kata_kunci = $("#katakunci").val();
		if (kata_kunci == "")
		{
			alert("Kata kunci pencarian masih kosong.");
			$("#katakunci").focus();
			return false;
		}
		
		kata_kunci = B64.encode(kata_kunci);
		
		loading();
		$('#frame_data').load(base_url+'report/customer_cari/'+kata_kunci+'/0');
	}
	
	function tampilkan_detail_customer(id_customer)
	{
		loading();
		$('#frame_data').load(base_url+'report/customer_detail/'+id_customer);
	}

	function hapus_data_customer(id_customer){
		if(confirm("Yakin akan menghapus data?")){
			$.post(base_url+'report/customer_delete/'+id_customer, function(){
				tampilkan_list(0);
			});
		}		
		return false;
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
		$('#frame_data').load(base_url+'report/customer_list/0');
	})
</script>

</body>
</html>