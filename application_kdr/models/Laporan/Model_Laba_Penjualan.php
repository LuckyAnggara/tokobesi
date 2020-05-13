<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laba_Penjualan extends CI_Model
{

    public function get_data_laba_penjualan($hari, $bulan, $tahun, $periode)
    {

        $data = [
            'total_penjualan' => $this->total_penjualan($hari, $bulan, $tahun, $periode),
            'potongan_penjualan' => $this->potongan_penjualan($hari, $bulan, $tahun, $periode),
            'retur_penjualan' => $this->retur_penjualan($hari, $bulan, $tahun, $periode),
            'total_potongan_penjualan' => $this->total_potongan_penjualan($hari, $bulan, $tahun, $periode),
            'penjualan_kotor' => $this->penjualan_kotor($hari, $bulan, $tahun, $periode),
            'total_penjualan_bersih' => $this->penjualan_kotor($hari, $bulan, $tahun, $periode),

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
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;
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
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;
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

        // $this->db->select_sum('retur_total');
        // $this->db->from('master_retur_penjualan');
        // if ($tanggal !== "--") {
        //     $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
        //     $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        // }
        //     $total_retur = $this->db->get()->row();
        //     if ($total_retur->retur_total == null) {
        //         $total_retur =  "0";
        //     } else {
        //     $total_retur = $total_retur->retur_total;
        // }

        return $total_penjualan;
    }

    public function potongan_penjualan($hari = null, $bulan = null, $tahun = null, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;
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
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;
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

    public function penjualan_kotor($hari, $bulan, $tahun, $periode)
    {
        $total_penjualan = $this->total_penjualan($hari, $bulan, $tahun, $periode);
        $total_potongan_penjualan = $this->total_potongan_penjualan($hari, $bulan, $tahun, $periode);
        return $total_penjualan - $total_potongan_penjualan;
    }

    public function persediaan_akhir($hari, $bulan, $tahun, $periode)
    {
        $tanggal1 = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal2 = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        $this->db->select('SUM(`saldo`*`harga_pokok`) as awal');
        $this->db->from('detail_persediaan');
        if ($tanggal1 !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal1)));
        }

        $output = $this->db->get()->row();
        $awal = $output->awal;

        $this->db->select('SUM(`debit`*`harga_pokok`) as akhir1, SUM(`saldo`*`harga_pokok`) as akhir2');
        $this->db->from('detail_persediaan');
        if ($tanggal1 !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggal2)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal1)));
        }
        $output = $this->db->get()->row();
        $akhir1 = $output->akhir1;
        $akhir2 = $output->akhir2;

        return $awal - $akhir1 - $akhir2;
    }

    public function persediaan_akhirv2($hari, $bulan, $tahun, $periode)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;

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
        $this->db->where('periode', $periode);

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
        $penjualan_kotor = $this->penjualan_kotor($hari, $bulan, $tahun, $periode);
        $harga_pokok_penjualan = $this->harga_pokok_penjualan($hari, $bulan, $tahun, $periode);
        return $penjualan_kotor - $harga_pokok_penjualan;
    }

    public function pendapatan_lain($hari, $bulan, $tahun, $periode) // pendapatan lain - lain baru ongkos kirim

    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . $bulan . "-" . $hari;
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

    // data utang dan piutang

    public function data_utang($tanggal)
    {
        $this->db->select_sum('sisa_utang');
        $this->db->from('master_utang');
        $this->db->where('tanggal_input >=', $tanggal);
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();
        if ($output['sisa_utang'] == null) {
            return "0";
        } else {
            return $output['sisa_utang'];
        }
    }

    public function data_piutang($tanggal)
    {
        $this->db->select_sum('sisa_piutang');
        $this->db->from('master_piutang');
        $this->db->where('tanggal_input >=', $tanggal);
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('periode', $periode);

        $output = $this->db->get()->row_array();
        if ($output['sisa_piutang'] == null) {
            return "0";
        } else {
            return $output['sisa_piutang'];
        }
    }
}
