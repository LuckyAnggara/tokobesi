<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kartupersediaan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Persediaan/Model_Persediaan_Barang', 'modelPersediaan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['kartu'] = $this->modelPersediaan->get_kartu_persediaan();
        $data['css'] = 'manajemen_persediaan/kartu_persediaan/kartu_persediaan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/kartu_persediaan/kartu_persediaan', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/kartu_persediaan/kartu_persediaan_js');
        $this->load->view('template/template_app_js');
    }

    public function get_data()
    {
        $output = $this->modelPersediaan->get_kartu_persediaan();
    }

    public function get_data_ajax()
    {
        $kode_barang = $this->input->post('kode_barang');
        $database = $this->modelPersediaan->get_kartu_persediaan_ajax($kode_barang);
        $data = $database->result_array();

        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => 22,
            "data" =>  array()
        );

        if ($data == "") {
            $output['data'] = "";
        } else {
            foreach ($data as $data2) {
                $value['detail'] = $data2;
                $output['data'][] = $value;
            }
        }


        $output = json_encode($output);
        echo $output;
    }

    public function get_data_barang_versi_select2()
    {
        $string = $this->input->post('search_term');
        $database = $this->modelPersediaan->get_data_barang($string);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data"  => $database->num_rows(),
            "data" => $data,
        );
        $output = json_encode($output);
        echo $output;
    }
    public function getDetailBarang()

    {
        $kode_barang = $this->input->post('kode_barang');
        $output = $this->modelPersediaan->getDetailBarang($kode_barang);
        $output = json_encode($output);
        echo $output;
    }
}
