<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
	class Profile extends CI_Controller {
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
			$data['profile']=$this->company_model->select();
			$data['login']=$this->db->order_by('id','asc')->limit(1)->get('login_details')->result_array();
			$data['logo']=$this->db->get('company_logo')->result();
			$this->load->view('header');
			$this->load->view('company_details',$data);
			// $this->load->view('footer');
		}

		public function insert()
		{
			$id=$_POST['id'];
			$username=$_POST['username'];
			$password=$_POST['password'];

			$d=array(
			'softwarename' =>$_POST['softwarename'],
			'companyname' =>$_POST['companyname'],
			'phoneno' =>$_POST['phoneno'],
			'mobileno' =>$_POST['mobileno'],
			'emailid' =>$_POST['emailid'],
			'gstin' =>$_POST['gstin'],
			'website' =>$_POST['website'],
			'address1' =>$_POST['address1'],
			'address2' =>$_POST['address2'],
			'city' =>$_POST['city'],
			'pincode' =>$_POST['pincode'],
			'stateCode'	=> $_POST['stateCode'],
			'aadharno' =>$_POST['aadharno'],
			'username' =>$_POST['username'],
			'password' =>$_POST['password'],
			'bankname' =>$_POST['bankname'],
			'accountno' =>$_POST['accountno'],
			'bankbranch' =>$_POST['bankbranch'],
			'ifsccode' =>$_POST['ifsccode'],
			'status'=>1);

			$this->db->where('id',$id);
			$this->db->update('login_details',array('username'=>$username,'password'=>$password));

			$data=$this->db->get('profile')->result();
			if($data!='')
			{
				$profile=$this->db->get('profile')->result();
				foreach ($profile as $a)
				$id=$a->id;
				$result=$this->company_model->update($id,$d);
				if($result==true)
				{
					$this->session->set_flashdata('msg','Profile Updated Successfully');
					redirect('profile');
				}
				else
				{
					$this->session->set_flashdata('msg1','No Changes');
					redirect('profile');	
				}
			}
			else
			{
				$result=$this->company_model->insert($a);
				if($result==true)
				{
					$this->session->set_flashdata('msg','Profile Added Successfully');
					redirect('profile');
				}
				else
				{
					$this->session->set_flashdata('msg1','Profile Added Successfully');
					redirect('profile');	
				}
			}
		}


		Public function upload()
		{
			$config = array(
			'upload_path' => "./upload/",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)      
			);
			$this->load->library('upload', $config);
			if($this->upload->do_upload('file'))
			{
				$data = array('upload_data' => $this->upload->data());
				foreach($data as $key)
				{
					$filename=$key['file_name'];
					$array=array('date'	=>	date('Y-m-d'),'image'	=>	$filename,'status'	=>	1);
					$get=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('company_logo')->result();
					$count=count($get);
					if($count >0)
					{
						$this->db->order_by('id','desc');
						$this->db->limit(1);
						$this->db->update('company_logo',$array); 
						$result=$this->db->affected_rows()!=1? false:true;
						if($result=true)
						{
							$this->session->set_flashdata('msg','Companylogo Update Successfully !');
							redirect('profile');
						}
						else
						{
							$this->session->set_flashdata('msg1','Companylogo Update Failed !');
							redirect('profile');
						} 

					}
					else
					{
						$this->db->insert('company_logo',$array); 
						$result=$this->db->affected_rows()!=1? false:true;
						if($result=true)
						{
							$this->session->set_flashdata('msg','Companylogo Update Successfully !');
							redirect('profile');
						}
						else
						{
							$this->session->set_flashdata('msg1','Companylogo Update Failed !');
							redirect('profile');
						} 
					}
				}

			}
			else
			{
				$error = array('error' => $this->upload->display_errors());
				$this->session->set_flashdata('msg','Upload Logo'.$error);
				redirect('profile');
			}
		}
	}
ob_flush();
?>