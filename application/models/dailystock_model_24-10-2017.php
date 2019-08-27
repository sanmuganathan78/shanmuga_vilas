<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dailystock_model extends CI_Model {

		
        var $table = 'stock_reports';
  var $column_order = array(null, 'hsnno','itemname','updatestock'); //set column field database for datatable orderable
  var $column_search = array('hsnno','itemname','updatestock'); //set column field database for datatable searchable 
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
    if($this->input->post('itemno'))
    {
      $this->db->where('hsnno',$this->input->post('itemno'));
    }

    if($this->input->post('itemname'))
    {
      $this->db->where('itemname',$this->input->post('itemname'));
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
      // $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
      $this->db->order_by('id', $_POST['order']['0']['dir']);
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

	public function add($data)
	{
          $this->db->insert('stock',$data);
          return $this->db->affected_rows()!=1? false:true;
	}

	public function select()
	{
		$this->db->select('*');
		$this->db->from('stock');
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();

	}

	
	public function insert_stock($c)
		{
			$this->db->insert('stock',$c);
			return ($this->db->affected_rows() !=1) ? false:true;
	
	    }	


	public function check($b)
		{
			
			$this->db->where('itemname',$b);
			$query = $this->db->get('stock');
		if($query->num_rows >0)
		{
			return true;
		}		

		}

		public function get_last_stock($b)
	{
		$this->db->select('*');
		$this->db->from('stock');
		$this->db->where('itemname',$b);
		$this->db->order_by('id','desc');
		$this->db->limit('1');
		$query= $this->db->get();
	 	return $query->result();
		
		
	}
		public function stock_update($itemname,$data)
		{	
			
			$this->db->where('itemname',$itemname);
			$this->db->update('stock',$data);
						return ($this->db->affected_rows() !=1) ? false:true;
	
	    }	

	    public function header($data,$id)
	{


		$this->db->where('id',$id);
		$this->db->update('stock',$data);
		return $this->db->affected_rows()!=1? false:true;
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

    if(@$this->session->userdata('rcbio_itemname'))
    {



      $this->db->where('itemname',$this->session->userdata('rcbio_itemname'));
    }


     if(@$this->session->userdata('rcbio_itemno'))
    {


      $this->db->where('itemcode',$this->session->userdata('rcbio_itemno'));
    }

 


    return $query=$this->db->get('stock_reports')->result_array();



    return $query->result_array();




  }


}

