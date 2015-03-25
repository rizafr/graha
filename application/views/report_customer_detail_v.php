<div class="margin_center" style="width:1000px">	
	
	<div class="header_data">Data Customer</div>
	<div class="tombol_tambah">
		<a href="javascript:void(0);" onClick="javascript:tampilkan_list(0);"><input type="button" value="&laquo; Kembali"></a>
	</div>	
	<div class="frame_tabel radius transparent">		
		<table width="1000px" cellspacing="1px" cellpadding="2px" bgcolor="#CCCCCC">
			<tr bgcolor="#FFFFFF">
				<td colspan="4"><div class="header_tabel">Data Customer</div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td width="203" bgcolor="#999999"><div class="isi_tabel"><strong>Nama Lengkap</strong></div></td>
				<td width="269">
					<div class="isi_tabel"><?php echo $customer->nama_lengkap; ?></div>
				</td>
				<td width="173" rowspan="2" valign="top" bgcolor="#999999"><div class="isi_tabel">
					<strong>Alamat KTP</strong>
				</div></td>
				<td width="332" rowspan="2" valign="top">
					<div class="isi_tabel"><?php echo $customer->alamat_ktp ?></div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>No. KTP</strong></div></td>
				<td>
					<div class="isi_tabel"><?php echo $customer->no_ktp; ?></div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel"><strong>No. Kartu Keluarga</strong></div></td>
				<td>
					<div class="isi_tabel"><?php echo $kartu_keluarga->no_kartu_keluarga; ?></div>
				</td>
				<td rowspan="2" valign="top" bgcolor="#999999"><div class="isi_tabel">
					<strong>Alamat NPWP</strong>
				</div></td>
				<td rowspan="2" valign="top"><div class="isi_tabel">
					<?php echo $customer->alamat_npwp; ?>
				</div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel">
					<strong>NPWP</strong>
				</div></td>
				<td>
					<div class="isi_tabel"><?php echo $customer->no_npwp; ?></div>
				</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999">
					<div class="isi_tabel">
					<strong>Telpon</strong>
				</div></td>
				<td>
					<div class="isi_tabel"><?php echo $customer->telpon; ?></div>
				</td>
				<td bgcolor="#999999"><div class="isi_tabel">
					<strong>Dok. KTP</strong>
				</div></td>
				<td><div class="isi_tabel">
					<?php
						if($customer->doc_ktp != "")
						{
					?>
					<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_ktp; ?>" target="_blank">KTP</a>
					<?php		
						}
					?>
				</div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel">
					<strong>HP</strong>
					</div></td>
				<td>
					<div class="isi_tabel"><?php echo $customer->hp; ?></div>
					</td>
				<td bgcolor="#999999">
					<div class="isi_tabel">
						<strong>Dok. NPWP</strong>
					</div>	
				</td>
				<td>
					<div class="isi_tabel">
						<?php
						if($customer->doc_npwp != "")
						{
						?>
						<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_npwp; ?>" target="_blank">NPWP</a>
						<?php		
						}
						?>
					</div>
					</td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel">
					<strong>Email</strong>
				</div></td>
				<td><div class="isi_tabel">
					<?php echo $customer->hp; ?>
				</div></td>
				<td bgcolor="#999999"><div class="isi_tabel">
					<strong>Dok. Kartu Keluarga</strong>
				</div></td>
				<td><div class="isi_tabel">
					<?php
						if($customer->doc_kartu_keluarga != "")
						{
						?>
					<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_kartu_keluarga; ?>" target="_blank">Kartu Keluarga</a>
					<?php		
						}
						?>
				</div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td rowspan="2" valign="top" bgcolor="#999999">
					<div class="isi_tabel">
						<strong>Alamat Surat Menyurat</strong>
				</div></td>
				<td rowspan="2" valign="top"><div class="isi_tabel">
					<?php echo $customer->alamat_surat_menyurat; ?>
				</div></td>
				<td bgcolor="#999999"><div class="isi_tabel">
					<strong>Dok. Akta Nikah</strong>
				</div></td>
				<td><div class="isi_tabel">
					<?php
						if($customer->doc_akta_nikah != "")
						{
						?>
					<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_akta_nikah; ?>" target="_blank">Akta Nikah</a>
					<?php		
						}
						?>
				</div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td bgcolor="#999999"><div class="isi_tabel">
					<strong>Dok. SIUP</strong>
				</div></td>
				<td><div class="isi_tabel">
					<?php
						if($customer->doc_siup != "")
						{
						?>
					<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/dokumen_user/<?php echo $customer->doc_siup; ?>" target="_blank">SIUP</a>
					<?php		
						}
						?>
				</div></td>
			</tr>
			<tr bgcolor="#FFFFFF">
				<td valign="top" bgcolor="#999999">&nbsp;</td>
				<td valign="top">&nbsp;</td>
				<td bgcolor="#999999"><div class="isi_tabel">
					<strong>Dok. Lainnya</strong>
				</div></td>
				<td><div class="isi_tabel">
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
				</div></td>
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