<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login_model extends CI_Model {

	public function add()
	{

		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$this->db->where('username',$username);
		$this->db->where('password',$password);
		return $this->db->get('login_details')->result_array();
	}
}