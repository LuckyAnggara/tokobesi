<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPenjualanBarang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function get_data_by_id($id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('tabel_pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);

        return $this->db->get()->row_array();
    }

    function get_data_barang2($string)
    {
        if ($string == null) {
            $this->db->select('*');
            $this->db->from('master_persediaan');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_barang');
            $this->db->like("master_barang.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $this->db->or_like("harga_satuan", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function get_data_barang($string)

    {
        if ($string == null) {
            $this->db->select('master_persediaan.*, master_barang.*');
            $this->db->from('master_persediaan');
            $this->db->join('master_barang', 'master_barang.kode_barang = master_persediaan.kode_barang');
            $output = $this->db->get();
            return $output;
        } else {
            $this->db->select('master_persediaan.*, master_barang.*');
            $this->db->from('master_persediaan');
            $this->db->join('master_barang', 'master_barang.kode_barang = master_persediaan.kode_barang');
            $this->db->like("master_persediaan.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function push_data_barang()
    {
        $post = $this->input->post();
        if ($post['id_pelanggan'] == null) {
            $post['id_pelanggan'] = 0;
        }
        $data = [
            'id_pelanggan' => $post['id_pelanggan'],
            'kode_barang' => $post['kode_barang'],
            'jumlah_pembelian' => $post["jumlah_pembelian"],
            'harga_total' => $this->_hitung_total($post['kode_barang'], $post['jumlah_pembelian']),
        ];
        $this->db->insert('tabel_keranjang', $data);
    }

    private function _hitung_total($kode_barang, $jumlah_pembelian)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $output = $data['harga_satuan'];
        return $output * $jumlah_pembelian;
    }

    function get_data_keranjang()
    {
        $this->db->select('tabel_keranjang.*, master_barang.*');
        $this->db->from('tabel_keranjang');
        $this->db->join('master_barang', 'master_barang.kode_barang = tabel_keranjang.kode_barang');

        $output = $this->db->get();
        return $output;
    }
}
