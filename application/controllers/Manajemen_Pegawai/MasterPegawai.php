<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterpegawai extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Pegawai/Model_Master_Pegawai', 'modelPegawai');
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
        
        $data['css'] = 'manajemen_pegawai/master_pegawai/master_pegawai_css';
      
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
        $data = $this->modelPegawai->tambah_data_pegawai($post);
        echo $data;
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



    public function Detail_Pegawai($nip)
    {

        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        // data pegawai

        $data['css'] = 'manajemen_pegawai/master_pegawai/master_pegawai_css';
        $data['pegawai'] = $this->modelPegawai->detail_pegawai($nip);

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_pegawai/master_pegawai/detail_pegawai/detail_pegawai');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_pegawai/master_pegawai/detail_pegawai/detail_pegawai_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_pegawai/master_pegawai/detail_pegawai/detail_pegawai_js');
        $this->load->view('template/template_app_js');
    }
    public function SetGambarBaru($nip)
    {
        $this->modelPegawai->edit_gambar($nip);
    }


    public function GetGambarBaru($nip)
    {
        $data = $this->modelPegawai->get_gambar_baru($nip);
        $output = json_encode($data);
        echo $output;
    }


    public function edit_data_umum($nip)
    {
        $data = $this->modelPegawai->edit_data_umum($nip);
        return $data;
    }

    public function edit_data_alamat($nip)
    {
        $this->modelPegawai->edit_data_alamat($nip);
    }

    public function edit_data_pekerjaan($nip)
    {
        $this->modelPegawai->edit_data_pekerjaan($nip);
    }

    public function edit_data_lainnya($nip)
    {
        $this->modelPegawai->edit_data_lainnya($nip);
    }
}
