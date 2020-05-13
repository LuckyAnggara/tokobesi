<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laba extends CI_Model
{

    public function get_data_laba_total($hari, $bulan, $tahun, $periode)
    {
        return $this->modelLaba->get_data_laba_total($hari, $bulan, $tahun, $periode);
    }

    public function get_data_laba_penjualan($hari, $bulan, $tahun, $periode)
    {

        $data = [
            'total_penjualan' => $this->total_penjualan($hari, $bulan, $tahun, $periode),
            'potongan_penjualan' => $this->potongan_penjualan($hari, $bulan, $tahun, $periode),
            'retur_penjualan' => $this->retur_penjualan($hari, $bulan, $tahun, $periode),
            'total_potongan_penjualan' => $this->total_potongan_penjualan($hari, $bulan, $tahun, $periode),
            'total_penjualan_bersih' => $this->total_penjualan_bersih($hari, $bulan, $tahun, $periode),

            'persediaan_awal' => $this->persediaan_awal($hari, $bulan, $tahun, $periode),
            'total_pembelian' => $this->total_pembelian($hari, $bulan, $tahun, $periode),
            'potongan_pembelian' => $this->potongan_pembelian($hari, $bulan, $tahun, $periode),
            'retur_pembelian' => $this->retur_pembelian($hari, $bulan, $tahun, $periode),
            'total_potongan_pembelian' => $this->pembelian_kotor($hari, $bulan, $tahun, $periode),
            'pembelian_kotor' => $this->pembelian_kotor($hari, $bulan, $tahun, $periode),

            'persediaan_tersedia' => $this->persediaan_tersedia($hari, $bulan, $tahun, $periode),
            'persediaan_akhir' => $this->persediaan_akhirv2($hari, $bulan, $tahun, $periode),
            'harga_pokok_penjualan' => $this->harga_pokok_penjualan($hari, $bulan, $tahun, $periode),
            'laba_penjualan' => $this->laba_penjualan($hari, $bulan, $tahun, $periode),
            'pendapatan_lain' => $this->pendapatan_lain($hari, $bulan, $tahun, $periode),
            'total_pendapatan_lain' => $this->pendapatan_lain($hari, $bulan, $tahun, $periode),
            'total_pendapatan_bersih' => $this->total_pendapatan_bersih($hari, $bulan, $tahun, $periode),
        ];

        return $data;
        // return $this->laba_penjualan($hari, $bulan, $tahun, $periode);
    }

    // menghitung persediaan awal

    public function persediaan_awal($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        $this->db->select('SUM(`qty_awal`*`harga_awal`) as persediaan_awal');
        $this->db->from('master_saldo_awal');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->persediaan_awal == null) {
            return 0;
        } else {
            return $output->persediaan_awal;
        }
    }

    public function persediaan_tersedia($hari, $bulan, $tahun, $periode)
    {
        $pembelian_kotor = $this->total_pembelian($hari, $bulan, $tahun, $periode);
        $persediaan_awal = $this->persediaan_awal($hari, $bulan, $tahun, $periode);
        $retur_pembelian = $this->retur_pembelian($hari, $bulan, $tahun, $periode);
        return $persediaan_awal + ($pembelian_kotor - $retur_pembelian);
    }

    // menghitung total pembelian

    public function total_pembelian($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('total_pembelian');
        $this->db->from('master_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->total_pembelian == null) {
            return "0";
        } else {
            return $output->total_pembelian;
        }
    }

    public function potongan_pembelian($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('diskon');
        $this->db->from('master_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->diskon == null) {
            return "0";
        } else {
            return $output->diskon;
        }
    }

    public function retur_pembelian($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('retur_total');
        $this->db->from('master_retur_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->retur_total == null) {
            return "0";
        } else {
            return $output->retur_total;
        }
    }

    public function total_potongan_pembelian($hari, $bulan, $tahun, $periode)
    {
        $potongan_pembelian = $this->potongan_pembelian($hari, $bulan, $tahun, $periode);
        $retur_pembelian = $this->retur_pembelian($hari, $bulan, $tahun, $periode);
        return $potongan_pembelian + $retur_pembelian;
    }

    public function pembelian_kotor($hari, $bulan, $tahun, $periode)
    {
        $total_pembelian = $this->total_pembelian($hari, $bulan, $tahun, $periode);
        $total_potongan_pembelian = $this->total_potongan_pembelian($hari, $bulan, $tahun, $periode);
        return $total_pembelian - $total_potongan_pembelian;
    }

    // menghitung penjualan kotor

    public function total_penjualan($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $total_penjualan = $this->db->get()->row();
        if ($total_penjualan->total_penjualan == null) {
            $total_penjualan = "0";
        } else {
            $total_penjualan = $total_penjualan->total_penjualan;
        }

        return $total_penjualan;
    }

    public function potongan_penjualan($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('diskon');
        $this->db->from('master_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->diskon == null) {
            return "0";
        } else {
            return $output->diskon;
        }
    }

    public function retur_penjualan($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('retur_total');
        $this->db->from('master_retur_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->retur_total == null) {
            return "0";
        } else {
            return $output->retur_total;
        }
    }

    public function total_potongan_penjualan($hari, $bulan, $tahun, $periode)
    {
        $potongan_penjualan = $this->potongan_penjualan($hari, $bulan, $tahun, $periode);
        $retur_penjualan = $this->retur_penjualan($hari, $bulan, $tahun, $periode);
        return $potongan_penjualan + $retur_penjualan;
    }

    public function total_penjualan_bersih($hari, $bulan, $tahun, $periode)
    {
        $total_penjualan = $this->total_penjualan($hari, $bulan, $tahun, $periode);
        $total_potongan_penjualan = $this->total_potongan_penjualan($hari, $bulan, $tahun, $periode);
        return $total_penjualan - $total_potongan_penjualan;
    }

    public function persediaan_akhirv2($hari, $bulan, $tahun, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        $persediaan_tersedia = $this->persediaan_tersedia($hari, $bulan, $tahun, $periode);

        $this->db->select('SUM(`qty`*`harga_pokok`) as persediaan_akhir');
        $this->db->from('master_harga_pokok_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        $persediaan_akhir = $output->persediaan_akhir;

        $this->db->select('SUM(`saldo_tersedia`*`harga_pokok`) as sisa_persediaan_retur');
        $this->db->from('detail_retur_barang_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        $sisa_persediaan_retur = $output->sisa_persediaan_retur;

        $persediaan_akhir = $persediaan_tersedia - $persediaan_akhir;
        return $persediaan_akhir + $sisa_persediaan_retur;
    }

    public function harga_pokok_penjualan($hari, $bulan, $tahun, $periode)
    {
        $persediaan_tersedia = $this->persediaan_tersedia($hari, $bulan, $tahun, $periode);
        $persediaan_akhirv2 = $this->persediaan_akhirv2($hari, $bulan, $tahun, $periode);
        return $persediaan_tersedia - $persediaan_akhirv2;
    }

    public function laba_penjualan($hari, $bulan, $tahun, $periode)
    {
        $total_penjualan_bersih = $this->total_penjualan_bersih($hari, $bulan, $tahun, $periode);
        $harga_pokok_penjualan = $this->harga_pokok_penjualan($hari, $bulan, $tahun, $periode);
        return $total_penjualan_bersih - $harga_pokok_penjualan;
    }

    public function pendapatan_lain($hari = null, $bulan = null, $tahun = null, $periode) // pendapatan lain - lain baru ongkos kirim

    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('ongkir');
        $this->db->from('master_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row();
        if ($output->ongkir == null) {
            return "0";
        } else {
            return $output->ongkir;
        }
    }

    public function total_pendapatan_bersih($hari = null, $bulan = null, $tahun = null, $periode)
    {

        $laba_penjualan = $this->laba_penjualan($hari, $bulan, $tahun, $periode);
        $pendapatan_lain = $this->pendapatan_lain($hari, $bulan, $tahun, $periode);
        return $laba_penjualan + $pendapatan_lain;
    }

    // beban usaha

    public function beban_operasional_usaha($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        // ambil data kategori usaha

        $this->db->select('*');
        $this->db->from('master_kategori_biaya');
        $kategori_biaya = $this->db->get()->result_array();

        foreach ($kategori_biaya as $key => $value) {

            $this->db->select('SUM(`total`) as total_biaya');
            $this->db->from('detail_biaya');
            if ($tanggal !== "--") {
                $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
                $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
            }
            $this->db->where('periode', $periode);

            $this->db->where('kategori_biaya', $value['id']);
            $data = $this->db->get()->row_array();
            if ($data['total_biaya'] == null) {
                $total_biaya = 0;
            } else {
                $total_biaya = $data['total_biaya'];
            }
            $output[] = [
                'nama_biaya' => $value['nama_biaya'],
                'total' => $total_biaya,
            ];
        }

        return $output;
    }

    public function total_beban_operasional($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`total`) as total');
        $this->db->from('detail_biaya');
        if ($tanggal !== "--") {
            $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $data = $this->db->get()->row();
        $total = $data->total;
        if ($total == null) {
            return 0;
        } else {
            return $total;
        }
    }

    public function beban_gaji($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`gaji_pokok`) as gaji_pokok, SUM(`uang_makan`) as uang_makan, SUM(`bonus`) as bonus');
        $this->db->from('detail_gaji');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_pembayaran >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_pembayaran <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $data = $this->db->get()->row_array();
        if ($data['gaji_pokok'] == null) {
            $gaji_pokok = 0;
        } else {
            $gaji_pokok = $data['gaji_pokok'];
        }
        if ($data['uang_makan'] == null) {
            $uang_makan = 0;
        } else {
            $uang_makan = $data['uang_makan'];
        }
        if ($data['bonus'] == null) {
            $bonus = 0;
        } else {
            $bonus = $data['bonus'];
        }

        $output = [
            'gaji_pokok' => $gaji_pokok,
            'uang_makan' => $uang_makan,
            'bonus' => $bonus,
        ];
        return $output;
    }

    public function total_beban_gaji($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`total`) as total');
        $this->db->from('detail_gaji');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_pembayaran >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_pembayaran <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $this->db->where('periode', $periode);

        $data = $this->db->get()->row();
        $total = $data->total;
        if ($total == null) {
            return 0;
        } else {
            return $total;
        }
    }

    public function laba_berjalan($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $total_pendapatan_bersih = $this->total_pendapatan_bersih($hari, $bulan, $tahun, $periode);
        $total_beban_operasional = $this->total_beban_operasional($hari, $bulan, $tahun, $periode);
        $total_beban_gaji = $this->total_beban_gaji($hari, $bulan, $tahun, $periode);

        return $total_pendapatan_bersih - ($total_beban_operasional + $total_beban_gaji);
    }
}
