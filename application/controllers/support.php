<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	ob_start();
	class Support extends CI_Controller {
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
			$this->load->view('header');
			$this->load->view('support_view',$data);
			// $this->load->view('footer');
		}

		
	}
	ob_flush();
?>