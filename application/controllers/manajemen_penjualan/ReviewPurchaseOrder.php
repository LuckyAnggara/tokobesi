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

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function review($string = null)
    {

        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_penjualan/purchase_order/purchase_order_css';
        $data['timeline'] = $this->modelPO->timeline($string);
        $data['no_order'] = $this->modelPO->cekData($string);


        if (!isset($data['no_order'])) {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('template/template_page_not_found');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        } else {
            $cekProses = $this->modelPO->cekDataMaster($string); // melakukan cek. apakah sudah di proses sebelumnya, kalo sudah tampilkan timelain
            if ($cekProses !== true) {
                $this->load->view('template/template_sales/template_header_sales', $data);
                $this->load->view('template/template_menu');
                $this->load->view('manajemen_penjualan/purchase_order/review/review_purchase_order', $data);
                $this->load->view('template/template_sales/template_right_sales');
                $this->load->view('manajemen_penjualan/purchase_order/review/review_purchase_order_modal');
                $this->load->view('template/template_footer');
                $this->load->view('template/template_js');
                $this->load->view('manajemen_penjualan/purchase_order/review/review_purchase_order_js');
                $this->load->view('template/template_app_js');
            } else {
                $this->load->view('template/template_sales/template_header_sales', $data);
                $this->load->view('template/template_menu');
                $this->load->view('manajemen_penjualan/purchase_order/review/timeline_purchase_order', $data);
                $this->load->view('template/template_sales/template_right_sales');
                $this->load->view('manajemen_penjualan/purchase_order/review/review_purchase_order_modal');
                $this->load->view('template/template_footer');
                $this->load->view('template/template_js');
                $this->load->view('manajemen_penjualan/purchase_order/review/review_purchase_order_js');
                $this->load->view('template/template_app_js');
            }
        }
    }

    public function setDataReview()
    {
        $post = $this->input->post();
        $data = $this->modelPO->setDataReview($post);
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
        pusher_notif_sales();
    }

    function pusher_notif_sales()
    {
        require_once(APPPATH . 'libraries/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'a198692078b54078587e',
            'bbcd6e359ab9b8fb37d2',
            '942885',
            $options
        );

        $data['message'] = 'sales';
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
