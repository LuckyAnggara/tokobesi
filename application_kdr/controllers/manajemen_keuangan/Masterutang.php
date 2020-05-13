<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Masterutang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Pembelian/Model_Detail_Transaksi_Pembelian', 'modelDetailTransaksiPembelian');
        $this->load->model('Manajemen_Keuangan/Model_Utang', 'modelUtang');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');
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
            $nama_supplier = $this->modelUtang->get_data_supplier($value['nomor_transaksi']);

            $value['nama_supplier'] = $nama_supplier;
            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }
    public function datapembayaran()
    {
        $post = $this->input->post();
        $database = $this->modelUtang->datapembayaran($post);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('detail_utang'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );

        $output = json_encode($output);
        echo $output;
    }
    
    public function detail_utang($nomor_transaksi)
    {

        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['data_order'] = $this->modelDetailTransaksiPembelian->get_data($nomor_transaksi);
        $data['detail_order'] = $this->modelDetailTransaksiPembelian->get_detail($nomor_transaksi);
        $data['data_utang'] = $this->modelUtang->get_data_detail_utang($nomor_transaksi);

        $data['css'] =  'manajemen_keuangan/master_utang/detail_utang/detail_utang_css';

        // print_r($data['data_order']);
        if (!isset($data['data_order']['nomor_transaksi'])) {
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
        $nomor_transaksi = $this->input->post('nomor_transaksi');
        $total_tagihan = $this->modelUtang->get_data_detail_utang($nomor_transaksi);
        $total_tagihan = $total_tagihan['total_tagihan'];

        $database = $this->modelUtang->get_detail_pembayaran($nomor_transaksi);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('detail_utang'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );
        foreach ($data as $key => $value) {

            $nilai = $total_tagihan - $value['nominal_pembayaran'];
            $value['saldo'] = $nilai;
            $output['data'][] = $value;
            $total_tagihan = $nilai;
        }

        $output = json_encode($output);
        echo $output;
    }


    public function tambahPembayaran()
    {
        $post = $this->input->post();
        $this->modelUtang->tambah_pembayaran($post);
        $this->modelUtang->update_master($post);
        $this->modelPusher->pusher_utangpiutang($post['nomor_transaksi']);
    }

    public function saldoutang()
    {
        $data =  $this->modelUtang->saldo_utang();
        $output = json_encode($data);
        echo $output;
    }

    public function saldoutangdetail()
    {
        $nomor_transaksi = $this->input->post('nomor_transaksi');
        $data =  $this->modelUtang->saldo_utang_detail($nomor_transaksi);
        $output = json_encode($data);
        echo $output;
    }

    public function statusbayar()
    {
        $nomor_transaksi = $this->input->post('nomor_transaksi');
        $data =  $this->modelUtang->status_bayar($nomor_transaksi);
        $output = json_encode($data);
        echo $output;
    }

    public function setlampiran()
    {
        $id = $this->input->post('id');
        $nomor_transaksi = $this->input->post('nomor_transaksi');
        $this->modelUtang->set_lampiran($id);
        $this->modelPusher->pusher_utangpiutang($nomor_transaksi);
    }

    public function delete_data()
    {
        $id = $this->input->post('id');
        $nomor_transaksi = $this->input->post('nomor_transaksi');
        if (empty($id)) {
        } else {
            $this->modelUtang->delete_data($id); // tambah data siswa
        }
        $this->modelPusher->pusher_utangpiutang($nomor_transaksi);
    }
}
