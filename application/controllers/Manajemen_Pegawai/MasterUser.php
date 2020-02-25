<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterUser extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Pegawai/Model_Master_User', 'modelUser');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        } else {
            $role = $this->session->userdata('role');
            if ($role  < 4) {
                redirect(base_url("index.html"));
            }
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        
        $data['css'] = 'manajemen_pegawai/master_user/master_user_css';
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_pegawai/master_user/master_user');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_pegawai/master_user/master_user_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_pegawai/master_user/master_user_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $database = $this->modelUser->get_data();
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

    public function getDataPegawai()
    {
        $query = $this->input->get('query');
        $database = $this->modelUser->get_data_pegawai($query);
        $data = $database->result_array();
        $output = json_encode($data);
        echo $output;
    }

    public function getdatauser()
    {
        $post = $this->input->post();
        $data = $this->modelUser->get_data_user($post);
        $output = json_encode($data);
        echo $output;
    }

    public function tambahuser()
    {
        $post = $this->input->post();
        $database = $this->modelUser->tambah_user($post);
    }

    public function setactive()
    {
        $post = $this->input->post();
        $database = $this->modelUser->set_user_active($post);
    }

    public function setinactive()
    {
        $post = $this->input->post();
        $this->modelUser->set_user_inactive($post);
        $this->modelUser->force_logout($post['username']);
    }

    public function resetpassword()
    {
        $username = $this->input->post('view_username');
        $database = $this->modelUser->reset_password($username);
    }

    public function forcelogout()
    {
        $username = $this->input->post('username');
        $this->modelUser->force_logout($username);
        $this->modelPusher->pusher_force_logout($username);
    }



  }
