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

    function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_keuangan/master_coh/daftar_coh/daftar_coh_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_coh/daftar_coh/daftar_coh', $data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_keuangan/master_coh/daftar_coh/daftar_coh_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_coh/daftar_coh/daftar_coh_js');
        $this->load->view('template/template_app_js');
    }

    public function cek_data()
    {
        $post = $this->input->post();
        $data = $this->modelCoh->cek_data($post);
        echo $data;
    }

    public function tambah_data()
    {
        $post = $this->input->post();
        $this->modelCoh->start_of_day($post);
    }

    public function edit_data($no_ref)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['master_coh'] = $this->modelCoh->get_view_master_coh($no_ref);
        $data['css'] = 'manajemen_keuangan/master_coh/edit_gaji/edit_gaji_css';
        if ($data['master_coh']['status'] == 2) {
            redirect(base_url("manajemen_keuangan/mastergaji/detail_data/" . $no_ref));
        }

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_coh/edit_gaji/edit_gaji', $data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_keuangan/master_coh/edit_gaji/edit_gaji_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_coh/edit_gaji/edit_gaji_js');
        $this->load->view('template/template_app_js');
    }

    public function detail_data($no_ref)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['master_coh'] = $this->modelCoh->get_view_master_coh($no_ref);
        $data['css'] = 'manajemen_keuangan/master_coh/detail_gaji/detail_gaji_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_coh/detail_gaji/detail_gaji', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_coh/detail_gaji/detail_gaji_js');
        $this->load->view('template/template_app_js');
    }

    public function get_view_detail_gaji()
    {
        $no_ref = $this->input->post('no_ref');
        $database = $this->modelCoh->get_view_detail_gaji($no_ref);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_detail_master_coh()
    {
        $no_ref = $this->input->post('no_ref');
        $database = $this->modelCoh->get_detail_master_coh($no_ref);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );
        $output = json_encode($output);
        echo $output;
    }

    function get_data_pegawai()
    {
        $database = $this->modelCoh->get_data_pegawai();
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $value) {
            $value['bonus'] = "0";
            $value['total'] = $value['gaji_pokok'] + $value['uang_makan'] + $value['bonus'];
            $output['data'][] = $value;
        }
        $output = json_encode($output);
        echo $output;
    }

    public function get_master_coh()
    {
        $database = $this->modelCoh->get_master_coh();
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );

        $output = json_encode($output);
        echo $output;
    }

    public function random_ref()
    {
        $number = $this->modelCoh->random_ref();
        if ($number == false) {
            echo $number;
        } else {
            $output =  "REF" . $number;
            $output = json_encode($output);
            echo $output;
        }
    }

    public function tambah_master_coh()
    {
        $post = $this->input->post();
        $this->modelCoh->tambah_data($post);
        $this->modelCoh->tambah_detail_data($post);
    }

    public function proses_bayar()
    {
        $post = $this->input->post();
        $this->modelCoh->bayar_master($post);
        $this->modelCoh->bayar_detail($post['output']);

    }

    public function delete_master_coh()
    {
        $no_ref = $this->input->post('no_ref');
        $this->modelCoh->delete_master_coh($no_ref);
    }

    public function ubah_gaji_pokok()
    {
        $post = $this->input->post();
        $this->modelCoh->ubah_gaji_pokok($post);
    }

    public function ubah_uang_makan()
    {
        $post = $this->input->post();
        $this->modelCoh->ubah_uang_makan($post);
    }

    public function ubah_bonus()
    {
        $post = $this->input->post();
        $this->modelCoh->ubah_bonus($post);
    }
}
