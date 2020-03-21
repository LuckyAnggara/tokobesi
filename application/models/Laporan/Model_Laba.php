<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Laba extends CI_Model
{
    // global

    function get_data_laba_total($hari, $bulan, $tahun)
    {
        return 0;

    }

    // private
    function total_penjualan($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        if($output->total_penjualan == null)
        {
        return "0";
        }else{
        return $output->total_penjualan;
        }
    }

    function potongan_penjualan($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('diskon');
        $this->db->from('master_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        if($output->diskon == null)
        {
        return "0";
        }else{
        return $output->diskon;
        }
    }

    function retur_penjualan($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('retur_total');
        $this->db->from('master_retur_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        if($output->retur_total == null)
        {
        return "0";
        }else{
        return $output->retur_total;
        }
    }

    function harga_pokok_penjualan($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`qty` * `harga_pokok`) as harga');
        $this->db->from('master_harga_pokok_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        if($output->harga == null)
        {
        return "0";
        }else{
        return $output->harga;
        }
    }

    function persediaan_awal($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`qty_awal`*`harga_awal`) as persediaan_awal');
        $this->db->from('master_saldo_awal');
        $output = $this->db->get()->row();
        if ($output->persediaan_awal == null) {
            return "0";
        } else {
            return $output->persediaan_awal;
        }
    }

    function pembelian_bersih($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`total_pembelian`) as pembelian_bersih');
        $this->db->from('master_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        if ($output->pembelian_bersih == null) {
            return "0";
        } else {
            return $output->pembelian_bersih;
        }
    }

    function diskon_pembelian($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`diskon`) as diskon_pembelian');
        $this->db->from('master_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        if ($output->diskon_pembelian == null) {
            return "0";
        } else {
            return $output->diskon_pembelian;
        }
    }

    function retur_pembelian($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select('SUM(`retur_total`) as retur_pembelian');
        $this->db->from('master_retur_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        if ($output->retur_pembelian == null) {
            return "0";
        } else {
            return $output->retur_pembelian;
        }
    }


    function persediaan_akhir($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        $this->db->select('SUM(`saldo_awal`*`harga_awal`) as sisa_persediaan_awal');
        $this->db->from('master_saldo_awal');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        $sisa_persediaan_awal = $output->sisa_persediaan_awal;

        $this->db->select('SUM(`saldo`*`harga_beli`) as sisa_pembelian_bersih');
        $this->db->from('detail_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        $sisa_pembelian_bersih = $output->sisa_pembelian_bersih;

        $this->db->select('SUM(`saldo_retur`*`harga_pokok`) as persediaan_retur');
        $this->db->from('detail_retur_barang_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        $persediaan_retur = $output->persediaan_retur;


        return $sisa_persediaan_awal + $sisa_pembelian_bersih + $persediaan_retur ;


        // $output = $this->db->get()->row();
        // if ($output->pembelian_bersih == null) {
        //     return "0";
        // } else {
        //     return $output->pembelian_bersih;
        // }
    }

    function harga_pokok_penjualanv2($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;

        

        $this->db->select('SUM(`qty_awal`*`harga_awal`) as persediaan_awal');
        $this->db->from('master_saldo_awal');
        $output = $this->db->get()->row();
        $persediaan_awal = $output->persediaan_awal;

        //  // pengurang
        // $this->db->select('SUM((`qty_awal` - `saldo_awal`)*`harga_awal`) as pengurang_awal');
        // $this->db->from('master_saldo_awal');
        // if ($tanggal !== "--") {
        //     $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
        //     $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        // }
        // $output = $this->db->get()->row();
        // $pengurang_awal = $output->pengurang_awal;


        $this->db->select('SUM(`jumlah_pembelian`*`harga_beli`) as pembelian_bersih');
        $this->db->from('detail_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        $pembelian_bersih = $output->pembelian_bersih;

        $this->db->select('SUM(`saldo_retur`*`harga_pokok`) as persediaan_retur');
        $this->db->from('detail_retur_barang_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        $retur_pembelian = $output->persediaan_retur;

        $persediaan_barang = $persediaan_awal + $pembelian_bersih;
        // $persediaan_barang = ($persediaan_awal - $pengurang_awal) + $pembelian_bersih;

        $this->db->select('SUM(`saldo_awal`*`harga_awal`) as sisa_persediaan_awal');
        $this->db->from('master_saldo_awal');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        $sisa_persediaan_awal = $output->sisa_persediaan_awal;

        
        $this->db->select('SUM(`saldo`*`harga_beli`) as sisa_pembelian_bersih');
        $this->db->from('detail_pembelian');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        $sisa_pembelian_bersih = $output->sisa_pembelian_bersih;

        $persediaan_akhir = $sisa_persediaan_awal + $sisa_pembelian_bersih;

        $data = ($persediaan_barang - $retur_pembelian) - $persediaan_akhir ;
        if($data == null)
        {
        return "0";
        }else{
        return $data;
        }
    }

    // pendapatan lain - lain

    function ongkos_kirim($hari = null, $bulan = null, $tahun = null)
    {
        $tanggal = $tahun . "-" . $bulan . "-" . $hari;
        $tanggalawal = $tahun . "-" . 01 . "-" . 01;
        $this->db->select_sum('ongkir');
        $this->db->from('master_penjualan');
        if ($tanggal !== "--") {
            $this->db->where('tanggal_transaksi >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
            $this->db->where('tanggal_transaksi <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        }
        $output = $this->db->get()->row();
        if($output->ongkir == null)
        {
        return "0";
        }else{
        return $output->ongkir;
        }
    }

    // beban usaha

    function beban_operasional_usaha($hari = null, $bulan = null, $tahun = null)
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
            $this->db->where('kategori_biaya', $value['id']);
            $data = $this->db->get()->row_array();
            if($data['total_biaya'] == null)
            {
                $total_biaya =0;
            }else{
                $total_biaya = $data['total_biaya'];
            }
            $output[] = [
                'nama_biaya' => $value['nama_biaya'],
                'total'=> $total_biaya
            ];
        }

        return $output;
    }

    function beban_operasional_usaha_v2($hari = null, $bulan = null, $tahun = null)
    {
            $tanggal = $tahun . "-" . $bulan . "-" . $hari;
            $tanggalawal = $tahun . "-" . 01 . "-" . 01;
            $this->db->select('master_kategori_biaya.nama_biaya, SUM(`total`) as total');
            $this->db->from('detail_biaya');
            $this->db->join('master_kategori_biaya', 'detail_biaya.kategori_biaya = master_kategori_biaya.id');
            if ($tanggal !== "--") {
                $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
                $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
            }
            $this->db->group_by('kategori_biaya');
            return $this->db->get()->result_array();
    }

    function beban_gaji($hari = null, $bulan = null, $tahun = null)
    {
            $tanggal = $tahun . "-" . $bulan . "-" . $hari;
            $tanggalawal = $tahun . "-" . 01 . "-" . 01;
            $this->db->select('SUM(`gaji_pokok`) as gaji_pokok, SUM(`uang_makan`) as uang_makan, SUM(`bonus`) as bonus');
            $this->db->from('detail_gaji');
            if ($tanggal !== "--") {
                $this->db->where('tanggal_pembayaran >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
                $this->db->where('tanggal_pembayaran <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
            }
            $data = $this->db->get()->row_array();
            if($data['gaji_pokok'] == null)
            {
                $gaji_pokok = 0;
            }else{
                $gaji_pokok = $data['gaji_pokok'];
            }
            if($data['uang_makan'] == null)
            {
                $uang_makan = 0;
            }else{
                $uang_makan = $data['uang_makan'];
            }
            if($data['bonus'] == null)
            {
                $bonus = 0;
            }else{
                $bonus = $data['bonus'];
            }

            $output = [
                'gaji_pokok' => $gaji_pokok,
                'uang_makan' => $uang_makan,
                'bonus' => $bonus,
            ];
            return $output;
        }

    function total_beban($hari = null, $bulan = null, $tahun = null)
    {
            $tanggal = $tahun . "-" . $bulan . "-" . $hari;
            $tanggalawal = $tahun . "-" . 01 . "-" . 01;
            $this->db->select('SUM(`total`) as total');
            $this->db->from('detail_biaya');
            if ($tanggal !== "--") {
                $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
                $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
            }
            $output = $this->db->get()->row();
            $beban_operasional =  $output->total;

            $tanggal = $tahun . "-" . $bulan . "-" . $hari;
            $tanggalawal = $tahun . "-" . 01 . "-" . 01;
            $this->db->select('SUM(`gaji_pokok`) as gaji_pokok, SUM(`uang_makan`) as uang_makan, SUM(`bonus`) as bonus');
            $this->db->from('detail_gaji');
            if ($tanggal !== "--") {
                $this->db->where('tanggal_pembayaran >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
                $this->db->where('tanggal_pembayaran <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
            }
            $output = $this->db->get()->row();

            $beban_gaji = $output->gaji_pokok + $output->uang_makan + $output->bonus;

            return $beban_operasional + $beban_gaji;
    }
}
