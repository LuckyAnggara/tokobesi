<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Coh extends CI_Model
{
    function get_master_coh()
    {
        $this->db->select('*, DATE_FORMAT(master_coh.tanggal_input, "%d-%b-%y") as tanggal');
        $this->db->from('master_coh');
        $this->db->join('master_user', 'master_user.username = master_coh.user');
        $this->db->where('user', $this->session->userdata['username']);
        return $this->db->get();
    }

    function cek_data($post)
    {
        $this->db->select('tanggal_input');
        $this->db->from('master_coh');
        $this->db->like('tanggal_input', date('Y-m-d', strtotime($post['tanggal'])));
        $data = $this->db->get()->num_rows();

        if($data > 0)
        {
            return 1;
        }else{
            return 0;
        }
    }

    function start_of_day($post)
    {
        $data = [
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
            'cash_awal' => $this->normal($post['permintaan_cash']),
            'cash_proses' => 0,
            'cash_akhir' => $this->normal($post['permintaan_cash']),
            'keterangan' => $post['keterangan'],
        ];
        $this->db->insert('master_coh',$data);
    }

    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }
}
