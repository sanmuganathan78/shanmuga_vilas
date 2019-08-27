<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class CashBill extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('cashbill_model');
    if($this->session->userdata('rcbio_login')=='')
    {
      $this->session->set_flashdata('msg','Please Login to continue!');
      redirect('login');
    }     
  }
	public function index()
	{
	    $mysqli = new mysqli("localhost", "root", "", "shanmuga_vilas");
		$query_update1 =$mysqli->query("SELECT * FROM cashbill_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
		while($row = mysqli_fetch_array($query_update1))
		{
			$quotationnos=$row['invoiceno'];
			//$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
			$new_bond_prefix = '';
			@$quotationnos=str_replace($new_bond_prefix,'',$quotationnos);
			//echo $quotationnos."vaitheesh";
		}

		if(date('m')=='04')
		{
			$month=date('m');
			$year=date('Y');
			$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->get('cashbill_details')->result_array();
			if($old)
			{
				@$bond_no = $quotationnos;
				if(is_null($bond_no))
				{
					$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
					$new_bond_prefix = '';
					$new_bond_noo = $new_bond_prefix.$default_bond->cashbill_invoice;
					//$new_bond_noo = '100001'; 
				} 
				else 
				{
					$default_bond=$this->db->where('id',1)->where('cashbill_invoice !=','')->get('preference_settings')->row();
					if($default_bond)
					{
						$bond_no=$default_bond->cashbill_invoice;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_prefix = '';//$default_bond->invoicePrefix;
						$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
					}
					else
					{
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						//$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
						$new_bond_prefix = '';//$default_bond->invoicePrefix;
						$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
					}

				}
			}
			else
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$new_bond_prefix = '';//$default_bond->invoicePrefix;
				$new_bond_noo = $new_bond_prefix.$default_bond->cashbill_invoice;
				//$new_bond_noo = '100001';
			}

		}
		else
		{
			@$bond_no = $quotationnos;
			if(is_null($bond_no))
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$new_bond_prefix = '';//$default_bond->invoicePrefix;
				$new_bond_noo = $new_bond_prefix.$default_bond->cashbill_invoice;
				//$new_bond_noo = '100001'; 
			} 
			else
			{
				$default_bond=$this->db->where('id',1)->where('cashbill_invoice !=','')->get('preference_settings')->row();
				if($default_bond)
				{
					@$bond_no=$default_bond->cashbill_invoice;
					$new_bond_prefix = '';//$default_bond->invoicePrefix;
					$bondLen = strlen($bond_no);
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
				}
				else
				{
					$bondLen = strlen($bond_no);
					//$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
					$new_bond_prefix = '';//$default_bond->invoicePrefix;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					@$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
				}
			}
		}
		$data['invoiceno']=$new_bond_noo;
		$this->load->view('header');
		$this->load->view('cashbill_add',$data);
		$this->load->view('footer');
	}

		public function insert()
	{
		 //print_r($_POST);exit;
		 $mysqli = new mysqli("localhost", "root", "", "shanmuga_vilas");
		$query_update1 =$mysqli->query("SELECT * FROM cashbill_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
		while($row = mysqli_fetch_array($query_update1))
		{
			$quotationnos=$row['invoiceno'];
			//$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
			$new_bond_prefix = '';
			@$quotationnos=str_replace($new_bond_prefix,'',$quotationnos);
			//echo $quotationnos."vaitheesh";
		}

		if(date('m')=='04')
		{
			$month=date('m');
			$year=date('Y');
			$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->get('cashbill_details')->result_array();
			if($old)
			{
				@$bond_no = $quotationnos;
				if(is_null($bond_no))
				{
					$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
					$new_bond_prefix = '';
					$new_bond_noo = $new_bond_prefix.$default_bond->cashbill_invoice;
					//$new_bond_noo = '100001'; 
				} 
				else 
				{
					$default_bond=$this->db->where('id',1)->where('cashbill_invoice !=','')->get('preference_settings')->row();
					if($default_bond)
					{
						$bond_no=$default_bond->cashbill_invoice;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_prefix = '';//$default_bond->invoicePrefix;
						$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
					}
					else
					{
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						//$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
						$new_bond_prefix = '';//$default_bond->invoicePrefix;
						$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
					}

				}
			}
			else
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$new_bond_prefix = '';//$default_bond->invoicePrefix;
				$new_bond_noo = $new_bond_prefix.$default_bond->cashbill_invoice;
				//$new_bond_noo = '100001';
			}

		}
		else
		{
			@$bond_no = $quotationnos;
			if(is_null($bond_no))
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$new_bond_prefix = '';//$default_bond->invoicePrefix;
				$new_bond_noo = $new_bond_prefix.$default_bond->cashbill_invoice;
				//$new_bond_noo = '100001'; 
			} 
			else
			{
				$default_bond=$this->db->where('id',1)->where('cashbill_invoice !=','')->get('preference_settings')->row();
				if($default_bond)
				{
					@$bond_no=$default_bond->cashbill_invoice;
					$new_bond_prefix = '';//$default_bond->invoicePrefix;
					$bondLen = strlen($bond_no);
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
				}
				else
				{
					$bondLen = strlen($bond_no);
					//$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
					$new_bond_prefix = '';//$default_bond->invoicePrefix;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					@$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
				}
			}
		}
		$invoiceno=$new_bond_noo;
		$customername = $_POST['customername'];
		$cust_mobno = $_POST['cust_mobno'];
		$address = $_POST['address'];
		$grandtotal = $_POST['grandtotal'];

	
			$hsnno=implode('||',$_POST['hsnno']);
			$itemname=implode('||',$_POST['itemname']);
			$qty=implode('||',$_POST['qty']);
			$uom=implode('||',$_POST['uom']);
			$rate=implode('||',$_POST['rate']);
			$amount=implode('||',$_POST['amount']);
			// @$discount=implode('||',$_POST['discount']);
			// @$discountamount=implode('||',$_POST['discountamount']);
			$taxableamount=implode('||',$_POST['taxableamount']);
			// $cgst=implode('||',$_POST['cgst']);
			// $cgstamount=implode('||',$_POST['cgstamount']);
			// $sgst=implode('||',$_POST['sgst']);
			// $sgstamount=implode('||',$_POST['sgstamount']);
			// $igst=implode('||',$_POST['igst']);
			// $igstamount=implode('||',$_POST['igstamount']);
			$total=implode('||',$_POST['total']);
			$subtotal=$this->input->post('subtotal');
			$freightamount=$this->input->post('freightamount');
			$freightcgst=$this->input->post('freightcgst');
			$freightcgstamount=$this->input->post('freightcgstamount');
			$freightsgst=$this->input->post('freightsgst');
			$freightsgstamount=$this->input->post('freightsgstamount');
			$freightigst=$this->input->post('freightigst');
			$freightigstamount=$this->input->post('freightigstamount');
			$freighttotal=$this->input->post('freighttotal');
			$loadingamount=$this->input->post('loadingamount');
			$loadingcgst=$this->input->post('loadingcgst');
			$loadingcgstamount=$this->input->post('loadingcgstamount');
			$loadingsgst=$this->input->post('loadingsgst');
			$loadingsgstamount=$this->input->post('loadingsgstamount');
			$loadingigst=$this->input->post('loadingigst');
			$loadingigstamount=$this->input->post('loadingigstamount');
			$loadingtotal=$this->input->post('loadingtotal');
			$roundOff=$this->input->post('roundOff');
			$othercharges=$this->input->post('othercharges');
			$hiddenDiscountBy=$this->input->post('hiddenDiscountBy');
			$grandtotal=$this->input->post('grandtotal');

			$invoicenoyear=$_POST['invoiceno'].''.date('-Y').'';
			$invoicenodate=$_POST['invoiceno'].''.date('dmy').'';

			$pcode=$_POST['hsnno'];
			$count7=count($pcode);
			for ($i=0; $i < $count7; $i++) 
			{
			$res[]="0";
			$ret[]="1";
			}



			// $billtype=$_POST['gsttype'];
			// if($billtype=='intrastate')
			// {
			// 	$sgst = implode('||',$_POST['sgst']);
			// 	$cgst = implode('||',$_POST['cgst']);
			// 	$igst = implode('||',$_POST['igst']);
			// 	$sgstamount = implode('||',$_POST['sgstamount']);
			// 	$cgstamount = implode('||',$_POST['cgstamount']);
			// 	$igstamount = implode('||',$res);
			// 	$sgsts='sgst';
			// 	$cgsts='cgst';
			// 	$igsts='';
			// }

			// if($billtype=='interstate')
			// {
			// 	$sgst =implode('||',$res);
			// 	$cgst = implode('||',$res);
			// 	$igst = implode('||',$_POST['igst']);
			// 	$sgstamount = implode('||',$res);
			// 	$cgstamount = implode('||',$res);
			// 	$igstamount = implode('||',$_POST['igstamount']);
			// 	$igsts='igst';
			// 	$sgsts='';
			// 	$cgsts='';
			// }

			$data=array(
			'Date'=>date('Y-m-d'),
			'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
			'invoiceno' =>$invoiceno, 
			'customerId' => '0',
			'customername' =>$_POST['customername'], 
			'cust_mobno' => $_POST['cust_mobno'],
			'address' =>nl2br($_POST['address'],true), 
			'gsttype' =>$_POST['gsttype'],
			'typesgst'=>$sgsts,
			'typecgst'=>$cgsts,
			'typeigst'=>$igsts,
			'hsnno'=>$hsnno,
			'itemname'=>$itemname,
			'uom'=>$uom,
			'rate'=>$rate,
			'qty'=>$qty,
			'amount'=>$amount,
			'discount'=>$_POST['discount'],
			'discountamount'=>$_POST['discountamount'],
			// 'taxableamount'=>$taxableamount,
			// 'sgst'=>$sgst,
			// 'sgstamount'=>$sgstamount,
			// 'cgst'=>$cgst,
			// 'cgstamount'=>$cgstamount,
			// 'igst'=>$igst,
			// 'igstamount'=>$igstamount,
			'total'=>$total,
			'subtotal' =>$_POST['subtotal'], 
			'freightamount'=>$freightamount,
			'freightcgst'=>$freightcgst,
			'freightcgstamount'=>$freightcgstamount,
			'freightsgst'=>$freightsgst,
			'freightsgstamount'=>$freightsgstamount,
			'freightigst'=>$freightigst,
			'freightigstamount'=>$freightigstamount,
			'freighttotal'=>$freighttotal,
			'loadingamount'=>$loadingamount,
			'loadingcgst'=>$loadingcgst,
			'loadingcgstamount'=>$loadingcgstamount,
			'loadingsgst'=>$loadingsgst,
			'loadingsgstamount'=>$loadingsgstamount,
			'loadingigst'=>$loadingigst,
			'loadingigstamount'=>$loadingigstamount,
			'loadingtotal'=>$loadingtotal,
			'roundOff' =>$roundOff,
			'othercharges' =>$othercharges,
			'discountBy' =>$hiddenDiscountBy,
			'return_status'=>implode('||',$ret),
			'grandtotal' =>$grandtotal, 
			'invoicenodate' =>$invoicenodate, 
			'invoicenoyear' =>$invoicenoyear, 
			'status'=>1,
			'edit_status'=>1);
			$result=$this->db->insert('cashbill_details',$data);
			if($result==true)
			{ 
				$invoiceid=$this->db->insert_id();
				$this->db->query("UPDATE preference_settings SET cashbill_invoice 	='' WHERE id=1");
				$this->db->query("UPDATE cashbill_details SET customerId ='$invoiceid' WHERE id='$invoiceid'");
		
				$sparename=$_POST['itemname'];
				$qty=$_POST['qty'];
				$count=count($sparename);
				for ($i=0; $i <  $count; $i++) 
				{ 
					$data=$this->db->where('itemname',$sparename[$i])->get('inward_delivery')->result();
					foreach($data as $v)
					{
						$bal=$v->balanceqty;
					}
					if($data)
					{
						$this->db->where('itemname',$sparename[$i])->update('inward_delivery',array('date'=>date('Y-m-d'),'balanceqty'=>$bal-$qty[$i],'qty'=>$qty[$i]));
					}
				}		




				$itemnames=$_POST['itemname'];
				$qtys=$_POST['qty'];
				$hsnnoss=$_POST['hsnno'];
				$rate=$_POST['rate'];
				$total=$_POST['total'];
				$count=count($sparename);
				for ($j=0; $j <  $count; $j++) 
				{
					$podatass=array(
					'systemDate'=>date('Y-m-d'),
					'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
					'invoiceno' =>$_POST['invoiceno'],
					'customerId' => '0',
					'customername' =>$_POST['customername'], 
					'mobileno' => $cust_mobno,
					'address' =>nl2br($_POST['address']), 
					'gsttype' =>$_POST['gsttype'],
					'itemname'=>$itemnames[$j],
					'rate'=>$rate[$j],
					'qty'=>$qtys[$j],
					'total'=>$total[$j],
					'hsnno'=>$hsnnoss[$j],
					'address' =>$_POST['address'],  
					'subtotal' =>$_POST['subtotal'], 
					'grandtotal' =>$_POST['grandtotal'], 
					'invoicenodate' =>$invoicenodate, 
					'invoicenoyear' =>$invoicenoyear,
					'invoiceid' =>$invoiceid,
					'status'=>1);
					$this->db->insert('cashbill_reports',$podatass);
				}

				
				$this->session->set_flashdata('msg','Cash Bill Added Successfully');
				if($_POST['print']=='print')
				{
					redirect('cashbill/printInvoice');
				}
				if($_POST['save']=='save')
				{
					redirect('cashbill');
				}
			}
			else
			{
				$this->session->set_flashdata('msg1','Cash Bill Added Unsuccessfully');
				redirect('cashbill');
			}
		
	}

  public function listing()
  {

    //$data['invoice']=$this->cashbill_model->select();
    //$data['vat']=$this->db->get('vat_details')->result_array(); 
    $this->load->view('header');
    $this->load->view('cashbill_list');
    $this->load->view('footer1');
  }

 public function viewBill()
  {

     $id=base64_decode($this->uri->segment(3));
     $data['result']=$this->db->where('id',$id)->get('cashbill_details')->result_array();  
     $this->load->view('header');
     $this->load->view('cashbill_view',$data);
     $this->load->view('footer');

  }


		public function ajax_list()
		{
			$list = $this->cashbill_model->get_datatables();
			$data = array();
			$no = $_POST['start'];
			$i=1;
			foreach ($list as $person) {
				@$gstin=$this->db->select('gstno')->where('name',$person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;
				@$phoneno=$this->db->select('phoneno')->where('name',$person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->phoneno;
				if($phoneno='') {
                    
				}
				$startTimeStamp = strtotime($person->invoicedate);
				$endTimeStamp = strtotime(date('Y-m-d'));
				$timeDiff = abs($endTimeStamp - $startTimeStamp);
				$numberDays = $timeDiff/86400;  // 86400 seconds in one day
				$numberDays = intval($numberDays);

				$no++;
				$row = array();
				$row[] = $i++;
				$row[] =date('d-m-Y',strtotime($person->invoicedate));
				$row[] = $person->invoiceno;
				$row[] = $person->customername;
				$row[] = $person->cust_mobno;
				//$row[] = $gstin;
				$row[] = $person->grandtotal;
				//$row[] = $numberDays.' Days';
				$code=base64_encode($person->id);

				$deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$code."'".')">Delete</a>';
				$row[] = '
				<div class="btn-group">
					<button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Manage <span class="caret"></span></button>
					<ul class="dropdown-menu" role="menu" style="background: #23BDCF none repeat scroll 0% 0%;width:14px;min-width: 100%;">
						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('cashbill/viewBill/'.$code).'" title="Hapus" >View</a></li>
						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('cashbill/edit/'.$code).'" title="Hapus" >Edit</a></li>
						<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('cashbill/printBill/'.$code).'" title="Hapus" >Print</a></li>
					<li>'.$deleteOptn.'</li>
					</ul>
				</div>';

				$data[] = $row;
			}
			$output = array(
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->cashbill_model->count_all(),
			"recordsFiltered" => $this->cashbill_model->count_filtered(),
			"data" => $data,);
			//output to json format
			echo json_encode($output);
		}

public function ajax_delete($id)
{
  $this->cashbill_model->delete_by_id($id);
  echo json_encode(array("status" => TRUE));
}

		public function autocomplete_name()
		{
			$name=$this->input->post('keyword');
			//$cusname='ram';
			$this->db->select('*');
			$this->db->from('cashbill_details');
			$this->db->like('invoiceno',$name);
			$this->db->group_by('invoiceno');

			$query = $this->db->get();
			$result = $query->result();
			$name       =  array();
			foreach ($result as $d) 
			{
			$json_array             = array();
			$json_array['value']    = $d->invoiceno;
			$json_array['label']    = $d->invoiceno;
			$name[]             = $json_array;
			}
			echo json_encode($name);
		}
  
public function autocomplete_customername()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('customer_details');
  $this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
  $this->db->like('name',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->name;
    $json_array['value']    = $d->name;
    $json_array['address']    = $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
    $json_array['customerid'] = $d->id;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}






public function autocomplete_itemcode()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemno',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->itemno;
    $json_array['value']    = $d->itemno;
    // $json_array['itemname']    = $d->itemname;
    // $json_array['price']    = $d->price;
    // $json_array['hsnno']    = $d->hsnno;


    // $json_array['advanceamount'] = $d->voucheramount;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}

public function get_itemcode()
{
  $itemcode=$this->input->post('name');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemno',$itemcode);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $h)
  {   
    $vob['itemname']=$h->itemname;
    $vob['price']=$h->price;
    $vob['hsnno']=$h->hsnno;

  }
  echo json_encode($vob);
}

public function get_hsnno()
{
  $itemcode=$this->input->post('name');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('hsnno',$itemcode);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $h)
  {   
    $vob['itemname']=$h->itemname;
    $vob['price']=$h->price;
    $vob['sgst']=$h->sgst;
    $vob['cgst']=$h->cgst;
    $vob['igst']=$h->igst;

  }
  echo json_encode($vob);
}


public function get_itemnames()
{
  $itemcode=$this->input->post('name');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemname',$itemcode);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $h)
  {   
	
	
    $uom=$this->db->select('uom')->where('id',$h->uom)->get('uom')->row()->uom;
    $vob['hsnno']=$h->hsnno;
    $vob['price']=$h->price;
    $vob['priceType']=$h->priceType;
    $vob['hsnno']=$h->hsnno;
    $vob['sgst']=$h->sgst;
    $vob['cgst']=$h->cgst;
    $vob['igst']=$h->igst;
    $vob['uom']=$uom;
	
	$checkInvoiceType = $this->db->select('invoiceBy')->where('id',1)->get('preference_settings')->row()->invoiceBy;
	if($checkInvoiceType=='without_stock')
	{
		$vob['balance']=0;
	}
	else
	{
		$this->db->select('*');
		$this->db->from('stock');
		$this->db->where('itemname',$itemcode);
		$query2 = $this->db->get();	
		$result = $query2->row();
		$vob['balance']=$result->balance;
	}
	

  }
  echo json_encode($vob);
}



public function autocomplete_itemname()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemname',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->itemname;
    $json_array['value']    = $d->itemname;
    $json_array['price']    = $d->price;
    $json_array['sgst']    = $d->sgst;
    $json_array['cgst']    = $d->cgst;
    $json_array['igst']    = $d->igst;


    // $json_array['advanceamount'] = $d->voucheramount;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}


public function autocomplete_hsnno()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('hsnno',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->hsnno;
    $json_array['value']    = $d->hsnno;


    // $json_array['advanceamount'] = $d->voucheramount;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}


public function edit()
{

  $id=base64_decode($this->uri->segment(3));
  $data['result']=$this->db->where('id',$id)->get('cashbill_details')->result_array(); 
  $this->load->view('header');
  $this->load->view('cashbill_edit',$data);
  $this->load->view('footer');

}


public function autocomplete_invoiceno()
{
  $name=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('purchase_details');
  $this->db->like('purchaseno',$name);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d) 
  {
    $json_array             = array();
    $json_array['value']    = $d->purchaseno;
    $json_array['label']    = $d->purchaseno;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}


public function autocomplete_no()
{
  $name=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemno',$name);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d) 
  {
    $json_array             = array();
    $json_array['value']    = $d->itemno;
    $json_array['label']    = $d->itemno;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}


public function autocomplete_item()
{
  $itemname=$this->input->post('keyword');
//$cusname='ram';
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->like('itemname',$itemname);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d) 
  {
    $json_array             = array();
    $json_array['value']    = $d->itemname;
    $json_array['label']    = $d->itemname;
    $name[]             = $json_array;
  }
  echo json_encode($name);
}
public function get_itemno()
{
  $itemno=$this->input->post('itemno');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemno',$itemno);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $s)
  {   
    $vob['itemname']=$s->itemname;
    $vob['price']=$s->price;
  }
  echo json_encode($vob);
}
public function get_itemname()
{
  $itemname=$this->input->post('itemname');
  $this->db->select('*');
  $this->db->from('additem');
  $this->db->where('itemname',$itemname);
  $query = $this->db->get();
  $result = $query->result();
  foreach($result as $s)
  {   
    $vob['itemno']=$s->itemno;
    $vob['price']=$s->price;
  }
  echo json_encode($vob);
}

public function update()
{

	$customername = $_POST['customername'];
	$customerid = $_POST['customerid'];
	$cust_mobno = $_POST['cust_mobno'];
	$address = $_POST['address'];
	
	$grandtotal = $_POST['grandtotal'];
	$customerDet = array('date'=>date('Y-m-d'),'type'=>'Intra customer','name'=>$customername,'phoneno'=>$cust_mobno,'address1'=>nl2br($address,true),'status'=>'1');
	$this->db->where('id',$customerid)->update('customer_details',$customerDet);
	$id=$this->input->post('id');
	$getpurchase=$this->db->where('id',$id)->get('cashbill_details')->result();
	foreach($getpurchase as $getp)
	$grandtotals=$getp->grandtotal; 
   
    $data11=$this->db->where('id',$customerid)->get('customer_details')->result_array();
    foreach ($data11 as $a1) 
    {
		$openingbalance=$a1['openingbal'];
		$balance=$a1['balanceamount'];
		$salesamounts=$a1['salesamount'];  
		$paidamounts=$a1['paidamount'];  
    } 
	if($paidamounts=='') { $paidAmount = $grandtotal; } else { $paidAmount = $paidamounts-$grandtotals;  }
	if($salesamounts=='') {	$salesamount=$grandtotal; }	else { $salesamount=$salesamounts-$grandtotals;	}
    $this->db->where('id',$customerid)->update('customer_details',array('paidamount'=>$paidAmount,'salesamount'=>$salesamount,'balanceamount'=>0));

    $data1=$this->db->where('id',$customerid)->get('customer_details')->result_array();
	foreach ($data1 as $a) 
    {
      $openingbalance=$a['openingbal'];
      $balance=$a['balanceamount'];
      $salesamounts=$a['salesamount'];  
      $paidamounts=$a['paidamount'];  
    }
    if($paidamounts=='') { $paidAmount = $grandtotal; } else { $paidAmount = $paidamounts+$grandtotal;  }
    if($salesamounts=='') { $salesamount=$grandtotal; } else { $salesamount=$salesamounts+$grandtotal; }
    $datass = array('paidamount'=>$paidAmount,'salesamount'=>$salesamount,'balanceamount'=>0);
    $this->db->where('id',$customerid)->update('customer_details',$datass);
	 
		
	$id=$this->input->post('id');
	$getpurchase=$this->db->where('id',$id)->get('cashbill_details')->result();
	foreach($getpurchase as $getp)
	$grandtotals=$getp->grandtotal;  
	$ite=explode('||',$getp->itemname);
	$qtyss=explode('||',$getp->qty);
	$hsnnos=explode('||',$getp->hsnno);

	$count=count($ite);
	for ($i=0; $i < $count; $i++) 
	{ 
		$stock=$this->db->where('itemname',$ite[$i])->where('hsnno',$hsnnos[$i])->get('stock')->result_array();
		foreach ($stock as $s) 
		{
			$cur=$s['balance'];
			$tot=$cur+$qtyss[$i]; 
			$this->db->where('itemname',$ite[$i])->where('hsnno',$hsnnos[$i])->update('stock',array('balance'=>$tot));   
		}

	}
	
	$hsnno=implode('||',$_POST['hsnno']);
	$itemname=implode('||',$_POST['itemname']);
	$qty=implode('||',$_POST['qty']);
	$uom=implode('||',$_POST['uom']);
	$rate=implode('||',$_POST['rate']);
	$amount=implode('||',$_POST['amount']);
	@$discount=implode('||',$_POST['discount']);
	@$discountamount=implode('||',$_POST['discountamount']);
	$taxableamount=implode('||',$_POST['taxableamount']);
	$cgst=implode('||',$_POST['cgst']);
	$cgstamount=implode('||',$_POST['cgstamount']);
	$sgst=implode('||',$_POST['sgst']);
	$sgstamount=implode('||',$_POST['sgstamount']);
	$igst=implode('||',$_POST['igst']);
	$igstamount=implode('||',$_POST['igstamount']);
	$total=implode('||',$_POST['total']);
	$subtotal=$this->input->post('subtotal');
	$freightamount=$this->input->post('freightamount');
	$freightcgst=$this->input->post('freightcgst');
	$freightcgstamount=$this->input->post('freightcgstamount');
	$freightsgst=$this->input->post('freightsgst');
	$freightsgstamount=$this->input->post('freightsgstamount');
	$freightigst=$this->input->post('freightigst');
	$freightigstamount=$this->input->post('freightigstamount');
	$freighttotal=$this->input->post('freighttotal');
	$loadingamount=$this->input->post('loadingamount');
	$loadingcgst=$this->input->post('loadingcgst');
	$loadingcgstamount=$this->input->post('loadingcgstamount');
	$loadingsgst=$this->input->post('loadingsgst');
	$loadingsgstamount=$this->input->post('loadingsgstamount');
	$loadingigst=$this->input->post('loadingigst');
	$loadingigstamount=$this->input->post('loadingigstamount');
	$loadingtotal=$this->input->post('loadingtotal');
	$roundOff=$this->input->post('roundOff');
	$othercharges=$this->input->post('othercharges');
	$hiddenDiscountBy=$this->input->post('hiddenDiscountBy');
	$grandtotal=$this->input->post('grandtotal');

	$pcode=$_POST['hsnno'];
	$count7=count($pcode);
	for ($i=0; $i < $count7; $i++) 
	{
		$res[]="0";
		$ret[]="1";
	}

	$billtype=$_POST['gsttype'];
	if($billtype=='intrastate')
	{
		$sgst = implode('||',$_POST['sgst']);
		$cgst = implode('||',$_POST['cgst']);
		$igst = implode('||',$res);
		$sgstamount = implode('||',$_POST['sgstamount']);
		$cgstamount = implode('||',$_POST['cgstamount']);
		$igstamount = implode('||',$_POST['igst']);
		$sgsts='sgst';
		$cgsts='cgst';
		$igsts='';
	}

	if($billtype=='interstate')
	{
		$sgst =implode('||',$res);
		$cgst = implode('||',$res);
		$igst = implode('||',$_POST['igst']);
		$sgstamount = implode('||',$res);
		$cgstamount = implode('||',$res);
		$igstamount = implode('||',$_POST['igstamount']);
		$igsts='igst';
		$sgsts='';
		$cgsts='';
	}

	$data=array(
	'systemDate'=>date('Y-m-d'),
	'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])),
	'invoiceno' =>$_POST['invoiceno'], 
	'customername' =>$_POST['customername'], 
	'cust_mobno' => $_POST['cust_mobno'],
	'address' =>nl2br($address,true), 
	'gsttype' =>$_POST['gsttype'],
	'typesgst'=>$sgsts,
	'typecgst'=>$cgsts,
	'typeigst'=>$igsts,
	'hsnno'=>$hsnno,
	'itemname'=>$itemname,
	'uom'=>$uom,
	'rate'=>$rate,
	'qty'=>$qty,
	'amount'=>$amount,
	'discount'=>$discount,
	'discountamount'=>$discountamount,
	'taxableamount'=>$taxableamount,
	'sgst'=>$sgst,
	'sgstamount'=>$sgstamount,
	'cgst'=>$cgst,
	'cgstamount'=>$cgstamount,
	'igst'=>$igst,
	'igstamount'=>$igstamount,
	'total'=>$total,
	'subtotal' =>$_POST['subtotal'], 
	'freightamount'=>$freightamount,
	'freightcgst'=>$freightcgst,
	'freightcgstamount'=>$freightcgstamount,
	'freightsgst'=>$freightsgst,
	'freightsgstamount'=>$freightsgstamount,
	'freightigst'=>$freightigst,
	'freightigstamount'=>$freightigstamount,
	'freighttotal'=>$freighttotal,
	'loadingamount'=>$loadingamount,
	'loadingcgst'=>$loadingcgst,
	'loadingcgstamount'=>$loadingcgstamount,
	'loadingsgst'=>$loadingsgst,
	'loadingsgstamount'=>$loadingsgstamount,
	'loadingigst'=>$loadingigst,
	'loadingigstamount'=>$loadingigstamount,
	'loadingtotal'=>$loadingtotal,
	'roundOff' =>$roundOff,
	'othercharges' =>$othercharges,
	'discountBy' =>$hiddenDiscountBy,
	'return_status'=>implode('||',$ret),
	'grandtotal' =>$grandtotal, 
	'invoicenodate' =>$invoicenodate, 
	'invoicenoyear' =>$invoicenoyear, 
	'status'=>1,
	'edit_status'=>1);
	$this->db->where('id',$_POST['id']);
	$result=$this->db->update('cashbill_details',$data);
	if($result==true)
	{ 
		$invoiceid=$_POST['id'];
		$this->db->where('invoiceid',$_POST['id'])->delete('cashbill_reports');
		$sparename=$_POST['itemname'];
		$qty=$_POST['qty'];
		$hsnnos=$_POST['hsnno'];
		$sgsts=$_POST['sgst'];
		$cgsts=$_POST['cgst'];
		$igsts=$_POST['igst'];
		$count=count($sparename);
		for ($i=0; $i <  $count; $i++) 
		{ 
			$data=$this->db->where('itemname',$sparename[$i])->where('hsnno',$hsnnos[$i])->get('stock')->result();
			foreach($data as $v)
			{
				$bal=$v->balance;
			}

			if($data)
			{
				$this->db->where('itemname',$sparename[$i])->where('hsnno',$hsnnos[$i])->update('stock', array('date'=>date('Y-m-d'),'balance'=>$bal-$qty[$i]));
			}
		}


		$itemnames=$_POST['itemname'];
		$qtys=$_POST['qty'];
		$hsnnoss=$_POST['hsnno'];

		$count=count($sparename);
		for ($j=0; $j <  $count; $j++) 
		{
			$podatass=array(
			'systemDate'=>date('Y-m-d'),
			'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
			'invoiceno' =>$_POST['invoiceno'], 
			'customerId' => $_POST['customerid'],
			'customername' =>$_POST['customername'], 
			'address' =>nl2br($address,true), 
			'gsttype' =>$_POST['gsttype'],
			'itemname'=>$itemnames[$j],
			'rate'=>$_POST['rate'][$j],
			'qty'=>$qtys[$j],
			'total'=>$_POST['total'][$j],
			'hsnno'=>$hsnnoss[$j],
			'subtotal' =>$_POST['subtotal'], 
			'grandtotal' =>$_POST['grandtotal'], 
			'invoicenodate' =>$invoicenodate, 
			'invoicenoyear' =>$invoicenoyear,
			'invoiceid' =>$invoiceid,
			'status'=>1);
			$this->db->insert('cashbill_reports',$podatass);
		}

		$this->session->set_flashdata('msg','Cash Bill Update Successfully');

		if($_POST['save']=='save')
		{
			redirect('cashbill/listing');
		}
		else
		{
			redirect('cashbill/printInvoice');
		}
	}
	else
	{
	$this->session->set_flashdata('msg1','Cash Bill Update Unsuccessfully');
	redirect('cashbill/listing');
	}

}

	public function delete()
	{
		$del=base64_decode($this->input->post('id'));
		$getdetails=$this->db->where('id',$del)->get('cashbill_details')->result();
		if($getdetails)
		{
			foreach($getdetails as $row)
			{
				$customer_details=$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('id',$row->customerId)->get('customer_details')->result();
				foreach($customer_details as $c)
					$updates=0;//$c->balanceamount-$row->grandtotal;
					$salesamt = $c->salesamount-$row->grandtotal;
					$paidamt = $c->paidamount-$row->grandtotal;
					$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('id',$row->customerId)->update('customer_details',array('balanceamount'=>$updates,'salesamount'=>$salesamt,'paidamount'=>$paidamt));
					
				$itemname =explode('||',$row->itemname);
				$rate =explode('||',$row->rate);
				$qty =explode('||',$row->qty);
				$hsnno =explode('||',$row->hsnno);
				$invcount=count($itemname);
				for ($j=0; $j < $invcount; $j++)
				{ 
					$invwq=$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('stock')->result();
					if($invwq)
					{ 
						foreach($invwq as $w)
							@$old=$w->balance;  
							$qty[$j];
							@$bal=$old+$qty[$j];
						
						$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('stock',array('balance'=>$bal)); 
					}
				} 
			}
		}
		
	
		$data=$this->db->where('id',$del)->delete('cashbill_details');
		if($data)
		{
			$this->db->where('invoiceid',$del)->delete('cashbill_reports');
			echo'yes';
		}
		else
		{
			echo'no';   
		}
	} 

   public function pending_view()
    {
        $data['pending']=$this->cashbill_model->pending();
        $this->load->view('header');
        $this->load->view('pending_view',$data);
        $this->load->view('footer1');
    }


public function pending()
{

  $data['pending']=$this->cashbill_model->pending_select();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function pending_search()
{
  $data['pending']=$this->cashbill_model->search_reports();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function purchase_reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->cashbill_model->search_pending();

    // echo"<pre>";
    // print_r($data);
  $this->load->view('purchase_reports',$data,$fromdate,$todate,$suppliername);

}

public function reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->cashbill_model->search_reports();

  
  $this->load->view('purchase_reports2',$data,$fromdate,$todate);

}


public function reports1()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->cashbill_model->search_pending();

  
  $this->load->view('purchase_reports1',$data,$fromdate,$todate);

}

	public function getcustomer()
	{
		$name=$_POST['name'];
		$data=$this->db->where('name',$name)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->result();
		echo $count=count($data);
	}
	public function getcustomer_edit()
	{
		$name=$_POST['name'];
		$oldname = $_POST['oldName'];
		if($name==$oldname)
		{
			echo 0;
		}
		else
		{
			$data=$this->db->where('name',$name)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->result();
			echo $count=count($data);
		}
	}

public function check_hsnno()
{
 $name=$_POST['name'];
 $data=$this->db->where('hsnno',$name)->get('additem')->result();

 echo $count=count($data);

}

public function gets()
{
  $name=$_POST['name'];
  $data=$this->db->where('itemname',$name)->get('additem')->result();
  echo $count=count($data);

}


public function printInvoice()
  {
    $data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('cashbill_details')->result();
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
    $data['time']=date('h:i:s A');
    $this->load->view('salesbill',$data);
    // $this->load->view('cashbill_add_print',$data);
    //$this->load->view('invoicebill',$data);
// $this->load->view('invoice_bill',$data);
  }

  public function printBill()
  {
    $id=base64_decode($this->uri->segment(3));
  // $this->load->library('mpdf'); 
    $data['pre']=$this->db->where('id',$id)->get('cashbill_details')->result();

    foreach($data['pre'] as $b)
    {
      $number= $b->grandtotal;
    }
    $no = round($number);
    $point = round($number - $no, 2) * 100;
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
    $data['profile']=$this->db->get('profile')->result();
    $data['invoice']=$this->db->where('id',$id)->get('cashbill_details')->result();
    $this->load->view('salesbill',$data);
    // $this->load->view('cashbill_add_print',$data);
  }

  public function search()
  { 

    $fromdate=$this->input->post('fromdate');
    $todate=$this->input->post('todate');
    $cusname=$this->input->post('cusname');
    $invoiceno=$this->input->post('invoiceno');
    $gsttype=$this->input->post('gsttype');

    $data=array(
      'rcbio_fromdate' => $fromdate,
      'rcbio_todate' => $todate,
      'rcbio_cusname' => $cusname,
      'rcbio_invoiceno' => $invoiceno,
      'rcbio_gsttype' => $gsttype,
      'rcbio_bill_format' =>'Print',
      );

    $this->session->set_userdata($data);

  }


	public function search_reports()
	{   
		$bill_format=$this->session->userdata('rcbio_bill_format');                
		if($bill_format=='Print')
		{
			$data['invoice']=$this->cashbill_model->search_billing();
			$data['fromdate']=$this->session->userdata('rcbio_fromdate');
			$data['todate']=$this->session->userdata('rcbio_todate');
			$data['cusname']=$this->session->userdata('rcbio_cusname');
			$data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
			$data['gsttype']=$this->session->userdata('rcbio_gsttype');
			$this->load->view('cashbill_printall',$data);
		}
	}


public function get_stockqty()
{
  $itemcode=$this->input->post('name');
  $this->db->select('*');
  $this->db->from('stock');
  $this->db->where('itemname',$itemcode);
  $query = $this->db->get();  
  $result = $query->result();

  foreach($result as $h)
  {   

    $vob['balance']=$h->balance;

  }
  echo json_encode($vob);
}


Public function get_dcno()
  {
    $cusname=$_POST['id'];
   $query=$this->db->where('status',1)->where('cusname',$cusname)->where('balanceqty >',0)->group_by('dcno')->get('dc_delivery');
    $result= $query->result();
    $data=array();
    foreach($result as $r)
    {
      $data['value']=$r->dcno;
      $data['label']=$r->dcno;
      $json[]=$data;


    }
    echo json_encode($json);


  }

	public function getdc_details()
	{
		$invoicetype=$this->input->post('invoicetype');
		$gsttype=$this->input->post('gsttype');
		$data['gsttype']=$gsttype;
		if($invoicetype=='Against DC')
		{
			$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select DC No</span></div>';
			echo $html; 
		}
		else
		{
			$this->load->view('directinvoice',$data);
		}
	}

	public function getdcdetails()
	{
		$dcno=$this->input->post('dcno');
		$gsttype=$this->input->post('gsttype');
		if($dcno=='')
		{
			$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select DC No</span></div>';
			echo $html; 
		}
		else
		{
			$data['dcno']=$dcno;
			$data['gsttype']=$gsttype;
			$this->load->view('againstdc',$data);
		}
	}
  
}

ob_flush();
?>