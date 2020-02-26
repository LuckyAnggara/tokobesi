<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterpiutang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Detail_Transaksi_Penjualan', 'modelDetailTransaksiPenjualan');
        $this->load->model('Manajemen_Keuangan/Model_Piutang', 'modelPiutang');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function daftar_piutang()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_keuangan/master_piutang/daftar_piutang/daftar_piutang_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_keuangan/master_piutang/daftar_piutang/daftar_piutang', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_keuangan/master_piutang/daftar_piutang/daftar_piutang_js');
        $this->load->view('template/template_app_js');
    }



    public function getData()
    {
        $post = $this->input->post();
        $database = $this->modelPiutang->get_data_piutang($post);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_piutang'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $key => $value) {
            $nama_sales = $this->modelPiutang->get_data_sales($value['no_faktur']);
            $nama_pelanggan = $this->modelPiutang->get_data_pelanggan($value['no_faktur']);

            $value['nama_sales'] = $nama_sales;
            $value['nama_pelanggan'] = $nama_pelanggan;
            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }

    public function detail_piutang($no_faktur)
    {

        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['data_order'] = $this->modelDetailTransaksiPenjualan->get_data($no_faktur);
        $data['detail_order'] = $this->modelDetailTransaksiPenjualan->get_detail($no_faktur);

        $data['css'] =  'manajemen_keuangan/master_piutang/detail_piutang/detail_piutang_css';

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

            $this->load->view('manajemen_keuangan/master_piutang/detail_piutang/detail_piutang', $data);
            $this->load->view('template/template_right');
            $this->load->view('manajemen_keuangan/master_piutang/detail_piutang/detail_piutang_modal');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('manajemen_keuangan/master_piutang/detail_piutang/detail_piutang_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function getDetailPembayaran()
    {

        $nomor_faktur = $this->input->post('nomor_faktur');
        $database = $this->modelPiutang->get_detail_pembayaran($nomor_faktur);
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
        $this->modelPiutang->tambah_pembayaran($post);
        $this->modelPiutang->update_master($post);
    }

    public function saldopiutang()
    {
        $data =  $this->modelPiutang->saldo_piutang();
        $output = json_encode($data);
        echo $output;
    }

    public function saldopiutangdetail()
    {
        $nomor_faktur = $this->input->post('nomor_faktur');
        $data =  $this->modelPiutang->saldo_piutang_detail($nomor_faktur);
        $output = json_encode($data);
        echo $output;
    }

    public function statusbayar()
    {
        $nomor_faktur = $this->input->post('nomor_faktur');
        $data =  $this->modelPiutang->status_bayar($nomor_faktur);
        $output = json_encode($data);
        echo $output;
    }
}
