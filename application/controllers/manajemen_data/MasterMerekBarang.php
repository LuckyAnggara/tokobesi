<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterMerekBarang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Data/Model_Master_Merek_Barang', 'modelMerek_Barang');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
    }

    public function index()
    {
        $data['css'] = 'manajemen_data/master_merek_barang/master_merek_barang_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_data/master_merek_barang/master_merek_barang');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_data/master_merek_barang/master_merek_barang_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_data/master_merek_barang/master_merek_barang_js');
        $this->load->view('template/template_app_js');
    }

    public function getData($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelMerek_Barang->get_data($string);
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
    // Cek Duplikat Data
    public function Cek_Kode_Merek_Barang_Input($string)
    {
        $CekKodeMerek_Barang = $this->modelMerek_Barang->Cek_Kode_Merek_Barang_Input($string);
        echo $CekKodeMerek_Barang;
    }

    public function generate_kode_Merek_Barang()
    {
        echo $this->modelMerek_Barang->get_kode_Merek_Barang();
    }

    // Tambah Data

    public function tambah_data()
    {
        $this->modelMerek_Barang->tambah_data();
    }

    public function view_edit_data($id_merek_barang)
    {
        $data = $this->modelMerek_Barang->view_edit_data($id_merek_barang);
        $output = json_encode($data);
        echo $output;
    }

    public function edit_data($id_merek_barang)
    {
        $this->modelMerek_Barang->edit_data($id_merek_barang);
    }

    public function delete_data($id_merek_barang)
    {
        if (empty($id_merek_barang)) {
        } else {
            $this->modelMerek_Barang->delete_data($id_merek_barang); // tambah data siswa
        }
    }

    // ambil data merek_barang

    public function get_data_merek_barang()
    {
        $data =  $this->modelMerek_Barang->get_data_merek_barang();
        return $data;
    }

    public function get_Data_Dengan_Merek_Barang($nama_merek_barang)
    {

        $string = str_replace("%20", " ", $nama_merek_barang);
        $database = $this->modelMerek_Barang->get_Data_Dengan_Merek_Barang($string);
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
}
