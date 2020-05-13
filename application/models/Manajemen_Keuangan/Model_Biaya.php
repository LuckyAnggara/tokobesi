<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Biaya extends CI_Model
{
    function get_kategori_biaya($query)
    {
        $this->db->select('*');
        $this->db->from('master_kategori_biaya');
        $this->db->like('nama_biaya', $query);
        $this->db->where('status', 0);
        $output = $this->db->get();
        return $output;
    }

    function get_daftar_biaya_hari_ini()
    {
        $periode = $this->modelSetting->get_data_periode();
        $this->db->select('detail_biaya.*, master_kategori_biaya.nama_biaya, DATE_FORMAT(tanggal, "%H:%i") as jam');
        $this->db->from('detail_biaya');
        $this->db->join('master_kategori_biaya', 'master_kategori_biaya.id = detail_biaya.kategori_biaya');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59'));
        $this->db->where('detail_biaya.periode', $periode);

        return $this->db->get();
    }

    function get_daftar_biaya_histori($post)
    {
        $tanggal_awal = $post['tanggal_awal'];
        $tanggal_akhir = $post['tanggal_akhir'];
        $periode = $this->modelSetting->get_data_periode();
        $this->db->select('detail_biaya.*, master_kategori_biaya.nama_biaya, DATE_FORMAT(tanggal, "%d %b %y | %H:%i") as jam_tanggal');
        $this->db->from('detail_biaya');
        $this->db->join('master_kategori_biaya', 'master_kategori_biaya.id = detail_biaya.kategori_biaya');
        if ($tanggal_awal !== null) {
            $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggal_awal)));
            $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal_akhir)));
        }
        $this->db->where('detail_biaya.periode', $periode);
        $this->db->order_by('detail_biaya.id', 'DESC');
        return $this->db->get();
    }

    function get_total_biaya($post)
    {
        $tanggal_awal = $post['tanggal_awal'];
        $tanggal_akhir = $post['tanggal_akhir'];
        $periode = $this->modelSetting->get_data_periode();
        
        $this->db->select_sum('total');
        $this->db->from('detail_biaya');
        if($tanggal_awal == null){
            $this->db->where('tanggal >=', date('Y-m-d 00:00:00'));
            $this->db->where('tanggal <=', date('Y-m-d 23:59:59'));
        }else{
            $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggal_awal)));
            $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal_akhir)));
        }
        $this->db->where('periode', $periode);

    
        $output = $this->db->get();
        return $output->row()->total;
    }

    function tambah_biaya($post)
    {
        $no_jurnal = $this->nomor_jurnal();
        $data = [
            'kategori_biaya' => $post['kategori_biaya'],
            'nomor_jurnal' =>$no_jurnal,
            'keterangan' => $post['keterangan'],
            'total' => $this->normal($post['total_biaya']),
            'status' => 0,
            'tanggal' => date('Y-m-d H:i:s'),
            'user' => $this->session->userdata['username'],
            'periode' => $this->modelSetting->get_data_periode()
        ];
        $this->db->insert('detail_biaya', $data);
        return $no_jurnal;
    }

    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }

    function nomor_jurnal()
    {
        $this->db->select_max('nomor_jurnal');
        $data = $this->db->get('detail_biaya');
        if ($data->row('nomor_jurnal') !== null) {
            $number = substr($data->row('nomor_jurnal'),7);
            $number = $number + 1;
            $tgl = date('dmy');
            return $tgl . '4' . $number;
        } else {
            $tgl = date('dmy');
            return $tgl . '4' . '1';
        }
    }

    // revisi dan delete

    function detail_biaya($id)
    {
        $this->db->select('detail_biaya.total, detail_biaya.id, detail_biaya.keterangan as ket, master_kategori_biaya.nama_biaya');
        $this->db->from('detail_biaya');
        $this->db->join('master_kategori_biaya', 'master_kategori_biaya.id = detail_biaya.kategori_biaya');
        $this->db->where('detail_biaya.id', $id);
        $data_biaya = $this->db->get()->row_array();

        return $data_biaya;
    }

    function revisi_biaya($post)
    {
        $this->db->select('*');
        $this->db->from('detail_biaya');
        $this->db->where('id', $post['id']);
        $data_biaya = $this->db->get()->row_array();

        $real_biaya = $this->normal($post['real_biaya']);
        $data = [
            'total' => $real_biaya,
            'keterangan' => $post['revisi_keterangan']
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('detail_biaya', $data);

        return $data_biaya;
    }

    function delete_biaya($id){
        $this->db->select('*');
        $this->db->from('detail_biaya');
        $this->db->where('id', $id);
        $data_biaya = $this->db->get()->row_array();

        $this->db->where('id', $id);
        $this->db->delete('detail_biaya');

        return $data_biaya;
    }

}
