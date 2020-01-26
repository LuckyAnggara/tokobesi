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
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['no_order_pembelian'] = $this->_generateNomor();
        $data['css'] = 'manajemen_pembelian/pembelian_barang/pembelian_barang_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['title'] = "Pembelian Barang";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_pembelian/pembelian_barang/pembelian_barang', $data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_pembelian/pembelian_barang/pembelian_barang_modal', $data);
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_pembelian/pembelian_barang/pembelian_barang_js');
        $this->load->view('template/template_app_js');
    }

    private function _generateNomor()
    {
        return random_string('alnum', 16);
    }

    public function clear_keranjang_pembelian($no_order_lama)
    {
        $this->modelPembelianBarang->get_data_keranjang_clear($no_order_lama);
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
        $this->modelPembelianBarang->push_data_barang();
    }

    function push_total_perhitungan()
    {
        $post = $this->input->post();
        $this->modelPembelianBarang->push_total_perhitungan($post);
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

    public function delete_data_keranjang($id)
    {
        if (empty($id)) {
        } else {
            $this->modelPembelianBarang->delete_data_keranjang($id); // delete data
        }
    }

    public function get_sum_keranjang($no_order)
    {

        $output = $this->modelPembelianBarang->get_sum_keranjang($no_order);
        $output = json_encode($output);
        echo $output;
    }

    public function push_grand_total()
    {
        $post = $this->input->post();
        $this->modelPembelianBarang->push_grand_total($post);
    }

    function get_total_perhitungan($no_order)
    {
        $data = $this->modelPembelianBarang->get_total_perhitungan($no_order);
        $output = json_encode($data);
        echo $output;
    }

    function proses_tunai()
    {

        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('master_pembelian');
        $this->db->where('nomor_transaksi', $post['nomor_transaksi']);
        $cek = $this->db->get()->num_rows();
        if ($cek > 0) {
            echo "1";
        } else {
            $this->modelPembelianBarang->proses_tunai($post);
        }
    }

    function proses_kredit()
    {

        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('master_pembelian');
        $this->db->where('nomor_transaksi', $post['nomor_transaksi']);
        $cek = $this->db->get()->num_rows();
        if ($cek > 0) {
            echo "1";
        } else {
            $this->modelPembelianBarang->proses_kredit($post);
        }
    }
}
