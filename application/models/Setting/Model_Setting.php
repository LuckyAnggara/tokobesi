<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Setting extends CI_Model
{
    function get_data_perusahaan()
    {
        $this->db->select('*');
        $this->db->from('setting_perusahaan');
        return $this->db->get()->row_array();
    }
}
