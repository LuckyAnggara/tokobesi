<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Database extends CI_Controller
{
    public function hap($dummy)
    {
        $this->load->database($dummy, TRUE, FALSE);
    }

    public function import_database()
    {
        $path = 'assets/backup/';
        $sql_filename = 'bbmakmur_kadungora.sql';

        $sql_contents = file_get_contents($path . $sql_filename);
        $sql_contents = explode(";", $sql_contents);
        array_pop($sql_contents);
        $result = $this->db->query('SET FOREIGN_KEY_CHECKS=0');

        foreach ($sql_contents as $key => $value) {
                $this->db->query($value);
        }
        echo "sukses";
    }

    public function backup_database()
    {
        $this->load->dbutil();
        $this->load->helper('file');

        $config = array(
            'format'    => 'sql',
            'filename'    => 'database'
        );

        $backup = $this->dbutil->backup($config);

        $save = './assets/backup/database' . date("ymdHis") . '.sql';

        write_file($save, $backup);
    }
}
