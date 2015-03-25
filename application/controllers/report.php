<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Report extends CI_Controller
{
	var $tanggal;
	var $dokumen_path;
	
	public function __Construct()
	{
		parent::__Construct();
		$this->access_lib->is_login();
		$this->access_lib->_is("adm,mgr,ksr,sal");
		
		$this->load->library('header_lib');
		$script_obj 		= new header_lib;
		$this->header 		= $script_obj->dashboard_header();

		$this->tanggal		= date("Y-m-d H:i:s");
		$this->dokumen_path = realpath(APPPATH.'../files/dokumen_user');
	}

	#	------------------------------
	#	B O O K I N G    R E G U L A R
	#	------------------------------

	public function regular()
	{
		$data['header'] = $this->header;
		$this->load->view('report_regular_v', $data);
	}

	public function regular_list($limit)
	{
		$this->load->model('pemesanan_m');
		$this->load->model('cluster_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_jenis('limit', 'Marketable', $limit, '', '', '', '', '')->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_jenis('all', 'Marketable', 0, '', '', '', '', '')->result());
		$data['cluster']			= $this->cluster_m->get_all("all", 0)->result();

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;
		
		$data['filter']				= "";
		$data['kata_kunci']			= "";
		$data['id_cluster']			= "";
		$data['kategori']			= "";
		$data['status_cari']		= "";
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('report_regular_data_v', $data);
	}

	public function regular_cari_list($limit, $filter, $id_cluster, $kategori, $kata_kunci)
	{
		$this->load->model('pemesanan_m');
		$this->load->model('cluster_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_jenis('limit', 'Marketable', $limit, '', $filter, $id_cluster, urldecode($kategori), urldecode($kata_kunci))->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_jenis('all', 'Marketable', 0, '', $filter, $id_cluster, urldecode($kategori), urldecode($kata_kunci))->result());
		$data['cluster']			= $this->cluster_m->get_all("all", 0)->result();

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;

		$data['filter']				= $filter;
		$data['kata_kunci']			= urldecode($kata_kunci);
		$data['id_cluster']			= $id_cluster;
		$data['kategori']			= urldecode($kategori);
		$data['status_cari']		= "cari";
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('report_regular_data_v', $data);
	}	

	public function regular_form($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');
		$this->load->model('cara_pembayaran_m');

		$data['pemesanan'] = $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		
		# Untuk sales, jika status = booked dan belum di-verify
		if ($this->access_lib->_if("sal"))
		{
			if ($data['pemesanan']->status_pemesanan != "Booked" OR $data['pemesanan']->status_verify != "")
			{
				redirect('report/regular');
			}
		}
		
		$data['header']					= $this->header;
		$data['data_unit'] 				= $this->unit_m->get_by_id($id_unit)->row();
		$data['kartu_keluarga']			= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['pemesanan']				= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$data['customer']				= $this->customer_m->get_by_id($data['pemesanan']->id_customer)->row();
		$data['data_cara_pembayaran']	= $this->cara_pembayaran_m->get_all()->result();

		$data['id_unit']				= $id_unit;
		$data['id_kartu_keluarga']		= $id_kartu_keluarga;
		$data['id_pemesanan']			= $id_pemesanan;

		$this->load->view('report_regular_form_v', $data);	
	}

	public function regular_edit()
	{
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('customer_ref_m');
		$this->load->model('unit_m');
		$this->load->model('kartu_keluarga_m');
		
		$now_pemesanan = $this->pemesanan_m->get_by_id($this->input->post('id_pemesanan'))->row();
		if ($now_pemesanan->status_data != "")
		{
			redirect('report/regular');
		}
		
		# Untuk sales, jika status = booked dan belum di-verify
		if ($this->access_lib->_if("sal"))
		{
			if ($now_pemesanan->status_pemesanan != "Booked" OR $now_pemesanan->status_verify != "")
			{
				redirect('report/regular');
			}
			
			$status_pemesanan	= $now_pemesanan->status_pemesanan;
			$timeout			= $now_pemesanan->timeout;
		}
		else
		{
			$status_pemesanan	= $this->input->post('status_pemesanan');
			$timeout			= (($this->input->post('hari')*86400)+($this->input->post('jam')*3600)+($this->input->post('menit')*60));
		}
		
		$tanggal_tanda_jadi = $now_pemesanan->tanggal_tanda_jadi;
		$tanggal_sold = $now_pemesanan->tanggal_sold;
		$status_verify = $now_pemesanan->status_verify;
		
		if ($now_pemesanan->status_pemesanan != $status_pemesanan)
		{
			if ($status_pemesanan == "Booked")
			{
				$status_verify = '';
				$tanggal_tanda_jadi = '';
				$tanggal_sold = '';
			}
			if ($status_pemesanan == "Tanda Jadi")
			{
				$status_verify = '';
				$tanggal_tanda_jadi = $this->tanggal;
				$tanggal_sold = '';
			}
			elseif ($status_pemesanan == "Sold")
			{
				$tanggal_sold = $this->tanggal;
			}
		}
		
		$temp_cara_pembayaran = explode(" ", $this->input->post('cara_pembayaran'));
		$tipe_pembayaran = $temp_cara_pembayaran[0];
		$tahap_pembayaran = $temp_cara_pembayaran[1];
		
		# Mengupdata data pemesanan
		$data_pemesanan = array(	"tanggal_tanda_jadi"	=> $tanggal_tanda_jadi,
									"tanggal_sold"			=> $tanggal_sold,
									"status_pemesanan"		=> $status_pemesanan,
									"status_verify"			=> $status_verify,
									"tipe_pembayaran"		=> $tipe_pembayaran,
									"tahap_pembayaran"		=> $tahap_pembayaran,
									"booking_fee"			=> $this->input->post('booking_fee'),
									"timeout"				=> $timeout
									);
		$this->pemesanan_m->edit($this->input->post('id_pemesanan'), $data_pemesanan);

		$data_unit = $this->unit_m->get_by_id($this->input->post('id_unit'))->row();
		
		# Mengupdata data customer
		$data_customer 	= array(	"nama_lengkap"			=> $this->input->post('nama_lengkap'),
									"no_ktp"				=> $this->input->post('no_ktp'),
									"no_npwp"				=> $this->input->post('no_npwp'),
									"alamat_npwp"			=> $this->input->post('alamat_npwp'),
									"telpon"				=> $this->input->post('telpon'),
									"hp"					=> $this->input->post('hp'),
									"email"					=> $this->input->post('email'),
									"alamat_ktp"			=> $this->input->post('alamat_ktp'),
									"alamat_surat_menyurat"	=> $this->input->post('alamat_surat_menyurat')									
									);
		$this->customer_m->edit($this->input->post('id_customer'), $data_customer);
		
		# Update / Insert Referensi Customer
		$this->customer_ref_m->save();
		
		# Update No Kartu Keluarga
		$this->kartu_keluarga_m->edit_kartu_keluarga(
			$this->input->post('id_kartu_keluarga'), 
			array("no_kartu_keluarga" => $this->input->post('no_kartu_keluarga'))
		);

		$doc_ktp 			= $this->upload_dokumen("doc_ktp");
		$doc_npwp			= $this->upload_dokumen("doc_npwp");
		$doc_kartu_keluarga	= $this->upload_dokumen("doc_kartu_keluarga");
		$doc_akta_nikah		= $this->upload_dokumen("doc_akta_nikah");
		$doc_siup			= $this->upload_dokumen("doc_siup");

		# Upload File
		$data_upload = array();
		if($doc_ktp != "")
		{
			$data_upload["doc_ktp"] = $doc_ktp;
		}
		if($doc_npwp != "")
		{
			$data_upload["doc_npwp"] = $doc_npwp;
		}
		if($doc_kartu_keluarga != "")
		{
			$data_upload["doc_kartu_keluarga"] = $doc_kartu_keluarga;
		}
		if($doc_akta_nikah != "")
		{
			$data_upload["doc_akta_nikah"] = $doc_akta_nikah;
		}
		if($doc_siup != "")
		{
			$data_upload["doc_siup"] = $doc_siup;
		}
		if(!empty($data_upload))
		{
			$this->customer_m->edit($this->input->post('id_customer'), $data_upload);
		}
		
		# Mengupload file dokumen
		$i = 0;
		foreach ($_FILES['doc']['name'] as $filename)
		{
			if (!empty($_FILES['doc']['name'][$i]))
            {
            	$file = $this->upload_dokumen_lainnya($i);

            	$data = array(	"id_customer"		=> $this->input->post('id_customer'),
            					"file_dokumen"		=> $file);
            	$this->customer_m->add_dokumen($data); 
            	$i++;
            }  
		}
		
		# Mengupdate status unit
		if ($status_pemesanan == "Sold")
		{
			$status_pemesanan_for_unit = "Sold";
		}
		else
		{
			$status_pemesanan_for_unit = "Booked";
		}
		$this->unit_m->update_status_transaksi($this->input->post('id_unit'), $status_pemesanan_for_unit);
		
		$this->access_lib->logging("Ubah data pemesanan regular : ".$now_pemesanan->nomor_pemesanan." (".$this->input->post('status_pemesanan').")");

		redirect('report/regular_anggota_keluarga/'.$this->input->post('id_unit').'/'.$this->input->post('id_kartu_keluarga').'/'.$this->input->post('id_pemesanan'));
	}

	public function regular_anggota_keluarga($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');		
		$this->load->model('kartu_keluarga_m');
		
		$data['header']				= $this->header;
		$data['data_unit'] 			= $this->unit_m->get_by_id($id_unit)->row();
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['anggota_keluarga']	= $this->kartu_keluarga_m->get_all_anggota_keluarga($id_kartu_keluarga)->result();
		$data['id_unit']			= $id_unit;
		$data['id_pemesanan']		= $id_pemesanan;
		$data['id_kartu_keluarga']	= $id_kartu_keluarga;

		$this->load->view('report_regular_kartu_keluarga_v', $data);
	}

	public function regular_anggota_keluarga_add()
	{
		$this->load->model('kartu_keluarga_m');

		$data = array(	"id_kartu_keluarga" 	=> $this->input->post('id_kartu_keluarga'),
						"nama_lengkap"			=> $this->input->post('nama_anggota_keluarga'),
						"no_ktp"				=> $this->input->post('no_ktp'),
						"tanggal_lahir"			=> $this->input->post('tanggal_lahir'),
						"bulan_lahir"			=> $this->input->post('bulan_lahir'),
						"tahun_lahir"			=> $this->input->post('tahun_lahir'),
						"npwp"					=> $this->input->post('npwp'),
						"hubungan_keluarga"		=> $this->input->post('hubungan_keluarga'),
						"status_nikah"			=> $this->input->post('status_kawin'));

		$id_anggota_keluarga = $this->kartu_keluarga_m->add_anggota_keluarga($data);
		
		redirect('report/regular_anggota_keluarga/'.$this->input->post('id_unit').'/'.$this->input->post('id_kartu_keluarga').'/'.$this->input->post('id_pemesanan'));
	}

	public function regular_anggota_keluarga_delete($id_anggota_keluarga)
	{
		$this->load->model('kartu_keluarga_m');
		$this->kartu_keluarga_m->delete_anggota_keluarga($id_anggota_keluarga);
	}

	public function regular_preview($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
		$data['data_unit'] 			= $this->unit_m->get_by_id($id_unit)->row();
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['anggota_keluarga']	= $this->kartu_keluarga_m->get_all_anggota_keluarga($id_kartu_keluarga)->result();
		$data['pemesanan']			= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$data['dokumen_lainnya']	= $this->customer_m->get_dokumen_by_id_customer($data['pemesanan']->id_customer)->result();
		$data['id_unit']			= $id_unit;
		$data['id_kartu_keluarga']	= $id_kartu_keluarga;
		$data['id_pemesanan']		= $id_pemesanan;		

		$this->load->view('report_regular_preview_v', $data);
	}	
	
	public function regular_detail($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
		$data['data_unit'] 			= $this->unit_m->get_by_id($id_unit)->row();
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['anggota_keluarga']	= $this->kartu_keluarga_m->get_all_anggota_keluarga($id_kartu_keluarga)->result();
		$data['pemesanan']			= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$data['dokumen_lainnya']	= $this->customer_m->get_dokumen_by_id_customer($data['pemesanan']->id_customer)->result();
		$data['id_unit']			= $id_unit;
		$data['id_kartu_keluarga']	= $id_kartu_keluarga;
		$data['id_pemesanan']		= $id_pemesanan;		

		$this->load->view('report_regular_detail_v', $data);
	}
	
	public function regular_delete($id_pemesanan, $id_unit)
	{
		$this->access_lib->_is("adm,mgr,ksr");
		
		$this->load->model('pemesanan_m');
		$this->load->model('unit_m');
		
		$data_pemesanan = $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		
		$data = array( 	"status_data" 	=> 'trash_data',
						"delete_by"		=> $this->session->userdata('id_user'),
						"delete_time"	=> date('Y-m-d H:i:s'));
		$this->pemesanan_m->edit($id_pemesanan, $data);

		$this->unit_m->update_status_transaksi($id_unit, "");
		
		$this->access_lib->logging("Hapus data pemesanan regular : ".$data_pemesanan->nomor_pemesanan);
	}

	#	--------------------------
	#	B O O K I N G    P R O M O
	#	--------------------------

	public function promo()
	{
		$data['header']		= $this->header;
		$this->load->view('report_promo_v', $data);
	}

	public function promo_list($limit)
	{
		$this->load->model('pemesanan_m');
		$this->load->model('cluster_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_jenis('limit', 'Promo', $limit, '', '', '', '', '')->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_jenis('all', 'Promo', 0, '', '', '', '', '')->result());
		$data['cluster']			= $this->cluster_m->get_all("all", 0)->result();

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;

		$data['filter']				= "";
		$data['kata_kunci']			= "";
		$data['id_cluster']			= "";
		$data['kategori']			= "";
		$data['status_cari']		= "";
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('report_promo_data_v', $data);
	}

	public function promo_cari_list($limit, $filter, $id_cluster, $kategori, $kata_kunci)
	{
		$this->load->model('pemesanan_m');
		$this->load->model('cluster_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_jenis('limit', 'Promo', $limit, '', $filter, $id_cluster, urldecode($kategori), urldecode($kata_kunci))->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_jenis('all', 'Promo', 0, '', $filter, $id_cluster, urldecode($kategori), urldecode($kata_kunci))->result());
		$data['cluster']			= $this->cluster_m->get_all("all", 0)->result();

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;

		$data['filter']				= $filter;
		$data['kata_kunci']			= urldecode($kata_kunci);
		$data['id_cluster']			= $id_cluster;
		$data['kategori']			= urldecode($kategori);
		$data['status_cari']		= "cari";
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('report_promo_data_v', $data);
	}	

	public function promo_form($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');
		$this->load->model('cara_pembayaran_m');
		$this->load->model('promo_m');
		
		$data['pemesanan'] = $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		
		# Untuk sales, jika status = booked dan belum di-verify
		if ($this->access_lib->_if("sal"))
		{
			if ($data['pemesanan']->status_pemesanan != "Booked" OR $data['pemesanan']->status_verify != "")
			{
				redirect('report/promo');
			}
		}

		$data['header']					= $this->header;
		$data['data_unit'] 				= $this->unit_m->get_by_id($id_unit)->row();
		$data['kartu_keluarga']			= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['customer']				= $this->customer_m->get_by_id($data['pemesanan']->id_customer)->row();
		
		$data['diskon_cara_pembayaran'] = $this->promo_m->get_max_diskon($id_unit)->result();
		$data['data_cara_pembayaran']   = $data['diskon_cara_pembayaran'];

		$data['id_unit']				= $id_unit;
		$data['id_kartu_keluarga']		= $id_kartu_keluarga;
		$data['id_pemesanan']			= $id_pemesanan;
		
		$data["status"]					= $data["pemesanan"]->jenis_pemesanan;
		$data['nama_promo']				= $data["pemesanan"]->nama_promo;
		$data['deskripsi']				= $data["pemesanan"]->deskripsi;

		$this->load->view('report_promo_form_v', $data);	
	}

	public function promo_edit()
	{
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('customer_ref_m');
		$this->load->model('unit_m');
		$this->load->model('kartu_keluarga_m');

		$now_pemesanan = $this->pemesanan_m->get_by_id($this->input->post('id_pemesanan'))->row();
		if ($now_pemesanan->status_data != "")
		{
			redirect('report/promo');
		}
		
		# Untuk sales, jika status = booked dan belum di-verify
		if ($this->access_lib->_if("sal"))
		{
			if ($now_pemesanan->status_pemesanan != "Booked" OR $now_pemesanan->status_verify != "")
			{
				redirect('report/regular');
			}
			
			$status_pemesanan	= $now_pemesanan->status_pemesanan;
			$timeout			= $now_pemesanan->timeout;
		}
		else
		{
			$status_pemesanan	= $this->input->post('status_pemesanan');
			$timeout			= (($this->input->post('hari')*86400)+($this->input->post('jam')*3600)+($this->input->post('menit')*60));
		}
		
		$tanggal_tanda_jadi = $now_pemesanan->tanggal_tanda_jadi;
		$tanggal_sold = $now_pemesanan->tanggal_sold;
		$status_verify = $now_pemesanan->status_verify;
		
		if ($now_pemesanan->status_pemesanan != $status_pemesanan)
		{
			if ($status_pemesanan == "Booked")
			{
				$status_verify = '';
				$tanggal_tanda_jadi = '';
				$tanggal_sold = '';
			}
			if ($status_pemesanan == "Tanda Jadi")
			{
				$status_verify = '';
				$tanggal_tanda_jadi = $this->tanggal;
				$tanggal_sold = '';
			}
			elseif ($status_pemesanan == "Sold")
			{
				$tanggal_sold = $this->tanggal;
			}
		}
		
		$temp_cara_pembayaran = explode(" ", $this->input->post('cara_pembayaran'));
		$tipe_pembayaran = $temp_cara_pembayaran[0];
		$tahap_pembayaran = $temp_cara_pembayaran[1];
		
		# Mengupdata data pemesanan
		$data_pemesanan = array(	"tanggal_tanda_jadi"	=> $tanggal_tanda_jadi,
									"tanggal_sold"			=> $tanggal_sold,
									"status_pemesanan"		=> $status_pemesanan,
									"status_verify"			=> $status_verify,
									"tipe_pembayaran"		=> $tipe_pembayaran,
									"tahap_pembayaran"		=> $tahap_pembayaran,
									"booking_fee"			=> $this->input->post('booking_fee'),
									"timeout"				=> $timeout,
									"diskon_tanah"			=> $this->input->post('diskon_tanah'),
									"diskon_bangunan"		=> $this->input->post('diskon_bangunan')
									);
		$this->pemesanan_m->edit($this->input->post('id_pemesanan'), $data_pemesanan);

		$data_unit = $this->unit_m->get_by_id($this->input->post('id_unit'))->row();

		# Mengupdata data customer
		$data_customer 	= array(	"nama_lengkap"			=> $this->input->post('nama_lengkap'),
									"no_ktp"				=> $this->input->post('no_ktp'),
									"no_npwp"				=> $this->input->post('no_npwp'),
									"alamat_npwp"			=> $this->input->post('alamat_npwp'),
									"telpon"				=> $this->input->post('telpon'),
									"hp"					=> $this->input->post('hp'),
									"email"					=> $this->input->post('email'),
									"alamat_ktp"			=> $this->input->post('alamat_ktp'),
									"alamat_surat_menyurat"	=> $this->input->post('alamat_surat_menyurat')
									);
		$this->customer_m->edit($this->input->post('id_customer'), $data_customer);

		# Update / Insert Referensi Customer
		$this->customer_ref_m->save();
		
		# Update No Kartu Keluarga
		$this->kartu_keluarga_m->edit_kartu_keluarga(
			$this->input->post('id_kartu_keluarga'), 
			array("no_kartu_keluarga" => $this->input->post('no_kartu_keluarga'))
		);
		
		$doc_ktp 			= $this->upload_dokumen("doc_ktp");
		$doc_npwp			= $this->upload_dokumen("doc_npwp");
		$doc_kartu_keluarga	= $this->upload_dokumen("doc_kartu_keluarga");
		$doc_akta_nikah		= $this->upload_dokumen("doc_akta_nikah");
		$doc_siup			= $this->upload_dokumen("doc_siup");

		# Upload File
		$data_upload = array();
		if($doc_ktp != "")
		{
			$data_upload["doc_ktp"] = $doc_ktp;
		}
		if($doc_npwp != "")
		{
			$data_upload["doc_npwp"] = $doc_npwp;
		}
		if($doc_kartu_keluarga != "")
		{
			$data_upload["doc_kartu_keluarga"] = $doc_kartu_keluarga;
		}
		if($doc_akta_nikah != "")
		{
			$data_upload["doc_akta_nikah"] = $doc_akta_nikah;
		}
		if($doc_siup != "")
		{
			$data_upload["doc_siup"] = $doc_siup;
		}
		if(!empty($data_upload))
		{
			$this->customer_m->edit($this->input->post('id_customer'), $data_upload);
		}

		# Mengupload file dokumen
		$i = 0;
		foreach ($_FILES['doc']['name'] as $filename)
		{
			if (!empty($_FILES['doc']['name'][$i]))
            {
            	$file = $this->upload_dokumen_lainnya($i);

            	$data = array(	"id_customer"		=> $this->input->post('id_customer'),
            					"file_dokumen"		=> $file);
            	$this->customer_m->add_dokumen($data); 
            	$i++;
            }  
		}

		# Mengupdate status unit
		if ($status_pemesanan == "Sold")
		{
			$status_pemesanan_for_unit = "Sold";
		}
		else
		{
			$status_pemesanan_for_unit = "Booked";
		}
		$this->unit_m->update_status_transaksi($this->input->post('id_unit'), $status_pemesanan_for_unit);
		
		$this->access_lib->logging("Ubah data pemesanan promo : ".$now_pemesanan->nomor_pemesanan." (".$this->input->post('status_pemesanan').")");
		
		redirect('report/promo_anggota_keluarga/'.$this->input->post('id_unit').'/'.$this->input->post('id_kartu_keluarga').'/'.$this->input->post('id_pemesanan'));
	}

	public function promo_anggota_keluarga($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');		
		$this->load->model('kartu_keluarga_m');
		
		$data['header']				= $this->header;
		$data['data_unit'] 			= $this->unit_m->get_by_id($id_unit)->row();
		$data["pemesanan"]			= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['anggota_keluarga']	= $this->kartu_keluarga_m->get_all_anggota_keluarga($id_kartu_keluarga)->result();
		$data['id_unit']			= $id_unit;
		$data['id_pemesanan']		= $id_pemesanan;
		$data['id_kartu_keluarga']	= $id_kartu_keluarga;
		
		$data["status"]				= $data["pemesanan"]->jenis_pemesanan;
		$data['nama_promo']			= $data["pemesanan"]->nama_promo;
		$data['deskripsi']			= $data["pemesanan"]->deskripsi;

		$this->load->view('report_promo_kartu_keluarga_v', $data);
	}

	public function promo_anggota_keluarga_add()
	{
		$this->load->model('kartu_keluarga_m');

		$data = array(	"id_kartu_keluarga" 	=> $this->input->post('id_kartu_keluarga'),
						"nama_lengkap"			=> $this->input->post('nama_anggota_keluarga'),
						"no_ktp"				=> $this->input->post('no_ktp'),
						"tanggal_lahir"			=> $this->input->post('tanggal_lahir'),
						"bulan_lahir"			=> $this->input->post('bulan_lahir'),
						"tahun_lahir"			=> $this->input->post('tahun_lahir'),
						"npwp"					=> $this->input->post('npwp'),
						"hubungan_keluarga"		=> $this->input->post('hubungan_keluarga'),
						"status_nikah"			=> $this->input->post('status_kawin'));

		$id_anggota_keluarga = $this->kartu_keluarga_m->add_anggota_keluarga($data);
		
		redirect('report/promo_anggota_keluarga/'.$this->input->post('id_unit').'/'.$this->input->post('id_kartu_keluarga').'/'.$this->input->post('id_pemesanan'));
	}

	public function promo_anggota_keluarga_delete($id_anggota_keluarga)
	{
		$this->load->model('kartu_keluarga_m');
		$this->kartu_keluarga_m->delete_anggota_keluarga($id_anggota_keluarga);
	}

	public function promo_preview($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
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

		$this->load->view('report_promo_preview_v', $data);
	}
	
	public function promo_detail($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
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

		$this->load->view('report_promo_detail_v', $data);
	}
	
	public function promo_delete($id_pemesanan, $id_unit)
	{
		$this->access_lib->_is("adm,mgr,ksr");
		
		$this->load->model('pemesanan_m');
		$this->load->model('unit_m');

		$data_pemesanan = $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		
		$data = array( 	"status_data" 	=> 'trash_data',
						"delete_by"		=> $this->session->userdata('id_user'),
						"delete_time"	=> date('Y-m-d H:i:s'));
		$this->pemesanan_m->edit($id_pemesanan, $data);

		$this->unit_m->update_status_transaksi($id_unit, "");
		
		$this->access_lib->logging("Hapus data pemesanan promo : ".$data_pemesanan->nomor_pemesanan);
	}

	#	----------------------------------
	#	B O O K I N G    U N I T   S O L D
	#	----------------------------------

	public function unit_sold()
	{
		$data['header'] = $this->header;
		$this->load->view('report_unit_sold_v', $data);
	}

	public function unit_sold_list($limit)
	{
		$this->load->model('pemesanan_m');
		$this->load->model('cluster_m');
		$this->load->model('promo_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_status('limit', '', $limit, '', '', '', '', '', '', '')->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_status('all', '', $limit, '', '', '', '', '', '', '')->result());
		$data['cluster']			= $this->cluster_m->get_all("all", 0)->result();
		$data['promo']				= $this->promo_m->get_all("all", 0)->result();

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;

		$data['filter']				= "";
		$data['kata_kunci']			= "";
		$data['id_cluster']			= "";
		$data['kategori']			= "";
		$data['jenis_transaksi']	= "";
		$data['status_cari']		= "";
		$data['id_promo']  			= "";
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('report_unit_sold_data_v', $data);
	}

	public function unit_sold_cari_list($limit, $filter, $id_cluster, $kategori, $kata_kunci, $jenis_transaksi, $id_promo)
	{
		$this->load->model('pemesanan_m');
		$this->load->model('cluster_m');
		$this->load->model('promo_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_status('limit', '', $limit, '', $filter, $id_cluster, urldecode($kategori), urldecode($kata_kunci), $jenis_transaksi, $id_promo)->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_status('all', '', 0, '', $filter, $id_cluster, urldecode($kategori), urldecode($kata_kunci), $jenis_transaksi, $id_promo)->result());
		$data['cluster']			= $this->cluster_m->get_all("all", 0)->result();
		$data['promo']				= $this->promo_m->get_all("all", 0)->result();

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;

		$data['filter']				= $filter;
		$data['kata_kunci']			= urldecode($kata_kunci);
		$data['id_cluster']			= $id_cluster;
		$data['kategori']			= urldecode($kategori);
		$data['jenis_transaksi']	= $jenis_transaksi;
		$data['status_cari']		= "cari";
		$data['id_promo'] 			= $id_promo;
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('report_unit_sold_data_v', $data);
	}	

	public function unit_sold_form($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');
		$this->load->model('cara_pembayaran_m');
		$this->load->model('promo_m');

		$data['header']					= $this->header;
		$data['data_unit'] 				= $this->unit_m->get_by_id($id_unit)->row();
		$data['kartu_keluarga']			= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['pemesanan']				= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$data['customer']				= $this->customer_m->get_by_id($data['pemesanan']->id_customer)->row();
		$data['data_cara_pembayaran']	= $this->cara_pembayaran_m->get_all()->result();
		
		if ($data["pemesanan"]->jenis_pemesanan == "Promo")
		{
			$data['diskon_cara_pembayaran'] = $this->promo_m->get_max_diskon($id_unit)->result();
			$data['data_cara_pembayaran']   = $data['diskon_cara_pembayaran'];
		}
		
		$data['id_unit']				= $id_unit;
		$data['id_kartu_keluarga']		= $id_kartu_keluarga;
		$data['id_pemesanan']			= $id_pemesanan;
		
		$data["status"]					= $data["pemesanan"]->jenis_pemesanan;
		$data['nama_promo']				= $data["pemesanan"]->nama_promo;
		$data['deskripsi']				= $data["pemesanan"]->deskripsi;

		$this->load->view('report_unit_sold_form_v', $data);	
	}

	public function unit_sold_edit()
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('customer_ref_m');
		$this->load->model('unit_m');
		$this->load->model('kartu_keluarga_m');

		$now_pemesanan = $this->pemesanan_m->get_by_id($this->input->post('id_pemesanan'))->row();
		
		$tanggal_tanda_jadi = $now_pemesanan->tanggal_tanda_jadi;
		$tanggal_sold = $now_pemesanan->tanggal_sold;
		$status_verify = $now_pemesanan->status_verify;
		
		if ($now_pemesanan->status_pemesanan != $this->input->post('status_pemesanan'))
		{
			if ($this->input->post('status_pemesanan') == "Booked")
			{
				$status_verify = '';
				$tanggal_tanda_jadi = '';
				$tanggal_sold = '';
			}
			if ($this->input->post('status_pemesanan') == "Tanda Jadi")
			{
				$status_verify = '';
				$tanggal_tanda_jadi = $this->tanggal;
				$tanggal_sold = '';
			}
			elseif ($this->input->post('status_pemesanan') == "Sold")
			{
				$tanggal_sold = $this->tanggal;
			}
		}
		
		$data_unit = $this->unit_m->get_by_id($this->input->post('id_unit'))->row();
		
		$timeout = (($this->input->post('hari')*86400)+($this->input->post('jam')*3600)+($this->input->post('menit')*60));

		$temp_cara_pembayaran = explode(" ", $this->input->post('cara_pembayaran'));
		$tipe_pembayaran = $temp_cara_pembayaran[0];
		$tahap_pembayaran = $temp_cara_pembayaran[1];
		
		if($data_unit->status_unit == "Promo")
		{
			# Mengupdata data pemesanan
			$data_pemesanan = array(	"tanggal_tanda_jadi"	=> $tanggal_tanda_jadi,
										"tanggal_sold"			=> $tanggal_sold,
										"status_pemesanan"		=> $this->input->post('status_pemesanan'),
										"status_verify"			=> $status_verify,
										"tipe_pembayaran"		=> $tipe_pembayaran,
										"tahap_pembayaran"		=> $tahap_pembayaran,
										"booking_fee"			=> $this->input->post('booking_fee'),
										"timeout"				=> $timeout,
										"diskon_tanah"			=> $this->input->post('diskon_tanah'),
										"diskon_bangunan"		=> $this->input->post('diskon_bangunan')
										);
		}
		else
		{
			# Mengupdata data pemesanan
			$data_pemesanan = array(	"tanggal_tanda_jadi"	=> $tanggal_tanda_jadi,
										"tanggal_sold"			=> $tanggal_sold,
										"status_pemesanan"		=> $this->input->post('status_pemesanan'),
										"status_verify"			=> $status_verify,
										"tipe_pembayaran"		=> $tipe_pembayaran,
										"tahap_pembayaran"		=> $tahap_pembayaran,
										"booking_fee"			=> $this->input->post('booking_fee'),
										"timeout"				=> $timeout
										);
		}
		
		$this->pemesanan_m->edit($this->input->post('id_pemesanan'), $data_pemesanan);	

		# Mengupdata data customer
		$data_customer 	= array(	"nama_lengkap"			=> $this->input->post('nama_lengkap'),
									"no_ktp"				=> $this->input->post('no_ktp'),
									"no_npwp"				=> $this->input->post('no_npwp'),
									"alamat_npwp"			=> $this->input->post('alamat_npwp'),
									"telpon"				=> $this->input->post('telpon'),
									"hp"					=> $this->input->post('hp'),
									"email"					=> $this->input->post('email'),
									"alamat_ktp"			=> $this->input->post('alamat_ktp'),
									"alamat_surat_menyurat"	=> $this->input->post('alamat_surat_menyurat')									
									);
		$this->customer_m->edit($this->input->post('id_customer'), $data_customer);
		
		# Update / Insert Referensi Customer
		$this->customer_ref_m->save();
		
		# Update No Kartu Keluarga
		$this->kartu_keluarga_m->edit_kartu_keluarga(
			$this->input->post('id_kartu_keluarga'), 
			array("no_kartu_keluarga" => $this->input->post('no_kartu_keluarga'))
		);

		$doc_ktp 			= $this->upload_dokumen("doc_ktp");
		$doc_npwp			= $this->upload_dokumen("doc_npwp");
		$doc_kartu_keluarga	= $this->upload_dokumen("doc_kartu_keluarga");
		$doc_akta_nikah		= $this->upload_dokumen("doc_akta_nikah");
		$doc_siup			= $this->upload_dokumen("doc_siup");
		
		# Upload File
		$data_upload = array();
		if($doc_ktp != "")
		{
			$data_upload["doc_ktp"] = $doc_ktp;
		}
		if($doc_npwp != "")
		{
			$data_upload["doc_npwp"] = $doc_npwp;
		}
		if($doc_kartu_keluarga != "")
		{
			$data_upload["doc_kartu_keluarga"] = $doc_kartu_keluarga;
		}
		if($doc_akta_nikah != "")
		{
			$data_upload["doc_akta_nikah"] = $doc_akta_nikah;
		}
		if($doc_siup != "")
		{
			$data_upload["doc_siup"] = $doc_siup;
		}
		if(!empty($data_upload))
		{
			$this->customer_m->edit($this->input->post('id_customer'), $data_upload);
		}

		# Mengupload file dokumen
		$i = 0;
		foreach ($_FILES['doc']['name'] as $filename)
		{
			if (!empty($_FILES['doc']['name'][$i]))
            {
            	$file = $this->upload_dokumen_lainnya($i);

            	$data = array(	"id_customer"		=> $this->input->post('id_customer'),
            					"file_dokumen"		=> $file);
            	$this->customer_m->add_dokumen($data); 
            	$i++;
            }  
		}

		# Mengupdate status unit
		if ($this->input->post('status_pemesanan') == "Sold")
		{
			$status_pemesanan_for_unit = "Sold";
		}
		else
		{
			$status_pemesanan_for_unit = "Booked";
		}
		$this->unit_m->update_status_transaksi($this->input->post('id_unit'), $status_pemesanan_for_unit);
		
		$this->access_lib->logging("Ubah data pemesanan SOLD : ".$now_pemesanan->nomor_pemesanan." (".$this->input->post('status_pemesanan').")");
		
		redirect('report/unit_sold_anggota_keluarga/'.$this->input->post('id_unit').'/'.$this->input->post('id_kartu_keluarga').'/'.$this->input->post('id_pemesanan'));
	}

	public function unit_sold_anggota_keluarga($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');		
		$this->load->model('kartu_keluarga_m');
		
		$data['header']				= $this->header;
		$data['data_unit'] 			= $this->unit_m->get_by_id($id_unit)->row();
		$data['pemesanan']			= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['anggota_keluarga']	= $this->kartu_keluarga_m->get_all_anggota_keluarga($id_kartu_keluarga)->result();
		$data['id_unit']			= $id_unit;
		$data['id_pemesanan']		= $id_pemesanan;
		$data['id_kartu_keluarga']	= $id_kartu_keluarga;
		
		$data["status"]				= $data["pemesanan"]->jenis_pemesanan;
		$data['nama_promo']			= $data["pemesanan"]->nama_promo;
		$data['deskripsi']			= $data["pemesanan"]->deskripsi;

		$this->load->view('report_unit_sold_kartu_keluarga_v', $data);
	}

	public function unit_sold_anggota_keluarga_add()
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('kartu_keluarga_m');

		$data = array(	"id_kartu_keluarga" 	=> $this->input->post('id_kartu_keluarga'),
						"nama_lengkap"			=> $this->input->post('nama_anggota_keluarga'),
						"no_ktp"				=> $this->input->post('no_ktp'),
						"tanggal_lahir"			=> $this->input->post('tanggal_lahir'),
						"bulan_lahir"			=> $this->input->post('bulan_lahir'),
						"tahun_lahir"			=> $this->input->post('tahun_lahir'),
						"npwp"					=> $this->input->post('npwp'),
						"hubungan_keluarga"		=> $this->input->post('hubungan_keluarga'),
						"status_nikah"			=> $this->input->post('status_kawin'));

		$id_anggota_keluarga = $this->kartu_keluarga_m->add_anggota_keluarga($data);		

		redirect('report/unit_sold_anggota_keluarga/'.$this->input->post('id_unit').'/'.$this->input->post('id_kartu_keluarga').'/'.$this->input->post('id_pemesanan'));
	}

	public function unit_sold_anggota_keluarga_delete($id_anggota_keluarga)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('kartu_keluarga_m');
		$this->kartu_keluarga_m->delete_anggota_keluarga($id_anggota_keluarga);
	}

	public function unit_sold_preview($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
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

		$this->load->view('report_unit_sold_preview_v', $data);
	}

	public function unit_sold_detail($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
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

		$this->load->view('report_unit_sold_detail_v', $data);
	}
	
	public function unit_sold_delete($id_pemesanan, $id_unit)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('pemesanan_m');
		$this->load->model('unit_m');

		$data_pemesanan = $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		
		$data = array( 	"status_data" 	=> 'trash_data',
						"delete_by"		=> $this->session->userdata('id_user'),
						"delete_time"	=> date('Y-m-d H:i:s'));
		$this->pemesanan_m->edit($id_pemesanan, $data);

		$this->unit_m->update_status_transaksi($id_unit, "");
		
		$this->access_lib->logging("Hapus data pemesanan SOLD : ".$data_pemesanan->nomor_pemesanan);
	}
	
	#	------------------------------
	#	B O O K I N G    T I M E O U T
	#	------------------------------

	public function timeout()
	{
		$data['header'] = $this->header;
		$this->load->view('report_timeout_v', $data);
	}

	public function timeout_list($limit)
	{
		$this->load->model('pemesanan_m');
		$this->load->model('cluster_m');
		
		$data['pemesanan']			= $this->pemesanan_m->get_by_status_data('limit', $limit, 'timeout')->result();
		$data['total_pemesanan']	= count($this->pemesanan_m->get_by_status_data('all', 0, 'timeout')->result());

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;		
		
		if(($data['total_pemesanan'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_pemesanan']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_pemesanan']/10)*10) - 10;
		}
		
		$this->load->view('report_timeout_data_v', $data);
	}

	public function timeout_detail($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
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

		$this->load->view('report_timeout_detail_v', $data);
	}

	public function timeout_form($id_unit, $id_kartu_keluarga, $id_pemesanan)
	{
		$this->access_lib->_is("adm,mgr,ksr");
		
		$this->load->model('unit_m');
		$this->load->model('pemesanan_m');
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
		$data['data_unit'] 			= $this->unit_m->get_by_id($id_unit)->row();
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['pemesanan']			= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$data['dokumen_lainnya']	= $this->customer_m->get_dokumen_by_id_customer($data['pemesanan']->id_customer)->result();
		$data['customer']			= $this->customer_m->get_by_id($data['pemesanan']->id_customer)->row();

		$data['id_unit']			= $id_unit;
		$data['id_kartu_keluarga']	= $id_kartu_keluarga;
		$data['id_pemesanan']		= $id_pemesanan;
		$data['message']			= "";
		
		$data["status"]				= $data["pemesanan"]->jenis_pemesanan;
		$data['nama_promo']			= $data["pemesanan"]->nama_promo;
		$data['deskripsi']			= $data["pemesanan"]->deskripsi;

		$this->load->view('report_timeout_form_v', $data);	
	}

	public function timeout_restore()
	{
		$this->access_lib->_is("adm,mgr,ksr");
		
		$this->load->model('pemesanan_m');
		$this->load->model('unit_m');
		
		$id_pemesanan	= $this->input->post('id_pemesanan');
		$pemesanan		= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$id_unit		= $pemesanan->id_unit;
		$data_unit		= $this->unit_m->get_by_id($id_unit)->row();
		$timeout		= (($this->input->post('hari')*86400)+($this->input->post('jam')*3600)+($this->input->post('menit')*60));
		
		$data = array( 	"timeout"		=> $timeout,
						"status_verify"	=> '',
						"status_data"	=> '');
		
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
					$this->access_lib->logging("Restore data pemesanan timeout : ".$pemesanan->nomor_pemesanan);
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
				$this->access_lib->logging("Restore data pemesanan timeout : ".$pemesanan->nomor_pemesanan);
				echo "ok";
			}
		}
		else
		{
			echo "Maaf, unit yang terkait dengan pemesanan ini sudah tidak available.";
		}
	}

	public function timeout_delete($id_pemesanan, $id_unit)
	{
		$this->access_lib->_is("adm,mgr,ksr");
		
		$this->load->model('pemesanan_m');
		$this->load->model('unit_m');

		$data_pemesanan = $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		
		$data = array( 	"status_data"	=> 'trash_data',
						"delete_by"		=> $this->session->userdata('id_user'),
						"delete_time"	=> date('Y-m-d H:i:s'));
		
		$this->pemesanan_m->edit($id_pemesanan, $data);
		
		$this->access_lib->logging('Hapus data pemesanan dari "Book Timeout" : '.$data_pemesanan->nomor_pemesanan);
	}

	#	---------------
	#	C U S T O M E R
	#	---------------

	public function customer()
	{
		$this->access_lib->_is("adm,mgr");
		
		$data['header'] = $this->header;

		$this->load->view('report_customer_v', $data);
	}

	public function customer_list($limit = 10)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('customer_m');
		
		$data['customer']		= $this->customer_m->get_all('limit', $limit)->result();
		$data['total_customer'] = count($this->customer_m->get_all('all', 0)->result());

		$data['prev']			= $limit - 10;
		$data['next']			= $limit + 10;
		$data['posisi']			= $limit;
		$data['katakunci']		= "";		
		
		if(($data['total_customer'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_customer']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_customer']/10)*10) - 10;
		}
		
		$this->load->view('report_customer_data_v', $data);
	}

	public function customer_cari($katakunci, $limit = 0)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('customer_m');
		
		$katakunci = base64_decode($katakunci);
		
		$data['customer']			= $this->customer_m->get_all_cari('limit', $katakunci, $limit)->result();
		$data['total_customer']		= count($this->customer_m->get_all_cari('all', $katakunci, 0)->result());

		$data['prev']				= $limit - 10;
		$data['next']				= $limit + 10;
		$data['posisi']				= $limit;
		$data['katakunci']			= $katakunci;
		
		if(($data['total_customer'] % 10) > 0)
		{
			$data['akhir']	= floor($data['total_customer']/10)*10;
		}
		else
		{
			$data['akhir']	= (floor($data['total_customer']/10)*10) - 10;
		}
		
		$this->load->view('report_customer_data_cari_v', $data);
	}

	public function customer_form_data($status, $id_customer)
	{
		$this->access_lib->_is("adm,mgr");
		
		$data['header'] = $this->header;

		if($status == "add")
		{
			$data['judul']					= "Tambah Data Customer";
			$data['action'] 				= base_url()."report/customer_add";
			$data['status_form']			= $status;

			$data['nama_lengkap']			= "";
			$data['no_ktp']					= "";
			$data['no_npwp']				= "";
			$data['telpon']					= "";
			$data['hp']						= "";
			$data['email']					= "";
			$data['no_kartu_keluarga'] 		= "";
			$data['alamat_ktp']				= "";
			$data['alamat_npwp']			= "";
			$data['alamat_surat_menyurat']	= "";
			$data['id_customer']			= "";
			$data['id_kartu_keluarga']		= "";
			$data['doc_ktp']				= "";
			$data['doc_npwp']				= "";
			$data['doc_kartu_keluarga']		= "";
			$data['doc_akta_nikah']			= "";
			$data['doc_siup']				= "";
		}
		else
		{
			$this->load->model('customer_m');
			$this->load->model('kartu_keluarga_m');

			$data['judul']					= "Ubah Data Customer";
			$data['action'] 				= base_url()."report/customer_edit";
			$data['status_form']			= $status;
			$data_customer					= $this->customer_m->get_by_id($id_customer)->row();
			$data_kartu_keluarga			= $this->kartu_keluarga_m->get_kartu_keluarga_by_id_customer($data_customer->id_customer)->row();

			$data['nama_lengkap']			= $data_customer->nama_lengkap;
			$data['no_ktp']					= $data_customer->no_ktp;
			$data['no_npwp']				= $data_customer->no_npwp;
			$data['telpon']					= $data_customer->telpon;
			$data['hp']						= $data_customer->hp;
			$data['email']					= $data_customer->email;
			$data['no_kartu_keluarga'] 		= $data_kartu_keluarga->no_kartu_keluarga;
			$data['alamat_ktp']				= $data_customer->alamat_ktp;
			$data['alamat_npwp']			= $data_customer->alamat_npwp;
			$data['alamat_surat_menyurat']	= $data_customer->alamat_surat_menyurat;
			$data['id_customer']			= $data_customer->id_customer;
			$data['id_kartu_keluarga']		= $data_kartu_keluarga->id_kartu_keluarga;
			$data['doc_ktp']				= $data_customer->doc_ktp;
			$data['doc_npwp']				= $data_customer->doc_npwp;
			$data['doc_kartu_keluarga']		= $data_customer->doc_kartu_keluarga;
			$data['doc_akta_nikah']			= $data_customer->doc_akta_nikah;
			$data['doc_siup']				= $data_customer->doc_siup;
		}

		$this->load->view('report_customer_form_v', $data);
	}

	public function customer_add()
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('customer_m');
		$this->load->model('customer_ref_m');
		$this->load->model('kartu_keluarga_m');

		$doc_ktp 			= $this->upload_dokumen("doc_ktp");
		$doc_npwp			= $this->upload_dokumen("doc_npwp");
		$doc_kartu_keluarga	= $this->upload_dokumen("doc_kartu_keluarga");
		$doc_akta_nikah		= $this->upload_dokumen("doc_akta_nikah");
		$doc_siup			= $this->upload_dokumen("doc_siup");

		# Menyimpan data customer
		$data_customer 	= array(	"nama_lengkap"			=> $this->input->post('nama_lengkap'),
									"no_ktp"				=> $this->input->post('no_ktp'),
									"no_npwp"				=> $this->input->post('no_npwp'),
									"alamat_npwp"			=> $this->input->post('alamat_npwp'),
									"telpon"				=> $this->input->post('telpon'),
									"hp"					=> $this->input->post('hp'),
									"email"					=> $this->input->post('email'),
									"alamat_ktp"			=> $this->input->post('alamat_ktp'),
									"alamat_surat_menyurat"	=> $this->input->post('alamat_surat_menyurat'),
									"doc_ktp"				=> $doc_ktp,
									"doc_npwp"				=> $doc_npwp,
									"doc_kartu_keluarga"	=> $doc_kartu_keluarga,
									"doc_akta_nikah"		=> $doc_akta_nikah,
									"doc_siup"				=> $doc_siup
									);
		$id_customer = $this->customer_m->add($data_customer);
		
		# Update / Insert Referensi Customer
		$this->customer_ref_m->save();
		
		# Mengupload file dokumen
		$i = 0;
		foreach ($_FILES['doc']['name'] as $filename)
		{
			if (!empty($_FILES['doc']['name'][$i]))
            {
            	$file = $this->upload_dokumen_lainnya($i);

            	$data = array(	"id_customer"		=> $id_customer,
            					"file_dokumen"		=> $file);
            	$this->customer_m->add_dokumen($data); 
            	$i++;
            }  
		}
		
		# Menyimpan data kartu keluarga
		$data_kartu_keluarga 	= array(	"id_customer"			=> $id_customer,
											"no_kartu_keluarga"		=> $this->input->post('no_kartu_keluarga'),
											"tanggal_posting"		=> $this->tanggal);

		$id_kartu_keluarga		= $this->kartu_keluarga_m->add_kartu_keluarga($data_kartu_keluarga);

		$this->access_lib->logging("Tambah data customer : ".$this->input->post('nama_lengkap'));
		
		redirect('report/customer_anggota_keluarga/'.$id_kartu_keluarga);
	}

	public function customer_edit()
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('customer_m');
		$this->load->model('customer_ref_m');
		$this->load->model('kartu_keluarga_m');

		# Menyimpan data customer
		$data_customer 	= array(	"nama_lengkap"			=> $this->input->post('nama_lengkap'),
									"no_ktp"				=> $this->input->post('no_ktp'),
									"no_npwp"				=> $this->input->post('no_npwp'),
									"alamat_npwp"			=> $this->input->post('alamat_npwp'),
									"telpon"				=> $this->input->post('telpon'),
									"hp"					=> $this->input->post('hp'),
									"email"					=> $this->input->post('email'),
									"alamat_ktp"			=> $this->input->post('alamat_ktp'),
									"alamat_surat_menyurat"	=> $this->input->post('alamat_surat_menyurat')
									);
		$this->customer_m->edit($this->input->post('id_customer'), $data_customer);
		
		# Update / Insert Referensi Customer
		$this->customer_ref_m->save();
		
		# Update No Kartu Keluarga
		$this->kartu_keluarga_m->edit_kartu_keluarga(
			$this->input->post('id_kartu_keluarga'), 
			array("no_kartu_keluarga" => $this->input->post('no_kartu_keluarga'))
		);
		
		$doc_ktp 			= $this->upload_dokumen("doc_ktp");
		$doc_npwp			= $this->upload_dokumen("doc_npwp");
		$doc_kartu_keluarga	= $this->upload_dokumen("doc_kartu_keluarga");
		$doc_akta_nikah		= $this->upload_dokumen("doc_akta_nikah");
		$doc_siup			= $this->upload_dokumen("doc_siup");
		
		# Upload File
		$data_upload = array();
		if($doc_ktp != "")
		{
			$data_upload["doc_ktp"] = $doc_ktp;
		}
		if($doc_npwp != "")
		{
			$data_upload["doc_npwp"] = $doc_npwp;
		}
		if($doc_kartu_keluarga != "")
		{
			$data_upload["doc_kartu_keluarga"] = $doc_kartu_keluarga;
		}
		if($doc_akta_nikah != "")
		{
			$data_upload["doc_akta_nikah"] = $doc_akta_nikah;
		}
		if($doc_siup != "")
		{
			$data_upload["doc_siup"] = $doc_siup;
		}
		if(!empty($data_upload))
		{
			$this->customer_m->edit($this->input->post('id_customer'), $data_upload);
		}
		
		# Mengupload file dokumen
		$i = 0;
		foreach ($_FILES['doc']['name'] as $filename)
		{
			if (!empty($_FILES['doc']['name'][$i]))
            {
            	$file = $this->upload_dokumen_lainnya($i);

            	$data = array(	"id_customer"		=> $this->input->post('id_customer'),
            					"file_dokumen"		=> $file);
            	$this->customer_m->add_dokumen($data); 
            	$i++;
            }  
		}

		# Menyimpan data kartu keluarga
		$data_kartu_keluarga 	= array(	"id_customer"			=> $this->input->post('id_customer'),
											"no_kartu_keluarga"		=> $this->input->post('no_kartu_keluarga'),
											"tanggal_posting"		=> $this->tanggal);

		$this->kartu_keluarga_m->edit_kartu_keluarga($this->input->post('id_kartu_keluarga'), $data_kartu_keluarga);

		$this->access_lib->logging("Ubah data customer : ".$this->input->post('nama_lengkap'));
		
		redirect('report/customer_anggota_keluarga/'.$this->input->post('id_kartu_keluarga'));
	}

	public function customer_anggota_keluarga($id_kartu_keluarga)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('kartu_keluarga_m');

		$data['header']				= $this->header;
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id($id_kartu_keluarga)->row();
		$data['id_kartu_keluarga']	= $id_kartu_keluarga;
		$data['anggota_keluarga']	= $this->kartu_keluarga_m->get_all_anggota_keluarga($id_kartu_keluarga)->result();

		$this->load->view('report_form_kartu_keluarga_v', $data);
	}

	public function customer_anggota_keluarga_add()
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('kartu_keluarga_m');		

		$data = array(	"id_kartu_keluarga" 	=> $this->input->post('id_kartu_keluarga'),
						"nama_lengkap"			=> $this->input->post('nama_anggota_keluarga'),
						"no_ktp"				=> $this->input->post('no_ktp'),
						"tanggal_lahir"			=> $this->input->post('tanggal_lahir'),
						"bulan_lahir"			=> $this->input->post('bulan_lahir'),
						"tahun_lahir"			=> $this->input->post('tahun_lahir'),
						"npwp"					=> $this->input->post('npwp'),
						"hubungan_keluarga"		=> $this->input->post('hubungan_keluarga'),
						"status_nikah"			=> $this->input->post('status_kawin'));

		$id_anggota_keluarga = $this->kartu_keluarga_m->add_anggota_keluarga($data);			

		redirect('report/customer_anggota_keluarga/'.$this->input->post('id_kartu_keluarga'));
	}

	public function customer_anggota_keluarga_delete($id_anggota_keluarga)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('kartu_keluarga_m');
		$this->kartu_keluarga_m->delete_anggota_keluarga($id_anggota_keluarga);
	}
	
	public function customer_detail($id_customer)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$data['customer'] 			= $this->customer_m->get_by_id($id_customer)->row();
		$data['kartu_keluarga']		= $this->kartu_keluarga_m->get_kartu_keluarga_by_id_customer($data['customer']->id_customer)->row();
		$data['anggota_keluarga']	= $this->kartu_keluarga_m->get_all_anggota_keluarga($data['kartu_keluarga']->id_kartu_keluarga)->result();
		$data['dokumen_lainnya']	= $this->customer_m->get_dokumen_by_id_customer($id_customer)->result();

		$this->load->view('report_customer_detail_v', $data);
	}
	
	public function customer_delete($id_customer)
	{
		$this->access_lib->_is("adm,mgr");
		
		$this->load->model('customer_m');
		$this->load->model('kartu_keluarga_m');

		$nama_lengkap = $this->customer_m->get_by_id($id_customer)->row()->nama_lengkap;
		$data_kartu_keluarga = $this->kartu_keluarga_m->get_kartu_keluarga_by_id_customer($data_customer->id_customer)->row();

		$this->customer_m->delete($id_customer);
		$this->kartu_keluarga_m->delete_kartu_keluarga($data_kartu_keluarga->id_kartu_keluarga);
		$this->kartu_keluarga_m->delete_anggota_keluarga_by_id_kartu_keluarga($data_kartu_keluarga->id_kartu_keluarga);
		
		$this->access_lib->logging("Hapus data customer : ".$nama_lengkap);
	}

	#	----------------------------
	#	U P L O A D  D O C U M E T
	#	----------------------------

	public function upload_dokumen($nama_dokumen)
	{
		if($_FILES[$nama_dokumen]['name'] != "")
		{
			$path_parts = pathinfo($_FILES[$nama_dokumen]['name']);
			$rand_name 	= $this->session->userdata('id_user')."_".$nama_dokumen."_".md5(date('Y-m-d H:i:s')).".".$path_parts['extension'];

			move_uploaded_file($_FILES[$nama_dokumen]["tmp_name"], $this->dokumen_path."/".$rand_name);
			$ktp 		= $rand_name;
		}
		else
		{
			$ktp 		= "";
		}
		
		return $ktp;
	}

	public function upload_dokumen_lainnya($i)
	{
		if($_FILES['doc']['name'][$i] != "")
		{
			$path_parts = pathinfo($_FILES['doc']['name'][$i]);
			$rand_name 	= $this->session->userdata('id_user')."_".$i."_".md5(date('Y-m-d H:i:s')).".".$path_parts['extension'];

			move_uploaded_file($_FILES['doc']["tmp_name"][$i], $this->dokumen_path."/".$rand_name);
			$ktp 		= $rand_name; 		
		}
		else
		{
			$ktp 		= "";
		}
		
		return $ktp;
	}

	#	---------------------------------------
	#	V E R I F I K A S I  T R A N S A K S I
	#	---------------------------------------
	
	# Verify transaksi
	public function verify_transaksi($id_pemesanan)
	{
		$this->access_lib->_is("adm,mgr,ksr");
		
		$this->load->library('f_lib');
		$this->load->model('pemesanan_m');
		$this->load->model('unit_m');
		$this->load->model('timeout_m');
		
		$data_pemesanan		= $this->pemesanan_m->get_by_id($id_pemesanan)->row();
		$nomor_pemesanan	= $data_pemesanan->nomor_pemesanan;
		$status_pemesanan	= $data_pemesanan->status_pemesanan;
		$status_verify		= $data_pemesanan->status_verify;
		$id_unit			= $data_pemesanan->id_unit;
		
		$show_status_pemesanan	= $status_pemesanan;
		$show_status_verify		= $status_verify;
		$tanggal_pemesanan		= $data_pemesanan->tanggal_pemesanan;
		$tanggal_tanda_jadi		= $this->f_lib->ubah_format_tanggal($data_pemesanan->tanggal_tanda_jadi, "H:i:s");
		$timeout				= $data_pemesanan->timeout;
		
		if ($status_pemesanan == "Booked")
		{
			$tanggal_exp		= $this->f_lib->exp_order($timeout, $tanggal_pemesanan, "H:i:s");
		}
		else if ($status_pemesanan == "Tanda Jadi")
		{
			$tanggal_exp		= $this->f_lib->exp_order($timeout, $data_pemesanan->tanggal_tanda_jadi, "H:i:s");
		}
		
		if ($status_pemesanan == "Booked" AND $status_verify == "")
		{
			$data = array("status_verify" => "Verified");
			$this->pemesanan_m->edit($id_pemesanan, $data);
			
			$show_status_verify = "Verified";
			
			$this->access_lib->logging('Verify pemesanan : '.$nomor_pemesanan.' ["Booked" -> "Booked (Verified)"]');
		}
		elseif ($status_pemesanan == "Booked" AND $status_verify == "Verified")
		{
			# Ambil Waktu Default Timeout Untuk Tanda Jadi
			$data_timeout		= $this->timeout_m->get_active_tanda_jadi()->row();
			$timeout			= $data_timeout->timeout;
			$tanggal_tanda_jadi = $this->tanggal;
			
			$data = array(	"status_pemesanan"		=> "Tanda Jadi", 
							"status_verify"			=> "", 
							"tanggal_tanda_jadi"	=> $tanggal_tanda_jadi,
							"timeout"				=> $timeout
							);
			$this->pemesanan_m->edit($id_pemesanan, $data);
			
			$show_status_pemesanan	= "Tanda Jadi";
			$show_status_verify		= "";
			$tanggal_exp			= $this->f_lib->exp_order($timeout, $tanggal_tanda_jadi, "H:i:s");
			$tanggal_tanda_jadi		= $this->f_lib->ubah_format_tanggal($tanggal_tanda_jadi, "H:i:s");
			
			$this->access_lib->logging('Verify pemesanan : '.$nomor_pemesanan.' ["Booked (Verified)" -> "Tanda Jadi"]');
		}
		elseif ($status_pemesanan == "Tanda Jadi" AND $status_verify == "")
		{
			$data = array("status_verify" => "Verified");
			$this->pemesanan_m->edit($id_pemesanan, $data);
			
			$show_status_verify = "Verified";
			
			$this->access_lib->logging('Verify pemesanan : '.$nomor_pemesanan.' ["Tanda Jadi" -> "Tanda Jadi (Verified)"]');
		}
		elseif ($status_pemesanan == "Tanda Jadi" AND $status_verify == "Verified")
		{
			$data = array(	"status_pemesanan"	=> "Sold",
							"tanggal_sold"		=> $this->tanggal);
							
			$this->pemesanan_m->edit($id_pemesanan, $data);
			
			$show_status_pemesanan	= "Sold";
			
			$this->unit_m->update_status_transaksi($id_unit, "Sold");
			
			$this->access_lib->logging('Verify pemesanan : '.$nomor_pemesanan.' ["Tanda Jadi (Verified)" -> "Sold"]');
		}
	
		echo $show_status_pemesanan."|".$show_status_verify."|".$tanggal_exp."|".$tanggal_tanda_jadi;
	}
	
}

/* End of file report.php */
/* Location: ./application/controllers/report.php */