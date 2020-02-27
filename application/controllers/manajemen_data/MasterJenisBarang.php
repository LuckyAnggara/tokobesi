<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterjenisbarang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Data/Model_Master_Jenis_Barang', 'modelJenis_Barang');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_data/master_jenis_barang/master_jenis_barang_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_data/master_jenis_barang/master_jenis_barang');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_data/master_jenis_barang/master_jenis_barang_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_data/master_jenis_barang/master_jenis_barang_js');
        $this->load->view('template/template_app_js');
    }

    public function getData($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelJenis_Barang->get_data($string);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );

        $output = json_encode($output);
        echo $output;
    }
    // Cek Duplikat Data
    public function Cek_Kode_Jenis_Barang_Input($string)
    {
        $CekKodeJenis_Barang = $this->modelJenis_Barang->Cek_Kode_Jenis_Barang_Input($string);
        echo $CekKodeJenis_Barang;
    }

    public function generate_kode_Jenis_Barang()
    {
        echo $this->modelJenis_Barang->get_kode_Jenis_Barang();
    }

    // Tambah Data

    public function tambah_data()
    {
        $this->modelJenis_Barang->tambah_data();
    }

    public function view_edit_data($id_jenis_barang)
    {
        $data = $this->modelJenis_Barang->view_edit_data($id_jenis_barang);
        $output = json_encode($data);
        echo $output;
    }

    public function edit_data($id_jenis_barang)
    {
        $this->modelJenis_Barang->edit_data($id_jenis_barang);
    }

    public function delete_data($id_jenis_barang)
    {
        if (empty($id_jenis_barang)) {
        } else {
            $this->modelJenis_Barang->delete_data($id_jenis_barang); // tambah data siswa
        }
    }

    // ambil data jenis_barang

    public function get_data_jenis_barang()
    {
        $data =  $this->modelJenis_Barang->get_data_jenis_barang();
        return $data;
    }

    public function get_Data_Dengan_Jenis_Barang($nama_jenis_barang)
    {

        $string = str_replace("%20", " ", $nama_jenis_barang);
        $database = $this->modelJenis_Barang->get_Data_Dengan_Jenis_Barang($string);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }
}
