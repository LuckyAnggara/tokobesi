<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Pegawai extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }
    function get_master_data()
    {
            $this->db->select('*, DATE_FORMAT(tanggal_lahir, "%d %M %Y") as tanggal');
            $this->db->from('master_pegawai');
            $output = $this->db->get();
            return $output;
    }

    function set_user_active($post)
    {
        $data = [
            'status' => 1,
        ];
        $this->db->where('nip', $post['nip']);
        $this->db->update('master_pegawai', $data);
    }

    function set_user_inactive($post)
    {
        $data = [
            'status' => 0,
        ];
        $this->db->where('nip', $post['nip']);
        $this->db->update('master_pegawai', $data);
    }


    function tambah_data_pegawai($post)
    {
        $data = [
            'nip' => strtoupper($post['nip']),
            'ktp' => strtoupper($post['ktp']),
            'nama_lengkap' => strtoupper($post['nama_lengkap']),
            'jenis_kelamin' => strtoupper($post['jenis_kelamin']),
            'alamat' => strtoupper($post['alamat']),
            'kelurahan' => strtoupper($post["kelurahan"]),
            'kecamatan' => strtoupper($post["kecamatan"]),
            'kota' => strtoupper($post["kota"]),
            'tanggal_lahir' => date('Y-m-d H:i:s', strtotime($post['tanggal_lahir'])),
            'tanggal_masuk' => date('Y-m-d H:i:s', strtotime($post['tanggal_masuk'])),
            'pendidikan_terakhir' => strtoupper($post['pendidikan_terakhir']),
            'jabatan' =>  strtoupper($post['jabatan']),
            'nomor_telepon' => strtoupper($post["nomor_telepon"]),
            'nomor_rekening' => strtoupper($post["nama_bank"]) . ' - '.strtoupper($post["nomor_rekening"]),
            'npwp' => strtoupper($post["npwp"]),
            'gambar' => $this->_uploadImage(),
            'user' => $this->session->userdata['username'],

        ];
        $this->db->insert('master_pegawai', $data);
    }

    private function _uploadImage()
    {
        $post = $this->input->post();
        $config['upload_path']          = './assets/images/pegawai/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $post['nip'];
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        } else {
            return "default.png";
        }
    }

}
