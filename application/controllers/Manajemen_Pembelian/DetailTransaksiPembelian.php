<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DetailTransaksiPembelian extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Pembelian/Model_Detail_Transaksi_Pembelian', 'modelDetailTransaksiPembelian');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
    }


    public function nomor_transaksi($nomor_transaksi)
    {
        $data['data_order'] = $this->modelDetailTransaksiPembelian->get_data($nomor_transaksi);
        $data['detail_order'] = $this->modelDetailTransaksiPembelian->get_detail($nomor_transaksi);
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_pembelian/detail_transaksi_pembelian/detail_transaksi_pembelian_css';

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
            $this->load->view('manajemen_pembelian/detail_transaksi_pembelian/detail_transaksi_pembelian', $data);
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        }
    }
}
