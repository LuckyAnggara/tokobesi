<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterSupplier extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Data/Model_Master_Supplier', 'modelSupplier');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['css'] = 'manajemen_data/master_supplier/master_supplier_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_data/master_supplier/master_supplier');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_data/master_supplier/master_supplier_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_data/master_supplier/master_supplier_js');
        $this->load->view('template/template_app_js');
    }

    public function getData($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelSupplier->get_data($string);
        $data = $database->result_array();
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );

        $output = json_encode($output);
        echo $output;
    }
    // Generate Kode Barang Automatic
    public function cekData($string)
    {
        $noUrut = $this->modelSupplier->cekData($string);
        $noUrut++;
        echo sprintf("%03s", $noUrut);
    }

    public function generate_kode_supplier()
    {
        echo $this->modelSupplier->get_kode_supplier();
    }

    // Tambah Data

    public function tambah_data()
    {
        $this->modelSupplier->tambah_data();
    }

    public function view_edit_data($kode_barang)
    {
        $data = $this->modelSupplier->view_edit_data($kode_barang);
        $output = json_encode($data);
        echo $output;
    }

    public function edit_data($kode_barang)
    {
        $this->modelSupplier->edit_data($kode_barang);
    }

    public function delete_data($kode_barang)
    {
        if (empty($kode_barang)) {
        } else {
            $this->modelSupplier->delete_data($kode_barang); // tambah data siswa
        }
    }

    // ambil data satuan

    public function get_data_satuan()
    {
        $data =  $this->modelSupplier->get_data_satuan();
        return $data;
    }
}
