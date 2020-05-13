<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Penjualan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laporan_Penjualan', 'modelLapPenjualan');
        $this->load->model('Setting/Model_Pusher', 'modelPusher');
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
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'laporan/penjualan/penjualan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/penjualan/penjualan', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('laporan/penjualan/penjualan_js');
        $this->load->view('template/template_app_js');
    }


    public function laporan_penjualan()
    {
        $post = $this->input->post();
        $tanggal = explode('-',$post['tanggal']);
        $jenis_data = $post['data'];
        
        switch ($jenis_data) {
            case '0':
                $data_penjualan = $this->modelLapPenjualan->data_penjualan($jenis_data, $tanggal);
                // $output = json_encode($data_penjualan);
                // echo $output;
                $this->laporan_detail($tanggal, $data_penjualan);
                break;
            case '1':
                $data_penjualan = $this->modelLapPenjualan->data_penjualan($jenis_data, $tanggal);
                $this->laporan_per_sales($tanggal, $data_penjualan);

                break;
        }
    }

    public function laporan_retur_penjualan()
    {
        $post = $this->input->post();
        $tanggal = explode('-', $post['tanggal']);
        $jenis_data = $post['data'];

        switch ($jenis_data) {
            case '0':
                $data_penjualan = $this->modelLapPenjualan->data_retur_penjualan($jenis_data, $tanggal);
                // $output = json_encode($data_penjualan);
                // echo $output;
                $this->laporan_detail_retur($tanggal, $data_penjualan);
                break;
        }
    }

    public function laporan_detail($tanggal, $data_penjualan)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $tanggal1 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[0])));
        $tanggal2 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[1])));
        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:L1'); // merge
        $sheet->mergeCells('A2:L2'); // merge
        $sheet->mergeCells('A5:L5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PENJUALAN');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PER TANGGAL : ' . $tanggal1 . ' - ' . $tanggal2);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('L')->setAutoSize(true);

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
            ]
        ];

        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'TANGGAL TRANSAKSI');
        $sheet->setCellValue('C6', 'NOMOR FAKTUR');
        $sheet->setCellValue('D6', 'NAMA PELANGGAN');
        $sheet->setCellValue('E6', 'TOTAL PENJUALAN');
        $sheet->setCellValue('F6', 'DISKON');
        $sheet->setCellValue('G6', 'PAJAK');
        $sheet->setCellValue('H6', 'ONGKOS KIRIM');
        $sheet->setCellValue('I6', 'GRAND TOTAL');
        $sheet->setCellValue('J6', 'SALES');
        $sheet->setCellValue('K6', 'KASIR / ADMIN');
        $sheet->setCellValue('L6', 'STATUS');
        $spreadsheet->getActiveSheet()->getStyle('E:I')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $spreadsheet->getActiveSheet()->getStyle('A6:L6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A6:A6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C6:C6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('E6:E6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('G6:G6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('H6:H6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('L6:L6')->applyFromArray($styleArray);

        $kolom = 7;
        $nomor = 1;

        foreach ($data_penjualan as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['tanggal_transaksi']);
            $sheet->setCellValue('C' . $kolom, $value['no_faktur']);
            $sheet->setCellValue('D' . $kolom, $value['nama_pelanggan']);
            $sheet->setCellValue('E' . $kolom, $value['total_penjualan']);
            $sheet->setCellValue('F' . $kolom, $value['diskon']);
            $sheet->setCellValue('G' . $kolom, $value['pajak']);
            $sheet->setCellValue('H' . $kolom, $value['ongkir']);
            $sheet->setCellValue('I' . $kolom, $value['grand_total']);
            $sheet->setCellValue('J' . $kolom, $value['sales']);
            $sheet->setCellValue('K' . $kolom, $value['kasir']);
            $sheet->setCellValue('L' . $kolom, $value['status']);

            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':L' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H' . $kolom  . ':H' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('I' . $kolom  . ':I' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('J' . $kolom  . ':J' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('K' . $kolom  . ':K' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('L' . $kolom  . ':L' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;

        }

        $kolom++;


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan penjualan';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    public function laporan_per_sales($tanggal, $data_per_sales)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $tanggal1 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[0])));
        $tanggal2 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[1])));
        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:K1'); // merge
        $sheet->mergeCells('A2:K2'); // merge
        $sheet->mergeCells('A5:K5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PENJUALAN');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PER TANGGAL : ' . $tanggal1 . ' - ' . $tanggal2);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);

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
            ]
        ];

        $kolom = 7;

        foreach ($data_per_sales as $key => $data) {

            $sheet->mergeCells('A'. $kolom .':B' . $kolom);
            $sheet->setCellValue('A' . $kolom, 'NAMA SALES');
            $sheet->setCellValue('C' . $kolom, $data['nama_sales']);
            $kolom++;

            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':K' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H' . $kolom  . ':H' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('I' . $kolom  . ':I' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('J' . $kolom  . ':J' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('K' . $kolom  . ':K' . $kolom)->applyFromArray($styleArray);

            // HEADER ISI
            $sheet->setCellValue('A' . $kolom, 'NO');
            $sheet->setCellValue('B' . $kolom, 'TANGGAL TRANSAKSI');
            $sheet->setCellValue('C' . $kolom, 'NOMOR FAKTUR');
            $sheet->setCellValue('D' . $kolom, 'NAMA PELANGGAN');
            $sheet->setCellValue('E' . $kolom, 'TOTAL PENJUALAN');
            $sheet->setCellValue('F' . $kolom, 'DISKON');
            $sheet->setCellValue('G' . $kolom, 'PAJAK');
            $sheet->setCellValue('H' . $kolom, 'ONGKOS KIRIM');
            $sheet->setCellValue('I' . $kolom, 'GRAND TOTAL');
            $sheet->setCellValue('J' . $kolom, 'KASIR / ADMIN');
            $sheet->setCellValue('K' . $kolom, 'STATUS');
            $spreadsheet->getActiveSheet()->getStyle('E:I')->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $nomor = 1;
            $kolom++;

            foreach ($data['data_penjualan'] as $key => $value) {

               

                if ($value['status'] == 0) {
                    $status = 'LUNAS';
                } else if ($value['status'] == 1) {
                    $status = 'KREDIT';
                }

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['tanggal_transaksi']);
            $sheet->setCellValue('C' . $kolom, $value['no_faktur']);
            $sheet->setCellValue('D' . $kolom, $value['nama_pelanggan']);
            $sheet->setCellValue('E' . $kolom, $value['total_penjualan']);
            $sheet->setCellValue('F' . $kolom, $value['diskon']);
            $sheet->setCellValue('G' . $kolom, $value['pajak_masukan']);
            $sheet->setCellValue('H' . $kolom, $value['ongkir']);
            $sheet->setCellValue('I' . $kolom, $value['grand_total']);
            $sheet->setCellValue('J' . $kolom, $value['nama_kasir']);
            $sheet->setCellValue('K' . $kolom, $status);
                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':K' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('H' . $kolom  . ':H' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('I' . $kolom  . ':I' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('J' . $kolom  . ':J' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('K' . $kolom  . ':K' . $kolom)->applyFromArray($styleArray);
            

            $kolom++;
            $nomor++;
        }
            $kolom++;

        }

       

        $kolom++;


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan penjualan';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    public function laporan_detail_retur($tanggal, $data_penjualan)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $tanggal1 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[0])));
        $tanggal2 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[1])));
        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:K1'); // merge
        $sheet->mergeCells('A2:K2'); // merge
        $sheet->mergeCells('A5:K5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN RETURN PENJUALAN');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PER TANGGAL : ' . $tanggal1 . ' - ' . $tanggal2);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);

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
            ]
        ];

        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'TANGGAL RETUR');
        $sheet->setCellValue('C6', 'NOMOR FAKTUR RETUR');
        $sheet->setCellValue('D6', 'TANGGAL TRANSAKSI');
        $sheet->setCellValue('E6', 'NOMOR FAKTUR');
        $sheet->setCellValue('F6', 'NAMA PELANGGAN');
        $sheet->setCellValue('G6', 'TOTAL PENJUALAN');
        $sheet->setCellValue('H6', 'DISKON');
        $sheet->setCellValue('I6', 'PAJAK');
        $sheet->setCellValue('J6', 'GRAND TOTAL');
        $sheet->setCellValue('K6', 'KASIR / ADMIN');
        $spreadsheet->getActiveSheet()->getStyle('G:J')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        $spreadsheet->getActiveSheet()->getStyle('A6:K6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A6:A6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C6:C6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('E6:E6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('G6:G6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('H6:H6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('J6:J6')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('K6:K6')->applyFromArray($styleArray);

        $kolom = 7;
        $nomor = 1;

        foreach ($data_penjualan as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['tanggal_retur']);
            $sheet->setCellValue('C' . $kolom, $value['no_faktur']);
            $sheet->setCellValue('D' . $kolom, $value['tanggal_transaksi']);
            $sheet->setCellValue('E' . $kolom, $value['no_faktur_asli']);
            $sheet->setCellValue('F' . $kolom, $value['nama_pelanggan']);
            $sheet->setCellValue('G' . $kolom, $value['total_penjualan']);
            $sheet->setCellValue('H' . $kolom, $value['diskon']);
            $sheet->setCellValue('I' . $kolom, $value['pajak']);
            $sheet->setCellValue('J' . $kolom, $value['grand_total']);
            $sheet->setCellValue('K' . $kolom, $value['kasir']);

            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':K' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H' . $kolom  . ':H' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('I' . $kolom  . ':I' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('J' . $kolom  . ':J' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('K' . $kolom  . ':K' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }

        $kolom++;


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan retur penjualan';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    function cek()
    {
        $post['tanggal'] = '2020-03-22';
        $post['data'] = 0;
        $data_penjualan = $this->modelLapPenjualan->data_penjualan($post);
        $output = json_encode($data_penjualan);
        echo $output;
       
    }
}