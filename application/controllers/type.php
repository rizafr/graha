<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Type extends CI_Controller
{
	
	var $path_file;
	
	function __Construct()
	{
		parent::__Construct();
		$this->load->library('access_lib');		
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,stk");
		
		$this->path_file	= realpath(APPPATH.'../files/gallery/');
	}
	
	# Menampilkan list data type
	function index($id_cluster)
	{
		$this->load->library('header_lib');
		$script_obj = new header_lib;
		$data['header'] = $script_obj->dashboard_header();
		$data['id_cluster']	= $id_cluster;
		
		$this->load->view('type_v', $data);
	}
	
	# Menampilkan list data type
	function list_data($id_cluster)
	{
		$this->load->model("cluster_m");
		$this->load->model("type_m");
		
		$data['nama_cluster'] = $this->cluster_m->get_by_id($id_cluster)->row()->nama_cluster;
		$data['type'] = $this->type_m->get_by_cluster($id_cluster)->result();
		$data['id_cluster'] = $id_cluster;
		
		$this->load->view('type_list_v', $data);
	}
	
	# Menambahkan Data Type
	function add($id_cluster)
	{
		$this->load->model("type_m");
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$data_type = array(	'id_cluster'	=> $id_cluster,
								'nama_type'		=> strtoupper($this->input->post('nama_type')),
								'spesifikasi'	=> $this->input->post('deskripsi'));
						
			$id_type = $this->type_m->add($data_type, $this->input->post('kode_blok'));
			if($id_type)
			{
				$this->access_lib->logging('Tambah data type : '.strtoupper($this->input->post('nama_type')));
				redirect('type/form_gallery/'.$id_type);
			}
		}
		
		$this->load->model("cluster_m");
		
		$this->load->library('header_lib');
		$script_obj				= new header_lib;
		$data['header']			= $script_obj->dashboard_header();
		
		$data['nama_cluster']	= $this->cluster_m->get_by_id($id_cluster)->row()->nama_cluster;
		$data['action']			= base_url()."type/add/".$id_cluster;
		$data['id_cluster']		= $id_cluster;
		
		$this->load->view('type_add_v', $data);
	}
	
	# Menambahkan Data Type
	function edit($id_type)
	{
		$this->load->model("type_m");
		
		$data['data_type']	= $this->type_m->get_by_id($id_type)->row();
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$data_type = array(	'nama_type'		=> strtoupper($this->input->post('nama_type')),
								'spesifikasi'	=> $this->input->post('deskripsi'));
								
			$this->type_m->edit($id_type, $data_type, $this->input->post('kode_blok'));
			
			$this->access_lib->logging('Ubah data type : '.strtoupper($this->input->post('nama_type')));
			redirect('type/index/'.$data['data_type']->id_cluster);
		}
		
		$this->load->library('header_lib');
		$script_obj			= new header_lib;
		$data['header']		= $script_obj->dashboard_header();
		
		$data['action']		= base_url()."type/edit/".$id_type;
		
		$this->load->view('type_edit_v', $data);
	}
	
	# Menghapus data type
	function delete($id_type)
	{
		$this->load->model('type_m');
		$nama_type = $this->type_m->get_by_id($id_type)->row()->nama_type;
		$result = $this->type_m->delete($id_type);
		if($result > 0)
		{
			$this->access_lib->logging('Hapus data type : '.$nama_type);
			echo "ok";
		}
	}
	
	# Menampilkan Detail Data Type
	function detail($id_type)
	{
		$this->load->model('type_m');
		
		$data['data_type'] = $this->type_m->get_by_id($id_type)->row();
		
		$this->load->view('type_detail_v', $data);
	}
	
	# Menambahkan / Ubah Data gallery
	function form_gallery($id_type)
	{
		$this->load->model("type_m");
		$this->load->model('gallery_m');
		
		$this->load->library('header_lib');
		$script_obj			= new header_lib;
		$data['header']		= $script_obj->dashboard_header();
		
		$data['data_type']	= $this->type_m->get_by_id($id_type)->row();
		
		$this->load->view('type_gallery_form_v', $data);
	}
	
	#Ambil Data Gallery
	function gallery_list_data($id_type)
	{
		$this->load->model('gallery_m');
		
		$data['gallery'] = $this->gallery_m->get_by_id_type($id_type)->result();
		$this->load->view('type_gallery_list_v', $data);
	}
	
	# Mengupload foto gallery
	function upload_gallery($id_type)
	{
		$this->load->model('type_m');
		$this->load->model('gallery_m');
		
		# Get Id Gallery Untuk Nama Image
		$id_gallery = $this->gallery_m->add($id_type);
		
		# Upload Image Gallery
		$data_type = $this->type_m->get_by_id($id_type)->row();
		$nama_type = $data_type->nama_type;
		
		$image_gallery = $this->upload_image_gallery($id_gallery, $nama_type);
		
		# Update Nama FIle
		$this->gallery_m->edit($id_gallery, $image_gallery);
	}
	
	# Menampilkan data GALLERY
	function gallery_detail($id_type)
	{
		$this->load->model('gallery_m');
		
		$data['gallery'] = $this->gallery_m->get_by_id_type($id_type)->result();
		$this->load->view('type_gallery_detail_v', $data);
	}
	
	function spesifikasi_detail($id_type)
	{
		$this->load->model('type_m');

		echo $this->type_m->get_by_id($id_type)->row()->spesifikasi;
	}
	
	#Delete Gallery
	function delete_gallery($id_gallery)
	{
		$this->load->model('gallery_m');
		
		$this->gallery_m->delete($id_gallery);
	}
	
	# Menambah data gallery
	function upload_image_gallery($id_gallery, $nama_type)
	{
		$this->load->library('upload');
		
		$image_gallery 	= "no_image.jpg";
		$field_name = "gallery";
		$file_name = $_FILES['gallery']['name'];
		
		if($file_name != "")
		{
			$config = array(
				'file_name'		=> preg_replace("/[^A-Za-z0-9_-\s]/", "", $id_gallery."_".$nama_type),
				'overwrite'		=> TRUE,
				'remove_spaces'	=> TRUE,
				'allowed_types' => 'jpg|JPG|jpeg|JPEG|gif|png',
				'upload_path'	=> $this->path_file,
				'max_size' 		=> 5000
			);
			
			$this->upload->initialize($config);
			
			if($this->upload->do_upload($field_name))
			{
				$image_data = $this->upload->data();
				$image_gallery = $image_data['file_name'];
				
				# create thumbnail
				$this->upload_image_gallery_thumbnail($image_gallery);
			}
		}
		
		return $image_gallery;
		
	}
	
	# Mengupload data gallery
	function upload_image_gallery_thumbnail($image_gallery)
	{
		# resize image to 500px
		$this->load->library('image_lib');
		$config = array('image_library' 	=> 'gd2',
						'maintain_ration' 	=> true,
						'source_image' 		=> $this->path_file.'/'.$image_gallery,
						'new_image' 		=> $this->path_file . '/resize',
						'width' 			=> 500,
						'height'			=> 342);
		
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		unset($config);
	
		#make image thumbnail
		$this->load->library('image_lib');	
		$config = array('source_image' 		=> $this->path_file.'/'.$image_gallery,
						'new_image' 		=> $this->path_file . '/thumbnail',
						'maintain_ration' 	=> true,
						'width' 			=> 180,
						'height'			=> 123);
			
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		unset($config);
	}
	
}

# End of file type.php
# Location: ./applicaion/controller/type.php