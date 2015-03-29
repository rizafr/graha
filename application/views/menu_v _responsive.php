<?php
	$nama_perusahaan = '
	<div class="logo-bg">
		E- Marketing | <img src="'.base_url().'files/images/favicon.ico"> PT. Pembangunan Jaya Ancol Tbk
	</div>' ;
if($this->access_lib->_if("adm"))
{
?>

	<ul id="cbp-tm-menu" class="cbp-tm-menu">
		
		<li>
			<a href="#">Home</a>
		</li>
		<li>
			<a href="#">Master</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>cluster" class="cbp-tm-icon-archive">Cluster</a></li>
				<li><a href="<?php echo base_url(); ?>unit" class="cbp-tm-icon-archive">Stok Unit</a></li>
				<li><a href="<?php echo base_url(); ?>promo" class="cbp-tm-icon-archive">Promo</a></li>
				<li><a href="<?php echo base_url(); ?>mapping" class="cbp-tm-icon-location">Mapping</a></li>
				<li><a href="<?php echo base_url(); ?>timeout" class="cbp-tm-icon-clock">Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>cara_pembayaran" class="cbp-tm-icon-mobile">Cara Pembayaran</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Booking</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>booking" class="cbp-tm-icon-cog">Regular</a></li>
				<li><a href="<?php echo base_url(); ?>booking/promo" class="cbp-tm-icon-cog">Promo</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Report</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>report/regular" class="cbp-tm-icon-pencil">Booking Regular</a></li>
				<li><a href="<?php echo base_url(); ?>report/promo" class="cbp-tm-icon-pencil">Booking Promo</a></li>
				<li><a href="<?php echo base_url(); ?>report/timeout" class="cbp-tm-icon-pencil">Book Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>report/unit_sold" class="cbp-tm-icon-pencil">Unit Sold</a></li>
				<li><a href="<?php echo base_url(); ?>report/customer" class="cbp-tm-icon-pencil">Customer</a></li>
				<li><a href="<?php echo base_url(); ?>printout" class="cbp-tm-icon-pencil">Transaksi</a></li>
				<li><a href="<?php echo base_url(); ?>printout/stok" class="cbp-tm-icon-pencil">Stok Unit</a></li>
			</ul>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>agent">Team Sales</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>user">User</a></div>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>user/profile">Profile</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>user/logs">User Logs</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>trash_data">Trash Data</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>login/logout">Logout</a>
		</li>
	</ul>
	
	
<?php
}
elseif($this->access_lib->_if("mgr"))
{
?>	
	<ul id="cbp-tm-menu" class="cbp-tm-menu">
		
		<li>
			<a href="#">Home</a>
		</li>
		<li>
			<a href="#">Master</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>cluster" class="cbp-tm-icon-archive">Cluster</a></li>
				<li><a href="<?php echo base_url(); ?>unit" class="cbp-tm-icon-archive">Stok Unit</a></li>
				<li><a href="<?php echo base_url(); ?>promo" class="cbp-tm-icon-archive">Promo</a></li>
				<li><a href="<?php echo base_url(); ?>mapping" class="cbp-tm-icon-location">Mapping</a></li>
				<li><a href="<?php echo base_url(); ?>timeout" class="cbp-tm-icon-clock">Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>cara_pembayaran" class="cbp-tm-icon-mobile">Cara Pembayaran</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Booking</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>booking" class="cbp-tm-icon-cog">Regular</a></li>
				<li><a href="<?php echo base_url(); ?>booking/promo" class="cbp-tm-icon-cog">Promo</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Report</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>report/regular" class="cbp-tm-icon-pencil">Booking Regular</a></li>
				<li><a href="<?php echo base_url(); ?>report/promo" class="cbp-tm-icon-pencil">Booking Promo</a></li>
				<li><a href="<?php echo base_url(); ?>report/timeout" class="cbp-tm-icon-pencil">Book Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>report/unit_sold" class="cbp-tm-icon-pencil">Unit Sold</a></li>
				<li><a href="<?php echo base_url(); ?>report/customer" class="cbp-tm-icon-pencil">Customer</a></li>
				<li><a href="<?php echo base_url(); ?>printout" class="cbp-tm-icon-pencil">Transaksi</a></li>
				<li><a href="<?php echo base_url(); ?>printout/stok" class="cbp-tm-icon-pencil">Stok Unit</a></li>
			</ul>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>agent">Team Sales</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>user">User</a></div>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>user/profile">Profile</a>
		</li>	
		<li>
			<a href="<?php echo base_url(); ?>trash_data">Trash Data</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>login/logout">Logout</a>
		</li>
	</ul>


<?php
}
elseif($this->access_lib->_if("stk"))
{
?>
	<ul id="cbp-tm-menu" class="cbp-tm-menu">
		
		<li>
			<a href="#">Home</a>
			<div id="notifikasi" class="radius shadow">
				<span id="jumlah_notifikasi"></span>
			</div>
		</li>
		<li>
			<a href="#">Master</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>cluster" class="cbp-tm-icon-archive">Cluster</a></li>
				<li><a href="<?php echo base_url(); ?>unit" class="cbp-tm-icon-archive">Stok Unit</a></li>
				<li><a href="<?php echo base_url(); ?>promo" class="cbp-tm-icon-archive">Promo</a></li>
				<li><a href="<?php echo base_url(); ?>mapping" class="cbp-tm-icon-location">Mapping</a></li>
			</ul>
		</li>		
		<li>
			<a href="#">Report</a>
			<ul class="cbp-tm-submenu">				
				<li><a href="<?php echo base_url(); ?>printout/stok" class="cbp-tm-icon-pencil">Stok Unit</a></li>
			</ul>
		</li>
	
		<li>
			<a href="<?php echo base_url(); ?>user/profile">Profile</a>
		</li>
		
		<li>
			<a href="<?php echo base_url(); ?>login/logout">Logout</a>
		</li>
	</ul>
	

<?php
}
elseif($this->access_lib->_if("ksr"))
{
?>
<ul id="cbp-tm-menu" class="cbp-tm-menu">
		
		<li>
			<div id="notifikasi" class="radius shadow">
				<span id="jumlah_notifikasi"></span>
			</div>
		</li>
		<li>
			<a href="#">Home</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>produk">Cluster</a>			
		</li>
		<li>
			<a href="#">Booking</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>booking" class="cbp-tm-icon-cog">Regular</a></li>
				<li><a href="<?php echo base_url(); ?>booking/promo" class="cbp-tm-icon-cog">Promo</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Report</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>report/regular" class="cbp-tm-icon-pencil">Booking Regular</a></li>
				<li><a href="<?php echo base_url(); ?>report/promo" class="cbp-tm-icon-pencil">Booking Promo</a></li>
				<li><a href="<?php echo base_url(); ?>report/timeout" class="cbp-tm-icon-pencil">Book Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>report/unit_sold" class="cbp-tm-icon-pencil">Unit Sold</a></li>
			</ul>
		</li>
		
		<li>
			<a href="<?php echo base_url(); ?>user/profile">Profile</a>
		</li>		
		<li>
			<a href="<?php echo base_url(); ?>trash_data">Trash Data</a>
		</li>
		<li>
			<a href="<?php echo base_url(); ?>login/logout">Logout</a>
		</li>
	</ul>

<?php
}
elseif($this->access_lib->_if("sal"))
{
?>
<ul id="cbp-tm-menu" class="cbp-tm-menu">
		
		<li>
			<a href="#">Home</a>
			<div id="notifikasi" class="radius shadow">
				<span id="jumlah_notifikasi"></span>
			</div>
		</li>
		
		<li>
			<a href="#">Booking</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>booking" class="cbp-tm-icon-cog">Regular</a></li>
				<li><a href="<?php echo base_url(); ?>booking/promo" class="cbp-tm-icon-cog">Promo</a></li>
			</ul>
		</li>
		<li>
			<a href="#">Report</a>
			<ul class="cbp-tm-submenu">
				<li><a href="<?php echo base_url(); ?>report/regular" class="cbp-tm-icon-pencil">Booking Regular</a></li>
				<li><a href="<?php echo base_url(); ?>report/promo" class="cbp-tm-icon-pencil">Booking Promo</a></li>
				<li><a href="<?php echo base_url(); ?>report/timeout" class="cbp-tm-icon-pencil">Book Timeout</a></li>
				<li><a href="<?php echo base_url(); ?>report/unit_sold" class="cbp-tm-icon-pencil">Unit Sold</a></li>
				<?php
				if($this->session->userdata('sm') == "Y")
				{
					?>
					<li><a href="<?php echo base_url(); ?>printout">Transaksi</a></li>
					<?php
				}
				?>
			</ul>
		</li>
		
		<li>
			<a href="<?php echo base_url(); ?>user/profile">Profile</a>
		</li>
		<li>
		<li>
			<a href="<?php echo base_url(); ?>login/logout">Logout</a>
		</li>
	</ul>
	
	
	
<?php
}
?>
	
<script src="<?php echo base_url(); ?>files/menu/js/cbpTooltipMenu.min.js"></script>
<script>
	var menu = new cbpTooltipMenu( document.getElementById( 'cbp-tm-menu' ) );
</script>

