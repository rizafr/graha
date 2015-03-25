<?php echo $header; ?>

<script type="text/javascript">
	
	function loading()
	{
		$('#frame_laporan').html('<div class="loading"></div>');
	}
	
	function show()
	{
		var laporan = $("#laporan").val();
		var kategori = $("#kategori").val();
		loading();
		$('#frame_laporan').load(base_url+'printout/stok_data/'+laporan+'/'+kategori);
	}
	
	function printout()
	{
		var laporan = $("#laporan").val();
		var kategori = $("#kategori").val();
		
		location.href = base_url+'printout/stok_print/'+laporan+'/'+kategori;
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
	<div class="header_data">Laporan Stok Unit</div>
	<div class="frame_tabel radius transparent" style="margin-bottom: 3px;">
	<table cellspacing="1px" cellpadding="1px">
		<tr bgcolor="#FFFFFF">
			<td width="150px" bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;">Status Unit</div></td>
			<td width="350px">
				<div class="isi_tabel">
					<select name="laporan" id="laporan">
						<option value="Master">Master</option>
						<option value="Marketable">Marketable</option>
						<option value="Promo">Promo</option>
					</select>
					
					<select name="kategori" id="kategori">
						<option value="0"> -- Kategori -- </option>
						<option value="RESIDENSIAL">RESIDENSIAL</option>
						<option value="RUKO">RUKO</option>
						<option value="KAVELING">KAVELING</option>
					</select>
				</div>
			</td>
		</tr>
		
		<tr bgcolor="#FFFFFF">
			<td width="150px" bgcolor="#0066FF"><div class="header_tabel_cari" style="height: 100%;"></div></td>
			<td width="350px">
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