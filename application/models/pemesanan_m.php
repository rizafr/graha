<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pemesanan_m extends CI_Model
{
	private $tbl_pemesanan = 'tbl_pemesanan';
	private $tbl_nup = 'tbl_nup';

	function __Construct()
	{
		parent::__Construct();
	}
	
	# Menampilkan data pemesanan berdasarkan id_pemesanan
	function get_by_id($id_pemesanan)
	{
		$query = $this->db->query("	SELECT 		tbl_promo.*, 
												tbl_pemesanan.*, 
												tbl_nup.*,
												CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran,
												tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
												tbl_customer.nama_lengkap, tbl_customer.no_ktp, tbl_customer.no_npwp, tbl_customer.telpon, tbl_customer.hp, 
												tbl_customer.alamat_npwp, tbl_cluster.nama_cluster, tbl_unit.id_unit, tbl_unit.kode_unit, tbl_type.nama_type, tbl_unit.posisi, tbl_customer.alamat_surat_menyurat,
												tbl_customer.email, tbl_customer.alamat_ktp, tbl_customer.doc_ktp, tbl_customer.doc_npwp, tbl_customer.doc_kartu_keluarga,
												tbl_customer.doc_akta_nikah, tbl_customer.doc_siup
									FROM 		tbl_pemesanan
									INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
									LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
									INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
									INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
									INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
									INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
									INNER JOIN 	tbl_nup ON tbl_pemesanan.id_pemesanan = tbl_nup.id_pemesanan
									LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
									LEFT JOIN 	tbl_promo ON tbl_pemesanan.id_promo = tbl_promo.id_promo
									WHERE  		tbl_pemesanan.id_pemesanan = '".$id_pemesanan."'");
		return $query;
	}

	# Menampilkan data pemesanan berdasarkan jenis
	# ---------------------------------------------
	# Jenis 		: Marketable, Promo
	# Status Data 	: '' -> available, trash_data, timeout
	# Filter 		: Nomor Pemesanan, Cluster
	# Kategori 		: Real Estate, Kaveling, Ruko
	# Kata Kunci 	: Nomor Pemesanan
	function get_by_jenis($status, $jenis, $limit, $status_data, $filter, $id_cluster, $kategori, $kata_kunci)
	{
		
		$var_where = "";

		if($filter == "nomor_pemesanan")
		{
			$var_where = " AND tbl_pemesanan.nomor_pemesanan LIKE '%".mysql_real_escape_string($kata_kunci)."%'";
		}
		else if($filter == "cluster")
		{
			if($id_cluster != "0" OR $id_cluster != 0)
			{
				if($kategori == "0")
				{
					$var_where = " AND tbl_cluster.id_cluster = '".$id_cluster."'";
				}
				else if($kategori != "0")
				{
					$var_where = " AND tbl_cluster.id_cluster = '".$id_cluster."' AND tbl_unit.kategori = '".$kategori."'";
				}				
			}
			else if($id_cluster == "0" OR $id_cluster == 0)
			{
				if($kategori == "0")
				{
					$var_where = "";
				}
				else if($kategori != "0")
				{
					$var_where = " AND tbl_unit.kategori = '".$kategori."'";
				}
			}			
		}

		if ($this->session->userdata('level') == "Sales")
		{
			if($this->session->userdata('sm') == "Y")
			{
				$var_where .= " AND tbl_pemesanan.id_agen = '".$this->session->userdata('id_agent')."' ";
			}
			else
			{
				$var_where .= " AND tbl_pemesanan.id_user = '".$this->session->userdata('id_user')."' ";
			}
		}
		
		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		tbl_pemesanan.id_pemesanan, tbl_pemesanan.nomor_pemesanan, tbl_pemesanan.tanggal_pemesanan, tbl_pemesanan.id_agen,
													tbl_pemesanan.id_user, tbl_pemesanan.id_customer, tbl_pemesanan.id_promo, tbl_pemesanan.jenis_pemesanan, 
													tbl_pemesanan.status_pemesanan, tbl_pemesanan.status_verify, CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran, tbl_pemesanan.booking_fee, 
													tbl_pemesanan.tanggal_tanda_jadi, tbl_pemesanan.id_unit, tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
													tbl_customer.nama_lengkap, tbl_unit.id_unit, tbl_cluster.nama_cluster, tbl_unit.kode_unit, 
													tbl_type.nama_type, tbl_unit.posisi, tbl_unit.kategori, tbl_pemesanan.id_kartu_keluarga, tbl_pemesanan.timeout
										FROM 		tbl_pemesanan
										INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
										LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
										INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
										INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
										INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
										INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
										LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
										WHERE  		tbl_pemesanan.jenis_pemesanan = '".$jenis."' AND 
													tbl_pemesanan.status_pemesanan <> 'Sold' AND
													tbl_pemesanan.status_data = '".$status_data."'".$var_where);
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT 		tbl_pemesanan.id_pemesanan, tbl_pemesanan.nomor_pemesanan, tbl_pemesanan.tanggal_pemesanan, tbl_pemesanan.id_agen,
													tbl_pemesanan.id_user, tbl_pemesanan.id_customer, tbl_pemesanan.id_promo, tbl_pemesanan.jenis_pemesanan, 
													tbl_pemesanan.status_pemesanan, tbl_pemesanan.status_verify, CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran, tbl_pemesanan.booking_fee, 
													tbl_pemesanan.tanggal_tanda_jadi, tbl_pemesanan.id_unit, tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
													tbl_customer.nama_lengkap, tbl_unit.id_unit, tbl_cluster.nama_cluster, tbl_unit.kode_unit, 
													tbl_type.nama_type, tbl_unit.posisi, tbl_unit.kategori, tbl_pemesanan.id_kartu_keluarga, tbl_pemesanan.timeout
										FROM 		tbl_pemesanan
										INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
										LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
										INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
										INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
										INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
										INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
										LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
										WHERE  		tbl_pemesanan.jenis_pemesanan = '".$jenis."' AND 
													tbl_pemesanan.status_pemesanan <> 'Sold' AND
													tbl_pemesanan.status_data = '".$status_data."'".$var_where."
										ORDER BY 	tbl_pemesanan.id_pemesanan
										LIMIT 		".$limit.", 10");
		}
		return $query;
	}

	# Menampilkan data pemesanan berdasarkan status
	# ---------------------------------------------
	# Status 			: All, Limit
	# Jenis 			: Marketable, Promo
	# Status Data 		: '' -> available, trash_data, timeout
	# Filter 			: Nomor Pemesanan, Cluster, Jenis Transaksi
	# kategori 			: Real Estate, Kaveling, Ruko
	# Kata Kunci 		: Nomor pemesanan
	# Jenis Transaksi 	: Marketabel, Promo
	function get_by_status($status, $jenis, $limit, $status_data, $filter, $id_cluster, $kategori, $kata_kunci, $jenis_transaksi, $id_promo)
	{
		$var_where = "";

		if($filter == "nomor_pemesanan")
		{
			$var_where = " AND tbl_pemesanan.nomor_pemesanan LIKE '%".mysql_real_escape_string($kata_kunci)."%'";
		}
		else if($filter == "cluster")
		{
			if($id_cluster != "0" OR $id_cluster != 0)
			{
				if($kategori == "0")
				{
					$var_where = " AND tbl_cluster.id_cluster = '".$id_cluster."'";
				}
				else if($kategori != "0")
				{
					$var_where = " AND tbl_cluster.id_cluster = '".$id_cluster."' AND tbl_unit.kategori = '".$kategori."'";
				}				
			}
			else if($id_cluster == "0" OR $id_cluster == 0)
			{
				if($kategori == "0")
				{
					$var_where = "";
				}
				else if($kategori != "0")
				{
					$var_where = " AND tbl_unit.kategori = '".$kategori."'";
				}
			}			
		}
		else if($filter == "transaksi")
		{
			if($id_promo == 0)
			{
				$var_where = " AND tbl_pemesanan.jenis_pemesanan = '".$jenis_transaksi."'";
			}
			else
			{
				$var_where = " AND tbl_pemesanan.jenis_pemesanan = '".$jenis_transaksi."' AND tbl_pemesanan.id_promo = '".$id_promo."'";
			}			
		}

		if ($this->session->userdata('level') == "Sales")
		{
			if($this->session->userdata('sm') == "Y")
			{
				$var_where .= " AND tbl_pemesanan.id_agen = '".$this->session->userdata('id_agent')."' ";
			}
			else
			{
				$var_where .= " AND tbl_pemesanan.id_user = '".$this->session->userdata('id_user')."' ";
			}
		}

		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		tbl_pemesanan.id_pemesanan, tbl_pemesanan.nomor_pemesanan, tbl_pemesanan.tanggal_pemesanan, tbl_pemesanan.id_agen,
													tbl_pemesanan.id_user, tbl_pemesanan.id_customer, tbl_pemesanan.id_promo, tbl_pemesanan.jenis_pemesanan, 
													tbl_pemesanan.status_pemesanan, tbl_pemesanan.status_verify, CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran, tbl_pemesanan.booking_fee, 
													tbl_pemesanan.tanggal_tanda_jadi, tbl_pemesanan.id_unit, tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
													tbl_customer.nama_lengkap, tbl_unit.id_unit, tbl_cluster.nama_cluster, tbl_unit.kode_unit, 
													tbl_type.nama_type, tbl_unit.posisi, tbl_unit.kategori, tbl_pemesanan.id_kartu_keluarga, tbl_pemesanan.timeout
										FROM 		tbl_pemesanan
										INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
										LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
										INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
										INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
										INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
										INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
										LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
										WHERE  		tbl_pemesanan.status_pemesanan = 'Sold' AND
													tbl_pemesanan.status_data = ''".$var_where);
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT 		tbl_pemesanan.id_pemesanan, tbl_pemesanan.nomor_pemesanan, tbl_pemesanan.tanggal_pemesanan, tbl_pemesanan.id_agen,
													tbl_pemesanan.id_user, tbl_pemesanan.id_customer, tbl_pemesanan.id_promo, tbl_pemesanan.jenis_pemesanan, 
													tbl_pemesanan.status_pemesanan, tbl_pemesanan.status_verify, CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran, tbl_pemesanan.booking_fee, 
													tbl_pemesanan.tanggal_tanda_jadi, tbl_pemesanan.id_unit, tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
													tbl_customer.nama_lengkap, tbl_unit.id_unit, tbl_cluster.nama_cluster, tbl_unit.kode_unit, 
													tbl_type.nama_type, tbl_unit.posisi, tbl_unit.kategori, tbl_pemesanan.id_kartu_keluarga, tbl_pemesanan.timeout
										FROM 		tbl_pemesanan
										INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
										LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
										INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
										INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
										INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
										INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
										LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
										WHERE  		tbl_pemesanan.status_pemesanan ='Sold' AND
													tbl_pemesanan.status_data = ''".$var_where."
										ORDER BY 	tbl_pemesanan.id_pemesanan
										LIMIT 		".$limit.", 10");
		}
		return $query;
	}

	# Menampilkan data pemesanan berdasarkan status
	# ---------------------------------------------
	# Status Data 	: '' -> available, trash_data, timeout
	function get_by_status_data($status, $limit, $status_data)
	{
		$var_where = "";
		
		if ($this->session->userdata('level') == "Sales")
		{
			if($this->session->userdata('sm') == "Y")
			{
				$var_where .= " AND tbl_pemesanan.id_agen = '".$this->session->userdata('id_agent')."' ";
			}
			else
			{
				$var_where .= " AND tbl_pemesanan.id_user = '".$this->session->userdata('id_user')."' ";
			}
		}
		
		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		tbl_pemesanan.id_pemesanan, tbl_pemesanan.nomor_pemesanan, tbl_pemesanan.tanggal_pemesanan, tbl_pemesanan.id_agen,
													tbl_pemesanan.id_user, tbl_pemesanan.id_customer, tbl_pemesanan.id_promo, tbl_pemesanan.jenis_pemesanan, 
													tbl_pemesanan.status_pemesanan, tbl_pemesanan.status_verify, CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran, tbl_pemesanan.booking_fee, 
													tbl_pemesanan.tanggal_tanda_jadi, tbl_pemesanan.id_unit, tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
													tbl_customer.nama_lengkap, tbl_unit.id_unit, tbl_cluster.nama_cluster, tbl_unit.kode_unit, 
													tbl_type.nama_type, tbl_unit.posisi, tbl_unit.kategori, tbl_pemesanan.id_kartu_keluarga, tbl_pemesanan.timeout
										FROM 		tbl_pemesanan
										INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
										LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
										INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
										INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
										INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
										INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
										LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
										WHERE  		tbl_pemesanan.status_data = '".$status_data."' ".$var_where);
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT 		tbl_pemesanan.id_pemesanan, tbl_pemesanan.nomor_pemesanan, tbl_pemesanan.tanggal_pemesanan, tbl_pemesanan.id_agen,
													tbl_pemesanan.id_user, tbl_pemesanan.id_customer, tbl_pemesanan.id_promo, tbl_pemesanan.jenis_pemesanan, 
													tbl_pemesanan.status_pemesanan, tbl_pemesanan.status_verify, CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran, tbl_pemesanan.booking_fee, 
													tbl_pemesanan.tanggal_tanda_jadi, tbl_pemesanan.id_unit, tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
													tbl_customer.nama_lengkap, tbl_unit.id_unit, tbl_cluster.nama_cluster, tbl_unit.kode_unit, 
													tbl_type.nama_type, tbl_unit.posisi, tbl_unit.kategori, tbl_pemesanan.id_kartu_keluarga, tbl_pemesanan.timeout
										FROM 		tbl_pemesanan
										INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
										LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
										INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
										INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
										INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
										INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
										LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
										WHERE  		tbl_pemesanan.status_data = '".$status_data."' ".$var_where." 
										LIMIT 		".$limit.", 10");
		}
		
		return $query;
	}

	# Menampilkan trash data yang dicari
	# ----------------------------------
	# Status Data 	: '' -> available, trash_data, timeout
	# Kata Kunci 	: Nomor pemesanan
	function get_by_status_data_cari($status, $limit, $status_data, $kata_kunci)
	{
		$var_where = "";

		if($kata_kunci != "")
		{
			$var_where = " AND tbl_pemesanan.nomor_pemesanan like '%".mysql_real_escape_string($kata_kunci)."%'";
		}
		
		if ($this->session->userdata('level') == "Sales")
		{
			if($this->session->userdata('sm') == "Y")
			{
				$var_where .= " AND tbl_pemesanan.id_agen = '".$this->session->userdata('id_agent')."' ";
			}
			else
			{
				$var_where .= " AND tbl_pemesanan.id_user = '".$this->session->userdata('id_user')."' ";
			}
		}
		
		if($status == "all")
		{
			$query = $this->db->query("	SELECT 		tbl_pemesanan.id_pemesanan, tbl_pemesanan.nomor_pemesanan, tbl_pemesanan.tanggal_pemesanan, tbl_pemesanan.id_agen,
													tbl_pemesanan.id_user, tbl_pemesanan.id_customer, tbl_pemesanan.id_promo, tbl_pemesanan.jenis_pemesanan, 
													tbl_pemesanan.status_pemesanan, tbl_pemesanan.status_verify, CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran, tbl_pemesanan.booking_fee, 
													tbl_pemesanan.tanggal_tanda_jadi, tbl_pemesanan.id_unit, tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
													tbl_customer.nama_lengkap, tbl_unit.id_unit, tbl_cluster.nama_cluster, tbl_unit.kode_unit, 
													tbl_type.nama_type, tbl_unit.posisi, tbl_unit.kategori, tbl_pemesanan.id_kartu_keluarga, tbl_pemesanan.timeout
										FROM 		tbl_pemesanan
										INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
										LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
										INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
										INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
										INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
										INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
										LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
										WHERE  		tbl_pemesanan.status_data = '".$status_data."'".$var_where);
		}
		else if($status == "limit")
		{
			$query = $this->db->query("	SELECT 		tbl_pemesanan.id_pemesanan, tbl_pemesanan.nomor_pemesanan, tbl_pemesanan.tanggal_pemesanan, tbl_pemesanan.id_agen,
													tbl_pemesanan.id_user, tbl_pemesanan.id_customer, tbl_pemesanan.id_promo, tbl_pemesanan.jenis_pemesanan, 
													tbl_pemesanan.status_pemesanan, tbl_pemesanan.status_verify, CONCAT(tbl_pemesanan.tipe_pembayaran, ' ', tbl_pemesanan.tahap_pembayaran) AS cara_pembayaran, tbl_pemesanan.booking_fee, 
													tbl_pemesanan.tanggal_tanda_jadi, tbl_pemesanan.id_unit, tbl_agent.team as 'nama_agent', sm.nama_lengkap AS sales_manager, tbl_user.nama_lengkap as 'nama_sales', 
													tbl_customer.nama_lengkap, tbl_unit.id_unit, tbl_cluster.nama_cluster, tbl_unit.kode_unit, 
													tbl_type.nama_type, tbl_unit.posisi, tbl_unit.kategori, tbl_pemesanan.id_kartu_keluarga, tbl_pemesanan.timeout
										FROM 		tbl_pemesanan
										INNER JOIN 	tbl_agent ON tbl_pemesanan.id_agen = tbl_agent.id_agent
										LEFT JOIN	tbl_user sm ON tbl_agent.id_sm = sm.id_user
										INNER JOIN 	tbl_user ON tbl_pemesanan.id_user = tbl_user.id_user
										INNER JOIN 	tbl_customer ON tbl_pemesanan.id_customer = tbl_customer.id_customer
										INNER JOIN 	tbl_unit ON tbl_pemesanan.id_unit = tbl_unit.id_unit
										INNER JOIN 	tbl_cluster ON tbl_unit.id_cluster = tbl_cluster.id_cluster
										LEFT JOIN 	tbl_type ON tbl_unit.id_type = tbl_type.id_type
										WHERE  		tbl_pemesanan.status_data = '".$status_data."'".$var_where."
										LIMIT 		".$limit.", 10");
		}
		
		return $query;
	}

	function get_latest_data()
	{
		$this->db->order_by("id_pemesanan", "DESC");
		$query = $this->db->get($this->tbl_pemesanan, 1, 0);
		return $query;
	}

	# Menyimpan data pemesanan
	function add($data)
	{
		$this->db->insert($this->tbl_pemesanan, $data);
		return $this->db->insert_id();
	}
	
	# Menyimpan data nup
	function add_nup($data)
	{
		$this->db->insert($this->tbl_nup, $data);
	}

	# Mengubah data pemesanan
	function edit($id_pemesanan, $data)
	{
		$this->db->where('id_pemesanan', $id_pemesanan);
		$this->db->update($this->tbl_pemesanan, $data);
		return $this->db->affected_rows();
	}

	# Menghapus data pemesanan
	function delete($id_pemesanan)
	{
		$this->db->where('id_pemesanan', $id_pemesanan);
		$this->db->delete($this->tbl_pemesanan);
	}
	
	# Cek Data Pemesanan Timeout Booked
	function scheduler_timeout()
	{
		$query = $this->db->query("
			SELECT	id_pemesanan, id_unit, status_pemesanan, timeout, tanggal_pemesanan, tanggal_tanda_jadi 
			FROM	tbl_pemesanan
			WHERE	(status_pemesanan = 'Booked' OR status_pemesanan = 'Tanda Jadi') AND 
					status_verify = '' AND 
					status_data = ''");
		
		return $query;
	}

}

/* End of file Pemesanan_m.php */
/* Location: ./application/models/Pemesanan_m.php */