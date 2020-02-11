<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Persediaan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }
    function getDataBarang()
    {
        $this->db->select('kode_barang, nama_barang');
        $this->db->from('master_barang');
        return $this->db->get();
    }

    function saldoAwal($kode_barang, $post)
    {
        $this->db->select('qty_awal, saldo_awal, harga_awal');
        $this->db->from('master_saldo_awal');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_saldo >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_saldo <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get()->row_array();
    }

    function saldoMasuk($kode_barang, $post)
    {
        $this->db->select_sum('jumlah_pembelian');
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get()->row_array();
    }

    function saldoKeluar($kode_barang, $post)
    {
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get()->row_array();
    }

    function saldoCart($kode_barang, $post)
    {
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('is_po', 0);
        return $this->db->get()->row_array();
    }

    function saldoCartPo($kode_barang, $post)
    {
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_purchase_order');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_input >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('status !=', 99);
        $this->db->where('status !=', 2);
        return $this->db->get()->row_array();
    }


    function saldoAkhir($saldoAwal, $masuk, $keluar, $cart, $cartPo)
    {
        if ($saldoAwal == null) $saldoAwal['qty_awal']  = 0;
        if ($masuk['jumlah_pembelian'] == null) $masuk['jumlah_pembelian'] = 0;
        if ($keluar['jumlah_penjualan'] == null) $keluar['jumlah_penjualan'] = 0;
        if ($cart['jumlah_penjualan'] == null) $cart['jumlah_penjualan'] = 0;
        if ($cartPo['jumlah_penjualan'] == null) $cartPo['jumlah_penjualan'] = 0;

        $awalan = $saldoAwal['qty_awal'] + $masuk['jumlah_pembelian'] - $cart['jumlah_penjualan'] - $cartPo['jumlah_penjualan'];

        return ($awalan - $keluar['jumlah_penjualan']);
    }


    // DETAIL SCRIPT

    function getDataMasuk($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get();
    }

    function getDataKeluar($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        return $this->db->get();
    }

    function getDataCart($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('is_po =', 0);

        return $this->db->get();
    }

    function getDataCartPo($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_input, '%d-%b-%Y') as tanggal_input");
        $this->db->from('temp_purchase_order');
        $this->db->join('master_user', 'master_user.username = temp_purchase_order.user');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_input >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->where('temp_purchase_order.status !=', 99);
        $this->db->where('temp_purchase_order.status !=', 2);
        return $this->db->get();
    }


    // STOCK OPNAME

    function getMasterStokOpname()
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d-%b-%y") as tanggal');
        $this->db->from('master_stok_opname');
        return $this->db->get();
    }

    function getDetailMasterStokOpname($no_ref)
    {
        $this->db->select('*');
        $this->db->from('master_stok_opname');
        $this->db->where('nomor_referensi', $no_ref);
        return $this->db->get()->row_array();
    }

    function dataBarang($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get()->row_array();
    }

    function saldoBuku($kode_barang)
    {
        // saldo awal
        $this->db->select('qty_awal, saldo_awal, harga_awal');
        $this->db->from('master_saldo_awal');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        if ($data !== null) {
            $saldoAwal = $data['qty_awal'];
        } else {
            $saldoAwal = 0;
        }

        // saldo masuk
        $this->db->select_sum('jumlah_pembelian');
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoMasuk = $data['jumlah_pembelian'];

        // saldo keluar
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoKeluar = $data['jumlah_penjualan'];

        // saldo keranjang
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoCart = $data['jumlah_penjualan'];

        // saldo Cart Po

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_purchase_order');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoCartPo = $data['jumlah_penjualan'];

        if ($saldoAwal == null) $saldoAwal  = 0;
        if ($saldoMasuk == null) $saldoMasuk = 0;
        if ($saldoKeluar == null) $saldoKeluar = 0;
        if ($saldoCart == null) $saldoCart = 0;
        if ($saldoCartPo == null) $saldoCartPo = 0;

        return ($saldoAwal + $saldoMasuk) - ($saldoKeluar + $saldoCart + $saldoCartPo);
    }

    function random_ref()
    {
        return random_string('numeric', 7);
    }

    function tambah_data($post)
    {
        $data = [
            'nomor_referensi' => $post['nomor_referensi'],
            'tanggal' =>  date('Y-m-d H:i:s', strtotime($post['tanggal'])),
            'keterangan' => $post['keterangan'],
            'user' => $this->session->userdata['username']
        ];
        $this->db->insert('master_stok_opname', $data);
    }

    function tambah_detail_data($post)
    {
        $database = $this->getDataBarang();
        $dataBarang = $database->result_array();
        $output = array();

        foreach ($dataBarang as $key => $value) {
            $data_barang = $this->dataBarang($value['kode_barang']);
            $saldo_buku = $this->saldoBuku($value['kode_barang']);
            $value['data_barang'] = $data_barang;
            $value['saldo_buku'] = $saldo_buku;
            $value['saldo_fisik'] = "0";
            $value['selisih'] = $saldo_buku - $value['saldo_fisik'];
            $output[] = $value;
        }

        foreach ($output as $key => $value) {
            $barang = $value['data_barang'];
            $data = [
                'nomor_referensi' => $post['nomor_referensi'],
                'tanggal' =>  date('Y-m-d H:i:s', strtotime($post['tanggal'])),
                'kode_barang' => $barang['kode_barang'],
                'saldo_buku' => $value['saldo_buku'],
                'saldo_fisik' => $value['saldo_fisik'],
                'selisih' => $value['selisih'],
                'user' => $this->session->userdata['username']
            ];
            $this->db->insert('detail_stok_opname', $data);
        }
    }

    function getDataStokOpname($no_ref)
    {
        $this->db->select('*');
        $this->db->from('detail_stok_opname');
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->order_by('kode_barang', 'ASC');

        return $this->db->get();
    }

    function update_data_by_upload($no_ref) // update data stok opname by upload file
    {
        $config['upload_path']          = './assets/upload/temp/stokopname/';
        $config['allowed_types']        = 'xlsx|xls';
        $config['file_name']            = random_string('alnum', 16);
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('upload_data')) {
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $nama_file = $this->upload->data("file_name");
            $spreadsheet = $reader->load('./assets/upload/temp/stokopname/' . $nama_file);
            $sheetData = $spreadsheet->getActiveSheet()->toArray();

        }

        for ($i = 1; $i < count($sheetData); $i++) {
            $selisih = $sheetData[$i]['4'] - $sheetData[$i]['5'];
            $data = [
                'saldo_fisik' => $sheetData[$i]['5'],
                'selisih' => $selisih,
                'user' => $this->session->userdata['username']
            ];
            $this->db->where('kode_barang', $sheetData[$i]['1']);
            $this->db->where('nomor_referensi', $no_ref);
            $this->db->update('detail_stok_opname', $data);
        }
        unlink('./assets/upload/temp/stokopname/' . $nama_file);

    }
}
