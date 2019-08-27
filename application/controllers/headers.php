<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Headers extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		//$this->load->model('tax_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}
	public function index()
	{
		$data['vat']=$this->db->get('headers')->result_array();
		$this->load->view('header');
		$this->load->view('addheaders',$data);
		$this->load->view('footer1');
	}

	Public function get_tax()
	{	
		$id=$_POST['tax_id'];
		$where=array('id'=>$_POST['tax_id']);
		$data = $this->db->get_where('vat_details',$where)->row();
		echo json_encode($data);
	}

	public function insert()
	{
		$data=array(
		'date'=>date('Y-m-d'),
		'name' =>$_POST['name'],
		'status'=>1);
		$result=$this->db->insert('headers',$data);
		if($result==true)
		{
			$this->session->set_flashdata('msg','Account Header  Added Successfully!');
			redirect('headers');
		}
		else
		{
			$this->session->set_flashdata('msg1','Account Header Added Unsuccessfully!');
			redirect('headers');
		}
	}

	public function delete()
	{
		$del=$this->input->post('id');
		$data=$this->db->where('id',$del)->delete('headers');
		if($data)
		{
			$this->session->set_flashdata('msg','Account Header  Deleted Successfully!');
			redirect('headers');
		}
		else
		{
			$this->session->set_flashdata('msg1','Account Header  Deleted Unsuccessfully');
			redirect('headers');
		}
	}
}

ob_flush();
?>