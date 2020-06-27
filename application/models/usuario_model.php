<?php
defined('BASEPATH') or exit('No direct script access allowed');

class usuario_model extends CI_Model
{
	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	public function Login($username, $password)
	{
		$this->db->where('username', $username);
		$this->db->where('password', $password);
		$hol = $this->db->get('usuarios');

		if ($hol->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}
}
