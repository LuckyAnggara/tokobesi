<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterPersediaan extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('manajemen_persediaan/Model_Master_Persediaan', 'modelMasterPersediaan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_persediaan/master_persediaan/master_persediaan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/master_persediaan/master_persediaan');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_persediaan/master_persediaan/master_persediaan_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/master_persediaan/master_persediaan_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {
        $post = $this->input->post();

        $database = $this->modelMasterPersediaan->getDataBarang();
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($dataBarang as $key => $value) {
            $saldoAwal =  $this->modelMasterPersediaan->saldoAwal($value['kode_barang'], $post);
            if ($saldoAwal == null) {
                $saldoAwal['qty_awal'] = 0;
                $saldoAwal['saldo_awal'] = 0;
                $saldoAwal['harga_awal'] = 0;
            }


            $saldoMasuk =  $this->modelMasterPersediaan->saldoMasuk($value['kode_barang'], $post);
            $saldoKeluar =  $this->modelMasterPersediaan->saldoKeluar($value['kode_barang'], $post);

            $saldoCart =  $this->modelMasterPersediaan->saldoCart($value['kode_barang'], $post);
            $saldoCartPo =  $this->modelMasterPersediaan->saldoCartPo($value['kode_barang'], $post);

            $saldoAkhir =  $this->modelMasterPersediaan->saldoAkhir($saldoAwal, $saldoMasuk, $saldoKeluar, $saldoCart, $saldoCartPo);

            $value['saldo_awal'] = $saldoAwal;
            $value['saldo_masuk'] = $saldoMasuk;
            $value['saldo_keluar'] = $saldoKeluar;
            $value['saldo_cart'] = $saldoCart;
            $value['saldo_cart_po'] = $saldoCartPo;
            $value['saldo_akhir'] = $saldoAkhir;

            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }

    public function getDataMasuk()
    {
        $post = $this->input->post();
        $database = $this->modelMasterPersediaan->getDataMasuk($post);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );

        $output = json_encode($output);
        echo $output;
    }

    public function getDataKeluar()
    {
        $post = $this->input->post();
        $database = $this->modelMasterPersediaan->getDataKeluar($post);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );

        $output = json_encode($output);
        echo $output;
    }

    public function getDataCart()
    {
        $post = $this->input->post();
        $database = $this->modelMasterPersediaan->getDataCart($post);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );

        $output = json_encode($output);
        echo $output;
    }

    public function getDataCartPo()
    {
        $post = $this->input->post();
        $database = $this->modelMasterPersediaan->getDataCartPo($post);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );

        $output = json_encode($output);
        echo $output;
    }
}
