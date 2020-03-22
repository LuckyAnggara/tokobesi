<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Utangpiutang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laporan_Utang', 'modelLapUtang');
        $this->load->model('Laporan/Model_Laporan_Piutang', 'modelLapPiutang');
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
        $data['css'] = 'laporan/utang_piutang/utang_piutang_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/utang_piutang/utang_piutang', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('laporan/utang_piutang/utang_piutang_js');
        $this->load->view('template/template_app_js');
    }

    public function laporan_utang()
    {
        $post = $this->input->post();
        $jenis_data = $post['data'];
        $data_utang = $this->modelLapUtang->data_utang($post);

        switch ($jenis_data) {
            case '0':
                $this->laporan_utang_faktur($post, $data_utang);
                break;
            case '1':
                $this->laporan_utang_supplier($post, $data_utang);
                break;
            case '2':
                 $this->laporan_utang_detail($post, $data_utang);
                break;
        }  
    }

    public function laporan_piutang()
    {
        $post = $this->input->post();
        $jenis_data = $post['data'];
        $data_piutang = $this->modelLapPiutang->data_piutang($post);

        switch ($jenis_data) {
            case '0':
                $this->laporan_piutang_faktur($post, $data_piutang);
                break;
            case '1':
                $this->laporan_piutang_pelanggan($post, $data_piutang);
                break;
            case '2':
                $this->laporan_piutang_detail($post, $data_piutang);
                break;
        }
    }

    public function laporan_utang_faktur($post, $data_utang)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL
        $utang_kemarin = $this->modelLapUtang->utang_kemarin($post);
        $utang_hari_ini = $this->modelLapUtang->utang_hari_ini($post);
        $pembayaran_hari_ini = $this->modelLapUtang->pembayaran_hari_ini($post);

        $sheet->mergeCells('A1:H1'); // merge
        $sheet->mergeCells('A2:H2'); // merge
        $sheet->mergeCells('A5:G5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN UTANG DAGANG');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PENYAJIAN DATA PER TANGGAL : ' .$this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
        $sheet->setCellValue('H5', '(Rp.)');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'TANGGAL TRANSAKSI');
        $sheet->setCellValue('C6', 'NOMOR FAKTUR / INVOICE');
        $sheet->setCellValue('D6', 'NAMA SUPPLIER');
        $sheet->setCellValue('E6', 'TOTAL TAGIHAN');
        $sheet->setCellValue('F6', 'TOTAL PEMBAYARAN');
        $sheet->setCellValue('G6', 'SISA TAGIHAN');
        $sheet->setCellValue('H6', 'TANGGAL JATUH TEMPO');
        $spreadsheet->getActiveSheet()->getStyle('A6:H6')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A6:H6')
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A6:H6')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);


        $kolom = 7;
        $nomor = 1;

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

        // SET HEADER

        $spreadsheet->getActiveSheet()->getStyle('D:G')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        foreach ($data_utang as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['tanggal']);
            $sheet->setCellValue('C' . $kolom, $value['nomor_transaksi']);
            $sheet->setCellValue('D' . $kolom, $value['nama_supplier']);
            $sheet->setCellValue('E' . $kolom, $value['total_tagihan']);
            $sheet->setCellValue('F' . $kolom, $value['total_pembayaran']);
            $sheet->setCellValue('G' . $kolom, $value['sisa_utang']);
            $sheet->setCellValue('H' . $kolom, $value['tanggal_tempo']);

            $spreadsheet->getActiveSheet()->getStyle('A6' . ':H6')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A6' . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C6' . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D6' . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E6' . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F6' . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G6' . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H6' . ':H' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }
        $total_utang = 0;
        $total_pembayaran = 0;
        $sisa_utang = 0;
        foreach ($data_utang as $key => $value) {
            $total_utang = $total_utang + $value['total_tagihan'];
            $total_pembayaran = $total_pembayaran + $value['total_pembayaran'];
            $sisa_utang = $sisa_utang + $value['sisa_utang'];
        }

        $total = [
            'total_utang' => $total_utang,
            'total_pembayaran' => $total_pembayaran,
            'sisa_utang' => $sisa_utang,
        ];

        //set jumlah pembayaran sumnya
   
        // TOTAL
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('A' . $kolom, 'TOTAL');
        $sheet->getStyle('A' . $kolom)->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('E' . $kolom, $total['total_utang']);
        $sheet->setCellValue('F' . $kolom, $total['total_pembayaran']);
        $sheet->setCellValue('G' . $kolom, $total['sisa_utang']);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $kolom++;
        $kolom++;

        // DETAIL REQUEST AN
        $sheet->mergeCells('E' . $kolom . ':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'UTANG HARI KEMARIN');
        $sheet->setCellValue('G' . $kolom, $utang_kemarin);
        $kolom++;
        $sheet->mergeCells('E' . $kolom . ':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'UTANG HARI INI');
        $sheet->setCellValue('G' . $kolom, $utang_hari_ini);

        $kolom++;
        $sheet->setCellValue('G' . $kolom, $utang_kemarin + $utang_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        $kolom++;
        $sheet->mergeCells('E' . $kolom . ':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'PEMBAYARAN HARI INI');
        $sheet->setCellValue('G' . $kolom, $pembayaran_hari_ini);
        $kolom++;
        $sheet->mergeCells('E' . $kolom . ':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'TOTAL UTANG');
        $sheet->setCellValue('G' . $kolom, $utang_kemarin + $utang_hari_ini - $pembayaran_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan utang per faktur' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    public function laporan_utang_supplier($post, $data_utang)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL
        $utang_kemarin = $this->modelLapUtang->utang_kemarin($post);
        $utang_hari_ini = $this->modelLapUtang->utang_hari_ini($post);
        $pembayaran_hari_ini = $this->modelLapUtang->pembayaran_hari_ini($post);

        $sheet->mergeCells('A1:E1'); // merge
        $sheet->mergeCells('A2:E2'); // merge
        $sheet->mergeCells('A5:D5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN UTANG DAGANG');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PENYAJIAN DATA PER TANGGAL : ' . $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
        $sheet->setCellValue('E5', '(Rp.)');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E5')->getAlignment()->setHorizontal('right');

        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'NAMA SUPPLIER');
        $sheet->setCellValue('C6', 'TOTAL TAGIHAN');
        $sheet->setCellValue('D6', 'TOTAL PEMBAYARAN');
        $sheet->setCellValue('E6', 'SISA PEMBAYARAN');
        $spreadsheet->getActiveSheet()->getStyle('A6:E6')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A6:E6')
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A6:E6')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        $kolom = 7;
        $nomor = 1;

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

        // SET HEADER

        $spreadsheet->getActiveSheet()->getStyle('C:E')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        foreach ($data_utang as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['nama_supplier']);
            $sheet->setCellValue('C' . $kolom, $value['total_tagihan']);
            $sheet->setCellValue('D' . $kolom, $value['total_pembayaran']);
            $sheet->setCellValue('E' . $kolom, $value['sisa_utang']);


            $spreadsheet->getActiveSheet()->getStyle('A6' . ':E5')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A6' . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C6' . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D6' . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E6' . ':E' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }
        $total_utang = 0;
        $total_pembayaran = 0;
        $sisa_utang = 0;
        foreach ($data_utang as $key => $value) {
            $total_utang = $total_utang + $value['total_tagihan'];
            $total_pembayaran = $total_pembayaran + $value['total_pembayaran'];
            $sisa_utang = $sisa_utang + $value['sisa_utang'];
        }

        $total = [
            'total_utang' => $total_utang,
            'total_pembayaran' => $total_pembayaran,
            'sisa_utang' => $sisa_utang,
        ];

        //set jumlah pembayaran sumnya

        // TOTAL
        $sheet->mergeCells('A' . $kolom . ':B' . $kolom); // merge
        $sheet->setCellValue('A' . $kolom, 'TOTAL');
        $sheet->getStyle('A' . $kolom)->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('C' . $kolom, $total['total_utang']);
        $sheet->setCellValue('D' . $kolom, $total['total_pembayaran']);
        $sheet->setCellValue('E' . $kolom, $total['sisa_utang']);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $kolom++;
        $kolom++;

        // DETAIL REQUEST AN
        $sheet->mergeCells('C' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('C' . $kolom, 'UTANG HARI KEMARIN');
        $sheet->setCellValue('E' . $kolom, $utang_kemarin);
        $kolom++;
        $sheet->mergeCells('C' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('C' . $kolom, 'UTANG HARI INI');
        $sheet->setCellValue('E' . $kolom, $utang_hari_ini);

        $kolom++;
        $sheet->setCellValue('E' . $kolom, $utang_kemarin + $utang_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        $kolom++;
        $sheet->mergeCells('C' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('C' . $kolom, 'PEMBAYARAN HARI INI');
        $sheet->setCellValue('E' . $kolom, $pembayaran_hari_ini);
        $kolom++;
        $sheet->mergeCells('C' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('C' . $kolom, 'TOTAL UTANG');
        $sheet->setCellValue('E' . $kolom, $utang_kemarin + $utang_hari_ini - $pembayaran_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan utang per supplier ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    public function laporan_utang_detail($post, $data_utang)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL
        $utang_kemarin = $this->modelLapUtang->utang_kemarin($post);
        $utang_hari_ini = $this->modelLapUtang->utang_hari_ini($post);
        $pembayaran_hari_ini = $this->modelLapUtang->pembayaran_hari_ini($post);

        $sheet->mergeCells('A1:G1'); // merge
        $sheet->mergeCells('A2:G2'); // merge
        $sheet->mergeCells('A5:G5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN UTANG DAGANG');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PENYAJIAN DATA PER TANGGAL : ' . $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
        $sheet->setCellValue('G5', '(Rp.)');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

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
        foreach ($data_utang as $key => $value) {
            $spreadsheet->getActiveSheet()->getStyle('D:F')->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $sheet->mergeCells('A' . $kolom . ':B' . $kolom); // merge
            $sheet->setCellValue('A' . $kolom, 'KODE SUPPLIER');
            $sheet->setCellValue('C' . $kolom, ': '.$value['kode_supplier']);
            $sheet->setCellValue('D' . $kolom, 'TOTAL TAGIHAN');
            $sheet->setCellValue('E' . $kolom, $value['total_tagihan']);
            $sheet->setCellValue('F' . $kolom, 'SISA UTANG');
            $sheet->setCellValue('G' . $kolom, $value['sisa_utang']);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $kolom++;

            $sheet->mergeCells('A' . $kolom . ':B' . $kolom); // merge
            $sheet->setCellValue('A' . $kolom, 'NAMA SUPPLIER');
            $sheet->setCellValue('C' . $kolom, ': ' . $value['nama_supplier']);
            $sheet->setCellValue('D' . $kolom, 'TOTAL PEMBAYARAN');
            $sheet->setCellValue('E' . $kolom, $value['total_pembayaran']);

            $kolom++;

            $sheet->setCellValue('A' . $kolom, 'NO');
            $sheet->setCellValue('B' . $kolom, 'TANGGAL TRANSAKSI');
            $sheet->setCellValue('C' . $kolom, 'NOMOR FAKTUR / INVOICE');
            $sheet->setCellValue('D' . $kolom, 'TOTAL TAGIHAN');
            $sheet->setCellValue('E' . $kolom, 'TOTAL PEMBAYARAN');
            $sheet->setCellValue('F' . $kolom, 'SISA TAGIHAN');
            $sheet->setCellValue('G' . $kolom, 'TANGGAL JATUH TEMPO');
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);

            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
                ->getFill()->getStartColor()->setARGB('FF16F900');
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
                ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
            $kolom++;
            $nomor = 1;

            foreach ($value['data_faktur'] as $key => $data_faktur) {

                $sheet->setCellValue('A' . $kolom, $nomor);
                $sheet->setCellValue('B' . $kolom, $data_faktur['tanggal_transaksi']);
                $sheet->setCellValue('C' . $kolom, $data_faktur['nomor_transaksi']);
                $sheet->setCellValue('D' . $kolom, $data_faktur['total_tagihan']);
                $sheet->setCellValue('E' . $kolom, $data_faktur['total_pembayaran']);
                $sheet->setCellValue('F' . $kolom, $data_faktur['sisa_utang']);
                $sheet->setCellValue('G' . $kolom, $data_faktur['tanggal_tempo']);

                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('F' . $kolom  . ':F' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('G' . $kolom  . ':G' . $kolom)->applyFromArray($styleArray);

                $kolom++;
                $nomor++;
            }
            
            $sheet->mergeCells('A' . $kolom . ':C' . $kolom); // merge
            $sheet->setCellValue('A' . $kolom, 'TOTAL');
            $sheet->getStyle('A' . $kolom)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('D' . $kolom, $value['total_tagihan']);
            $sheet->setCellValue('E' . $kolom, $value['total_pembayaran']);
            $sheet->setCellValue('F' . $kolom, $value['sisa_utang']);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)
                ->getFill()->getStartColor()->setARGB('FF16F900');
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)
                ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

            $kolom++;
            $kolom++;

        }

        $kolom++;

        // DETAIL REQUEST AN
        $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        $sheet->setCellValue('D' . $kolom, 'UTANG HARI KEMARIN');
        $sheet->setCellValue('F' . $kolom, $utang_kemarin);
        $kolom++;
        $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        $sheet->setCellValue('D' . $kolom, 'UTANG HARI INI');
        $sheet->setCellValue('F' . $kolom, $utang_hari_ini);

        $kolom++;
        $sheet->setCellValue('F' . $kolom, $utang_kemarin + $utang_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        $kolom++;
        $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        $sheet->setCellValue('D' . $kolom, 'PEMBAYARAN HARI INI');
        $sheet->setCellValue('F' . $kolom, $pembayaran_hari_ini);
        $kolom++;
        $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        $sheet->setCellValue('D' . $kolom, 'TOTAL UTANG');
        $sheet->setCellValue('F' . $kolom, $utang_kemarin + $utang_hari_ini - $pembayaran_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan detail utang ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    public function laporan_piutang_faktur($post, $data_piutang)
    {

        
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL
        $piutang_kemarin = $this->modelLapPiutang->piutang_kemarin($post);
        $piutang_hari_ini = $this->modelLapPiutang->piutang_hari_ini($post);
        $pembayaran_hari_ini = $this->modelLapPiutang->pembayaran_hari_ini($post);

        $sheet->mergeCells('A1:H1'); // merge
        $sheet->mergeCells('A2:H2'); // merge
        $sheet->mergeCells('A5:G5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN UTANG DAGANG');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PENYAJIAN DATA PER TANGGAL : ' . $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
        $sheet->setCellValue('H5', '(Rp.)');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'TANGGAL TRANSAKSI');
        $sheet->setCellValue('C6', 'NOMOR FAKTUR / INVOICE');
        $sheet->setCellValue('D6', 'NAMA PELANGGAN');
        $sheet->setCellValue('E6', 'TOTAL TAGIHAN');
        $sheet->setCellValue('F6', 'TOTAL PEMBAYARAN');
        $sheet->setCellValue('G6', 'SISA TAGIHAN');
        $sheet->setCellValue('H6', 'TANGGAL JATUH TEMPO');
        $spreadsheet->getActiveSheet()->getStyle('A6:H6')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A6:H6')
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A6:H6')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);


        $kolom = 7;
        $nomor = 1;

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

        // SET HEADER

        $spreadsheet->getActiveSheet()->getStyle('D:G')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        foreach ($data_piutang as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['tanggal']);
            $sheet->setCellValue('C' . $kolom, $value['no_faktur']);
            $sheet->setCellValue('D' . $kolom, $value['nama_pelanggan']);
            $sheet->setCellValue('E' . $kolom, $value['total_tagihan']);
            $sheet->setCellValue('F' . $kolom, $value['total_pembayaran']);
            $sheet->setCellValue('G' . $kolom, $value['sisa_piutang']);
            $sheet->setCellValue('H' . $kolom, $value['tanggal_tempo']);

            $spreadsheet->getActiveSheet()->getStyle('A6' . ':H6')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A6' . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C6' . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D6' . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E6' . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F6' . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G6' . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H6' . ':H' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }
        $total_piutang = 0;
        $total_pembayaran = 0;
        $sisa_piutang = 0;
        foreach ($data_piutang as $key => $value) {
            $total_piutang = $total_piutang + $value['total_tagihan'];
            $total_pembayaran = $total_pembayaran + $value['total_pembayaran'];
            $sisa_piutang = $sisa_piutang + $value['sisa_piutang'];
        }

        $total = [
            'total_piutang' => $total_piutang,
            'total_pembayaran' => $total_pembayaran,
            'sisa_piutang' => $sisa_piutang,
        ];

        //set jumlah pembayaran sumnya

        // TOTAL
        $sheet->mergeCells('A' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('A' . $kolom, 'TOTAL');
        $sheet->getStyle('A' . $kolom)->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('E' . $kolom, $total['total_piutang']);
        $sheet->setCellValue('F' . $kolom, $total['total_pembayaran']);
        $sheet->setCellValue('G' . $kolom, $total['sisa_piutang']);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $kolom++;
        $kolom++;

        // DETAIL REQUEST AN
        $sheet->mergeCells('E' . $kolom . ':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'PIUTANG HARI KEMARIN');
        $sheet->setCellValue('G' . $kolom, $piutang_kemarin);
        $kolom++;
        $sheet->mergeCells('E' . $kolom . ':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'PIUTANG HARI INI');
        $sheet->setCellValue('G' . $kolom, $piutang_hari_ini);

        $kolom++;
        $sheet->setCellValue('G' . $kolom, $piutang_kemarin + $piutang_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        $kolom++;
        $sheet->mergeCells('E' . $kolom . ':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'PEMBAYARAN HARI INI');
        $sheet->setCellValue('G' . $kolom, $pembayaran_hari_ini);
        $kolom++;
        $sheet->mergeCells('E' . $kolom . ':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'TOTAL PIUTANG');
        $sheet->setCellValue('G' . $kolom, $piutang_kemarin + $piutang_hari_ini - $pembayaran_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan piutang per faktur ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    public function laporan_piutang_pelanggan($post, $data_piutang)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL
        $piutang_kemarin = $this->modelLapPiutang->piutang_kemarin($post);
        $piutang_hari_ini = $this->modelLapPiutang->piutang_hari_ini($post);
        $pembayaran_hari_ini = $this->modelLapPiutang->pembayaran_hari_ini($post);

        $sheet->mergeCells('A1:E1'); // merge
        $sheet->mergeCells('A2:E2'); // merge
        $sheet->mergeCells('A5:D5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PIUTANG DAGANG');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PENYAJIAN DATA PER TANGGAL : ' . $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
        $sheet->setCellValue('E5', '(Rp.)');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('E5')->getAlignment()->setHorizontal('right');

        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'NAMA PELANGGAN');
        $sheet->setCellValue('C6', 'TOTAL TAGIHAN');
        $sheet->setCellValue('D6', 'TOTAL PEMBAYARAN');
        $sheet->setCellValue('E6', 'SISA PEMBAYARAN');
        $spreadsheet->getActiveSheet()->getStyle('A6:E6')
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A6:E6')
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A6:E6')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);

        $kolom = 7;
        $nomor = 1;

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

        // SET HEADER

        $spreadsheet->getActiveSheet()->getStyle('C:E')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        foreach ($data_piutang as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['nama_pelanggan']);
            $sheet->setCellValue('C' . $kolom, $value['total_tagihan']);
            $sheet->setCellValue('D' . $kolom, $value['total_pembayaran']);
            $sheet->setCellValue('E' . $kolom, $value['sisa_piutang']);


            $spreadsheet->getActiveSheet()->getStyle('A6' . ':E5')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A6' . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C6' . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D6' . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E6' . ':E' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }
        $total_piutang = 0;
        $total_pembayaran = 0;
        $sisa_piutang = 0;
        foreach ($data_piutang as $key => $value) {
            $total_piutang = $total_piutang + $value['total_tagihan'];
            $total_pembayaran = $total_pembayaran + $value['total_pembayaran'];
            $sisa_piutang = $sisa_piutang + $value['sisa_piutang'];
        }

        $total = [
            'total_piutang' => $total_piutang,
            'total_pembayaran' => $total_pembayaran,
            'sisa_piutang' => $sisa_piutang,
        ];

        //set jumlah pembayaran sumnya

        // TOTAL
        $sheet->mergeCells('A' . $kolom . ':B' . $kolom); // merge
        $sheet->setCellValue('A' . $kolom, 'TOTAL');
        $sheet->getStyle('A' . $kolom)->getAlignment()->setHorizontal('center');
        $sheet->setCellValue('C' . $kolom, $total['total_piutang']);
        $sheet->setCellValue('D' . $kolom, $total['total_pembayaran']);
        $sheet->setCellValue('E' . $kolom, $total['sisa_piutang']);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

        $kolom++;
        $kolom++;

        // DETAIL REQUEST AN
        $sheet->mergeCells('C' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('C' . $kolom, 'PIUTANG HARI KEMARIN');
        $sheet->setCellValue('E' . $kolom, $piutang_kemarin);
        $kolom++;
        $sheet->mergeCells('C' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('C' . $kolom, 'PIUTANG HARI INI');
        $sheet->setCellValue('E' . $kolom, $piutang_hari_ini);

        $kolom++;
        $sheet->setCellValue('E' . $kolom, $piutang_kemarin + $piutang_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        $kolom++;
        $sheet->mergeCells('C' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('C' . $kolom, 'PEMBAYARAN HARI INI');
        $sheet->setCellValue('E' . $kolom, $pembayaran_hari_ini);
        $kolom++;
        $sheet->mergeCells('C' . $kolom . ':D' . $kolom); // merge
        $sheet->setCellValue('C' . $kolom, 'TOTAL PIUTANG');
        $sheet->setCellValue('E' . $kolom, $piutang_kemarin + $piutang_hari_ini - $pembayaran_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan piutang per supplier ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    public function laporan_piutang_detail($post, $data_piutang)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL
        $piutang_kemarin = $this->modelLapPiutang->piutang_kemarin($post);
        $piutang_hari_ini = $this->modelLapPiutang->piutang_hari_ini($post);
        $pembayaran_hari_ini = $this->modelLapPiutang->pembayaran_hari_ini($post);

        $sheet->mergeCells('A1:G1'); // merge
        $sheet->mergeCells('A2:G2'); // merge
        $sheet->mergeCells('A5:G5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PIUTANG DAGANG');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'PENYAJIAN DATA PER TANGGAL : ' . $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
        $sheet->setCellValue('G5', '(Rp.)');
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

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
        foreach ($data_piutang as $key => $value) {
            $spreadsheet->getActiveSheet()->getStyle('D:F')->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $sheet->mergeCells('A' . $kolom . ':B' . $kolom); // merge
            $sheet->setCellValue('A' . $kolom, 'ID PELANGGAN');
            $sheet->setCellValue('C' . $kolom, ': ' . $value['id_pelanggan']);
            $sheet->setCellValue('D' . $kolom, 'TOTAL TAGIHAN');
            $sheet->setCellValue('E' . $kolom, $value['total_tagihan']);
            $sheet->setCellValue('F' . $kolom, 'SISA PIUTANG');
            $sheet->setCellValue('G' . $kolom, $value['sisa_piutang']);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $kolom++;

            $sheet->mergeCells('A' . $kolom . ':B' . $kolom); // merge
            $sheet->setCellValue('A' . $kolom, 'NAMA PELANGGAN');
            $sheet->setCellValue('C' . $kolom, ': ' . $value['nama_pelanggan']);
            $sheet->setCellValue('D' . $kolom, 'TOTAL PEMBAYARAN');
            $sheet->setCellValue('E' . $kolom, $value['total_pembayaran']);

            $kolom++;

            $sheet->setCellValue('A' . $kolom, 'NO');
            $sheet->setCellValue('B' . $kolom, 'TANGGAL TRANSAKSI');
            $sheet->setCellValue('C' . $kolom, 'NOMOR FAKTUR / INVOICE');
            $sheet->setCellValue('D' . $kolom, 'TOTAL TAGIHAN');
            $sheet->setCellValue('E' . $kolom, 'TOTAL PEMBAYARAN');
            $sheet->setCellValue('F' . $kolom, 'SISA TAGIHAN');
            $sheet->setCellValue('G' . $kolom, 'TANGGAL JATUH TEMPO');
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom . ':G' . $kolom)->applyFromArray($styleArray);

            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
                ->getFill()->getStartColor()->setARGB('FF16F900');
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)
                ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
            $kolom++;
            $nomor = 1;

            foreach ($value['data_faktur'] as $key => $data_faktur) {

                $sheet->setCellValue('A' . $kolom, $nomor);
                $sheet->setCellValue('B' . $kolom, $data_faktur['tanggal_transaksi']);
                $sheet->setCellValue('C' . $kolom, $data_faktur['no_faktur']);
                $sheet->setCellValue('D' . $kolom, $data_faktur['total_tagihan']);
                $sheet->setCellValue('E' . $kolom, $data_faktur['total_pembayaran']);
                $sheet->setCellValue('F' . $kolom, $data_faktur['sisa_piutang']);
                $sheet->setCellValue('G' . $kolom, $data_faktur['tanggal_tempo']);

                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':G' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('B' . $kolom . ':B' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('C' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('D' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('E' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('F' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);
                $spreadsheet->getActiveSheet()->getStyle('G' . $kolom . ':G' . $kolom)->applyFromArray($styleArray);

                $kolom++;
                $nomor++;
            }

            $sheet->mergeCells('A' . $kolom . ':C' . $kolom); // merge
            $sheet->setCellValue('A' . $kolom, 'TOTAL');
            $sheet->getStyle('A' . $kolom)->getAlignment()->setHorizontal('center');
            $sheet->setCellValue('D' . $kolom, $value['total_tagihan']);
            $sheet->setCellValue('E' . $kolom, $value['total_pembayaran']);
            $sheet->setCellValue('F' . $kolom, $value['sisa_piutang']);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)
                ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)
                ->getFill()->getStartColor()->setARGB('FF16F900');
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':F' . $kolom)
                ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);

            $kolom++;
            $kolom++;
        }

        $kolom++;

        // DETAIL REQUEST AN
        $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        $sheet->setCellValue('D' . $kolom, 'PIUTANG HARI KEMARIN');
        $sheet->setCellValue('F' . $kolom, $piutang_kemarin);
        $kolom++;
        $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        $sheet->setCellValue('D' . $kolom, 'PIUTANG HARI INI');
        $sheet->setCellValue('F' . $kolom, $piutang_hari_ini);

        $kolom++;
        $sheet->setCellValue('F' . $kolom, $piutang_kemarin + $piutang_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        $kolom++;
        $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        $sheet->setCellValue('D' . $kolom, 'PEMBAYARAN HARI INI');
        $sheet->setCellValue('F' . $kolom, $pembayaran_hari_ini);
        $kolom++;
        $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        $sheet->setCellValue('D' . $kolom, 'TOTAL PIUTANG');
        $sheet->setCellValue('F' . $kolom, $piutang_kemarin + $piutang_hari_ini - $pembayaran_hari_ini);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan detail piutang ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    

    

   

    function cek()
    {
        $post['tanggal'] = '2020-03-19';
        $data_utang = $this->modelLapUtang->utang_kemarin($post);

        $output = json_encode($data_utang);
        echo $output;
    }
}