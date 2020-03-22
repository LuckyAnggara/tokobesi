<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laporan_Persediaan extends CI_Model
{
    // global

    function data_persediaan($post)
    {
        $jenis_data = $post['data'];
        switch ($jenis_data) {
            case '0':
                return $this->get_persediaan_per_barang($post);
                break;
            case '1':
                return $this->data_utang_supplier($post);
                break;
            case '2':
                return $this->data_utang_lengkap($post);
                break;
        }
    }

    function get_persediaan_per_barang($post){
        $output = array();
        $data_barang = $this->get_data_barang();
        foreach ($data_barang as $key => $value) {
            $data_persediaan = $this->get_data_persediaan($value['kode_barang'], $post);

            $total_persediaan = 0;
            $total_persediaan_akhir = 0;
            $total_saldo = 0;

            foreach ($data_persediaan as $key => $data) {
                $total_persediaan = $total_persediaan + $data['jumlah_pembelian'];
                $total_persediaan_akhir = $total_persediaan_akhir + $data['saldo'];
                $total_saldo = $total_saldo + $data['total'];
            }

            $data = [
                'kode_barang' => $value['kode_barang'],
                'nama_barang' => $value['nama_barang'],
                'nama_satuan' => $value['nama_satuan'],
                'total_persediaan' => $total_persediaan,
                'total_persediaan_akhir' => $total_persediaan_akhir,
                'total_saldo' => $total_saldo,
                'data_persediaan' => $data_persediaan,
            ];
            if($data_persediaan != null){
                $output[] = $data;
            }
        }
        return $output;
    }

    function get_data_barang()
    {
        $this->db->select('kode_barang, nama_barang, master_satuan_barang.nama_satuan');
        $this->db->from('master_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $data = $this->db->get()->result_array();
        return $data;
    }

    function get_data_persediaan($kode_barang, $post){
        $output = array();

        $data_pembelian = $this->data_pembelian($kode_barang, $post);
        
        $data_retur_penjualan = $this->data_retur_penjualan($kode_barang, $post);
        foreach ($data_pembelian as $key => $value) {
            $data_retur_pembelian = $this->data_retur_pembelian($value['kode_barang'], $post, $value['id']);
            $data_sisa_pembelian = $this->data_sisa_pembelian($value['kode_barang'], $post, $value['id']);
            $saldo = $value['jumlah_pembelian']  - $data_retur_pembelian - $data_sisa_pembelian ;
            if ($saldo == 0) {
                continue;
            } else {
                $data = [
                    'nomor_transaksi' => $value['nomor_transaksi'],
                    'jumlah_pembelian' => $value['jumlah_pembelian'],
                    'saldo' =>  $saldo,
                    'harga_beli' => $value['harga_beli'],
                    'total' =>  $saldo *  $value['harga_beli'],
                    'keterangan' => 'Pembelian Nomor Transaksi : ' . $value['nomor_transaksi'],
                ];
            }
            $output[] = $data;
        }

        foreach ($data_retur_penjualan as $key => $value) {
            if ($value['saldo_tersedia'] == 0) {
                continue;
            } else {
                $data = [
                    'nomor_transaksi' => $value['nomor_faktur'],
                    'jumlah_pembelian' => $value['saldo_retur'],
                    'saldo' => $value['saldo_tersedia'],
                    'harga_beli' => $value['harga_pokok'],
                    'total' => $value['saldo_tersedia'] *  $value['harga_pokok'],
                    'keterangan' => 'Retur dari Nomor Faktur : ' . $value['nomor_faktur'],
                ];
            }
            $output[] = $data;
        }

        return $output;      
    }

    function data_pembelian($kode_barang, $post){

        $this->db->select('kode_barang, jumlah_pembelian, saldo, harga_beli,nomor_transaksi,id');
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-01-01 00:00:00'));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        return $this->db->get()->result_array();
    }

    function data_retur_pembelian($kode_barang, $post, $tag)
    {

        $this->db->select('sum(`jumlah_retur`) as qty');
        $this->db->from('detail_retur_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('id_detail_pembelian', $tag);
        $this->db->where('tanggal_transaksi >=', date('Y-01-01 00:00:00'));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $data = $this->db->get()->row();
        return $data->qty;
    }

    function data_sisa_pembelian($kode_barang, $post, $tag)
    {
        $this->db->select('sum(`qty`) as qty, tag');
        $this->db->from('master_harga_pokok_penjualan');
        $this->db->where('tag', $tag);
        $this->db->where('jenis_barang', 'pembelian_bersih');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-01-01 00:00:00'));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $data = $this->db->get()->row();
        return $data->qty;
    }

    function data_retur_penjualan($kode_barang, $post)
    {

        $this->db->select('saldo_retur, saldo_tersedia, harga_pokok,nomor_faktur, id');
        $this->db->from('detail_retur_barang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-01-01'));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal'])));
        return $this->db->get()->result_array();
    }
}