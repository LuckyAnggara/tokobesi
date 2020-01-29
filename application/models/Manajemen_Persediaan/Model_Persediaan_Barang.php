<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Persediaan_Barang extends CI_Model
{
    function get_kartu_persediaan_ajax($kode_barang)
    {
        $query =  $this->db->query("SELECT *, @saldo := @saldo+qty as saldo FROM ( SELECT 'Masuk' trans_type, nomor_transaksi as nomor_transaksi, DATE_FORMAT(tanggal_transaksi,'%d-%b-%Y') as tanggal_transaksi, kode_barang, jumlah_pembelian as qty, harga_beli FROM detail_pembelian WHERE kode_barang = '" . $kode_barang . "' UNION ALL SELECT 'Keluar' trans_type, nomor_faktur, DATE_FORMAT(tanggal_transaksi,'%d-%b-%Y') as tanggal_transaksi, kode_barang, -qty, harga_pokok FROM master_harga_pokok_penjualan WHERE kode_barang = '" . $kode_barang . "' UNION ALL SELECT 'awal' trans_type,nomor_faktur, DATE_FORMAT(tanggal_saldo,'%d-%b-%Y') as tanggal_transaksi, kode_barang, qty_awal, harga_awal FROM master_saldo_awal WHERE kode_barang = '" . $kode_barang . "') tx JOIN ( select @saldo:= 0 ) sx on 1=1 ORDER BY tanggal_transaksi");

        // $query =  $this->db->query("SELECT *, @saldo := @saldo+qty as saldo FROM ( SELECT 'Masuk' trans_type, nomor_transaksi as nomor_transaksi, DATE_FORMAT(tanggal_transaksi,'%d-%b-%Y') as tanggal_transaksi, kode_barang, jumlah_pembelian as qty, harga_beli FROM detail_pembelian WHERE kode_barang = '" . $kode_barang . "' UNION ALL SELECT 'Keluar' trans_type, nomor_faktur, DATE_FORMAT(tanggal_transaksi,'%d-%b-%Y') as tanggal_transaksi, kode_barang, -jumlah_penjualan as qty, harga_jual FROM detail_penjualan WHERE kode_barang = '" . $kode_barang . "') tx JOIN ( select @saldo:= 0 ) sx on 1=1 ORDER BY tanggal_transaksi");

        return $query;
    }
    function get_kartu_persediaan()
    {
        $query =  $this->db->query("SELECT *, @saldo := @saldo+qty as saldo FROM ( SELECT 'Masuk' trans_type, nomor_transaksi as nomor_transaksi, tanggal_transaksi, kode_barang, jumlah_pembelian as qty, harga_beli FROM detail_pembelian WHERE kode_barang = 'K001' UNION ALL SELECT 'Keluar' trans_type, nomor_faktur, tanggal_transaksi, kode_barang, -jumlah_penjualan as qty, harga_jual FROM detail_penjualan WHERE kode_barang = 'K001') tx JOIN ( select @saldo:= 0 ) sx on 1=1 ORDER BY tanggal_transaksi");

        return $query->result_array();
    }

    function get_data_barang(){
        $this->db->select('*');
        $this->db->from('master_barang');
        return $this->db->get();
    }

    function getDetailBarang($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get()->row_array();
    }

    function get_data_persediaan($kode_barang)
    {

        $this->db->select_sum('saldo');
        $this->db->where('kode_barang', $kode_barang);
        $result = $this->db->get('detail_pembelian')->row();
        $qty_saldo =  $result->saldo;

        // $this->db->select_sum('jumlah_penjualan');
        // $this->db->where('kode_barang', $kode_barang);
        // $result = $this->db->get('detail_penjualan')->row();
        // $qty_terjual =  $result->jumlah_penjualan;

        $this->db->select_sum('jumlah_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $result = $this->db->get('temp_tabel_keranjang_penjualan')->row();
        $qty_temp =  $result->jumlah_penjualan;

        return  $qty_saldo - $qty_temp;
    }

 
}
