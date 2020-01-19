<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterPelanggan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Data/Model_Master_Pelanggan', 'modelPelanggan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
    }

    public function index()
    {
        $data['css'] = 'manajemen_data/master_pelanggan/master_pelanggan_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_data/master_pelanggan/master_pelanggan');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_data/master_pelanggan/master_pelanggan_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_data/master_pelanggan/master_pelanggan_js');
        $this->load->view('template/template_app_js');
    }

    public function getData($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelPelanggan->get_data($string);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_pelanggan'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );

        $output = json_encode($output);
        echo $output;
    }
    // Generate Kode Barang Automatic
    public function cekData($string)
    {
        $noUrut = $this->modelPelanggan->cekData($string);
        $noUrut++;
        echo sprintf("%03s", $noUrut);
    }

    public function generate_id_pelanggan()
    {
        echo $this->modelPelanggan->get_id_pelanggan();
    }

    // Tambah Data

    public function tambah_data()
    {
        $this->modelPelanggan->tambah_data();
    }

    public function view_edit_data($id_pelanggan)
    {
        $data = $this->modelPelanggan->view_edit_data($id_pelanggan);
        $output = json_encode($data);
        echo $output;
    }

    public function edit_data($id_pelanggan)
    {
        $this->modelPelanggan->edit_data($id_pelanggan);
    }

    public function delete_data($id_pelanggan)
    {
        if (empty($id_pelanggan)) {
        } else {
            $this->modelPelanggan->delete_data($id_pelanggan); // tambah data siswa
        }
    }

    // ambil data satuan

    public function get_data_satuan()
    {
        $data =  $this->modelPelanggan->get_data_satuan();
        return $data;
    }
}
