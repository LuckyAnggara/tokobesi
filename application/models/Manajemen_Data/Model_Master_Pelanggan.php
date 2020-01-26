<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Pelanggan extends CI_Model
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
            $this->db->from('master_pelanggan');
            $this->db->where('status_pelanggan', 0);
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_pelanggan');
            $this->db->where('status_pelanggan', 0);
            $this->db->like("master_pelanggan.id_pelanggan", $string);
            $this->db->or_like("nama_pelanggan", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function cekData($string)
    {
        $this->db->select('*');
        $this->db->from('master_pelanggan');
        $this->db->like('id_pelanggan', $string);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $this->_generate_id_pelanggan();
        }
    }

    private function _generate_id_pelanggan()
    {
        $num =  random_string('numeric', 4);
        $str = random_string('alpha', 3);
        // cek takut double

        return $str . $num;
    }

    private function _cek_id($id)
    {
        $this->db->select('*');
        $this->db->from('master_pelanggan');
        $this->db->where('id_pelanggan',  $id);
        return $this->db->get()->num_rows();
    }

    function view_edit_data($id_pelanggan)
    {
        $this->db->select('*');
        $this->db->from('master_pelanggan');
        $this->db->where('id_pelanggan', $id_pelanggan);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function edit_data($id_pelanggan)
    {
        $post = $this->input->post();
        $nomor_rekening = $post['edit_bank_rekening'] . '-' . $post['edit_nomor_rekening'] . '-' . $post['edit_nama_rekening'];
        $data = [
            'id_pelanggan' => $post['edit_id_pelanggan'],
            'tipe_pelanggan' => $post['edit_tipe_pelanggan'],
            'nama_pelanggan' => strtoupper($post['edit_nama_pelanggan']),
            'alamat' => $post["edit_alamat"],
            'email' => $post["edit_email"],
            'nomor_telepon' => $post['edit_nomor_telepon'],
            'npwp' => $post['edit_npwp'],
            'nomor_rekening' => $nomor_rekening,
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->update('master_pelanggan', $data);
    }

    function tambah_data()

    {
        $post = $this->input->post();
        $nomor_rekening = $post['bank_rekening'] . '-' . $post['nomor_rekening'] . '-' . $post['nama_rekening'];
        $data = [
            'id_pelanggan' => $post['id_pelanggan'],
            'tipe_pelanggan' => $post['tipe_pelanggan'],
            'nama_pelanggan' => strtoupper($post['nama_pelanggan']),
            'alamat' => $post["alamat"],
            'email' => $post["email"],
            'nomor_telepon' => $post['nomor_telepon'],
            'npwp' => $post['npwp'],
            'nomor_rekening' => $nomor_rekening,
            'status_pelanggan' => 0,
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_pelanggan', $data);
    }

    function delete_data($id_pelanggan)
    {
        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->delete('master_pelanggan');
    }

    function get_id_pelanggan()
    {
        $id = $this->_generate_id_pelanggan();

        $cek = $this->_cek_id(strtoupper($id));
        if ($cek > 1) {
            $this->_generate_id_pelanggan();
        } else {
            return strtoupper($id);
        }
    }
}
