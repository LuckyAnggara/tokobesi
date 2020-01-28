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
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		$where = array(
			'username' => $username,
			'password' => $password, // md5($password)
		);

		$cek = $this->modelLogin->cek_login("master_user", $where)->row_array();

		if (isset($cek)) {
			echo "login";
			// if ($cek['status'] == "login") {
			// 	echo "login";
			// } else {
			$data_session = array(
				'username' => $username,
				'status' => "login",
				'role' => $role,
				'avatar' => $cek['avatar']
			);
			$this->session->set_userdata($data_session);
			// 	$this->modelLogin->update_status($username);
			// }
		} else {
			echo "false";
		}
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
