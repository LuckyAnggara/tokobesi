<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Excel extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
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
}
