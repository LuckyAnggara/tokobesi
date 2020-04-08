<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Po extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string'));
    }

    public function get_data_keranjang_clear($no_order)
    {
        //  cek dulu apakah sudah di save apa blm
        $this->db->where('no_order_po', $no_order);
        $this->db->delete('temp_tabel_keranjang_po');

        $this->db->where('no_order', $no_order);
        $this->db->delete('tabel_perhitungan_order');

        $data['no_order_po'] = $no_order;
        $this->_delete_detail_pembelian_temp($data);
    }

    function get_data_supplier($string)
    {
        $this->db->select('*');
        $this->db->from('master_supplier');
        $this->db->like('kode_supplier', $string);
        $this->db->or_like('nama_supplier', $string);
        return $this->db->get()->result_array();
    }


    function push_data_barang()
    {
        $post = $this->input->post();
        $data = [
            'no_order_po' => $post['no_order_po'],
            'tanggal_transaksi' => date('Y-m-d H:i:s', strtotime($post['tanggal_transaksi'])),
            'kode_barang' => $post['kode_barang'],
            'jumlah_pembelian' => $post["jumlah_pembelian"],
            'harga_beli' => $post["harga_beli"],
            'total_harga' => $post["harga_beli"] * $post['jumlah_pembelian'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('temp_tabel_keranjang_po', $data);
    }

    function push_total_perhitungan($post)
    {
        $this->db->select_sum('total_harga');
        $this->db->where('no_order_po', $post['no_order_po']);
        $total_harga = $this->db->get('temp_tabel_keranjang_po')->row_array();

        $total_keranjang = $total_harga['total_harga'];

        $grand_total = $total_keranjang + $post['ongkir'];

        $this->db->select('*');
        $this->db->from('tabel_perhitungan_order');
        $this->db->where('no_order', $post['no_order_po']);
        $cek = $this->db->get()->num_rows();

        $data = array(
            'no_order' => $post['no_order_po'],
            'total_keranjang' => $total_keranjang,
            'ongkir' => $post['ongkir'],
            'grand_total' => $grand_total
        );

        if ($cek < 1) {
            $this->db->insert('tabel_perhitungan_order', $data);
        } else {
            $this->db->query("DELETE From tabel_perhitungan_order Where no_order = '" . $post['no_order_po'] . "'"); // delete dulu
            $this->db->insert('tabel_perhitungan_order', $data); // lalu tambah
        }
    }

    function get_data_keranjang($no_order_po)
    {
        $this->db->select('temp_tabel_keranjang_po.*, master_barang.*');
        $this->db->from('temp_tabel_keranjang_po');
        $this->db->join('master_barang', 'master_barang.kode_barang = temp_tabel_keranjang_po.kode_barang');
        $this->db->where('no_order_po', $no_order_po);
        $output = $this->db->get();
        return $output;
    }

    function delete_data_keranjang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('temp_tabel_keranjang_po');
    }

    function push_grand_total($post)
    {
        $this->db->select('*');
        $this->db->from('tabel_perhitungan_order');
        $this->db->where('no_order', $post['no_order_po']);
        $cek = $this->db->get()->num_rows();
        $data = array(
            'no_order' => $post['no_order_po'],
            'total_keranjang' => $post['total_pembelian'],
            'ongkir' => 0,
            'grand_total' => $post['grand_total']
        );
        if ($cek < 1) {
            $this->db->insert('tabel_perhitungan_order', $data);
        } else {
            $this->db->query("DELETE From tabel_perhitungan_order Where no_order = '" . $post['no_order_po'] . "'"); // delete dulu
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

    function get_sum_keranjang($no_order)
    {
        // $this->db->select_sum('diskon');
        // $this->db->where('no_order_po', $no_order);
        // $diskon = $this->db->get('temp_tabel_keranjang_po')->row_array();

        $this->db->select_sum('total_harga');
        $this->db->where('no_order_po', $no_order);
        $total_harga = $this->db->get('temp_tabel_keranjang_po')->row_array();
        $output = array(
            "total_pembelian" => $total_harga['total_harga'],
            "total_harga" => $total_harga['total_harga']
        );

        return $output;
    }


    function proses($post)
    {
        $data = array(
            'no_order_po' => $post['no_order_po'],
            'tanggal_transaksi' => date('Y-m-d H:i:s', strtotime($post['tanggal_transaksi'])),
            'cabang' => $post['cabang'],
            'tanggal_input' =>  date("Y-m-d H:i:s"),
            'status' => '0', // 0 untuk belum terkirim 1 untuk ter kirim 2 untuk diterima
            'keterangan' => $post['keterangan'],
            'user' => $this->session->userdata['username'],
        );

        $this->db->insert('master_po', $data);

        // update data total pembelian
        $this->db->query("UPDATE master_po INNER JOIN tabel_perhitungan_order ON tabel_perhitungan_order.no_order = master_po.no_order_po SET master_po.total_pembelian = tabel_perhitungan_order.total_keranjang, master_po.biaya_lainnya = tabel_perhitungan_order.ongkir, master_po.grand_total = tabel_perhitungan_order.grand_total where  tabel_perhitungan_order.no_order = '" . $post['no_order_po'] . "'");

        $this->_tambah_detail_pembelian($post);
        $this->_delete_detail_pembelian_temp($post);
    }


    private function _tambah_detail_pembelian($post)
    {
        $this->db->select('*');
        $this->db->from('temp_tabel_keranjang_po');
        $this->db->where('no_order_po', $post['no_order_po']);
        $output = $this->db->get()->result_array();

        
        foreach ($output as $key => $value) {
            $nama_barang = $this->nama_barang($value['kode_barang']);
            $data = [
                'no_order_po' => $value['no_order_po'],
                'tanggal_transaksi' => $value['tanggal_transaksi'],
                'kode_barang' => $value['kode_barang'],
                'nama_barang' => $nama_barang,
                'jumlah_pembelian' => $value['jumlah_pembelian'],
                'harga_beli' => $value['harga_beli'],
                'total_harga' => $value['jumlah_pembelian'],
                'tanggal_input' => $value['tanggal_input'],
            ];
            $this->db->insert('detail_po', $data);
        }
        // $this->db->select('*');
        // $this->db->query("INSERT INTO `detail_po`(`no_order_po`,`tanggal_transaksi`, `kode_barang`, `jumlah_pembelian`,`harga_beli`,`total_harga`,`tanggal_input`) SELECT `no_order_po`, `tanggal_transaksi`, `kode_barang`, `jumlah_pembelian`,`harga_beli`,`total_harga`,`tanggal_input`, FROM temp_tabel_keranjang_po WHERE no_order_po = '" . $post['no_order_po'] . "'");
    }

    function nama_barang($kode_barang){
        $this->db->select('nama_barang');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        return $data['nama_barang'];
    }

    private function _delete_detail_pembelian_temp($post)
    {
        $this->db->where('no_order_po', $post['no_order_po']);
        $this->db->delete('temp_tabel_keranjang_po');
    }


    function get_daftar_request()
    {
        $this->db->select('*, DATE_FORMAT(tanggal_input, "%d %b %Y") as tanggal_input, DATE_FORMAT(tanggal_transaksi, "%d %b %Y") as tanggal_transaksi');
        $this->db->from('master_po');
        $data =  $this->db->get()->result_array();
        return $data;
    }
    function get_daftar_receive()
    {
        $this->db->select('*, DATE_FORMAT(tanggal_masuk, "%d %b %Y") as tanggal_masuk');
        $this->db->from('master_receive_po');
        $data =  $this->db->get()->result_array();
        return $data;
    }

    function get_data_po($no_order_po){

        $this->db->select('*');
        $this->db->from('master_po');
        $this->db->where('no_order_po', $no_order_po);
        $data_po = $this->db->get()->row_array();

        $this->db->select('detail_po.*, master_satuan_barang.nama_satuan');
        $this->db->from('detail_po');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_po.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('no_order_po', $no_order_po);
        $detail_po = $this->db->get()->result_array();

        $data = [
            'no_order_po' => $data_po['no_order_po'],
            'tanggal_transaksi' => $data_po['tanggal_transaksi'],
            'cabang' => $data_po['cabang'],
            'total_pembelian' => $data_po['total_pembelian'],
            'biaya_lainnya' => $data_po['biaya_lainnya'],
            'grand_total' => $data_po['grand_total'],
            'keterangan' => $data_po['keterangan'],
            'status' => $data_po['status'],
            'detail_po' => $detail_po
        ];

        return $data;

        
    }
}
