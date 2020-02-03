<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PurchaseOrder extends CI_Controller
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

    public function init_no_order()
    {
        $this->session->unset_userdata('no_order_dummy');
        $no_order_dummy = date('djy') . random_string('numeric', 2);
        $this->cek_duplikat($no_order_dummy);
    }

    function cek_duplikat($no_order)
    {
        $cek = $this->ModelPO->cek_nomor_order($no_order);
        if ($cek < 1) {
            $this->session->set_userdata('no_order_dummy', 'PO.' . $no_order);
        } else {
            $this->init_no_order();
        }
    }
    public function clear_keranjang_belanja($no_order_lama)
    {
        $this->ModelPO->get_data_keranjang_clear($no_order_lama);
    }

    public function index()
    {
        $this->init_no_order();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['no_order'] = $this->session->userdata('no_order_dummy');
        $data['css'] = 'manajemen_penjualan/purchase_order/purchase_order_css';
        $data['title'] = "Penjualan Barang";
        $this->load->view('template/template_header_sales', $data);
        $this->load->view('template/template_menu');
        $this->load->view('manajemen_penjualan/purchase_order/purchase_order', $data);
        $this->load->view('template/template_right_sales');
        $this->load->view('manajemen_penjualan/purchase_order/purchase_order_modal');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('manajemen_penjualan/purchase_order/purchase_order_js');
        $this->load->view('template/template_app_js');
    }

    public function get_data_pelanggan($id_pelanggan)
    {
        $data = $this->ModelPO->get_data_by_id($id_pelanggan);
        $output = json_encode($data);
        echo $output;
    }

    public function get_data_barang($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->ModelPO->get_data_barang($string);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data"  => $database->num_rows(),
            "data" => array()
        );

        foreach ($data as $value) {
            $qty = $this->modelPersediaan->get_data_persediaan($value['kode_barang']);
            if ($qty > 0) {
                $value['jumlah_persediaan'] = $qty;
            } else {
                $value['jumlah_persediaan'] = "0";
            }
            $output['data'][] = $value;
        }

        $output = json_encode($output);
        echo $output;
    }

    public function push_data_barang()
    {
        $this->ModelPO->push_data_barang();
    }

    public function get_data_keranjang($no_order)
    {
        $database = $this->ModelPO->get_data_keranjang($no_order);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_sum_keranjang($no_order)
    {
        $output = $this->ModelPO->get_sum_keranjang($no_order);
        $output = json_encode($output);
        echo $output;
    }

    public function get_sum_diskon($no_order)
    {
        if (empty($no_order)) {
            $output = array(
                "diskon" => '0'
            );
            $output = json_encode($output);
            echo $output;
        } else {
            $this->db->select_sum('diskon');
            $this->db->where('no_order_penjualan', $no_order);
            $output = $this->db->get('temp_tabel_keranjang_penjualan')->row();
            $output = json_encode($output);
            echo $output;
        }
    }

    public function delete_data_keranjang($id)
    {
        if (empty($id)) {
        } else {
            $this->ModelPO->delete_data_keranjang($id); // delete data
        }
    }

    public function persediaan_temp_tambah()
    {
        $this->ModelPO->persediaan_temp_tambah();
    }

    public function persediaan_temp_batal()
    {
        $this->ModelPO->persediaan_temp_batal();
    }

    public function set_last_no_order($no_order)
    {
        $this->session->set_userdata('reset_keranjang_' . $no_order, $no_order);
    }

    // checkout penjualan


    function push_total_perhitungan()
    {
        $post = $this->input->post();
        $this->ModelPO->push_total_perhitungan($post);
    }

    function get_total_perhitungan($no_order)
    {
        $data = $this->ModelPO->get_total_perhitungan($no_order);
        $output = json_encode($data);
        echo $output;
    }

    function get_diskon($kode_diskon)
    {
        $data = $this->ModelPO->get_diskon($kode_diskon);
        $output = json_encode($data);
        echo $output;
    }

    function bayar_checkout()
    {
        $post = $this->input->post();
        $data = $this->ModelPO->proses_penjualan($post);
    }


    function cekPasswordDirektur()
    {
        $post = $this->input->post();
        $output = $this->ModelPO->cekPasswordDirektur($post);
        echo $output;
    }

    function get_data_persediaan($kode_barang)
    {
        $output = $this->modelPersediaan->get_data_persediaan($kode_barang);
        echo $output;
    }

    function cek_pelanggan($id_pelanggan = "")
    {
        $output = $this->ModelPO->cek_pelanggan($id_pelanggan);
        echo $output;
    }

    function cek()
    {
        $kode_barang = 'B001';
        $this->db->select('*');
        $this->db->from('master_saldo_awal');
        $this->db->where('kode_barang', $kode_barang);
        $saldo_awal = $this->db->get()->row_array();

        print_r($saldo_awal);
        echo $saldo_awal['saldo_awal'];

        $this->db->select_sum('saldo');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('saldo !=', 0);
        $saldo_berjalan = $this->db->get('detail_pembelian')->row_array();

        // cek total persediaan dari saldo awal + berjalan
        // $total_persediaan = $saldo_awal['saldo_awal'] + $saldo_berjalan;
        echo $saldo_berjalan['saldo'];
    }

    function notif_keranjang()
    {
        $post = $this->input->post();
        $database = $this->ModelPO->notif_keranjang($post);
        $data = $database->result_array();
        $output = array(
            "jumlah"  => $database->num_rows(),
            "data" => $data
        );
        $output = json_encode($output);
        echo $output;
    }
}
