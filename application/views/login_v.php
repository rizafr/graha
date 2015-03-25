<?php echo $header; ?>
<script type="text/javascript">
$(document).ready(function() {
	$(".username").focus(function() {
		$(".user-icon").css("left","-48px");
	});
	$(".username").blur(function() {
		$(".user-icon").css("left","0px");
	});
	
	$(".password").focus(function() {
		$(".pass-icon").css("left","-48px");
	});
	$(".password").blur(function() {
		$(".pass-icon").css("left","0px");
	});
});
</script>

</head>
<body>

<div id="wrapper">
	
    <?php
    if($this->session->flashdata('error') != "")
	{
		?>
		<div class="error_login" style="z-index:10000"> <?php echo $this->session->flashdata('error'); ?> </div>
		<?php
	}
	
	if($this->session->flashdata('success') != "")
	{
		?>
		<div class="success_login" style="z-index:10000"> <?php echo $this->session->flashdata('success'); ?> </div>
		<?php
	}
	?>   
    
    <div class="user-icon"></div>
    <div class="pass-icon"></div>

    <form name="login-form" class="login-form" action="<?php echo base_url(); ?>login/process" method="post">
    
        <div class="header" style="height:78px;">
            <div style="position:absolute; margin:5px 0 0 -9px"><img src="<?php echo base_url(); ?>files/images/logo_PembangunanJayaAncol_login.png"></div>
        </div>
        
        <div class="content">
            <input name="username" type="text" class="input username" value="" placeholder="Username" />
            <input name="password" type="password" class="input password" value="" placeholder="Password" />
			<input name="captcha" type="text" class="input" style="width:50px;margin-top:25px;text-align:center;" />
			<div style="float:right;width:100px;margin-top:26px;"><?php echo $captcha; ?></div>
        </div>
        
        <div class="footer">
            <input type="submit" name="submit" value="Login" class="button" />
            <div class="footer_login">Copyright &copy; 2015 - PT Pembangunan Jaya Ancol</div>
        </div>
    
    </form>

</div>

<div class="gradient"></div>

</body>
</html>