<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Merek_Barang extends CI_Model
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
            $this->db->from('master_merek_barang');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_merek_barang');
            $this->db->like("master_merek_barang.kode_merek_barang", $string);
            $this->db->or_like("nama_merek_barang", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function Cek_Kode_Merek_Barang_Input($string)
    {
        $this->db->select('*');
        $this->db->from('master_merek_barang');
        $this->db->where('kode_merek_barang', $string);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            echo "ada";
        } else {
            echo "tidak";
        }
    }

    function view_edit_data($id_merek_barang)
    {
        $this->db->select('*');
        $this->db->from('master_merek_barang');
        $this->db->where('id_merek_barang', $id_merek_barang);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function edit_data($id_merek_barang)
    {
        $post = $this->input->post();
        $data = [
            'kode_merek_barang' => strtoupper($post['edit_kode_merek_barang']),
            'nama_merek_barang' => strtoupper($post['edit_nama_merek_barang']),
            'keterangan' => $post['edit_keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('id_merek_barang', $id_merek_barang);
        $this->db->update('master_merek_barang', $data);
    }

    function tambah_data()

    {
        $post = $this->input->post();
        $data = [
            'kode_merek_barang' => strtoupper($post['kode_merek_barang']),
            'nama_merek_barang' => strtoupper($post['nama_merek_barang']),
            'keterangan' => $post['keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_merek_barang', $data);
    }

    function delete_data($id_merek_barang)
    {
        $this->db->where('id_merek_barang', $id_merek_barang);
        $this->db->delete('master_merek_barang');
    }

    function get_kode_merek_barang()
    {
        $kode = $this->_generate_kode_merek_barang();
        return strtoupper($kode);
    }

    function get_Data_Dengan_Merek_Barang($nama_merek_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('merek_barang', $nama_merek_barang);
        $output = $this->db->get();
        return $output;
    }
}
