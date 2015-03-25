<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}

	function list_data(posisi)
	{
		loading();
		$('#frame_data').load(base_url+'promo/list_data/'+posisi);
	}
	
	function list_data_unit_promo(id_promo, posisi)
	{
		loading();
		$('#frame_data').load(base_url+'promo/list_data_unit_promo/'+id_promo+'/'+posisi);
	}
	
	function add(posisi)
	{
		loading();
		$('#frame_data').load(base_url+'promo/form_data_promo/add/0/'+posisi);
	}
	
	function edit(id_promo, posisi)
	{
		loading();
		$('#frame_data').load(base_url+'promo/form_data_promo/edit/'+id_promo+'/'+posisi);
	}
	
	function post(ini, posisi)
	{
		if (validasi())
		{
			$.ajax({
				type: "POST",
				url: $(ini).attr("action"),
				data: $("#form").serialize(),
				success: function(result)
				{
					if(result == "ok-add")
					{
						alert("Data promo berhasil ditambahkan.");
					}
					else if(result == "ok-edit")
					{
						alert("Data promo berhasil diubah.");
					}
					
					list_data(posisi);
				}
			});
		}
		
		return false;
	}
	
	function detail(id_promo, posisi)
	{
		loading();
		$('#frame_data').load(base_url+'promo/detail/'+id_promo+'/'+posisi);
	}
	
	function hapus(id_promo){
		if(confirm("Yakin akan menghapus data?")){
			$.post(base_url+'promo/delete/'+id_promo, function(result){
				if (result == "ok")
				{
					$("#tr_" + id_promo).fadeOut();
				}
				else
				{
					alert("Data promo gagal dihapus, data promo masih digunakan oleh unit yang telah mempunyai status transaksi.");
				}
			});
		}
		
		return false;
	}

	function validasi()
	{
		var nama_event	= $('#nama_promo').val();
		var datepicker1	= $('#datepicker1').val();
		var datepicker2	= $('#datepicker2').val();
		var status		= $('#status').val();
		var deskripsi	= $('#deskripsi').val();

		if(nama_event == "")
		{
			alert("Nama Promo harus diisi !");
			$('#nama_event').focus();
			return false;
		}
		else if(datepicker1 == "")
		{
			alert("Tanggal Awal Promo harus diisi !");
			$('#datepicker1').focus();
			return false;
		}
		else if(datepicker2 == "")
		{
			alert("Tanggal Akhir Promo harus diisi !");
			$('#datepicker2').focus();
			return false;
		}
		else if(status == "")
		{
			alert("Status Promo harus diisi harus diisi !");
			$('#status').focus();
			return false;
		}
		else if(deskripsi == "")
		{
			alert("Deskripsi Promo harus diisi !");
			$('#deskripsi').focus();
			return false;
		}		
		else
		{
			return true;
		}
	}
	
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
			list_data(0);
		}
	}});
}
	
scheduler_promo();
interval_promo();
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
	
	list_data(0);

})
</script>


</body>
</html>