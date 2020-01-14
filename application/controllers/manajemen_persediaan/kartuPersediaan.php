<?php
defined('BASEPATH') or exit('No direct script access allowed');

class KartuPersediaan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Persediaan/Model_Persediaan_Barang', 'modelPersediaan');
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
        $this->load->view('manajemen_persediaan/kartu_persediaan/kartu_persediaan_js');
        $this->load->view('template/template_app_js');
    }

    public function get_data($string)
    {
        $output = $this->modelPersediaan->get_detail($string);
        $output = json_encode($output);
        echo $output;
    }
}