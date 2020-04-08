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
            $bonus = $this->bonus($value['nip']);
            $value['bonus'] = $bonus;
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

    function get_detail_master_gaji($no_ref, $jenis_pembayaran)
    {
        $this->db->select('master_pegawai.nama_lengkap,master_pegawai.jabatan, detail_gaji.id as idid, detail_gaji.*');
        $this->db->from('detail_gaji');
        $this->db->join('master_pegawai', 'master_pegawai.nip = detail_gaji.nip');
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->where('status_gaji', $jenis_pembayaran);
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
        return $post['no_ref'];
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

    function bonus($nip)
    {
        // hitung umur bekerja
        $this->db->select('master_pegawai.tanggal_masuk, master_user.role, ');
        $this->db->from('master_pegawai');
        $this->db->join('master_user','master_user.nip = master_pegawai.nip');
        $this->db->where('master_pegawai.nip', $nip);
        $datapegawai = $this->db->get()->row_array();

        list($year, $month, $day) = explode("-", $datapegawai['tanggal_masuk']);
        $year_diff  = date("Y") - $year;
        $month_diff = date("m") - $month;
        $day_diff   = date("d") - $day;
        if ($month_diff < 0) $year_diff--;
        elseif (($month_diff == 0) && ($day_diff < 0)) $year_diff--;

        //echo $year_diff;

        // cek threshold bonus
        $this->db->select_sum('total_penjualan');
        $this->db->from('master_penjualan');
        $this->db->where('tanggal_transaksi', date('Y-m-d'));
        $output = $this->db->get()->row_array();
        $omzet = $output['total_penjualan'];

        $this->db->select('value');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'threshold_bonus');
        $data = $this->db->get()->row_array();
        $threshold_bonus = $data['value'];

        $this->db->select('value');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'bonus_senior');
        $data = $this->db->get()->row_array();
        $bonus_senior = $data['value'];

        $this->db->select('value');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'bonus_junior');
        $data = $this->db->get()->row_array();
        $bonus_junior = $data['value'];


        // cek sales atau bukan..
        if($datapegawai['role'] == '3'){
            $bonus_sales = $this->bonus_sales($nip);
            echo "cek";
            return $bonus_sales;
        }else{
            if ($omzet > $threshold_bonus) {
                if ($year_diff >= 4) {
                    return $bonus_senior;
                } else {
                    return $bonus_junior;
                }
            } else {
                return 0;
            }
        }
    }

    function bonus_sales($nip){
        $bulan = date('m');
        $tahun = date('Y');
        $tanggal = $tahun . "-" . $bulan . "-" . 31;
        $tanggalawal = $tahun . "-" . $bulan . "-" . 01;

        $this->db->select('SUM(`total_insentif`) as total');
        $this->db->from('master_insentif');
        $this->db->where('nip', $nip);
        $this->db->where('tanggal >=', date('Y-m-d 00:00:00', strtotime($tanggalawal)));
        $this->db->where('tanggal <=', date('Y-m-d 23:59:59', strtotime($tanggal)));
        $data = $this->db->get()->row();
        if($data->total !== null){
            return $data->total;
        }else{
            return 0;
        }
    }

    function delete_master_gaji($no_ref)
    {
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->delete('master_gaji');
        return 'ok';
    }

    function ubah_gaji_pokok($post)
    {

        $total = $this->ubah_total($post, 'gaji');
        $data = [
            'total' => $total,
            'gaji_pokok' => $this->normal($post['gaji_pokok']),
            'user' => $this->session->userdata['username']
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('detail_gaji', $data);
    }

    function ubah_uang_makan($post)
    {
        $total = $this->ubah_total($post, 'makan');
        $data = [
            'total' => $total,
            'uang_makan' => $this->normal($post['uang_makan']),
            'user' => $this->session->userdata['username']
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('detail_gaji', $data);
    }

    function ubah_bonus($post)
    {
        $total = $this->ubah_total($post, 'bonus');
        $data = [
            'total' => $total,
            'bonus' => $this->normal($post['bonus']),
            'user' => $this->session->userdata['username']
        ];
        $this->db->where('id', $post['id']);
        $this->db->update('detail_gaji', $data);
    }

    function normal($value)
    {
        $value = str_replace("Rp.", "", $value);
        $value = str_replace(".", "", $value);
        return str_replace(",", "", $value);
    }

    function ubah_total($post, $type)
    {
        $this->db->select('gaji_pokok, uang_makan, bonus');
        $this->db->from('detail_gaji');
        $this->db->where('id', $post['id']);
        $data = $this->db->get()->row_array();
        $gaji_pokok = $data['gaji_pokok'];
        $uang_makan = $data['uang_makan'];
        $bonus = $data['bonus'];
        switch ($type) {
            case 'gaji':
                return $this->normal($post['gaji_pokok']) + $uang_makan + $bonus;
                break;

            case 'makan':
                return $this->normal($post['uang_makan']) + $gaji_pokok + $bonus;
                break;

            case 'bonus':
                return $this->normal($post['bonus']) + $gaji_pokok + $uang_makan;
                break;
        }
        return $data;
    }

    // view detail gaji

    function get_view_master_gaji($no_ref)
    {
        $this->db->select('master_gaji.id,master_gaji.nomor_referensi, master_gaji.total_pembayaran,master_gaji.status, master_gaji.keterangan, DATE_FORMAT(master_gaji.tanggal, "%d-%b-%y") as tanggal, master_user.nama as nama_admin,');
        $this->db->from('master_gaji');
        $this->db->join('master_user', 'master_user.username = master_gaji.user');
        $this->db->where('nomor_referensi', $no_ref);
        return $this->db->get()->row_array();
    }
    function get_view_detail_gaji($no_ref)
    {
        $this->db->select('master_pegawai.nama_lengkap,master_pegawai.jabatan, detail_gaji.id as idid, detail_gaji.*');
        $this->db->from('detail_gaji');
        $this->db->join('master_pegawai', 'master_pegawai.nip = detail_gaji.nip');
        $this->db->where('nomor_referensi', $no_ref);
        $this->db->where('detail_gaji.status', 2);
        $this->db->order_by('master_pegawai.nama_lengkap', 'ASC');
        return $this->db->get();
    }
}
