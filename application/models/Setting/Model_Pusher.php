<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Pusher extends CI_Model
{
    function pusher_notif_sales()
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

        $data['message'] = 'sales';
        $data['persediaan'] = 'update';
        $data['sales'] = 'update_po';
        $pusher->trigger('my-channel', 'my-event', $data);
    }

    function pusher_update_persediaan()
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
        $data['persediaan'] = 'update';
        $pusher->trigger('my-channel', 'my-event', $data);
    }
}
