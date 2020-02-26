<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Faktur extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('string'));
    }

    function nomor_acak()
    {
        $no_faktur = random_string('numeric', 7);
        $cek = $this->_cek($no_faktur);
        if($cek > 0)
        {
            $this->nomor_acak();
        }else{
            return $no_faktur;
        }
    }

    private function _cek($no_faktur)
    {
        $this->db->select('no_faktur');
        $this->db->from('master_penjualan');
        $this->db->where('no_faktur', $no_faktur);
        return $this->db->get()->num_rows();
    }

    function nomor_urut()
    {
        $this->db->select_max('no_faktur');
        $data = $this->db->get('master_penjualan');
        if ($data->row('no_faktur') !== null) {
            $number = substr($data->row('no_faktur'), -3);
            $number = $number + 1;
            return sprintf("%07d", $number);
        } else {
            return sprintf("%07d", 1);
        }

        // $this->db->like('no_faktur', date('dmy'));
        // $data = $this->db->get('master_penjualan');
        // if ($data->row('no_faktur') !== null) {
        //     return substr($data->row('no_faktur'), -3);
        // } else {
        //     return 0;
        // }
    }

    function tanggal_nomor_urut()
    {
        $this->db->select_max('no_faktur');
        $data = $this->db->get('master_penjualan');
        if ($data->row('no_faktur') !== null) {
            $number = substr($data->row('no_faktur'), -3);
            $number = $number + 1;
            $tgl = date('dmy');
            return $tgl. sprintf("%03d", $number);
        } else {
            $tgl = date('dmy');
            return $tgl . sprintf("%03d", 1);
        }
    }

    function _generate_no_faktur($post)
    {
        $number = $this->nomor_urut($post);
        $number = $number + 1;
        $no_faktur = date('dmy') . sprintf("%03d", $number);
        $no_faktur = $this->session->userdata['faktur_prefix'] . $no_faktur;
        return $no_faktur;
    }

    public function set_faktur()
    {
        $this->db->select('value');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'nomor_faktur');
        $data = $this->db->get()->row_array();
        $id = $data['value'];
        
        switch ($id) {
            case '1':
                return $this->modelFaktur->nomor_acak();
                break;
            case '2':
                return $this->modelFaktur->nomor_urut();
                break;
            case '3':
                return $this->modelFaktur->tanggal_nomor_urut();
                break;
        }
    }
}
