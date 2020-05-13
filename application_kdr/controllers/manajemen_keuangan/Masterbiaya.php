<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterbiaya extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Keuangan/Model_Coh', 'modelCoh');
        $this->load->model('Manajemen_Keuangan/Model_Biaya', 'modelBiaya');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
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

    public function get_daftar_biaya_hari_ini()
    {
        $database = $this->modelBiaya->get_daftar_biaya_hari_ini();
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered" => $database->num_rows(),
            "data" => $dataBarang,
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_daftar_biaya_histori()
    {
        $post = $this->input->post();
        $database = $this->modelBiaya->get_daftar_biaya_histori($post);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered" => $database->num_rows(),
            "data" => $dataBarang,
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_kategori_biaya()
    {
        $query = $this->input->get('query');
        $database = $this->modelBiaya->get_kategori_biaya($query);
        $data = $database->result_array();
        $output = json_encode($data);
        echo $output;
    }

    public function get_total_biaya()
    {
        $post = $this->input->post();
        echo $this->modelBiaya->get_total_biaya($post);
    }

    public function tambah_biaya()
    {
        // $user = $this->session->userdata('username');
        // $dana = $this->modelCoh->cek_dana($user);
        // $post = $this->input->post();
        // $total_biaya = $this->normal($post['total_biaya']);
        // if($total_biaya > $dana){
        //     echo "kurang";
        // }else{
        //     $no_jurnal = $this->modelBiaya->tambah_biaya($post);
        //     $this->modelCoh->pembayaran_biaya($user, $post, $no_jurnal);
        //     echo $no_jurnal;
        // }

        // tanpa coh

        $user = $this->session->userdata('username');
        $post = $this->input->post();
        $no_jurnal = $this->modelBiaya->tambah_biaya($post);
        echo $no_jurnal;
    }

    public function revisi_biaya()
    {
        $user = $this->session->userdata('username');
        $post = $this->input->post();
        $data = $this->modelBiaya->revisi_biaya($post);
        $pengembalian = $this->normal($post['pengembalian']);
        echo $pengembalian;
        // $this->modelCoh->revisi_pembayaran_biaya($user, $data, $pengembalian);
    }

    public function delete_biaya()
    {
        $user = $this->session->userdata('username');
        $id = $this->input->post('id');
        $data = $this->modelBiaya->delete_biaya($id);

        // $this->modelCoh->delete_pembayaran_biaya($user, $data);
    }

    public function detail_biaya()
    {

        $id = $this->input->post('id');
        $data = $this->modelBiaya->detail_biaya($id);
        $output = json_encode($data);
        echo $output;
    }

    public function cek()
    {
        echo $this->modelBiaya->nomor_jurnal();
    }

    public function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }
}
