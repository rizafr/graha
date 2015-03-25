<?php echo $header; ?>



<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data(posisi, ikey){
		
		if (ikey == "")
		{
			var nama_cluster = $("#nama_cluster").val();isUndefined(nama_cluster, '');
			
			var key = new Array();
			
			key[0] = nama_cluster;
			
			key = key.join('#');
			key = B64.encode(key);
		}
		else if (ikey == "all")
		{
			var key = '';
		}
		else
		{
			var key = ikey;
		}
		
		loading();
		$('#frame_data').load(base_url+'cluster/list_data/'+posisi+'/'+key);
	}
	
	function hapus(id_cluster)
	{
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'cluster/delete/'+id_cluster, function(result){
				if(result == "ok")
				{
					$('#'+id_cluster).fadeOut();
				}
			});	
		}
		
		return false;
	}
	
	function detail(id_cluster, posisi, ikey)
	{
		loading();
		$('#frame_data').load(base_url+'cluster/detail/'+id_cluster+'/'+posisi+'/'+ikey);
		
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
	
	list_data(0, '');

})
</script>


</body>
</html>