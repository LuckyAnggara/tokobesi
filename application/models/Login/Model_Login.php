<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Login extends CI_Model
{
    function cek_login($table, $where)
    {
        return $this->db->get_where($table, $where);
    }

    function update_status($username)
    {
        $data = array(
            'status' => 'login',
            'timestamp' => date("Y-m-d H:i:s"),
        );
        $this->db->where('username', $username);
        $this->db->update('master_user', $data);
    }
    function update_status_logout($username)
    {
        $data = array(
            'status' => 'logout',
            'last_activity' => date("Y-m-d H:i:s"),
        );
        $this->db->where('username', $username);
        $this->db->update('master_user', $data);
    }
}
