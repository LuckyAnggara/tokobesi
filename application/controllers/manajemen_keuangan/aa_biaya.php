<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterbiaya extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Keuangan/Model_Biaya', 'modelBiaya');
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
        $data['css'] = 'manajemen_keuangan/master_biaya/daftar_biaya/daftar_biaya_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_biaya/daftar_biaya/daftar_biaya', $data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_keuangan/master_biaya/daftar_biaya/daftar_biaya_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_biaya/daftar_biaya/daftar_biaya_js');
        $this->load->view('template/template_app_js');
    }


    public function tambah_data($no_ref = null)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['master_biaya'] = $this->modelBiaya->get_view_master_biaya($no_ref);
        $data['css'] = 'manajemen_keuangan/master_biaya/tambah_biaya/tambah_biaya_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_biaya/tambah_biaya/tambah_biaya',$data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_keuangan/master_biaya/tambah_biaya/tambah_biaya_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_biaya/tambah_biaya/tambah_biaya_js');
        $this->load->view('template/template_app_js');
    }

    public function detail_data($no_ref)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['master_biaya'] = $this->modelBiaya->get_view_master_biaya($no_ref);
        $data['css'] = 'manajemen_keuangan/master_biaya/detail_biaya/detail_biaya_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_biaya/detail_biaya/detail_biaya',$data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_biaya/detail_biaya/detail_biaya_js');
        $this->load->view('template/template_app_js');
    }

     public function tambah($no_ref = null)
    {
        $data = $this->modelBiaya->get_view_master_biaya($no_ref);
        print_r($data);
    }

    public function get_detail_master_biaya()
    {
        $no_ref = $this->input->post('no_ref');
        $database = $this->modelBiaya->get_detail_master_biaya($no_ref);
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
        $database = $this->modelBiaya->get_data_pegawai();
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $value) {
            $value['bonus'] = "0";
            $value['total'] = $value['biaya_pokok'] + $value['uang_makan'] + $value['bonus'];
            $output['data'][] = $value;
        }
        $output = json_encode($output);
        echo $output;
    }

    public function get_master_biaya()
    {
        $database = $this->modelBiaya->get_master_biaya();
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );

        $output = json_encode($output);
        echo $output;
    }

    public function get_master_biaya_histori()
    {
        $database = $this->modelBiaya->get_master_biaya_histori();
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );

        $output = json_encode($output);
        echo $output;
    }

    public function random_ref()
    {
        $number = $this->modelBiaya->random_ref();
        if ($number == false) {
            echo $number;
        } else {
            $output =  "REF" . $number;
            $output = json_encode($output);
            echo $output;
        }
    }

    public function tambah_master_biaya()
    {
        $post = $this->input->post();
        $this->modelBiaya->tambah_data($post);
    }

    public function tambah_detail_biaya()
    {
        $post = $this->input->post();
        $this->modelBiaya->tambah_detail_biaya($post);
    }

    public function get_kategori_biaya()
    {
        $query = $this->input->get('query');
        $database = $this->modelBiaya->get_kategori_biaya($query);
        $data = $database->result_array();
        $output = json_encode($data);
        echo $output;
    }

    public function delete_detail_biaya()
    {
        $id = $this->input->post('id');
        $this->modelBiaya->delete_detail_biaya($id);
    }

    public function get_master_total()
    {
        $no_ref = $this->input->post('no_ref');
        $output = $this->modelBiaya->get_master_total($no_ref);
        echo $output;
    }

    public function proses_tutup()
    {
        $post = $this->input->post();
        $this->modelBiaya->tutup_master($post);
    }
}
