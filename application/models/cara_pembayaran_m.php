<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cara_pembayaran_m extends CI_Model 
{
	private $tbl_cara_pembayaran = 'tbl_cara_pembayaran';

	function __construct()
	{
		parent::__construct();
	}

	public function get_all()
	{
		$query = $this->db->query("	SELECT 
										*, 
										CONCAT(tipe_pembayaran, ' ', tahap_pembayaran) AS cara_pembayaran
									FROM tbl_cara_pembayaran
									ORDER BY tipe_pembayaran ASC, tahap_pembayaran ASC");
		return $query;
	}

	public function get_by_id($id_cara_pembayaran)
	{
		$query = $this->db->query("	SELECT 
										*, 
										CONCAT(tipe_pembayaran, ' ', tahap_pembayaran) AS cara_pembayaran
									FROM tbl_cara_pembayaran
									WHERE id_cara_pembayaran = '".$id_cara_pembayaran."' 
									ORDER BY tipe_pembayaran ASC, tahap_pembayaran ASC");
		return $query;
	}

	public function add($data)
	{
		$this->db->insert($this->tbl_cara_pembayaran, $data);
		return $this->db->insert_id();
	}

	public function edit($id_cara_pembayaran, $data)
	{
		$this->db->where('id_cara_pembayaran', $id_cara_pembayaran);
		$this->db->update($this->tbl_cara_pembayaran, $data);
	}

	public function delete($id_cara_pembayaran)
	{
		$this->db->where('id_cara_pembayaran', $id_cara_pembayaran);
		$this->db->delete($this->tbl_cara_pembayaran);
		return $this->db->affected_rows();
	}
		
}

/* End of file cara_pembayaran_m.php */
/* Location: ./application/models/cara_pembayaran_m.php */