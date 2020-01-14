<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KartuPersediaan extends CI_Controller
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
        $data['css'] = 'manajemen_persediaan/kartu_persediaan/kartu_persediaan_css';
        $data['title'] = "Kartu Persediaanhyg";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/kartu_persediaan/kartu_persediaan', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_js');
        // $this->load->view('manajemen_persediaan/kartu_persediaan/kartu_persediaan_js');
        $this->load->view('template/template_app_js');
    }
}