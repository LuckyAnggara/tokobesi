<?php
defined('BASEPATH') or exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Kasir extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Keuangan/Model_Biaya', 'modelBiaya');
        $this->load->model('Manajemen_Keuangan/Model_Gaji', 'modelGaji');
        $this->load->model('Dashboard/Model_Dashboard_Kasir', 'modelDashboardKasir');
        $this->load->model('Setting/Model_Setting', 'modelSetting');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function laporan_harian()
    {
        $kasir = $this->input->post('kasir');
        $tanggal = $this->input->post('tanggal');
        
		$database = $this->modelDashboardKasir->get_data_penjualan_hari_ini($tanggal, $kasir);
		$data = $database->result_array();

		foreach ($data as $key => $value) {
			if ($value['status_bayar'] == 0) {
				$value['kredit'] = 'Belum Lunas';
				$output[] = $value;
			} else {
				$value['kredit'] = "Lunas";
				$output[] = $value;
            }
		}

		// $output = json_encode($output);
        // echo $output;

        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $kasir);
        $data_kasir = $this->db->get()->row_array();

		$laporan_kasir = $this->modelDashboardKasir->laporan_kasir($kasir);
		
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        // SET HEADER
        // SET JUDUL

        $sheet->mergeCells('A1:D1'); // merge
        $sheet->mergeCells('A3:B3'); // merge
        $sheet->mergeCells('A3:B3'); // merge
        $sheet->setCellValue('A1', 'LAPORAN KASIR');
        $sheet->setCellValue('A2', 'TANGGAL ');
        $sheet->setCellValue('A3', 'NAMA KASIR ');
        $sheet->setCellValue('C2', ': '. $this->tgl_indo(date("Y-m-d-D", strtotime($tanggal))));
        $sheet->setCellValue('C3', ': '. $data_kasir['nama']);
        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');

        // HEADER ISI
        $sheet->setCellValue('A5', 'NO');
        $sheet->setCellValue('B5', 'NOMOR FAKTUR');
        $sheet->setCellValue('C5', 'NAMA PELANGGAN');
        $sheet->setCellValue('D5', 'TOTAL PENJUALAN');
        $sheet->setCellValue('E5', 'STATUS');

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);


        $kolom = 6;
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
        $spreadsheet->getActiveSheet()->getStyle('D')->getNumberFormat()
            ->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);
        foreach ($output as $key => $value) {

        $sheet->setCellValue('A' . $kolom, $nomor);
        $sheet->setCellValue('B' . $kolom, $value['no_faktur']);
        $sheet->setCellValue('C' . $kolom, $value['nama_pelanggan']);
        $sheet->setCellValue('D' . $kolom, $value['total_penjualan']);
        $sheet->setCellValue('E' . $kolom, $value['kredit']);

        $spreadsheet->getActiveSheet()->getStyle('A5' . ':E5')->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('A5' . ':E' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('B5' . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('B5' . ':B' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('D5' . ':D' . $kolom)->applyFromArray($styleArray);
        $spreadsheet->getActiveSheet()->getStyle('E5' . ':E' . $kolom)->applyFromArray($styleArray);

        $kolom++;
        $nomor++;
        }

        // set jumlah pembayaran sumnya
        $kolom++;
        $sheet->mergeCells('B' . $kolom .':C' . $kolom); // merge
        $sheet->setCellValue('B' . $kolom, 'TOTAL PENJUALAN');
        $sheet->setCellValue('D' . $kolom, $laporan_kasir['omzet']);
        $kolom++;
        $sheet->mergeCells('B' . $kolom .':C' . $kolom); // merge
        $sheet->setCellValue('B' . $kolom, 'TOTAL TRANSAKSI');
        $sheet->setCellValue('D' . $kolom, $laporan_kasir['transaksi']. ' Transaksi');

        $writer = new Xlsx($spreadsheet);

        $filename = 'laporan '.$kasir;

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function data_penjualan_kasir_hari_ini()
	{
        $kasir = $this->session->userdata['username'];
		$database = $this->modelDashboard->get_data_penjualan_hari_ini(date("Y-m-d 00-00-00"), $kasir);
		$data = $database->result_array();
		$output = array(
			// "draw" => $_POST['draw'],
			"recordsTotal" => $this->db->count_all_results('master_penjualan'),
			"recordsFiltered"  => $database->num_rows(),
			"data" => array()
		);

		foreach ($data as $key => $value) {
			if ($value['status_bayar'] == 0) {
				$data =  $this->modelDaftarTransaksiPenjualan->get_data_kredit($value['no_faktur']);
				$value['kredit'] = $data;
				$output['data'][] = $value;
			} else {
				$value['kredit'] = "";
				$output['data'][] = $value;
			}
		}

		$output = json_encode($output);
		echo $output;
	}

	public function laporan_kasir()
	{
		$role = $this->session->userdata['role'];
		if($role == 1){
			$user = $this->session->userdata['username'];
		}else{
			$user = null;
		}
		$data = $this->modelDashboard->laporan_kasir($user);
		
		$output = json_encode($data);
		echo $output;
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