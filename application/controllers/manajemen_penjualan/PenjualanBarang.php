<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanBarang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ssp');
        $this->load->library('datatables');
        $this->load->model('manajemen_penjualan/modelPenjualanBarang', 'modelPenjualan');
        // $this->load->model('manajemen_barang/modelDetailpersediaan', 'detailpersediaan');
    }

    public function index()
    {
        $this->clear_keranjang_belanja();
        //$data['satuan'] = $this->modelBarang->get_data_satuan();
        $data['css'] = 'manajemen_penjualan/penjualan_barang/penjualan_barang_css';
        $data['title'] = "Penjualan Barang";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/penjualan_barang/penjualan_barang');
        $this->load->view('template/template_right');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/penjualan_barang/penjualan_barang_js');
        $this->load->view('template/template_app_js');
    }

    public function get_data_pelanggan($id_pelanggan)
    {
        $data = $this->modelPenjualan->get_data_by_id($id_pelanggan);
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

    public function clear_keranjang_belanja()
    {
        $this->db->query('Delete FROM tabel_keranjang');
        $this->db->query('alter TABLE tabel_keranjang AUTO_INCREMENT = 1');
    }
    public function push_data_barang()
    {
        $this->modelPenjualan->push_data_barang();
    }

    public function get_data_keranjang()
    {
        $database = $this->modelPenjualan->get_data_keranjang();
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_sum_keranjang()
    {
        $this->db->select_sum('harga_total');
        $output = $this->db->get('tabel_keranjang')->row();
        $output = json_encode($output);
        echo $output;
    }
}
