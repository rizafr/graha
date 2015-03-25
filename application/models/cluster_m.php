<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cluster_m extends CI_Model
{
	
	var $tanggal;
	
	private $tbl_cluster = 'tbl_cluster';
	
	function __construct()
	{
		parent::__construct();
		$this->tanggal = date('Y-m-d H:i:s');
	}

	# Mendapatkan semua data cluster
	function get_all($status, $limit = 0, $key = array())
	{
		
		$nama_cluster = mysql_real_escape_string($key[0]);
		$where = "";
			
		if($nama_cluster != '')
		{
			$where .= " WHERE nama_cluster LIKE '%".$nama_cluster."%' ";
		}
			
		if($status == "all")
		{
			$query = $this->db->query("SELECT * FROM tbl_cluster ".$where." ORDER BY nama_cluster ASC");
		}
		else if($status == "limit")
		{
			$query = $this->db->query("SELECT * FROM tbl_cluster ".$where." ORDER BY nama_cluster ASC LIMIT ".$limit.", 10");
		}
		
		return $query;
	}
	
	# Mendapatkan data cluster berdasarkan id_cluster
	function get_by_id($id_cluster)
	{
		$query = $this->db->query("SELECT * FROM  tbl_cluster WHERE id_cluster = '".$id_cluster."'");
		return $query;
	}

	# Menambahkan data cluster
	function add($data)
	{
		$this->db->insert($this->tbl_cluster, $data);
		return $this->db->insert_id();
	}
	
	# Mengubah data cluster
	function edit($id_cluster, $data)
	{
		$this->db->where('id_cluster', $id_cluster);
		$this->db->update($this->tbl_cluster, $data);
		return $this->db->affected_rows();
	}
	
	# Menghapus data cluster
	function delete($id_cluster)
	{		
		$this->db->where('id_cluster', $id_cluster);
		$this->db->delete($this->tbl_cluster);
		return $this->db->affected_rows();
	}

}

# End of file cluster_m.php
# Location: ./application/model/cluster_m.php