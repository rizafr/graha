<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data()
	{
		loading();
		$('#frame_data').load(base_url+'cara_pembayaran/list_data');
	}
	
	function add()
	{
		loading();
		$('#frame_data').load(base_url+'cara_pembayaran/form_data/add/0');
	}
	
	function edit(id_cara_pembayaran)
	{
		loading();
		$('#frame_data').load(base_url+'cara_pembayaran/form_data/edit/'+id_cara_pembayaran);
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
						alert("Data cara pembayaran berhasil ditambahkan.");
					}
					else if(result == "ok-edit")
					{
						alert("Data cara pembayaran berhasil diubah.");
					}
					
					list_data();
				}
			});
		}
		
		return false;
	}
	
	function hapus(id_cara_pembayaran)
	{
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'cara_pembayaran/delete/'+id_cara_pembayaran, function(result){
				if(result == "ok")
				{
					$('#'+id_cara_pembayaran).fadeOut();
				}
			});	
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
	
	function validasi()
	{
		var cara_pembayaran = $('#cara_pembayaran').val();

		if(cara_pembayaran == "")
		{
			alert("Nama cara pembayaran harus diisi !");
			$('#cara_pembayaran').focus();
			return false;
		}	
		else
		{
			return true;
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
	
	list_data();

})
</script>


</body>
</html>