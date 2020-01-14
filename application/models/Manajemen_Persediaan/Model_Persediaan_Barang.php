<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Persediaan_Barang extends CI_Model
{
    private function _get_detail_barang($string)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where("kode_barang", $string);
        return $this->db->get()->row_array();
    }

    private function _get_detail_pembelian($string)
    {
        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->where("kode_barang", $string);
        return $this->db->get()->result_array();
    }

    private function _get_detail_penjualan($string)
    {
        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->where("kode_barang", $string);
        return $this->db->get()->result_array();
    }

      private function getdetaildetail($string)
    {
        $this->db->select('*');
        $this->db->from('master_kartu_persediaan');
        $this->db->where("kode_barang", $string);
        return $this->db->get()->result_array();
    }

    function get_detail($string)
    {

        $detail = $this->_get_detail_barang($string);
        $pembelian = $this->_get_detail_pembelian($string);
        $penjualan = $this->_get_detail_penjualan($string);

        $get_detail = $this->get_detail_detail($string);
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => 1,
            "recordsFiltered"  => 1,
            "data" => $get_detail      
        );

        return $output;
    }

    // function get_detail_detail($string)
    // {
    //     $this->db->select('master_barang.*,detail_pembelian.tanggal_transaksi as tgl_beli, detail_pembelian.nomor_transaksi as nomor_beli, detail_pembelian.jumlah_pembelian, detail_pembelian.harga_beli, detail_pembelian.total_harga as total_beli, detail_penjualan.tanggal_transaksi as tgl_jual, detail_penjualan.nomor_faktur as nomor_jual, detail_penjualan.jumlah_penjualan, detail_penjualan.harga_jual, detail_penjualan.total_harga as total_jual');
    //     $this->db->from('master_barang');
    //     $this->db->join('detail_pembelian', 'detail_pembelian.kode_barang = master_barang.kode_barang','outer');
    //     $this->db->join('detail_penjualan', 'detail_penjualan.kode_barang = master_barang.kode_barang', 'outer');
    //     $this->db->where("master_barang.kode_barang", $string);
    //     $this->db->ORDER_BY("tgl_beli","ASC");
    //     return $this->db->get()->result_array();
    // }

    function get_detail_detail($string)
    {
        $this->db->select('mster_barang.*,detail_pembelian.tanggal_transaksi as tgl_beli, detail_pembelian.nomor_transaksi as nomor_beli, detail_pembelian.jumlah_pembelian, detail_pembelian.harga_beli, detail_pembelian.total_harga as total_beli, detail_penjualan.tanggal_transaksi as tgl_jual, detail_penjualan.nomor_faktur as nomor_jual, detail_penjualan.jumlah_penjualan, detail_penjualan.harga_jual, detail_penjualan.total_harga as total_jual');
        $this->db->from('master_barang');
        $this->db->join('detail_pembelian', 'detail_pembelian.kode_barang = master_barang.kode_barang','right outer');
        $this->db->join('detail_penjualan', 'detail_penjualan.kode_barang = master_barang.kode_barang', 'right outer');
        $this->db->where("master_barang.kode_barang", $string);
        $this->db->ORDER_BY("tgl_beli","ASC");
        return $this->db->get()->result_array();
    }
}