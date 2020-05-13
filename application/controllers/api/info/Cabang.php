<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cabang extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Manajemen_Penjualan/Model_Daftar_Transaksi_Penjualan', 'modelDaftarTransaksiPenjualan');
        $this->load->model('Laporan/Model_Laba', 'modelLaba');
        $this->load->model('Api/Model_Master_Persediaan_Api', 'modelMasterPersediaanApi');
        $this->load->model('Dashboard/Model_Dashboard', 'modelDashboard');
        $this->load->model('Api/Model_Dashboard_Api', 'modelDashboardApi');
        $this->load->model('Dashboard/Model_Dashboard_Manajer', 'modelDashboardManajer');
        $this->load->model('Setting/Model_Periode', 'modelPeriode');

        // if ($api == '') {
        //     redirect(base_url("login"));
        // }
    }
    public function cek_token()
    {
        $outtoken = $this->input->post('token');
        $intoken = $this->modelSetting->cekTokenApi();
        if ($intoken === $outtoken) {
            echo 'match';
        } else {
            echo 'notmatch';
        }
    }
    public function data_periode()
    {
        $data = $this->modelPeriode->get_data_periode();
        $output = json_encode($data);
        echo $output;
    }

    public function data()
    {
        $periode = $this->input->post('periode');
        $data['total_laba'] = $this->total_laba($periode);
        $data['total_beban'] = $this->total_beban($periode);
        $data['total_utang'] = $this->modelDashboardApi->data_utang(date("Y-01-01"), $periode);
        $data['total_piutang'] = $this->modelDashboardApi->data_piutang(date("Y-01-01"), $periode);

        $data['transaksi'] = $this->modelDashboard->data_transaksi(date("Y-m-d"), $periode);
        $data['total_penjualan'] = $this->modelDashboard->data_penjualan(date("Y-m-d"), $periode);
        $data['total_pembelian'] = $this->modelDashboard->data_pembelian(date("Y-m-d"), $periode);
        $data['total_produk_terjual'] = $this->modelDashboard->data_produk_terjual(date("Y-m-d"), $periode);

        $data['trend_transaksi'] = $this->modelDashboard->trend_transaksi(date("Y-m-d"), $periode);
        $data['trend_penjualan'] = $this->modelDashboard->trend_penjualan(date("Y-m-d"), $periode);
        $data['trend_pembelian'] = $this->modelDashboard->trend_pembelian(date("Y-m-d"), $periode);
        $data['trend_produk_terjual'] = $this->modelDashboard->trend_produk_terjual(date("Y-m-d"), $periode);

        $data['dropdown_penjualan'] = $this->modelDashboard->dropdown_penjualan($periode);
        $data['dropdown_pembelian'] = $this->modelDashboard->dropdown_pembelian($periode);
        $data['dropdown_produk_terjual'] = $this->modelDashboard->dropdown_produk_terjual($periode);
        $data['dropdown_transaksi_penjualan'] = $this->modelDashboard->dropdown_transaksi_penjualan($periode);

        $output = json_encode($data);
        echo $output;
    }

    public function total_laba($periode)
    {
        $hari = date("d");
        $bulan = date("m");
        $tahun = date("Y");

        $data = $this->modelLaba->laba_berjalan($hari, $bulan, $tahun, $periode);

        return $data;
    }

    public function total_beban($periode)
    {
        $hari = date("d");
        $bulan = date("m");
        $tahun = date("Y");

        $beban_operasional = $this->modelLaba->total_beban_operasional($hari, $bulan, $tahun, $periode);
        $beban_gaji = $this->modelLaba->total_beban_gaji($hari, $bulan, $tahun, $periode);
        $data = $beban_operasional + $beban_gaji;
        return $data;

    }

    public function data_penjualan_terakhir()
    {
        $periode = $this->input->post('periode');

        $database = $this->modelDashboard->get_data_penjualan_terakhir(date("Y-m-d 00-00-00"), $periode);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_penjualan'),
            "recordsFiltered" => $database->num_rows(),
            "data" => array(),
        );

        foreach ($data as $key => $value) {
            if ($value['status_bayar'] == 0) {
                $data = $this->modelDaftarTransaksiPenjualan->get_data_kredit($value['no_faktur']);
                $value['kredit'] = $data;
                $output['data'][] = $value;
            } else {
                $value['kredit'] = "";
                $output['data'][] = $value;
            }
        }

        $output = json_encode($output);
        echo $output;
    }

    public function data_piutang()
    {
        $post = $this->input->post();
        $database = $this->modelDashboardApi->get_data_piutang($post);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_piutang'),
            "recordsFiltered" => $database->num_rows(),
            "data" => array(),
        );

        foreach ($data as $key => $value) {
            $output['data'][] = $value;
        }
        $output = json_encode($output);
        echo $output;
    }

    public function data_utang()
    {
        $post = $this->input->post();
        $database = $this->modelDashboardApi->get_data_utang($post);
        $data = $database->result_array();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results('master_utang'),
            "recordsFiltered" => $database->num_rows(),
            "data" => array(),
        );

        foreach ($data as $key => $value) {
            $output['data'][] = $value;
        }
        $output = json_encode($output);
        echo $output;
    }

    public function get_data_persediaan()
    {
        $post = $this->input->post();

        $database = $this->modelMasterPersediaanApi->getDataBarang();
        $dataBarang = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered" => $database->num_rows(),
            "data" => array(),
        );

        foreach ($dataBarang as $key => $value) {
            $saldoAwal = $this->modelMasterPersediaanApi->saldoAwal($value['kode_barang'], $post);
            if ($saldoAwal == null) {
                $saldoAwal['qty_awal'] = 0;
                $saldoAwal['saldo_awal'] = 0;
                $saldoAwal['harga_awal'] = 0;
            }

            $saldoMasuk = $this->modelMasterPersediaanApi->saldoMasuk($value['kode_barang'], $post);

            $saldoKeluar = $this->modelMasterPersediaanApi->saldoKeluar($value['kode_barang'], $post);

            $saldoCart = $this->modelMasterPersediaanApi->saldoCart($value['kode_barang'], $post);
            $saldoCartPo = $this->modelMasterPersediaanApi->saldoCartPo($value['kode_barang'], $post);

            $saldoAkhir = $this->modelMasterPersediaanApi->saldoAkhir($saldoAwal, $saldoMasuk, $saldoKeluar, $saldoCart, $saldoCartPo);

            $value['saldo_awal'] = $saldoAwal;

            $value['saldo_masuk'] = $saldoMasuk;

            $value['saldo_keluar'] = $saldoKeluar;
            $value['saldo_cart'] = $saldoCart;
            $value['saldo_cart_po'] = $saldoCartPo;
            $value['saldo_akhir'] = $saldoAkhir;
            if ($saldoAkhir !== 0) {
                $output['data'][] = $value;
            }
        }

        $output = json_encode($output);
        echo $output;
    }

    public function top_sales()
    {
        $bulan = $this->input->post('bulan');
        $periode = $this->input->post('periode');
        $data = $this->modelDashboardApi->data_top_sales($bulan, $periode);

        foreach ($data as $key => $value) {
            $data[$key]['detail'] = $this->modelDashboardApi->detail_sales($value['sales']);
        }

        $output = json_encode($data);
        echo $output;
    }

    public function data_total_laba()
    {
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $periode = $this->input->post('periode');

        $data['label'] = $this->modelDashboard->calendar($bulan, $tahun);
        $total = 0;
        foreach ($data['label'] as $key => $value) {
            $laba = $this->modelDashboardApi->get_data_laba_harian($value, $bulan, $tahun, $periode);
            $total = $total + $laba;
            $data['total'][] = $total;
            $data['harian'][] = $laba;
        }

        $output = json_encode($data);
        echo $output;
    }

    public function data_top_produk()
    {
        $option = $this->input->post('option');
        $periode = $this->input->post('periode');
        $data = $this->modelDashboardApi->topProduk($option, $periode);
        if ($data == null) {
            $dataset['nama_barang'][] = "Belum ada data";
            $dataset['jumlah_penjualan'][] = 0;
        } else {
            foreach ($data as $key => $value) {
                $dataset['nama_barang'][] = $value['nama_barang'];
                $dataset['jumlah_penjualan'][] = $value['jumlah_penjualan'];
            }
        }
        $output = json_encode($dataset);
        echo $output;
    }

    public function data_produktifitas_sales()
    {
        $kode_sales = $this->input->post('kode_sales');
        $periode = $this->input->post('periode');

        $data = $this->modelDashboardApi->data_produktifitas_sales($kode_sales, $periode);
        if ($data == null) {
            $dataset['bulan'][] = "belum ada data";
            $dataset['value'][] = 0;
        } else {
            foreach ($data as $key => $value) {
                $dataset['bulan'][] = $value['bulan'];
                $dataset['value'][] = $value['total_penjualan'];
            }
        }

        $output = json_encode($dataset);
        echo $output;
    }

}
