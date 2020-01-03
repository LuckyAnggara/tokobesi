<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelMasterSupplier extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function get_data($string)
    {
        if ($string == null) {
            $this->db->select('*');
            $this->db->from('master_supplier');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_supplier');
            $this->db->like("master_supplier.kode_supplier", $string);
            $this->db->or_like("nama_supplier", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function cekData($string)
    {
        $this->db->select('*');
        $this->db->from('master_supplier');
        $this->db->like('kode_supplier', $string);
        $query = $this->db->get();
        if($query->num_rows() > 0 ){
            $this->_generate_kode_supplier();
        }
    }

    private function _generate_kode_supplier()
    {
        $num =  random_string('numeric',3);
        $str = random_string('alpha',3);
        return $str.$num;
    }

    function view_edit_data($kode_supplier)
    {
        $this->db->select('*');
        $this->db->from('master_supplier');
        $this->db->where('kode_supplier', $kode_supplier);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function edit_data($kode_supplier)
    {
        $post = $this->input->post();
        $nomor_rekening = $post['edit_bank_rekening'].'-'.$post['edit_nomor_rekening'].'-'.$post['edit_nama_rekening'];
        $data = [
            'kode_supplier' => $post['edit_kode_supplier'],
            'nama_supplier' => strtoupper($post['edit_nama_supplier']),
            'alamat' => $post["edit_alamat"],
            'nomor_telepon' => $post['edit_nomor_telepon'],
            'npwp' => $post['edit_npwp'],
            'nomor_rekening' => $nomor_rekening,
            'keterangan' => $post['edit_keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->where('kode_supplier', $kode_supplier);
        $this->db->update('master_supplier', $data);
    }

    function tambah_data()
    
    {
        $post = $this->input->post();
        $nomor_rekening = $post['bank_rekening'].'-'.$post['nomor_rekening'].'-'.$post['nama_rekening'];
        $data = [
            'kode_supplier' => $post['kode_supplier'],
            'nama_supplier' => strtoupper($post['nama_supplier']),
            'alamat' => $post["alamat"],
            'nomor_telepon' => $post['nomor_telepon'],
            'npwp' => $post['npwp'],
            'nomor_rekening' => $nomor_rekening,
            'keterangan' => $post['keterangan'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('master_supplier', $data);
    }

    function delete_data($kode_supplier)
    {
        $this->db->where('kode_supplier', $kode_supplier);
        $this->db->delete('master_supplier');
    }

    function get_kode_supplier()
    {
        $kode = $this->_generate_kode_supplier();
        return strtoupper($kode);
    }
}
