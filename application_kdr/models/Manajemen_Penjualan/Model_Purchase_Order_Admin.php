<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Purchase_Order_Admin extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Setting/Model_Faktur', 'modelFaktur');
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function getDataReview($no_order)
    {
        // // cek dulu master_po apakah status nya masih proses admin
        // $this->db->select('*');
        // $this->db->from('master_purchase_order');
        // $this->db->where('no_order', $no_order);
        // $cek = $this->db->get()->row_array();

        // if ($cek['status_po'] == "1") {
        $this->db->select('no_order');
        $this->db->select('temp_purchase_order.*, master_barang.*');
        $this->db->from('temp_purchase_order');
        $this->db->join('master_barang', 'master_barang.kode_barang = temp_purchase_order.kode_barang');
        $this->db->where('no_order', $no_order);
        $output = $this->db->get()->result_array();
        return $output;
        // }
    }

    function getDataMasterPO($no_order)
    {
        $this->db->select('*');
        $this->db->from('master_purchase_order');
        $this->db->join('master_user', 'master_user.username = master_purchase_order.sales');
        $this->db->join('master_pelanggan', 'master_pelanggan.id_pelanggan = master_purchase_order.id_pelanggan');
        $this->db->where('no_order', $no_order);
        return $this->db->get()->row_array();
    }

    // angka angkaan

    function push_total_perhitungan($post)
    {
        $this->db->select('*');
        $this->db->from('master_purchase_order');
        $this->db->where('no_order', $post['no_order']);
        $total = $this->db->get()->row_array();

        $grand_total = (($total['total_penjualan'] - $total['diskon']) + $post['pajak']) + $post['ongkir'];

        $this->db->select('*');
        $this->db->from('master_purchase_order');
        $this->db->where('no_order', $post['no_order']);
        $cek = $this->db->get()->num_rows();


        $data = array(
            'no_order' => $post['no_order'],
            'pajak_masukan' => $post['pajak'],
            'ongkir' => $post['ongkir'],
            'grand_total' => $grand_total
        );

        if ($cek > 0) {
            $this->db->where('no_order', $post['no_order']);
            $this->db->update('master_purchase_order', $data);
            echo $cek;
        }
    }

    function get_total_perhitungan($no_order)
    {
        $this->db->select('*');
        $this->db->from('master_purchase_order');
        $this->db->where('no_order', $no_order);
        $output = $this->db->get()->row_array();
        return $output;
    }

    //script generate faktur dan pelanggan dummy wic

    function nomor($post)
    {
        $this->db->select_max('no_faktur');
        $this->db->like('no_faktur', date('dmy'));
        $data = $this->db->get('master_penjualan');
        if ($data->row('no_faktur') !== null) {
            return substr($data->row('no_faktur'), -3);
        } else {
            return 0;
        }
    }

    private function _generate_no_faktur($post)
    {

        $number = $this->nomor($post);
        $number = $number + 1;
        $no_faktur = date('dmy') . sprintf("%03d", $number);

        $no_faktur = $this->session->userdata['faktur_prefix'] . $no_faktur;

        return $no_faktur;
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

    // script penjualan

    function proses_penjualan($post)
    {
        // input data baru

        if ($post['id_pelanggan'] == "") {
            $id_pelanggan = $this->_createPelangganDummy($post);
        } else {
            $id_pelanggan = $post['id_pelanggan'];
        }

        $no_faktur = $this->modelFaktur->set_faktur();
        $tanggal_transaksi = date('Y-m-d H:i:s', strtotime($post['tanggal_faktur']));
        $user = $this->session->userdata['username'];

        $this->db->query("INSERT INTO `master_penjualan`(`no_order_penjualan`,`no_faktur`,`tanggal_transaksi`, `id_pelanggan`, `total_penjualan`, `diskon`,`pajak_masukan`,`ongkir`,`grand_total`,`tanggal_input`,`status_bayar`,`sales`,`user`) SELECT `no_order`, '" .  $no_faktur . "', '" .  $tanggal_transaksi . "', `id_pelanggan`, `total_penjualan`, `diskon`,`pajak_masukan`,`ongkir`,`grand_total`,`tanggal_input`,  '" .  $post['status'] . "', `sales`,'" .  $user . "' FROM master_purchase_order WHERE no_order = '" . $post['no_order_penjualan'] . "'");

        // tambah detail penjualan
        $this->_tambah_detail_penjualan($post, $no_faktur);
        $this->_debet_dari_keranjang_sementara($post);
        $this->_update_master_po($post);
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
        }
        $this->_update_master_insentif($no_faktur);
        $this->_update_timeline_po($post, 'approve');
    }

    private function _tambah_detail_penjualan($post, $no_faktur)
    {
        $tanggal_transaksi = date('Y-m-d H:i:s', strtotime($post['tanggal_faktur']));
        $this->db->query("INSERT INTO `detail_penjualan`(`nomor_faktur`,`tanggal_transaksi`, `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`,`harga_jual`,`diskon`,`total_harga`,`tanggal_input`) SELECT '" .  $no_faktur . "', '" .  $tanggal_transaksi . "', `no_order`, `kode_barang`, `jumlah_penjualan`,`harga_jual`,`diskon`,`total_harga`,'" .  $tanggal_transaksi . "'  FROM temp_purchase_order WHERE no_order = '" . $post['no_order_penjualan'] . "'");
    }

    private function _debet_dari_keranjang_sementara($post)
    {

        $this->db->select('*');
        $this->db->from('detail_penjualan');
        $this->db->where('no_order_penjualan', $post['no_order_penjualan']);
        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {

            $this->proses_debet_persediaan($value); //proses debet persediaan untuk menentukan harga beli // fifo lifo atau average
        }

        // ubah status jadi 2.
        $this->db->set('status', 2);
        $this->db->where('no_order', $post['no_order_penjualan']);
        $this->db->update('temp_purchase_order');
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
        $data = $this->db->get()->row_array();
        if ($data['saldo'] == null) {
            $ouput = [
                'saldo' => 0
            ];
            return $ouput;
        } else {
            return $data;
        }
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

        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->where('saldo !=', 0);
        $this->db->where('kode_barang', $kode_barang);

        if ($detail_barang['metode_hpp'] == "LIFO") {
            $this->db->order_by('tanggal_transaksi', 'DESC'); // ASC untuk LIFO
        } else {
            $this->db->order_by('tanggal_transaksi', 'ASC'); // DESC untuk FIFO
            echo "fifo";
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
        $data_barang = $this->fifo_lifo($kode_barang, $detail_barang);

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
                    'harga_pokok' => $saldo_awal['harga_awal'],
                    'harga_jual' => $post['harga_jual'],
                    'keterangan' => $detail_barang['metode_hpp']
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
                        'harga_pokok' => $saldo_awal['harga_awal'],
                        'harga_jual' => $post['harga_jual'],
                        'keterangan' => $detail_barang['metode_hpp']
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

                    echo $stok;
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
                        $data = [
                            'nomor_faktur' => $post['nomor_faktur'],
                            'tanggal_transaksi' => date("Y-m-d H:i:s"),
                            'kode_barang' => $kode_barang,
                            'qty' => $jual,
                            'harga_pokok' => $harga_beli,
                            'harga_jual' => $post['harga_jual'],
                            'keterangan' => $detail_barang['metode_hpp']
                        ];
                        $this->db->insert('master_harga_pokok_penjualan', $data);
                        $this->db->query("UPDATE detail_pembelian SET saldo = $stok_update WHERE id = '$id' AND kode_barang = '$kode_barang' AND tanggal_transaksi = '$tgl'");
                    } else {

                        break;
                    }
                }
            }
        } else {
            echo "error";
        }
    }

    function _update_master_po($post)
    {
        $post = $this->input->post();
        $data = [
            'tanggal_input' => date("Y-m-d H:i:s"),
            'admin' => $this->session->userdata['username'],
            'status_po' => 2,
        ];
        $this->db->where('no_order', $post['no_order_penjualan']);
        $this->db->update('master_purchase_order', $data);
    }

    private function _delete_perhitungan($post) // delete di tabel perhitungan karena sudah di proses
    {
        $this->db->select('*');
        $this->db->where('no_order', $post['no_order_penjualan']);
        $this->db->delete('tabel_perhitungan_order');
    }

    // script reject dan return

    function reject($post)
    {
        $no_order = $post['no_order_penjualan'];
        $data = [
            'tanggal_input' => date("Y-m-d H:i:s"),
            'admin' => $this->session->userdata['username'],
            'status_po' => 99,
        ];
        $this->db->where('no_order', $no_order);
        $this->db->update('master_purchase_order', $data);

        $this->_update_timeline_po($post, 'reject');
        $this->_clear_keranjang_po($no_order);
    }

    function return($post)
    {
        $no_order = $post['no_order_penjualan'];
        $data = [
            'tanggal_input' => date("Y-m-d H:i:s"),
            'admin' => $this->session->userdata['username'],
            'status_po' => 3,
        ];
        $this->db->where('no_order', $no_order);
        $this->db->update('master_purchase_order', $data);

        $this->_update_timeline_po($post, 'return');
    }

    private function _update_timeline_po($post, $x)
    {
        $this->db->select('no_order');
        $this->db->from('timeline_po');
        $this->db->where('no_order', $post['no_order_penjualan']);
        $cek = $this->db->get()->num_rows();

        if ($cek > 0) {
            $urutan = $cek + 1;
        } else {
            $urutan = 1;
        }
        switch ($x) {
            case 'reject':
                $data = array(
                    'no_order' =>  $post['no_order_penjualan'],
                    'tanggal' =>  date("Y-m-d H:i:s"),
                    'pesan' => '<span class="text-danger">Reject</span><br>',
                    'urutan' => $urutan,
                    'user' =>  $this->session->userdata['username'],
                );
                $this->db->insert('timeline_po', $data);
                break;
            case 'approve':
                $data = array(
                    'no_order' => $post['no_order_penjualan'],
                    'tanggal' =>  date("Y-m-d H:i:s"),
                    'pesan' => '<span class="text-success">Approve</span><br>',
                    'urutan' => $urutan,
                    'user' =>  $this->session->userdata['username'],
                );
                $this->db->insert('timeline_po', $data);
                break;
            case 'return':
                $data = array(
                    'no_order' =>  $post['no_order_penjualan'],
                    'tanggal' =>  date("Y-m-d H:i:s"),
                    'pesan' => '<span class="text-warning">return</span><br>',
                    'urutan' => $urutan,
                    'user' =>  $this->session->userdata['username'],
                );
                $this->db->insert('timeline_po', $data);
                break;
            case 'open':
                $data = array(
                    'no_order' =>  $post['no_order_penjualan'],
                    'tanggal' =>  date("Y-m-d H:i:s"),
                    'urutan' => $urutan,
                    'user' =>  $this->session->userdata['username'],
                );
                $this->db->insert('timeline_po', $data);
                break;
        }
    }

    private function _clear_keranjang_po($no_order)
    {
        $data = [
            'tanggal_input' => date("Y-m-d H:i:s"),
            'status' => 99,
        ];
        $this->db->where('no_order', $no_order);
        $this->db->update('temp_purchase_order', $data);
    }

    private function _update_master_insentif($no_faktur)
    {
        $this->db->select('value');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'komisi_sales');
        $data = $this->db->get()->row_array();
        $insentif = $data['value'];

        echo $insentif . "<br>";

        $this->db->select('*');
        $this->db->from('master_penjualan');
        $this->db->where('no_faktur', $no_faktur);
        $data_penjualan = $this->db->get()->row_array();

        $this->db->select('nip');
        $this->db->from('master_user');
        $this->db->where('username' , $data_penjualan['sales']);
        $data = $this->db->get()->row_array();
        $nip = $data['nip'];

        $data = array(
            'nomor_faktur' => $no_faktur,
            'gross_penjualan' =>  $data_penjualan['total_penjualan'],
            'insentif' => $insentif,
            'total_insentif' => ($insentif / 100) *  $data_penjualan['total_penjualan'],
            'sales' => $data_penjualan['sales'],
            'nip' => $nip,
            'status' => 0,
            'tanggal' => $data_penjualan['tanggal_transaksi']
        );

        $this->db->insert('master_insentif', $data);
        echo ($insentif / 100) *  $data_penjualan['total_penjualan'];
    }
}
