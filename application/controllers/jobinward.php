<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Jobinward extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  $this->load->model('jobinward_model');
      date_default_timezone_set('Asia/Kolkata');
		 if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
	}
	public function index()
	{

    $data['jobinwardno'] = $this->get_inward_no();
		$this->load->view('header');
		$this->load->view('add_jobinward',$data);
		$this->load->view('footer1');
	}

  Public function get_inward_no()
  {
    @$jobinwardno =  $this->db->order_by('id','desc')->get('jobinward_details')->row()->jobinwardno;
    if(!empty($jobinwardno)){
    $jobinwardno++;  
  }else{
    $jobinwardno = 'J0001';
  }
    
    return $jobinwardno;
  }

	

    public function insert()
    {

      $jobtype=$this->input->post('jobtype');
      $jobinwardno=$this->get_inward_no();
      $jobinwarddate=date('Y-m-d',strtotime($this->input->post('jobinwarddate')));
      $dateofcompletion=date('Y-m-d',strtotime($this->input->post('dateofcompletion')));
      $operatorname=$this->input->post('operatorname');
      $vendors=$this->input->post('vendors');
      $vendordetails=$this->input->post('vendordetails');
      @$joborderno=$this->input->post('joborderno');
     
      $jobdescription=$this->input->post('jobdescription');
      $itemname=$this->input->post('itemname');
      $uom=$this->input->post('uom');
      $qty=$this->input->post('qty');
      $joborderqty=$this->input->post('joborderqty');
      $returnitemname=$this->input->post('returnitemname');
      $returnqty=$this->input->post('returnqty');
      $scrap=$this->input->post('scrap');
      $issueby=$this->input->post('issueby');

      if($jobtype=='IN-House')
      {
           $category=implode('||',$this->input->post('category'));
      }
      else
      {
          $category=$this->input->post('category');
      }

      

      $data=array(
        'date'=>date('Y-m-d'),
        'jobtype'=>$jobtype,
        'jobinwardno'=>$jobinwardno,
        'jobinwarddate'=>$jobinwarddate,
        'dateofcompletion'=>$dateofcompletion,
        'operatorname'=>$operatorname,
        'vendors'=>$vendors,
        'vendordetails'=>$vendordetails,
        'joborderno'=>$joborderno,
        'category'=>$category,
        'jobdescription'=>$jobdescription,
        'issueby'=>$issueby,
        'status'=>1, 
        );


     
        $result=$this->jobinward_model->add($data);
        if($result==true)
        {
            $insertid=$this->db->insert_id();
            $count=count($itemname);
          for ($i=0; $i <$count ; $i++) { 
             $datas=array(
            'date'=>date('Y-m-d'),
            'jobinwardno'=>$jobinwardno,
            'joborderno'=>$joborderno,
            'insertid'=>$insertid,
            'itemname'=>$itemname[$i],
            'qty'=>$qty[$i],
            'joborderqty'=>$joborderqty[$i],
            'returnitemname'=>$returnitemname[$i],
            'returnqty'=>$returnqty[$i],
            'scrap'=>$scrap[$i],
            'uom'=>$uom[$i],
            'status'=>1, 
            'job_status'=>1, 
            );

            $this->db->insert('jobinward_data',$datas);
            
          }



          $this->session->set_flashdata('msg','Job Added Successfully');
          redirect('jobinward');
        }
        else
        {
          $this->session->set_flashdata('msg1','Job Added Unsuccessfully');
          redirect('jobinward');
        }
       
    }


  

    public function view()
  {
    $data['view']=$this->jobinward_model->select();
    $this->load->view('header');
    $this->load->view('jobinward_view',$data);
    $this->load->view('footer1');
  }

   
       


      public function viewbilling()
      {
        $id=$this->input->post('id');
        $data=$this->db->where('insertid',$id)->get('jobinward_data')->result_array();

       
        if($data)
        {
          

              

            $html='<div class="row">
                  <table class="table m-0">
                      <thead>
                      <tr>
                          <td colspan="3" align="center"><b>Job Order Details</b></td>
                          <td colspan="5" align="center"><b>Returnable Details</b></td>
                          
                       </tr> 
                      <tr>
                          <th>S.No</th>
                          <th>Item Name</th>
                          <th>Qty</th>
                          <th>UOM</th>
                          <th>Item Name</th>
                          <th>Job Order Qty</th>
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
                          <td>'.$row['joborderqty'].'</td>
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
   $inwardno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('vendor_details');
  $this->db->like('vendorname',$inwardno);
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
  $inwardno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemname',$inwardno);
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


  public function getjoborder()
  {

    $joborderno=$this->input->post('joborderno');

    if($joborderno=='')
    {
      $html='';
    }
    else
    {
     $datas=$this->db->where('joborderno',$joborderno)->get('job_details')->result_array();

     foreach ($datas as $values) 
     {
       $category=$values['category'];
       $jobdescription=$values['jobdescription'];
      $issueby=$values['issueby'];
     }

    

     $cates=explode('||', $category);
     $count=count($cates);

     for ($i=0; $i <$count ; $i++) { 
      $categ=$this->db->select('category')->where('id',$cates[$i])->get('category')->row()->category;
      $categ_ory[]=$categ;
     }

    $data=$this->db->where('joborderno',$joborderno)->get('job_data')->result_array();

    $html='<div class="col-md-3">
                        <div class="form-group">
                          <label>Categories</label>
                        <input id="" readonly  name="" value='.implode(',',$categ_ory).' class="form-control">
                        <input id="category" value="'.$category.'" type="hidden" readonly name="category" class="form-control">
                        </div>
                      </div>

                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Job Description</label>
                        <textarea type="text" class="form-control" readonly name="jobdescription" id="jobdescription" parsley-trigger="change" required  rows="3">'.$jobdescription.'</textarea>
                        </div>
                      </div>

                      <div class="col-md-3">
                                <div class="form-group">
                                  <label>Issue By</label>
                                    <input type="text" required parsley-trigger="change" class="form-control clears" name="issueby" id="issueby" value="'.$issueby.'" >
                                </div>
                              </div>
                 
                    
                  </div>
                   <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix"></div>
                  <table class="responsive table" width="100%">
                    <thead> 
                       <tr>
                        <!-- <th>&nbsp;&nbsp;&nbsp;&nbsp;Item Code</th> -->
                        <td align="center" colspan="3" style="border-top: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0;border-left: 1px solid #e0e0e0;"><b style="color: blue;">Job Order Details</b></td>
                        <td align="center" colspan="4" style="border-top: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0;"><b style="color: blue;">Returnable Details</b></td>
                        
                      </tr>
                      <tr>
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;Item Name</th>
                        <th>&nbsp;&nbsp;Qty</th>
                        <th style="border-right: 1px solid #e0e0e0;">&nbsp;&nbsp;UOM</th>
                        <th>&nbsp;&nbsp;Item Name</th>
                        <th>&nbsp;&nbsp;Qty</th>
                        <th>&nbsp;&nbsp;Scrap</th>
                        
                      </tr>  
                    </thead>
                    <tbody>';

                    foreach ($data as $rows){
                    
                    $html.='

                      <tr>

                          <td><input parsley-trigger="change" required id="itemname" type="text" readonly name="itemname[]" value="'.$rows['itemname'].'"></td>
                         <td><input class="decimal" parsley-trigger="change" readonly required id="qty" type="text" name="qty[]" value="'.$rows['qty'].'"   autocomplete="off"></td>
                         <td style="border-right: 1px solid #e0e0e0;"><input readonly id="uom" type="text" name="uom[]" value="'.$rows['uom'].'" autocomplete="off"></td>
                          
                           <td><input parsley-trigger="change" readonly value="'.$rows['returnitemname'].'" required id="returnitemname" type="text" name="returnitemname[]" value=""></td>

                            <td><input parsley-trigger="change" required id="returnqty" type="text" name="returnqty[]" value="">
                              <input class="form-control"  id="joborderqty'.$rows['id'].'" type="hidden" name="joborderqty[]" value="'.$rows['balanceqty'].'" autocomplete="off"> 
                              <div id="qty_valid" style="color:green;">Job Order Qty : '.$rows['balanceqty'].'</div></td>

                             <td><input parsley-trigger="change" readonly required id="scrap" type="text" name="scrap[]" value="'.$rows['scrap'].'"></td> 
                                                      
                              
                            </tr>';
                          }
                      $html.=' </tbody>
                         
                        </table>
                        
                        <div class="clearfix"></div>
                   
                        <br>
                     <div class="col-sm-offset-4">
                     <button  class="btn btn-info"  type="submit" id="submit" name="save" value="save">Save</button>
                       <!--  <button  class="btn btn-primary"  name="print" id="print" value="print">Print</button> -->
                          <button type="reset"  class="btn btn-default" id="">Reset</button>
                        </div>';


                    }    

                        echo $html;
  }


  public function getinhouseinward()
  {
    echo $this->load->view('inhousejob');
  }

  public function get_joborderno()
  {
      $vendors=$_POST['vendors'];
       $query=$this->db->where('status',1)->where('vendors',$vendors)->where('jobtype','Job Order')->get('job_details');
        $result= $query->result();
        $data=array(); 
        if($result)
        {
        foreach($result as $r)
        {
          $data['value']=$r->joborderno;
          $data['label']=$r->joborderno;
          $json[]=$data;


        }
      }
        echo json_encode($json);
  }
  

        




}

ob_flush();

?>