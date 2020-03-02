<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Gaji extends CI_Model
{

    function get_data_pegawai()
    {
        $this->db->select('nip, nama_lengkap,jabatan,gaji_pokok,uang_makan');
        $this->db->from('master_pegawai');
        $this->db->where('status', '1');
        return $this->db->get();
    }

    function get_master_gaji()
    {
        $this->db->select('master_gaji.id,master_gaji.nomor_referensi, master_gaji.total_pembayaran,master_gaji.status, master_gaji.keterangan, DATE_FORMAT(master_gaji.tanggal, "%d-%b-%y") as tanggal, master_user.nama as nama_admin,');
        $this->db->from('master_gaji');
        $this->db->join('master_user', 'master_user.username = master_gaji.user');
        $this->db->where('user', $this->session->userdata['username']);
        return $this->db->get();
    }

    function random_ref()
    {
        $data = random_string('numeric', 7);
        $this->db->select('nomor_referensi');
        $this->db->from('master_gaji');
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
            'total_pembayaran' => '0',
            'status' => '0',
            'user' => $this->session->userdata['username']
        ];
        $this->db->insert('master_gaji', $data);
    }

    function delete_master_stok_opname($no_ref)
    {
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->delete('master_stok_opname');
    }

    function tambah_detail_data($post)
    {

        $database = $this->get_data_pegawai();
        $data = $database->result_array();
        $output = array();

        foreach ($data as $value) {
            $value['bonus'] = "0";
            $value['total'] = $value['gaji_pokok'] + $value['uang_makan'] + $value['bonus'];
            $output[] = $value;
        }

        foreach ($output as $key => $value) {
            $data = [
                'nomor_referensi' => $post['nomor_referensi'],
                'nip' => $value['nip'],
                'gaji_pokok' => $value['gaji_pokok'],
                'uang_makan' => $value['uang_makan'],
                'bonus' => $value['bonus'],
                'total' => $value['total'],
                'status' => 0,
                'user' => $this->session->userdata['username']
            ];
            $this->db->insert('detail_gaji', $data);
        }
    }

    function get_detail_master_gaji($no_ref)
    {
        $this->db->select('*, detail_gaji.id as idid');
        $this->db->from('detail_gaji');
        $this->db->join('master_pegawai', 'master_pegawai.nip = detail_gaji.nip');
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->order_by('master_pegawai.nama_lengkap', 'ASC');
        return $this->db->get();
    }

    function bayar_master($post)
    {
        $data = [
            'status' => 2,
            'total_pembayaran' => $post['total_pembayaran'],
        ];
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->update('master_gaji', $data);
    }

    function bayar_detail($post)
    {
        foreach ($post as $key => $value) {
            $data = [
                'status' => 2,
                'tanggal_pembayaran' =>  date("Y-m-d H:i:s"),
                'user' => $this->session->userdata['username']
            ];
            $this->db->where('id', $value);
            $this->db->update('detail_gaji', $data);
        }
    }
}
