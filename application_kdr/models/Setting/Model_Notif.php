<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Notif extends CI_Model
{

    public function reload_pesan($user)
    {
        $this->db->select('*');
        $this->db->from('notif');
        $this->db->join('master_user','master_user.username = notif.dari');
        $this->db->where('ke', $user);
        $this->db->where('is_deleted',0);
        return $this->db->get()->result_array();
    }

    public function request($dari, $ke, $pesan, $link = null)
    {
        $data = [
            'dari' => $dari,
            'ke'=> $ke,
            'pesan' => $pesan,
            'link'=>$link,
            'tanggal' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('notif',$data);
        $this->_pusherNotif($dari);
    }

    public function approve($dari, $ke, $pesan, $link = null)
    {
        $data = [
            'dari' => $dari,
            'ke'=> $ke,
            'pesan' => $pesan,
            'link'=>$link,
            'tanggal' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('notif',$data);
        $this->_pusherNotif($dari);
    }



    private function _pusherNotif($dari) 
    {
        require_once(APPPATH . 'libraries/vendor/autoload.php');
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
        $pusher = new Pusher\Pusher(
            'a198692078b54078587e',
            'bbcd6e359ab9b8fb37d2',
            '942885',
            $options
        );

        $data['notif'] = [
            'is_notif' => 'yes',
            'pesan' => 'Notifikasi baru',
            'dari' => $dari  
        ];
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}