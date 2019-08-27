<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vendor_model extends CI_Model {

	public function head($data)
	{
		$this->db->insert('vendor_details',$data);
		return $this->db->affected_rows()!=1? false:true;
	}
	public function select()
	{
		$this->db->select('*');
		$this->db->from('vendor_details');
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
	}


	public function search_vendor()
	{
		if($this->input->post('fromdate')=='')
		{
			$fromdate='';
		}
		else
		{
			$fromdate=date('Y-m-d',strtotime($this->input->post('fromdate')));
			// $fromdate1=str_replace('/', '-', $fromdate);
			// $f=date('Y-m-d',strtotime($fromdate1));
		}
		if($this->input->post('todate')=='')
		{
			$todate='';
		}
		else
		{
			$todate=date('Y-m-d',strtotime($this->input->post('todate')));
			// $todate1=str_replace('/', '-', $todate);
			// $t=date('Y-m-d',strtotime($todate1));
		}
		if(@$fromdate)
		{
			$this->db->where('date >=',$fromdate);
		}
		if(@$todate)
		{
			$this->db->where('date <=',$todate);
		}
		if(@$_POST['type'])
		{
			$this->db->where('type',$_POST['type']);
		}
		return $query= $this->db->get('vendor_details')->result_array();
	}

	public function add($qt)
	{
		$this->db->select('*');
		$this->db->where('id',$qt);
		$this->db->from('vendor_details');
		return $this->db->get()->result_array();
	}

	// public function patry_update($data,$id)
	// {
	// 	$this->db->select('*');
	// 	$this->db->where('id',$id);
	// 	$this->db->from('vendor_details',$data);
	// 	return $this->db->get()->result_array();
	// }

	public function patry_update($data,$id)
	{	
		$this->db->where('id',$id);
		$this->db->update('vendor_details',$data);
		return $this->db->affected_rows()!=1? false:true;
	}
}

