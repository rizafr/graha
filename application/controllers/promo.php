<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promo extends CI_Controller
{
	var $header;
	
	function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,mgr,stk");
	}
	
	# Halaman default promo
	function index()
	{		
		$this->load->library('header_lib');
		$script_obj = new header_lib;
		
		$data['header'] = $script_obj->dashboard_header();				
		$this->load->view('promo_v', $data);
	}
	
	# Menampilkan list data promo
	function list_data($posisi = 0)
	{
		$this->load->model('promo_m');
		$data['promo'] 			= $this->promo_m->get_all('limit', $posisi)->result();
		$data['total_promo']	= count($this->promo_m->get_all('all', 0)->result());
		$data['prev']			= $posisi - 10;
		$data['next']			= $posisi + 10;
		$data['posisi']			= $posisi;
		
		if(($data['total_promo'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_promo']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_promo']/10)*10) - 10;
		}
		
		$this->load->view('promo_data_v', $data);
	}
	
	# Menampilkan form data promo
	function form_data_promo($status, $id_promo, $posisi = 0)
	{
		$this->access_lib->_is("adm,stk");
		
		$data['posisi']	= $posisi;
		
		if($status === "add")
		{
			$data['judul']	= "Tambah Data Promo";
			$data['action']	= base_url()."promo/add";
			
			$data['id_promo']		= "";
			$data['nama_promo']		= "";
			$data['datepicker1']	= "";
			$data['datepicker2']	= "";
			$data['deskripsi']		= "";
			$data['status_promo']	= "";
		}
		else if($status === "edit")
		{
			$this->load->model('promo_m');
			
			$data['judul']	= "Ubah Data Promo";
			$data['action']	= base_url()."promo/edit";
			$data_promo		= $this->promo_m->get_by_id($id_promo)->row();
			
			$data['id_promo']		= $data_promo->id_promo;
			$data['nama_promo']		= $data_promo->nama_promo;
			$data['datepicker1']	= $data_promo->tanggal_mulai;
			$data['datepicker2']	= $data_promo->tanggal_akhir;
			$data['deskripsi']		= $data_promo->deskripsi;
			$data['status_promo']	= $data_promo->status_promo;
		}
		
		$this->load->view('promo_form_data_v', $data);
	}	
	
	# Menambah data promo
	function add()
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('promo_m');
		
		$data = array('nama_promo'		=> $this->input->post('nama_promo'),
					  'tanggal_mulai'	=> $this->input->post('datepicker1'),
					  'tanggal_akhir'	=> $this->input->post('datepicker2'),
					  'id_user'			=> $this->session->userdata('userdata'),
					  'status_promo'	=> $this->input->post('status'),
					  'deskripsi'		=> $this->input->post('deskripsi'));
		
		$id_promo = $this->promo_m->add($data);
		if ($id_promo)
		{
			if ($this->input->post('status') == "1")
			{
				$this->promo_m->deactive_status($id_promo);
			}
			
			$this->access_lib->logging('Tambah data promo : '.$this->input->post('nama_promo'));
			echo "ok-add";
		}
	}
	
	# Mengubah data promo
	function edit()
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('promo_m');

		$data = array('nama_promo'		=> $this->input->post('nama_promo'),
					  'tanggal_mulai'	=> $this->input->post('datepicker1'),
					  'tanggal_akhir'	=> $this->input->post('datepicker2'),
					  'id_user'			=> $this->session->userdata('userdata'),
					  'status_promo'	=> $this->input->post('status'),
					  'deskripsi'		=> $this->input->post('deskripsi'));
		
		$this->promo_m->update($this->input->post('id_promo'), $data);
		if ($this->input->post('status') == "1")
		{
			$this->promo_m->deactive_status($this->input->post('id_promo'));
		}
		
		$this->access_lib->logging('Ubah data promo : '.$this->input->post('nama_promo'));
		echo "ok-edit";
	}
	
	# Menghapus data promo
	function detail($id_promo, $posisi = 0)
	{
		$this->load->model('promo_m');
		$data['posisi'] = $posisi;
		$data['promo']	= $this->promo_m->get_by_id($id_promo)->row();
		$data['unit']	= $this->promo_m->get_all_unit_promo($id_promo)->result();
		
		$this->load->view('promo_detail_v', $data);
	}
	
	# Menghapus data promo
	function delete($id_promo)
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('promo_m');
		$nama_promo = $this->promo_m->get_by_id($id_promo)->row()->nama_promo;
		$result = $this->promo_m->delete($id_promo);
		if ($result == "ok")
		{
			$this->access_lib->logging('Hapus data promo : '.$nama_promo);
		}
		echo $result;
	}
	
	# Menampilkan list unit promo
	function list_data_unit_promo($id_promo, $posisi = 0)
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('promo_m');
		$this->load->model('cluster_m');
		$this->load->model('cara_pembayaran_m');
		
		$data['promo'] 			= $this->promo_m->get_by_id($id_promo)->row();
		$data['cluster']		= $this->cluster_m->get_all("all")->result();
		$data['cara_pembayaran'] = $this->cara_pembayaran_m->get_all("all")->result();
		$data['unit']			= $this->promo_m->get_all_unit_promo($id_promo)->result();
		$data['posisi']			= $posisi;
		
		$this->load->view('promo_data_unit_v', $data);
	}
	
	# Menampilkan list unit promo
	function list_data_unit_promo_rfs($id_promo)
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('promo_m');
		$data['unit'] = $this->promo_m->get_all_unit_promo($id_promo)->result();
		
		$this->load->view('promo_data_unit_list_v', $data);
	}
	
	# Menampilkan menambahkan unit promo
	function save_unit_promo($id_promo, $id_unit, $actlog = "")
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('promo_m');
		$this->load->model('unit_m');
		
		$diskon_tanah = $this->input->post('diskon_tanah');
		$diskon_bangunan = $this->input->post('diskon_bangunan');
		$mx_tnh = $_POST['mx_tnh'];
		$mx_bgn = $_POST['mx_bgn'];
		
		$data_unit = $this->unit_m->get_by_id($id_unit)->row();
		if ($data_unit->status_unit != "Master" AND $data_unit->status_transaksi == "")
		{
			$this->promo_m->save_unit_promo($id_promo, $id_unit, $diskon_tanah, $diskon_bangunan, $mx_tnh, $mx_bgn);
			$this->access_lib->logging($actlog.' data unit promo : '.$data_unit->kode_unit);
			echo "ok";
		}
		else
		{
			echo "Data diskon gagal disimpan, unit ".$data_unit->kode_unit." masih dalam proses transaksi.";
		}
	}
	
	# Menampilkan menghapus unit promo
	function delete_unit_promo($id_unit)
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('promo_m');
		$this->load->model('unit_m');
		
		$data_unit = $this->unit_m->get_by_id($id_unit)->row();
		
		if ($data_unit->status_transaksi == "")
		{
			$this->promo_m->delete_unit_promo($id_unit);
			$this->access_lib->logging('Hapus data unit promo : '.$data_unit->kode_unit);
			echo "ok";
		}
		else
		{
			echo "Data unit gagal dihapus, unit ".$data_unit->kode_unit." masih dalam proses transaksi.";
		}
		
	}
	
	# Menampilkan menghapus unit promo
	function reset_promo()
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('promo_m');
		$this->promo_m->reset_promo();
		$this->access_lib->logging('Reset status promo');
	}
	
}

# End of file promo.php
# Location: ./applicaion/controller/dashboard/promo.php