<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianBarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Penjualan/Model_Penjualan_Barang', 'modelPenjualan');
        $this->load->model('Manajemen_Penjualan/Model_Invoice', 'modelInvoice');
    }

    public function index()
    {
        $data['css'] = 'manajemen_pembelian/pembelian_barang/pembelian_barang_css';
        $data['title'] = "Pembelian Barang";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_pembelian/pembelian_barang/pembelian_barang', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_pembelian/pembelian_barang/pembelian_barang_js');
        $this->load->view('template/template_app_js');
    }
}
