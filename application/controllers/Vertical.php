<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vertical extends CI_Controller
{
    public function index()
    {
        $this->db->select('*');
        $this->db->from('harga_detail_pembelian');
        $this->db->where('kode_barang','P001');

        var_dump($this->db->get()->row_array());
    }
}