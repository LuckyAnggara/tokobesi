<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Periode extends CI_Model
{

    public function get_data_periode()
    {
        $this->db->select('*');
        $this->db->from('master_periode');
        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {
            $cek = 0;
            $this->db->select('value');
            $this->db->from('master_setting');
            $this->db->where('nama_setting', 'periode');
            $setting = $this->db->get()->row_array();
            if ($setting['value'] == $value['id']) {
                $cek = 1;
            }
            $output[] = [
                'id' => $value['id'],
                'periode' => $value['periode'],
                'cek' => $cek,
            ];
        }
        return $output;
    }
}
