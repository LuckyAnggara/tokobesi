<?php
defined('BASEPATH') or exit('No direct script access allowed');


class Model_Coh extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Setting/Model_Notif', 'modelNotif');

    }

    // global

    function cek_ready_kasir()
    {
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $this->session->userdata('username'));
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status',1);
        return $this->db->get()->num_rows();
    }

    function retur_penjualan($user, $nominal, $no_faktur)
    {
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $user);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status', 1);
        $data_coh = $this->db->get()->row_array();
        $data = [
            'saldo_akhir' => $data_coh['saldo_akhir'] - $nominal,
        ];
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $this->db->update('master_coh', $data);

        // update detail
        $data = [
            'nomor_referensi' => $data_coh['nomor_referensi'],
            'nominal' => $nominal,
            'saldo' => $data_coh['saldo_akhir'] - $nominal,
            'jenis' => 2,
            'keterangan' => 'Retur Penjualan Nomor Faktur : ' . $no_faktur,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    function transaksi_penjualan_tunai($user, $nominal, $no_faktur, $is_transfer = null){
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $user);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status', 1);
        $data_coh = $this->db->get()->row_array();
        $data = [
            'saldo_akhir'=> $data_coh['saldo_akhir'] + $nominal,
        ];
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $this->db->update('master_coh', $data);

        if($is_transfer == null){
            $keterangan =  'Penjualan Tunai Nomor Faktur : '.$no_faktur ;
        }else{
            $keterangan =  'Penjualan Nomor Faktur : '.$no_faktur . ' Pembayaran Melalui Transfer ke Rekening : '. $is_transfer;
        }
        // update detail
        $data = [
            'nomor_referensi' => $data_coh['nomor_referensi'],
            'nominal' => $nominal,
            'saldo' => $data_coh['saldo_akhir'] + $nominal,
            'jenis' => 1,
            'keterangan' => $keterangan,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    function transaksi_penjualan_kredit($user, $nominal, $no_faktur)
    {
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $user);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status', 1);
        $data_coh = $this->db->get()->row_array();
        $data = [
            'saldo_akhir' => $data_coh['saldo_akhir'] + $nominal,
        ];
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $this->db->update('master_coh', $data);

        // update detail
        $data = [
            'nomor_referensi' => $data_coh['nomor_referensi'],
            'nominal' => $nominal,
            'saldo' => $data_coh['saldo_akhir'] + $nominal,
            'jenis' => 1,
            'keterangan' => 'Down Payment (DP) Penjualan Kredit Nomor Faktur : ' . $no_faktur,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    function pembayaran_biaya($user, $post, $no_jurnal){
        $nominal = $this->normal($post['total_biaya']);

        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $user);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status', 1);
        $data_coh = $this->db->get()->row_array();
        $data = [
            'saldo_akhir' => $data_coh['saldo_akhir'] - $nominal,
        ];
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $this->db->update('master_coh', $data);

        // cek nama biaya
        $this->db->select('nama_biaya');
        $this->db->from('master_kategori_biaya');
        $this->db->where('id', $post['kategori_biaya']);
        $data = $this->db->get()->row_array();
        $nama_biaya = $data['nama_biaya'];

        // update detail
        $data = [
            'nomor_referensi' => $data_coh['nomor_referensi'],
            'nominal' => $nominal,
            'saldo' => $data_coh['saldo_akhir'] - $nominal,
            'jenis' => 2,
            'keterangan' => 'Debit Biaya '.$nama_biaya. ' Nomor Jurnal : #' . $no_jurnal,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    function revisi_pembayaran_biaya($user, $post, $pengembalian)
    {
        $nominal = $pengembalian;

        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $user);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status', 1);
        $data_coh = $this->db->get()->row_array();
        $data = [
            'saldo_akhir' => $data_coh['saldo_akhir'] + $nominal,
        ];
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $this->db->update('master_coh', $data);

        // cek nama biaya
        $this->db->select('nama_biaya');
        $this->db->from('master_kategori_biaya');
        $this->db->where('id', $post['kategori_biaya']);
        $data = $this->db->get()->row_array();
        $nama_biaya = $data['nama_biaya'];

        // update detail
        $data = [
            'nomor_referensi' => $data_coh['nomor_referensi'],
            'nominal' => $nominal,
            'saldo' => $data_coh['saldo_akhir'] + $nominal,
            'jenis' => 1,
            'keterangan' => 'Pengembalian Biaya ' . $nama_biaya . ' Nomor Jurnal :#' . $post['nomor_jurnal'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    function delete_pembayaran_biaya($user, $post)
    {
        $nominal = $this->normal($post['total']);

        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $user);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status', 1);
        $data_coh = $this->db->get()->row_array();
        $data = [
            'saldo_akhir' => $data_coh['saldo_akhir'] + $nominal,
        ];
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $this->db->update('master_coh', $data);

        // cek nama biaya
        $this->db->select('nama_biaya');
        $this->db->from('master_kategori_biaya');
        $this->db->where('id', $post['kategori_biaya']);
        $data = $this->db->get()->row_array();
        $nama_biaya = $data['nama_biaya'];

        // update detail
        $data = [
            'nomor_referensi' => $data_coh['nomor_referensi'],
            'nominal' => $nominal,
            'saldo' => $data_coh['saldo_akhir'] + $nominal,
            'jenis' =>1,
            'keterangan' => 'Pengembalian Biaya ' . $nama_biaya . ' Nomor Jurnal :#' . $post['nomor_jurnal'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    function pembayaran_gaji($user, $post, $no_ref)
    {
        $nominal = $this->normal($post['total_pembayaran']);

        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $user);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status', 1);
        $data_coh = $this->db->get()->row_array();
        $data = [
            'saldo_akhir' => $data_coh['saldo_akhir'] - $nominal,
        ];
        $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
        $this->db->update('master_coh', $data);

        // update detail
        $data = [
            'nomor_referensi' => $data_coh['nomor_referensi'],
            'nominal' => $nominal,
            'saldo' => $data_coh['saldo_akhir'] - $nominal,
            'jenis' => 2,
            'keterangan' => 'Debit Pembayaran Gaji Nomor Jurnal : #' . $no_ref,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    function delete_pembayaran_gaji($user, $post)
    {
        $nominal = $this->normal($post['total_pembayaran']);
        if($nominal == 0){
            $this->db->select('*');
            $this->db->from('master_coh');
            $this->db->where('user', $user);
            $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
            $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
            $this->db->where('status', 1);
            $data_coh = $this->db->get()->row_array();
            $data = [
                'saldo_akhir' => $data_coh['saldo_akhir'] + $nominal,
            ];
            $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
            $this->db->update('master_coh', $data);


            // update detail
            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi'],
                'nominal' => $nominal,
                'saldo' => $data_coh['saldo_akhir'] + $nominal,
                'jenis' => 1,
                'keterangan' => 'Pengembalian Pembayaran Gaji Nomor Jurnal :#' . $post['no_ref'],
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);
        }
        
    }


    function cek_dana($user)
    {
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('user', $user);
        $this->db->where('tanggal_input >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal_input <=', date('Y-m-d 23:59:59'));
        $this->db->where('status', 1);
        $data = $this->db->get()->row_array();
        return $data['saldo_akhir'];
    }

    function get_data_pending_user($user)
    {
        $this->db->select('*, master_user.nama as nama_pegawai, DATE_FORMAT(tanggal, "%d %b %y | %H:%i") as jam');
        $this->db->from('master_coh_permintaan');
        $this->db->join('master_user','master_user.username = master_coh_permintaan.user');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00'));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59'));
        $this->db->where('master_coh_permintaan.status', 1);
        $this->db->where('spv', $user);
        return $this->db->get()->result_array();
    }

    //manajer
    function get_data_master_permintaan()
    {
        $this->db->select(' DATE_FORMAT(master_coh_permintaan.tanggal, "%d %b %y | %H:%i") as tanggal , master_coh_permintaan.nominal, master_coh_permintaan.status, master_coh_permintaan.jenis_permintaan, master_coh_permintaan.id,master_coh_permintaan.nomor_referensi, master_user.nama as nama_pegawai');
        $this->db->from('master_coh_permintaan');
        $this->db->join('master_user','master_coh_permintaan.user = master_user.username');
        ///$this->db->where('master_coh_permintaan.tanggal >=', date('Y-m-d 00:00:00'));
        //$this->db->where('master_coh_permintaan.tanggal <=', date('Y-m-d 23:59:59'));
        $this->db->where('level', 3);
        $this->db->order_by('master_coh_permintaan.tanggal', 'DESC');
        return $this->db->get();
    }

    function manajer_reject_coh($post)
    {
        $approval = $this->session->userdata['username'];
        $data = [
            'status' => 99,
            'approval' => $approval,
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('master_coh_permintaan', $data);

        if ($post['jenis'] == 5) { // tutup kas
            $data = [
                'status' => 1, // 2 Buka toko
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            return "sukses_tutup_toko";
        }else{
            return 'sukses';
        }



        
    }

    function manajer_approve_coh($post)
    {
        $approval = $this->session->userdata['username'];
        // update data permintaan
        $data = [
            'status' => 2,
            'approval' => $approval,
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
                'jenis' => 1,
                'keterangan' => 'Penambahan dana',
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);
    
            $data = [
                'saldo_akhir' => $data_coh['saldo_akhir'] + $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);

            $this->modelNotif->approve($approval, $data_coh['user'], 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/');
            return "sukses";
        }else if($post['jenis'] == 2) // setor
        {
            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh['saldo_akhir'] - $post['nominal'],
                'jenis' => 2,
                'keterangan' => 'Penyetoran dana',
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);
    
            $data = [
                'saldo_akhir' => $data_coh['saldo_akhir'] - $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);

            $this->modelNotif->approve($approval, $data_coh['user'], 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/');
            return "sukses";
        } else if ($post['jenis'] == 3) { // mulai kas

            $data = [
                'status' => 1, // 1 mulai toko
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            $this->_tambah_data_awal($post['no_ref'], $data_coh['saldo_awal']);

            $this->modelNotif->approve($approval, $data_coh['user'], 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/');
            return "sukses";

        }else if($post['jenis'] == 5){ // tutup kas
            $data = [
                'status' => 2, // 2 tutup toko
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            $this->modelNotif->approve($approval, $data_coh['user'], 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/');
            return "sukses";

        }
    }


    // spv
    function get_data_master()
    {
        $this->db->select('*, DATE_FORMAT(master_coh.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_coh');
        $this->db->where('status', 4);
        $this->db->or_where('status', 1);
        $this->db->or_where('status', 0);
        $this->db->having('user', $this->session->userdata['username']);
        return $this->db->get();
    }

    function get_data_master_kasir_aktif()
    {
        // cek last nomor_ref yang aktif
        $this->db->select('nomor_referensi');
        $this->db->from('master_coh');
        $this->db->where('status', 1);
        $this->db->where('user', $this->session->userdata('username'));
        $data = $this->db->get()->row_array();

        $this->db->select('master_coh.saldo_awal, master_coh.saldo_akhir, master_coh.status, master_coh.nomor_referensi_spv, DATE_FORMAT(master_coh.tanggal_input, "%d %b %Y") as tanggal, master_user.nama as nama_kasir');
        $this->db->from('master_coh');
        $this->db->join('master_user', 'master_user.username = master_coh.user');
        $this->db->where('master_coh.status !=', 99);

        $this->db->having('nomor_referensi_spv', $data['nomor_referensi']);
        $data = $this->db->get();
        if($data->num_rows > 0){
            return $data;
        }
    }

    function get_data_master_histori()
    {
        $this->db->select('*, DATE_FORMAT(master_coh.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_coh');
        $this->db->where('user', $this->session->userdata['username']);
        $this->db->where('status', 2);
        $this->db->order_by('tanggal_input', 'DESC');
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
        $this->db->select('*, DATE_FORMAT(tanggal_input, "%d %b %y | %H:%i") as jam, DATE_FORMAT(tanggal_input, "%H:%i") as jam_jam');
        $this->db->from('detail_coh');
        $this->db->where('nomor_referensi', $nomor_referensi);
        return $this->db->get();
    }

    function get_data_permintaan_spv()
    {
        $this->db->select('DATE_FORMAT(master_coh_permintaan.tanggal,  "%d %b %y | %H:%i") as jam,master_coh_permintaan.tanggal , master_coh_permintaan.nominal, master_coh_permintaan.status, master_coh_permintaan.jenis_permintaan, master_coh_permintaan.id,master_coh_permintaan.nomor_referensi, master_user.nama as nama_pegawai');
        $this->db->from('master_coh_permintaan');
        $this->db->join('master_user', 'master_coh_permintaan.user = master_user.username');
        $this->db->where('master_coh_permintaan.tanggal >=', date('Y-m-d 00:00:00'));
        $this->db->where('master_coh_permintaan.tanggal <=', date('Y-m-d 23:59:59'));
        $this->db->where('level', 2);
        $this->db->where('spv', $this->session->userdata('username'));
        $this->db->order_by('master_coh_permintaan.tanggal', 'DESC');
        return $this->db->get();
    }


    function cek_data($post)
    {
        $this->db->select('tanggal_input');
        $this->db->from('master_coh');
        $this->db->where('user', $this->session->userdata['username']);
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
        $this->db->select('MAX(CAST(`nomor_referensi` as INT)) AS nomor_referensi');
        $this->db->from('master_coh');
        $data = $this->db->get()->row_array();
        $no = $data['nomor_referensi'];
        $no++;
        $data = [
            'nomor_referensi' => $no,
            'tanggal_input' => date("Y-m-d H:i:s"),
            'level' => 4,
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

    function dana_masuk($post)
    {
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('nomor_referensi', $post['no_ref']);
        $data_coh = $this->db->get()->row_array();
        $nominal = $this->normal($post['dana_masuk']);
        $data = [
            'saldo_akhir' => $data_coh['saldo_akhir'] + $nominal,
        ];
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->update('master_coh', $data);
        
        $data = [
            'nomor_referensi' => $post['no_ref'],
            'nominal' => $nominal,
            'saldo' => $data_coh['saldo_akhir'] + $nominal,
            'jenis' => 1,
            'keterangan' => 'Dana Masuk : ' . $post['keterangan_dana_masuk'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
        return "sukses";
    }

    private function _tambah_data_awal($no, $nominal)
    {
        $data = [
            'nomor_referensi' => $no,
            'saldo' => $nominal,
            'nominal' => $nominal,
            'jenis' => 1,  // 1 cash awal (masuk) 2 tarik baru (masuk) 3 permintaan keluar (keluar) 4 setor ke atas (keluar)
            'keterangan' => 'Saldo Awal',
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('detail_coh', $data);
    }

    function supervisor_approve_coh($post)
    {
        $approval = $this->session->userdata['username'];
        // update data permintaan
        $data = [
            'status' => 2,
            'approval' => $approval,
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('master_coh_permintaan', $data);

        // tarik data coh
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('nomor_referensi' , $post['no_ref']);
        $data_coh =$this->db->get()->row_array();

        // tarik data coh spv

        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('nomor_referensi' , $data_coh['nomor_referensi_spv']);
        $data_coh_spv =$this->db->get()->row_array();
        // tarik data coh spv

        if($post['jenis'] == 1){ // tarik
            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh['saldo_akhir'] + $post['nominal'],
                'jenis' => 1,
                'keterangan' => 'Penambahan dana',
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);
    
            // nambah kas kasir
            $data = [
                'saldo_akhir' => $data_coh['saldo_akhir'] + $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);

            // kurang kas spv
            $data = [
                'saldo_akhir' => $data_coh_spv['saldo_akhir'] - $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $data_coh_spv['nomor_referensi']);
            $this->db->update('master_coh', $data);

            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi_spv'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh_spv['saldo_akhir'] - $post['nominal'],
                'jenis' => 2,
                'keterangan' => 'Penarikan dana Oleh '.$post['nama_pegawai'],
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);

            
            $this->modelNotif->approve($approval, $data_coh['user'], 'Permintaan dana di Setujui', 'manajemen_keuangan/mastercoh/');
            return "sukses";
        }else if($post['jenis'] == 2) // setor
        {

            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh['saldo_akhir'] - $post['nominal'],
                'jenis' => 2,
                'keterangan' => 'Penyetoran dana',
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);
    
            $data = [
                'saldo_akhir' => $data_coh['saldo_akhir'] - $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);

            // tambah kas spv   
            $data = [
                'saldo_akhir' => $data_coh_spv['saldo_akhir'] + $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $data_coh_spv['nomor_referensi']);
            $this->db->update('master_coh', $data);

            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi_spv'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh_spv['saldo_akhir'] + $post['nominal'],
                'jenis' => 1,
                'keterangan' => 'Dana di setorkan oleh ' . $post['nama_pegawai'],
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);

            $this->modelNotif->approve($approval, $data_coh['user'], 'Penyetoran dana di Setujui', 'manajemen_keuangan/mastercoh/');
            return "sukses";


        } else if ($post['jenis'] == 3) { // mulai kas

            $data = [
                'status' => 1, // 1 mulai toko
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            $data = [
                'saldo_akhir' => $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            $this->_tambah_data_awal($post['no_ref'], $data_coh['saldo_awal']);

            // kurang kas spv
            $data = [
                'saldo_akhir' => $data_coh_spv['saldo_akhir'] - $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $data_coh['nomor_referensi_spv']);
            $this->db->update('master_coh', $data);

            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi_spv'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh_spv['saldo_akhir'] - $post['nominal'],
                'jenis' => 3,
                'keterangan' => 'Penarikan dana Oleh '.$post['nama_pegawai'],
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);


            $this->modelNotif->approve($approval, $data_coh['user'], 'Pembukaan Kas di Setujui', 'manajemen_keuangan/mastercoh/');
            return "sukses";

        }else if($post['jenis'] == 5){ // tutup kas
            $data = [
                'status' => 2, // 2 tutup toko
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);
            $this->modelNotif->approve($approval, $data_coh['user'], 'Penutupan Kas di Setujui', 'manajemen_keuangan/mastercoh/');
            return "sukses";

        }
    }

    function supervisor_reject_coh($post)
    {
        $data = [
            'status' => 99,
            'approval' => $this->session->userdata['username'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('master_coh_permintaan', $data);

        $this->db->select('*');
        $this->db->from('master_coh_permintaan');
        $this->db->where('id', $post['id']);
        $data_coh = $this->db->get()->row_array();

        $jenis_permintaan = $data_coh['jenis_permintaan'];

        if($jenis_permintaan == '3'){
            $data = [
                'status' => 99, // 1 mulai toko 99 reject
            ];
            $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
            $this->db->update('master_coh', $data);
        }else if ($jenis_permintaan == '5') {
            $data = [
                'status' => 1, // 5 minta tutup toko tapi di reject jd mulai lagi
            ];
            $this->db->where('nomor_referensi', $data_coh['nomor_referensi']);
            $this->db->update('master_coh', $data);
            // echo $data_coh['nomor_referensi'];
        }
        return "sukses";
              
    }

    

    // UMUM

    function get_data_permintaan($post)
    {
        $this->db->select('DATE_FORMAT(master_coh_permintaan.tanggal,  "%d %b %y | %H:%i") as jam, master_coh_permintaan.tanggal , master_coh_permintaan.nominal, master_coh_permintaan.status, master_coh_permintaan.jenis_permintaan, master_coh_permintaan.id,master_coh_permintaan.nomor_referensi, master_user.nama as nama_pegawai');
        $this->db->from('master_coh_permintaan');
        $this->db->join('master_user','master_coh_permintaan.user = master_user.username');
        $this->db->where('master_coh_permintaan.tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('master_coh_permintaan.tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $this->db->where('master_coh_permintaan.level', 2);
        return $this->db->get();
    }

    function get_data_pending($post)
    {
        $this->db->select('*, DATE_FORMAT(tanggal, "%d %b %y | %H:%i") as jam');
        $this->db->from('master_coh_permintaan');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->where('user', $this->session->userdata['username']);
        return $this->db->get();
    }

    function get_jumlah_data_pending($post)
    {
        $this->db->select('user');
        $this->db->from('master_coh_permintaan');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $this->db->where('nomor_referensi', $post['no_ref']);
        $this->db->where('user', $this->session->userdata['username']);
        $this->db->where('status', 1);
        $data = $this->db->get()->num_rows();
        return $data;
    }

    function get_jumlah_data_permintaan($post)
    {
        $this->db->select('user');
        $this->db->from('master_coh_permintaan');
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($post['tanggal'])));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($post['tanggal'])));
        $this->db->where('spv', $this->session->userdata['username']);
        $this->db->where('status', 1);
        $data = $this->db->get()->num_rows();
        return $data;
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
        
        // cek dulu yg status nya aktif cohnya kasir
        $this->db->select('nomor_referensi_spv,status');
        $this->db->from('master_coh');
        $this->db->having('nomor_referensi_spv', $data_master->nomor_referensi);
        $this->db->where('status', 1);
        $this->db->or_where('status', 4);
        
        $cek = $this->db->get()->num_rows();

        if($cek > 0){
            return "masih_aktif";
        }else{
           

            if ($data_master->saldo_akhir !== "0") {
                return $data_master->saldo_akhir;
            } else {
                $data = [
                    'status' => 4 // artinya minta request ke atasan untuk di tutup
                ];
                $this->db->where('id', $id);
                $this->db->update('master_coh', $data);
                $this->permintaan_tutup_kas($data_master->nomor_referensi);
                return $data_master->saldo_akhir;
            }
        
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
            'level' => 3, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
            'tanggal' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_coh_permintaan', $data);
        $this->modelNotif->request($this->session->userdata['username'], 'manajer', 'Permintaan Dana', 'manajemen_keuangan/mastercoh/');
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

    // kasir

    function spv_no_ref($query)
    {
        $this->db->select('*, master_user.nama as nama_spv, DATE_FORMAT(tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_coh');
        $this->db->join('master_user','master_user.username = master_coh.user');
        $this->db->where('level',4);
        $this->db->like('tanggal_input', date('Y-m-d'));
        $this->db->having('master_coh.status', 1);
        $output = $this->db->get();
        return $output;
    }

    function data_transfer_kasir($query)
    {
        $this->db->select('*, master_user.nama as nama_kasir, DATE_FORMAT(tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_coh');
        $this->db->join('master_user', 'master_user.username = master_coh.user');
        $this->db->where('level', 1);
        $this->db->where('user !=', $this->session->userdata('username'));
        $this->db->like('tanggal_input', date('Y-m-d'));
        $this->db->having('master_coh.status', 1);
        $output = $this->db->get();
        return $output;
    }

    function get_data_master_kasir()
    {
        $this->db->select('*, DATE_FORMAT(master_coh.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_coh');
        $this->db->where('status', 4);
        $this->db->or_where('status', 1);
        $this->db->or_where('status', 0);
        $this->db->having('user', $this->session->userdata['username']);
        $this->db->order_by('tanggal_input', 'DESC');
        return $this->db->get();
    }

    function get_data_master_kasir_histori()
    {
        $this->db->select('*, DATE_FORMAT(master_coh.tanggal_input, "%d %b %Y") as tanggal');
        $this->db->from('master_coh');
        $this->db->where('user', $this->session->userdata['username']);
        $this->db->where('status', 2);
        $this->db->order_by('tanggal_input', 'DESC');
        return $this->db->get();
    }

    function cek_data_kasir($post)
    {
        $this->db->select('tanggal_input');
        $this->db->from('master_coh');
        $this->db->like('tanggal_input', date('Y-m-d', strtotime($post['tanggal'])));
        $this->db->where('user', $this->session->userdata['username']);
        $data = $this->db->get()->num_rows();

        if ($data > 0) {
            return 1;
        } else {
            $this->db->select('*');
            $this->db->from('master_coh');
            $this->db->where('user', $this->session->userdata['username']);
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

    function start_of_day_kasir($post)
    {
        $data_spv = $this->cek_data_spv($post['id_supervisor']);
        if($data_spv['saldo_akhir'] >= $this->normal($post['permintaan_cash'])){
            $this->db->select('MAX(CAST(`nomor_referensi` as INT)) AS nomor_referensi');
            $this->db->from('master_coh');
            $data = $this->db->get()->row_array();
            $no = $data['nomor_referensi'];
            $no++;
            $data = [
                'nomor_referensi' => $no,
                'nomor_referensi_spv' =>$post['id_supervisor'],
                'tanggal_input' => date("Y-m-d H:i:s"),
                'level' => 1,
                'user' => $this->session->userdata['username'],
                'saldo_awal' => $this->normal($post['permintaan_cash']),
                'saldo_proses' => 0,
                'saldo_akhir' => $this->normal($post['permintaan_cash']),
                'status' => 0, // 0 mulai terus nunggu approve, 1 di approve mulai toko, 2 tutup
                'keterangan' => $post['keterangan'],
            ];
            $this->db->insert('master_coh', $data);
            $this->permintaan_awal_dana_kasir($no, $post, $data_spv['user']);
            return "sukses";

        }else
        {
            return "kurang";
        }
    }

    function get_data_permintaan_kasir()
    {
        $this->db->select('DATE_FORMAT(master_coh_permintaan.tanggal,  "%d %b %y | %H:%i") as jam,master_coh_permintaan.tanggal , master_coh_permintaan.nominal, master_coh_permintaan.status, master_coh_permintaan.jenis_permintaan, master_coh_permintaan.id,master_coh_permintaan.nomor_referensi, master_user.nama as nama_pegawai, spv');
        $this->db->from('master_coh_permintaan');
        $this->db->join('master_user', 'master_coh_permintaan.user = master_user.username');
        // $this->db->where('master_coh_permintaan.tanggal >=', date('Y-m-d 00:00:00'));
        // $this->db->where('master_coh_permintaan.tanggal <=', date('Y-m-d 23:59:59'));
        $this->db->where('level', 1);
        $this->db->where('spv', $this->session->userdata('username'));
        $this->db->order_by('master_coh_permintaan.tanggal', 'DESC');
        return $this->db->get();
    }

    function cek_data_spv($id_supervisor)
    {
        $this->db->select('*');
        $this->db->from('master_coh');
        $this->db->where('nomor_referensi', $id_supervisor);
        $data = $this->db->get()->row_array();

        return $data;
    }

    function permintaan_awal_dana_kasir($no_ref, $post,$spv)
    {
        $data = [
            'nomor_referensi' => $no_ref,
            'nominal' => $this->normal($post['permintaan_cash']),
            'jenis_permintaan' => 3, // 3 untuk awal dana
            'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
            'level' => 2, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
            'tanggal' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
            'spv' => $spv,
        ];
        $this->db->insert('master_coh_permintaan', $data);
        return "sukses";
    }

    function permintaan_tarik_dana_kasir($post)
    {
        $data_spv = $this->cek_data_spv($post['id_supervisor']);
        if($data_spv['saldo_akhir'] >= $this->normal($post['tarik_dana'])){
        $data = [
            'nomor_referensi' => $post['no_ref'],
            'nominal' => $this->normal($post['tarik_dana']),
            'jenis_permintaan' => 1, // 1 untuk tarik dana 2 untuk setor dana
            'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
            'level' => 2, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
            'spv' => $data_spv['user'],
            'tanggal' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_coh_permintaan', $data);
        return "sukses";
        }else
        {
        return "kurang";
        }
    }

    function permintaan_setor_dana_kasir($post)
    {
        $data_spv = $this->cek_data_spv($post['id_supervisor']);

        $data = [
            'nomor_referensi' => $post['no_ref'],
            'nominal' => $this->normal($post['setor_dana']),
            'jenis_permintaan' => 2, // 1 untuk tarik dana 2 untuk setor dana
            'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
            'level' => 2, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
            'spv' => $data_spv['user'],
            'tanggal' => date("Y-m-d H:i:s"),
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_coh_permintaan', $data);
        return "sukses";
    }

    function tutup_master_coh_kasir($id)
    {
        $this->db->select('nomor_referensi, saldo_akhir, nomor_referensi_spv');
        $this->db->from('master_coh');
        $this->db->where('id', $id);
        $data_master = $this->db->get()->row();

            if ($data_master->saldo_akhir !== "0") {
                return $data_master->saldo_akhir;
            } else {
                $data = [
                    'status' => 4 // artinya minta request ke atasan untuk di tutup
                ];
                $this->db->where('id', $id);
                $this->db->update('master_coh', $data);
                $this->permintaan_tutup_kas_kasir($data_master);
                return $data_master->saldo_akhir;
            }
    
    }

    function permintaan_tutup_kas_kasir($data_master)
    {
        $data_spv = $this->cek_data_spv($data_master->nomor_referensi_spv);
        $data = [
            'nomor_referensi' => $data_master->nomor_referensi,
            'nominal' => 0,
            'jenis_permintaan' => 5, // 1 untuk tarik dana 2 untuk setor dana , 5 untuk tutup kas
            'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
            'tanggal' => date("Y-m-d H:i:s"),
            'level' => 2, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
            'spv' => $data_spv['user'],
            'user' => $this->session->userdata['username'],
        ];
        $this->db->insert('master_coh_permintaan', $data);
    }

    function permintaan_transfer_dana_kasir($post)
    {
        $data_kasir= $this->cek_data_spv($post['no_ref_kasir']);
        if ($data_kasir['saldo_akhir'] >= $this->normal($post['transfer_dana'])) {
            $data = [
                'nomor_referensi' => $post['no_ref'],
                'nominal' => $this->normal($post['transfer_dana']),
                'jenis_permintaan' => 1, // 1 untuk tarik dana 2 untuk setor dana
                'status' => 1, // 1 untuk pending 2 untuk approve 99 untuk reject
                'level' => 1, // 1 kasir dengan kasir , 2 kasir dengan spv, 3 spv dengan manajer
                'spv' => $data_kasir['user'],
                'tanggal' => date("Y-m-d H:i:s"),
                'user' => $this->session->userdata['username'],
            ];
            $this->db->insert('master_coh_permintaan', $data);
            return "sukses";
        } else {
            return "kurang";
        }
    }

    

    function kasir_approve_coh($post)
    {
        // tarik data coh
        $this->db->select('*, nama as nama_kasir');
        $this->db->from('master_coh');
        $this->db->join('master_user', 'master_user.username = master_coh.user');
        $this->db->where('nomor_referensi', $post['no_ref']);
        $data_coh = $this->db->get()->row_array();

        // tarik data coh kasir lain

        $this->db->select('*, nama as nama_kasir');
        $this->db->from('master_coh');
        $this->db->join('master_user', 'master_user.username = master_coh.user');
        $this->db->where('user', $post['spv']);
        $this->db->where('master_coh.status', 1);
        $data_coh_kasir_lain = $this->db->get()->row_array();
        // tarik data coh kasir lain

        if ($post['jenis'] == 1) { // tarik
            $data = [
                'nomor_referensi' => $data_coh['nomor_referensi'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh['saldo_akhir'] + $post['nominal'],
                'jenis' => 1,
                'keterangan' => 'Transfer Dana dari '. $data_coh_kasir_lain['nama_kasir'],
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);

            // nambah kas kasir
            $data = [
                'saldo_akhir' => $data_coh['saldo_akhir'] + $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $post['no_ref']);
            $this->db->update('master_coh', $data);

            // kurang kas spv
            $data = [
                'saldo_akhir' => $data_coh_kasir_lain['saldo_akhir'] - $post['nominal'],
            ];
            $this->db->where('nomor_referensi', $data_coh_kasir_lain['nomor_referensi']);
            $this->db->update('master_coh', $data);

            $data = [
                'nomor_referensi' => $data_coh_kasir_lain['nomor_referensi'],
                'nominal' => $post['nominal'],
                'saldo' => $data_coh_kasir_lain['saldo_akhir'] - $post['nominal'],
                'jenis' => 2,
                'keterangan' => 'Transfer dana ke ' . $post['nama_pegawai'],
                'tanggal_input' => date("Y-m-d H:i:s"),
            ];
            $this->db->insert('detail_coh', $data);

            $approval = $this->session->userdata['username'];
            // update data permintaan
            $data = [
                'status' => 2,
                'approval' => $approval,
            ];
            $this->db->where('id', $post['id']);
            $this->db->update('master_coh_permintaan', $data);
            return "sukses";

        } else{
            return "error";
        }

        
    }

    function kasir_reject_coh($post)
    {
        $data = [
            'status' => 99,
            'approval' => $this->session->userdata['username'],
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('master_coh_permintaan', $data);

        return "sukses";
    }

}
