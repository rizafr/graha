<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_Controller
{
	
	function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
		$this->tanggal = date('Y-m-d H:i:s');
	}
	
	# Halaman default user
	function index()
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->library('header_lib');
		
		$script_obj 		= new header_lib;
		$data['header']		= $script_obj->dashboard_header();
				
		$this->load->view('user_v', $data);
	}
	
	# Menampilkan list data user
	function list_data($posisi = 0, $ikey = "")
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('user_m');
		
		$key = base64_decode($ikey);
		$key = explode("#", $key);
		
		$data['user'] 		= $this->user_m->get_all('limit', $posisi, $key)->result();
		$data['total_user']	= count($this->user_m->get_all('all', 0, $key)->result());
		
		$data['s_nama_lengkap'] = $key[0];
		
		$data['key']	= "'$ikey'";
		$data['posisi']	= $posisi;
		$data['prev']	= $posisi - 20;
		$data['next']	= $posisi + 20;
		
		if(($data['total_user'] % 20) > 0)
		{
			$data['akhir']	= floor($data['total_user']/20)*20;
		}
		else
		{
			$data['akhir']	= (floor($data['total_user']/20)*20) - 20;
		}
		
		$this->load->view('user_list_v', $data);
	}

	# Menampilkan form data user
	function form_data_user($status, $id_user, $posisi = 0, $ikey = "")
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model("agent_m");
		$data['posisi']	= $posisi;
		$data['key'] = "'$ikey'";
		
		if($status === "add")
		{
			$data['judul']	= "Tambah Data User";
			$data['action']	= base_url()."user/add";
			$data['status']	= "add";
			
			$data['agent']			= $this->agent_m->get_all()->result();
			
			$data['id_user']		= "";
			$data['id_agent']		= "";
			$data['nama_lengkap']	= "";
			$data['tempat_lahir']	= "";
			$data['tanggal_lahir']	= "";
			$data['bulan_lahir']	= "";
			$data['tahun_lahir']	= "";
			$data['email']			= "";
			$data['telepon']		= "";
			$data['hp']				= "";
			$data['alamat']			= "";
			$data['level']			= "";
			$data['username']		= "";
			$data['password']		= "";
			$data['status_transaksi'] = "";
			
		}
		else if($status === "edit")
		{
			$this->load->model('user_m');
			
			$data['judul']	= "Ubah Data User";
			$data['action']	= base_url()."user/edit";
			$data['status']	= "edit";
			
			$data_user		= $this->user_m->get_by_id($id_user)->row();
			$data['agent']	= $this->agent_m->get_all()->result();
			$tanggal_lahir	= explode("-", $data_user->tanggal_lahir);
			
			$data['id_user']		= $data_user->id_user;
			$data['id_agent']		= $data_user->id_agent;
			$data['nama_lengkap']	= $data_user->nama_lengkap;
			$data['tempat_lahir']	= $data_user->tempat_lahir;
			$data['tanggal_lahir']	= $tanggal_lahir[2];
			$data['bulan_lahir']	= $tanggal_lahir[1];
			$data['tahun_lahir']	= $tanggal_lahir[0];
			$data['email']			= $data_user->email;
			$data['telepon']		= $data_user->telepon;
			$data['hp']				= $data_user->hp;
			$data['alamat']			= $data_user->alamat;
			$data['level']			= $data_user->level;
			$data['username']		= $data_user->username;
			$data['status_transaksi'] = $data_user->status_transaksi;
		}
		
		$this->load->view('user_form_v', $data);
	}
	
	# Menambah data user
	function add()
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('user_m');
		
		if ($this->cek_username($this->input->post('username')))
		{
			echo "Username telah terdaftar !";
			exit;
		}
		
		$id_agent = $this->input->post('id_agent');
		if($this->input->post('level') == "Manager" OR $this->input->post('level') == "Kasir" OR $this->input->post('level') == "Stok")
		{
			$id_agent = "1";
		}
		
		$tanggal_lahir = $this->input->post('tahun_lahir')."-".$this->input->post('bulan_lahir')."-".$this->input->post('tanggal_lahir');
		
		$data = array('id_agent'			=> $id_agent,
					  'nama_lengkap'		=> $this->input->post('nama_lengkap'),
					  'tempat_lahir'		=> $this->input->post('tempat_lahir'),
					  'tanggal_lahir'		=> $tanggal_lahir,
					  'email'				=> $this->input->post('email'),
					  'telepon'				=> $this->input->post('telepon'),
					  'hp'					=> $this->input->post('hp'),
					  'alamat'				=> $this->input->post('alamat'),
					  'level'				=> $this->input->post('level'),
					  'username'			=> $this->input->post('username'),
					  'password'			=> md5($this->input->post('password')),
					  'status_transaksi'	=> $this->input->post('status_transaksi'),
					  'tanggal_posting'		=> $this->tanggal);
					  
		$id_user = $this->user_m->add($data);
		if ($id_user)
		{
			$this->access_lib->logging('Tambah data user : '.$this->input->post('username'));
			echo "ok-add";
		}
		
	}
	
	# Mengubah data user
	function edit()
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('user_m');
		
		if ($this->cek_username($this->input->post('username'), $this->input->post('id_user')))
		{
			echo "Username telah terdaftar !";
			exit;
		}
		
		$id_agent = $this->input->post('id_agent');
		if($this->input->post('level') == "Manager" OR $this->input->post('level') == "Kasir" OR $this->input->post('level') == "Stok")
		{
			$id_agent = "1";
		}
		
		$tanggal_lahir = $this->input->post('tahun_lahir')."-".$this->input->post('bulan_lahir')."-".$this->input->post('tanggal_lahir');
		
		$data = array('id_agent'			=> $id_agent,
					  'nama_lengkap'		=> $this->input->post('nama_lengkap'),
					  'tempat_lahir'		=> $this->input->post('tempat_lahir'),
					  'tanggal_lahir'		=> $tanggal_lahir,
					  'email'				=> $this->input->post('email'),
					  'telepon'				=> $this->input->post('telepon'),
					  'hp'					=> $this->input->post('hp'),
					  'alamat'				=> $this->input->post('alamat'),
					  'level'				=> $this->input->post('level'),
					  'username'			=> $this->input->post('username'),
					  'password'			=> $this->input->post('password'),
					  'status_transaksi'	=> $this->input->post('status_transaksi'),
					  'tanggal_posting'		=> $this->tanggal);
					  
		$this->user_m->edit($this->input->post('id_user'),$data);
		$this->access_lib->logging('Ubah data user : '.$this->input->post('username'));
		echo "ok-edit";
	}
	
	# Menampilkan data detail user
	function detail($id_user, $posisi = 0, $ikey = "")
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('user_m');
		$data['user'] 	= $this->user_m->get_by_id($id_user)->row();
		$data['posisi']	= $posisi;
		$data['key']	= "'$ikey'";
		
		$this->load->view('user_detail_v', $data);
	}	
	
	# Menghapus data user
	function delete($id_user)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('user_m');
		$username = $this->user_m->get_by_id($id_user)->row()->username;
		$result = $this->user_m->delete($id_user);
		if($result > 0)
		{
			$this->access_lib->logging('Hapus data user : '.$username);
			echo "ok";
		}
	}
	
	# Cek Unique Kode_Unit
	function cek_username($username, $id_user = "")
	{
		$result = $this->user_m->cek_username($username, $id_user);
		if(count($result) > 0)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	#===============#
	# P R O F I L E #
	#===============#
	
	# Menampilkan profile user
	function profile()
	{
		$this->load->library('header_lib');		
		$script_obj		= new header_lib;
		$data["header"]	= $script_obj->dashboard_header();
		
		$this->load->view('user_profile_v', $data);
	}
	
	# Menampilkan profile user
	function profile_detail()
	{
		$this->load->model('user_m');
		$this->load->model('agent_m');
		
		$id_user		= $this->session->userdata('id_user');
		
		$data["user"]	= $this->user_m->get_by_id($id_user)->row();
		$data["agent"]	= $this->agent_m->get_by_id($data["user"]->id_agent)->row();
		
		$this->load->view('user_profile_detail_v', $data);
	}

	# Menampilkan form edit profile
	function profile_form()
	{
		$this->load->model('user_m');
		$this->load->model('agent_m');
		
		$id_user = $this->session->userdata('id_user');
		
		$data['action']	= base_url()."user/edit_profile";
		$data_user		= $this->user_m->get_by_id($id_user)->row();
		$data_agent		= $this->agent_m->get_by_id($data_user->id_agent)->row();
		
		$tanggal_lahir = explode("-", $data_user->tanggal_lahir);
		
		$data['team']			= $data_agent->team;
		$data['sales_manager']	= $data_agent->sales_manager;
		$data['id_agent']		= $data_user->id_agent;
		$data['nama_lengkap']	= $data_user->nama_lengkap;
		$data['tempat_lahir']	= $data_user->tempat_lahir;
		$data['tanggal_lahir']	= $tanggal_lahir[2];
		$data['bulan_lahir']	= $tanggal_lahir[1];
		$data['tahun_lahir']	= $tanggal_lahir[0];
		$data['email']			= $data_user->email;
		$data['telepon']		= $data_user->telepon;
		$data['hp']				= $data_user->hp;
		$data['alamat']			= $data_user->alamat;
		$data['level']			= $data_user->level;
		$data['username']		= $data_user->username;
		$data['status_transaksi'] = $data_user->status_transaksi;

		$this->load->view('user_profile_form_v', $data);
	}
	
	# Mengubah data profile
	function edit_profile()
	{
		$this->load->model('user_m');
		
		$id_user = $this->session->userdata('id_user');
		$tanggal_lahir = $this->input->post('tahun_lahir')."-".$this->input->post('bulan_lahir')."-".$this->input->post('tanggal_lahir');
		
		$data = array('nama_lengkap'		=> $this->input->post('nama_lengkap'),
					  'tempat_lahir'		=> $this->input->post('tempat_lahir'),
					  'tanggal_lahir'		=> $tanggal_lahir,
					  'email'				=> $this->input->post('email'),
					  'telepon'				=> $this->input->post('telepon'),
					  'hp'					=> $this->input->post('hp'),
					  'alamat'				=> $this->input->post('alamat'),
					  'password'			=> $this->input->post('password'));
					  
		$this->user_m->edit($id_user, $data);

		$this->access_lib->logging('Ubah data profile.');
		echo "ok-edit";
	}
	
	#=========#
	# L O G S #
	#=========#
	
	# Halaman default user
	function logs()
	{
		$this->access_lib->_is("adm");
		
		$this->load->library('header_lib');
		
		$script_obj 		= new header_lib;
		$data['header']		= $script_obj->dashboard_header();
				
		$this->load->view('user_logs_v', $data);
	}
	
	# Menampilkan list data user
	function list_data_logs($posisi = 0, $show = 20, $ikey = "")
	{
		$this->access_lib->_is("adm");
		
		$this->load->model('user_m');
		
		$key = base64_decode($ikey);
		$key = explode("#", $key);
		
		$data['logs'] 		= $this->user_m->get_logs('limit', $posisi, $show, $key)->result();
		$data['total_logs']	= count($this->user_m->get_logs('all', 0, $show, $key)->result());
		
		$data['cari'] = $key[0];
		$data['pencarian'] = $key[1];
		$data['tanggal_mulai'] = $key[2];
		$data['tanggal_selesai'] = $key[3];
		
		$data['key']	= "'$ikey'";
		$data['posisi']	= $posisi;
		$data['show']	= $show;
		$data['prev']	= $posisi - $show;
		$data['next']	= $posisi + $show;
		
		if(($data['total_logs'] % $show) > 0)
		{
			$data['akhir']	= floor($data['total_logs']/$show)*$show;
		}
		else
		{
			$data['akhir']	= (floor($data['total_logs']/$show)*$show) - $show;
		}
		
		$this->load->view('user_list_logs_v', $data);
	}
	
	# Menampilkan list data user
	function hapus_data_logs($ikey)
	{
		$this->access_lib->_is("adm");
		
		$this->load->model('user_m');
		
		$key = base64_decode($ikey);
		$key = explode("#", $key);
		
		$result = $this->user_m->delete_log($key[0], $key[1]);
		if($result > 0)
		{
			$tanggal_mulai = strtotime($key[0]);
			$tanggal_mulai = date("d-M-Y", $tanggal_mulai);
			$tanggal_selesai = strtotime($key[1]);
			$tanggal_selesai = date("d-M-Y", $tanggal_selesai);
		
			$this->access_lib->logging('Hapus data log : '.$tanggal_mulai.' s/d '.$tanggal_selesai);
			echo "ok";
		}
		
	}
}

# End of file user.php
# Location: ./applicaion/controller/user.php