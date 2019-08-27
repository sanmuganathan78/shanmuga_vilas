<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Item_model extends CI_Model {

	var $table = 'additem';
var $column = array('itemname','uom','price','id'); //set column field database for order and search
var $order = array('id' => 'desc'); // default order 

public function __construct()
{
	parent::__construct();
	$this->load->database();
}

private function _get_datatables_query()
{
	$this->db->from($this->table);
	$i = 0;
	$this->db->or_like('itemname',$_POST['search']['value']);
	$this->db->or_like('uom',$_POST['search']['value']);		
	$this->db->or_like('price',$_POST['search']['value']);
if(isset($_POST['order'])) // here order processing
{
	$this->db->order_by('id', $_POST['order']['0']['dir']);
} 
else if(isset($this->order))
{
	$order = $this->order;
	$this->db->order_by(key($order), $order[key($order)]);
}
}
function get_datatables()
{
	$this->_get_datatables_query();
	if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
	$query = $this->db->get();
	return $query->result();
}

function count_filtered()
{
	$this->_get_datatables_query();
	$query = $this->db->get();
	$this->db->order_by('id','desc');
	return $query->num_rows();
}
public function count_all()
{
	$this->db->from($this->table);
	return $this->db->count_all_results();
}
public function get_by_id($id)
{
	$this->db->from($this->table);
	$this->db->where('id',$id);
	$query = $this->db->get();
	return $query->row();
}

public function update($data)
	{
		$where=array('id' => $this->input->post('id'));
		$this->db->update($this->table, $data, $where);
		return ($this->db->affected_rows()!=1)?false:true;
		
	}
public function delete_by_id($id)
{
	$this->db->where('id', $id);
	$this->db->delete($this->table);
}

public function add($data)
{
	$this->db->insert('additem',$data);
	$itemno = $this->db
	->limit(1)
	->order_by('id','desc')
	->get_where('additem',array('status'=>1))
	->row()
	->itemno;
	$itemno++;
	return $itemno;
}
Public function get_itemno()
{
	if(isset($_POST['itemno'])){
		$itemno = $_POST['itemno'];
		// echo $itemno;		 
	}else{
		$itemno = $this->get_last_itemno();			
		if(isset($itemno)){
			$itemno++; 	
		}else{
			$itemno = 'I00001';
		}			
	}	

	$data = $this->db->get_where('additem',array('status'=>1))->result();

	if(isset($data) && count($data)!=0){ 
		$where = array('itemno'=>$itemno,'status'=>1);
		$count = $this->db->get_where('additem',$where)->num_rows();
			if($count !=0){ // Check item no already exist or not 
				$itemno++;
				return $itemno;
			}else{
				return $itemno;
			}
			}else{ // table is empty  generate auto no 
				$itemno = 'I00001';
				return $itemno;
			}	
}
// Public function get_last_itemno()
// {
// 	$where = array('status'=>1);
// 	$data=$this->db->limit(1)->order_by('id','desc')->get_where('additem',$where)->result();	
// 	if(isset($data) && count($data) != 0){
// 		foreach($data as $d){
// 		return $d->itemno;	
// 		}		 
// 	}
// }

public function vi()
{
	$this->db->select('*');
	$this->db->from('additem');
	$this->db->order_by('id','desc');
	return $this->db->get()->result_array();
}

public function header($data,$id)
{
	$this->db->where('id',$id);
	$this->db->update('additem',$data);
	return $this->db->affected_rows()!=1? false:true;
}
}