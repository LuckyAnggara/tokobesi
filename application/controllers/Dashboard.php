<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Setting/Model_Setting', 'modelSetting');
	}


	public function index()
	{
		$data['css'] = 'dashboard/dashboard_css';
		$data['setting_perusahaan'] = $this->modelSetting->get_data_perusahaan();
		$this->load->view('template/template_header', $data);
		$this->load->view('template/template_menu');
		$this->load->view('dashboard/dashboard');
		$this->load->view('template/template_right');
		$this->load->view('template/template_footer');
		$this->load->view('template/template_js');
		$this->load->view('dashboard/dashboard_js');
		$this->load->view('template/template_app_js');
	}

	public function jam()
	{
		echo  date("His") . "<br>";
		echo date('Y-m-d H:i:s', strtotime('01/16/2020' . date("His")));
	}
}
