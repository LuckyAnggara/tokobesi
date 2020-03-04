<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Keuangan/Model_Biaya', 'modelBiaya');
        $this->load->model('Manajemen_Keuangan/Model_Gaji', 'modelGaji');
        $this->load->model('manajemen_persediaan/Model_Master_Persediaan', 'modelMasterPersediaan');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }
    public function StokOpname($no_ref)
    {
        $database = $this->modelMasterPersediaan->getDataStokOpname($no_ref);
        $dataBarang = $database->result_array();
        $output = array();

        foreach ($dataBarang as $key => $value) {

            $data_barang = $this->modelMasterPersediaan->dataBarang($value['kode_barang']);

            $value['data_barang'] = $data_barang;

            $output[] = $value;
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Kode Barang');
        $sheet->setCellValue('C1', 'Nama Barang');
        $sheet->setCellValue('D1', 'Satuan');
        $sheet->setCellValue('E1', 'Saldo (Buku)');
        $sheet->setCellValue('F1', 'Saldo (Fisik)');

        $kolom = 2;
        $nomor = 1;

        foreach ($output as $key => $value) {

            $barang = $value['data_barang'];
            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $barang['kode_barang']);
            $sheet->setCellValue('C' . $kolom, $barang['nama_barang']);
            $sheet->setCellValue('D' . $kolom, $barang['nama_satuan']);
            $sheet->setCellValue('E' . $kolom, $value['saldo_buku']);
            $sheet->setCellValue('F' . $kolom, $value['saldo_fisik']);

            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'stokopname';

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }


    public function reportStokOpname($no_ref)
    {
        // set Excel
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // init data awal
        // master
        $data = $this->modelMasterPersediaan->getMasterStokOpnameUser($no_ref);
        $master_stok_opname = $data->row_array();

        $sheet->mergeCells('A1:C1'); // merge buat nomor referensi
        $sheet->mergeCells('A2:C2'); // merge buat tanggal
        $sheet->mergeCells('A3:C3'); // merge buat maker

        $sheet->setCellValue('A1', 'Nomor Referensi : ');
        $sheet->setCellValue('A2', 'Tanggal : ');
        $sheet->setCellValue('A3', 'Maker : ');
        $sheet->setCellValue('D1', $master_stok_opname['nomor_referensi']);
        $sheet->setCellValue('D2', $master_stok_opname['tanggal']);
        $sheet->setCellValue('D3', $master_stok_opname['nama_admin']);
        //detail
        $database = $this->modelMasterPersediaan->getDataStokOpname($no_ref);
        $detailStokOpname = $database->result_array();
        $output = array();

        // SET HEADER
        $sheet->getStyle('A5:G5')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('FF000000');
        $sheet->getStyle('A5:G5')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);

        $sheet->setCellValue('A5', 'No');
        $sheet->mergeCells('B5:C5'); // merge buat kode Barang
        $sheet->setCellValue('B5', 'Kode Barang');
        $sheet->setCellValue('D5', 'Nama Barang');
        $sheet->setCellValue('E5', 'Satuan');
        $sheet->setCellValue('F5', 'Saldo (Buku)');
        $sheet->setCellValue('G5', 'Saldo (Fisik)');
        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);

        $kolom = 6;
        $nomor = 1;
        foreach ($detailStokOpname as $key => $value) {
            $sub_detail = $this->modelMasterPersediaan->detail_detailStokOpname($value['id']);

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->mergeCells('B' . $kolom . ':C'  . $kolom); // merge buat kode Barang
            $sheet->setCellValue('B' . $kolom, $value['kode_barang']);
            $sheet->setCellValue('D' . $kolom, $value['nama_barang']);
            $sheet->setCellValue('E' . $kolom, $value['nama_satuan']);
            $sheet->setCellValue('F' . $kolom, $value['saldo_buku']);
            $sheet->setCellValue('G' . $kolom, $value['saldo_fisik']);

            $kolom++;
            $nomor++;

            $sub_nomor = 1;

            foreach ($sub_detail as $key => $value) {
                $sheet->setCellValue('B' . $kolom, $sub_nomor);
                $sheet->setCellValue('C' . $kolom, $value['qty']);
                $sheet->setCellValue('D' . $kolom, $value['keterangan']);
                $kolom++;
                $sub_nomor++;
            }
            $nomor++;
        }



        $writer = new Xlsx($spreadsheet);

        $filename = 'Report Stok Opname ' . $no_ref;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    function detail_gaji($no_ref)
    {
        $master_gaji = $this->modelGaji->get_view_master_gaji($no_ref);

        $database = $this->modelGaji->get_view_detail_gaji($no_ref);
        $data = $database->result_array();
         
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER

        $spreadsheet->getActiveSheet()->getStyle('D:G')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // SET JUDUL
        $sheet->mergeCells('A1:D1'); // merge
        $sheet->mergeCells('A2:B2'); // merge
        $sheet->mergeCells('A3:B3'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PEMBAYARAN GAJI');
        $sheet->setCellValue('A2', 'NOMOR REFERENSI ');
        $sheet->setCellValue('A3', 'TANGGAL ');
        $sheet->setCellValue('C2', ': '. $master_gaji['nomor_referensi']);
        $sheet->setCellValue('C3', ': '. $master_gaji['tanggal']);
        
        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'NAMA PEGAWAI');
        $sheet->setCellValue('C6', 'JABATAN');
        $sheet->setCellValue('D6', 'GAJI POKOK');
        $sheet->setCellValue('E6', 'UANG MAKAN');
        $sheet->setCellValue('F6', 'BONUS');
        $sheet->setCellValue('G6', 'TOTAL TERIMA');
        $sheet->setCellValue('H6', 'TANDA TANGAN');

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

        foreach ($data as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['nama_lengkap']);
            $sheet->setCellValue('C' . $kolom, $value['jabatan']);
            $sheet->setCellValue('D' . $kolom, $value['gaji_pokok']);
            $sheet->setCellValue('E' . $kolom, $value['uang_makan']);
            $sheet->setCellValue('F' . $kolom, $value['bonus']);
            $sheet->setCellValue('G' . $kolom, $value['total']);

            $spreadsheet->getActiveSheet()->getStyle('A6' . ':H6')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A6' . ':H' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D6' . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('F6' . ':F' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('H6' . ':H' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }

        // set jumlah pembayaran sumnya
        $kolom++;
        $sheet->mergeCells('E' . $kolom .':F' . $kolom); // merge
        $sheet->setCellValue('E' . $kolom, 'TOTAL PEMBAYARAN');
        $sheet->setCellValue('G' . $kolom, $master_gaji['total_pembayaran']);

        $writer = new Xlsx($spreadsheet);

        $filename = 'tanda terima gaji '.$master_gaji['tanggal']  ;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    function detail_biaya($no_ref)
    {
        $master_biaya = $this->modelBiaya->get_view_master_biaya($no_ref);

        $database = $this->modelBiaya->get_view_detail_biaya($no_ref);
        $data = $database->result_array();
        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER

        $spreadsheet->getActiveSheet()->getStyle('D:G')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        // SET JUDUL
        $sheet->mergeCells('A1:D1'); // merge
        $sheet->mergeCells('A2:B2'); // merge
        $sheet->mergeCells('A3:B3'); // merge
        $sheet->setCellValue('A1', 'LAPORAN BIAYA');
        $sheet->setCellValue('A2', 'NOMOR REFERENSI ');
        $sheet->setCellValue('A3', 'TANGGAL ');
        $sheet->setCellValue('C2', ': '. $master_biaya['nomor_referensi']);
        $sheet->setCellValue('C3', ': '. $master_biaya['tanggal']);
        
        // HEADER ISI
        $sheet->setCellValue('A6', 'NO');
        $sheet->setCellValue('B6', 'KATEGORI BIAYA');
        $sheet->setCellValue('C6', 'KETERANGAN');
        $sheet->setCellValue('D6', 'TOTAL BIAYA');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);

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

        foreach ($data as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, strtoupper($value['nama_biaya']));
            $sheet->setCellValue('C' . $kolom, strtoupper($value['ket']));
            $sheet->setCellValue('D' . $kolom, $value['total']);

            $spreadsheet->getActiveSheet()->getStyle('A6' . ':D6')->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A6' . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B6' . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D6' . ':D' . $kolom)->applyFromArray($styleArray);

            $kolom++;
            $nomor++;
        }

        // set jumlah pembayaran sumnya
        $kolom++;
        $sheet->mergeCells('B' . $kolom .':C' . $kolom); // merge
        $sheet->setCellValue('B' . $kolom, 'TOTAL BIAYA');
        $sheet->setCellValue('D' . $kolom, $master_biaya['total_biaya']);

        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan biaya '.$master_biaya['tanggal']  ;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
