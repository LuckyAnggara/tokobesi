<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PembelianBarang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Penjualan/Model_Penjualan_Barang', 'modelPenjualan');
        $this->load->model('Manajemen_Pembelian/Model_Pembelian_Barang', 'modelPembelianBarang');
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

    public function get_data_supplier()
    {
        $data = $this->modelPembelianBarang->get_data_supplier();
        $output = json_encode($data);
        echo $output;
    }

    public function get_data_barang($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelPenjualan->get_data_barang($string);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_data_barang_versi_select2()
    {
        $string = $this->input->post('search_term');
        $database = $this->modelPenjualan->get_data_barang($string);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }

    public function push_data_barang()
    {
        $post = $this->input->post();
        $this->modelPembelianBarang->push_data_barang($post);
    }

    public function get_data_keranjang($no_order_pembelian)
    {
        $database = $this->modelPembelianBarang->get_data_keranjang($no_order_pembelian);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }
}
