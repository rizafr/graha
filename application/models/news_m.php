<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_m extends CI_Model
{
	
	private $tbl_news = 'tbl_news';
	
	function __construct()
	{
		parent::__construct();
	}

	# Mendapatkan semua data news
	function get_aktif()
	{
		$query = $this->db->query(" SELECT	n.*, u.nama_lengkap, u.level
									FROM	tbl_news n
									LEFT JOIN tbl_user u ON n.id_user = u.id_user
									WHERE	n.status = 'Aktif'
									ORDER BY tanggal_posting DESC");
		
		return $query;
	}
	
	# Mendapatkan semua data news
	function get_all($status, $limit = 0)
	{
		if($status == "all")
		{
			$query = $this->db->query(" SELECT	n.*, u.nama_lengkap, u.level
										FROM	tbl_news n
										LEFT JOIN tbl_user u ON n.id_user = u.id_user
										ORDER BY status ASC, tanggal_posting DESC");
		}
		else if($status == "limit")
		{
			$query = $this->db->query(" SELECT	n.*, u.nama_lengkap, u.level
										FROM	tbl_news n
										LEFT JOIN tbl_user u ON n.id_user = u.id_user
										ORDER BY status ASC, tanggal_posting DESC
										LIMIT	".$limit.", 10");
		}
		
		return $query;
	}
	
	# Mendapatkan data news berdasarkan id_news
	function get_by_id($id_news)
	{
		$query = $this->db->query("	SELECT	n.*, u.nama_lengkap, u.level
									FROM	tbl_news n
									LEFT JOIN tbl_user u ON n.id_user = u.id_user
								 	WHERE n.id_news = '".$id_news."'");
		return $query;
	}
	
	# Menginputkan data news
	function add($data)
	{
		$this->db->insert($this->tbl_news, $data);
		return $this->db->insert_id();
	}
	
	# Mengubah data news
	function edit($id_news, $data)
	{
		$this->db->where('id_news', $id_news);
		$this->db->update($this->tbl_news, $data);
	}
	
	# Menghapus data user
	function delete($id_news)
	{		
		$this->db->where('id_news', $id_news);
		$this->db->delete($this->tbl_news);
		return $this->db->affected_rows();
	}
	
}

# End of file user_m.php
# Location: ./application/model/user_m.php