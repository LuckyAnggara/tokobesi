<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
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


    function push_satuan($kode_barang)
    {
        $this->db->select("master_barang.harga_satuan,master_satuan_barang.nama_satuan");
        $this->db->from("master_barang");
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where("master_barang.kode_barang", $kode_barang);
        return $this->db->get()->row_array();
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
            'kode_barang' => $post['edit_kode_barang'],
            'tipe_barang' => $post['edit_tipe_barang'],
            'jenis_barang' => $post['edit_jenis_barang'],
            'merek_barang' => $post['edit_merek_barang'],
            'kode_supplier' => $post['edit_kode_supplier'],
            'nama_barang' => strtoupper($post['edit_nama_barang']),
            'harga_pokok' => $post["edit_harga_pokok"],
            'harga_satuan' => $post["edit_harga_satuan"],
            'persediaan_minimum' => $post["edit_persediaan_minimum"],
            'kode_satuan' => $post['edit_satuan'],
            'gambar' => $this->_editUploadImage(),
            'status_jual' => $post["status_jual"],
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
            'tipe_barang' => $post['tipe_barang'],
            'jenis_barang' => $post['jenis_barang'],
            'merek_barang' => $post['merek_barang'],
            'kode_supplier' => $post['kode_supplier'],
            'nama_barang' => strtoupper($post['nama_barang']),
            'harga_pokok' => $post["harga_pokok"],
            'harga_satuan' => $post["harga_satuan"],
            'persediaan_minimum' => $post["persediaan_minimum"],
            'kode_satuan' => $post['satuan'],
            'gambar' => $this->_uploadImage(),
            'status_jual' => $post["status_jual"],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('master_barang', $data);

        $this->_push_data_persediaan($post['kode_barang']);
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
        if ($this->upload->do_upload('edit_gambar')) {
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
        // delete image

        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        $data = $this->db->get()->row_array();
        $data = $data['gambar'];
        unlink('./assets/images/barang/' . $data);

        // delete database
        $this->db->where('kode_barang', $kode_barang);
        $this->db->delete('master_barang');
    }

    // push data ke master persediaan

    private function _push_data_persediaan($kode_barang)
    {
        $data = [
            'kode_barang' => $kode_barang,
            'jumlah_persediaan' => 0,
            'jumlah_keranjang' => 0,
            'jumlah_persediaan_sementara' => 0,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('master_persediaan', $data);
    }

    // Get Data Tipe, Satuan, Jenis, Merek


    function get_data_tjms($string)
    {
        $this->db->select('*');
        $this->db->from($string);
        return $this->db->get()->result_array();
    }
}
