<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
	class Daily_stockreports extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('dailystock_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');
	}

	public function index()
	{
		$this->load->view('header');
		$this->load->view('daily_stock');
		$this->load->view('footer1');
	}

	public function insert()
	{
		$datas=array('date'		=>	date('Y-m-d'),
					'itemname'	=> 	$_POST['itemname'],
					'updatestock'=>	$_POST['qty'],
					'status'	=>	1
					);
		$this->db->insert('stock_reports',$datas);

		$item=$this->db->where('itemname',$_POST['itemname'])->get('stock')->result();
		if($item)
		{
			foreach($item as $i)
			{
				$qty=$i->qty;
				$oldqty=$i->oldqty;
				$currentstock=$i->currentstock;
				$id=$i->id;
			}
			$updateqty=$_POST['qty']+$qty;
			$total=$currentstock+$_POST['qty'];
			$itemname=$_POST['itemname'];
			$data=array(
						'date'			=>	date('Y-m-d'),
						'itemname'		=>	$_POST['itemname'],
						'qty'			=>	$oldqty,
						'balance'		=>	$updateqty,
						'updatestock'	=>	$_POST['qty'],
						'currentstock'	=>	$total,		
						'oldqty'		=>	$currentstock,		
						'status'		=>	1
						);

			$result=$this->stock_model->stock_update($itemname,$data);
			if($result==true)
			{
				$this->session->set_flashdata('msg','Stock Update Successfully');
				redirect('stock');
			}
			else
			{
				$this->session->set_flashdata('msg1','Stock Update Unsuccessfully');
				redirect('stock');
			}
		}
		else
		{
			$itemname=$_POST['itemname'];
			$qty=$_POST['quantity'];
			$data=array(
			'date'=>date('Y-m-d'),
			'itemname'=>$itemname,
			'quantity'=>$qty,
			'balance'=>$qty,
			'updatestock'=>$_POST['quantity'],
			// 'oldqty'=>$_POST['quantity'],
			'currentstock'=>$_POST['quantity'],		
			'status'=>1);
			$result=$this->stock_model->add($data);
			if($result==true)
			{
				$this->session->set_flashdata('msg','Stock Added Successfully');
				redirect('stock');
			}
			else
			{
				$this->session->set_flashdata('msg1','Stock Added Unsuccessfully');
				redirect('stock');
			}
		}
	}

	public function autocomplete_itemname()
	{
		$itemname=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('itemname',$itemname);
		// $this->db->where('status',1);
		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) 
		{
			$json_array         = array();
			$json_array['value']= $d->itemname;
			$json_array['label']= $d->itemname;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function autocomplete_itemcode()
	{
		$itemcode=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->like('hsnno',$itemcode);
		$this->db->where('status',1);
		$query = $this->db->get();
		$result = $query->result();
		$name   =  array();
		foreach ($result as $d) 
		{
			$json_array         = array();
			$json_array['value']= $d->hsnno;
			$json_array['label']= $d->hsnno;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function autocomplete_name()
	{
		$batchno=$this->input->post('keyword');
		$this->db->select('*');
		$this->db->from('purchase_details');
		$this->db->like('batchno',$batchno);

		$query = $this->db->get();
		$result = $query->result();
		$name       =  array();
		foreach ($result as $d) 
		{
			$json_array         = array();
			$json_array['value']= $d->batchno;
			$json_array['label']= $d->batchno;
			$name[]             = $json_array;
		}
		echo json_encode($name);
	}

	public function update()
	{
		$id=$_POST['id'];
		$item=$this->db->where('itemname',$_POST['itemname'])->get('stock')->result();
		foreach($item as $i)
		{
			$qty=$i->quantity;
			$oldqty=$i->oldqty;
			$currentstock=$i->currentstock;
			$id=$i->id;
		}
		$updateqty=$_POST['quantity']+$qty;
		$total=$currentstock+$_POST['quantity'];
		$data=array(
		'date'			=> date('Y-m-d'),
		'itemname'		=> $_POST['itemname'],
		'quantity'		=> $_POST['quantity'],
		'balance'		=> $updateqty,
		'updatestock'	=> $_POST['quantity'],
		'currentstock'	=> $total,		
		'oldqty'		=> $currentstock,		
		'status'		=> 1);
		$result=$this->stock_model->header($data,$id);
		if($result==true)
		{
			$this->session->set_flashdata('msg','Stock Update Successfully !');
			redirect('stock');
		}
		else
		{
			$this->session->set_flashdata('msg1','No changes  !');
			redirect('stock');
		}
	}

	public function delete()
	{
		$del=$this->input->post('id');
		$data=$this->db->where('id',$del)->delete('stock');
		if($data)
		{
			$this->session->set_flashdata('msg','Stock  Deleted Successfully!');
			redirect('stock');
		}
		else
		{
			$this->session->set_flashdata('msg1','Stock  Deleted Unsuccessfully');
			redirect('stock');
		}
	}

	public function autocomplete_partname()
	{
		$itemname=$this->input->post('keyword');
		//$cusname='ram';
		$this->db->select('*');
		$this->db->from('stock');
		$this->db->like('itemname',$itemname);

		$query = $this->db->get();
		$result = $query->result();
		$name =  array();
		foreach ($result as $d) 
		{
			$json_array          = array();
			$json_array['value'] = $d->itemname;
			$json_array['label'] = $d->itemname;
			$name[]              = $json_array;
		}
		echo json_encode($name);
	}


	public function get_item()
	{
		$item=$this->input->post('itemname');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('itemname',$item);
		$query=$this->db->get();
		$result=$query->result();
		$count=count($result);
		if($count==1)
		{
			echo'1';
		}
		else
		{
			echo'0';
		}
	}


	public function ajax_list()
	{
		$list = $this->dailystock_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$a=1;
		foreach ($list as $person) {
			$no++;
			$row = array();
			$row[] = $a++;
			$row[] = date('d-m-Y',strtotime($person->date));
			$row[] =$person->hsnno;
			$row[] = $person->itemname;
			$row[] = $person->updatestock;
			$data[] = $row;
		}

		$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->dailystock_model->count_all(),
		"recordsFiltered" => $this->dailystock_model->count_filtered(),
		"data" => $data,
		);
		//output to json format
		echo json_encode($output);
	}

	public function search()
	{ 
		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$itemname=$this->input->post('itemname');
		$itemno=$this->input->post('itemno');

		$data=array('rcbio_fromdate'	=> $fromdate,
					'rcbio_todate' 		=> $todate,
					'rcbio_itemname'	=> $itemname,
					'rcbio_itemno' 		=> $itemno,
					'rcbio_bill_format' =>'Print',
					);
		$this->session->set_userdata($data);
	}

	public function billing_reportdownload()
	{ 
		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$itemname=$this->input->post('itemname');
		$itemno=$this->input->post('itemno');

		$data=array('rcbio_fromdate' 	=> $fromdate,
					'rcbio_todate' 		=> $todate,
					'rcbio_itemname' 	=> $itemname,
					'rcbio_itemno'		=> $itemno,
					'rcbio_bill_format'	=>'Bill_Download',
					);
		$this->session->set_userdata($data);
	}


	public function search_reports()
	{   
		$bill_format=$this->session->userdata('rcbio_bill_format');                
		if($bill_format=='Print')
		{
			$data['purchase']=	$this->dailystock_model->search_billing();
			$data['fromdate']=	$this->session->userdata('rcbio_fromdate');
			$data['todate']	 =	$this->session->userdata('rcbio_todate');
			$data['itemname']=	$this->session->userdata('rcbio_itemname');
			$data['itemno']	 =	$this->session->userdata('rcbio_itemno');
			$this->load->view('daily_stockreport',$data);
		}
		elseif($bill_format=='Bill_Download')
		{
			$this->load->helper('download');
			$this->load->library('mpdf');
			$purchase=$this->dailystock_model->search_billing();
			$fromdate=$this->session->userdata('rcbio_fromdate');
			$todate=$this->session->userdata('rcbio_todate');
			$itemname=$this->session->userdata('rcbio_itemname');
			$itemno=$this->session->userdata('rcbio_itemno');

			$mpdf = new mPDF('L',  // mode - default ''
			'A4',    // format - A4, for example, default ''
			0,     // font size - default 0
			'',    // default font family
			10,    // margin_left
			10,    // margin right
			16,     // margin top
			16,    // margin bottom
			9,     // margin header
			9,     // margin footer
			'L'); 

			$profilesgetdata=$this->db->where('status',1)->get('profile')->result_array();
			foreach ($profilesgetdata as $key => $profilesgetdatas) {
				$title=$profilesgetdatas['companyname'];
				$logo=$profilesgetdatas['logo'];
				$address1=$profilesgetdatas['address1'];
				$address2=$profilesgetdatas['address2'];
				$mobileno=$profilesgetdatas['phoneno'];
				$email=$profilesgetdatas['emailid'];
			}

			$html='<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
			<tr>
			<td height="80" align="center" style=""><p><img src="'.base_url().'logouploads/'. $logo.'" alt="DDD"></p>
			<p style="margin-top: -22px; font-size: 12px;"><strong>'. $title.'</strong></p>
			<p style="margin-top: -22px; font-size: 12px;"><strong>'. $address1.','. $address2.',</strong></p>
			<p style="margin-top: -10px; font-size: 12px;"><strong>Mobile :&nbsp;'. $mobileno.', E-Mail:&nbsp;'.$email.' </strong></p></td>
			</tr>
			</table>

			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
			<tr style="font-size: 14px;">
			<td height="35" width="222" align="left" style="border-bottom:1px solid black;"><strong>Daily Stock Reports</strong></td>';

			if(@$itemname)
			{
				$sup=ucfirst($itemname);
			} 
			else
			{
			$sup="All Reports";
			}

			if(@$fromdate)
			{
				$frm='From Date :&nbsp;'. $fromdate.'';
			} 
			else
			{

			}
			
			if(@$todate){
			$to='To Date :&nbsp;'. $todate.''; 
			} 
			else
			{
			}
			$html.=' <td height="35" width="424" align="left" style="border-bottom:1px solid black;font-size:14px;"><strong style="font-size:13px;">'.$sup.'&nbsp;&nbsp;&nbsp; '.$frm.' &nbsp;&nbsp;'.$to.'&nbsp;&nbsp;
			</strong></td>
			<td height="35" width="64" align="right" style="border-bottom:1px solid black;"><strong></strong></td>
			</tr>
			</table>

			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 16;">
			<tr>
			<td width="116" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
			<td width="97" align="left" style="border-bottom:1px solid black;"><strong>Item No</strong></td>
			<td width="112" align="left" style="border-bottom:1px solid black;"><strong>Item Name</strong></td>
			<td width="112" align="right" style="border-bottom:1px solid black;"><strong>Quantity</strong></td>
			</tr>';
			$i=1;
			foreach ($purchase as $row) 
			{
				$itemname=$row['itemname'];
				$itemno=$row['itemcode'];
				$receiptdate=date('d-m-Y',strtotime($row['date']));
				$updatestock=$row['updatestock'];
				$balancess[]=$updatestock;
				$b=array_sum($balancess);
				$html.='<tr>
				<td align="left" style="border-bottom:1px dotted black;">'.$receiptdate.'</td>
				<td align="left" style="border-bottom:1px dotted black;">'.$itemno.'</td>
				<td align="left" style="border-bottom:1px dotted black;">'. ucfirst($itemname).'</td>
				<td align="right" style="border-bottom:1px dotted black;">'.$updatestock.'</td>
				</tr>';
			}
			$html.='<tfoot>
			<tr>
			<td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
			<td width="144" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
			<td width="112" align="center" style="border-bottom:1px solid black;"><strong ></strong></td>
			<td width="186" align="left" style="border-bottom:1px solid black;"><strong ></strong></td>
			</tr>
			</tfoot>
			</table>

			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 16;"> <tr>
			<td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
			<td width="144" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
			<td width="112" align="right" style="border-bottom:1px solid black;"><strong style="">Total Quantity</strong></td>
			<td width="186" align="right" style="border-bottom:1px solid black;"><strong >'.$b.'</strong></td>
			</tr>
			</table>'; 
			$itemname=$this->session->userdata('itemname');
			if(@$itemname)
			{
				$sups=$itemname;
			} 
			else
			{

			}
			// echo $html;
			$mpdf->WriteHTML($html);  
			//   $mpdf->Output();
			// $filename=date('d-m-Y').'Purchase Collection Reports.pdf';
			//  $content = $mpdf->Output($filename,$sup, 'D');
			$mpdf->Output($sups.' '.'Daily Stock Reports'.' '.date('d-m-Y').'.pdf','d');
			//   force_download($filename,$content); 
		}
	}
}
ob_flush();
?>