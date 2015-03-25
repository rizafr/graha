<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Timeout_m extends CI_Model 
{
	private $tbl_timeout = 'tbl_timeout';

	function __construct()
	{
		parent::__construct();
	}	

	public function get_all()
	{
		$query = $this->db->query("SELECT * FROM tbl_timeout ORDER BY status DESC, status_pemesanan ASC");
		return $query;
	}

	public function get_by_id($id_timeout)
	{
		$query = $this->db->get_where($this->tbl_timeout, array('id_timeout' => $id_timeout));
		return $query;
	}
	
	public function get_active_booking()
	{
		$query = $this->db->query("SELECT * FROM tbl_timeout WHERE status_pemesanan = 'Booking' AND status = '1'");
		return $query;
	}
	
	public function get_active_tanda_jadi()
	{
		$query = $this->db->query("SELECT * FROM tbl_timeout WHERE status_pemesanan = 'Tanda Jadi' AND status = '1'");
		return $query;
	}
	
	public function get_active_locked()
	{
		$query = $this->db->query("SELECT * FROM tbl_timeout WHERE status_pemesanan = 'Locked (Siteplan)' AND status = '1'");
		return $query;
	}

	public function add($data)
	{
		$this->db->insert($this->tbl_timeout, $data);
		return $this->db->insert_id();
	}

	public function edit($id_timeout, $data)
	{
		$this->db->where('id_timeout', $id_timeout);
		$this->db->update($this->tbl_timeout, $data);
		return $this->db->affected_rows();
	}

	public function delete($id_timeout)
	{
		$this->db->where('id_timeout', $id_timeout);
		$this->db->delete($this->tbl_timeout);
		return $this->db->affected_rows();
	}
	
	public function deactive($status_pemesanan, $id_timeout)
	{
		$this->db->where('status_pemesanan', $status_pemesanan);
		$this->db->where('id_timeout !=', $id_timeout);
		$this->db->update($this->tbl_timeout, array("status" => "0"));
	}
}

/* End of file timeout_m.php */
/* Location: ./application/models/timeout_m.php */