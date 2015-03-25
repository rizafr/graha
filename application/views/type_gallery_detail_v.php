
<?php
if(count($gallery) > 0)
{
    $i = 0;
    foreach($gallery as $data_gallery)
    {
		?>
		<a data-lightbox="image-1" href="<?php echo base_url(); ?>files/gallery/<?php echo $data_gallery->image_gallery; ?>" title="<?php echo $data_gallery->nama_type; ?>">
			<div class="shadow" style="width: 180px; height: 123px; float: left; margin: 8px 0 0 8px; background-image:url(<?php echo base_url(); ?>files/gallery/thumbnail/<?php echo $data_gallery->image_gallery; ?>);"></div>
		</a>
		<?php
        $i++;
    }
}
else
{
	?>
	<div class="error">Data gallery masih kosong</div>
	<?php
}
?>



<script>
  jQuery(document).ready(function($) {
      $('.lightbox').hide();
  });
</script>