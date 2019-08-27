<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Vendor extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('vendor_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}	
		date_default_timezone_set('Asia/Kolkata');		
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('addvendor');
		 // $this->load->view('footer');
	}
	public function insert()
	{
		if(@$_POST['email'])
		{
			$email=$_POST['email'];
		}
		else
		{
			$email='';
		}

		if(@$_POST['address2'])
		{
			$address2=$_POST['address2'];
		}
		else
		{
			$address2='';
		}

			if(@$_POST['tinno'])
		{
			$tinno=$_POST['tinno'];
		}
		else
		{
			$tinno='';
		}


			if(@$_POST['cstno'])
		{
			$cstno=$_POST['cstno'];
		}
		else
		{
			$cstno='';
		}

	if(@$_POST['panno'])
		{
			$panno=$_POST['panno'];
		}
		else
		{
			$panno='';
		}

			if(@$_POST['gstno'])
		{
			$gstno=$_POST['gstno'];
		}
		else
		{
			$gstno='';
		}
				if(@$_POST['adharno'])
		{
			$adharno=$_POST['adharno'];
		}
		else
		{
			$adharno='';
		}

		if(@$_POST['bankname'])
		{
			$bankname=$_POST['bankname'];
		}
		else
		{
			$bankname='';
		}

		if(@$_POST['accountno'])
		{
			$accountno=$_POST['accountno'];
		}
		else
		{
			$accountno='';
		}

		if(@$_POST['chequename'])
		{
			$chequename=$_POST['chequename'];
		}
		else
		{
			$chequename='';
		}


		$data=array(
			'date'=>date('Y-m-d'),			
			'vendorname'=>$_POST['vendorname'], 
			'phoneno'=>$_POST['phoneno'],
			'email'=>$email,
			'address1'=>$_POST['address1'],
			'address2'=>$address2,
			'state'=>$_POST['state'],
			'statecode'=>$_POST['statecode'],
			'city'=>$_POST['city'],
			'pincode'=>$_POST['pincode'],
			'tinno'=>$tinno,
			'cstno'=>$cstno,
			'panno'=>$panno,
			'gstno'=>$gstno,
			'adharno'=>$adharno,
			'bankname'=>$bankname,
			'accountno'=>$accountno,
			'status'=>1,
			);

		$result=$this->vendor_model->head($data);
		if($result=true)
		{
			$this->session->set_flashdata('msg','Vendor Added Successfully !');
			redirect('vendor');
		}
		else
		{
			$this->session->set_flashdata('msg1','Vendor Added UnSuccessfully !');
			redirect('vendor');
		}
	}
// Public function checkstates1()
// 		{
// 			$id=$this->input->post('id');

// 			$data=$this->db->where('countryid',$id)->get('state')->result_array();
// // echo"<pre>";
// // print_r($data);
// // $v=array();
// 			foreach ($data as $c)
// 			{
// 				$f['value']=$c['id'];
// 				$f['label']=$c['statename'];	
// 				$v[]=$f;				
// 			}
// 			echo json_encode($v);
// 		}
// 		Public function checkcity()
// 		{
// 			 $stateid=$this->input->post('state');
// 			$data=$this->db->where('stateid',$stateid)->get('city')->result_array();
// 			foreach ($data as $c)
// 			{
// 				$f['value']=$c['city'];
// 				$f['label']=$c['city'];	
// 				$f['stateid']=$c['stateid'];	
// 				$h[]=$f;				
// 			}
// 			echo json_encode($h);
// 		}

	public function view()
	{

		$data['vendor']=$this->vendor_model->select();
		 $this->load->view('header');
		 $this->load->view('vendor_view',$data);
		 $this->load->view('footer1');
	}

	public function search()
	{


		 $data['vendor']=$this->vendor_model->search_vendor();
         $this->load->view('header');
		 $this->load->view('vendor_view',$data);
		 $this->load->view('footer1');
	}

		   public function reports()
  {
    $fromdate=$_POST['fromdate'];
    $todate=$_POST['todate'];
		$data['cus']=$this->vendor_model->search_vendor();
    $this->load->view('vendor_reports',$data,$fromdate,$todate);
    
  }
// 	public function pdf()
// 	{
// 		$fromdate=$_POST['fromdate'];
// 		$todate=$_POST['todate'];
// 		$data['cus1']=$this->party_model->cus_search();
// 		$this->load->view('vendor_pdf',$data,$fromdate,$todate);
// 		}

// 		public function get_phoneno()
// 		{
// 			$phoneno=$this->input->post('phoneno');
// 			$this->db->select('*');
// 			$this->db->from('addparty');
// 			$this->db->where('phoneno',$phoneno);
// 			$result=$this->db->get()->result();

// 			if($result)
// 			{
// 				echo"yes";
// 			}
// 			else
// 			{
// 				echo"no";
// 			}

			
// 		}

		public function edit()
	{
		$qt=$this->uri->segment(3);
		$data['edit']=$this->vendor_model->add($qt);
		$this->load->view('header');
		$this->load->view('edit_vendor',$data);
		$this->load->view('footer');
	}

			public function getname()
	{
		 $name=$_POST['name'];
		 $type=$_POST['partytype'];
		$data=$this->db->where('name',$name)->where('type',$type)->get('vendor_details')->result();
		echo $count=count($data);
		
	}

	public function update()
	{



		$id=$_POST['id'];

		if(@$_POST['email'])
		{
			$email=$_POST['email'];
		}
		else
		{
			$email='';
		}

		if(@$_POST['address2'])
		{
			$address2=$_POST['address2'];
		}
		else
		{
			$address2='';
		}

			if(@$_POST['tinno'])
		{
			$tinno=$_POST['tinno'];
		}
		else
		{
			$tinno='';
		}


			if(@$_POST['cstno'])
		{
			$cstno=$_POST['cstno'];
		}
		else
		{
			$cstno='';
		}

	if(@$_POST['panno'])
		{
			$panno=$_POST['panno'];
		}
		else
		{
			$panno='';
		}

			if(@$_POST['gstno'])
		{
			$gstno=$_POST['gstno'];
		}
		else
		{
			$gstno='';
		}
				if(@$_POST['adharno'])
		{
			$adharno=$_POST['adharno'];
		}
		else
		{
			$adharno='';
		}

		if(@$_POST['bankname'])
		{
			$bankname=$_POST['bankname'];
		}
		else
		{
			$bankname='';
		}

		if(@$_POST['accountno'])
		{
			$accountno=$_POST['accountno'];
		}
		else
		{
			$accountno='';
		}

		if(@$_POST['chequename'])
		{
			$chequename=$_POST['chequename'];
		}
		else
		{
			$chequename='';
		}


		$data=array(
			'date'=>date('Y-m-d'),			
			'vendorname'=>$_POST['vendorname'], 
			'phoneno'=>$_POST['phoneno'],
			'email'=>$email,
			'address1'=>$_POST['address1'],
			'address2'=>$address2,
			'state'=>$_POST['state'],
			'statecode'=>$_POST['statecode'],
			'city'=>$_POST['city'],
			'pincode'=>$_POST['pincode'],
			'tinno'=>$tinno,
			'cstno'=>$cstno,
			'panno'=>$panno,
			'gstno'=>$gstno,
			'adharno'=>$adharno,
			'bankname'=>$bankname,
			'accountno'=>$accountno,
			'status'=>1,
			);



	
		
			$result=$this->vendor_model->patry_update($data,$id);
		if($result==true)
		{
			$this->session->set_flashdata('msg','Vendor Updated Successfully !');
			redirect('vendor/view');
		}
		else
		{
			$this->session->set_flashdata('msg1','No changes !');
			redirect('vendor/view');
		}
	}

	public function delete()
	{
		$dd=$this->input->post('id');
		$data=$this->db->where('id',$dd)->delete('vendor_details');
		if($data)
		{
			$this->session->set_flashdata('msg','Deleted successfully');
			redirect('vendor/view');
		}
		else
		{
			$this->session->set_flashdata('msg1','Deleted usuccessfully');
			redirect('vendor/view');
		}
	}
	public function get_phoneno()
		{
			$phoneno=$this->input->post('phoneno');
			$this->db->select('*');
			$this->db->from('vendor_details');
			$this->db->where('phoneno',$phoneno);
			$result=$this->db->get()->result();

			if($result)
			{
				echo"yes";
			}
			else
			{
				echo"no";
			}

			
		}

		Public function upload_excel()
	{

		$config['upload_path'] =  './upload/vendor/';
//Only allow this type of extensions 
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
// if any error occurs 
		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('msg1',$error);
			redirect('vendor');

		}
//if successfully uploaded the file 
		else
		{
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
			$fileextension=explode('.',$file_name);
				$counts=count($fileextension)-1;
             //load library phpExcel
			$this->load->library("Excel");

			//here i used microsoft excel 2007

			if($fileextension[$counts]=='xlsx' || $fileextension[$counts]=='Xlsx')
			{
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			}
			else
			{
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
			}	

			//$objReader = PHPExcel_IOFactory::createReader('Excel2007');
//set to read only
			$objReader->setReadDataOnly(true);
//load excel file
			$objPHPExcel = $objReader->load('upload/vendor/'.$file_name);
			$sheetnumber = 0;
			foreach ($objPHPExcel->getWorksheetIterator() as $sheet)
			{

$s = $sheet->getTitle();	// get the sheet name 

$sheet= str_replace(' ', '', $s); // remove the spaces between sheet name 
$sheet= strtolower($sheet); 
$objWorksheet = $objPHPExcel->getSheetByName($s);

$lastRow = $objPHPExcel->setActiveSheetIndex($sheetnumber)->getHighestRow(); 
$sheetnumber++;

for($j=2; $j<=$lastRow; $j++)
{

	$accountname = $objWorksheet->getCellByColumnAndRow(0,$j)->getValue();
	$printname = $objWorksheet->getCellByColumnAndRow(1,$j)->getValue();	
	$type = $objWorksheet->getCellByColumnAndRow(2,$j)->getValue();
	$name = $objWorksheet->getCellByColumnAndRow(3,$j)->getValue();
	$mobileno = $objWorksheet->getCellByColumnAndRow(4,$j)->getValue();
	$email = $objWorksheet->getCellByColumnAndRow(5,$j)->getValue();
	$address1 = $objWorksheet->getCellByColumnAndRow(6,$j)->getValue();
	$address2 = $objWorksheet->getCellByColumnAndRow(7,$j)->getValue();	
	$contactperson = $objWorksheet->getCellByColumnAndRow(8,$j)->getValue();
	$state = $objWorksheet->getCellByColumnAndRow(9,$j)->getValue();
	$statecode = $objWorksheet->getCellByColumnAndRow(10,$j)->getValue();
	$city = $objWorksheet->getCellByColumnAndRow(11,$j)->getValue();
	$pincode = $objWorksheet->getCellByColumnAndRow(12,$j)->getValue();
	$tinno = $objWorksheet->getCellByColumnAndRow(13,$j)->getValue();
	$cstno = $objWorksheet->getCellByColumnAndRow(14,$j)->getValue();
	$panno = $objWorksheet->getCellByColumnAndRow(15,$j)->getValue();
	$gstno = $objWorksheet->getCellByColumnAndRow(16,$j)->getValue();	
	$adharno = $objWorksheet->getCellByColumnAndRow(17,$j)->getValue();
	$bankname = $objWorksheet->getCellByColumnAndRow(18,$j)->getValue();
	$accountno = $objWorksheet->getCellByColumnAndRow(19,$j)->getValue();
	$chequename = $objWorksheet->getCellByColumnAndRow(20,$j)->getValue();
	$openingbalance = $objWorksheet->getCellByColumnAndRow(21,$j)->getValue();

	
	if($type!="" && $name!="" && $mobileno!="" &&  $contactperson!='')
	{

	$accountname =  $accountname ? $accountname:'-';
	$printname =  $printname ? $printname:'-';
	$type =  $type ? $type:'-';
	$name =  $name ? $name:'-';
	$mobileno =  $mobileno ? $mobileno:'-';
	$email =  $email ? $email:'-';
	$address1 =  $address1 ? $address1:'-';
	$address2 =  $address2 ? $address2:'-';
	$contactperson =  $contactperson ? $contactperson:'-';
	$state =  $state ? $state:'-';
	$statecode =  $statecode ? $statecode:'-';
	$city =  $city ? $city:'-';
	$pincode =  $pincode ? $pincode:'-';	
	$tinno =  $tinno ? $tinno:'-';
	$cstno =  $cstno ? $cstno:'-';	
	$panno =  $panno ? $panno:'-';
	$gstno =  $gstno ? $gstno:'-';
	$adharno =  $adharno ? $adharno:'-';
	$bankname =  $bankname ? $bankname:'-';
	$accountno =  $accountno ? $accountno:'-';
	$chequename =  $chequename ? $chequename:'-';
	$openingbalance =  $openingbalance ? $openingbalance:'0.00';

	

	
	
	$data=array(
			'date'=>date('Y-m-d'),			
			'accountname'=>$accountname,
			'printname'=>$printname, 
			'type'=>$type,
			'name'=>$name, 
			'phoneno'=>$mobileno,
			'email'=>$email,
			'address1'=>$address1,
			'address2'=>$address2,
			'contactperson'=>$contactperson,
			'state'=>$state,
			'statecode'=>$statecode,
			'city'=>$city,
			'pincode'=>$pincode,
			'tinno'=>$tinno,
			'cstno'=>$cstno,
			'panno'=>$panno,
			'gstno'=>$gstno,
			'adharno'=>$adharno,
			'bankname'=>$bankname,
			'accountno'=>$accountno,
			'chequeno'=>$chequename,
			'openingbal'=>$openingbalance,
			'status'=>1,
			);

	$getdetails=$this->db->where('type',$type)->where('name',$name)->get('vendor_details')->num_rows();
									if($getdetails > 0)
									{
										// $this->db->where('vendorcode',$vendorcode);
										// $this->db->update('vendor_details',$excel);
									}
									else
									{
										$this->db->insert('vendor_details',$data);
									}
	}
}// loop ends 

						
				$result=$this->db->affected_rows()!=1 ? false:true;	
				if($result=true)
				{
					$this->session->set_flashdata('msg','Party Details Added Successfully !');
					redirect('vendor');
				}
				else
				{
					$this->session->set_flashdata('msg1','Party Details Added UnSuccessfully !');
					redirect('vendor');
				}

		}
	}
}
}

ob_flush();
?>