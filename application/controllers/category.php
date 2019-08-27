<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Category extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('category_model');
		if($this->session->userdata('rcbio_login')=='')
		{

			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index()
	{
		$data['category']=$this->category_model->select();
		$this->load->view('header');
		$this->load->view('addcategory',$data);
		$this->load->view('footer1');
	}

	Public function get_category()
	{	
		$id=$_POST['category_id'];
		$where=array('id'=>$_POST['category_id']);
		$data = $this->db->get_where('category',$where)->row();
		echo json_encode($data);
	}

	public function insert()
	{
		$data=array('date'=>date('Y-m-d'),'category' =>$_POST['category'],'status'=>1);
		$result=$this->category_model->add($data); 
		if($result==true)
		{
			$this->session->set_flashdata('msg','Category  Added Successfully!');
			redirect('category');
		}
		else
		{
			$this->session->set_flashdata('msg1','Category Added Unsuccessfully!');
			redirect('category');
		}
	}

	public function delete()
	{
		$del=$this->input->post('id');
		$data=$this->db->where('id',$del)->delete('category');
		if($data)
		{
			$this->session->set_flashdata('msg','Category  Deleted Successfully!');
			redirect('category');
		}
		else
		{
			$this->session->set_flashdata('msg1','Category  Deleted Unsuccessfully');
			redirect('category');
		}
	}
}

ob_flush();
?>