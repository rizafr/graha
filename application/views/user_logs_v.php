<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data_logs(posisi, show, ikey){
		
		if (ikey == "")
		{
			var pencarian = $("#pencarian").val(); pencarian = isUndefined(pencarian, '');
			var cari = $("#cari").val(); cari = isUndefined(cari, '');
			var tanggal_mulai = $("#tanggal_mulai").val(); tanggal_mulai = isUndefined(tanggal_mulai, '');
			var tanggal_selesai = $("#tanggal_selesai").val(); tanggal_selesai = isUndefined(tanggal_selesai, '');
			
			if (tanggal_mulai != "")
			{
				var dateObject1 = $('#tanggal_mulai').datepicker("getDate");
				tanggal_mulai = $.datepicker.formatDate("yy-mm-dd", dateObject1);
			}
			
			if (tanggal_selesai != "")
			{
				var dateObject2 = $('#tanggal_selesai').datepicker("getDate");
				tanggal_selesai = $.datepicker.formatDate("yy-mm-dd", dateObject2);
			}
			
			var key = new Array();
			
			key[0] = cari;
			key[1] = pencarian;
			key[2] = tanggal_mulai;
			key[3] = tanggal_selesai;
			
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
		$('#frame_data').load(base_url+'user/list_data_logs/'+posisi+'/'+show+'/'+key);
	}
	
	function hapus_log(){
		
		var tanggal_mulai = $("#tanggal_mulai").val(); tanggal_mulai = isUndefined(tanggal_mulai, '');
		var tanggal_selesai = $("#tanggal_selesai").val(); tanggal_selesai = isUndefined(tanggal_selesai, '');
			
		if (tanggal_mulai == "" || tanggal_selesai == "")
		{
			alert("Pilih periode log yang akan dihapus.");
			$("#tanggal_mulai").focus();
			return false;
		}
		
		if(confirm("Yakin akan menghapus data log "+tanggal_mulai+" s/d "+tanggal_selesai))
		{
			var dateObject1 = $('#tanggal_mulai').datepicker("getDate");
			tanggal_mulai = $.datepicker.formatDate("yy-mm-dd", dateObject1);
			var dateObject2 = $('#tanggal_selesai').datepicker("getDate");
			tanggal_selesai = $.datepicker.formatDate("yy-mm-dd", dateObject2);
			
				var key = tanggal_mulai+"#"+tanggal_selesai;
				key = B64.encode(key);
			
				$.post(base_url+'user/hapus_data_logs/'+key, function(result){
					if(result == "ok")
					{
						alert("Data log berhasil dihapus.");
						list_data_logs(0, 20, '');
					}
					else
					{
						alert("Data log tidak ditemukan.");
					}
				});
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
	
	list_data_logs(0, 20, '');

})
</script>

</body>
</html>