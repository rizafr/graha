<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agent_m extends CI_Model
{
	
	private $tbl_agent = 'tbl_agent';
	
	function __Construct()
	{
		parent::__Construct();
	}
	
	# Menampilkan data agent
	function get_all()
	{
		$query = $this->db->query("	SELECT a.*, sm.nama_lengkap AS sales_manager
								 	FROM tbl_agent a
									LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
									WHERE 
										a.id_agent != '1' ");
		return $query;
	}
	
	# Menampilkan data agent berdasarkan id_agent
	function get_by_id($id_agent)
	{
		$query = $this->db->query("	SELECT *, a.*, sm.nama_lengkap AS sales_manager
								 	FROM tbl_agent a
									LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
									WHERE 
										a.id_agent = '".$id_agent."' ");
		return $query;
	}

	# Mendapatkan data user berdasarkan id_user
	function get_opt_sm($id_agent = "")
	{
		$where = "";
		if ($id_agent != "")
		{
			$where = " AND id_agent != '".$id_agent."' ";
		}
		$query = $this->db->query("	SELECT u.* 
									FROM tbl_user u 
									WHERE u.level = 'Sales' AND 
									u.id_user NOT IN (SELECT id_sm FROM tbl_agent WHERE id_sm IS NOT NULL ".$where.") ");
		return $query;
	}
	
	# Menginputkan data agent
	function add($data)
	{
		$this->db->insert($this->tbl_agent, $data);
		return $this->db->insert_id();
	}
	
	# Mengubah data agent
	function edit($id_agent, $data)
	{
		$this->db->where('id_agent', $id_agent);
		$this->db->update($this->tbl_agent, $data);
	}
	
	# Menghapus data agent
	function delete($id_agent)
	{
		$this->db->where('id_agent', $id_agent);
		$this->db->delete($this->tbl_agent);
		return $this->db->affected_rows();
	}
	
}

# End of file agent_m.php
# Location: ./application/model/agent_m.php