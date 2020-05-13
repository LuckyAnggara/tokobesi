<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dashboard_Supervisor extends CI_Model
{
    function data_pending_stok_opname()
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d %b %Y") as tanggal');
        $this->db->from('master_stok_opname');
        $this->db->where('status', 1);
        return $this->db->get()->result_array();
    }

    function data_pending_insentif()
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d %b %Y") as tanggal');
        $this->db->from('master_insentif');
        $this->db->join('master_user', 'master_user.username = master_insentif.sales');
        $this->db->where('master_insentif.status', 0);
        return $this->db->get()->result_array();
    }

    function laporan_spv($kasir = null)
    {

        $this->db->select('saldo_akhir');
        $this->db->from('master_coh');
        $this->db->like('tanggal_input', date('Y-m-d'));
        if ($kasir !== null) {
            $this->db->where('user', $kasir);
            $this->db->where('status', 1);
        }
        $data = $this->db->get()->row_array();

        $cash = $data['saldo_akhir'];


        $this->db->select_sum('total');
        $this->db->from('detail_biaya');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59'));
        $data = $this->db->get()->row();
        $total_biaya = $data->total;

        $this->db->select_sum('total');
        $this->db->from('detail_gaji');
        $this->db->where('status', 2);
        $this->db->where('tanggal_pembayaran >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_pembayaran <=', date('Y-m-d 23:59:59'));
        $data = $this->db->get()->row();
        $total_gaji = $data->total;

        $output = [
            'cash' => $cash,
            'total_pengeluaran' => $total_biaya + $total_gaji
        ];
        return $output;
    }

}
