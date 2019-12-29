<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelMasterStock extends CI_Model
{
    function get_data_allV2()
    {
        $this->datatables->select('*, master_stock.id, master_stock.jumlah_stock');
        $this->datatables->from('master_barang');
        $this->datatables->add_column(
            'aksi',
            '<button type="button" class="btn btn-icon waves-effect waves-light btn-success btn-sm" onclick="warningDelete($1)"><i class="fa  fa-search" ></i></button>',
            'no'
        );
        return $this->datatables->generate();
    }

    function get_data($string)

    {
        if ($string == null) {
            $this->db->select('master_barang.*, master_stock.id, master_stock.jumlah_stock');
            $this->db->from('master_barang');
            $this->db->join('master_stock', 'master_stock.kd_barang = master_barang.kd_barang', 'left');
            $output = $this->db->get();


            return $output;
        } else {
            $this->db->select('master_barang.*, master_stock.id, master_stock.jumlah_stock');
            $this->db->from('master_barang');
            $this->db->join('master_stock', 'master_stock.kd_barang = master_barang.kd_barang', 'left');
            $this->db->like("master_barang.kd_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $this->db->or_like("harga_satuan", $string);
            $this->db->or_like("jumlah_stock", $string);

            $output = $this->db->get();
            return $output;
        }
    }
}
