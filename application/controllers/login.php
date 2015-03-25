<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller{

	function __Construct()
	{
		parent::__Construct();
	}
	
	# Menampilkan halaman login
	function index()
	{
		$this->load->helper('captcha');
		$this->load->library('header_lib');
		$script_obj = new header_lib;
		
		$data['header'] = $script_obj->login_header();
		$data['captcha'] = $this->_set_captcha();
		
		$this->load->view('login_v', $data);
	}
	
	# Login Process
	function process()
	{
		$this->load->model('user_m');
		
		$username	= $this->input->post('username');
		$password	= $this->input->post('password');
		$captcha	= $this->input->post('captcha');
		
		if($username == "")
		{
			$this->session->set_flashdata('error', "Username tidak boleh kosong");
			redirect('login');
		}
		else if($password == "")
		{
			$this->session->set_flashdata('error', "Password tidak boleh kosong");
			redirect('login');
		}
		else if($captcha == "")
		{
			$this->session->set_flashdata('error', "Kode captcha tidak boleh kosong");
			redirect('login');
		}
		else if(!$this->_check_captcha($captcha))
		{
			$this->session->set_flashdata('error', "Kode captcha yang anda masukan tidak cocok");
			redirect('login');
		}
		else if($this->access_lib->validate($username, $password))
		{	
			if($this->session->userdata('level') == "Kasir")
			{		
				redirect('report/regular');
			}
			else
			{		
				redirect('home');
			}
		}
		else
		{
			$this->session->set_flashdata('error', "Username dan Password yang anda masukan tidak cocok");
			redirect('login');
		}
	}
	
	function _check_captcha($captcha)
	{
		$expiration = time()-7200;
		$this->db->query("DELETE FROM tbl_captcha WHERE captcha_time < ".$expiration);
		
		$sql	= "SELECT COUNT(*) AS tot FROM tbl_captcha WHERE word = '".mysql_real_escape_string($captcha)."'";
		$row	= $this->db->query($sql)->row();

		if ($row->tot == 1)
		{
			return TRUE;
		}
		return FALSE;
		
	}
	
	function _set_captcha()
	{
		$rw = mt_rand(1000,9999);
		$rw = strval($rw);
		
		$vals = array(
			'word'		=> $rw,
			'img_path'	=> './files/captcha/',
			'img_url'	=> base_url().'/files/captcha/',
			'font_path'	=> './files/fonts/texb.ttf',
			'img_width'	=> '100',
			'img_height' => '45',
			'expiration' => 7200
			);
						  
		$cap = create_captcha($vals);
		if ($cap)
		{
			$captcha_time	= $cap['time'];
			$ip_address		= $this->input->ip_address();
			$word			= $cap['word'];
			
			$this->db->query("INSERT INTO tbl_captcha VALUES ('', '".$captcha_time."', '".$ip_address."', '".$word."')");
		}
		else
		{
			return "Captcha not work" ;
		}
		return $cap['image'];
	}
	
	# Keluar dari aplikasi / dashboard
	function logout()
	{
		$this->access_lib->logout();
	}
}

# End of file login.php
# Location: ./applicaion/controller/login.php