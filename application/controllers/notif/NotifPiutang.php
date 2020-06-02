<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotifPiutang extends CI_Controller
{
    public function get_data(){

        $hari_ini = date('Y/m/d');
        $output = [];
        $this->db->select('master_piutang.*, master_penjualan.id_pelanggan, master_pelanggan.nama_pelanggan');
        $this->db->from('master_piutang');
        $this->db->join('master_penjualan','master_penjualan.no_faktur = master_piutang.no_faktur');
        $this->db->join('master_pelanggan','master_pelanggan.id_pelanggan = master_penjualan.id_pelanggan');

        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {
            // if($value['tanggal_jatuh_tempo'] - $hari_ini)
            $diff = date_diff(date_create($value['tanggal_jatuh_tempo']), date_create($hari_ini));

            if($diff->days < 30){
                $output[] = [
                    'no_faktur' => $value['no_faktur'],
                    'nama_pelanggan' => $value['nama_pelanggan'],
                    'tanggal_jatuh_tempo' => date('d-M-Y', strtotime($value['tanggal_jatuh_tempo'])),
                    'sisa_piutang'=> $value['sisa_piutang'],
                ];
            }
          
        }

        $output = json_encode($output);
        echo $output;
    }
}