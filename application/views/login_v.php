<?php echo $header; ?>

    <span href="#" class="button" id="toggle-login">E- Marketing</span>
    
	<div id="login">
	
		<h1>Silakan Login</h1>	
			<?php
				if($this->session->flashdata('error') != "")
				{
					?>
					<div class="peringatan" style="z-index:10000"> <?php echo $this->session->flashdata('error'); ?> </div>
					<?php
				}
				
				if($this->session->flashdata('success') != "")
				{
					?>
					<div class="peringatan" style="z-index:10000"> <?php echo $this->session->flashdata('success'); ?> </div>
					<?php
				}
				?> 
			
			<form id="form1" action="<?php echo base_url(); ?>login/process" method="post" autocomplete="off">
			 	<input type="text" name="username" value="" placeholder="masukan username" required />
				<input type="password" name="password" value="" placeholder="masukan password" required/>
				<input name="captcha" type="captcha" required title="Silakan Isi Capctha" />
						<div class="captcha"><?php echo $captcha; ?></div>
				<p><span>&nbsp;</span><input class="submit" type="submit" name="name" value="login" title="Klik jika sudah mengisi username dan password"/></p>
			 </form>				
    </div>
    <footer>
		<p>PT. Pembangunan Jaya Ancol Tbk</p>
    </footer> 
  
  <!-- javascript at the bottom for fast page loading -->
  <script src="<?php echo base_url(); ?>files/login/js/index.js"></script>  
  <script>
		//<![CDATA[
	$(document.body).append('<div id="page-loader"></div>');
	$(window).on("beforeunload", function() {
		$('#page-loader').fadeIn(500).delay(9000).fadeOut(1000);
	});
	//]]>
  </script>
  <!-- javascript untuk validasi dengan mengacu ke id form1 pada form-->
<script>
	$(document).ready(function() {
	$("#form1").validate();
});
</script>