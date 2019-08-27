<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class user_master_model extends CI_Model {

	var $table = 'login_details';
	var $column = array('date','username','designation','phoneno','email','id'); //set column field database for order and search
	var $column_search = array('date','username','designation','phoneno','email');
	var $order = array('id' => 'desc'); // default order 

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	private function _get_datatables_query()
	{
		$this->db->where('userType','U');
		if($this->input->post('fromdate'))
		{
			//echo "inside";
			$this->db->where('date >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
		}
		if($this->input->post('todate'))
		{
			//echo "inside todate";
			$this->db->where('date <=',date('Y-m-d',strtotime($this->input->post('todate'))));
		}
		//$this->db->where('balance > ','0');
		$this->db->from($this->table);

		$i = 0;
		foreach ($this->column_search as $item) // loop column 
		{
			if($_POST['search']['value']) // if datatable send POST for search
			{
				if($i===0) // first loop
				{
				//$this->db->group_start(); 
				$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
				$this->db->or_like($item, $_POST['search']['value']);
				}
			}
			$i++;
		}
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
		
		$this->db->where('login_id', $id);
		$this->db->delete('user_menu');
	}

	
	
	public function search_vendor()
	{
		if($this->input->post('fromdate')=='') { $fromdate=''; } else { $fromdate=date('Y-m-d',strtotime($this->input->post('fromdate'))); }
		if($this->input->post('todate')=='') { $todate=''; } else { $todate=date('Y-m-d',strtotime($this->input->post('todate'))); }
		if(@$fromdate) { $this->db->where('date >=',$fromdate); }
		if(@$todate) { $this->db->where('date <=',$todate); }
		$this->db->order_by('date','desc');
		return $query= $this->db->get('login_details')->result_array();
	}
	
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