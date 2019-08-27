<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Purchasetaxstatement_model extends CI_Model {


        var $table = 'purchase_details';
var $column_search = array('purchasedate','purchaseno','suppliername','grandtotal','typesgst','typecgst','typeigst','id'); //set column field database for order and search
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
      $this->db->where('purchasedate >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
    }
    if($this->input->post('todate'))
    {
      $this->db->where('purchasedate <=',date('Y-m-d',strtotime($this->input->post('todate'))));
    }
   

    if($this->input->post('cusname'))
    {
      $this->db->where('suppliername',$this->input->post('cusname'));
    }


    if($this->input->post('purchaseno'))
    {
      $this->db->where('purchaseno',$this->input->post('purchaseno'));
    }

    if($this->input->post('gsttype'))
    {
      $this->db->where('gsttype',$this->input->post('gsttype'));
    }
	if($this->input->post('tax_percent'))
	{
		if($this->input->post('gsttype')=='interstate')
		{
			$this->db->like('igst', $this->input->post('tax_percent'));
		}
		elseif($this->input->post('gsttype')=='intrastate')
		{
			$this->db->like('cgst', $this->input->post('tax_percent'));
		}
		else
		{
			
		}
		
	}
   // echo  $GST=$this->input->post('gsttype');
    //  if($this->input->post('gsttype'))
    // {
    //   $this->db->where('typecgst',$this->input->post('gsttype'));
    // }

    // if($this->input->post('gsttype'))
    // {
    //   $this->db->where('typesgst',$this->input->post('gsttype'));
    // }

    

    
    //  $gsttype=$this->input->post('gsttype');
    // if($gsttype=='sgst')
    // {
    //   $this->db->where('typesgst',$this->input->post('gsttype'));
    // }
    //    if($gsttype=='cgst')
    // {
    //   $this->db->where('typecgst',$this->input->post('gsttype'));
    // }

    // if($gsttype=='igst')
    // {
    //   $this->db->where('typeigst',$this->input->post('gsttype'));
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
	   if($this->input->post('fromdate'))
    {
      $this->db->where('purchasedate >=',date('Y-m-d',strtotime($this->input->post('fromdate'))));
    }
    if($this->input->post('todate'))
    {
      $this->db->where('purchasedate <=',date('Y-m-d',strtotime($this->input->post('todate'))));
    }
   

    if($this->input->post('cusname'))
    {
      $this->db->where('suppliername',$this->input->post('cusname'));
    }


    if($this->input->post('purchaseno'))
    {
      $this->db->where('purchaseno',$this->input->post('purchaseno'));
    }

    if($this->input->post('gsttype'))
    {
      $this->db->where('gsttype',$this->input->post('gsttype'));
    }
	if($this->input->post('tax_percent'))
	{
		if($this->input->post('gsttype')=='interstate')
		{
			$this->db->like('igst', $this->input->post('tax_percent'));
		}
		elseif($this->input->post('gsttype')=='intrastate')
		{
			$this->db->like('cgst', $this->input->post('tax_percent'));
		}
		else
		{
			
		}
		
	}
    $this->db->from($this->table);
    return $this->db->count_all_results();
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

		if(@$fromdate){ $this->db->where('purchasedate >=',$fromdate); }
		if(@$todate) { $this->db->where('purchasedate <=',$todate); }
		if(@$this->session->userdata('rcbio_cusname')) { $this->db->where('suppliername',$this->session->userdata('rcbio_cusname')); }
		if($this->session->userdata('rcbio_gsttype')) { $this->db->where('gsttype',$this->session->userdata('rcbio_gsttype')); }
		if(@$this->session->userdata('rcbio_purchaseno')) {  $this->db->where('purchaseno',$this->session->userdata('rcbio_purchaseno'));  }
		if(@$this->session->userdata('rcbio_tax_percent'))
		{
			if(@$this->session->userdata('rcbio_gsttype')=='interstate')
			{
				$this->db->like('igst', @$this->session->userdata('rcbio_tax_percent'));
			}
			elseif(@$this->session->userdata('rcbio_gsttype')=='intrastate')
			{
				$this->db->like('cgst', @$this->session->userdata('rcbio_tax_percent'));
			}
			else
			{
				
			}
		
		}
		return $query=$this->db->get('purchase_details')->result_array();

		return $query->result_array();

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
    $this->db->where('purchaseno',$id)->delete('collection_details');
    $this->db->where('purchaseno',$id)->delete('purchase_party_statement');
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
        $this->db->where('balance >',0);

        $this->db->from('purchase_details');
        return $this->db->get()->result_array();
    }

    public function purchase_edit($id)
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

        public function search_purchase()
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

       
        return $query= $this->db->get('purchase_details')->result_array();
    }

    public function update_purchase($data,$id)
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

       
        return $query= $this->db->where('balance >',0)->get('purchase_details')->result_array();

     

    }


      public function get_cname($name)
        {
            $this->db->select('*');
            $this->db->from('customerpo_details');
            $this->db->where('suppliername',$name);
            $query = $this->db->get();
            return $query->result();
        }


           public function get_dc($c_name)
        {
            $this->db->select('*');
            $this->db->from('customerpo_details');
            $this->db->where('status',1);
            $this->db->where('suppliername',$c_name);
            $query = $this->db->get();
            return $query->result();

        } 

                public function get_itemname($dcno)
        {
            $this->db->select('*');
            $this->db->from('directdc_reports');
            $this->db->where('dcbillno',$dcno);
             $this->db->where('status',1);
            $query = $this->db->get();
            return $query->result();
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