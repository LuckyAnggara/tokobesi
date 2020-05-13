<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Persediaan_Api extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }
    public function getDataBarang()
    {
        $this->db->select('kode_barang, nama_barang');
        $this->db->from('master_barang');
        return $this->db->get();
    }

    public function saldoAwal($kode_barang, $post)
    {
        $periode = $post['periode'];

        $this->db->select('qty_awal, saldo_awal, harga_awal');
        $this->db->from('master_saldo_awal');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('periode', $periode);

        return $this->db->get()->row_array();
    }

    public function saldoMasuk($kode_barang, $post)
    {
        $periode = $post['periode'];

        $this->db->select_sum('jumlah_pembelian');
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        $this->db->where('periode', $periode);

        $jumlah_pembelian = $this->db->get()->row_array();

        $this->db->select_sum('saldo_retur');
        $this->db->from('detail_retur_barang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        $this->db->where('periode', $periode);

        $saldo_retur = $this->db->get()->row_array();

        $output = [
            'jumlah_pembelian' => $jumlah_pembelian['jumlah_pembelian'],
            'saldo_retur' => $saldo_retur['saldo_retur'],
        ];
        return $output;
    }

    public function saldoKeluar($kode_barang, $post)
    {
        $periode = $post['periode'];

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        $this->db->where('periode', $periode);

        $jumlah_penjualan = $this->db->get()->row_array();

        $this->db->select_sum('jumlah_retur');
        $this->db->from('detail_retur_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        $this->db->where('periode', $periode);

        $saldo_retur = $this->db->get()->row_array();

        $output = [
            'jumlah_penjualan' => $jumlah_penjualan['jumlah_penjualan'],
            'saldo_retur' => $saldo_retur['jumlah_retur'],
        ];
        return $output;
    }

    public function saldoCart($kode_barang, $post)
    {
        $periode = $post['periode'];

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        $this->db->where('is_po', 0);
        $this->db->where('periode', $periode);

        return $this->db->get()->row_array();
    }

    public function saldoCartPo($kode_barang, $post)
    {
        $periode = $post['periode'];

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_purchase_order');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        $this->db->where('status !=', 99);
        $this->db->where('status !=', 2);
        $this->db->where('periode', $periode);

        return $this->db->get()->row_array();
    }

    public function saldoAkhir($saldoAwal, $masuk, $keluar, $cart, $cartPo)
    {
        if ($saldoAwal == null) {
            $saldoAwal['qty_awal'] = 0;
        }

        if ($masuk['jumlah_pembelian'] == null) {
            $masuk['jumlah_pembelian'] = 0;
        }

        if ($masuk['saldo_retur'] == null) {
            $masuk['saldo_retur'] = 0;
        }

        if ($keluar['jumlah_penjualan'] == null) {
            $keluar['jumlah_penjualan'] = 0;
        }

        if ($keluar['saldo_retur'] == null) {
            $keluar['saldo_retur'] = 0;
        }

        if ($cart['jumlah_penjualan'] == null) {
            $cart['jumlah_penjualan'] = 0;
        }

        if ($cartPo['jumlah_penjualan'] == null) {
            $cartPo['jumlah_penjualan'] = 0;
        }

        $awalan = $saldoAwal['qty_awal'] + ($masuk['jumlah_pembelian'] + $masuk['saldo_retur']) - $cart['jumlah_penjualan'] - $cartPo['jumlah_penjualan'];

        return ($awalan - ($keluar['jumlah_penjualan'] + $keluar['saldo_retur']));
    }

    // DETAIL SCRIPT

    public function getDataMasuk($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        return $this->db->get();
    }

    public function getDataMasukRetur($post)
    {
        $this->db->select("id, nomor_faktur as nomor_transaksi, harga_pokok as harga_beli,saldo_retur as jumlah_pembelian, DATE_FORMAT(tanggal_input, '%d-%b-%Y') as tanggal_transaksi, saldo_tersedia as saldo");
        $this->db->from('detail_retur_barang_penjualan');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        return $this->db->get();
    }

    public function getDataKeluar($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        return $this->db->get();
    }

    public function getDataKeluarRetur($post)
    {
        $this->db->select("id, nomor_transaksi as nomor_faktur, harga_retur as harga_jual,jumlah_retur as jumlah_penjualan, DATE_FORMAT(tanggal, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('detail_retur_pembelian');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        return $this->db->get();
    }

    public function getDataCart($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_transaksi, '%d-%b-%Y') as tanggal_transaksi");
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->join('master_user', 'temp_tabel_keranjang_penjualan.user = master_user.username');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        $this->db->where('is_po =', 0);

        return $this->db->get();
    }

    public function getDataCartPo($post)
    {
        $this->db->select("*, DATE_FORMAT(tanggal_input, '%d-%b-%Y') as tanggal_input");
        $this->db->from('temp_purchase_order');
        $this->db->join('master_user', 'master_user.username = temp_purchase_order.user');
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($post['tanggal_akhir'])));
        $this->db->where('temp_purchase_order.status !=', 99);
        $this->db->where('temp_purchase_order.status !=', 2);
        return $this->db->get();
    }

    // STOCK OPNAME

    public function getMasterStokOpnameUser()
    {
        $this->db->select('master_stok_opname.id,master_stok_opname.nomor_referensi, master_stok_opname.status, master_stok_opname.keterangan, DATE_FORMAT(master_stok_opname.tanggal, "%d-%b-%y") as tanggal, master_user.nama as nama_admin,');
        $this->db->from('master_stok_opname');
        $this->db->join('master_user', 'master_user.username = master_stok_opname.user');
        $this->db->where('user', $this->session->userdata['username']);
        return $this->db->get();
    }

    public function getDetailMasterStokOpname($no_ref)
    {
        $this->db->select('*');
        $this->db->from('master_stok_opname');
        $this->db->where('nomor_referensi', $no_ref);
        return $this->db->get()->row_array();
    }

    public function dataBarang($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get()->row_array();
    }

    public function saldoBuku($kode_barang)
    {

        // saldo awal
        $this->db->select('qty_awal, saldo_awal, harga_awal');
        $this->db->from('master_saldo_awal');
        $this->db->where('kode_barang', $kode_barang);

        $data = $this->db->get()->row_array();
        if ($data == null) {
            $saldoAwal = 0;
        } else {
            $saldoAwal = $data['qty_awal'];
        }

        // saldo masuk
        $this->db->select_sum('jumlah_pembelian');
        $this->db->from('detail_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $jumlah_pembelian = $data['jumlah_pembelian'];

        $this->db->select_sum('saldo_retur');
        $this->db->from('detail_retur_barang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();

        $saldo_retur = $data['saldo_retur'];

        $saldoMasuk = $jumlah_pembelian + $saldo_retur;

        // saldo keluar

        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('detail_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $jumlah_penjualan = $data['jumlah_penjualan'];

        $this->db->select_sum('jumlah_retur');
        $this->db->from('detail_retur_pembelian');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldo_retur = $data['jumlah_retur'];

        $saldoKeluar = $jumlah_penjualan + $saldo_retur;

        // saldo keranjang
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('is_po =', 0);
        $data = $this->db->get()->row_array();
        $saldoCart = $data['jumlah_penjualan'];
        $this->db->from('temp_tabel_keranjang_penjualan');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $saldoCart = $data['jumlah_penjualan'];

        // saldo Cart Po
        $this->db->select_sum('jumlah_penjualan');
        $this->db->from('temp_purchase_order');
        $this->db->where('kode_barang', $kode_barang);
        $this->db->where('temp_purchase_order.status !=', 99);
        $this->db->where('temp_purchase_order.status !=', 2);
        $data = $this->db->get()->row_array();
        $saldoCartPo = $data['jumlah_penjualan'];

        if ($saldoAwal == null) {
            $saldoAwal = 0;
        }

        if ($saldoMasuk == null) {
            $saldoMasuk = 0;
        }

        if ($saldoKeluar == null) {
            $saldoKeluar = 0;
        }

        if ($saldoCart == null) {
            $saldoCart = 0;
        }

        if ($saldoCartPo == null) {
            $saldoCartPo = 0;
        }

        return ($saldoAwal + $saldoMasuk) - ($saldoKeluar + $saldoCart + $saldoCartPo);
    }

    public function random_ref()
    {
        return random_string('numeric', 7);
    }

    public function tambah_data($post)
    {
        $data = [
            'nomor_referensi' => $post['nomor_referensi'],
            'tanggal' => date('Y-m-d H:i:s', strtotime($post['tanggal'])),
            'keterangan' => $post['keterangan'],
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_stok_opname', $data);
    }

    public function delete_master_stok_opname($no_ref)
    {
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->delete('master_stok_opname');
    }

    public function tambah_detail_data($post)
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
                'tanggal' => date('Y-m-d H:i:s', strtotime($post['tanggal'])),
                'kode_barang' => $barang['kode_barang'],
                'saldo_buku' => $value['saldo_buku'],
                'saldo_fisik' => $value['saldo_fisik'],
                'selisih' => $value['selisih'],
                'user' => $this->session->userdata['username'],
            ];
            $this->db->insert('detail_stok_opname', $data);
        }
    }

    public function getDataStokOpname($no_ref)
    {
        $this->db->select('*');
        $this->db->from('detail_stok_opname');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_stok_opname.kode_barang');
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->order_by('detail_stok_opname.kode_barang', 'ASC');
        return $this->db->get();
    }

    public function update_data_by_upload($no_ref) // update data stok opname by upload file

    {
        $config['upload_path'] = './assets/upload/temp/stokopname/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = random_string('alnum', 16);
        $config['overwrite'] = true;
        $config['max_size'] = 4096; // 4MB
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
                'user' => $this->session->userdata['username'],
            ];
            $this->db->where('kode_barang', $sheetData[$i]['1']);
            $this->db->where('nomor_referensi', $no_ref);
            $this->db->update('detail_stok_opname', $data);
        }
        unlink('./assets/upload/temp/stokopname/' . $nama_file);
    }

    // script detail dari detail stok opname
    public function detailStokOpname($id_detail)
    {
        $this->db->select('*');
        $this->db->from('detail_stok_opname');
        $this->db->where('id', $id_detail);
        return $this->db->get()->row_array();
    }

    public function detail_detailStokOpname($id_detail)
    {
        $this->db->select('*');
        $this->db->from('detail_detail_stok_opname');
        $this->db->where('id_detail_stok_opname', $id_detail);
        return $this->db->get()->result_array();
    }

    public function tambah_detail_selisih($post)
    {

        $data = [
            'id_detail_stok_opname' => $post['id'],
        ];
        $this->db->insert('detail_detail_stok_opname', $data);

        $this->db->select('id');
        $this->db->from('detail_detail_stok_opname');
        $this->db->limit(1);
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->row_array();
        $last = $query['id'];
        echo $last;
    }

    public function delete_detail_selisih($post)
    {
        $this->db->where('id', $post['id']);
        $this->db->delete('detail_detail_stok_opname');
    }

    public function edit_detail_selisih($post)
    {
        $data = [
            'qty' => $post['qty'],
            'keterangan' => $post['ket'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('detail_detail_stok_opname', $data);
    }

    public function koreksi($id_detail)
    {
        $this->db->select_sum('qty');
        $this->db->from('detail_detail_stok_opname');
        $this->db->where('id_detail_stok_opname', $id_detail);
        $output = $this->db->get()->row_array();
        if ($output['qty'] == null) {
            return "0";
        } else {
            return $output['qty'];
        }
    }

    public function tambah_saldo_fisik($post)
    {
        $selisih = $post['saldo_buku'] - $post['saldo_fisik'];
        $data = [
            'saldo_fisik' => $post['saldo_fisik'],
            'selisih' => $selisih,
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('detail_stok_opname', $data);
    }

    public function proses_spv($post)
    {
        $data = [
            'status' => 1,
            'tanggal' => date('Y-m-d H:i:s', strtotime($post['tanggal'])),
            'keterangan' => $post['keterangan'],
        ];
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->update('master_stok_opname', $data);
    }

    // script review stok opname

    public function getMasterStokOpnameSpv()
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d-%b-%y") as tanggal');
        $this->db->from('master_stok_opname');
        $this->db->where('status', 1);
        return $this->db->get();
    }

    public function treeviewkodebarang($post)
    {
        $this->db->select('*, master_barang.nama_barang');
        $this->db->from('detail_stok_opname');
        $this->db->join('master_barang', 'master_barang.kode_barang = detail_stok_opname.kode_barang');
        $this->db->where('nomor_referensi', $post['no_ref']);
        return $this->db->get()->result_array();
    }

    public function treeviewdetail($string)
    {
        $this->db->select('*');
        $this->db->from('detail_detail_stok_opname');
        $this->db->where('id_detail_stok_opname', $string);
        return $this->db->get()->result_array();
    }

    public function approve_review($post)
    {
        $data = [
            'status' => 2,
            'tanggal' => date('Y-m-d H:i:s'),
            'spv' => $this->session->userdata['username'],
        ];
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->update('master_stok_opname', $data);
    }

    public function return_review($post)
    {
        $data = [
            'status' => 3,
            'tanggal' => date('Y-m-d H:i:s'),
            'spv' => $this->session->userdata['username'],
        ];
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->update('master_stok_opname', $data);
    }

    public function reject_review($post)
    {
        $data = [
            'status' => 99,
            'tanggal' => date('Y-m-d H:i:s'),
            'spv' => $this->session->userdata['username'],
        ];
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->update('master_stok_opname', $data);
    }
}
