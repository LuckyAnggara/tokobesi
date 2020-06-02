<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NotifUtang extends CI_Controller
{
    public function get_data(){

        $hari_ini = date('Y/m/d');
        $output = [];
        $this->db->select('master_utang.*, master_pembelian.kode_supplier, master_supplier.nama_supplier');
        $this->db->from('master_utang');
        $this->db->join('master_pembelian','master_pembelian.nomor_transaksi = master_utang.nomor_transaksi');
        $this->db->join('master_supplier','master_supplier.kode_supplier = master_pembelian.kode_supplier');

        $data = $this->db->get()->result_array();

        foreach ($data as $key => $value) {
            // if($value['tanggal_jatuh_tempo'] - $hari_ini)
            $diff = date_diff(date_create($value['tanggal_jatuh_tempo']), date_create($hari_ini));

            if($diff->days < 30){
                $output[] = [
                    'nomor_transaksi' => $value['nomor_transaksi'],
                    'nama_supplier' => $value['nama_supplier'],
                    'tanggal_jatuh_tempo' => date('d-M-Y', strtotime($value['tanggal_jatuh_tempo'])),
                    'sisa_utang'=> $value['sisa_utang'],
                ];
            }
          
        }

        $output = json_encode($output);
        echo $output;
    }
}