<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Returpersediaan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Persediaan/Model_Retur_Persediaan', 'modelReturPersediaan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        // $data['kartu'] = $this->modelReturPersediaan->get_retur_persediaan();
        $data['css'] = 'manajemen_persediaan/retur_persediaan/retur_persediaan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/retur_persediaan/retur_persediaan', $data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_persediaan/retur_persediaan/retur_persediaan_modal');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/retur_persediaan/retur_persediaan_js');
        $this->load->view('template/template_app_js');
    }

    public function get_data()
    {
        $output = $this->modelReturPersediaan->get_retur_persediaan();
    }

    public function get_detail_retur()
    {
        $kode_barang = $this->input->post('kode_barang');
        $database = $this->modelReturPersediaan->get_detail_retur($kode_barang);
        $data = $database->result_array();

        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => 22,
            "data" =>  $data
        );

        $output = json_encode($output);
        echo $output;
    }

    public function get_data_barang()
    {
        $string = $this->input->post('query');
        $database = $this->modelReturPersediaan->get_data_barang($string);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data"  => $database->num_rows(),
            "data" => $data,
        );
        $output = json_encode($output);
        echo $output;
    }
    public function get_detail_barang()

    {
        $kode_barang = $this->input->post('kode_barang');
        $output = $this->modelReturPersediaan->get_detail_barang($kode_barang);
        $output = json_encode($output);
        echo $output;
    }

    public function total_saldo()
    {
        $kode_barang = $this->input->post('kode_barang');
        echo $this->modelReturPersediaan->total_saldo($kode_barang);
    }

    public function push_retur()
    {
        $periode = $this->modelSetting->get_data_periode();
        $post = $this->input->post();
        $this->modelReturPersediaan->push_retur($post, $periode);
    }
}
