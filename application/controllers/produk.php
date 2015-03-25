<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Produk extends CI_Controller
{
	
	function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
	}
	
	# Menampilkan list data cluster
	function index($posisi = 0)
	{
		$this->load->library('header_lib');
		$script_obj = new header_lib;

		$data['header'] = $script_obj->dashboard_header();
		$data['posisi']	= $posisi;
		
		$this->load->view('produk_v', $data);
	}
	
	# Menampilkan list data cluster
	function list_data($posisi = 0, $ikey = "")
	{
		$this->load->model('cluster_m');
		
		$key = base64_decode($ikey);
		$key = explode("#", $key);
		
		$data['cluster'] 		= $this->cluster_m->get_all('limit', $posisi, $key)->result();
		$data['total_cluster']	= count($this->cluster_m->get_all('all', 0, $key)->result());
		
		$data['nama_cluster']	= $key[0];
		$data['key']			= "'$ikey'";
		
		$data['prev']			= $posisi - 10;
		$data['next']			= $posisi + 10;
		$data['posisi']			= $posisi;
		
		if(($data['total_cluster'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_cluster']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_cluster']/10)*10) - 10;
		}
		
		$this->load->view('produk_list_v', $data);
	}
	
	# Menampilkan Detail Data Cluster
	function detail($id_cluster, $posisi = 0, $ikey = "")
	{
		$this->load->model('cluster_m');
		$this->load->model('type_m');
		
		$data['posisi']	= $posisi;
		$data['key'] = "'$ikey'";
		$data['data_cluster'] = $this->cluster_m->get_by_id($id_cluster)->row();
		$data["type"] = $this->type_m->get_by_cluster($id_cluster)->result();
		
		$this->load->view('produk_detail_v', $data);
	}
	
	# Menampilkan Detail Data Type Cluster
	function cluster_detail_type($id_type)
	{
		$this->load->model('type_m');
		$this->load->model('gallery_m');
		
		$data["type"] = $this->type_m->get_by_id($id_type)->row();
		$this->load->view('produk_detail_type_v', $data);
	}
	
	# Menampilkan Detail Data Siteplan Cluster
	function cluster_detail_siteplan($id_cluster)
	{
		$this->load->model('siteplan_m');
		
		$data["siteplan"] = $this->siteplan_m->get_by_cluster_actived($id_cluster)->result();
		$this->load->view('produk_detail_siteplan_v', $data);
	}
	
	# Menampilkan data detail siteplan
	function cluster_detail_siteplan_show($id_siteplan)
	{
		$this->load->model('siteplan_m');
		$this->load->library('user_agent');
		
		$data['data_siteplan'] = $this->siteplan_m->get_by_id($id_siteplan)->row();
		$data['unit'] = $this->siteplan_m->get_unit($id_siteplan)->result();
		
		if ($this->agent->is_mobile())
		{
			$this->load->view('mobile/produk_detail_siteplan_show_v', $data);
		}
		else
		{
			$this->load->view('produk_detail_siteplan_show_v', $data);
		}
	
	}
	
}

# End of file cluster.php
# Location: ./applicaion/controller/cluster.php