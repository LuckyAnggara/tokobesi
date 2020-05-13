<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterkategoribiaya extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Data/Model_Master_Kategori_Biaya', 'modelKategoriBiaya');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_data/master_kategori_biaya/master_kategori_biaya_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_data/master_kategori_biaya/master_kategori_biaya');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_data/master_kategori_biaya/master_kategori_biaya_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_data/master_kategori_biaya/master_kategori_biaya_js');
        $this->load->view('template/template_app_js');
    }

    public function getData($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelKategoriBiaya->get_data($string);
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
    public function cek_kode_kategori_biaya_Input($string)
    {
        $CekKodekategori_biaya = $this->modelKategoriBiaya->Cek_Kode_kategori_biaya_Input($string);
        echo $CekKodekategori_biaya;
    }

    public function generate_kode_kategori_biaya()
    {
        echo $this->modelKategoriBiaya->get_kode_kategori_biaya();
    }

    // Tambah Data

    public function tambah_data()
    {
        $this->modelKategoriBiaya->tambah_data();
    }

    public function view_edit_data($id_kategori_biaya)
    {
        $data = $this->modelKategoriBiaya->view_edit_data($id_kategori_biaya);
        $output = json_encode($data);
        echo $output;
    }

    public function edit_data($id_kategori_biaya)
    {
        $this->modelKategoriBiaya->edit_data($id_kategori_biaya);
    }

    public function delete_data($id_kategori_biaya)
    {
        if (empty($id_kategori_biaya)) {
        } else {
            $this->modelKategoriBiaya->delete_data($id_kategori_biaya); // tambah data siswa
        }
    }

    // ambil data kategori_biaya

    public function get_data_kategori_biaya()
    {
        $data =  $this->modelKategoriBiaya->get_data_kategori_biaya();
        return $data;
    }

    public function get_Data_dengan_kategori_biaya($nama_kategori_biaya)
    {

        $string = str_replace("%20", " ", $nama_kategori_biaya);
        $database = $this->modelKategoriBiaya->get_Data_Dengan_kategori_biaya($string);
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
