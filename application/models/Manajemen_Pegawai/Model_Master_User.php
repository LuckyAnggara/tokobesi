<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_User extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }



    function get_data()
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username !=', $this->session->userdata('username'));
        $output = $this->db->get();
        return $output;
    }

    function get_data_pegawai($query)
    {
        $this->db->select('*');
        $this->db->from('master_pegawai');
        $this->db->like('nip', $query);
        $this->db->or_like('nama_lengkap', $query);
        $this->db->having('has_user', 0);
        $output = $this->db->get();
        return $output;
    }

    function get_data_user($post)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $post['username']);
        return $this->db->get()->row_array();
    }

    function tambah_user($post)
    {

        $password = htmlspecialchars(trim(123456));
        $ecnrypt_pw = password_hash($password, PASSWORD_BCRYPT);
        $username = htmlspecialchars(trim($post['username']));
        $data = [
            'username' => $username,
            'nip' => $post['nip'],
            'nama' => $post['nama_pegawai'],
            'role' => $post['role'],
            'status' => 'inActive',
            'password' => $ecnrypt_pw,
            'isActive' => 1,
        ];
        $this->db->insert('master_user', $data);
        $this->update_data_has_user($post['nip']);
    }

    function update_data_has_user($nip)
    {
        $data = [
            'has_user' => '1'
        ];
        $this->db->where('nip', $nip);
        $this->db->update('master_pegawai', $data);
    }

    function set_user_active($post)
    {
        $data = [
            'isActive' => 1,
        ];
        $this->db->where('username', $post['username']);
        $this->db->update('master_user', $data);
    }

    function set_user_inactive($post)
    {
        $data = [
            'isActive' => 0,
        ];
        $this->db->where('username', $post['username']);
        $this->db->update('master_user', $data);
    }

    function reset_password($username)
    {
        $password = htmlspecialchars(trim(123456));
        $ecnrypt_pw = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'password' => $ecnrypt_pw,
        ];
        $this->db->where('username', $username);
        $this->db->update('master_user', $data);
    }

    function force_logout($username)
    {
        $data = [
            'status' => 0, // 0 k=logout 1 login
        ];
        $this->db->where('username', $username);
        $this->db->update('master_user', $data);
    }
}
