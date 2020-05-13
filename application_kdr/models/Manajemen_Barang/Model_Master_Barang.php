<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_Barang extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url', 'file'));
    }

    function get_data()
    {

        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->join('master_jenis_barang', 'master_jenis_barang.id_jenis_barang = master_barang.jenis_barang');
        $this->db->join('master_merek_barang', 'master_merek_barang.id_merek_barang = master_barang.merek_barang');
        $this->db->where('is_delete', '0');
        $output = $this->db->get();
        return $output;
    }


    function push_satuan($kode_barang)
    {
        $this->db->select("master_barang.harga_pokok,master_satuan_barang.nama_satuan");
        $this->db->from("master_barang");
        $this->db->join('master_satuan_barang', 'master_satuan_barang.id_satuan = master_barang.kode_satuan');
        $this->db->where("master_barang.kode_barang", $kode_barang);
        return $this->db->get()->row_array();
    }

    function cekData()
    {
        $query = $this->db->query("SELECT COUNT(kode_barang) as kodebarang from master_barang");
        $hasil = $query->row();
        if ($hasil->kodebarang !== null) {
            return $hasil->kodebarang;
        } else {
            return "1";
        }
    }

    function view_edit_data($kode_barang)
    {
        $this->db->select('*');
        $this->db->from('master_barang');
        $this->db->where('kode_barang', $kode_barang);
        $query = $this->db->get()->row_array();
        return $query;
    }

    function edit_data($kode_barang)
    {
        $post = $this->input->post();
        $data = array(
            'kode_barang' => $post['edit_kode_barang'],
            'tipe_barang' => 1,
            'jenis_barang' => $post['edit_jenis_barang'],
            'merek_barang' => $post['edit_merek_barang'],
            'kode_supplier' => $post['edit_kode_supplier'],
            'nama_barang' => strtoupper($post['edit_nama_barang']),
            'harga_pokok' => $post["edit_harga_pokok"],
            'harga_satuan' => $post["edit_harga_satuan"],
            'harga_kedua' => $post["edit_harga_kedua"],
            'harga_ketiga' => $post["edit_harga_ketiga"],
            'persediaan_minimum' => $post["edit_persediaan_minimum"],
            'kode_satuan' => $post['edit_satuan'],
            'gambar' => $this->_editUploadImage(),
            'status_jual' => $post["status_jual"],
            'user' => $this->session->userdata['username'],
            'tanggal_input' => date("Y-m-d H:i:s"),
        );
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('master_barang', $data);
    }

    function tambah_data()
    {
        $post = $this->input->post();
        $data = [
            'kode_barang' => $post['kode_barang'],
            'tipe_barang' => 1,
            'jenis_barang' => $post['jenis_barang'],
            'merek_barang' => $post['merek_barang'],
            'kode_supplier' => $post['kode_supplier'],
            'nama_barang' => strtoupper($post['nama_barang']),
            'harga_pokok' => $post["harga_pokok"],
            'harga_satuan' => $post["harga_satuan"],
            'harga_kedua' => $post["harga_kedua"],
            'harga_ketiga' => $post["harga_ketiga"],
            'persediaan_minimum' => $post["persediaan_minimum"],
            'kode_satuan' => $post['satuan'],
            'metode_hpp' => $post['metode_hpp'],
            'komisi_sales' => $post['komisi_sales'],
            'keterangan' => $post['keterangan'],
            'user' => $this->session->userdata['username'],
            'gambar' => $this->_uploadImage(),
            'status_jual' => $post["status_jual"],
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('master_barang', $data);

        // $this->_push_data_persediaan($post['kode_barang']);
    }

    private function _editUploadImage()
    {
        $post = $this->input->post();
        $config['upload_path']          = './assets/images/barang/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = $post['edit_kode_barang'];
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('edit_gambar')) {
            return $this->upload->data("file_name");
        } else {
            return "default.jpg";

            // return $post['edit_kode_barang'];
        }
    }

    private function _uploadImage()
    {
        $post = $this->input->post();
        $config['upload_path']          = './assets/images/barang/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $post['kode_barang'];
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('gambar')) {
            return $this->upload->data("file_name");
        } else {
            return "default.jpg";
        }
    }

    function delete_data($kode_barang)
    {
        // delete image

        // $this->db->select('*');
        // $this->db->from('master_barang');
        // $this->db->where('kode_barang', $kode_barang);
        // $data = $this->db->get()->row_array();
        // $data = $data['gambar'];
        // unlink('./assets/images/barang/' . $data);

        // // delete database
        // $this->db->where('kode_barang', $kode_barang);
        // $this->db->delete('master_barang');

        $data = [
            'is_delete' => 1,
        ];
        $this->db->where('kode_barang', $kode_barang);
        $this->db->update('master_barang', $data);
    }

    // push data ke master persediaan

    private function _push_data_persediaan($kode_barang)
    {
        $data = [
            'kode_barang' => $kode_barang,
            'jumlah_persediaan' => 0,
            'jumlah_keranjang' => 0,
            'jumlah_persediaan_sementara' => 0,
            'tanggal_input' => date("Y-m-d H:i:s"),
        ];
        $this->db->insert('master_persediaan', $data);
    }

    // Get Data Tipe, Satuan, Jenis, Merek


    function get_data_tjms($string)
    {
        $this->db->select('*');
        $this->db->from($string);
        return $this->db->get()->result_array();
    }



    // untuk chart per barang

    function get_statistik_penjualan($post)
    {
        $query =  $this->db->query("SELECT DATE_FORMAT(tanggal_transaksi,'%d - %M') as tanggal,   SUM(jumlah_penjualan) as nilai, IFNULL(tanggal_transaksi, 0) tanggals FROM detail_penjualan WHERE kode_barang = '" . $post['kode_barang'] . "' AND tanggal_transaksi  BETWEEN '" . date('Y-m-d', strtotime($post['tanggal_awal'])) . "' AND '" . date('Y-m-d', strtotime($post['tanggal_akhir'])) . "' GROUP BY DATE(tanggal_transaksi)");
        if ($query->num_rows() > 0) {
            foreach ($query->result() as $data) {
                $hasil[] = $data;
            }
            return $hasil;
        }
    }

    function status_update($post)
    {
        $data = array(
            'status_jual' => $post["status_update"],
        );
        $this->db->where('kode_barang', $post['kode_barang']);
        $this->db->update('master_barang', $data);
    }

    function get_data_jenis($query)
    {
        $this->db->select('*');
        $this->db->from('master_jenis_barang');
        $this->db->like('kode_jenis_barang', $query);
        $this->db->or_like('nama_jenis_barang', $query);
        $output = $this->db->get();
        return $output;
    }

    function get_data_merek($query)
    {
        $this->db->select('*');
        $this->db->from('master_merek_barang');
        $this->db->like('kode_merek_barang', $query);
        $this->db->or_like('nama_merek_barang', $query);
        $output = $this->db->get();
        return $output;
    }

    function get_data_satuan($query)
    {
        $this->db->select('*');
        $this->db->from('master_satuan_barang');
        $this->db->like('kode_satuan', $query);
        $this->db->or_like('nama_satuan', $query);
        $output = $this->db->get();
        return $output;
    }

    function get_data_supplier($query)
    {
        $this->db->select('*');
        $this->db->from('master_supplier');
        $this->db->like('kode_supplier', $query);
        $this->db->or_like('nama_supplier', $query);
        $output = $this->db->get();
        return $output;
    }
}
