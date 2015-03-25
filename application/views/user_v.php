<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function list_data(posisi, ikey){
		
		if (ikey == "")
		{
			var s_nama_lengkap = $("#s_nama_lengkap").val();s_nama_lengkap = isUndefined(s_nama_lengkap, '');
			
			var key = new Array();
			
			key[0] = s_nama_lengkap;
			
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
		$('#frame_data').load(base_url+'user/list_data/'+posisi+'/'+key);
	}
	
	function add(posisi, ikey)
	{
		loading();
		$('#frame_data').load(base_url+'user/form_data_user/add/0/'+posisi+'/'+ikey);
	}
	
	function edit(id_user, posisi, ikey)
	{
		loading();
		$('#frame_data').load(base_url+'user/form_data_user/edit/'+id_user+'/'+posisi+'/'+ikey);
	}
	
	function post(ini, posisi, ikey)
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
						alert("Data user berhasil ditambahkan.");
					}
					else if(result == "ok-edit")
					{
						alert("Data user berhasil diubah.");
					}
					else
					{
						alert(result);
						return false;
					}
					
					list_data(posisi, ikey);
				}
			});
		}
		
		return false;
	}
	
	function detail(id_user, posisi, ikey)
	{
		loading();
		$('#frame_data').load(base_url+'user/detail/'+id_user+'/'+posisi+'/'+ikey);
	}
	
	function hapus(id_user)
	{
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'user/delete/'+id_user, function(result){
				if(result == "ok")
				{
					$('#'+id_user).fadeOut();
				}
			});	
		}
	}

function validasi()
{
	var nama_lengkap	= $('#nama_lengkap').val();
	var tempat_lahir	= $('#tempat_lahir').val();
	var tanggal_lahir	= $('#tanggal_lahir').val();
	var bulan_lahir		= $('#bulan_lahir').val();
	var tahun_lahir		= $('#tahun_lahir').val();
	var email			= $('#email').val();
	var telepon			= $('#telepon').val();
	var hp				= $('#hp').val();
	var alamat			= $('#alamat').val();
	var id_agent		= $('#id_agent').val();
	var level			= $('#level').val();
	var status_transaksi = $('#status_transaksi').val();
	var username		= $('#username').val();
	var password		= $('#password').val();
	var password_conf	= $('#password_conf').val();
	var status_js		= $('#status_js').val();

	if(nama_lengkap == "")
	{
		alert("Nama Lengkap harus diisi !");
		$('#nama_lengkap').focus();
		return false;
	}
	else if(tempat_lahir == "")
	{
		alert("Tempat Lahir harus diisi !");
		$('#tempat_lahir').focus();
		return false;
	}
	else if(tanggal_lahir == "")
	{
		alert("Tanggal Lahir harus diisi !");
		$('#tanggal_lahir').focus();
		return false;
	}
	else if(bulan_lahir == "")
	{
		alert("Bulan Lahir harus diisi !");
		$('#bulan_lahir').focus();
		return false;
	}
	else if(tahun_lahir == "")
	{
		alert("Tahun Lahir harus diisi !");
		$('#tahun_lahir').focus();
		return false;
	}
	else if(email == "")
	{
		alert("Email harus diisi !");
		$('#email').focus();
		return false;
	}
	else if(!isValidEmailAddress(email)) 
	{
		alert("Format email yang anda masukkan tidak valid !");
		$('#email').focus();
		return false;
	}
	else if(hp == "")
	{
		alert("No. HP harus diisi !");
		$('#hp').focus();
		return false;
	}
	else if(alamat == "")
	{
		alert("Alamat harus diisi !");
		$('#alamat').focus();
		return false;
	}
	else if(id_agent == "" && level == "Sales")
	{
		alert("Team sales harus diisi harus diisi !");
		$('#id_agent').focus();
		return false;
	}
	else if(level == "")
	{
		alert("Level harus diisi !");
		$('#level').focus();
		return false;
	}
	else if(status_transaksi == "")
	{
		alert("Status transaksi harus diisi !");
		$('#status_transaksi').focus();
		return false;
	}
	else if(username == "")
	{
		alert("Username harus diisi !");
		$('#username').focus();
		return false;
	}
	else if(password != "" || password_conf != "")
	{
		if(password == "")
		{
			alert("Password harus diisi !");
			$('#password').focus();
			return false;
		}
		if(password_conf == "")
		{
			alert("Konfirmasi Password harus diisi harus diisi !");
			$('#password_conf').focus();
			return false;
		}
	}
	
	if(status_js == "add")
	{
		if(password == "")
		{
			alert("Password harus diisi !");
			$('#password').focus();
			return false;
		}
		if(password_conf == "")
		{
			alert("Konfirmasi Password harus diisi harus diisi !");
			$('#password_conf').focus();
			return false;
		}
	}
	
	if(telepon != "")
	{	
		if(isNaN($('#telepon').val() / 1) == true)
		{
			alert("No. telepon harus numerik !");
			$('#telepon').focus();
			return false;
		}
	}
	
	if(password_conf != password)
	{
		alert("Konfirmasi password anda tidak sesuai !");
		$('#password_conf').focus();
		return false;
	}
	else if(isNaN($('#hp').val() / 1) == true)
	{
		alert("No. HP harus numerik !");
		$('#hp').focus();
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
	
	list_data(0, '');

})
</script>


</body>
</html>