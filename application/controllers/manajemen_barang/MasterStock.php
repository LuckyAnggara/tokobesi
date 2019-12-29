<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterStock extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->library('ssp');
		$this->load->library('datatables');
		$this->load->model('manajemen_barang/modelMasterStock', 'modelStock');
		$this->load->model('manajemen_barang/modelDetailStock', 'detailStock');
	}

	public function index()
	{
		$data['css'] = $this->load->view('manajemen_barang/master_stock/master_stock_css');
		$data['title'] = "Master Persediaan Barang";
		$this->load->view('template/template_header', $data);
		$this->load->view('template/template_menu');
		$this->load->view('manajemen_barang/master_stock/master_stock');
		$this->load->view('template/template_right');
		$this->load->view('template/template_js');
		$this->load->view('template/template_app_js');
		$this->load->view('manajemen_barang/master_stock/master_stock_js');
	}

	public function cek($kode_barang)
	{
		$data = $this->detailStock->get_data($kode_barang);

		print_r($data);
	}

	public function Detail_Stock($kode_barang)
	{
		$data['stock'] = $this->detailStock->get_data($kode_barang);
		$data['css'] = $this->load->view('manajemen_barang/master_stock/master_stock_css');
		$data['title'] = "Detail Stock Barang dengan Kode : " . $kode_barang;
		$this->load->view('template/template_header', $data);
		$this->load->view('template/template_menu');
		$this->load->view('manajemen_barang/master_stock/detail_stock', $data);
		$this->load->view('template/template_right');
		$this->load->view('template/template_js');
		$this->load->view('template/template_app_js');
		$this->load->view('manajemen_barang/master_stock/detail_stock_js');
		//$this->load->view('manajemen_barang/master_stock/master_stock_js');
	}

	public function getDataV2()
	{
		echo $this->modelStock->get_data_all();
	}

	public function getData($string = null)
	{
		$string = str_replace("%20", " ", $string);
		$database = $this->modelStock->get_data($string);

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
