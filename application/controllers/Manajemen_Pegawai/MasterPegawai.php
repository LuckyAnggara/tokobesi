<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterPegawai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Pegawai/Model_Master_Pegawai', 'modelPegawai');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }else{
            if ($this->session->userdata('role') != "Spv") {
                redirect(base_url("index.html"));
                echo $this->session->userdata('role');
            }
        }
    }

    public function index()
    {
        $data['css'] = 'manajemen_pegawai/master_pegawai/master_pegawai_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_pegawai/master_pegawai/master_pegawai');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_pegawai/master_pegawai/master_pegawai_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_pegawai/master_pegawai/master_pegawai_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $database = $this->modelPegawai->get_master_data();
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_pegawai'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }


    public function tambahdatapegawai()
    {
        $post = $this->input->post();
        $this->modelPegawai->tambah_data_pegawai($post);
    }

    public function setactive()
    {
        $post = $this->input->post();
        $database = $this->modelPegawai->set_user_active($post);
    }

    public function setinactive()
    {
        $post = $this->input->post();
        $this->modelPegawai->set_user_inactive($post);
    }

    public function resetpassword()
    {
        $username = $this->input->post('view_username');
        $database = $this->modelUser->reset_password($username);
    }



    public function Detail_Pegawai()
    {

        $data['css'] = 'manajemen_pegawai/master_pegawai/detail_pegawai/detail_pegawai_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $this->load->view('template/template_header',$data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_pegawai/master_pegawai/detail_pegawai/detail_pegawai');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_pegawai/master_pegawai/detail_pegawai/detail_pegawai_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_pegawai/master_pegawai/detail_pegawai/detail_pegawai_js');
        $this->load->view('template/template_app_js');
    }



  }
