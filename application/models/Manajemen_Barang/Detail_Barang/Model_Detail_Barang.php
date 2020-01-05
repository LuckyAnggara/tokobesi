<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Detail_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    function _uploadNewGambar()
    {
        $post = $this->input->post();
        $this->_delete_gambar_sebelumnya($post['kode_barang']);
        $config['upload_path']          = './assets/images/barang/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $post['kode_barang'];
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('edit_gambar')) {
            return $this->upload->data("file_name");
        } else {
            return $post['kode_barang'];
        }
    }

    private function _delete_gambar_sebelumnya($kode_barang)
    {
        // delete image

        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $data = $data['gambar'];
        unlink('./assets/images/barang/' . $data);
    }

    function edit_gambar($kode_barang)
    {
        $data = array(
            'gambar' => $this->_uploadNewGambar(),
            'tanggal_input' => date("Y-m-d H:i:s"),
        );
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('master_barang', $data);
    }

    function get_gambar_baru($kode_barang)
    {
        $this->db->select('gambar');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get()->row_array();
    }

    function get_data_for_detail($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        return $this->db->get()->row_array();
    }
}
