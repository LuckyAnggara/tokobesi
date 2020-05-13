<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Daftar_Transaksi_Penjualan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function get_data($post)
    {
        $periode = $this->modelSetting->get_data_periode();

        $this->db->select('master_penjualan.*,master_pelanggan.nama_pelanggan, master_user.nama as nama_pegawai  ');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        if ($post['status_bayar'] == null) {
        } else {
            $this->db->where('status_bayar', $post['status_bayar']);
        }
        if ($this->session->userdata('role') < 4) {
            $this->db->where('master_penjualan.user', $this->session->userdata['username']);
        }
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('periode', $periode);
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
        $this->db->select('*');
        $this->db->from('master_harga_pokok_penjualan');
        $this->db->where('nomor_faktur', $no_faktur);
        $output = $this->db->get()->result_array();



        foreach ($output as $key => $value) {
            $this->db->select('*');
            $this->db->from('detail_pembelian');
            $this->db->where('id', $value['tag']);
            $data = $this->db->get()->row_array();
            $saldo = $data['saldo'];

            $update = [
                'saldo' => $saldo + $value['qty']
            ];
            $this->db->where('id', $value['tag']);
            $this->db->update('detail_pembelian', $update);
        }

        
        $this->db->where('no_faktur', $no_faktur);
        $this->db->delete('master_penjualan');

        $this->db->where('nomor_faktur_asli', $no_faktur);
        $this->db->delete('master_retur_penjualan');

        return "ok";
    }
}
