<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pesan extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->load->model('Setting/Model_Notif', 'modelNotif');

    }
    
    public function reload_pesan()
    {
        $user = $this->session->userdata['username'];
        $data = $this->modelNotif->reload_pesan($user);
        $output = json_encode($data);
        echo $output;
    }

    public function read_pesan()
    {
        $id = $this->input->post('id');
        $data = [
            'is_read' => 1,
        ];

        $this->db->where('id',$id);
        $this->db->update('notif',$data);
    }
}
