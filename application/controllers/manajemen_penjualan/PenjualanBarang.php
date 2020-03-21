<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Penjualanbarang extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Penjualan/Model_Penjualan_Barang', 'modelPenjualan');
        $this->load->model('Manajemen_Persediaan/Model_Persediaan_Barang', 'modelPersediaan');
        $this->load->model('Manajemen_Penjualan/Model_Invoice', 'modelInvoice');
        $this->load->model('Manajemen_Keuangan/Model_Coh', 'modelCoh');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');
 
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function init_no_order()
    {
        $this->session->unset_userdata('no_order_dummy');
        $no_order_dummy = random_string('numeric', 7);
        $this->cek_duplikat($no_order_dummy);
    }

    function cek_duplikat($no_order)
    {
        $cek = $this->modelPenjualan->cek_nomor_order($no_order);
        if ($cek < 1) {
            $this->session->set_userdata('no_order_dummy', 'OUT' . $no_order);
        } else {
            $this->init_no_order();
        }
    }
    public function clear_keranjang_belanja($no_order_lama)
    {
        $this->modelPenjualan->get_data_keranjang_clear($no_order_lama);
        $this->modelPusher->pusher_update_persediaan();
    }

    public function index()
    {
        if ($this->session->userdata('role') !== "1") {
            redirect(base_url("dashboard"));
        } else {
            $cek_status = $this->modelCoh->cek_ready_kasir();
            $data['menu'] = $this->modelSetting->data_menu();
            $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
            $data['css'] = 'manajemen_penjualan/penjualan_barang/penjualan_barang_css';
            if($cek_status > 0){
                $this->init_no_order();
                $data['no_order'] = $this->session->userdata('no_order_dummy');
                $this->load->view('template/template_header', $data);
                $this->load->view('template/template_menu');
                $this->load->view('manajemen_penjualan/penjualan_barang/penjualan_barang', $data);
                $this->load->view('template/template_right');
                $this->load->view('manajemen_penjualan/penjualan_barang/penjualan_modal');
                $this->load->view('template/template_footer');
                $this->load->view('template/template_js');
                $this->load->view('manajemen_penjualan/penjualan_barang/penjualan_barang_js');
                $this->load->view('template/template_app_js');
            }else{
                $this->load->view('template/template_header', $data);
                $this->load->view('template/template_menu');
                $this->load->view('template/template_lock');
                $this->load->view('template/template_right');
                $this->load->view('template/template_footer');
                $this->load->view('template/template_js');
                $this->load->view('template/template_app_js');
            }
        }
    }

    public function get_data_pelanggan($id_pelanggan)
    {
        $data = $this->modelPenjualan->get_data_by_id($id_pelanggan);
        $output = json_encode($data);
        echo $output;
    }

    public function get_data_barang($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelPenjualan->get_data_barang($string);
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

    public function get_data_barang_versi_select2()

    {
        $string = $this->input->get('query');
        $database = $this->modelPenjualan->get_data_barang($string);
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
        $this->modelPenjualan->push_data_barang();
        $this->modelPusher->pusher_update_persediaan();
    }

    public function get_data_keranjang($no_order)
    {
        $database = $this->modelPenjualan->get_data_keranjang($no_order);
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
        $output = $this->modelPenjualan->get_sum_keranjang($no_order);
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
            $this->modelPenjualan->delete_data_keranjang($id); // delete data
        }
    }

    public function persediaan_temp_tambah()
    {
        $this->modelPenjualan->persediaan_temp_tambah();
    }

    public function persediaan_temp_batal()
    {
        $this->modelPenjualan->persediaan_temp_batal();
    }

    public function set_last_no_order($no_order)
    {
        $this->session->set_userdata('reset_keranjang_' . $no_order, $no_order);
    }

    // checkout penjualan

    function simpan_order()
    {
        $post = $this->input->post();
        $this->modelPenjualan->simpan_order($post);
    }

    function push_total_perhitungan()
    {
        $post = $this->input->post();
        $this->modelPenjualan->push_total_perhitungan($post);
    }

    function get_total_perhitungan($no_order)
    {
        $data = $this->modelPenjualan->get_total_perhitungan($no_order);
        $output = json_encode($data);
        echo $output;
    }

    function get_diskon($kode_diskon)
    {
        $data = $this->modelPenjualan->get_diskon($kode_diskon);
        $output = json_encode($data);
        echo $output;
    }

    function bayar_checkout()
    {
        $post = $this->input->post();
        $data = $this->modelPenjualan->proses_penjualan($post);
    }

    function invoice($no_order_penjualan)
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['menu'] = $this->modelSetting->data_menu();

        $data['data_order'] = $this->modelInvoice->get_data_order($no_order_penjualan);
        $data['detail_order'] = $this->modelInvoice->get_detail_order($no_order_penjualan);
        $data['css'] = 'manajemen_penjualan/invoice/invoice_css';
        $data['title'] = "Cetak Faktur";
        if (!isset($data['data_order']['no_faktur'])) {
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('template/template_page_not_found');
            $this->load->view('template/template_right');
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('template/template_app_js');
        } else {
            if ($data['data_order']['status_bayar'] == 0) {
                $data['data_order'] = $this->modelInvoice->get_data_order_kredit($no_order_penjualan);
                $this->load->view('template/template_header', $data);
                $this->load->view('template/template_menu');
                $this->load->view('manajemen_penjualan/invoice/invoice_kredit', $data);
                $this->load->view('template/template_right');
                $this->load->view('template/template_footer');
                $this->load->view('template/template_js');

                $this->load->view('template/template_app_js');
            } else {

                $this->load->view('template/template_header', $data);
                $this->load->view('template/template_menu');
                $this->load->view('manajemen_penjualan/invoice/invoice', $data);
                $this->load->view('template/template_right');
                $this->load->view('template/template_footer');
                $this->load->view('template/template_js');
                $this->load->view('manajemen_penjualan/invoice/invoice_js');
                $this->load->view('template/template_app_js');
            }
        }
    }


    function cekPasswordOverride()
    {
        $this->db->select('*');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'password_harga');
        $query = $this->db->get()->row_array();
        $role_override = $query['value'];
        $post = $this->input->post();
        $output = $this->modelPenjualan->cekPasswordOverride($post, $role_override);
        echo $output;
    }

    function get_data_persediaan($kode_barang)
    {
        $output = $this->modelPersediaan->get_data_persediaan($kode_barang);
        echo $output;
    }

    function cek_pelanggan($id_pelanggan = "")
    {
        $output = $this->modelPenjualan->cek_pelanggan($id_pelanggan);
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

    // delete last record bisi error

    function revert_error()
    {
        $this->db->query('DELETE from master_penjualan order by id desc limit 1');
        $this->db->query('DELETE from master_pelanggan order by id desc limit 1');
        $this->db->query('DELETE from temp_tabel_keranjang_penjualan order by id desc limit 1');
    }

    function set_harga()
    {
        $post = $this->input->post();
        echo  $this->modelPenjualan->set_harga($post);
    } 

    function surat_jalan()
    {
        $post = $this->input->post();
        echo $this->modelPenjualan->surat_jalan($post);
    }
}
