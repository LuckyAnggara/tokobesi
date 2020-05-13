<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dashboard_Api extends CI_Model
{

    public function get_data_piutang($post)
    {
        $periode = $post['periode'];

        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_piutang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_piutang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_piutang');
        $this->db->join('master_user', 'master_user.username = master_piutang.user');
        $this->db->where('sisa_piutang !=', 0);
        $this->db->where('periode', $periode);

        $this->db->order_by('master_piutang.tanggal_jatuh_tempo', 'ASC');
        $output = $this->db->get();
        return $output;
    }

    public function get_data_utang($post)
    {
        $periode = $post['periode'];

        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_utang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_utang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_utang');
        $this->db->join('master_user', 'master_user.username = master_utang.user');
        $this->db->where('sisa_utang !=', 0);
        $this->db->where('periode', $periode);

        $this->db->order_by('master_utang.tanggal_jatuh_tempo', 'ASC');
        $output = $this->db->get();
        return $output;
    }

    public function data_top_sales($bulan, $periode)
    {
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

    public function data_utang($tanggal, $periode)
    {

        $this->db->select_sum('sisa_utang');
        $this->db->from('master_utang');
        $this->db->where('tanggal_input >=', $tanggal);
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();
        if ($output['sisa_utang'] == null) {
            return "0";
        } else {
            return $output['sisa_utang'];
        }
    }

    public function data_piutang($tanggal, $periode)
    {

        $this->db->select_sum('sisa_piutang');
        $this->db->from('master_piutang');
        $this->db->where('tanggal_input >=', $tanggal);
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();
        if ($output['sisa_piutang'] == null) {
            return "0";
        } else {
            return $output['sisa_piutang'];
        }
    }

    public function get_data_laba_harian($hari, $bulan, $tahun, $periode)
    {
        return $this->laba_harian($hari, $bulan, $tahun, $periode);
    }

    public function laba_harian($hari, $bulan, $tahun, $periode)
    {
        $penjualan_kotor = $this->penjualan_kotor($hari, $bulan, $tahun, $periode);
        $harga_pokok_penjualan = $this->harga_pokok_penjualan($hari, $bulan, $tahun, $periode);
        return $penjualan_kotor - $harga_pokok_penjualan;
    }

    // menghitung persediaan awal

    public function persediaan_awal($hari = null, $bulan = null, $tahun = null, $periode)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        $this->db->select('SUM(`qty_awal`*`harga_awal`) as persediaan_awal');
        $this->db->from('master_saldo_awal');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->persediaan_awal == null) {
            return 0;
        } else {
            return $output->persediaan_awal;
        }
    }

    public function persediaan_tersedia($hari, $bulan, $tahun, $periode)
    {
        $pembelian_kotor = $this->pembelian_kotor($hari, $bulan, $tahun, $periode);
        $persediaan_awal = $this->persediaan_awal($hari, $bulan, $tahun, $periode);
        return $persediaan_awal + $pembelian_kotor;
    }

    // menghitung total pembelian

    public function total_pembelian($hari = null, $bulan = null, $tahun = null, $periode)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('total_pembelian');
        $this->db->from('master_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->total_pembelian == null) {
            return "0";
        } else {
            return $output->total_pembelian;
        }
    }

    public function potongan_pembelian($hari = null, $bulan = null, $tahun = null, $periode)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('diskon');
        $this->db->from('master_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->diskon == null) {
            return "0";
        } else {
            return $output->diskon;
        }
    }

    public function retur_pembelian($hari = null, $bulan = null, $tahun = null, $periode)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('retur_total');
        $this->db->from('master_retur_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->retur_total == null) {
            return "0";
        } else {
            return $output->retur_total;
        }
    }

    public function total_potongan_pembelian($hari, $bulan, $tahun, $periode)
    {
        $potongan_pembelian = $this->potongan_pembelian($hari, $bulan, $tahun, $periode);
        $retur_pembelian = $this->retur_pembelian($hari, $bulan, $tahun, $periode);
        return $potongan_pembelian + $retur_pembelian;
    }

    public function pembelian_kotor($hari, $bulan, $tahun, $periode)
    {
        $total_pembelian = $this->total_pembelian($hari, $bulan, $tahun, $periode);
        $total_potongan_pembelian = $this->total_potongan_pembelian($hari, $bulan, $tahun, $periode);
        return $total_pembelian - $total_potongan_pembelian;
    }

    // menghitung penjualan kotor

    public function total_penjualan($hari = null, $bulan = null, $tahun = null, $periode)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('periode', $periode);

        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }

        $total_penjualan = $this->db->get()->row();
        if ($total_penjualan->total_penjualan == null) {
            $total_penjualan = "0";
        } else {
            $total_penjualan = $total_penjualan->total_penjualan;
        }

        // $this->db->select_sum('retur_total');
        // $this->db->from('master_retur_penjualan');
        // if ($tanggal !== "--") {
        //     $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
        //     $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        // }
        //     $total_retur = $this->db->get()->row();
        //     if ($total_retur->retur_total == null) {
        //         $total_retur =  "0";
        //     } else {
        //     $total_retur = $total_retur->retur_total;
        // }

        return $total_penjualan;
    }

    public function potongan_penjualan($hari = null, $bulan = null, $tahun = null, $periode)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;
        $this->db->select_sum('diskon');
        $this->db->from('master_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->diskon == null) {
            return "0";
        } else {
            return $output->diskon;
        }
    }

    public function retur_penjualan($hari = null, $bulan = null, $tahun = null, $periode)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;
        $this->db->select_sum('retur_total');
        $this->db->from('master_retur_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->retur_total == null) {
            return "0";
        } else {
            return $output->retur_total;
        }
    }

    public function total_potongan_penjualan($hari, $bulan, $tahun, $periode)
    {
        $potongan_penjualan = $this->potongan_penjualan($hari, $bulan, $tahun, $periode);
        $retur_penjualan = $this->retur_penjualan($hari, $bulan, $tahun, $periode);
        return $potongan_penjualan + $retur_penjualan;
    }

    public function penjualan_kotor($hari, $bulan, $tahun, $periode)
    {
        $total_penjualan = $this->total_penjualan($hari, $bulan, $tahun, $periode);
        $total_potongan_penjualan = $this->total_potongan_penjualan($hari, $bulan, $tahun, $periode);
        return $total_penjualan - $total_potongan_penjualan;
    }

    public function persediaan_akhir($hari, $bulan, $tahun, $periode)
    {
        $tanggal1 = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal2 = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        $this->db->select('SUM(`saldo`*`harga_pokok`) as awal');
        $this->db->from('detail_persediaan');
        if ($tanggal1 !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal1)));
        }
        $output = $this->db->get()->row();
        $awal = $output->awal;

        $this->db->select('SUM(`debit`*`harga_pokok`) as akhir1, SUM(`saldo`*`harga_pokok`) as akhir2');
        $this->db->from('detail_persediaan');
        if ($tanggal1 !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggal2)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal1)));
        }
        $output = $this->db->get()->row();
        $akhir1 = $output->akhir1;
        $akhir2 = $output->akhir2;

        return $awal - $akhir1 - $akhir2;
    }

    public function persediaan_akhirv2($hari, $bulan, $tahun, $periode)
    {

        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;

        $persediaan_tersedia = $this->persediaan_tersedia($hari, $bulan, $tahun, $periode);

        $this->db->select('SUM(`qty`*`harga_pokok`) as persediaan_akhir');
        $this->db->from('master_harga_pokok_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        $persediaan_akhir = $output->persediaan_akhir;

        $this->db->select('SUM(`saldo_tersedia`*`harga_pokok`) as sisa_persediaan_retur');
        $this->db->from('detail_retur_barang_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        $sisa_persediaan_retur = $output->sisa_persediaan_retur;

        $persediaan_akhir = $persediaan_tersedia - $persediaan_akhir;
        return $persediaan_akhir + $sisa_persediaan_retur;
    }

    public function harga_pokok_penjualan($hari, $bulan, $tahun, $periode)
    {
        $persediaan_tersedia = $this->persediaan_tersedia($hari, $bulan, $tahun, $periode);
        $persediaan_akhirv2 = $this->persediaan_akhirv2($hari, $bulan, $tahun, $periode);
        return $persediaan_tersedia - $persediaan_akhirv2;
    }

    public function topProduk($option, $periode)
    {

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

    public function data_produktifitas_sales($kode_sales, $periode)
    {

        $this->db->select_sum('total_penjualan');
        $this->db->select("DATE_FORMAT(tanggal_transaksi, '%b') as bulan");
        $this->db->from('master_penjualan');
        $this->db->where('sales', $kode_sales);
        $this->db->where('periode', $periode);
        $this->db->group_by('bulan');
        $this->db->order_by('bulan', 'DESC');
        return $this->db->get()->result_array();
    }

}
