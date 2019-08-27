<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quotation_model extends CI_Model {


        var $table = 'quotation_details';
var $column = array('quotationno','quotationdate','customername','grandtotal','id'); //set column field database for order and search
var $column_search = array('quotationno','quotationdate','customername','grandtotal','id'); //set column field database for datatable searchable 
var $order = array('id' => 'desc'); // default order 

public function __construct()
{
    parent::__construct();
    $this->load->database();
}

	private function _get_datatables_query()
	{
		
		if($this->input->post('fromdate'))
		{
			//echo "inside";
			$this->db->where('quotationdate >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
		}
		if($this->input->post('todate'))
		{
			//echo "inside todate";
			$this->db->where('quotationdate <=',date('Y-m-d',strtotime($this->input->post('todate'))));
		}
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
		
		//$this->db->or_like('quotationno',$_POST['search']['value']);
		//$this->db->or_like('customername',$_POST['search']['value']);     
		//$this->db->or_like('grandtotal',$_POST['search']['value']);
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
	//echo $this->_get_datatables_query();
	//exit;
    if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
    $query = $this->db->get();
    return $query->result();
}

function count_filtered()
{
	if($this->input->post('fromdate'))
	{
		//echo "inside";
		$this->db->where('quotationdate >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
	}
	if($this->input->post('todate'))
	{
		//echo "inside todate";
		$this->db->where('quotationdate <=',date('Y-m-d',strtotime($this->input->post('todate'))));
	}
    $this->_get_datatables_query();
    $query = $this->db->get();
    $this->db->order_by('id','desc');
    return $query->num_rows();
}
public function count_all()
{
	if($this->input->post('fromdate'))
	{
		//echo "inside";
		$this->db->where('quotationdate >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
	}
	if($this->input->post('todate'))
	{
		//echo "inside todate";
		$this->db->where('quotationdate <=',date('Y-m-d',strtotime($this->input->post('todate'))));
	}
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
    $this->db->where('purchaseno', $id);
    $this->db->delete($this->table);
    $this->db->where('purchaseno',$id)->delete('purchase_collection');
    $this->db->where('purchaseno',$id)->delete('po_party_statements');
}
  

    public function add($data)
    {
        $this->db->insert('purchase_details',$data);
        return $this->db->affected_rows()!=1? false:true;
    }


    public function select()
    {
        $this->db->select('*');
        $this->db->from('purchase_details');
        $this->db->order_by('id','desc');
        return $this->db->get()->result_array();
    }

    public function pending_select()
    {
        $this->db->select('*');
        //$this->db->where('balance >',0);
        $this->db->order_by('id','desc');
        $this->db->from('purchase_details');
        return $this->db->get()->result_array();
    }

    public function invoice_edit($id)
    {
        $this->db->select('*');
        $this->db->where('id',$id);
        $this->db->from('purchase_details');
        return $this->db->get()->result_array();
    }

    // public function user_update($id,$data)
    // {
    //  $this->db->where('id',$id);
    //  $this->db->update('login',$data);
    //  return $this->db->affected_rows()!=1? false:true;

        public function search_invoice()
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
            $this->db->where('quotationdate >=',$fromdate);
        }

          else   if(@$fromdate=='')
        {
            $this->db->where('quotationdate >=',$fromdate);
        }

        if(@$todate)
        {
            $this->db->where('quotationdate <=',$todate);
        }

      else if(@$todate=='')
        {
            $this->db->where('quotationdate <=',$todate);
        }



      
       
        return $query= $this->db->get('quotation_details')->result_array();
    }

    public function update_invoice($data,$id)
    {

        $this->db->where('id',$id);
        $this->db->update('purchase_details',$data);
        return $this->db->affected_rows()!=1? false:true;
    }



       public function search_pending()
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

         if(@$_POST['suppliername'])
        {

            $suppliername=$_POST['suppliername'];

           

        }
       
                // echo $fromdate;        
    
        if($fromdate!='' && $todate!='' && @$suppliername!='')
        {
            $this->db->where('status',1);
            //$this->db->where('balance >',0);
            $this->db->where('purchasedate >=',$fromdate);
                $this->db->where('purchasedate <=',$todate);
                $this->db->where('suppliername',$suppliername);
                $query=$this->db->get('purchase_details');    
                        }
        //01
        else if($fromdate!='' && $todate=='' && $suppliername='')
        {
            $this->db->where('status',1);
              //$this->db->where('balance >',0);

            $this->db->where('purchasedate >=',$fromdate);   
                $this->db->where('suppliername',$suppliername);

            $query=$this->db->get('purchase_details');
        }

        //10
        else if($fromdate=='' && $todate!='')
        {
            $this->db->where('status',1); 
          //$this->db->where('balance >',0);

            $this->db->where('purchasedate <=',$todate);
                $this->db->where('suppliername',$suppliername);

            $query=$this->db->get('purchase_details');
        }
        //11
        else
        {
            $this->db->where('status',1);
        //$this->db->where('balance >',0);

            $query=$this->db->get('purchase_details');
        }



        return $query->result_array();

    }


     public function search_reports()
    {
        if($this->input->post('fromdate')==''){ $fromdate=''; } else { $fromdate=date('Y-m-d',strtotime($this->input->post('fromdate')));   }
        if($this->input->post('todate')=='') { $todate=''; } else { $todate=date('Y-m-d',strtotime($this->input->post('todate')));  }
     	if($fromdate!='' && $todate!='')
		{
			$this->db->where('status',1);
			// $this->db->where('balance >',0);
			$this->db->where('quotationdate >=',$fromdate);
			$this->db->where('quotationdate <=',$todate);
			$query=$this->db->get('quotation_details');    
		}
		else if($fromdate!='' && $todate=='')
		{
			$this->db->where('status',1);
			$this->db->where('quotationdate >=',$fromdate);   
			$query=$this->db->get('quotation_details');
		}
		else if($fromdate=='' && $todate!='')
		{
			$this->db->where('status',1); 
			$this->db->where('quotationdate <=',$todate);
			$query=$this->db->get('quotation_details');
		}
		else
		{
			$this->db->where('status',1);
			$query=$this->db->get('quotation_details');
		}
        return $query->result_array();

    }



        public function pending()
    {
        $this->db->select('*');
        $this->db->where('balance >',0);
        $this->db->from('purchase_details');
        $this->db->order_by('id','desc');
        return $this->db->get()->result_array();
    }
          
}