<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dashboard_Kasir extends CI_Model
{

    function get_data_penjualan_terakhir()
    {
        $periode = $this->modelSetting->get_data_periode();

        $this->db->select('master_penjualan.status_bayar,master_penjualan.no_faktur, master_penjualan.sales, master_penjualan.total_penjualan, DATE_FORMAT(`tanggal_transaksi`, "%H:%i") as jam, DATE_FORMAT(`tanggal_transaksi`, "%d %M %y") as tanggal, master_user.nama');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->where('user', $this->session->userdata['username']);
        $this->db->where('periode', $periode);

        $this->db->order_by('id', 'DESC');
        $this->db->limit(10);
        $output = $this->db->get();
        return $output;
    }

    function get_data_penjualan_hari_ini($tanggal, $kasir = null)
    {
        $periode = $this->modelSetting->get_data_periode();

        $this->db->select('master_penjualan.status_bayar,master_penjualan.no_faktur, master_penjualan.sales, master_penjualan.total_penjualan, DATE_FORMAT(`tanggal_transaksi`, "%H:%i") as jam, DATE_FORMAT(`tanggal_transaksi`, "%d-%M-%y") as tanggal, master_user.nama, master_pelanggan.nama_pelanggan as nama_pelanggan');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        if($kasir !== null){
            $this->db->where('master_penjualan.user',$kasir);
        }
        $this->db->where('periode', $periode);

        $this->db->like('tanggal_transaksi', date('Y-m-d', strtotime($tanggal)));
        $this->db->order_by('master_penjualan.id', 'DESC');
        $output = $this->db->get();
        return $output;
    }

    function laporan_kasir($kasir = null)
    {
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->like('tanggal_transaksi', date('Y-m-d'));
        if($kasir !== null){
            $this->db->where('user',$kasir);
        }
        $data = $this->db->get()->row();

        $omzet = $data->total_penjualan;

        $this->db->select('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->like('tanggal_transaksi', date('Y-m-d'));
        if($kasir !== null){
            $this->db->where('user',$kasir);
        }
        $data = $this->db->get()->num_rows();

        $transaksi = $data;

        $this->db->select('saldo_akhir');
        $this->db->from('master_coh');
        $this->db->like('tanggal_input', date('Y-m-d'));
        if($kasir !== null){
            $this->db->where('user',$kasir);
            $this->db->where('status',1);
        }
        $data = $this->db->get()->row_array();

        $cash = $data['saldo_akhir'];

        $output = [
            'omzet' => $omzet,
            'transaksi' => $transaksi,
            'cash' => $cash
        ];
        return $output;
    }
}
