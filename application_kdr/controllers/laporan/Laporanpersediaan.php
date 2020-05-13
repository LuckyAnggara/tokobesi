<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Laporanpersediaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Laporan/Model_Laporan_Persediaan', 'modelLapPersediaan');
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
        $data['css'] = 'laporan/persediaan/persediaan_css';

        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('laporan/persediaan/persediaan', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('laporan/persediaan/persediaan_js');
        $this->load->view('template/template_app_js');
    }


    public function laporan_persediaan()
    {
        $post = $this->input->post();
        $jenis_data = $post['data'];
        
        switch ($jenis_data) {
            case '0':
                $data_persediaan = $this->modelLapPersediaan->data_persediaan($post);
                $this->laporan_data_per_barang($post, $data_persediaan);
                // $data_persediaan = $this->modelLapPersediaan->data_persediaan($post);
                // $output = json_encode($data_persediaan);
                // echo $output;
                break;
            case '1':
                $data_persediaan = $this->modelLapPersediaan->data_persediaan($post);
                $this->laporan_data_barang_harga($post, $data_persediaan);
                break;
           
        }
    }

    public function laporan_data_barang_harga($post, $data_persediaan)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:G1'); // merge
        $sheet->mergeCells('A2:G2'); // merge
        $sheet->mergeCells('A5:G5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PERSEDIAAN');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'DATA PER TANGGAL : ' . $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
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
        foreach ($data_persediaan as $key => $value) {
            $spreadsheet->getActiveSheet()->getStyle('C:F')->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $sheet->mergeCells('A' . $kolom . ':B' . $kolom); // merge
            $sheet->setCellValue('A' . $kolom, 'KODE BARANG');
            $sheet->setCellValue('C' . $kolom, $value['kode_barang']);
            $sheet->setCellValue('D' . $kolom, 'TOTAL PERSEDIAAN AKHIR');
            $sheet->setCellValue('E' . $kolom, $value['total_persediaan_akhir']);
            $sheet->setCellValue('F' . $kolom, $value['nama_satuan']);
            $spreadsheet->getActiveSheet()->getStyle('G' . $kolom)->getNumberFormat()
                ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

            $kolom++;

            $sheet->mergeCells('A' . $kolom . ':B' . $kolom); // merge
            $sheet->setCellValue('A' . $kolom, 'NAMA BARANG');
            $sheet->setCellValue('C' . $kolom, $value['nama_barang']);
            $sheet->setCellValue('D' . $kolom, 'TOTAL SALDO AKHIR');
            $sheet->setCellValue('E' . $kolom, $value['total_saldo']);

            $kolom++;

            $sheet->setCellValue('A' . $kolom, 'NO');
            $sheet->setCellValue('B' . $kolom, 'ID PEMBELIAN');
            $sheet->setCellValue('C' . $kolom, 'HARGA BELI');
            $sheet->setCellValue('D' . $kolom, 'JUMLAH PEMBELIAN');
            $sheet->setCellValue('E' . $kolom, 'SALDO AKHIR');
            $sheet->setCellValue('F' . $kolom, 'TOTAL SALDO AKHIR');
            $sheet->setCellValue('G' . $kolom, 'KETERANGAN');
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

            foreach ($value['data_persediaan'] as $key => $detail_persediaan) {

                $sheet->setCellValue('A' . $kolom, $nomor);
                $sheet->setCellValue('B' . $kolom, $detail_persediaan['nomor_transaksi']);
                $sheet->setCellValue('C' . $kolom, $detail_persediaan['harga_beli']);
                $sheet->setCellValue('D' . $kolom, $detail_persediaan['jumlah_pembelian']);
                $sheet->setCellValue('E' . $kolom, $detail_persediaan['saldo']);
                $sheet->setCellValue('F' . $kolom, $detail_persediaan['total']);
                $sheet->setCellValue('G' . $kolom, $detail_persediaan['keterangan']);

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
            $sheet->setCellValue('D' . $kolom, $value['total_persediaan']);
            $sheet->setCellValue('E' . $kolom, $value['total_persediaan_akhir']);
            $sheet->setCellValue('F' . $kolom, $value['total_saldo']);
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
        // $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        // $sheet->setCellValue('D' . $kolom, 'UTANG HARI KEMARIN');
        // $sheet->setCellValue('F' . $kolom, $utang_kemarin);
        // $kolom++;
        // $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        // $sheet->setCellValue('D' . $kolom, 'UTANG HARI INI');
        // $sheet->setCellValue('F' . $kolom, $utang_hari_ini);

        // $kolom++;
        // $sheet->setCellValue('F' . $kolom, $utang_kemarin + $utang_hari_ini);
        // $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
        //     ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        // $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
        //     ->getFill()->getStartColor()->setARGB('FF16F900');
        // $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
        //     ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        // $kolom++;
        // $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        // $sheet->setCellValue('D' . $kolom, 'PEMBAYARAN HARI INI');
        // $sheet->setCellValue('F' . $kolom, $pembayaran_hari_ini);
        // $kolom++;
        // $sheet->mergeCells('D' . $kolom . ':E' . $kolom); // merge
        // $sheet->setCellValue('D' . $kolom, 'TOTAL UTANG');
        // $sheet->setCellValue('F' . $kolom, $utang_kemarin + $utang_hari_ini - $pembayaran_hari_ini);
        // $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
        //     ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        // $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
        //     ->getFill()->getStartColor()->setARGB('FF16F900');
        // $spreadsheet->getActiveSheet()->getStyle('F' . $kolom)
        //     ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan persediaan ' . $post['tanggal'];

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        // $output = json_encode($post);
        // echo $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal'])));
    }

    public function laporan_data_per_barang($post, $data_persediaan)
    {
        $data_perusahaan = $this->modelSetting->get_data_perusahaan();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:E1'); // merge
        $sheet->mergeCells('A2:E2'); // merge
        $sheet->mergeCells('A5:E5'); // merge
        $sheet->setCellValue('A1', 'LAPORAN PERSEDIAAN');
        $sheet->setCellValue('A2', $data_perusahaan['nama_perusahaan']);
        $sheet->setCellValue('A5', 'DATA PER TANGGAL : ' . $this->tgl_indo(date("Y-m-d-D", strtotime($post['tanggal']))));
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal('center');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);


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
        $nomor = 1;
        $spreadsheet->getActiveSheet()->getStyle('C')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);

        $sheet->setCellValue('A' . $kolom, 'NO');
        $sheet->setCellValue('B' . $kolom, 'KODE BARANG');
        $sheet->setCellValue('C' . $kolom, 'NAMA BARANG');
        $sheet->setCellValue('D' . $kolom, 'SATUAN');
        $sheet->setCellValue('E' . $kolom, 'JUMLAH PERSEDIAAN');
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);

        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID);
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFill()->getStartColor()->setARGB('FF16F900');
        $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);
        
        $kolom++;

        foreach ($data_persediaan as $key => $value) {

            $sheet->setCellValue('A' . $kolom, $nomor);
            $sheet->setCellValue('B' . $kolom, $value['kode_barang']);
            $sheet->setCellValue('C' . $kolom, $value['nama_barang']);
            $sheet->setCellValue('D' . $kolom, $value['nama_satuan']);
            $sheet->setCellValue('E' . $kolom, $value['total_persediaan_akhir']);

            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':E' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('A' . $kolom . ':A' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('B' . $kolom  . ':B' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('C' . $kolom  . ':C' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('D' . $kolom  . ':D' . $kolom)->applyFromArray($styleArray);
            $spreadsheet->getActiveSheet()->getStyle('E' . $kolom  . ':E' . $kolom)->applyFromArray($styleArray);

                $kolom++;
                $nomor++;
            }


        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan persediaan per barang ' . $post['tanggal'];

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
        $data_persediaan = $this->modelLapPersediaan->data_persediaan($post);
        $output = json_encode($data_persediaan);
        echo $output;
       
    }
}