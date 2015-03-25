<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit_m extends CI_Model
{

	private $tbl_unit = 'tbl_unit';
	
	function __Construct()
	{
		parent::__Construct();
	}
	
	# Menampilkan semua data unit
	# Kategori : master, publish
	function get_all($status, $limit = 0, $show = 10, $key = array())
	{
	
			$filter_kategori			= mysql_real_escape_string($key[0]);
			$filter_cluster				= mysql_real_escape_string($key[1]);
			$filter_type				= mysql_real_escape_string($key[2]);
			$filter_kode_cluster		= mysql_real_escape_string($key[3]);
			$filter_blok				= mysql_real_escape_string($key[4]);
			$filter_nomor				= mysql_real_escape_string($key[5]);
			$filter_status_unit			= mysql_real_escape_string($key[6]);
			$filter_status_transaksi	= mysql_real_escape_string($key[7]);
			$order_by					= mysql_real_escape_string($key[8]);
			$sort_by					= mysql_real_escape_string($key[9]);
			
			$where = "";
			
			if($filter_kategori != '')
			{
				$where .= " AND u.kategori = '".$filter_kategori."' ";
			}
			if($filter_cluster != '')
			{
				$where .= " AND u.id_cluster = '".$filter_cluster."' ";
			}
			if($filter_type != '')
			{
				$where .= " AND u.id_type = '".$filter_type."' ";
			}
			if($filter_kode_cluster != '' || $filter_blok != '' || $filter_nomor != '')
			{
				if ($filter_kode_cluster != '') { $where .= " AND u.kode_unit LIKE '%".$filter_kode_cluster."%/%' "; }
				if ($filter_blok != '') { $where .= " AND u.kode_unit LIKE '%/%".$filter_blok."%-%' "; }
				if ($filter_nomor != '') { $where .= " AND u.kode_unit LIKE '%-%".$filter_nomor."%' "; }
			}
			if($filter_status_unit != '')
			{
				$where .= " AND u.status_unit = '".$filter_status_unit."' ";
			}
			if($filter_status_transaksi != '')
			{
				$where .= " AND u.status_transaksi = '".$filter_status_transaksi."' ";
			}
			
			if($order_by != '' AND $sort_by != '')
			{	
				$where .= " ORDER BY ".$order_by." ".$sort_by;
			}
				
			if ($where != "")
			{
				$where = " WHERE ".$where;
				$where = preg_replace('/AND/', '', $where, 1);
			}

		if($status == "all"){
			$query = $this->db->query("	SELECT		*, u.*
										FROM		tbl_unit u
										INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
										LEFT JOIN 	tbl_type t ON u.id_type = t.id_type 
										".$where);
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT		*, u.*
										FROM		tbl_unit u
										INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
										LEFT JOIN	tbl_type t ON u.id_type = t.id_type 
										".$where."
										LIMIT		".$limit.", ".$show);
		}
		return $query;
	}
	
	# Menampilkan data unit berdasarkan id_unit
	function get_by_id($id_unit)
	{
		$query = $this->db->query("SELECT		*, u.*
								   FROM			tbl_unit u
								   INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
								   LEFT JOIN	tbl_type t ON u.id_type = t.id_type
								   WHERE		u.id_unit = '".$id_unit."'");
		return $query;
	}

	# Menambah data unit
	function add($data)
	{
		$this->db->insert($this->tbl_unit, $data);
		return $this->db->insert_id();
	}
	
	# Mengubah data unit
	function edit($id_unit, $data)
	{
		$this->db->where('id_unit', $id_unit);
		$this->db->update($this->tbl_unit, $data);
		return $this->db->affected_rows();
	}
	
	# Menghapus data unit
	function delete($id_unit)
	{
		$this->db->where('id_unit', $id_unit);
		$this->db->delete($this->tbl_unit);
		return $this->db->affected_rows();
	}
	
	# Update status unit (Master, Marketable, Promo)
	function update_status_unit($id_unit, $status)
	{
		$data = array('status_unit'	=> $status);
		
		$this->db->where('id_unit', $id_unit);
		$this->db->update($this->tbl_unit, $data);
		return $this->db->affected_rows();
	}

	# Update status unit (Marketable, Booked, Tanda jadi, verified, sold)
	function update_status_transaksi($id_unit, $status)
	{
		$data = array('status_transaksi' => $status);
		
		$this->db->where('id_unit', $id_unit);
		$this->db->update($this->tbl_unit, $data);		
	}
	
	# Mengecek status transaksi dari suatu unit
	function cek_status_transaksi($id_unit)
	{
		$query = $this->db->get_where($this->tbl_unit, array('id_unit' => $id_unit))->row();
		return $query->status_transaksi;
	}
	
	# Mengecek duplicate kode unit
	function cek_kode_unit($kode_unit)
	{
		return $query = $this->db->get_where($this->tbl_unit, array('kode_unit' => $kode_unit))->row();
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function lock($id_unit)
	{		
		$data = array('locked' => '1', 'tanggal_locked' => date('Y-m-d H:i:s'));
		$this->db->where('id_unit', $id_unit);
		$this->db->update($this->tbl_unit, $data);	
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function unlock($id_unit)
	{		
		$data = array('locked' => '0', 'tanggal_locked' => '');
		$this->db->where('id_unit', $id_unit);
		$this->db->update($this->tbl_unit, $data);	
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function scheduler_unlock()
	{		
		return $this->db->query("SELECT id_unit, tanggal_locked FROM tbl_unit WHERE locked = '1'")->result();
	}
	
	# Menampilkan unit lainnya (yang tidak mempunyai siteplan)
	function get_unit_regular_lainnya($status, $limit = 0)
	{
		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		*, u.*
										FROM 		tbl_unit u
										INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster 
										LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
										LEFT JOIN 	tbl_unit_siteplan us ON u.id_unit = us.id_unit
										WHERE 
											u.status_unit = 'Marketable' AND 
											u.status_transaksi = '' AND 
											us.id_siteplan IS NULL
									");
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT 		*, u.*
										FROM 		tbl_unit u
										INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster 
										LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
										LEFT JOIN 	tbl_unit_siteplan us ON u.id_unit = us.id_unit
										WHERE 
											u.status_unit = 'Marketable' AND 
											u.status_transaksi = '' AND 
											us.id_siteplan IS NULL
										LIMIT ".$limit.", 10");
		}

		return $query;
	}
	
	# Menampilkan unit lainnya (yang tidak mempunyai siteplan)
	function get_unit_promo_lainnya($status, $limit)
	{
		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		*, u.*
										FROM 		tbl_unit u
										INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster 
										LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
										LEFT JOIN 	tbl_unit_siteplan us ON u.id_unit = us.id_unit
										INNER JOIN	tbl_promo p ON u.id_promo = p.id_promo
										WHERE 		u.status_unit = 'Promo' AND 
													u.status_transaksi = '' AND 
													p.status_promo = '1' AND 
													us.id_siteplan IS NULL
									");
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT 		*, u.*
										FROM 		tbl_unit u
										INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster 
										LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
										LEFT JOIN 	tbl_unit_siteplan us ON u.id_unit = us.id_unit
										INNER JOIN	tbl_promo p ON u.id_promo = p.id_promo
										WHERE 		u.status_unit = 'Promo' AND 
													u.status_transaksi = '' AND 
													p.status_promo = '1' AND 
													us.id_siteplan IS NULL
										LIMIT 		".$limit.", 10");
		}

		return $query;
	}
	
}

# End of file unit_m.php
# Location: ./application/model/unit_m.php