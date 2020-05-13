<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laporan_Sales extends CI_Model
{
    // global

    function data_penjualan($jenis_data, $tanggal)
    {
        switch ($jenis_data) {
            case '0':
                return $this->data_piutang_per_sales($tanggal);
                break;
            case '1':
                return $this->data_penjualan_per_sales($tanggal);
                break;
        }
    }

    function data_piutang_per_sales($tanggal)
    {
        $output = array();
        $data_sales = $this->data_sales();
        foreach ($data_sales as $key => $value) {
            $output_piutang = array();
            $data_piutang = $this->data_piutang($value['username'], $tanggal);
            foreach ($data_piutang as $key => $data_piutang) {
                $detail_piutang = $this->detail_piutang($data_piutang['no_faktur']);
                $data = [
                    'no_faktur' => $data_piutang['no_faktur'],
                    'tanggal_transaksi' => $data_piutang['tanggal_transaksi'],
                    'nama_pelanggan' => $data_piutang['nama_pelanggan'],
                    'total_penjualan' => $data_piutang['total_penjualan'],
                    'total_pembayaran' => $data_piutang['total_pembayaran'],
                    'sisa_piutang' => $data_piutang['sisa_piutang'],
                    'detail_pembayaran' => $detail_piutang,
                ];
                $output_piutang[] = $data;
            }

            $data = [
                'nama_sales' => $value['nama'],
                'data_piutang' => $output_piutang
            ];

            if ($data_piutang) {
                $output[] = $data;
            }
        }
        return $output;
    }

    function data_penjualan_per_sales($tanggal)
    {
        $output = array();
        $data_sales = $this->data_sales();
        foreach ($data_sales as $key => $value) {
            $data_penjualan = $this->get_per_sales($value['username'], $tanggal);
           
            $data = [
                'nama_sales' => $value['nama'],
                'data_penjualan' => $data_penjualan
            ];
            if($data_penjualan !== null){
                $output[] = $data;
            }
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
        return $data['nama'];
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

    function data_piutang($sales, $tanggal)
    {
        $this->db->select('*, master_user.nama as nama_kasir');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.user');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->join('master_piutang', 'master_piutang.no_faktur = master_penjualan.no_faktur');
        $this->db->where('sales', $sales);
        $this->db->where('status', 0);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggal[0])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal[1])));
        $data = $this->db->get()->result_array();
        return $data;
    }

    function detail_piutang($nomor_faktur)
    {
        $this->db->select('*,DATE_FORMAT(tanggal,  "%d %b %Y") as tanggal');
        $this->db->from('detail_piutang');
        $this->db->where('nomor_faktur', $nomor_faktur);
        $data = $this->db->get()->result_array();
        return $data;
    }
}