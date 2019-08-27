<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Dashboard extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('login_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{
		$first_day_this_month = date('Y-m-01');//date('m-01-Y'); // hard-coded '01' for first day
		$last_day_this_month  = date('Y-m-t');//date('m-t-Y');
		$data['first_day']=$first_day_this_month;
		$data['last_day']=$last_day_this_month;
		$data['cus']=$this->db->where('type','customer')->get('customer_details')->result_array();
		$data['sup']=$this->db->where('type','supplier')->get('customer_details')->result_array();
		//SALES
		$totalSales = $this->db->select_sum('grandtotal')->get('invoice_details')->row()->grandtotal;
		$totalReturn = $this->db->select_sum('grandtotal')->where('types','Debit')->get('sales_return')->row()->grandtotal;
		$totalReceived = $this->db->select_sum('overallamount')->where('vouchertype','payment')->get('voucher')->row()->overallamount;
		$data['sales'] = $totalSales-$totalReturn;
		$data['receivable'] = $totalReceived;
		$data['salesBalance']=$data['sales']-$totalReceived;
		$curMonthSales = $this->db->select_sum('grandtotal')->where('invoicedate >= ',$first_day_this_month)->where('invoicedate <= ',$last_day_this_month)->get('invoice_details')->row()->grandtotal;
		$curMonthReturn = $this->db->select_sum('grandtotal')->where('types','Debit')->where('returndate >= ',$first_day_this_month)->where('returndate <= ',$last_day_this_month)->get('sales_return')->row()->grandtotal;
		$data['curMonthSales']=$curMonthSales-$curMonthReturn;
		//PURCHASE
		$totalPurchase = $this->db->select_sum('grandtotal')->get('purchase_details')->row()->grandtotal;
		$totalPReturn = $this->db->select_sum('grandtotal')->get('sales_return')->row()->grandtotal;
		$totalPaid = $this->db->select_sum('overallamount')->where('vouchertype','receipt')->get('voucher')->row()->overallamount;
		$data['purchase'] = $totalPurchase-$totalPReturn;
		$data['payable'] = $totalPaid;
		$data['purchaseBalance']=$data['purchase']-$totalPaid;
		$curMonthPurchase = $this->db->select_sum('grandtotal')->where('invoicedate >= ',$first_day_this_month)->where('invoicedate <= ',$last_day_this_month)->get('purchase_details')->row()->grandtotal;
		$curMonthPReturn = $this->db->select_sum('grandtotal')->where('types','Credit')->where('returndate >= ',$first_day_this_month)->where('returndate <= ',$last_day_this_month)->get('sales_return')->row()->grandtotal;
		$data['curMonthpurchase'] = $curMonthPurchase-$curMonthPReturn;
		
		//echo $totalReceived;
		//exit;
		$data['totalExpenses'] = $this->db->select_sum('overallamount')->get('expenses')->row()->overallamount;
		$data['currExpenses'] = $this->db->select_sum('overallamount')->where('expensesdate >= ',$first_day_this_month)->where('expensesdate <= ',$last_day_this_month)->get('expenses')->row()->overallamount;
		
		$data['invoice']=$this->db->get('invoice_details')->result_array();
		//$data['purchase']=$this->db->get('purchase_details')->result_array();
		$this->load->view('header');
		$this->load->view('content',$data);
		$this->load->view('footer');
	}
}
ob_flush();
?>