<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}

	function tampilkan_list(posisi)
	{
		var nomor_pemesanan = $("#nomor_pemesanan").val();

		loading();
		$('#frame_data').load(base_url+'trash_data/list_data/'+posisi);
	}

	function cari(posisi)
	{
		var nomor_pemesanan = $("#nomor_pemesanan").val();

		loading();
		$('#frame_data').load(base_url+'trash_data/list_data_cari/'+posisi+'/'+nomor_pemesanan);
	}

	function restore_data(id_pemesanan, id_unit)
	{
		if(confirm("Yakin akan me-restore data pemesanan ini ?"))
		{
			$.post(base_url+'trash_data/restore/'+id_pemesanan+'/'+id_unit, function(result){
				if(result == "ok")
				{
					tampilkan_list(0);
					alert("Data pemesanan berhasil di-restore");
				}
				else
				{
					alert(result);
				}
			});
		}
	}

	function hapus_data(id_pemesanan)
	{
		if(confirm("Data akan secara permanen dihapus. Yakin akan menghapus data ?"))
		{
			$.post(base_url+'trash_data/delete/'+id_pemesanan, function(){
				loading();
				tampilkan_list(0);
			})
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
		$('#frame_data').load(base_url+'trash_data/list_data/0');
	})
</script>

</body>
</html>