<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vertical extends CI_Controller
{
    public function index()
    {
        $data['css'] = 'dashboard/dashboard_css';
        $data['title'] = "Dashboard";
        $this->load->view('template_horizontal/template_header', $data);
        $this->load->view('template_horizontal/template_menu', $data);
        $this->load->view('template_horizontal/template_content', $data);
        $this->load->view('template_horizontal/template_rightbar', $data);
        $this->load->view('template_horizontal/template_js', $data);
        $this->load->view('template_horizontal/template_app_js', $data);
    }
}