<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Detail_Transaksi_Penjualan', 'modelDetailTransaksiPenjualan');
        $this->load->model('Manajemen_Keuangan/Model_Piutang', 'modelPiutang');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

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

        $data['css'] = 'setting/setting_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('setting/setting');
        $this->load->view('template/template_right');
        $this->load->view('setting/setting_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('setting/setting_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $this->db->select('*');
        $this->db->from('master_setting');
        $data = $this->db->get()->result_array();
        $output = array();

        foreach ($data as $key => $value) {
            $output[$value['nama_setting']] = $value['value'];
        }

        $output = json_encode($output);
        echo $output;
    }

    public function SetGambarBaru()
    {
        $this->modelSetting->edit_gambar();
    }

    public function GetGambarBaru()
    {
        $data = $this->modelSetting->get_gambar_baru();
        $output = json_encode($data);
        echo $output;
    }

    public function confirmSetting()
    {
        $post = $this->input->post();
        foreach ($post as $key => $value) {
            $this->modelSetting->confirm_setting($key, $value);
        }
    }
}
