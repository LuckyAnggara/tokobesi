<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function get_data_bank(){
        $this->db->select('*');
        $this->db->from('data_bank');
        $data = $this->db->get()->result_array();
        $output = json_encode($data);
        echo $output;
    }

}