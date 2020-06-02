<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bank extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Setting/Model_Setting', 'modelSetting');
        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    // data bank untuk di master penjualan
    public function get_data_bank(){
        $data = $this->modelSetting->get_data_bank();
        $output = json_encode($data);
        echo $output;
    }

    // data bank untuk di datatable menu setting

    public function get_data_bank_table(){
        $data = $this->modelSetting->get_data_bank();
        $output = array(
            // "draw" => $_POST['draw'],
            "recordsTotal" => $this->db->count_all_results(),
            "recordsFiltered"  => 0,
            "data" => $data
        );

        $output = json_encode($output);
        echo $output;
    }

    public function tambahBank(){
        $post = $this->input->post();
        $this->modelSetting->tambahBank($post);
    }

    public function delete_data(){
        $post = $this->input->post();
        $this->modelSetting->delete_data_bank($post);
    }

}