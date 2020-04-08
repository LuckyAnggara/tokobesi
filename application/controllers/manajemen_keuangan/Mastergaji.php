<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mastergaji extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Keuangan/Model_Coh', 'modelCoh');
        $this->load->model('Manajemen_Keuangan/Model_Gaji', 'modelGaji');
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
        $data['css'] = 'manajemen_keuangan/master_gaji/daftar_gaji/daftar_gaji_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_gaji/daftar_gaji/daftar_gaji', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_gaji/daftar_gaji/daftar_gaji_js');
        $this->load->view('template/template_app_js');
    }

    public function tambah_data()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_keuangan/master_gaji/tambah_gaji/tambah_gaji_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_gaji/tambah_gaji/tambah_gaji');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_keuangan/master_gaji/tambah_gaji/tambah_gaji_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_gaji/tambah_gaji/tambah_gaji_js');
        $this->load->view('template/template_app_js');
    }

    public function edit_data($no_ref)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['master_gaji'] = $this->modelGaji->get_view_master_gaji($no_ref);
        $data['css'] = 'manajemen_keuangan/master_gaji/edit_gaji/edit_gaji_css';
        if ($data['master_gaji']['status'] == 2) {
            redirect(base_url("manajemen_keuangan/mastergaji/detail_data/" . $no_ref));
        }

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_gaji/edit_gaji/edit_gaji', $data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_keuangan/master_gaji/edit_gaji/edit_gaji_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_gaji/edit_gaji/edit_gaji_js');
        $this->load->view('template/template_app_js');
    }

    public function detail_data($no_ref)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['master_gaji'] = $this->modelGaji->get_view_master_gaji($no_ref);
        $data['css'] = 'manajemen_keuangan/master_gaji/detail_gaji/detail_gaji_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_gaji/detail_gaji/detail_gaji', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_gaji/detail_gaji/detail_gaji_js');
        $this->load->view('template/template_app_js');
    }

    public function get_view_detail_gaji()
    {
        $no_ref = $this->input->post('no_ref');
        $database = $this->modelGaji->get_view_detail_gaji($no_ref);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_detail_master_gaji_harian()
    {
        $no_ref = $this->input->post('no_ref');
        $database = $this->modelGaji->get_detail_master_gaji($no_ref, 0);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_detail_master_gaji_bulanan()
    {
        $no_ref = $this->input->post('no_ref');
        $database = $this->modelGaji->get_detail_master_gaji($no_ref, 1);
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
        $database = $this->modelGaji->get_data_pegawai();
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

    public function get_master_gaji()
    {
        $database = $this->modelGaji->get_master_gaji();
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
        $number = $this->modelGaji->random_ref();
        if ($number == false) {
            echo $number;
        } else {
            $output =  "REF" . $number;
            $output = json_encode($output);
            echo $output;
        }
    }

    public function tambah_master_gaji()
    {
        $post = $this->input->post();
        $this->modelGaji->tambah_data($post);
        $this->modelGaji->tambah_detail_data($post);
    }

    public function proses_bayar()
    {
        $post = $this->input->post();

        $user = $this->session->userdata('username');
        $dana = $this->modelCoh->cek_dana($user);
        $post = $this->input->post();

        $total_pembayaran = $this->normal($post['total_pembayaran']);
        if ($total_pembayaran > $dana) {
            echo "kurang";
        } else {
            $no_ref = $this->modelGaji->bayar_master($post);
            $this->modelGaji->bayar_detail($post['output']);
            $this->modelCoh->pembayaran_gaji($user, $post, $no_ref);
            echo "ok";
        }

    }

    public function delete_master_gaji()
    {
        $user = $this->session->userdata('username');
        $data = $this->input->post();
       
        $no_ref = $this->input->post('no_ref');
        $output = $this->modelGaji->delete_master_gaji($no_ref);

        $this->modelCoh->delete_pembayaran_gaji($user, $data);

        echo $output;

    }


    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }

    public function ubah_gaji_pokok()
    {
        $post = $this->input->post();
        $this->modelGaji->ubah_gaji_pokok($post);
    }

    public function ubah_uang_makan()
    {
        $post = $this->input->post();
        $this->modelGaji->ubah_uang_makan($post);
    }

    public function ubah_bonus()
    {
        $post = $this->input->post();
        $this->modelGaji->ubah_bonus($post);
    }
}
