<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Scheduler extends CI_Controller
{
	
	function __Construct()
	{
		parent::__Construct();
		date_default_timezone_set("Asia/Jakarta");
	}
	
	# Menghapus data unit yang berhubungan dengan siteplan
	function unlock()
	{		
		$this->load->model('unit_m');
		$this->load->model('timeout_m');
		
		$found = '';
		$timeout = $this->timeout_m->get_active_locked()->row()->timeout;
		$data_unit = $this->unit_m->scheduler_unlock();
		foreach ($data_unit AS $u)
		{
			$diff = (time() - strtotime($u->tanggal_locked));
			if ($diff > $timeout)
			{
				$this->unit_m->unlock($u->id_unit);
				$found = 'found';
			}
		}
		
		echo $found;
	}
	
	# Update Pemesanan Timeout Status Pemesanan = "Tanda Jadi" dan status verify =  ""
	# Update Pemesanan Timeout Status Pemesanan = "Booked" dan status verify =  ""
	# Interval Javascript
	function timeout()
	{
		$this->load->library('f_lib');
		
		$found = "";
		$now = time();
		
		$this->load->model('pemesanan_m');
		$this->load->model('unit_m');
		$data_pemesanan = $this->pemesanan_m->scheduler_timeout()->result();
		
		foreach ($data_pemesanan AS $p)
		{
			if ($p->status_pemesanan == "Booked")
			{
				$exp = $this->f_lib->exp_order($p->timeout, $p->tanggal_pemesanan);
			}
			elseif ($p->status_pemesanan == "Tanda Jadi")
			{
				$exp = $this->f_lib->exp_order($p->timeout, $p->tanggal_tanda_jadi);
			}
			
			$diff = $now-$exp;
			if ($diff > 0)
			{
				$this->pemesanan_m->edit($p->id_pemesanan, array("status_data" => "timeout"));
				$this->unit_m->update_status_transaksi($p->id_unit, "");
				$found = "found";
			}
		}
		
		echo $found;
		
	}
	
	function promo()
	{
		$found = "";
		$now = time();
		echo  $now ;
		$this->load->model('promo_m');
		$data_promo = $this->promo_m->get_active_promo()->result();
		
		foreach ($data_promo AS $p)
		{
			$tanggal_mulai = strtotime($p->tanggal_mulai);
			$tanggal_akhir = strtotime($p->tanggal_akhir);
			
			if ( (($tanggal_mulai-$now) > 0) OR (($tanggal_akhir-$now) < 0) )
			{
				$this->promo_m->update($p->id_promo, array('status_promo' => '0'));
				$found = "found";
			}
		}
		
		echo $found;
		
	}
	
	
	
}

# End of file user.php
# Location: ./applicaion/controller/user.php