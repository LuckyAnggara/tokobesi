<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Setting extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }

    function get_data_perusahaan()
    {
        $this->db->select('*');
        $this->db->from('setting_perusahaan');
        return $this->db->get()->row_array();
    }

    function prefixFaktur()
    {
        $this->db->select('prefix_faktur');
        $this->db->from('setting_perusahaan');
        $data =  $this->db->get()->row_array();
        return $data['prefix_faktur'];
    }

    function edit_gambar()
    {
        $data = array(
            'value' => $this->_uploadNewGambar(),
        );
        $this->db->where('nama_setting', 'logo_perusahaan');
        $this->db->update('master_setting', $data);
    }

    function get_gambar_baru()
    {
        $this->db->select('value');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'logo_perusahaan');
        return $this->db->get()->row_array();
    }

    function _uploadNewGambar()
    {
        $this->_delete_gambar_sebelumnya();
        $config['upload_path']          = './assets/images/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = random_string('alnum', 16);
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('edit_gambar')) {
            return $this->upload->data("file_name");
        } else {
            return "";
        }
    }

    private function _delete_gambar_sebelumnya()
    {
        $this->db->select('*');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'logo_perusahaan');
        $data = $this->db->get()->row_array();
        $data_gambar = $data['value'];
        if ($data_gambar !== "") {
            unlink('./assets/images/' . $data_gambar);
        }
    }


}
