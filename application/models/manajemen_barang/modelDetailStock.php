<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelDetailStock extends CI_Model
{
    function get_data($kode_barang)
    {
        $this->db->select('master_barang.*, master_stock.id, master_stock.jumlah_stock');
        $this->db->from('master_barang');
        $this->db->join('master_stock', 'master_stock.kode_barang = master_barang.kode_barang');
        $this->db->where("master_barang.kode_barang", $kode_barang);
        $output = $this->db->get()->row_array();
        return $output;
    }
}
