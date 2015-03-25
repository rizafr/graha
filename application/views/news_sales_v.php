<div class="margin_center" style="width:1000px;margin-top:-50px">	
	<div class="clear"></div>
		<div id="slidorion" class="slidorion">
			<div class="slider">
				<?php
				foreach($news as $data_news)
				{
					?>
					<div class="slide"><img style="max-width:700px; max-height:500px" src="<?php echo base_url().'files/slide/'.$data_news->image; ?>" /></div>
					<?php
				}
				?>
			</div>

			<div class="accordion">
				<?php
				foreach($news as $data_news)
				{
					?>
					<div class="header"><?php echo $data_news->judul; ?></div>
					<div class="content"><?php echo $data_news->deskripsi; ?></div>
					<?php
				}
				?>
			</div>
		</div>

		<script src="<?php echo base_url(); ?>files/js/slidorion/jquery.easing.js"></script>
		<script src="<?php echo base_url(); ?>files/js/slidorion/jquery.slidorion.min.js"></script>

		<script>
		$(function() {
			$('#slidorion').slidorion({
				interval: 5000,
				effect: 'random',
				controlNav: true,
				controlNavClass: 'slidorion-nav',
				hoverPause: true
			});
		});
		</script>
	
	<div class="clear"></div>
	
</div>