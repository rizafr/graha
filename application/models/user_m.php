<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_m extends CI_Model
{
	
	var $tanggal;
	private $tbl_user = 'tbl_user';
	
	function __construct()
	{
		parent::__construct();
		$this->tanggal = date('Y-m-d H:i:s');
	}

	# Cek Username dan Password
	function cek_username_password($username, $password)
	{
		$query = $this->db->query("	SELECT *
								 	FROM  tbl_user u
									LEFT JOIN tbl_agent a ON a.id_agent = u.id_agent
								 	WHERE 
										username = '".mysql_real_escape_string($username)."' AND
										password = '".mysql_real_escape_string($password)."' AND 
										(u.status_transaksi = '1' OR u.status_transaksi = '2')");
		return $query;
	}
	
	# Mendapatkan data user berdasarkan id_user
	function get_by_id($id_user)
	{
		$query = $this->db->query("	SELECT *, u.*, sm.nama_lengkap AS sales_manager
								 	FROM tbl_user u
									LEFT JOIN tbl_agent a ON u.id_agent = a.id_agent
									LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
								 	WHERE u.id_user = '".$id_user."'");
		return $query;
	}
	
	# Mendapatkan data user berdasarkan id_user
	function get_by_level($level)
	{
		$query = $this->db->query("	SELECT *, u.*, sm.nama_lengkap AS sales_manager
								 	FROM tbl_user u
									LEFT JOIN tbl_agent a ON u.id_agent = a.id_agent
									LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
								 	WHERE u.level = '".$level."'");
		return $query;
	}
	
	# Mendapatkan data user berdasarkan id_agent
	function get_by_id_agent($id_agent)
	{
		$query = $this->db->query(" SELECT	*
									FROM	tbl_user 
									WHERE	id_agent = '".$id_agent."'
									ORDER BY nama_lengkap ASC");
		return $query;
	}
	
	# Mendapatkan semua data user
	function get_all($status, $limit = 0, $key = array())
	{
		$nama_lengkap = $key[0];
		$where = "";
			
		if($nama_lengkap != '')
		{
			$where .= " AND u.nama_lengkap LIKE '%".mysql_real_escape_string($nama_lengkap)."%' ";
		}
		
		if ($this->access_lib->_if("mgr"))
		{
			$where .= " AND u.level != 'Manager' ";
		}
		
		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		*, u.*, sm.nama_lengkap AS sales_manager
										FROM 		tbl_user u
										LEFT JOIN	tbl_agent a ON u.id_agent = a.id_agent
										LEFT JOIN	tbl_user sm ON a.id_sm = sm.id_user
										WHERE 		
											u.id_user != '".$this->session->userdata('id_user')."' AND 
											u.level != 'Administrator' ".$where." 
										ORDER BY	u.level ASC, u.nama_lengkap ASC");		
		}
		elseif($status == "limit")
		{
			$query = $this->db->query("	SELECT 		*, u.*, sm.nama_lengkap AS sales_manager
										FROM 		tbl_user u
										LEFT JOIN	tbl_agent a ON u.id_agent = a.id_agent
										LEFT JOIN	tbl_user sm ON a.id_sm = sm.id_user
										WHERE 		
											u.id_user != '".$this->session->userdata('id_user')."' AND 
											u.level != 'Administrator' ".$where." 
										ORDER BY	u.level ASC, u.nama_lengkap ASC
										LIMIT		".$limit.", 20");
		}
		
		return $query;
	}
	
	# Menginputkan data user
	function add($data)
	{		
		$this->db->insert($this->tbl_user, $data);
		return $this->db->insert_id();
	}

	# Mengubah data user
	function edit($id_user, $data)
	{
		if($data['password'] == "")
		{	
			unset($data['password']);
		}
		else
		{
			$data['password'] = md5($data['password']);
		}

		$this->db->where('id_user', $id_user);
		$this->db->update($this->tbl_user, $data);
	
	}
	
	# Menghapus data user
	function delete($id_user)
	{		
		$this->db->where('id_user', $id_user);
		$this->db->delete($this->tbl_user);
		return $this->db->affected_rows();
	}
	
	# Mengecek duplicate kode unit
	function cek_username($username, $id_user)
	{
		$data = array('username' => $username);
		if ($id_user != "")
		{
			$data["id_user !="] = $id_user;
		}
					  
		return $query = $this->db->get_where($this->tbl_user, $data)->row();
	}
	
	# Mendapatkan semua data logs
	function get_logs($status, $limit = 0, $show = 20, $key = array())
	{
		$cari = mysql_real_escape_string($key[0]);
		$pencarian = mysql_real_escape_string($key[1]);
		$tanggal_mulai = mysql_real_escape_string($key[2]);
		$tanggal_selesai = mysql_real_escape_string($key[3]);
		
		if($tanggal_mulai == '')
		{
			$tanggal_mulai = date('Y-m-d');
		}
		if($tanggal_selesai == '')
		{
			$tanggal_selesai = date('Y-m-d');
		}
		
		$where = " WHERE tanggal_posting >= '".$tanggal_mulai." 00:00:00' AND tanggal_posting <= '".$tanggal_selesai." 23:59:59' ";
			
		if($cari != '' AND $pencarian != '')
		{
			$where .= " AND ".$pencarian." LIKE '%".$cari."%' ";
		}
		
		if($status == "all")
		{
			$query = $this->db->query("	SELECT *, DATE_FORMAT(tanggal_posting,'%d-%b-%Y %T') AS tanggal_posting
										FROM  tbl_user_log
										".$where."
										ORDER BY  tanggal_posting DESC");		
		}
		elseif($status == "limit")
		{
			$query = $this->db->query("	SELECT *, DATE_FORMAT(tanggal_posting,'%d-%b-%Y %T') AS tanggal_posting
										FROM  tbl_user_log
										".$where."
										ORDER BY  tanggal_posting DESC 
										LIMIT ".$limit." , ".$show);
		}
		
		return $query;
	}
	
	# Mendapatkan semua data logs
	function delete_log($tanggal_mulai, $tanggal_selesai)
	{
		$tanggal_mulai = mysql_real_escape_string($tanggal_mulai);
		$tanggal_selesai = mysql_real_escape_string($tanggal_selesai);
		
		if($tanggal_mulai == '' OR $tanggal_selesai == '')
		{
			return 0;
		}
		
		$this->db->query("DELETE FROM tbl_user_log WHERE tanggal_posting >= '".$tanggal_mulai." 00:00:00' AND tanggal_posting <= '".$tanggal_selesai." 23:59:59'");
		return $this->db->affected_rows();
	}
	
}

# End of file user_m.php
# Location: ./application/model/user_m.php