<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siteplan_m extends CI_Model
{
	
	var $tanggal;
	var $path_foto_user;
	
	private $tbl_siteplan = 'tbl_siteplan';
	
	function __construct()
	{
		parent::__construct();
		$this->tanggal 			= date('Y-m-d H:i:s');
		$this->path_foto_user 	= realpath(APPPATH.'../files');
	}
	
	# Mendapatkan data semua siteplan
	function get_all()
	{
		$query = $this->db->query("
		SELECT *
		FROM tbl_siteplan
		ORDER BY id_cluster, nama_siteplan");
		
		return $query;
	}
	
	# Mendapatkan data siteplan berdasarkan id_siteplan
	function get_by_id($id_siteplan)
	{
		$query = $this->db->query("
			SELECT s.*, c.nama_cluster
			FROM tbl_siteplan s
			INNER JOIN tbl_cluster c ON s.id_cluster = c.id_cluster 
			WHERE s.id_siteplan = '".$id_siteplan."'");
		
		return $query;
	}
	
	# Mendapatkan data siteplan berdasarkan id_siteplan
	function get_by_cluster($id_cluster)
	{
		$query = $this->db->query("
			SELECT s.* 
			FROM tbl_siteplan s
			INNER JOIN tbl_cluster c ON s.id_cluster = c.id_cluster 
			WHERE s.id_cluster = '".$id_cluster."'");
		
		return $query;
	}
	
	# Mendapatkan data siteplan berdasarkan id_siteplan
	function get_by_cluster_actived($id_cluster)
	{
		$query = $this->db->query("
			SELECT s.* 
			FROM tbl_siteplan s
			INNER JOIN tbl_cluster c ON s.id_cluster = c.id_cluster 
			WHERE s.id_cluster = '".$id_cluster."' AND status = 'Aktif'");
		
		return $query;
	}
	
	# Menginputkan data siteplan
	function add($data)
	{
		$this->db->insert($this->tbl_siteplan, $data);
		return $this->db->insert_id();
	}
	
	# Mengubah data siteplan
	function edit($id_siteplan, $data)
	{
		
		if($data['image'] == "")
		{	
			unset($data['image']);
		}

		$this->db->where('id_siteplan', $id_siteplan);
		$this->db->update($this->tbl_siteplan, $data);
		return $this->db->affected_rows();
	
	}
	
	# Menghapus data siteplan
	function delete($id_siteplan)
	{		
		$this->db->where('id_siteplan', $id_siteplan);
		$this->db->delete($this->tbl_siteplan);
		return $this->db->affected_rows();
	}
	
	function get_unit($id_siteplan)
	{		
		$query = $this->db->query("	SELECT		*, u.*
									FROM		tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
									LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
									INNER JOIN	tbl_unit_siteplan us ON u.id_unit = us.id_unit
									WHERE
										u.status_unit != 'Master' AND 
										us.id_siteplan = '".$id_siteplan."' AND 
										us.coords != ''
									ORDER BY kode_unit ASC
								   ");
		
		return $query;
	}
	
	function get_all_unit($id_siteplan)
	{		
		$query = $this->db->query("	SELECT		*, u.*
									FROM			tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
									LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
									INNER JOIN	tbl_unit_siteplan us ON u.id_unit = us.id_unit
									WHERE
										us.id_siteplan = '".$id_siteplan."' AND 
										us.coords != ''
									ORDER BY kode_unit ASC
								   ");
		
		return $query;
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function get_unit_opt($id_cluster, $id_siteplan)
	{		
		$query = $this->db->query("SELECT		*, u.*
								   FROM			tbl_unit u
								   INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
								   LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
								   LEFT JOIN	tbl_unit_siteplan us ON u.id_unit = us.id_unit AND us.id_siteplan = '".$id_siteplan."' 
								   WHERE		u.id_cluster = '".$id_cluster."'
								   ORDER BY		kode_unit ASC
								   ");
		
		return $query;
	}
	
	# Menambahkan coords
	function add_coords($id_siteplan, $id_unit, $coords)
	{		
		# Menghapus Koordinat Lama
		$this->db->where('id_siteplan', $id_siteplan);
		$this->db->where('id_unit', $id_unit);
		$this->db->delete('tbl_unit_siteplan');
		
		# Menambahkan Koordinat baru
		$this->db->insert('tbl_unit_siteplan', array('id_siteplan' => $id_siteplan,'id_unit' => $id_unit,'coords' => $coords));
	}
	
	#===================#
	#	R E G U L A R   #
	#===================#
	
	# Mendapatkan data semua siteplan
	function get_all_regular()
	{
		$query = $this->db->query("
		SELECT *
		FROM tbl_siteplan
		WHERE status = 'Aktif'
		ORDER BY id_cluster, nama_siteplan");
		
		return $query;
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function get_unit_regular($id_siteplan)
	{		
		$query = $this->db->query("	SELECT		*, u.*
									FROM		tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
									LEFT JOIN	tbl_type t ON u.id_type = t.id_type
									LEFT JOIN	tbl_unit_siteplan us ON u.id_unit = us.id_unit
									WHERE
										u.status_unit = 'Marketable' AND 
										us.id_siteplan = '".$id_siteplan."' AND 
										us.coords != ''
									ORDER BY kode_unit ASC");
									
		return $query;
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function get_total_unit_regular_available($id_siteplan)
	{		
		$query = $this->db->query("	SELECT		
										count(u.id_unit) AS total, 
										sum(IF(u.status_transaksi = '', 1, 0)) AS total_available, 
										sum(IF(u.status_transaksi = 'Booked', 1, 0)) AS total_booked,
										sum(IF(u.status_transaksi = 'Sold', 1, 0)) AS total_sold
									FROM		tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
									LEFT JOIN	tbl_type t ON u.id_type = t.id_type
									LEFT JOIN	tbl_unit_siteplan us ON u.id_unit = us.id_unit
									WHERE
										u.status_unit = 'Marketable' AND 
										us.id_siteplan = '".$id_siteplan."' AND 
										us.coords != ''
								   ORDER BY u.kode_unit ASC
								   ");
		
		return $query->row();
	}
	
	# Menampilkan unit lainnya (yang tidak mempunyai siteplan)
	function get_unit_regular_lainnya_available()
	{
		$query = $this->db->query("	SELECT 		
										count(u.id_unit) AS total, 
										sum(IF(u.status_transaksi = '', 1, 0)) AS total_available, 
										sum(IF(u.status_transaksi = 'Booked', 1, 0)) AS total_booked,
										sum(IF(u.status_transaksi = 'Sold', 1, 0)) AS total_sold
									FROM 		tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster 
									LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
									LEFT JOIN 	tbl_unit_siteplan us ON u.id_unit = us.id_unit
									WHERE 
										u.status_unit = 'Marketable' AND 
										us.id_siteplan IS NULL
									");
		return $query->row();
	}
	
	
	
	#===============#
	#	P R O M O   #
	#===============#
	
	function get_all_promo()
	{
		$query = $this->db->query("
		SELECT *
		FROM tbl_unit u
		INNER JOIN tbl_promo p ON u.id_promo = p.id_promo
		INNER JOIN tbl_siteplan s ON u.id_cluster = s.id_cluster
		WHERE
			s.status = 'Aktif' AND
			p.status_promo = '1' AND 
			u.status_unit = 'Promo' 
		GROUP BY s.id_siteplan
		ORDER BY s.nama_siteplan");
		
		return $query;
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function get_unit_promo($id_siteplan)
	{		
		$query = $this->db->query("	SELECT		*, u.*
									FROM		tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
									LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
									INNER JOIN	tbl_promo p ON u.id_promo = p.id_promo
									LEFT JOIN	tbl_unit_siteplan us ON u.id_unit = us.id_unit
									WHERE
										u.status_unit = 'Promo' AND 
										us.id_siteplan = '".$id_siteplan."' AND 
										us.coords != '' AND 
										p.status_promo = '1'
								   ORDER BY u.kode_unit ASC");
								   
		return $query;
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function get_total_unit_promo_available($id_siteplan)
	{		
		$query = $this->db->query("	SELECT
										count(u.id_unit) AS total, 
										sum(IF(u.status_transaksi = '', 1, 0)) AS total_available, 
										sum(IF(u.status_transaksi = 'Booked', 1, 0)) AS total_booked,
										sum(IF(u.status_transaksi = 'Sold', 1, 0)) AS total_sold
									FROM		tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster
									LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
									INNER JOIN	tbl_promo p ON u.id_promo = p.id_promo
									LEFT JOIN	tbl_unit_siteplan us ON u.id_unit = us.id_unit
									WHERE
										u.status_unit = 'Promo' AND 
										us.id_siteplan = '".$id_siteplan."' AND 
										us.coords != '' AND 
										p.status_promo = '1'
								   ORDER BY u.kode_unit ASC
								   ");
		
		return $query->row();
	}
	
	# Menampilkan unit lainnya (yang tidak mempunyai siteplan)
	function get_unit_promo_lainnya_available()
	{
		$query = $this->db->query("	SELECT
										count(u.id_unit) AS total, 
										sum(IF(u.status_transaksi = '', 1, 0)) AS total_available, 
										sum(IF(u.status_transaksi = 'Booked', 1, 0)) AS total_booked,
										sum(IF(u.status_transaksi = 'Sold', 1, 0)) AS total_sold
									FROM 		tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster 
									LEFT JOIN 	tbl_type t ON u.id_type = t.id_type
									LEFT JOIN 	tbl_unit_siteplan us ON u.id_unit = us.id_unit
									INNER JOIN	tbl_promo p ON u.id_promo = p.id_promo
									WHERE
										u.status_unit = 'Promo' AND 
										p.status_promo = '1' AND 
										us.id_siteplan IS NULL
									");
		return $query->row();
	}
}

# End of file user_m.php
# Location: ./application/model/user_m.php