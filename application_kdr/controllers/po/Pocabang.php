<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pocabang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
        $this->load->model('Manajemen_Penjualan/Model_Penjualan_Barang', 'modelPenjualan');
        $this->load->model('Po/Model_Po', 'modelPO');
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        $this->load->library('Pdf');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function tambah_data()
    {
        if ($this->session->userdata('role') !== "5") {
            redirect(base_url("dashboard"));
        } else {
            $data['menu'] = $this->modelSetting->data_menu();
            $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
            $data['no_order_po'] = $this->_generateNomor();
            $data['css'] = 'po/tambah_data/po_css';
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('po/tambah_data/po', $data);
            $this->load->view('template/template_right');
            $this->load->view('po/tambah_data/po_modal', $data);
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('po/tambah_data/po_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function index()
    {
        if ($this->session->userdata('role') !== "5") {
            redirect(base_url("dashboard"));
        } else {
            $data['menu'] = $this->modelSetting->data_menu();
            $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
            $data['no_order_po'] = $this->_generateNomor();
            $data['css'] = 'po/daftar_data/daftar_po_css';
            $this->load->view('template/template_header', $data);
            $this->load->view('template/template_menu');
            $this->load->view('po/daftar_data/daftar_po', $data);
            $this->load->view('template/template_right');
            $this->load->view('po/daftar_data/daftar_po_modal', $data);
            $this->load->view('template/template_footer');
            $this->load->view('template/template_js');
            $this->load->view('po/daftar_data/daftar_po_js');
            $this->load->view('template/template_app_js');
        }
    }

    public function detail($no_order_po)
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['menu'] = $this->modelSetting->data_menu();
        $data['css'] = 'po/detail/detail_css';

        $data['data_po'] = $this->modelPO->get_data_po($no_order_po);

        // print_r($data['data_po']);
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('po/detail/detail', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('po/detail/detail_js');
        $this->load->view('template/template_app_js');
    }

    public function detail_receive($no_order_po)
    {
        $data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
        $data['menu'] = $this->modelSetting->data_menu();
        $data['css'] = 'po/detail_receive/detail_receive_css';

        $data['po'] = $this->modelPO->get_data_po_receive($no_order_po);

        // print_r($data['data_po']);
        $this->load->view('template/template_header', $data);
        $this->load->view('template/template_menu');
        $this->load->view('po/detail_receive/detail_receive', $data);
        $this->load->view('template/template_right');
        $this->load->view('template/template_footer');
        $this->load->view('template/template_js');
        $this->load->view('po/detail_receive/detail_receive_js');
        $this->load->view('template/template_app_js');
    }

    private function _generateNomor()
    {
        $this->db->select('MAX(`id`) as id');
        $this->db->from('master_po');
        $data = $this->db->get()->row_array();
        $string = $data['id'];
        if ($string !== null) {
            $number = substr($string, 0, 10);
            // $number = substr($string, -3);
            $number = $number + 1;
            $tgl = date('ymd');
            return $tgl . sprintf("%03d", $number);
        } else {
            $tgl = date('ymd');
            return $tgl . sprintf("%03d", 1);
        }
    }

    public function clear_keranjang_po($no_order_lama)
    {
        $this->modelPO->get_data_keranjang_clear($no_order_lama);
    }

    public function get_data_supplier()
    {
        $string = $this->input->post('query');
        $data = $this->modelPO->get_data_supplier($string);
        $output = json_encode($data);
        echo $output;
    }

    public function get_data_barang($string = null)
    {
        $string = str_replace("%20", " ", $string);
        $database = $this->modelPenjualan->get_data_barang($string);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data" => $database->num_rows(),
            "data" => $data,
        );
        $output = json_encode($output);
        echo $output;
    }

    public function get_data_barang_versi_select2()
    {
        $string = $this->input->post('query');
        $database = $this->modelPenjualan->get_data_barang($string);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data" => $database->num_rows(),
            "data" => $data,
        );
        $output = json_encode($output);
        echo $output;
    }

    public function push_data_barang()
    {
        $this->modelPO->push_data_barang();
    }

    public function push_total_perhitungan()
    {
        $post = $this->input->post();
        $this->modelPO->push_total_perhitungan($post);
    }

    public function get_data_keranjang($no_order_po)
    {
        $database = $this->modelPO->get_data_keranjang($no_order_po);
        $data = $database->result_array();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered" => $database->num_rows(),
            "data" => $data,
        );
        $output = json_encode($output);
        echo $output;
    }

    public function delete_data_keranjang($id)
    {
        if (empty($id)) {
        } else {
            $this->modelPO->delete_data_keranjang($id); // delete data
        }
    }

    public function get_sum_keranjang($no_order)
    {

        $output = $this->modelPO->get_sum_keranjang($no_order);
        $output = json_encode($output);
        echo $output;
    }

    public function push_grand_total()
    {
        $post = $this->input->post();
        $this->modelPO->push_grand_total($post);
    }

    public function get_total_perhitungan($no_order)
    {
        $data = $this->modelPO->get_total_perhitungan($no_order);
        $output = json_encode($data);
        echo $output;
    }

    public function proses()
    {
        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('master_po');
        $this->db->where('no_order_po', $post['no_order_po']);
        $cek = $this->db->get()->num_rows();
        if ($cek > 0) {
            echo "1";
        } else {
            $this->modelPO->proses($post);
        }
    }

    public function get_data_po()
    {
        $post = $this->input->post();
        $this->db->select('*');
        $this->db->from('master_po');
        $this->db->where('no_order_po', $post['no_order_po']);
        $data = $this->db->get()->row_array();
        $output = json_encode($data);
        echo $output;
    }

    public function get_daftar_request()
    {
        $data = $this->modelPO->get_daftar_request();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data" => '0',
            "data" => $data,
        );
        $output = json_encode($output);
        echo $output;
    }

    public function ubah_status_po()
    {
        $post = $this->input->post();
        $data = [
            'status' => $post['status'],
        ];
        $this->db->where('no_order_po', $post['no_order_po']);
        $this->db->update('master_po', $data);
    }

    public function ubah_status_by_id()
    {
        $post = $this->input->post();
        $data = [
            'status' => $post['status'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('master_receive_po', $data);
    }

    public function delete_po()
    {
        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $this->db->delete('master_po');
    }

    public function get_daftar_receive()
    {
        $data = $this->modelPO->get_daftar_receive();
        $output = array(
            "recordsTotal" => $this->db->count_all_results(),
            "jumlah_data" => '0',
            "data" => $data,
        );
        $output = json_encode($output);
        echo $output;
    }

    public function set_detail_receive()
    {
        $post = $this->input->post();
        $this->modelPO->set_detail_receive($post);
    }

    public function print_lx($no_order)
    {
        $setting_perusahaan = $this->modelSetting->get_data_perusahaan();
        $no_order_po = $no_order;
        $data_po = $this->modelPO->get_data_po($no_order_po);
        $tanggal_transaksi = $this->tgl_indo(date("Y-m-d-D", strtotime($data_po['tanggal_transaksi'])));

        $pdf = new FPDF('p', 'mm', 'letter');
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->AddFont('Tahoma', 'B', 'tahomabd.php');
        $pdf->AddFont('Tahoma', '', 'tahoma.php');
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Tahoma', 'B', 11);
        // mencetak string
        $pdf->Cell(100, 6, $setting_perusahaan['nama_perusahaan'], 0, 0, 'L');
        $pdf->Cell(96, 6, 'Purchase Order Cabang', 0, 1, 'R');
        $pdf->SetFont('Tahoma', '', 8);
        $pdf->MultiCell(100, 5, nl2br($setting_perusahaan['alamat_perusahaan']), 0, 'J');

        $pdf->Cell(100, 5, 'Telp : ' . $setting_perusahaan['nomor_telepon'] . ' / Fax : ' . $setting_perusahaan['nomor_fax'], 0, 1, 'L');

        $pdf->Cell(196, 5, 'Email : ' . $setting_perusahaan['alamat_email'], 0, 1, 'L');
        $pdf->Cell(196, 2, '', 'B', 1, 'L');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 3, '', 0, 1);
        $pdf->Cell(30, 5, 'Nomor Purchae Order', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(50, 5, $data_po['no_order_po'], 0, 0);
        $pdf->Cell(45);
        $pdf->Cell(30, 5, 'Tanggal P.O', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(50, 5, $tanggal_transaksi, 0, 1);

        // header
        $pdf->Cell(196, 2, '', 'B', 1, 'L');
        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Tahoma', 'B', 7);

        $pdf->Cell(7, 6, '#', 1, 0, 'C');
        $pdf->Cell(90, 6, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Satuan', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Harga', 1, 0, 'C');
        $pdf->Cell(15, 6, 'Qty', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Total', 1, 1, 'C');
        $pdf->SetFont('Tahoma', '', 7);

        // foreach ($detail_order as $row){
        //     $pdf->Cell(20,6,$row->nim,1,0);
        //     $pdf->Cell(85,6,$row->nama_lengkap,1,0);
        //     $pdf->Cell(27,6,$row->no_hp,1,0);
        //     $pdf->Cell(25,6,$row->tanggal_lahir,1,1);
        // }
        $no = 0;
        foreach ($data_po['detail_po'] as $key => $value) {
            $no++;

            $pdf->Cell(7, 5, $no, 1, 0, 'C');
            $pdf->Cell(90, 5, $value['nama_barang'], 1, 0);
            $pdf->Cell(20, 5, $value['nama_satuan'], 1, 0, 'C');
            $pdf->Cell(20, 5, $this->rupiah($value['harga_beli']), 1, 0, 'R');
            $pdf->Cell(15, 5, $value['jumlah_pembelian'], 1, 0, 'C');
            $pdf->Cell(45, 5, $this->rupiah($value['total_harga']), 1, 1, 'R');
        }

        $pdf->Cell(10, 6, '', 0, 1);

        $pdf->SetFont('Tahoma', '', 8);
        $pdf->Cell(90, 5, 'Hormat Kami', 0, 0, 'C');
        $pdf->Cell(50, 5, '', 0, 0);
        $pdf->SetFont('Tahoma', '', 7);
        $pdf->Cell(30, 5, 'Sub Total', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(22, 5, $this->rupiah($data_po['total_pembelian']), 0, 1, 'R');
        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->SetFont('Tahoma', '', 8);
        $pdf->Cell(110);
        $pdf->SetFont('Tahoma', '', 7);
        $pdf->Cell(30, 5, 'Biaya Lainnya', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(22, 5, $this->rupiah($data_po['biaya_lainnya']), 0, 1, 'R');
        $pdf->Cell(110, 5, '', 0, 1);
        $pdf->SetFont('Tahoma', '', 7);
        $pdf->Cell(90, 5, $setting_perusahaan['nama_perusahaan'], 0, 0, 'C');
        $pdf->Cell(50, 5, '', 0, 0);
        $pdf->Cell(30, 5, '', 'B', 0);
        $pdf->Cell(5, 5, '', 'B', 0);
        $pdf->Cell(22, 5, '', 'B', 1, 'R');
        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->SetFont('Tahoma', 'B', 9);
        $pdf->Cell(110);
        $pdf->Cell(30, 5, 'Grand Total', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(22, 5, $this->rupiah($data_po['grand_total']), 0, 1, 'R');

        $pdf->SetFont('Tahoma', 'B', 7);
        $pdf->Cell(196, 3, '', 'B', 1);
        $pdf->Cell(10, 2, '', 0, 1);

        $pdf->Cell(30, 7, 'Keterangan :', 0, 0);
        $pdf->MultiCell(90, 7, $data_po['keterangan'], 0, 'J');

        $pdf->Output();
    }

    public function print_lx_receive($no_order_po)
    {
        $po = $this->modelPO->get_data_po_receive($no_order_po);
        $data_po = $po['data_po'];
        $tanggal_transaksi = $this->tgl_indo(date("Y-m-d-D", strtotime($data_po['tanggal_masuk'])));

        $pdf = new FPDF('p', 'mm', 'letter');
        // membuat halaman baru
        $pdf->AddPage();
        $pdf->AddFont('Tahoma', 'B', 'tahomabd.php');
        $pdf->AddFont('Tahoma', '', 'tahoma.php');
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Tahoma', 'B', 11);
        // mencetak string
        $pdf->Cell(100, 6, $data_po['nama_perusahaan'], 0, 0, 'L');
        $pdf->Cell(96, 6, 'Purchase Order Cabang', 0, 1, 'R');
        $pdf->SetFont('Tahoma', '', 8);
        $pdf->MultiCell(100, 5, nl2br($data_po['alamat_perusahaan']), 0, 'J');

        $pdf->Cell(100, 5, 'Telp : ' . $data_po['nomor_telepon'] . ' / Fax : ' . $data_po['nomor_fax'], 0, 1, 'L');

        $pdf->Cell(196, 5, 'Email : ' . $data_po['alamat_email'], 0, 1, 'L');
        $pdf->Cell(196, 2, '', 'B', 1, 'L');
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10, 3, '', 0, 1);
        $pdf->Cell(30, 5, 'Nomor Purchae Order', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(50, 5, $data_po['no_order_po'], 0, 0);
        $pdf->Cell(45);
        $pdf->Cell(30, 5, 'Tanggal P.O', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(50, 5, $tanggal_transaksi, 0, 1);

        // header
        $pdf->Cell(196, 2, '', 'B', 1, 'L');
        $pdf->Cell(10, 5, '', 0, 1);
        $pdf->SetFont('Tahoma', 'B', 7);

        $pdf->Cell(7, 6, '#', 1, 0, 'C');
        $pdf->Cell(90, 6, 'Nama Barang', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Satuan', 1, 0, 'C');
        $pdf->Cell(20, 6, 'Harga', 1, 0, 'C');
        $pdf->Cell(15, 6, 'Qty', 1, 0, 'C');
        $pdf->Cell(45, 6, 'Total', 1, 1, 'C');
        $pdf->SetFont('Tahoma', '', 7);

        // foreach ($detail_order as $row){
        //     $pdf->Cell(20,6,$row->nim,1,0);
        //     $pdf->Cell(85,6,$row->nama_lengkap,1,0);
        //     $pdf->Cell(27,6,$row->no_hp,1,0);
        //     $pdf->Cell(25,6,$row->tanggal_lahir,1,1);
        // }
        $no = 0;
        foreach ($po['detail_po'] as $key => $value) {
            $no++;
            $pdf->Cell(7, 5, $no, 1, 0, 'C');
            $pdf->Cell(90, 5, $value['nama_barang'], 1, 0);
            $pdf->Cell(20, 5, $value['nama_satuan'], 1, 0, 'C');
            $pdf->Cell(20, 5, $this->rupiah($value['harga_beli']), 1, 0, 'R');
            $pdf->Cell(15, 5, $value['jumlah_pembelian'], 1, 0, 'C');
            $pdf->Cell(45, 5, $this->rupiah($value['total_harga']), 1, 1, 'R');
        }

        $pdf->Cell(10, 6, '', 0, 1);

        $pdf->SetFont('Tahoma', '', 8);
        $pdf->Cell(90, 5, 'Hormat Kami', 0, 0, 'C');
        $pdf->Cell(50, 5, '', 0, 0);
        $pdf->SetFont('Tahoma', '', 7);
        $pdf->Cell(30, 5, 'Sub Total', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(22, 5, $this->rupiah($data_po['total_pembelian']), 0, 1, 'R');
        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->SetFont('Tahoma', '', 8);
        $pdf->Cell(110);
        $pdf->SetFont('Tahoma', '', 7);
        $pdf->Cell(30, 5, 'Biaya Lainnya', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(22, 5, $this->rupiah($data_po['biaya_lainnya']), 0, 1, 'R');
        $pdf->Cell(110, 5, '', 0, 1);
        $pdf->SetFont('Tahoma', '', 7);
        $pdf->Cell(90, 5, $data_po['nama_perusahaan'], 0, 0, 'C');
        $pdf->Cell(50, 5, '', 0, 0);
        $pdf->Cell(30, 5, '', 'B', 0);
        $pdf->Cell(5, 5, '', 'B', 0);
        $pdf->Cell(22, 5, '', 'B', 1, 'R');
        $pdf->Cell(30, 5, '', 0, 0);
        $pdf->SetFont('Tahoma', 'B', 9);
        $pdf->Cell(110);
        $pdf->Cell(30, 5, 'Grand Total', 0, 0);
        $pdf->Cell(5, 5, ':', 0, 0);
        $pdf->Cell(22, 5, $this->rupiah($data_po['grand_total']), 0, 1, 'R');

        $pdf->SetFont('Tahoma', 'B', 7);
        $pdf->Cell(196, 3, '', 'B', 1);
        $pdf->Cell(10, 2, '', 0, 1);

        $pdf->Cell(30, 7, 'Keterangan :', 0, 0);
        $pdf->MultiCell(90, 7, $data_po['keterangan'], 0, 'J');

        $pdf->Output();
    }

    public function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka, 0, ',', '.');
        return $hasil_rupiah;
    }

    public function tgl_indo($tanggal)
    {
        $bulan = array(
            1 => 'Januari',
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
            'Desember',
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
