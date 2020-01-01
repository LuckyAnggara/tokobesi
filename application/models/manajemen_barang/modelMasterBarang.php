<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelMasterBarang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
    }

    function get_data($string)
    {
        if ($string == null) {
            $this->db->select('*');
            $this->db->from('master_barang');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_barang');
            $this->db->like("master_barang.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $this->db->or_like("harga_satuan", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function cekData($string)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->like("kode_barang", $string);
        $this->db->order_by("kode_barang", "DESC");
        $this->db->Limit("1");
        $query = $this->db->get();
        $query = $query->row_array();
        $data = $query['kode_barang'];
        return filter_var($data, FILTER_SANITIZE_NUMBER_INT);
    }

    function view_edit_data($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function edit_data($kode_barang)
    {
        $post = $this->input->post();
        $data = array(
            'nama_barang' => strtoupper($post['edit_nama_barang']),
            'harga_satuan' => $post["edit_harga_satuan"],
            'satuan' => $post['edit_satuan'],
            'gambar' => $this->_editUploadImage(),
            'tanggal_input' => date("Y-m-d H:i:s"),
        );
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('master_barang', $data);
    }

    function tambah_data()
    {
        $post = $this->input->post();
        $data = [
            'kode_barang' => $post['kode_barang'],
            'nama_barang' => strtoupper($post['nama_barang']),
            'harga_satuan' => $post["harga_satuan"],
            'satuan' => $post['satuan'],
            'gambar' => $this->_uploadImage(),
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('master_barang', $data);
        // $this->uploadLampiran($post['noSurat']);
    }

    private function _editUploadImage()
    {
        $post = $this->input->post();
        $config['upload_path']          = './assets/images/barang/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $post['edit_kode_barang'];
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('edit_gambar_dropfy')) {
            return $this->upload->data("file_name");
        } else {
            return $post['edit_kode_barang'];
        }
    }

    private function _uploadImage()
    {
        $post = $this->input->post();
        $config['upload_path']          = './assets/images/barang/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $post['kode_barang'];
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        } else {
            return "default.jpg";
        }
    }

    function delete_data($kode_barang)
    {
        $this->db->where('kode_barang', $kode_barang);
        $this->db->delete('master_barang');
    }

    function get_data_satuan()
    {
        $this->db->select('*');
        $this->db->from('tabel_satuan');
        return $this->db->get()->result_array();
    }
}
