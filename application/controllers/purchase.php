<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Purchase extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('purchase_model');
    if($this->session->userdata('rcbio_login')=='')
    {

      $this->session->set_flashdata('msg','Please Login to continue!');
      redirect('login');
    } 
    date_default_timezone_set('Asia/Kolkata');    
  }

  public function index()
  {
    
$mysqli = new mysqli("localhost", "root", "", "shanmuga_vilas");
$query_update1 =$mysqli->query("SELECT * FROM purchase_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
    while($row = mysqli_fetch_array($query_update1))

    {
      @$quotationnos=$row['purchaseno'];
    }
    if(date('m')=='04')
    {

      $month=date('m');
      $year=date('Y');
      $old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->where('status',1)->get('purchase_details')->result_array();
      if($old)
      {
        @$bond_no = $quotationnos;

        if(is_null($bond_no))
        {
			$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
			$new_bond_noo = 'P'.$default_bond->purchase;
          //$new_bond_noo = 'P00001'; 
        } 
        else 
        {
			$default_bond=$this->db->where('id',1)->where('purchase !=','')->get('preference_settings')->row();
			if($default_bond)
			{
				$bond_no='P'.$default_bond->purchase;
				$bondLen = strlen($bond_no)-1;
				$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
				$new_bond_noo = 'P'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
			}
			else
			{
				$bondLen = strlen($bond_no)-1;
				$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
				$new_bond_noo = 'P'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
			}
          /*$old_bond_noo = str_split($bond_no,2);
          @$va = (string)($old_bond_noo[1].$old_bond_noo[2].$old_bond_noo[3])+1;  
          $bond_length = strlen($va);
          if($bond_length == 1)
          {
            $new_bond_noo = 'P0000'.$va;  
          } 
          else if($bond_length == 2)
          {  
            $new_bond_noo = 'P000'.$va; 
          }
          else if($bond_length == 3)
          {  
            $new_bond_noo = 'P00'.$va; 
          }
          else if($bond_length == 4)
          {  
            $new_bond_noo = 'P0'.$va; 
          }
          else if($bond_length == 5)
          {  
            $new_bond_noo = 'P'.$va; 
          }*/
        }
      }
      else
      {
		  $default_bond=$this->db->where('id',1)->get('preference_settings')->row();
		  $new_bond_noo = 'P'.$default_bond->purchase;
        //$new_bond_noo = 'P00001';
      }
    }
    else
    {
      @$bond_no = $quotationnos;
      if(is_null($bond_no))
      {
		  $default_bond=$this->db->where('id',1)->get('preference_settings')->row();
			$new_bond_noo = 'P'.$default_bond->purchase;
        //$new_bond_noo = 'P00001'; 
      } 
      else
      {
			$default_bond=$this->db->where('id',1)->where('purchase !=','')->get('preference_settings')->row();
			if($default_bond)
			{
				@$bond_no='P'.$default_bond->purchase;
				$bondLen = strlen($bond_no)-1;
				$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
				$new_bond_noo = 'P'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
			}
			else
			{
				$bondLen = strlen($bond_no)-1;
				$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
				@$new_bond_noo = 'P'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
			}
        /*$old_bond_noo = str_split($bond_no,2);
        @$va = (string)($old_bond_noo[1].$old_bond_noo[2].$old_bond_noo[3])+1;  
        $bond_length = strlen($va);
        if($bond_length == 1)
        {
          $new_bond_noo = 'P0000'.$va;  
        } 
        else if($bond_length == 2)
        {  
          $new_bond_noo = 'P000'.$va; 
        }

        else if($bond_length == 3)
        {  
          $new_bond_noo = 'P00'.$va; 
        }
        else if($bond_length == 4)
        {  
          $new_bond_noo = 'P0'.$va; 
        }
        else if($bond_length == 5)
        {  
          $new_bond_noo = 'P'.$va; 
        }*/
      }
    }
    
    $data['invoiceno']=$new_bond_noo;
    $this->load->view('header');
    $this->load->view('add_purchase',$data);
    $this->load->view('footer');
  }

	public function insert()
	{
		// print_r($_POST);
		// exit;
	      $mysqli = new mysqli("localhost", "root", "", "shanmuga_vilas");  
$query_update1 =$mysqli->query("SELECT * FROM purchase_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
while($row = mysqli_fetch_array($query_update1))

{
@$quotationnos=$row['purchaseno'];
}
if(date('m')=='04')
{

$month=date('m');
$year=date('Y');
$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->where('status',1)->get('purchase_details')->result_array();
if($old)
{
@$bond_no = $quotationnos;

if(is_null($bond_no))
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_noo = 'P'.$default_bond->purchase;
//$new_bond_noo = 'P00001'; 
} 
else 
{
$default_bond=$this->db->where('id',1)->where('purchase !=','')->get('preference_settings')->row();
if($default_bond)
{
$bond_no='P'.$default_bond->purchase;
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'P'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
}
else
{
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'P'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
}

}
}
else
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_noo = 'P'.$default_bond->purchase;
//$new_bond_noo = 'P00001';
}
}
else
{
@$bond_no = $quotationnos;
if(is_null($bond_no))
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_noo = 'P'.$default_bond->purchase;
//$new_bond_noo = 'P00001'; 
} 
else
{
$default_bond=$this->db->where('id',1)->where('purchase !=','')->get('preference_settings')->row();
if($default_bond)
{
@$bond_no='P'.$default_bond->purchase;
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'P'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
}
else
{
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'P'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
}

}
}

$invoiceno=$new_bond_noo;

		$grandtotal = $_POST['grandtotal'];
		$customerid = $_POST['supplierid'];
		$data1=$this->db->where('id',$customerid)->get('customer_details')->result_array();
		foreach ($data1 as $a) 
		{
			$openingbalance=$a['openingbal'];
			$balance=$a['balanceamount'];
			$salesamounts=$a['salesamount'];  
			$paidamounts=$a['paidamount'];  
		}

		if($balance)
		{
			$balanceamount=$balance + $grandtotal;
		}
		else
		{
			$balanceamount=($openingbalance+$grandtotal)-$paidamounts;
		}
		if($salesamounts=='')
		{
			$salesamount=$grandtotal;
		}
		else
		{
			$salesamount=$salesamounts+$grandtotal;
		}


		$datass = array('salesamount'=>$salesamount,'balanceamount'=>$balanceamount);
		$this->db->where('id',$customerid)->update('customer_details',$datass);

		//$hsnno=implode('||',$_POST['hsnno']);
		$itemname=implode('||',$_POST['itemname']);
		$qty=implode('||',$_POST['qty']);
		$uom=implode('||',$_POST['uom']);
		$rate=implode('||',$_POST['rate']);
		$amount=implode('||',$_POST['amount']);
		@$discount=implode('||',$_POST['discount']);
		@$discountamount=implode('||',$_POST['discountamount']);
		// $taxableamount=implode('||',$_POST['taxableamount']);
		// $cgst=implode('||',$_POST['cgst']);
		// $cgstamount=implode('||',$_POST['cgstamount']);
		// $sgst=implode('||',$_POST['sgst']);
		// $sgstamount=implode('||',$_POST['sgstamount']);
		// $igst=implode('||',$_POST['igst']);
		// $igstamount=implode('||',$_POST['igstamount']);
		$total=implode('||',$_POST['total']);
		$subtotal=$this->input->post('subtotal');
		// $freightamount=$this->input->post('freightamount');
		// $freightcgst=$this->input->post('freightcgst');
		// $freightcgstamount=$this->input->post('freightcgstamount');
		// $freightsgst=$this->input->post('freightsgst');
		// $freightsgstamount=$this->input->post('freightsgstamount');
		// $freightigst=$this->input->post('freightigst');
		// $freightigstamount=$this->input->post('freightigstamount');
		// $freighttotal=$this->input->post('freighttotal');
		// $loadingamount=$this->input->post('loadingamount');
		// $loadingcgst=$this->input->post('loadingcgst');
		// $loadingcgstamount=$this->input->post('loadingcgstamount');
		// $loadingsgst=$this->input->post('loadingsgst');
		// $loadingsgstamount=$this->input->post('loadingsgstamount');
		// $loadingigst=$this->input->post('loadingigst');
		// $loadingigstamount=$this->input->post('loadingigstamount');
		// $loadingtotal=$this->input->post('loadingtotal');
		$othercharges=$this->input->post('othercharges');
		$hiddenDiscountBy=$this->input->post('hiddenDiscountBy');
		$roundOff=$this->input->post('roundOff');
		$grandtotal=$this->input->post('grandtotal');
		$purchasenoyear=$_POST['purchaseno'].''.date('-Y').'';
		$purchasenodate=$_POST['purchaseno'].''.date('dmy').'';


		//$pcode=$_POST['hsnno'];
		//$count7=count($pcode);
		// for ($i=0; $i < $count7; $i++) 
		// {
		// 	$res[]="0";
		// 	$ret[]="1";
		// }

		// $billtype=$_POST['gsttype'];
		// if($billtype=='intrastate')
		// {
		// 	$sgst = implode('||',$_POST['sgst']);
		// 	$cgst = implode('||',$_POST['cgst']);
		// 	$igst = implode('||',$_POST['igst']);
		// 	//$igst = implode('||',$res);
		// 	$sgstamount = implode('||',$_POST['sgstamount']);
		// 	$cgstamount = implode('||',$_POST['cgstamount']);
		// 	$igstamount = implode('||',$_POST['igstamount']);
		// 	//$igstamount = implode('||',$res);
		// 	$sgsts='sgst';
		// 	$cgsts='cgst';
		// 	$igsts='';
		// }

		// if($billtype=='interstate')
		// {
		// 	//$sgst =implode('||',$res);
		// 	//$cgst = implode('||',$res);
		// 	$sgst = implode('||',$_POST['sgst']);
		// 	$cgst = implode('||',$_POST['cgst']);
		// 	$igst = implode('||',$_POST['igst']);
		// 	//$sgstamount = implode('||',$res);
		// 	//$cgstamount = implode('||',$res);
		// 	$sgstamount = implode('||',$_POST['sgstamount']);
		// 	$cgstamount = implode('||',$_POST['cgstamount']);
		// 	$igstamount = implode('||',$_POST['igstamount']);
		// 	$igsts='igst';
		// 	$sgsts='';
		// 	$cgsts='';
		// }


		$data=array(
		'date'=>date('Y-m-d'),
		'purchasedate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
		'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
		'purchaseno' =>$invoiceno, 
		'supplierId' => $customerid,
		'suppliername' =>$_POST['suppliername'], 
		'address' =>$_POST['address'], 
		'invoiceno' =>$_POST['invoiceno'], 
		'grandtotal' =>$_POST['grandtotal'], 
		// 'billtype' =>$_POST['gsttype'], 
		// 'gsttype' =>$_POST['gsttype'], 
		// 'typesgst'=>$sgsts,
		// 'typecgst'=>$cgsts,
		// 'typeigst'=>$igsts,
		// 'hsnno'=>$hsnno,
		'itemname'=>$itemname,
		'uom'=>$uom,
		'rate'=>$rate,
		'qty'=>$qty,
		'amount'=>$amount,
		'discount'=>$discount,
		'discountamount'=>$discountamount,
		// 'taxableamount'=>$taxableamount,
		// 'sgst'=>$sgst,
		// 'sgstamount'=>$sgstamount,
		// 'cgst'=>$cgst,
		// 'cgstamount'=>$cgstamount,
		// 'igst'=>$igst,
		// 'igstamount'=>$igstamount,
		'total'=>$total,
		'subtotal' =>$_POST['subtotal'], 
		// 'freightamount'=>$freightamount,
		// 'freightcgst'=>$freightcgst,
		// 'freightcgstamount'=>$freightcgstamount,
		// 'freightsgst'=>$freightsgst,
		// 'freightsgstamount'=>$freightsgstamount,
		// 'freightigst'=>$freightigst,
		// 'freightigstamount'=>$freightigstamount,
		// 'freighttotal'=>$freighttotal,
		// 'loadingamount'=>$loadingamount,
		// 'loadingcgst'=>$loadingcgst,
		// 'loadingcgstamount'=>$loadingcgstamount,
		// 'loadingsgst'=>$loadingsgst,
		// 'loadingsgstamount'=>$loadingsgstamount,
		// 'loadingigst'=>$loadingigst,
		// 'loadingigstamount'=>$loadingigstamount,
		// 'loadingtotal'=>$loadingtotal,
		'roundOff' =>$roundOff,
		'othercharges' =>$othercharges,
		'discountBy' =>$hiddenDiscountBy,
		// 
		'status'=>1,
		'edit_status'=>1);
		$result=$this->db->insert('purchase_details',$data);
		if($result==true)
		{ 
			
			$purchaseid = $this->db->insert_id();
			$this->db->query("UPDATE preference_settings SET purchase='' WHERE id=1");
			$sparename=$_POST['itemname'];
			$qty=$_POST['qty'];
			// $hsnnos=$_POST['hsnno'];
			// $sgsts=$_POST['sgst'];
			// $cgsts=$_POST['cgst'];
			// $igsts=$_POST['igst'];
			// $priceTypes=$_POST['priceType'];
			$rates=$_POST['rate'];
			$count=count($sparename);

			for ($i=0; $i <  $count; $i++) 
			{ 
				$data=$this->db->where('itemname',$sparename[$i])->get('stock')->result();
				foreach($data as $v)
				{
					$bal=$v->balance;
				}
				if($data)
				{
					$this->db->where('itemname',$sparename[$i])->update('stock',
					array(
					'updatestock'=>$qty[$i],
					'stockdate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
					'quantity'=>$qty[$i],
					//'hsnno' =>$hsnnos[$i],
					// 'sgst' =>$sgsts[$i],
					// 'cgst' =>$cgsts[$i],
					// 'igst' =>$igsts[$i],
					'date'=>date('Y-m-d'),
					'balance'=>$bal+$qty[$i]
					));

					$this->db->insert('stock_reports',
					array( 
					//'hsnno' =>$hsnnos[$i],
					'date' =>date('Y-m-d'),
					'itemname' =>$sparename[$i], 
					'purchaseid' =>$purchaseid, 
					'updatestock' =>$qty[$i],

					//'priceType'	=> $priceTypes[$i]
				));        
				}
				else
				{
					$this->db->insert('stock',
					array( 
					//'hsnno' =>$hsnnos[$i],
					'stockdate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
					'date' =>date('Y-m-d'),
					'itemname' =>$sparename[$i],
					// 'sgst' =>$sgsts[$i],
					// 'cgst' =>$cgsts[$i],
					// 'igst' =>$igsts[$i],
					'quantity'=>$qty[$i],
					'rate'	=> $rates[$i],
					//'priceType'	=> $priceTypes[$i],
					'updatestock' =>$qty[$i], 
					'balance' =>$_POST['qty'][$i])); 

					$this->db->insert('stock_reports',
					array(
					'stockdate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
					'purchaseid' =>$purchaseid, 
					'date' =>date('Y-m-d'),
					'itemname' =>$sparename[$i],
					//'hsnno' =>$hsnnos[$i],
					'updatestock' =>$qty[$i],
					'priceType'	=> $priceTypes[$i]));        
				}

			}


			$itemnames=$_POST['itemname'];
			$qtys=$_POST['qty'];
			$hsnnoss=$_POST['hsnno'];

			$count=count($sparename);



			for ($j=0; $j <  $count; $j++) 
			{
				$podatass=array(
				'date'=>date('Y-m-d'),
				'purchasedate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
				'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
				'purchaseno' =>$_POST['purchaseno'], 
				'supplierId' => $customerid,
				'suppliername' =>$_POST['suppliername'], 
				'invoiceno' =>$_POST['invoiceno'], 
				'itemname'=>$itemnames[$j],
				'rate'=>$rate[$j],
				'qty'=>$qty[$j],
				'total'=>$total[$j],
				'hsnno'=>$hsnnoss[$j],
				'address' =>$_POST['address'],  
				'subtotal' =>$_POST['subtotal'], 
				'grandtotal' =>$_POST['grandtotal'], 
				'purchasenodate' =>$purchasenodate, 
				'purchasenoyear' =>$purchasenoyear,
				'purchaseid' =>$purchaseid,
				'status'=>1);
				$this->db->insert('purchase_reports',$podatass);
			}






			@$receiptno='-';
			@$paymentdetails='-';
			@$paymentmodes='-';
			@$throughchecks='-';
			@$banktransfers='-';
			@$chamounts='-';
			@$bankamounts='-';
			@$purpose='-';
			@$amount='-';
			@$chequeno='-';


			$dd=array(
			'date'=>date('Y-m-d',strtotime($_POST['invoicedate'])),
			'receiptno'=>$receiptno,
			'purchaseno'=>$_POST['purchaseno'],
			'supplierId' => $customerid,
			'suppliername'=>$_POST['suppliername'],
			'payment'=>$paymentdetails, 
			'purchasedate'=>date('Y-m-d',strtotime($_POST['purchasedate'])),
			'itemname'=>$itemname, 
			'amount'=>$total, 
			'purpose'=>$purpose,
			'chamount'=>$chamounts,
			'banktransfer'=>$banktransfers,
			'bankamount'=>$bankamounts, 
			'chequeno'=>$chequeno, 
			'throughcheck'=>$throughchecks, 
			'paymentdetails'=>$paymentdetails,
			'total'=>$_POST['grandtotal'],
			'paid'=>$pay,
			'paidamount'=>$paymentdetails,
			'currentpaid'=>$paymentdetails,
			'receiptamt'=>$paymentdetails,
			'balance'=>$balanceamount,
			'purchaseamt'=>$_POST['grandtotal'],
			'invoiceno' =>$_POST['invoiceno'],
			'purchasenodate' =>$purchasenodate, 
			'purchasenoyear' =>$purchasenoyear,
			'purchaseid' =>$purchaseid, 
			'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
			'status'=>1);

			$this->db->insert('po_party_statements',$dd);
			$this->session->set_flashdata('msg','Purchase Added Successfully');
			redirect('purchase');
		}
		else
		{
		$this->session->set_flashdata('msg1','Purchase Added Unsuccessfully');
		redirect('purchase');
		}

	}

	public function view()
	{
		$data['purchase']=$this->purchase_model->select();
		$data['vat']=$this->db->get('vat_details')->result_array(); 
		$this->load->view('header');
		$this->load->view('purchase_view',$data);
		$this->load->view('footer1');
	}

	public function views()
	{
		$id=base64_decode($this->uri->segment(3));
		$data['result']=$this->db->where('id',$id)->get('purchase_details')->result_array(); 
		$this->load->view('header');
		$this->load->view('view_purchase',$data);
		$this->load->view('footer');
	}


	public function ajax_list()
	{
		$list = $this->purchase_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i=1;
		foreach ($list as $person) {
			$startTimeStamp = strtotime($person->invoicedate);
			$endTimeStamp = strtotime(date('Y-m-d'));
			$timeDiff = abs($endTimeStamp - $startTimeStamp);
			$numberDays = $timeDiff/86400;  // 86400 seconds in one day
			$numberDays = intval($numberDays);

			$no++;
			$row = array();
			$row[] = $i++;
			$row[] =date('d-m-Y',strtotime($person->invoicedate));
			$row[] = $person->purchaseno;
			$row[] = $person->invoiceno;
			$row[] = $person->suppliername;
			//$row[] = $numberDays.' Days';
			$row[] = $person->grandtotal;
			$code=base64_encode($person->id);
			//add html for action
			$return_status=explode("||",$person->return_status);
			// if(in_array(0,$return_status))
			// {
			// 	$deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:alert(\'Sorry! You cannot able to delete!\');" title="Hapus" >Delete</a>';
				
			// }
			// else
			// {
			 	$deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$code."'".')">Delete</a>';
			// }
			if($person->edit_status=='0')
			{
				$row[] = '
				<div class="btn-group">
				<button type="button" class="btn
				btn-info dropdown-toggle waves-effect waves-light"
				data-toggle="dropdown" aria-expanded="false">Manage <span
				class="caret"></span></button>
				<ul class="dropdown-menu"
				role="menu" style="background: #23BDCF none repeat scroll
				0% 0%;width:14px;min-width: 100%;">


				<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchase/views/'.$code).'" title="View" >View</a></li>
				<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchase/edit/'.$code).'" title="Edit" >Edit</a></li>
				
				<li>'.$deleteOptn.'</li>
				</ul>
				</div>

				'; 
			}

			else
			{

			$row[] = '


			<div class="btn-group">
			<button type="button" class="btn
			btn-info dropdown-toggle waves-effect waves-light"
			data-toggle="dropdown" aria-expanded="false">Manage <span
			class="caret"></span></button>
			<ul class="dropdown-menu"
			role="menu" style="background: #23BDCF none repeat scroll
			0% 0%;width:14px;min-width: 100%;">


			<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchase/views/'.$code).'" title="View" >View</a></li>



			<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchase/edit/'.$code).'" title="Edit" >Edit</a></li>

			<li>'.$deleteOptn.'</li>
			</ul>
			</div>

			';
			}

			$data[] = $row;
		}

		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->purchase_model->count_all(),
		"recordsFiltered" => $this->purchase_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}



	public function ajax_delete($id)
	{
	  $this->purchase_model->delete_by_id($id);
	  echo json_encode(array("status" => TRUE));
	}


public function autocomplete_customername()
{
  $orderno=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('customer_details');
  $this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
  $this->db->like('name',$orderno);
  $query = $this->db->get();
  $result = $query->result();
  $name       =  array();
  foreach ($result as $d){
    $json_array             = array();
    $json_array['label']    = $d->name;
    $json_array['value']    = $d->name;
    $json_array['address']    = $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
    $json_array['supplierid'] = $d->id;
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
    $vob['sgst']=$h->sgst;
    $vob['cgst']=$h->cgst;
    $vob['igst']=$h->igst;
    $vob['uom']=$uom;

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
  $data['result']=$this->db->where('id',$id)->get('purchase_details')->result_array(); 
  // echo"<prE>";
  // print_r($data['result']);
  $this->load->view('header');
  $this->load->view('purchase_edit',$data);
  $this->load->view('footer');

}

public function getsupplier()
{
  $name=$_POST['name'];
  $data=$this->db->where('name',$name)->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->get('customer_details')->result();
  echo $count=count($data);

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
public function autocomplete_invoiceno1()
{
  $name=$this->input->post('keyword');
  $this->db->select('*');
  $this->db->from('purchase_details');
  $this->db->like('invoiceno',$name);
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




  // public function edit()
  // {


  //       $data['vat']=$this->db->get('vat_details')->result_array(); 

  //   $id=base64_decode($this->uri->segment(3));

  //     $data['edit']=$this->purchase_model->invoice_edit($id);
  //     $this->load->view('header');
  //     $this->load->view('edit_invoice',$data);
  //        $this->load->view('footer');


  // }

	public function update()
	{
		
		$id=$this->input->post('id');
		$getpurchase=$this->db->where('id',$id)->get('purchase_details')->result();
		foreach($getpurchase as $getp)
		$grandtotals=$getp->grandtotal;  

		$ite=explode('||',$getp->itemname);
		$qtyss=explode('||',$getp->qty);
		$hsnnos=explode('||',$getp->hsnno);
		/*$updatableitemName = $_POST['itemname'];
		$updatableitemNo = $_POST['hsnno'];
		$updatableQty = $_POST['hsnno'];
		print_r($updatableitemName);
		echo '<hr>';
		print_r($updatableitemNo);
		exit;
		Array ( [0] => let us c [1] => Let Us C++ )
		Array ( [0] => 0001 [1] => 0002 )*/
		//
		
		$count=count($ite);
		for ($i=0; $i < $count; $i++) 
		{ 
			$stock=$this->db->where('itemname',$ite[$i])->where('hsnno',$hsnnos[$i])->get('stock')->result_array();
			foreach ($stock as $s) 
			{
				$ite[$i];
				$cur=$s['balance']; 
				$tot=$cur-$qtyss[$i]; 
				$this->db->where('itemname',$ite[$i])->where('hsnno',$hsnnos[$i])->update('stock',array('balance'=>$tot));   
			}
		}
		//$grandtotal = $_POST['grandtotal'];
		
		$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')");
		$data1=$this->db->where('name',$_POST['suppliername'])->get('customer_details')->result_array();
		foreach ($data1 as $a) 
		{
			$openingbalance=$a['openingbal'];
			$balance=$a['balanceamount'];
			$salesamounts=$a['salesamount'];  
		} 

		if($balance)
		{
			$balanceamount=$balance -$grandtotals;
		}
		else
		{
			$balanceamount='0.00';
		}
		$this->db->where('id',$a['id'])->update('customer_details',array('balanceamount'=>$balanceamount));
		$data11=$this->db->where('id',$a['id'])->get('customer_details')->result_array();
		$grandtotal = $_POST['grandtotal'];

		foreach ($data11 as $a1) 
		{
			$openingbalance=$a1['openingbal'];
			$balance=$a1['balanceamount'];
			$salesamounts=$a1['salesamount'];  
		}


		if($balance)
		{
			$balanceamount=$balance + $grandtotal;
		}
		else
		{
			$balanceamount=$openingbalance+$grandtotal;
		}
		if($salesamounts=='')
		{
			$salesamount=$grandtotal;
		}
		else
		{
			$salesamount=$salesamounts+$grandtotal;
		}
		$datass = array('salesamount'=>$salesamount,'balanceamount'=>$balanceamount);
		$this->db->where('id',$a1['id'])->update('customer_details',$datass);



		$hsnno=implode('||',$_POST['hsnno']);
		$itemname=implode('||',$this->db->escape_str($_POST['itemname']));
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
		@$igst=implode('||',$_POST['igst']);
		@$igstamount=implode('||',$_POST['igstamount']);
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
			$igst = implode('||',$_POST['igst']);
			//$igst = implode('||',$res);
			$sgstamount = implode('||',$_POST['sgstamount']);
			$cgstamount = implode('||',$_POST['cgstamount']);
			$igstamount = implode('||',$_POST['igstamount']);
			//$igstamount = implode('||',$res);
			$sgsts='sgst';
			$cgsts='cgst';
			$igsts='';
		}
		if($billtype=='interstate')
		{
			//$sgst =implode('||',$res);
			//$cgst = implode('||',$res);
			$sgst = implode('||',$_POST['sgst']);
			$cgst = implode('||',$_POST['cgst']);
			$igst = implode('||',$_POST['igst']);
			//$sgstamount = implode('||',$res);
			//$cgstamount = implode('||',$res);
			$sgstamount = implode('||',$_POST['sgstamount']);
			$cgstamount = implode('||',$_POST['cgstamount']);
			$igstamount = implode('||',$_POST['igstamount']);
			$igsts='igst';
			$sgsts='';
			$cgsts='';
		}

		$data=array(
		'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
		'suppliername' =>$_POST['suppliername'], 
		'address' =>$_POST['address'], 
		'invoiceno' =>$_POST['invoiceno'], 
		'billtype' =>$_POST['gsttype'], 
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
		'edit_status'=>1
		);
		$this->db->where('id',$id);
		$result=$this->db->update('purchase_details',$data);
		// $results=$this->purchase_model->update_invoice($data,$id);
		if($result)
		{


		$this->db->where('purchaseid',$id)->delete('purchase_collection');
		$this->db->where('purchaseid',$id)->delete('po_party_statements');//ok
		$this->db->where('purchaseid',$id)->delete('purchase_reports');
		$this->db->where('purchaseid',$id)->delete('stock_reports');
		//UPDATING STOCK INTO STOCK TABLE AND STOCK_REPORT TABLE
		$purchaseid = $_POST['id'];
		$sparename=$_POST['itemname'];
		$qty=$_POST['qty'];
		$pocode=$_POST['hsnno'];
		$sgsts=$_POST['sgst'];
		$cgsts=$_POST['cgst'];
		$igsts=$_POST['igst'];
		$priceTypes=$_POST['priceType'];
		$rates=$_POST['rate'];
		$count=count($sparename);
		for ($i=0; $i <  $count; $i++) 
		{ 
			@$dt=$this->db->where('itemname',$sparename[$i])->where('hsnno',$pocode[$i])->get('stock')->result();
			foreach($dt as $v)
			{
				$bal=$v->balance;
			}
			if($dt)
			{ 
				$this->db->where('itemname',$sparename[$i])->where('hsnno',$pocode[$i])->update('stock',array('updatestock'=>$qty[$i],'hsnno'=>$pocode[$i],'date'=>date('Y-m-d'),'balance'=>$bal+$qty[$i]));
			}
			else
			{
				$this->db->insert('stock',
				array( 
				'hsnno' =>$pocode[$i],
				'stockdate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
				'date' =>date('Y-m-d'),
				'itemname' =>$sparename[$i],
				'sgst' =>$sgsts[$i],
				'cgst' =>$cgsts[$i],
				'igst' =>$igsts[$i],
				'quantity'=>$qty[$i],
				'rate'	=> $rates[$i],
				'priceType'	=> $priceTypes[$i],
				'updatestock' =>$qty[$i], 
				'balance' =>$qty[$i])
				); 
			}
			$this->db->insert('stock_reports',
			array(
			'stockdate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
			'purchaseid' =>$purchaseid, 
			'date' =>date('Y-m-d'),
			'itemname' =>$sparename[$i],
			'hsnno' =>$pocode[$i],
			'updatestock' =>$qty[$i],
			'priceType'	=> $priceTypes[$i])
			);

		}




		$itemnames=$_POST['itemname'];
		$qtys=$_POST['qty'];
		$hsnnoss=$_POST['hsnno'];
		$postItemName = $_POST['itemname'];
		$count=count($postItemName);

		for ($j=0; $j <  $count; $j++) 
		{

			$podatass=array(
			'date'=>date('Y-m-d'),
			'purchasedate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
			'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
			'purchaseno' =>$_POST['purchaseno'], 
			'suppliername' =>$_POST['suppliername'], 
			'invoiceno' =>$_POST['invoiceno'], 
			'itemname'=>$postItemName[$j],
			'rate'=>$rate[$j],
			'qty'=>$qty[$j],
			'total'=>$total[$j],
			'hsnno'=>$hsnnoss[$j],
			'address' =>$_POST['address'],  
			'subtotal' =>$_POST['subtotal'], 
			'grandtotal' =>$_POST['grandtotal'], 
			'purchasenodate' =>$purchasenodate, 
			'purchasenoyear' =>$purchasenoyear,
			'purchaseid' =>$purchaseid,
			'status'=>1);
			$this->db->insert('purchase_reports',$podatass);
		}






		@$receiptno='-';
		@$paymentdetails='-';
		@$paymentmodes='-';
		@$throughchecks='-';
		@$banktransfers='-';
		@$chamounts='-';
		@$bankamounts='-';
		@$purpose='-';
		@$amount='-';
		@$chequeno='-';


		$dd=array(
		'date'=>date('Y-m-d',strtotime($_POST['invoicedate'])),
		'receiptno'=>$receiptno,
		'purchaseno'=>$_POST['purchaseno'],
		'suppliername'=>$_POST['suppliername'],
		'payment'=>$paymentdetails, 
		'purchasedate'=>date('Y-m-d',strtotime($_POST['purchasedate'])),
		'itemname'=>$itemname, 
		'amount'=>$total, 
		'purpose'=>$purpose,
		'chamount'=>$chamounts,
		'banktransfer'=>$banktransfers,
		'bankamount'=>$bankamounts, 
		'chequeno'=>$chequeno, 
		'throughcheck'=>$throughchecks, 
		'paymentdetails'=>$paymentdetails,
		'total'=>$_POST['grandtotal'],
		'paid'=>$pay,
		'paidamount'=>$paymentdetails,
		'currentpaid'=>$paymentdetails,
		'receiptamt'=>$paymentdetails,
		'balance'=>$balanceamount,
		'purchaseamt'=>$_POST['grandtotal'],
		'invoiceno' =>$_POST['invoiceno'],
		'purchasenodate' =>$purchasenodate, 
		'purchasenoyear' =>$purchasenoyear,
		'purchaseid' =>$purchaseid, 
		'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
		'status'=>1);

		$this->db->insert('po_party_statements',$dd);

		$this->session->set_flashdata('msg','Purchase Updated Successfully');
		redirect('purchase/view');
		}
		else
		{
			$this->session->set_flashdata('msg1','No Changes');
			redirect('purchase/view');
		}

	}





	public function search()
	{ 
		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$suppliername=$this->input->post('suppliername');
		$invoiceno=$this->input->post('invoiceno');

		$data=array(
		'rcbio_fromdate' => $fromdate,
		'rcbio_todate' => $todate,
		'rcbio_suppliername' => $suppliername,
		'rcbio_invoiceno' => $invoiceno,
		'rcbio_bill_format' =>'Print',
		);
		$this->session->set_userdata($data);
	}


	public function search_reports()
	{   
		$bill_format=$this->session->userdata('rcbio_bill_format');                
		$data['purchase']=$this->purchase_model->search_billing();
		$data['fromdate']=$this->session->userdata('rcbio_fromdate');
		$data['todate']=$this->session->userdata('rcbio_todate');
		$data['suppliername']=$this->session->userdata('rcbio_suppliername');
		$data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
		$this->load->view('purchase_reports2',$data);
	}  


public function delete()
{
	$del=base64_decode($this->input->post('id'));
	//$del=$this->input->post('id');  
	$getdetails=$this->db->where('id',$del)->get('purchase_details')->result();
	foreach($getdetails as $row)

	// $getsuppliers='Intra supplier';
	// $getsuppliers1='Inter supplier';

	// $customer_details=$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->where('name',$row->suppliername)->get('customer_details')->result();
	// foreach($customer_details as $c)
	// $updates=$c->balanceamount-$row->grandtotal;
	//$salesamt = $c->salesamount-$row->grandtotal;
	$this->db->where("(type = 'Intra supplier' OR type = 'Inter supplier')")->where('name',$row->suppliername)->update('customer_details',array('balanceamount'=>@$updates,'salesamount'=>@$salesamt));
	$itemname =explode('||',$row->itemname);
	$rate =explode('||',$row->rate);
	$qty =explode('||',$row->qty);
	$hsnno =explode('||',$row->hsnno);
	$invcount=count($itemname);
	for ($j=0; $j < $invcount; $j++)
	{ 
		$invwq=$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('stock')->result();
		foreach($invwq as $w)
		@$old=$w->balance;  
		//$qty[$j];
		@$bal=$old-$qty[$j];
		$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('stock',array('balance'=>$bal));

		$invwq1=$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('stock_reports')->result();
		foreach($invwq1 as $w1)
		$old1=$w1->updatestock;
		@$ba1l=$old1-$qty[$j];
		$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('stock_reports',array('updatestock'=>$ba1l));		
	} 
	$data=$this->db->where('id',$del)->delete('purchase_details');
	if($data)
	{
		//$this->db->where('purchaseid',$del)->delete('purchase_collection');
		$this->db->where('purchaseid',$del)->delete('po_party_statements');
		//$this->session->set_flashdata('msg','Purchase  Deleted successfully!');
		echo'yes';
	}
	else
	{
		//$this->session->set_flashdata('msg1','Purchase  Deleted unsuccessfully');
		echo'no';   

	}
}



public function pending()
{

  $data['pending']=$this->purchase_model->pending_select();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function pending_search()
{
  $data['pending']=$this->purchase_model->search_reports();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function purchase_reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->purchase_model->search_pending();

    // echo"<pre>";
    // print_r($data);
  $this->load->view('purchase_reports',$data,$fromdate,$todate,$suppliername);

}

public function reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->purchase_model->search_reports();

  
  $this->load->view('purchase_reports2',$data,$fromdate,$todate);

}


public function reports1()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->purchase_model->search_pending();

  
  $this->load->view('purchase_reports1',$data,$fromdate,$todate);

}

public function get_supplier()
{
 $name=$_POST['name'];
 $data=$this->db->where('name',$name)->get('customer_details')->result();
 echo $count=count($data);

}

public function check_hsnno()
{
 $name=$_POST['name'];
 $data=$this->db->where('hsnno',$name)->get('additem')->result();

 echo $count=count($data);

}

}

ob_flush();
?>