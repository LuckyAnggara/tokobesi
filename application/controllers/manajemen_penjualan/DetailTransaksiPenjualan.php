<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailTransaksiPenjualan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Detail_Transaksi_Penjualan', 'modelDetailTransaksiPenjualan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
    }

    public function nomor_faktur($no_faktur)
    {
        $data['data_order'] = $this->modelDetailTransaksiPenjualan->get_data($no_faktur);
        $data['detail_order'] = $this->modelDetailTransaksiPenjualan->get_detail($no_faktur);
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_penjualan/detail_transaksi_penjualan/detail_transaksi_penjualan_css';

        if (!isset($data['data_order']['no_faktur'])) {
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
            $this->load->view('manajemen_penjualan/detail_transaksi_penjualan/detail_transaksi_penjualan', $data);
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        }
    }
}
