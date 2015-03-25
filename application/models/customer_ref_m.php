<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Customer_ref_m extends CI_Model 
{	
	
	private $tbl_customer_ref = "tbl_customer_ref";

	function __Construct()
	{
		parent::__Construct();
	}

	# Mendapatkan data customer berdasarkan id
	function get_by_no_ktp($no_ktp)
	{
		$query = $this->db->query("SELECT * FROM tbl_customer_ref WHERE no_ktp = '".mysql_real_escape_string($no_ktp)."'");
		return $query;
	}
	
	# Mendapatkan data customer berdasarkan id
	function save()
	{
		$no_ktp = $this->input->post('no_ktp');
		$data 	= array(	"nama_lengkap"			=> $this->input->post('nama_lengkap'),
							"no_npwp"				=> $this->input->post('no_npwp'),
							"alamat_npwp"			=> $this->input->post('alamat_npwp'),
							"telpon"				=> $this->input->post('telpon'),
							"hp"					=> $this->input->post('hp'),
							"email"					=> $this->input->post('email'),
							"alamat_ktp"			=> $this->input->post('alamat_ktp'),
							"alamat_surat_menyurat"	=> $this->input->post('alamat_surat_menyurat'),
							"no_kartu_keluarga"		=> $this->input->post('no_kartu_keluarga')
							);
							
		$this->delete($no_ktp);
		$data["no_ktp"] = $no_ktp;
		$this->add($data);
		
	}
	
	# Menyimpan data customer
	function add($data)
	{
		$this->db->insert($this->tbl_customer_ref, $data);
	}

	# Mengubah data customer
	function edit($no_ktp ,$data)
	{
		$this->db->where('no_ktp', $no_ktp);
		$this->db->update($this->tbl_customer_ref, $data);
		return $this->db->affected_rows();
	}

	# Menghapus data customer
	function delete($no_ktp)
	{
		$this->db->where('no_ktp', $no_ktp);
		$this->db->delete($this->tbl_customer_ref);
	}
}

/* End of file customer_m.php */
/* Location: ./application/models/customer_m.php */