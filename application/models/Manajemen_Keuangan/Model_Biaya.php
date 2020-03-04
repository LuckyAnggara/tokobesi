<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Biaya extends CI_Model
{

    function get_data_pegawai()
    {
        $this->db->select('nip, nama_lengkap,jabatan,biaya_pokok,uang_makan');
        $this->db->from('master_pegawai');
        return $this->db->get();
    }

    function get_master_biaya()
    {
        $this->db->select('master_biaya.id,master_biaya.nomor_referensi, master_biaya.total_biaya,master_biaya.status, master_biaya.keterangan, DATE_FORMAT(master_biaya.tanggal, "%d-%b-%y") as tanggal, master_user.nama as nama_admin,');
        $this->db->from('master_biaya');
        $this->db->join('master_user', 'master_user.username = master_biaya.user');
        $this->db->where('user', $this->session->userdata['username']);
        return $this->db->get();
    }

    function random_ref()
    {
        $data = random_string('numeric', 7);
        $this->db->select('nomor_referensi');
        $this->db->from('master_biaya');
        $this->db->where('nomor_referensi', $data);

        $cek = $this->db->get()->num_rows();

        if ($cek > 0) {
            return false;
        } else {
            return $data;
        }
    }

    function tambah_data($post)
    {
        $data = [
            'nomor_referensi' => $post['nomor_referensi'],
            'tanggal' =>  date('Y-m-d H:i:s', strtotime($post['tanggal'])),
            'keterangan' => $post['keterangan'],
            'total_biaya' => '0',
            'status' => '0',
            'user' => $this->session->userdata['username']
        ];
        $this->db->insert('master_biaya', $data);
    }

    function delete_master_stok_opname($no_ref)
    {
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->delete('master_stok_opname');
    }

    function tambah_detail_biaya($post)
    {
        $data = [
            'nomor_referensi' => $post['nomor_referensi'],
            'kategori_biaya' => $post['kategori_biaya'],
            'keterangan' => $post['keterangan'],
            'total' => $this->normal($post['total_biaya']),
            'status' => 0,
            'tanggal' => date('Y-m-d H:i:s'),
            'user' => $this->session->userdata['username']
        ];
        $this->db->insert('detail_biaya', $data);
    }

    function get_detail_master_biaya($no_ref)
    {
        $this->db->select('detail_biaya.id,detail_biaya.nomor_referensi,detail_biaya.keterangan as ket,detail_biaya.total,DATE_FORMAT(detail_biaya.tanggal, "%d %M %Y") as jam,master_kategori_biaya.nama_biaya');
        $this->db->from('detail_biaya');
        $this->db->join('master_kategori_biaya', 'master_kategori_biaya.id = detail_biaya.kategori_biaya');
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->order_by('detail_biaya.id', 'ASC');
        return $this->db->get();
    }

    function get_kategori_biaya($query)
    {
        $this->db->select('*');
        $this->db->from('master_kategori_biaya');
        $this->db->like('nama_biaya', $query);
        $output = $this->db->get();
        return $output;
    }

    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }

    function delete_detail_biaya($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('detail_biaya');
    }

    function get_master_total($no_ref)
    {
        $this->db->select_sum('total');
        $this->db->from('detail_biaya');
        $this->db->where('nomor_referensi', $no_ref);
        $output = $this->db->get();
        return $output->row()->total;
    }

    function get_view_master_biaya($no_ref)
    {
        $this->db->select('master_biaya.id,master_biaya.nomor_referensi, master_biaya.total_biaya,master_biaya.status, master_biaya.keterangan, DATE_FORMAT(master_biaya.tanggal, "%d-%b-%y") as tanggal, master_user.nama as nama_admin,');
        $this->db->from('master_biaya');
        $this->db->join('master_user', 'master_user.username = master_biaya.user');
        $this->db->where('nomor_referensi', $no_ref);
        $data = $this->db->get()->row_array();

        if(isset($data)){
            return $data;
        }else{
            $data = [
                "nomor_referensi" => "",
                "tanggal" => "",
                "keterangan" => "",
            ];
            return $data;
        }
    }

    // view detail

}
