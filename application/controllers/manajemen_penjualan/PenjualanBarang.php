<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PenjualanBarang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ssp');
        $this->load->library('datatables');
        $this->load->helper('string');
        $this->load->model('manajemen_penjualan/modelPenjualanBarang', 'modelPenjualan');
    }

    public function init_setting(){

        $this->session->unset_userdata('no_order_dummy');
        $no_order_dummy = random_string('numeric',10);
        $this->session->set_userdata('no_order_dummy', $no_order_dummy);
        
    }
    public function clear_keranjang_belanja($no_order)
    {
        $this->modelPenjualan->get_data_keranjang_clear($no_order);
    }

    public function cekcek(){
        $this->init_setting();
        echo $this->session->userdata('reset_keranjang_no_order');
    }

    public function index()
    {
        $this->init_setting();
        $data['no_order'] = $this->session->userdata('no_order_dummy');
        $data['css'] = 'manajemen_penjualan/penjualan_barang/penjualan_barang_css';
        $data['title'] = "Penjualan Barang";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/penjualan_barang/penjualan_barang',$data);
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

    public function push_data_barang()
    {
        $this->modelPenjualan->push_data_barang();
    }

    public function get_data_keranjang($no_order)
    {
        $database = $this->modelPenjualan->get_data_keranjang($no_order);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_sum_keranjang($no_order)
    {
        if(empty($no_order))
        {
            $output = array(
            "harga_total" => '0'
        );
        $output = json_encode($output);
        echo $output;

        }else{
        $this->db->select_sum('harga_total');
        $this->db->where('no_order',$no_order);
        $output = $this->db->get('tabel_keranjang_temp')->row();
        $output = json_encode($output);
        echo $output;
        }
    }

    public function delete_data_keranjang($id)
    {
        if (empty($id)) {
        } else {
            $this->modelPenjualan->delete_data_keranjang($id); // delete data
        }
    }

    public function persediaan_temp_tambah(){
        $this->modelPenjualan->persediaan_temp_tambah();
    }

    public function persediaan_temp_batal(){
        $this->modelPenjualan->persediaan_temp_batal();
    }

    public function set_last_no_order($no_order)
    {
        $this->session->set_userdata('reset_keranjang_'.$no_order, $no_order);
    }

    // checkout penjualan

    public function checkout_order($no_order)
    {
        $data['css'] = 'manajemen_penjualan/penjualan_barang/penjualan_barang_css';
        $data['title'] = "Checkout Order";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/checkout_order/checkout_order',$data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/penjualan_barang/penjualan_barang_js');
        $this->load->view('template/template_app_js');
    }
}
