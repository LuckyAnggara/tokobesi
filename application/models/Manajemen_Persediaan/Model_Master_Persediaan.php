<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Persediaan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }
    function getDataBarang()
    {
        $this->db->select('kode_barang, nama_barang');
        $this->db->from('master_barang');
        return $this->db->get();
    }

    function saldoAwal($kode_barang, $post)
    {
        $this->db->select('qty_awal, saldo_awal, harga_awal');
        $this->db->from('master_saldo_awal');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_saldo >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_saldo <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get()->row_array();
    }

    function saldoMasuk($kode_barang, $post)
    {
        $this->db->select_sum('jumlah_pembelian');
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get()->row_array();
    }

    function saldoKeluar($kode_barang, $post)
    {
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get()->row_array();
    }

    function saldoCart($kode_barang, $post)
    {
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('is_po', 0);
        return $this->db->get()->row_array();
    }

    function saldoCartPo($kode_barang, $post)
    {
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_purchase_order');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_input >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('status !=', 99);
        $this->db->where('status !=', 2);
        return $this->db->get()->row_array();
    }


    function saldoAkhir($saldoAwal, $masuk, $keluar, $cart, $cartPo)
    {
        if ($saldoAwal == null) $saldoAwal['qty_awal']  = 0;
        if ($masuk['jumlah_pembelian'] == null) $masuk['jumlah_pembelian'] = 0;
        if ($keluar['jumlah_penjualan'] == null) $keluar['jumlah_penjualan'] = 0;
        if ($cart['jumlah_penjualan'] == null) $cart['jumlah_penjualan'] = 0;
        if ($cartPo['jumlah_penjualan'] == null) $cartPo['jumlah_penjualan'] = 0;

        $awalan = $saldoAwal['qty_awal'] + $masuk['jumlah_pembelian'] - $cart['jumlah_penjualan'] - $cartPo['jumlah_penjualan'];

        return ($awalan - $keluar['jumlah_penjualan']);
    }


    // DETAIL SCRIPT

    function getDataMasuk($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get();
    }

    function getDataKeluar($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get();
    }

    function getDataCart($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('is_po =', 0);

        return $this->db->get();
    }

    function getDataCartPo($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_input, '%d-%b-%Y') as tanggal_input");
        $this->db->from('temp_purchase_order');
        $this->db->join('master_user', 'master_user.username = temp_purchase_order.user');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_input >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('temp_purchase_order.status !=', 99);
        $this->db->where('temp_purchase_order.status !=', 2);
        return $this->db->get();
    }


    // STOCK OPNAME

    function getDataStockOpname()
    {
        $this->db->select('kode_barang');
        $this->db->from('master_barang');
        return $this->db->get();
    }

    function dataBarang($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get()->row_array();
    }

    function saldoBuku($kode_barang)
    {
        // saldo awal
        $this->db->select('qty_awal, saldo_awal, harga_awal');
        $this->db->from('master_saldo_awal');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        if ($data !== null) {
            $saldoAwal = $data['qty_awal'];
        } else {
            $saldoAwal = 0;
        }

        // saldo masuk
        $this->db->select_sum('jumlah_pembelian');
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoMasuk = $data['jumlah_pembelian'];

        // saldo keluar
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoKeluar = $data['jumlah_penjualan'];

        // saldo keranjang
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoCart = $data['jumlah_penjualan'];

        // saldo Cart Po

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_purchase_order');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoCartPo = $data['jumlah_penjualan'];

        if ($saldoAwal == null) $saldoAwal  = 0;
        if ($saldoMasuk == null) $saldoMasuk = 0;
        if ($saldoKeluar == null) $saldoKeluar = 0;
        if ($saldoCart == null) $saldoCart = 0;
        if ($saldoCartPo == null) $saldoCartPo = 0;

        return ($saldoAwal + $saldoMasuk) - ($saldoKeluar + $saldoCart + $saldoCartPo);
    }

    function random_ref()
    {
        return random_string('numeric', 7);
    }

    
}
