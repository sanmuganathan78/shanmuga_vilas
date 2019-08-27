<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Joborder extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  $this->load->model('joborder_model');
      date_default_timezone_set('Asia/Kolkata');
		 if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
	}
	public function index()
	{

    $data['joborderno'] = $this->get_order_no();
		$this->load->view('header');
		$this->load->view('add_job',$data);
		$this->load->view('footer1');
	}

  Public function get_order_no()
  {
    @$joborderno =  $this->db->order_by('id','desc')->get('job_details')->row()->joborderno;
    if(!empty($joborderno)){
    $joborderno++;  
  }else{
    $joborderno = 'J0001';
  }
    
    return $joborderno;
  }

	

    public function insert()
    {

      $jobtype=$this->input->post('jobtype');
      $joborderno=$this->get_order_no();
      $joborderdate=date('Y-m-d',strtotime($this->input->post('joborderdate')));
      $dateofcompletion=date('Y-m-d',strtotime($this->input->post('dateofcompletion')));
      $operatorname=$this->input->post('operatorname');
      $vendors=$this->input->post('vendors');
      $vendordetails=$this->input->post('vendordetails');
      $category=implode('||',$this->input->post('category'));
      $jobdescription=$this->input->post('jobdescription');
      $itemname=$this->input->post('itemname');
      $uom=$this->input->post('uom');
      $qty=$this->input->post('qty');
      $scrap=$this->input->post('scrap');
      $returnitemname=$this->input->post('returnitemname');
      $returnqty=$this->input->post('returnqty');
      $issueby=$this->input->post('issueby');

      

      $data=array(
        'date'=>date('Y-m-d'),
        'jobtype'=>$jobtype,
        'joborderno'=>$joborderno,
        'joborderdate'=>$joborderdate,
        'dateofcompletion'=>$dateofcompletion,
        'operatorname'=>$operatorname,
        'vendors'=>$vendors,
        'vendordetails'=>$vendordetails,
        'category'=>$category,
        'jobdescription'=>$jobdescription,
        'issueby'=>$issueby,
        'status'=>1, 
        );


     
        $result=$this->joborder_model->add($data);
        if($result==true)
        {
            $insertid=$this->db->insert_id();
            $count=count($itemname);
          for ($i=0; $i <$count ; $i++) { 
             $datas=array(
            'date'=>date('Y-m-d'),
            'insertid'=>$insertid,
            'joborderno'=>$joborderno,
            'itemname'=>$itemname[$i],
            'qty'=>$qty[$i],
            'returnitemname'=>$returnitemname[$i],
            'returnqty'=>$returnqty[$i],
            'scrap'=>$scrap[$i],
            'balanceqty'=>$returnqty[$i],
            'uom'=>$uom[$i],
            'status'=>1, 
            'job_status'=>1, 
            );

            $this->db->insert('job_data',$datas);
            
          }



          $this->session->set_flashdata('msg','Job Added Successfully');
          redirect('joborder');
        }
        else
        {
          $this->session->set_flashdata('msg1','Job Added Unsuccessfully');
          redirect('joborder');
        }
       
    }


  

    public function view()
  {
    $data['view']=$this->joborder_model->select();
    $this->load->view('header');
    $this->load->view('joborder_view',$data);
    $this->load->view('footer1');
  }

    public function pending()
  {
    $data['view']=$this->joborder_model->select_pending();
    $this->load->view('header');
    $this->load->view('joborder_pending',$data);
    $this->load->view('footer1');
  }


   
       


      public function viewbilling()
      {
        $id=$this->input->post('id');
        $data=$this->db->where('insertid',$id)->get('job_data')->result_array();

       
        if($data)
        {
          

              

            $html='<div class="row">
                  <table class="table m-0">
                      <thead>
                      <tr>
                          <td colspan="3" align="center"><b>Job Order Details</b></td>
                          <td colspan="4" align="center"><b>Returnable Details</b></td>
                          
                       </tr> 
                      <tr>
                          <th>S.No</th>
                          <th>Item Name</th>
                          <th>Qty</th>
                          <th>UOM</th>
                          <th>Item Name</th>
                          <th>Qty</th>
                          <th>Scrap</th>
                       </tr>   
                      </thead>
                      <tbody>';
                                     
                      foreach ($data as $row) {
                          $a=1;                         
                  $html.='<tr>
                          <td>'.$a++.'</td>
                          <td>'.$row['itemname'].'</td>
                          <td>'.$row['qty'].'</td>
                          <td>'.$row['uom'].'</td>
                          <td>'.$row['returnitemname'].'</td>
                          <td>'.$row['returnqty'].'</td>
                          <td>'.$row['scrap'].'</td>
                       
                      </tr>';
                     
                     }
                          
                      $html.='</tbody>
                  </table>
              </div>
              <div class="row">
                  <div class="col-md-4">
                      
                  </div>
                  <div class="col-md-4">
                      
                  </div>
                 
                 
              
                  
                 
              </div>';
            
          
        }
        else
        {
          $html='';
        }


        echo $html;

      }

 

        Public function delete()
      {    

            $data=$this->db->where('id',$_POST['id'])->delete('inward_details');
           if($data)
           {

                $checkdata=$this->db->where('insertid',$_POST['id'])->get('inward_delivery')->result_array();
                if($checkdata)
                {
                  $count=count($checkdata);
                  for ($i=0; $i <$count ; $i++) { 
                    $this->db->where('insertid',$_POST['id'])->delete('inward_delivery');
                  }
                }
                
               
                //$this->session->set_flashdata('msg','Invoice Details  Deleted successfully!');
                echo'yes';
          }
          else
          {
            //$this->session->set_flashdata('msg1','Invoice Details  Deleted unsuccessfully');
            echo'no';   
              
          } 
         
     
      

      }




      public function autocomplete_name()
  {
   $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('vendor_details');
  $this->db->like('vendorname',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->vendorname;
    $json_array['value']    = $d->vendorname;
  
    $name[]             = $json_array;
  }
  echo json_encode($name);
  }

  public function autocomplete_itemname()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemname',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->itemname;
    $json_array['value']    = $d->itemname;
    $json_array['price']    = $d->price;
    $json_array['sgst']    = $d->sgst;
    $json_array['cgst']    = $d->cgst;
    $json_array['igst']    = $d->igst;


    // $json_array['advanceamount'] = $d->voucheramount;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}


    public function get_name()
  {
    $vendorname=$this->input->post('vendors');
    $this->db->select('*');
    $this->db->from('vendor_details');
    $this->db->where('vendorname',$vendorname);
    $query = $this->db->get();
    $result = $query->result();
    foreach($result as $s)
    {   
      $vob['address']=$s->address1.', '.$s->address2;
     
    }
    echo json_encode($vob);
  }


        public function check_itemname()
  {
     $name=$_POST['itemname'];
    $data=$this->db->where('itemname',$name)->get('additem')->result();
    echo $count=count($data);
    
  }


    public function check_vendors()
  {
     $name=$_POST['vendors'];
    $data=$this->db->where('vendorname',$name)->get('vendor_details')->result();
    echo $count=count($data);
    
  }

   


public function get_itemnames()
{
  $itemcode=$this->input->post('name');
  // $itemcode='Micro Mac';
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemname',$itemcode);
  $query = $this->db->get();
  $result = $query->result();

  foreach($result as $h)
  {   
    $uom=$this->db->select('uom')->where('id',$h->uom)->get('uom')->row()->uom;
    $vob['hsnno']=$h->hsnno;
    $vob['uom']=$uom;
 
  }
  echo json_encode($vob);
}


  Public function get_category()
  {

   

      $result=$this->db->where('status',1)
                     ->order_by('category','ASC')
            ->get('category')
            ->result();
     
        $data=array();
    foreach($result as $r)
    {
      $data['value']=$r->id;
      $data['label']=$r->category;
      $json[]=$data;
      
      
    }
    echo json_encode($json);
  }
  

        




}

ob_flush();

?>