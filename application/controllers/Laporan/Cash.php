<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Cash extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Keuangan/Model_Coh', 'modelCoh');
        $this->load->model('Manajemen_Keuangan/Model_Gaji', 'modelGaji');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function laporan_cash_kasir($id)
    {
        // $id = $this->input->post('id');
        // data master coh
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('id', $id);
        $data_coh = $this->db->get()->row_array();

        // data kasir
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $data_coh['user']);
        $data_kasir = $this->db->get()->row_array();

        // data spv
        $this->db->select('master_user.nama as nama_spv');
        $this->db->from('master_coh');
        $this->db->join('master_user','master_user.username = master_coh.user');
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi_spv']);
        $data_spv = $this->db->get()->row_array();
        $spv = $data_spv['nama_spv'];

        // data coh
        $this->db->select('*, DATE_FORMAT(tanggal_input, "%H:%i") as jam, DATE_FORMAT(tanggal_input, "%d %b %y") as tanggal');
        $this->db->from('detail_coh');
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $detail_coh = $this->db->get()->result_array();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:G1'); // merge
        $sheet->mergeCells('A2:C2'); // merge
        $sheet->mergeCells('A3:C3'); // merge
        $sheet->mergeCells('D2:G2'); // merge
        $sheet->mergeCells('D3:G3'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PENGGUNAAN DANA HARIAN');
        $sheet->setCellValue('A2', 'TANGGAL ');
        $sheet->setCellValue('A3', 'NAMA KASIR ');
        $sheet->setCellValue('D2', ': '. $this->tgl_indo(date("Y-m-d-D", strtotime($data_coh['tanggal_input']))));
        $sheet->setCellValue('D3', ': '. $data_kasir['nama']);

        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'TANGGAL');
        $sheet->setCellValue('C6', 'JAM');
        $sheet->setCellValue('D6', 'KAS MASUK');
        $sheet->setCellValue('E6', 'KAS KELUAR');
        $sheet->setCellValue('F6', 'SALDO AKHIR');
        $sheet->setCellValue('G6', 'KETERANGAN');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);


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

        $spreadsheet->getActiveSheet()->getStyle('D:F')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        foreach ($detail_coh as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['tanggal']);
            $sheet->setCellValue('C' . $kolom, $value['jam']);
            if($value['jenis'] == "1" || $value['jenis'] == "4"){
                $sheet->setCellValue('D' . $kolom, $value['nominal']);
            }else if($value['jenis'] == "2" || $value['jenis'] == "3"){
                $sheet->setCellValue('E' . $kolom, $value['nominal']);
            }
            $sheet->setCellValue('F' . $kolom, $value['saldo']);
            $sheet->setCellValue('G' . $kolom, $value['keterangan']);

            $spreadsheet->getActiveSheet()->getStyle('A6' . ':G6')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A6' . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C6' . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D6' . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E6' . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F6' . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G6' . ':G' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }

        // set jumlah pembayaran sumnya
        $kolom++;
        
        $sheet->mergeCells('F' . $kolom .':G' . $kolom); // merge
        $sheet->setCellValue('F' . $kolom, 'Mengetahui,');
        $sheet->getStyle('F' . $kolom)->getAlignment()->setHorizontal('center');
        $kolom++;
        $kolom++;
        $kolom++;
        $kolom++;
        $sheet->mergeCells('F' . $kolom .':G' . $kolom); // merge
        $sheet->setCellValue('F' . $kolom, $spv);
        $sheet->getStyle('F' . $kolom)->getAlignment()->setHorizontal('center');
        $kolom++;
        $sheet->mergeCells('F' . $kolom . ':G' . $kolom); // merge
        $sheet->setCellValue('F' . $kolom, 'Supervisor');
        $sheet->getStyle('F' . $kolom)->getAlignment()->setHorizontal('center');
        

        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan kas '.$data_kasir['nama'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($detail_coh);
        // echo $output;
    }

    public function laporan_cash_spv($id)
    {
        // $id = $this->input->post('id');
        // data master coh
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('id', $id);
        $data_coh = $this->db->get()->row_array();

        // data kasir
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $data_coh['user']);
        $data_kasir = $this->db->get()->row_array();

        // data spv
        $this->db->select('master_user.nama as nama_spv');
        $this->db->from('master_coh');
        $this->db->join('master_user', 'master_user.username = master_coh.user');
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi_spv']);
        $data_spv = $this->db->get()->row_array();
        $spv = $data_spv['nama_spv'];

        // data coh
        $this->db->select('*, DATE_FORMAT(tanggal_input, "%H:%i") as jam, DATE_FORMAT(tanggal_input, "%d %b %y") as tanggal');
        $this->db->from('detail_coh');
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $detail_coh = $this->db->get()->result_array();


        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:G1'); // merge
        $sheet->mergeCells('A2:C2'); // merge
        $sheet->mergeCells('A3:C3'); // merge
        $sheet->mergeCells('D2:G2'); // merge
        $sheet->mergeCells('D3:G3'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PENGGUNAAN DANA HARIAN');
        $sheet->setCellValue('A2', 'TANGGAL ');
        $sheet->setCellValue('A3', 'NAMA KASIR ');
        $sheet->setCellValue('D2', ': ' . $this->tgl_indo(date("Y-m-d-D", strtotime($data_coh['tanggal_input']))));
        $sheet->setCellValue('D3', ': ' . $data_kasir['nama']);

        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'TANGGAL');
        $sheet->setCellValue('C6', 'JAM');
        $sheet->setCellValue('D6', 'KAS MASUK');
        $sheet->setCellValue('E6', 'KAS KELUAR');
        $sheet->setCellValue('F6', 'SALDO AKHIR');
        $sheet->setCellValue('G6', 'KETERANGAN');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);


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

        $spreadsheet->getActiveSheet()->getStyle('D:F')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        foreach ($detail_coh as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['tanggal']);
            $sheet->setCellValue('C' . $kolom, $value['jam']);
            if ($value['jenis'] == "1" || $value['jenis'] == "4") {
                $sheet->setCellValue('D' . $kolom, $value['nominal']);
            } else if ($value['jenis'] == "2" || $value['jenis'] == "3") {
                $sheet->setCellValue('E' . $kolom, $value['nominal']);
            }
            $sheet->setCellValue('F' . $kolom, $value['saldo']);
            $sheet->setCellValue('G' . $kolom, $value['keterangan']);

            $spreadsheet->getActiveSheet()->getStyle('A6' . ':G6')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A6' . ':G' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C6' . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D6' . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E6' . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F6' . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('G6' . ':G' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }

        // set jumlah pembayaran sumnya
        $kolom++;

        $sheet->mergeCells('F' . $kolom . ':G' . $kolom); // merge
        $sheet->setCellValue('F' . $kolom, 'Mengetahui,');
        $sheet->getStyle('F' . $kolom)->getAlignment()->setHorizontal('center');
        $kolom++;
        $kolom++;
        $kolom++;
        $kolom++;
        $sheet->mergeCells('F' . $kolom . ':G' . $kolom); // merge
        $sheet->setCellValue('F' . $kolom, '(                                                       )');
        $sheet->getStyle('F' . $kolom)->getAlignment()->setHorizontal('center');
        $kolom++;
        $sheet->mergeCells('F' . $kolom . ':G' . $kolom); // merge
        $sheet->setCellValue('F' . $kolom, 'Manajer');
        $sheet->getStyle('F' . $kolom)->getAlignment()->setHorizontal('center');


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan kas ' . $data_kasir['nama'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($detail_coh);
        // echo $output;
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
}