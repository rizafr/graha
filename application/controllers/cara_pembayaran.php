<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cara_pembayaran extends CI_Controller {

	public function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,mgr");
		$this->tanggal = date('Y-m-d H-i-s');
	}

	# Menampilkan list data cara pembayaran
	public function index()
	{
		$this->load->library('header_lib');
		$script_obj = new header_lib;

		$data['header'] = $script_obj->dashboard_header();
		
		$this->load->view('cara_pembayaran_v', $data);
	}
	
	# Menampilkan list data cara pembayaran
	public function list_data()
	{
		$this->load->model('cara_pembayaran_m');

		$data['cara_pembayaran'] = $this->cara_pembayaran_m->get_all()->result();	
		
		$this->load->view('cara_pembayaran_list_v', $data);
	}

	# Menampilkan form data 
	public function form_data($status, $id_cara_pembayaran)
	{
		if($status == "add")
		{
			$data['judul']				= "Form Tambah Data";
			$data['action']				= base_url()."cara_pembayaran/add";

			$data['id_cara_pembayaran'] = "";
			$data['tipe_pembayaran']	= "Cash";
			$data['tahap_pembayaran']	= "1";
		}
		else if($status == "edit")
		{
			$this->load->model('cara_pembayaran_m');

			$data['judul']				= "Form Ubah Data";
			$data['action']				= base_url()."cara_pembayaran/edit";
			$data_cara_bayar			= $this->cara_pembayaran_m->get_by_id($id_cara_pembayaran)->row();

			$data['id_cara_pembayaran']	= $data_cara_bayar->id_cara_pembayaran;
			$data['tipe_pembayaran']	= $data_cara_bayar->tipe_pembayaran;
			$data['tahap_pembayaran']	= $data_cara_bayar->tahap_pembayaran;
		}

		$this->load->view("cara_pembayaran_form_v", $data);
	}
	# Menambahkan Data cara pembayaran
	public function add()
	{
		$this->load->model("cara_pembayaran_m");

		$data = array(	'tipe_pembayaran'	=> $this->input->post('tipe_pembayaran'),
						'tahap_pembayaran'	=> $this->input->post('tahap_pembayaran'));
		
		$id_cara_pembayaran = $this->cara_pembayaran_m->add($data);
		if ($id_cara_pembayaran)
		{
			$this->access_lib->logging('Tambah data cara pembayaran : '.$this->input->post('tipe_pembayaran').' '.$this->input->post('tahap_pembayaran').'x');
			echo "ok-add";
		}
	}
	
	#Mengubah Data cara pembayaran
	public function edit()
	{
		$this->load->model("cara_pembayaran_m");

		$data = array(	'tipe_pembayaran'	=> $this->input->post('tipe_pembayaran'),
						'tahap_pembayaran'	=> $this->input->post('tahap_pembayaran'));
		
		$this->cara_pembayaran_m->edit($this->input->post('id_cara_pembayaran'), $data);
		
		$this->access_lib->logging('Ubah data cara pembayaran : '.$this->input->post('tipe_pembayaran').' '.$this->input->post('tahap_pembayaran').'x');
		echo "ok-edit";
	}
	
	# Menghapus data cara pembayaran
	public function delete($id_cara_pembayaran)
	{
		$this->load->model('cara_pembayaran_m');
		$cara_pembayaran = $this->cara_pembayaran_m->get_by_id($id_cara_pembayaran)->row();	
		$result = $this->cara_pembayaran_m->delete($id_cara_pembayaran);
		if($result > 0)
		{
			$this->access_lib->logging('Hapus data cara pembayaran : '.$cara_pembayaran->tipe_pembayaran.' '.$cara_pembayaran->tahap_pembayaran.'x');
			echo "ok";
		}
	}

}

/* End of file cara_pembayaran.php */
/* Location: ./application/controllers/cara_pembayaran.php */