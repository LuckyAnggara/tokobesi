<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Daftar_Transaksi_Pembelian extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function get_data($post)
    {
        $this->db->select('master_pembelian.*,master_supplier.nama_supplier, master_user.nama as nama_pegawai');
        $this->db->from('master_pembelian');
        $this->db->join('master_user', 'master_user.username = master_pembelian.user');
        $this->db->join('master_supplier', 'master_supplier.kode_supplier = master_pembelian.kode_supplier');
        if ($post['status_bayar'] == null) {
        } else {
            $this->db->where('status_bayar', $post['status_bayar']);
        }
        if ($this->session->userdata('role') < 4) {
            $this->db->where('master_pembelian.user', $this->session->userdata['username']);
        }
        $this->db->where('tanggal_transaksi >=', date('Y-m-d', strtotime($post['tanggal_awal'])));
        $this->db->where('tanggal_transaksi <=', date('Y-m-d', strtotime($post['tanggal_akhir'])));
        $this->db->order_by('master_pembelian.tanggal_transaksi', 'DESC');
        $output = $this->db->get();
        return $output;
    }

    function get_data_kredit($nomor_transaksi)
    {
        $this->db->select('*');
        $this->db->from('master_utang');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $output = $this->db->get()->row_array();
        return $output;
    }


    function delete_data($nomor_transaksi)
    {
        $this->db->select('*');
        $this->db->from('detail_pembelian');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $data = $this->db->get()->result_array();

        $kurang = 0;
        
        foreach ($data as $key => $value) {
            
            if($value['jumlah_pembelian'] != $value['saldo']){
                $kurang++;
            }
        }

        if($kurang == 0){
            $this->db->where('nomor_transaksi', $nomor_transaksi);
            $this->db->delete('master_pembelian');
            $this->db->where('nomor_transaksi', $nomor_transaksi);
            $this->db->delete('master_utang');
            return 'ok';
        }else{
            return 'kurang';
        }

    }

    function _uploadNewLampiran()
    {
        $post = $this->input->post();
        $this->_delete_lampiran_sebelumnya($post['nomor_transaksi']);
        $config['upload_path']          = './assets/upload/bukti/pembelian/';
        $config['allowed_types']        = 'jpeg|jpg|png|pdf';
        $config['file_name']            = random_string('alnum', 16);
        $config['overwrite']            = true;
        $config['max_size']             = 4096 * 3; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('lampiran')) {
            return $this->upload->data("file_name");
        } else {
            echo $this->upload->display_errors();
            return "";
        }
    }

    private function _delete_lampiran_sebelumnya($nomor_transaksi)
    {
        // delete image

        $this->db->select('*');
        $this->db->from('master_pembelian');
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $data = $this->db->get()->row_array();
        $data = $data['lampiran'];
        if ($data !== "") {
            unlink('./assets/upload/bukti/pembelian/' . $data);
        } else {
        }
    }

    function set_lampiran($nomor_transaksi)
    {
        $data = array(
            'lampiran' => $this->_uploadNewLampiran(),
        );
        $this->db->where('nomor_transaksi', $nomor_transaksi);
        $this->db->update('master_pembelian', $data);
    }
}
