<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Dashboard_Supervisor extends CI_Model
{
    function data_pending_stok_opname()
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d %b %Y") as tanggal');
        $this->db->from('master_stok_opname');
        $this->db->where('status', 1);
        return $this->db->get()->result_array();
    }

    function data_pending_insentif()
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d %b %Y") as tanggal');
        $this->db->from('master_insentif');
        $this->db->join('master_user', 'master_user.username = master_insentif.sales');
        $this->db->where('master_insentif.status', 0);
        return $this->db->get()->result_array();
    }

}
