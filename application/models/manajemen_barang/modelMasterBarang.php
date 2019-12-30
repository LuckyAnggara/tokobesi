<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ModelMasterBarang extends CI_Model
{

    function get_data($string)

    {
        if ($string == null) {
            $this->db->select('*');
            $this->db->from('master_barang');
            $output = $this->db->get();

            return $output;
        } else {
            $this->db->select('*');
            $this->db->from('master_barang');
            $this->db->like("master_barang.kode_barang", $string);
            $this->db->or_like("nama_barang", $string);
            $this->db->or_like("harga_satuan", $string);
            $output = $this->db->get();
            return $output;
        }
    }

    function cekData($string)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->like("kode_barang", $string);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function tambah_data()
    {
        $post = $this->input->post();
        $data = [
            'kode_barang' => $post['kode_barang'],
            'nama_barang' => $post['nama_barang'],
            'harga_satuan' => $post["harga_satuan"],
            'satuan' => $post['satuan'],
            'gambar' => $post['gambar'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('master_barang', $data);
        // $this->uploadLampiran($post['noSurat']);
    }
}
