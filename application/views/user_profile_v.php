<?php include "fungsi_tanggal.php"; ?>
<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function profile_detail()
	{
		loading();
		$('#frame_data').load(base_url+'user/profile_detail');
	}
	
	function profile_form()
	{
		loading();
		$('#frame_data').load(base_url+'user/profile_form');
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
					if(result == "ok-edit")
					{
						alert("Data profile berhasil diubah.");
					}
					
					profile_detail();
				}
			});
		}
		
		return false;
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
	var password		= $('#password').val();
	var password_conf	= $('#password_conf').val();

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
	else if(!isValidEmailAddress(email)) 
	{
		alert("Format email yang anda masukkan kurang benar !");
		$('#email').focus();
		return false;
	}
	else
	{
		return true;
	}
}

function isValidEmailAddress(emailAddress) {
    var pattern = new RegExp(/^((([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+(\.([a-z]|\d|[!#\$%&'\*\+\-\/=\?\^_`{\|}~]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])+)*)|((\x22)((((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(([\x01-\x08\x0b\x0c\x0e-\x1f\x7f]|\x21|[\x23-\x5b]|[\x5d-\x7e]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(\\([\x01-\x09\x0b\x0c\x0d-\x7f]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))))*(((\x20|\x09)*(\x0d\x0a))?(\x20|\x09)+)?(\x22)))@((([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|\d|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.)+(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])*([a-z]|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])))\.?$/i);
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
	
	profile_detail();

})
</script>

</body>
</html>

