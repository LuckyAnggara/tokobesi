<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Saldo_Awal_Persediaan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function getData()
    {

        $this->db->select('kode_barang');
        $this->db->from('master_saldo_awal');
        $output = $this->db->get()->result_array();

        foreach ($output as $key => $value) {
            $data['kode_barang'][] = $value['kode_barang'];
        }

        $this->db->select('*');
        $this->db->from('master_barang');
        if (!empty($output)) {
            $this->db->where_not_in('kode_barang', $data['kode_barang']);
        }
        return $this->db->get();
    }

    function getAllData()
    {
        $this->db->select('*');
        $this->db->select('(`qty_awal`*`harga_awal`) as total');
        $this->db->from('master_saldo_awal');
        $this->db->join('master_barang', 'master_barang.kode_barang = master_saldo_awal.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        return $this->db->get();
    }

    function tambah_data($post)
    {
        $qty = $this->normal($post['jumlah']);
        $harga = $this->normal($post['harga']);
        $data = [
            'kode_barang' => $post['kode_barang'],
            'qty_awal' => $qty,
            'saldo_awal' => $qty,
            'nomor_faktur' => 'SALDO AWAL', // hanya dummy data
            'harga_awal' => $harga,
            'tanggal_input' => date("Y-m-d H:i:s"),
            'tanggal_saldo' => date("Y-01-01 00:00:01"),
            'user' => $this->session->userdata['username'],
        ];

        $this->db->insert('master_saldo_awal', $data);
    }

    function normal($value)
    {

        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }

    function view_edit_data($id)
    {
        $this->db->select('*');
        $this->db->from('master_saldo_awal');
        $this->db->join('master_barang', 'master_barang.kode_barang = master_saldo_awal.kode_barang');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    function edit_data($id, $post)
    {
        $qty = $this->normal($post['edit_jumlah']);
        $harga = $this->normal($post['edit_harga']);
        $data = [
            'qty_awal' => $qty,
            'harga_awal' => $harga,
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];

        $this->db->where('id', $id);
        $this->db->update('master_saldo_awal', $data);
    }

    function delete_data($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_saldo_awal');
    }

    function subTotal()
    {
        $this->db->select_sum('qty_awal');
        $this->db->select('SUM(qty_awal*harga_awal) as total');
        $this->db->from('master_saldo_awal');
        return $this->db->get()->row_array();
    }
}
