<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_data').html('<div class="loading"></div>');
	}
	
	function isInt(n) {return n % 1 === 0;}
	
	function list_data(posisi, show, ikey){
		
		if(isInt(show) === false)
		{
			show = 10;
		}
		
		if (ikey == "")
		{
			var filter_kategori = $('#filter_kategori').val();isUndefined(filter_kategori, '');
			var filter_cluster = $('#filter_cluster').val();isUndefined(filter_cluster, '');
			var filter_type = $('#filter_type').val();isUndefined(filter_type, '');
			var filter_kode_cluster = $('#filter_kode_cluster').val();isUndefined(filter_kode_cluster, '');
			var filter_blok = $('#filter_blok').val();isUndefined(filter_blok, '');
			var filter_nomor = $('#filter_nomor').val();isUndefined(filter_nomor, '');
			var filter_status_unit = $('#filter_status_unit').val();isUndefined(filter_status_unit, '');
			var filter_status_transaksi = $('#filter_status_transaksi').val();isUndefined(filter_status_transaksi, '');
			var order_by = $('#order_by').val();isUndefined(order_by, '');
			var sort_by = $('#sort_by').val();isUndefined(sort_by, '');
			
			var key = new Array();
			
			key[0] = filter_kategori;
			key[1] = filter_cluster;
			key[2] = filter_type;
			key[3] = filter_kode_cluster;
			key[4] = filter_blok;
			key[5] = filter_nomor;
			key[6] = filter_status_unit;
			key[7] = filter_status_transaksi;
			key[8] = order_by;
			key[9] = sort_by;
			
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
			$('#frame_data').load(base_url+'unit/list_data/'+posisi+'/'+show+'/'+key);
	}
	
	function add(posisi, show, ikey)
	{
		loading();
		$('#frame_data').load(base_url+'unit/add/'+posisi+'/'+show+"/"+ikey);
	}
	
	function post_add(posisi, show, ikey)
	{
		if(validasi() == false)
		{
			return false;
		}
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>unit/add/"+posisi+"/"+show+"/"+ikey,
			data: $("#form_add").serialize(),
			success: function(result) {
				if (result == 'ok')
				{
					alert('Data unit berhasil ditambahkan.');
					list_data(posisi, show, ikey);
				}
				else if (result == 'no')
				{
					alert('Gagal menambahkan data unit.');
					list_data(posisi, show, ikey);
				}
				else
				{
					$('#frame_data').html(result);
				}
		   }
		 });
	}
	
	function edit(id_unit, posisi, show, ikey)
	{
		$.ajax({url:"<?php echo base_url(); ?>unit/edit/"+id_unit+"/"+posisi+"/"+show+"/"+ikey, success:function(result){
			
			if (result == "yes you can't")
			{
				alert("Maaf, status unit ini tidak bisa diubah, karena sedang dalam proses transaksi");
			}
			else
			{
				loading();
				$("#frame_data").html(result);
			}
			
		}});

	}
	
	function post_edit(id_unit, posisi, show, ikey)
	{
		if(validasi() == false)
		{
			return false;
		}
		
		$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>unit/edit/"+id_unit+"/"+posisi+"/"+show+"/"+ikey,
			data: $("#form_edit").serialize(),
			success: function(result) {
				if (result == 'ok')
				{
					alert('Data unit berhasil diubah.');
					list_data(posisi, show, ikey);
				}
				else
				{
					$('#frame_data').html(result);
				}
		   }
		 });
	}
	
	function detail(id_unit, posisi, show, ikey)
	{
		loading();
		$('#frame_data').load(base_url+'unit/detail/'+id_unit+'/'+posisi+'/'+show+"/"+ikey);
	}
	
	function hapus(id_unit, posisi, show)
	{
		if(confirm("Yakin akan menghapus data?"))
		{
			$.post(base_url+'unit/delete/'+id_unit+'/'+posisi+'/'+show, function(data){
			
				if(data == "ok")
				{
					$('#tr_'+id_unit).fadeOut();
				}
				else
				{	
					alert(data);
				}	
			});
		}
		
	}
	
	function update_status_unit(id_unit, val)
	{
		var status_unit	= $(val).val();
		$.post(base_url+'unit/update_status_unit/'+id_unit+'/'+status_unit, function(result){
			
			if(result == "ok-mm")
			{
				$('#stu_'+id_unit).html(status_unit);
				alert('Status unit  berhasil diubah menjadi "'+status_unit+'"');
			}
			else if(result == "ok-p")
			{	
				$('#stu_'+id_unit).html('<font color="blue">'+status_unit+'</font>');
				alert('Status unit berhasil diubah menjadi "'+status_unit+'".\nSilahkan pilih menu "Master -> Promo" untuk menambahkan data diskon.');
			}
			else
			{	
				alert(result);
			}
		});
	}
	
	function reset_promo(){
	
		if(confirm("Yakin akan menghapus data promo?")){
			
			$.post(base_url+'promo/reset_promo', function(result){
				
				alert('Data unit dengan status "Promo" berhasil diubah menjadi "Marketable".');
				list_data(0, 20, '');
				
			});
		}
	}
	
	
	
	

	
function validasi()
{
	auto(0, 0);
	
	var kategori			= $('#kategori').val();
	var id_cluster			= $('#id_cluster').val();
	var id_type				= $('#id_type').val();
	var kode_cluster		= $('#kode_cluster').val();
	var kode_blok			= $('#kode_blok').val();
	var nomor				= $('#nomor').val();
	var status_unit			= $('#status_unit').val();
	var luas_tanah			= $('#luas_tanah').val();
	var luas_bangunan		= $('#luas_bangunan').val();
	var harga_tanah_m2		= $('#harga_tanah_m2').val();
	var harga_bangunan_m2	= $('#harga_bangunan_m2').val();
	var diskon_tanah		= $('#diskon_tanah').val();
	var diskon_bangunan		= $('#diskon_bangunan').val();
	var harga_tanah			= $('#harga_tanah').val();
	var harga_bangunan		= $('#harga_bangunan').val();
	var harga_jual_exc_ppn	= $('#harga_jual_exc_ppn').val();
	var harga_jual_inc_ppn	= ufm($('#harga_jual_inc_ppn').val());
	var tanda_jadi			= ufm($('#tanda_jadi').val());
	var persen_tanda_jadi	= $('#persen_tanda_jadi').val();
	var uang_muka			= ufm($('#uang_muka').val());
	var persen_uang_muka	= $('#persen_uang_muka').val();
	var plafon_kpr			= ufm($('#plafon_kpr').val());
	var suku_bunga			= $('#suku_bunga').val();
	var kpr_5_tahun			= $('#kpr_5_tahun').val();
	var kpr_10_tahun		= $('#kpr_10_tahun').val();
	var kpr_15_tahun		= $('#kpr_15_tahun').val();

	if(kategori == ""){alert("Kategori harus diisi !");$('#kategori').focus();return false;}
	else if(id_cluster == ""){alert("Cluster harus diisi !");$('#id_cluster').focus();return false;}
	else if(id_type == ""){alert("Type bangunan harus diisi !");$('#id_type').focus();return false;}
	else if(kode_cluster == ""){alert("Kode cluster harus diisi !");$('#kode_cluster').focus();return false;}
	else if(kode_blok == ""){alert("Blok harus diisi !");$('#kode_blok').focus();return false;}
	else if(nomor == ""){alert("Nomor blok harus diisi !");$('#nomor').focus();return false;}
	else if(status_unit == ""){alert("Status unit harus diisi !");$('#status_unit').focus();return false;}
	else if(luas_tanah == ""){alert("Luas tanah harus diisi !");$('#luas_tanah').focus();return false;}
	else if(luas_bangunan == ""){alert("Luas bangunan harus diisi !");$('#luas_bangunan').focus();return false;}
	else if(harga_tanah_m2 == ""){alert("Harga tanah/m2 harus diisi !");$('#harga_tanah_m2').focus();return false;}
	else if(harga_bangunan_m2 == ""){alert("Harga bangunan/m2 harus diisi !");$('#harga_bangunan_m2').focus();return false;}
	else if(diskon_tanah == ""){alert("Diskon tanah harus diisi !");$('#diskon_tanah').focus();return false;}
	else if(diskon_bangunan == ""){alert("Diskon bangunan harus diisi !");$('#diskon_bangunan').focus();return false;}
	else if(harga_tanah == ""){alert("Harga tanah harus diisi !");$('#harga_tanah').focus();return false;}
	else if(harga_bangunan == ""){alert("Harga bangunan harus diisi !");$('#harga_bangunan').focus();return false;}
	else if(harga_jual_exc_ppn == ""){alert("Harga jual exc. PPN harus diisi !");$('#harga_jual_exc_ppn').focus();return false;}
	else if(harga_jual_inc_ppn == ""){alert("Harga jual inc. PPN harus diisi !");$('#harga_jual_inc_ppn').focus();return false;}
	else if(tanda_jadi == ""){alert("Tanda jadi harus diisi !");$('#tanda_jadi').focus();return false;}
	else if(persen_tanda_jadi == ""){alert("Prosentase tanda jadi harus diisi !");$('#persen_tanda_jadi').focus();return false;}
	else if(uang_muka == ""){alert("Uang muka harus diisi !");$('#uang_muka').focus();return false;}
	else if(persen_uang_muka == ""){alert("Prosentase uang muka harus diisi !");$('#persen_uang_muka').focus();return false;}
	else if(plafon_kpr == ""){alert("Plafon KPR harus diisi !");$('#plafon_kpr').focus();return false;}
	else if(suku_bunga == ""){alert("Asumsi suku bunga harus diisi !");$('#suku_bunga').focus();return false;}
	else if(kpr_5_tahun == ""){alert("KPR 5 tahun harus diisi !");$('#kpr_5_tahun').focus();return false;}
	else if(kpr_10_tahun == ""){alert("KPR 10 tahun harus diisi !");$('#kpr_10_tahun').focus();return false;}
	else if(kpr_15_tahun == ""){alert("KPR 15 tahun harus diisi !");$('#kpr_15_tahun').focus();return false;}
	else if(plafon_kpr < 0){alert("Nilai tidak boleh minus !");$('#tanda_jadi').focus();return false;}
	else if((harga_jual_inc_ppn - (tanda_jadi + uang_muka)) != plafon_kpr){alert("Nilai tidak sesuai !");$('#plafon_kpr').focus();return false;}
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
	
	list_data(0, 20, 'all');

})
</script>


</body>
</html>