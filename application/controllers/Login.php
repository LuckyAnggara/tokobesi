<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		$this->load->view('login/login');
	}
	public function cek()
	{

		echo phpinfo();
	}
}
