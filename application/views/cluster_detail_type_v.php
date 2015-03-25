<table style="white-space: nowrap;">
<tr>
<?php
foreach($type as $tp)
{
	$show_gallery = "";
	$gallery = $this->gallery_m->get_by_id_type($tp->id_type)->result();

	if(count($gallery) > 0)
	{
		$i = 0;
		foreach($gallery as $data_gallery)
		{
			$show_gallery .= '
			<a data-lightbox="image-1" href="'.base_url().'files/gallery/'.$data_gallery->image_gallery.'" title="'.$data_gallery->nama_type.'">
				<div class="shadow" style="width: 180px; height: 123px; float: left; margin: 8px 0 0 8px; background-image:url('.base_url().'files/gallery/thumbnail/'.$data_gallery->image_gallery.');"></div>
			</a>
			';
			$i++;
		}
	}
	else
	{
		$show_gallery .= '<div class="error">Data gallery masih kosong</div>';
	}
	echo '
	<td valign="top">
		<table style="white-space: nowrap;">
		<tr>
			<td><strong> Type &nbsp;&nbsp;</strong></td>
			<td><strong> : &nbsp;&nbsp;</strong></td>
			<td><strong>'.$tp->nama_type.'</strong></td>
		</tr>
		<tr>
			<td><strong> Blok &nbsp;&nbsp;</strong></td>
			<td><strong> : &nbsp;&nbsp;</strong></td>
			<td><strong>'.$tp->kode_blok.'</strong></td>
		</tr>
		<tr>
			<td valign="top"><strong> Spesifikasi &nbsp;&nbsp;</strong></td>
			<td valign="top"><strong> : &nbsp;&nbsp;</strong></td>
			<td>'.$tp->spesifikasi.'</td>
		</tr>
		<tr>
			<td valign="top"><strong> Gambar &nbsp;&nbsp;</strong></td>
			<td valign="top"><strong> : &nbsp;&nbsp;</strong></td>
			<td>'.$show_gallery.'</td>
		</tr>
		</table>
	</td>
	';
}
?>
</tr>
</table>



<script>
  jQuery(document).ready(function($) {
      $('.lightbox').hide();
  });
</script>