<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Labapenjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laba_Penjualan', 'modelLabaPenjualan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    function tgl_indo($tanggal)
    {
        $bulan = array(
            1 =>   'Januari',
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
            'Desember'
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
        $hari = date("d");
        $bulan = date("M");
        $tahun = date("Y");
        
        $data['laba_penjualan'] = $this->modelLabaPenjualan->get_data_laba_penjualan($hari, $bulan, $tahun);
        // $output = json_encode($output);
        // echo $output;
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'laporan/laba/laba_css';
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/laba_penjualan/laba', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('laporan/laba_penjualan/laba_js');
        $this->load->view('template/template_app_js');
    }

    public function generate_data()
    {
        $post = $this->input->post();
        $hari = $post['hari'];
        $bulan = $post['bulan'];
        $tahun = $post['tahun'];
        $data = $this->modelLabaPenjualan->get_data_laba_penjualan($hari, $bulan, $tahun);
        $output = json_encode($data);
        echo $output;
    }

    public function cek()
    {
        $hari = '17';
        $bulan = '03';
        $tahun = '2020';
        
        $output = $this->modelLabaPenjualan->get_data_laba_penjualan($hari, $bulan, $tahun);
        $output = json_encode($output);
        echo $output;
    }

    public function download()
    {
        $post = $this->input->post();
        $hari = date('d', strtotime($post['tanggal']));
        $bulan = date('m', strtotime($post['tanggal']));
        $tahun = date('Y', strtotime($post['tanggal']));
        // echo $hari;
        // echo $bulan;
        // echo $tahun;
        $data = $this->modelLabaPenjualan->get_data_laba_penjualan($hari, $bulan, $tahun);

        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:F1'); // merge
        $sheet->mergeCells('A2:F2'); // merge
        $sheet->mergeCells('A4:F4'); // merge
        $sheet->setCellValue('A1', 'LAPORAN LABA PENJUALAN');
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
                'color' => array('rgb' => 'FF0000')
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
        $sheet->mergeCells('A' . $kolom . ':E'. $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'PENJUALAN');
        $sheet->setCellValue('F' . $kolom, $data['total_penjualan']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'DISKON PENJUALAN');
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('E' . $kolom, $data['potongan_penjualan']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'RETUR PENJUALAN');
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('E' . $kolom, $data['retur_penjualan']);
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':E'. $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'TOTAL PENJUALAN');
        $sheet->setCellValue('F' . $kolom, $data['penjualan_kotor']);
        $kolom++;
        $kolom++;
        $sheet->mergeCells('A' . $kolom . ':E'. $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom .  ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'HARGA POKOK PENJUALAN');
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'PERSEDIAAN AWAL');
        $sheet->setCellValue('D' . $kolom, $data['persediaan_awal']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'PEMBELIAN');
        $sheet->setCellValue('D' . $kolom, $data['total_pembelian']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'DISKON PEMBELIAN');
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('D' . $kolom, $data['potongan_pembelian']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'RETUR PEMBELIAN');
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('D' . $kolom, $data['retur_pembelian']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'PERSEDIAAN TERSEDIA DI JUAL');
        $sheet->setCellValue('E' . $kolom, $data['persediaan_tersedia']);
        $kolom++;
        $sheet->setCellValue('B' . $kolom, 'PERSEDIAAN AKHIR');
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)->applyFromArray($minus); // style bold
        $sheet->setCellValue('E' . $kolom, $data['persediaan_akhir']);
        $kolom++;
        $spreadsheet->getActiveSheet()->getStyle('B' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('B' . $kolom, 'HARGA POKOK PENJUALAN');
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)->applyFromArray($hpp); // style bold
        $sheet->setCellValue('F' . $kolom, $data['harga_pokok_penjualan']);
        $kolom++;
        $kolom++;

        $sheet->mergeCells('A' . $kolom . ':E' . $kolom); // merge
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray); // style bold
        $sheet->setCellValue('A' . $kolom, 'LABA / RUGI PENJUALAN');
        if($data['laba_penjualan'] < 0){
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)->applyFromArray($hpp); // style bold
            $sheet->setCellValue('F' . $kolom, $data['laba_penjualan']);
        }else{
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)->applyFromArray($styleArray); // style bold
            $sheet->setCellValue('F' . $kolom, $data['laba_penjualan']);
        }


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan laba penjualan ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
