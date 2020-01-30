<?php
defined('BASEPATH') or exit('No direct script access allowed');

class MasterBarang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Barang/Model_Master_Barang', 'modelBarang');
        $this->load->model('Manajemen_Barang/Detail_Barang/Model_Detail_Barang', 'modelDetailBarang');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Manajemen_Barang/Model_Detail_Persediaan', 'detailpersediaan');
        $this->load->model('Manajemen_Persediaan/Model_Persediaan_Barang', 'modelPersediaan');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $data['tipe'] = $this->modelBarang->get_data_tjms('master_tipe_barang');
        $data['jenis'] = $this->modelBarang->get_data_tjms('master_jenis_barang');
        $data['merek'] = $this->modelBarang->get_data_tjms('master_merek_barang');
        $data['satuan'] = $this->modelBarang->get_data_tjms('master_satuan_barang');
        $data['supplier'] = $this->modelBarang->get_data_tjms('master_supplier');
        $data['css'] = 'manajemen_barang/master_barang/master_barang_css';
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['title'] = "Data Barang";
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_barang/master_barang/master_barang');
        $this->load->view('template/template_right');
        $this->load->view('manajemen_barang/master_barang/master_barang_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_barang/master_barang/master_barang_js');
        $this->load->view('manajemen_barang/master_barang/master_barang_chart_js');
        $this->load->view('template/template_app_js');
    }

    public function getData()
    {

        $database = $this->modelBarang->get_data();
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $value) {
            $data2 = $this->modelBarang->push_satuan($value['kode_barang']);

            $qty = $this->modelPersediaan->get_data_persediaan($value['kode_barang']);
            if ($qty > 0) {
                $value['jumlah_persediaan'] = $qty;
            } else {
                $value['jumlah_persediaan'] = "0";
            }
            $value['status'] = [
                'status_jual' => $value['status_jual'],
                'kode_barang' => $value['kode_barang']
            ];
            $value['hargapokok'] = $data2;
            $output['data'][] = $value;
        }
        $output = json_encode($output);
        echo $output;
    }
    // Generate Kode Barang Automatic
    public function cekData($string = null)
    {
        if ($string !== null) {
            $data = $this->modelBarang->cekData($string);
            $nourut = 0;
            if ($data !== "1") {
                $nourut = substr($data, 3, 4);
            }
            $nourut++;
            $string = substr($string, 0, 3);
            $nourut =  sprintf("%04s", $nourut);
            echo strtoupper($string) . $nourut;
        } else {
            echo "";
        }
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

    public function edit_data_umum($kode_barang)
    {
        $this->modelDetailBarang->edit_data_umum($kode_barang);
    }

    public function edit_data_harga($kode_barang)
    {
        $this->modelDetailBarang->edit_data_harga($kode_barang);
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

    public function Detail_Barang($kode_barang)
    {

        $data['detail'] = $this->modelDetailBarang->get_data_for_detail($kode_barang);

        $data['tipe'] = $this->modelBarang->get_data_tjms('master_tipe_barang');
        $data['jenis'] = $this->modelBarang->get_data_tjms('master_jenis_barang');
        $data['merek'] = $this->modelBarang->get_data_tjms('master_merek_barang');
        $data['satuan'] = $this->modelBarang->get_data_tjms('master_satuan_barang');
        $data['supplier'] = $this->modelBarang->get_data_tjms('master_supplier');
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'manajemen_barang/master_barang/master_barang_css';
        $data['title'] = "Data Barang " . $kode_barang;
        $data['kode_barang'] = $kode_barang;
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_barang/master_barang/detail_barang/detail_barang', $data);
        $this->load->view('template/template_right');
        $this->load->view('manajemen_barang/master_barang/detail_barang/detail_barang_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_barang/master_barang/detail_barang/detail_barang_js');
        $this->load->view('template/template_app_js');
    }

    public function get_data_for_detail($kode_barang)
    {
        $data = $this->modelDetailBarang->get_data_for_detail($kode_barang);
        $output = json_encode($data);
        echo $output;
    }

    public function SetGambarBaru($kode_barang)
    {
        $this->modelDetailBarang->edit_gambar($kode_barang);
    }

    public function GetGambarBaru($kode_barang)
    {
        $data = $this->modelDetailBarang->get_gambar_baru($kode_barang);
        $output = json_encode($data);
        echo $output;
    }

    // untuk statistik penjualan per barang

    public function get_statistik_penjualan()
    {
        $post = $this->input->post();
        $data = $this->modelBarang->get_statistik_penjualan($post);
        $output = json_encode($data);
        echo $output;
    }

    public function status_update()
    {
        $post = $this->input->post();
        $this->modelBarang->status_update($post);
    }
}
