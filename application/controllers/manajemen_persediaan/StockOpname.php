<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StockOpname extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('manajemen_persediaan/Model_Master_Persediaan', 'modelMasterPersediaan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['css'] = 'manajemen_persediaan/stock_opname/stock_opname_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/stock_opname/stock_opname');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_persediaan/stock_opname/stock_opname_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/stock_opname/stock_opname_js');
        $this->load->view('template/template_app_js');
    }


    public function tambah_data()
    {
        $data['css'] = 'manajemen_persediaan/stock_opname/tambah_data/tambah_stock_opname_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/stock_opname/tambah_data/tambah_stock_opname');
        $this->load->view('template/template_right');
        // $this->load->view('manajemen_persediaan/stock_opname/stock_opname_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/stock_opname/tambah_data/tambah_stock_opname_js');
        $this->load->view('template/template_app_js');
    }

    public function getDataStockOpname()
    {
        $database = $this->modelMasterPersediaan->getDataStockOpname();
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($dataBarang as $key => $value) {

            $data_barang = $this->modelMasterPersediaan->dataBarang($value['kode_barang']);
            $saldo_buku = $this->modelMasterPersediaan->saldoBuku($value['kode_barang']);

            $value['data_barang'] = $data_barang;
            $value['saldo_buku'] = $saldo_buku;
            $value['saldo_fisik'] = "0";
            $value['selisih'] = $saldo_buku - $value['saldo_fisik'];

            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }

    public function random_ref(){
        $number = $this->modelMasterPersediaan->random_ref();
        $output =  "REF#" . $number;
        $output = json_encode($output);
        echo $output;
    }
}
