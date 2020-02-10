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

        $database = $this->modelMasterPersediaan->getDataStockOpname($no_ref);
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
}
