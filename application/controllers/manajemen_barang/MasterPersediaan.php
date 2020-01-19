<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterPersediaan extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Manajemen_Barang/Model_Master_Persediaan', 'modelpersediaan');
		$this->load->model('Manajemen_Barang/Model_Detail_Persediaan', 'detailpersediaan');
		$this->load->model('Setting/Model_Setting', 'modelSetting');
	}

	public function index()
	{
		$data['css'] = 'manajemen_barang/master_persediaan/master_persediaan_css';
		$data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
		$this->load->view('template/template_header', $data);
		$this->load->view('template/template_menu');
		$this->load->view('manajemen_barang/master_persediaan/master_persediaan');
		$this->load->view('template/template_right');
		$this->load->view('template/template_js');
		$this->load->view('template/template_app_js');
		$this->load->view('manajemen_barang/master_persediaan/master_persediaan_js');
	}

	public function cek($kode_barang)
	{
		$data = $this->detailpersediaan->get_data($kode_barang);

		print_r($data);
	}

	public function Detail_persediaan($kode_barang)
	{
		$data['persediaan'] = $this->detailpersediaan->get_data($kode_barang);
		$data['css'] = $this->load->view('manajemen_barang/master_persediaan/master_persediaan_css');
		$data['title'] = "Detail persediaan Barang dengan Kode : " . $kode_barang;
		$this->load->view('template/template_header', $data);
		$this->load->view('template/template_menu');
		$this->load->view('manajemen_barang/master_persediaan/detail_persediaan', $data);
		$this->load->view('template/template_right');
		$this->load->view('template/template_js');
		$this->load->view('template/template_app_js');
		$this->load->view('manajemen_barang/master_persediaan/detail_persediaan_js');
		//$this->load->view('manajemen_barang/master_persediaan/master_persediaan_js');
	}

	public function getDataV2()
	{
		echo $this->modelpersediaan->get_data_all();
	}

	public function getData($string = null)
	{
		$string = str_replace("%20", " ", $string);
		$database = $this->modelpersediaan->get_data($string);

		$data = $database->result_array();
		$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->db->count_all_results(),
			"recordsFiltered"  => $database->num_rows(),
			"data" =>  $data
		);


		$output = json_encode($output);
		echo $output;
	}
}
