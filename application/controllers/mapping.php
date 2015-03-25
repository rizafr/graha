<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mapping extends CI_Controller
{
	
	function __Construct()
	{
		parent::__Construct();
		
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,stk");
	}
	
	# Halaman default user
	function index()
	{
		$this->load->library('header_lib');
		
		$script_obj 		= new header_lib;
		$data['header']		= $script_obj->dashboard_header();
		
		$this->load->model('siteplan_m');
		
		$data['siteplan'] = $this->siteplan_m->get_all()->result();
		
		$this->load->view('mapping_v', $data);
	}
	
	
	# Menampilkan data detail siteplan
	function image_siteplan($id_siteplan = "")
	{
		if($id_siteplan != "")
		{
			$this->load->model('siteplan_m');
			$data['data_siteplan'] = $this->siteplan_m->get_by_id($id_siteplan)->row();
			$this->load->view('mapping_image_siteplan_v', $data);
		}
	}
	
	# Menampilkan data detail siteplan
	function image_mapping($id_siteplan = "")
	{
		if($id_siteplan != "")
		{
			$this->load->model('siteplan_m');
			
			$data['data_siteplan'] = $this->siteplan_m->get_by_id($id_siteplan)->row();
			$data['unit'] = $this->siteplan_m->get_all_unit($id_siteplan)->result();
			
			$this->load->view('mapping_image_mapping_v', $data);
		}
		
	}
	
	# Menampilkan data detail siteplan
	function add_coords()
	{
		$this->load->model('siteplan_m');
		
		$id_siteplan = $this->input->post('id_siteplan');
		$id_unit = $this->input->post('id_unit');
		$coords = $this->input->post('coords');
		
		$this->siteplan_m->add_coords($id_siteplan, $id_unit, $coords);
		
		print "Koordinat unit berhasil diubah.";
		
	}
	
}

# End of file user.php
# Location: ./applicaion/controller/user.php