<?php
//error_reporting(0);
class Usermaster extends CI_Controller {
    function __construct()	
	{
		parent::__construct();
		$this->load->model('user_master_model');
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
		$data['item']='';
		$data['action'] = site_url('usermaster/addMenu');		
		$this->load->view('header');
		$this->load->view('user_master_view',$data);
		$this->load->view('footer1');
	}
	function updatetoadd()
	{
		$this->_set_fields();
		$data['id'] = 'have';
		$data['item']='';
		$data['action'] = site_url('usermaster/addMenu');		
		$this->load->view('header');
		$this->load->view('user_master_view',$data);
		$this->load->view('footer1');
	}
	function addMenu(){
        // set common properties
        $data['action'] = site_url('usermaster/addMenu');
	    $this->_set_fields();
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block errors">', '</span>');
		$this->form_validation->set_rules('username','User Name','required');//|prep_url|callback_url_exists
		$this->form_validation->set_rules('designation','Designation','required');
		$this->form_validation->set_rules('password','Password','required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['id']='have';
			$this->load->view('header');
			$this->load->view('user_master_view',$data);
			$this->load->view('footer1');
        }
		else
		{

			if(@$_POST['email']) { $email=$_POST['email']; } else { $email=''; }
			if(@$_POST['phoneno']) { $phoneno=$_POST['phoneno']; } else { $phoneno=''; }
			if(@$_POST['doj']) { $doj=date('Y-m-d',strtotime($_POST['doj'])); } else { $doj=''; }
			if(@$_POST['sub_menu_link']) { $sub_menu_link=$_POST['sub_menu_link']; } else { $sub_menu_link=''; }
			if(@$_POST['selectedMainMenu']) { $selectedMainMenu=$_POST['selectedMainMenu']; } else { $selectedMainMenu=''; }
			if(@$_POST['selectedSubMenu']) { $selectedSubMenu=$_POST['selectedSubMenu']; } else { $selectedSubMenu=''; }
			if(@$_POST['add_party']) { $add_party=$_POST['add_party']; } else { $add_party='0'; }
			if(@$_POST['add_expenses']) { $add_expenses=$_POST['add_expenses']; } else { $add_expenses='0'; }
			if(@$_POST['add_quotation']) { $add_quotation=$_POST['add_quotation']; } else { $add_quotation='0'; }
			
			$data=array('userType' => 'U',
						'date'=>date('Y-m-d'),			
						'name'=>$_POST['username'],
						'designation'=>$_POST['designation'],	
						'email'=>$email,
						'phoneno'=>$phoneno,
						'doj'=> $doj,
						'username'=>$_POST['username'],
						'password'=>$_POST['password'],
						'status'=>'1',
						'sub_menu_link'=>$sub_menu_link,
						'selectedMainMenu' => $selectedMainMenu,
						'selectedSubMenu'	=> $selectedSubMenu,
						'add_party'	=> $add_party,
						'add_expenses' => $add_expenses,
						'add_quotation' => $add_quotation
					);
		
			$result=$this->db->insert('login_details',$data);
			$login_id=$this->db->insert_id();
			
			if($result)
			{
				$main_menu = explode(",",$_POST['selectedMainMenu']);
				$sub_menu = explode(",",$_POST['selectedSubMenu']);
				$sub_menu_link = explode(",",$_POST['sub_menu_link']);
				$mainmenuCount = count($main_menu);
				for($i=0;$i<$mainmenuCount;$i++)
				{
					$data=array('login_id' => $login_id,
								'main_menu'=>$main_menu[$i],			
								'sub_menu'=>$sub_menu[$i],			
								'sub_menu_link'=>$sub_menu_link[$i]
							);
		
					$result=$this->db->insert('user_menu',$data);
				}
			
				$this->session->set_flashdata('msg','User Added Successfully !');
				redirect('usermaster');
			}
			else
			{

				$this->session->set_flashdata('msg','User Added UnSuccessfully !');
				redirect('usermaster');

			}
        }
		
    }
	function editUser($id){
        // set validation properties
        $this->_set_fields();
        // prefill form values
		$id=base64_decode($this->uri->segment(3));
		$person=$this->db->where('id',$id)->get('login_details')->row();	
		
        $this->validation->sid = $id;
		$this->validation->name	 = $person->name;
		$this->validation->designation = $person->designation;
		$this->validation->email = $person->email;
		$this->validation->phoneno = $person->phoneno;
		if($person->doj!='')
		{
			$this->validation->doj	 = date('d-m-Y',strtotime($person->doj));
		}
		else
		{
			$this->validation->doj	 = '';
		}
		
		$this->validation->username = $person->username;
		$this->validation->password = $person->password;
		$this->validation->sub_menu_link = $person->sub_menu_link;
		$this->validation->selectedMainMenu = $person->selectedMainMenu;
		$this->validation->selectedSubMenu = $person->selectedSubMenu;
		$this->validation->add_party = $person->add_party;
		$this->validation->add_expenses = $person->add_expenses;
		$this->validation->add_quotation = $person->add_quotation;
        // set common properties
		$data['id'] = 'onUpdate';
        $data['action'] = site_url('usermaster/updateMenu');
		$this->load->view('header');
		$this->load->view('user_master_view',$data);
		$this->load->view('footer1');
		
    }
	function updateMenu(){
        // set common properties
        $data['action'] = site_url('AdminSlider/updateMenu');
		$sid = $this->input->post('sid');
		$person=$this->db->where('id',$sid)->get('login_details')->row();
        $this->validation->sid = $sid;
		$this->validation->name	 = $person->name;
		$this->validation->designation = $person->designation;
		$this->validation->email = $person->email;
		$this->validation->phoneno = $person->phoneno;
		if($person->doj!='')
		{
			$this->validation->doj	 = date('d-m-Y',strtotime($person->doj));
		}
		else
		{
			$this->validation->doj	 = '';
		}
		
		$this->validation->username = $person->username;
		$this->validation->password = $person->password;
		$this->validation->sub_menu_link = $person->sub_menu_link;
		$this->validation->selectedMainMenu = $person->selectedMainMenu;
		$this->validation->selectedSubMenu = $person->selectedSubMenu;
		$this->validation->add_party = $person->add_party;
		$this->validation->add_expenses = $person->add_expenses;
		$this->validation->add_quotation = $person->add_quotation;
	
        // set validation properties
        $this->_set_fields();
        //$this->_set_rules();
        $this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<span class="help-block errors">', '</span>');
		$this->form_validation->set_rules('username','User Name','required');//|prep_url|callback_url_exists
		$this->form_validation->set_rules('designation','Designation','required');
		$this->form_validation->set_rules('password','Password','required');

		
		// run validation
        if ($this->form_validation->run() == FALSE){
			$this->validation->sid = $sid;
			$data['id'] = 'onUpdate';
			$this->load->view('header');
			$this->load->view('user_master_view',$data);
			$this->load->view('footer1');
        }
		else
		{
			if(@$_POST['email']) { $email=$_POST['email']; } else { $email=''; }
			if(@$_POST['phoneno']) { $phoneno=$_POST['phoneno']; } else { $phoneno=''; }
			if(@$_POST['doj']) { $doj=date('Y-m-d',strtotime($_POST['doj'])); } else { $doj=''; }
			if(@$_POST['sub_menu_link']) { $sub_menu_link=$_POST['sub_menu_link']; } else { $sub_menu_link=''; }
			if(@$_POST['selectedMainMenu']) { $selectedMainMenu=$_POST['selectedMainMenu']; } else { $selectedMainMenu=''; }
			if(@$_POST['selectedSubMenu']) { $selectedSubMenu=$_POST['selectedSubMenu']; } else { $selectedSubMenu=''; }
			if(@$_POST['add_party']) { $add_party=$_POST['add_party']; } else { $add_party='0'; }
			if(@$_POST['add_expenses']) { $add_expenses=$_POST['add_expenses']; } else { $add_expenses='0'; }
			if(@$_POST['add_quotation']) { $add_quotation=$_POST['add_quotation']; } else { $add_quotation='0'; }

			$data=array('userType' => 'U',
						'date'=>date('Y-m-d'),			
						'name'=>$_POST['username'],
						'designation'=>$_POST['designation'],	
						'email'=>$email,
						'phoneno'=>$phoneno,
						'doj'=> $doj,
						'username'=>$_POST['username'],
						'password'=>$_POST['password'],
						'status'=>'1',
						'sub_menu_link'=>$sub_menu_link,
						'selectedMainMenu'=>$selectedMainMenu,
						'selectedSubMenu'=>$selectedSubMenu,
						'add_party'	=> $add_party,
						'add_expenses' => $add_expenses,
						'add_quotation' => $add_quotation
					);
		
			$result = $this->db->where('id',$sid)->update('login_details',$data);
			
			if($result)
			{
				$this->db->query("DELETE FROM user_menu WHERE login_id='".$sid."' ");
				$main_menu = explode(",",$_POST['selectedMainMenu']);
				$sub_menu = explode(",",$_POST['selectedSubMenu']);
				$sub_menu_link = explode(",",$_POST['sub_menu_link']);
				$mainmenuCount = count($main_menu);
				for($i=0;$i<$mainmenuCount;$i++)
				{
					$data=array('login_id' => $sid,
								'main_menu'=>$main_menu[$i],			
								'sub_menu'=>$sub_menu[$i],			
								'sub_menu_link'=>$sub_menu_link[$i]
							);
		
					$result=$this->db->insert('user_menu',$data);
				}
				$this->session->set_flashdata('msg','User Updated Successfully !');
				redirect('usermaster');
			}
			else
			{
				$this->session->set_flashdata('msg1','No changes  !');
				redirect('usermaster');
			}
		}
         
    }
	function ajax_delete($id){
		$this->user_master_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
    }
	
	// validation fields
    function _set_fields(){
        $fields['id'] = '';
        $fields['sid'] = '';
        $fields['username'] = '';
        $fields['designation'] = '';
        $fields['password'] = '';
        $fields['phoneno'] = '';
        $fields['email'] = '';
        $fields['doj'] = '';
        $fields['sub_menu_link'] = '';
        $fields['selectedMainMenu'] = '';
        $fields['selectedSubMenu'] = '';
        $fields['add_party'] = '';
        $fields['add_expenses'] = '';
        $fields['add_quotation'] = '';
      
        $this->validation->set_fields($fields);
    }
	
	public function ajax_list()
	{
		$list = $this->user_master_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i=1;
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] =date('d-m-Y',strtotime($person->date));
			$row[] = $person->username;
			$row[] = $person->designation;
			$row[] = $person->phoneno;
			$row[] = $person->email;
			$code=base64_encode($person->id);
			//add html for action
			$row[] = '
			<div class="btn-group">
				<button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Manage <span class="caret"></span></button>
				<ul class="dropdown-menu" role="menu" style="background: #23BDCF none repeat scroll 0% 0%;width:14px;min-width: 100%;">
					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('usermaster/editUser/'.$code).'" title="Hapus" >Edit</a></li>
					<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')">Delete</a></li>
				</ul>
			</div>
			';
			$data[] = $row;
		}

		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->user_master_model->count_all(),
		"recordsFiltered" => $this->user_master_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}
	

	public function getname()
	{
		$name=$_POST['name'];
		if($_POST['id']!='')
		{
			$this->db->where('id <>',$_POST['id']);
		}
		$this->db->where('username',$name);
		$this->db->from('login_details');	
		$query = $this->db->get();
		$data =  $query->result();
		//$data=$this->db->where('vendorname',$name)->get('vendor_details')->result();
		echo $count=count($data);
	}
	
	
	public function reports()
	{
		$fromdate=$_POST['fromdate'];
		$todate=$_POST['todate'];
		$data['cus']=$this->user_master_model->search_vendor();
		$this->load->view('vendor_reports',$data,$fromdate,$todate);
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
			redirect('usermaster');
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
					$this->session->set_flashdata('msg','Vendor Details Added Successfully !');
					redirect('usermaster');
				}
				else
				{
				$this->session->set_flashdata('msg1','Vendor Details Added UnSuccessfully !');
				redirect('usermaster');
				}

			}
		}
	}
}
?>
