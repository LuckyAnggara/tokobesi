<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Penjualan_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url','string'));
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

    function push_data_barang()
    {
        $post = $this->input->post();
        if ($post['id_pelanggan'] == null) {
            $post['id_pelanggan'] = 0;
        }
        $data = [
            'id_pelanggan' => $post['id_pelanggan'],
            'no_order' => $post['no_order'],
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

    public function persediaan_temp_tambah()
    {
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

    public function persediaan_temp_batal($input = null)
    {
       
        if ($input !== null) {
            $post = $input;
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
        }else{

        }
    }

    public function get_data_keranjang_clear($no_order)
    {   
        //  cek dulu apakah sudah di save apa blm

        $this->db->select('*');
        $this->db->from('tabel_daftar_belanja'); 
        $this->db->where('no_order', $no_order);
        $cek = $this->db->get()->num_rows();

        if($cek > 0){

        }else{
        $this->db->select('*');
        $this->db->from('tabel_keranjang_temp');
        $this->db->where('no_order', $no_order);
        $data = $this->db->get()->result_array();

        foreach ($data as $value) {
            $this->persediaan_temp_batal($value);
        }
        }

        $this->db->where('no_order', $no_order);
        $this->db->delete('tabel_keranjang_temp');

        
    }

    function simpan_order($post)
    {
        if($post['id_pelanggan'] == ""){
            $id = $this->_createPelangganDummy($post);
        }else{
            $id = $post['id_pelanggan'];
        }
        $data = array(
            'no_order' => $post['no_order'],
            'id_pelanggan' => $id,
            'status' => 0, // belum di proses masih di keranjang unpaid.
            'tanggal_input' => date("Y-m-d H:i:s"),
        );    
        
        $cek = $this->_cekNoOrderTabel($post['no_order']);
        if($cek < 1){
            $this->db->insert('tabel_daftar_belanja', $data);
        }
        $this->db->query('DELETE From tabel_keranjang_belanja Where no_order = '.$post['no_order']);
      
        $this->db->query('INSERT INTO `tabel_keranjang_belanja`(`no_order`, `kode_barang`, `jumlah_pembelian`, `harga_total`) SELECT `no_order`, `kode_barang`, `jumlah_pembelian`, `harga_total` FROM tabel_keranjang_temp WHERE no_order = '. $post['no_order'].'');
    }

    // cek nomor order apa udhh terddaftar di tabel, in case 2x klik simpan
    private function _cekNoOrderTabel($no_order){
        $this->db->select('*');
        $this->db->from('tabel_daftar_belanja'); 
        $this->db->where('no_order', $no_order);
        return $this->db->get()->num_rows();
    }


    private function _createPelangganDummy($post)
    {
        $id = random_string('alnum', 16);
        $data = array(
            'id_pelanggan' => $id,
            'nama_pelanggan' => $post['nama_pelanggan'],
            'alamat' => $post['alamat'],
            'nomor_telepon' => $post['nomor_telepon'],
            'status' => 1 // dummy id.
        );
        $this->db->insert('tabel_pelanggan', $data);
        return $id;
    }

    function push_total_perhitungan($post)
    {

        $this->db->select('*');
        $this->db->from('tabel_perhitungan_order'); 
        $this->db->where('no_order', $post['no_order']);
        $cek = $this->db->get()->num_rows();

        $data = array(
            'no_order' => $post['no_order'],
            'total_keranjang' => $post['total_keranjang'],
            'diskon' => $post['diskon'],
            'pajak' => $post['pajak'],
            'ongkir' => $post['ongkir'],
            'grand_total' => $post['grand_total']
        );

        if($cek < 1){
        $this->db->insert('tabel_perhitungan_order', $data);
        }else{
        $this->db->query('DELETE From tabel_perhitungan_order Where no_order = '.$post['no_order']); // delete dulu
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

    function get_diskon($kode_diskon)
    {
       $this->db->select('*');
       $this->db->from('tabel_diskon');
       $this->db->where('kode_diskon', $kode_diskon);
       $output = $this->db->get()->row_array();
       return $output;
    }

    function bayar_checkout($no_order)
    {

      $no_faktur =  $this->_generate_no_faktur();

      $this->db->query('UPDATE tabel_daftar_belanja INNER JOIN tabel_perhitungan_order ON tabel_perhitungan_order.no_order = tabel_daftar_belanja.no_order SET tabel_daftar_belanja.total_keranjang = tabel_perhitungan_order.total_keranjang, tabel_daftar_belanja.diskon = tabel_perhitungan_order.diskon, tabel_daftar_belanja.pajak = tabel_perhitungan_order.pajak, tabel_daftar_belanja.ongkir = tabel_perhitungan_order.ongkir, tabel_daftar_belanja.grand_total = tabel_perhitungan_order.grand_total where  tabel_perhitungan_order.no_order =  '.$no_order );
       
      $data = [
            'no_faktur' => $no_faktur,
            'status' =>1
        ];
        $this->db->where('no_order', $no_order);
        $this->db->update('tabel_daftar_belanja', $data);
    }

    private function _generate_no_faktur()
    {
        $alpha = random_string('alpha', 3);
        $number = random_string('numeric', 7);

        return strtoupper($alpha).$number;
    }
}
