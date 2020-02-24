<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PurchaseOrderAdmin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Purchase_Order', 'modelPO');
        $this->load->model('Manajemen_Penjualan/Model_Purchase_Order_Admin', 'modelPOAdmin');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_penjualan/purchase_order_admin/purchase_order_admin_css';
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/purchase_order_admin/purchase_order_admin');
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/purchase_order_admin/purchase_order_admin_js');
        $this->load->view('template/template_app_js');
    }


    public function getDataPO()
    {
        $post = $this->input->post();
        $database = $this->modelPO->get_data_po($post);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_penjualan'),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $key => $value) {
            $sales =  $this->modelPO->data_sales($value['sales']);
            $admin =  $this->modelPO->data_admin($value['admin']);
            $pelanggan =  $this->modelPO->data_pelanggan($value['id_pelanggan']);


            $value['sales'] = $sales;
            $value['admin'] = $admin;
            $value['pelanggan'] = $pelanggan;

            $output['data'][] = $value;
        }



        $output = json_encode($output);
        echo $output;
    }

    public function delete_data($no_faktur)
    {
        if (empty($no_faktur)) {
        } else {
            $this->modelDaftarTransaksiPenjualan->delete_data($no_faktur); // tambah data siswa
        }
    }


    public function review($no_order)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['data_po'] = $this->modelPOAdmin->getDataMasterPO($no_order);
        $data['review_order'] = $this->modelPOAdmin->getDataReview($no_order);

        $data['css'] = 'manajemen_penjualan/purchase_order_admin/review/review_purchase_order_admin_css';

        if (!isset($data['data_po']['no_order'])) {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('template/template_page_not_found');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        } else {

            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('manajemen_penjualan/purchase_order_admin/review/review_purchase_order_admin');
            $this->load->view('template/template_right');
            $this->load->view('manajemen_penjualan/purchase_order_admin/review/review_purchase_order_admin_modal');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('manajemen_penjualan/purchase_order_admin/review/review_purchase_order_admin_js');
            $this->load->view('template/template_app_js');
        }
    }

    function push_total_perhitungan()
    {
        $post = $this->input->post();
        $this->modelPOAdmin->push_total_perhitungan($post);
    }

    function get_total_perhitungan($no_order)
    {
        $data = $this->modelPOAdmin->get_total_perhitungan($no_order);
        $output = json_encode($data);
        echo $output;
    }

    function bayar_checkout()
    {
        $post = $this->input->post();
        $this->modelPOAdmin->proses_penjualan($post);
    }

    function reject()
    {
        $post = $this->input->post();
        $this->modelPOAdmin->reject($post);
    }

    function return()
    {
        $post = $this->input->post();
        $this->modelPOAdmin->return($post);
    }
}
