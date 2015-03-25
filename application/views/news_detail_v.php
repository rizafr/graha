<div class="margin_center" style="width:1000px;margin-top:-50px">	
	<div class="tombol_tambah">
		<a href="javascript:void(0);" onClick="javascript:list_data(<?php echo $posisi; ?>); return false;">
			<input type="button" value="&laquo; Kembali">
		</a>
	</div>
	<div class="clear">
	</div>
		<div id="slidorion" class="slidorion">
			<div class="slider">
				<div class="slide"><img style="max-width:700px; max-height:500px" src="<?php echo base_url().'files/slide/'.$data_news->image; ?>" /></div>
			</div>

			<div class="accordion">
				<div class="header"><?php echo $data_news->judul; ?></div>
				<div class="content"><?php echo $data_news->deskripsi; ?></div>
			</div>
		</div>

		<script src="<?php echo base_url(); ?>files/js/slidorion/jquery.easing.js"></script>
		<script src="<?php echo base_url(); ?>files/js/slidorion/jquery.slidorion.min.js"></script>

		<script>
		$(function() {
			$('#slidorion').slidorion();
		});
		</script>
	
	<div class="clear"></div>
	
</div>