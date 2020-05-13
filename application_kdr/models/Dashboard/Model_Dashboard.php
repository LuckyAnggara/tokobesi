<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dashboard extends CI_Model
{
    public function data_transaksi($tanggal, $periode)
    {
        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $data = $this->db->get()->num_rows();
        if ($data > 0) {
            return $data;
        } else {
            return 0;
        }
    }

    public function data_penjualan($tanggal, $periode)
    {

        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();
        if ($output['total_penjualan'] == null) {
            return "0";
        } else {
            return $output['total_penjualan'];
        }
    }

    public function data_pembelian($tanggal, $periode)
    {

        $this->db->select_sum('total_pembelian');
        $this->db->from('master_pembelian');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();

        if ($output['total_pembelian'] == null) {
            return "0";
        } else {
            return $output['total_pembelian'];
        }
    }

    public function data_produk_terjual($tanggal, $periode)
    {

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();
        return $output['jumlah_penjualan'];
    }

    // TREND
    public function trend_transaksi($tanggal, $periode)
    {
        // hari ini
        $output2 = $this->data_transaksi($tanggal, $periode);

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:00', strtotime('-1 days', strtotime(date('Y-m-d 00:00:00'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->where('periode', $periode);

        // dibagi..
        $output1 = $this->db->get()->num_rows();
        if ($output1 == 0) {
            $output1 = $output2;
        }

        if ($output2 == 0) {
            return -100;
        } else {
            $hasil = $output2 / $output1;
            return round(($hasil - 1) * 100, 2);
        }
    }

    public function trend_penjualan($tanggal, $periode)
    {
        // hari ini
        $output2 = $this->data_penjualan($tanggal, $periode);

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:00', strtotime('-1 days', strtotime(date('Y-m-d 00:00:00'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();

        $output1 = $output['total_penjualan'];
        if ($output1 == 0) {
            $output1 = $output2;
        }

        if ($output2 == 0) {
            return -100;
        } else {
            $hasil = $output2 / $output1;
            return round(($hasil - 1) * 100, 2);
        }
    }

    public function trend_pembelian($tanggal, $periode)
    {
        // hari ini
        $output2 = $this->data_pembelian($tanggal, $periode);

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-1 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('total_pembelian');
        $this->db->from('master_pembelian');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();

        $output1 = $output['total_pembelian'];

        if ($output1 == 0) {
            $output1 = $output2;
        }

        if ($output2 == 0) {
            return -100;
        } else {
            $hasil = $output2 / $output1;
            return round(($hasil - 1) * 100, 2);
        }
    }

    public function trend_produk_terjual($tanggal, $periode)
    {
        // hari ini
        $output2 = $this->data_produk_terjual($tanggal, $periode);

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-1 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();
        $output1 = $output['jumlah_penjualan'];
        if ($output1 == 0) {
            $output1 = $output2;
        }

        if ($output2 == 0) {
            return -100;
        } else {
            $hasil = $output2 / $output1;
            return round(($hasil - 1) * 100, 2);
        }
    }

    // DROPDOWN UNTUK LIHAT 5 HARI TERAKHIR

    public function dropdown_penjualan($periode)
    {
        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-5 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('total_penjualan');
        $this->db->select("DATE_FORMAT(tanggal_transaksi,'%Y-%m-%d') as tanggal");
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->where('periode', $periode);

        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5);

        $output = $this->db->get()->result_array();
        return $output;
    }

    public function dropdown_pembelian($periode)
    {

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-5 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('total_pembelian');
        $this->db->select("DATE_FORMAT(tanggal_transaksi,'%Y-%m-%d') as tanggal");
        $this->db->from('master_pembelian');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->where('periode', $periode);

        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5);

        $output = $this->db->get()->result_array();
        return $output;
    }

    public function dropdown_produk_terjual($periode)
    {

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-5 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('jumlah_penjualan');
        $this->db->select("DATE_FORMAT(tanggal_transaksi,'%Y-%m-%d') as tanggal");
        $this->db->from('detail_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->where('periode', $periode);

        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5);

        $output = $this->db->get()->result_array();
        return $output;
    }

    public function dropdown_transaksi_penjualan($periode)
    {

        //hari kemarin

        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-5 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select('COUNT(master_penjualan.no_faktur) as jumlah');
        $this->db->select("DATE_FORMAT(tanggal_transaksi,'%Y-%m-%d') as tanggal");
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->where('periode', $periode);

        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5);

        $output = $this->db->get()->result_array();
        return $output;
    }

    // TOP SALES

    public function data_top_sales($bulan)
    {
        $periode = $this->modelSetting->get_data_periode();
        $this->db->select('sales, COUNT(sales) as total_transaksi, EXTRACT( MONTH FROM `tanggal_transaksi`) as bulan');
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('EXTRACT( MONTH FROM `tanggal_transaksi`) = ', $bulan);
        $this->db->where('sales !=', 'nosales');
        $this->db->where('periode', $periode);

        $this->db->group_by('sales');
        $this->db->limit(5);
        $this->db->order_by('total_penjualan', 'DESC');

        $output = $this->db->get()->result_array();
        return $output;
    }

    public function detail_sales($kode_sales)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $kode_sales);
        $output = $this->db->get()->row_array();
        return $output;
    }

    // penjualan terakhir

    public function get_data_penjualan_terakhir($tanggal, $periode)
    {
        $this->db->select('master_penjualan.status_bayar,master_penjualan.no_faktur, master_penjualan.sales, master_penjualan.total_penjualan, DATE_FORMAT(`tanggal_transaksi`, "%H:%i") as jam, DATE_FORMAT(`tanggal_transaksi`, "%d-%M-%y") as tanggal, master_user.nama');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $this->db->limit(5);
        $this->db->order_by('id', 'DESC');
        $output = $this->db->get();
        return $output;
    }
    // penjualan terakhir kasir hari ini

    // get data laba

    public function calendar($month, $year)
    {
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($i = 0; $i < $num; $i++) {
            $data[] = ($i + 1);
        }
        return $data;
    }

    public function get_data_laba_total($hari, $bulan, $tahun)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $tanggal1 = date("Y-m-d 00:00:00", strtotime($tanggalawal));
        $tanggal2 = date("Y-m-d 23:59:59", strtotime($tanggal));

        $this->db->select('sum(`qty` * `harga_pokok`) as totalpokok , sum(`qty` * `harga_jual`) as totaljual');
        $this->db->from('master_harga_pokok_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal1);
        $this->db->where('tanggal_transaksi <=', $tanggal2);

        $data = $this->db->get()->row_array();
        $totalPokok = $data['totalpokok'];
        $totalJual = $data['totaljual'];
        $hasil = $totalJual - $totalPokok;

        return $hasil;

        // cari hpp nya
    }

    public function get_data_laba_harianv2($hari, $bulan, $tahun)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal1 = date("Y-m-d 00:00:00", strtotime($tanggal));
        $tanggal2 = date("Y-m-d 23:59:59", strtotime($tanggal));

        $this->db->select('sum(`qty` * `harga_pokok`) as totalpokok , sum(`qty` * `harga_jual`) as totaljual');
        $this->db->from('master_harga_pokok_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal1);
        $this->db->where('tanggal_transaksi <=', $tanggal2);

        $data = $this->db->get()->row_array();
        $totalPokok = $data['totalpokok'];
        $totalJual = $data['totaljual'];

        $total_retur = $this->retur_penjualan($hari, $bulan, $tahun);
        $persediaan_retur = $this->retur_persediaan_penjualan($hari, $bulan, $tahun);
        $hasil = ($totalJual - $total_retur) - ($totalPokok - $persediaan_retur);

        return $hasil;

        // cari hpp nya
    }

    public function retur_penjualan($hari, $bulan, $tahun)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal1 = date("Y-m-d 00:00:00", strtotime($tanggal));
        $tanggal2 = date("Y-m-d 23:59:59", strtotime($tanggal));

        $this->db->select('sum(`retur_total`) as total_retur');
        $this->db->from('master_retur_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal1);
        $this->db->where('tanggal_transaksi <=', $tanggal2);
        $output = $this->db->get()->row();
        if ($output->total_retur == null) {
            return 0;
        } else {
            return $output->total_retur;
        }

    }

    public function retur_persediaan_penjualan($hari, $bulan, $tahun)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal1 = date("Y-m-d 00:00:00", strtotime($tanggal));
        $tanggal2 = date("Y-m-d 23:59:59", strtotime($tanggal));

        $this->db->select('sum(`saldo_retur`*`harga_pokok`) as total_retur');
        $this->db->from('detail_retur_barang_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal1);
        $this->db->where('tanggal_transaksi <=', $tanggal2);
        $output = $this->db->get()->row();
        if ($output->total_retur == null) {
            return 0;
        } else {
            return $output->total_retur;
        }
    }

    // function get_data_laba_total($hari, $bulan, $tahun)
    // {
    //     $tanggal = $tahun . "-" . $bulan . "-" . $hari;
    //     $tanggalawal = $tahun . "-" . $bulan . "-" . 01;
    //     $tanggal1 =  date("Y-m-d 00:00:00", strtotime($tanggalawal));
    //     $tanggal2 =  date("Y-m-d 23:59:59", strtotime($tanggal));

    //     $this->db->select_sum('total_penjualan');
    //     $this->db->select('no_faktur, DATE_FORMAT(`tanggal_transaksi`, "%e") as hari,DATE_FORMAT(`tanggal_transaksi`, "%m") as tahun, DATE_FORMAT(`tanggal_transaksi`, "%Y") as tahun ');
    //     $this->db->from('master_penjualan');
    //     $this->db->where('tanggal_transaksi >=', $tanggal1);
    //     $this->db->where('tanggal_transaksi <=', $tanggal2);

    //     $data =  $this->db->get()->row_array();

    //     $harga_pokok = $this->_cari_harga_pokok($data['no_faktur']);
    //     $hasil = $data['total_penjualan'] - $harga_pokok['total'];

    //     return $hasil / 1000000;

    //     // cari hpp nya
    // }

    // function get_data_laba_harian($hari, $bulan, $tahun)
    // {
    //     $tanggal = $tahun . "-" . $bulan . "-" . $hari;
    //     $tanggal1 =  date("Y-m-d 00:00:00", strtotime($tanggal));
    //     $tanggal2 =  date("Y-m-d 23:59:59", strtotime($tanggal));

    //     $this->db->select_sum('total_penjualan');
    //     $this->db->select('no_faktur, DATE_FORMAT(`tanggal_transaksi`, "%e") as hari,DATE_FORMAT(`tanggal_transaksi`, "%m") as tahun, DATE_FORMAT(`tanggal_transaksi`, "%Y") as tahun ');
    //     $this->db->from('master_penjualan');
    //     $this->db->where('tanggal_transaksi >=', $tanggal1);
    //     $this->db->where('tanggal_transaksi <=', $tanggal2);

    //     $data =  $this->db->get()->row_array();

    //     $harga_pokok = $this->_cari_harga_pokok($data['no_faktur']);

    //     $hasil = $data['total_penjualan'] - $harga_pokok['total'];
    //     return $hasil / 1000000;
    //     // cari hpp nya

    // }

    // private function _cari_harga_pokok($no_faktur)
    // {
    //     $this->db->select('sum(`qty` * `harga_pokok`) as total');
    //     $this->db->from('master_harga_pokok_penjualan');
    //     $this->db->where('nomor_faktur', $no_faktur);
    //     return $this->db->get()->row_array();
    // }

    // Donut untuk TOP PRODUK

    public function topProduk($option)
    {
        $periode = $this->modelSetting->get_data_periode();

        if ($option == 1) { // 1 artinya hari ini.. 2 bulan ini
            $tanggal = date("Y-m-d");
            $tanggal1 = date("Y-m-d 00:00:00", strtotime($tanggal));
            $tanggal2 = date("Y-m-d 23:59:59", strtotime($tanggal));
        } else if ($option == 2) {
            $tanggal1 = date("Y-m-01 00:00:00");
            $tanggal2 = date("Y-m-t 23:59:59");
        } else {
            $tanggal1 = date("Y-m-01 00:00:00");
            $tanggal2 = date("Y-m-t 23:59:59");
        }

        $this->db->select_sum('jumlah_penjualan');
        $this->db->select('master_barang.nama_barang');
        $this->db->from('detail_penjualan');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_penjualan.kode_barang');
        $this->db->where('tanggal_transaksi >=', $tanggal1);
        $this->db->where('tanggal_transaksi <=', $tanggal2);
        $this->db->where('periode', $periode);

        $this->db->group_by('detail_penjualan.kode_barang');
        $this->db->limit('5');

        return $this->db->get()->result_array();
    }

    //produktifitas sales

    public function getDataSales()
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('role', '3');

        return $this->db->get()->result_array();
    }

    public function data_produktifitas_sales($kode_sales)
    {
        $periode = $this->modelSetting->get_data_periode();

        $this->db->select_sum('total_penjualan');
        $this->db->select("DATE_FORMAT(tanggal_transaksi, '%b') as bulan");
        $this->db->from('master_penjualan');
        $this->db->where('sales', $kode_sales);
        $this->db->where('periode', $periode);
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'DESC');
        return $this->db->get()->result_array();
    }

    public function get_data_piutang()
    {
        $periode = $this->modelSetting->get_data_periode();

        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_piutang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_piutang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_piutang');
        $this->db->join('master_user', 'master_user.username = master_piutang.user');
        $this->db->where('sisa_piutang !=', 0);
        $this->db->where('periode', $periode);

        $this->db->order_by('master_piutang.tanggal_jatuh_tempo', 'ASC');
        $output = $this->db->get();
        return $output;
    }

    public function get_data_utang()
    {
        $periode = $this->modelSetting->get_data_periode();

        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_utang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_utang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_utang');
        $this->db->join('master_user', 'master_user.username = master_utang.user');
        $this->db->where('sisa_utang !=', 0);
        $this->db->where('periode', $periode);

        $this->db->order_by('master_utang.tanggal_jatuh_tempo', 'ASC');
        $output = $this->db->get();
        return $output;
    }

    // data kasir tambahan

    public function get_data_laba_harian($hari, $bulan, $tahun)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal1 = date("Y-m-d 00:00:00", strtotime($tanggal));
        $tanggal2 = date("Y-m-d 23:59:59", strtotime($tanggal));

        $persediaan_awal = $this->saldo_persediaan_awal();
        $sisa_persediaan_awal = $this->saldo_sisa_persediaan_awal($tanggal1, $tanggal2);
        $pembelian_bersih = $this->saldo_pembelian_bersih($tanggal1, $tanggal2);
        $retur_pembelian = $this->saldo_retur_pembelian($tanggal1, $tanggal2);
        $sisa_saldo_pembelian_bersih = $this->saldo_sisa_pembelian_bersih($tanggal1, $tanggal2);
        $penjualan_bersih = $this->saldo_penjualan_bersih($tanggal1, $tanggal2);
        $retur_penjualan_bersih = $this->saldo_retur_penjualan($tanggal1, $tanggal2);

        $awal = $persediaan_awal - $sisa_persediaan_awal;
        $pembelian = ($pembelian_bersih - $sisa_saldo_pembelian_bersih) - $retur_pembelian;
        $penjualan = $penjualan_bersih - $retur_penjualan_bersih;

        $hasil = $penjualan - ($awal + $pembelian);
        // return $hasil;

        $output = [
            'persediaan_awal' => $persediaan_awal,
            'sisa_persediaan_awal' => $sisa_persediaan_awal,
            'pembelian_bersih' => $pembelian_bersih,
            'retur_pembelian' => $retur_pembelian,
            'sisa_saldo_pembelian_bersih' => $sisa_saldo_pembelian_bersih,
            'penjualan_bersih' => $penjualan_bersih,
            'retur_penjualan_bersih' => $retur_penjualan_bersih,
        ];

        return $output;
    }

    private function saldo_persediaan_awal()
    {
        $this->db->select('SUM(`qty_awal`*`harga_awal`) as persediaan_awal');
        $this->db->from('master_saldo_awal');
        $output = $this->db->get()->row();
        if ($output->persediaan_awal == null) {
            return 0;
        } else {
            return $output->persediaan_awal;
        }
    }

    private function saldo_sisa_persediaan_awal($tanggal1, $tanggal2)
    {
        $this->db->select('SUM(`saldo_awal`*`harga_awal`) as sisa_persediaan_awal');
        $this->db->from('master_saldo_awal');
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($tanggal1)));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($tanggal2)));
        $output = $this->db->get()->row();
        if ($output->sisa_persediaan_awal == null) {
            return 0;
        } else {
            return $output->sisa_persediaan_awal;
        }
    }

    private function saldo_pembelian_bersih($tanggal1, $tanggal2)
    {
        $this->db->select('SUM(`jumlah_pembelian`*`harga_beli`) as pembelian_bersih');
        $this->db->from('detail_pembelian');
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggal1)));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal2)));
        $output = $this->db->get()->row();
        if ($output->pembelian_bersih == null) {
            return 0;
        } else {
            return $output->pembelian_bersih;
        }
    }

    private function saldo_retur_pembelian($tanggal1, $tanggal2)
    {
        $this->db->select('SUM(`jumlah_retur`*`harga_retur`) as retur_pembelian');
        $this->db->from('detail_retur_pembelian');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggal1)));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal2)));
        $output = $this->db->get()->row();
        if ($output->retur_pembelian == null) {
            return 0;
        } else {
            return $output->retur_pembelian;
        }

    }

    private function saldo_sisa_pembelian_bersih($tanggal1, $tanggal2)
    {
        $this->db->select('SUM(`saldo`*`harga_beli`) as sisa_pembelian_bersih');
        $this->db->from('detail_pembelian');
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggal1)));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal2)));
        $output = $this->db->get()->row();
        if ($output->sisa_pembelian_bersih == null) {
            return 0;
        } else {
            return $output->sisa_pembelian_bersih;
        }
    }
    private function saldo_penjualan_bersih($tanggal1, $tanggal2)
    {
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggal1)));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal2)));
        $output = $this->db->get()->row();
        if ($output->total_penjualan == null) {
            return 0;
        } else {
            return $output->total_penjualan;
        }
    }
    private function saldo_retur_penjualan($tanggal1, $tanggal2)
    {
        $this->db->select_sum('retur_total');
        $this->db->from('master_retur_penjualan');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggal1)));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal2)));
        $output = $this->db->get()->row();
        if ($output->retur_total == null) {
            return 0;
        } else {
            return $output->retur_total;
        }
    }

}
