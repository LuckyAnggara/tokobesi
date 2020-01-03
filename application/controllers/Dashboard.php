<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$data['css'] = 'dashboard/dashboard_css';
		$data['title'] = "Dashboard";
		$this->load->view('template/template_header', $data);
		$this->load->view('template/template_menu');
		$this->load->view('dashboard/dashboard');
		$this->load->view('template/template_right');
		$this->load->view('template/template_js');
		$this->load->view('dashboard/dashboard_js');
		$this->load->view('template/template_app_js');
	}
}
