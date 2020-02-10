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

        $semua_pengguna =  $this->modelMasterPersediaan->getDataStockOpname();

        
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'No');
        $sheet->setCellValue('B1', 'Nama Barang');
        $sheet->setCellValue('C1', 'Satuan');
        $sheet->setCellValue('D1', 'Saldo (Buku)');
        $sheet->setCellValue('E1', 'Saldo (Fisik)');

        $kolom = 2;
        $nomor = 1;
        foreach ($semua_pengguna as $pengguna) {

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $pengguna['kode_barang'])
                ->setCellValue('C' . $kolom, $pengguna['kode_barang'])
                ->setCellValue('D' . $kolom, $pengguna['kode_barang'])
                ->setCellValue('E' . $kolom, $pengguna['kode_barang']);

            $kolom++;
            $nomor++;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'stokopname'. $no_ref;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}
