<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Pengeluaran extends CI_Model
{

    public function data_harian($tanggal, $periode = null)
    {
        $kategori_biaya = $this->get_kategori_biaya();
        $output = array();
        foreach ($kategori_biaya as $key => $value) {
            $detail_data = $this->get_detail_biaya($value['id'], $tanggal, $periode);
            $total_biaya = $this->total_biaya($value['id'], $tanggal, $periode);
            $data = [
                'nama_biaya' => $value['nama_biaya'],
                'total' => $total_biaya,
                'detail_data' => $detail_data,
            ];
            if ($total_biaya !== null) {
                $output[] = $data;
            }
        }
        return $output;
    }

    public function get_kategori_biaya()
    {
        $this->db->select('*');
        $this->db->from('master_kategori_biaya');
        return $this->db->get()->result_array();
    }

    public function get_detail_biaya($biaya, $tanggal, $periode)
    {
        $this->db->select('detail_biaya.nomor_jurnal,DATE_FORMAT(detail_biaya.tanggal,  "%d %b %Y") as tanggal, detail_biaya.total, detail_biaya.keterangan, master_user.nama as nama_pegawai');
        $this->db->from('detail_biaya');
        $this->db->join('master_user', 'master_user.username = detail_biaya.user');
        $this->db->where('kategori_biaya', $biaya);
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggal[0])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal[1])));
        $this->db->where('periode', $periode);
        $data = $this->db->get()->result_array();
        return $data;
    }

    public function total_biaya($biaya, $tanggal, $periode)
    {
        $this->db->select('sum(`total`) as total');
        $this->db->from('detail_biaya');
        $this->db->where('kategori_biaya', $biaya);
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggal[0])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal[1])));
        $this->db->where('periode', $periode);
        $data = $this->db->get()->row();
        return $data->total;
    }

    public function data_gaji($tanggal, $periode)
    {
        $total_gaji = $this->total_gaji($tanggal, $periode);

        return $total_gaji;
    }

    public function total_gaji($tanggal, $periode)
    {
        $this->db->select('sum(`total`) as total');
        $this->db->select('sum(`gaji_pokok`) as gaji_pokok');
        $this->db->select('sum(`uang_makan`) as uang_makan');
        $this->db->select('sum(`bonus`) as bonus');
        $this->db->from('detail_gaji');
        $this->db->where('status', 2);
        $this->db->where('tanggal_pembayaran >=', date('Y-m-d 00:00:00', strtotime($tanggal[0])));
        $this->db->where('tanggal_pembayaran <=', date('Y-m-d 23:59:59', strtotime($tanggal[1])));
        $this->db->where('periode', $periode);
        $data = $this->db->get()->row();
        $output = [
            'total' => $data->total,
            'gaji_pokok' => $data->gaji_pokok,
            'uang_makan' => $data->uang_makan,
            'bonus' => $data->bonus,
        ];
        if ($data->total == null) {
            $output = [
                'total' => 0,
                'gaji_pokok' => 0,
                'uang_makan' => 0,
                'bonus' => 0,
            ];

        } else {
            $output = [
                'total' => $data->total,
                'gaji_pokok' => $data->gaji_pokok,
                'uang_makan' => $data->uang_makan,
                'bonus' => $data->bonus,
            ];

        }

        return $output;

    }
}
