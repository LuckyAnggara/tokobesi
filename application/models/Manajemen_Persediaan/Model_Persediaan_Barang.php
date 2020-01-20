<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Persediaan_Barang extends CI_Model
{
    function get_kartu_persediaan_ajax()
    {
        $query =  $this->db->query("SELECT *, @saldo := @saldo+qty as saldo FROM ( SELECT 'Masuk' trans_type, nomor_transaksi as nomor_transaksi, tanggal_transaksi, kode_barang, jumlah_pembelian as qty, harga_beli FROM detail_pembelian WHERE kode_barang = 'P001' UNION ALL SELECT 'Keluar' trans_type, nomor_faktur, tanggal_transaksi, kode_barang, -jumlah_penjualan as qty, harga_jual FROM detail_penjualan WHERE kode_barang = 'P001') tx JOIN ( select @saldo:= 0 ) sx on 1=1 ORDER BY tanggal_transaksi");

        return $query;
    }
    function get_kartu_persediaan()
    {
        $query =  $this->db->query("SELECT *, @saldo := @saldo+qty as saldo FROM ( SELECT 'Masuk' trans_type, nomor_transaksi as nomor_transaksi, tanggal_transaksi, kode_barang, jumlah_pembelian as qty, harga_beli FROM detail_pembelian WHERE kode_barang = 'P001' UNION ALL SELECT 'Keluar' trans_type, nomor_faktur, tanggal_transaksi, kode_barang, -jumlah_penjualan as qty, harga_jual FROM detail_penjualan WHERE kode_barang = 'P001') tx JOIN ( select @saldo:= 0 ) sx on 1=1 ORDER BY tanggal_transaksi");

        return $query->result_array();
    }

    function get_data_persediaan($kode_barang)
    {
        $qty = $this->db->query("SELECT SUM(`saldo`) AS `saldo` FROM `detail_persediaan` WHERE `kode_barang` = '" . $kode_barang . "'");

        return $qty->row_array();
    }
}
