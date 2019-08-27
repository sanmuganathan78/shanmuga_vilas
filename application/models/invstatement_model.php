<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Invstatement_model extends CI_Model {


        var $table = 'invoice_party_statement';
  var $column_order = array(null, 'date','invoiceno','receiptno','customername','invoiceamt','receiptamt','balance','paid'); //set column field database for datatable orderable
  var $column_search = array('date','invoiceno','receiptno','customername','invoiceamt','receiptamt','balance','paid'); //set column field database for datatable searchable 
  var $order = array('id' => 'asc'); // default order 

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
      $this->db->where('date >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
    }
    if($this->input->post('todate'))
    {
      $this->db->where('date <=',date('Y-m-d',strtotime($this->input->post('todate'))));
    }
    if($this->input->post('invoiceno'))
    {
      $this->db->where('invoiceno',$this->input->post('invoiceno'));
    }

    if($this->input->post('customername'))
    {
      $this->db->where('customername',$this->input->post('customername'));
    }

    //  $status=$this->input->post('status');
    // if($status=='1')
    // {
    //   $this->db->where('po_status',$this->input->post('status'));
    // }
    //    if($status=='0')
    // {
    //   $this->db->where('po_status',$this->input->post('status'));
    // }


      // $pono=$this->input->post('pono');
      //   $suppliername=$this->input->post('suppliername');  
      //   $status=$this->input->post('status');  

    $this->db->from($this->table);
    $i = 0;
  
    foreach ($this->column_search as $item) // loop column 
    {
      if($_POST['search']['value']) // if datatable send POST for search
      {
        
        if($i===0) // first loop
        {
          //$this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
          $this->db->like($item, $_POST['search']['value']);
        }
        else
        {
          $this->db->or_like($item, $_POST['search']['value']);
        }

        // if(count($this->column_search) - 1 == $i) //last loop
        //  $this->db->group_end(); //close bracket
      }
      $i++;
    }
    
    if(isset($_POST['order'])) // here order processing
    {
      $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    } 
    else if(isset($this->order))
    {
      $order = $this->order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
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

	  public function pay_amount($id)
    {
    
        $this->db->select('*');
        $this->db->where('id',$id);
            $this->db->from('purchase_details');
            return $this->db->get()->result_array();
    }

    public function pay_insert($data)
    {
    	$this->db->insert('purchase_collection',$data);
    	return $this->db->affected_rows()!=1? false:true;

    }


    public function select()
    {
    	$this->db->select('*');
    	$this->db->from('invoice_party_statement');
        $this->db->order_by('id','desc');
    	return $this->db->get()->result_array();
    }

    public function search_collection()
    {

          if($this->input->post('fromdate')=='')
        {
            $fromdate='';
        }
        else
        {
            $fromdate=date('Y-m-d',strtotime($this->input->post('fromdate')));
           
        }
        if($this->input->post('todate')=='')
        {
            $todate='';
        }
        else
        {
            $todate=date('Y-m-d',strtotime($this->input->post('todate')));
            
        }
        if(@$fromdate)
        {
            $this->db->where('date >=',$fromdate);
        }
        if(@$todate)
        {
            $this->db->where('date <=',$todate);
        }

        if(@$_POST['customername'])
        {

            $name=$_POST['customername'];
            $this->db->where('customername',$name);
        }
        return $query= $this->db->get('invoice_party_statement')->result_array();

    }


	public function search_billing()
	{
		//print_r($this->input->post());
		//exit;
		if($this->input->post('sfromdate')!=""){ $fromdate=date('Y-m-d',strtotime($this->input->post('sfromdate'))); } else  { $fromdate=''; }
		
		if($this->input->post('stodate')!="") {  $todate=date('Y-m-d',strtotime($this->input->post('stodate'))); } else { $todate=''; }

		if(@$fromdate) { $this->db->where('date >=',$fromdate); }
		if(@$todate) { $this->db->where('date <=',$todate); }

		if(@$this->input->post('sinvoiceno')) { $this->db->where('invoiceno',$this->input->post('sinvoiceno')); }

		if(@$this->input->post('scustomername')) { $this->db->where('customername',$this->input->post('scustomername')); }

		return $query=$this->db->get('invoice_party_statement')->result_array();
		return $query->result_array();
	}




}