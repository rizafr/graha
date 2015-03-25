<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}

	function tampilkan_list(posisi)
	{
		loading();
		$('#frame_data').load(base_url+'report/unit_sold_list/'+posisi);
	}
	
	function list_filter(posisi)
	{
		var filter 			= $('input:radio[name=filter]:checked').val();
		var kata_kunci		= $('#nomor_pemesanan').val();
		var id_cluster 		= $('#nama_cluster').val();
		var kategori		= encodeURI($('#nama_kategori').val());
		var jenis_transaksi	= $('#jenis_transaksi').val();
		var id_promo		= $('#id_promo').val();

		if(!filter)
		{
			alert("Anda belum memilih jenis pencarian");
		}
		else
		{
			if(filter == "nomor_pemesanan")
			{
				if(!kata_kunci)
				{
					alert("Nomor pemesanan yang akan dicari masih kosong !");
				}
				else
				{
					loading();
					$('#frame_data').load(base_url+'report/unit_sold_cari_list/'+posisi+'/'+filter+'/0/0/'+kata_kunci+'/0/0');
				}
			}	
			else if(filter == "cluster")
			{
				loading();
				$('#frame_data').load(base_url+'report/unit_sold_cari_list/'+posisi+'/'+filter+'/'+id_cluster+'/'+kategori+'/0/0/0');
			}
			else if(filter == "transaksi")
			{				
				loading();
				$('#frame_data').load(base_url+'report/unit_sold_cari_list/'+posisi+'/'+filter+'/0/0/0/'+jenis_transaksi+'/'+id_promo);
			}		
		}
	}

	function hapus_pemesanan(id_pemesanan, id_unit, posisi){
		if(confirm("Yakin akan menghapus data?")){
			$.post(base_url+'report/unit_sold_delete/'+id_pemesanan+'/'+id_unit, function(){
				tampilkan_list(posisi);
			});
		}		
		return false;
	}

	function enable_promo()
	{
		var jenis_transaksi	= $('#jenis_transaksi').val();
		
		if(jenis_transaksi == "Promo")
		{
			$('#id_promo').show();
		}
		else
		{
			$('#id_promo').hide();
		}		
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
		$('#frame_data').load(base_url+'report/unit_sold_list/0');
	})
</script>

</body>
</html>