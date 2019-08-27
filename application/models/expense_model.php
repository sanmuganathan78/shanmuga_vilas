<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expense_model extends CI_Model {


	 var $table = 'expenses';
  var $column_order = array(null, 'expensesdate','purpose','name','headers','paymentdetails','overallamount'); //set column field database for datatable orderable
  var $column_search = array('expensesdate','purpose','name','paymentdetails','overallamount','headers'); //set column field database for datatable searchable 
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
      $this->db->where('expensesdate >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
    }
    if($this->input->post('todate'))
    {
      $this->db->where('expensesdate <=',date('Y-m-d',strtotime($this->input->post('todate'))));
    }
    if($this->input->post('name'))
    {
      $this->db->where('name',$this->input->post('name'));
    }
     if($this->input->post('headers'))
    {
        if($this->input->post('headers')!="All") 
        {
          $this->db->where('headers',$this->input->post('headers'));
        }
    }

    // if($this->input->post('customername'))
    // {
    //   $this->db->where('customername',$this->input->post('customername'));
    // }

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
	

	public function add()
	{
		if($_POST['throughcheck']!='')
		{
			$throughcheck=$_POST['throughcheck'];
		}
		else
		{
			$throughcheck='';
		}
		if($_POST['chequeno']!='')
		{
			$chequeno=$_POST['chequeno'];
		}
		else
		{
			$chequeno='';
		}
		if($_POST['chamount']!='')
		{
			$chamount=$_POST['chamount'];
		}
		else
		{
			$chamount='';
		}
		if($_POST['banktransfer']!='')
		{
			$banktransfer=$_POST['banktransfer'];
		}
		else
		{
			$banktransfer='';
		}

		if($_POST['bamount']!='')
		{
			$bamount=$_POST['bamount'];
		}
		else
		{
			$bamount='';
		}
			if($_POST['amount']!='')
		{
			$amount=$_POST['amount'];
		}
		else
		{
			$amount='';
		}

				$payment=$_POST['paymentmode'];




					if($payment=='Cash')
		{
			$paymentdetails=$payment;
		}
		else if($payment=='Cheque')
		{
			$paymentdetails=$payment.' '.$throughcheck.' '.$_POST['chequeno'];
		}
		else if($payment=='Bank')
		{
			$paymentdetails=$payment.' '.$_POST['banktransfer'];
		}	
      else if($payment=='Card')
    {
      $paymentdetails=$_POST['cardtype'];
    } 




			if($_POST['amount'])
		{
			$overallamount=$_POST['amount'];

			
		}

		else	if($_POST['bamount'])
		{
			$overallamount=$_POST['bamount'];

			
		}

			else if($_POST['chamount'])
		{
			$overallamount=$_POST['chamount'];

		
		}
        else if($_POST['cardamount'])
    {
      $overallamount=$_POST['cardamount'];

    
    }



		$data=array(
		'date'=>date('Y-m-d'),	
		'name'=>$_POST['name'],
		'expensesdate'=>date('Y-m-d',strtotime($_POST['expensesdate'])),
    'headers'=>$_POST['headers'],
    'purpose'=>$_POST['purpose'],
		'expensesid'=>$_POST['expensesid'],
		'paymentmode'=>$_POST['paymentmode'],
		// 'billno'=>$_POST['billno'],
		// 'tinno'=>$_POST['tinno'],
		// 'remarks'=>$_POST['remarks'],
		'throughcheck'=>$throughcheck,
		'chequeno'=>$chequeno,
		'chamount'=>$chamount,
		'banktransfer'=>$banktransfer,
		'bamount'=>$bamount,
		'amount'=>$amount,
		'cardtype' => $_POST['cardtype'],
		'paymentdetails'=>$paymentdetails,
		'overallamount'=>$overallamount,
		'transactionid' => $_POST['transactionid'],
		'status'=>1
		);	
          $this->db->insert('expenses',$data);
          return $this->db->affected_rows()!=1? false:true;
	}

	public function select()
	{
		$this->db->select('*');
		$this->db->from('expenses');
		$this->db->order_by('id','desc');
		return $this->db->get()->result_array();
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

    if(@$this->session->userdata('rcbio_name'))
    {


      $this->db->where('name',$this->session->userdata('rcbio_name'));
    }


   
 


    return $query=$this->db->get('expenses')->result_array();



    return $query->result_array();




  }


}

