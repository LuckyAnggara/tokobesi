<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Insentif extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }



    function get_data($bulan)
    {
        $this->db->select('*');
        $this->db->from('master_insentif');
        $this->db->where('EXTRACT( MONTH FROM `tanggal`) = ', $bulan);
        $this->db->where('sales', $this->session->userdata['username']);
        $output = $this->db->get();
        return $output;
    }

    function total_insentif($bulan)
    {
        $this->db->select_sum('total_insentif');
        $this->db->from('master_insentif');
        $this->db->where('status', 1);
        $this->db->where('EXTRACT( MONTH FROM `tanggal`) = ', $bulan);
        $this->db->where('sales', $this->session->userdata['username']);
        $data = $this->db->get()->row_array();
        if ($data['total_insentif'] !== null) {
            return $data['total_insentif'];
        } else {
            return "0";
        }
    }
}
