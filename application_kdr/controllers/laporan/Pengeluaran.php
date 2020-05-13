<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pengeluaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laba', 'modelLaba');
        $this->load->model('Laporan/Model_Pengeluaran', 'modelPengeluaran');
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
        $data['css'] = 'laporan/pengeluaran/pengeluaran_css';

        $data['periode'] = $this->modelPeriode->get_data_periode();

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/pengeluaran/pengeluaran', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('laporan/pengeluaran/pengeluaran_js');
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
        $data['kategori_biaya'] = $this->modelLaba->beban_operasional_usaha($hari, $bulan, $tahun, $periode);
        $data['total_beban_operasional'] = $this->modelLaba->total_beban_operasional($hari, $bulan, $tahun, $periode);
        $data['beban_gaji'] = $this->modelLaba->beban_gaji($hari, $bulan, $tahun, $periode);
        $data['total_beban_gaji'] = $this->modelLaba->total_beban_gaji($hari, $bulan, $tahun, $periode);
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
        $sheet->setCellValue('A1', 'LAPORAN PENGELUARAN USAHA');
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

        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan laba penjualan ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function data_laporan_harian()
    {
        $post = $this->input->post();
        $tanggal = explode('-', $post['tanggal']);
        $periode = $post['periode'];
        $data_biaya = $this->modelPengeluaran->data_harian($tanggal, $periode);
        $data_gaji = $this->modelPengeluaran->data_gaji($tanggal, $periode);
        $this->download_laporan_harian($tanggal, $data_biaya, $data_gaji);
    }

    public function download_laporan_harian($tanggal, $data_biaya, $data_gaji)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $tanggal1 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[0])));
        $tanggal2 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[1])));
        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:F1'); // merge
        $sheet->mergeCells('A2:F2'); // merge
        $sheet->mergeCells('A4:F4'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PENGELUARAN');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A4', 'PER TANGGAL : ' . $tanggal1 . ' - ' . $tanggal2);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);

        $styleArray = [
            'borders' => [
                'top' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'bottom' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'right' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
                'left' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                ],
            ],
        ];

        $kolom = 6;

        foreach ($data_biaya as $key => $data) {
            $spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $sheet->mergeCells('A' . $kolom . ':C' . $kolom);
            $sheet->setCellValue('D' . $kolom, $data['nama_biaya']);
            $sheet->setCellValue('A' . $kolom, 'NAMA BIAYA');
            $sheet->mergeCells('D' . $kolom . ':F' . $kolom);
            $kolom++;
            $sheet->mergeCells('A' . $kolom . ':C' . $kolom);
            $sheet->mergeCells('D' . $kolom . ':F' . $kolom);
            $sheet->setCellValue('A' . $kolom, 'SALDO BIAYA');
            $sheet->setCellValue('D' . $kolom, $data['total']);
            $kolom++;
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);

            // HEADER ISI
            $sheet->setCellValue('A' . $kolom, 'NO');
            $sheet->setCellValue('B' . $kolom, 'TANGGAL');
            $sheet->setCellValue('C' . $kolom, 'NOMOR JURNAL');
            $sheet->setCellValue('D' . $kolom, 'TOTAL BIAYA');
            $sheet->setCellValue('E' . $kolom, 'KETERANGAN');
            $sheet->setCellValue('F' . $kolom, 'PEMUTUS');

            $kolom++;
            $nomor = 1;

            foreach ($data['detail_data'] as $key => $value) {

                $sheet->setCellValue('A' . $kolom, $nomor);
                $sheet->setCellValue('B' . $kolom, $value['tanggal']);
                $sheet->setCellValue('C' . $kolom, $value['nomor_jurnal']);
                $sheet->setCellValue('D' . $kolom, $value['total']);
                $sheet->setCellValue('E' . $kolom, $value['keterangan']);
                $sheet->setCellValue('F' . $kolom, $value['nama_pegawai']);
                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('B' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('D' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('E' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('F' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);

                $kolom++;
                $nomor++;
            }
            $kolom++;
        }
        $kolom++;
        $spreadsheet->getActiveSheet()->getStyle('C')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $sheet->mergeCells('A' . $kolom . ':C' . $kolom);
        $sheet->setCellValue('A' . $kolom, 'GAJI PEGAWAI');
        $kolom++;
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('B' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);

        $sheet->mergeCells('A' . $kolom . ':B' . $kolom);
        $sheet->setCellValue('A' . $kolom, 'KOMPONEN');
        $sheet->setCellValue('C' . $kolom, 'TOTAL');
        $kolom++;
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('B' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $sheet->mergeCells('A' . $kolom . ':B' . $kolom);
        $sheet->setCellValue('A' . $kolom, 'GAJI POKOK');
        $sheet->setCellValue('C' . $kolom, $data_gaji['gaji_pokok']);
        $kolom++;
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('B' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $sheet->mergeCells('A' . $kolom . ':B' . $kolom);
        $sheet->setCellValue('A' . $kolom, 'UANG MAKAN');
        $sheet->setCellValue('C' . $kolom, $data_gaji['uang_makan']);
        $kolom++;
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('B' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $sheet->mergeCells('A' . $kolom . ':B' . $kolom);
        $sheet->setCellValue('A' . $kolom, 'BONUS');
        $sheet->setCellValue('C' . $kolom, $data_gaji['bonus']);

        $kolom++;
        $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $sheet->setCellValue('C' . $kolom, $data_gaji['total']);

        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan beban usaha';

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
}
