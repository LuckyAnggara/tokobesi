<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mastercoh extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Keuangan/Model_Coh', 'modelCoh');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
	{
		if ($this->session->userdata('role') == "1") {
			redirect(base_url("manajemen_keuangan/mastercoh/kasir"));
		}
		if ($this->session->userdata('role') == "4") {
			redirect(base_url("manajemen_keuangan/mastercoh/supervisor"));
		}
		if ($this->session->userdata('role') == "5") {
			redirect(base_url("manajemen_keuangan/mastercoh/manajer"));
		}
	}

    function manajer()
    {
        if ($this->session->userdata('role') != "5") {
            redirect(base_url("dashboard"));
        } else {
            $data['menu'] = $this->modelSetting->data_menu();
            $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
            $data['css'] = 'manajemen_keuangan/master_coh/manajer/daftar_coh/daftar_coh_css';

            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('manajemen_keuangan/master_coh/manajer/daftar_coh/daftar_coh', $data);
            $this->load->view('template/template_right');
            $this->load->view('manajemen_keuangan/master_coh/manajer/daftar_coh/daftar_coh_modal');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('manajemen_keuangan/master_coh/manajer/daftar_coh/daftar_coh_js');
            $this->load->view('template/template_app_js');
        }
    }

    function get_data_master_permintaan()
    {
        $database = $this->modelCoh->get_data_master_permintaan();
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

    function manajer_approve_coh()
    {
        $post = $this->input->post();
        $data = $this->modelCoh->manajer_approve_coh($post);
        echo $data;
    }

     function manajer_reject_coh()
    {
        $id = $this->input->post('id');
        $data = $this->modelCoh->manajer_reject_coh($id);
        echo $data;
    }

    // script spv

    function supervisor()
    {
        if ($this->session->userdata('role') != "4") {
            redirect(base_url("dashboard"));
        } else {
            $data['menu'] = $this->modelSetting->data_menu();
            $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
            $data['css'] = 'manajemen_keuangan/master_coh/supervisor/daftar_coh/daftar_coh_css';

            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('manajemen_keuangan/master_coh/supervisor/daftar_coh/daftar_coh', $data);
            $this->load->view('template/template_right');
            $this->load->view('manajemen_keuangan/master_coh/supervisor/daftar_coh/daftar_coh_modal');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('manajemen_keuangan/master_coh/supervisor/daftar_coh/daftar_coh_js');
            $this->load->view('template/template_app_js');
        }
    }



    function detail_data($string)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_keuangan/master_coh/supervisor/detail_coh/detail_coh_css';

        $data['detail_data'] = $this->modelCoh->detail_master($string);
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_coh/supervisor/detail_coh/detail_coh', $data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_keuangan/master_coh/supervisor/detail_coh/detail_coh_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_coh/supervisor/detail_coh/detail_coh_js');
        $this->load->view('template/template_app_js');
    }

    public function get_data_master()
    {
        $database = $this->modelCoh->get_data_master();
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

    public function get_detail_data()
    {
        $nomor_referensi = $this->input->post('no_ref');
        $database = $this->modelCoh->get_detail_data($nomor_referensi);
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

    public function cek_data()
    {
        $post = $this->input->post();
        $data = $this->modelCoh->cek_data($post);
        echo $data;
    }


    public function delete_master_coh()
    {
        $id = $this->input->post('id');
        $this->modelCoh->delete_master_coh($id);
    }

    public function delete_permintaan()
    {
        $id = $this->input->post('id');
        $this->modelCoh->delete_permintaan($id);
    }



    public function get_data_pending()
    {
        $post = $this->input->post();
        $database = $this->modelCoh->get_data_pending($post);
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

     public function get_data_permintaan()
    {
        $post = $this->input->post();
        $database = $this->modelCoh->get_data_permintaan($post);
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

    // permintaan

    public function permintaan_tarik_dana()
    {
        $post = $this->input->post();
        $data = $this->modelCoh->permintaan_tarik_dana($post);
        echo $data;
    }

    public function permintaan_setor_dana()
    {
        $post = $this->input->post();
        $data = $this->modelCoh->permintaan_setor_dana($post);
        echo $data;
    }

    public function tutup_master_coh()
    {
        $id = $this->input->post('id');
        echo $this->modelCoh->tutup_master_coh($id);
    }

        public function tambah_data()
    {
        $post = $this->input->post();
        $this->modelCoh->start_of_day($post);
    }

}
