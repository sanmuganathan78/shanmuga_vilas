	<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	ob_start();
	class purchaseorder extends CI_Controller {

	public function __construct()
	{
	parent::__construct();
	$this->load->model('purchaseorder_model');
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
$query_update1 =$mysqli->query("SELECT * FROM purchaseorder_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
	while($row = mysqli_fetch_array($query_update1))

	{
	@$quotationnos=$row['purchaseorderno'];
	}
	if(date('m')=='04')
	{

	$month=date('m');
	$year=date('Y');
	$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->where('status',1)->get('purchaseorder_details')->result_array();
	if($old)
	{
	@$bond_no = $quotationnos;

	if(is_null($bond_no))
	{
	$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
	$new_bond_noo = 'P'.$default_bond->purchaseorder;
	//$new_bond_noo = 'P00001'; 
	} 
	else 
	{
	$default_bond=$this->db->where('id',1)->where('purchaseorder !=','')->get('preference_settings')->row();
	if($default_bond)
	{
	$bond_no='P'.$default_bond->purchaseorder;
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
	$new_bond_noo = 'P'.$default_bond->purchaseorder;
	//$new_bond_noo = 'P00001';
	}
	}
	else
	{
	@$bond_no = $quotationnos;
	if(is_null($bond_no))
	{
	$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
	$new_bond_noo = 'P'.$default_bond->purchaseorder;
	//$new_bond_noo = 'P00001'; 
	} 
	else
	{
	$default_bond=$this->db->where('id',1)->where('purchaseorder !=','')->get('preference_settings')->row();
	if($default_bond)
	{
	@$bond_no='P'.$default_bond->purchaseorder;
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
	}
	}

	$data['invoiceno']=$new_bond_noo;
	$this->load->view('header');
	$this->load->view('purchaseOrder_add',$data);
	$this->load->view('footer');
	}

	public function insert()
	{
    
    	  $mysqli = new mysqli("localhost", "erpin_billing", "erpin_billing", "erpin_billing");  
$query_update1 =$mysqli->query("SELECT * FROM purchaseorder_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
	while($row = mysqli_fetch_array($query_update1))

	{
	@$quotationnos=$row['purchaseorderno'];
	}
	if(date('m')=='04')
	{

	$month=date('m');
	$year=date('Y');
	$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->where('status',1)->get('purchaseorder_details')->result_array();
	if($old)
	{
	@$bond_no = $quotationnos;

	if(is_null($bond_no))
	{
	$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
	$new_bond_noo = 'P'.$default_bond->purchaseorder;
	//$new_bond_noo = 'P00001'; 
	} 
	else 
	{
	$default_bond=$this->db->where('id',1)->where('purchaseorder !=','')->get('preference_settings')->row();
	if($default_bond)
	{
	$bond_no='P'.$default_bond->purchaseorder;
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
	$new_bond_noo = 'P'.$default_bond->purchaseorder;
	//$new_bond_noo = 'P00001';
	}
	}
	else
	{
	@$bond_no = $quotationnos;
	if(is_null($bond_no))
	{
	$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
	$new_bond_noo = 'P'.$default_bond->purchaseorder;
	//$new_bond_noo = 'P00001'; 
	} 
	else
	{
	$default_bond=$this->db->where('id',1)->where('purchaseorder !=','')->get('preference_settings')->row();
	if($default_bond)
	{
	@$bond_no='P'.$default_bond->purchaseorder;
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
	$customerid = $_POST['customerid'];
	if($_POST['potype']=='BOM')
	{
	$_POST['selected_bom']=0;
	}
	$_POST['invoiceno'] = 0;
	//exit;
	$hsnno=implode('||',$_POST['hsnno']);
	$itemname=implode('||',$_POST['itemname']);
	$qty=implode('||',$_POST['qty']);
	$balanceqty=implode('||',$_POST['balanceqty']);
	$bom_qty=implode('||',$_POST['bomqty']);
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
	$selected_bom=implode('||',$_POST['selected_bom']);
	$potype=$this->input->post('potype');
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
	$othercharges=$this->input->post('othercharges');
	$hiddenDiscountBy=$this->input->post('hiddenDiscountBy');
	$roundOff=$this->input->post('roundOff');
	$grandtotal=$this->input->post('grandtotal');
	$purchasenoyear=$_POST['purchaseorderno'].''.date('-Y').'';
	$purchasenodate=$_POST['purchaseorderno'].''.date('dmy').'';


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
	$igstamount = implode('||',$res);
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
	'date'=>date('Y-m-d'),
	'purchasedate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
	'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
	'potype' => $_POST['potype'],
	'purchaseorderno' =>$invoiceno, 
	'purchaseorder' =>$_POST['purchaseorder'],
	'selected_bom' =>$selected_bom, 
	'customerId' => $customerid,
	'customername' =>$_POST['customername'], 
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
	'balanceqty'=>$qty,
	'bom_qty'=>$bom_qty,
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
	'purchasenodate' =>$purchasenodate, 
	'purchasenoyear' =>$purchasenoyear, 
	'status'=>1,
	'edit_status'=>1);
	$result=$this->db->insert('purchaseorder_details',$data);
	if($result==true)
	{ 

	$purchaseid = $this->db->insert_id();
	$this->db->query("UPDATE preference_settings SET purchaseorder='' WHERE id=1");
	$sparename=$_POST['itemname'];

	$hsnnos=$_POST['hsnno'];
	$sgsts=$_POST['sgst'];
	$cgsts=$_POST['cgst'];
	$igsts=$_POST['igst'];
	$priceTypes=$_POST['priceType'];

	$count=count($sparename);

	$itemnames=$_POST['itemname'];
	$uom=$_POST['uom'];
	$rates=$_POST['rate'];
	$qty=$_POST['qty'];
	$bom_qty=$_POST['bomqty'];
	$total=$_POST['total'];
	$hsnnoss=$_POST['hsnno'];
	//$selected_bom=$_POST['selected_bom'];
	//$potype=$_POST['potype'];

	$count=count($sparename);



	for ($j=0; $j <  $count; $j++) 
	{
	$podatass=array(
	'date'=>date('Y-m-d'),
	'potype' => $potype,
	'purchasedate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
	'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
	'purchaseorderno' =>$_POST['purchaseorderno'],
	'purchaseorder' =>$_POST['purchaseorder'],
	'selected_bom'=>$selected_bom,				
	'customerId' => $customerid,
	'customername' =>$_POST['customername'], 
	'invoiceno' =>$_POST['invoiceno'], 
	'itemname'=>$itemnames[$j],
	'uom'=>$uom[$j],
	'rate'=>$rate[$j],
	'qty'=>$qty[$j],
	'balaceqty'=>$qty[$j],
	'bom_qty'=>$bom_qty[$j],
	'total'=>$total[$j],
	'hsnno'=>$hsnnoss[$j],
	'address' =>$_POST['address'],  
	'subtotal' =>$_POST['subtotal'], 
	'grandtotal' =>$_POST['grandtotal'], 
	'purchasenodate' =>$purchasenodate, 
	'purchasenoyear' =>$purchasenoyear,
	'purchaseid' =>$purchaseid,
	'status'=>1);
	$this->db->insert('purchaseorder_reports',$podatass);
	}

	$this->session->set_flashdata('msg','purchaseorder Added Successfully');
	//if($_POST['print']=='print')
	if(isset($_POST['print']))
	{
	redirect('purchaseorder/directPrint');
	}
	//if($_POST['save']=='save')
	if(isset($_POST['save']))
	{
	redirect('purchaseorder/view');
	}

	}
	else
	{
	$this->session->set_flashdata('msg1','purchaseorder Added Unsuccessfully');
	redirect('purchaseorder');
	}

	}

	public function view()
	{
	//$data['purchase']=$this->purchaseorder_model->select();
	//$data['vat']=$this->db->get('vat_details')->result_array(); 
	$this->load->view('header');
	$this->load->view('purchaseOrder_view');
	$this->load->view('footer1');
	}

	public function views()
	{
	$id=base64_decode($this->uri->segment(3));
	$data['result']=$this->db->where('id',$id)->get('purchaseorder_details')->result_array(); 
	$this->load->view('header');
	$this->load->view('purchaseOrder_viewDet',$data);
	$this->load->view('footer');
	}

	public function pending()
	{
	$data['view']=$this->purchaseorder_model->select_pending();
	$this->load->view('header');
	$this->load->view('purchaseOrder_pending',$data);
	$this->load->view('footer1');
	}


	public function ajax_list()
	{
	$list = $this->purchaseorder_model->get_datatables();
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
	$row[] = $person->purchaseorderno;
	$row[] = $person->customername;
	$row[] = $numberDays.' Days';
	$row[] = $person->grandtotal;
	$code=base64_encode($person->id);
	//add html for action
	$deleteOptn='<a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$code."'".')">Delete</a>';
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


	<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchaseorder/views/'.$code).'" title="View" >View</a></li>
	<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchaseorder/edit/'.$code).'" title="Edit" >Edit</a></li>
	<!-- <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('purchaseorder/invoice/'.$code).'" title="Hapus" >Print</a></li> -->

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


	<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchaseorder/views/'.$code).'" title="View" >View</a></li>
	<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('purchaseorder/edit/'.$code).'" title="Edit" >Edit</a></li>
	<!-- <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" target="_blank" href="'.base_url('purchaseorder/invoice/'.$code).'" title="Hapus" >Print</a></li>  -->
	<li>'.$deleteOptn.'</li>
	</ul>
	</div>

	';
	}

	$data[] = $row;
	}

	$output = array(
	"draw" => $_POST['draw'],
	"recordsTotal" => $this->purchaseorder_model->count_all(),
	"recordsFiltered" => $this->purchaseorder_model->count_filtered(),
	"data" => $data,
	);
	//output to json format
	echo json_encode($output);
	}



	public function ajax_delete($id)
	{
	$this->purchaseorder_model->delete_by_id($id);
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
	$this->db->where('itemtype','Raw Material');
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
	$name[]             = $json_array;
	}
	echo json_encode($name);
	}

	public function edit()
	{
	$id=base64_decode($this->uri->segment(3));
	$data['result']=$this->db->where('id',$id)->get('purchaseorder_details')->result_array(); 
	// echo"<prE>";
	// print_r($data['result']);
	$this->load->view('header');
	$this->load->view('purchaseOrder_edit',$data);
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
	$this->db->from('purchaseorder_details');
	$this->db->like('purchaseno',$name);
	$this->db->where('purchasetype','Direct purchaseorder');
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

	public function autocomplete_purchaseorderno()
	{
	$name=$this->input->post('keyword');
	$this->db->select('*');
	$this->db->from('purchaseorder_details');
	$this->db->like('purchaseorderno',$name);
	$query = $this->db->get();
	$result = $query->result();
	$name       =  array();
	foreach ($result as $d) 
	{
	$json_array             = array();
	$json_array['value']    = $d->purchaseorderno;
	$json_array['label']    = $d->purchaseorderno;
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
	//print_r($this->input->post());
	//exit;
	/*Array ( [hiddenDiscountBy] => percent_wise [purchasedate] => 21-12-2017 [invoicedate] => 21-12-2017 [suppliername] => Supplier [supplierid] => 2 [gsttype] => intrastate [address] => Aasath Nagar, SMM Flour Mill, Virudhunagar, Tamil Nadu [hsnno] => Array ( [0] => 004 [1] => 005 ) [itemno] => Array ( [0] => [1] => ) [itemname] => Array ( [0] => 100MM Sheet [1] => 200MM Sheet ) [priceType] => Array ( [0] => Exclusive [1] => Exclusive ) [qty] => Array ( [0] => 10 [1] => 10 ) [qtys] => Array ( [0] => 10 [1] => 10 ) [uom] => Array ( [0] => PCs [1] => PCs ) [rate] => Array ( [0] => 150 [1] => 150 ) [amount] => Array ( [0] => 1500.00 [1] => 1500.00 ) [gstcal] => Array ( [0] => [1] => ) [discount] => Array ( [0] => 0 [1] => 0 ) [taxableamount] => Array ( [0] => 1500.00 [1] => 1500.00 ) [discountamount] => Array ( [0] => [1] => ) [cgst] => Array ( [0] => 6 [1] => 6 ) [cgstamount] => Array ( [0] => 90.00 [1] => 90.00 ) [sgst] => Array ( [0] => 6 [1] => 6 ) [sgstamount] => Array ( [0] => 90.00 [1] => 90.00 ) [total] => Array ( [0] => 1680.00 [1] => 1680.00 ) [freightamount] => 100 [freightcgst] => 5 [freightcgstamount] => 5.00 [freightsgst] => 5 [freightsgstamount] => 5.00 [freighttotal] => 110.00 [loadingamount] => 50 [loadingcgst] => 5 [loadingcgstamount] => 2.50 [loadingsgst] => 5 [loadingsgstamount] => 2.50 [loadingtotal] => 55.00 [subtotal] => 3525.00 [roundOff] => 0 [othercharges] => 0 [grandtotal] => 3525.00 [taxtotal] => [purchaseorderno] => P001 [id] => 1 )*/
	$id=$this->input->post('id');

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
	$igst = implode('||',$res);
	$sgstamount = implode('||',$_POST['sgstamount']);
	$cgstamount = implode('||',$_POST['cgstamount']);
	$igstamount = implode('||',$res);
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
	'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
	'customerId' => $customerid,
	'customername' =>$_POST['customername'],
	'address' =>$_POST['address'], 
	'purchaseorderno' =>$_POST['purchaseorderno'], 
	'purchaseorder' =>$_POST['purchaseorder'],
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
	$result=$this->db->update('purchaseorder_details',$data);
	// $results=$this->purchaseorder_model->update_invoice($data,$id);
	if($result)
	{
	$this->db->where('purchaseid',$id)->delete('purchaseorder_reports');
	$purchaseid = $_POST['id'];
	$purchasenoyear=$_POST['purchaseorderno'].''.date('-Y').'';
	$purchasenodate=$_POST['purchaseorderno'].''.date('dmy').'';
	$itemnames=$_POST['itemname'];
	$hsnnoss=$_POST['hsnno'];
	$postItemName = $_POST['itemname'];
	$uom = $_POST['uom'];
	$rates=$_POST['rate'];
	$qty=$_POST['qty'];
	$total=$_POST['total'];
	$customerid=$_POST['customerid'];
	$count=count($postItemName);

	for ($j=0; $j <  $count; $j++) 
	{

	$podatass=array(
	'date'=>date('Y-m-d'),
	'purchasedate' =>date('Y-m-d',strtotime($_POST['purchasedate'])), 
	'invoicedate' =>date('Y-m-d',strtotime($_POST['invoicedate'])), 
	'purchaseorderno' =>$_POST['purchaseorderno'],
	'purchaseorder' =>$_POST['purchaseorder'],
	'customerId' => $customerid,
	'customername' =>$_POST['customername'],
	'invoiceno' =>$_POST['invoiceno'], 
	'itemname'=>$postItemName[$j],
	'uom'=>$uom[$j],
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
	'status'=>1
	);
	$this->db->insert('purchaseorder_reports',$podatass);
	}

	$this->session->set_flashdata('msg','purchaseorder Updated Successfully');
	redirect('purchaseorder/view');
	}
	else
	{
	$this->session->set_flashdata('msg1','No Changes');
	redirect('purchaseorder/view');
	}

	}

	public function search()
	{ 
	$fromdate=$this->input->post('fromdate');
	$todate=$this->input->post('todate');
	$customername=$this->input->post('customername');
	$purchaseorderno=$this->input->post('purchaseorderno');

	$data=array(
	'rcbio_fromdate' => $fromdate,
	'rcbio_todate' => $todate,
	'rcbio_customername' => $customername,
	'rcbio_purchaseorderno' => $purchaseorderno,
	'rcbio_bill_format' =>'Print',
	);
	$this->session->set_userdata($data);
	}


	public function search_reports()
	{   
	$bill_format=$this->session->userdata('rcbio_bill_format');                
	$data['purchase']=$this->purchaseorder_model->search_billing();
	$data['fromdate']=$this->session->userdata('rcbio_fromdate');
	$data['todate']=$this->session->userdata('rcbio_todate');
	$data['customername']=$this->session->userdata('rcbio_customername');
	$data['purchaseorderno']=$this->session->userdata('rcbio_purchaseorderno');
	$this->load->view('purchaseOrder_searchreports',$data);
	}  


	public function delete()
	{
	$del=base64_decode($this->input->post('id'));
	$getdetails=$this->db->where('id',$del)->get('purchaseorder_details')->result();
	foreach($getdetails as $row)
	$purchaseorderno = $row->purchaseorderno;


	$data=$this->db->where('id',$del)->delete('purchaseorder_details');
	if($data)
	{
	$this->db->where('purchaseid',$del)->delete('purchaseorder_reports');
	echo 'yes';
	}
	else
	{
	echo'no';   
	}
	}

	
	public function pending_search()
	{
	$data['pending']=$this->purchaseorder_model->search_reports();
	$this->load->view('header');
	$this->load->view('purchase_pending_view',$data);
	$this->load->view('footer1');
	}


	public function purchase_reports()
	{
	@$suppliername=$_POST['suppliername'];
	@$fromdate=$_POST['fromdate'];
	@$todate=$_POST['todate'];
	$data['pending']=$this->purchaseorder_model->search_pending();
	// echo"<pre>";
	// print_r($data);
	$this->load->view('purchase_reports',$data,$fromdate,$todate,$suppliername);
	}

	public function reports()
	{
	@$suppliername=$_POST['suppliername'];
	@$fromdate=$_POST['fromdate'];
	@$todate=$_POST['todate'];
	$data['pending']=$this->purchaseorder_model->search_reports();
	$this->load->view('purchase_reports2',$data,$fromdate,$todate);
	}

	public function reports1()
	{
	@$suppliername=$_POST['suppliername'];
	@$fromdate=$_POST['fromdate'];
	@$todate=$_POST['todate'];
	$data['pending']=$this->purchaseorder_model->search_pending();
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
	public function autocomplete_vendorname()
	{
	$orderno=$this->input->post('keyword');
	$this->db->select('*');
	$this->db->from('vendor_details');
	$this->db->like('vendorname',$orderno);
	$query = $this->db->get();
	$result = $query->result();
	$name       =  array();
	foreach ($result as $d){
	$json_array             = array();
	$json_array['label']    = $d->vendorname;
	$json_array['value']    = $d->vendorname;
	$json_array['id']    = 	$d->id;
	$json_array['vendordetails']    = 	$d->address1.', '.$d->address2;
	$name[]             = $json_array;
	}
	echo json_encode($name);
	}

	public function check_vendors()
	{
	$name=$_POST['vendors'];
	$data=$this->db->where('vendorname',$name)->get('vendor_details')->result();
	echo $count=count($data);
	}

	Public function get_bomno()
	{
	$query=$this->db->where('status',1)->group_by('bomno')->get('bom_details');
	$result= $query->result();
	$data=array(); 
	if($result)
	{
	foreach($result as $r)
	{
	$data['value']=$r->bomno;
	$data['label']=$r->bomno;
	$json[]=$data;
	}
	}
	echo json_encode($json);
	}

	public function getbomdetails()
	{
	$selected_bom=$this->input->post('selected_bom');
	if($selected_bom=='')
	{
	$html='<div class="text-center" style="color:red;font-weight:bold;"><span>Please Select BOM No</span></div>';
	}
	else
	{
	$result = "'" . implode ( "', '", $selected_bom ) . "'";

	/*$count=count($selected_bom);
	for ($i=0; $i < $count; $i++) { 
	$data[]=$this->db->where('joborderno',$jobOrder[$i])->get('job_data_returnable')->result_array();//->where('balanceqty >',0)
	}*/
	$query = "SELECT SUM(qty) AS totQty,itemname,hsnno,uom,price FROM  `bom_reports` WHERE bomno IN (".$result.") GROUP BY hsnno";
	$queryRes = $this->db->query($query);
	$data = $queryRes->result_array();
	$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
	if($discountBy=='percent_wise') { $discType= '%'; } else { $discType=''; }

	$html='
	<div class="table-responsive myform" >
	<table class="responsive table" width="100%">
	<thead> 
	<tr>
	<th>HSN Code</th>
	<th>Item Name</th>
	<th>Qty</th>
	<th>UOM</th>
	<th>Rate</th>
	<th>Amount</th>
	<th>Disc '.$discType.'</th>
	<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
	<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
	<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
	<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
	<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
	<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
	<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
	<th>Total</th>
	<th>&nbsp;</th>
	</tr>  
	</thead>
	<tbody>';
	$k=0;
	foreach ($data as $rows) 
	{
	//foreach ($datas as $rows) 
	//{
	//$amount = 
	$itemDet=$this->db->select('*')->where('hsnno', $rows['hsnno'])->where('itemname',$rows['itemname'])->get('additem')->row();
	$html.='
	<tr>
	<td><input class="" id="hsnno'.$k.'" parsley-trigger="change"  readonly type="text" name="hsnno[]" value="'.$rows['hsnno'].'" ><div id="hsnno_valid'.$k.'"></div><input type="hidden" name="priceType[]" id="priceType'.$k.'" value="'.$itemDet->priceType.'"/></td>

	<td><input class="itemname_class" data-id="'.$k.'" id="itemname'.$k.'" parsley-trigger="change" required  type="text" name="itemname[]" value="'.$rows['itemname'].'" ><div id="itemname_valid'.$k.'"></div></td>

	<td><input class="qty_class decimals" id="qty'.$k.'" data-id="'.$k.'" parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off" value=""><div id="qty_valid'.$k.'"></div><input type="hidden" name="bomqty[]" id="bomqty'.$k.'" value="'.$rows['totQty'].'" ><div style="color:green;">BOM Qty : '.$rows['totQty'].'</div></td>  

	<td><input class="" id="uom'.$k.'" parsley-trigger="change"  readonly  type="text" name="uom[]"  autocomplete="off" value="'.$rows['uom'].'"><div id="uom_valid'.$k.'"></div></td>

	<td><input class="rate_class decimals" data-id="'.$k.'" parsley-trigger="change"  id="rate'.$k.'" required type="text" name="rate[]"   autocomplete="off" value="'.$rows['price'].'"><div id="rate_valid'.$k.'"></div></td>

	<td><input class="decimals" id="amount'.$k.'" parsley-trigger="change"  readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid'.$k.'"></div></td>

	<td><input class="discount_class decimals" id="discount'.$k.'" data-id="'.$k.'"  type="text" name="discount[]" onkeypress="return isNumber(event)" value="0"  autocomplete="off"><div id="discount_valid'.$k.'"></div></td>

	<td><input class="decimals" id="taxableamount'.$k.'" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount'.$k.'"><div id="taxableamount_valid'.$k.'"></div></td>

	<td class="sgst"><input class="decimals" readonly id="cgst'.$k.'"  type="text" name="cgst[]" onkeypress="return isNumberKey(event)" autocomplete="off" value="'.$itemDet->cgst.'"><div id="cgst_valid'.$k.'"></div></td>

	<td class="sgst"><input class="decimals" readonly id="cgstamount'.$k.'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td class="sgst"><input class="decimals" id="sgst'.$k.'" readonly  type="text" name="sgst[]" value="'.$itemDet->sgst.'" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid'.$k.'"></div></td>

	<td class="sgst"><input class="decimals" id="sgstamount'.$k.'"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td class="igst" style="display:none;"><input class="decimals" id="igst'.$k.'"  type="text" name="igst[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" value="'.$itemDet->sgst.'"><div id="igst_valid'.$k.'"></div></td>

	<td class="igst" style="display:none;"><input class="decimals" id="igstamount'.$k.'"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td><input class="" id="total'.$k.'" type="text" name="total[]" value=""  readonly ></td>
	<td style="width:10px;">&nbsp;</td>
	';

	if($k==0)
	{
	$html .= '<td>&nbsp;</td>';
	}
	else
	{
	$html .='<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>';
	}
	$html .='
	</tr>';
	$k++;
	//}
	}
	$html.='
	</tbody>
	</table>

	<script>
	$(".remove").click(function(){
	$(this).parents("tr").remove();
	});
	</script>';

	$html.='
	<script>
	$(".qty_class").keyup(function(){
	var id=$(this).attr(\'data-id\');
	if($(this).val()==\'\') { $(this).val("0"); }
	var qty=(isNaN($("#qty"+id).val())) ? 0 : $("#qty"+id).val();
	var bomqty=$("#bomqty"+id).val();
	if(parseFloat(qty) > parseFloat(bomqty))
	{
	alert("Invalid Qty");
	$(this).val("0");
	$(this).focus();
	}
	});
	</script>
	';
	}
	echo $html;
	}
	function getaddpurchasedetails()
	{
	$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
	if($discountBy=='percent_wise') { $discType= '%'; } else { $discType=''; }
	$html ='
	<div class="table-responsive myform directPurchaseDet" >
	<table class="table two">
	<thead> 
	<tr>
	<th style="width:70px">HSN Code</th>
	<th style="width:150px">Item Name <!--<a target="_blank" href="<?php echo base_url();?>itemmaster">(Add Item)</a>--></th>
	<th style="width:50px">Qty</th>
	<th style="width:50px">UOM</th>
	<th style="width:70px">Rate</th>
	<th style="width:100px">Amount</th>
	<th style="width:40px">Disc '.$discType.'</th>
	<th style="width:100px">&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
	<th class="sgst" style="width:45px">&nbsp;&nbsp;&nbsp;CGST</th>
	<th class="sgst" style="width:80px">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
	<th class="sgst" style="width:45px">&nbsp;&nbsp;&nbsp;SGST</th>
	<th class="sgst" style="width:80px">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
	<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
	<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
	<th style="width:110px">Total</th>
	<th style="width:10px;">&nbsp;</th>
	</tr>   
	</thead>
	<tbody>
	<tr>
	<td><input class="" id="hsnno0" parsley-trigger="change"  readonly type="text" name="hsnno[]" value="" ><div id="hsnno_valid0"></div><input type="hidden" name="priceType[]" id="priceType0" /></td>

	<td><input class="itemname_class" data-id="0" id="itemname0" parsley-trigger="change" required  type="text" name="itemname[]" value="" ><div id="itemname_valid0"></div></td>

	<td><input class="qty_class decimals" id="qty0" data-id="0" parsley-trigger="change" required type="text" name="qty[]"  autocomplete="off" ><div id="qty_valid0"></div><input type="hidden" name="bomqty[]" value="0"></td>  

	<td><input class="" id="uom0" parsley-trigger="change"  readonly  type="text" name="uom[]"  autocomplete="off"><div id="uom_valid0"></div></td>

	<td><input class="rate_class decimals" data-id="0" parsley-trigger="change"  id="rate0" required type="text" name="rate[]"   autocomplete="off"><div id="rate_valid0"></div></td>

	<td><input class="decimals" id="amount0" parsley-trigger="change"  readonly type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid0"></div></td>

	<td><input class="discount_class decimals" id="discount0" data-id="0"  type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off"><div id="discount_valid0"></div></td>

	<td><input class="decimals" id="taxableamount0" readonly type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount0"><div id="taxableamount_valid0"></div></td>

	<td class="sgst"><input class="decimals" readonly id="cgst0"  type="text" name="cgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid0"></div></td>

	<td class="sgst"><input class="decimals" readonly id="cgstamount0"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td class="sgst"><input class="decimals" id="sgst0" readonly  type="text" name="sgst[]" value="" onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid0"></div></td>

	<td class="sgst"><input class="decimals" id="sgstamount0"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td class="igst" style="display:none;"><input class="decimals" id="igst0"  type="text" name="igst[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid0"></div></td>

	<td class="igst" style="display:none;"><input class="decimals" id="igstamount0"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly value=""></td>

	<td><input class="" id="total0" type="text" name="total[]" value=""  readonly ></td>
	<td style="width:10px;">&nbsp;</td>
	</tr>
	</tbody>
	<tbody id="append"></tbody> 
	</table> 
	</div>


	';
	echo $html;
	}

	public function invoice()
	{
	$id=base64_decode($this->uri->segment(3));
	// $this->load->library('mpdf'); 
	$data['pre']=$this->db->where('id',$id)->get('purchaseorder_details')->result();

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
	$data['invoice']=$this->db->where('id',$id)->get('purchaseorder_details')->result();
	//$this->load->view('invoicebill',$data);
	$this->load->view('purchaseOrder_bill',$data);
	}

	public function directPrint()
	{
	$data['pre']=$this->db->order_by('id','desc')->limit(1)->get('purchaseorder_details')->result();
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
	$data['profile']=$this->db->get('profile')->result();
	$data['invoice']=$data['pre'];

	$this->load->view('purchaseOrder_bill',$data);
	//$this->load->view('invoicebill',$data);
	// $this->load->view('invoice_bill',$data);


	}

	}

	ob_flush();
	?>