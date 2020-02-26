<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Setting/Model_Setting', 'modelSetting');
		$this->load->model('Login/Model_Login', 'modelLogin');
	}


	public function index()
	{
		$data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
		$this->load->view('login/login', $data);
	}

	function aksi_login()
	{
		$post = $this->input->post();
		$this->db->where('username', $post["username"]);
		//$user = $this->db->get('master_user')->row();
		$user = $this->modelLogin->detail_user($post["username"]);

		$username = $this->input->post('username');
		$password = $this->input->post('password');

		if ($user) {
			$isPasswordTrue = password_verify($post["password"], $user->password);
			$isactive = $user->isactive;
			if ($isactive == "0") {
				echo "notactive";
			} else {
				if ($isPasswordTrue) {
					$data_session = array(
						'username' => $username,
						'nama' => $user->nama,
						'status' => "login",
						'role' => $user->role,
						'avatar' => $user->avatar,
						'menu' => $user->menu,
					);
					$this->session->set_userdata($data_session);

					return true;
				} else {
					echo "false";
				}
			}
			// jika password benar dan dia admin

		}
		// login gagal
		echo "none";
	}


	function logout()
	{
		$username = $this->session->userdata['username'];
		$this->modelLogin->update_status_logout($username);
		$this->session->sess_destroy();
		redirect(base_url('login'));
	}

	function forceLogout()
	{
		$username = $this->session->userdata['username'];
		$this->modelLogin->update_status_logout($username);
		$this->session->sess_destroy();
	}
}
