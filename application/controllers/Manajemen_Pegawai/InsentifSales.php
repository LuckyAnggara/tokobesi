<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Insentifsales extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Pegawai/Model_Insentif_Sales', 'modelInsentif');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $role = $this->session->userdata('role');
        if (($role < 4)) {
            redirect(base_url("dashboard"));
        } else {
            $data['menu'] = $this->modelSetting->data_menu();
            $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

            $data['css'] = 'manajemen_pegawai/insentif_sales/insentif_sales_css';
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_sales/template_menu_sales');
            $this->load->view('manajemen_pegawai/insentif_sales/insentif_sales');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('manajemen_pegawai/insentif_sales/insentif_sales_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function getData()
    {
        $database = $this->modelInsentif->get_data();
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_user'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }

    public function approveinsentif()
    {
        $post = $this->input->post();
        $data = $this->modelInsentif->approve_insentif($post);
        echo $data;
    }

    public function rejectinsentif()
    {
        $post = $this->input->post();
        $data = $this->modelInsentif->reject_insentif($post);
        echo $data;
    }
}
