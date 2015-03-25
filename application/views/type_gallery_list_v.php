<?php
foreach($gallery as $data_gallery)
{
	?>
	<div class="list_image" id="list_<?php echo $data_gallery->id_gallery; ?>" style="background-image:url(<?php echo base_url(); ?>files/gallery/thumbnail/<?php echo $data_gallery->image_gallery; ?>); background-size: 200%; width: 100px; height: 100px; margin:5px; float: left;">
		<div style="background-color: #FFF; float: right; margin:1px;">
			<a style="cursor:pointer" onClick="javascript:hapus(<?php echo $data_gallery->id_gallery; ?>); return false;" title="hapus">Hapus</a>
		</div>
	</div>
	<?php
}
?>

