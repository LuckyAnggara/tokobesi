<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Detail_Transaksi_Penjualan extends CI_Model
{


    function get_data($no_faktur)
    {
        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('no_faktur', $no_faktur);
        $output = $this->db->get()->row_array();
        return $output;
    }

    function get_detail($no_faktur)
    {
        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_penjualan.kode_barang');
        $this->db->where('nomor_faktur', $no_faktur);
        $output = $this->db->get()->result_array();
        return $output;
    }
}
