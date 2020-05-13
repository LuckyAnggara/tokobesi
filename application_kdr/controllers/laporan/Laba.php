<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laba extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laba', 'modelLaba');
        $this->load->model('Laporan/Model_Pengeluaran', 'modelPengeluaran');
        $this->load->model('Laporan/Model_Laba_Penjualan', 'modelLabaPenjualan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->model('Setting/Model_Periode', 'modelPeriode');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember',
        );
        $pecahkan = explode('-', $tanggal);

        // variabel pecahkan 0 = tanggal
        // variabel pecahkan 1 = bulan
        // variabel pecahkan 2 = tahun

        switch ($pecahkan[3]) {
            case 'Sun':
                $hari_ini = "Minggu";
                break;

            case 'Mon':
                $hari_ini = "Senin";
                break;

            case 'Tue':
                $hari_ini = "Selasa";
                break;

            case 'Wed':
                $hari_ini = "Rabu";
                break;

            case 'Thu':
                $hari_ini = "Kamis";
                break;

            case 'Fri':
                $hari_ini = "Jumat";
                break;

            case 'Sat':
                $hari_ini = "Sabtu";
                break;

            default:
                $hari_ini = "Tidak di ketahui";
                break;
        }

        return $hari_ini . ', ' . $pecahkan[2] . ' ' . $bulan[(int) $pecahkan[1]] . ' ' . $pecahkan[0];
    }

    public function index()
    {
        $periode = $this->modelSetting->get_data_periode();

        $hari = date("d");
        $bulan = date("M");
        $tahun = date("Y");

        $data['pendapatan'] = $this->modelLaba->get_data_laba_penjualan($hari, $bulan, $tahun, $periode);
        $data['kategori_biaya'] = $this->modelLaba->beban_operasional_usaha($hari, $bulan, $tahun, $periode);
        $data['total_beban_operasional'] = $this->modelLaba->total_beban_operasional($hari, $bulan, $tahun, $periode);
        $data['beban_gaji'] = $this->modelLaba->beban_gaji($hari, $bulan, $tahun, $periode);
        $data['total_beban_gaji'] = $this->modelLaba->total_beban_gaji($hari, $bulan, $tahun, $periode);
        $data['laba_berjalan'] = $this->modelLaba->laba_berjalan($hari, $bulan, $tahun, $periode);
        $data['total_pendapatan_bersih'] = $this->modelLaba->total_pendapatan_bersih($hari, $bulan, $tahun, $periode);

        // $output = json_encode($output);
        // echo $output;

        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'laporan/laba/laba_css';

        $data['periode'] = $this->modelPeriode->get_data_periode();

        // print_r($data['periode']);
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/laba/laba', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('laporan/laba/laba_js');
        $this->load->view('template/template_app_js');
    }

    public function generate_data()
    {

        $post = $this->input->post();
        $hari = $post['hari'];
        $bulan = $post['bulan'];
        $tahun = $post['tahun'];
        $periode = $post['periode'];

        $data['pendapatan'] = $this->modelLaba->get_data_laba_penjualan($hari, $bulan, $tahun, $periode);
        $data['kategori_biaya'] = $this->modelLaba->beban_operasional_usaha($hari, $bulan, $tahun, $periode);
        $data['total_beban_operasional'] = $this->modelLaba->total_beban_operasional($hari, $bulan, $tahun, $periode);
        $data['beban_gaji'] = $this->modelLaba->beban_gaji($hari, $bulan, $tahun, $periode);
        $data['total_beban_gaji'] = $this->modelLaba->total_beban_gaji($hari, $bulan, $tahun, $periode);
        $data['laba_berjalan'] = $this->modelLaba->laba_berjalan($hari, $bulan, $tahun, $periode);
        $data['total_pendapatan_bersih'] = $this->modelLaba->total_pendapatan_bersih($hari, $bulan, $tahun, $periode);

        $output = json_encode($data);
        echo $output;
    }

    public function data_download($hari, $bulan, $tahun, $periode)
    {
        $data['pendapatan'] = $this->modelLaba->get_data_laba_penjualan($hari, $bulan, $tahun, $periode);
        $data['kategori_biaya'] = $this->modelLaba->beban_operasional_usaha($hari, $bulan, $tahun, $periode);
        $data['total_beban_operasional'] = $this->modelLaba->total_beban_operasional($hari, $bulan, $tahun, $periode);
        $data['beban_gaji'] = $this->modelLaba->beban_gaji($hari, $bulan, $tahun, $periode);
        $data['total_beban_gaji'] = $this->modelLaba->total_beban_gaji($hari, $bulan, $tahun, $periode);
        $data['laba_berjalan'] = $this->modelLaba->laba_berjalan($hari, $bulan, $tahun, $periode);
        $data['total_pendapatan_bersih'] = $this->modelLaba->total_pendapatan_bersih($hari, $bulan, $tahun, $periode);
        return $data;
    }

    public function download()
    {

        $post = $this->input->post();
        $hari = date('d', strtotime($post['tanggal']));
        $bulan = date('m', strtotime($post['tanggal']));
        $tahun = date('Y', strtotime($post['tanggal']));
        $periode = $post['periode'];

        $data = $this->data_download($hari, $bulan, $tahun, $periode);

        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:F1'); // merge
        $sheet->mergeCells('A2:F2'); // merge
        $sheet->mergeCells('A4:F4'); // merge
        $sheet->setCellValue('A1', 'LAPORAN LABA / RUGI USAHA');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A4', 'DATA PER TANGGAL : ' . $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $styleArray = [
            'font' => [
                'bold' => true,
                'size' => 12,
            ],
        ];

        $minus = [
            'font' => [
                'color' => array('rgb' => 'FF0000'),
            ],
        ];

        $hpp = [
            'font' => [
                'color' => array('rgb' => 'FF0000'),
                'bold' => true,
                'size' => 12,
            ],
        ];

        $kolom = 6;
        $spreadsheet->getActiveSheet()->getStyle('D:F')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'PENJUALAN');
        $sheet->setCellValue('E' . $kolom, $data['pendapatan']['total_penjualan']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'DISKON PENJUALAN');
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('D' . $kolom, $data['pendapatan']['potongan_penjualan']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'RETUR PENJUALAN');
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('D' . $kolom, $data['pendapatan']['retur_penjualan']);
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'TOTAL PENJUALAN');
        $sheet->setCellValue('E' . $kolom, $data['pendapatan']['total_penjualan_bersih']);
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':E' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'HARGA POKOK PENJUALAN');
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'PERSEDIAAN AWAL');
        $sheet->setCellValue('D' . $kolom, $data['pendapatan']['persediaan_awal']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'PEMBELIAN');
        $sheet->setCellValue('D' . $kolom, $data['pendapatan']['total_pembelian']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'DISKON PEMBELIAN');
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('D' . $kolom, $data['pendapatan']['potongan_pembelian']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'RETUR PEMBELIAN');
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('D' . $kolom, $data['pendapatan']['retur_pembelian']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'PERSEDIAAN TERSEDIA DI JUAL');
        $sheet->setCellValue('E' . $kolom, $data['pendapatan']['persediaan_tersedia']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'PERSEDIAAN AKHIR');
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('E' . $kolom, $data['pendapatan']['persediaan_akhir']);
        $kolom++;
        $spreadsheet->getActiveSheet()->getStyle('B' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('B' . $kolom, 'HARGA POKOK PENJUALAN');
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)->applyFromArray($hpp); // style bold
        $sheet->setCellValue('E' . $kolom, $data['pendapatan']['harga_pokok_penjualan']);
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'PENDAPATAN DARI PENJUALAN');
        // $sheet->setCellValue('E' . $kolom, $data['pendapatan']['laba_penjualan']);
        // $kolom++;

        // $sheet->mergeCells('A' . $kolom . ':E' . $kolom); // merge
        // $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        // $sheet->setCellValue('A' . $kolom, 'LABA / RUGI PENJUALAN');

        if ($data['pendapatan']['laba_penjualan'] < 0) {
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)->applyFromArray($hpp); // style bold
            $sheet->setCellValue('E' . $kolom, $data['pendapatan']['laba_penjualan']);
        } else {
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)->applyFromArray($styleArray); // style bold
            $sheet->setCellValue('E' . $kolom, $data['pendapatan']['laba_penjualan']);
        }
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'PENDAPATAN LAIN - LAIN');
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'ONGKOS KIRIM');
        $sheet->setCellValue('D' . $kolom, $data['pendapatan']['pendapatan_lain']);
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'TOTAL PENDAPATAN LAIN - LAIN');
        $sheet->setCellValue('E' . $kolom, $data['pendapatan']['total_pendapatan_lain']);
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'TOTAL PENDAPATAN BERSIH');
        $sheet->setCellValue('F' . $kolom, $data['total_pendapatan_bersih']);
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'BEBAN OPERASIONAL');
        $kolom++;
        foreach ($data['kategori_biaya'] as $key => $value) {
            $sheet->setCellValue('B' . $kolom, $value['nama_biaya']);
            $sheet->setCellValue('D' . $kolom, $value['total']);
            $kolom++;
        }
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'TOTAL BEBAN OPERASIONAL');
        $sheet->setCellValue('E' . $kolom, $data['total_beban_operasional']);
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'BEBAN GAJI');
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'GAJI POKOK');
        $sheet->setCellValue('D' . $kolom, $data['beban_gaji']['gaji_pokok']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'UANG MAKAN');
        $sheet->setCellValue('D' . $kolom, $data['beban_gaji']['uang_makan']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'BONUS');
        $sheet->setCellValue('D' . $kolom, $data['beban_gaji']['bonus']);
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'TOTAL BEBAN GAJI');
        $sheet->setCellValue('E' . $kolom, $data['total_beban_gaji']);
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'TOTAL BEBAN USAHA');
        $total_beban_usaha = $data['total_beban_gaji'] + $data['total_beban_operasional'];
        $sheet->setCellValue('F' . $kolom, $total_beban_usaha);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)->applyFromArray($hpp); // style bold
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'LABA / RUGI');
        if ($data['laba_berjalan'] < 0) {
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)->applyFromArray($hpp); // style bold
            $sheet->setCellValue('F' . $kolom, $data['laba_berjalan']);
        } else {
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)->applyFromArray($styleArray); // style bold
            $sheet->setCellValue('F' . $kolom, $data['laba_berjalan']);
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan laba penjualan ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function cek()
    {
        $hari = '25';
        $bulan = '03';
        $tahun = '2020';

        $data = $this->data_download($hari, $bulan, $tahun, $periode);
        $output = json_encode($data);
        echo $output;
    }

    public function generate_data_harian()
    {
        $post = $this->input->post();
        $hari = $post['hari'];
        $bulan = $post['bulan'];
        $tahun = $post['tahun'];
        $periode = $post['periode'];
        $pendapatan = $this->modelLabaPenjualan->get_data_laba_penjualan($hari, $bulan, $tahun, $periode);

        $tanggal1 = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal2 = $tahun . "-" . $bulan . "-" . $hari;
        $tanggal[0] = $tanggal1;
        $tanggal[1] = $tanggal2;

        $pengeluaran['data_biaya'] = $this->modelPengeluaran->data_harian($tanggal, $periode);
        $pengeluaran['data_gaji'] = $this->modelPengeluaran->data_gaji($tanggal, $periode);

        $total_beban_operasional = 0;
        foreach ($pengeluaran['data_biaya'] as $key => $value) {
            $total_beban_operasional = $total_beban_operasional + $value['total'];
        }
        $data = [
            'pendapatan' => $pendapatan,
            'pengeluaran' => $pengeluaran,
            'total_beban_operasional' => $total_beban_operasional,
        ];
        $output = json_encode($data);
        echo $output;
    }

}
