<?php echo $header; ?>

<script type="text/javascript">
	
	$(document).ready(function() {
		$('#laporan').change(function(){
			var laporan = $(this).val();
			if(laporan == "timeout" || laporan == "trash_data")
			{
				$('#tr-tanggal').hide();
			}
			else
			{
				$('#tr-tanggal').show();
			}
		});
		
		$('#id_agent').change(function(){
			var id_agent = $(this).val();
			$('#id_user').html('<option value=""> -- Sales -- </option>');
			if(id_agent != "" )
			{
				$('#id_user').load(base_url+'ajax/list_option_sales/'+id_agent);
			}
		});
	});
	
	$(function() {
		$("#tanggal").datepicker({ dateFormat: 'dd M yy' }).datepicker("setDate", "0");
	});

	function loading()
	{
		$('#frame_laporan').html('<div class="loading"></div>');
	}
	
	function show()
	{
		var laporan = $("#laporan").val();
		var type = $("#type").val();
		var dateObject = $('#tanggal').datepicker("getDate");
		var tanggal = $.datepicker.formatDate("yy-mm-dd", dateObject);
		var kategori = $("#kategori").val();
		var jenis_pemesanan = $("#jenis_pemesanan").val();
		
		var id_agent = $("#id_agent").val();
		var id_user = $("#id_user").val();
		
		loading();
		$('#frame_laporan').load(base_url+'printout/transaksi/'+laporan+'/'+type+'/'+tanggal+'/'+kategori+'/'+jenis_pemesanan+'/'+id_agent+'/'+id_user);
	}
	
	function printout()
	{
		var laporan = $("#laporan").val();
		var type = $("#type").val();
		var dateObject = $('#tanggal').datepicker("getDate");
		var tanggal = $.datepicker.formatDate("yy-mm-dd", dateObject);
		var kategori = $("#kategori").val();
		var jenis_pemesanan = $("#jenis_pemesanan").val();
		
		var id_agent = $("#id_agent").val();
		var id_user = $("#id_user").val();
		
		location.href = base_url+'printout/transaksi_print/'+laporan+'/'+type+'/'+tanggal+'/'+kategori+'/'+jenis_pemesanan+'/'+id_agent+'/'+id_user;
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
<div class="margin_center" style="width:99%">
	<div class="header_data">Laporan Transaksi</div>
	<div class="frame_tabel radius transparent" style="margin-bottom: 3px;">
	<table cellspacing="1px" cellpadding="1px">
		<tr bgcolor="#FFFFFF">
			<td width="150px" bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Jenis Laporan</div></td>
			<td width="400px">
				<div class="isi_tabel">
					<select name="laporan" id="laporan">
						<option value="booked">Booked</option>
						<option value="tanda_jadi">Tanda Jadi</option>
						<option value="sold">Sold</option>
						<option value="timeout">Timeout</option>
						<option value="trash_data">Trash Data</option>
					</select>
					
					<select name="kategori" id="kategori">
						<option value="0"> -- Kategori -- </option>
						<option value="RESIDENSIAL">RESIDENSIAL</option>
						<option value="RUKO">RUKO</option>
						<option value="KAVELING">KAVELING</option>
					</select>
					
					<select name="jenis_pemesanan" id="jenis_pemesanan">
						<option value="0"> -- Jenis Pemesanan -- </option>
						<option value="Marketable">Regular</option>
						<option value="Promo">Promo</option>
					</select>
				</div>
			</td>
		</tr>
		
		<tr bgcolor="#FFFFFF">
			<td bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Sales</div></td>
			<td>
			
				<div class="isi_tabel">
					<select name="id_agent" id="id_agent" <?php if($this->session->userdata('sm') == "Y"){echo 'style="display:none;"';} ?>>
						<option value="0"> -- Team -- </option>
						<?php
						
						foreach ($agent as $data_agent)
						{
							echo '<option value="'.$data_agent->id_agent.'"> '.$data_agent->team.' - '.$data_agent->sales_manager.' </option>';
						}
						
						?>
					</select>

					<select name="id_user" id="id_user">
						<option value="0"> -- Sales -- </option>
						<?php
						
						foreach ($user as $data_user)
						{
							echo '<option value="'.$data_user->id_user.'"> '.$data_user->nama_lengkap.' </option>';
						}
						
						?>
					</select>
				</div>
			</td>
		</tr>
		
		<tr bgcolor="#FFFFFF" id="tr-tanggal">
			<td bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Tanggal</div></td>
			<td>
				<div class="isi_tabel">
					<select name="type" id="type">
						<option value="bulanan">Bulanan</option>
						<option value="harian">Harian</option>
					</select>
					
					<input type="text" name="tanggal" size="13" id="tanggal" style="text-align:center;" />
				</div>
			</td>
		</tr>
		
		<tr bgcolor="#FFFFFF">
			<td bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;"></div></td>
			<td>
				<div class="isi_tabel">
					<input type="button" name="show" value="Tamplikan" id="show" onClick="javascript:show()" />
					<input type="button" name="cetak" value="Cetak" id="cetak" onClick="javascript:printout()" />
				</div>
			</td>
		</tr>
		
	</table>
	</div>
	
	<div class="clear"></div>
	
	<div id="frame_laporan"></div>
	
	<div class="clear" style="height:20px;"></div>
</div>
</div>

</body>
</html>