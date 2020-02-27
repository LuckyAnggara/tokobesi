<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Detail_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file', 'string'));
    }

    function _uploadNewGambar()
    {
        $post = $this->input->post();
        $this->_delete_gambar_sebelumnya($post['kode_barang']);
        $config['upload_path']          = './assets/images/barang/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = random_string('alnum', 16);
        $config['overwrite']            = true;
        $config['max_size']             = 4096 * 3; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('edit_gambar')) {
            return $this->upload->data("file_name");
        } else {
            return "default.jpg";
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
        if ($data != "default.jpg") {
            unlink('./assets/images/barang/' . $data);
        }
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

    function edit_data_umum($kode_barang)
    {
        $post = $this->input->post();
        $data = [
            'kode_barang' => $post['edit_kode_barang'],
            'tipe_barang' => $post['edit_tipe_barang'],
            'jenis_barang' => $post['edit_jenis_barang'],
            'merek_barang' => $post['edit_merek_barang'],
            'kode_supplier' => $post['edit_kode_supplier'],
            'nama_barang' => strtoupper($post['edit_nama_barang']),
            'keterangan' => $post['edit_keterangan'],
        ];
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('master_barang', $data);
    }

    function edit_data_harga($kode_barang)
    {
        $post = $this->input->post();
        $data = [
            'harga_pokok' => $post["edit_harga_pokok"],
            'harga_satuan' => $post["edit_harga_satuan"],
            'persediaan_minimum' => $post["edit_persediaan_minimum"],
            'kode_satuan' => $post['edit_satuan'],
            'status_jual' => $post["edit_status_jual"],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('master_barang', $data);
    }

    function edit_data_komisi($kode_barang)
    {
        $post = $this->input->post();
        $data = [
            'komisi_sales' => $post["edit_komisi_sales"],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('master_barang', $data);
    }

    function edit_data_lainnya($kode_barang)
    {
        $post = $this->input->post();
        $data = [
            'status_jual' => $post["edit_status_jual"],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('master_barang', $data);
    }
}
