<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Faktur extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Manajemen_Penjualan/Model_Penjualan_Barang', 'modelPenjualan');
        $this->load->model('Setting/Model_Faktur', 'modelFaktur');

        if ($this->session->userdata('status') != "login") {
            redirect(base_url("login"));
        }
    }

    public function set_dummy()
    {
        $id = $this->input->post('id');
            switch ($id) {
            case '1':
                echo $this->modelFaktur->nomor_acak();
                break;
            case '2':
                echo $this->modelFaktur->nomor_urut();
                break;
            case '3':
                echo $this->modelFaktur->tanggal_nomor_urut();
                break;
            }
    }

    public function setFaktur()
    {
        echo $this->modelPenjualan->fakturfaktur();
    }

}