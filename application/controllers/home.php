<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller
{
	var $tanggal;
	
	function __Construct()
	{
		parent::__Construct();
		$this->load->library('header_lib');
		
		$this->access_lib->is_login();
		
		$this->load->model('news_m');
	}
	
	# Halaman Home
	function index($posisi = 0)
	{
		$script_obj = new header_lib;
		$data['header'] = $script_obj->dashboard_header();
		$data['posisi'] = $posisi;
		
		$this->load->view('home_v', $data);
	}
	
	# Menampilkan list data news
	function list_data($posisi = 0)
	{
		
		if ($this->access_lib->_if("sal"))
		{
			$data["news"] = $this->news_m->get_aktif()->result();
			
			$this->load->view('news_sales_v', $data);
		}
		else
		{
			$data["news"]		= $this->news_m->get_all("limit", $posisi)->result();
			$data['total_news']	= count($this->news_m->get_all("all")->result());
			
			$data['prev']	= $posisi - 10;
			$data['next']	= $posisi + 10;
			$data['posisi']	= $posisi;
			
			if(($data['total_news'] % 10) > 0)
			{
				$data['akhir']	= floor($data['total_news']/10)*10;
			}
			else
			{
				$data['akhir']	= (floor($data['total_news']/10)*10) - 10;
			}
			
			$this->load->view('news_list_v', $data);
		}
		
	}
	
	# Menambahkan Data news
	function add($posisi = 0)
	{
		$this->access_lib->_is("adm,mgr,stk");
		
		$script_obj = new header_lib;
		$data['header'] = $script_obj->dashboard_header();
		
		$data['action']	= base_url()."home/add/".$posisi;
		$data['posisi']	= $posisi;
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$image = $this->upload_slide($this->input->post('judul'));
			
			$data_news = array(	'judul'				=> $this->input->post('judul'),
								'image'				=> $image,
								'deskripsi'			=> $this->input->post('deskripsi'),
								'status'			=> $this->input->post('status'),
								'id_user'			=> $this->session->userdata('id_user'),
								'tanggal_posting'	=> date('Y-m-d H:i:s'));
				
			$this->news_m->add($data_news);
			$this->access_lib->logging('Tambah data news : '.$this->input->post('judul'));
			redirect('home/index/'.$posisi);
		}
		
		$this->load->view('news_add_v', $data);
	}
	
	# Menambahkan Data news
	function edit($posisi = 0, $id_news)
	{
		$this->access_lib->_is("adm,mgr,stk");
		
		$script_obj = new header_lib;
		$data['header'] = $script_obj->dashboard_header();
		
		$data['data_news'] = $this->news_m->get_by_id($id_news)->row();
		$data['action']	= base_url()."home/edit/".$posisi."/".$id_news;
		$data['posisi']	= $posisi;
		$data['id_news'] = $id_news;
		$id_user = $this->session->userdata('id_user');
		
		if ($data['data_news']->id_user != $id_user)
		{
			if (!$this->access_lib->_if("adm"))
			{
				redirect('home/index/'.$posisi);
			}
			else
			{
				$id_user = $data['data_news']->id_user;
			}
			
		}
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$image = $data['data_news']->image;
			if($_FILES['image']['name'] != "")
			{
				$image = $this->upload_slide($this->input->post('judul'));
			}
			
			$data_news = array(	'judul'				=> $this->input->post('judul'),
								'image'				=> $image,
								'deskripsi'			=> $this->input->post('deskripsi'),
								'status'			=> $this->input->post('status'),
								'id_user'			=> $id_user,
								'tanggal_posting'	=> date('Y-m-d H:i:s'));
				
			$this->news_m->edit($id_news, $data_news);
			$this->access_lib->logging('Ubah data news : '.$this->input->post('judul'));
			redirect('home/index/'.$posisi);
		}
		
		$this->load->view('news_edit_v', $data);
	}
	
	# Menghapus data news
	function delete($id_news)
	{
		$this->access_lib->_is("adm,mgr,stk");
		$judul = $this->news_m->get_by_id($id_news)->row()->judul;
		$result = $this->news_m->delete($id_news);
		if($result > 0)
		{
			$this->access_lib->logging('Hapus data news : '.$judul);
			echo "ok";
		}
	}
	
	# Menghapus data type
	function detail($posisi = 0, $id_news)
	{
		$this->access_lib->_is("adm,mgr,stk");
		
		$data['data_news'] = $this->news_m->get_by_id($id_news)->row();
		$data['posisi']	= $posisi;
		
		$this->load->view('news_detail_v', $data);
	}

	function upload_slide($judul)
	{
		$this->load->library('upload');
		
		$image_slide = "no_image.jpg";
		$field_name = "image";
		$file_name = $_FILES['image']['name'];
		
		if($file_name != "")
		{
			$config = array(
				'file_name'		=> preg_replace("/[^A-Za-z0-9_-\s]/", "", $judul),
				'overwrite'		=> TRUE,
				'remove_spaces'	=> TRUE,
				'allowed_types' => 'jpg|JPG|jpeg|JPEG|gif|png',
				'upload_path'	=> './files/slide',
				'max_size' 		=> 5000
			);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload($field_name))
			{
				$image_data = $this->upload->data();
				$image_slide = $image_data['file_name'];
			}
		}
		
		return $image_slide;
	}
}

# End of file news_event.php
# Location: ./applicaion/controller/dashboard/news_event.php