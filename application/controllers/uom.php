<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Uom extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  $this->load->model('uom_model');
		 if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index()
	{
		$data['uom']=$this->uom_model->select();
		$this->load->view('header');
		$this->load->view('adduom',$data);
		$this->load->view('footer1');
	}

		Public function get_uom()
	{	

		
		 $id=$_POST['uom_id'];

		// echo"<pre>";
		// print_r($id);

		$where=array('id'=>$_POST['uom_id']);
		 $data = $this->db->get_where('uom',$where)->row();
		 echo json_encode($data);

		

	}

	public function insert()
	{

		
		$data=
		array(
			'date'=>date('Y-m-d'),
			'uom' =>$_POST['uom'],
			'status'=>1);
		$result=$this->uom_model->add($data); 
		if($result==true)
		{
			$this->session->set_flashdata('msg','UOM  Added Successfully!');
			redirect('uom');
		}
		else
		{
			$this->session->set_flashdata('msg1','UOM Added Unsuccessfully!');
			redirect('uom');
		}
	}

	// public function view()
	// {  
	// 	$data['user']=$this->tax_model->select();
	// 	$this->load->view('header');
	// 	$this->load->view('addvat',$data);
	// 	$this->load->view('footer1');
	// }

	// public function update()
	// {
	// 	$id =$_POST['id'];
	// 	$data=
	// 	array(
	// 		'date'=>date('Y-m-d'),
	// 		'username' =>$_POST['username'],
	// 		'name' =>$_POST['name'],
	// 		'password' =>$_POST['password'],
	// 		'status'=>1);
	// 	$result=$this->user_model->user_update($id,$data); 
	// 	if($result==true)
	// 	{
	// 		$this->session->set_flashdata('msg','User  Updated Successfully!');
	// 		redirect('user');
	// 	}
	// 	else
	// 	{
	// 		$this->session->set_flashdata('msg1','No changes');
	// 		redirect('user');
	// 	}
	// }
	public function delete()
	{
		$del=$this->input->post('id');
		$data=$this->db->where('id',$del)->delete('uom');
		if($data)
		{
			$this->session->set_flashdata('msg','UOM  Deleted Successfully!');
			redirect('uom');
		}
		else
		{
			$this->session->set_flashdata('msg1','UOM  Deleted Unsuccessfully');
			redirect('uom');
		}
	}
	public function checkUom()
	{
		$uom = $this->input->post('uom');
		$checkExists=$this->db->where('uom', $uom)->count_all_results('uom');
		echo $checkExists;
	}
}

ob_flush();
?>