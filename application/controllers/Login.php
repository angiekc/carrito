<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{

		if ($this->session->userdata('username')) {
			redirect('Welcome');
		}
		if (isset($_POST['password'])) {
			$this->load->model('usuario_model');
			if ($this->usuario_model->Login($_POST['username'], md5($_POST['password']))) {
				$this->session->set_userdata('username', $_POST['username']);
				redirect('Welcome');
			} else {
				redirect('Login#bad-password');
			}
		}

		$this->load->view('Login.html');
	}
	public function  Logout()
	{
		$this->session->sess_destroy();
		redirect('Login');
	}
}
