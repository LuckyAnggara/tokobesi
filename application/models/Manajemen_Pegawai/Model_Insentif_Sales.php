<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Insentif_Sales extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }



    function get_data()
    {
        $this->db->select('master_insentif.id, master_insentif.nomor_faktur, master_insentif.gross_penjualan,  master_insentif.total_insentif, master_insentif.status, DATE_FORMAT(master_insentif.tanggal,"%d-%b-%Y") as tanggal, master_user.nama as nama_sales');
        $this->db->from('master_insentif');
        $this->db->join('master_user', 'master_user.username = master_insentif.sales');
        $output = $this->db->get();
        return $output;
    }

    function approve_insentif($post)
    {
        $data = [
            "status" => 1
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('master_insentif', $data);

        return "sukses";
    }

    function reject_insentif($post)
    {
        $data = [
            "status" => 99
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('master_insentif', $data);

        return "sukses";
    }
}
