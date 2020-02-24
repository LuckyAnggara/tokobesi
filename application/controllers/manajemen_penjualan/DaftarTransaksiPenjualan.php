<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DaftarTransaksiPenjualan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Daftar_Transaksi_Penjualan', 'modelDaftarTransaksiPenjualan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_penjualan/daftar_transaksi_penjualan/daftar_transaksi_penjualan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/daftar_transaksi_penjualan/daftar_transaksi_penjualan');
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/daftar_transaksi_penjualan/daftar_transaksi_penjualan_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $post = $this->input->post();
        $database = $this->modelDaftarTransaksiPenjualan->get_data($post);
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



    public function delete_data($no_faktur)
    {
        if (empty($no_faktur)) {
        } else {
            $this->modelDaftarTransaksiPenjualan->delete_data($no_faktur); // tambah data siswa
        }
    }
}
