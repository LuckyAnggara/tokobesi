<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Saldo_Awal_Persediaan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function getData(){

        $this->db->select('kode_barang');
        $this->db->from('master_saldo_awal');
        $data = $this->db->get()->result_array();
        $data = $data['kode_barang'];
        echo $data;
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where_not_in('kode_barang', $data['kode_barang']);
        return $this->db->get()->result_array();
    }
}
