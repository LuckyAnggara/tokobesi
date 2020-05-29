<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Setting extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->helper('string');
    }

    public function get_data_perusahaan()
    {
        $this->db->select('*');
        $this->db->from('master_setting');
        $data = $this->db->get()->result_array();

        $output = array();
        foreach ($data as $key => $value) {
            $output[$value['nama_setting']] = $value['value'];
        }
        return $output;
    }

    public function prefixFaktur()
    {
        $this->db->select('prefix_faktur');
        $this->db->from('setting_perusahaan');
        $data = $this->db->get()->row_array();
        return $data['prefix_faktur'];
    }

    public function edit_gambar()
    {
        $data = array(
            'value' => $this->_uploadNewGambar(),
        );
        $this->db->where('nama_setting', 'logo_perusahaan');
        $this->db->update('master_setting', $data);
    }

    public function get_gambar_baru()
    {
        $this->db->select('value');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'logo_perusahaan');
        return $this->db->get()->row_array();
    }

    public function _uploadNewGambar()
    {
        $this->_delete_gambar_sebelumnya();
        $config['upload_path'] = './assets/images/';
        $config['allowed_types'] = 'jpeg|jpg|png';
        $config['file_name'] = random_string('alnum', 16);
        $config['overwrite'] = true;
        $config['max_size'] = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('edit_gambar')) {
            return $this->upload->data("file_name");
        } else {
            return "";
        }
    }

    private function _delete_gambar_sebelumnya()
    {
        $this->db->select('*');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'logo_perusahaan');
        $data = $this->db->get()->row_array();
        $data_gambar = $data['value'];
        if ($data_gambar !== "") {
            unlink('./assets/images/' . $data_gambar);
        }
    }

    // script confirm perubahan setting

    public function confirm_setting($key, $value)
    {
        if (is_array($value)) {
            $value = join(',', $value);
        }
        $data = [
            'value' => $value,
        ];

        $this->db->where('nama_setting', $key);
        $this->db->update('master_setting', $data);
    }

    public function data_menu()
    {
        $role = $this->session->userdata('menu');
        $role_menu = explode(',', $role);

        foreach ($role_menu as $key => $value) {

            $menu = $this->_push_menu($value);

            $menu['sub_menu'] = $this->_push_sub_menu($menu['id']);

            $main_menu[] = $menu;
        }
        return $main_menu;
    }

    private function _push_menu($id)
    {
        $this->db->select('*');
        $this->db->from('tabel_menu');
        $this->db->where('id', $id);
        return $this->db->get()->row_array();
    }

    private function _push_sub_menu($id)
    {
        $this->db->select('*');
        $this->db->from('tabel_submenu');
        $this->db->where('main_menu', $id);
        $data = $this->db->get();
        $cek = $data->num_rows();
        if ($cek > 0) {
            return $data->result_array();
        }
    }

    public function get_data_periode()
    {
        $this->db->select('*');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'periode');
        $data = $this->db->get()->row_array();
        return $data['value'];
    }

    public function cekTokenApi()
    {
        $this->db->select('*');
        $this->db->from('master_setting');
        $this->db->where('nama_setting', 'token_api');
        $data = $this->db->get()->row_array();
        return $data['value'];

    }

    public function tambahPeriode($post){
        $data = [
            'periode'=> $post['periode'],
            'periode_awal'=> date('Y-m-d', strtotime($post['periode_awal'])),
            'periode_akhir'=> date('Y-m-d', strtotime($post['periode_akhir'])),
        ];
        $this->db->insert('master_periode', $data);
    }
}
