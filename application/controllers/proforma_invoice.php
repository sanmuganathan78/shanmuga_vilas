<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Proforma_invoice extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('proforma_invoice_model');
    if($this->session->userdata('rcbio_login')=='')
    {
      $this->session->set_flashdata('msg','Please Login to continue!');
      redirect('login');
    }     
  }
	public function index()
	{
		
$mysqli = new mysqli("localhost", "root", "", "shanmuga_vilas");
$query_update1 =$mysqli->query("SELECT * FROM proforma_invoice_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
		while($row = mysqli_fetch_array($query_update1))
		{
			$quotationnos=$row['invoiceno'];
			$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
			$new_bond_prefix = $default_bond->proforma_invoicePrefix;
			@$quotationnos=str_replace($new_bond_prefix,'',$quotationnos);
		}

		if(date('m')=='04')
		{
			$month=date('m');
			$year=date('Y');
			$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->get('proforma_invoice_details')->result_array();
			if($old)
			{
				@$bond_no = $quotationnos;
				if(is_null($bond_no))
				{
					$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->proforma_invoicePrefix;
					$new_bond_noo = $new_bond_prefix.$default_bond->proforma_invoice;
					//$new_bond_noo = '100001'; 
				} 
				else 
				{
					$default_bond=$this->db->where('id',1)->where('proforma_invoice !=','')->get('preference_settings')->row();
					if($default_bond)
					{
						$bond_no=$default_bond->proforma_invoice;
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_prefix = $default_bond->proforma_invoicePrefix;
						$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
					}
					else
					{
						$bondLen = strlen($bond_no);
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
						$new_bond_prefix = $default_bond->proforma_invoicePrefix;
						$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
					}
				}
			}
			else
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->proforma_invoicePrefix;
				$new_bond_noo = $new_bond_prefix.$default_bond->proforma_invoice;
				//$new_bond_noo = '100001';
			}

		}
		else
		{
			@$bond_no = $quotationnos;
			if(is_null($bond_no))
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$new_bond_prefix = $default_bond->proforma_invoicePrefix;
				$new_bond_noo = $new_bond_prefix.$default_bond->proforma_invoice;
				//$new_bond_noo = '100001'; 
			} 
			else
			{
				$default_bond=$this->db->where('id',1)->where('proforma_invoice !=','')->get('preference_settings')->row();
				if($default_bond)
				{
					@$bond_no=$default_bond->proforma_invoice;
					$new_bond_prefix = $default_bond->proforma_invoicePrefix;
					$bondLen = strlen($bond_no);
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
				}
				else
				{
					$bondLen = strlen($bond_no);
					$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
					$new_bond_prefix = $default_bond->proforma_invoicePrefix;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					@$new_bond_noo = $new_bond_prefix.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
				}
			}
		}
		$data['invoiceno']=$new_bond_noo;
		$this->load->view('header');
		$this->load->view('proforma_invoice1',$data);
		$this->load->view('footer');
	}

	public function insert()
	{
	$grandtotal = $_POST['grandtotal'];
	$customerid = $_POST['customerid'];
	$data1=$this->db->where('id',$customerid)->get('customer_details')->result_array();
	foreach ($data1 as $a) 
	{
		$openingbalance=$a['openingbal'];
		$balance=$a['balanceamount'];
		$salesamounts=$a['salesamount'];  
		$paidamounts=$a['paidamount'];  
	}
	if($balance){ $balanceamount=$balance + $grandtotal; } else { $balanceamount=($openingbalance+$grandtotal)-$paidamounts; }
	if($salesamounts=='') {	$salesamount=$grandtotal; }	else { $salesamount=$salesamounts+$grandtotal;	}

	$datass = array('salesamount'=>$salesamount,'balanceamount'=>$balanceamount);
	$this->db->where('id',$customerid)->update('customer_details',$datass);

	$insertid=$this->input->post('insertid');
	@$deliveryid=implode('||',$_POST['id']);
	$invoicetype=$this->input->post('invoicetype');
	$bill_type=$this->input->post('bill_type');
	@$dcno=implode('||',$_POST['dcno']);
	@$dcnos=implode('||',$_POST['dcnos']);
	$hsnno=implode('||',$_POST['hsnno']);
	$itemname=implode('||',$_POST['itemname']);
	$item_desc=implode('||',$_POST['item_desc']);
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

	$invoicenoyear=$_POST['invoiceno'].''.date('-Y').'';
	$invoicenodate=$_POST['invoiceno'].''.date('dmy').'';

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
		//$igst = implode('||',$res);
		$igst = implode('||',$_POST['igst']);
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
		$sgstamount = implode('||',$_POST['sgstamount']);
		$cgstamount = implode('||',$_POST['cgstamount']);
		//$sgstamount = implode('||',$res);
		//$cgstamount = implode('||',$res);
		$igstamount = implode('||',$_POST['igstamount']);
		$igsts='igst';
		$sgsts='';
		$cgsts='';
	}

	$data=array(
	'date'=>date('Y-m-d'),
	'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
	'orderdate' =>date('Y-m-d',strtotime($_POST['orderdate'])),
	'invoicetype'=>$invoicetype,
	'bill_type' => $bill_type,
	'dcno'=>$dcno, 
	'invoiceno' =>$_POST['invoiceno'], 
	'insertid'=>$insertid, 
	'customerId' => $customerid,
	'customername' =>$_POST['customername'], 
	'address' =>$_POST['address'], 
	'orderno' =>$_POST['orderno'], 
	'billtype' =>$_POST['gsttype'], 
	'gsttype' =>$_POST['gsttype'],
	'deliveryat' =>$_POST['deliveryat'],
	'vehicleno' =>$_POST['vehicleno'],
	'transportmode' =>$_POST['transportmode'],
	'typesgst'=>$sgsts,
	'typecgst'=>$cgsts,
	'typeigst'=>$igsts,
	'hsnno'=>$hsnno,
	'dcnos'=>$dcnos, 
	'deliveryid'=>$deliveryid, 
	'itemname'=>$itemname,
	'item_desc'=>$item_desc,
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
	$result=$this->db->insert('proforma_invoice_details',$data);
	if($result==true)
	{ 
		$invoiceid=$this->db->insert_id();
		$this->db->query("UPDATE preference_settings SET proforma_invoice='' WHERE id=1");
		$sparename=$_POST['itemname'];
		$item_desca=$_POST['item_desc'];
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
				$this->db->where('itemname',$sparename[$i])->where('hsnno',$hsnnos[$i])->update('stock',array('date'=>date('Y-m-d'),'balance'=>$bal-$qty[$i]));
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
			'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
			'orderdate' =>date('Y-m-d',strtotime($_POST['orderdate'])), 
			'invoiceno' =>$_POST['invoiceno'],
			'customerId' => $customerid,
			'customername' =>$_POST['customername'], 
			'address' =>$_POST['address'], 
			'orderno' =>$_POST['orderno'], 
			'billtype' =>$_POST['gsttype'], 
			'gsttype' =>$_POST['gsttype'],
			'deliveryat' =>$_POST['deliveryat'],
			'vehicleno' =>$_POST['vehicleno'], 
			'itemname'=>$sparename[$j],
			'item_desc'=>$item_desca[$j],
			'rate'=>$rate[$j],
			'qty'=>$qty[$j],
			'total'=>$total[$j],
			'hsnno'=>$hsnnoss[$j],
			'address' =>$_POST['address'],  
			'subtotal' =>$_POST['subtotal'], 
			'grandtotal' =>$_POST['grandtotal'], 
			'invoicenodate' =>$invoicenodate, 
			'invoicenoyear' =>$invoicenoyear,
			'invoiceid' =>$invoiceid,
			'status'=>1);
			$this->db->insert('proforma_invoice_reports',$podatass);
		}

		@$receiptno='-';
		@$paymentdetails='-';
		@$paymentmodes='-';
		@$throughchecks='-';
		@$banktransfers='-';
		@$chamounts='-';
		@$bankamounts='-';
		@$chequeno='-';
		@$receiptamt='-';
		@$receiptid='-';

		$dd=array(
		'date'=>date('Y-m-d',strtotime($_POST['invoicedate'])),
		'receiptdate'=>date('Y-m-d',strtotime($_POST['invoicedate'])),  
		'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
		'invoiceno'=>$_POST['invoiceno'],
		'payment'=>$paymentdetails,
		'customerId' => $customerid,
		'customername' =>$_POST['customername'], 
		'paymentmode'=>$paymentmodes,
		'throughcheck'=>$throughchecks,
		'banktransfer'=>$banktransfers,
		'chamount'=>$chamounts,
		'bankamount'=>$bankamounts,
		'chequeno'=>$chequeno,
		'itemname'=>$itemname,
		'item_desc'=>$item_desc,
		'paymentdetails'=>$paymentdetails,
		'overallamount'=>$_POST['grandtotal'],
		'receiptamt'=>'-',          
		'receiptno'=>$receiptid,
		// 'qty'=>$qty,
		'paid'=>$paymentdetails,
		'totalamount'=>$_POST['grandtotal'],
		'invoiceamt'=>$_POST['grandtotal'],
		'invoicenoyear' =>$invoicenoyear, 
		'invoicenodate' =>$invoicenodate, 
		'balance'=>$balanceamount,
		'invoiceid' =>$invoiceid,
		'status'=>1);
		$this->db->insert('proinvoice_party_statement',$dd);



		$invoicetype=$this->input->post('invoicetype');
		if($invoicetype=='Against DC')
		{
			$insertid=$this->input->post('insertid');
			$itemname=$this->input->post('itemname');
			$id=$this->input->post('id');
			$count=count($itemname);
			for ($i=0; $i <$count ; $i++) 
			{ 
				// $balanceqty=$inwardqty[$i]-$qty[$i];

				// if($balanceqty==0)
				// {
				//     $inward_status=0;
				// }
				// else
				// {
				//   $inward_status=1;
				// }

				$datas=array('balanceqty'=>0,'dc_status'=>0);
				$this->db->where('id',$id[$i]);
				$this->db->update('dc_delivery',$datas);

				$datass=array('delete_status'=>0);
				$this->db->where('id',$insertid);
				$this->db->update('dcbill_details',$datass);
			}
		}

		$this->session->set_flashdata('msg','Invoice Added Successfully');
		if($_POST['print']=='print')
		{
			redirect('proforma_invoice/bill');
		}
		if($_POST['save']=='save')
		{
			redirect('proforma_invoice');
		}
	}
	else
	{
		$this->session->set_flashdata('msg1','Invoice Added Unsuccessfully');
		redirect('proforma_invoice');
	}


	}

  public function view()
  {

    $data['invoice']=$this->proforma_invoice_model->select();
    $data['vat']=$this->db->get('vat_details')->result_array(); 

    $this->load->view('header');
    $this->load->view('proforma_invoice_view',$data);
    $this->load->view('footer1');
  }

 public function views()
  {

     $id=base64_decode($this->uri->segment(3));
     $data['result']=$this->db->where('id',$id)->get('proforma_invoice_details')->result_array();  
     $this->load->view('header');
     $this->load->view('proforma_view_invoice',$data);
     $this->load->view('footer');

  }


 public function ajax_list()
  {
    $list = $this->proforma_invoice_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    $i=1;
    foreach ($list as $person) {

       @$gstin=$this->db->select('gstno')->where('name',$person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;

       @$phoneno=$this->db->select('phoneno')->where('name',$person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->phoneno;

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
      $row[] = $phoneno;
      $row[] = $gstin;
      $row[] = $numberDays.' Days';
      $row[] = $person->grandtotal;
	  $return_status=explode("||",$person->return_status);
      $code=base64_encode($person->id);
		if(in_array(0,$return_status))
		{
			$deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:alert(\'Sorry! You cannot able to delete!\');" title="Hapus" >Delete</a>';
			
		}
		else
		{
			$deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$code."'".')">Delete</a>';
		}
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

          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('proforma_invoice/views/'.$code).'" title="Hapus" >View</a></li>
          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('proforma_invoice/edit/'.$code).'" title="Hapus" >Edit</a></li>

          <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('proforma_invoice/rebill/'.$code).'" title="Hapus" >Print</a></li>
          <li>'.$deleteOptn.'</li>
        </ul>
      </div>';

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

        <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('proforma_invoice/views/'.$code).'" title="Hapus" >View</a></li>
        <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('proforma_invoice/edit/'.$code).'" title="Hapus" >Edit</a></li>
      
        <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('proforma_invoice/rebill/'.$code).'" title="Hapus" >Print</a></li>
        <li>'.$deleteOptn.'</li>
      </ul>
    </div>';
  }
      //add html for action

    // <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('invoice/edit/'.$code).'" title="Edit" >Edit</a></li>
  
  $data[] = $row;
}
$output = array(
  "draw" => $_POST['draw'],
  "recordsTotal" => $this->proforma_invoice_model->count_all(),
  "recordsFiltered" => $this->proforma_invoice_model->count_filtered(),
  "data" => $data,);
    //output to json format
echo json_encode($output);
}

public function ajax_delete($id)
{
  $this->proforma_invoice_model->delete_by_id($id);
  echo json_encode(array("status" => TRUE));
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
  $data['result']=$this->db->where('id',$id)->get('proforma_invoice_details')->result_array(); 
  $this->load->view('header');
  $this->load->view('proforma_edit_invoices',$data);
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




  // public function edit()
  // {


  //       $data['vat']=$this->db->get('vat_details')->result_array(); 

  //   $id=base64_decode($this->uri->segment(3));

  //     $data['edit']=$this->proforma_invoice_model->invoice_edit($id);
  //     $this->load->view('header');
  //     $this->load->view('edit_invoice',$data);
  //        $this->load->view('footer');


  // }

public function update()
{

// echo "<pre>";
// print_r($_POST);
// exit;
	$id=$this->input->post('id');
   $getpurchase=$this->db->where('id',$id)->get('proforma_invoice_details')->result();
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
      $ite[$i];
      $cur=$s['balance'];
      $qtyss[$i]; 
      $tot=$cur+$qtyss[$i]; 
      $this->db->where('itemname',$ite[$i])->where('hsnno',$hsnnos[$i])->update('stock',array('balance'=>$tot));   
    }

  }
   //$grandtotal = $_POST['grandtotal'];
    $this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
    $data11=$this->db->where('name',$_POST['customername'])->get('customer_details')->result_array();
    foreach ($data11 as $a1) 
    {
      $openingbalance=$a1['openingbal'];
      $balance=$a1['balanceamount'];
        $salesamounts=$a1['salesamount'];  
    } 

    if($balance)
    {
      $balanceamount=$balance -$grandtotals;
    }
    else
    {
      $balanceamount='0.00';
    }    
    $this->db->where('id',$a1['id'])->update('customer_details',array('balanceamount'=>$balanceamount));

    
     $grandtotal = $_POST['grandtotal'];
      $data1=$this->db->where('id',$a1['id'])->get('customer_details')->result_array();


  
    foreach ($data1 as $a) 
    {
      $openingbalance=$a['openingbal'];
      $balance=$a['balanceamount'];
      $salesamounts=$a['salesamount'];  
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
      $salesamount=$salesamounts-$grandtotal;
    }

    $datass = array('salesamount'=>$salesamount,'balanceamount'=>$balanceamount);

     $this->db->where('id',$a['id'])->update('customer_details',$datass);

 
  
    $hsnno=implode('||',$_POST['hsnno']);
    $itemname=implode('||',$_POST['itemname']);
    $item_desc=implode('||',$_POST['item_desc']);
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
      //$igst = implode('||',$res);
	  $igst = implode('||',$_POST['igst']);
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
      'date'=>date('Y-m-d'),
	  'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])),
      'invoiceno' =>$_POST['invoiceno'], 
      'bill_type' =>$_POST['bill_type'], 
      'customername' =>$_POST['customername'], 
      'customerId' => $_POST['customerid'],
      'address' =>$_POST['address'], 
      'orderno' =>$_POST['orderno'], 
      'billtype' =>$_POST['gsttype'], 
      'gsttype' =>$_POST['gsttype'],
      'deliveryat' =>$_POST['deliveryat'],
      'vehicleno' =>$_POST['vehicleno'],
      'transportmode' =>$_POST['transportmode'],
      'typesgst'=>$sgsts,
      'typecgst'=>$cgsts,
      'typeigst'=>$igsts,
      'hsnno'=>$hsnno,
      'itemname'=>$itemname,
      'item_desc'=>$item_desc,
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
    $result=$this->db->update('proforma_invoice_details',$data);
    if($result==true)
    { 
        $invoiceid=$_POST['id'];


        $this->db->where('invoiceid',$_POST['id'])->delete('proforma_invoice_reports');
        $this->db->where('invoiceid',$_POST['id'])->delete('proinvoice_party_statement');


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
          $this->db->where('itemname',$sparename[$i])->where('hsnno',$hsnnos[$i])->update('stock',
            array(
              'date'=>date('Y-m-d'),
              'balance'=>$bal-$qty[$i]
              ));
        }
       
      }


      $itemnames=$_POST['itemname'];
      $item_descs=$_POST['item_desc'];
      $qtys=$_POST['qty'];
      $hsnnoss=$_POST['hsnno'];

      $count=count($sparename);
      for ($j=0; $j <  $count; $j++) 
      {
		$podatass=array(
		'date'=>date('Y-m-d'),
		'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
		'orderdate' =>date('Y-m-d',strtotime($_POST['orderdate'])), 
		'invoiceno' =>$_POST['invoiceno'], 
		'customername' =>$_POST['customername'], 
		'address' =>$_POST['address'], 
		'orderno' =>$_POST['orderno'], 
		'billtype' =>$_POST['gsttype'], 
		'gsttype' =>$_POST['gsttype'],
		'deliveryat' =>$_POST['deliveryat'],
		'vehicleno' =>$_POST['vehicleno'], 
		'itemname'=>$itemnames[$j],
		'item_desc'=>$item_descs[$j],
		'rate'=>$_POST['rate'][$j],
		'qty'=>$qtys[$j],
		'total'=>$_POST['total'][$j],
		'hsnno'=>$hsnnoss[$j],
		'address' =>$_POST['address'],  
		'subtotal' =>$_POST['subtotal'], 
		'grandtotal' =>$_POST['grandtotal'], 
		'invoicenodate' =>$invoicenodate, 
		'invoicenoyear' =>$invoicenoyear,
		'invoiceid' =>$invoiceid,
		'status'=>1);
        $this->db->insert('proforma_invoice_reports',$podatass);
      }


    
        @$receiptno='-';
        @$paymentdetails='-';
        @$paymentmodes='-';
        @$throughchecks='-';
        @$banktransfers='-';
        @$chamounts='-';
        @$bankamounts='-';
        @$chequeno='-';
        @$receiptamt='-';
        @$receiptid='-';

        $dd=array(
          'date'=>date('Y-m-d',strtotime($_POST['invoicedate'])),
          'receiptdate'=>date('Y-m-d',strtotime($_POST['invoicedate'])),  
          'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
          'invoiceno'=>$_POST['invoiceno'],
          'payment'=>$paymentdetails,
		  'customerId' => $_POST['customerid'],
          'customername' =>$_POST['customername'], 
          'paymentmode'=>$paymentmodes,
          'throughcheck'=>$throughchecks,
          'banktransfer'=>$banktransfers,
          'chamount'=>$chamounts,
          'bankamount'=>$bankamounts,
          'chequeno'=>$chequeno,
          'itemname'=>$itemname,
          'item_desc'=>$item_desc,
          'paymentdetails'=>$paymentdetails,
          'overallamount'=>$_POST['grandtotal'],
          'receiptamt'=>'-',          
          'receiptno'=>$receiptid,
          // 'qty'=>$qty,
          'paid'=>$paymentdetails,
          'totalamount'=>$_POST['grandtotal'],
          'invoiceamt'=>$_POST['grandtotal'],
          'invoicenoyear' =>$invoicenoyear, 
          'invoicenodate' =>$invoicenodate, 
          'balance'=>$balanceamount,
          'invoiceid' =>$invoiceid,
          'status'=>1);


  

      $this->db->insert('proinvoice_party_statement',$dd);
      $this->session->set_flashdata('msg','Invoice Update Successfully');
       
          if($_POST['save']=='save')
            {
                redirect('proforma_invoice/view');
            }
            else
            {
              redirect('proforma_invoice/bill');
            }
    }
    else
    {
      $this->session->set_flashdata('msg1','Invoice Update Unsuccessfully');
      redirect('proforma_invoice/view');
    }

}





public function delete()
{
 $del=base64_decode($this->input->post('id'));
//   $del=base64_decode('Ng==');
  

   //$del=$this->input->post('id');  
  $getdetails=$this->db->where('id',$del)->get('proforma_invoice_details')->result();

  if($getdetails)
  {
  foreach($getdetails as $row)
  {



    $customer_details=$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name',$row->customername)->get('customer_details')->result();
 
      foreach($customer_details as $c)
    $updates=$c->balanceamount-$row->grandtotal;
	$salesamt = $c->salesamount-$row->grandtotal;

    $this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name',$row->customername)->update('customer_details',array('balanceamount'=>$updates,'salesamount'=>$salesamt));

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
			/*$invwq1=$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->get('stock_reports')->result();
			foreach($invwq1 as $w1)
			$old1=$w1->updatestock;
			$ba1l=$old1+$qty[$j];
			$this->db->where('itemname',$itemname[$j])->where('hsnno',$hsnno[$j])->update('stock_reports',array('updatestock'=>$ba1l));		
			*/
              
          } 

        }

      }
          $checkdata=$this->db->where('id',$del)->get('proforma_invoice_details')->result_array();
                if($checkdata)
                {
                  foreach ($checkdata as $rows) 
                  {
                        $invoicetype=$rows['invoicetype'];
                        $deliveryid=explode('||',$rows['deliveryid']);
                        $qtyss=explode('||',$rows['qty']);

                   }     
                        $counts=count($deliveryid);
                        
                        if($invoicetype=='Against DC')
                      {
                            for ($i=0; $i <$counts ; $i++) { 

                              $datass=array('balanceqty'=>$qtyss[$i],
                                         'dc_status'=>1);
                            $this->db->where('id',$deliveryid[$i]);
                            $this->db->update('dc_delivery',$datass);
                              
                            } 

                            

                            // $datass=array('delete_status'=>0);
                            // $this->db->where('id',$insertid);
                            // $this->db->update('inward_details',$datass);
               
                        }


                    

                  }







  $data=$this->db->where('id',$del)->delete('proforma_invoice_details');
 if($data)
 {
      $this->db->where('invoiceid',$del)->delete('proforma_invoice_reports');
      $this->db->where('invoiceid',$del)->delete('proinvoice_party_statement');


      //$this->session->set_flashdata('msg','Proforma_invoice Details  Deleted successfully!');
      echo'yes';
}
else
{
  //$this->session->set_flashdata('msg1','Proforma_invoice Details  Deleted unsuccessfully');
  echo'no';   
    
}

} 

   public function pending_view()
    {
        $data['pending']=$this->proforma_invoice_model->pending();
        $this->load->view('header');
        $this->load->view('pending_view',$data);
        $this->load->view('footer1');
    }


public function pending()
{

  $data['pending']=$this->proforma_invoice_model->pending_select();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function pending_search()
{
  $data['pending']=$this->proforma_invoice_model->search_reports();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function purchase_reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->proforma_invoice_model->search_pending();

    // echo"<pre>";
    // print_r($data);
  $this->load->view('purchase_reports',$data,$fromdate,$todate,$suppliername);

}

public function reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->proforma_invoice_model->search_reports();

  
  $this->load->view('purchase_reports2',$data,$fromdate,$todate);

}


public function reports1()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->proforma_invoice_model->search_pending();

  
  $this->load->view('purchase_reports1',$data,$fromdate,$todate);

}

  public function getcustomer()
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

public function gets()
{
  $name=$_POST['name'];
  $data=$this->db->where('itemname',$name)->get('additem')->result();
  echo $count=count($data);

}


public function bill()
  {
    $data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('proforma_invoice_details')->result();
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
	/* CALCULATION NO.OF ITEMS FOR EACH TAX %*/
	$taxesList1 = $this->db->select('sgst,cgst,igst')->get('vat_details')->result();
	if(count($taxesList1) > 0)
	{
		foreach($taxesList1 as $tl1)
		{
			$taxPercent[$tl1->igst]=0;
			$grossAmount[$tl1->igst]=0;
			$NetValue[$tl1->igst]=0;
		}
	}
	//print_r($taxPercent);Array ( [18] => 0 [28] => 0 [5] => 0 [12] => 0 )
	//exit;
	$invoiceDet = $this->db->select('gsttype,qty,sgst,cgst,igst,taxableamount,cgstamount,sgstamount,igstamount')->where('status',1)->order_by('id','desc')->limit(1)->get('proforma_invoice_details')->row();
	if(count($invoiceDet) > 0 )
	{
		$gstType = $invoiceDet->gsttype;
		$sgstPer = explode("||",$invoiceDet->sgst);
		$cgstPer = explode("||",$invoiceDet->cgst);
		$igstPer = explode("||",$invoiceDet->igst);
		$quantit = explode("||",$invoiceDet->qty);
		$taxableamount = explode("||",$invoiceDet->taxableamount);
		$cgstAmt = explode("||",$invoiceDet->cgstamount);
		$sgstAmt = explode("||",$invoiceDet->sgstamount);
		$igstAmt = explode("||",$invoiceDet->igstamount);
		
		$taxesList = $this->db->select('sgst,cgst,igst')->get('vat_details')->result();
		if(count($taxesList) > 0 )
		{
			foreach($taxesList as $tl)
			{
				if($gstType=='interstate')
				{
					for($i=0;$i<count($quantit);$i++)
					{
						if($igstPer[$i]==$tl->igst)
						{
							$grossAmount[$tl->igst] +=$taxableamount[$i];
							$taxPercent[$tl->igst] +=$igstAmt[$i];
							$NetValue[$tl->igst] +=$igstAmt[$i]+$taxableamount[$i];
						}
					}
				}
				else
				{
					for($i=0;$i<count($quantit);$i++)
					{
						if($cgstPer[$i]==$tl->cgst)
						{
							$grossAmount[$tl->igst] +=$taxableamount[$i];
							$taxPercent[$tl->igst] +=($sgstAmt[$i]+$cgstAmt[$i]);
							$NetValue[$tl->igst] +=($sgstAmt[$i]+$cgstAmt[$i])+$taxableamount[$i];
							//$taxPercent[$tl->igst] +=($cgstAmt[$i]+$sgstAmt[$i]);
						}
					}
				}
				
			}
		}
	}
	$data['taxPercent']=$taxPercent;
	$data['grossAmount']=$grossAmount;
	$data['NetValue']=$NetValue;
	$data['fromDirectBill']=1;
	//print_r($taxPercent);
	/* CALCULATION NO.OF ITEMS FOR EACH TAX % */
    $this->load->view('proforma_invoicebill',$data);
    //$this->load->view('invoicebill',$data);
// $this->load->view('invoice_bill',$data);
  }

  public function rebill()
  {
    $id=base64_decode($this->uri->segment(3));
  // $this->load->library('mpdf'); 
    $data['pre']=$this->db->where('id',$id)->get('proforma_invoice_details')->result();

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
    $data['invoice']=$this->db->where('id',$id)->get('proforma_invoice_details')->result();
	/* CALCULATION NO.OF ITEMS FOR EACH TAX %*/
	$taxesList1 = $this->db->select('sgst,cgst,igst')->get('vat_details')->result();
	if(count($taxesList1) > 0)
	{
		foreach($taxesList1 as $tl1)
		{
			$taxPercent[$tl1->igst]=0;
			$grossAmount[$tl1->igst]=0;
			$NetValue[$tl1->igst]=0;
		}
	}
	
	$invoiceDet = $this->db->select('gsttype,qty,sgst,cgst,igst,taxableamount,cgstamount,sgstamount,igstamount')->where('id',$id)->get('proforma_invoice_details')->row();
	if(count($invoiceDet) > 0 )
	{
		$gstType = $invoiceDet->gsttype;
		$sgstPer = explode("||",$invoiceDet->sgst);
		$cgstPer = explode("||",$invoiceDet->cgst);
		$igstPer = explode("||",$invoiceDet->igst);
		$quantit = explode("||",$invoiceDet->qty);
		$taxableamount = explode("||",$invoiceDet->taxableamount);
		$cgstAmt = explode("||",$invoiceDet->cgstamount);
		$sgstAmt = explode("||",$invoiceDet->sgstamount);
		$igstAmt = explode("||",$invoiceDet->igstamount);
		
		$taxesList = $this->db->select('sgst,cgst,igst')->get('vat_details')->result();
		if(count($taxesList) > 0 )
		{
			foreach($taxesList as $tl)
			{
				if($gstType=='interstate')
				{
					for($i=0;$i<count($igstPer);$i++)
					{
						if($igstPer[$i]==$tl->igst)
						{
							$grossAmount[$tl->igst] +=$taxableamount[$i];
							//$taxPercent[$tl->igst] +=$quantit[$i];
							$taxPercent[$tl->igst] +=$igstAmt[$i];
							$NetValue[$tl->igst] +=$igstAmt[$i]+$taxableamount[$i];
						}
					}
				}
				else
				{
					for($i=0;$i<count($cgstPer);$i++)
					{
						if($cgstPer[$i]==$tl->cgst)
						{
							//$taxPercent[$tl->igst] +=$quantit[$i];
							$grossAmount[$tl->igst] +=$taxableamount[$i];
							$taxPercent[$tl->igst] +=($sgstAmt[$i]+$cgstAmt[$i]);
							$NetValue[$tl->igst] +=($sgstAmt[$i]+$cgstAmt[$i])+$taxableamount[$i];
						}
					}
				}
				
			}
		}
	}
	/* CALCULATION NO.OF ITEMS FOR EACH TAX % */
	$data['taxPercent']=$taxPercent;
	$data['grossAmount']=$grossAmount;
	$data['NetValue']=$NetValue;
	$data['fromDirectBill']=0;
    $this->load->view('proforma_invoicebill',$data);
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
      $data['invoice']=$this->proforma_invoice_model->search_billing();

      $data['fromdate']=$this->session->userdata('rcbio_fromdate');
      $data['todate']=$this->session->userdata('rcbio_todate');
      $data['cusname']=$this->session->userdata('rcbio_cusname');
      $data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
      $data['gsttype']=$this->session->userdata('rcbio_gsttype');


      $this->load->view('proforma_invoice_reports',$data);

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
			$checkItemType = $this->db->select('itemType')->where('id',1)->get('preference_settings')->row()->itemType;
			if($checkItemType=='with_item')
			{
				$this->load->view('proforma_directinvoice',$data);
			}
			else
			{
				$this->load->view('invoiceWithoutItem',$data);
			}
			
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
			$this->load->view('proforma_againstdc',$data);
		}
	}
  
}

ob_flush();
?>