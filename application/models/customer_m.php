<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_m extends CI_Model 
{	
	var $tanggal;
	private $tbl_customer 	= "tbl_customer";
	private $tbl_dokumen 	= "tbl_customer_dokumen";

	function __Construct()
	{
		parent::__Construct();
	}

	# Mendapatkan data customer berdasarkan id
	function get_by_id($id_customer)
	{
		$query = $this->db->query("SELECT * FROM tbl_customer WHERE id_customer = '".$id_customer."'");
		return $query;
	}

	# Menampilkan semua data customer
	function get_all($status, $limit)
	{
		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		*
										FROM 		tbl_customer
										ORDER BY 	id_customer ASC");
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT 		*
										FROM 		tbl_customer
										ORDER BY 	id_customer ASC
										LIMIT 		".$limit.", 10");
		}		
		return $query;
	}

	# Menampilkan semua data customer
	function get_all_cari($status, $katakunci, $limit)
	{
		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		*
										FROM 		tbl_customer
										WHERE 		nama_lengkap LIKE '%".mysql_real_escape_string($katakunci)."%' OR no_ktp LIKE '%".$katakunci."%'
										ORDER BY 	id_customer ASC");
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT 		*
										FROM 		tbl_customer
										WHERE 		nama_lengkap LIKE '%".mysql_real_escape_string($katakunci)."%' OR no_ktp LIKE '%".$katakunci."%'
										ORDER BY 	id_customer ASC
										LIMIT 		".$limit.", 10");
		}		
		return $query;
	}

	# Menyimpan data customer
	function add($data)
	{
		$this->db->insert($this->tbl_customer, $data);
		return $this->db->insert_id();
	}

	# Mengubah data customer
	function edit($id_customer, $data)
	{
		$this->db->where('id_customer', $id_customer);
		$this->db->update($this->tbl_customer, $data);
	}

	# Menghapus data customer
	function delete($id_customer)
	{
		$this->db->where('id_customer', $id_customer);
		$this->db->delete($this->tbl_customer);
	}


	#	--------------------------------
	#	D O K U M E N  L E G A L I T A S
	#	--------------------------------

	# Mendapatkan data dokumen berdasarkan id_anggota_keluarga
	function get_dokumen_by_id_customer($id_customer)
	{
		$query = $this->db->get_where($this->tbl_dokumen, array("id_customer" => $id_customer));
		return $query;
	}

	# Mendapatkan data dokumen berdasarkan id_dokumen
	function get_dokumen_by_id($id_dokumen)
	{
		$query = $this->db->get_where($this->tbl_dokumen, array("id_dokumen" => $id_dokumen));
		return $query;
	}

	# Menambah data dokumen
	function add_dokumen($data)
	{
		$this->db->insert($this->tbl_dokumen, $data);
		return $this->db->insert_id();
	}

	# Menghapus data dokumen
	function delete_dokumen($id_dokumen)
	{
		$this->db->where('id_dokumen', $id_dokumen);
		$this->db->delete($this->tbl_dokumen);
	}
	
	# Mendapatkan data customer berdasarkan no_ktp
	function get_by_no_ktp($no_ktp)
	{
		$query = $this->db->query("SELECT * FROM tbl_customer WHERE no_ktp = '".mysql_real_escape_string($no_ktp)."' ORDER BY id_customer DESC");
		return $query;
	}
}

/* End of file customer_m.php */
/* Location: ./application/models/customer_m.php */