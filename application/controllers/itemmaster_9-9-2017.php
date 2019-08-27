<?php
//error_reporting(0);
class Itemmaster extends CI_Controller {
    function __construct()	
	{
		parent::__construct();
		$this->load->model('item_model');
		if($this->session->userdata('rcbio_login')=='')
		{

			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}

    function index($offset = 0)
	{
		$this->_set_fields();
		$data['id'] = '';
		$data['item']=$this->item_model->vi();
		$data['action'] = site_url('Itemmaster/addItem');		
		$this->load->view('header');
		$this->load->view('item_master_view',$data);
		$this->load->view('footer1');
	}
	
	function addItem(){
        // set common properties
        $data['action'] = site_url('Itemmaster/addItem');
	    $this->_set_fields();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block errors">', '</span>');
		$this->form_validation->set_rules('hsnno','HSN Code','required');
		$this->form_validation->set_rules('itemname','Item Name','required');//|prep_url|callback_url_exists
		$this->form_validation->set_rules('uom','UOM','required');
		$this->form_validation->set_rules('price','Price','required');
		$this->form_validation->set_rules('taxtype','Tax Type','required');
		$this->form_validation->set_rules('priceType','Price Type','required');
		if ($this->form_validation->run() == FALSE)
		{
			$data['id']='have';
			$this->load->view('header');
			$this->load->view('item_master_view',$data);
			$this->load->view('footer1');
        }
		else
		{
			if(isset($_POST['priceType'])){ $priceType = $_POST['priceType']; } else { $priceType = 'Exclusive'; }
			if($_POST['price']!="") { $price=$_POST['price']; } else { $price=0; }
			if($_POST['hsnno']!="") { $hsnno=$_POST['hsnno']; } else { $hsnno=0; }
			$data=array(
						'date'		=> date('Y-m-d'),
						'itemname'	=> $_POST['itemname'],
						'uom'		=> $_POST['uom'],
						'price'		=> $price,
						'hsnno'		=> $hsnno,
						'taxtype'	=> $_POST['taxtype'],
						'sgst'		=> $_POST['sgst'],
						'cgst'		=> $_POST['cgst'],
						'igst'		=> $_POST['igst'],
						'status'	=> 1,
						'priceType' => $priceType
						);
			if($data)
			{
				$this->db->insert('additem',$data);
				$this->session->set_flashdata('msg','Item Added Successfully !');
				redirect('itemmaster');
			}
			else
			{

				$this->session->set_flashdata('msg','Item Added UnSuccessfully !');
				redirect('itemmaster');

			}
        }
		
    }
	function editItem($id){
        // set validation properties
        $this->_set_fields();
        // prefill form values
		$id=base64_decode($this->uri->segment(3));
		$person=$this->db->where('id',$id)->get('additem')->row();	
		
        $this->validation->sid = $id;
		$this->validation->hsnno = $person->hsnno;
		$this->validation->itemname = $person->itemname;
		$this->validation->uom = $person->uom;
		$this->validation->price = $person->price;
		$this->validation->taxtype = $person->taxtype;
		$this->validation->sgst = $person->sgst;
		$this->validation->cgst = $person->cgst;
		$this->validation->igst = $person->igst;
		$this->validation->priceType = $person->priceType;
        // set common properties
		$data['id'] = 'onUpdate';
        $data['action'] = site_url('itemmaster/updateItem');
		$this->load->view('header');
		$this->load->view('item_master_view',$data);
		$this->load->view('footer1');
		
    }
	function updateItem(){
        // set common properties
        $data['action'] = site_url('AdminSlider/updateItem');
		$appTable='admin_slider';
		$sid = $this->input->post('sid');
		$person=$this->db->where('id',$sid)->get('additem')->row();
        $this->validation->sid = $sid;
		$this->validation->hsnno = $person->hsnno;
		$this->validation->itemname = $person->itemname;
		$this->validation->uom = $person->uom;
		$this->validation->price = $person->price;
		$this->validation->taxtype = $person->taxtype;
		$this->validation->sgst = $person->sgst;
		$this->validation->cgst = $person->cgst;
		$this->validation->igst = $person->igst;
		$this->validation->priceType = $person->priceType;
	
        // set validation properties
        $this->_set_fields();
        //$this->_set_rules();
        $this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block errors">', '</span>');
		$this->form_validation->set_rules('hsnno','HSN Code','required');
		$this->form_validation->set_rules('itemname','Item Name','required');//|prep_url|callback_url_exists
		$this->form_validation->set_rules('uom','UOM','required');
		$this->form_validation->set_rules('price','Price','required');
		$this->form_validation->set_rules('taxtype','Tax Type','required');
		$this->form_validation->set_rules('priceType','Price Type','required');
		
		// run validation
        if ($this->form_validation->run() == FALSE){
			$this->validation->sid = $sid;
			$data['id'] = 'onUpdate';
			$this->load->view('header');
			$this->load->view('item_master_view',$data);
			$this->load->view('footer1');
        }
		else
		{
			if($_POST['itemname']!= $_POST['oldItemName'])
			{
				//UPDATE THE FOLLOWING TABLS
				/* 1 */ $this->db->query("UPDATE cash_bill SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 2 */ $this->db->query("UPDATE dcbill_details SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 3 */ $this->db->query("UPDATE dc_delivery SET `itemname` = '".$_POST['itemname']."' WHERE itemname='".$_POST['oldItemName']."'");
				/* 4 */ $this->db->query("UPDATE invoice_details SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 5 */ $this->db->query("UPDATE invoice_party_statement SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 6 */ $this->db->query("UPDATE invoice_reports SET `itemname` = '".$_POST['itemname']."' WHERE itemname='".$_POST['oldItemName']."'");
				/* 7 */ $this->db->query("UPDATE inward_delivery SET `itemname` = '".$_POST['itemname']."' WHERE itemname='".$_POST['oldItemName']."'");
				/* 8 */ $this->db->query("UPDATE inward_details SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 9 */ $this->db->query("UPDATE jobinward_data SET `itemname` = '".$_POST['itemname']."' WHERE itemname='".$_POST['oldItemName']."'");
				/* 10 */$this->db->query("UPDATE purchase_reports SET `itemname` = '".$_POST['itemname']."' WHERE itemname='".$_POST['oldItemName']."'");
				/* 10 */$this->db->query("UPDATE job_data SET `itemname` = '".$_POST['itemname']."' WHERE itemname='".$_POST['oldItemName']."'");
				/* 11 */$this->db->query("UPDATE po_party_statements SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 12 */$this->db->query("UPDATE purchase_details SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 13 */$this->db->query("UPDATE quotation_details SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 14 */$this->db->query("UPDATE sales_return SET `itemname` = REPLACE(itemname, '".$_POST['oldItemName']."', '".$_POST['itemname']."')");
				/* 15 */$this->db->query("UPDATE stock SET `itemname` = '".$_POST['itemname']."' WHERE itemname='".$_POST['oldItemName']."'");
				/* 16 */$this->db->query("UPDATE stock_reports SET `itemname` = '".$_POST['itemname']."' WHERE itemname='".$_POST['oldItemName']."'");
			}
			
			$uom =$_POST['uom'];
			$itemname =$_POST['itemname'];
			$hsnno =$_POST['hsnno'];
			$price =$_POST['price'];
			$taxtype =$_POST['taxtype'];
			$sgst=$_POST['sgst'];
			$cgst=$_POST['cgst'];
			$igst=$_POST['igst'];
			$priceType = $_POST['priceType'];
			$data=array('uom'=>$uom,'itemname'=>$itemname,'price'=>$price,'taxtype'=>$taxtype,'hsnno'=>$hsnno,'sgst'=>$sgst,'igst'=>$igst,'cgst'=>$cgst,'priceType'=>$priceType);
			$result = $this->db->where('id',$sid)->update('additem',$data);
			if($result==true)
			{
				$this->session->set_flashdata('msg','Item Updated Successfully !');
				redirect('itemmaster');
			}
			else
			{
				$this->session->set_flashdata('msg1','No changes  !');
				redirect('itemmaster');
			}
		}
         
    }
	function ajax_delete($id){
		$this->item_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
    }
	
	// validation fields
    function _set_fields(){
        $fields['id'] = '';
        $fields['sid'] = '';
        $fields['hsnno'] = '';
        $fields['itemname'] = '';
        $fields['uom'] = '';
        $fields['price'] = '';
        $fields['taxtype'] = '';
        $fields['sgst'] = '';
        $fields['cgst'] = '';
        $fields['igst'] = '';
        $fields['priceType'] = '';
        $this->validation->set_fields($fields);
    }
	
	public function ajax_list()
	{
		$list = $this->item_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i=1;
		foreach ($list as $person) {
			@$uom=$this->db->select('uom')->where('id',$person->uom)->get('uom')->row()->uom;
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] =date('d-m-Y',strtotime($person->date));
			$row[] = $person->hsnno;
			$row[] = $person->itemname;
			$row[] = $uom;
			$row[] = $person->sgst;
			$row[] = $person->cgst;
			$row[] = $person->igst;
			$row[] = $person->price;
			$code=base64_encode($person->id);
			//add html for action
			$row[] = '
			<div class="btn-group">
				<button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Manage <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu" style="background: #23BDCF none repeat scroll 0% 0%;width:14px;min-width: 100%;">
					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('itemmaster/editItem/'.$code).'" title="Hapus" >Edit</a></li>
					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')">Delete</a></li>
				</ul>
			</div>
			';
			$data[] = $row;
		}

		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->item_model->count_all(),
		"recordsFiltered" => $this->item_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	
	public function gettax()
	{
		$taxtype=$this->input->post('taxtype');
		$taxs=$this->db->where('id',$taxtype)->get('vat_details')->result_array();
		if($taxs)
		{
			foreach ($taxs as $rows) 
			{
				$data['sgst']=$rows['sgst'];
				$data['cgst']=$rows['cgst'];
				$data['igst']=$rows['igst'];
			}
		}
		else
		{
				$data['sgst']='';
				$data['cgst']='';
				$data['igst']='';
		}

		echo json_encode($data); 
	}
	public function getcode()
	{
		$name=$_POST['name'];
		$data=$this->db->where('hsnno',$name)->get('additem')->result();
		echo $count=count($data);
	}
	public function getname()
	{
		$name=$_POST['name'];
		$data=$this->db->where('itemname',$name)->get('additem')->result();
		echo $count=count($data);
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
			redirect('itemmaster');
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
				for($j=3; $j<=$lastRow; $j++)
				{
					$itemname = $objWorksheet->getCellByColumnAndRow(0,$j)->getValue();
					$uom = $objWorksheet->getCellByColumnAndRow(1,$j)->getValue();	
					$price = $objWorksheet->getCellByColumnAndRow(2,$j)->getValue();
					$hsnno = $objWorksheet->getCellByColumnAndRow(3,$j)->getValue();
					$sgst = $objWorksheet->getCellByColumnAndRow(4,$j)->getValue();
					$cgst = $objWorksheet->getCellByColumnAndRow(5,$j)->getValue();
					$igst = $objWorksheet->getCellByColumnAndRow(6,$j)->getValue();
					$priceType = $objWorksheet->getCellByColumnAndRow(7,$j)->getValue();

					if($itemname!="")
					{
						$itemname =  $itemname ? $itemname:'-';
						$price =  $price ? $price:'0';
						$hsnno =  $hsnno ? $hsnno:'-';
						$sgst =  $sgst ? $sgst:'0';
						$cgst =  $cgst ? $cgst:'0';
						$igst =  $igst ? $igst:'0';
						$priceType =  ($priceType!="")?$priceType:'Exclusive';
						if($uom!="")
						{
							$uomsdetails=$this->db->where('uom',$uom)->get('uom')->result();
							if(count($uomsdetails) > 0)
							{
								foreach($uomsdetails as $u)
								$uoms=$u->id;
							}
							else
							{
								$uoms='-';
							}

						}
						else
						{
							$uoms='-';
						}

						$data=array(
						'date'=>date('Y-m-d'),
						'itemname'=>$itemname,
						'uom'=>$uoms,
						'price'=>$price,
						'hsnno'=>$hsnno,
						'sgst'=>$sgst,
						'cgst'=>$cgst,
						'igst'=>$igst,
						'status'=>1,
						'priceType'=>$priceType
						);
						$getdetails=$this->db->where('itemname',$itemname)->get('additem')->num_rows();
						if($getdetails > 0)
						{
							
						}
						else
						{
							$this->db->insert('additem',$data);
						}
					}
				}// loop ends 


				$result=$this->db->affected_rows()!=1 ? false:true;	
				if($result=true)
				{
					$this->session->set_flashdata('msg','Item Details Added Successfully !');
					redirect('itemmaster');
				}
				else
				{
				$this->session->set_flashdata('msg1','Item Details Added UnSuccessfully !');
				redirect('itemmaster');
				}

			}
		}
	}
}
?>
