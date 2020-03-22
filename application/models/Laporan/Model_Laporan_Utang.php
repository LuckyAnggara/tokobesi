<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laporan_Utang extends CI_Model
{
    // global

    function data_utang($post)
    {
        $jenis_data = $post['data'];
        switch ($jenis_data) {
            case '0':
                return $this->data_utang_faktur($post);
                break;
            case '1':
                return $this->data_utang_supplier($post);
                break;
            case '2':
                return $this->data_utang_lengkap($post);
                break;
        }
    }

    private function data_utang_faktur($post)
    {
        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_utang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_utang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_utang');
        $this->db->join('master_user', 'master_user.username = master_utang.user');
        $this->db->join('master_pembelian', 'master_pembelian.nomor_transaksi = master_utang.nomor_transaksi');
        $this->db->join('master_supplier', 'master_supplier.kode_supplier = master_pembelian.kode_supplier');
        $this->db->where('sisa_utang !=', 0);
        $this->db->where('master_utang.tanggal_input >=', date('Y-01-01'));
        $this->db->where('master_utang.tanggal_input <=', date('Y-m-d', strtotime($post['tanggal'])));
        $this->db->order_by('master_utang.tanggal_jatuh_tempo', 'ASC');
        return $this->db->get()->result_array();
    }

    function data_utang_supplier($post)
    {
        $this->db->select('master_supplier.kode_supplier,master_supplier.nama_supplier, master_user.nama as nama_pegawai');
        $this->db->select_sum('master_utang.total_tagihan');
        $this->db->select_sum('master_utang.total_pembayaran');
        $this->db->select_sum('master_utang.sisa_utang');
        $this->db->from('master_utang');
        $this->db->join('master_user', 'master_user.username = master_utang.user');
        $this->db->join('master_pembelian', 'master_pembelian.nomor_transaksi = master_utang.nomor_transaksi');
        $this->db->join('master_supplier', 'master_supplier.kode_supplier = master_pembelian.kode_supplier');
        $this->db->where('master_utang.tanggal_input >=', date('Y-01-01'));
        $this->db->where('master_utang.tanggal_input <=', date('Y-m-d', strtotime($post['tanggal'])));
        $this->db->group_by('master_pembelian.kode_supplier');
        $this->db->order_by('master_utang.tanggal_input', 'DESC');
        return $this->db->get()->result_array();
    }

    function data_utang_lengkap($post)
    {
        $data_supplier = $this->data_utang_supplier($post);
        $output = array();
        foreach ($data_supplier as $key => $value) {

            $data_faktur = $this->detail_pembayaran($post, $value['kode_supplier']);
            $data = [
                'kode_supplier' => $value['kode_supplier'],
                'nama_supplier' => $value['nama_supplier'],
                'total_tagihan' => $value['total_tagihan'],
                'total_pembayaran' => $value['total_pembayaran'],
                'sisa_utang' => $value['sisa_utang'],
                'data_faktur' => $data_faktur,
            ];

            $output[] = $data;
        }

        return $output;
    }

    private function detail_pembayaran($post,$kode_supplier)
    {
        $this->db->select('master_utang.nomor_transaksi,master_utang.total_tagihan,master_utang.total_pembayaran,master_utang.sisa_utang, master_user.nama as nama_pegawai, DATE_FORMAT(master_utang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_utang.tanggal_input, "%d %b %Y") as tanggal_transaksi');
        $this->db->from('master_utang');
        $this->db->join('master_user', 'master_user.username = master_utang.user');
        $this->db->join('master_pembelian', 'master_pembelian.nomor_transaksi = master_utang.nomor_transaksi');
        $this->db->join('master_supplier', 'master_supplier.kode_supplier = master_pembelian.kode_supplier');
        $this->db->where('master_pembelian.kode_supplier =', $kode_supplier);
        $this->db->order_by('master_utang.tanggal_jatuh_tempo', 'ASC');
        return $this->db->get()->result_array();
    }

    function utang_kemarin($post){

        $tanggalkemarin1 = date('Y-m-d 23:59:59', strtotime('-1 days', strtotime($post['tanggal'])));

        $this->db->select_sum('nominal_pembayaran','utang_kemarin');
        $this->db->from('detail_utang');
        $this->db->where('tanggal >=', date('Y-01-01 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal <=', $tanggalkemarin1);
        $data= $this->db->get()->row();
        $utang_kemarin =  $data->utang_kemarin;
        if($utang_kemarin == null){
            $utang_kemarin=  0;
        }

        $this->db->select_sum('total_tagihan');
        $this->db->from('master_utang');
        $this->db->where('tanggal_input >=', date('Y-01-01 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal_input <=', $tanggalkemarin1);
        $data = $this->db->get()->row();
        $total_utang_kemarin = $data->total_tagihan;
        
        return $total_utang_kemarin - $utang_kemarin;
    }

    function utang_hari_ini($post)
    {
        $this->db->select_sum('total_tagihan', 'utang_hari_ini');
        $this->db->from('master_utang');
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $data = $this->db->get()->row();
        $utang_hari_ini =  $data->utang_hari_ini;
        if ($utang_hari_ini == null) {
            return 0;
        } else {
            return $utang_hari_ini;
        }
    }

    function pembayaran_hari_ini($post)
    {

        $this->db->select_sum('nominal_pembayaran', 'pembayaran_hari_ini');
        $this->db->from('detail_utang');
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