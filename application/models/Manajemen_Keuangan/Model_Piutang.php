<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Piutang extends CI_Model
{

    function get_data_piutang($post)
    {
        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_piutang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_piutang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_piutang');
        $this->db->join('master_user', 'master_user.username = master_piutang.user');
        $this->db->where('tanggal_input >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->order_by('tanggal_input', 'DESC');
        $output = $this->db->get();
        return $output;
    }

    function get_data_sales($nomor_faktur)
    {
        $this->db->select('master_penjualan.sales,master_user.nama as nama_sales');
        $this->db->from('master_penjualan');
        $this->db->join('master_user', 'master_user.username = master_penjualan.sales');
        $this->db->where('no_faktur', $nomor_faktur);
        $output = $this->db->get()->row_array();
        if (!isset($output)) {
            return "";
        } else {
            return $output['nama_sales'];
        }
    }

    function get_data_pelanggan($nomor_faktur)
    {
        $this->db->select('master_pelanggan.nama_pelanggan as nama_pelanggan');
        $this->db->from('master_penjualan');
        $this->db->join('master_piutang', 'master_piutang.no_faktur = master_penjualan.no_faktur');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('master_penjualan.no_faktur', $nomor_faktur);
        $output = $this->db->get()->row_array();
        return $output['nama_pelanggan'];
    }

    function get_detail_pembayaran($nomor_faktur)
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d %b %Y") as tanggal');
        $this->db->from('detail_piutang');
        $this->db->where('nomor_faktur', $nomor_faktur);
        return $this->db->get();
    }

    function tambah_pembayaran($post)
    {
        $nominal_pembayaran = str_replace(".", "", $post['nominal_pembayaran']);
        $nominal_pembayaran = str_replace("Rp ", "", $nominal_pembayaran);
        $data = [
            'nomor_faktur' => $post['nomor_faktur'],
            'tanggal' => date('Y-m-d H:i:s', strtotime($post['tanggal'])),
            'nominal_pembayaran' => $nominal_pembayaran,
            'sisa_piutang' => $this->_sisa_piutang($post['nomor_faktur'], $nominal_pembayaran),
            'keterangan' => $post['keterangan'],
            'user' => $this->session->userdata['username'],
            'bukti' => $this->_uploadBukti(),
        ];
        $this->db->insert('detail_piutang', $data);
    }

    function update_master($post)
    {
        $total_pembayaran = $this->_total_pembayaran($post['nomor_faktur']);
        $data = [
            'total_pembayaran' => $total_pembayaran,
            'sisa_piutang' => $post['grand_total'] - $total_pembayaran,
        ];

        $this->db->where('no_faktur', $post['nomor_faktur']);
        $this->db->update('master_piutang', $data);
    }

    private function _sisa_piutang($nomor_faktur, $nominal_pembayaran)
    {
        $this->db->select('sisa_piutang');
        $this->db->from('master_piutang');
        $this->db->where('no_faktur', $nomor_faktur);
        $data = $this->db->get()->row_array();
        $sisa_piutang = $data['sisa_piutang'];

        $output =  $sisa_piutang - $nominal_pembayaran;
        if ($output == 0) {
            $this->_ganti_status($nomor_faktur);
        }
        return $output;
    }

    private function _ganti_status($nomor_faktur)
    {
        $data = [
            'status_bayar' => 1,
        ];
        $this->db->where('no_faktur', $nomor_faktur);
        $this->db->update('master_penjualan', $data);
    }

    private function _total_pembayaran($nomor_faktur)
    {
        $this->db->select_sum('nominal_pembayaran');
        $this->db->from('detail_piutang');
        $this->db->where('nomor_faktur', $nomor_faktur);
        $output = $this->db->get()->row_array();

        return $output['nominal_pembayaran'];
    }

    private function _uploadBukti()
    {
        $config['upload_path'] = './assets/upload/bukti/piutang/';
        $config['allowed_types'] = 'jpeg|jpg|png|pdf';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['max_size'] = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('bukti')) {
            return $this->upload->data('file_name');
        } else {
            return "";
        }
    }

    function saldo_piutang()
    {
        $this->db->select_sum('sisa_piutang');
        $this->db->from('master_piutang');
        $output = $this->db->get()->row_array();
        return $output['sisa_piutang'];
    }

    function saldo_piutang_detail($nomor_faktur)
    {
        $this->db->select('sisa_piutang');
        $this->db->from('master_piutang');
        $this->db->where('no_faktur', $nomor_faktur);
        $output = $this->db->get()->row_array();
        return $output['sisa_piutang'];
    }

    function status_bayar($nomor_faktur)
    {
        $this->db->select('status_bayar');
        $this->db->from('master_penjualan');
        $this->db->where('no_faktur', $nomor_faktur);
        $output = $this->db->get()->row_array();
        return $output['status_bayar'];
    }
}
