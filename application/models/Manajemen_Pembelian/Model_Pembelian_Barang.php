<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Pembelian_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string'));
    }

    function get_data_supplier()
    {
        $this->db->select('*');
        $this->db->from('master_supplier');
        return $this->db->get()->result_array();
    }

    function get_data_barang($string)
    {
        if ($string == null) {
            $this->db->select('master_persediaan.*, master_barang.*, master_satuan_barang.nama_satuan');
            $this->db->from('master_persediaan');
            $this->db->join('master_barang', 'master_barang.kode_barang = master_persediaan.kode_barang');
            $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
            $output = $this->db->get();
            return $output;
        } else {
            $this->db->select('master_persediaan.*, master_barang.*, master_satuan_barang.nama_satuan');
            $this->db->from('master_persediaan');
            $this->db->join('master_barang', 'master_barang.kode_barang = master_persediaan.kode_barang');
            $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
            $this->db->like("master_persediaan.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function push_data_barang($post)
    {
        $harga_total = $post['jumlah_pembelian']*$post['harga_beli'];
        $data = [
            'no_order_pembelian' => $post['no_order_pembelian'],
            'kode_barang' => $post['kode_barang'],
            'jumlah_pembelian' => $post["jumlah_pembelian"],
            'harga_beli' => $post["harga_beli"],
            'diskon' => 0,
            'total_harga' => $harga_total,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('temp_tabel_keranjang_pembelian', $data);
    }

    function get_data_keranjang($no_order_pembelian)
    {
        $this->db->select('temp_tabel_keranjang_pembelian.*, master_barang.*');
        $this->db->from('temp_tabel_keranjang_pembelian');
        $this->db->join('master_barang', 'master_barang.kode_barang = temp_tabel_keranjang_pembelian.kode_barang');
        $this->db->where('no_order_pembelian', $no_order_pembelian);
        $output = $this->db->get();
        return $output;
    }
}