<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Detail_Transaksi_Pembelian extends CI_Model
{

    function get_data($nomor_transaksi)
    {
        $this->db->select('*');
        $this->db->from('master_pembelian');
        $this->db->join('master_supplier', 'master_supplier.kode_supplier = master_pembelian.kode_supplier');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        return $output;
    }

    function get_detail($nomor_transaksi)
    {
        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_pembelian.kode_barang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->result_array();
        return $output;
    }
}
