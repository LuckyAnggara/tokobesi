<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Kategori_Biaya extends CI_Model
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
            $this->db->from('master_kategori_biaya');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_kategori_biaya');
            $this->db->like("master_kategori_biaya.kode_kategori_biaya", $string);
            $this->db->or_like("nama_biaya", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function view_edit_data($id)
    {
        $this->db->select('*');
        $this->db->from('master_kategori_biaya');
        $this->db->where('id', $id);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function edit_data($id)
    {
        $post = $this->input->post();
        $data = [
            'nama_biaya' => strtoupper($post['edit_nama_biaya']),
            'keterangan' => $post['edit_keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('id', $id);
        $this->db->update('master_kategori_biaya', $data);
    }

    function tambah_data()

    {
        $post = $this->input->post();
        $data = [
            'nama_biaya' => strtoupper($post['nama_biaya']),
            'keterangan' => $post['keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_kategori_biaya', $data);
    }

    function delete_data($id)
    {
          $data = [
            'status' => 1,
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('id', $id);
        $this->db->update('master_kategori_biaya', $data);
    }

    function get_kode_kategori_biaya()
    {
        $kode = $this->_generate_kode_kategori_biaya();
        return strtoupper($kode);
    }

    function get_data_dengan_kategori_biaya($nama_biaya)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kategori_biaya', $nama_biaya);
        $output = $this->db->get();
        return $output;
    }
}
