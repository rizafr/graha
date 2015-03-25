<?php include "fungsi_tanggal.php"; ?>

<script type="text/javascript">
$(document).ready(function(){
	
		$("#id_cluster").change(function(){
			
			$('#id_unit').empty();
			$('#id_unit').html('<option value="" data-type=""> -- Pilih Unit -- </option>');
			$('#type').empty();
			$("#diskon_tanah").val("0");
			$("#diskon_bangunan").val("0");
			
			$('.dkt').each(function() {
				$(this).val("0");
			});
			
			$('.dkb').each(function() {
				$(this).val("0");
			});
	
			var id_cluster = $(this).val();
			if(id_cluster != "")
			{
				get_unit_promo_opt();
			}
		});
		
		$("#id_unit").change(function(){
			
			$('#type').empty();
			$("#diskon_tanah").val("0");
			$("#diskon_bangunan").val("0");
			
			$('.dkt').each(function() {
				$(this).val("0");
			});
				
			$('.dkb').each(function() {
				$(this).val("0");
			});
			
			var id_unit = $(this).val();
			if(id_unit != "")
			{
				var type = $('option:selected', this).attr("data-type");
				var diskon_tanah = $('option:selected', this).attr("data-diskon-tanah");
				var diskon_bangunan = $('option:selected', this).attr("data-diskon-bangunan");
				
				$('.dkt').each(function() {
					$(this).val(diskon_tanah);
				});
				
				$('.dkb').each(function() {
					$(this).val(diskon_bangunan);
				});
				
				$('#type').html(type);
				$("#diskon_tanah").val(diskon_tanah);
				$("#diskon_bangunan").val(diskon_bangunan);
			}
			
			
			
		});
		
		$("#diskon_tanah").change(function(){
			
			isPercentKey("#diskon_tanah");
			
			$('.dkt').each(function() {
				$(this).val($("#diskon_tanah").val());
			});
		});
		
		$("#diskon_bangunan").change(function(){
			
			isPercentKey("#diskon_bangunan");
			
			$('.dkb').each(function() {
				$(this).val($("#diskon_bangunan").val());
			});
		});
		
});

function get_unit_promo_opt()
{
	var id_cluster = $("#id_cluster").val();
	$('#id_unit').empty();
	$('#id_unit').html('<option value="" data-type=""> -- Pilih Unit -- </option>');
	$('#type').empty();
	$("#diskon_tanah").val("0");
	$("#diskon_bangunan").val("0");
			
	$('.dkt').each(function() {
		$(this).val("0");
	});
				
	$('.dkb').each(function() {
		$(this).val("0");
	});
	
	$('#id_unit').load(base_url+'ajax/get_unit_promo_opt/'+id_cluster+'/<?php echo $promo->id_promo; ?>');
}

function list_data_unit_promo_rfs()
{
	$('#data-unit-promo').html('<div class="loading"></div>');
	$('#data-unit-promo').load(base_url+'promo/list_data_unit_promo_rfs/<?php echo $promo->id_promo; ?>');
}

function add_unit_promo()
{

	var id_promo = <?php echo $promo->id_promo; ?>;
	var id_unit = $("#id_unit").val();
	var kode_unit = $('option:selected', "#id_unit").html();
	if (id_unit == "")
	{
		return false;
	}
	
	$.ajax({
		type: "POST",
		url: "<?php echo base_url(); ?>promo/save_unit_promo/"+id_promo+"/"+id_unit+"/Tambah",
		data: $("#form_add").serialize(),
		success: function(result)
		{
			if(result == "ok")
			{
				alert("Unit "+kode_unit+" berhasil ditambahkan.");
			}
			else
			{
				alert(result);
			}
				
			get_unit_promo_opt();
			list_data_unit_promo_rfs();
		}
	});
}

function edit_unit_promo(id_unit)
{
	var id_promo = <?php echo $promo->id_promo; ?>;
	
	var dataArray = {};
	$(".post_"+id_unit).each(function(){
		dataArray[$(this).attr('name')] = $(this).val();
	});

	$.ajax({
			type: "POST",
			url: "<?php echo base_url(); ?>promo/save_unit_promo/"+id_promo+"/"+id_unit+"/Ubah",
			data: dataArray,
			success: function(result) {
				if(result == "ok")
				{
					alert("Data diskon berhasil diubah.");
				}
				else
				{
					alert(result);
				}
				
				get_unit_promo_opt();
				list_data_unit_promo_rfs();
		   }
	 });
}

function delete_unit_promo(id_unit)
{

	if(confirm("Yakin akan menghapus data?"))
	{
		
		$.post(base_url+'promo/delete_unit_promo/'+id_unit, function(result){
			if(result == "ok")
			{
				$("#"+id_unit).fadeOut();
				$("#"+id_unit).remove();
				$("#det_"+id_unit).remove();
			}
			else
			{
				alert(result);
			}
			
			get_unit_promo_opt();
		});
	}

}

	function isPercentKey(id)
	{
		var val = fm2($(id).val());
		if(isNaN(val) || val >= 100 || val < 0)
		{
			$(id).val("0.00");
		}
		else
		{
			$(id).val(val);
		}
	}
	
</script>

<div class="margin_center" style="width:1000px">		
	<div class="header_data">Unit Promo</div>
	<div class="tombol_tambah">
		<a href="" onClick="javascript:list_data(<?php echo $posisi; ?>); return false;"><input type="button" value="&laquo; Kembali"></a>
	</div>
	<form name="form_add" id="form_add" method="post" action="">
	<div class="frame_tabel radius transparent">
		<table width="450px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="isi_tabel"><strong>Cluster</strong></div></td>
				<td width="400px" colspan="2">
					<div class="isi_tabel">
						<strong>
							<select name="id_cluster" id="id_cluster">
								<option value=""> -- Pilih Cluster -- </option>
	
								<?php
								foreach($cluster as $data_cluster)
								{
									echo '<option value="'.$data_cluster->id_cluster.'">'.$data_cluster->nama_cluster.'</option>';
								}
								?>
							</select>
						</strong>
					</div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Unit</strong></div></td>
				<td colspan="2">
					<div class="isi_tabel">
						<strong>
							<select name="id_unit" id="id_unit">
								<option value=""> -- Pilih Unit -- </option>
							</select>
						</strong>
					</div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Type</strong></div></td>
				<td colspan="2" height="28px;">
					<div class="isi_tabel" id="type"></div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Diskon Tanah</strong></div></td>
				<td colspan="2">
					<div class="isi_tabel">
						<strong>
							<input type="text" size="5" id="diskon_tanah" name="diskon_tanah" value="0" onBlur="return isPercentKey(this)" style="text-align:right;"> %
						</strong>
					</div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Diskon Bangunan</strong></div></td>
				<td colspan="2">
					<div class="isi_tabel">
						<strong>
							<input type="text" size="5" id="diskon_bangunan" name="diskon_bangunan" value="0" onBlur="return isPercentKey(this)" style="text-align:right;"> %
						</strong>
					</div>
				</td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#0066FF" rowspan="2"><div class="header_tabel">Cara Pembayaran</div></td>
				<td bgcolor="#999999" colspan="2"><div class="header_tabel">Maksimun Diskon</div></td>
			</tr>
			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="header_tabel">Tanah</div></td>
				<td bgcolor="#999999"><div class="header_tabel">Bangunan</div></td>
			</tr>
			
			<?php
			foreach ($cara_pembayaran AS $cp)
			{
				?>
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong><?php echo $cp->cara_pembayaran; ?>x</strong></div></td>
					<td align="center">
						<div class="isi_tabel">
							<strong>
								<input type="text" size="5" class="dkt" name="mx_tnh[<?php echo $cp->id_cara_pembayaran; ?>]" value="0" onBlur="return isPercentKey(this)" style="text-align:right;"> %
							</strong>
						</div>
					</td>
					
					<td align="center">
						<div class="isi_tabel">
							<strong>
								<input type="text" size="5" class="dkb" name="mx_bgn[<?php echo $cp->id_cara_pembayaran; ?>]" value="0" onBlur="return isPercentKey(this)" style="text-align:right;"> %
							</strong>
						</div>
					</td>
				</tr>
				<?php
			}
			?>
			
			<tr bgcolor="#FFFFFF">
				<td valign="top" bgcolor="#999999"><div class="isi_tabel"></div></td>
				<td colspan="2" align="right">
					<div class="isi_tabel">
						<input type="submit" value="Tambahkan &#10003;" onClick="javascript:add_unit_promo(); return false;">
					</div>
				</td>
			</tr>
		</table>
	</div>
	</form>
	
	<div class="frame_tabel radius transparent" style="position:absolute; margin-left:500px;">
		<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td width="150px" bgcolor="#999999"><div class="isi_tabel"><strong>Nama Promo</strong></div></td>
				<td width="450px"><div class="isi_tabel"><?php echo $promo->nama_promo; ?></div></td>
			</tr>	
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Mulai</strong></div></td>
				<td><div class="isi_tabel"><?php echo ubah_format_tanggal($promo->tanggal_mulai); ?></div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Akhir</strong></div></td>
				<td><div class="isi_tabel"><?php echo ubah_format_tanggal($promo->tanggal_akhir); ?></div></td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>Status</strong></div></td>
				<td>
					<?php
					if($promo->status_promo == "1"){
					?>
					
					<div class="isi_tabel" style="color:#090;">Aktif</div>
					
					<?php
					}else if($promo->status_promo == "0"){
					?>
					
					<div class="isi_tabel" style="color:#090;">Tidak Aktif</div>
					
					<?php
					}
					?>
				</td>
			</tr>			
			<tr bgcolor="#FFFFFF">
				<td valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Deskripsi</strong></div></td>
				<td><div class="isi_tabel"><?php echo $promo->deskripsi; ?></div></td>
			</tr>
		</table>
	</div>
	
	<div class="clear"></div><br /><br />
	
	<div id="data-unit-promo" class="frame_tabel radius transparent" style="width:1000px;">
	
	</div>
	
	<script type="text/javascript">
	$(document).ready(function() {
		
		$('#data-unit-promo').load(base_url+'promo/list_data_unit_promo_rfs/<?php echo $promo->id_promo; ?>');

	});
	</script>
	
	<div class="clear" style="height:40px;"></div>
</div>