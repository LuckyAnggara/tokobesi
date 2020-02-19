<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReturPenjualan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Retur_Penjualan', 'modelReturPenjualan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_penjualan/retur_penjualan/retur_penjualan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/retur_penjualan/retur_penjualan', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/retur_penjualan/retur_penjualan_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $post = $this->input->post();
        $output = $this->modelReturPenjualan->get_data($post);
        $output = $output = json_encode($output);
        echo $output;
    }

    public function getDetailData()
    {
        $post = $this->input->post();
        $output = $this->modelReturPenjualan->get_detail_data($post);
        $output = $output = json_encode($output);
        echo $output;
    }
}
