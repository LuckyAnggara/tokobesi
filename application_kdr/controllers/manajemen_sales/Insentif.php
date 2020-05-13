<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Insentif extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Sales/Model_Insentif', 'modelInsentif');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        } else {
            if ($this->session->userdata('role') != "3") {
                redirect(base_url("index.html"));
            }
        }
    }

    public function index()
    {
		$data['menu'] = $this->modelSetting->data_menu();
        $data['css'] = 'manajemen_sales/insentif/insentif_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_sales/insentif/insentif');
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_sales/insentif/insentif_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $bulan = $this->input->post('bulan');
        $database = $this->modelInsentif->get_data($bulan);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_user'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );
        $output = $output = json_encode($output);
        echo $output;
    }

    public function totalInsentif()
    {
        $bulan = $this->input->post('bulan');
        $output = $this->modelInsentif->total_insentif($bulan);
        $output = json_encode($output);
        echo $output;
    }
}
