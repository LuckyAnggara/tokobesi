<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dashboard_Kasir extends CI_Model
{

    function get_data_penjualan_terakhir()
    {
        $this->db->select('master_penjualan.status_bayar,master_penjualan.no_faktur, master_penjualan.sales, master_penjualan.total_penjualan, DATE_FORMAT(`tanggal_transaksi`, "%H:%i") as jam, DATE_FORMAT(`tanggal_transaksi`, "%d %M %Y") as tanggal, master_user.nama');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->where('user', $this->session->userdata['username']);
        $this->db->limit(10);
        $this->db->order_by('id', 'DESC');
        $output = $this->db->get();
        return $output;
    }
}
