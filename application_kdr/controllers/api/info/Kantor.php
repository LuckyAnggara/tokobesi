<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kantor extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    public function get_data_cabang()
    {
        // $string = $this->input->post('query');
        $this->db->select('*');
        $this->db->from('master_cabang');
        // $this->db->like('nama_cabang', $string);
        $data = $this->db->get()->result_array();

        $output = json_encode($data);
        echo $output;
    }

    public function get_url_cabang()
    {
        $string = $this->input->post('kode_cabang');
        $this->db->select('*');
        $this->db->from('master_cabang');
        $this->db->where('kode_cabang', $string);
        $data = $this->db->get()->row_array();
        $data = $data['link'];
        $output = json_encode($data);
        echo $output;
    }
}
