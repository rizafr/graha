<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data()
	{
		loading();
		$('#frame_data').load(base_url+'timeout/list_data');
	}
	
	function add()
	{
		loading();
		$('#frame_data').load(base_url+'timeout/form_data/add/0');
	}
	
	function edit(id_timeout)
	{
		loading();
		$('#frame_data').load(base_url+'timeout/form_data/edit/'+id_timeout);
	}
	
	function post(ini)
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
						alert("Data timeout berhasil ditambahkan.");
					}
					else if(result == "ok-edit")
					{
						alert("Data timeout berhasil diubah.");
					}
					
					list_data();
				}
			});
		}
		
		return false;
	}
	
	function hapus(id_timeout)
	{
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'timeout/delete/'+id_timeout, function(result){
				if(result == "ok")
				{
					$('#'+id_timeout).fadeOut();
				}
			});	
		}
	}
	

	
	function validasi()
	{
		var status_pemesanan = $('#status_pemesanan').val();
		var status = $('#status').val();
		var hari = ufm($('#hari').val());
		var jam = ufm($('#jam').val());
		var menit = ufm($('#menit').val());

		if(status_pemesanan == "")
		{
			alert("Status transaksi harus diisi !");
			$('#status_pemesanan').focus();
			return false;
		}
		else if(status == "")
		{
			alert("Status timeout harus diisi !");
			$('#status').focus();
			return false;
		}
		else if((hari+jam+menit) < 1)
		{
			alert("Nilai timeout harus > 0 !");
			$('#menit').focus();
			return false;
		}
		else
		{
			return true;
		}
	}
	
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		{
			return false;
		}
		
		return true;
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
	
	$('#frame_data').load(base_url+'timeout/list_data');

})
</script>


</body>
</html>