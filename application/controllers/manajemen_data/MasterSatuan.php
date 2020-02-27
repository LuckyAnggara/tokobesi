<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mastersatuan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Data/Model_Master_Satuan', 'modelSatuan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_data/master_satuan/master_satuan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_data/master_satuan/master_satuan');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_data/master_satuan/master_satuan_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_data/master_satuan/master_satuan_js');
        $this->load->view('template/template_app_js');
    }

    public function getData($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelSatuan->get_data($string);
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
    public function Cek_Kode_Satuan_Input($string)
    {
        $CekKodeSatuan = $this->modelSatuan->Cek_Kode_Satuan_Input($string);
        echo $CekKodeSatuan;
    }

    public function generate_kode_Satuan()
    {
        echo $this->modelSatuan->get_kode_Satuan();
    }

    // Tambah Data

    public function tambah_data()
    {
        $this->modelSatuan->tambah_data();
    }

    public function view_edit_data($id_satuan)
    {
        $data = $this->modelSatuan->view_edit_data($id_satuan);
        $output = json_encode($data);
        echo $output;
    }

    public function edit_data($id_satuan)
    {
        $this->modelSatuan->edit_data($id_satuan);
    }

    public function delete_data($id_satuan)
    {
        if (empty($id_satuan)) {
        } else {
            $this->modelSatuan->delete_data($id_satuan); // tambah data siswa
        }
    }

    // ambil data satuan

    public function get_data_satuan()
    {
        $data =  $this->modelSatuan->get_data_satuan();
        return $data;
    }

    public function get_Data_Dengan_Satuan($nama_satuan)
    {

        $string = str_replace("%20", " ", $nama_satuan);
        $database = $this->modelSatuan->get_Data_Dengan_Satuan($string);
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
