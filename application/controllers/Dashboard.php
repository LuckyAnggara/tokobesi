<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Setting/Model_Setting', 'modelSetting');
		$this->load->model('Manajemen_Penjualan/Model_Daftar_Transaksi_Penjualan', 'modelDaftarTransaksiPenjualan');
		$this->load->model('Dashboard/Model_Dashboard', 'modelDashboard');
		$this->load->model('Dashboard/Model_Dashboard_Kasir', 'modelDashboardKasir');
		$this->load->model('Dashboard/Model_Dashboard_Admin', 'modelDashboardAdmin');
		if ($this->session->userdata('status') != "login") {
			redirect(base_url("login"));
		}
	}


	// dashboard manajer
	public function data()
	{
		$data['transaksi'] = $this->modelDashboard->data_transaksi(date("Y-m-d"));
		$data['total_penjualan'] = $this->modelDashboard->data_penjualan(date("Y-m-d"));
		$data['total_pembelian'] = $this->modelDashboard->data_pembelian(date("Y-m-d"));
		$data['total_produk_terjual'] = $this->modelDashboard->data_produk_terjual(date("Y-m-d"));
		$data['trend_transaksi'] = $this->modelDashboard->trend_transaksi(date("Y-m-d"));
		$data['trend_penjualan'] = $this->modelDashboard->trend_penjualan(date("Y-m-d"));
		$data['trend_pembelian'] = $this->modelDashboard->trend_pembelian(date("Y-m-d"));
		$data['trend_produk_terjual'] = $this->modelDashboard->trend_produk_terjual(date("Y-m-d"));
		$data['dropdown_penjualan'] = $this->modelDashboard->dropdown_penjualan();
		$data['dropdown_pembelian'] = $this->modelDashboard->dropdown_pembelian();
		$data['dropdown_produk_terjual'] = $this->modelDashboard->dropdown_produk_terjual();
		$data['dropdown_transaksi_penjualan'] = $this->modelDashboard->dropdown_transaksi_penjualan();

		$output = json_encode($data);
		echo $output;
	}

	public function top_sales()
	{
		$bulan = $this->input->post('bulan');
		$data = $this->modelDashboard->data_top_sales($bulan);

		foreach ($data as $key => $value) {
			$data[$key]['detail'] = $this->modelDashboard->detail_sales($value['sales']);
		}

		$output = json_encode($data);
		echo $output;
	}


	public function data_penjualan_terakhir()
	{
		$database = $this->modelDashboard->get_data_penjualan_terakhir(date("Y-m-d 00-00-00"));
		$data = $database->result_array();
		$output = array(
			// "draw" => $_POST['draw'],
			"recordsTotal" => $this->db->count_all_results('master_penjualan'),
			"recordsFiltered"  => $database->num_rows(),
			"data" => array()
		);

		foreach ($data as $key => $value) {
			if ($value['status_bayar'] == 0) {
				$data =  $this->modelDaftarTransaksiPenjualan->get_data_kredit($value['no_faktur']);
				$value['kredit'] = $data;
				$output['data'][] = $value;
			} else {
				$value['kredit'] = "";
				$output['data'][] = $value;
			}
		}

		$output = json_encode($output);
		echo $output;
	}

	function data_total_laba()
	{
		$bulan = $this->input->post('bulan');
		$tahun = $this->input->post('tahun');


		$data['label'] = $this->modelDashboard->calendar($bulan, $tahun);

		foreach ($data['label'] as $key => $value) {
			$data['total'][] = $this->modelDashboard->get_data_laba_total($value, $bulan, $tahun);
			$data['harian'][] = $this->modelDashboard->get_data_laba_harian($value, $bulan, $tahun);
		}

		$output = json_encode($data);
		echo $output;
	}

	function data_top_produk()
	{
		$option = $this->input->post('option');
		$data = $this->modelDashboard->topProduk($option);
		if ($data == null) {
			$dataset['nama_barang'][] = "belum ada data";
			$dataset['jumlah_penjualan'][] = 0;
		} else {
			foreach ($data as $key => $value) {
				$dataset['nama_barang'][] = $value['nama_barang'];
				$dataset['jumlah_penjualan'][] = $value['jumlah_penjualan'];
			}
		}
		$output = json_encode($dataset);
		echo $output;
	}

	function data_produktifitas_sales()
	{
		$kode_sales = $this->input->post('kode_sales');
		$data = $this->modelDashboard->data_produktifitas_sales($kode_sales);
		if ($data == null) {
			$dataset['bulan'][] = "belum ada data";
			$dataset['value'][] = 0;
		} else {
			foreach ($data as $key => $value) {
				$dataset['bulan'][] = $value['bulan'];
				$dataset['value'][] = $value['total_penjualan'] / 1000000;
			}
		}

		$output = json_encode($dataset);
		echo $output;
	}


	function cek()
	{
		$data = $this->modelDashboard->data_produktifitas_sales('lucky15');
		$output = json_encode($data);
		echo $output;
	}

	public function cek2($no_faktur)
	{
		$data = $this->modelDashboard->cari_harga_pokok($no_faktur);
		$output = json_encode($data);
		echo $output;
	}

	// dashboard kasir
	public function data_penjualan_terakhir_kasir()
	{
		$database = $this->modelDashboardKasir->get_data_penjualan_terakhir();
		$data = $database->result_array();
		$output = array(
			// "draw" => $_POST['draw'],
			"recordsTotal" => $this->db->count_all_results('master_penjualan'),
			"recordsFiltered"  => $database->num_rows(),
			"data" => array()
		);

		foreach ($data as $key => $value) {
			if ($value['status_bayar'] == 0) {
				$data =  $this->modelDaftarTransaksiPenjualan->get_data_kredit($value['no_faktur']);
				$value['kredit'] = $data;
				$output['data'][] = $value;
			} else {
				$value['kredit'] = "";
				$output['data'][] = $value;
			}
		}

		$output = json_encode($output);
		echo $output;
	}

	// dashboard admin

	public function getDataPendingPO()
	{
		$post = $this->input->post();
		$database = $this->modelDashboardAdmin->get_data_po();
		$data = $database->result_array();
		$output = array(
			// "draw" => $_POST['draw'],
			"recordsTotal" => $this->db->count_all_results('master_penjualan'),
			"recordsFiltered"  => $database->num_rows(),
			"data" => array()
		);

		foreach ($data as $key => $value) {
			$sales =  $this->modelDashboardAdmin->data_sales($value['sales']);
			$admin =  $this->modelDashboardAdmin->data_admin($value['admin']);
			$pelanggan =  $this->modelDashboardAdmin->data_pelanggan($value['id_pelanggan']);

			$value['sales'] = $sales;
			$value['admin'] = $admin;
			$value['pelanggan'] = $pelanggan;

			$output['data'][] = $value;
		}

		$output = json_encode($output);
		echo $output;
	}

	public function data_pembelian_terakhir()
	{
		$post = $this->input->post();
		$database = $this->modelDashboardAdmin->get_data($post);
		$data = $database->result_array();
		$output = array(
			// "draw" => $_POST['draw'],
			"recordsTotal" => $this->db->count_all_results('master_pembelian'),
			"recordsFiltered"  => $database->num_rows(),
			"data" => array()
		);

		foreach ($data as $key => $value) {
			if ($value['status_bayar'] == 0) {
				$data =  $this->modelDashboardAdmin->get_data_kredit($value['nomor_transaksi']);
				$value['kredit'] = $data;
				$output['data'][] = $value;
			} else {
				$value['kredit'] = "";
				$output['data'][] = $value;
			}
		}

		$output = json_encode($output);
		echo $output;
	}


	// VIEW
	public function index()
	{
		if ($this->session->userdata('role') == "1") {
			redirect(base_url("dashboard/kasir"));
		}
		if ($this->session->userdata('role') == "2") {
			redirect(base_url("dashboard/admin"));
		}
		if ($this->session->userdata('role') == "3") {
			redirect(base_url("dashboard/sales"));
		}
		if ($this->session->userdata('role') == "4") {
			redirect(base_url("dashboard/supervisor"));
		}
		if ($this->session->userdata('role') == "5") {
			redirect(base_url("dashboard/manajer"));
		}
	}

	public function kasir()
	{
		$data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
		$data['menu'] = $this->modelSetting->data_menu();
		$data['css'] = 'dashboard/kasir/dashboard_css';
		if ($this->session->userdata('role') != "1") {
			redirect(base_url("dashboard"));
		} else {

			$this->load->view('template/template_header', $data);
			$this->load->view('template/template_menu', $data);
			$this->load->view('dashboard/kasir/dashboard', $data);
			$this->load->view('template/template_right');
			$this->load->view('template/template_footer');
			$this->load->view('template/template_js');
			$this->load->view('dashboard/kasir/dashboard_js');
			$this->load->view('template/template_app_js');
		}
	}

	public function admin()
	{
		$data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
		$data['menu'] = $this->modelSetting->data_menu();
		$data['css'] = 'dashboard/admin/dashboard_css';
		if ($this->session->userdata('role') != "2") {
			redirect(base_url("dashboard"));
		} else {

			$this->load->view('template/template_header', $data);
			$this->load->view('template/template_menu', $data);
			$this->load->view('dashboard/admin/dashboard', $data);
			$this->load->view('template/template_right');
			$this->load->view('template/template_footer');
			$this->load->view('template/template_js');
			$this->load->view('dashboard/admin/dashboard_js');
			$this->load->view('template/template_app_js');
		}
	}

	public function manajer()
	{

		$data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
		$data['menu'] = $this->modelSetting->data_menu();

		$data['css'] = 'dashboard/manajer/dashboard_css';

		if ($this->session->userdata('role') != "5") {
			redirect(base_url("dashboard"));
		} else {

			$data['sales'] = $this->modelDashboard->getDataSales();
			$this->load->view('template/template_header', $data);
			$this->load->view('template/template_menu', $data);
			$this->load->view('dashboard/manajer/dashboard', $data);
			$this->load->view('template/template_right');
			$this->load->view('template/template_footer');
			$this->load->view('template/template_js');
			$this->load->view('dashboard/manajer/dashboard_js');
			$this->load->view('template/template_app_js');
		}
	}
}
