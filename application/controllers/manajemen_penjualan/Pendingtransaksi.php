<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pendingtransaksi extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Pending_Transaksi', 'modelPendingTransaksi');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_penjualan/pending_transaksi/pending_transaksi_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/pending_transaksi/pending_transaksi');
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/pending_transaksi/pending_transaksi_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $database = $this->modelPendingTransaksi->get_data();
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_penjualan'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );

        $output = json_encode($output);
        echo $output;
    }

    public function delete_data($id)
    {
        if (empty($id)) {
        } else {
            $this->modelPendingTransaksi->delete_data($id); // tambah data siswa
        }
    }
}
