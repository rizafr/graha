<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Kartu_keluarga_m extends CI_Model 
{
	var $tanggal;

	private $tbl_kartu_keluarga 			= "tbl_kartu_keluarga";
	private $tbl_anggota_keluarga 			= "tbl_anggota_keluarga";
	private $tbl_anggota_keluarga_dokumen	= "tbl_anggota_keluarga_dokumen";

	function __Construct()
	{
		parent::__Construct();
	}
	
	# 	--------------------------
	#	K A R T U  K E L U A R G A
	#	--------------------------

	# Mendapatkan kartu keluarga berdasarkan id_customer
	function get_kartu_keluarga_by_id_customer($id_customer)
	{
		$query = $this->db->get_where($this->tbl_kartu_keluarga, array("id_customer" => $id_customer));
		return $query;
	}

	# Mendapatkan semua data anggota keluarga
	function get_kartu_keluarga_by_id($id_kartu_keluarga)
	{
		$query = $this->db->get_where($this->tbl_kartu_keluarga, array("id_kartu_keluarga" => $id_kartu_keluarga));
		return $query;
	}

	# Menyimpan data kertu keluarga
	function add_kartu_keluarga($data)
	{
		$this->db->insert($this->tbl_kartu_keluarga, $data);
		return $this->db->insert_id();
	}

	# Mengubah data kartu keluarga
	function edit_kartu_keluarga($id_kartu_keluarga, $data)
	{
		$this->db->where('id_kartu_keluarga', $id_kartu_keluarga);
		$this->db->update($this->tbl_kartu_keluarga, $data);
	}

	# Menghapus data kartu keluarga
	function delete_kartu_keluarga($id_kartu_keluarga)
	{
		$this->db->where('id_kartu_keluarga', $id_kartu_keluarga);
		$this->db->delete($this->tbl_kartu_keluarga);
	}


	# 	------------------------------
	#	A N G G O T A  K E L U A R G A
	#	------------------------------

	# Mendapatkan semua data anggota keluarga
	function get_all_anggota_keluarga($id_kartu_keluarga)
	{		
		$query = $this->db->query("	SELECT 	* 
									FROM 	tbl_anggota_keluarga 
									WHERE 	id_kartu_keluarga = '".$id_kartu_keluarga."'");		
		return $query;
	}

	# Menyimpan data anggota keluarga
	function add_anggota_keluarga($data)
	{
		$this->db->insert($this->tbl_anggota_keluarga, $data);
		return $this->db->insert_id();
	}

	# Menghapus data anggota keluarga berdasarkan id anggota keluarga
	function delete_anggota_keluarga($id_anggota_keluarga)
	{
		$this->db->where('id_anggota_keluarga', $id_anggota_keluarga);
		$this->db->delete($this->tbl_anggota_keluarga);
	}

	# Menghapus data anggota keluarga berdasarkan id_kartu_keluarga
	function delete_anggota_keluarga_by_id_kartu_keluarga($id_kartu_keluarga)
	{
		$this->db->where('id_kartu_keluarga', $id_kartu_keluarga);
		$this->db->delete($this->tbl_anggota_keluarga);
	}

}

/* End of file kartu_keluarga_m.php */
/* Location: ./application/models/kartu_keluarga_m.php */