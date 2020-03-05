<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laba extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laba', 'modelLaba');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data = [
            'penjualan_bersih' => $this->penjualan_bersih(),
            'retur_penjualan' => $this->retur_penjualan(),
            'harga_pokok_penjualan' => $this->harga_pokok_penjualan(),
            'laba_kotor' => $this->laba_kotor(),
        ];
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'laporan/laba/laba_css';
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/laba/laba', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('template/template_app_js');
    }

    function penjualan_bersih()
    {
        return $this->modelLaba->penjualan_bersih();
    }

    function retur_penjualan()
    {
        return $this->modelLaba->retur_penjualan();
    }

    function harga_pokok_penjualan()
    {
        return $this->modelLaba->harga_pokok_penjualan();
    }

    function laba_kotor()
    {
        $penjualan_bersih = $this->penjualan_bersih();
        $retur_penjualan = $this->retur_penjualan();
        $harga_pokok_penjualan = $this->harga_pokok_penjualan();

        return $penjualan_bersih - $retur_penjualan - $harga_pokok_penjualan;
    }
}
