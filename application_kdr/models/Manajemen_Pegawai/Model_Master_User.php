<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Model_Master_User extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->helper('string');
    }

    function get_data()
    {
        $this->db->select('*');
        $this->db->from('master_user');
        // $this->db->where('is_del', 0);
        $this->db->where('username !=', $this->session->userdata('username'));
        $this->db->order_by('is_del', 'ASC');
        $output = $this->db->get();
        return $output;
    }

    function get_data_pegawai($query)
    {
        $this->db->select('*');
        $this->db->from('master_pegawai');
        $this->db->like('nip', $query);
        $this->db->or_like('nama_lengkap', $query);
        $this->db->having('has_user', 0);
        $output = $this->db->get();
        return $output;
    }

    function get_data_user($post)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $post['username']);
        return $this->db->get()->row_array();
    }

    function cekData($post)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $post['username']);
        return $this->db->get()->num_rows();
    }

    function tambah_user($post)
    {
        $cek = $this->cekData($post);
        if ($cek > 0) {
            return 'duplikat';
        } else {
            $password = htmlspecialchars(trim(123456));
            $ecnrypt_pw = password_hash($password, PASSWORD_BCRYPT);
            $username = htmlspecialchars(trim($post['username']));
            $data = [
                'username' => $username,
                'nip' => $post['nip'],
                'nama' => $post['nama_pegawai'],
                'role' => $post['role'],
                'status' => 'inActive',
                'password' => $ecnrypt_pw,
                'isActive' => 1,
            ];
            $this->db->insert('master_user', $data);
            $this->update_data_has_user($post['nip']);
        }
    }

    function update_data_has_user($nip)
    {
        $data = [
            'has_user' => '1'
        ];
        $this->db->where('nip', $nip);
        $this->db->update('master_pegawai', $data);
    }

    function set_user_active($post)
    {
        $data = [
            'isActive' => 1,
        ];
        $this->db->where('username', $post['username']);
        $this->db->update('master_user', $data);
    }

    function set_user_inactive($post)
    {
        $data = [
            'isActive' => 0,
        ];
        $this->db->where('username', $post['username']);
        $this->db->update('master_user', $data);
    }

    function reset_password($username)
    {
        $password = htmlspecialchars(trim(123456));
        $ecnrypt_pw = password_hash($password, PASSWORD_BCRYPT);
        $data = [
            'password' => $ecnrypt_pw,
        ];
        $this->db->where('username', $username);
        $this->db->update('master_user', $data);
    }

    function force_logout($username)
    {
        $data = [
            'status' => 0, // 0 k=logout 1 login
        ];
        $this->db->where('username', $username);
        $this->db->update('master_user', $data);
    }

    function delete_data($username)
    {
        $this->db->select('nip');
        $this->db->from('master_user');
        $this->db->where('username', $username);
        $data = $this->db->get()->row_array();

        $nip = $data['nip'];

        $data = array(
            'has_user' => 0,
        );
        $this->db->where('nip', $nip);
        $this->db->update('master_pegawai', $data);

        $data = array(
            'is_del' => 1,
            'isactive' => 0,
        );
        $this->db->where('username', $username);
        $this->db->update('master_user', $data);
    }

    function detail_user($post)
    {
        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $post['username']);
        return $this->db->get()->row_array();
    }

    function _uploadNewGambar()
    {
        $post = $this->input->post();
        $this->_delete_gambar_sebelumnya($post['username']);
        $config['upload_path']          = './assets/images/users/';
        $config['allowed_types']        = 'jpeg|jpg|png';
        $config['file_name']            = random_string('alnum', 16);
        $config['overwrite']            = true;
        $config['max_size']             = 4096; // 4MB
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('gambar')) {
            echo  $this->upload->display_errors();
            return $this->upload->data("file_name");
        } else {
            echo  $this->upload->display_errors();
            return "default.jpg";
        }
    }

    private function _delete_gambar_sebelumnya($username)
    {
        // delete image

        $this->db->select('*');
        $this->db->from('master_user');
        $this->db->where('username', $username);
        $data = $this->db->get()->row_array();
        $data_gambar = $data['gambar'];
        if ($data_gambar != "default.jpg") {
            unlink('./assets/images/users/' . $data);
        }
    }

    function edit_gambar($username)
    {
        $data = array(
            'avatar' => $this->_uploadNewGambar(),
        );
        $this->db->where('username', $username);
        $this->db->update('master_user', $data);
    }

    function get_gambar_baru($username)
    {
        $this->db->select('avatar');
        $this->db->from('master_user');
        $this->db->where('username', $username);
        return $this->db->get()->row_array();
    }

    function change_password($post)
    {
		//$user = $this->db->get('master_user')->row();
		$user = $this->detail_user($post);

		$username = $this->input->post('username');
        $password = $this->input->post('password_lama');
        $password_baru = $this->input->post('password_baru');
        
        if ($user) {
			$isPasswordTrue = password_verify( $password , $user['password']);
				if ($isPasswordTrue) {
                    $password = htmlspecialchars(trim($password_baru));
                    $ecnrypt_pw = password_hash($password, PASSWORD_BCRYPT);
                    $data = array(
                        'password' => $ecnrypt_pw,
                    );
                    $this->db->where('username', $username);
                    $this->db->update('master_user', $data);
				} else {
					echo "salah";
				}
			}
    }

}
