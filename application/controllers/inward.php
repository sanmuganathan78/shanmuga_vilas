<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Inward extends CI_Controller {

public function __construct()
{
parent::__construct();
$this->load->model('inward_model');
if($this->session->userdata('rcbio_login')=='')
{
$this->session->set_flashdata('msg','Please Login to continue!');
redirect('login');
}
}
public function index()
{

$mysqli = new mysqli("localhost", "root", "", "shanmuga_vilas");
$query_update1 =$mysqli->query("SELECT * FROM inward_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
while($row = mysqli_fetch_array($query_update1))  
{
@$quotationnos=$row['inwardno'];           
}
if(date('m')=='04')
{
$month=date('m');
$year=date('Y');
$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->get('inward_details')->result_array();
if($old)
{
@$bond_no = $quotationnos;
if(is_null($bond_no))
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_noo ='I'. $default_bond->inward;
//$new_bond_noo = 'I00001'; 
} 
else 
{
$default_bond=$this->db->where('id',1)->where('inward !=','')->get('preference_settings')->row();
if($default_bond)
{
$bond_no='I'.$default_bond->inward;
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'I'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
}
else
{
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'I'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
}
}
}
else
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_noo = 'I'.$default_bond->inward;
//$new_bond_noo = 'I00001';
}
}
else
{
@$bond_no = $quotationnos;
if(is_null($bond_no))
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_noo = 'I'.$default_bond->inward;
//$new_bond_noo = 'I00001'; 
} 
else
{
$default_bond=$this->db->where('id',1)->where('inward !=','')->get('preference_settings')->row();
if($default_bond)
{
@$bond_no='I'.$default_bond->inward;
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'I'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
}
else
{
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
@$new_bond_noo = 'I'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
}
}
}
$data['cusno']=$new_bond_noo;
$this->load->view('header');
$this->load->view('add_inward',$data);
$this->load->view('footer1');
}

Public function create()
{
$type=$this->uri->segment(3);    
$data['']=$this->backup_model->create_backup($type);
}

public function insert()
{
  $mysqli = new mysqli("localhost", "root", "", "shanmuga_vilas");  
$query_update1 =$mysqli->query("SELECT * FROM inward_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
while($row = mysqli_fetch_array($query_update1))  
{
@$quotationnos=$row['inwardno'];           
}
@$bond_no = $quotationnos;
if(is_null($bond_no))
{
$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
$new_bond_noo = 'I'.$default_bond->inward;
} 
else
{
$default_bond=$this->db->where('id',1)->where('inward !=','')->get('preference_settings')->row();
if($default_bond)
{
@$bond_no='I'.$default_bond->inward;
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'I'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
}
else
{
$bondLen = strlen($bond_no)-1;
$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
$new_bond_noo = 'I'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
}
}

$inwardno=$new_bond_noo;

// $hsnno=implode('||',array_filter($_POST['hsnno']));
$itemname=implode('||',array_filter($_POST['itemname']));
$item_desc=implode('||',array_filter($_POST['item_desc']));
$uom=implode('||',array_filter($_POST['uom']));
$qty=implode('||',array_filter($_POST['qty']));
$remarks=implode('||',array_filter($_POST['remarks']));
$inwardnoyear=$_POST['inwardno'].''.date('-y').'';
$inwardnodate=$_POST['inwardno'].''.date('dmy').'';

$data=array('date'=>date('Y-m-d'),
'inwardno'=>$inwardno,
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
// 'cusname'=>$_POST['cusname'],
// 'address'=>$_POST['address'], 
// 'customerdcno'=>$_POST['customerdcno'],
// 'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemname,
'item_desc'=>$item_desc,
'qty'=>$qty,
'remarks'=>$remarks,
// 'hsnno'=>$hsnno,
'uom'=>$uom,
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'delete_status'=>1, 
);

$result=$this->inward_model->add($data);
if($result==true)
{
$insertid=$this->db->insert_id();
$this->db->query("UPDATE preference_settings SET inward='' WHERE id=1");
// $hsnnos=$_POST['hsnno'];
$itemnames=$_POST['itemname'];
$item_descs=$_POST['item_desc'];
$uoms=$_POST['uom'];
$qtys=$_POST['qty'];
$remarkss=$_POST['remarks'];
$count=count($_POST['itemname']);
$insertIdArray =array();
for ($i=0; $i <$count ; $i++) { 
	$item=$this->db->where('itemname',$itemnames[$i])->get('inward_delivery')->result();
if($item)
{
foreach($item as $j)
{
$qty=$j->qty;
$currentstock=$j->balanceqty;
$id=$j->id;
}
$totalstk=$currentstock+$qtys[$i];
	// print_r($totalstk);exit;

$datas=array('date'=>date('Y-m-d'),
// 'insertid'=>$insertid,
// 'inwardno'=>$inwardno,
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
// 'cusname'=>$_POST['cusname'],
// 'address'=>$_POST['address'], 
// 'customerdcno'=>$_POST['customerdcno'],
// 'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemnames[$i],
'item_desc'=>$item_descs[$i],
'qty'=>$qtys[$i],
'balanceqty'=>$totalstk,
'remarks'=>$remarkss[$i],
// 'hsnno'=>$hsnnos[$i],
'uom'=>$uoms[$i],
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'inward_status'=>1, 
);
$this->db->where('id',$id)->update('inward_delivery',$datas);
$insertIdArray[]=$this->db->insert_id();
}else{
	$datas=array('date'=>date('Y-m-d'),
// 'insertid'=>$insertid,
// 'inwardno'=>$inwardno,
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
// 'cusname'=>$_POST['cusname'],
// 'address'=>$_POST['address'], 
// 'customerdcno'=>$_POST['customerdcno'],
// 'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemnames[$i],
'item_desc'=>$item_descs[$i],
'qty'=>$qtys[$i],
'balanceqty'=>$qtys[$i],
'remarks'=>$remarkss[$i],
// 'hsnno'=>$hsnnos[$i],
'uom'=>$uoms[$i],
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'inward_status'=>1, 
);
$this->db->insert('inward_delivery',$datas);
}
}
// $this->db->query("UPDATE inward_details SET inward_delivery_id='".implode(",",$insertIdArray)."' WHERE id='".$insertid."' ");
$this->session->set_flashdata('msg','Inward Added Successfully');
redirect('inward');
}
else
{
$this->session->set_flashdata('msg1','Inward Added Unsuccessfully');
redirect('inward');
}

}

public function edit()
{
$id=base64_decode($this->uri->segment(3));
$data['result']=$this->db->where('id',$id)->get('inward_details')->result_array(); 
$this->load->view('header');
$this->load->view('edit_inward',$data);
$this->load->view('footer');
}

public function update()
{
$id=$_POST['id'];
$hsnno=implode('||',array_filter($_POST['hsnno']));
$itemname=implode('||',array_filter($_POST['itemname']));
$item_desc=implode('||',array_filter($_POST['item_desc']));
$uom=implode('||',array_filter($_POST['uom']));
$qty=implode('||',array_filter($_POST['qty']));
$remarks=implode('||',array_filter($_POST['remarks']));
$inwardnoyear=$_POST['inwardno'].''.date('-y').'';
$inwardnodate=$_POST['inwardno'].''.date('dmy').'';
$inward_delivery_id = implode(",",$_POST['inward_delivery_id']);

$data=array('date'=>date('Y-m-d'),
'inwardno'=>$_POST['inwardno'],
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
'cusname'=>$_POST['cusname'],
'address'=>$_POST['address'], 
'customerdcno'=>$_POST['customerdcno'],
'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemname,
'item_desc'=>$item_desc,
'qty'=>$qty,
'remarks'=>$remarks,
'hsnno'=>$hsnno,
'uom'=>$uom,
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'inward_delivery_id' => $inward_delivery_id
);
$result=$this->inward_model->updates($data,$id);
if($result==true)
{
$checkdata=$this->db->where('insertid',$_POST['id'])->get('inward_delivery')->result_array();
if($checkdata)
{
$counts=count($checkdata);
for ($j=0; $j <$counts ; $j++) { 
$this->db->where('insertid',$_POST['id'])->delete('inward_delivery');
}
}
$insertid=$id;
$hsnnos=$_POST['hsnno'];
$itemnames=$_POST['itemname'];
$item_descs=$_POST['item_desc'];
$uoms=$_POST['uom'];
$qtys=$_POST['qty'];
$remarkss=$_POST['remarks'];
$inwdelId = $_POST['inward_delivery_id'];
$count=count($_POST['itemname']);
$insertIdArray =array();
for ($i=0; $i <$count ; $i++) { 
if($inwdelId[$i]=='')
{
$datas=array(
'date'=>date('Y-m-d'),
'insertid'=>$insertid,
'inwardno'=>$_POST['inwardno'],
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
'cusname'=>$_POST['cusname'],
'address'=>$_POST['address'], 
'customerdcno'=>$_POST['customerdcno'],
'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemnames[$i],
'item_desc'=>$item_descs[$i],
'qty'=>$qtys[$i],
'balanceqty'=>$qtys[$i],
'remarks'=>$remarkss[$i],
'hsnno'=>$hsnnos[$i],
'uom'=>$uoms[$i],
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'inward_status'=>1, 
);
$this->db->insert('inward_delivery',$datas);
$insertIdArray[]=$this->db->insert_id();
}
else
{
$datas=array('id' => $inwdelId[$i],
'date'=>date('Y-m-d'),
'insertid'=>$insertid,
'inwardno'=>$_POST['inwardno'],
'inwarddate'=>date('Y-m-d',strtotime($_POST['inwarddate'])),
'cusname'=>$_POST['cusname'],
'address'=>$_POST['address'], 
'customerdcno'=>$_POST['customerdcno'],
'customerdcdate'=>date('Y-m-d',strtotime($_POST['customerdcdate'])),
'itemname'=>$itemnames[$i],
'item_desc'=>$item_descs[$i],
'qty'=>$qtys[$i],
'balanceqty'=>$qtys[$i],
'remarks'=>$remarkss[$i],
'hsnno'=>$hsnnos[$i],
'uom'=>$uoms[$i],
'inwardnoyear'=>$inwardnoyear,
'inwardnodate'=>$inwardnodate,
'status'=>1, 
'inward_status'=>1, 
);
$this->db->insert('inward_delivery',$datas);
$insertIdArray[]=$inwdelId[$i];
}

}
$this->db->query("UPDATE inward_details SET inward_delivery_id='".implode(",",$insertIdArray)."' WHERE id='".$insertid."' ");
$this->session->set_flashdata('msg','Inward Added Successfully');
redirect('inward');
}
else
{
$this->session->set_flashdata('msg1','Inward Added Unsuccessfully');
redirect('inward');
}
}

public function view()
{
$data['inward']=$this->inward_model->select();
$this->load->view('header');
$this->load->view('inward_view',$data);
$this->load->view('footer1');
}

public function pending()
{
$data['view']=$this->inward_model->select_pending();
$this->load->view('header');
$this->load->view('inward_pending',$data);
$this->load->view('footer1');
}

public function autocomplete_cusname()
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
$name[]             = $json_array;
}
echo json_encode($name);
}




public function ajax_list()
{
$list = $this->inward_model->get_datatables();
//print_r($list);
$data = array();
$no = $_POST['start'];
$a=1;
$totalamount[]=array();
foreach ($list as $person) {
$no++;
$row = array();
$row[] = $a++;
$row[] = date('d-m-Y',strtotime($person->inwarddate));
$row[] =$person->inwardno;
$row[] = $person->cusname;
$row[] = $person->customerdcno;
$row[] = date('d-m-Y',strtotime($person->customerdcdate));
//$delestatus=$this->db->where('insertid',$person->id)->get('inward_delivery')->num_rows();
//$inwardstatus=$this->db->select_sum('inward_status')->where('insertid',$person->id)->get('inward_delivery')->row()->inward_status;
$delestatus=$person->delete_status;
if($delestatus==1) 
{ 
$editLink = base_url().'inward/edit/'.base64_encode($person->id);
$deleteLink = 'delete_person('."'".$person->id."'".')';
}
else
{
$editLink = 'javascript:alert(\'Sorry! You cannot able to edit\');';
$deleteLink = 'javascript:alert(\'Sorry! You cannot able to delete\');';
}
$htmls='
<div class="btn-group">
<button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light"  data-toggle="dropdown" aria-expanded="false">Manage <span class="caret"></span></button>
<ul class="dropdown-menu" role="menu" style="background: #23BDCF  none repeat scroll 0% 0%;width:14px;min-width: 100%;">
<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Delete" onclick="view_person('."'".$person->id."'".')">View</a></li>';
$htmls.='<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.$editLink.'" >Edit </a></li>';
$htmls.='<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Delete" onclick="'.$deleteLink.'" >Delete</a></li>';

/*if($delestatus==$inwardstatus)
{
$htmls.='<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url().'inward/edit/'.base64_encode($person->id).'" >Edit '.$delestatus.'</a></li>';
$htmls.='<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Delete" onclick="delete_person('."'".$person->id."'".')">Delete</a></li>';
}
else
{
}*/

$htmls.='
</ul>
</div>
';
$row[] = $htmls;
$data[] = $row;
}
$output = array(
"draw" => $_POST['draw'],
"recordsTotal" => $this->inward_model->count_all(),
"recordsFiltered" => $this->inward_model->count_filtered(),
"data" => $data,
);
//output to json format
echo json_encode($output);
}


public function search()
{ 
$fromdate=$this->input->post('fromdate');
$todate=$this->input->post('todate');
$customername=$this->input->post('customername');

$data=array('rcbio_fromdate' => $fromdate,
'rcbio_todate' => $todate,
'rcbio_customername' => $customername,
'rcbio_bill_format' =>'Print',
);
$this->session->set_userdata($data);
}


public function search_reports()
{   
$bill_format=$this->session->userdata('rcbio_bill_format');                
if($bill_format=='Print')
{
$data['purchase']=$this->inward_model->search_billing();
$data['fromdate']=$this->session->userdata('rcbio_fromdate');
$data['todate']=$this->session->userdata('rcbio_todate');
$data['customername']=$this->session->userdata('rcbio_customername');
$this->load->view('inwardstmt_report',$data);
}

}

public function viewbilling()
{
$id=$this->input->post('id');
$data=$this->db->where('id',$id)->get('inward_details')->result_array();
if($data)
{
foreach ($data as $row) {
$html='
<div class="row">
<table class="table m-0">
<thead>
<tr>
<th>S.No</th>
<th>HSN Code</th>
<th>Item Name</th>
<th>UOM</th>
<th>Qty</th>
<th>Remarks</th>
</tr>   
</thead>
<tbody>';
$hsnno=explode('||',$row['hsnno']);
$itemname=explode('||',$row['itemname']);
$uom=explode('||',$row['uom']);
$qty=explode('||',$row['qty']);
$remarks=explode('||',$row['remarks']);
$count=count($itemname);
$a=1;
for ($i=0; $i < $count; $i++) { 
$html.='
<tr>
<td>'.$a++.'</td>
<td>'.$hsnno[$i].'</td>
<td>'.$itemname[$i].'</td>
<td>'.$uom[$i].'</td>
<td>'.$qty[$i].'</td>
<td>'.@$remarks[$i].'</td>
</tr>';

}

$html.='
</tbody>
</table>
</div>
<div class="row">
<div class="col-md-4"></div>
<div class="col-md-4"></div>
</div>';
}
}
else
{
$html='';
}
echo $html;
}

//       public function ajax_delete($id)
// {
//  $this->inward_model->delete_by_id($id);
//  echo json_encode(array("status" => TRUE));
// }

Public function delete()
{    
$data=$this->db->where('id',$_POST['id'])->delete('inward_details');
if($data)
{
$checkdata=$this->db->where('insertid',$_POST['id'])->get('inward_delivery')->result_array();
if($checkdata)
{
$count=count($checkdata);
for ($i=0; $i <$count ; $i++) { 
$this->db->where('insertid',$_POST['id'])->delete('inward_delivery');
}
}
echo'yes';
}
else
{
echo'no';   
} 
}

public function autocomplete_name()
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
$name[]             = $json_array;
}
echo json_encode($name);
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
$name[]             = $json_array;
}
echo json_encode($name);
}

public function get_name()
{
$cusname=$this->input->post('cusname');
$this->db->select('*');
$this->db->from('customer_details');
$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')");
$this->db->where('name',$cusname);
$query = $this->db->get();
$result = $query->result();
foreach($result as $s)
{   
$vob['address']=$s->address1.', '.$s->address2;
}
echo json_encode($vob);
}

public function check_itemname()
{
$name=$_POST['itemname'];
$data=$this->db->where('itemname',$name)->get('additem')->result();
echo $count=count($data);
}

public function check_cusname()
{
$name=$_POST['cusname'];
$data=$this->db->where("(type = 'Intra customer' OR type = 'Inter customer')")->where('name',$name)->get('customer_details')->result();
echo $count=count($data);
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
@$uom=$this->db->select('uom')->where('id',$h->uom)->get('uom')->row()->uom;
$vob['hsnno']=$h->hsnno;
$vob['uom']=$uom;
}
echo json_encode($vob);
}
}
ob_flush();
?>