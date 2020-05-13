<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backup extends CI_Controller
{
    public function index()
    {
        $this->load->dbutil();
        $this->load->helper('file');

        $config = array(
            'format'    => 'sql',
            'filename'    => 'database'
        );

        $backup = $this->dbutil->backup($config);

        $save = './assets/backup/database-' . date("ymdHis") . '.sql';

        write_file($save, $backup);
    }
}
