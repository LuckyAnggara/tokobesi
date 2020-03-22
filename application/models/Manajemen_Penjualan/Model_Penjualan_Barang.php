<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Penjualan_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Setting/Model_Faktur', 'modelFaktur');
        $this->load->helper(array('form', 'url', 'string'));
    }

    function fakturfaktur()
    {
        $no_faktur = $this->modelFaktur->set_faktur();
        return $no_faktur;
    }

    function get_data_by_id($id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('master_pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);

        return $this->db->get()->row_array();
    }

    function get_data_barang($string)
    {
        if ($string == null) {
            $this->db->select('master_barang.*, master_satuan_barang.nama_satuan');
            $this->db->from('master_barang');
            $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
            $this->db->having('status_jual', 0);

            $output = $this->db->get();
            return $output;
        } else {
            $this->db->select('master_barang.*, master_satuan_barang.nama_satuan');
            $this->db->from('master_barang');
            $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
            // $this->db->where_not_in('status_jual', 1);
            // $this->db->group_start();
            $this->db->like("master_barang.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $this->db->having('status_jual', 0);
            $this->db->limit('6');

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
            'user' => $this->session->userdata['username'],
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

        $this->db->select('*');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('id', $id);
        $data = $this->db->get()->result_array();

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

    public function get_data_keranjang_clear($no_order)
    {
        //  cek dulu apakah sudah di save apa blm
        $this->db->where('no_order_penjualan', $no_order);
        $this->db->delete('temp_tabel_keranjang_penjualan');
    }

    function simpan_order($post)
    {
        if ($post['id_pelanggan'] == "") {
            $id = $this->_createPelangganDummy($post);
        } else {
            $id = $post['id_pelanggan'];
        }
        $data = array(
            'no_order_penjualan' => $post['no_order_penjualan'],
            'tipe_pelanggan' => 'dummy',
            'id_pelanggan' => $id,
            'status_bayar' => 0, // belum di proses masih di keranjang unpaid.
            'tanggal_input' => date("Y-m-d H:i:s"),
        );

        $cek = $this->_cekNoOrderTabel($post['no_order_penjualan']);
        if ($cek < 1) {
            $this->db->insert('temp_tabel_keranjang_penjualan', $data);
        }
        $this->db->query('DELETE From detail_penjualan Where no_order_penjualan = ' . $post['no_order_penjualan']);

        $this->db->query('INSERT INTO `detail_penjualan`(`no_order_penjualan`, `kode_barang`, `jumlah_penjualan`, `total_harga`) SELECT `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`, `total_harga` FROM temp_tabel_keranjang_penjualan WHERE no_order_penjualan = ' . $post['no_order_penjualan'] . '');
    }

    // cek nomor order apa udhh terddaftar di tabel, in case 2x klik simpan
    private function _cekNoOrderTabel($no_order)
    {
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
            'status_pelanggan' => 1 // dummy id.
        );
        $this->db->insert('master_pelanggan', $data);
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

        $grand_total = (($total_keranjang - $diskon['diskon']) + $post['pajak']) + $post['ongkir'];

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

        if ($cek < 1) {
            $this->db->insert('tabel_perhitungan_order', $data);
        } else {
            $this->db->query("DELETE From tabel_perhitungan_order Where no_order = '" . $post['no_order_penjualan'] . "'"); // delete dulu
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

        return strtoupper($alpha) . $number;
    }

    function cekPasswordOverride($post, $role_override) // overide password harga jual
    {

        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('role', $role_override);
        $user = $this->db->get()->row_array();

        $isPasswordTrue = password_verify($post["password"], $user['password']);

        if ($isPasswordTrue) {
            return 1;
        } else {
            return 0;
        }
    }

    function proses_penjualan($post)
    {
        // input data baru

        if ($post['id_pelanggan'] == "") {
            $id_pelanggan = $this->_createPelangganDummy($post);
        } else {
            $id_pelanggan = $post['id_pelanggan'];
        }

        $no_faktur = $this->modelFaktur->set_faktur();

        $data = array(
            'no_order_penjualan' => $post['no_order_penjualan'],
            'no_faktur' => $no_faktur,
            'tanggal_transaksi' => date("Y-m-d H:i:s"),
            'id_pelanggan' => $id_pelanggan,
            'status_bayar' => $post['status'], // 0 untuk lunas 1 untuk nyicil cashbon
            'tanggal_input' =>  date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        );

        $this->db->insert('master_penjualan', $data);

        // update data total penjualan
        $this->db->query("UPDATE master_penjualan INNER JOIN tabel_perhitungan_order ON tabel_perhitungan_order.no_order = master_penjualan.no_order_penjualan SET master_penjualan.total_penjualan = tabel_perhitungan_order.total_keranjang, master_penjualan.diskon = tabel_perhitungan_order.diskon, master_penjualan.pajak_masukan = tabel_perhitungan_order.pajak, master_penjualan.ongkir = tabel_perhitungan_order.ongkir, master_penjualan.grand_total = tabel_perhitungan_order.grand_total where  tabel_perhitungan_order.no_order = '" . $post['no_order_penjualan'] . "'");

        // tambah detail penjualan
        $this->_tambah_detail_penjualan($post, $no_faktur);
        // update status persediaan
        $this->_debet_dari_keranjang_sementara($post);

        $this->_delete_perhitungan($post);
        // proses jika kredit
        // status = 0 untuk kredit status = 1 untuk cash
        if ($post['status'] == 0) {

            $this->db->select('grand_total');
            $this->db->from('master_penjualan');
            $this->db->where('no_faktur', $no_faktur);
            $grand_total = $this->db->get()->row_array();
            $sisa_piutang = $grand_total['grand_total'] - $post['down_payment'];

            $data = array(
                'no_faktur' => $no_faktur,
                'tanggal_jatuh_tempo' => date('Y-m-d H:i:s', strtotime($post['tanggal_jatuh_tempo'])),
                'down_payment' => $post['down_payment'],
                'total_tagihan' => $grand_total['grand_total'],
                'total_pembayaran' => $post['down_payment'],
                'sisa_piutang' => $sisa_piutang,
                'tanggal_input' =>  date("Y-m-d H:i:s"),
                'user' => $this->session->userdata['username'],
            );

            $this->db->insert('master_piutang', $data);

            $data = array(
                'nomor_faktur' => $no_faktur,
                'nominal_pembayaran' => $post['down_payment'],
                'sisa_piutang' => $sisa_piutang,
                'tanggal' => date("Y-m-d H:i:s"),
                'user' => $this->session->userdata['username'],
                'bukti' => '1',
                'keterangan' => 'Down Payment',
            );
            $this->db->insert('detail_piutang', $data);
            // update COH
            $nominal = $post['down_payment'];
            // $this->modelCoh->transaksi_penjualan_kredit($this->session->userdata['username'], $nominal, $no_faktur);
        }else{
            $this->db->select('grand_total');
            $this->db->from('master_penjualan');
            $this->db->where('no_faktur', $no_faktur);
            $data = $this->db->get()->row_array();
            $nominal = $data['grand_total'];

            // update COH
            // $this->modelCoh->transaksi_penjualan_tunai($this->session->userdata['username'], $nominal, $no_faktur);
        }
    }

    private function _tambah_detail_penjualan($post, $no_faktur)
    {
        $this->db->query("INSERT INTO `detail_penjualan`(`nomor_faktur`,`tanggal_transaksi`, `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`,`harga_jual`,`diskon`,`total_harga`,`tanggal_input`) SELECT '" .  $no_faktur . "', `tanggal_transaksi`, `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`,`harga_jual`,`diskon`,`total_harga`,`tanggal_input`  FROM temp_tabel_keranjang_penjualan WHERE no_order_penjualan = '" . $post['no_order_penjualan'] . "'");
    }

    private function _debet_dari_keranjang_sementara($post)
    {

        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->where('no_order_penjualan', $post['no_order_penjualan']);
        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {
            // $this->db->select('jumlah_keranjang');
            // $this->db->from('master_persediaan');
            // $this->db->where('kode_barang', $value['kode_barang']);
            // $data = $this->db->get()->row_array();
            // $keranjang = $data['jumlah_keranjang'];
            // $real = $keranjang - $value['jumlah_penjualan'];

            // $update = [
            //     'jumlah_keranjang' => $real,
            // ];

            // $this->db->where('kode_barang', $value['kode_barang']);
            // $this->db->update('master_persediaan', $update);

            $this->proses_debet_persediaan($value); //proses debet persediaan untuk menentukan harga beli // fifo lifo atau average
        }

        $this->db->where('no_order_penjualan', $post['no_order_penjualan']);
        $this->db->delete('temp_tabel_keranjang_penjualan');
    }

    private function _delete_perhitungan($post) // delete di tabel perhitungan karena sudah di proses
    {
        $this->db->select('*');
        $this->db->where('no_order', $post['no_order_penjualan']);
        $this->db->delete('tabel_perhitungan_order');
    }
    function cek_nomor_order($no_order)
    {
        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->where('no_order_penjualan',  $no_order);
        return $this->db->get()->num_rows();
    }

    function get_data_persediaan($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_persediaan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        return $data['jumlah_persediaan'];
    }

    function cek_pelanggan($id_pelanggan)
    {
        $this->db->select('id_pelanggan');
        $this->db->from('master_pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        return $this->db->get()->num_rows();
    }

    // paket proses debet persediaan untuk hpp dll nya complicated

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

    function saldo_berjalan($kode_barang)
    {
        $this->db->select_sum('saldo');
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('saldo !=', 0);
        $saldo_beli = $this->db->get()->row_array();

        $this->db->select_sum('saldo_tersedia');
        $this->db->from('detail_retur_barang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('saldo_tersedia !=', 0);
        $saldo_retur = $this->db->get()->row_array();

        if(!isset($saldo_retur)){
            $saldo_retur['saldo_tersedia'] = 0;
        }

        if(!isset($saldo_beli)){
            $saldo_beli['saldo'] = 0;
        }

        $ouput = [
            'saldo' => $saldo_retur['saldo_tersedia'] + $saldo_beli['saldo']
        ];
            return $ouput;
    }

    function detail_barang($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get()->row_array();
    }

    function fifo_lifo($kode_barang, $detail_barang)
    {

        $this->db->select('*, "beli" jenis_saldo');
        $this->db->from('detail_pembelian');
        $this->db->where('saldo !=', 0);
        $this->db->where('kode_barang', $kode_barang);

        if ($detail_barang['metode_hpp'] == "LIFO") {
            $this->db->order_by('tanggal_transaksi', 'DESC'); // ASC untuk LIFO
        } else {
            $this->db->order_by('tanggal_transaksi', 'ASC'); // DESC untuk FIFO
        }

        return $this->db->get()->result_array();
    }

      function fifo_lifo_retur($kode_barang, $detail_barang)
    {

        $this->db->select('id, nomor_faktur as nomor_transaksi,harga_pokok as harga_beli, kode_barang, saldo_tersedia as saldo, tanggal_input as tanggal_transaksi, "retur" jenis_saldo');
        $this->db->from('detail_retur_barang_penjualan');
        $this->db->where('saldo_tersedia !=', 0);
        $this->db->where('kode_barang', $kode_barang);

        if ($detail_barang['metode_hpp'] == "LIFO") {
            $this->db->order_by('tanggal_input', 'DESC'); // ASC untuk LIFO
        } else {
            $this->db->order_by('tanggal_input', 'ASC'); // DESC untuk FIFO
        }

        return $this->db->get()->result_array();
    }

    function proses_debet_persediaan($post)
    {
        $kode_barang = $post['kode_barang'];
        $qty_penjualan = $post['jumlah_penjualan'];
        // total kan persediaan
        $detail_barang = $this->detail_barang($kode_barang);

        $saldo_awal = $this->saldo_awal($kode_barang);
        $saldo_berjalan = $this->saldo_berjalan($kode_barang);

        // cek total persediaan dari saldo awal + berjalan
        $total_persediaan = $saldo_awal['saldo_awal'] + $saldo_berjalan['saldo'];
        // penentuan fifo lifo
        $data_barang_beli = $this->fifo_lifo($kode_barang, $detail_barang);
        $data_barang_retur = $this->fifo_lifo_retur($kode_barang, $detail_barang);
        $data_barang = array_merge($data_barang_beli, $data_barang_retur);
        // untuk harga beli average
        $this->db->select_sum('harga_beli');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('saldo !=', 0);
        $result = $this->db->get('detail_pembelian')->row();
        $pembilang =  $result->harga_beli;

        // $this->db->select_sum('harga_beli');
        // $this->db->where('kode_barang', $kode_barang);
        // $this->db->where('saldo !=', 0);
        // $penyebut = $this->db->get('detail_pembelian');

        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->where('saldo !=', 0);
        $this->db->where('kode_barang', $kode_barang);
        $harga = $this->db;
        $penyebut = $harga->get()->num_rows();

        if ($qty_penjualan <= $total_persediaan) {
            // cek apakah penjualan lebih dari saldo awal
            if ($qty_penjualan < $saldo_awal['saldo_awal']) {
                // jika penjualan lebih kecil dari saldo awal
                $stok_update = $saldo_awal['saldo_awal'] - $qty_penjualan;
                $data = [
                    'nomor_faktur' => $post['nomor_faktur'],
                    'tanggal_transaksi' => date("Y-m-d H:i:s"),
                    'kode_barang' => $kode_barang,
                    'qty' => $stok_update,
                    'sisa' => $stok_update,
                    'harga_pokok' => $saldo_awal['harga_awal'],
                    'harga_jual' => $post['harga_jual'],
                    'keterangan' => $detail_barang['metode_hpp'],
                    'jenis_barang' => 'saldo_awal',
                    'tag' => 'saldoawal_'.$saldo_awal['id'],
                ];
                $this->db->insert('master_harga_pokok_penjualan', $data);
                $this->db->query("UPDATE master_saldo_awal SET saldo_awal = $stok_update WHERE kode_barang = '$kode_barang'");

               
            } else {

                if ($saldo_awal['saldo_awal'] !== 0) {

                    $data = [
                        'nomor_faktur' => $post['nomor_faktur'],
                        'tanggal_transaksi' => date("Y-m-d H:i:s"),
                        'kode_barang' => $kode_barang,
                        'qty' => $saldo_awal['saldo_awal'],
                        'sisa' => $stok_update,
                        'harga_pokok' => $saldo_awal['harga_awal'],
                        'harga_jual' => $post['harga_jual'],
                        'keterangan' => $detail_barang['metode_hpp'],
                        'jenis_barang' => 'saldo_awal',
                        'tag' => 'saldoawal_'.$saldo_awal['id'],
                    ];
                    $this->db->insert('master_harga_pokok_penjualan', $data);
                }

                $stok_update = 0;
                $this->db->query("UPDATE master_saldo_awal SET saldo_awal = $stok_update WHERE kode_barang = '$kode_barang'");
                $qty_penjualan = $qty_penjualan - $saldo_awal['saldo_awal']; // update qty penjualan setelah di kurangi saldo awal yang diambil


                foreach ($data_barang as $key => $value) {
                    $id = $value['id'];
                    $tgl = $value['tanggal_transaksi'];
                    $stok = $value['saldo'];
                    $tag = $value['id'];
                    // nentuain harga baragng jiga AVERAGE
                    if ($detail_barang['metode_hpp'] == "AVERAGE") {
                        $harga_beli = $pembilang / $penyebut;
                    } else {
                        $harga_beli = $value['harga_beli'];
                    }

                    if ($qty_penjualan !== 0) {
                        if ($qty_penjualan >= $stok) { // jika 7 => 5 maka yess
                            $qty_penjualan = $qty_penjualan - $stok; // qty_penjualan = 7 - 5 = 2
                            $stok_update = 0; // stok jadi 0
                            $jual = $stok; // untuk update jual posisi ga bisa asal

                        } else {
                            $stok_update = $stok - $qty_penjualan;
                            $jual = $qty_penjualan; // untuk update jual posisi ga bisa asal
                            $qty_penjualan = $qty_penjualan - $qty_penjualan;
                        }
                        if ($value['jenis_saldo'] == 'retur') {
                            $jenis_barang_dijual = 'barang_retur';
                        } else {
                            $jenis_barang_dijual = 'pembelian_bersih';
                        }
                        $data = [
                            'nomor_faktur' => $post['nomor_faktur'],
                            'tanggal_transaksi' => date("Y-m-d H:i:s"),
                            'kode_barang' => $kode_barang,
                            'qty' => $jual,
                            'sisa' => $stok_update,
                            'harga_pokok' => $harga_beli,
                            'harga_jual' => $post['harga_jual'],
                            'keterangan' => $detail_barang['metode_hpp'],
                            'jenis_barang' => $jenis_barang_dijual,
                            'tag' => $tag,
                        ];
                        $this->db->insert('master_harga_pokok_penjualan', $data);

                        if($value['jenis_saldo'] == 'retur'){
                            $this->db->query("UPDATE detail_retur_barang_penjualan SET saldo_tersedia = $stok_update WHERE id = '$id' AND kode_barang = '$kode_barang' AND tanggal_input = '$tgl'");
                        }else{
                            $this->db->query("UPDATE detail_pembelian SET saldo = $stok_update WHERE id = '$id' AND kode_barang = '$kode_barang' AND tanggal_transaksi = '$tgl'");
                        }

                        $this->tambah_detail_persediaan($kode_barang, $stok_update, $harga_beli,$post, $jenis_barang_dijual);
                        
                        
                    } else {

                        break;
                    }
                }

            }
        } else {
            echo "error";
        }
    }

    function set_harga($post)
    {
        $this->db->select('harga_satuan, harga_kedua, harga_ketiga');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $post['kode_barang']);
        $data = $this->db->get()->row_array();

        switch ($post['jenis_harga']) {
            case '1':
                return $data['harga_satuan'];
                break;
            case '2':
                return $data['harga_kedua'];
                break;
            case '3':
                return $data['harga_ketiga'];
                break;
            default:
                return $data['harga_satuan'];
                break;
        }
    }

    function surat_jalan($post)
    {
        $data = [
            'no_polisi' => $post['no_pol']
        ];
        $this->db->where('no_order_penjualan', $post['no_order']);
        $this->db->update('master_penjualan', $data);

        return "sukses";
    }

    function tambah_detail_persediaan($kode_barang, $stok_update, $harga, $post, $jenis){
        $data = [
            'nomor_transaksi' => $post['nomor_faktur'],
            'tanggal_transaksi' => date("Y-m-d H:i:s"),
            'kode_barang' => $kode_barang,
            'saldo' => $stok_update,
            'debit' => $post['jumlah_penjualan'],
            'harga_pokok' => $harga,
            'jenis_barang' => $jenis,
        ];
        $this->db->insert('detail_persediaan', $data);
    }
}
