<?php
$show_gallery = "";
$gallery = $this->gallery_m->get_by_id_type($type->id_type)->result();

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
	
	?>
	<table>
		<tr>
			<td valign="top" width="100px"><strong> Type &nbsp;&nbsp;</strong></td>
			<td valign="top" width="20px"><strong> : &nbsp;&nbsp;</strong></td>
			<td valign="top"><strong><?php echo $type->nama_type; ?></strong></td>
			<td valign="top" rowspan="3" style="padding-left:50px;"><?php echo $show_gallery; ?></td>
		</tr>
		<tr>
			<td valign="top"><strong> Blok &nbsp;&nbsp;</strong></td>
			<td valign="top"><strong> : &nbsp;&nbsp;</strong></td>
			<td valign="top"><strong><?php echo $type->kode_blok; ?></strong></td>
		</tr>
		<tr>
			<td valign="top"><strong> Spesifikasi &nbsp;&nbsp;</strong></td>
			<td valign="top"><strong> : &nbsp;&nbsp;</strong></td>
			<td valign="top"><?php echo $type->spesifikasi; ?></td>
		</tr>
	</table>



<script>
  jQuery(document).ready(function($) {
      $('.lightbox').hide();
  });
</script>