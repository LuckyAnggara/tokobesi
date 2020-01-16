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
        $data = [
            'tanggal_transaksi' => date("Y-m-d H:i:s"),
            'no_order_penjualan' => $post['no_order_penjualan'],
            'kode_barang' => $post['kode_barang'],
            'jumlah_penjualan' => $post["jumlah_penjualan"],
            'harga_jual' => $post["harga_jual"],
            'diskon' => $post["diskon"],
            'total_harga' => $post["harga_jual"] * $post['jumlah_penjualan'] - $post['diskon'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('temp_tabel_keranjang_penjualan', $data);
    }

    private function _hitung_total($kode_barang, $jumlah_penjualan)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $output = $data['harga_satuan'];
        return $output * $jumlah_penjualan;
    }

    function get_data_keranjang($no_order)
    {
        $this->db->select('temp_tabel_keranjang_penjualan.*, master_barang.*');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->join('master_barang', 'master_barang.kode_barang = temp_tabel_keranjang_penjualan.kode_barang');
        $this->db->where('no_order_penjualan', $no_order);
        $output = $this->db->get();
        return $output;
    }

    function delete_data_keranjang($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('temp_tabel_keranjang_penjualan');
    }

    public function persediaan_temp_tambah()
    {
        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('master_persediaan');
        $this->db->where('kode_barang', $post['kode_barang']);
        $output = $this->db->get()->row_array();
        $data = array(
            'jumlah_keranjang' => $output['jumlah_keranjang'] + $post['jumlah_penjualan'],
            'jumlah_persediaan' => $output['jumlah_persediaan'] - $post['jumlah_penjualan']
        );
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->update('master_persediaan', $data);
    }

    public function persediaan_temp_batal($value)
    {
              
            $post = $value;
            $this->db->select('*');
            $this->db->from('temp_tabel_keranjang_penjualan');
            $this->db->where('id', $post['id']);
            $output_keranjang = $this->db->get()->row_array();

            $this->db->select('*');
            $this->db->from('master_persediaan');
            $this->db->where('kode_barang', $output_keranjang['kode_barang']);
            $output_persediaan = $this->db->get()->row_array();

            $data = array(
                'jumlah_keranjang' => $output_persediaan['jumlah_keranjang'] - $output_keranjang['jumlah_penjualan'],
                'jumlah_persediaan' => $output_persediaan['jumlah_persediaan'] + $output_keranjang['jumlah_penjualan']
            );
            print_r($data);

            $this->db->where('kode_barang', $output_keranjang['kode_barang']);
            $this->db->update('master_persediaan', $data);

    }

    public function get_data_keranjang_clear($no_order)
    {   
        //  cek dulu apakah sudah di save apa blm

        $this->db->select('*');
        $this->db->from('temp_tabel_keranjang_penjualan'); 
        $this->db->where('no_order_penjualan', $no_order);
        $cek = $this->db->get()->num_rows();

        if($cek > 0){
        $this->db->select('*');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('no_order_penjualan', $no_order);
        $data = $this->db->get()->result_array();

        foreach ($data as $value) {
            $this->persediaan_temp_batal($value);
        }
        $this->db->where('no_order_penjualan', $no_order);
        $this->db->delete('temp_tabel_keranjang_penjualan');
        }else{
        
        }

        

        
    }

    function simpan_order($post)
    {
        if($post['id_pelanggan'] == ""){
            $id = $this->_createPelangganDummy($post);
        }else{
            $id = $post['id_pelanggan'];
        }
        $data = array(
            'no_order_penjualan' => $post['no_order_penjualan'],
            'id_pelanggan' => $id,
            'status' => 0, // belum di proses masih di keranjang unpaid.
            'tanggal_input' => date("Y-m-d H:i:s"),
        );    
        
        $cek = $this->_cekNoOrderTabel($post['no_order_penjualan']);
        if($cek < 1){
            $this->db->insert('temp_tabel_keranjang_penjualan', $data);
        }
        $this->db->query('DELETE From detail_penjualan Where no_order_penjualan = '.$post['no_order_penjualan']);
      
        $this->db->query('INSERT INTO `detail_penjualan`(`no_order_penjualan`, `kode_barang`, `jumlah_penjualan`, `total_harga`) SELECT `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`, `total_harga` FROM temp_tabel_keranjang_penjualan WHERE no_order_penjualan = '. $post['no_order_penjualan'].'');
    }

    // cek nomor order apa udhh terddaftar di tabel, in case 2x klik simpan
    private function _cekNoOrderTabel($no_order){
        $this->db->select('*');
        $this->db->from('temp_tabel_keranjang_penjualan'); 
        $this->db->where('no_order_penjualan', $no_order);
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

        $this->db->select_sum('diskon');
        $this->db->where('no_order_penjualan', $post['no_order_penjualan']);
        $diskon = $this->db->get('temp_tabel_keranjang_penjualan')->row_array();

        $this->db->select_sum('total_harga');
        $this->db->where('no_order_penjualan', $post['no_order_penjualan']);
        $total_harga = $this->db->get('temp_tabel_keranjang_penjualan')->row_array();

        $total_keranjang = $total_harga['total_harga'] + $diskon['diskon'];

        $grand_total = (($total_keranjang - $diskon['diskon']) + $post['pajak'])+$post['ongkir'];

        $this->db->select('*');
        $this->db->from('tabel_perhitungan_order'); 
        $this->db->where('no_order', $post['no_order_penjualan']);
        $cek = $this->db->get()->num_rows();
        

        $data = array(
            'no_order' => $post['no_order_penjualan'],
            'total_keranjang' => $total_keranjang,
            'diskon' => $diskon['diskon'],
            'pajak' => $post['pajak'],
            'ongkir' => $post['ongkir'],
            'grand_total' => $grand_total
        );

        if($cek < 1){
        $this->db->insert('tabel_perhitungan_order', $data);
        }else{
        $this->db->query('DELETE From tabel_perhitungan_order Where no_order = '.$post['no_order_penjualan']); // delete dulu
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
        $this->db->select_sum('diskon');
        $this->db->where('no_order_penjualan', $no_order);
        $diskon = $this->db->get('temp_tabel_keranjang_penjualan')->row_array();

        $this->db->select_sum('total_harga');
        $this->db->where('no_order_penjualan', $no_order);
        $total_harga = $this->db->get('temp_tabel_keranjang_penjualan')->row_array();
         $output = array(
                "total_penjualan" => $total_harga['total_harga'] + $diskon['diskon'],
                "diskon" => $diskon['diskon'],
                "total_harga" => $total_harga['total_harga']
        );

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

    // function bayar_checkout($no_order_penjualan)
    // {

    //   $no_faktur =  $this->_generate_no_faktur();

    //   $this->db->query('UPDATE temp_tabel_keranjang_penjualan INNER JOIN tabel_perhitungan_order ON tabel_perhitungan_order.no_order = temp_tabel_keranjang_penjualan.no_order_penjualan SET temp_tabel_keranjang_penjualan.total_keranjang = tabel_perhitungan_order.total_penjualan, temp_tabel_keranjang_penjualan.diskon = tabel_perhitungan_order.diskon, temp_tabel_keranjang_penjualan.pajak = tabel_perhitungan_order.pajak, temp_tabel_keranjang_penjualan.ongkir = tabel_perhitungan_order.ongkir, temp_tabel_keranjang_penjualan.grand_total = tabel_perhitungan_order.grand_total where  tabel_perhitungan_order.no_order_penjualan =  '.$no_order_penjualan );
       
    //   $data = [
    //         'no_faktur' => $no_faktur,
    //         'status' =>1
    //     ];
    //     $this->db->where('no_order_penjualan', $no_order_penjualan);
    //     $this->db->update('temp_tabel_keranjang_penjualan', $no_order_penjualan);
    // }

    private function _generate_no_faktur()
    {
        $alpha = random_string('alpha', 3);
        $number = random_string('numeric', 7);

        return strtoupper($alpha).$number;
    }

    function cekPasswordDirektur($post)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('jabatan', 'Direktur');
        $this->db->where('password', $post['password']);
        $data = $this->db->get()->num_rows();
        
        if($data >0){
            return 1;
        }else{
            return 0;
        }
    }

    function proses_penjualan($post)
    {
        // input data baru

        if($post['id_pelanggan'] == ""){
            $id_pelanggan = $this->_createPelangganDummy($post);
        }else{
            $id_pelanggan = $post['id_pelanggan'];
        }

        $no_faktur = $this->_generate_no_faktur();

        $data = array(
            'no_order_penjualan' => $post['no_order_penjualan'],
            'no_faktur' => $no_faktur,
            'tanggal_transaksi' => date("Y-m-d H:i:s"),
            'id_pelanggan' => $id_pelanggan,
            'status' => $post['status'], // 0 untuk lunas 1 untuk nyicil cashbon
            'tanggal_input' =>  date("Y-m-d H:i:s"),
            'user' =>'usn',
        );

        $this->db->insert('master_penjualan', $data);

        // update data total penjualan
        $this->db->query("UPDATE master_penjualan INNER JOIN tabel_perhitungan_order ON tabel_perhitungan_order.no_order = master_penjualan.no_order_penjualan SET master_penjualan.total_penjualan = tabel_perhitungan_order.total_keranjang, master_penjualan.diskon = tabel_perhitungan_order.diskon, master_penjualan.pajak_masukan = tabel_perhitungan_order.pajak, master_penjualan.ongkir = tabel_perhitungan_order.ongkir, master_penjualan.grand_total = tabel_perhitungan_order.grand_total where  tabel_perhitungan_order.no_order = '" . $post['no_order_penjualan']."'");

        //$this->_tambah_data_persediaan($post);
        $this->_tambah_detail_penjualan($post, $no_faktur);
        $this->_debet_dari_keranjang_sementara($post);
    }

    private function _tambah_detail_penjualan($post, $no_faktur)
    {
        $this->db->query("INSERT INTO `detail_penjualan`(`tanggal_transaksi`, `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`,`harga_jual`,`diskon`,`total_harga`,`tanggal_input`) SELECT `tanggal_transaksi`, `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`,`harga_jual`,`diskon`,`total_harga`,`tanggal_input` FROM temp_tabel_keranjang_penjualan WHERE no_order_penjualan = '" . $post['no_order_penjualan']."'");

        
        $update = [
                'nomor_faktur' => $no_faktur
        ];
        $this->db->where('no_order_penjualan', $post['no_order_penjualan']);
        $this->db->update('detail_penjualan', $update);
    }

    private function _debet_dari_keranjang_sementara($post)
    {

        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->where('no_order_penjualan', $post['no_order_penjualan']);
        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {
            $this->db->select('jumlah_keranjang');
            $this->db->from('master_persediaan');
            $this->db->where('kode_barang', $value['kode_barang']);
            $data = $this->db->get()->row_array();
            $keranjang = $data['jumlah_keranjang'];
            $real = $keranjang - $value['jumlah_penjualan'];

            $update = [
                'jumlah_keranjang' => $real,
            ];

            $this->db->where('kode_barang', $value['kode_barang']);
            $this->db->update('master_persediaan', $update);

        }

    }
}