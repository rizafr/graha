<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class File_dokumen_m extends CI_Model 
{
	private $tbl_dokumen = 'tbl_file_dokumen';
	
	function __construct()
	{
		parent::__construct();
	}

	public function get_all()
	{
		$query = $this->db->get($this->tbl_dokumen);
		return $query;
	}

	public function get_by_id($id_dokumen)
	{
		$query = $this->db->get_where($this->tbl_file_dokumen, array('id_dokumen' => $id_dokumen));
		return $query;
	}

	public function add($data)
	{
		$this->db->insert($this->tbl_dokumen, $data);
		return $this->db->insert_id();
	}

	public function edit($id_dokumen, $data)
	{
		$this->db->where('id_dokumen', $id_dokumen);
		$this->db->update($this->tbl_dokumen, $data);
	}

	public function delete($id_dokumen)
	{
		$this->db->where('id_dokumen', $id_dokumen);
		$this->db->update($this->tbl_dokumen);
	}
}

/* End of file file_dokumen_m.php */
/* Location: ./application/models/file_dokumen_m.php */