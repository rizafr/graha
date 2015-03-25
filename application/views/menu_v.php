<script type="text/javascript" >
$(document).ready(function()
{
	$(".account").click(function()
	{
		var X=$(this).attr('id');
		if(X==1)
		{
			$("#submenu").hide();
			$("#submenu2").hide();
			$("#submenu3").hide();
			$(this).attr('id', '0'); 
			$(".account2").attr('id', '0'); 
			$(".account3").attr('id', '0'); 
		}
		else
		{
			$("#submenu").show();
			$("#submenu2").hide();
			$("#submenu3").hide();
			$(this).attr('id', '1');
			$(".account2").attr('id', '0'); 
			$(".account3").attr('id', '0'); 
		}
	});
	
	$(".account2").click(function()
	{
		var X=$(this).attr('id');
		if(X==1)
		{
			$("#submenu").hide();
			$("#submenu2").hide();
			$("#submenu3").hide();
			$(this).attr('id', '0');
			$(".account").attr('id', '0'); 
			$(".account3").attr('id', '0'); 			
		}
		else
		{
			$("#submenu").hide();
			$("#submenu2").show();
			$("#submenu3").hide();
			$(this).attr('id', '1');
			$(".account").attr('id', '0'); 
			$(".account3").attr('id', '0');
		}
	});
	
	$(".account3").click(function()
	{
		var X=$(this).attr('id');
		if(X==1)
		{
			$("#submenu").hide();
			$("#submenu2").hide();
			$("#submenu3").hide();
			$(this).attr('id', '0'); 
			$(".account").attr('id', '0'); 
			$(".account2").attr('id', '0');
		}
		else
		{
			$("#submenu").hide();
			$("#submenu2").hide();
			$("#submenu3").show();
			$(this).attr('id', '1');
			$(".account").attr('id', '0'); 
			$(".account2").attr('id', '0');
		}
	});

	//Mouse click on sub menu
	$(".submenu").mouseup(function()
	{
		return false
	});
	$(".submenu2").mouseup(function()
	{
		return false
	});
	$(".submenu3").mouseup(function()
	{
		return false
	});
	
	//Mouse click on my account link
	$(".account").mouseup(function()
	{
		return false
	});
	$(".account2").mouseup(function()
	{
		return false
	});	
	$(".account3").mouseup(function()
	{
		return false
	});
	
	//Document Click
	$(document).mouseup(function()
	{
		$(".submenu").hide();
		$(".submenu2").hide();
		$(".submenu3").hide();
		$(".account").attr('id', '');
		$(".account2").attr('id', '');
		$(".account3").attr('id', '');
	});

});
</script>
<style type="text/css">
.logo-bg {
	height: 38px;
	position:absolute;
	z-index:1000;
	margin:1px 2px 1px 2px;
	padding:6px 8px 1px 8px;
	--background-image:url('<?php echo base_url(); ?>files/images/transparent-black.png');
	background: #F0F0F0;
	border-radius:3px 3px 3px 3px;
	border: 1px solid rgb(153, 153, 153);
}
</style>

<div class="header" style="height:50px; ">
	<div class="logo-bg">
		<img src="<?php echo base_url(); ?>files/images/logo_PembangunanJayaAncol_login.png" height="35px">
	</div>
</div>

<?php
if($this->access_lib->_if("adm"))
{
?>
<div id="top_panel">
	<div class="list_menu" style="color:#F00;"><a href="<?php echo base_url(); ?>login/logout" style="color:#F00;">Logout</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>trash_data">Trash Data</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>user/logs">User Logs</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>user/profile">Profile</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>user">User</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>agent">Team Sales</a></div>
	<div class="list_menu" id="menu_report">
		<a class="account">Report</a>
		<div class="submenu" id="submenu">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>report/regular">Booking Regular</a></li>
				<li><a href="<?php echo base_url(); ?>report/promo">Booking Promo</a></li>
				<li><a href="<?php echo base_url(); ?>report/timeout">Book Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>report/unit_sold">Unit Sold</a></li>
				<li><a href="<?php echo base_url(); ?>report/customer">Customer</a></li>
				<li><a href="<?php echo base_url(); ?>printout">Transaksi</a></li>
				<li><a href="<?php echo base_url(); ?>printout/stok">Stok Unit</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu" id="menu_booking">
		<a class="account3">Booking</a>
		<div class="submenu" id="submenu3">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>booking">Regular</a></li>
				<li><a href="<?php echo base_url(); ?>booking/promo">Promo</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu" id="menu_master">
		<a class="account2">Master</a>
		<div class="submenu" id="submenu2">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>unit">Stok Unit</a></li>
				<li><a href="<?php echo base_url(); ?>promo">Promo</a></li>
				<li><a href="<?php echo base_url(); ?>cluster">Cluster</a></li>
				<li><a href="<?php echo base_url(); ?>mapping">Mapping</a></li>
				<li><a href="<?php echo base_url(); ?>timeout">Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>cara_pembayaran">Cara Pembayaran</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu">
		<div id="notifikasi" class="radius shadow">
			<span id="jumlah_notifikasi"></span>
		</div>
		<a href="<?php echo base_url(); ?>home">Home</a>
	</div>
</div>
<?php
}
elseif($this->access_lib->_if("mgr"))
{
?>
<div id="top_panel">
	<div class="list_menu" style="color:#F00;"><a href="<?php echo base_url(); ?>login/logout" style="color:#F00;">Logout</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>trash_data">Trash Data</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>user/profile">Profile</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>user">User</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>agent">Team Sales</a></div>
	<div class="list_menu" id="menu_report">
		<a class="account">Report</a>
		<div class="submenu" id="submenu">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>report/regular">Booking Regular</a></li>
				<li><a href="<?php echo base_url(); ?>report/promo">Booking Promo</a></li>
				<li><a href="<?php echo base_url(); ?>report/timeout">Book Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>report/unit_sold">Unit Sold</a></li>
				<li><a href="<?php echo base_url(); ?>report/customer">Customer</a></li>
				<li><a href="<?php echo base_url(); ?>printout">Transaksi</a></li>
				<li><a href="<?php echo base_url(); ?>printout/stok">Stok Unit</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu" id="menu_booking">
		<a class="account3">Booking</a>
		<div class="submenu" id="submenu3">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>booking">Regular</a></li>
				<li><a href="<?php echo base_url(); ?>booking/promo">Promo</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu" id="menu_master">
		<a class="account2">Master</a>
		<div class="submenu" id="submenu2">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>unit">Stok Unit</a></li>
				<li><a href="<?php echo base_url(); ?>promo">Promo</a></li>
				<li><a href="<?php echo base_url(); ?>cluster">Cluster</a></li>
				<li><a href="<?php echo base_url(); ?>timeout">Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>cara_pembayaran">Cara Pembayaran</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu">
		<div id="notifikasi" class="radius shadow">
			<span id="jumlah_notifikasi"></span>
		</div>
		<a href="<?php echo base_url(); ?>home">Home</a>
	</div>
</div>
<?php
}
elseif($this->access_lib->_if("stk"))
{
?>
<div id="top_panel">
	<div class="list_menu" style="color:#F00;"><a href="<?php echo base_url(); ?>login/logout" style="color:#F00;">Logout</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>user/profile">Profile</a></div>
	<div class="list_menu" id="menu_report">
		<a class="account">Report</a>
		<div class="submenu" id="submenu">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>printout/stok">Stok Unit</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu" id="menu_master">
		<a class="account2">Master</a>
		<div class="submenu" id="submenu2">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>unit">Stok Unit</a></li>
				<li><a href="<?php echo base_url(); ?>promo">Promo</a></li>
				<li><a href="<?php echo base_url(); ?>cluster">Cluster</a></li>
				<li><a href="<?php echo base_url(); ?>mapping">Mapping</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu">
		<div id="notifikasi" class="radius shadow">
			<span id="jumlah_notifikasi"></span>
		</div>
		<a href="<?php echo base_url(); ?>home">Home</a>
	</div>
</div>
<?php
}
elseif($this->access_lib->_if("ksr"))
{
?>
<div id="top_panel">
	<div class="list_menu" style="color:#F00;"><a href="<?php echo base_url(); ?>login/logout" style="color:#F00;">Logout</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>trash_data">Trash Data</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>user/profile">Profile</a></div>
	<div class="list_menu" id="menu_report">
		<a class="account">Report</a>
		<div class="submenu" id="submenu">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>report/regular">Booking Regular</a></li>
				<li><a href="<?php echo base_url(); ?>report/promo">Booking Promo</a></li>
				<li><a href="<?php echo base_url(); ?>report/timeout">Book Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>report/unit_sold">Unit Sold</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu" id="menu_booking">
		<a class="account3">Booking</a>
		<div class="submenu" id="submenu3">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>booking">Regular</a></li>
				<li><a href="<?php echo base_url(); ?>booking/promo">Promo</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>produk">Cluster</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>home">Home</a></div>
	<div class="list_menu">
		<div id="notifikasi" class="radius shadow">
			<span id="jumlah_notifikasi"></span>
		</div>
	</div>
</div>
<?php
}
elseif($this->access_lib->_if("sal"))
{
?>
<div id="top_panel">
	<div class="list_menu" style="color:#F00;"><a href="<?php echo base_url(); ?>login/logout" style="color:#F00;">Logout</a></div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>user/profile">Profile</a></div>
	<div class="list_menu" id="menu_report">
		<a class="account">Report</a>
		<div class="submenu" id="submenu">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>report/regular">Booking Regular</a></li>
				<li><a href="<?php echo base_url(); ?>report/promo">Booking Promo</a></li>
				<li><a href="<?php echo base_url(); ?>report/timeout">Book Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>report/unit_sold">Unit Sold</a></li>
				<?php
				if($this->session->userdata('sm') == "Y")
				{
					?>
					<li><a href="<?php echo base_url(); ?>printout">Transaksi</a></li>
					<?php
				}
				?>
			</ul>
		</div>
	</div>
	<div class="list_menu" id="menu_booking">
		<a class="account3">Booking</a>
		<div class="submenu" id="submenu3">
			<ul class="root">				
				<li><a href="<?php echo base_url(); ?>booking">Regular</a></li>
				<li><a href="<?php echo base_url(); ?>booking/promo">Promo</a></li>
			</ul>
		</div>
	</div>
	<div class="list_menu"><a href="<?php echo base_url(); ?>produk">Cluster</a></div>
	<div class="list_menu">
		<div id="notifikasi" class="radius shadow">
			<span id="jumlah_notifikasi"></span>
		</div>
		<a href="<?php echo base_url(); ?>home">Home</a>
	</div>
</div>
<?php
}
?>