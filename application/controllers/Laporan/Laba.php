<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Laba extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laba', 'modelLaba');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function index()
    {
        $hari = date("d");
        $bulan = date("M");
        $tahun = date("Y");
        $data = [
            'total_penjualan' => $this->total_penjualan($hari,$bulan,$tahun),
            'potongan_penjualan' => $this->potongan_penjualan($hari,$bulan,$tahun),
            'retur_penjualan' => $this->retur_penjualan($hari,$bulan,$tahun),
            'total_potongan_penjualan'=>$this->total_potongan_penjualan($hari,$bulan,$tahun),
            'penjualan_kotor'=>$this->penjualan_kotor($hari,$bulan,$tahun),
            'harga_pokok_penjualan' => $this->harga_pokok_penjualan($hari,$bulan,$tahun),
            'laba_rugi_kotor' => $this->laba_rugi_kotor($hari,$bulan,$tahun),
            // pendapatan lain - lain
            'ongkos_kirim' => $this->ongkos_kirim($hari,$bulan,$tahun),
            'pendapatan_lain'=>$this->pendapatan_lain($hari,$bulan,$tahun),
            'beban_operasional_usaha'=>$this->beban_operasional_usaha($hari,$bulan,$tahun),
            'beban_gaji'=>$this->beban_gaji($hari,$bulan,$tahun),
            'total_beban'=>$this->total_beban($hari,$bulan,$tahun),
            'laba_rugi'=>$this->laba_rugi($hari,$bulan,$tahun)
        ];
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'laporan/laba/laba_css';
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/laba/laba', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('laporan/laba/laba_js');
        $this->load->view('template/template_app_js');
    }

    function generate_data()
    {
          $post = $this->input->post();
          $hari = $post['hari'];
          $bulan = $post['bulan'];
          $tahun = $post['tahun'];
          $data = [
            'total_penjualan' => $this->total_penjualan($hari,$bulan,$tahun),
            'potongan_penjualan' => $this->potongan_penjualan($hari,$bulan,$tahun),
            'retur_penjualan' => $this->retur_penjualan($hari,$bulan,$tahun),
            'total_potongan_penjualan'=>$this->total_potongan_penjualan($hari,$bulan,$tahun),
            'penjualan_kotor'=>$this->penjualan_kotor($hari,$bulan,$tahun),
            'harga_pokok_penjualan' => $this->harga_pokok_penjualan($hari,$bulan,$tahun),
            'laba_rugi_kotor' => $this->laba_rugi_kotor($hari,$bulan,$tahun),
            // pendapatan lain - lain
            'ongkos_kirim' => $this->ongkos_kirim($hari,$bulan,$tahun),
            'pendapatan_lain'=>$this->pendapatan_lain($hari,$bulan,$tahun),
            'beban_operasional_usaha'=>$this->beban_operasional_usaha($hari,$bulan,$tahun),
            'beban_gaji'=>$this->beban_gaji($hari,$bulan,$tahun),
            'total_beban'=>$this->total_beban($hari,$bulan,$tahun),
            'laba_rugi'=>$this->laba_rugi($hari,$bulan,$tahun),
        ];
        $output = json_encode($data);
        echo $output;

    }

    function total_penjualan($hari,$bulan,$tahun)
    {
        return $this->modelLaba->total_penjualan($hari,$bulan,$tahun);
    }

    function potongan_penjualan($hari,$bulan,$tahun)
    {
        return $this->modelLaba->potongan_penjualan($hari,$bulan,$tahun);
    }

    function retur_penjualan($hari,$bulan,$tahun)
    {
        return $this->modelLaba->retur_penjualan($hari,$bulan,$tahun); 
    }

    function total_potongan_penjualan($hari,$bulan,$tahun)
    {
        $potongan_penjualan = $this->potongan_penjualan($hari,$bulan,$tahun);
        $retur_penjualan = $this->retur_penjualan($hari,$bulan,$tahun);
        return $potongan_penjualan + $retur_penjualan;
    }

    function penjualan_kotor($hari,$bulan,$tahun)
    {
        $total_penjualan = $this->total_penjualan($hari,$bulan,$tahun);
        $total_potongan_penjualan = $this->total_potongan_penjualan($hari,$bulan,$tahun);
        return $total_penjualan - $total_potongan_penjualan;
    }

    function harga_pokok_penjualan($hari,$bulan,$tahun)
    {
        return $this->modelLaba->harga_pokok_penjualanv2($hari,$bulan,$tahun);
    }

    function laba_rugi_kotor($hari,$bulan,$tahun)
    {
        $penjualan_kotor = $this->penjualan_kotor($hari,$bulan,$tahun);
        $harga_pokok_penjualan = $this->harga_pokok_penjualan($hari,$bulan,$tahun);

        return $penjualan_kotor - $harga_pokok_penjualan;
    }

    // pendapatan lain - lain

    function ongkos_kirim($hari,$bulan,$tahun)
    {
          return $this->modelLaba->ongkos_kirim($hari,$bulan,$tahun);
    }

    function pendapatan_lain($hari,$bulan,$tahun)
    {
        $ongkir = $this->modelLaba->ongkos_kirim($hari,$bulan,$tahun);
        return $ongkir;
    }

    function beban_operasional_usaha($hari,$bulan,$tahun)
    {
        return $this->modelLaba->beban_operasional_usaha($hari,$bulan,$tahun);
    }

    function beban_gaji($hari,$bulan,$tahun)
    {
        return $this->modelLaba->beban_gaji($hari,$bulan,$tahun);
    }


    function total_beban($hari,$bulan,$tahun)
    {
        return $this->modelLaba->total_beban($hari,$bulan,$tahun);
    }

    function laba_rugi($hari,$bulan,$tahun)
    {
        $laba_rugi_kotor = $this->laba_rugi_kotor($hari,$bulan,$tahun);
        $total_beban = $this->total_beban($hari,$bulan,$tahun);

        return $laba_rugi_kotor - $total_beban;
    }
}
