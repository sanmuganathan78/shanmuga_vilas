<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('vat_details',$data);
		return $this->db->affected_rows()!=1? false:true;
	}


	public function select()
	{
		$this->db->select('*');
		$this->db->where('status',1);
		$this->db->from('vat_details');
		return $this->db->get()->result_array();
	}

	// public function user_update($id,$data)
	// {
	// 	$this->db->where('id',$id);
	// 	$this->db->update('login',$data);
	// 	return $this->db->affected_rows()!=1? false:true;

	      
}