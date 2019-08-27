<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Quotation extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('quotation_model');
    if($this->session->userdata('rcbio_login')=='')
    {

      $this->session->set_flashdata('msg','Please Login to continue!');
      redirect('login');
    } 
    date_default_timezone_set('Asia/Kolkata');    
  }

	public function index()
	{
		
$mysqli = new mysqli("localhost", "erpin_billing", "erpin_billing", "erpin_billing");
$query_update1 =$mysqli->query("SELECT * FROM quotation_details WHERE status ='1' ORDER BY id DESC LIMIT 1");
		while($row = mysqli_fetch_array($query_update1))
		{
			@$quotationnos=$row['quotationno'];
		}
		
		if(date('m')=='04')
		{
			$month=date('m');
			$year=date('Y');
			$old=$this->db->where('month(date)', $month)->where('year(date) ', $year)->where('status',1)->get('quotation_details')->result_array();
			if($old)
			{
				@$bond_no = $quotationnos;
				if(is_null($bond_no))
				{
					$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
					$new_bond_noo = 'Q'.$default_bond->quotation;
					//$new_bond_noo = 'Q00001'; 
				} 
				else 
				{
					$default_bond=$this->db->where('id',1)->where('quotation !=','')->get('preference_settings')->row();
					if($default_bond)
					{
						$bond_no='Q'.$default_bond->quotation;
						$bondLen = strlen($bond_no)-1;
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_noo = 'Q'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
					}
					else
					{
						$bondLen = strlen($bond_no)-1;
						$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
						$new_bond_noo = 'Q'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
					}
					
					/*$old_bond_noo = str_split($bond_no,2);
					@$va = (string)($old_bond_noo[1].$old_bond_noo[2].$old_bond_noo[3])+1;  
					$bond_length = strlen($va);
					if($bond_length == 1)
					{
						$new_bond_noo = 'Q0000'.$va;  
					} 
					else if($bond_length == 2)
					{  
						$new_bond_noo = 'Q000'.$va; 
					}
					else if($bond_length == 3)
					{  
						$new_bond_noo = 'Q00'.$va; 
					}
					else if($bond_length == 4)
					{  
						$new_bond_noo = 'Q0'.$va; 
					}
					else if($bond_length == 5)
					{  
						$new_bond_noo = 'Q'.$va; 
					}*/
				}
			}
			else
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$new_bond_noo = 'Q'.$default_bond->quotation;
				//$new_bond_noo = 'Q00001';
			}
		}
		else
		{
			@$bond_no = $quotationnos;
			if(is_null($bond_no))
			{
				$default_bond=$this->db->where('id',1)->get('preference_settings')->row();
				$new_bond_noo = 'Q'.$default_bond->quotation;
				//$new_bond_noo = 'Q00001'; 
			} 
			else
			{
				$default_bond=$this->db->where('id',1)->where('quotation !=','')->get('preference_settings')->row();
				if($default_bond)
				{
					@$bond_no='Q'.$default_bond->quotation;
					$bondLen = strlen($bond_no)-1;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					$new_bond_noo = 'Q'.sprintf('%0'.$bondLen.'d', $bondOnlyNum);
				}
				else
				{
					$bondLen = strlen($bond_no)-1;
					$bondOnlyNum = filter_var($bond_no, FILTER_SANITIZE_NUMBER_INT);
					@$new_bond_noo = 'Q'.sprintf('%0'.$bondLen.'d', $bondOnlyNum + 1);
				}
				
				/*$old_bond_noo = str_split($bond_no,2);
				@$va = (string)($old_bond_noo[1].$old_bond_noo[2].$old_bond_noo[3])+1;  
				$bond_length = strlen($va);
				if($bond_length == 1)
				{
					$new_bond_noo = 'Q0000'.$va;  
				} 
				else if($bond_length == 2)
				{  
					$new_bond_noo = 'Q000'.$va; 
				}
				else if($bond_length == 3)
				{  
					$new_bond_noo = 'Q00'.$va; 
				}
				else if($bond_length == 4)
				{  
					$new_bond_noo = 'Q0'.$va; 
				}
				else if($bond_length == 5)
				{  
					$new_bond_noo = 'Q'.$va; 
				}*/
			}
		}
		
		/*if($default_bond_noo!="")
		{
			$data['quotationno']=$default_bond_noo;
		}
		else
		{
			$data['quotationno']=$new_bond_noo;
		}*/
		$data['quotationno']=$new_bond_noo;
		$this->load->view('header');
		$this->load->view('add_quotation',$data);
		$this->load->view('footer');
	}

	public function insert()
	{
		$hsnno=implode('||',$_POST['hsnno']);
		$itemname=implode('||',$_POST['itemname']);
		$description=implode('||',$_POST['description']);
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
		// $freightcharges=$this->input->post('freightcharges');
		// $packingcharges=$this->input->post('packingcharges');
		$othercharges=$this->input->post('othercharges');
		$grandtotal=$this->input->post('grandtotal');

		$data=array(
		'date'=>date('Y-m-d'),
		'quotationdate' =>date('Y-m-d',strtotime($_POST['quotationdate'])), 
		'quotationno' =>$_POST['purchaseno'], 
		'customerId' => $_POST['customerId'],
		'customername' =>$_POST['customername'], 
		'address' =>$_POST['address'], 
		'gsttype'	=> $_POST['gsttype'],
		'gstinno' =>$_POST['gstinno'], 
		'hsnno'=>$hsnno,
		'itemname'=>$itemname,
		'description'=>$description,
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
		// 'freightcharges' =>$freightcharges,
		// 'packingcharges' =>$packingcharges,
		'othercharges' =>$othercharges,
		// 'return_status'=>implode('||',$ret),
		'grandtotal' =>$grandtotal, 
		// 'purchasenodate' =>$purchasenodate, 
		// 'purchasenoyear' =>$purchasenoyear, 
		'status'=>1,
		'edit_status'=>1);

		$result=$this->db->insert('quotation_details',$data);
		if($result==true)
		{ 
			$this->db->query("UPDATE preference_settings SET quotation='' WHERE id=1");
			if($_POST['address']!=$_POST['oldAddress'])
			{
				$address = explode(", ",$_POST['address']);
				$cusAddData = array('address1'=>$address[0],'address2'=>$address[1],'city'=>$address[2],'state'=>$address[3]);
				$this->db->where('id',$_POST['customerId']);
				$result=$this->db->update('customer_details',$cusAddData);
			}
			$this->session->set_flashdata('msg','Quotation Added Successfully');

			if($_POST['print']=='print')
			{
				redirect('quotation/bill');
			}
			if($_POST['save']=='save')
			{
				redirect('quotation');
			}
				redirect('quotation');
		}
		else
		{
			$this->session->set_flashdata('msg1','Quotation Added Unsuccessfully');
			redirect('quotation');
		}
	}

	public function view()
	{
		$data['purchase']=$this->quotation_model->select();
		$data['vat']=$this->db->get('vat_details')->result_array(); 

		$this->load->view('header');
		$this->load->view('quotation_view',$data);
		$this->load->view('footer1');
	}

	public function views()
	{
		$id=base64_decode($this->uri->segment(3));
		$data['result']=$this->db->where('id',$id)->get('quotation_details')->result_array(); 
		$this->load->view('header');
		$this->load->view('view_quotation',$data);
		$this->load->view('footer');
	}


	public function ajax_list()
	{
		$list = $this->quotation_model->get_datatables();
		//print_r($list);
		//exit;
		$data = array();
		$no = $_POST['start'];
		$i=1;
		foreach ($list as $person) {

		$startTimeStamp = strtotime($person->date);
		$endTimeStamp = strtotime(date('Y-m-d'));
		$timeDiff = abs($endTimeStamp - $startTimeStamp);
		$numberDays = $timeDiff/86400;  // 86400 seconds in one day
		$numberDays = intval($numberDays);

		$no++;
		$row = array();
		$row[] = $i++;
		$row[] =date('d-m-Y',strtotime($person->quotationdate));
		$row[] = $person->quotationno;
		$row[] = $person->customername;
		$row[] = $person->grandtotal;
		$code=base64_encode($person->id);
		//add html for action

		$row[] = '


		<div class="btn-group">
		<button type="button" class="btn
		btn-info dropdown-toggle waves-effect waves-light"
		data-toggle="dropdown" aria-expanded="false">Manage <span
		class="caret"></span></button>
		<ul class="dropdown-menu"
		role="menu" style="background: #23BDCF none repeat scroll
		0% 0%;width:14px;min-width: 100%;">


		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('quotation/views/'.$code).'" title="View" >View</a></li>



		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('quotation/edit/'.$code).'" title="Edit" >Edit</a></li>

		<li><a class="" target="_blank" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('quotation/rebill/'.$code).'" title="Edit" >Print</a></li>

		<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$code."'".')">Delete</a></li>
		</ul>
		</div>

		';


		$data[] = $row;
	}

$output = array(
  "draw" => $_POST['draw'],
  "recordsTotal" => $this->quotation_model->count_all(),
  "recordsFiltered" => $this->quotation_model->count_filtered(),
  "data" => $data,
  );
    //output to json format
echo json_encode($output);
}



public function ajax_delete($id)
{
  $this->quotation_model->delete_by_id($id);
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

public function bill()
  {
    $data['pre']=$this->db->where('status',1)->order_by('id','desc')->limit(1)->get('quotation_details')->result();
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
    $this->load->view('quotationbill',$data);
    //$this->load->view('invoicebill',$data);
// $this->load->view('invoice_bill',$data);
  }

  public function rebill()
  {
    $id=base64_decode($this->uri->segment(3));
  // $this->load->library('mpdf'); 
    $data['pre']=$this->db->where('id',$id)->get('quotation_details')->result();

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
    $data['invoice']=$this->db->where('id',$id)->get('quotation_details')->result();
    $this->load->view('quotationbill',$data);
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
    $vob['hsnno']=$h->hsnno;
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
		$data['result']=$this->db->where('id',$id)->get('quotation_details')->result_array(); 
		// echo"<prE>";
		// print_r($data['result']);
		$this->load->view('header');
		$this->load->view('quotation_edit',$data);
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

  //     $data['edit']=$this->quotation_model->invoice_edit($id);
  //     $this->load->view('header');
  //     $this->load->view('edit_invoice',$data);
  //        $this->load->view('footer');


  // }

public function update()
{
	//$grandtotal = $_POST['grandtotal'];
     $id = $_POST['id'];
    $hsnno=implode('||',$_POST['hsnno']);
    $itemname=implode('||',$_POST['itemname']);
    $description=implode('||',$_POST['description']);
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
 
    $othercharges=$this->input->post('othercharges');
    $grandtotal=$this->input->post('grandtotal');

	if($_POST['oldAddress']!="")
	{
		if($_POST['address']!=$_POST['oldAddress'])
		{
			$address = explode(", ",$_POST['address']);
			$cusAddData = array('address1'=>$address[0],'address2'=>$address[1],'city'=>$address[2],'state'=>$address[3]);
			$this->db->where('id',$_POST['customerId']);
			$result=$this->db->update('customer_details',$cusAddData);
		}
	}
   
    $data=array(
      'date' =>date('Y-m-d',strtotime($_POST['quotationdate'])), 
      'quotationdate' =>date('Y-m-d',strtotime($_POST['quotationdate'])), 
	  'customerId' => $_POST['customerId'],
      'customername' =>$_POST['customername'], 
      'address' =>$_POST['address'], 
      'quotationno' =>$_POST['quotationno'], 
     'gsttype'	=> $_POST['gsttype'],
      'hsnno'=>$hsnno,
      'itemname'=>$itemname,
      'description'=>$description,
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
      // 'freightcharges' =>$freightcharges,
      // 'packingcharges' =>$packingcharges,
      'othercharges' =>$othercharges,
      'grandtotal' =>$grandtotal, 
      'edit_status'=>1
      );
     $this->db->where('id',$id);
     $result=$this->db->update('quotation_details',$data);
   // $results=$this->quotation_model->update_invoice($data,$id);
  if($result)
  {
     
    
 $this->session->set_flashdata('msg','Quotation Updated Successfully');
  redirect('quotation/view');
}
else
{
  $this->session->set_flashdata('msg1','No Changes');
  redirect('quotation/view');
}

}



public function search()
{

  $data['purchase']=$this->quotation_model->search_invoice();
  $this->load->view('header');
  $this->load->view('quotation_view',$data);
  $this->load->view('footer1');
}



  // public function delete()
  // {
  //   $del=$this->input->post('id');
  //   $data=$this->db->where('id',$del)->delete('purchase_details');
  //   if($data)
  //   {
  //     $this->session->set_flashdata('msg','Purchase  Deleted Successfully!');
  //     redirect('purchase/view');
  //   }
  //   else
  //   {
  //     $this->session->set_flashdata('msg1','Purchase  Deleted Unsuccessfully');
  //     redirect('purchase/view');
  //   }
  // }


public function delete()
{
  $del=base64_decode($this->input->post('id'));

   //$del=$this->input->post('id');  
  $getdetails=$this->db->where('id',$del)->get('quotation_details')->result();
 
 
  $data=$this->db->where('id',$del)->delete('quotation_details');
 if($data)
 {
    
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

  $data['pending']=$this->quotation_model->pending_select();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function pending_search()
{
  $data['pending']=$this->quotation_model->search_reports();


  $this->load->view('header');
  $this->load->view('purchase_pending_view',$data);
  $this->load->view('footer1');
}


public function purchase_reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->quotation_model->search_pending();

    // echo"<pre>";
    // print_r($data);
  $this->load->view('purchase_reports',$data,$fromdate,$todate,$suppliername);

}

public function reports()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->quotation_model->search_reports();
  $this->load->view('quotation_reports2',$data,$fromdate,$todate);

}


public function reports1()
{
  @$suppliername=$_POST['suppliername'];
  @$fromdate=$_POST['fromdate'];
  @$todate=$_POST['todate'];
  $data['pending']=$this->quotation_model->search_pending();

  
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