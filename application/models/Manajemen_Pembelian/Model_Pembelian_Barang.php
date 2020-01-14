<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Pembelian_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string'));
    }

    public function get_data_keranjang_clear($no_order)
    {
        //  cek dulu apakah sudah di save apa blm

        $this->db->where('no_order_pembelian', $no_order);
        $this->db->delete('temp_tabel_keranjang_pembelian');

        $this->db->where('no_order', $no_order);
        $this->db->delete('tabel_perhitungan_order');
    }

    function get_data_supplier()
    {
        $this->db->select('*');
        $this->db->from('master_supplier');
        return $this->db->get()->result_array();
    }

    function get_data_barang($string)
    {
        if ($string == null) {
            $this->db->select('master_persediaan.*, master_barang.*, master_satuan_barang.nama_satuan');
            $this->db->from('master_persediaan');
            $this->db->join('master_barang', 'master_barang.kode_barang = master_persediaan.kode_barang');
            $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
            $output = $this->db->get();
            return $output;
        } else {
            $this->db->select('master_persediaan.*, master_barang.*, master_satuan_barang.nama_satuan');
            $this->db->from('master_persediaan');
            $this->db->join('master_barang', 'master_barang.kode_barang = master_persediaan.kode_barang');
            $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
            $this->db->like("master_persediaan.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function push_data_barang($post)
    {
        $harga_total = $post['jumlah_pembelian']*$post['harga_beli'];
        $data = [
            'no_order_pembelian' => $post['no_order_pembelian'],
            'tanggal_transaksi' => date('Y-m-d H:i:s',strtotime($post['tanggal_transaksi'])),
            'kode_barang' => $post['kode_barang'],
            'jumlah_pembelian' => $post["jumlah_pembelian"],
            'harga_beli' => $post["harga_beli"],
            'diskon' => 0,
            'total_harga' => $harga_total,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('temp_tabel_keranjang_pembelian', $data);
    }

    function get_data_keranjang($no_order_pembelian)
    {
        $this->db->select('temp_tabel_keranjang_pembelian.harga_beli,temp_tabel_keranjang_pembelian.jumlah_pembelian,temp_tabel_keranjang_pembelian.total_harga,temp_tabel_keranjang_pembelian.id, master_barang.kode_barang,master_barang.nama_barang');
        $this->db->from('temp_tabel_keranjang_pembelian');
        $this->db->join('master_barang', 'master_barang.kode_barang = temp_tabel_keranjang_pembelian.kode_barang');
        $this->db->where('no_order_pembelian', $no_order_pembelian);
        $output = $this->db->get();
        return $output;
    }

    function delete_data_keranjang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('temp_tabel_keranjang_pembelian');
    }

    function push_grand_total($post)
    {
        $this->db->select('*');
        $this->db->from('tabel_perhitungan_order');
        $this->db->where('no_order', $post['no_order_pembelian']);
        $cek = $this->db->get()->num_rows();
        $data = array(
            'no_order' => $post['no_order_pembelian'],
            'total_keranjang' => $post['total_pembelian'],
            'diskon' => $post['diskon'],
            'pajak' => $post['pajak_keluaran'],
            'ongkir' => 0,
            'grand_total' => $post['grand_total']
        );
        if ($cek < 1) {
            $this->db->insert('tabel_perhitungan_order', $data);
        } else {
            $this->db->query("DELETE From tabel_perhitungan_order Where no_order = '" . $post['no_order_pembelian']. "'"); // delete dulu
            $this->db->insert('tabel_perhitungan_order', $data); // lalu tambah
        }
    }

    function get_total_perhitungan($no_order)
    {
        $this->db->select('*');
        $this->db->from('tabel_perhitungan_order');
        $this->db->where('no_order', $no_order);
        $output = $this->db->get()->row_array();
        return $output;
    }

    function proses_pembelian($post)
    {
        // input data baru

        $data = array(
            'no_order_pembelian' => $post['no_order_pembelian'],
            'nomor_transaksi' => $post['nomor_transaksi'],
            'tanggal_transaksi' => date('Y-m-d H:i:s',strtotime($post['tanggal_transaksi'])),
            'kode_supplier' => $post['kode_supplier'],
            'tanggal_input' =>  date("Y-m-d H:i:s"),
            'status' => 0, // 0 untuk lunas 1 untuk nyicil cashbon
            'user_input' =>'udin',
        );

        $this->db->insert('master_pembelian', $data);

        // update data total pembelian
        $this->db->query("UPDATE master_pembelian INNER JOIN tabel_perhitungan_order ON tabel_perhitungan_order.no_order = master_pembelian.no_order_pembelian SET master_pembelian.total_pembelian = tabel_perhitungan_order.total_keranjang, master_pembelian.diskon = tabel_perhitungan_order.diskon, master_pembelian.pajak_keluaran = tabel_perhitungan_order.pajak, master_pembelian.ongkir = tabel_perhitungan_order.ongkir, master_pembelian.grand_total = tabel_perhitungan_order.grand_total where  tabel_perhitungan_order.no_order = '" . $post['no_order_pembelian']."'");

        $this->_tambah_data_persediaan($post);
        $this->_tambah_detail_pembelian($post);

    }

    private function _tambah_detail_pembelian($post)
    {
        $this->db->query("INSERT INTO `detail_pembelian`(`tanggal_transaksi`, `no_order_pembelian`, `kode_barang`, `jumlah_pembelian`,`harga_beli`,`diskon`,`total_harga`,`tanggal_input`) SELECT `tanggal_transaksi`, `no_order_pembelian`, `kode_barang`, `jumlah_pembelian`,`harga_beli`,`diskon`,`total_harga`,`tanggal_input` FROM temp_tabel_keranjang_pembelian WHERE no_order_pembelian = '" . $post['no_order_pembelian']."'");

        
        $update = [
                'nomor_transaksi' => $post['nomor_transaksi']
        ];
        $this->db->where('no_order_pembelian', $post['no_order_pembelian']);
        $this->db->update('detail_pembelian', $update);
    }

    private function _tambah_data_persediaan($post)
    {
        $this->db->select('*');
        $this->db->from('temp_tabel_keranjang_pembelian');
        $this->db->where('no_order_pembelian', $post['no_order_pembelian']);
        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {
            $this->db->select('*');
            $this->db->from('master_persediaan');
            $this->db->where('kode_barang', $value['kode_barang']);
            $jumlah_lama = $this->db->get()->row_array();

            $update = [
                'jumlah_persediaan' => $value['jumlah_pembelian'] + $jumlah_lama['jumlah_persediaan'],
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->where('kode_barang', $value['kode_barang']);
            $this->db->update('master_persediaan', $update);
        }

    }

}