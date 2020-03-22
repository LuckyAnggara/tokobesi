<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laporan_Piutang extends CI_Model
{
    // global

    function data_piutang($post)
    {
        $jenis_data = $post['data'];
        switch ($jenis_data) {
            case '0':
                return $this->data_piutang_faktur($post);
                break;
            case '1':
                return $this->data_piutang_pelanggan($post);
                break;
            case '2':
                return $this->data_piutang_lengkap($post);
                break;
        }
    }

    private function data_piutang_faktur($post)
    {
        $this->db->select('*, DATE_FORMAT(master_piutang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_piutang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_piutang');
        $this->db->join('master_penjualan', 'master_penjualan.no_faktur = master_piutang.no_faktur');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('sisa_piutang !=', 0);
        $this->db->where('master_piutang.tanggal_input >=', date('Y-01-01'));
        $this->db->where('master_piutang.tanggal_input <=', date('Y-m-d', strtotime($post['tanggal'])));
        $this->db->order_by('master_piutang.tanggal_jatuh_tempo', 'ASC');
        return $this->db->get()->result_array();
    }

    function data_piutang_pelanggan($post)
    {
        $this->db->select('master_pelanggan.id_pelanggan,master_pelanggan.nama_pelanggan, master_user.nama as nama_pegawai');
        $this->db->select_sum('master_piutang.total_tagihan');
        $this->db->select_sum('master_piutang.total_pembayaran');
        $this->db->select_sum('master_piutang.sisa_piutang');
        $this->db->from('master_piutang');
        $this->db->join('master_user', 'master_user.username = master_piutang.user');
        $this->db->join('master_penjualan', 'master_penjualan.no_faktur = master_piutang.no_faktur');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('master_piutang.tanggal_input >=', date('Y-01-01'));
        $this->db->where('master_piutang.tanggal_input <=', date('Y-m-d', strtotime($post['tanggal'])));
        $this->db->group_by('master_penjualan.id_pelanggan');
        $this->db->order_by('master_piutang.tanggal_input', 'DESC');
        return $this->db->get()->result_array();
    }

    function data_piutang_lengkap($post)
    {
        $data_pelanggan = $this->data_piutang_pelanggan($post);
        $output = array();
        foreach ($data_pelanggan as $key => $value) {
            $data_faktur = $this->detail_pembayaran($post, $value['id_pelanggan']);
            $data = [
                'id_pelanggan' => $value['id_pelanggan'],
                'nama_pelanggan' => $value['nama_pelanggan'],
                'total_tagihan' => $value['total_tagihan'],
                'total_pembayaran' => $value['total_pembayaran'],
                'sisa_piutang' => $value['sisa_piutang'],
                'data_faktur' => $data_faktur,
            ];

            $output[] = $data;
        }
        return $output;
    }

    private function detail_pembayaran($post,$id_pelanggan)
    {
        $this->db->select('master_piutang.no_faktur,master_piutang.total_tagihan,master_piutang.total_pembayaran,master_piutang.sisa_piutang, master_user.nama as nama_pegawai, DATE_FORMAT(master_piutang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_piutang.tanggal_input, "%d %b %Y") as tanggal_transaksi');
        $this->db->from('master_piutang');
        $this->db->join('master_user', 'master_user.username = master_piutang.user');
        $this->db->join('master_penjualan', 'master_penjualan.no_faktur = master_piutang.no_faktur');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('master_penjualan.id_pelanggan =', $id_pelanggan);
        $this->db->order_by('master_piutang.tanggal_jatuh_tempo', 'ASC');
        return $this->db->get()->result_array();
    }

    function piutang_kemarin($post){

        $tanggalkemarin1 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime($post['tanggal'])));

        $this->db->select_sum('nominal_pembayaran','piutang_kemarin');
        $this->db->from('detail_piutang');
        $this->db->where('tanggal >=', date('Y-01-01 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal <=', $tanggalkemarin1);
        $data= $this->db->get()->row();
        $piutang_kemarin =  $data->piutang_kemarin;
        if($piutang_kemarin == null){
            $piutang_kemarin=  0;
        }

        $this->db->select_sum('total_tagihan');
        $this->db->from('master_piutang');
        $this->db->where('tanggal_input >=', date('Y-01-01 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal_input <=', $tanggalkemarin1);
        $data = $this->db->get()->row();
        $total_piutang_kemarin = $data->total_tagihan;
        
        return $total_piutang_kemarin - $piutang_kemarin;
    }

    function piutang_hari_ini($post)
    {
        $this->db->select_sum('total_tagihan', 'piutang_hari_ini');
        $this->db->from('master_piutang');
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $data = $this->db->get()->row();
        $piutang_hari_ini =  $data->piutang_hari_ini;
        if ($piutang_hari_ini == null) {
            return 0;
        } else {
            return $piutang_hari_ini;
        }
    }

    function pembayaran_hari_ini($post)
    {

        $this->db->select_sum('nominal_pembayaran', 'pembayaran_hari_ini');
        $this->db->from('detail_piutang');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $data = $this->db->get()->row();
        $pembayaran_hari_ini =  $data->pembayaran_hari_ini;
        if ($pembayaran_hari_ini == null) {
            return 0;
        } else {
            return $pembayaran_hari_ini;
        }
    }
}