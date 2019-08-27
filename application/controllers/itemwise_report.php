<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
	class Itemwise_report extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dailystock_model');
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
		$this->load->view('itemwiseReport');
		$this->load->view('footer1');
	}

	public function autocomplete_itemname()
	{
		$itemname=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('itemname',$itemname);
		// $this->db->where('status',1);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) 
		{
			$json_array         = array();
			$json_array['value']= $d->itemname;
			$json_array['label']= $d->itemname;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function autocomplete_itemcode()
	{
		$itemcode=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('hsnno',$itemcode);
		$this->db->where('status',1);
		$query = $this->db->get();
		$result = $query->result();
		$name   =  array();
		foreach ($result as $d) 
		{
			$json_array         = array();
			$json_array['value']= $d->hsnno;
			$json_array['label']= $d->hsnno;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}
	public function printReport()
	{
		//$data['purchase']=	$this->dailystock_model->search_billing();
		$data['fromdate']=	($this->input->post('fromdate')!="")?$this->input->post('fromdate'):'';
		$data['todate']	 =	($this->input->post('todate')!="")?$this->input->post('todate'):'';
		$data['itemname']=	($this->input->post('itemname')!="")?$this->input->post('itemname'):'';
		$data['itemno']	 =	($this->input->post('itemno')!="")?$this->input->post('itemno'):'';
		$this->load->view('itemwiserpt_print',$data);
	}

	
}
ob_flush();
?>