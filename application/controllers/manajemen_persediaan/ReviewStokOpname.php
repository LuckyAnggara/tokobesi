<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ReviewStokOpname extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('manajemen_persediaan/Model_Master_Persediaan', 'modelMasterPersediaan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->helper(array('form', 'url'));

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['css'] = 'manajemen_persediaan/stok_opname/review_data/review_stok_opname_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/stok_opname/review_data/review_stok_opname');
        $this->load->view('template/template_right');
        // $this->load->view('manajemen_persediaan/stok_opname/stok_opname_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/stok_opname/review_data/review_stok_opname_js');
        $this->load->view('template/template_app_js');
    }

    public function getMasterStokOpnameSpv()
    {
        $database = $this->modelMasterPersediaan->getMasterStokOpnameSpv();
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );

        $output = json_encode($output);
        echo $output;
    }

    public function Review_Detail($no_ref)
    {
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();

        $data['stok_opname'] = $this->modelMasterPersediaan->getDetailMasterStokOpname($no_ref);

        $data['css'] = 'manajemen_persediaan/stok_opname/review_data/review_detail_data/review_detail_stok_opname_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/stok_opname/review_data/review_detail_data/review_detail_stok_opname', $data);
        $this->load->view('template/template_right');
        // $this->load->view('manajemen_persediaan/stok_opname/stok_opname_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/stok_opname/review_data/review_detail_data/review_detail_stok_opname_js');
        $this->load->view('template/template_app_js');
    }

    public function treeview()
    {
        $post = $this->input->post();
        $kode_barang = $this->modelMasterPersediaan->treeviewkodebarang($post);
        $output = array();
        $detail_data = array();

        $char = range('A', 'Z');
        foreach ($kode_barang as $key => $value) {
            $data_barang = $char[$key] . '.   ' . $value['kode_barang'] . ' - ' . $value['nama_barang'] . ' (Selisih : <span class="text-danger">' . $value['selisih'] . '</span>)';
            $detail = $this->modelMasterPersediaan->treeviewdetail($value['id']);

            foreach ($detail as $key => $value) {
                $detail_data[] = 'Koreksi - (<span class="text-danger">' . $value['qty'] . '</span>) - ' . $value['keterangan'];
            }

            $output[] = array(
                'text' => $data_barang,
                'children' => $detail_data,
                'state' => array(
                    'opened' => true
                )
            );
            unset($detail_data);
            $detail_data = array();
        }


        $output = json_encode($output);
        echo $output;
    }

    function approve()
    {
        $post = $this->input->post();
        $this->modelMasterPersediaan->approve_review($post);
    }

    function return()
    {
        $post = $this->input->post();
        $this->modelMasterPersediaan->return_review($post);
    }

    function reject()
    {
        $post = $this->input->post();
        $this->modelMasterPersediaan->reject_review($post);
    }
}
