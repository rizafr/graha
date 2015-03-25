<?php include "fungsi_tanggal.php"; ?>
<?php include "fungsi_kode.php"; ?>

<script type="text/javascript">
	var winHeight = $(window).height();
	$('#stok_list').css('height', winHeight-50);
</script>
		
<div class="margin_center" style="width:99%;">

	<div class="clear" style="height:30px;"></div>
	
	<div class="frame_tabel_cust radius transparent" id="stok_list" style="float:none; overflow:scroll;">
		<table style="white-space:nowrap; min-width:100%;" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			
			<tr bgcolor="#FFFFFF">
				<td rowspan="2" class="header_tabel_cust center"> Cluster </td>
				<td rowspan="2" class="header_tabel_cust center"> Kode Blok </td>
				<td rowspan="2" class="header_tabel_cust center"> Tipe Produk </td>
				<td rowspan="2" class="header_tabel_cust center"> Tipe Bangunan </td>
				<td colspan="2" class="header_tabel_cust center"> Luas (m&sup2;) </td>
				<td rowspan="2" class="header_tabel_cust center"> Harga Tanah/m&sup2; </td> 
				<td rowspan="2" class="header_tabel_cust center"> T+ </td>
				<td rowspan="2" class="header_tabel_cust center"> Harga Bang/m&sup2; </td> 
				<td colspan="2" class="header_tabel_cust center"> Diskon </td>
				<td colspan="2" class="header_tabel_cust center"> Harga </td>
				<td rowspan="2" class="header_tabel_cust center"> Harga Exc. PPN </td>
				<td colspan="2" class="header_tabel_cust center"> Pajak </td>
				<td rowspan="2" class="header_tabel_cust center"> Total PPN </td>
				<td rowspan="2" class="header_tabel_cust center"> Harga Inc. PPN </td>
				<td rowspan="2" class="header_tabel_cust center"> Kelas Produk </td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td class="header_tabel_cust center"> Tnh </td>
				<td class="header_tabel_cust center"> Bang </td>
				<td class="header_tabel_cust center"> Tnh </td>
				<td class="header_tabel_cust center"> Bang </td>
				<td class="header_tabel_cust center"> Tnh </td>
				<td class="header_tabel_cust center"> Bang </td>
				<td class="header_tabel_cust center"> Tnh </td>
				<td class="header_tabel_cust center"> Bang </td>
			</tr>
			
			<?php
			
			$sum_luas_tanah	= 0;
			$sum_luas_bangunan = 0;
			$sum_harga_tanah = 0;
			$sum_harga_bangunan = 0;
			$sum_harga_jual_exc_ppn = 0;
			$sum_ppn_tanah = 0;
			$sum_ppn_bangunan = 0;
			$sum_total_ppn = 0;
			$sum_harga_jual_inc_ppn = 0;
			
			foreach($lap as $b)
			{
				if ($b->status_unit == "Promo")
				{
					$data = array(
						"luas_tanah"		=> $b->luas_tanah,
						"luas_bangunan" 	=> $b->luas_bangunan,
						"harga_tanah_m2"	=> $b->harga_tanah_m2,
						"harga_bangunan_m2"	=> $b->harga_bangunan_m2,
						"diskon_tanah"		=> $b->diskon_tanah,
						"diskon_bangunan"	=> $b->diskon_bangunan,
						"fs"				=> $b->fs);
							
					$res = hitung($data);
					
					$diskon_tanah = $b->diskon_tanah;
					$diskon_bangunan = $b->diskon_bangunan;
					$harga_tanah = $res["harga_tanah"];
					$harga_bangunan = $res["harga_bangunan"];
					$harga_jual_exc_ppn = $res["harga_jual_exc_ppn"];
					$ppn_tanah = $res["ppn_tanah"];
					$ppn_bangunan = $res["ppn_bangunan"];
					$total_ppn = $res["total_ppn"];
					$harga_jual_inc_ppn = $res["harga_jual_inc_ppn"];
				}
				else
				{
					$diskon_tanah = 0.00;
					$diskon_bangunan = 0.00;
					$harga_tanah = $b->harga_tanah;
					$harga_bangunan = $b->harga_bangunan;
					$harga_jual_exc_ppn = $b->harga_jual_exc_ppn;
					$ppn_tanah = $b->ppn_tanah;
					$ppn_bangunan = $b->ppn_bangunan;
					$total_ppn = $b->total_ppn;
					$harga_jual_inc_ppn = $b->harga_jual_inc_ppn;
				}
				
				?>
				<tr class="hover">
					<td class="isi_tabel"> <?php echo $b->nama_cluster; ?> </td>
					<td class="isi_tabel"> <?php echo $b->kode_unit; ?> </td>
					<td class="isi_tabel"> <?php echo $b->kategori; ?> </td>
					<td class="isi_tabel"> <?php echo $b->tipe_bangunan; ?> </td>
					<td class="isi_tabel right"> <?php echo $b->luas_tanah; ?> </td>
					<td class="isi_tabel right"> <?php echo $b->luas_bangunan; ?> </td>
					<td class="isi_tabel right"> <?php echo number_format($b->harga_tanah_m2, 0); ?> </td>
					<td class="isi_tabel right"> <?php echo $b->fs; ?>% </td>
					<td class="isi_tabel right"> <?php echo number_format($b->harga_bangunan_m2, 0); ?> </td>
					<td class="isi_tabel right"> <?php echo $diskon_tanah; ?>% </td>
					<td class="isi_tabel right"> <?php echo $diskon_bangunan; ?>% </td>
					<td class="isi_tabel right"> <?php echo number_format($harga_tanah, 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format($harga_bangunan, 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format($harga_jual_exc_ppn, 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format($ppn_tanah, 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format($ppn_bangunan, 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format($total_ppn, 0); ?> </td>
					<td class="isi_tabel right"> <?php echo number_format($harga_jual_inc_ppn, 0); ?> </td>
					<td class="isi_tabel center"> <?php echo $b->kelas_produk; ?> </td>
				</tr>
				<?php
				
				$sum_luas_tanah += $b->luas_tanah;
				$sum_luas_bangunan += $b->luas_bangunan;
				$sum_harga_tanah += $harga_tanah;
				$sum_harga_bangunan += $harga_bangunan;
				$sum_harga_jual_exc_ppn += $harga_jual_exc_ppn;
				$sum_ppn_tanah += $ppn_tanah;
				$sum_ppn_bangunan += $ppn_bangunan;
				$sum_total_ppn += $total_ppn;
				$sum_harga_jual_inc_ppn += $harga_jual_inc_ppn;
			}
			?>
			
			<tr bgcolor="#B0B0B0">
				<td class="header_tabel_cust center" colspan="4"> Total </td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_luas_tanah, 2); ?> </td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_luas_bangunan, 2); ?> </td>
				<td class="isi_tabel" colspan="5"></td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_harga_tanah, 0); ?> </td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_harga_bangunan, 0); ?> </td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_harga_jual_exc_ppn, 0); ?> </td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_ppn_tanah, 0); ?> </td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_ppn_bangunan, 0); ?> </td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_total_ppn, 0); ?> </td>
				<td class="isi_tabel right bold"> <?php echo number_format($sum_harga_jual_inc_ppn, 0); ?> </td>
				<td class="isi_tabel"></td>
			</tr>
			
		</table>
	</div>

</div>