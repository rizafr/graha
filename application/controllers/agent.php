<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent extends CI_Controller{
	
	function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,mgr");
	}
	
	# Halaman default agent
	function index()
	{
		$this->load->library('header_lib');
		
		$script_obj 		= new header_lib;
		$data['header']		= $script_obj->dashboard_header();
		
		$this->load->view('agent_v', $data);
	}
	
	# Menampilkan list data agent
	function list_data()
	{
		$this->load->model('agent_m');
		$data['agent'] 		= $this->agent_m->get_all()->result();
		
		$this->load->view('agent_list_v', $data);
	}
	
	# Menambahkan Data Agent
	function add()
	{
		$this->load->model('agent_m');
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$this->load->model('user_m');
			
			$data_agent = array('team'				=> $this->input->post('team'), 
								'id_sm'				=> $this->input->post('id_sm'),
								'tanggal_posting'	=> date("Y:m:d H:i:s"));
				
			$id_agent = $this->agent_m->add($data_agent);
			if($id_agent)
			{
				$this->user_m->edit($this->input->post('id_sm'), array('id_agent' => $id_agent));
				$this->access_lib->logging('Tambah data team sales  : '.$this->input->post('team'));
				echo "ok-add";
				exit;
			}
		}
		
		$data['user'] = $this->agent_m->get_opt_sm()->result();
		$data['action']	= base_url()."agent/add";
		$this->load->view('agent_add_v', $data);
	}
	
	#Mengubah Data Cluster
	function edit($id_agent)
	{
		$this->load->model('agent_m');
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{			
			$this->load->model('user_m');
			
			$data_agent = array('team'	=> $this->input->post('team'), 
								'id_sm' => $this->input->post('id_sm'));
								
			$this->agent_m->edit($id_agent, $data_agent);		
			$this->user_m->edit($this->input->post('id_sm'), array('id_agent' => $id_agent));	
			$this->access_lib->logging('Ubah data team sales : '.$this->input->post('team'));
			echo "ok-edit";
			exit;
		}
		
		$data['data_agent'] = $this->agent_m->get_by_id($id_agent)->row();
		$data['user'] = $this->agent_m->get_opt_sm($id_agent)->result();
		$data['action']	= base_url()."agent/edit/".$id_agent;
		$this->load->view('agent_edit_v', $data);
	}
	
	# Menghapus data agent
	function delete($id_agent)
	{
		$this->load->model('agent_m');
		$team = $this->agent_m->get_by_id($id_agent)->row()->team;
		$result = $this->agent_m->delete($id_agent);
		if($result > 0)
		{
			$this->access_lib->logging('Hapus data team sales : '.$team);
			echo "ok";
		}
	}
	
	# Menampilkan data detail agent
	function detail($id_agent)
	{
		$this->load->model('agent_m');
		
		$data['agent'] 	= $this->agent_m->get_by_id($id_agent)->row();
		
		$this->load->view('agent_detail_v', $data);
	}	
	
	# [isi tab] detail agent
	function detail_agent($id_agent)
	{
		$this->load->model('agent_m');
		
		$data['data_agent'] = $this->agent_m->get_by_id($id_agent)->row();
		
		$this->load->view('agent_detail_agent_v', $data);
	}
	
	# [isi tab] users yang ada di dalam agent
	function detail_users($id_agent)
	{
		$this->load->model('user_m');
		
		$data['user'] = $this->user_m->get_by_id_agent($id_agent)->result();
		
		$this->load->view('agent_detail_users_v', $data);
	}
	
}

# End of file agent.php
# Location: ./applicaion/controller/agent.php