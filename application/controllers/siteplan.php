<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siteplan extends CI_Controller
{
	
	function __Construct()
	{
		parent::__Construct();
		
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,stk");
		
	}
	
	# Halaman default user
	function index($id_cluster)
	{
		$this->load->library('header_lib');
		
		$script_obj 		= new header_lib;
		$data['header']		= $script_obj->dashboard_header();
		$data['id_cluster'] = $id_cluster;
		
		$this->load->view('siteplan_v', $data);
	}
	
	function list_data($id_cluster)
	{
		$this->load->model('cluster_m');
		$this->load->model('siteplan_m');
		
		$data['nama_cluster'] = $this->cluster_m->get_by_id($id_cluster)->row()->nama_cluster;
		$data['siteplan'] = $this->siteplan_m->get_by_cluster($id_cluster)->result();
		$data['id_cluster'] = $id_cluster;
		
		$this->load->view('siteplan_list_v', $data);
	}
	
	# Menampilkan form data user
	function add($id_cluster)
	{
		
		$this->load->model('siteplan_m');
		
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$data_siteplan = array(	"id_cluster"	=> $id_cluster,
									"nama_siteplan" => strtoupper($this->input->post('nama_siteplan')),
									"image"			=> 'no_image.jpg',
									"status"		=> $this->input->post('status'));
											
			$id_siteplan = $this->siteplan_m->add($data_siteplan);
					
			$image = $this->upload_siteplan($id_siteplan, strtoupper($this->input->post('nama_siteplan')));
			$this->siteplan_m->edit($id_siteplan, array("image" => $image));
					
			if($id_siteplan)
			{
				$this->access_lib->logging('Tambah data siteplan : '.strtoupper($this->input->post('nama_siteplan')));
				redirect('siteplan/index/'.$id_cluster);
			}
		}
		
		$this->load->model('cluster_m');
		
		$data['nama_cluster'] = $this->cluster_m->get_by_id($id_cluster)->row()->nama_cluster;
		$data['action']	= base_url()."siteplan/add/".$id_cluster;
		$data['id_cluster'] = $id_cluster;
		
		$this->load->view('siteplan_add_v', $data);
	}
	
	# Mengubah data siteplan
	function edit($id_siteplan)
	{
		$this->load->model('siteplan_m');
		
		$data['data_siteplan'] = $this->siteplan_m->get_by_id($id_siteplan)->row();

		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$image = "";
			if($_FILES['gambar_siteplan']['name'] != "")
			{
				$image = $this->upload_siteplan($id_siteplan, strtoupper($this->input->post('nama_siteplan')));
			}
			
			$data_siteplan = array(	"nama_siteplan" => strtoupper($this->input->post('nama_siteplan')),
									"image"			=> $image,
									"status"		=> $this->input->post('status'));
											
			$this->siteplan_m->edit($id_siteplan, $data_siteplan);
			
			$this->access_lib->logging('Ubah data siteplan : '.strtoupper($this->input->post('nama_siteplan')));
			redirect('siteplan/index/'.$data['data_siteplan']->id_cluster);
		}
		
		$data['action']	= base_url()."siteplan/edit/".$id_siteplan;
		
		$this->load->view('siteplan_edit_v', $data);
	}
	
	# Upload gambar siteplan
	function upload_siteplan($id_siteplan, $nama_siteplan)
	{
		$this->load->library('upload');
		
		$image_siteplan = "no_image.jpg";
		$field_name = "gambar_siteplan";
		$file_name = $_FILES['gambar_siteplan']['name'];
		
		if($file_name != "")
		{
			$config = array(
				'file_name'		=> preg_replace("/[^A-Za-z0-9_-\s]/", "", $id_siteplan."_".$nama_siteplan),
				'overwrite'		=> TRUE,
				'remove_spaces'	=> TRUE,
				'allowed_types' => 'jpg|JPG|jpeg|JPEG|gif|png',
				'upload_path'	=> './files/siteplan',
				'max_size' 		=> 5000
			);
			$this->upload->initialize($config);
			
			if($this->upload->do_upload($field_name))
			{
				$image_data = $this->upload->data();
				$image_siteplan = $image_data['file_name'];
				$this->upload_siteplan_thumbnail($image_siteplan);
				$this->image_mapping($image_data['raw_name'], $image_data['image_width'], $image_data['image_height']);
			}
		}
		
		return $image_siteplan;
	}
	
	# Mengupload data galeri
	function upload_siteplan_thumbnail($image_siteplan)
	{		
		$this->load->library('image_lib');	
		$config = array('source_image' 		=> './files/siteplan/'.$image_siteplan,
						'new_image' 		=> './files/siteplan/thumbnail/'.$image_siteplan,
						'maintain_ration' 	=> true,
						'width' 			=> 150,
						'height'			=> 150,
						'image_library'		=> 'gd2'
		);
			
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$this->image_lib->clear();
		unset($config);
	}
	
	# Create Image Mapping
	function image_mapping($image_siteplan, $width, $height)
	{		
		$im = imagecreatetruecolor($width, $height);
		$transparent = imagecolorallocate($im, 0, 0, 0);
		imagecolortransparent($im, $transparent);
		$to = './files/siteplan/mapping/'.$image_siteplan.'.jpg';
		imagegif($im, $to);
		imagedestroy($im);
	}
	
	# Menampilkan data detail siteplan
	function detail($id_siteplan)
	{
		$this->load->model('siteplan_m');
		$this->load->library('user_agent');
		
		$data['data_siteplan'] = $this->siteplan_m->get_by_id($id_siteplan)->row();
		$data['unit'] = $this->siteplan_m->get_all_unit($id_siteplan)->result();
		
		if ($this->agent->is_mobile())
		{
			$this->load->view('mobile/siteplan_detail_v', $data);
		}
		else
		{
			$this->load->view('siteplan_detail_v', $data);
		}
		
	}
	
	# Menghapus siteplan
	function delete($id_siteplan)
	{
		$this->load->model('siteplan_m');
		$nama_siteplan = $this->siteplan_m->get_by_id($id_siteplan)->row()->nama_siteplan;
		$result = $this->siteplan_m->delete($id_siteplan);
		if($result > 0)
		{
			$this->access_lib->logging('Hapus data siteplan : '.$nama_siteplan);
			echo "ok";
		}
	}
	
}

# End of file user.php
# Location: ./applicaion/controller/user.php