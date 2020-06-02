<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laporan_Penjualan extends CI_Model
{
    // global

    function data_penjualan($jenis_data, $tanggal)
    {
        switch ($jenis_data) {
            case '0':
                return $this->data_detail($tanggal);
                break;
            case '1':
                return $this->data_per_sales($tanggal);
                break;
        }
    }

    function data_retur_penjualan($jenis_data, $tanggal)
    {
        switch ($jenis_data) {
            case '0':
                return $this->data_detail_retur($tanggal);
                break;
        }
    }

    function data_detail($tanggal)
    {
        $output = array();
        $data_master = $this->get_data_master($tanggal);
        foreach ($data_master as $key => $value) {
            $nama_sales = $this->nama_sales($value['sales']);
            if($value['status'] == 0)
            {
                $status = 'LUNAS';
            }else if($value['status'] == 1)
            {
                $status = 'KREDIT';
            }
            $data = [
                'tanggal_transaksi' => $value['tanggal_transaksi'],
                'no_faktur' => $value['no_faktur'],
                'nama_pelanggan' => $value['nama_pelanggan'],
                'total_penjualan' => $value['total_penjualan'],
                'diskon' => $value['diskon'],
                'pajak' => $value['pajak_masukan'],
                'ongkir' => $value['ongkir'],
                'grand_total' => $value['grand_total'],
                'sales' => $nama_sales,
                'kasir' => $value['nama_kasir'],
                'status' => $status,

            ];
            $output[] = $data;
        }
        return $output;
    }

    function data_per_sales($tanggal)
    {
        $output = array();
        $data_sales = $this->data_sales();
        foreach ($data_sales as $key => $value) {
            $data_penjualan = $this->get_per_sales($value['username'], $tanggal);
            $data = [
                'nama_sales' => $value['nama'],
                'data_penjualan' => $data_penjualan
            ];
            $output[] = $data;
        }
        return $output; 
    }

    function get_data_master($tanggal)
    {
        $this->db->select('*, master_user.nama as nama_kasir');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00',strtotime($tanggal[0])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal[1])));
        $data = $this->db->get()->result_array();
        return $data;
    }

    function data_sales()
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('role', 3);
        $data = $this->db->get()->result_array();
        return $data;
    }

    function nama_sales($sales)
    {
        $this->db->select('nama');
        $this->db->from('master_user');
        $this->db->where('username', $sales);
        $data = $this->db->get()->row_array();
        if($sales == "nosales"){
return "";
        }else{
            return $data['nama'];

        }
    }

    function get_per_sales($sales, $tanggal){
        $this->db->select('*, master_user.nama as nama_kasir');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('sales', $sales);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggal[0])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal[1])));
        $data = $this->db->get()->result_array();
        return $data;
    }



    function data_detail_retur($tanggal)
    {
        $output = array();
        $data_master = $this->get_data_master_retur($tanggal);
        foreach ($data_master as $key => $value) {
            $data = [
                'tanggal_transaksi' => $value['tanggal_transaksi'],
                'tanggal_retur' => $value['tanggal'],
                'no_faktur' => $value['nomor_faktur'],
                'no_faktur_asli' => $value['nomor_faktur_asli'],
                'nama_pelanggan' => $value['nama_pelanggan'],
                'total_penjualan' => $value['retur_total'],
                'diskon' => $value['retur_diskon'],
                'pajak' => $value['retur_pajak'],
                'grand_total' => $value['retur_grand_total'],
                'kasir' => $value['nama_kasir'],
            ];
            $output[] = $data;
        }
        return $output;
    }

    function get_data_master_retur($tanggal)
    {
        $this->db->select('*, master_user.nama as nama_kasir');
        $this->db->from('master_retur_penjualan');
        $this->db->join('master_user', 'master_user.username = master_retur_penjualan.user');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_retur_penjualan.id_pelanggan');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggal[0])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal[1])));
        $data = $this->db->get()->result_array();
        return $data;
    }
}