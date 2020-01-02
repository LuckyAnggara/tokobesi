<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterBarang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->library('ssp');
        $this->load->library('datatables');
        $this->load->model('manajemen_barang/modelMasterBarang', 'modelBarang');
        $this->load->model('manajemen_barang/modelDetailpersediaan', 'detailpersediaan');
    }

    public function index()
    {
        $data['satuan'] = $this->modelBarang->get_data_satuan();
        $data['css'] = 'manajemen_barang/master_barang/master_barang_css';
        $data['title'] = "Data Barang";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_barang/master_barang/master_barang');
        $this->load->view('template/template_right');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_barang/master_barang/master_barang_js');
        $this->load->view('manajemen_barang/master_barang/master_barang_chart_js');
        $this->load->view('template/template_app_js');
    }

    public function getData($string = null)
    {


        // $string = str_replace("%20", " ", $string);
        // $database = $this->modelBarang->get_data($string);

        // $data = $database->result_array();

        // // $data[]["hargasatuan"] = $data;
        // $output = array(
        //     "draw" => $_POST['draw'],
        //     "recordsTotal" => $this->db->count_all_results(),
        //     "recordsFiltered"  => $database->num_rows(),
        //     "data" => $data
        // );

        $string = str_replace("%20", " ", $string);
        $database = $this->modelBarang->get_data($string);
        $data = $database->result_array();
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $value) {
            $this->db->select("harga_satuan,satuan");
            $this->db->from("master_barang");
            $this->db->where("kode_barang", $value['kode_barang']);
            $data2 = $this->db->get()->row_array();
            $value['hargasatuan'] = $data2;
            $output['data'][] = $value;
        }


        $output = json_encode($output);
        echo $output;
    }
    // Generate Kode Barang Automatic
    public function cekData($string)
    {
        $noUrut = $this->modelBarang->cekData($string);
        $noUrut++;
        echo sprintf("%03s", $noUrut);
    }

    // Tambah Data

    public function tambah_data()
    {
        $this->modelBarang->tambah_data();
    }

    public function view_edit_data($kode_barang)
    {
        $data = $this->modelBarang->view_edit_data($kode_barang);
        $output = json_encode($data);
        echo $output;
    }

    public function edit_data($kode_barang)
    {
        $this->modelBarang->edit_data($kode_barang);
    }

    public function delete_data($kode_barang)
    {
        if (empty($kode_barang)) {
        } else {
            $this->modelBarang->delete_data($kode_barang); // tambah data siswa
        }
    }

    // ambil data satuan

    public function get_data_satuan()
    {
        $data =  $this->modelBarang->get_data_satuan();
        return $data;
    }
}
