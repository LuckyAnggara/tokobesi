<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Invoice extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string'));
    }

    function get_data_order($no_order) // udah include nominal pembayaran dan status
    {
        $this->db->select('*');
        $this->db->from('tabel_daftar_belanja');
        $this->db->join('tabel_pelanggan', 'tabel_pelanggan.id_pelanggan = tabel_daftar_belanja.id_pelanggan');
        $this->db->where('no_order', $no_order);
        return $this->db->get()->row_array();
    }

    function get_detail_order($no_order){
        $this->db->select('*');
        $this->db->from('tabel_keranjang_belanja');
        $this->db->join('master_barang', 'master_barang.kode_barang = tabel_keranjang_belanja.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('no_order', $no_order);
        return $this->db->get()->result_array();
    }


}