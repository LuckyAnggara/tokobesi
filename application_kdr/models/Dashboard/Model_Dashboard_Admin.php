<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dashboard_Admin extends CI_Model
{
    function get_data_po()
    {
        $this->db->select('*');
        $this->db->from('master_purchase_order');
        $this->db->where('status_po', 1);
        $this->db->order_by('master_purchase_order.tanggal_input', 'DESC');
        return $this->db->get();
    }


    function data_status($post)
    {
        $this->db->select('no_order, status_po');
        $this->db->from('master_purchase_order');
        $this->db->where('no_order', $post);
        return $this->db->get()->row_array();
    }

    function data_sales($post)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $post);
        return $this->db->get()->row_array();
    }

    function data_admin($post)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $post);
        return $this->db->get()->row_array();
    }

    function data_pelanggan($post)
    {
        $this->db->select('*');
        $this->db->from('master_pelanggan');
        $this->db->where('id_pelanggan', $post);
        return $this->db->get()->row_array();
    }


    // daftar pembelian
    function get_data()
    {
        $periode = $this->modelSetting->get_data_periode();

        $this->db->select('master_pembelian.*,DATE_FORMAT(master_pembelian.tanggal_transaksi, "%d %b %Y") as tanggal_transaksi');
        $this->db->from('master_pembelian');
        $this->db->where('master_pembelian.user', $this->session->userdata['username']);
        $this->db->where('master_pembelian.periode', $periode);
        $this->db->order_by('master_pembelian.tanggal_transaksi', 'DESC');
        $this->db->limit('10');
        $output = $this->db->get();
        return $output;
    }

    function get_data_kredit($nomor_transaksi)
    {
        
        $this->db->select('*');
        $this->db->from('master_utang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        return $output;
    }
}
