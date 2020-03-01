<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deletetemp extends CI_Controller
{
    function delete_temp_tabel_keranjang_pembelian()
    {
        $this->db->empty_table('temp_tabel_keranjang_pembelian');
        $this->db->empty_table('temp_tabel_keranjang_penjualan');
        $this->db->empty_table('temp_purchase_order');
        $this->db->empty_table('tabel_perhitungan_order');
    }

    function saldo_awal($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_saldo_awal');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        if ($data == null) {
            $ouput = [
                'saldo_awal' => 0
            ];
            return $ouput;
        } else {
            return $data;
        }
    }

    function cek()
    {
        $data = $this->saldo_awal('bes0002');
        print_r($data);
    }
}
