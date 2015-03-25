<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Denied extends CI_Controller
{
	function noscript()
	{
		$this->load->view('noscript_v');
	}
	
	function maintenance()
	{
		$this->load->view('maintenance_v');
	}
	
}

# End of file news_event.php
# Location: ./applicaion/controller/dashboard/news_event.php