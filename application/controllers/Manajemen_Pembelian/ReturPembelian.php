<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReturPembelian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('manajemen_pembelian/Model_Retur_Pembelian', 'modelReturPembelian');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_pembelian/retur_pembelian/retur_pembelian_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_pembelian/retur_pembelian/retur_pembelian', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_pembelian/retur_pembelian/retur_pembelian_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $post = $this->input->post();
        $output = $this->modelReturPembelian->get_data($post);
        $output = $output = json_encode($output);
        echo $output;
    }

    public function getDetailData()
    {
        $post = $this->input->post();
        $output = $this->modelReturPembelian->get_detail_data($post);
        $output = $output = json_encode($output);
        echo $output;
    }

    public function tambahdatamaster()
    {
        $post = $this->input->post();
        $this->modelReturPembelian->tambah_data_master($post);
    }

    public function tambahdatadetail()
    {
        $post = $this->input->post();
        $this->modelReturPembelian->tambah_data_detail($post);
    }



    // daftar retur

    public function daftar_retur()
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_pembelian/retur_pembelian/daftar_retur_pembelian/daftar_retur_pembelian_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_pembelian/retur_pembelian/daftar_retur_pembelian/daftar_retur_pembelian', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_pembelian/retur_pembelian/daftar_retur_pembelian/daftar_retur_pembelian_js');
        $this->load->view('template/template_app_js');
    }



    public function getDataRetur()
    {
        $post = $this->input->post();
        $database = $this->modelReturPembelian->get_data_retur($post);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_retur_pembelian'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $key => $value) {
            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }


    function faktur($nomor_transaksi)
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['data_order'] = $this->modelReturPembelian->get_data_faktur($nomor_transaksi);
        $data['detail_order'] = $this->modelReturPembelian->get_detail_faktur($nomor_transaksi);
        $data['css'] = 'manajemen_pembelian/retur_pembelian/faktur_retur/faktur_retur_css';
        $data['title'] = "Cetak Faktur";
        if (!isset($data['data_order']['nomor_transaksi'])) {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('template/template_page_not_found');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        } else {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('manajemen_pembelian/retur_pembelian/faktur_retur/faktur_retur', $data);
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function delete_faktur()
    {
        $nomor_transaksi = $this->input->post('nomor_transaksi');
        $this->modelReturPembelian->delete_data($nomor_transaksi);
    }
}
