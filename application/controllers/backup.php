<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Backup extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		  $this->load->model('backup_model');
		 if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			date_default_timezone_set('Asia/Kolkata');
			redirect('login');
		}
	}
	public function index()
	{
		$this->load->view('header');
		$this->load->view('add_backup');
		$this->load->view('footer1');
	}

	Public function create()
	{
		 $type=$this->uri->segment(3);		
		$data['']=$this->backup_model->create_backup($type);
			
			
		
	}

}

ob_flush();
?>