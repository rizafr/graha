<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Promo_m extends CI_Model
{
	private $tbl_promo = 'tbl_promo';
	
	function __Construct()
	{
		parent::__Construct();
	}
	
	# Mendapatkan semua data promo
	function get_all($status, $limit)
	{
		if($status == "all")
		{
			$query = $this->db->query("SELECT 	*
									   FROM		tbl_promo
									   ORDER BY status_promo DESC, tanggal_mulai DESC");
		}else if($status == "limit")
		{
			$query = $this->db->query("SELECT 	*
									   FROM		tbl_promo
									   ORDER BY status_promo DESC, tanggal_mulai DESC
									   LIMIT	".$limit.", 10");
		}
		return $query;
	}
	
	# Mendapatkan data promo berdasarkan id_promo
	function get_by_id($id_promo)
	{
		$query = $this->db->get_where($this->tbl_promo, array('id_promo' => $id_promo));
		return $query;
	}	
	
	# Menambah data event
	function add($data)
	{				
		$this->db->insert($this->tbl_promo, $data);
		return $this->db->insert_id();
	}
	
	# Mengubah data event
	function update($id_promo, $data)
	{		
		$this->db->where('id_promo', $id_promo);
		$this->db->update($this->tbl_promo, $data);
	}
	
	# Menghapus data event
	function delete($id_promo)
	{
		$found = $this->db->query("
			SELECT *
			FROM tbl_unit 
			WHERE id_promo = '".$id_promo."' AND status_transaksi != ''")->row();
		
		if (count($found) > 0)
		{
			return "found";
		}
		else
		{
			$this->db->where('id_promo', $id_promo);
			$this->db->delete($this->tbl_promo);
			
			# Reset Promo By id_promo
			$data_unit = array(	"id_promo" => '',
								"diskon_tanah" => '',
								"diskon_bangunan" => '',
								"status_unit" => 'Marketable'
			);
			$this->db->where('id_promo', $id_promo);
			$this->db->where('status_transaksi', '');
			$this->db->update("tbl_unit", $data_unit);
			
			return "ok";
		}
	}
	
	# Set Status Tidak Aktif
	function deactive_status($id_promo)
	{		
		$data = array("status_promo" => "0");
		$this->db->where('id_promo !=', $id_promo);
		$this->db->update($this->tbl_promo, $data);
	}
	
	# Query event yang masih aktif
	function get_active_promo()
	{
		$query = $this->db->get_where($this->tbl_promo, array('status_promo' => '1'));
		return $query;
	}
	
	# Mengambil unit promo
	function get_active_promo_by_id_unit($id_unit){
		$query = $this->db->query("
			SELECT *
			FROM tbl_unit u
			INNER JOIN tbl_promo p ON u.id_promo = p.id_promo
			WHERE u.id_unit = '".$id_unit."' AND p.status_promo = '1'
		");
		
		return $query;
	}
	
	# Mengambil unit promo
	function get_all_unit_promo($id_promo){
		$query = $this->db->query("
			SELECT *
			FROM tbl_unit u 
			INNER JOIN tbl_cluster c ON u.id_cluster = c.id_cluster 
			LEFT JOIN tbl_type t ON u.id_type = t.id_type
			WHERE u.id_promo = '".$id_promo."'
			ORDER BY c.nama_cluster ASC, u.kode_unit ASC, nama_type ASC
		");
		
		return $query;
	}
	
	# Ambil Unit Untuk Promo
	function get_unit_promo_opt($id_cluster, $id_promo)
	{
		$query = $this->db->query("	SELECT 		*
									FROM 		tbl_unit u
									INNER JOIN	tbl_cluster c ON u.id_cluster = c.id_cluster 
									LEFT JOIN	tbl_type t ON u.id_type = t.id_type 
									WHERE 		u.status_unit != 'Master' AND 
												u.status_transaksi = '' AND 
												u.id_cluster = '".$id_cluster."' AND
												u.id_promo != '".$id_promo."' 
								");
		return $query;
	}
	
	# Menambahkan unit promo
	function save_unit_promo($id_promo, $id_unit, $diskon_tanah, $diskon_bangunan, $mx_tnh, $mx_bgn){
		
		$data_unit = array(	"id_promo" => $id_promo,
							"diskon_tanah" => $diskon_tanah,
							"diskon_bangunan" => $diskon_bangunan,
							"status_unit" => 'Promo'
		);
		$this->db->where('id_unit', $id_unit);
		$this->db->update("tbl_unit", $data_unit);
		
		$this->save_max_diskon($id_unit, $mx_tnh, $mx_bgn);
	}
	
	# Menambahkan unit promo
	function delete_unit_promo($id_unit){
		
		$data_unit = array(	"id_promo" => '',
							"diskon_tanah" => '',
							"diskon_bangunan" => '',
							"status_unit" => 'Marketable'
		);
		$this->db->where('id_unit', $id_unit);
		$this->db->update("tbl_unit", $data_unit);
		
		$this->db->where("id_unit", $id_unit);
		$this->db->delete("tbl_unit_promo");
	}
	
	# Mendapatkan data customer berdasarkan id
	function save_max_diskon($id_unit, $mx_tnh, $mx_bgn)
	{
		$this->db->where("id_unit", $id_unit);
		$this->db->delete("tbl_unit_promo");
		
		foreach($mx_tnh AS $id_cara_pembayaran => $i)
		{
			$data = array(	"id_unit"				=> $id_unit,
							"id_cara_pembayaran"	=> $id_cara_pembayaran,
							"max_diskon_tanah"		=> $mx_tnh[$id_cara_pembayaran],
							"max_diskon_bangunan"	=> $mx_bgn[$id_cara_pembayaran]
							);
			
			$this->db->insert("tbl_unit_promo", $data);
		}
		
	}
	
	public function get_max_diskon($id_unit)
	{
		$query = $this->db->query("
		SELECT 
			*, b.*,
			CONCAT(b.tipe_pembayaran, ' ', b.tahap_pembayaran) AS cara_pembayaran,
			IFNULL(a.max_diskon_tanah,0) AS max_diskon_tanah, 
			IFNULL(a.max_diskon_bangunan,0) AS max_diskon_bangunan
		FROM 
			tbl_cara_pembayaran b
		LEFT JOIN tbl_unit_promo a ON a.id_cara_pembayaran = b.id_cara_pembayaran AND a.id_unit = '".$id_unit."' 
		ORDER BY b.tipe_pembayaran ASC, b.tahap_pembayaran ASC
		");
		
		return $query;
	}
	
	public function reset_promo()
	{
		$this->db->query("
		UPDATE tbl_unit 
		SET 
			id_promo = '',
			diskon_tanah = '', 
			diskon_bangunan = '',
			status_unit = 'Marketable'
		WHERE 
			status_transaksi = '' AND 
			status_unit = 'Promo'
		");
	}
	
}

# End of file promo_m.php
# Location: ./application/model/promo_m.php