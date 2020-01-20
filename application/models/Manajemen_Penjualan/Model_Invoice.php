<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Invoice extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string'));
    }

    function get_data_order($no_order_penjualan) // udah include nominal pembayaran dan status
    {
        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('no_order_penjualan', $no_order_penjualan);
        return $this->db->get()->row_array();
    }

    function get_data_order_kredit($no_order_penjualan) // udah include nominal pembayaran dan status serta kredit / piutang
    {
        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->join('master_piutang', 'master_piutang.no_faktur = master_penjualan.no_faktur');
        $this->db->where('no_order_penjualan', $no_order_penjualan);
        return $this->db->get()->row_array();
    }

    function get_detail_order($no_order_penjualan)
    {
        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_penjualan.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('no_order_penjualan', $no_order_penjualan);
        return $this->db->get()->result_array();
    }
}
