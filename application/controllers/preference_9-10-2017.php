<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	ob_start();
	class Preference extends CI_Controller {
		public function __construct()
		{
			parent::__construct();
			$this->load->model('company_model');
			if($this->session->userdata('rcbio_login')=='')
			{
				$this->session->set_flashdata('msg','Please Login to continue!');
				redirect('login');
			}	
			date_default_timezone_set('Asia/Kolkata');
		}

		public function index()
		{
			$this->db->select('*');
			$this->db->from('preference_settings');
			$data['row']=$this->db->get()->row_array();
			//print_r($data['row']);
			//exit;
			//$data['login']=$this->db->order_by('id','asc')->limit(1)->get('login_details')->result_array();
			//$data['logo']=$this->db->get('company_logo')->result();
			$this->load->view('header');
			$this->load->view('preference_settings',$data);
			// $this->load->view('footer');
		}

		public function insert()
		{
			$id='1';
			$config = array(
			'upload_path' => "./upload/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)      
			);
			$this->load->library('upload', $config);
			if(empty($_FILES['cmp_logo']['name']))
			{
				$cmp_logo=$this->input->post('old_cmp_logo');
			}
			else
			{
				
				if ( ! $this->upload->do_upload('cmp_logo'))
				{
					$this->session->set_flashdata('msg', ' Error in Image Uploading! <br>'.$this->upload->display_errors());
					redirect('preference');
				}
				else
				{
					$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
					$cmp_logo = $upload_data['file_name'];
				}
			}
			if(empty($_FILES['cont_logo']['name']))
			{
				$cont_logo=$this->input->post('old_cont_logo');
			}
			else
			{
				
				if ( ! $this->upload->do_upload('cont_logo'))
				{
					$this->session->set_flashdata('msg', ' Error in Image Uploading! <br>'.$this->upload->display_errors());
					redirect('preference');
				}
				else
				{
					$upload_data = $this->upload->data(); //Returns array of containing all of the data related to the file you uploaded.
					$cont_logo = $upload_data['file_name'];
				}
			}
			$d=array(
			'quotation' =>$_POST['quotation'],
			'expenses' =>$_POST['expenses'],
			'dc' =>$_POST['dc'],
			'voucher' =>$_POST['voucher'],
			'debit' =>$_POST['debit'],
			'credit' =>$_POST['credit'],
			'purchase' =>$_POST['purchase'],
			'invoice' =>$_POST['invoice'],
			'cmp_companyname' =>$_POST['cmp_companyname'],
			'cmp_phoneno' =>$_POST['cmp_phoneno'],
			'cmp_mobileno' =>$_POST['cmp_mobileno'],
			'cmp_address1' =>$_POST['cmp_address1'],
			'cmp_address2' =>$_POST['cmp_address2'],
			'cmp_city' =>$_POST['cmp_city'],
			'cmp_pincode' =>$_POST['cmp_pincode'],
			'cmp_stateCode' =>$_POST['cmp_stateCode'],
			'cmp_website' =>$_POST['cmp_website'],
			'cmp_emailid' =>$_POST['cmp_emailid'],
			'cmp_logo' =>$cmp_logo,
			'cont_companyname' =>$_POST['cont_companyname'],
			'cont_phoneno' =>$_POST['cont_phoneno'],
			'cont_mobileno' =>$_POST['cont_mobileno'],
			'cont_address1' =>$_POST['cont_address1'],
			'cont_address2' =>$_POST['cont_address2'],
			'cont_city' =>$_POST['cont_city'],
			'cont_pincode' =>$_POST['cont_pincode'],
			'cont_stateCode' =>$_POST['cont_stateCode'],
			'cont_website' =>$_POST['cont_website'],
			'cont_emailid' =>$_POST['cont_emailid'],
			'cont_logo' =>$cont_logo
			);
			$this->db->where('id',$id);
			$this->db->update('preference_settings',$d);
			$result=$this->db->affected_rows()!=1? false:true;
			if($result==true)
			{
				$this->session->set_flashdata('msg','Settings Updated Successfully');
				redirect('preference');
			}
			else
			{
				$this->session->set_flashdata('msg1','No Changes');
				redirect('preference');	
			}
			
		}
		public function resetFun()
		{
			$id='1';
			$d=array(
			'quotation' =>'001',
			'expenses' =>'001',
			'dc' =>'001',
			'voucher' =>'001',
			'debit' =>'001',
			'credit' =>'001',
			'purchase' =>'001',
			'invoice' =>'001'
			);
			$this->db->where('id',$id);
			$this->db->update('preference_settings',$d);
			$result=$this->db->affected_rows()!=1? false:true;
			if($result==true)
			{
				$this->session->set_flashdata('msg','Settings Updated Successfully');
				redirect('preference');
			}
			else
			{
				$this->session->set_flashdata('msg1','No Changes');
				redirect('preference');	
			}
		}
		public function resetTables()
		{
			$checkedBoxes = $this->input->post('resetChkBox');
			foreach($checkedBoxes as $cb)
			{
				if($cb=='sales')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$this->db->query("TRUNCATE TABLE `invoice_details`");
					$this->db->query("TRUNCATE TABLE `invoice_party_statement`");
					$this->db->query("TRUNCATE TABLE `invoice_reports`");
					$this->db->query("DELETE FROM `sales_return` WHERE types='Debit'");
				}
				elseif($cb=='purchase')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$this->db->query("TRUNCATE TABLE `po_party_statements`");
					$this->db->query("TRUNCATE TABLE `purchase_collection`");
					$this->db->query("TRUNCATE TABLE `purchase_details`");
					$this->db->query("TRUNCATE TABLE `purchase_reports`");
					$this->db->query("DELETE FROM `sales_return` WHERE types='Credit'");
				}
				elseif($cb=='item')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$this->db->query("TRUNCATE TABLE `additem`");
					$this->db->query("TRUNCATE TABLE `stock`");
					$this->db->query("TRUNCATE TABLE `stock_reports`");
				}
				elseif($cb=='party')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$this->db->query("TRUNCATE TABLE `customer_details`");
				}
				elseif($cb=='voucher')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$this->db->query("TRUNCATE TABLE `voucher`");
					$this->db->query("TRUNCATE TABLE `collection_details`");
				}
				elseif($cb=='expenses')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$this->db->query("TRUNCATE TABLE `expenses`");
				}
				elseif($cb=='quotation')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$this->db->query("TRUNCATE TABLE `quotation_details`");
				}
				elseif($cb=='dc')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$this->db->query("TRUNCATE TABLE `dcbill_details`");
					$this->db->query("TRUNCATE TABLE `dc_delivery`");
				}
				elseif($cb=='full')
				{
					//TRUNCATE THE FOLLOWING TABLES
					$databaseName = $this->db->database;
					$query = $this->db->query("SELECT t.TABLE_NAME AS stud_tables FROM INFORMATION_SCHEMA.TABLES AS t WHERE t.TABLE_SCHEMA =  '".$databaseName."' AND t.TABLE_NAME NOT LIKE  '%company_logo' AND t.TABLE_NAME NOT LIKE  '%login_details' AND t.TABLE_NAME NOT LIKE  '%preference_details' AND t.TABLE_NAME NOT LIKE  '%preference_settings' AND t.TABLE_NAME NOT LIKE  '%profile'");
					
					$res = $query->num_rows();
					if($res > 0)
					{
						$result = $query->result();
						foreach($result as $r)
						{
							//echo "TRUNCATE TABLE `".$r->stud_tables."`<br>";
							$this->db->query("TRUNCATE TABLE `".$r->stud_tables."`");
						}
					}
				}
			}
			$this->session->set_flashdata('msg','Settings Updated Successfully');
			redirect('preference');
		}
	}
	ob_flush();
?>