<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Trash_data extends CI_Controller
{
	public function __Construct()
	{
		parent::__Construct();
		$this->tanggal = date('Y-m-d H-i-s');
		
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,mgr,ksr");
	}
	
	# Menampilkan list data trash data
	public function index()
	{
		$this->load->library('header_lib');
		$script_obj = new header_lib;

		$data['header'] = $script_obj->dashboard_header();
		
		$this->load->view('trash_data_v', $data);
	}
	
	# Menampilkan list data trash data
	public function list_data($limit)
	{
		$this->load->model('pemesanan_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_status_data('limit', $limit, 'trash_data')->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_status_data('all', 0, 'trash_data')->result());

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;
		$data['kata_kunci']			= "";
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('trash_data_list_v', $data);
	}

	# Menampilkan list data pencarian trash data
	public function list_data_cari($limit, $kata_kunci = '')
	{
		$this->load->model('pemesanan_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_status_data_cari('limit', $limit, 'trash_data', urldecode($kata_kunci))->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_status_data_cari('all', 0, 'trash_data', urldecode($kata_kunci))->result());

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;
		$data['kata_kunci']			= $kata_kunci;
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('trash_data_cari_list_v', $data);
	}
	
	# Mengubah Data trash data
	public function detail($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('user_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$this->load->library('header_lib');
		$script_obj = new header_lib;

		$data['header'] 			= $script_obj->dashboard_header();
		$data['data_unit'] 			= $this->unit_m->get_by_id($id_unit)->row();
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['anggota_keluarga']	= $this->kartu_keluarga_m->get_all_anggota_keluarga($id_kartu_keluarga)->result();
		$data['pemesanan']			= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$data['dokumen_lainnya']	= $this->customer_m->get_dokumen_by_id_customer($data['pemesanan']->id_customer)->result();
		$data['id_unit']			= $id_unit;
		$data['id_kartu_keluarga']	= $id_kartu_keluarga;
		$data['id_pemesanan']		= $id_pemesanan;
		
		$data["status"]				= $data["pemesanan"]->jenis_pemesanan;
		$data['nama_promo']			= $data["pemesanan"]->nama_promo;
		$data['deskripsi']			= $data["pemesanan"]->deskripsi;
		
		$data['user_delete']		= $this->user_m->get_by_id($data['pemesanan']->delete_by)->row();
		
		$this->load->view('trash_data_detail_v', $data);
	}

	# Me-restore data trash data
	public function restore($id_pemesanan, $id_unit)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('pemesanan_m');
		$this->load->model('unit_m');
		
		$data_unit = $this->unit_m->get_by_id($id_unit)->row();
		$pemesanan = $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		
		$data = array( 	"status_data"	=> '',
						"delete_by"		=> '',
						"delete_time"	=> '');
		
		if ($pemesanan->status_pemesanan == "Sold")
		{
			$status_pemesanan = "Sold";
		}
		else
		{
			$status_pemesanan = "Booked";
		}
		
		if((count($data_unit) > 0) AND ($data_unit->status_unit == $pemesanan->jenis_pemesanan) AND ($data_unit->status_transaksi == ""))
		{
			if ($data_unit->status_unit == "Promo")
			{
				if ($data_unit->id_promo ==  $pemesanan->id_promo)
				{
					$this->pemesanan_m->edit($id_pemesanan, $data);
					$this->unit_m->update_status_transaksi($id_unit, $status_pemesanan);
					$this->access_lib->logging("Restore data pemesanan : ".$pemesanan->nomor_pemesanan);
					echo "ok";
				}
				else
				{
					echo "Maaf, unit yang terkait dengan pemesanan ini sudah tidak available (Data Promo tidak sesuai).";
				}
			}
			else
			{
				$this->pemesanan_m->edit($id_pemesanan, $data);
				$this->unit_m->update_status_transaksi($id_unit, $status_pemesanan);
				$this->access_lib->logging("Restore data pemesanan : ".$pemesanan->nomor_pemesanan);
				echo "ok";
			}
		}
		else
		{
			echo "Maaf, unit yang terkait dengan pemesanan ini sudah tidak available.";
		}
		
	}

	# Menghapus data (permanen)
	public function delete($id_pemesanan)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('pemesanan_m');
		$nomor_pemesanan = $this->pemesanan_m->get_by_id($id_pemesanan)->row()->nomor_pemesanan;
		$this->access_lib->logging('Hapus data pemesanan dari "Trash Data" : '.$nomor_pemesanan);
		$this->pemesanan_m->delete($id_pemesanan);
	}
	
}

# End of file trash_data.php
# Location: ./applicaion/controller/trash_data.php