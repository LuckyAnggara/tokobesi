<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laba extends CI_Model
{
    function penjualan_bersih($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        return $output->total_penjualan;
    }

    function retur_penjualan($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('retur_total');
        $this->db->from('master_retur_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        return $output->retur_total;
    }



    function harga_pokok_penjualan($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`qty` * `harga_pokok`) as harga');
        $this->db->from('master_harga_pokok_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        return $output->harga;
    }

    function harga_pokok_penjualanv2($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        $this->db->select('SUM(`qty_awal`*`harga_awal`) as persediaan_awal');
        $this->db->from('master_saldo_awal');
        $output = $this->db->get()->row();
        $persediaan_awal = $output->persediaan_awal;

        $this->db->select('SUM(`jumlah_pembelian`*`harga_beli`) as pembelian_bersih');
        $this->db->from('detail_pembelian');
        $output = $this->db->get()->row();
        $pembelian_bersih = $output->pembelian_bersih;

        $this->db->select('SUM(`saldo_retur`*`harga_pokok`) as pembelian_bersih');
        $this->db->from('detail_retur_barang_penjualan');
        $output = $this->db->get()->row();
        $pembelian_bersih = $output->pembelian_bersih;

        $persediaan_barang = $persediaan_awal + $pembelian_bersih;


        $this->db->select('SUM(`saldo_awal`*`harga_awal`) as sisa_persediaan_awal');
        $this->db->from('master_saldo_awal');
        $output = $this->db->get()->row();
        $sisa_persediaan_awal = $output->sisa_persediaan_awal;

        $this->db->select('SUM(`saldo`*`harga_beli`) as sisa_pembelian_bersih');
        $this->db->from('detail_pembelian');
        $output = $this->db->get()->row();
        $sisa_pembelian_bersih = $output->sisa_pembelian_bersih;

        $persediaan_akhir = $sisa_persediaan_awal + $sisa_pembelian_bersih;

        return $persediaan_barang - $persediaan_akhir;
    }
}
