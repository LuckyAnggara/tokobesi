<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Purchase_Order_Sales extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function get_data($post)
    {
        $this->db->select('master_penjualan.*,master_pelanggan.nama_pelanggan ');
        $this->db->from('master_penjualan');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
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

    function get_data_kredit($no_faktur)
    {
        $this->db->select('*');
        $this->db->from('master_piutang');
        $this->db->where('no_faktur', $no_faktur);
        $output = $this->db->get()->row_array();
        return $output;
    }


    function delete_data($no_faktur)
    {
        $this->db->where('no_faktur', $no_faktur);
        $this->db->delete('master_penjualan');
    }
}
