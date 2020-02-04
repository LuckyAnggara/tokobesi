<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Purchase_Order extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'string'));
    }

    function cekData($string)
    {
        $this->db->select('*');
        $this->db->from('temp_purchase_order');
        $this->db->where('no_order', $string);
        $cek = $this->db->get()->num_rows();
        if ($cek > 0) {
            return $string;
        } else {
            return null;
        }
    }

    function cekDataMaster($string)
    {
        $this->db->select('*');
        $this->db->from('master_purchase_order');
        $this->db->where('no_order', $string);
        $cek = $this->db->get()->num_rows();
        if ($cek > 0) {
            return true;
        } else {
            return false;
        }
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
            $this->db->where_not_in('status_jual', 1);
            $output = $this->db->get();
            return $output;
        } else {
            $this->db->select('master_barang.*, master_satuan_barang.nama_satuan');
            $this->db->from('master_barang');
            $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
            $this->db->where_not_in('status_jual', 1);
            $this->db->group_start();
            $this->db->like("master_barang.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $this->db->group_end();

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
            'user' =>  $this->session->userdata['username'],
            'status' => 1, // artinya 1 adalah PO dan 0 adalah direct order ke toko
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

        if ($cek > 0) {
            $this->db->select('*');
            $this->db->from('temp_tabel_keranjang_penjualan');
            $this->db->where('no_order_penjualan', $no_order);
            $data = $this->db->get()->result_array();

            foreach ($data as $value) {
                $this->persediaan_temp_batal($value);
            }
            $this->db->where('no_order_penjualan', $no_order);
            $this->db->delete('temp_tabel_keranjang_penjualan');
        } else {
        }
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
        $this->db->where('no_order', $post['no_order']);
        $diskon = $this->db->get('temp_purchase_order')->row_array();

        $this->db->select_sum('total_harga');
        $this->db->where('no_order', $post['no_order']);
        $total_harga = $this->db->get('temp_purchase_order')->row_array();

        $total_keranjang = $total_harga['total_harga'] + $diskon['diskon'];

        $grand_total = (($total_keranjang - $diskon['diskon']) + $post['pajak']) + $post['ongkir'];

        $this->db->select('*');
        $this->db->from('tabel_perhitungan_order');
        $this->db->where('no_order', $post['no_order']);
        $cek = $this->db->get()->num_rows();

        $data = array(
            'no_order' => $post['no_order'],
            'total_keranjang' => $total_keranjang,
            'diskon' => $diskon['diskon'],
            'pajak' => $post['pajak'],
            'ongkir' => $post['ongkir'],
            'grand_total' => $grand_total
        );

        if ($cek < 1) {
            $this->db->insert('tabel_perhitungan_order', $data);
        } else {
            $this->db->query("DELETE From tabel_perhitungan_order Where no_order = '" . $post['no_order'] . "'"); // delete dulu
            $this->db->insert('tabel_perhitungan_order', $data); // lalu tambah
        }
    }

    function get_total_perhitungan($post)
    {
        $no_order = $post['no_order'];
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

    function cekPasswordDirektur($post) // overide password harga jual
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('role', 'Direktur');
        $this->db->where('password', $post['password']);
        $data = $this->db->get()->num_rows();

        if ($data > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    private function _delete_perhitungan($post) // delete di tabel perhitungan karena sudah di proses
    {
        $this->db->select('*');
        $this->db->where('no_order', $post['no_order']);
        $this->db->delete('tabel_perhitungan_order');
    }
    function cek_nomor_order($no_order)
    {
        $this->db->select('*');
        $this->db->from('master_purchase_order');
        $this->db->where('no_order',  $no_order);
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


    // set Notif pada saat orderan di tambahkan ke keranjang

    function notif_keranjang($post)
    {
        $this->db->select('*');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->join('master_barang', 'master_barang.kode_barang =temp_tabel_keranjang_penjualan.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('no_order_penjualan', $post['no_order']);
        $this->db->where('temp_tabel_keranjang_penjualan.user', $this->session->userdata['username']);
        $this->db->where('status', 1);

        return $this->db->get();
    }

    function setDataReview($post)
    {
        $no_order = $post['no_order'];
        $this->db->select('*');
        $this->db->from('temp_purchase_order');
        $this->db->join('master_barang', 'master_barang.kode_barang = temp_purchase_order.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('no_order', $no_order);
        $this->db->where('status', $no_order);
        return $this->db->get()->result_array();
    }

    function push_review_temp($post)
    {
        $no_order = $post['no_order'];
        $this->db->query("INSERT INTO `temp_purchase_order`(`no_order`, `kode_barang`, `jumlah_penjualan`, `harga_jual`,`diskon`,`total_harga`,`tanggal_input`) SELECT `no_order_penjualan`, `kode_barang`, `jumlah_penjualan`, `harga_jual`,`diskon`,`total_harga`,`tanggal_input` FROM temp_tabel_keranjang_penjualan WHERE no_order_penjualan ='" . $no_order . "'");
    }

    function proses_ke_admin($post)
    {
        // input data baru

        if ($post['id_pelanggan'] == "") {
            $id_pelanggan = $this->_createPelangganDummy($post);
        } else {
            $id_pelanggan = $post['id_pelanggan'];
        }

        $data = array(
            'no_order' => $post['no_order'],
            'id_pelanggan' => $id_pelanggan,
            'tanggal_input' =>  date("Y-m-d H:i:s"),
            'sales' => $this->session->userdata['username'],
            'status_po' => 1, // 1 artinya proses di admin
        );

        $this->db->insert('master_purchase_order', $data);

        // update data total penjualan
        $this->db->query("UPDATE master_purchase_order INNER JOIN tabel_perhitungan_order ON tabel_perhitungan_order.no_order = master_purchase_order.no_order SET master_purchase_order.total_penjualan = tabel_perhitungan_order.total_keranjang, master_purchase_order.diskon = tabel_perhitungan_order.diskon, master_purchase_order.pajak_masukan = tabel_perhitungan_order.pajak, master_purchase_order.ongkir = tabel_perhitungan_order.ongkir, master_purchase_order.grand_total = tabel_perhitungan_order.grand_total where  tabel_perhitungan_order.no_order = '" . $post['no_order'] . "'");

        // tambah detail penjualan
        $this->_ubah_status_detail_po($post);

        $this->_delete_perhitungan($post);

        $this->_update_timeline_po($post);
    }

    private function _ubah_status_detail_po($post)
    {
        $data = array(
            'status' => 1
        );
        $this->db->where('no_order', $post['no_order']);
        $this->db->update('temp_purchase_order', $data);
    }

    private function _update_timeline_po($post)

    {

        $this->db->select('no_order');
        $this->db->from('timeline_po');
        $this->db->where('no_order', $post['no_order']);
        $cek = $this->db->get()->num_rows();

        if ($cek > 1) {
            $urutan = $cek + 1;
        } else {
            $urutan = 1;
        }

        $data = array(
            'no_order' => $post['no_order'],
            'tanggal' =>  date("Y-m-d H:i:s"),
            'pesan' => $post['pesan'],
            'urutan' => $urutan,
        );

        $this->db->insert('timeline_po', $data);
    }
}
