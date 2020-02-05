<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PurchaseOrderAdmin extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Purchase_Order', 'modelPO');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['css'] = 'manajemen_penjualan/purchase_order/purchase_order_admin/purchase_order_admin_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/purchase_order/purchase_order_admin/purchase_order_admin');
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/purchase_order/purchase_order_admin/purchase_order_admin_js');
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
            $sales =  $this->modelPO->data_sales($value['user']);
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

   
}
