<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Joborder_model extends CI_Model {

		    
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

 
	public function add($data)
	{
        $this->db->insert('job_details',$data);
        return $this->db->affected_rows()!=1? false:true;
	}

  public function updates($data,$id)
{
    $this->db->where('id',$id);   
  $this->db->update('job_details',$data);
  return $this->db->affected_rows() !=1 ? false:true;
}

	public function select()
	{
		$this->db->select('*');
		$this->db->from('job_details');
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
	} 

  public function select_pending()
  {
    $this->db->select('*');
    $this->db->where('balanceqty >',0);
    $this->db->from('job_data');
    return $this->db->get()->result_array();
  } 


  public function delete_by_id($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->table);
  }


}

