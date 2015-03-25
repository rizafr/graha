<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cluster extends CI_Controller
{
	
	var $tanggal;
	
	function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,mgr,stk");
		
		$this->tanggal = date('Y-m-d H:i:s');
	}
	
	# Menampilkan list data cluster
	function index($posisi = 0)
	{
		$this->load->library('header_lib');
		$script_obj = new header_lib;

		$data['header'] = $script_obj->dashboard_header();
		$data['posisi']	= $posisi;
		
		$this->load->view('cluster_v', $data);
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
		
		$this->load->view('cluster_list_v', $data);
	}
	
	# Menambahkan Data Cluster
	function add()
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('cluster_m');
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$data_cluster = array(	'nama_cluster' => strtoupper($this->input->post('nama_cluster')),
									'kode_cluster' => strtoupper($this->input->post('kode_cluster')));
						
			$id_cluster = $this->cluster_m->add($data_cluster);		
				
			if($id_cluster)
			{
				$this->access_lib->logging('Tambah data cluster : '.$this->input->post('nama_cluster'));
				redirect('type/index/'.$id_cluster);
			}
		}
		
		$this->load->library('header_lib');
		$script_obj		= new header_lib;
		$data['header'] = $script_obj->dashboard_header();
		$data['action'] = base_url()."cluster/add/";
		
		$this->load->view('cluster_add_v', $data);
	}
	
	#Mengubah Data Cluster
	function edit($id_cluster)
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('cluster_m');
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$data_cluster = array(	'nama_cluster' => strtoupper($this->input->post('nama_cluster')),
									'kode_cluster' => strtoupper($this->input->post('kode_cluster')));
										
			$this->cluster_m->edit($id_cluster, $data_cluster);
			$this->access_lib->logging('Ubah data cluster : '.$this->input->post('nama_cluster'));
			redirect('type/index/'.$id_cluster);
		}
		
		$this->load->library('header_lib');
		$script_obj				= new header_lib;
		$data['header']			= $script_obj->dashboard_header();
		$data['data_cluster'] 	= $this->cluster_m->get_by_id($id_cluster)->row();
		$data['action']			= base_url()."cluster/edit/".$id_cluster;
		
		$this->load->view('cluster_edit_v', $data);
	}
	
	# Menghapus data cluster
	function delete($id_cluster)
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('cluster_m');
		$nama_cluster = $this->cluster_m->get_by_id($id_cluster)->row()->nama_cluster;
		$result = $this->cluster_m->delete($id_cluster);
		if($result > 0)
		{
			$this->access_lib->logging('Hapus data cluster : '.$nama_cluster);
			echo "ok";
		}
	}
	
	# Menampilkan Detail Data Cluster
	function detail($id_cluster, $posisi = 0, $ikey = "")
	{
		$this->load->model('cluster_m');
		
		$data['posisi']	= $posisi;
		$data['key'] = "'$ikey'";
		$data['data_cluster'] = $this->cluster_m->get_by_id($id_cluster)->row();
		
		$this->load->view('cluster_detail_v', $data);
	}
	
	# Menampilkan Detail Data Type Cluster
	function cluster_detail_type($id_cluster)
	{
		$this->load->model('type_m');
		$this->load->model('gallery_m');
		
		$data["type"] = $this->type_m->get_by_cluster($id_cluster)->result();
		$this->load->view('cluster_detail_type_v', $data);
	}
	
	# Menampilkan Detail Data Siteplan Cluster
	function cluster_detail_siteplan($id_cluster)
	{
		$this->load->model('siteplan_m');
		
		$data["siteplan"] = $this->siteplan_m->get_by_cluster($id_cluster)->result();
		$this->load->view('cluster_detail_siteplan_v', $data);
	}
	
	# Menampilkan data detail siteplan
	function cluster_detail_siteplan_show($id_siteplan)
	{
		$this->load->model('siteplan_m');
		$this->load->library('user_agent');
		
		$data['data_siteplan'] = $this->siteplan_m->get_by_id($id_siteplan)->row();
		$data['unit'] = $this->siteplan_m->get_all_unit($id_siteplan)->result();
		
		if ($this->agent->is_mobile())
		{
			$this->load->view('mobile/cluster_detail_siteplan_show_v', $data);
		}
		else
		{
			$this->load->view('cluster_detail_siteplan_show_v', $data);
		}
		
	}
	
}

# End of file cluster.php
# Location: ./applicaion/controller/cluster.php