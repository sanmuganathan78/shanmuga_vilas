<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Taxtype extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  $this->load->model('tax_model');
		 if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index()
	{
		  $data['vat']=$this->tax_model->select();
		$this->load->view('header');
		$this->load->view('addtax',$data);
		$this->load->view('footer1');
	}

		Public function get_tax()
	{	

		
		 $id=$_POST['tax_id'];

		// echo"<pre>";
		// print_r($id);

		$where=array('id'=>$_POST['tax_id']);
		 $data = $this->db->get_where('vat_details',$where)->row();
		 echo json_encode($data);

		

	}

	public function insert()
	{

		
		$data=
		array(
			'date'=>date('Y-m-d'),
			'taxtype' =>$_POST['taxtype'],
			'taxname' =>$_POST['taxname'],
			'taxpercentage'=>$_POST['taxtype'].' @ '.$_POST['taxname'].' %',
			'sgst' =>$_POST['sgst'],
			'cgst' =>$_POST['cgst'],
			'igst' =>$_POST['igst'],
			'status'=>1);
		$result=$this->tax_model->add($data); 
		if($result==true)
		{
			$this->session->set_flashdata('msg','Tax  Added Successfully!');
			redirect('taxtype');
		}
		else
		{
			$this->session->set_flashdata('msg1','Tax Added Unsuccessfully!');
			redirect('taxtype');
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
		$data=$this->db->where('id',$del)->delete('vat_details');
		if($data)
		{
			$this->session->set_flashdata('msg','Tax  Deleted Successfully!');
			redirect('taxtype');
		}
		else
		{
			$this->session->set_flashdata('msg1','Tax  Deleted Unsuccessfully');
			redirect('taxtype');
		}
	}
	public function checkTax()
	{
		$taxtype = $this->input->post('taxtype');
		$taxname = $this->input->post('taxname');
		$checkExists=$this->db->where('taxname', $taxname)->where('taxtype', $taxtype)->count_all_results('vat_details');
		echo $checkExists;
	}
}

ob_flush();
?>