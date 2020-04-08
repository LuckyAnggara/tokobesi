<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Utang extends CI_Model
{

    function get_data_utang($post)
    {
        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(master_utang.tanggal_jatuh_tempo, "%d %b %Y") as tanggal_tempo, DATE_FORMAT(master_utang.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_utang');
        $this->db->join('master_user', 'master_user.username = master_utang.user');
        $this->db->where('tanggal_input >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_input <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->order_by('tanggal_input', 'DESC');
        $output = $this->db->get();
        return $output;
    }

    function get_data_sales($nomor_transaksi)
    {
        $this->db->select('master_pembelian.sales,master_user.nama as nama_sales');
        $this->db->from('master_pembelian');
        $this->db->join('master_user', 'master_user.username = master_pembelian.sales');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        if (!isset($output)) {
            return "";
        } else {
            return $output['nama_sales'];
        }
    }

    function get_data_supplier($nomor_transaksi)
    {
        $this->db->select('master_supplier.nama_supplier as nama_supplier');
        $this->db->from('master_pembelian');
        $this->db->join('master_utang', 'master_utang.nomor_transaksi = master_pembelian.nomor_transaksi');
        $this->db->join('master_supplier', 'master_supplier.kode_supplier = master_pembelian.kode_supplier');
        $this->db->where('master_pembelian.nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        return $output['nama_supplier'];
    }

    function get_data_detail_utang($nomor_transaksi)
    {
        $this->db->select('*');
        $this->db->from('master_utang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        return $output;
    }

    function datapembayaran($post)
    {
        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(detail_utang.tanggal, "%d %b %Y") as tanggal');
        $this->db->from('detail_utang');
        $this->db->join('master_user', 'master_user.username = detail_utang.user');
        $this->db->where('detail_utang.tanggal >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('detail_utang.tanggal <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->order_by('detail_utang.tanggal', 'DESC');
        $output = $this->db->get();
        return $output;
    }

    function get_detail_pembayaran($nomor_transaksi)
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d %b %Y") as tanggal');
        $this->db->from('detail_utang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $this->db->order_by('detail_utang.tanggal', 'ASC');
        return $this->db->get();
    }

    function tambah_pembayaran($post)
    {
        $nominal_pembayaran = str_replace(".", "", $post['nominal_pembayaran']);
        $nominal_pembayaran = str_replace("Rp ", "", $nominal_pembayaran);
        $data = [
            'nomor_transaksi' => $post['nomor_transaksi'],
            'tanggal' => date('Y-m-d H:i:s', strtotime($post['tanggal'])),
            'nominal_pembayaran' => $nominal_pembayaran,
            'sisa_utang' => $this->_sisa_utang($post['nomor_transaksi'], $nominal_pembayaran),
            'keterangan' => $post['keterangan'],
            'user' => $this->session->userdata['username'],
            'bukti' => $this->_uploadBukti(),
        ];
        $this->db->insert('detail_utang', $data);
    }

    function update_master($post)
    {
        $total_pembayaran = $this->_total_pembayaran($post['nomor_transaksi']);

        $this->db->select('total_tagihan');
        $this->db->from('master_utang');
        $this->db->where('nomor_transaksi', $post['nomor_transaksi']);
        $total_tagihan = $this->db->get()->row_array();
        
        $data = [
            'total_pembayaran' => $total_pembayaran,
            'sisa_utang' => $total_tagihan['total_tagihan'] - $total_pembayaran,
        ];

        $this->db->where('nomor_transaksi', $post['nomor_transaksi']);
        $this->db->update('master_utang', $data);
    }

    private function _sisa_utang($nomor_transaksi, $nominal_pembayaran)
    {
        $this->db->select('sisa_utang');
        $this->db->from('master_utang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $data = $this->db->get()->row_array();
        $sisa_utang = $data['sisa_utang'];

        $output =  $sisa_utang - $nominal_pembayaran;
        if ($output == 0) {
            $this->_ganti_status($nomor_transaksi);
        }
        return $output;
    }

    private function _ganti_status($nomor_transaksi)
    {
        $data = [
            'status_bayar' => 1,
        ];
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $this->db->update('master_pembelian', $data);
    }

    private function _total_pembayaran($nomor_transaksi)
    {
        $this->db->select_sum('nominal_pembayaran');
        $this->db->from('detail_utang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();

        return $output['nominal_pembayaran'];
    }

    private function _uploadBukti()
    {
        $config['upload_path'] = './assets/upload/bukti/utang/';
        $config['allowed_types'] = 'jpeg|jpg|png|pdf';
        $config['encrypt_name'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['max_size'] = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('bukti')) {
            echo  $this->upload->display_errors();
            return $this->upload->data('file_name');
        } else {
            echo  $this->upload->display_errors();

            return "";
        }
    }

    function saldo_utang()
    {
        $this->db->select_sum('sisa_utang');
        $this->db->from('master_utang');
        $output = $this->db->get()->row_array();
        return $output['sisa_utang'];
    }

    function saldo_utang_detail($nomor_transaksi)
    {
        $this->db->select('sisa_utang');
        $this->db->from('master_utang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        return $output['sisa_utang'];
    }

    function status_bayar($nomor_transaksi)
    {
        $this->db->select('status_bayar');
        $this->db->from('master_pembelian');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        return $output['status_bayar'];
    }


    function set_lampiran($id)
    {
        $data = array(
            'bukti' => $this->_uploadBukti(),
        );
        $this->db->where('id', $id);
        $this->db->update('detail_utang', $data);
    }

    function delete_data($id)
    {
        $this->db->select('nominal_pembayaran, nomor_transaksi');
        $this->db->from('detail_utang');
        $this->db->where('id', $id);
        $data = $this->db->get()->row_array();

        $nominal_pembayaran = $data['nominal_pembayaran'];
        $data_utang = $this->_carisisautang($data['nomor_transaksi']);

        $data = array(
            'total_pembayaran' => $data_utang['total_pembayaran'] - $nominal_pembayaran,
            'sisa_utang' => $data_utang['sisa_utang'] + $nominal_pembayaran,
        );
        $this->db->where('nomor_transaksi', $data_utang['nomor_transaksi']);
        $this->db->update('master_utang', $data);

        $this->_delete_lampiran($id);
        $this->db->where('id', $id);
        $this->db->delete('detail_utang');
    }

    private function _carisisautang($nomor_transaksi)
    {
        $this->db->select('*');
        $this->db->from('master_utang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();

        if ($output['sisa_utang'] == 0) {
            $data = [
                'status_bayar' => 0,
            ];
            $this->db->where('nomor_transaksi', $nomor_transaksi);
            $this->db->update('master_pembelian', $data);
        }

        return $output;
    }

    private function _delete_lampiran($id)
    {
        // delete image

        $this->db->select('*');
        $this->db->from('detail_utang');
        $this->db->where('id', $id);
        $data = $this->db->get()->row_array();
        $data = $data['bukti'];
        if ($data !== "") {
            unlink('./assets/upload/bukti/utang/' . $data);
        } else {
        }
    }
}
