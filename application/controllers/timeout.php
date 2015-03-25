<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeout extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->tanggal = date('Y-m-d H-i-s');
		
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,mgr");
	}
	
	# Menampilkan list data timeout
	public function index()
	{
		$this->load->library('header_lib');
		$script_obj = new header_lib;

		$data['header'] = $script_obj->dashboard_header();
		
		$this->load->view('timeout_v', $data);
	}
	
	# Menampilkan list data timeout
	public function list_data()
	{
		$this->load->model('timeout_m');

		$data['timeout'] = $this->timeout_m->get_all()->result();	
		
		$this->load->view('timeout_list_v', $data);
	}

	# Menampilkan form data timeout
	public function form_data($status, $id_timeout)
	{
		if($status == "add")
		{
			$data['judul']				= "Form Tambah Data Timeout";
			$data['action']				= base_url()."timeout/add";

			$data['id_timeout']			= "";
			$data['status_pemesanan']	= "";
			$data['timeout']			= "0";
			$data['status']				= "";
		}
		else if($status == "edit")
		{
			$this->load->model('timeout_m');

			$data['judul']				= "Form Ubah Data Timeout";
			$data['action']				= base_url()."timeout/edit";
			$data_timeout 				= $this->timeout_m->get_by_id($id_timeout)->row();

			$data['id_timeout']			= $data_timeout->id_timeout;
			$data['status_pemesanan']	= $data_timeout->status_pemesanan;
			$data['timeout']			= $data_timeout->timeout;
			$data['status']				= $data_timeout->status;
		}

		$this->load->view('timeout_form_v', $data);
	}
	
	# Menambahkan Data timeout
	public function add()
	{
		$this->load->model("timeout_m");
		
		$timeout = (($this->input->post('hari')*86400)+($this->input->post('jam')*3600)+($this->input->post('menit')*60));
		
		$data = array(	'status_pemesanan'	=> $this->input->post('status_pemesanan'),
						'timeout'			=> $timeout,
						'status'			=> $this->input->post('status'));
						
		$id_timeout = $this->timeout_m->add($data);
		if ($id_timeout)
		{
			if($this->input->post('status') == "1")
			{
				$this->timeout_m->deactive($this->input->post('status_pemesanan'), $id_timeout);
			}
			
			$this->access_lib->logging('Tambah data timeout : '
				.$this->input->post('status_pemesanan').' '
				.$this->input->post('hari').' hari, '
				.$this->input->post('jam').' jam, '
				.$this->input->post('menit').' menit');
			echo "ok-add";
		}
	}
	
	#Mengubah Data timeout
	public function edit()
	{
		$this->load->model("timeout_m");

		$timeout = (($this->input->post('hari')*86400)+($this->input->post('jam')*3600)+($this->input->post('menit')*60));
		
		$data = array(	'status_pemesanan'	=> $this->input->post('status_pemesanan'),
						'timeout'			=> $timeout,
						'status'			=> $this->input->post('status'));

		$result = $this->timeout_m->edit($this->input->post('id_timeout'), $data);
		
		if ($result > 0)
		{
			if($this->input->post('status') == "1")
			{
				$this->timeout_m->deactive($this->input->post('status_pemesanan'), $this->input->post('id_timeout'));
			}
		}
		
		$this->access_lib->logging('Ubah data timeout : '
				.$this->input->post('status_pemesanan').' '
				.$this->input->post('hari').' hari, '
				.$this->input->post('jam').' jam, '
				.$this->input->post('menit').' menit');
		echo "ok-edit";
	}
	
	# Menghapus data timeout
	public function delete($id_timeout)
	{
		$this->load->model('timeout_m');
		$status_pemesanan = $this->timeout_m->get_by_id($id_timeout)->row()->status_pemesanan;		
		$result = $this->timeout_m->delete($id_timeout);
		if($result > 0)
		{
			$this->access_lib->logging('Hapus data timeout : '.$status_pemesanan);
			echo "ok";
		}
	}
	
}

# End of file timeout.php
# Location: ./applicaion/controller/timeout.php