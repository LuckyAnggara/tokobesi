<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dashboard extends CI_Model
{
    function data_transaksi($tanggal)
    {

        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));
        $data = $this->db->get()->num_rows();
        if ($data > 0) {
            return $data;
        } else {
            return 0;
        }
    }

    function data_penjualan($tanggal)
    {

        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));

        $output = $this->db->get()->row_array();
        if ($output['total_penjualan'] == null) {
            return "0";
        } else {
            return $output['total_penjualan'];
        }
    }

    function data_pembelian($tanggal)
    {

        $this->db->select_sum('total_pembelian');
        $this->db->from('master_pembelian');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));

        $output = $this->db->get()->row_array();

        if ($output['total_pembelian'] == null) {
            return "0";
        } else {
            return $output['total_pembelian'];
        }
    }


    function data_produk_terjual($tanggal)
    {

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));

        $output = $this->db->get()->row_array();
        return $output['jumlah_penjualan'];
    }



    // TREND
    function trend_transaksi($tanggal)
    {
        // hari ini
        $output2 = $this->data_transaksi($tanggal);

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:00', strtotime('-1 days', strtotime(date('Y-m-d 00:00:00'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
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

    function trend_penjualan($tanggal)
    {
        // hari ini
        $output2 = $this->data_penjualan($tanggal);

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:00', strtotime('-1 days', strtotime(date('Y-m-d 00:00:00'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);

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

    function trend_pembelian($tanggal)
    {
        // hari ini
        $output2 = $this->data_pembelian($tanggal);

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-1 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('total_pembelian');
        $this->db->from('master_pembelian');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);

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

    function trend_produk_terjual($tanggal)
    {
        // hari ini
        $output2 = $this->data_produk_terjual($tanggal);

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-1 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);

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

    function dropdown_penjualan()
    {

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-5 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('total_penjualan');
        $this->db->select("DATE_FORMAT(tanggal_transaksi,'%Y-%m-%d') as tanggal");
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5);

        $output = $this->db->get()->result_array();
        return $output;
    }

    function dropdown_pembelian()
    {

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-5 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('total_pembelian');
        $this->db->select("DATE_FORMAT(tanggal_transaksi,'%Y-%m-%d') as tanggal");
        $this->db->from('master_pembelian');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5);

        $output = $this->db->get()->result_array();
        return $output;
    }

    function dropdown_produk_terjual()
    {

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-5 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select_sum('jumlah_penjualan');
        $this->db->select("DATE_FORMAT(tanggal_transaksi,'%Y-%m-%d') as tanggal");
        $this->db->from('detail_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5);

        $output = $this->db->get()->result_array();
        return $output;
    }

    function dropdown_transaksi_penjualan()
    {

        //hari kemarin
        $tanggalkemarin1 = date('Y-m-d 00:00:01', strtotime('-5 days', strtotime(date('Y-m-d 00:00:01'))));
        $tanggalkemarin2 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime(date('Y-m-d 23:59:59'))));

        $this->db->select('COUNT(master_penjualan.no_faktur) as jumlah');
        $this->db->select("DATE_FORMAT(tanggal_transaksi,'%Y-%m-%d') as tanggal");
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggalkemarin1);
        $this->db->where('tanggal_transaksi <=', $tanggalkemarin2);
        $this->db->group_by('tanggal');
        $this->db->order_by('tanggal', 'DESC');
        $this->db->limit(5);

        $output = $this->db->get()->result_array();
        return $output;
    }



    // TOP SALES


    function data_top_sales($bulan)
    {
        $this->db->select('sales, COUNT(sales) as total_transaksi, EXTRACT( MONTH FROM `tanggal_transaksi`) as bulan');
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('EXTRACT( MONTH FROM `tanggal_transaksi`) = ', $bulan);
        $this->db->where('sales !=', 'nosales');
        $this->db->group_by('sales');
        $this->db->limit(5);
        $this->db->order_by('total_penjualan', 'DESC');

        $output = $this->db->get()->result_array();
        return $output;
    }

    function detail_sales($kode_sales)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $kode_sales);
        $output = $this->db->get()->row_array();
        return $output;
    }

    // penjualan terakhir

    function get_data_penjualan_terakhir($tanggal)
    {
        $this->db->select('master_penjualan.status_bayar,master_penjualan.no_faktur, master_penjualan.sales, master_penjualan.total_penjualan, DATE_FORMAT(`tanggal_transaksi`, "%H:%i") as jam, DATE_FORMAT(`tanggal_transaksi`, "%d-%M-%y") as tanggal, master_user.nama');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->where('tanggal_transaksi >=', $tanggal);
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59'));
        $this->db->limit(5);
        $this->db->order_by('id', 'DESC');
        $output = $this->db->get();
        return $output;
    }

    // get data laba

    function calendar($month, $year)
    {
        $num = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        for ($i = 0; $i < $num; $i++) {
            $data[] = ($i + 1);
        }
        return $data;
    }

    function get_data_laba_total($hari, $bulan, $tahun)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $tanggal1 =  date("Y-m-d 00:00:00", strtotime($tanggalawal));
        $tanggal2 =  date("Y-m-d 23:59:59", strtotime($tanggal));

        $this->db->select('sum(`qty` * `harga_pokok`) as totalpokok , sum(`qty` * `harga_jual`) as totaljual');
        $this->db->from('master_harga_pokok_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal1);
        $this->db->where('tanggal_transaksi <=', $tanggal2);

        $data =  $this->db->get()->row_array();
        $totalPokok = $data['totalpokok'];
        $totalJual = $data['totaljual'];
        $hasil = $totalJual - $totalPokok;

        return $hasil;

        // cari hpp nya
    }

    function get_data_laba_harian($hari, $bulan, $tahun)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal1 =  date("Y-m-d 00:00:00", strtotime($tanggal));
        $tanggal2 =  date("Y-m-d 23:59:59", strtotime($tanggal));

        $this->db->select('sum(`qty` * `harga_pokok`) as totalpokok , sum(`qty` * `harga_jual`) as totaljual');
        $this->db->from('master_harga_pokok_penjualan');
        $this->db->where('tanggal_transaksi >=', $tanggal1);
        $this->db->where('tanggal_transaksi <=', $tanggal2);

        $data =  $this->db->get()->row_array();
        $totalPokok = $data['totalpokok'];
        $totalJual = $data['totaljual'];
        $hasil = $totalJual - $totalPokok;

        return $hasil ;

        // cari hpp nya
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

    function topProduk($option)
    {
        if ($option == 1) { // 1 artinya hari ini.. 2 bulan ini
            $tanggal = date("Y-m-d");
            $tanggal1 =  date("Y-m-d 00:00:00", strtotime($tanggal));
            $tanggal2 =  date("Y-m-d 23:59:59", strtotime($tanggal));
        } else if ($option == 2) {
            $tanggal1 =  date("Y-m-01 00:00:00");
            $tanggal2 =  date("Y-m-t 23:59:59");
        } else {
            $tanggal1 =  date("Y-m-01 00:00:00");
            $tanggal2 =  date("Y-m-t 23:59:59");
        }

        $this->db->select_sum('jumlah_penjualan');
        $this->db->select('master_barang.nama_barang');
        $this->db->from('detail_penjualan');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_penjualan.kode_barang');
        $this->db->where('tanggal_transaksi >=', $tanggal1);
        $this->db->where('tanggal_transaksi <=', $tanggal2);
        $this->db->group_by('detail_penjualan.kode_barang');
        $this->db->limit('5');

        return $this->db->get()->result_array();
    }

    //produktifitas sales

    function getDataSales()
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('role', '3');

        return $this->db->get()->result_array();
    }

    function data_produktifitas_sales($kode_sales)
    {
        $this->db->select_sum('total_penjualan');
        $this->db->select("DATE_FORMAT(tanggal_transaksi, '%b') as bulan");
        $this->db->from('master_penjualan');
        $this->db->where('sales', $kode_sales);
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'DESC');
        return $this->db->get()->result_array();
    }


    function get_data_piutang()
    {
        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_piutang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_piutang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_piutang');
        $this->db->join('master_user', 'master_user.username = master_piutang.user');
        $this->db->where('sisa_piutang !=', 0);
        $this->db->order_by('master_piutang.tanggal_jatuh_tempo', 'ASC');
        $output = $this->db->get();
        return $output;
    }


    function get_data_utang()
    {
        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_utang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_utang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_utang');
        $this->db->join('master_user', 'master_user.username = master_utang.user');
        $this->db->where('sisa_utang !=', 0);
        $this->db->order_by('master_utang.tanggal_jatuh_tempo', 'ASC');
        $output = $this->db->get();
        return $output;
    }
}
