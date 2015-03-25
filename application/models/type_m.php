<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Type_m extends CI_Model
{
	
	var $tanggal;
	
	private $tbl_type = 'tbl_type';
	
	function __construct()
	{
		parent::__construct();
		$this->tanggal = date('Y-m-d H:i:s');
	}
	
	# Mendapatkan semua data type
	function get_all($status, $limit = 0)
	{
		if($status == "all")
		{
			$query = $this->db->query("SELECT * FROM tbl_type ORDER BY nama_type ASC");
		}
		else if($status == "limit")
		{
			$query = $this->db->query("SELECT * FROM tbl_type ORDER BY nama_type ASC LIMIT ".$limit.", 10");
		}
		
		return $query;
	}
	
	# Mendapatkan data type berdasarkan id_type
	function get_by_id($id_type)
	{
		$query = $this->db->query(" SELECT * 
									FROM tbl_type t
									INNER JOIN tbl_cluster c ON t.id_cluster = c.id_cluster 
									WHERE t.id_type = '".$id_type."'");
		return $query;
	}
	
	# Mendapatkan data type berdasarkan Cluster
	function get_by_cluster($id_cluster)
	{
		$query = $this->db->query(" SELECT *
									FROM tbl_type
									WHERE id_cluster = '".$id_cluster."'
									ORDER BY nama_type ASC");
		return $query;
	}

	# Menambahkan data type
	function add($data, $kode_blok)
	{
		foreach ($kode_blok as $key => $val)
		{
			if($val == ''){unset($kode_blok[$key]);}
		}
		
		$kode_blok = strtoupper(implode(",", $kode_blok));
		$data['kode_blok'] = $kode_blok;
		
		$this->db->insert($this->tbl_type, $data);
		return $this->db->insert_id();
	}
	
	# Mengubah data type
	function edit($id_type, $data, $kode_blok)
	{
		foreach ($kode_blok as $key => $val)
		{
			if($val == ''){unset($kode_blok[$key]);}
		}
		
		$kode_blok = strtoupper(implode(",", $kode_blok));
		$data['kode_blok'] = $kode_blok;

		$this->db->where('id_type', $id_type);
		$this->db->update($this->tbl_type, $data);
	}
	
	# Menghapus data type
	function delete($id_type)
	{		
		$this->db->where('id_type', $id_type);
		$this->db->delete($this->tbl_type);
		return $this->db->affected_rows();
	}

}

# End of file type_m.php
# Location: ./application/model/type_m.php