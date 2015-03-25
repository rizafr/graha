<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Gallery_m extends CI_Model
{

	private $tbl_gallery = 'tbl_gallery';
	
	function __Construct()
	{
		parent::__Construct();
	}
	
	# Mendapatkan gallery berdasarkan id_type
	function get_by_id_type($id_type)
	{
		$query = $this->db->query(" SELECT * 
									FROM tbl_gallery g
									LEFT JOIN tbl_type t ON g.id_type = t.id_type
									WHERE g.id_type = '".$id_type."'");
		return $query;
	}

	# Mendapatkan gallery berdasarkan id_gallery
	function get_by_id_gallery($id_gallery)
	{
		$query = $this->db->get_where($this->tbl_gallery, array('id_gallery' => $id_gallery));
		return $query;
	}
	
	# Menambah data gallery
	function add($id_type)
	{
		$data = array('id_type' => $id_type, 'image_gallery' => '');
		$this->db->insert($this->tbl_gallery, $data);
		return $this->db->insert_id();
	}
	
	# Menambah data gallery
	function edit($id_gallery, $image_gallery)
	{
		$data = array('image_gallery' => $image_gallery);
		$this->db->where('id_gallery', $id_gallery);
		$this->db->update($this->tbl_gallery, $data);
	}
	
	# Menghapus data gallery berdasarkan id_gallery
	function delete($id_gallery)
	{
		$path_file = realpath(APPPATH.'../files/gallery/');
		
		$data_gallery = $this->get_by_id_gallery($id_gallery)->row();
		
		if($data_gallery->image_gallery != "")
		{
			if(!file_exists(base_url()."files/gallery/".$data_gallery->image_gallery))
			{
				unlink($path_file."/".$data_gallery->image_gallery);
			}
			
			if(!file_exists(base_url()."files/gallery/resize/".$data_gallery->image_gallery))
			{
				unlink($path_file."/resize/".$data_gallery->image_gallery);
			}
			
			if(!file_exists(base_url()."files/gallery/thumbnail/".$data_gallery->image_gallery))
			{
				unlink($path_file."/thumbnail/".$data_gallery->image_gallery);
			}
		}
		
		$this->db->where('id_gallery', $id_gallery);
		$this->db->delete($this->tbl_gallery);
	}	

}

# End of file gallery_m.php
# Location: ./application/model/gallery_m.php