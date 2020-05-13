<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Detail_Persediaan extends CI_Model
{
    function get_data($kode_barang)
    {
        $this->db->select('master_barang.*, master_persediaan.id, master_persediaan.jumlah_persediaan');
        $this->db->from('master_barang');
        $this->db->join('master_persediaan', 'master_persediaan.kode_barang = master_barang.kode_barang');
        $this->db->where("master_barang.kode_barang", $kode_barang);
        $output = $this->db->get()->row_array();
        return $output;
    }
}
