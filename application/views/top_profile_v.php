<div id="top_profile">
	<img class="user" src="<?php echo base_url(); ?>files/images/user.png" />
	<div class="user-detail">
		Hi, <b><?php echo $this->session->userdata('nama_lengkap'); ?></b><br />
		Akses : <b><i> <?php echo $this->session->userdata('level'); ?> </i></b>
	</div>
</div>
