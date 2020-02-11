<?php
defined('BASEPATH') or exit('No direct script access allowed');

class StokOpname extends CI_Controller
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
        $data['css'] = 'manajemen_persediaan/stok_opname/stok_opname_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/stok_opname/stok_opname');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_persediaan/stok_opname/stok_opname_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/stok_opname/stok_opname_js');
        $this->load->view('template/template_app_js');
    }


    public function tambah_data()
    {
        $data['css'] = 'manajemen_persediaan/stok_opname/tambah_data/tambah_stok_opname_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/stok_opname/tambah_data/tambah_stok_opname');
        $this->load->view('template/template_right');
        // $this->load->view('manajemen_persediaan/stok_opname/stok_opname_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/stok_opname/tambah_data/tambah_stok_opname_js');
        $this->load->view('template/template_app_js');
    }

    public function detail_stokopname($no_ref)
    {
        
        $data['css'] = 'manajemen_persediaan/stok_opname/detail_data/detail_stok_opname_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['stok_opname'] = $this->modelMasterPersediaan->getDetailMasterStokOpname($no_ref);
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_persediaan/stok_opname/detail_data/detail_stok_opname',$data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_persediaan/stok_opname/detail_data/detail_stok_opname_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_persediaan/stok_opname/detail_data/detail_stok_opname_js');
        $this->load->view('template/template_app_js');
    }

    public function getDetailMasterStokOpname(){
        $no_ref = $this->input->post('no_ref');
        $data = $this->modelMasterPersediaan->getDetailMasterStokOpname($no_ref);
        $output = json_encode($data);
        echo $output;
    }
    

    public function getDataStokOpname($no_ref)
    {
        $database = $this->modelMasterPersediaan->getDataStokOpname($no_ref);
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($dataBarang as $key => $value) {

            $data_barang = $this->modelMasterPersediaan->dataBarang($value['kode_barang']);

            $value['data_barang'] = $data_barang;

            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }

    public function getMasterStokOpname()
    {
        $database = $this->modelMasterPersediaan->getMasterStokOpname();
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $dataBarang
        );

        $output = json_encode($output);
        echo $output;
    }

    public function random_ref()
    {
        $number = $this->modelMasterPersediaan->random_ref();
        $output =  "REF" . $number;
        $output = json_encode($output);
        echo $output;
    }

    public function tambah_stokopname()
    {
        $post = $this->input->post();
        $this->modelMasterPersediaan->tambah_data($post);
        $this->modelMasterPersediaan->tambah_detail_data($post);
    }

    public function import_data()
    {
        $no_ref = $this->input->post('nomor_referensi');
        $this->modelMasterPersediaan->update_data_by_upload($no_ref);
    }
}
