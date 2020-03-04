<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Retur_Penjualan extends CI_Model
{
    function get_data($post)
    {
        $no_faktur = $post['nomor_faktur'];
        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');
        $this->db->where('no_faktur', $no_faktur);
        $output = $this->db->get()->row_array();
        return $output;
    }

    function get_detail_data($post)
    {
        $no_faktur = $post['nomor_faktur'];
        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_penjualan.kode_barang');
        $this->db->where('nomor_faktur', $no_faktur);
        $output = $this->db->get()->result_array();
        return $output;
    }

    function tambah_data_master($post)
    {
        $cekDouble = $this->cek_double($post['nomor_faktur']);

        if ($cekDouble > 0) {
            $this->db->where('nomor_faktur', 'RTR-' . $post['nomor_faktur']);
            $this->db->delete('master_retur_penjualan');
        }
        $data = [
            "nomor_faktur" => 'RTR-' . $post['nomor_faktur'],
            "nomor_faktur_asli" => $post['nomor_faktur'],
            "id_pelanggan" => $post['id_pelanggan'],
            "retur_total" => $post['retur_total'],
            "retur_diskon" => $post['retur_diskon'],
            "retur_pajak" => $post['retur_pajak'],
            "retur_grand_total" => $post['retur_grand_total'],
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_retur_penjualan', $data);
    }

    function tambah_data_detail($post)
    {
        $nomor_faktur = $this->cek_last_faktur();
        $data = [
            "id_detail_penjualan" => $post['id_detail_penjualan'],
            "nomor_faktur" => 'RTR-' . $post['nomor_faktur'],
            "kode_barang" => $post['kode_barang'],
            "keterangan" => $post['keterangan'],
            "jumlah_retur" => $post['qty'],
            "saldo" => $post['qty'],
            "harga_retur" => $this->normal($post['harga']),
            "diskon" => $post['diskon'],
            "total_retur" => $post['retur_total'],
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('detail_retur_penjualan', $data);
    }

    private function cek_double($nomor_faktur)
    {
        $this->db->select('nomor_faktur');
        $this->db->from('master_retur_penjualan');
        $this->db->where('nomor_faktur', 'RTR-' . $nomor_faktur);
        return $this->db->get()->num_rows();
    }

    private function cek_last_faktur()
    {
        $this->db->select('nomor_faktur');
        $this->db->from('master_retur_penjualan');
        $this->db->order_by('tanggal', 'ASC');
        $data = $this->db->get()->row_array();
        return $data['nomor_faktur'];
    }

    function get_data_retur($post)
    {
        $this->db->select('master_retur_penjualan.*,master_pelanggan.nama_pelanggan, master_user.nama as nama_pegawai ');
        $this->db->from('master_retur_penjualan');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_retur_penjualan.id_pelanggan');
        $this->db->join('master_user', 'master_user.username = master_retur_penjualan.user');
        $this->db->where('tanggal >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->order_by('tanggal', 'DESC');
        $output = $this->db->get();
        return $output;
    }


    function delete_data($nomor_faktur)
    {
        $this->db->where('nomor_faktur', $nomor_faktur);
        $this->db->delete('master_retur_penjualan');
    }


    // faktur retur penjualan

    function get_data_faktur($nomor_faktur) // udah include nominal pembayaran dan status
    {
        $this->db->select('*, master_user.nama as nama_pegawai');
        $this->db->from('master_retur_penjualan');
        $this->db->join('master_user', 'master_user.username = master_retur_penjualan.user');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_retur_penjualan.id_pelanggan');
        $this->db->where('nomor_faktur', $nomor_faktur);
        return $this->db->get()->row_array();
    }

    function get_detail_faktur($nomor_faktur)
    {
        $this->db->select('*');
        $this->db->from('detail_retur_penjualan');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_retur_penjualan.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('nomor_faktur', $nomor_faktur);
        return $this->db->get()->result_array();
    }

    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }
}
