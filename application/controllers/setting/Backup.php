<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Backup extends CI_Controller
{
    public function index()
    {
        $this->load->dbutil();
        $this->load->helper('file');

        $config = array(
            'format'    => 'zip',
            'filename'    => 'database.sql'
        );

        $backup = $this->dbutil->backup($config);

        $save = './assets/backup/backupdbse-' . date("ymdHis") . '.zip';

        write_file($save, $backup);
    }
}