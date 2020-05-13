<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Pending_Transaksi extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function get_data()
    {
        $this->db->select('*');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('user', $this->session->userdata('username'));
        $output = $this->db->get();
        return $output;
    }

    function delete_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('temp_tabel_keranjang_penjualan');
    }
}
