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

        $data = [
            'isactive' => 1,
        ];
        $this->db->where('nip', $post['nip']);
        $this->db->update('master_user', $data);
    }

    function set_user_inactive($post)
    {
        $data = [
            'status' => 0,
        ];
        $this->db->where('nip', $post['nip']);
        $this->db->update('master_pegawai', $data);

        $data = [
            'isactive' => 0,
        ];
        $this->db->where('nip', $post['nip']);
        $this->db->update('master_user', $data);
    }


    function tambah_data_pegawai($post)
    {
        $this->db->select('nip');
        $this->db->from('master_pegawai');
        $this->db->where('nip', $post['nip']);
        $cek = $this->db->get()->num_rows();
        if ($cek > 0) {
            return 'duplikat';
        } else {
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
                'nomor_rekening' => strtoupper($post["nama_bank"]) . ' - ' . strtoupper($post["nomor_rekening"]),
                'gaji_pokok' => $this->normal($post["gaji_pokok"]),
                'uang_makan' => $this->normal($post["uang_makan"]),
                'npwp' => strtoupper($post["npwp"]),
                'gambar' => $this->_uploadImage(),
                'user' => $this->session->userdata['username'],
            ];
            $this->db->insert('master_pegawai', $data);
        }
    }

    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }

    private function _uploadImage()
    {
        $post = $this->input->post();
        $config['upload_path']          = './assets/images/pegawai/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = $post['nip'];
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


    /// detail pegawai

    function detail_pegawai($nip)
    {
        $this->db->select('*');
        $this->db->from('master_pegawai');
        $this->db->where('nip', $nip);
        return $this->db->get()->row_array();
    }

    function _uploadNewGambar()
    {
        $post = $this->input->post();
        $this->_delete_gambar_sebelumnya($post['nip']);
        $config['upload_path']          = './assets/images/pegawai/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = random_string('alnum', 16);
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('gambar')) {
            echo  $this->upload->display_errors();
            return $this->upload->data("file_name");
        } else {
            echo  $this->upload->display_errors();
            return "default.jpg";
        }
    }

    private function _delete_gambar_sebelumnya($nip)
    {
        // delete image

        $this->db->select('*');
        $this->db->from('master_pegawai');
        $this->db->where('nip', $nip);
        $data = $this->db->get()->row_array();
        $data_gambar = $data['gambar'];
        if ($data_gambar != "default.jpg") {
            unlink('./assets/images/pegawai/' . $data);
        }
    }

    function edit_gambar($nip)
    {
        $data = array(
            'gambar' => $this->_uploadNewGambar(),
        );
        $this->db->where('nip', $nip);
        $this->db->update('master_pegawai', $data);
    }

    function get_gambar_baru($nip)
    {
        $this->db->select('gambar');
        $this->db->from('master_pegawai');
        $this->db->where('nip', $nip);
        return $this->db->get()->row_array();
    }

    function edit_data_umum($nip)
    {
        $post = $this->input->post();

        $data = [
            'ktp' => strtoupper($post['ktp']),
            'nama_lengkap' => strtoupper($post['nama_lengkap']),
            'jenis_kelamin' => strtoupper($post['jenis_kelamin']),
            'tanggal_lahir' => date('Y-m-d H:i:s', strtotime($post['tanggal_lahir'])),
            'pendidikan_terakhir' => strtoupper($post['jenis_kelamin']),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('nip', $nip);
        $this->db->update('master_pegawai', $data);
    }

    function edit_data_alamat($nip)
    {
        $post = $this->input->post();

        $data = [
            'alamat' => strtoupper($post['alamat']),
            'kelurahan' => strtoupper($post['kelurahan']),
            'kecamatan' => strtoupper($post['kecamatan']),
            'kota' => strtoupper($post['kota']),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('nip', $nip);
        $this->db->update('master_pegawai', $data);
    }

    function edit_data_pekerjaan($nip)
    {
        $post = $this->input->post();

        $data = [
            'jabatan' => strtoupper($post['jabatan']),
            'gaji_pokok' => $this->normal($post["gaji_pokok"]),
            'uang_makan' => $this->normal($post["uang_makan"]),
            'tanggal_masuk' => date('Y-m-d H:i:s', strtotime($post['tanggal_masuk'])),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('nip', $nip);
        $this->db->update('master_pegawai', $data);
    }

    function edit_data_lainnya($nip)
    {
        $post = $this->input->post();

        $data = [
            'nomor_telepon' => strtoupper($post["nomor_telepon"]),
            'nomor_rekening' => strtoupper($post["nama_bank"]) . ' - ' . strtoupper($post["nomor_rekening"]),
            'npwp' => strtoupper($post["npwp"]),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('nip', $nip);
        $this->db->update('master_pegawai', $data);
    }
}
