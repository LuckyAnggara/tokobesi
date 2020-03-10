<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Coh extends CI_Model
{

    //manajer
    function get_data_master_permintaan()
    {
        $this->db->select('master_coh_permintaan.tanggal , master_coh_permintaan.nominal, master_coh_permintaan.status, master_coh_permintaan.jenis_permintaan, master_coh_permintaan.id,master_coh_permintaan.nomor_referensi, master_user.nama as nama_pegawai');
        $this->db->from('master_coh_permintaan');
        $this->db->join('master_user','master_coh_permintaan.user = master_user.username');
        $this->db->where('level', 3);
        return $this->db->get();
    }

    function manajer_reject_coh($id)
    {
        $data = [
            'status' => 99,
            'approval' => $this->session->userdata['username'],
        ];
        $this->db->where('id', $id);
        $this->db->update('master_coh_permintaan', $data);
        return "sukses";

    }

    function manajer_approve_coh($post)
    {

        // update data permintaan
        $data = [
            'status' => 2,
            'approval' => $this->session->userdata['username'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('master_coh_permintaan', $data);

        // tarik data coh
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('nomor_referensi' , $post['no_ref']);
        $data_coh =$this->db->get()->row_array();

        if($post['jenis'] == 1){ // tarik
            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh['saldo_akhir'] + $post['nominal'],
                'jenis' => 2,
                'keterangan' => 'Penambahan dana',
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);
    
            $data = [
                'saldo_akhir' => $data_coh['saldo_akhir'] + $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);

            return "sukses";
        }else if($post['jenis'] == 2) // setor
        {
            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh['saldo_akhir'] - $post['nominal'],
                'jenis' => 4,
                'keterangan' => 'Penyetoran dana',
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);
    
            $data = [
                'saldo_akhir' => $data_coh['saldo_akhir'] - $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            return "sukses";
        } else if ($post['jenis'] == 3) { // mulai kas

            $data = [
                'status' => 1, // 1 mulai toko
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            $this->_tambah_data_awal($post['no_ref'], $data_coh['saldo_awal']);
            return "sukses";

        }else if($post['jenis'] == 5){ // tutup kas
            $data = [
                'status' => 2, // 2 tutup toko
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            return "sukses";

        }
    }


    // spv
    function get_data_master()
    {
        $this->db->select('*, DATE_FORMAT(master_coh.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_coh');
        $this->db->where('user', $this->session->userdata['username']);
        return $this->db->get();
    }

    function detail_master($string)
    {
        $this->db->select('*, DATE_FORMAT(master_coh.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_coh');
        $this->db->where('id', $string);
        return $this->db->get()->row_array();
    }


    function get_detail_data($nomor_referensi)
    {
        $this->db->select('*, DATE_FORMAT(tanggal_input, "%H:%i") as jam');
        $this->db->from('detail_coh');
        $this->db->where('nomor_referensi', $nomor_referensi);
        return $this->db->get();
    }


    function cek_data($post)
    {
        $this->db->select('tanggal_input');
        $this->db->from('master_coh');
        $this->db->like('tanggal_input', date('Y-m-d', strtotime($post['tanggal'])));
        $data = $this->db->get()->num_rows();

        if ($data > 0) {
            return 1;
        } else {
            $this->db->select('tanggal_input');
            $this->db->from('master_coh');
            $this->db->where('status', 1);
            $this->db->or_where('status', 0);
            $this->db->or_where('status', 4);
            $data = $this->db->get()->num_rows();
            if ($data > 0) {
                return 2;
            } else {
                return 0;
            }
        }
    }

    function start_of_day($post)
    {
        $this->db->select_max('nomor_referensi');
        $this->db->from('master_coh');
        $data = $this->db->get()->row_array();
        $no = $data['nomor_referensi'];
        $no++;
        $data = [
            'nomor_referensi' => $no,
            'tanggal_input' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
            'saldo_awal' => $this->normal($post['permintaan_cash']),
            'saldo_proses' => 0,
            'saldo_akhir' => $this->normal($post['permintaan_cash']),
            'status' => 0, // 0 mulai terus nunggu approve, 1 di approve mulai toko, 2 tutup
            'keterangan' => $post['keterangan'],
        ];
        $this->db->insert('master_coh', $data);
        $this->permintaan_awal_dana($no, $post);
    }

    private function _tambah_data_awal($no, $nominal)
    {
        $data = [
            'nomor_referensi' => $no,
            'saldo' => $nominal,
            'nominal' => $nominal,
            'jenis' => 1,  // 1 cash awal (masuk) 2 tarik baru (masuk) 3 permintaan keluar (keluar) 4 setor ke atas (keluar)
            'keterangan' => 'Saldo Awal Penarikan',
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    // UMUM

    function get_data_permintaan($post)
    {
        $this->db->select('DATE_FORMAT(master_coh_permintaan.tanggal, "%H:%i") as jam, master_coh_permintaan.tanggal , master_coh_permintaan.nominal, master_coh_permintaan.status, master_coh_permintaan.jenis_permintaan, master_coh_permintaan.id,master_coh_permintaan.nomor_referensi, master_user.nama as nama_pegawai');
        $this->db->from('master_coh_permintaan');
        $this->db->join('master_user','master_coh_permintaan.user = master_user.username');
        $this->db->where('master_coh_permintaan.tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('master_coh_permintaan.tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $this->db->where('master_coh_permintaan.level', 2);
        return $this->db->get();
    }

    function get_data_pending($post)
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%H:%i") as jam');
        $this->db->from('master_coh_permintaan');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->where('user', $this->session->userdata['username']);
        return $this->db->get();
    }

    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }


    function delete_master_coh($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_coh');
    }

        function delete_permintaan($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('master_coh_permintaan');
    }

    function tutup_master_coh($id)
    {
        $this->db->select('nomor_referensi, saldo_akhir');
        $this->db->from('master_coh');
        $this->db->where('id', $id);
        $data_master = $this->db->get()->row();

        if($data_master->saldo_akhir !== "0")
        {
            return $data_master->saldo_akhir;
        }else{
        $data = [
            'status' => 4 // artinya minta request ke atasan untuk di tutup
        ];
        $this->db->where('id', $id);
        $this->db->update('master_coh',$data);
        $this->permintaan_tutup_kas($data_master->nomor_referensi);
        return $data_master->saldo_akhir;
        }
        
    }

    // permintaan

    function permintaan_tarik_dana($post)
    {
        $data = [
            'nomor_referensi' => $post['no_ref'],
            'nominal' => $this->normal($post['tarik_dana']),
            'jenis_permintaan' => 1, // 1 untuk tarik dana 2 untuk setor dana
            'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
            'tanggal' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_coh_permintaan', $data);
        return "sukses";
    }

    function permintaan_setor_dana($post)
    {
        $data = [
            'nomor_referensi' => $post['no_ref'],
            'nominal' => $this->normal($post['setor_dana']),
            'jenis_permintaan' => 2, // 1 untuk tarik dana 2 untuk setor dana
            'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
            'level' => 3, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
            'tanggal' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_coh_permintaan', $data);
        return "sukses";
    }

    function permintaan_awal_dana($no_ref, $post)
    {
        $data = [
            'nomor_referensi' => $no_ref,
            'nominal' => $this->normal($post['permintaan_cash']),
            'jenis_permintaan' => 3, // 3 untuk awal dana
            'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
            'level' => 3, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
            'tanggal' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_coh_permintaan', $data);
        return "sukses";
    }

    function permintaan_tutup_kas($no_ref)
    {
        $data = [
            'nomor_referensi' => $no_ref,
            'nominal' => 0,
            'jenis_permintaan' => 5, // 1 untuk tarik dana 2 untuk setor dana , 5 untuk tutup kas
            'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
            'tanggal' => date("Y-m-d H:i:s"),
            'level' => 3, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_coh_permintaan', $data);
    }
}
