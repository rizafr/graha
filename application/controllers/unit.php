<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Unit extends CI_Controller
{
	
	function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,mgr,stk");
	}
	
	# Halaman default msater unit
	function index()
	{
		$this->load->library('header_lib');
		
		$script_obj 		= new header_lib;
		$data['header']		= $script_obj->dashboard_header();
		
		$this->load->view('unit_v', $data);
	}
	
	# Menampilkan list data master unit
	function list_data($posisi = 0, $show = 20, $ikey = "")
	{
		$this->load->model('unit_m');
		$this->load->model('cluster_m');
		$this->load->model('type_m');
		
		$key = base64_decode($ikey);
		$key = explode("#", $key);
		
		$data['unit'] = $this->unit_m->get_all('limit', $posisi, $show, $key)->result();
		$data['total_unit'] = count($this->unit_m->get_all('all', 0, $show, $key)->result());
		
		$data['cluster']					= $this->cluster_m->get_all("all")->result();
		$data['type']						= $this->type_m->get_by_cluster($key[1])->result();
		$data['list_kategori']				= array("RESIDENSIAL", "RUKO", "KAVELING");
		$data['list_posisi']				= array("STANDAR", "SUDUT", "KHUSUS");
		$data['list_status_unit']			= array("Master", "Marketable", "Promo");
		$data['list_status_transaksi']		= array("Booked", "Sold");
	
		$data['filter_kategori']			= $key[0];
		$data['filter_cluster']				= $key[1];
		$data['filter_type']				= $key[2];
		$data['filter_kode_cluster']		= $key[3];
		$data['filter_blok']				= $key[4];
		$data['filter_nomor']				= $key[5];
		$data['filter_status_unit']			= $key[6];
		$data['filter_status_transaksi']	= $key[7];
		
		$data['order_by']					= $key[8];
		$data['sort_by']					= $key[9];
		
		$data['prev'] = $posisi - $show;
		$data['next'] = $posisi + $show;
		$data['posisi'] = $posisi;
		$data['show'] = $show;
		$data['key'] = $ikey;
		
		if(($data['total_unit'] % $show) > 0)
		{
			$data['akhir']	= floor($data['total_unit']/$show)*$show;
		}
		else
		{
			$data['akhir']	= (floor($data['total_unit']/$show)*$show) - $show;
		}
		
		$this->load->view('unit_list_v', $data);
	}
	
	# Menambah form data user
	function add($posisi = 0, $show = 20, $ikey = "")
	{
		$this->access_lib->_is("adm,stk");
		
		$data['msg'] = NULL;
		$data['posisi'] = $posisi;
		$data['show'] = $show;
		$data['key'] = $ikey;
		$this->load->model('unit_m');
		$this->load->model('cluster_m');

			$data['action']							= base_url()."unit/add";
			$data['cluster']						= $this->cluster_m->get_all("all")->result();
			$data['list_kategori']					= array("RESIDENSIAL", "RUKO", "KAVELING");
			$data['list_posisi']					= array("STANDAR", "SUDUT", "KHUSUS");
			$data['list_status_unit']				= array("Master", "Marketable", "Promo");
			$data['list_status_transaksi']			= array("Booked", "Sold");
			
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$this->form_validation->set_rules('id_cluster', 'Cluster', 'required|xss_clean');
			$this->form_validation->set_rules('id_type', 'id_type', 'xss_clean');
			$this->form_validation->set_rules('kode_cluster', 'Kode Cluster', 'required|xss_clean');
			$this->form_validation->set_rules('kode_blok', 'Blok', 'required|xss_clean');
			$this->form_validation->set_rules('nomor', 'Nomor', 'required|xss_clean');
			$this->form_validation->set_rules('kategori', 'Kategori', 'required|xss_clean');
			$this->form_validation->set_rules('luas_tanah', 'Luas Tanah', 'required|xss_clean');
			$this->form_validation->set_rules('luas_bangunan', 'Luas Bangunan', 'required|xss_clean');
			$this->form_validation->set_rules('harga_tanah_m2', 'Harga Tanah/m2', 'required|xss_clean');
			$this->form_validation->set_rules('harga_bangunan_m2', 'Harga Bangunan/m2', 'required|xss_clean');
			$this->form_validation->set_rules('diskon_tanah', 'Diskon Tanah', 'required|xss_clean');
			$this->form_validation->set_rules('diskon_bangunan', 'Diskon Bangunan', 'required|xss_clean');
			$this->form_validation->set_rules('harga_tanah', 'Harga Tanah', 'required|xss_clean');
			$this->form_validation->set_rules('harga_bangunan', 'Harga Bangunan', 'required|xss_clean');
			$this->form_validation->set_rules('ppn_tanah', 'PPN Bangunan', 'xss_clean');
			$this->form_validation->set_rules('ppn_bangunan', 'PPN Bangunan', 'xss_clean');
			$this->form_validation->set_rules('total_ppn', 'Total PPN', 'xss_clean');
			$this->form_validation->set_rules('harga_jual_exc_ppn', 'Harga Jual Exc. PPN', 'required|xss_clean');
			$this->form_validation->set_rules('harga_jual_inc_ppn', 'Harga Jual Inc. PPN', 'required|xss_clean');
			$this->form_validation->set_rules('fs', 'Faktor Strategis', 'required|xss_clean');
			$this->form_validation->set_rules('keterangan_fs', 'Ket. Faktor Strategis', 'xss_clean');
			$this->form_validation->set_rules('tanda_jadi', 'Tanda Jadi', 'required|xss_clean');
			$this->form_validation->set_rules('persen_tanda_jadi', 'Prosentase Tanda Jadi', 'required|xss_clean');
			$this->form_validation->set_rules('uang_muka', 'Uang Muka', 'required|xss_clean');
			$this->form_validation->set_rules('persen_uang_muka', 'Prosentase Uang Muka', 'required|xss_clean');
			$this->form_validation->set_rules('plafon_kpr', 'Plafon KPR', 'required|xss_clean');
			$this->form_validation->set_rules('kpr_5_tahun', 'Angsuran 5 Tahun', 'required|xss_clean');
			$this->form_validation->set_rules('kpr_10_tahun', 'Angsuran 10 Tahun', 'required|xss_clean');
			$this->form_validation->set_rules('kpr_15_tahun', 'Angsuran 15 Tahun', 'required|xss_clean');
			$this->form_validation->set_rules('suku_bunga', 'Asumsi Suku Bunga', 'required|xss_clean');
			$this->form_validation->set_rules('status_unit', 'Status Unit', 'required|xss_clean');

			$kode_unit = strtoupper(
					$this->input->post('kode_cluster', TRUE)."/".
					$this->input->post('kode_blok', TRUE)."-".
					$this->input->post('nomor', TRUE));
					
			if($this->cek_kode_unit($kode_unit))
			{
				$data['msg'] = '<li>Kode unit telah terdaftar.</li>';
			}
			
			if ($this->form_validation->run() !== FALSE AND $data['msg'] == NULL)
			{
				
				$data_unit = array(
					'id_cluster'			=> $this->input->post('id_cluster', TRUE),
					'id_type'				=> $this->input->post('id_type', TRUE),
					'posisi'				=> $this->input->post('posisi', TRUE),
					'kode_unit'				=> $kode_unit,
					'kategori'				=> $this->input->post('kategori', TRUE),
					'luas_tanah'			=> str_replace( ',', '', $this->input->post('luas_tanah', TRUE)),
					'luas_bangunan'			=> str_replace( ',', '', $this->input->post('luas_bangunan', TRUE)),
					'harga_tanah_m2'		=> str_replace( ',', '', $this->input->post('harga_tanah_m2', TRUE)),
					'harga_bangunan_m2'		=> str_replace( ',', '', $this->input->post('harga_bangunan_m2', TRUE)),
					'diskon_tanah'			=> $this->input->post('diskon_tanah', TRUE),
					'diskon_bangunan'		=> $this->input->post('diskon_bangunan', TRUE),
					'harga_tanah'			=> str_replace( ',', '', $this->input->post('harga_tanah', TRUE)),
					'harga_bangunan'		=> str_replace( ',', '', $this->input->post('harga_bangunan', TRUE)),
					'harga_jual_exc_ppn'	=> str_replace( ',', '', $this->input->post('harga_jual_exc_ppn', TRUE)),
					'harga_jual_inc_ppn'	=> str_replace( ',', '', $this->input->post('harga_jual_inc_ppn', TRUE)),
					'fs'					=> $this->input->post('fs', TRUE),
					'keterangan_fs'			=> $this->input->post('keterangan_fs', TRUE),
					'tanda_jadi'			=> str_replace( ',', '', $this->input->post('tanda_jadi', TRUE)),
					'persen_tanda_jadi'		=> $this->input->post('persen_tanda_jadi', TRUE),
					'uang_muka'				=> str_replace( ',', '', $this->input->post('uang_muka', TRUE)),
					'persen_uang_muka'		=> $this->input->post('persen_uang_muka', TRUE),
					'plafon_kpr'			=> str_replace( ',', '', $this->input->post('plafon_kpr', TRUE)),
					'kpr_5_tahun'			=> str_replace( ',', '', $this->input->post('kpr_5_tahun', TRUE)),
					'kpr_10_tahun'			=> str_replace( ',', '', $this->input->post('kpr_10_tahun', TRUE)),
					'kpr_15_tahun'			=> str_replace( ',', '', $this->input->post('kpr_15_tahun', TRUE)),
					'suku_bunga'			=> $this->input->post('suku_bunga', TRUE),
					'status_unit'			=> $this->input->post('status_unit', TRUE),
					'status_transaksi'		=> '',
					'tanggal_posting'		=> date('Y-m-d H:i:s'),
					'kelas_produk'			=> $this->input->post('kelas_produk', TRUE));
					
				$id_unit = $this->unit_m->add($data_unit);		
				
				if($id_unit)
				{
					$this->access_lib->logging('Tambah data unit : '.$kode_unit);
					echo 'ok';
					exit;
				}
				else
				{
					echo 'no';
					exit;
				}
			}
		}
		
		$this->load->view('unit_add_v', $data);
	}
	
	# Menambah form data user
	function edit($id_unit, $posisi = 0, $show = 20, $ikey = "")
	{
		$this->access_lib->_is("adm,stk");
		
		$data['msg'] = NULL;
		$data['posisi'] = $posisi;
		$data['show'] = $show;
		$data['key'] = $ikey;
		$this->load->model('unit_m');
		$this->load->model('cluster_m');
		$this->load->model('type_m');

			$data['action']		= base_url()."unit/edit/".$id_unit;
			$data['data_unit']	= $this->unit_m->get_by_id($id_unit)->row();
			
			if($data['data_unit']->status_transaksi != "")
			{
				echo "yes you can't";
				exit;
			}
			
			$data['cluster']						= $this->cluster_m->get_all("all")->result();
			$data['type']							= $this->type_m->get_by_cluster($data['data_unit']->id_cluster)->result();
			$data['list_kategori']					= array("RESIDENSIAL", "RUKO", "KAVELING");
			$data['list_posisi']					= array("STANDAR", "SUDUT", "KHUSUS");
			$data['list_status_unit']				= array("Master", "Marketable", "Promo");
			$data['list_status_transaksi']			= array("Booked", "Sold");
				
		if($_SERVER['REQUEST_METHOD'] === 'POST')
		{
			$this->form_validation->set_rules('id_cluster', 'Cluster', 'required|xss_clean');
			$this->form_validation->set_rules('id_type', 'id_type', 'xss_clean');
			$this->form_validation->set_rules('kode_cluster', 'Kode Cluster', 'required|xss_clean');
			$this->form_validation->set_rules('kode_blok', 'Blok', 'required|xss_clean');
			$this->form_validation->set_rules('nomor', 'Nomor', 'required|xss_clean');
			$this->form_validation->set_rules('kategori', 'Kategori', 'required|xss_clean');
			$this->form_validation->set_rules('luas_tanah', 'Luas Tanah', 'required|xss_clean');
			$this->form_validation->set_rules('luas_bangunan', 'Luas Bangunan', 'required|xss_clean');
			$this->form_validation->set_rules('harga_tanah_m2', 'Harga Tanah/m2', 'required|xss_clean');
			$this->form_validation->set_rules('harga_bangunan_m2', 'Harga Bangunan/m2', 'required|xss_clean');
			$this->form_validation->set_rules('diskon_tanah', 'Diskon Tanah', 'required|xss_clean');
			$this->form_validation->set_rules('diskon_bangunan', 'Diskon Bangunan', 'required|xss_clean');
			$this->form_validation->set_rules('harga_tanah', 'Harga Tanah', 'required|xss_clean');
			$this->form_validation->set_rules('harga_bangunan', 'Harga Bangunan', 'required|xss_clean');
			$this->form_validation->set_rules('harga_jual_exc_ppn', 'Harga Jual Exc. PPN', 'required|xss_clean');
			$this->form_validation->set_rules('harga_jual_inc_ppn', 'Harga Jual Inc. PPN', 'required|xss_clean');
			$this->form_validation->set_rules('fs', 'Faktor Strategis', 'required|xss_clean');
			$this->form_validation->set_rules('keterangan_fs', 'Ket. Faktor Strategis', 'xss_clean');
			$this->form_validation->set_rules('tanda_jadi', 'Tanda Jadi', 'required|xss_clean');
			$this->form_validation->set_rules('persen_tanda_jadi', 'Prosentase Tanda Jadi', 'required|xss_clean');
			$this->form_validation->set_rules('uang_muka', 'Uang Muka', 'required|xss_clean');
			$this->form_validation->set_rules('persen_uang_muka', 'Prosentase Uang Muka', 'required|xss_clean');
			$this->form_validation->set_rules('plafon_kpr', 'Plafon KPR', 'required|xss_clean');
			$this->form_validation->set_rules('kpr_5_tahun', 'Angsuran 5 Tahun', 'required|xss_clean');
			$this->form_validation->set_rules('kpr_10_tahun', 'Angsuran 10 Tahun', 'required|xss_clean');
			$this->form_validation->set_rules('kpr_15_tahun', 'Angsuran 15 Tahun', 'required|xss_clean');
			$this->form_validation->set_rules('suku_bunga', 'Asumsi Suku Bunga', 'required|xss_clean');
			$this->form_validation->set_rules('status_unit', 'Status Unit', 'required|xss_clean');

			$kode_unit = strtoupper(
					$this->input->post('kode_cluster', TRUE)."/".
					$this->input->post('kode_blok', TRUE)."-".
					$this->input->post('nomor', TRUE));
			
			if($kode_unit != $data['data_unit']->kode_unit)
			{
				if($this->cek_kode_unit($kode_unit))
				{
					$data['msg'] = '<li>Kode unit telah terdaftar.</li>';
				}
			}
			
			if ($this->form_validation->run() !== FALSE AND $data['msg'] == NULL)
			{
				$data_unit = array(
					'id_cluster'			=> $this->input->post('id_cluster', TRUE),
					'id_type'				=> $this->input->post('id_type', TRUE),
					'posisi'				=> $this->input->post('posisi', TRUE),
					'kode_unit'				=> $kode_unit,
					'kategori'				=> $this->input->post('kategori', TRUE),
					'luas_tanah'			=> str_replace( ',', '', $this->input->post('luas_tanah', TRUE)),
					'luas_bangunan'			=> str_replace( ',', '', $this->input->post('luas_bangunan', TRUE)),
					'harga_tanah_m2'		=> str_replace( ',', '', $this->input->post('harga_tanah_m2', TRUE)),
					'harga_bangunan_m2'		=> str_replace( ',', '', $this->input->post('harga_bangunan_m2', TRUE)),
					'diskon_tanah'			=> $this->input->post('diskon_tanah', TRUE),
					'diskon_bangunan'		=> $this->input->post('diskon_bangunan', TRUE),
					'harga_tanah'			=> str_replace( ',', '', $this->input->post('harga_tanah', TRUE)),
					'harga_bangunan'		=> str_replace( ',', '', $this->input->post('harga_bangunan', TRUE)),
					'harga_jual_exc_ppn'	=> str_replace( ',', '', $this->input->post('harga_jual_exc_ppn', TRUE)),
					'harga_jual_inc_ppn'	=> str_replace( ',', '', $this->input->post('harga_jual_inc_ppn', TRUE)),
					'fs'					=> $this->input->post('fs', TRUE),
					'keterangan_fs'			=> $this->input->post('keterangan_fs', TRUE),
					'tanda_jadi'			=> str_replace( ',', '', $this->input->post('tanda_jadi', TRUE)),
					'persen_tanda_jadi'		=> $this->input->post('persen_tanda_jadi', TRUE),
					'uang_muka'				=> str_replace( ',', '', $this->input->post('uang_muka', TRUE)),
					'persen_uang_muka'		=> $this->input->post('persen_uang_muka', TRUE),
					'plafon_kpr'			=> str_replace( ',', '', $this->input->post('plafon_kpr', TRUE)),
					'kpr_5_tahun'			=> str_replace( ',', '', $this->input->post('kpr_5_tahun', TRUE)),
					'kpr_10_tahun'			=> str_replace( ',', '', $this->input->post('kpr_10_tahun', TRUE)),
					'kpr_15_tahun'			=> str_replace( ',', '', $this->input->post('kpr_15_tahun', TRUE)),
					'suku_bunga'			=> $this->input->post('suku_bunga', TRUE),
					'status_unit'			=> $this->input->post('status_unit', TRUE),
					'kelas_produk'			=> $this->input->post('kelas_produk', TRUE));
					
				$result = $this->unit_m->edit($id_unit, $data_unit);		
				
				if ($data['data_unit']->status_unit == "Promo" AND $this->input->post('status_unit') != "Promo")
				{
					$this->load->model('promo_m');
					$this->promo_m->delete_unit_promo_by_id_unit($id_unit);
				}
				
				$this->access_lib->logging('Ubah data unit : '.$kode_unit);
				echo 'ok';
				exit;
				
			}
		}
		
		$this->load->view('unit_edit_v', $data);
	}
	
	# Cek Unique Kode_Unit
	function cek_kode_unit($kode_unit)
	{
		$result = $this->unit_m->cek_kode_unit($kode_unit);
		if(count($result) > 0)
		{
			return TRUE;
		}
		return FALSE;
	}
	
	# Mengubah status unit
	# Master, Marketable, Promo
	function update_status_unit($id_unit, $status_unit)
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('unit_m');
		$data_unit = $this->unit_m->get_by_id($id_unit)->row();

		if($data_unit->status_transaksi == "")
		{
			if($status_unit != "Promo")
			{
				$data_unit_update = array(	'status_unit'		=> $status_unit,
											'diskon_tanah'		=> '',
											'diskon_bangunan'	=> ''
				);
				$this->unit_m->edit($id_unit, $data_unit_update);
				$this->access_lib->logging('Ubah status unit : '.$data_unit->kode_unit.' ('.$status_unit.')');
				echo "ok-mm";
			}
			else
			{
				$this->load->model('promo_m');
				$actived = $this->promo_m->get_active_promo()->row();
				if (count($actived) > 0)
				{
					$id_promo = $actived->id_promo;
					$data_unit_update = array(	'status_unit'	=> $status_unit,
												'id_promo'		=> $id_promo
					);
					$this->unit_m->edit($id_unit, $data_unit_update);
					
					$this->access_lib->logging('Ubah status unit : '.$data_unit->kode_unit.' ('.$status_unit.')');
					echo "ok-p";
				}
				else
				{
					echo 'Data promo dengan status "Aktif" tidak ditemukan. Silahkan pilih menu "Master -> Promo" untuk mengaktifkan data promo.';
				}
			}
		}
		else
		{
			echo 'Maaf, status unit "'.$data_unit->kode_unit.'" tidak bisa diubah, karena masih dalam progress transaksi.';
		}
	}
	
	# Menghapus data unit
	function delete($id_unit, $posisi = 0, $show = 20)
	{
		$this->access_lib->_is("adm,stk");
		
		$this->load->model('unit_m');
		
		$data_unit = $this->unit_m->get_by_id($id_unit)->row();
		if($data_unit->status_transaksi != "")
		{
			echo 'Maaf, status unit "'.$data_unit->kode_unit.'" tidak bisa diubah, karena masih dalam progress transaksi.';
		}
		else
		{
			$this->access_lib->logging('Hapus data unit : '.$data_unit->kode_unit);
			$this->unit_m->delete($id_unit);
			echo "ok";
		}
		
	}
	
	# Menampilkan data detail unit
	function detail($id_unit, $posisi = 0, $show = 20, $ikey = "")
	{
		$this->load->model('unit_m');
		$data['data_unit'] = $this->unit_m->get_by_id($id_unit)->row();
		$data['posisi'] = $posisi;
		$data['show'] = $show;
		$data['key'] = $ikey;
		
		$this->load->view('unit_detail_v', $data);
	}
	
}

# End of file master_stock.php
# Location: ./applicaion/controller/master_stock.php