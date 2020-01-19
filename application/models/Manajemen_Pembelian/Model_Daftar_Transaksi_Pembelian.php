<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Daftar_Transaksi_Pembelian extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function get_data($post)
    {
        $this->db->select('master_pembelian.*,master_supplier.nama_supplier ');
        $this->db->from('master_pembelian');
        $this->db->join('master_supplier', 'master_supplier.kode_supplier = master_pembelian.kode_supplier');
        if ($post['status_bayar'] == null) {
        } else {
            $this->db->where('status_bayar', $post['status_bayar']);
        }
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->order_by('tanggal_transaksi', 'DESC');
        $output = $this->db->get();
        return $output;
    }

    function get_data_kredit($nomor_transaksi)
    {
        $this->db->select('*');
        $this->db->from('master_hutang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        return $output;
    }


    function delete_data($nomor_transaksi)
    {
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $this->db->delete('master_pembelian');
    }
}
