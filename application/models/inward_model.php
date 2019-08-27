<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inward_model extends CI_Model {
var $table = 'inward_details';
var $column_order = array(null, 'inwarddate','inwardno','cusname','customerdcno','customerdcdate'); //set column field database for datatable orderable
var $column_search = array('inwarddate','inwardno','cusname','customerdcno','customerdcdate'); //set column field database for datatable searchable 
var $order = array('id' => 'desc'); // default order 

public function __construct()
{
parent::__construct();
$this->load->database();
}

private function _get_datatables_query()
{
//add custom filter here
if($this->input->post('fromdate'))
{
$this->db->where('inwarddate >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
}
if($this->input->post('todate'))
{
$this->db->where('inwarddate <=',date('Y-m-d',strtotime($this->input->post('todate'))));
}

if($this->input->post('customername'))
{
$this->db->where('cusname',$this->input->post('customername'));
}
$this->db->from($this->table);
$i = 0;
foreach ($this->column_search as $item) // loop column 
{
if($_POST['search']['value']) // if datatable send POST for search
{
if($i===0) // first loop
{
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
$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
} 
elseif(isset($this->order))
{
$order = $this->order;
$this->db->order_by(key($order), $order[key($order)]);
}
}


public function search_billing()
{

if($this->session->userdata('rcbio_fromdate')!="")
{
$fromdate=date('Y-m-d',strtotime($this->session->userdata('rcbio_fromdate')));   
}
else
{
$fromdate='';
}
if($this->session->userdata('rcbio_todate')!="")
{
$todate=date('Y-m-d',strtotime($this->session->userdata('rcbio_todate')));
}
else
{
$todate='';
}



if(@$fromdate)
{


$this->db->where('date >=',$fromdate);
}

if(@$todate)
{

$this->db->where('date <=',$todate);
}

if(@$this->session->userdata('rcbio_customername'))
{

$this->db->where('cusname',$this->session->userdata('rcbio_customername'));
}


return $query=$this->db->get('inward_details')->result_array();

//return $query->result_array();

}

public function get_datatables()
{
$this->_get_datatables_query();
if($_POST['length'] != -1)
$this->db->limit($_POST['length'], $_POST['start']);
$query = $this->db->get();
return $query->result();
}

public function count_filtered()
{
$this->_get_datatables_query();
$query = $this->db->get();
return $query->num_rows();
}

public function count_all()
{
$this->db->from($this->table);
return $this->db->count_all_results();
}

public function add($data)
{
$this->db->insert('inward_details',$data);
return $this->db->affected_rows()!=1? false:true;
}

public function updates($data,$id)
{
$this->db->where('id',$id);   
$this->db->update('inward_details',$data);
return $this->db->affected_rows() !=1 ? false:true;
}

public function select()
{
$this->db->select('*');
$this->db->from('inward_details');
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

