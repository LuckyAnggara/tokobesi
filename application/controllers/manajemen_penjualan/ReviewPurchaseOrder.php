<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewPurchaseOrder extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Penjualan/Model_Purchase_Order', 'modelPO');
        $this->load->model('Manajemen_Persediaan/Model_Persediaan_Barang', 'modelPersediaan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function timeline($string = null)
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_penjualan/purchase_order_sales/review/review_purchase_order_css';
        $data['timeline'] = $this->modelPO->timeline($string);
        $data['no_order'] = $string;

        $cek = $this->modelPO->cekData($string);

        if ($cek == false) {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('template/template_page_not_found');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        } else {
            $this->load->view('template/template_sales/template_header_sales', $data);
            $this->load->view('template/template_menu');
            $this->load->view('manajemen_penjualan/purchase_order_sales/review/timeline_purchase_order', $data);
            $this->load->view('template/template_sales/template_right_sales');
            $this->load->view('manajemen_penjualan/purchase_order_sales/review/review_purchase_order_modal');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function review($string = null)
    {

        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_penjualan/purchase_order_sales/review/review_purchase_order_css';
        $data['timeline'] = $this->modelPO->timeline($string);
        $data['no_order'] = $string;
        $cek = $this->modelPO->cekData($string);

        if ($cek == false) {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('template/template_page_not_found');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        } else {

            $this->load->view('template/template_sales/template_header_sales', $data);
            $this->load->view('template/template_menu');
            $this->load->view('manajemen_penjualan/purchase_order_sales/review/review_purchase_order', $data);
            $this->load->view('template/template_sales/template_right_sales');
            $this->load->view('manajemen_penjualan/purchase_order_sales/review/review_purchase_order_modal');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('manajemen_penjualan/purchase_order_sales/review/review_purchase_order_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function setDataReview()
    {
        $post = $this->input->post();
        $data = $this->modelPO->setDataReview($post);
        $output = json_encode($data);
        echo $output;
    }
    function get_total_perhitungan_return()
    {
        $post = $this->input->post();
        $data = $this->modelPO->get_total_perhitungan_return($post);
        $output = json_encode($data);
        echo $output;
    }


    function get_total_perhitungan()
    {
        $post = $this->input->post();
        $data = $this->modelPO->get_total_perhitungan($post);
        $output = json_encode($data);
        echo $output;
    }

    function proses_ke_admin()
    {
        $post = $this->input->post();
        $this->modelPO->proses_ke_admin($post);
        // $this->modelPusher->pusher_notif_sales();
    }
}
