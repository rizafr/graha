<?php include "fungsi_tanggal.php"; ?>
<?php echo $header; ?>



<script type="text/javascript">

	
	<?php
if ($status == "Promo")
{
?>
	
	$(document).ready(function(){
		
		auto();
	});
	
	function PMT(i, n, p)
	{
		return i * p * Math.pow((1 + i), n) / (1 - Math.pow((1 + i), n));
	}
	
	function auto(){
			
			var luas_tanah			= <?php echo $data_unit->luas_tanah; ?>;
			var luas_bangunan		= <?php echo $data_unit->luas_bangunan; ?>;
			var harga_tanah_m2		= <?php echo $data_unit->harga_tanah_m2; ?>;
			var harga_bangunan_m2	= <?php echo $data_unit->harga_bangunan_m2; ?>;
			var diskon_tanah		= <?php echo $pemesanan->diskon_tanah; ?> / 100;
			var diskon_bangunan		= <?php echo $pemesanan->diskon_bangunan; ?> / 100;
			
			var fs					= <?php echo $data_unit->fs; ?> / 100;
			var persen_tanda_jadi	= <?php echo $data_unit->persen_tanda_jadi; ?> / 100;
			var persen_uang_muka	= <?php echo $data_unit->persen_uang_muka; ?> / 100;
			var suku_bunga			= <?php echo $data_unit->suku_bunga; ?> / 100;
			
			var harga_tanah			= (luas_tanah * (harga_tanah_m2*(1 + fs)) * (1 - diskon_tanah));
			var harga_bangunan		= (luas_bangunan * harga_bangunan_m2) * (1 - diskon_bangunan);
			
			var harga_jual_exc_ppn	= harga_tanah + harga_bangunan;
			var ppn_tanah			= harga_tanah / 10;
			var ppn_bangunan		= harga_bangunan / 10;
			var total_ppn			= ppn_tanah + ppn_bangunan;
			
			var harga_jual_inc_ppn	= harga_jual_exc_ppn + total_ppn;
			var tanda_jadi			= harga_jual_inc_ppn * persen_tanda_jadi;
			var uang_muka			= harga_jual_inc_ppn * persen_uang_muka;
			
			var plafon_kpr			= harga_jual_inc_ppn - (tanda_jadi + uang_muka);
			var kpr_5_tahun			= PMT(suku_bunga / 12, 60, -plafon_kpr);
			var kpr_10_tahun		= PMT(suku_bunga / 12, 120, -plafon_kpr);
			var kpr_15_tahun		= PMT(suku_bunga / 12, 180, -plafon_kpr);
			
			$("#harga_jual_inc_ppn").html(fm(harga_jual_inc_ppn));
			$("#tanda_jadi").html(fm(tanda_jadi));
			$("#uang_muka").html(fm(uang_muka));
			$("#plafon_kpr").html(fm(plafon_kpr));
			
			$("#kpr_5_tahun").html(fm(kpr_5_tahun));
			$("#kpr_10_tahun").html(fm(kpr_10_tahun));
			$("#kpr_15_tahun").html(fm(kpr_15_tahun));
	}
	
<?php
}
?>
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
	
	<div class="margin_center" style="width:1000px">
		<div class="header_data">Data Unit Dipesan</div>	
		<div class="frame_tabel radius transparent">	
			<table style="width:100%;" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
				<tr bgcolor="#FFFFFF">
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Kategori</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Cluster</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Unit</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Type</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Status</div></td>
					<td rowspan="2" colspan="2"class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Luas (m&sup2;)</div></td>
					<td rowspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Harga Jual Incl. PPN</div></td>
					<td colspan="6" class="header_tabel_cust"><div style="color:#FFF; text-align:center;">KPR (Asumsi Suku Bunga <?php echo $data_unit->suku_bunga; ?>%)</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Tanda Jadi</div></td>
					<td rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Uang Muka</div></td>
					<td rowspan="2" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Plafon KPR</div></td>
					<td colspan="3" class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Angsuran</div></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Tnh</div></td>
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">Bang</div></td>
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">5 Tahun</div></td>
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">10 Tahun</div></td>
					<td class="header_tabel_cust"><div style="color:#FFF; text-align: center;">15 Tahun</div></td>
				</tr>
				</thead>		
				
				<tr class="hover">
					<td><div class="isi_tabel"> <?php echo $data_unit->kategori; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_unit->nama_cluster; ?> </div></td>
					<td><div class="isi_tabel nowrap"> <?php echo $data_unit->kode_unit; ?> </div></td>
					<td><div class="isi_tabel"> <?php echo $data_unit->nama_type." ".$data_unit->posisi; ?> </div></td>
					<td align="center">
						<div class="isi_tabel"> 				
							
							<?php 
							if($data_unit->status_transaksi == "Booked")
							{
								echo "<font color='green'>".$data_unit->status_transaksi."</font>"; 
							}
							else
							{
								echo "<font color='red'>".$data_unit->status_transaksi."</font>";
							}
							?> 
							
						</div>					
					</td>
					<td align="center"><div class="isi_tabel"> <?php echo $data_unit->luas_tanah; ?> </div></td>
					<td align="center"><div class="isi_tabel"> <?php echo $data_unit->luas_bangunan; ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->harga_jual_inc_ppn), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->tanda_jadi), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->uang_muka), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->plafon_kpr), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_5_tahun), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_10_tahun), 0); ?> </div></td>
					<td align="right"><div class="isi_tabel"> <?php echo number_format(round($data_unit->kpr_15_tahun), 0); ?> </div></td>
				</tr>
				
				<?php
				if($status == "Promo")
				{
				?>
				
				<tr class="hover">
					<td colspan="7" class="header_tabel_cust">
						<div style="color:#FFF; text-align:right;"><b>Harga Setelah Diskon</b></div>
					</td>
					<td align="right"><div class="isi_tabel" id="harga_jual_inc_ppn"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="tanda_jadi"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="uang_muka"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="plafon_kpr"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="kpr_5_tahun"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="kpr_10_tahun"> 
						
					</div></td>
					<td align="right"><div class="isi_tabel" id="kpr_15_tahun"> 
						
					</div></td>
				</tr>
				
				<tr class="hover">
					<td class="header_tabel_cust">
						<div style="color:#FFF; text-align:center;">Promo</div>
					</td>
					<td colspan="13" align="left">
						<div class="isi_tabel"> 
							<?php echo "<strong>".$nama_promo."</strong><br />".$deskripsi; ?>
						</div>
					</td>
				</tr>
				
				<?php
				}
				?>
				
			</table>
		</div>
		<div class="clear" style="height:40px;"></div>
		
		<div class="header_data">Data Pemesan</div>	
		<div class="tombol_tambah">
			<a href="<?php echo base_url(); ?>report/timeout/0"><input type="button" value="&laquo; Kembali"></a>
			<a href="<?php echo base_url(); ?>booking/print_form/0/<?php echo $id_unit."/".$id_kartu_keluarga."/".$id_pemesanan; ?>" target="_blank"><input type="button" value="Print &#9113;"></a>
		</div>		
		
		<style type="text/css">
			#td-height td { height:19px; }
		</style>

		<div class="frame_tabel radius transparent" style="width:1000px" id="td-height">		
			<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">
				<tr bgcolor="#FFFFFF">
					<td width="200" bgcolor="#999999"><div class="isi_tabel"><strong>Nama Lengkap</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo $pemesanan->nama_lengkap; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>No. KTP</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo $pemesanan->no_ktp; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>No. Kartu Keluarga</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo $kartu_keluarga->no_kartu_keluarga; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>No.NPWP</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo $pemesanan->no_npwp; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Telpon<strong></strong></strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo $pemesanan->telpon; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>HP<strong></strong></strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo $pemesanan->hp; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Email</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo $pemesanan->email; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td style="height:59px;" valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Alamat Surat Menyurat</strong></div></td>
					<td valign="top">
						<div class="isi_tabel">
							<?php echo $pemesanan->alamat_surat_menyurat; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td style="height:59px;" valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Alamat KTP<span class="required_star"></span></strong></div></td>
					<td valign="top">
						<div class="isi_tabel">
							<?php echo $pemesanan->alamat_ktp; ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td style="height:59px;" valign="top" bgcolor="#999999"><div class="isi_tabel"><strong>Alamat NPWP<span class="required_star"></span></strong></div></td>
					<td valign="top">
						<div class="isi_tabel">
							<?php echo $pemesanan->alamat_npwp; ?>
						</div>
					</td>
				</tr>
				
			</table>
			<table width="500px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC" style="float:left">				
				
				<tr bgcolor="#FFFFFF">
					<td width="200" bgcolor="#999999"><div class="isi_tabel"><strong></strong><strong>Cara Pembayaran</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo $pemesanan->cara_pembayaran; ?>x
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Booking Fee</strong></div></td>
					<td align="right">
						<div class="isi_tabel">
							<?php echo number_format($pemesanan->booking_fee, 0); ?>
						</div>
					</td>
				</tr>
				
				<?php
				if($status == "Promo")
				{		
				?>
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999"><div class="isi_tabel"><strong>Diskon Tanah</strong></div></td>
						<td align="right">
							<div class="isi_tabel">
								<?php echo $pemesanan->diskon_tanah; ?> %
							</div>
						</td>
					</tr>
					
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999"><div class="isi_tabel"><strong>Diskon Bangunan</strong></div></td>
						<td align="right">
							<div class="isi_tabel">
								<?php echo $pemesanan->diskon_bangunan; ?> %
							</div>
						</td>
					</tr>
					
				<?php
				}
				else
				{
					?>
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
						<td><div class="isi_tabel"></div></td>
					</tr>
					<tr bgcolor="#FFFFFF">
						<td bgcolor="#999999"><div class="isi_tabel">&nbsp;</div></td>
						<td><div class="isi_tabel"></div></td>
					</tr>
					<?php
				}
				?>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Status Pemesanan</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php 
							if($pemesanan->status_pemesanan == "Booked")
							{
								echo "<font color='green'>".$pemesanan->status_pemesanan."</font>"; 
							}
							else
							{
								echo "<font color='red'>".$pemesanan->status_pemesanan."</font>"; 
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Status Verify</strong></div></td>
					<td>
						<div class="isi_tabel">
							<font color="green"><?php echo $pemesanan->status_verify; ?></font>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Pemesanan</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo ubah_format_tanggal($pemesanan->tanggal_pemesanan, "H:i:s"); ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Tanda Jadi</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php echo ubah_format_tanggal($pemesanan->tanggal_tanda_jadi, "H:i:s"); ?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Timeout</strong></div></td>
					<td>
						<div class="isi_tabel">
							<font color='red'><?php echo dhm($pemesanan->timeout, 'dhm'); ?></font>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Tanggal Expire</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php 
							if($pemesanan->status_pemesanan == "Booked")
							{
								echo exp_order($pemesanan->timeout, $pemesanan->tanggal_pemesanan);
							}
							else if($pemesanan->status_pemesanan == "Tanda Jadi" OR $pemesanan->status_pemesanan == "Sold")
							{						
								echo exp_order($pemesanan->timeout, $pemesanan->tanggal_tanda_jadi);
							}
							?> 
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. KTP</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php
							if($pemesanan->doc_ktp != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $pemesanan->doc_ktp; ?>" target="_blank">KTP</a>
								<?php		
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. NPWP</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php
							if($pemesanan->doc_npwp != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $pemesanan->doc_npwp; ?>" target="_blank">NPWP</a>
								<?php		
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. Kartu Keluarga</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php
							if($pemesanan->doc_kartu_keluarga != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $pemesanan->doc_kartu_keluarga; ?>" target="_blank">Kartu Keluarga</a>
								<?php		
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. Akta Nikah</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php
							if($pemesanan->doc_akta_nikah != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $pemesanan->doc_akta_nikah; ?>" target="_blank">Akta Nikah</a>
								<?php		
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. SIUP</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php
							if($pemesanan->doc_siup != "")
							{
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $pemesanan->doc_siup; ?>" target="_blank">SIUP</a>
								<?php		
							}
							?>
						</div>
					</td>
				</tr>
				
				<tr bgcolor="#FFFFFF">
					<td bgcolor="#999999"><div class="isi_tabel"><strong>Dok. Lainnya</strong></div></td>
					<td>
						<div class="isi_tabel">
							<?php
							$i=0;
							foreach($dokumen_lainnya as $data_lainnya)
							{
								$i++;
								?>
								<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $data_lainnya->file_dokumen; ?>" target="_blank">Doc.<?php echo $i; ?></a>,&nbsp;
								<?php
							}
							?>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div class="clear" style="height:40px;"></div>

		<div class="header_data">Data Kartu Keluarga</div>		
		<div class="frame_tabel radius transparent">			
			<div id="tabel_anggota_keluarga">
				<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
					<tr bgcolor="#FFFFFF">
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Nama Anggota Keluarga</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">No. KTP</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Tanggal Lahir</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">NPWP</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Hubungan Keluarga</div></td>
						<td class="header_tabel_cust"><div style="color:#FFF; text-align:center;">Status Kawin</div></td>
					</tr>

					<?php
					foreach($anggota_keluarga as $data_anggota)
					{
					?>

					<tr bgcolor="#FFFFFF" id="tbl_<?php echo $data_anggota->id_anggota_keluarga; ?>">
						<td><div class="isi_tabel"><?php echo  $data_anggota->nama_lengkap; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->no_ktp; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->tanggal_lahir."/".$data_anggota->bulan_lahir."/".$data_anggota->tahun_lahir; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->npwp; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->hubungan_keluarga; ?></div></td>
						<td><div class="isi_tabel"><?php echo  $data_anggota->status_nikah; ?></div></td>
					</tr>

					<?php
					}
					?>

				</table>
			</div>			
			
		</div>
	</div>
	<div class="clear" style="height:40px;"></div>
</div>

</body>
</html>