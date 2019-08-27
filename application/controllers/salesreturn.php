<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Salesreturn extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// $this->load->model('salesreturn_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		$this->load->model('salesreturn_model');
		date_default_timezone_set('Asia/Kolkata');
	}
	 
	 public function index()
	 {
		$this->db->limit(1);
		$this->db->order_by('id desc');
		$num=$this->db->get('sales_return')->result_array();
		@$invoiceno=$num[0]['returnno'];
		$count=count($invoiceno);
		if($count==0)
		{
			$gg="IR00001";
			$item_no= $gg;
		}
		else
		{
			$old_item_no = str_split($invoiceno,2);
			@$va = (string)($old_item_no[1].$old_item_no[2].$old_item_no[3].$old_item_no[4].$old_item_no[5])+1; 
			@$item_length = strlen($va);
			if(@$item_length == 1)
			{
				$item_no = "IR0000".$va;  
			}
			else if(@$item_length == 2)
			{
				$item_no = "IR000".$va;      
			}
			else if(@$item_length == 3)
			{   
				$item_no = "IR00".$va;   
			}
			else if(@$item_length == 4)
			{    
				$item_no = "IR0".$va; 
			}
		}
		$data['returnno']=$item_no;
		$this->load->view('header');
		$this->load->view('add_salesreturn',$data);
		$this->load->view('footer1');
	}

	public function add_return()
	{
		if(@$_POST['types']=='Debit')
		{
			$customerid = $_POST['customerid'];
			$count1=count($_POST['itemname']);
			$qtyss=$_POST['qty'];
			for($i = 0; $i< $count1; $i++)
			{
				if($qtyss[$i]=='0')
				{
					$res[]="1";
				}
				else
				{
					$res[]="0";
				}
			}

			$ress=implode('||',$res);
			$rrs=array_sum($res);
			if($rrs==0)
			{
				$this->db->where('invoiceno',$_POST['invoiceno']);
				$this->db->update('invoice_details',array('return_status'=>$ress,'edit_status'=>'0'));
			}
			else
			{
				$this->db->where('invoiceno',$_POST['invoiceno']);
				$this->db->update('invoice_details',array('return_status'=>$ress,'edit_status'=>'0'));
			}
			$data1=$this->db->where('id',$customerid)->get('customer_details')->result_array();
			$totalamount = $_POST['grandtotal'];
			foreach ($data1 as $a) 
			{
				$openingbalance=$a['openingbal'];
				$balance=$a['balanceamount']; 
				$returnamounts=$a['returnamount'];
				$salesamount=$a['salesamount'];
			}
			if($balance)
			{
				$balanceamount=$balance - $totalamount;
			}
			else
			{
				$balanceamount=$openingbalance - $totalamount;
			}
			if($returnamounts=='')
			{
				$returnamount=$totalamount;
			}
			else
			{
				$returnamount=$returnamounts+$totalamount;
			} 
			if($salesamount=='')
			{
				$salesamount=$totalamount;
			}
			else
			{
				$salesamount=$salesamount-$totalamount;
			} 
			$datass=array('salesamount'=>$salesamount,'balanceamount'=>$balanceamount,'returnamount'=>$returnamount);
			$it=$_POST['itemname'];
			$bn=$_POST['hsnno'];
			$q=$_POST['qty'];
			$count1=count($it);
			for ($i=0; $i < $count1; $i++) { 
				$this->db->where('itemname',$it[$i]);
				$this->db->where('hsnno',$bn[$i]);
				$wq=$this->db->get('stock')->result();
				foreach($wq as $w)
				$old=$w->balance;
				$bal=$old+$q[$i];
				$this->db->where('itemname',$it[$i]);
				$this->db->where('hsnno',$bn[$i]);
				$this->db->update('stock',array('balance'=>$bal));
			}

			$data=array(
			'date'=>date('Y-m-d'),
			'returnno' =>$_POST['returnno'],
			'returndate' =>date('Y-m-d',strtotime($_POST['returndate'])),
			'returnno' =>$_POST['returnno'],
			'time' =>$_POST['time'],
			'supplierid' =>'-', 
			'suppliername' =>'-',
			'purchaseno' =>'-',  
			'customername' =>$_POST['customername'],
			'invoiceno' =>$_POST['invoiceno'], 
			'description' =>$_POST['description'], 
			'customerid' =>$_POST['customerid'], 
			'dateofissue' =>date('Y-m-d',strtotime($_POST['dateofissue'])),
			'gsttype' =>$_POST['gsttype'], 
			'openingbal' =>$_POST['openingbal'], 
			'hsnno' =>implode('||',$_POST['hsnno']), 
			'itemname' =>implode('||',$_POST['itemname']), 
			'qty' =>implode('||',$_POST['qty']), 
			'uom' =>implode('||',$_POST['uom']), 
			'rate' =>implode('||',$_POST['rate']), 
			'amount' =>implode('||',$_POST['amount']), 
			'discount' =>implode('||',$_POST['discount']), 
			'taxableamount' =>implode('||',$_POST['taxableamount']), 
			'discountamount' =>implode('||',$_POST['discountamount']), 
			'cgst' =>implode('||',$_POST['cgst']), 
			'cgstamount' =>implode('||',$_POST['cgstamount']), 
			'sgst' =>implode('||',$_POST['sgst']), 
			'sgstamount' =>implode('||',$_POST['sgstamount']), 
			'igst' =>implode('||',$_POST['igst']), 
			'igstamount' =>implode('||',$_POST['igstamount']), 
			'total' =>implode('||',$_POST['total']), 
			'subtotal' =>$_POST['subtotal'], 
			'freightamount' =>$_POST['freightamount'], 
			'freightcgst' =>$_POST['freightcgst'], 
			'freightcgstamount' =>$_POST['freightcgstamount'], 
			'freightsgst' =>$_POST['freightsgst'], 
			'freightsgstamount' =>$_POST['freightsgstamount'], 
			'freightigst' =>$_POST['freightigst'], 
			'freightigstamount' =>$_POST['freightigstamount'], 
			'freighttotal' =>$_POST['freighttotal'], 
			'loadingamount' =>$_POST['loadingamount'], 
			'loadingcgst' =>$_POST['loadingcgst'], 
			'loadingcgstamount' =>$_POST['loadingcgstamount'], 
			'loadingsgst' =>$_POST['loadingsgst'], 
			'loadingsgstamount' =>$_POST['loadingsgstamount'], 
			'loadingigst' =>$_POST['loadingigst'], 
			'loadingigstamount' =>$_POST['loadingigstamount'], 
			'loadingtotal' =>$_POST['loadingtotal'], 
			'othercharges' =>$_POST['othercharges'], 
			'grandtotal' =>$_POST['grandtotal'], 
			'types' =>$_POST['types'], 
			'status'=>1);

			$da = array(
			'date'=>date('Y-m-d',strtotime($_POST['returndate'])),
			'receiptdate'=>date('Y-m-d',strtotime($_POST['returndate'])),
			'invoiceno'=>$_POST['invoiceno'],
			'receiptno'=>$_POST['returnno'],
			'customerId' => $customerid,
			'customername'=>$_POST['customername'],
			'returnamount'=>$_POST['grandtotal'],
			'balance'=>$balanceamount,
			'paymentdetails'=>$_POST['description'],
			'status'=>1
			);

			$res=$this->db->insert('sales_return',$data);
			$this->db->query("UPDATE preference_settings SET debit='' WHERE id=1");
			if($_POST['save']=='save')
			{
				if($res==true)
				{
					$this->db->where('id',$customerid)->update('customer_details',$datass);
					$this->db->insert('invoice_party_statement',$da);
					$this->session->set_flashdata('msg','Sales return added successfully');
					redirect('salesreturn');
				}
				else
				{
					$this->session->set_flashdata('msg1','Sales return added unsuccessfully');
					redirect('salesreturn');
				}
			}

			if($_POST['print']=='print')
			{
				if($res==true)
				{
					$this->db->where('id',$customerid)->update('customer_details',$datass);
					$this->db->insert('invoice_party_statement',$da);
					$this->session->set_flashdata('msg','Sales return added successfully');
					redirect('salesreturn/bill');
				}
				else
				{
					$this->session->set_flashdata('msg1','Sales return added unsuccessfully');
					redirect('salesreturn');
				}
			}
		}
		else if(@$_POST['types']=='Credit')
		{
			$supplierid = $_POST['supplierid'];
			$data=array(
			'date'=>date('Y-m-d'),
			'returnno' =>$_POST['returnno'],
			'returndate' =>date('Y-m-d',strtotime($_POST['returndate'])),
			'returnno' =>$_POST['returnno'],
			'time' =>$_POST['time'], 
			'suppliername' =>$_POST['suppliername'],
			'purchaseno' =>$_POST['purchaseno'], 
			'description' =>$_POST['description'], 
			'supplierid' =>$supplierid, 
			'customerid' =>'-', 
			'customername' =>'-',
			'invoiceno' =>'-', 
			'dateofissue' =>date('Y-m-d',strtotime($_POST['dateofissue'])),
			'gsttype' =>$_POST['gsttype'], 
			'openingbal' =>$_POST['openingbal'], 
			'hsnno' =>implode('||',$_POST['hsnno']), 
			'itemname' =>implode('||',$_POST['itemname']), 
			'qty' =>implode('||',$_POST['qty']), 
			'uom' =>implode('||',$_POST['uom']), 
			'rate' =>implode('||',$_POST['rate']), 
			'amount' =>implode('||',$_POST['amount']), 
			'discount' =>implode('||',$_POST['discount']), 
			'taxableamount' =>implode('||',$_POST['taxableamount']), 
			'discountamount' =>implode('||',$_POST['discountamount']), 
			'cgst' =>implode('||',$_POST['cgst']), 
			'cgstamount' =>implode('||',$_POST['cgstamount']), 
			'sgst' =>implode('||',$_POST['sgst']), 
			'sgstamount' =>implode('||',$_POST['sgstamount']), 
			'igst' =>implode('||',$_POST['igst']), 
			'igstamount' =>implode('||',$_POST['igstamount']), 
			'total' =>implode('||',$_POST['total']), 
			'subtotal' =>$_POST['subtotal'], 
			'freightamount' =>$_POST['freightamount'], 
			'freightcgst' =>$_POST['freightcgst'], 
			'freightcgstamount' =>$_POST['freightcgstamount'], 
			'freightsgst' =>$_POST['freightsgst'], 
			'freightsgstamount' =>$_POST['freightsgstamount'], 
			'freightigst' =>$_POST['freightigst'], 
			'freightigstamount' =>$_POST['freightigstamount'], 
			'freighttotal' =>$_POST['freighttotal'], 
			'loadingamount' =>$_POST['loadingamount'], 
			'loadingcgst' =>$_POST['loadingcgst'], 
			'loadingcgstamount' =>$_POST['loadingcgstamount'], 
			'loadingsgst' =>$_POST['loadingsgst'], 
			'loadingsgstamount' =>$_POST['loadingsgstamount'], 
			'loadingigst' =>$_POST['loadingigst'], 
			'loadingigstamount' =>$_POST['loadingigstamount'], 
			'loadingtotal' =>$_POST['loadingtotal'], 
			'othercharges' =>$_POST['othercharges'], 
			'grandtotal' =>$_POST['grandtotal'], 
			'types' =>$_POST['types'], 
			'status'=>1);

			$it=$_POST['itemname'];
			$bn=$_POST['hsnno'];
			$q=$_POST['qty'];

			$count1=count($it);
			for ($i=0; $i < $count1; $i++) { 
				$this->db->where('itemname',$it[$i]);
				$this->db->where('hsnno',$bn[$i]);
				$wq=$this->db->get('stock')->result();
				foreach($wq as $w)
				$old=$w->balance;
				$bal=$old-$q[$i];
				$this->db->where('itemname',$it[$i]);
				$this->db->where('hsnno',$bn[$i]);
				$this->db->update('stock',array('balance'=>$bal));
			}

			$count1=count($_POST['itemname']);
			$qtyss=$_POST['qty'];
			for($i = 0; $i< $count1; $i++)
			{
				if($qtyss[$i]=='0')
				{
					$res[]="1";
				}
				else
				{
					$res[]="0";
				}
			}

			$ress=implode('||',$res);
			$rrs=array_sum($res);
			if($rrs==0)
			{
				$this->db->where('purchaseno',$_POST['purchaseno']);
				$this->db->update('purchase_details',array('return_status'=>$ress,'edit_status'=>'0'));
			}
			else
			{
				$this->db->where('purchaseno',$_POST['purchaseno']);
				$this->db->update('purchase_details',array('return_status'=>$ress,'edit_status'=>'0'));
			}
			$data1=$this->db->where('id',$supplierid)->get('customer_details')->result_array();
			$totalamount = $_POST['grandtotal'];
			foreach ($data1 as $a) 
			{
				$openingbalance=$a['openingbal'];
				$balance=$a['balanceamount']; 
				$returnamounts=$a['returnamount'];
				$salesamount = $a['salesamount'];
			}
			if($balance)
			{
				$balanceamount=$balance - $totalamount;
			}
			else
			{
				$balanceamount=$openingbalance - $totalamount;
			}
			if($returnamounts=='')
			{
				$returnamount=$totalamount;
			}
			else
			{
				$returnamount=$returnamounts+$totalamount;
			} 
			if($salesamount=='')
			{
				$salesamount=$salesamount;
			}
			else
			{
				$salesamount=$salesamount- $totalamount;
			} 

			$datass=array('salesamount' => $salesamount, 'balanceamount'=>$balanceamount,'returnamount'=>$returnamount);
			$da = array(
			'date'=>date('Y-m-d',strtotime($_POST['returndate'])),
			'purchasedate'=>date('Y-m-d',strtotime($_POST['returndate'])),
			'purchaseno'=>$_POST['purchaseno'],
			'receiptno'=>$_POST['returnno'],
			'suppliername'=>$_POST['suppliername'],
			'returnamount'=>$_POST['grandtotal'],
			'balance'=>$balanceamount,
			'paymentdetails'=>$_POST['description'],
			'status'=>1
			);

			$res=$this->db->insert('sales_return',$data);
			$this->db->query("UPDATE preference_settings SET credit='' WHERE id=1");
			if($_POST['save']=='save')
			{
				if($res==true)
				{
					$this->db->where('id',$supplierid)->update('customer_details',$datass);
					$this->db->insert('po_party_statements',$da);
					$this->session->set_flashdata('msg','Purchase return added successfully');
					redirect('salesreturn');
				}
				else
				{
					$this->session->set_flashdata('msg1','Purchase return added unsuccessfully');
					redirect('salesreturn');
				}
			}
			if($_POST['print']=='print')
			{
				if($res==true)
				{
					$this->db->where('id',$supplierid)->update('customer_details',$datass);
					$this->db->insert('po_party_statements',$da);
					$this->session->set_flashdata('msg','Purchase return added successfully');
					redirect('salesreturn/bill');
				}
				else
				{
					$this->session->set_flashdata('msg1','Purchase return added unsuccessfully');
					redirect('salesreturn');
				}
			}
		}
		else
		{
			$this->session->set_flashdata('msg','Sales return added Unsuccessfully');
			redirect('salesreturn');
		}

	}
	
	//EDIT PURCHASE OR SALES RETURN
	public function update_return()
	{
		//print_r($_REQUEST);
		//exit;
		/*
		Array ( [/salesreturn/update_return] => [id] => 1 [returnno] => C00001 [returndate] => 01-09-2017 [time] => 11:48:10 AM [customername] => 9000 [supplierId] => 5 [customerid] => [invoiceno] => P00001 [description] => test description [hsnno] => Array ( [0] => 00001 [1] => 0002 ) [hiddenIgst] => 18 [itemname] => Array ( [0] => Let us See [1] => Let us C++ ) [priceType] => Array ( [0] => Exclusive [1] => Inclusive ) [qty] => Array ( [0] => 2 [1] => 2 ) [oldqtys] => Array ( [0] => 2 [1] => 2 ) [uom] => Array ( [0] => Nos [1] => Nos ) [rate] => Array ( [0] => 150 [1] => 200 ) [amount] => Array ( [0] => 300.00 [1] => 338.98 ) [discount] => Array ( [0] => 0 [1] => 0 ) [taxableamount] => Array ( [0] => 300.00 [1] => 400.00 ) [discountamount] => Array ( [0] => 0 [1] => 0 ) [cgst] => Array ( [0] => 9 [1] => 9 ) [cgstamount] => Array ( [0] => 27.00 [1] => 30.51 ) [sgst] => Array ( [0] => 9 [1] => 9 ) [sgstamount] => Array ( [0] => 27.00 [1] => 30.51 ) [igst] => Array ( [0] => 0 [1] => 0 ) [igstamount] => Array ( [0] => [1] => ) [total] => Array ( [0] => 354.00 [1] => 400.00 ) [freightamount] => 100 [freightcgst] => 10 [freightcgstamount] => 10.00 [freightsgst] => 10 [freightsgstamount] => 10.00 [freightigst] => [freightigstamount] => [freighttotal] => 120.00 [loadingamount] => 100 [loadingcgst] => 5 [loadingcgstamount] => 5.00 [loadingsgst] => 5 [loadingsgstamount] => 5.00 [loadingigst] => [loadingigstamount] => [loadingtotal] => 110.00 [subtotal] => 984.00 [othercharges] => 0 [grandtotal] => 984.00 [oldGrandTotal] => 984.00 [gsttypes] => intrastate [save] => save )
		*/
		if(@$_POST['types']=='Credit')
		{
			$id=$_POST['id'];
			$data=array(
			'hsnno' =>implode('||',$_POST['hsnno']), 
			'itemname' =>implode('||',$_POST['itemname']), 
			'qty' =>implode('||',$_POST['qty']), 
			'uom' =>implode('||',$_POST['uom']), 
			'rate' =>implode('||',$_POST['rate']), 
			'amount' =>implode('||',$_POST['amount']), 
			'discount' =>implode('||',$_POST['discount']), 
			'taxableamount' =>implode('||',$_POST['taxableamount']), 
			'discountamount' =>implode('||',$_POST['discountamount']), 
			'cgst' =>implode('||',$_POST['cgst']), 
			'cgstamount' =>implode('||',$_POST['cgstamount']), 
			'sgst' =>implode('||',$_POST['sgst']), 
			'sgstamount' =>implode('||',$_POST['sgstamount']), 
			'igst' =>implode('||',$_POST['igst']), 
			'igstamount' =>implode('||',$_POST['igstamount']), 
			'total' =>implode('||',$_POST['total']), 
			'subtotal' =>$_POST['subtotal'], 
			'grandtotal' =>$_POST['grandtotal'], 
			'types' =>$_POST['types'], 
			'status'=>1);

			$this->db->where('id',$id)->update('sales_return',$data);
			
			
			//UPDATE po_party_statements TABLE
			$this->db->where('receiptno',$_POST['returnno'])->delete('po_party_statements');
			//1) Get OLD Amount
			$getbalance_qry = $this->db->query("SELECT balance FROM po_party_statements WHERE suppliername='".$_POST['suppliername']."' ORDER BY id DESC ");
			$numRows = $getbalance_qry->num_rows();
			$balanceRes = $getbalance_qry->row();
			$balanceAmt = $balanceRes->balance;
			$newBalance = $balanceAmt-$_POST['grandtotal'];
			
			$po_party=array(
				'date'			=> date('Y-m-d'),
				'purchasedate'	=> date('Y-m-d',strtotime($_POST['returndate'])),
				'receiptno'		=> $_POST['returnno'],
				'purchaseno'	=> $_POST['invoiceno'],
				'supplierId'	=> $_POST['supplierId'],
				'suppliername'=>$_POST['customername'],
				'itemname' 		=> $itemname,
				'qty'			=> $qty,
				'total'			=> $_POST['grandtotal'],	
				'balance'		=> $newBalance,
				'amount' 		=> $amount,
				'return_amount'	=> $_POST['grandtotal'],
				'mobileno'		=> '',
				'invoiceno'		=>	$id,
				'purchasenodate'=> $_POST['purchasenodate'],
				'purchasenoyear'=> $_POST['purchasenoyear'],
				'status'=>1,
				'paymentdetails' => 'Purchase Return'
				);
				$this->db->insert('po_party_statements',$po_party);
			
			//UPDATE STOCK
			
			$it=$_POST['itemname'];
			$bn=$_POST['hsnno'];
			$q=$_POST['qty'];
			$oldReturn = $_POST['oldqtys'];
			$count1=count($it);
			for ($i=0; $i < $count1; $i++) { 
				$this->db->where('itemname',$it[$i]);
				$this->db->where('hsnno',$bn[$i]);
				$wq=$this->db->get('stock')->result();
				foreach($wq as $w)
				$old=$w->balance;
				$stockBalance = $w->balance;
				
				$oldRet = $oldReturn[$i];
				$curRet = $q[$i];
				if($oldRet < $curRet)
				{
					$updatableStock = $curRet-$oldRet;
					$bal = $stockBalance-$updatableStock;
				}
				elseif($oldRet > $curRet)
				{
					$updatableStock = $oldRet-$curRet;
					$bal = $stockBalance+$updatableStock;
				}
				else
				{
					$bal = $stockBalance;
				}
				
				$this->db->where('itemname',$it[$i]);
				$this->db->where('hsnno',$bn[$i]);
				$this->db->update('stock',array('balance'=>$bal));
			}

			$count1=count($_POST['itemname']);
			$qtyss=$_POST['qty'];
			for($i = 0; $i< $count1; $i++)
			{
				if($qtyss[$i]=='0')
				{
					$res[]="1";
				}
				else
				{
					$res[]="0";
				}
			}

			$ress=implode('||',$res);
			$this->db->where('purchaseno',$_POST['invoiceno']);
			$this->db->update('purchase_details',array('return_status'=>$ress,'edit_status'=>'0'));
			
			$data1=$this->db->where('id',$supplierid)->get('customer_details')->result_array();
			$totalamount = $_POST['grandtotal'];
			foreach ($data1 as $a) 
			{
				$openingbalance=$a['openingbal'];
				$balance=$a['balanceamount']; 
				$returnamounts=$a['returnamount'];
			}
			if($balance)
			{
				$balanceamount=$balance - $totalamount;
			}
			else
			{
				$balanceamount=$openingbalance - $totalamount;
			}
			if($returnamounts=='')
			{
				$returnamount=$totalamount;
			}
			else
			{
				$returnamount=$returnamounts+$totalamount;
			} 

			$datass=array('balanceamount'=>$balanceamount,'returnamount'=>$returnamount);
			$this->db->where('id',$supplierid)->update('customer_details',$datass);
			$this->session->set_flashdata('msg','Purchase return added successfully');
			redirect('salesreturn');
			
		}
	
	}
	//DEBIT OR CREDIT NOTE EDIT SECTION.
	public function views()
	{
		$id=$this->uri->segment(3);
		$data['result']=$this->db->where('id',$id)->get('sales_return')->result_array(); 
		$this->load->view('header');
		$this->load->view('view_salesreturn',$data);
		$this->load->view('footer');
	}
	//DEBIT OR CREDIT NOTE REPORTS
	Public function view()
	{
		$data['view']=$this->salesreturn_model->select();
		$this->load->view('header');
		$this->load->view('salesreturn_reports',$data);
		$this->load->view('footer1');
	}

	public function ajax_list()
	{
		$list = $this->salesreturn_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$a=1;
		$totalamount[]=array();
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $a++;
			$row[] = date('d-m-Y',strtotime($person->date));
			//$row[] = $person->types;
			if($person->types=='Credit')
			{
				$row[] = 'Debit';
			}
			else
			{
				$row[] ='Credit';
			}
			if($person->types=='Credit')
			{
				$row[] = $person->purchaseno;
			}
			else
			{
				$row[] =$person->invoiceno;
			}
			
			$row[] =$person->returnno;
			if($person->types=='Credit')
			{
				$row[] = $person->suppliername;
			}
			else
			{
				$row[] =$person->customername;
			}
			$row[] =$person->grandtotal;
			$row[] = '<div class="btn-group">
						<button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Manage <span class="caret"></span></button>
						<ul class="dropdown-menu" role="menu" style="background: #23BDCF none repeat scroll 0% 0%;width:14px;min-width: 100%;">
							<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('salesreturn/views/'.$person->id).'" title="View" >View</a></li>
							<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('salesreturn/bill_download/'.$person->id).'">Print</a></li>
							<li><a class="" onclick="return confirm(\'Are you sure want to delete?\')" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('salesreturn/deleteFun/'.$person->id).'" title="Delete" >Delete</a></li>
						</ul>
					</div>';
	  
			/*
			$row[] = '<a class="btn btn-sm btn-primary" href="'.base_url('salesreturn/views/'.$person->id).'" title="View" onclick="edit_person('."'".$person->id."'".')"><i class="glyphicon glyphicon-pencil"></i> </a>&nbsp;<a class="btn btn-sm btn-primary" href="'.base_url('salesreturn/bill_download/'.$person->id).'" title="View" target="_blank" ><i class="glyphicon glyphicon-download"></i>&nbsp;Print </a>';*/
			$data[] = $row;
		}

		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->salesreturn_model->count_all(),
		"recordsFiltered" => $this->salesreturn_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}


	Public function getinvoiceno()
	{
		$cusname=$this->input->post('cusname');
		$data=$this->db->where('status',1)->where('customername',$cusname)->get('invoice_details')->result_array(); 
		$count=count($data);
		if($count>0)
		{
			foreach ($data as $c)
			{
				$returnsta=$c['return_status'];
				if($returnsta=='')
				{
					$resu=1;
				}
				else
				{
					$return_count=explode('||',$returnsta);
					$resu=array_sum($return_count);
				}
				
				if($resu==0)
				{

				}
				else
				{
					$f['value']=$c['invoiceno'];
					$f['label']=$c['invoiceno']; 
					$v[]=$f; 
				}					
			}
			echo json_encode($v);
		}
		/*if($count>0)
		{
			foreach ($data as $r)
			{
				$returnsta=$r['return_status'];
			}
			$return_count=explode('||',$returnsta);
			$resu=array_sum($return_count);
			if($resu==0)
			{

			}
			else
			{
				foreach ($data as $c)
				{
					$f['value']=$c['invoiceno'];
					$f['label']=$c['invoiceno']; 
					$v[]=$f;        
				}
			}
			echo json_encode($v);
		}   */
	}

	Public function getpurchaseno()
	{
		$cusname=$this->input->post('suppliername');
		$data=$this->db->where('status',1)->where('suppliername',$cusname)->get('purchase_details')->result_array(); 
		$count=count($data);
		$v=array();
		if($count>0)
		{
			foreach ($data as $c)
			{
				$returnsta=$c['return_status'];
				if($returnsta=='')
				{
					$resu=1;
				}
				else
				{
					$return_count=explode('||',$returnsta);
					$resu=array_sum($return_count);
				}
				
				if($resu==0)
				{

				}
				else
				{
					$f['value']=$c['purchaseno'];
					$f['label']=$c['purchaseno']; 
					$v[]=$f; 
				}					
			}
			echo json_encode($v);
		}
		/*if($count>0)
		{
			foreach ($data as $r)
			{
				$returnsta=$r['return_status'];
			}
			$return_count=explode('||',$returnsta);
			$resu=array_sum($return_count);
			if($resu==0)
			{

			}
			else
			{
				foreach ($data as $c)
				{
					$f['value']=$c['purchaseno'];
					$f['label']=$c['purchaseno']; 
					$v[]=$f;        
				}
			} 
			echo json_encode($v);
		}   */
	}

	public function getdetails()
	{
		$invoiceno=$this->input->post('invoiceno');
		$this->db->select('*');
		$this->db->from('invoice_details');
		$this->db->where('status',1);
		$this->db->where('invoiceno',$invoiceno);
		// $this->db->where('return_status',1);
		$query = $this->db->get();
		$data= $query->result_array();
		foreach ($data as $ue) 
		{
		$html=' <div class="table-responsive">
		<table class="responsive table">
		<thead> 
		<tr>
		<th>HSN Code</th>
		<th>Item Name</th>
		<th>Qty</th>
		<th>UOM</th>
		<th>Rate</th>
		<th>Amount</th>
		<th>Disc %</th>
		<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
		<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
		<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
		<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
		<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
		<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
		<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
		<th>Total</th>
		</tr>  
		</thead>
		<tbody>';
		$hsnno=explode('||', $ue['hsnno']);
		$itemname=explode('||', $ue['itemname']);
		$rate=explode('||', $ue['rate']);
		$qty=explode('||', $ue['qty']);
		$amount=explode('||', $ue['amount']);
		$discount=explode('||', $ue['discount']); 
		$discountamount=explode('||', $ue['discountamount']); 
		$taxableamount=explode('||', $ue['taxableamount']);   
		$sgst=explode('||', $ue['sgst']); 
		$cgst=explode('||', $ue['cgst']); 
		$igst=explode('||', $ue['igst']); 
		$sgstamount=explode('||', $ue['sgstamount']); 
		$cgstamount=explode('||', $ue['cgstamount']); 
		$igstamount=explode('||', $ue['igstamount']); 
		$uom=explode('||', $ue['uom']); 
		$total=explode('||', $ue['total']); 
		$returnstatus=explode('||', $ue['return_status']); 
		/* START */
		$freightamount=$ue['freightamount'];
		$freightcgst=$ue['freightcgst'];
		$freightcgstamount=$ue['freightcgstamount'];
		$freightsgst=$ue['freightsgst'];
		$freightsgstamount=$ue['freightsgstamount'];
		$freightigst=$ue['freightigst']; 
		$freightigstamount=$ue['freightigstamount']; 
		$freighttotal=$ue['freighttotal'];   
		$loadingamount=$ue['loadingamount']; 
		$loadingcgst=$ue['loadingcgst']; 
		$loadingcgstamount=$ue['loadingcgstamount']; 
		$loadingsgst=$ue['loadingsgst']; 
		$loadingsgstamount=$ue['loadingsgstamount'];   
		$loadingigst=$ue['loadingigst']; 
		$loadingigstamount=$ue['loadingigstamount']; 
		$loadingtotal=$ue['loadingtotal']; 
		/* END */
		$count=count($itemname);
		for($i=0; $i< $count; $i++){
			if($returnstatus[$i]==0)
			{
				$hide="style='display:none'";
			}
			else
			{
				$hide='';
			}
			$checkItemType = $this->db->select('itemType')->where('id',1)->get('preference_settings')->row()->itemType;
			if($checkItemType=='with_item') 
			{ 
				$this->db->select('*');
				$this->db->from('additem');
				$this->db->where('itemname',$itemname[$i]);
				$item_query = $this->db->get();
				$item_result = $item_query->row();
				$priceTypeTag='<input type="hidden" id="priceType'.$i.'" name="priceType[]" value="'.$item_result->priceType.'" />';
				$igstTag = '<input type="hidden" id="hiddenIgst'.$i.'" value="'.$item_result->igst.'" />';
			}
			else
			{
				$priceTypeTag='<input type="hidden" id="priceType'.$i.'" name="priceType[]" value="" />';
				$igstTag = '<input type="hidden" id="hiddenIgst'.$i.'" value="" />';
			}
			
		//if($ue['gsttype']=='intrastate') { $cgst } else { }
		$html.='<tr '.$hide.'>
		<td>'.$igstTag.'<input class="" id="hsnno'.$i.'"  readonly style="border:1px solid #605f5f;" type="text" name="hsnno[]" value="'.$hsnno[$i].'" ><div id="hsnno_valid"></div></td>
		<td><input class="" id="itemname'.$i.'" style="border:1px solid #605f5f;" type="text" name="itemname[]" readonly value="'.$itemname[$i].'" >
		<div id="itemname_valid"></div>
		'.$priceTypeTag.'
		</td>
		<td><input class="" id="qty'.$i.'"   parsley-trigger="change"  type="text" name="qty[]" value="0"  onkeypress="return isNumberKey(event)" autocomplete="off" style="border:1px solid #605f5f;"><input type="hidden" id="qtys'.$i.'" value="'.$qty[$i].'"><div id="qty_valid" style="color:green">Purchase Qty : '.$qty[$i].'</div></td>  

		<td><input class="" id="uom'.$i.'"  readonly  style="border:1px solid #605f5f;" type="text" name="uom[]" value="'.$uom[$i].'"  autocomplete="off"><div id="rate_valid"></div></td>

		<td><input class=" decimals"  readonly id="rate'.$i.'"  style="border:1px solid #605f5f;" value="'.$rate[$i].'" type="text" name="rate[]"   autocomplete="off"><div id="rate_valid"></div></td>

		<td><input class="decimals" id="amount'.$i.'"  readonly style="border:1px solid #605f5f;" type="text" name="amount[]" value="'.$amount[$i].'"  autocomplete="off"><div id="rate_valid"></div></td>

		<td><input class="decimals" id="discount'.$i.'"  style="border:1px solid #605f5f;" type="text" name="discount[]" readonly value="'.$discount[$i].'" onkeypress="return isNumber(event)" autocomplete="off"><div id="rate_valid"></div></td>

		<td><input class="decimals" id="taxableamount'.$i.'" readonly style="border:1px solid #605f5f;" type="text" name="taxableamount[]" value="'.$taxableamount[$i].'"  autocomplete="off"><input type="hidden" value="'.$discountamount[$i].'" name="discountamount[]" id="discountamount'.$i.'"><div id="rate_valid"></div></td>

		<td class="sgst"><input class="decimals" readonly id="cgst'.$i.'"  type="text" value="'.$cgst[$i].'" name="cgst[]" value="'.$cgst[$i].'" style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid"></div></td>

		<td class="sgst"><input class="decimals" readonly id="cgstamount'.$i.'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$cgstamount[$i].'"></td>

		<td class="sgst"><input class="decimals" id="sgst'.$i.'" readonly  type="text" value="'.$sgst[$i].'" name="sgst[]" style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid"></div></td>

		<td class="sgst"><input class="decimals" id="sgstamount'.$i.'"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$sgstamount[$i].'"></td>

		<td class="igst" style="display:none;"><input class="decimals" value="'.$igst[$i].'" id="igst'.$i.'"  type="text" name="igst[]" readonly  style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid"></div></td>

		<td class="igst" style="display:none;"><input class="decimals" id="igstamount'.$i.'"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$igstamount[$i].'"></td>

		<td><input class="" id="total'.$i.'" type="text" name="total[]" value="'.$total[$i].'"  readonly style="border:1px solid #605f5f;"></td>

		</tr>';
		}

		$html.='</tbody>
		</table>
		</div>
		<div class="clearfix">&nbsp;</div>
		<div class="row">
			<table class="table myform">
				<tr>
					<td>Freight Charges</td>
					
					<td><input class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="" type="text" name="freightamount" value="'.$freightamount.'"  autocomplete="off"></td>
					
					<td class="sgst"><input class="decimals"  id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="'.$freightcgst.'"   style=""   autocomplete="off" ></td>
					
					<td class="sgst"><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off" value="'.$freightcgstamount.'" readonly ></td>
					
					<td class="sgst"><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" value="'.$freightsgst.'" readonly    autocomplete="off" ><div id="sgst_valid"></div></td>
					
					<td class="sgst"><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" value="'.$freightsgstamount.'" readonly ></td>
					
					<td class="igst" style="display:none;"><input class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST"  style=""   autocomplete="off" value="'.$freightigst.'"  ><div id="igst_valid"></div></td>
					
					<td class="igst" style="display:none;"><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" value="'.$freightigstamount.'" readonly ></td>
					
					<td><input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="'.$freighttotal.'" readonly ></td>
				</tr>

				<tr>
					<td>Loading & Packing Charges</td>
					
					<td><input class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="" type="text" name="loadingamount" value="'.$loadingamount.'"  autocomplete="off"><div id="rate_valid"></div></td>
					
					<td class="sgst"><input class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="'.$loadingcgst.'"   autocomplete="off" ><div id="cgst_valid"></div></td>
					
					<td class="sgst"><input class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off" value="'.$loadingcgstamount.'" readonly></td>
					
					<td class="sgst"><input class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" value="'.$loadingsgst.'" readonly  style=""   autocomplete="off" ><div id="sgst_valid"></div></td>
					
					<td class="sgst"><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount" readonly  placeholder="SGST Amount" autocomplete="off" readonly value="'.$loadingsgstamount.'" readonly ></td>
					
					<td class="igst" style="display:none;"><input class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST"   style=""   autocomplete="off" value="'.$loadingigst.'"  ><div id="igst_valid"></div></td>
					
					<td class="igst" style="display:none;"><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" value="'.$loadingigstamount.'" readonly ></td>
						
					<td><input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="'.$loadingtotal.'" readonly ></td>
				</tr>
			</table>
		</div>
		<div class="col-md-12">

		<br>
		<br>

		<div class="col-sm-offset-5">
		<label class="col-sm-5  control-label" >Sub Total</label>
		<div class="col-sm-7">
		<input class="form-control"  type="text" name="subtotal" id="subtotal" readonly  placeholder="0" value="'.$ue['subtotal'].'">
		</div>
		</div>
		<br>
		<br>    

		<div class="col-sm-offset-5">
		<label class="col-sm-5  control-label" >Round Off</label>
		<div class="col-sm-7">
		<input class="form-control"  type="text" name="othercharges" id="othercharges" readonly  placeholder="0" value="'.$ue['othercharges'].'">
		</div>
		</div>
		<br>
		<br>  

		<div class=" col-sm-offset-5">
		<label class="col-sm-5  control-label" >Grand Total</label>
		<div class="col-sm-7">
		<input class="form-control" readonly type="text" value="'.$ue['grandtotal'].'" name="grandtotal" id="grandtotal" >

		<input class="form-control" readonly type="hidden" value="'.$ue['gsttype'].'" name="gsttypes" id="gsttypes" >


		</div>                      
		</div>
		<br>
		<br>
		</div> 
		</div></div>';

		}
		for($i=0;$i<$count;$i++)
		{
		$html.='
		<script>
			var gsttype=$("#gsttypes").val();
			if(gsttype=="interstate")
			{
				$(".sgst").hide();
				$(".igst").show();
			}
			else  if(gsttype=="intrastate")
			{
				$(".sgst").show();
				$(".igst").hide();
			}
			//START QUANTITY FUNCTION
			var qty=$("#qty'.$i.'").val();
			var rate=$("#rate'.$i.'").val();
			var qtys=$("#qtys'.$i.'").val();
			var gsttype=$("#gsttypes").val();
			if(parseFloat(qty) > parseFloat(qtys))
			{
				alert("Your Required Qty is : "+qtys+"");
				$("#qty'.$i.'").val("");
				$("#qty'.$i.'").focus("");
			}

			if(qty!="")
			{
				var amo=parseFloat(rate)*parseFloat(qty);
				var amou=amo.toFixed(2);
				var discount=$("#discount'.$i.'").val();
				var cgst=$("#cgst'.$i.'").val();
				var sgst=$("#sgst'.$i.'").val();
				var igst=$("#igst'.$i.'").val(); 
				var taxableamount=$("#taxableamount'.$i.'").val(); 
				var gsttype=$("#gsttype").val(); 
				var othercharges=$("#othercharges").val();
				var a=0;
				var b=0; 
				var c=0;
				var d=0;
				var e=0;
				var f=0;
				var g=0;
				var h=0;
				var i=0;
				var j=0;
				taxableamount = amou;
					
				var priceType = $("#priceType'.$i.'").val();
				var hiddenIgst = $("#hiddenIgst'.$i.'").val();
				if(priceType=="Inclusive")
				{
					var taxableamount=0;
					var discountamount=0;
					var total="'.$i.'";
					taxableamount = amou;
					if(discount!="")
					{
						a=(parseFloat(amo)-parseFloat(discount));
						var discountamount=a.toFixed(2);
						var a2=parseFloat(amo)-parseFloat(discount);
						taxableamount=a2.toFixed(2);
					}
					k = taxableamount;
					$("#discountamount'.$i.'").val(discountamount);
					$("#taxableamount'.$i.'").val(taxableamount);
					if(gsttype=="intrastate")
					{
						if(cgst!="")
						{
							var divideBy = parseFloat(hiddenIgst)+100;
							b=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
							var b1=b.toFixed(2);
							$("#cgstamount'.$i.'").val(b1);
							var b2=parseFloat(k)-parseFloat(b);
							var b3=b2.toFixed(2);
							$("#amount'.$i.'").val(b3);
							var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
							$("#total'.$i.'").val(totalVal);
						}

						if(sgst!="")
						{
							var divideBy = parseFloat(hiddenIgst)+100;
							c=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
							var c1=c.toFixed(2);
							$("#sgstamount'.$i.'").val(c1);
							var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
							var c3=c2.toFixed(2);
							$("#amount'.$i.'").val(c3);
							var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
							$("#total'.$i.'").val(totalVal);
						}
					}
					else  if(gsttype=="interstate")
					{
						if(igst!="")
						{
							var divideBy = parseFloat(hiddenIgst)+100;
							d=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy);
							var d1=d.toFixed(2);
							$("#igstamount'.$i.'").val(d1);
							var d2=parseFloat(k)-parseFloat(d);
							var d3=d2.toFixed(2);
							$("#amount'.$i.'").val(d3);
							var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
							$("#total'.$i.'").val(totalVal);
						}
					}
				}
				else
				{
					var k=taxableamount;
					$("#amount'.$i.'").val(amou);
					$("#taxableamount'.$i.'").val(amou);
					$("#total'.$i.'").val(amou);
					
					

					if(discount!="")
					{
						a=((parseFloat(amo)*parseFloat(discount))/100);
						var a1=a.toFixed(2);
						var a2=parseFloat(amo)-parseFloat(a1);
						var a3=a2.toFixed(2);
						k=a3;
						$("#discountamount'.$i.'").val(a1);
						$("#taxableamount'.$i.'").val(a3);
						$("#total'.$i.'").val(a3);
					}

					if(gsttype=="intrastate")
					{
						if(cgst!="")
						{
							b=((parseFloat(k)*parseFloat(cgst))/100);
							var b1=b.toFixed(2);
							$("#cgstamount'.$i.'").val(b1);
							var b2=parseFloat(k)+parseFloat(b);
							var b3=b2.toFixed(2);
							$("#total'.$i.'").val(b3);
						}
						if(sgst!="")
						{
							c=((parseFloat(k)*parseFloat(sgst))/100);
							var c1=c.toFixed(2);
							$("#sgstamount'.$i.'").val(c1);
							var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
							var c3=c2.toFixed(2);
							$("#total'.$i.'").val(c3);
						}
					}
					else  if(gsttype=="interstate")
					{
						if(igst!="")
						{
							d=((parseFloat(k)*parseFloat(igst))/100);
							var d1=d.toFixed(2);
							$("#igstamount'.$i.'").val(d1);
							var d2=parseFloat(k)+parseFloat(d);
							var d3=d2.toFixed(2);
							$("#total'.$i.'").val(d3);
						}
					}
				}
				
				var othercharges=$("#othercharges").val();
				var sub_tot=0;
				sub_tot +=Number($("#freighttotal").val());
				sub_tot +=Number($("#loadingtotal").val());  
				$("input[name^=total]").each(function(){
					sub_tot +=Number($(this).val()); 
					var fina=sub_tot.toFixed(2);         
					$("#subtotal").val(fina);
					$("#grandtotal").val(fina); 
				});

				if(othercharges)
				{
					l=parseFloat(sub_tot)+parseFloat(othercharges);
					var l1=l.toFixed(2);
					$("#grandtotal").val(l1);
				}
			}
			//END OF QUANTITY FUNCTION
			$("#qty'.$i.'").keyup(function(){
				var qty=$("#qty'.$i.'").val();
				var rate=$("#rate'.$i.'").val();
				var qtys=$("#qtys'.$i.'").val();
				var gsttype=$("#gsttypes").val();
				if(parseFloat(qty) > parseFloat(qtys))
				{
					alert("Your Required Qty is : "+qtys+"");
					$("#qty'.$i.'").val("");
					$("#qty'.$i.'").focus("");
				}

				if(qty)
				{
					var amo=parseFloat(rate)*parseFloat(qty);
					var amou=amo.toFixed(2);
					var discount=$("#discount'.$i.'").val();
					var cgst=$("#cgst'.$i.'").val();
					var sgst=$("#sgst'.$i.'").val();
					var igst=$("#igst'.$i.'").val(); 
					var taxableamount=$("#taxableamount'.$i.'").val(); 
					var gsttype=$("#gsttype").val(); 
					var othercharges=$("#othercharges").val();
					var a=0;
					var b=0; 
					var c=0;
					var d=0;
					var e=0;
					var f=0;
					var g=0;
					var h=0;
					var i=0;
					var j=0;
					taxableamount = amou;
						
					var priceType = $("#priceType'.$i.'").val();
					var hiddenIgst = $("#hiddenIgst'.$i.'").val();
					if(priceType=="Inclusive")
					{
						var taxableamount=0;
						var discountamount=0;
						var total="'.$i.'";
						taxableamount = amou;
						if(discount > 0)
						{
							a=(parseFloat(amo)-parseFloat(discount));
							var discountamount=a.toFixed(2);
							var a2=parseFloat(amo)-parseFloat(discount);
							taxableamount=a2.toFixed(2);
						}
						k = taxableamount;
						$("#discountamount'.$i.'").val(discountamount);
						$("#taxableamount'.$i.'").val(taxableamount);
						if(gsttype=="intrastate")
						{
							if(cgst > 0)
							{
								var divideBy = parseFloat(hiddenIgst)+100;
								b=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
								var b1=b.toFixed(2);
								$("#cgstamount'.$i.'").val(b1);
								var b2=parseFloat(k)-parseFloat(b);
								var b3=b2.toFixed(2);
								$("#amount'.$i.'").val(b3);
								var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}

							if(sgst > 0)
							{
								var divideBy = parseFloat(hiddenIgst)+100;
								c=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
								var c1=c.toFixed(2);
								$("#sgstamount'.$i.'").val(c1);
								var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
								var c3=c2.toFixed(2);
								$("#amount'.$i.'").val(c3);
								var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}
						}
						else  if(gsttype=="interstate")
						{
							if(igst > 0)
							{
								var divideBy = parseFloat(hiddenIgst)+100;
								d=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy);
								var d1=d.toFixed(2);
								$("#igstamount'.$i.'").val(d1);
								var d2=parseFloat(k)-parseFloat(d);
								var d3=d2.toFixed(2);
								$("#amount'.$i.'").val(d3);
								var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}
						}
					}
					else
					{
						var k=taxableamount;
						$("#amount'.$i.'").val(amou);
						$("#taxableamount'.$i.'").val(amou);
						$("#total'.$i.'").val(amou);
						
						

						if(discount > 0)
						{
							a=((parseFloat(amo)*parseFloat(discount))/100);
							var a1=a.toFixed(2);
							var a2=parseFloat(amo)-parseFloat(a1);
							var a3=a2.toFixed(2);
							k=a3;
							$("#discountamount'.$i.'").val(a1);
							$("#taxableamount'.$i.'").val(a3);
							$("#total'.$i.'").val(a3);
						}

						if(gsttype=="intrastate")
						{
							if(cgst > 0)
							{
								b=((parseFloat(k)*parseFloat(cgst))/100);
								var b1=b.toFixed(2);
								$("#cgstamount'.$i.'").val(b1);
								var b2=parseFloat(k)+parseFloat(b);
								var b3=b2.toFixed(2);
								$("#total'.$i.'").val(b3);
							}
							if(sgst > 0)
							{
								c=((parseFloat(k)*parseFloat(sgst))/100);
								var c1=c.toFixed(2);
								$("#sgstamount'.$i.'").val(c1);
								var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
								var c3=c2.toFixed(2);
								$("#total'.$i.'").val(c3);
							}
						}
						else  if(gsttype=="interstate")
						{
							if(igst > 0)
							{
								d=((parseFloat(k)*parseFloat(igst))/100);
								var d1=d.toFixed(2);
								$("#igstamount'.$i.'").val(d1);
								var d2=parseFloat(k)+parseFloat(d);
								var d3=d2.toFixed(2);
								$("#total'.$i.'").val(d3);
							}
						}
					}
					
					var othercharges=$("#othercharges").val();
					var sub_tot=0;
					sub_tot +=Number($("#freighttotal").val());
					sub_tot +=Number($("#loadingtotal").val());  
					$("input[name^=total]").each(function(){
						sub_tot +=Number($(this).val()); 
						var fina=sub_tot.toFixed(2);         
						$("#subtotal").val(fina);
						$("#grandtotal").val(fina); 
					});

					if(othercharges)
					{
						l=parseFloat(sub_tot)+parseFloat(othercharges);
						var l1=l.toFixed(2);
						$("#grandtotal").val(l1);
					}
				}
			});
		</script>';





		}
		echo '<script>
		
		$("#freightamount").keyup(function(){
			frieght_calculation();
			totalAmt_calculation();
		});

		$("#freightcgst").keyup(function(){
			var freightcgst=$("#freightcgst").val();
			$("#freightsgst").val(freightcgst);
			frieght_calculation();
			totalAmt_calculation();
		});

		$("#freightigst").keyup(function(){
		   frieght_calculation();
			totalAmt_calculation();
		});

		$("#loadingamount").keyup(function(){
		   frieght_calculation();
			totalAmt_calculation();
		});

		$("#loadingcgst").keyup(function(){
			var loadingcgst=$("#loadingcgst").val();
			$("#loadingsgst").val(loadingcgst);
			frieght_calculation();
			totalAmt_calculation();
		});

		$("#loadingigst").keyup(function(){
			frieght_calculation();
			totalAmt_calculation();
		});
		$("#othercharges").keyup(function(){
		
			totalAmt_calculation();
		});
		function frieght_calculation()
		{
			var gsttype=$("#gsttype").val(); 
			var a=0;
			var b=0; 
			var c=0;
			var d=0;
			var e=0;
			var f=0;
			var g=0;
			var h=0;
			var i=0;
			var j=0;
			//var k=taxableamount;
			var l=0;
			if($("#freightcgst").val()=="") { $("#freightcgst").val("0");  }
			if($("#freightsgst").val()=="") { $("#freightsgst").val("0");  }
			if($("#freightigst").val()=="") { $("#freightigst").val("0");  }
			if($("#loadingcgst").val()=="") { $("#loadingcgst").val("0");  }
			if($("#loadingsgst").val()=="") { $("#loadingsgst").val("0");  }
			if($("#loadingigst").val()=="") { $("#loadingigst").val("0");  }
			var freightamount=$("#freightamount").val();
			var freightcgst=$("#freightcgst").val();
			var freightsgst=$("#freightsgst").val();
			var freightigst=$("#freightigst").val();
			var loadingamount=$("#loadingamount").val();
			var loadingcgst=$("#loadingcgst").val();
			var loadingsgst=$("#loadingsgst").val();
			var loadingigst=$("#loadingigst").val();
			
			if(freightamount=="")
			{
				var fa=0;
				$("#freightcgst").val("0");
				$("#freightsgst").val("0");
				$("#freightigst").val("0");

			} 
			else
			{
				var fa=freightamount;
			}

			if(loadingamount=="")
			{ 
				var la=0;
				$("#loadingcgst").val("0");
				$("#loadingsgst").val("0");
				$("#loadingigst").val("0");
			}
			else
			{
				var la=loadingamount;
			}

			if(gsttype=="intrastate")
			{
				if(freightcgst != "")
				{
					d=((parseFloat(fa)*parseFloat(freightcgst))/100);
					var d1=d.toFixed(2);
					$("#freightcgstamount").val(d1);
					var d2=parseFloat(fa)+parseFloat(d);
					var d3=d2.toFixed(2);
					$("#freighttotal").val(d3);
				}
				else
				{
					$("#freighttotal").val(0);
				}

				if(freightsgst != "")
				{
					e=((parseFloat(fa)*parseFloat(freightsgst))/100);
					var e1=e.toFixed(2);
					$("#freightsgstamount").val(e1);
					var e2=parseFloat(fa)+parseFloat(d)+parseFloat(e);
					var e3=e2.toFixed(2);
					$("#freighttotal").val(e3);
				}
				else
				{
					$("#freighttotal").val(0);
				}

				if(loadingcgst != "")
				{
					f=((parseFloat(la)*parseFloat(loadingcgst))/100);
					var f1=f.toFixed(2);
					$("#loadingcgstamount").val(f1);
					var f2=+parseFloat(la)+parseFloat(f);
					var f3=f2.toFixed(2);
					$("#loadingtotal").val(f3);
				}
				else
				{
					$("#loadingtotal").val(0);
				}

				if(loadingsgst != "")
				{
					g=((parseFloat(la)*parseFloat(loadingsgst))/100);
					var g1=g.toFixed(2);
					$("#loadingsgstamount").val(g1);
					var g2=parseFloat(la)+parseFloat(f)+parseFloat(g);
					var g3=g2.toFixed(2);
					$("#loadingtotal").val(g3);
				}
				else
				{
					$("#loadingtotal").val(0);
				}
			}
			else  if(gsttype=="interstate")
			{
				
				if(freightigst != "")
				{
					i=((parseFloat(fa)*parseFloat(freightigst))/100);
					var i1=i.toFixed(2);
					$("#freightigstamount").val(i1);
					var i2=parseFloat(fa)+parseFloat(i);
					var i3=i2.toFixed(2);
					$("#freighttotal").val(i3);
				}
				else
				{
					$("#freighttotal").val(0);
				}

				if(loadingigst != "")
				{
					j=((parseFloat(la)*parseFloat(loadingigst))/100);
					var j1=j.toFixed(2);
					$("#loadingigstamount").val(j1);
					var j2=parseFloat(la)+parseFloat(j);
					var j3=j2.toFixed(2);
					$("#loadingtotal").val(j3);
				}
				else
				{
					$("#loadingtotal").val(0);
				}
			}
		}
		function totalAmt_calculation()
		{
			//alert("totalAmt_calculation");
			var othercharges=$("#othercharges").val();
			if(othercharges=="") { othercharges=0; }
			var roundOff=$("#roundOff").val();
			var sub_tot=0;
			var l = 0;
			var l1=0;
			sub_tot +=Number($("#freighttotal").val());
			sub_tot +=Number($("#loadingtotal").val());  
			$(\'input[name^="total"]\').each(function(){
				sub_tot +=Number($(this).val()); 
				var fina=sub_tot.toFixed(2);         
				$("#subtotal").val(fina);
				$("#grandtotal").val(fina); 
			});

			if(othercharges)
			{
				l=parseFloat(sub_tot)+parseFloat(othercharges);
				l1=l.toFixed(2);
				$("#grandtotal").val(l1);
			}
			if(roundOff)
			{
				l=parseFloat(sub_tot)+parseFloat(othercharges)+parseFloat(roundOff);
				l1=l.toFixed(2);
				$("#grandtotal").val(l1);
			}
		}	
		</script>';

		echo $html;
	}

	
	public function getpodetails()
	{
		$invoiceno=$this->input->post('purchaseno');
		$this->db->select('*');
		$this->db->from('purchase_details');
		$this->db->where('status',1);
		$this->db->where('purchaseno',$invoiceno);
		// $this->db->where('return_status',1);
		$query = $this->db->get();
		$data= $query->result_array();
		foreach ($data as $ue) 
		{
			$html=' 
			<div class="table-responsive">
				<table class="responsive table">
					<thead> 
						<tr>
							<th>HSN Code</th>
							<th>Item Name</th>
							<th>Qty</th>
							<th>UOM</th>
							<th>Rate</th>
							<th>Total</th>
							<th>Disc </th>
							<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
							<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
							<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
							<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
							<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
							<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
							<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
							<th>Total</th>
						</tr>  
					</thead>
					<tbody>';
			$hsnno=explode('||', $ue['hsnno']);
			$itemname=explode('||', $ue['itemname']);
			$rate=explode('||', $ue['rate']);
			$qty=explode('||', $ue['qty']);
			$amount=explode('||', $ue['amount']);
			$discount=explode('||', $ue['discount']); 
			$discountamount=explode('||', $ue['discountamount']); 
			$taxableamount=explode('||', $ue['taxableamount']);   
			$sgst=explode('||', $ue['sgst']); 
			$cgst=explode('||', $ue['cgst']); 
			$igst=explode('||', $ue['igst']); 
			$sgstamount=explode('||', $ue['sgstamount']); 
			$cgstamount=explode('||', $ue['cgstamount']); 
			$igstamount=explode('||', $ue['igstamount']); 
			$uom=explode('||', $ue['uom']); 
			$total=explode('||', $ue['total']); 
			$returnstatus=explode('||', $ue['return_status']); 
			$count=count($itemname);
			for($i=0; $i< $count; $i++){
			if($returnstatus[$i]==0)
			{
				$hide="style='display:none'";
			}
			else
			{
				$hide='';
			}
			
			$this->db->select('*');
			$this->db->from('additem');
			$this->db->where('itemname',$itemname[$i]);
			$item_query = $this->db->get();
			$item_result = $item_query->row();
			
			//FRIEGHT CHARGES
			if($ue['gsttype']=='intrastate') 
			{
				$cgstHidStatus='';
				$igstHidStatus='style="display:none;"';
			} 
			else 
			{
				$cgstHidStatus='style="display:none;"';
				$igstHidStatus='';
			}
			//END OF FRIEGHT CHARGES
			$html.='
					<tr '.$hide.'>
						<td><input type="hidden" id="hiddenIgst'.$i.'" value="'.$item_result->igst.'" /><input class="" id="hsnno'.$i.'"  readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="'.$hsnno[$i].'" ></td>

						<td><input class="" id="itemname'.$i.'" style="border:1px solid #605f5f;" type="text" name="itemname[]" readonly value="'.$itemname[$i].'" ><input type="hidden" id="priceType'.$i.'" name="priceType[]" value="'.$item_result->priceType.'" /></td>

						<td><input class="" id="qty'.$i.'"   parsley-trigger="change" required  type="text" name="qty[]" value="0"  onkeypress="return isNumberKey(event)" autocomplete="off" style="border:1px solid #605f5f;"><input type="hidden" id="qtys'.$i.'" value="'.$qty[$i].'"><div id="qty_valid" style="color:green">Purchase Qty : '.$qty[$i].'</div></td>  

						<td><input class="" id="uom'.$i.'"  readonly  style="border:1px solid #605f5f;" type="text" name="uom[]" value="'.$uom[$i].'"  autocomplete="off"></td>

						<td><input class=" decimals"  readonly id="rate'.$i.'"  style="border:1px solid #605f5f;" value="'.$rate[$i].'" type="text" name="rate[]"   autocomplete="off"></td>

						<td><input class="decimals" id="amount'.$i.'"  readonly style="border:1px solid #605f5f;" type="text" name="amount[]" value="0"  autocomplete="off"></td>

						<td><input class="decimals" id="discount'.$i.'"  style="border:1px solid #605f5f;" type="text" name="discount[]" readonly value="'.$discount[$i].'" onkeypress="return isNumber(event)" autocomplete="off"></td>

						<td><input class="decimals" id="taxableamount'.$i.'" readonly style="border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" value="0" name="discountamount[]" id="discountamount'.$i.'"></td>

						<td class="sgst"><input class="decimals" readonly id="cgst'.$i.'"  type="text" value="'.$cgst[$i].'" name="cgst[]" value="" style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ></td>

						<td class="sgst"><input class="decimals" readonly id="cgstamount'.$i.'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" style="border:1px solid #605f5f;" value=""></td>

						<td class="sgst"><input class="decimals" id="sgst'.$i.'" readonly  type="text" value="'.$sgst[$i].'" name="sgst[]" value="" style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ></td>

						<td class="sgst"><input class="decimals" id="sgstamount'.$i.'"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value=""></td>

						<td class="igst" style="display:none;"><input class="decimals" value="'.$igst[$i].'" id="igst'.$i.'"  type="text" name="igst[]" readonly  style="border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ></td>

						<td class="igst" style="display:none;"><input class="decimals" id="igstamount'.$i.'"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="border:1px solid #605f5f;" value=""></td>

						<td><input class="" id="total'.$i.'" type="text" name="total[]" value=""  readonly style="border:1px solid #605f5f;"></td>
					</tr>';
			}

			$html.='
				</tbody>
			</table>
			</div>
			<div class="row">&nbsp;</div>
			<div class="table-responsive">
				<table class="table">
					<tr>
						<th>Charges</th>
						<th>Amount</th>
						<th '.$cgstHidStatus.'>CGST</th>
						<th '.$cgstHidStatus.'>CGST Amount</th>
						<th '.$cgstHidStatus.'>SGST</th>
						<th '.$cgstHidStatus.'>SGST Amount</th>
						<th '.$igstHidStatus.'>IGST</th>
						<th '.$igstHidStatus.'>IGST Amount</th>
						<th>Total</th>
					</tr>
					<tr>
						<td>Freight Charges</td>
						<td><input class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="border:1px solid #605f5f;" type="text" name="freightamount" value="'.$ue['freightamount'].'"  autocomplete="off"></td>
						<td '.$cgstHidStatus.'><input class="decimals"   id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="'.$ue['freightcgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td '.$cgstHidStatus.'><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off"  style="border:1px solid #605f5f;" value="'.$ue['freightcgstamount'].'"></td>
						<td '.$cgstHidStatus.'><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" readonly value="'
						.$ue['freightsgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td '.$cgstHidStatus.'><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['freightsgstamount'].'"></td>
						<td '.$igstHidStatus.'><input readonly class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST" value="'.$ue['freightigst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td '.$igstHidStatus.'><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['freightigstamount'].'"></td>
						<td><input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="'.$ue['freighttotal'].'"  readonly style="border:1px solid #605f5f;"></td>
						
					</tr>
					<tr>
						<td>Loading & Packing Charges</td>
						<td><input class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="border:1px solid #605f5f;" type="text" name="loadingamount" value="'.$ue['loadingamount'].'"  autocomplete="off"></td>
						<td '.$cgstHidStatus.'><input class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="'.$ue['loadingcgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td '.$cgstHidStatus.'><input class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off"  style="border:1px solid #605f5f;" value="'.$ue['loadingcgstamount'].'"></td>
						<td  '.$cgstHidStatus.'><input  class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" readonly value="'.$ue['loadingsgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td  '.$cgstHidStatus.'><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount"   placeholder="SGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['loadingsgstamount'].'"></td>
						<td  '.$igstHidStatus.'><input  class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST" value="'.$ue['loadingigst'].'"  style="border:1px solid #605f5f;"   autocomplete="off" ></td>
						<td  '.$igstHidStatus.'><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['loadingigstamount'].'"></td>
						<td><input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="'.$ue['loadingtotal'].'"  readonly style="border:1px solid #605f5f;"></td>
					</tr>
					
				</table>
			</div>
			<div class="col-md-12">
			<div class="col-sm-offset-5">
			<label class="col-sm-5  control-label" >Sub Total</label>
			<div class="col-sm-7">
			<input class="form-control"  type="text" name="subtotal" id="subtotal" readonly  placeholder="0" value="'.$ue['subtotal'].'">
			</div>
			</div>
			<br>
			<br>    

			<div class="col-sm-offset-5">
			<label class="col-sm-5  control-label" >Round Off</label>
			<div class="col-sm-7">
			<input class="form-control"  type="text" name="othercharges" id="othercharges" readonly  placeholder="0" value="'.$ue['othercharges'].'">
			</div>
			</div>
			<br>
			<br>  

			<div class=" col-sm-offset-5">
			<label class="col-sm-5  control-label" >Grand Total</label>
			<div class="col-sm-7">
			<input class="form-control" readonly type="text" value="'.$ue['grandtotal'].'" name="grandtotal" id="grandtotal" >
			<input class="form-control" readonly type="hidden" value="'.$ue['gsttype'].'" name="gsttypes" id="gsttypes" >


			</div>                      
			</div>
			<br>
			<br>
			</div> 
			</div></div>';

		}
		for($i=0;$i<$count;$i++)
		{
			$html.='
				<script>
				totalAmt_calculation();
				//$("#qty'.$i.'").keyup();
				//QUNATITIY KEU UP FUNCTION.
				var qty=$("#qty'.$i.'").val();
					var rate=$("#rate'.$i.'").val();
					var qtys=$("#qtys'.$i.'").val();
					var gsttype=$("#gsttypes").val();
					if(parseFloat(qty) > parseFloat(qtys))
					{
						alert("Your Required Qty is : "+qtys+"");
						$("#qty'.$i.'").val("");
						$("#qty'.$i.'").focus("");
					}

					if(qty!="")
					{
						var amo=parseFloat(rate)*parseFloat(qty);
						var amou=amo.toFixed(2);
						var discount=$("#discount'.$i.'").val();
						var cgst=$("#cgst'.$i.'").val();
						var sgst=$("#sgst'.$i.'").val();
						var igst=$("#igst'.$i.'").val(); 
						var taxableamount=$("#taxableamount'.$i.'").val(); 
						var gsttype=$("#gsttype").val(); 
						var othercharges=$("#othercharges").val();
						var a=0;
						var b=0; 
						var c=0;
						var d=0;
						var e=0;
						var f=0;
						var g=0;
						var h=0;
						var i=0;
						var j=0;
						taxableamount = amou;
							
						var priceType = $("#priceType'.$i.'").val();
						var hiddenIgst = $("#hiddenIgst'.$i.'").val();
						if(priceType=="Inclusive")
						{
							var taxableamount=0;
							var discountamount=0;
							var total="'.$i.'";
							taxableamount = amou;
							if(discount !="")
							{
								a=(parseFloat(amo)-parseFloat(discount));
								var discountamount=a.toFixed(2);
								var a2=parseFloat(amo)-parseFloat(discount);
								taxableamount=a2.toFixed(2);
							}
							k = taxableamount;
							$("#discountamount'.$i.'").val(discountamount);
							$("#taxableamount'.$i.'").val(taxableamount);
							if(gsttype=="intrastate")
							{
								if(cgst != "")
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									b=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
									var b1=b.toFixed(2);
									$("#cgstamount'.$i.'").val(b1);
									var b2=parseFloat(k)-parseFloat(b);
									var b3=b2.toFixed(2);
									$("#amount'.$i.'").val(b3);
									var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}

								if(sgst != "")
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									c=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
									var c1=c.toFixed(2);
									$("#sgstamount'.$i.'").val(c1);
									var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
									var c3=c2.toFixed(2);
									$("#amount'.$i.'").val(c3);
									var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}
							}
							else  if(gsttype=="interstate")
							{
								if(igst != "")
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									d=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy);
									var d1=d.toFixed(2);
									$("#igstamount'.$i.'").val(d1);
									var d2=parseFloat(k)-parseFloat(d);
									var d3=d2.toFixed(2);
									$("#amount'.$i.'").val(d3);
									var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}
							}
						}
						else
						{
							var k=taxableamount;
							$("#amount'.$i.'").val(amou);
							$("#taxableamount'.$i.'").val(amou);
							$("#total'.$i.'").val(amou);
							
							

							if(discount != "")
							{
								a=((parseFloat(amo)*parseFloat(discount))/100);
								var a1=a.toFixed(2);
								var a2=parseFloat(amo)-parseFloat(a1);
								var a3=a2.toFixed(2);
								k=a3;
								$("#discountamount'.$i.'").val(a1);
								$("#taxableamount'.$i.'").val(a3);
								$("#total'.$i.'").val(a3);
							}

							if(gsttype=="intrastate")
							{
								if(cgst != "")
								{
									b=((parseFloat(k)*parseFloat(cgst))/100);
									var b1=b.toFixed(2);
									$("#cgstamount'.$i.'").val(b1);
									var b2=parseFloat(k)+parseFloat(b);
									var b3=b2.toFixed(2);
									$("#total'.$i.'").val(b3);
								}
								if(sgst != "")
								{
									c=((parseFloat(k)*parseFloat(sgst))/100);
									var c1=c.toFixed(2);
									$("#sgstamount'.$i.'").val(c1);
									var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
									var c3=c2.toFixed(2);
									$("#total'.$i.'").val(c3);
								}
							}
							else  if(gsttype=="interstate")
							{
								//alert(gsttype+igst);
								if(igst != "")
								{
									//alert("if"+gsttype+igst);
									d=((parseFloat(k)*parseFloat(igst))/100);
									var d1=d.toFixed(2);
									$("#igstamount'.$i.'").val(d1);
									var d2=parseFloat(k)+parseFloat(d);
									var d3=d2.toFixed(2);
									$("#total'.$i.'").val(d3);
								}
							}
						}
						var othercharges=$("#othercharges").val();
						var sub_tot=0;
						sub_tot +=Number($("#freighttotal").val());
						sub_tot +=Number($("#loadingtotal").val());  
						$("input[name^=total]").each(function(){
							sub_tot +=Number($(this).val()); 
							var fina=sub_tot.toFixed(2);         
							$("#subtotal").val(fina);
							$("#grandtotal").val(fina); 
						});

						if(othercharges)
						{
							l=parseFloat(sub_tot)+parseFloat(othercharges);
							var l1=l.toFixed(2);
							$("#grandtotal").val(l1);
						}
					}
				//EOF QTY KEY UP FUNCTION
				var gsttype=$("#gsttypes").val();
				if(gsttype=="interstate")
				{
					$(".sgst").hide();
					$(".igst").show();
				}
				else  if(gsttype=="intrastate")
				{
					$(".sgst").show();
					$(".igst").hide();
				}

				$("#qty'.$i.'").keyup(function(){
					
					var qty=$("#qty'.$i.'").val();
					var rate=$("#rate'.$i.'").val();
					var qtys=$("#qtys'.$i.'").val();
					var gsttype=$("#gsttypes").val();
					if(parseFloat(qty) > parseFloat(qtys))
					{
						alert("Your Required Qty is : "+qtys+"");
						$("#qty'.$i.'").val("");
						$("#qty'.$i.'").focus("");
					}

					if(qty!="")
					{
						var amo=parseFloat(rate)*parseFloat(qty);
						var amou=amo.toFixed(2);
						var discount=$("#discount'.$i.'").val();
						var cgst=$("#cgst'.$i.'").val();
						var sgst=$("#sgst'.$i.'").val();
						var igst=$("#igst'.$i.'").val(); 
						var taxableamount=$("#taxableamount'.$i.'").val(); 
						var gsttype=$("#gsttype").val(); 
						var othercharges=$("#othercharges").val();
						var a=0;
						var b=0; 
						var c=0;
						var d=0;
						var e=0;
						var f=0;
						var g=0;
						var h=0;
						var i=0;
						var j=0;
						taxableamount = amou;
							
						var priceType = $("#priceType'.$i.'").val();
						var hiddenIgst = $("#hiddenIgst'.$i.'").val();
						if(priceType=="Inclusive")
						{
							var taxableamount=0;
							var discountamount=0;
							var total="'.$i.'";
							taxableamount = amou;
							if(discount !="")
							{
								a=(parseFloat(amo)-parseFloat(discount));
								var discountamount=a.toFixed(2);
								var a2=parseFloat(amo)-parseFloat(discount);
								taxableamount=a2.toFixed(2);
							}
							k = taxableamount;
							$("#discountamount'.$i.'").val(discountamount);
							$("#taxableamount'.$i.'").val(taxableamount);
							if(gsttype=="intrastate")
							{
								if(cgst != "")
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									b=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
									var b1=b.toFixed(2);
									$("#cgstamount'.$i.'").val(b1);
									var b2=parseFloat(k)-parseFloat(b);
									var b3=b2.toFixed(2);
									$("#amount'.$i.'").val(b3);
									var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}

								if(sgst != "")
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									c=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
									var c1=c.toFixed(2);
									$("#sgstamount'.$i.'").val(c1);
									var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
									var c3=c2.toFixed(2);
									$("#amount'.$i.'").val(c3);
									var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}
							}
							else  if(gsttype=="interstate")
							{
								if(igst != "")
								{
									var divideBy = parseFloat(hiddenIgst)+100;
									d=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy);
									var d1=d.toFixed(2);
									$("#igstamount'.$i.'").val(d1);
									var d2=parseFloat(k)-parseFloat(d);
									var d3=d2.toFixed(2);
									$("#amount'.$i.'").val(d3);
									var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
									$("#total'.$i.'").val(totalVal);
								}
							}
						}
						else
						{
							var k=taxableamount;
							$("#amount'.$i.'").val(amou);
							$("#taxableamount'.$i.'").val(amou);
							$("#total'.$i.'").val(amou);
							
							

							if(discount != "")
							{
								a=((parseFloat(amo)*parseFloat(discount))/100);
								var a1=a.toFixed(2);
								var a2=parseFloat(amo)-parseFloat(a1);
								var a3=a2.toFixed(2);
								k=a3;
								$("#discountamount'.$i.'").val(a1);
								$("#taxableamount'.$i.'").val(a3);
								$("#total'.$i.'").val(a3);
							}

							if(gsttype=="intrastate")
							{
								if(cgst != "")
								{
									b=((parseFloat(k)*parseFloat(cgst))/100);
									var b1=b.toFixed(2);
									$("#cgstamount'.$i.'").val(b1);
									var b2=parseFloat(k)+parseFloat(b);
									var b3=b2.toFixed(2);
									$("#total'.$i.'").val(b3);
								}
								if(sgst != "")
								{
									c=((parseFloat(k)*parseFloat(sgst))/100);
									var c1=c.toFixed(2);
									$("#sgstamount'.$i.'").val(c1);
									var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
									var c3=c2.toFixed(2);
									$("#total'.$i.'").val(c3);
								}
							}
							else  if(gsttype=="interstate")
							{
								if(igst != "")
								{
									d=((parseFloat(k)*parseFloat(igst))/100);
									var d1=d.toFixed(2);
									$("#igstamount'.$i.'").val(d1);
									var d2=parseFloat(k)+parseFloat(d);
									var d3=d2.toFixed(2);
									$("#total'.$i.'").val(d3);
								}
							}
						}
						var othercharges=$("#othercharges").val();
						var sub_tot=0;
						sub_tot +=Number($("#freighttotal").val());
						sub_tot +=Number($("#loadingtotal").val());  
						$("input[name^=total]").each(function(){
							sub_tot +=Number($(this).val()); 
							var fina=sub_tot.toFixed(2);         
							$("#subtotal").val(fina);
							$("#grandtotal").val(fina); 
						});

						if(othercharges)
						{
							l=parseFloat(sub_tot)+parseFloat(othercharges);
							var l1=l.toFixed(2);
							$("#grandtotal").val(l1);
						}
					}
				});
				$("#freightamount").keyup(function(){
					frieght_calculation();
					totalAmt_calculation();
				});

				$("#freightcgst").keyup(function(){
					var freightcgst=$("#freightcgst").val();
					$("#freightsgst").val(freightcgst);
					frieght_calculation();
					totalAmt_calculation();
				});

				$("#freightigst").keyup(function(){
				   frieght_calculation();
					totalAmt_calculation();
				});

				$("#loadingamount").keyup(function(){
				   frieght_calculation();
					totalAmt_calculation();
				});

				$("#loadingcgst").keyup(function(){
					var loadingcgst=$("#loadingcgst").val();
					$("#loadingsgst").val(loadingcgst);
					frieght_calculation();
					totalAmt_calculation();
				});

				$("#loadingigst").keyup(function(){
					frieght_calculation();
					totalAmt_calculation();
				});
				function frieght_calculation()
				{
					var gsttype=$("#gsttype").val(); 
					var a=0;
					var b=0; 
					var c=0;
					var d=0;
					var e=0;
					var f=0;
					var g=0;
					var h=0;
					var i=0;
					var j=0;
					//var k=taxableamount;
					var l=0;
					if($("#freightcgst").val()=="") { $("#freightcgst").val("0");  }
					if($("#freightsgst").val()=="") { $("#freightsgst").val("0");  }
					if($("#freightigst").val()=="") { $("#freightigst").val("0");  }
					if($("#loadingcgst").val()=="") { $("#loadingcgst").val("0");  }
					if($("#loadingsgst").val()=="") { $("#loadingsgst").val("0");  }
					if($("#loadingigst").val()=="") { $("#loadingigst").val("0");  }
					var freightamount=$("#freightamount").val();
					var freightcgst=$("#freightcgst").val();
					var freightsgst=$("#freightsgst").val();
					var freightigst=$("#freightigst").val();
					var loadingamount=$("#loadingamount").val();
					var loadingcgst=$("#loadingcgst").val();
					var loadingsgst=$("#loadingsgst").val();
					var loadingigst=$("#loadingigst").val();
					
					if(freightamount=="")
					{
						var fa=0;
						$("#freightcgst").val("0");
						$("#freightsgst").val("0");
						$("#freightigst").val("0");

					} 
					else
					{
						var fa=freightamount;
					}

					if(loadingamount=="")
					{ 
						var la=0;
						$("#loadingcgst").val("0");
						$("#loadingsgst").val("0");
						$("#loadingigst").val("0");
					}
					else
					{
						var la=loadingamount;
					}

					if(gsttype=="intrastate")
					{
						if(freightcgst != "")
						{
							d=((parseFloat(fa)*parseFloat(freightcgst))/100);
							var d1=d.toFixed(2);
							$("#freightcgstamount").val(d1);
							var d2=parseFloat(fa)+parseFloat(d);
							var d3=d2.toFixed(2);
							$("#freighttotal").val(d3);
						}
						else
						{
							$("#freighttotal").val(0);
						}

						if(freightsgst != "")
						{
							e=((parseFloat(fa)*parseFloat(freightsgst))/100);
							var e1=e.toFixed(2);
							$("#freightsgstamount").val(e1);
							var e2=parseFloat(fa)+parseFloat(d)+parseFloat(e);
							var e3=e2.toFixed(2);
							$("#freighttotal").val(e3);
						}
						else
						{
							$("#freighttotal").val(0);
						}

						if(loadingcgst != "")
						{
							f=((parseFloat(la)*parseFloat(loadingcgst))/100);
							var f1=f.toFixed(2);
							$("#loadingcgstamount").val(f1);
							var f2=+parseFloat(la)+parseFloat(f);
							var f3=f2.toFixed(2);
							$("#loadingtotal").val(f3);
						}
						else
						{
							$("#loadingtotal").val(0);
						}

						if(loadingsgst != "")
						{
							g=((parseFloat(la)*parseFloat(loadingsgst))/100);
							var g1=g.toFixed(2);
							$("#loadingsgstamount").val(g1);
							var g2=parseFloat(la)+parseFloat(f)+parseFloat(g);
							var g3=g2.toFixed(2);
							$("#loadingtotal").val(g3);
						}
						else
						{
							$("#loadingtotal").val(0);
						}
					}
					else  if(gsttype=="interstate")
					{
						
						if(freightigst != "")
						{
							i=((parseFloat(fa)*parseFloat(freightigst))/100);
							var i1=i.toFixed(2);
							$("#freightigstamount").val(i1);
							var i2=parseFloat(fa)+parseFloat(i);
							var i3=i2.toFixed(2);
							$("#freighttotal").val(i3);
						}
						else
						{
							$("#freighttotal").val(0);
						}

						if(loadingigst != "")
						{
							j=((parseFloat(la)*parseFloat(loadingigst))/100);
							var j1=j.toFixed(2);
							$("#loadingigstamount").val(j1);
							var j2=parseFloat(la)+parseFloat(j);
							var j3=j2.toFixed(2);
							$("#loadingtotal").val(j3);
						}
						else
						{
							$("#loadingtotal").val(0);
						}
					}
				}
				function totalAmt_calculation()
				{
					//alert("totalAmt_calculation");
					var othercharges=$("#othercharges").val();
					if(othercharges=="") { othercharges=0; }
					var roundOff=$("#roundOff").val();
					var sub_tot=0;
					var l = 0;
					var l1=0;
					sub_tot +=Number($("#freighttotal").val());
					sub_tot +=Number($("#loadingtotal").val());  
					$(\'input[name^="total"]\').each(function(){
						sub_tot +=Number($(this).val()); 
						var fina=sub_tot.toFixed(2);         
						$("#subtotal").val(fina);
						$("#grandtotal").val(fina); 
					});

					if(othercharges)
					{
						l=parseFloat(sub_tot)+parseFloat(othercharges);
						l1=l.toFixed(2);
						$("#grandtotal").val(l1);
					}
					if(roundOff)
					{
						l=parseFloat(sub_tot)+parseFloat(othercharges)+parseFloat(roundOff);
						l1=l.toFixed(2);
						$("#grandtotal").val(l1);
					}
				}	
				var othercharges=$("#othercharges").val();
				var sub_tot=0;
				sub_tot +=Number($("#freighttotal").val());
				sub_tot +=Number($("#loadingtotal").val());  
				$("input[name^=total]").each(function(){
					sub_tot +=Number($(this).val()); 
					var fina=sub_tot.toFixed(2);         
					$("#subtotal").val(fina);
					$("#grandtotal").val(fina); 
				});

				if(othercharges)
				{
					l=parseFloat(sub_tot)+parseFloat(othercharges);
					var l1=l.toFixed(2);
					$("#grandtotal").val(l1);
				}
				</script>
			';
		}
		echo $html;
	}


	public function search()
	{ 
		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$suppliername=$this->input->post('suppliername');
		$invoiceno=$this->input->post('invoiceno');
		$data=array(
		'mac_fromdate' => $fromdate,
		'mac_todate' => $todate,
		'mac_suppliername' => $suppliername,
		'mac_invoiceno' => $invoiceno,
		'mac_bill_format' =>'Print',
		);
		$this->session->set_userdata($data);
	}

	public function billing_reportdownload()
	{ 
		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$suppliername=$this->input->post('suppliername');
		$invoiceno=$this->input->post('invoiceno');

		$data=array(
		'mac_fromdate' => $fromdate,
		'mac_todate' => $todate,
		'mac_suppliername' => $suppliername,
		'mac_invoiceno' => $invoiceno,
		'mac_bill_format' =>'Bill_Download',
		);
		$this->session->set_userdata($data);
	}


	public function viewbilling()
	{
		$id=$this->input->post('id');
		$data=$this->db->where('id',$id)->get('addvehicle')->result_array();
		if($data)
		{
			foreach ($data as $row) {
				$html='
				<div class="row">
					<table class="table m-0">
						<thead>
							<tr>
								<th>Vehicle Name</th>
								<th>Reg No</th>
								<th>Mfg Year</th>
								<th>Starting Km</th>
								<th>Mileage</th>
								<th>Fueltype</th>
								<th>insurance</th>
							</tr>   
						</thead>
						<tbody>';
				$vehiclename=$row['vehiclename'];
				$regno=$row['regno'];
				$mfg=$row['mfgyear'];
				$startingkm=$row['startingkm'];
				$mileage=$row['mileage'];
				$fueltype=$row['fueltype'];
				$insurancetype=$row['insurancetype'];

				$html.='
							<tr>
								<td>'.$vehiclename.'</td>
								<td>'.$regno.'</td>
								<td>'.$mfg.'</td>
								<td>'.$startingkm.'</td>
								<td>'.$mileage.'</td>
								<td>'.$fueltype.'</td>
								<td>'.$insurancetype.'</td>
							</tr>';

				$html.='
						</tbody>
					</table>
				</div>
				<div class="row">
				<div class="col-md-4">
				</div>
				<div class="col-md-4">
				</div>
				</div>';
			}
		}
		else
		{
			$html='';
		}
		echo $html;
	}

	Public function delete()
	{     
		echo  $this->db->where('id',$_POST['id'])->delete('inward_details');
	}
	public function deleteFun($id)
	{
		$salesReturnDet = $this->db->where('id',$id)->get('sales_return')->row();
		if($salesReturnDet->types=='Debit')
		{
			$customerid = $salesReturnDet->customerid;
			$itemName = explode("||",$salesReturnDet->itemname);
			
			$count1=count($itemName);
			$qtyss=explode('||',$salesReturnDet->qty);
			for($i = 0; $i< $count1; $i++)
			{
				if($qtyss[$i]=='1')
				{
					$res[]="1";
				}
				else
				{
					$res[]="1";
				}
			}

			$ress=implode('||',$res);
			
			$rrs=array_sum($res);
			$this->db->where('invoiceno',$salesReturnDet->invoiceno);
			$this->db->where('customerId',$salesReturnDet->customerid);
			$this->db->update('invoice_details',array('return_status'=>$ress,'edit_status'=>'0'));
			
			$data1=$this->db->where('id',$salesReturnDet->customerid)->get('customer_details')->result_array();
			$totalamount = $salesReturnDet->grandtotal;
			foreach ($data1 as $a) 
			{
				$openingbalance=$a['openingbal'];
				$balance=$a['balanceamount']; 
				$returnamounts=$a['returnamount'];
				$salesamount=$a['salesamount'];
			}
			if($balance)
			{
				$balanceamount=$balance + $totalamount;
			}
			else
			{
				$balanceamount=$openingbalance + $totalamount;
			}
			if($returnamounts=='')
			{
				$returnamount=$totalamount;
			}
			else
			{
				$returnamount=$returnamounts-$totalamount;
			} 
			if($salesamount=='')
			{
				$salesamount=$totalamount;
			}
			else
			{
				$salesamount=$salesamount+$totalamount;
			} 
			$datass=array('salesamount'=>$salesamount,'balanceamount'=>$balanceamount,'returnamount'=>$returnamount);
			$this->db->where('id',$salesReturnDet->customerid)->update('customer_details',$datass);
			
			$it=explode('||',$salesReturnDet->itemname);
			$bn=explode('||',$salesReturnDet->hsnno);
			$q=explode('||',$salesReturnDet->qty);
			$count1=count($it);
			for ($i=0; $i < $count1; $i++) { 
				if($q[$i] > 0 )
				{
					$this->db->where('itemname',$it[$i]);
					$this->db->where('hsnno',$bn[$i]);
					$wq=$this->db->get('stock')->result();
					foreach($wq as $w)
					$old=$w->balance;
					$bal=$old-$q[$i];
					//echo $it[$i].'|'.$old.'+'.$q[$i].'='.$bal.'<br>';
					$this->db->where('itemname',$it[$i]);
					$this->db->where('hsnno',$bn[$i]);
					$this->db->update('stock',array('balance'=>$bal));
				}
			}
			$this->db->where('id',$id)->delete('sales_return');
			$this->db->where('invoiceno',$salesReturnDet->invoiceno)->where('receiptno',$salesReturnDet->returnno)->delete('invoice_party_statement');
			$this->session->set_flashdata('msg','Sales return deleted successfully');
			redirect('salesreturn/view');
			/*$da = array(
			'date'=>date('Y-m-d',strtotime($_POST['returndate'])),
			'receiptdate'=>date('Y-m-d',strtotime($_POST['returndate'])),
			'invoiceno'=>$_POST['invoiceno'],
			'receiptno'=>$_POST['returnno'],
			'customerId' => $customerid,
			'customername'=>$_POST['customername'],
			'returnamount'=>$_POST['grandtotal'],
			'balance'=>$balanceamount,
			'paymentdetails'=>$_POST['description'],
			'status'=>1
			);

			$res=$this->db->insert('sales_return',$data);
			$this->db->query("UPDATE preference_settings SET debit='' WHERE id=1");
			if($_POST['save']=='save')
			{
				if($res==true)
				{
					$this->db->where('id',$customerid)->update('customer_details',$datass);
					$this->db->insert('invoice_party_statement',$da);
					$this->session->set_flashdata('msg','Sales return added successfully');
					redirect('salesreturn');
				}
				else
				{
					$this->session->set_flashdata('msg1','Sales return added unsuccessfully');
					redirect('salesreturn');
				}
			}

			if($_POST['print']=='print')
			{
				if($res==true)
				{
					$this->db->where('id',$customerid)->update('customer_details',$datass);
					$this->db->insert('invoice_party_statement',$da);
					$this->session->set_flashdata('msg','Sales return added successfully');
					redirect('salesreturn/bill');
				}
				else
				{
					$this->session->set_flashdata('msg1','Sales return added unsuccessfully');
					redirect('salesreturn');
				}
			}*/
		}
		else if($salesReturnDet->types=='Credit')
		{ // PURCHASE RETURN STARTS HERE.
			$supplierid = $salesReturnDet->supplierid;
			$it=explode('||',$salesReturnDet->itemname);
			$bn=explode('||',$salesReturnDet->hsnno);
			$q=explode('||',$salesReturnDet->qty);
			$count1=count($it);
			for ($i=0; $i < $count1; $i++) { 
				if($q[$i] > 0 )
				{
					$this->db->where('itemname',$it[$i]);
					$this->db->where('hsnno',$bn[$i]);
					$wq=$this->db->get('stock')->result();
					foreach($wq as $w)
					$old=$w->balance;
					$bal=$old+$q[$i];
					$this->db->where('itemname',$it[$i]);
					$this->db->where('hsnno',$bn[$i]);
					$this->db->update('stock',array('balance'=>$bal));
					//echo 'stock BAlance'.$it[$i].'?'.$old.'+'.$q[$i].'='.$bal.'<br>';
				}
			}

			$count1=count($it);
			$qtyss=$q;
			for($i = 0; $i< $count1; $i++)
			{
				if($qtyss[$i]=='0')
				{
					$res[]="1";
				}
				else
				{
					$res[]="1";
				}
			}

			$ress=implode('||',$res);
			
			$rrs=array_sum($res);
			$this->db->where('purchaseno',$salesReturnDet->purchaseno);
			$this->db->where('supplierId',$salesReturnDet->supplierid);
			$this->db->update('purchase_details',array('return_status'=>$ress,'edit_status'=>'1'));

			$data1=$this->db->where('id',$salesReturnDet->supplierid)->get('customer_details')->result_array();

			$totalamount = $salesReturnDet->grandtotal;
			foreach ($data1 as $a) 
			{
				$openingbalance=$a['openingbal'];
				$balance=$a['balanceamount']; 
				$returnamounts=$a['returnamount'];
				$salesamount = $a['salesamount'];
			}
			if($balance)
			{
				$balanceamount=$balance + $totalamount;
			}
			else
			{
				$balanceamount=$openingbalance + $totalamount;
			}
			if($returnamounts=='')
			{
				$returnamount=$totalamount;
			}
			else
			{
				$returnamount=$returnamounts-$totalamount;
			} 
			if($salesamount=='')
			{
				$salesamount=$salesamount;
			}
			else
			{
				$salesamount=$salesamount+$totalamount;
			} 

			$datass=array('salesamount' => $salesamount, 'balanceamount'=>$balanceamount,'returnamount'=>$returnamount);
			$this->db->where('id',$salesReturnDet->supplierid)->update('customer_details',$datass);
			
			$this->db->where('id',$id)->delete('sales_return');
			$this->db->where('purchaseno',$salesReturnDet->purchaseno)->where('receiptno',$salesReturnDet->returnno)->delete('po_party_statements');
			
			$this->session->set_flashdata('msg','Sales return deleted Unsuccessfully');
			redirect('salesreturn/view');
			
			/*$da = array(
			'date'=>date('Y-m-d',strtotime($_POST['returndate'])),
			'purchasedate'=>date('Y-m-d',strtotime($_POST['returndate'])),
			'purchaseno'=>$_POST['purchaseno'],
			'receiptno'=>$_POST['returnno'],
			'suppliername'=>$_POST['suppliername'],
			'returnamount'=>$_POST['grandtotal'],
			'balance'=>$balanceamount,
			'paymentdetails'=>$_POST['description'],
			'status'=>1
			);

			$res=$this->db->insert('sales_return',$data);
			$this->db->query("UPDATE preference_settings SET credit='' WHERE id=1");
			if($_POST['save']=='save')
			{
				if($res==true)
				{
					$this->db->where('id',$supplierid)->update('customer_details',$datass);
					$this->db->insert('po_party_statements',$da);
					$this->session->set_flashdata('msg','Purchase return added successfully');
					redirect('salesreturn');
				}
				else
				{
					$this->session->set_flashdata('msg1','Purchase return added unsuccessfully');
					redirect('salesreturn');
				}
			}
			if($_POST['print']=='print')
			{
				if($res==true)
				{
					$this->db->where('id',$supplierid)->update('customer_details',$datass);
					$this->db->insert('po_party_statements',$da);
					$this->session->set_flashdata('msg','Purchase return added successfully');
					redirect('salesreturn/bill');
				}
				else
				{
					$this->session->set_flashdata('msg1','Purchase return added unsuccessfully');
					redirect('salesreturn');
				}
			}*/
		}
		else
		{
			$this->session->set_flashdata('msg','Sales return added Unsuccessfully');
			redirect('salesreturn');
		}
		
		
		
	}
	public function gets()
	{
		$name=$_POST['name'];
		$data=$this->db->where('itemname',$name)->get('godownstock')->result();
		echo $count=count($data);
	}

	public function getss()
	{
		$name=$_POST['name'];
		$data=$this->db->where('itemcode',$name)->get('godownstock')->result();
		echo $count=count($data);
	}

	public function bill()
	{
		$data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('sales_return')->result();
		foreach($data['pre'] as $b)
		{
			$number= $b->grandtotal;
		}
		$no = round($number);
		// $point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'One', '2' => 'Two',
		'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
		'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
		'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
		'13' => 'Thirteen', '14' => 'Fourteen',
		'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
		'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
		'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
		'60' => 'Sixty', '70' => 'Seventy',
		'80' => 'Eighty', '90' => 'Ninety');
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number) {
			$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
			$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
			$str [] = ($number < 21) ? $words[$number] .
			" " . $digits[$counter] . $plural . " " . $hundred
			:
			$words[floor($number / 10) * 10]
			. " " . $words[$number % 10] . " "
			. @$digits[$counter] . $plural . " " . $hundred;
			} 
			else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$data['fin']=$result;
		$this->load->view('creditbill',$data);
		//$this->load->view('invoicebill',$data);
		// $this->load->view('invoice_bill',$data);
	}

	//DEBIT OR CREDIT NOTE REPORTS PRINT
	public function bill_download()
	{
		$id=$this->uri->segment(3);
		$this->db->where('id',$id);
		$data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('sales_return')->result();
		foreach($data['pre'] as $b)
		{
			$number= $b->grandtotal;
		}
		$no = round($number);
		// $point = round($number - $no, 2) * 100;
		$hundred = null;
		$digits_1 = strlen($no);
		$i = 0;
		$str = array();
		$words = array('0' => '', '1' => 'One', '2' => 'Two',
		'3' => 'Three', '4' => 'Four', '5' => 'Five', '6' => 'Six',
		'7' => 'Seven', '8' => 'Eight', '9' => 'Nine',
		'10' => 'Ten', '11' => 'Eleven', '12' => 'Twelve',
		'13' => 'Thirteen', '14' => 'Fourteen',
		'15' => 'Fifteen', '16' => 'Sixteen', '17' => 'Seventeen',
		'18' => 'Eighteen', '19' =>'Nineteen', '20' => 'Twenty',
		'30' => 'Thirty', '40' => 'Forty', '50' => 'Fifty',
		'60' => 'Sixty', '70' => 'Seventy',
		'80' => 'Eighty', '90' => 'Ninety');
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($i < $digits_1) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += ($divider == 10) ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;
				$hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
				$str [] = ($number < 21) ? $words[$number] .
				" " . $digits[$counter] . $plural . " " . $hundred
				:
				$words[floor($number / 10) * 10]
				. " " . $words[$number % 10] . " "
				. @$digits[$counter] . $plural . " " . $hundred;
			} 
			else $str[] = null;
		}
		$str = array_reverse($str);
		$result = implode('', $str);
		$data['fin']=$result;
		$this->load->view('creditbill',$data);
		//$this->load->view('invoicebill',$data);
		// $this->load->view('invoice_bill',$data);
	}


	public function get_returnno()
	{
		$taxtype=$this->input->post('types');
		if($taxtype=='Debit')
		{
			$this->db->where('types',$taxtype);
			$this->db->order_by('id','desc');
			$this->db->limit(1);
			$num=$this->db->get('sales_return')->result_array();
			@$cusid=$num[0]['returnno'];
			$count=count($cusid);
			if($count=='0')
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$gg = 'D'.$default_bond->debit;
				$sales_no= $gg;
				//$gg="D00001";     
				//$sales_no= $gg;
			}
			else 
			{
				$default_bond=$this->db->where('id',1)->where('debit !=','')->get('preference_settings')->row();
				if($default_bond)
				{
					@$bond_no='D'.$default_bond->debit;
					$bondLen = strlen($bond_no)-1;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$sales_no = 'D'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
				}
				else
				{
					$bondLen = strlen($cusid)-1;
					$bondOnlyNum = filter_var($cusid, FILTER_SANITIZE_NUMBER_INT);
					$sales_no = 'D'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
				}
				/*$old_user_no = str_split($cusid,2);
				@$va = (string)($old_user_no[1].$old_user_no[2].$old_user_no[3].$old_user_no[4].$old_user_no[5].$old_user_no[6])+1; 
				@$sales_length = strlen($va);
				if(@$sales_length == 1)
				{
					$sales_no = "D0000".$va;  
				}
				else if(@$sales_length == 2)
				{
					$sales_no = "D000".$va;      
				}
				else if(@$sales_length == 3)
				{   
					$sales_no = "D00".$va;   
				}
				else if(@$sales_length == 4)
				{    
					$sales_no = "D0".$va; 
				}
				else if(@$sales_length == 5)
				{    
					$sales_no = "D".$va; 
				}*/
			}
			echo $sales_no;
		}
		else if($taxtype=='Credit')
		{
			$this->db->where('types',$taxtype);
			$this->db->order_by('id','desc');
			$this->db->limit(1);
			$num=$this->db->get('sales_return')->result_array();
			@$cusid=$num[0]['returnno'];
			$count=count($cusid);
			if($count=='0')
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$gg = 'C'.$default_bond->credit;
				$sales_no= $gg;
				//$gg="C00001";     
				//$sales_no= $gg;
			}
			else 
			{
				$default_bond=$this->db->where('id',1)->where('credit !=','')->get('preference_settings')->row();
				if($default_bond)
				{
					@$bond_no='C'.$default_bond->credit;
					$bondLen = strlen($bond_no)-1;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$sales_no = 'C'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
				}
				else
				{
					$bondLen = strlen($cusid)-1;
					$bondOnlyNum = filter_var($cusid, FILTER_SANITIZE_NUMBER_INT);
					$sales_no = 'C'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
				}
				/*$old_user_no = str_split($cusid,2);
				@$va = (string)($old_user_no[1].$old_user_no[2].$old_user_no[3].$old_user_no[4].$old_user_no[5].$old_user_no[6])+1; 
				@$sales_length = strlen($va);
				if(@$sales_length == 1)
				{
					$sales_no = "C0000".$va;  
				}
				else if(@$sales_length == 2)
				{
					$sales_no = "C000".$va;      
				}
				else if(@$sales_length == 3)
				{   
					$sales_no = "C00".$va;   
				}
				else if(@$sales_length == 4)
				{    
					$sales_no = "C0".$va; 
				}
				else if(@$sales_length == 5)
				{    
					$sales_no = "C".$va; 
				}*/
			}
			echo $sales_no;
		}
	}


	public function autocomplete_customername()
	{
		$orderno=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('customer_details');
		$this->db->where("(type = 'Inter customer' OR type = 'Intra customer')");
		$this->db->like('name',$orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d){
			$json_array             = array();
			$json_array['label']    = $d->name;
			$json_array['value']    = $d->name;
			$json_array['tinno']    = $d->tinno;
			$json_array['cstno']    = $d->cstno;
			$json_array['mobileno']    = $d->phoneno;
			$json_array['address']    = $d->address1.''.$d->address2;
			$json_array['id']    = $d->id;
			$json_array['balance']    = $d->balanceamount;
			// $json_array['advanceamount'] = $d->voucheramount;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}


	public function autocomplete_suppliername()
	{
		$orderno=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('customer_details');
		$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
		// $this->db->where('type','supplier');

		$this->db->like('name',$orderno);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d){
			$json_array             = array();
			$json_array['label']    = $d->name;
			$json_array['value']    = $d->name;
			$json_array['tinno']    = $d->tinno;
			$json_array['cstno']    = $d->cstno;
			$json_array['mobileno']    = $d->phoneno;
			$json_array['address']    = $d->address1.''.$d->address2;
			$json_array['id']    = $d->id;
			$json_array['balance']    = $d->balanceamount;
			// $json_array['advanceamount'] = $d->voucheramount;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}


	public function get_type()
	{
		$invoiceno=$this->input->post('invoiceno');
		$this->db->select('*');
		$this->db->from('invoice_details');
		$this->db->where('invoiceno',$invoiceno);
		$query = $this->db->get();
		$result = $query->result();

		foreach($result as $h)
		{   
			$vob['billtype']=$h->billtype;
		}
		echo json_encode($vob);
	}


	public function get_typepo()
	{
		$invoiceno=$this->input->post('purchaseno');
		$this->db->select('*');
		$this->db->from('purchase_details');
		$this->db->where('purchaseno',$invoiceno);
		$query = $this->db->get();
		$result = $query->result();
		foreach($result as $h)
		{   
			$vob['billtype']=$h->billtype;
		}
		echo json_encode($vob);
	}

}

ob_flush(); 
?>