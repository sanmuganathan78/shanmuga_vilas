<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('item_model');
		if($this->session->userdata('rcbio_login')=='')
		{

			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
		date_default_timezone_set('Asia/Kolkata');	
	}
/*	public function index()
	{

		$data['item']=$this->item_model->vi();		
		$this->load->view('header');
		$this->load->view('items');
		$this->load->view('footer1');
	}

	public function insert()
	{
		$this->validate();
		$itemno = $this->item_model->get_last_itemno();
		if(isset($itemno) && count($itemno) != 0){
			$itemno++;	
		}else{
			$itemno = 'I00001';
		}


		$data=array(
			'date'=>date('Y-m-d'),
			'itemno'=>$itemno,
			'itemname'=>$_POST['itemname'],
			'price'=>$_POST['price'],
			'status' =>1			
			);
		@$itemno = $this->item_model->add($data);
		echo json_encode(array("status" => TRUE,'itemno'=>$itemno));		
	}

	public function insert1()
	{
		//print_r($_POST); /// Array ( [hsnno] => [itemname] => a [uom] => 1 [price] => [taxtype] => 2 [sgst] => 14 [cgst] => 14 [igst] => 28 [priceType] => Exclusive [mrp] => )
		if(isset($_POST['priceType']))
		{
			$priceType = $_POST['priceType'];
		}
		else
		{
			$priceType = 'Exclusive';
		}
		//echo $priceType;
		//exit;
		if($_POST['price']!="")
		{
			$price=$_POST['price'];
		}
		else
		{
			$price=0;
		}
			if($_POST['hsnno']!="")
		{
			$hsnno=$_POST['hsnno'];
		}
		else
		{
			$hsnno=0;
		}
		
		$data=array(
			'date'=>date('Y-m-d'),
			'itemname'=>$_POST['itemname'],
			'uom'=>$_POST['uom'],
			'price'=>$price,
			'hsnno'=>$hsnno,
			'taxtype'=>$_POST['taxtype'],
			'sgst'=>$_POST['sgst'],
			'cgst'=>$_POST['cgst'],
			'igst'=>$_POST['igst'],
			'status'=>1,
			'priceType' => $priceType
			//'mrp'	=> $_POST['mrp']
			);
		if($data)
		{
			$this->db->insert('additem',$data);
			$this->session->set_flashdata('msg','Item Added Successfully !');
			redirect('item');
		}
		else
		{

			$this->session->set_flashdata('msg','Item Added UnSuccessfully !');
			redirect('item');

		}
	}
	Public function validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;
		if($this->input->post('itemname') == ''){
			$data['inputerror'][] = 'itemname';
			$data['error_string'][] = 'Enter item name';
			$data['status'] = FALSE;
		}
		if($this->input->post('price') == ''){
			$data['inputerror'][] = 'price';
			$data['error_string'][] = 'Enter price';
			$data['status'] = FALSE;
		}		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	public function view()
	{
		$data['item']=$this->item_model->vi();
		$this->load->view('header');
		$this->load->view('item_view',$data);
		$this->load->view('footer1');
	}
	public function getname()
	{
		$name=$_POST['name'];
		$data=$this->db->where('itemname',$name)->get('additem')->result();
		echo $count=count($data);
	}

		public function gethsnno()
	{
		$name=$_POST['name'];
		$data=$this->db->where('hsnno',$name)->get('additem')->result();
		echo $count=count($data);
	}
	public function getcode()
	{
		$name=$_POST['name'];
		$data=$this->db->where('itemno',$name)->get('additem')->result();
		echo $count=count($data);
	}
	public function update()
	{

	
		$id=$_POST['id'];
		$uom =$_POST['uom'];
		$itemname =$_POST['itemname'];
		$hsnno =$_POST['hsnno'];
		$price =$_POST['price'];
		$taxtype =$_POST['taxtype'];
		$sgst=$_POST['sgst'];
		$cgst=$_POST['cgst'];
		$igst=$_POST['igst'];
		$priceType = $_POST['priceType'];
		$data=array('uom'=>$uom,'itemname'=>$itemname,'price'=>$price,'taxtype'=>$taxtype,'hsnno'=>$hsnno,'sgst'=>$sgst,'igst'=>$igst,'cgst'=>$cgst,'priceType'=>$priceType);
// $result=$this->item_model->header($data,$id);
		$result = $this->db->where('id',$id)->update('additem',$data);
		if($result==true)
		{
			$this->session->set_flashdata('msg','Item Updated Successfully !');
			redirect('item');
		}
		else
		{
			$this->session->set_flashdata('msg1','No changes  !');
			redirect('item');
		}
	}
	public function delete()
	{
		$del=$this->input->post('id');
		$data=$this->db->where('id',$del)->delete('additem');
		if($data)
		{
			$this->session->set_flashdata('msg','Item  Deleted Successfully!');
			redirect('item/view');
		}
		else
		{
			$this->session->set_flashdata('msg1','Item  Deleted Unsuccessfully');
			redirect('item/view');
		}
	}
	public function get_itemname()
	{
		$itemname=$this->input->post('itemname');
		$this->db->select('*');
		$this->db->from('additem');
		$this->db->where('itemname',$itemname);
		$query=$this->db->get();
		$result=$query->result();
		if($result)
		{
			echo"yes";
		}
		else
		{
			echo"no";
		}
	}
	public function ajax_list()
	{
		$list = $this->item_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		$i=1;
		foreach ($list as $person) {

			@$uom=$this->db->select('uom')->where('id',$person->uom)->get('uom')->row()->uom;
			$no++;
			$row = array();
			$row[] = $i++;
			$row[] =date('d-m-Y',strtotime($person->date));
			$row[] = $person->hsnno;
			$row[] = $person->itemname;
			$row[] = $uom;
			$row[] = $person->sgst;
			$row[] = $person->cgst;
			$row[] = $person->igst;
			$row[] = $person->price;
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

				<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="'.base_url('item/edit/'.$code).'" title="Hapus" >Edit</a></li>


				<li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$person->id."'".')">Delete</a></li>
			</ul>
		</div>






		';
		$data[] = $row;
	}

	$output = array(
		"draw" => $_POST['draw'],
		"recordsTotal" => $this->item_model->count_all(),
		"recordsFiltered" => $this->item_model->count_filtered(),
		"data" => $data,
		);
//output to json format
	echo json_encode($output);
}

public function edit()

{

	$id=base64_decode($this->uri->segment(3));
	$data['result']=$this->db->where('id',$id)->get('additem')->result_array();	
	$this->load->view('header');
	$this->load->view('edit_item',$data);
	$this->load->view('footer');






}

public function ajax_edit($id)
{
	$data = $this->item_model->get_by_id($id);
// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
	echo json_encode($data);
}

// public function update()
// {

// 	 //echo json_encode($_POST); exit;

// 	// $this->validate();
// 	$data=array(
// 		'date'=>date('Y-m-d'),
// 		'itemno'=>$_POST['itemno'],
// 		'itemname'=>$_POST['itemname'],
// 		'price'=>$_POST['price'],
// 		);

// 	$this->item_model->update($data);
// 	echo json_encode(array("status" => TRUE));
// }

public function ajax_delete($id)
{
	$this->item_model->delete_by_id($id);
	echo json_encode(array("status" => TRUE));
// $this->session->set_flashdata('msg','Item  Deleted Successfully!');

}

public function gettax()
{
	$taxtype=$this->input->post('taxtype');
	$taxs=$this->db->where('id',$taxtype)->get('vat_details')->result_array();
	if($taxs)
	{
		foreach ($taxs as $rows) 
		{
			$data['sgst']=$rows['sgst'];
			$data['cgst']=$rows['cgst'];
			$data['igst']=$rows['igst'];
		}
	}
	else
	{
		    $data['sgst']='';
			$data['cgst']='';
			$data['igst']='';
	}

	echo json_encode($data); 


}



Public function upload_excel()
	{

		$config['upload_path'] =  './upload/customer/';
//Only allow this type of extensions 
		$config['allowed_types'] = '*';
		$this->load->library('upload', $config);
// if any error occurs 
		if ( ! $this->upload->do_upload('file'))
		{
			$error = array('error' => $this->upload->display_errors());
			$this->session->set_flashdata('msg1',$error);
			redirect('customer');

		}
//if successfully uploaded the file 
		else
		{
			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
			$fileextension=explode('.',$file_name);
				$counts=count($fileextension)-1;
             //load library phpExcel
			$this->load->library("Excel");
			//here i used microsoft excel 2007

			if($fileextension[$counts]=='xlsx' || $fileextension[$counts]=='Xlsx')
			{
				$objReader = PHPExcel_IOFactory::createReader('Excel2007');
			}
			else
			{
				$objReader = PHPExcel_IOFactory::createReader('Excel5');
			}	

			//$objReader = PHPExcel_IOFactory::createReader('Excel2007');
//set to read only
			$objReader->setReadDataOnly(true);
//load excel file
			$objPHPExcel = $objReader->load('upload/customer/'.$file_name);
			$sheetnumber = 0;
			foreach ($objPHPExcel->getWorksheetIterator() as $sheet)
			{

$s = $sheet->getTitle();	// get the sheet name 

$sheet= str_replace(' ', '', $s); // remove the spaces between sheet name 
$sheet= strtolower($sheet); 
$objWorksheet = $objPHPExcel->getSheetByName($s);

$lastRow = $objPHPExcel->setActiveSheetIndex($sheetnumber)->getHighestRow(); 
$sheetnumber++;

for($j=3; $j<=$lastRow; $j++)
{

	$itemname = $objWorksheet->getCellByColumnAndRow(0,$j)->getValue();
	$uom = $objWorksheet->getCellByColumnAndRow(1,$j)->getValue();	
	$price = $objWorksheet->getCellByColumnAndRow(2,$j)->getValue();
	$hsnno = $objWorksheet->getCellByColumnAndRow(3,$j)->getValue();
	$sgst = $objWorksheet->getCellByColumnAndRow(4,$j)->getValue();
	$cgst = $objWorksheet->getCellByColumnAndRow(5,$j)->getValue();
	$igst = $objWorksheet->getCellByColumnAndRow(6,$j)->getValue();
	
	if($itemname!="")
	{

	$itemname =  $itemname ? $itemname:'-';
	
	$price =  $price ? $price:'0';
	$hsnno =  $hsnno ? $hsnno:'-';
	$sgst =  $sgst ? $sgst:'0';
	$cgst =  $cgst ? $cgst:'0';
	$igst =  $igst ? $igst:'0';
if($uom!="")
{
	$uomsdetails=$this->db->where('uom',$uom)->get('uom')->result();
	if(count($uomsdetails) > 0)
	{
		foreach($uomsdetails as $u)
		$uoms=$u->id;
	}
	else
	{
		$uoms='-';
	}
	
}
else
{
	$uoms='-';
}
	
		
$data=array(
			'date'=>date('Y-m-d'),
			'itemname'=>$itemname,
			'uom'=>$uoms,
			'price'=>$price,
			'hsnno'=>$hsnno,
			'sgst'=>$sgst,
			'cgst'=>$cgst,
			'igst'=>$igst,
			'status'=>1
			);



	$getdetails=$this->db->where('itemname',$itemname)->get('additem')->num_rows();
									if($getdetails > 0)
									{
										
									}
									else
									{
										$this->db->insert('additem',$data);
									}
	}
}// loop ends 

						
				$result=$this->db->affected_rows()!=1 ? false:true;	
				if($result=true)
				{
					$this->session->set_flashdata('msg','Item Details Added Successfully !');
					redirect('item');
				}
				else
				{
					$this->session->set_flashdata('msg1','Item Details Added UnSuccessfully !');
					redirect('item');
				}

		}
	}
}

*/
	Public function download()
	{
		// date_default_timezone_set('Asia/calcutta');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
		//name the worksheet
		$this->excel->getActiveSheet()->setTitle('Item List');
		//set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Item Details');
		$this->excel->getActiveSheet()->setCellValue('A2', 'HSN No');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Item Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Qty');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Rate');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Total Quantity');



		//merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:E1');
		//set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		//make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('E'); $col++){
			//set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
			//change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
		//retrive contries table data
		$sql = "SELECT hsnno,itemname,quantity,rate,balance from stock ";        
		$rs = $this->db->query($sql);
		//        $rs = $this->db->get('countries');
		$exceldata="";
		foreach ($rs->result_array() as $row){
			$data['hsnno']=$row['hsnno'];
			$data['itemname']=$row['itemname'];
			$data['qty']=$row['quantity'];
			$data['rate']=$row['rate'];
			$data['stock']=$row['balance'];

			$exceldata[] = $data;
		}

		//Fill data 
		if(count($exceldata) > 0)
		{
			$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');
		}

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('E3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$filename='Itemlist-'.date('d/m/y').'.xls'; //save our workbook as this file name
		header('Content-Type: application/vnd.ms-excel'); //mime type
		header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
		header('Cache-Control: max-age=0'); //no cache

		//save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
		//if you want to save it as .XLSX Excel 2007 format
		$objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
		//force user to download the Excel file without writing it to server's HD
		$objWriter->save('php://output');


	}


}

ob_flush();
?>