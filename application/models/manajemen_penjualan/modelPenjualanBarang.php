<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelPenjualanBarang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function get_data_by_id($id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('tabel_pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);

        return $this->db->get()->row_array();
    }

    function get_data_barang2($string)
    {
        if ($string == null) {
            $this->db->select('*');
            $this->db->from('master_persediaan');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_barang');
            $this->db->like("master_barang.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $this->db->or_like("harga_satuan", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function get_data_barang($string)

    {
        if ($string == null) {
            $this->db->select('master_persediaan.*, master_barang.*');
            $this->db->from('master_persediaan');
            $this->db->join('master_barang', 'master_barang.kode_barang = master_persediaan.kode_barang');
            $output = $this->db->get();
            return $output;
        } else {
            $this->db->select('master_persediaan.*, master_barang.*');
            $this->db->from('master_persediaan');
            $this->db->join('master_barang', 'master_barang.kode_barang = master_persediaan.kode_barang');
            $this->db->like("master_persediaan.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function push_data_barang()
    {
        $post = $this->input->post();
        if ($post['id_pelanggan'] == null) {
            $post['id_pelanggan'] = 0;
        }
        $data = [
            'id_pelanggan' => $post['id_pelanggan'],
            'no_order'=>$post['no_order'],
            'kode_barang' => $post['kode_barang'],
            'jumlah_pembelian' => $post["jumlah_pembelian"],
            'harga_total' => $this->_hitung_total($post['kode_barang'], $post['jumlah_pembelian']),
        ];
        $this->db->insert('tabel_keranjang_temp', $data);
    }

    private function _hitung_total($kode_barang, $jumlah_pembelian)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $output = $data['harga_satuan'];
        return $output * $jumlah_pembelian;
    }

    function get_data_keranjang($no_order)
    {
        $this->db->select('tabel_keranjang_temp.*, master_barang.*');
        $this->db->from('tabel_keranjang_temp');
        $this->db->join('master_barang', 'master_barang.kode_barang = tabel_keranjang_temp.kode_barang');
        $this->db->where('no_order', $no_order);
        $output = $this->db->get();
        return $output;
    }

    function delete_data_keranjang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tabel_keranjang_temp');
    }

     public function persediaan_temp_tambah(){
        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('master_persediaan');
        $this->db->where('kode_barang', $post['kode_barang']);
        $output = $this->db->get()->row_array();
        $data = array(
        'jumlah_keranjang' => $output['jumlah_keranjang'] + $post['jumlah_pembelian'],
        'jumlah_persediaan' => $output['jumlah_persediaan'] - $post['jumlah_pembelian']
        );
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->update('master_persediaan', $data);
    }

    public function persediaan_temp_batal($input = null){
        if($input !== null){
        $post = $input;
        }else
        $post = $this->input->post();
        {
        $this->db->select('*');
        $this->db->from('tabel_keranjang_temp');
        $this->db->where('id', $post['id']);
        $output_keranjang = $this->db->get()->row_array();

        $this->db->select('*');
        $this->db->from('master_persediaan');
        $this->db->where('kode_barang', $output_keranjang['kode_barang']);
        $output_persediaan = $this->db->get()->row_array();

        $data = array(
        'jumlah_keranjang' => $output_persediaan['jumlah_keranjang'] - $output_keranjang['jumlah_pembelian'],
        'jumlah_persediaan' => $output_persediaan['jumlah_persediaan'] + $output_keranjang['jumlah_pembelian']
        );

        $this->db->where('kode_barang', $output_keranjang['kode_barang']);
        $this->db->update('master_persediaan', $data);
    }
    }

    public function get_data_keranjang_clear($no_order){

        $this->db->select('*');
        $this->db->from('tabel_keranjang_temp');
        $this->db->where('no_order', $no_order);
        $data = $this->db->get()->result_array();

        foreach ($data as $value){
            $this->persediaan_temp_batal($value);
        }

        $this->db->where('no_order', $no_order);
$this->db->delete('tabel_keranjang_temp');
    }
    
}
