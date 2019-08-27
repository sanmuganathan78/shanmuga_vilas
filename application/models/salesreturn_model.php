<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Salesreturn_model extends CI_Model {


var $table = 'sales_return';
var $column_search = array('types','suppliername','grandtotal','id','customername'); //set column field database for order and search
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
      $this->db->where('date >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
    }
    if($this->input->post('todate'))
    {
      $this->db->where('date <=',date('Y-m-d',strtotime($this->input->post('todate'))));
    }
   

    if($this->input->post('cusname'))
    {
      $this->db->where('suppliername',$this->input->post('cusname'));
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
            $this->db->order_by('id', $_POST['order']['0']['dir']);

      // $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
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
        $this->db->from('sales_return');
        $this->db->order_by('id','desc');
        return $this->db->get()->result_array();
    }

   public function pending_select()
    {
        $this->db->select('*');
        $this->db->where('balanceamount >',0);
        $this->db->where('partytype','supplier');
        $this->db->from('customer_details');
        $this->db->order_by('id','desc');
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
            $this->db->where('purchasedate >=',$fromdate);
        }

          else   if(@$fromdate=='')
        {
            $this->db->where('purchasedate >=',$fromdate);
        }

        if(@$todate)
        {
            $this->db->where('purchasedate <=',$todate);
        }

      else if(@$todate=='')
        {
            $this->db->where('purchasedate <=',$todate);
        }



         if(@$_POST['suppliername'])
        {
            $name=$_POST['suppliername'];
             $this->db->where('suppliername',$name);

          
        }
       
        return $query= $this->db->get('purchase_details')->result_array();
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
            $this->db->where('balance >',0);
            $this->db->where('purchasedate >=',$fromdate);
                $this->db->where('purchasedate <=',$todate);
                $this->db->where('suppliername',$suppliername);
                $query=$this->db->get('purchase_details');    
                        }
        //01
        else if($fromdate!='' && $todate=='' && $suppliername='')
        {
            $this->db->where('status',1);
              $this->db->where('balance >',0);

            $this->db->where('purchasedate >=',$fromdate);   
                $this->db->where('suppliername',$suppliername);

            $query=$this->db->get('purchase_details');
        }

        //10
        else if($fromdate=='' && $todate!='')
        {
            $this->db->where('status',1); 
          $this->db->where('balance >',0);

            $this->db->where('purchasedate <=',$todate);
                $this->db->where('suppliername',$suppliername);

            $query=$this->db->get('purchase_details');
        }
        //11
        else
        {
            $this->db->where('status',1);
        $this->db->where('balance >',0);

            $query=$this->db->get('purchase_details');
        }



        return $query->result_array();

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

    if(@$this->session->userdata('rcbio_cusname'))
    {



      $this->db->where('suppliername',$this->session->userdata('rcbio_cusname'));
    }
return $query=$this->db->get('purchase_details')->result_array();

return $query->result_array();

}


     public function search_reports()
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
            // $this->db->where('balance >',0);
            $this->db->where('purchasedate >=',$fromdate);
                $this->db->where('purchasedate <=',$todate);
                $this->db->where('suppliername',$suppliername);
                $query=$this->db->get('purchase_details');    
                        }
        //01
        else if($fromdate!='' && $todate=='' && $suppliername='')
        {
            $this->db->where('status',1);
              // $this->db->where('balance >',0);

            $this->db->where('purchasedate >=',$fromdate);   
                $this->db->where('suppliername',$suppliername);

            $query=$this->db->get('purchase_details');
        }

        //10
        else if($fromdate=='' && $todate!='')
        {
            $this->db->where('status',1); 
          // $this->db->where('balance >',0);

            $this->db->where('purchasedate <=',$todate);
                $this->db->where('suppliername',$suppliername);

            $query=$this->db->get('purchase_details');
        }
        //11
        else
        {
            $this->db->where('status',1);
        // $this->db->where('balance >',0);

            $query=$this->db->get('purchase_details');
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