<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ajax extends CI_Controller
{
	
	var $tanggal;
	
	function __Construct()
	{
		parent::__Construct();
		
		$this->access_lib->is_login();
		
	}
	
	function index()
	{
		
	}
	
	# Menampilkan list data type
	function list_option_type($id_cluster)
	{
		$this->load->model('type_m');
		$type = $this->type_m->get_by_cluster($id_cluster)->result();
		
		$opt = '<option value=""> -- Pilih Type -- </option>';
		if($type)
		{
			foreach($type as $data_type)
			{
				$opt .= '<option value="'.$data_type->id_type.'" data-kode-blok="'.$data_type->kode_blok.'">'.$data_type->nama_type.'</option>';
			}
		}
		
		print $opt;
		
	}
	
	# Menampilkan list data type Filter unit
	function list_option_type_filter($id_cluster)
	{
		$this->load->model('type_m');
		$type = $this->type_m->get_by_cluster($id_cluster)->result();
		
		$opt = '<option value=""> -- Type -- </option>';
		if($type)
		{
			foreach($type as $data_type)
			{
				$opt .= '<option value="'.$data_type->id_type.'">'.$data_type->nama_type.'</option>';
			}
		}
		
		print $opt;
		
	}
	
	# Menampilkan list data type
	function list_option_unit($id_cluster, $id_siteplan ,$id_unit = "")
	{
		$this->load->model('siteplan_m');
		$unit = $this->siteplan_m->get_unit_opt($id_cluster, $id_siteplan)->result();
		
		$opt = '<option value=""> -- Pilih Unit -- </option>';
		if($unit)
		{
			$cek = "";
			$sel = "";
			foreach($unit as $data_unit)
			{
				if ($data_unit->coords != "")
				{
					$cek = "&radic;";
				}
				if ($data_unit->id_unit == $id_unit)
				{
					$sel = 'selected="selected"';
				}
				$opt .= '<option value="'.$data_unit->id_unit.'" data-coords="'.$data_unit->coords.'" '.$sel.' >'.$data_unit->kode_unit.' &nbsp; '.$cek.'</option>';
				$cek = "";
				$sel = "";
			}
		}
		
		print $opt;
		
	}
	
	# Menampilkan list data type
	function get_unit_promo_opt($id_cluster, $id_promo)
	{
		$this->load->model('promo_m');
		$unit = $this->promo_m->get_unit_promo_opt($id_cluster, $id_promo)->result();
		
		$opt = '<option value="" data-type=""> -- Pilih Unit -- </option>';
		if($unit)
		{
			foreach($unit as $data_unit)
			{
				$opt .= '<option value="'.$data_unit->id_unit.'" data-type="'.$data_unit->nama_type.' '.$data_unit->posisi.'" data-diskon-tanah="'.$data_unit->diskon_tanah.'" data-diskon-bangunan="'.$data_unit->diskon_bangunan.'">'.$data_unit->kode_unit.'</option>';
			}
		}
		
		print $opt;
		
	}
	
	# Menampilkan list data type
	function list_option_sales($id_agent)
	{
		$this->load->model('user_m');
		$user = $this->user_m->get_by_id_agent($id_agent)->result();
		
		$opt = '<option value=""> -- Sales -- </option>';
		if($user)
		{
			foreach($user as $data_user)
			{
				$opt .= '<option value="'.$data_user->id_user.'">'.$data_user->nama_lengkap.'</option>';
			}
		}
		
		print $opt;
		
	}
	
}

# End of file type.php
# Location: ./applicaion/controller/type.php