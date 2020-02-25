<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterUtang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Detail_Transaksi_Penjualan', 'modelDetailTransaksiPenjualan');
        $this->load->model('Manajemen_Keuangan/Model_Utang', 'modelUtang');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function daftar_utang()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_keuangan/master_utang/daftar_utang/daftar_utang_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_utang/daftar_utang/daftar_utang', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_utang/daftar_utang/daftar_utang_js');
        $this->load->view('template/template_app_js');
    }



    public function getData()
    {
        $post = $this->input->post();
        $database = $this->modelUtang->get_data_utang($post);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_utang'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $key => $value) {
            $nama_sales = $this->modelUtang->get_data_sales($value['no_faktur']);
            $nama_supplier = $this->modelUtang->get_data_supplier($value['no_faktur']);

            $value['nama_sales'] = $nama_sales;
            $value['nama_supplier'] = $nama_supplier;
            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }

    public function detail_utang($no_faktur)
    {

        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['data_order'] = $this->modelDetailTransaksiPenjualan->get_data($no_faktur);
        $data['detail_order'] = $this->modelDetailTransaksiPenjualan->get_detail($no_faktur);

        $data['css'] =  'manajemen_keuangan/master_utang/detail_utang/detail_utang_css';

        if (!isset($data['data_order']['no_faktur'])) {
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

            $this->load->view('manajemen_keuangan/master_utang/detail_utang/detail_utang', $data);
            $this->load->view('template/template_right');
            $this->load->view('manajemen_keuangan/master_utang/detail_utang/detail_utang_modal');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('manajemen_keuangan/master_utang/detail_utang/detail_utang_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function getDetailPembayaran()
    {

        $nomor_faktur = $this->input->post('nomor_faktur');
        $database = $this->modelUtang->get_detail_pembayaran($nomor_faktur);
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

    public function tambahPembayaran()
    {
        $post = $this->input->post();
        $this->modelUtang->tambah_pembayaran($post);
        $this->modelUtang->update_master($post);
    }

    public function saldoutang()
    {
        $data =  $this->modelUtang->saldo_utang();
        $output = json_encode($data);
        echo $output;
    }

    public function saldoutangdetail()
    {
        $nomor_faktur = $this->input->post('nomor_faktur');
        $data =  $this->modelUtang->saldo_utang_detail($nomor_faktur);
        $output = json_encode($data);
        echo $output;
    }

    public function statusbayar()
    {
        $nomor_faktur = $this->input->post('nomor_faktur');
        $data =  $this->modelUtang->status_bayar($nomor_faktur);
        $output = json_encode($data);
        echo $output;
    }
}
