<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Retur_Persediaan extends CI_Model
{

    function get_data_barang($string)
    {
        $this->db->select('master_barang.kode_barang, master_barang.nama_barang');
        $this->db->select_sum('detail_retur_penjualan.saldo', 'saldo');
        $this->db->from('detail_retur_penjualan');
        $this->db->join('master_barang', 'detail_retur_penjualan.kode_barang = master_barang.kode_barang');
        $this->db->group_by('detail_retur_penjualan.kode_barang', $string);
        $this->db->like('detail_retur_penjualan.kode_barang', $string);
        $this->db->or_like('nama_barang', $string);
        $this->db->having('saldo !=', 0);
        return $this->db->get();
    }

    function get_detail_barang($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get()->row_array();
    }

    function get_detail_retur($kode_barang)
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d %b %Y") as tanggal');
        $this->db->from('detail_retur_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->having('saldo !=', 0);
        return $this->db->get();
    }

    function total_saldo($kode_barang)
    {
        $this->db->select_sum('saldo');
        $this->db->from('detail_retur_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row();
        return $data->saldo;
    }

    function push_retur($post)
    {
        $data_retur = $this->get_barang_retur($post['id']);
        $data = [
            'nomor_faktur' => $data_retur['nomor_faktur'],
            'kode_barang' => $data_retur['kode_barang'],
            'harga_pokok' => $this->normal($post['harga_pokok']),
            'saldo_tersedia' => $post['jumlah'],
            'saldo_retur' => $post['jumlah'],
            'keterangan' => $data_retur['nomor_faktur'] . ' - ' . $data_retur['keterangan'],
            'tanggal_input' =>  date('Y-m-d H:i:s'),
            'tanggal_transaksi' => date('Y-m-d H:i:s', strtotime($data_retur['tanggal_transaksi'])),
            'user' => $this->session->userdata['username'],
        ];

        $this->db->insert('detail_retur_barang_penjualan', $data);

        // update detail_retur_penjualan

        $data = [
            'saldo' => $data_retur['saldo'] - $post['jumlah'],
        ];

        $this->db->where('id', $post['id']);
        $this->db->update('detail_retur_penjualan', $data);
    }

    function get_barang_retur($id)
    {
        $this->db->select('*');
        $this->db->from('detail_retur_penjualan');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }
}
