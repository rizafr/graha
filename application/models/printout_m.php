<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Printout_m extends CI_Model
{
	function __Construct()
	{
		parent::__Construct();
	}
	
	# Booked
	function booked($type, $tanggal, $kategori = "0", $jenis_pemesanan = "0", $id_agent = "0", $id_user = "0")
	{
		$where = "";
		$date = explode("-", $tanggal);
		$yy = $date[0];
		$mm = $date[1];
		$dd = $date[2];
		
		if ($type == 'harian')
		{
			$where = " AND DATE(p.tanggal_pemesanan) = '".$tanggal."' ";
		}
		elseif ($type == 'bulanan')
		{
			$where = " AND YEAR(p.tanggal_pemesanan) = '".$yy."' AND MONTH(p.tanggal_pemesanan) = '".$mm."' ";
		}
		
		if ($kategori != '0')
		{
			$where .= " AND u.kategori = '".$kategori."' ";
		}
		if ($jenis_pemesanan != '0')
		{
			$where .= " AND p.jenis_pemesanan = '".$jenis_pemesanan."' ";
		}
		
		if ($id_agent != '0')
		{
			$where .= " AND a.id_agent = '".$id_agent."' ";
		}
		if ($id_user != '0')
		{
			$where .= " AND p.id_user = '".$id_user."' ";
		}
		
		$query = $this->db->query("
		
		SELECT
			p.nomor_pemesanan,
			u.kode_unit,
			UPPER(c.nama_lengkap) AS nama_pembeli,
			CONCAT_WS(' ',t.nama_type,u.posisi) AS tipe_bangunan,
			u.luas_tanah,
			u.luas_bangunan,
			u.harga_tanah_m2,
			u.fs,
			u.harga_bangunan_m2,
			p.diskon_tanah,
			p.diskon_bangunan,
			u.harga_tanah,
			u.harga_bangunan,
			u.harga_jual_exc_ppn,
			DATE_FORMAT(p.tanggal_pemesanan,'%d-%b-%Y') AS tanggal_pemesanan,
			p.booking_fee,
			s.nama_lengkap AS nama_sales,
			p.tipe_pembayaran,
			p.tahap_pembayaran,
			CONCAT(p.tipe_pembayaran, ' ', p.tahap_pembayaran) AS cara_pembayaran,
			p.jenis_pemesanan
			
		FROM tbl_pemesanan p
		INNER JOIN tbl_unit u ON p.id_unit = u.id_unit
		LEFT JOIN tbl_type t ON u.id_type = t.id_type
		LEFT JOIN tbl_user s ON p.id_user = s.id_user
		LEFT JOIN tbl_agent a ON s.id_agent = a.id_agent
		LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
		LEFT JOIN tbl_customer c ON p.id_customer = c.id_customer
		WHERE
			p.status_pemesanan = 'Booked' AND p.status_verify = 'Verified' AND p.status_data = '' ".$where);
			
		return $query;
	}
	
	# Tanda Jadi
	function tanda_jadi($type, $tanggal, $kategori = "0", $jenis_pemesanan = "0", $id_agent = "0", $id_user = "0")
	{
		$where = "";
		$date = explode("-", $tanggal);
		$yy = $date[0];
		$mm = $date[1];
		$dd = $date[2];
		
		if ($type == 'harian')
		{
			$where = " AND DATE(p.tanggal_tanda_jadi) = '".$tanggal."' ";
		}
		elseif ($type == 'bulanan')
		{
			$where = " AND YEAR(p.tanggal_tanda_jadi) = '".$yy."' AND MONTH(p.tanggal_tanda_jadi) = '".$mm."' ";
		}
		
		if ($kategori != '0')
		{
			$where .= " AND u.kategori = '".$kategori."' ";
		}
		if ($jenis_pemesanan != '0')
		{
			$where .= " AND p.jenis_pemesanan = '".$jenis_pemesanan."' ";
		}
		
		if ($id_agent != '0')
		{
			$where .= " AND a.id_agent = '".$id_agent."' ";
		}
		if ($id_user != '0')
		{
			$where .= " AND p.id_user = '".$id_user."' ";
		}
		
		$query = $this->db->query("
		
		SELECT
			p.nomor_pemesanan,
			DATE_FORMAT(p.tanggal_tanda_jadi,'%d-%b-%Y') AS tanggal_tanda_jadi,
			cl.nama_cluster,
			u.kode_unit,
			UPPER(c.nama_lengkap) AS nama_pembeli,
			u.kategori,
			CONCAT_WS(' ',t.nama_type,u.posisi) AS tipe_bangunan,
			u.luas_tanah,
			u.luas_bangunan,
			u.harga_tanah_m2,
			u.fs,
			u.harga_bangunan_m2,
			p.diskon_tanah,
			p.diskon_bangunan,
			u.harga_tanah,
			u.harga_bangunan,
			u.harga_jual_exc_ppn,
			u.harga_jual_inc_ppn,
			s.nama_lengkap AS nama_sales,
			p.tipe_pembayaran,
			p.tahap_pembayaran,
			CONCAT(p.tipe_pembayaran, ' ', p.tahap_pembayaran) AS cara_pembayaran,
			u.tanda_jadi,
			p.jenis_pemesanan
			
		FROM tbl_pemesanan p
		INNER JOIN tbl_unit u ON p.id_unit = u.id_unit
		INNER JOIN tbl_cluster cl ON u.id_cluster = cl.id_cluster
		INNER JOIN tbl_type t ON u.id_type = t.id_type
		LEFT JOIN tbl_user s ON p.id_user = s.id_user
		LEFT JOIN tbl_agent a ON s.id_agent = a.id_agent
		LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
		LEFT JOIN tbl_customer c ON p.id_customer = c.id_customer
		WHERE
			p.status_pemesanan = 'Tanda Jadi' AND p.status_verify = 'Verified' AND p.status_data = '' ".$where);
			
		return $query;
	}
	
	# Sold
	function sold($type, $tanggal, $kategori = "0", $jenis_pemesanan = "0", $id_agent = "0", $id_user = "0")
	{
		$where = "";
		$date = explode("-", $tanggal);
		$yy = $date[0];
		$mm = $date[1];
		$dd = $date[2];
		
		if ($type == 'harian')
		{
			$where = " AND DATE(p.tanggal_sold) = '".$tanggal."' ";
		}
		elseif ($type == 'bulanan')
		{
			$where = " AND YEAR(p.tanggal_sold) = '".$yy."' AND MONTH(p.tanggal_sold) = '".$mm."' ";
		}
		
		if ($kategori != '0')
		{
			$where .= " AND u.kategori = '".$kategori."' ";
		}
		if ($jenis_pemesanan != '0')
		{
			$where .= " AND p.jenis_pemesanan = '".$jenis_pemesanan."' ";
		}
		
		if ($id_agent != '0')
		{
			$where .= " AND a.id_agent = '".$id_agent."' ";
		}
		if ($id_user != '0')
		{
			$where .= " AND p.id_user = '".$id_user."' ";
		}
		
		$query = $this->db->query("
		
		SELECT
			p.nomor_pemesanan,
			DATE_FORMAT(p.tanggal_tanda_jadi,'%d-%b-%Y') AS tanggal_tanda_jadi,
			cl.nama_cluster,
			u.kode_unit,
			UPPER(c.nama_lengkap) AS nama_pembeli,
			u.kategori,
			CONCAT_WS(' ',t.nama_type,u.posisi) AS tipe_bangunan,
			u.luas_tanah,
			u.luas_bangunan,
			u.harga_tanah_m2,
			u.fs,
			u.harga_bangunan_m2,
			p.diskon_tanah,
			p.diskon_bangunan,
			u.harga_tanah,
			u.harga_bangunan,
			u.harga_jual_exc_ppn,
			u.harga_jual_inc_ppn,
			s.nama_lengkap AS nama_sales,
			p.tipe_pembayaran,
			p.tahap_pembayaran,
			CONCAT(p.tipe_pembayaran, ' ', p.tahap_pembayaran) AS cara_pembayaran,
			u.tanda_jadi,
			p.jenis_pemesanan
			
		FROM tbl_pemesanan p
		INNER JOIN tbl_unit u ON p.id_unit = u.id_unit
		INNER JOIN tbl_cluster cl ON u.id_cluster = cl.id_cluster
		INNER JOIN tbl_type t ON u.id_type = t.id_type
		LEFT JOIN tbl_user s ON p.id_user = s.id_user
		LEFT JOIN tbl_agent a ON s.id_agent = a.id_agent
		LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
		LEFT JOIN tbl_customer c ON p.id_customer = c.id_customer
		WHERE
			p.status_pemesanan = 'Sold' AND p.status_data = '' ".$where);
			
		return $query;
	}
	
	# Timeout
	function timeout($kategori = "0", $jenis_pemesanan = "0", $id_agent = "0", $id_user = "0")
	{
		$where = '';
		if ($kategori != '0')
		{
			$where .= " AND u.kategori = '".$kategori."' ";
		}
		if ($jenis_pemesanan != '0')
		{
			$where .= " AND p.jenis_pemesanan = '".$jenis_pemesanan."' ";
		}
		
		if ($id_agent != '0')
		{
			$where .= " AND a.id_agent = '".$id_agent."' ";
		}
		if ($id_user != '0')
		{
			$where .= " AND p.id_user = '".$id_user."' ";
		}
		
		$query = $this->db->query("
		
		SELECT
			p.nomor_pemesanan,
			p.status_pemesanan,
			p.timeout,
			p.booking_fee,
			p.tanggal_pemesanan,
			p.tanggal_tanda_jadi,
			cl.nama_cluster,
			u.kode_unit,
			UPPER(c.nama_lengkap) AS nama_pembeli,
			u.kategori,
			CONCAT_WS(' ',t.nama_type,u.posisi) AS tipe_bangunan,
			u.luas_tanah,
			u.luas_bangunan,
			u.harga_tanah_m2,
			u.fs,
			u.harga_bangunan_m2,
			p.diskon_tanah,
			p.diskon_bangunan,
			u.harga_tanah,
			u.harga_bangunan,
			u.harga_jual_exc_ppn,
			u.harga_jual_inc_ppn,
			s.nama_lengkap AS nama_sales,
			p.tipe_pembayaran,
			p.tahap_pembayaran,
			CONCAT(p.tipe_pembayaran, ' ', p.tahap_pembayaran) AS cara_pembayaran,
			u.tanda_jadi,
			p.jenis_pemesanan
			
		FROM tbl_pemesanan p
		INNER JOIN tbl_unit u ON p.id_unit = u.id_unit
		INNER JOIN tbl_cluster cl ON u.id_cluster = cl.id_cluster
		INNER JOIN tbl_type t ON u.id_type = t.id_type
		LEFT JOIN tbl_user s ON p.id_user = s.id_user
		LEFT JOIN tbl_agent a ON s.id_agent = a.id_agent
		LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
		LEFT JOIN tbl_customer c ON p.id_customer = c.id_customer
		WHERE
			p.status_data = 'timeout' ".$where);
			
		return $query;
	}
	
	# trash Data
	function trash_data($kategori = "0", $jenis_pemesanan = "0", $id_agent = "0", $id_user = "0")
	{
		$where = '';
		if ($kategori != '0')
		{
			$where .= " AND u.kategori = '".$kategori."' ";
		}
		if ($jenis_pemesanan != '0')
		{
			$where .= " AND p.jenis_pemesanan = '".$jenis_pemesanan."' ";
		}
		
		if ($id_agent != '0')
		{
			$where .= " AND a.id_agent = '".$id_agent."' ";
		}
		if ($id_user != '0')
		{
			$where .= " AND p.id_user = '".$id_user."' ";
		}
		
		$query = $this->db->query("
		
		SELECT
			p.nomor_pemesanan,
			p.status_pemesanan,
			p.status_verify,
			p.booking_fee,
			p.delete_time,
			x.nama_lengkap AS delete_by,
			DATE_FORMAT(p.tanggal_pemesanan,'%d-%b-%Y') AS tanggal_pemesanan,
			DATE_FORMAT(p.tanggal_tanda_jadi,'%d-%b-%Y') AS tanggal_tanda_jadi,
			cl.nama_cluster,
			u.kode_unit,
			UPPER(c.nama_lengkap) AS nama_pembeli,
			u.kategori,
			CONCAT_WS(' ',t.nama_type,u.posisi) AS tipe_bangunan,
			u.luas_tanah,
			u.luas_bangunan,
			u.harga_tanah_m2,
			u.fs,
			u.harga_bangunan_m2,
			p.diskon_tanah,
			p.diskon_bangunan,
			u.harga_tanah,
			u.harga_bangunan,
			u.harga_jual_exc_ppn,
			u.harga_jual_inc_ppn,
			s.nama_lengkap AS nama_sales,
			p.tipe_pembayaran,
			p.tahap_pembayaran,
			CONCAT(p.tipe_pembayaran, ' ', p.tahap_pembayaran) AS cara_pembayaran,
			u.tanda_jadi,
			p.jenis_pemesanan
			
		FROM tbl_pemesanan p
		INNER JOIN tbl_unit u ON p.id_unit = u.id_unit
		INNER JOIN tbl_cluster cl ON u.id_cluster = cl.id_cluster
		INNER JOIN tbl_type t ON u.id_type = t.id_type
		LEFT JOIN tbl_user s ON p.id_user = s.id_user
		LEFT JOIN tbl_agent a ON s.id_agent = a.id_agent
		LEFT JOIN tbl_user sm ON a.id_sm = sm.id_user
		LEFT JOIN tbl_user x ON p.delete_by = x.id_user
		LEFT JOIN tbl_customer c ON p.id_customer = c.id_customer
		WHERE
			p.status_data = 'trash_data' ".$where);
			
		return $query;
	}
	
	# Stok Unit
	function stok($status, $kategori = "0")
	{
		
		$where = "";
		if ($kategori != '0')
		{
			$where = " AND u.kategori = '".$kategori."' ";
		}
		
		$query = $this->db->query("
		
		SELECT
			c.nama_cluster,
			u.status_unit,
			u.kode_unit,
			u.kategori,
			CONCAT_WS(' ',t.nama_type,u.posisi) AS tipe_bangunan,
			u.luas_tanah,
			u.luas_bangunan,
			u.harga_tanah_m2,
			u.fs,
			u.harga_bangunan_m2,
			u.diskon_tanah,
			u.diskon_bangunan,
			u.harga_tanah,
			u.harga_bangunan,
			u.harga_jual_exc_ppn,
			(u.harga_tanah/10) AS ppn_tanah,
			(u.harga_bangunan/10) AS ppn_bangunan,
			((u.harga_tanah/10)+(u.harga_bangunan/10)) AS total_ppn,
			u.harga_jual_inc_ppn,
			u.kelas_produk	
		FROM tbl_unit u
		INNER JOIN tbl_cluster c ON u.id_cluster = c.id_cluster
		LEFT JOIN tbl_type t ON u.id_type = t.id_type
		WHERE
			u.status_unit = '".$status."' AND u.status_transaksi = '' ".$where);
			
		return $query;
	}

}

/* End of file Pemesanan_m.php */
/* Location: ./application/models/Pemesanan_m.php */