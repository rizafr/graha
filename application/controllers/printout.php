<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Printout extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
		if(!($this->access_lib->_if("adm,mgr,stk") OR $this->session->userdata('sm') == "Y"))
		{
			redirect('login');
		}
	}

	function index()
	{
		if(!($this->access_lib->_if("adm,mgr,stk") OR $this->session->userdata('sm') == "Y"))
		{
			redirect('login');
		}
		
		$this->load->library('header_lib');
		$script_obj = new header_lib;
		$data['header'] = $script_obj->dashboard_header();
		
		$this->load->model('user_m');
			
		if($this->session->userdata('sm') == "Y")
		{
			$data['user'] = $this->user_m->get_by_id_agent($this->session->userdata('id_agent'))->result();
		}
		else
		{
			$this->load->model('agent_m');
			$data['agent'] = $this->agent_m->get_all("all")->result();
			$data['user'] = array();
		}
		
		$this->load->view('printout_v', $data);
	}
	
	# Booked
	function transaksi($laporan, $type, $tanggal, $kategori = "0", $jenis_pemesanan = "0", $id_agent = "0", $id_user = "0")
	{
		if(!($this->access_lib->_if("adm,mgr,stk") OR $this->session->userdata('sm') == "Y"))
		{
			redirect('login');
		}
		
		if($this->session->userdata('sm') == "Y")
		{
			$id_agent = $this->session->userdata('id_agent');
		}
		
		$this->load->model('printout_m');
		
		if ($laporan == "booked")
		{
			$data['lap'] = $this->printout_m->booked($type, $tanggal, $kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_booked_v', $data);
		}
		else if ($laporan == "tanda_jadi")
		{
			$data['lap'] = $this->printout_m->tanda_jadi($type, $tanggal, $kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_tanda_jadi_v', $data);
		}
		else if ($laporan == "sold")
		{
			$data['lap'] = $this->printout_m->sold($type, $tanggal, $kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_sold_v', $data);
		}
		else if ($laporan == "timeout")
		{
			$data['lap'] = $this->printout_m->timeout($kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_timeout_v', $data);
		}
		else if ($laporan == "trash_data")
		{
			$data['lap'] = $this->printout_m->trash_data($kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_trash_data_v', $data);
		}
	}
	
	function transaksi_print($laporan, $type, $tanggal, $kategori = "0", $jenis_pemesanan = "0", $id_agent = "0", $id_user = "0")
	{
		if(!($this->access_lib->_if("adm,mgr,stk") OR $this->session->userdata('sm') == "Y"))
		{
			redirect('login');
		}
		
		if($this->session->userdata('sm') == "Y")
		{
			$id_agent = $this->session->userdata('id_agent');
		}
		
		$this->load->model('printout_m');
		$data['type'] = $type;
		$data['tanggal'] = $tanggal;
		$data['kategori'] = ($kategori == "0") ? "" : $kategori;
		$data['jenis_pemesanan'] = ($jenis_pemesanan == "0") ? "" : $jenis_pemesanan;
		
		$data['team'] = "";
		$data['nama_sales'] = "";
		
		if ($id_agent != '0')
		{
			$this->load->model('agent_m');
			$data_agent = $this->agent_m->get_by_id($id_agent)->row();
			$data['team'] = 'TEAM : '.$data_agent->team.' ('.$data_agent->sales_manager.')';
		}
		if ($id_user != '0')
		{
			$this->load->model('user_m');
			$data_user = $this->user_m->get_by_id($id_user)->row();
			$data['nama_sales'] = 'SALES : '.$data_user->nama_lengkap;
		}
		
		if ($laporan == "booked")
		{
			$data['lap'] = $this->printout_m->booked($type, $tanggal, $kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_booked_print_v', $data);
		}
		else if ($laporan == "tanda_jadi")
		{
			$data['lap'] = $this->printout_m->tanda_jadi($type, $tanggal, $kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_tanda_jadi_print_v', $data);
		}
		else if ($laporan == "sold")
		{
			$data['lap'] = $this->printout_m->sold($type, $tanggal, $kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_sold_print_v', $data);
		}
		else if ($laporan == "timeout")
		{
			$data['tanggal'] = date("Y-m-d");
			$data['lap'] = $this->printout_m->timeout($kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_timeout_print_v', $data);
		}
		else if ($laporan == "trash_data")
		{
			$data['tanggal'] = date("Y-m-d");
			$data['lap'] = $this->printout_m->trash_data($kategori, $jenis_pemesanan, $id_agent, $id_user)->result();
			$this->load->view('printout_trash_data_print_v', $data);
		}
		
		$this->access_lib->logging("Download laporan pemesanan : ".str_replace("_", " ", $laporan)." $tanggal $data[kategori] $data[jenis_pemesanan]");
	}
	
	# Stok
	function stok()
	{
		$this->access_lib->_is("adm,mgr,stk");
		
		$this->load->library('header_lib');
		$script_obj = new header_lib;
		$data['header'] = $script_obj->dashboard_header();
		$this->load->view('printout_stok_v', $data);
	}
	
	function stok_data($status, $kategori = "0")
	{
		$this->access_lib->_is("adm,mgr,stk");
		
		$this->load->model('printout_m');
		$data['lap'] = $this->printout_m->stok($status, $kategori)->result();
		$this->load->view('printout_stok_data_v', $data);
	}
	
	function stok_print($status, $kategori = "0")
	{
		$this->access_lib->_is("adm,mgr,stk");
		
		$this->load->model('printout_m');	
		$data['lap'] = $this->printout_m->stok($status, $kategori)->result();		
		$data['status'] = $status;
		$data['kategori'] = ($kategori == "0") ? "" : $kategori;
		$data['tanggal'] = date("Y-m-d");
		$this->load->view('printout_stok_print_v', $data);
		
		$this->access_lib->logging("Download laporan stok : $status $data[tanggal] $data[kategori]");
	}
	
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */