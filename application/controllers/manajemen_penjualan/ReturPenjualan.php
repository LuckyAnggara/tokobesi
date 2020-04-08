<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Returpenjualan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Retur_Penjualan', 'modelReturPenjualan');
        $this->load->model('Manajemen_Keuangan/Model_Piutang', 'modelPiutang');
        $this->load->model('Manajemen_Keuangan/Model_Coh', 'modelCoh');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $cek_status = $this->modelCoh->cek_ready_kasir();
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_penjualan/retur_penjualan/retur_penjualan_css';
        if ($cek_status > 0) {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('manajemen_penjualan/retur_penjualan/retur_penjualan', $data);
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('manajemen_penjualan/retur_penjualan/retur_penjualan_js');
            $this->load->view('template/template_app_js');
        } else {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('template/template_lock');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        }       
    }

    public function getData()
    {
        $post = $this->input->post();
        $output = $this->modelReturPenjualan->get_data($post);
        $output = $output = json_encode($output);
        echo $output;
    }

    public function getDetailData()
    {
        $post = $this->input->post();
        $output = $this->modelReturPenjualan->get_detail_data($post);
        $output = $output = json_encode($output);
        echo $output;
    }

    public function tambahdatamaster()
    {
        $post = $this->input->post();
        $data = $this->modelReturPenjualan->tambah_data_master($post);
        if($data == 'sukses'){
            $this->db->select('no_faktur');
            $this->db->from('master_piutang');
            $this->db->where('no_faktur', $post['nomor_faktur']);
            $cekKredit = $this->db->get()->num_rows();

            if ($cekKredit > 0) {
                $data = [
                    'nomor_faktur' => $post['nomor_faktur'],
                    'tanggal' => date('Y-m-d H:i:s'),
                    'nominal_pembayaran' => $post['retur_grand_total'],
                    'keterangan' => 'Retur Penjualan',
                ];
                $this->modelPiutang->tambah_pembayaran($data);
                $this->modelPiutang->update_master($data);
            }
            echo 'sukses';
        }else{
            echo 'error';
        }
        
    }

    public function tambahdatadetail()
    {
        $post = $this->input->post();
        $this->modelReturPenjualan->tambah_data_detail($post);
    }

    // daftar retur

    public function daftar_retur()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_penjualan/retur_penjualan/daftar_retur_penjualan/daftar_retur_penjualan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/retur_penjualan/daftar_retur_penjualan/daftar_retur_penjualan', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/retur_penjualan/daftar_retur_penjualan/daftar_retur_penjualan_js');
        $this->load->view('template/template_app_js');
    }



    public function getDataRetur()
    {
        $post = $this->input->post();
        $database = $this->modelReturPenjualan->get_data_retur($post);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_retur_penjualan'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $key => $value) {
            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }


    function faktur($nomor_faktur)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['data_order'] = $this->modelReturPenjualan->get_data_faktur($nomor_faktur);

        $data['detail_order'] = $this->modelReturPenjualan->get_detail_faktur($nomor_faktur);
        $data['css'] = 'manajemen_penjualan/retur_penjualan/faktur_retur/faktur_retur_css';
        $data['title'] = "Cetak Faktur";
        if (!isset($data['data_order']['nomor_faktur'])) {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu', $data);
            $this->load->view('template/template_page_not_found');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        } else {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu', $data);
            $this->load->view('manajemen_penjualan/retur_penjualan/faktur_retur/faktur_retur', $data);
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function delete_faktur()
    {
        $nomor_faktur = $this->input->post('nomor_faktur');
        $this->modelReturPenjualan->delete_data($nomor_faktur);
    }
}
