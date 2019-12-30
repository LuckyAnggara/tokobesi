<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterBarang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ssp');
        $this->load->library('datatables');
        $this->load->model('manajemen_barang/modelMasterBarang', 'modelBarang');
        $this->load->model('manajemen_barang/modelDetailStock', 'detailStock');
    }

    public function index()
    {
        $data['css'] = $this->load->view('manajemen_barang/master_barang/master_barang_css');
        $data['title'] = "Master Data Barang";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_barang/master_barang/master_barang');
        $this->load->view('template/template_right');
        $this->load->view('template/template_js');
        $this->load->view('template/template_app_js');
        $this->load->view('manajemen_barang/master_barang/master_barang_js');

        // $this->load->view('manajemen_barang/master_stock/master_stock_js');   
    }

    public function getData($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelBarang->get_data($string);

        $data = $database->result_array();
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" =>  $data
        );


        $output = json_encode($output);
        echo $output;
    }

    // Generate Kode Barang Automatis
    public function cekData($string)
    {
        $cek = $this->modelBarang->cekData($string);
        // echo $cek;

        if ($cek < 10) {
            $cek = $cek + 1;
            echo "00" . $cek;
        } else if ($cek > 10) {
            $cek = $cek + 1;
            echo "0" . $cek;
        } else if ($cek > 99) {
            echo $cek + 1;
        }
    }

    // Tambah Data

    public function tambah_data()
    {
        $this->modelBarang->tambah_data();
    }
}
