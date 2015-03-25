<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access_lib{

	function __construct()
	{
		$this->CI =& get_instance();
		$this->level = $this->CI->session->userdata('level');
	}
	
	# Mengeset session menjadi kosong
	function logging($keterangan = "")
	{
		$query	= "INSERT INTO tbl_user_log VALUES ('', '".$this->CI->session->userdata('id_user')."', '".$this->CI->session->userdata('username')."', '".mysql_real_escape_string($keterangan)."', '".$this->CI->input->ip_address()."', '".date('Y-m-d H:i:s')."')";
		$this->CI->db->query($query);
	}
	
	# Fungsi untuk memvalidasi login
	function validate($username, $password)
	{
		$this->CI->load->model('user_m');
		
		if(count($this->CI->user_m->cek_username_password($username, md5($password))->result()) > 0)
		{
			$data_user = $this->CI->user_m->cek_username_password($username, md5($password))->row();
			$sm = "N";
			if($data_user->level == "Sales")
			{
				if($data_user->id_user == $data_user->id_sm)
				{
					$sm = "Y";
				}
			}
			
			$data = array ('id_user'			=> $data_user->id_user,
						   'nama_lengkap'		=> $data_user->nama_lengkap,
						   'username'			=> $data_user->username,
						   'hash_data' 			=> md5(date('Ymd')."_".$data_user->id_user),
						   'level'				=> $data_user->level,
						   'sm'					=> $sm,
						   'id_agent'			=> $data_user->id_agent,
						   'status_transaksi'	=> $data_user->status_transaksi);
			
			$this->CI->session->set_userdata($data);
			
			$this->logging("Login");
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}	
	
	# Fungsi untuk mengecek apakah user tersebut sudah login
	function is_login()
	{
		if($this->CI->session->userdata('id_user'))
		{
			return TRUE;
		}
		else
		{
			$this->force_logout();
		}
	}
	
	# Fungsi untuk mengecek apakah user tersebut sudah login
	function is_active_transaction()
	{
		if($this->CI->session->userdata('status_transaksi') == "1")
		{
			return TRUE;
		}
		else
		{
			redirect('user/profile');
		}
	}
	
	# Fungsi untuk mengecek apakah hak sesuai
	function _is($level = "")
	{
		$level = explode(",", str_replace(array("adm", "mgr", "stk", "ksr", "sal"), array("Administrator", "Manager", "Stok", "Kasir", "Sales"), $level));
		if (!in_array($this->level, $level))
		{
			redirect('login');
		}
	}
	
	# Fungsi untuk mengecek apakah level sesuai
	function _if($level = "")
	{
		$level = explode(",", str_replace(array("adm", "mgr", "stk", "ksr", "sal"), array("Administrator", "Manager", "Stok", "Kasir", "Sales"), $level));
		return (in_array($this->level, $level));
	}
	
	# Fungsi logout
	function force_logout()
	{
		$this->CI->session->sess_destroy();
		$this->set_session_kosong();
		$this->CI->session->set_flashdata('error', 'Anda harus login dulu !');
		redirect('login');
	}
	
	# Fungsi logout
	function logout()
	{
		if ($this->CI->session->userdata('id_user'))
		{
			$this->logging("Logout");
		}
		$this->CI->session->sess_destroy();
		$this->set_session_kosong();
		$this->CI->session->set_flashdata('success', 'Anda sudah keluar dari Dashboard');
		redirect('login');
	}

	# Mengeset session menjadi kosong
	function set_session_kosong()
	{
		$data = array ( 'id_user'			=> '',
						'nama_lengkap'		=> '',
						'username'			=> '',
						'hash_data'			=> '',
						'level'				=> '',
						'sm'				=> '',
						'id_agent'			=> '',
						'status_transaksi'	=> '');
		
		$this->CI->session->set_userdata($data);
	}
}

# End of file access_lib.php
# Location: ./applicaion/libraries/access_lib.php