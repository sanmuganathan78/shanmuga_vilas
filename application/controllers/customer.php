<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Customer extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('customer_model');
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
		$this->load->view('addcustomer');
		// $this->load->view('footer');
	}
	public function insert()
	{
		// print_r($_POST);
		// exit;
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
				'date'			=> date('Y-m-d'),			
				'accountname'	=> $_POST['accountname'],
				'printname'		=> $_POST['printname'], 
				'type'			=> $_POST['type'],
				'name'			=> $_POST['name'], 
				'phoneno'		=> $_POST['phoneno'],
				'email'			=> $email,
				'address1'		=> $_POST['address1'],
				'address2'		=> $address2,
				'contactperson'	=> $_POST['contactperson'],
				'state'			=> $_POST['state'],
				'statecode'		=> $_POST['statecode'],
				'city'			=> $_POST['city'],
				'pincode'		=> $_POST['pincode'],
				'tinno'			=> $tinno,
				'cstno'			=> $cstno,
				'panno'			=> $panno,
				'gstno'			=> $gstno,
				'adharno'		=> $adharno,
				'bankname'		=> $bankname,
				'accountno'		=> $accountno,
				'chequeno'		=> $chequename,
				'openingbal'	=> $_POST['openingbalance'],
				'balanceamount'	=> $_POST['openingbalance'],
				'status'		=> 1,
				);

		$result=$this->customer_model->head($data);
		if($result=true)
		{
			$this->session->set_flashdata('msg','Party Added Successfully !');
			redirect('customer');
		}
		else
		{
			$this->session->set_flashdata('msg1','Party Added UnSuccessfully !');
			redirect('customer');
		}
	}

	public function view()
	{
		$data['customer']=$this->customer_model->select();
		$this->load->view('header');
		$this->load->view('customer_view',$data);
		$this->load->view('footer1');
	}

	public function search()
	{
		$data['customer']=$this->customer_model->search_customer();
		$this->load->view('header');
		$this->load->view('customer_view',$data);
		$this->load->view('footer1');
	}

	public function reports()
	{
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
		$type = $_POST['type'];
		$data['cus']=$this->customer_model->search_customer();
		$this->load->view('customer_reports',$data,$fromdate,$todate,$type);
	}

	public function edit()
	{
		$qt=$this->uri->segment(3);
		$data['edit']=$this->customer_model->add($qt);
		$this->load->view('header');
		$this->load->view('edit_customer',$data);
		$this->load->view('footer');
	}

	public function getname()
	{
		$name=$_POST['name'];
		$type=$_POST['partytype'];
		$data=$this->db->where('name',$name)->where('type',$type)->get('customer_details')->result();
		echo $count=count($data);
	}

	public function update()
	{
		$id=$_POST['id'];
		if(@$_POST['email'])	{	$email=$_POST['email'];				} else { $email='';			}
		if(@$_POST['address2'])	{	$address2=$_POST['address2'];		} else { $address2='';		}
		if(@$_POST['cstno'])	{	$cstno=$_POST['cstno'];				} else { $cstno='';			}
		if(@$_POST['tinno'])	{	$tinno=$_POST['tinno'];				} else { $tinno='';			}
		if(@$_POST['panno'])	{	$panno=$_POST['panno'];				} else { $panno='';			}
		if(@$_POST['gstno'])	{	$gstno=$_POST['gstno'];				} else { $gstno='';			}
		if(@$_POST['adharno'])	{	$adharno=$_POST['adharno'];			} else { $adharno='';		}
		if(@$_POST['bankname'])	{	$bankname=$_POST['bankname'];		} else { $bankname='';		}
		if(@$_POST['accountno']){	$accountno=$_POST['accountno'];		} else { $accountno='';		}
		if(@$_POST['chequename']){	$chequename=$_POST['chequename'];	} else { $chequename='';	}
		
		if($_POST['name']!=$_POST['oldName'])
		{
			//UPDATE THE FOLLOWING TABLS
			if($_POST['type']=='Intra customer' || $_POST['type']=='Inter customer')
			{
				$this->db->query("UPDATE cash_bill SET customername='".$_POST['name']."' WHERE customername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE collection_details SET customername='".$_POST['name']."' WHERE customername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE customerpo_details SET customername='".$_POST['name']."' WHERE customername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE dcbill_details SET cusname='".$_POST['name']."' WHERE cusname='".$_POST['oldName']."' ");
				$this->db->query("UPDATE dc_delivery SET cusname='".$_POST['name']."' WHERE cusname='".$_POST['oldName']."' ");
				$this->db->query("UPDATE invoice_details SET customername='".$_POST['name']."' WHERE customerId='".$_POST['id']."' ");
				$this->db->query("UPDATE invoice_party_statement SET customername='".$_POST['name']."' WHERE customername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `invoice_reports` SET customername='".$_POST['name']."' WHERE customername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `inward_delivery` SET cusname='".$_POST['name']."' WHERE cusname='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `inward_details` SET cusname='".$_POST['name']."' WHERE cusname='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `quotation_details` SET customername='".$_POST['name']."' WHERE customername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `sales_return` SET customername='".$_POST['name']."' WHERE customername='".$_POST['oldName']."' ");
			}
			if($_POST['type']=='Intra supplier' || $_POST['type']=='Inter supplier')
			{
				$this->db->query("UPDATE `po_party_statements` SET suppliername='".$_POST['name']."' WHERE suppliername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `purchase_collection` SET suppliername='".$_POST['name']."' WHERE suppliername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `purchase_details` SET suppliername='".$_POST['name']."' WHERE suppliername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `purchase_reports` SET suppliername='".$_POST['name']."' WHERE suppliername='".$_POST['oldName']."' ");
				$this->db->query("UPDATE `sales_return` SET suppliername='".$_POST['name']."' WHERE suppliername='".$_POST['oldName']."' ");
			}
		}
		
		$customerDet=$this->db->where('id',$id)->get('customer_details')->row();
		$salesamount = $customerDet->salesamount;
		$paidamount = $customerDet->paidamount;
		$returnamount = $customerDet->returnamount;
		$salesamount = ($salesamount!='')?$salesamount:0;
		$paidamount = ($paidamount!='')?$paidamount:0;
		$returnamount = ($returnamount!='')?$returnamount:0;
		$balanceamount = ($_POST['openingbalance']+$salesamount)-($paidamount);
		$data=array(
		'date'=>date('Y-m-d'),			
		'accountname'=>$_POST['accountname'],
		'printname'=>$_POST['printname'], 
		'type'=>$_POST['type'],
		'name'=>$_POST['name'], 
		'phoneno'=>$_POST['phoneno'],
		'email'=>$email,
		'address1'=>$_POST['address1'],
		'address2'		=>$address2,
		'contactperson'	=>$_POST['contactperson'],
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
		'chequeno'=>$chequename,
		'openingbal'=>$_POST['openingbalance'],
		'balanceamount' => $balanceamount,
		'status'=>1,
		);

		$result=$this->customer_model->patry_update($data,$id);
		if($result==true)
		{
			$this->session->set_flashdata('msg','Party Updated Successfully !');
			redirect('customer/view');
		}
		else
		{
			$this->session->set_flashdata('msg1','No changes !');
			redirect('customer/view');
		}
	}

	public function delete()
	{
		$dd=$this->input->post('id');
		$data=$this->db->where('id',$dd)->delete('customer_details');
		if($data)
		{
			$this->session->set_flashdata('msg','Deleted successfully');
			redirect('customer/view');
		}
		else
		{
			$this->session->set_flashdata('msg1','Deleted usuccessfully');
			redirect('customer/view');
		}
	}
	public function get_phoneno()
	{
		$phoneno=$this->input->post('phoneno');
		$this->db->select('*');
		$this->db->from('customer_details');
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

	public function get_stateCode()
  {
    $state=$this->input->post('state');
    $result=$this->db->where('state',$state)->get('stateCode')->result_array();
    if($result)
    {
      foreach ($result as $rows) 
      {
        $data['stateCode']=$rows['stateCode'];
      }
    }
    else
    {
        $data['stateCode']='';
    }

    echo json_encode($data); 
  }

		public function get_stateCodes()
	{
		$state=$this->input->post('state');
		$this->db->select('*');
		$this->db->from('stateCode');
		$this->db->where('state',$state);
		$query = $this->db->get();
		$result = $query->result_array();
		foreach($result as $h)
		{   
		$vob['stateCode']=$h->stateCode;
		$data[] = $vob;
		}
		echo json_encode($data);
	}

	Public function upload_excel()
	{
		$config['upload_path'] =  './upload/customer/';
		//Only allow this type of extensions 
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
		// if any error occurs 
		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('msg1',$error);
			redirect('customer');
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
			$objPHPExcel = $objReader->load('upload/customer/'.$file_name);
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
					$tinno = '-';
					$cstno = '-';
					$panno = $objWorksheet->getCellByColumnAndRow(13,$j)->getValue();
					$gstno = $objWorksheet->getCellByColumnAndRow(14,$j)->getValue();	
					$adharno = $objWorksheet->getCellByColumnAndRow(15,$j)->getValue();
					$bankname = $objWorksheet->getCellByColumnAndRow(16,$j)->getValue();
					$accountno = $objWorksheet->getCellByColumnAndRow(17,$j)->getValue();
					$chequename = $objWorksheet->getCellByColumnAndRow(18,$j)->getValue();
					$openingbalance = $objWorksheet->getCellByColumnAndRow(19,$j)->getValue();


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
						//$tinno =  $tinno ? $tinno:'-';
						//$cstno =  $cstno ? $cstno:'-';	
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

						$getdetails=$this->db->where('type',$type)->where('name',$name)->get('customer_details')->num_rows();
						if($getdetails > 0)
						{
							// $this->db->where('customercode',$customercode);
							// $this->db->update('customer_details',$excel);
						}
						else
						{
							$this->db->insert('customer_details',$data);
						}
					}
				}// loop ends 


				$result=$this->db->affected_rows()!=1 ? false:true;	
				if($result=true)
				{
					$this->session->set_flashdata('msg','Party Details Added Successfully !');
					redirect('customer');
				}
				else
				{
					$this->session->set_flashdata('msg1','Party Details Added UnSuccessfully !');
					redirect('customer');
				}

			}
		}
	}
}
ob_flush();
?>