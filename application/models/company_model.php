<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Company_model extends CI_Model {



	public function insert($a)
	{
		$this->db->insert('profile',$a);
		return $this->db->affected_rows()!=1? false:true;
	}






public function select()
	{
		$this->db->select('*');
		$this->db->from('profile');
		return $this->db->get()->result_array();
		
	}
     public function update($id,$d)
     {
     	$this->db->where('id',$id);
     	$this->db->update('profile',$d);
		return $this->db->affected_rows()!=1? false:true;
     } 

//       public function image($g)
// 	    {
// 	    	$this->db->insert('image_detail',$g);
// 	    	return $this->db->affected_rows()!=1? false:true;
// 	    }

	   
// 	      public function upload_image($id,$g)
//      {
//      	$this->db->where('id',$id);
// 	    	$this->db->update('image_detail',$g);
// 		return $this->db->affected_rows()!=1? false:true;
//      } 
}