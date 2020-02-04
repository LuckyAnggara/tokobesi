<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewPurchaseOrder extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Penjualan/Model_Purchase_Order', 'ModelPO');
        $this->load->model('Manajemen_Persediaan/Model_Persediaan_Barang', 'modelPersediaan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_penjualan/purchase_order/purchase_order_css';
        $this->load->view('template/template_sales/template_header_sales', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/purchase_order/review/review_purchase_order');
        $this->load->view('template/template_sales/template_right_sales');
        $this->load->view('manajemen_penjualan/purchase_order/purchase_order_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/purchase_order/review/review_purchase_order_js');
        $this->load->view('template/template_app_js');
    }

    public function setDataReview()
    {
        $post = $this->input->post();
        $data = $this->ModelPO->get_data($post['no_order']);
        $output = json_encode($data);
        echo $output;
    }

}
