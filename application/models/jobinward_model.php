<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Jobinward_model extends CI_Model {

		    
  public function __construct()
  {
    parent::__construct();
    $this->load->database();
  }

 
	public function add($data)
	{
        $this->db->insert('jobinward_details',$data);
        return $this->db->affected_rows()!=1? false:true;
	}

  public function updates($data,$id)
{
    $this->db->where('id',$id);   
  $this->db->update('jobinward_details',$data);
  return $this->db->affected_rows() !=1 ? false:true;
}

	public function select()
	{
		$this->db->select('*');
		$this->db->from('jobinward_details');
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
	} 

  public function select_pending()
  {
    $this->db->select('*');
    $this->db->where('balanceqty >',0);
    $this->db->from('inward_delivery');
    return $this->db->get()->result_array();
  } 


  public function delete_by_id($id)
  {
    $this->db->where('id', $id);
    $this->db->delete($this->table);
  }


}

