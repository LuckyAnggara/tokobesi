<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Jenis_Barang extends CI_Model
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
            $this->db->from('master_jenis_barang');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_jenis_barang');
            $this->db->like("master_jenis_barang.kode_jenis_barang", $string);
            $this->db->or_like("nama_jenis_barang", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function Cek_Kode_Jenis_Barang_Input($string)
    {
        $this->db->select('*');
        $this->db->from('master_jenis_barang');
        $this->db->where('kode_jenis_barang', $string);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            echo "ada";
        } else {
            echo "tidak";
        }
    }

    function view_edit_data($id_jenis_barang)
    {
        $this->db->select('*');
        $this->db->from('master_jenis_barang');
        $this->db->where('id_jenis_barang', $id_jenis_barang);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function edit_data($id_jenis_barang)
    {
        $post = $this->input->post();
        $data = [
            'kode_jenis_barang' => strtoupper($post['edit_kode_jenis_barang']),
            'nama_jenis_barang' => strtoupper($post['edit_nama_jenis_barang']),
            'keterangan' => $post['edit_keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->where('id_jenis_barang', $id_jenis_barang);
        $this->db->update('master_jenis_barang', $data);
    }

    function tambah_data()

    {
        $post = $this->input->post();
        $data = [
            'kode_jenis_barang' => strtoupper($post['kode_jenis_barang']),
            'nama_jenis_barang' => strtoupper($post['nama_jenis_barang']),
            'keterangan' => $post['keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('master_jenis_barang', $data);
    }

    function delete_data($id_jenis_barang)
    {
        $this->db->where('id_jenis_barang', $id_jenis_barang);
        $this->db->delete('master_jenis_barang');
    }

    function get_kode_jenis_barang()
    {
        $kode = $this->_generate_kode_jenis_barang();
        return strtoupper($kode);
    }

    function get_Data_Dengan_Jenis_Barang($nama_jenis_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('jenis_barang', $nama_jenis_barang);
        $output = $this->db->get();
        return $output;
    }
}
