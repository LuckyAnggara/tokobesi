<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Sales extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laporan_Sales', 'modelLapSales');
		$this->load->model('Dashboard/Model_Dashboard', 'modelDashboard');
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
        $data['sales'] = $this->modelDashboard->getDataSales();
        $data['menu'] = $this->modelSetting->data_menu();
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['css'] = 'laporan/sales/sales_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/sales/sales', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('laporan/sales/sales_js');
        $this->load->view('template/template_app_js');
    }


    public function laporan_penjualan()
    {
        $post = $this->input->post();
        $tanggal = explode('-',$post['tanggal']);
        $jenis_data = $post['data'];
        
        switch ($jenis_data) {
            case '0':
                $data_penjualan = $this->modelLapSales->data_penjualan($jenis_data, $tanggal);
                $this->laporan_piutang_per_sales($tanggal, $data_penjualan);

                // $output = json_encode($data_penjualan);
                // echo $output;
                // $this->laporan_detail($tanggal, $data_penjualan);
                break;
            case '1':
                $data_penjualan = $this->modelLapSales->data_penjualan($jenis_data, $tanggal);
                $this->laporan_penjualan_per_sales($tanggal, $data_penjualan);
                // echo $output;
                // $this->laporan_detail($tanggal, $data_penjualan);
                break;
        }
    }

    public function laporan_penjualan_per_sales($tanggal, $data_penjualan_per_sales)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();
       
        $tanggal1 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[0])));
        $tanggal2 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[1])));
        // SET HEADER
        // SET JUDUL

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
        $spreadsheet = new Spreadsheet();

        foreach ($data_penjualan_per_sales as $key => $data) {

            $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $data['nama_sales']);
            // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
            $spreadsheet->addSheet($myWorkSheet, $key);
            
            $sheet = $spreadsheet->getSheet($key);

            $sheet->mergeCells('A1:K1'); // merge
            $sheet->mergeCells('A2:K2'); // merge
            $sheet->mergeCells('A4:K4'); // merge
            $sheet->setCellValue('A1', 'LAPORAN PENJUALAN PER SALES '.$data['nama_sales']);
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
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);
            $sheet->getColumnDimension('I')->setAutoSize(true);
            $sheet->getColumnDimension('J')->setAutoSize(true);
            $sheet->getColumnDimension('K')->setAutoSize(true);

            
        
            $kolom = 5;
            $nomor = 1;
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
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':K' . $kolom)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':K' . $kolom)
                ->getFill()->getStartColor()->setARGB('FF0000000');
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':K' . $kolom)
                ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $kolom++;


            foreach ($data['data_penjualan'] as $key => $value) {
                if ($value['status_bayar'] == 1) {
                    $status = 'LUNAS';
                } else {
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
        }
    

        $sheetIndex = $spreadsheet->getIndex($spreadsheet->getSheetByName('Worksheet'));
        $spreadsheet->removeSheetByIndex($sheetIndex);

        $writer = new Xlsx($spreadsheet);

        $filename = 'Laporan Sales';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function laporan_piutang_per_sales($tanggal, $data_piutang_per_sales)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $tanggal1 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[0])));
        $tanggal2 = $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal[1])));
        // SET HEADER
        // SET JUDUL

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
        $spreadsheet = new Spreadsheet();

        foreach ($data_piutang_per_sales as $key => $data) {

            $myWorkSheet = new \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet($spreadsheet, $data['nama_sales']);
            // Attach the "My Data" worksheet as the first worksheet in the Spreadsheet object
            $spreadsheet->addSheet($myWorkSheet, $key);

            $sheet = $spreadsheet->getSheet($key);

            $sheet->mergeCells('A1:H1'); // merge
            $sheet->mergeCells('A2:H2'); // merge
            $sheet->mergeCells('A4:H4'); // merge
            $sheet->setCellValue('A1', 'LAPORAN PIUTANG SALES ' . $data['nama_sales']);
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
            $sheet->getColumnDimension('G')->setAutoSize(true);
            $sheet->getColumnDimension('H')->setAutoSize(true);



            $kolom = 5;
            $nomor = 1;
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':H' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H' . $kolom  . ':H' . $kolom)->applyFromArray($styleArray);

            // HEADER ISI
            $sheet->setCellValue('A' . $kolom, 'NO');
            $sheet->setCellValue('B' . $kolom, 'TANGGAL TRANSAKSI');
            $sheet->setCellValue('C' . $kolom, 'NOMOR FAKTUR');
            $sheet->setCellValue('D' . $kolom, 'NAMA PELANGGAN');
            $sheet->setCellValue('E' . $kolom, 'TOTAL PENJUALAN');
            $sheet->setCellValue('F' . $kolom, 'TOTAL PEMBAYARAN');
            $sheet->setCellValue('G' . $kolom, 'SISA PIUTANG');
            $sheet->setCellValue('H' . $kolom, 'KETERANGAN');
            $spreadsheet->getActiveSheet()->getStyle('E:G')->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':H' . $kolom)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':H' . $kolom)
                ->getFill()->getStartColor()->setARGB('FF0000000');
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':H' . $kolom)
                ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $kolom++;


            foreach ($data['data_piutang'] as $key => $value) {
                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':H' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('H' . $kolom  . ':H' . $kolom)->applyFromArray($styleArray);

                $sheet->setCellValue('A' . $kolom, $nomor);
                $sheet->setCellValue('B' . $kolom, $value['tanggal_transaksi']);
                $sheet->setCellValue('C' . $kolom, $value['no_faktur']);
                $sheet->setCellValue('D' . $kolom, $value['nama_pelanggan']);
                $sheet->setCellValue('E' . $kolom, $value['total_penjualan']);
                $sheet->setCellValue('F' . $kolom, $value['total_pembayaran']);
                $sheet->setCellValue('G' . $kolom, $value['sisa_piutang']);
                
                foreach ($value['detail_pembayaran'] as $key => $detail_pembayaran) {
                    $kolom++;
                    $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':H' . $kolom)->applyFromArray($styleArray);
                    $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
                    $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
                    $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
                    $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
                    $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
                    $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
                    $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);
                    $spreadsheet->getActiveSheet()->getStyle('H' . $kolom  . ':H' . $kolom)->applyFromArray($styleArray);
                
                    $spreadsheet->getActiveSheet()->getStyle('F' . $kolom . ':F' . $kolom)
                        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $spreadsheet->getActiveSheet()->getStyle('F' . $kolom . ':F' . $kolom)
                        ->getFill()->getStartColor()->setARGB('FFFFFF00');
                    $spreadsheet->getActiveSheet()->getStyle('F' . $kolom . ':F' . $kolom)
                        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
                    $spreadsheet->getActiveSheet()->getStyle('H' . $kolom . ':H' . $kolom)
                        ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
                    $spreadsheet->getActiveSheet()->getStyle('H' . $kolom . ':H' . $kolom)
                        ->getFill()->getStartColor()->setARGB('FFFFFF00');
                    $spreadsheet->getActiveSheet()->getStyle('H' . $kolom . ':H' . $kolom)
                        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

                    $sheet->setCellValue('F' . $kolom, $detail_pembayaran['nominal_pembayaran']);
                    $sheet->setCellValue('H' . $kolom, 'Pembayaran Tanggal : ' . $detail_pembayaran['tanggal'] . ' - ' .$detail_pembayaran['keterangan']);
                }
                $kolom++;
                $nomor++;
            }
        }


        $sheetIndex = $spreadsheet->getIndex($spreadsheet->getSheetByName('Worksheet'));
        $spreadsheet->removeSheetByIndex($sheetIndex);

        $writer = new Xlsx($spreadsheet);

        $filename = 'Laporan Sales';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }



    function cek()
    {
        $post['tanggal'] = '2020-03-22';
        $post['data'] = 0;
        $data_penjualan = $this->modelLapSales->data_penjualan($post);
        $output = json_encode($data_penjualan);
        echo $output;
       
    }
}