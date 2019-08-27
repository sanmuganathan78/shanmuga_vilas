<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Tax extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('taxstatement_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}	
		date_default_timezone_set('Asia/Kolkata');		
	}
	public function index()
	{
		
        $data['invoice']=$this->taxstatement_model->select();
		$this->load->view('header');
		$this->load->view('tax_reports',$data);
		$this->load->view('footer1');
	}
	
	public function view()
	{
		$data['invoice']=$this->taxstatement_model->select();
		$this->load->view('header');
		$this->load->view('tax_reports',$data);
		$this->load->view('footer1');
	}

	public function views()

	{

		$id=base64_decode($this->uri->segment(3));
		$data['result']=$this->db->where('id',$id)->get('invoice_details')->result_array();	
		$this->load->view('header');
		$this->load->view('view_invoice',$data);
		$this->load->view('footer');

	}

	

	public function search()
	{ 

		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$cusname=$this->input->post('cusname');
		$invoiceno=$this->input->post('invoiceno');
		$gsttype=$this->input->post('gsttype');
		$tax_percent=$this->input->post('tax_percent');

		$data=array(
			'rcbio_fromdate' => $fromdate,
			'rcbio_todate' => $todate,
			'rcbio_cusname' => $cusname,
			'rcbio_invoiceno' => $invoiceno,
			'rcbio_gsttype' => $gsttype,
			'rcbio_tax_percent' => $tax_percent,
			'rcbio_bill_format' =>'Print',
			);

		$this->session->set_userdata($data);

	}
	public function excel_download()
	{
		$fromdate=$this->input->post('fromdate');
		$todate=$this->input->post('todate');
		$cusname=$this->input->post('cusname');
		$invoiceno=$this->input->post('invoiceno');
		$gsttype=$this->input->post('gsttype');
		$tax_percent=$this->input->post('tax_percent');

		$data=array(
			'rcbio_fromdate' => $fromdate,
			'rcbio_todate' => $todate,
			'rcbio_cusname' => $cusname,
			'rcbio_invoiceno' => $invoiceno,
			'rcbio_gsttype' => $gsttype,
			'rcbio_tax_percent' => $tax_percent,
			'rcbio_bill_format' =>'download',
			);

		$this->session->set_userdata($data);
	}


	public function search_reports()
	{   
		$bill_format=$this->session->userdata('rcbio_bill_format');                

		if($bill_format=='Print')
		{
			$data['invoice']=$this->taxstatement_model->search_billing();
			$data['fromdate']=$this->session->userdata('rcbio_fromdate');
			$data['todate']=$this->session->userdata('rcbio_todate');
			$data['cusname']=$this->session->userdata('rcbio_cusname');
			$data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
			$data['gsttype']=$this->session->userdata('rcbio_gsttype');
			$data['tax_percent']=$this->session->userdata('rcbio_tax_percent');
			$this->load->view('invoice_reports',$data);
		}
		elseif($bill_format=='download')
		{
		    
			$result = $this->taxstatement_model->search_billing();
			$this->load->library('excel');
			$this->excel->setActiveSheetIndex(0);
			//name the worksheet
			$this->excel->getActiveSheet()->setTitle('Tax Report');
			//set cell A1 content with some text
			
			$this->excel->getActiveSheet()->setCellValue('A1', 'Tax Report');
			$this->excel->getActiveSheet()->setCellValue('A2', 'Date');
			$this->excel->getActiveSheet()->setCellValue('B2', 'Invoice No');
			$this->excel->getActiveSheet()->setCellValue('C2', 'Company Name');
			$this->excel->getActiveSheet()->setCellValue('D2', 'GSTIN');
			$this->excel->getActiveSheet()->setCellValue('E2', 'Basic Amount');
			$this->excel->getActiveSheet()->setCellValue('F2', 'Tax Type');
			$this->excel->getActiveSheet()->setCellValue('G2', 'CGST Percentage');
			$this->excel->getActiveSheet()->setCellValue('H2', 'CGST Amount');
			$this->excel->getActiveSheet()->setCellValue('I2', 'SGST Percentage');
			$this->excel->getActiveSheet()->setCellValue('J2', 'SGST Amount');
			$this->excel->getActiveSheet()->setCellValue('K2', 'IGST Percentage');
			$this->excel->getActiveSheet()->setCellValue('L2', 'IGST Amount');
			$this->excel->getActiveSheet()->setCellValue('M2', 'Invoice Amount');

			//merge cell A1 until C1
			$this->excel->getActiveSheet()->mergeCells('A1:M1');
			//set aligment to center for that merged cell (A1 to C1)
			$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			//make the font become bold
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
			$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
			$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');
			for($col = ord('A'); $col <= ord('M'); $col++){
				$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
				$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);
				$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			}
			
			$exceldata=array();
			
			foreach ($result as $row)
			{
				@$gstin=$this->db->select('gstno')->where('id',$row['customerId'])->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;
				 if($row['amount']!="")
				{
				  $amount=explode('||',$row['amount']);
				 // print_r($amount);
				  //echo '<br>';
				  $de_amount=array_sum($amount);
				  $de_amounts[]=array_sum($amount);
				}
				else
				{
				  $de_amount=0;
				}
				if($row['sgstamount']!="")
				{
					$sgstamount=explode('||',$row['sgstamount']);
					$sgst_amount=array_sum($sgstamount);
					$sgst_amounts[]=array_sum($sgstamount);
				}
				else
				{
					$sgst_amount=0;
				}
				if($row['igstamount']!="")
				{
					$igstamount=explode('||',$row['igstamount']);
					$igst_amount=array_sum($igstamount);
					$igst_amounts[]=array_sum($igstamount);
				}
				else
				{
					$igst_amount=0;
				}
				if($row['cgstamount']!="")
				{
					$cgstamount=explode('||',$row['cgstamount']);
					$cgst_amount=array_sum($cgstamount);
					$cgst_amounts[]=array_sum($cgstamount);	
				}
				else
				{
					$cgst_amount=0;
				}
				

				if($row['gsttype']=='interstate')
				{ 
					$igstpercent=explode("||",$row['igst']); 
					$cgstpercent=0; 
					$sgstpercent=0; 
					$cgstConcat='';
					$sgstConcat='';
					$igstConcat=' %';
					$cgst_amount = '';
					$sgst_amount = '';
					
				} 
				else if($row['gsttype']=='intrastate')
				{ 

					$igstpercent=0; 
					$cgstpercent=explode("||",$row['cgst']); 
					$sgstpercent=explode("||",$row['sgst']); 
					$cgstConcat=' %';
					$sgstConcat=' %';
					$igstConcat='';
					$igst_amount = '';
				}
				$data['invoiceDate']=$row['invoicedate'];
				$data['invoiceNo']=$row['invoiceno'];
				$data['Company']=$row['customername'];
				$data['gstin']=$gstin;
				$data['basicAmount']=$de_amount;
				$data['taxType']=ucfirst($row['gsttype']);
				$data['cgstPercent']=$cgstpercent[0].$cgstConcat;
				$data['cgstAmount']=$cgst_amount;
				$data['sgstPercent']=$sgstpercent[0].$sgstConcat;
				$data['sgstAmount']=$sgst_amount;
				$data['igstPercent']=$igstpercent[0].$igstConcat;
				$data['igstAmount']=$igst_amount;
				$data['invoice_amt']=@number_format($row['grandtotal'],2);
				@$exceldata[] = $data;
				
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
			$this->excel->getActiveSheet()->getStyle('F3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('G3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('H3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('I3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('J3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('K3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$this->excel->getActiveSheet()->getStyle('L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
			$filename='Invoice Tax Report-'.date('d/m/y').'.xls'; //save our workbook as this file name
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




	 public function ajax_list()
  {
	
    $list = $this->taxstatement_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    $i=1;
    foreach ($list as $person) {

       @$gstin=$this->db->select('gstno')->where('name',$person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;

       @$phoneno=$this->db->select('phoneno')->where('name',$person->customername)->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->phoneno;


      $no++;
      $row = array();
      $row[] = $i++;
      $row[] =date('d-m-Y',strtotime($person->invoicedate));
      $row[] = $person->invoiceno;
      $row[] = $person->customername;
      $row[] = $phoneno;
      $row[] = $gstin;
      $row[] = $person->grandtotal;
      
  
  $data[] = $row;
}
$output = array(
  "draw" => $_POST['draw'],
  "recordsTotal" => $this->taxstatement_model->count_all(),
  "recordsFiltered" => $this->taxstatement_model->count_filtered(),
  "data" => $data,);
    //output to json format
echo json_encode($output);
}

	function getTaxPercent()
	{
		$gstType=$_POST['gstType'];
		if($gstType=='intrastate')
		{
			$result = $this->db->select('sgst')->where('status','1')->get('vat_details')->result_array();
			if(count($result) > 0 )
			{
				echo '<option value="">Tax %</option>';
				foreach($result as $res)
				{
					echo '<option value="'.$res['sgst'].'">'.$res['sgst'].'</option> ';
				}
			}
			else
			{
				echo '<option value="">Tax %</option>';
			}
		}
		elseif($gstType=='interstate')
		{
			$result = $this->db->select('igst')->where('status','1')->get('vat_details')->result_array();	
			if(count($result) > 0 )
			{
				echo '<option value="">Tax %</option>';
				foreach($result as $res)
				{
					echo '<option value="'.$res['igst'].'">'.$res['igst'].'</option> ';
				}
			}
			else
			{
				echo '<option value="">Tax %</option>';
			}
		}
		else
		{
			echo '<option value="">Tax %</option>';
		}
	}



}

ob_flush();
?>