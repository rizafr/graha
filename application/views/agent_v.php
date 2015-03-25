<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data()
	{
		loading();
		$('#frame_data').load(base_url+'agent/list_data/');
	}
	
	function add()
	{
		loading();
		$('#frame_data').load(base_url+'agent/add/');
	}
	
	function edit(id_agent)
	{
		loading();
		$('#frame_data').load(base_url+'agent/edit/'+id_agent);
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
						alert("Data team sales berhasil ditambahkan.");
					}
					else if(result == "ok-edit")
					{
						alert("Data team sales berhasil diubah.");
					}
					
					list_data();
				}
			});
		}
		
		return false;
	}
	
	function detail(id_agent)
	{
		loading();
		$('#frame_data').load(base_url+'agent/detail/'+id_agent);
	}	
	
	function hapus(id_agent)
	{
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'agent/delete/'+id_agent, function(result){
				if(result == "ok")
				{
					$('#'+id_agent).fadeOut();
				}
			});	
		}
	}
	
function validasi()
{
	var team	= $('#team').val();
	var id_sm	= $('#id_sm').val();

	if(team == "")
	{
		alert("Nama team harus diisi !");
		$('#team').focus();
		return false;
	}
	else if(id_sm == "")
	{
		alert("Sales manager harus diisi !");
		$('#id_sm').focus();
		return false;
	}
	else
	{
		return true;
	}
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/);
    return pattern.test(emailAddress);
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
	
	list_data()
})
</script>


</body>
</html>