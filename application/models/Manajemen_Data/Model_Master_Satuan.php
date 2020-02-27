<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Satuan extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function get_data($string)
    {
        if ($string == null) {
            $this->db->select('*');
            $this->db->from('master_satuan_barang');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_satuan_barang');
            $this->db->like("master_satuan_barang.kode_satuan", $string);
            $this->db->or_like("nama_satuan", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function Cek_Kode_Satuan_Input($string)
    {
        $this->db->select('*');
        $this->db->from('master_satuan_barang');
        $this->db->where('kode_satuan', $string);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            echo "ada";
        } else {
            echo "tidak";
        }
    }

    function view_edit_data($id_satuan)
    {
        $this->db->select('*');
        $this->db->from('master_satuan_barang');
        $this->db->where('id_satuan', $id_satuan);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function edit_data($id_satuan)
    {
        $post = $this->input->post();
        $data = [
            'kode_satuan' => strtoupper($post['edit_kode_satuan']),
            'nama_satuan' => strtoupper($post['edit_nama_satuan']),
            'keterangan' => $post['edit_keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('id_satuan', $id_satuan);
        $this->db->update('master_satuan_barang', $data);
    }

    function tambah_data()

    {
        $post = $this->input->post();
        $data = [
            'kode_satuan' => strtoupper($post['kode_satuan']),
            'nama_satuan' => strtoupper($post['nama_satuan']),
            'keterangan' => $post['keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_satuan_barang', $data);
    }

    function delete_data($id_satuan)
    {
        $this->db->where('id_satuan', $id_satuan);
        $this->db->delete('master_satuan_barang');
    }

    function get_kode_satuan()
    {
        $kode = $this->_generate_kode_satuan();
        return strtoupper($kode);
    }

    function get_Data_Dengan_Satuan($nama_satuan)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_satuan', $nama_satuan);
        $output = $this->db->get();
        return $output;
    }
}
