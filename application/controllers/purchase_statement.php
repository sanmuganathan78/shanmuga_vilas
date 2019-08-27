<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
ob_start();
class Purchase_statement extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('postatement_model');
		if($this->session->userdata('rcbio_login')=='')
		{
			
			$this->session->set_flashdata('msg','Please Login to continue!');
			redirect('login');
		}
    date_default_timezone_set('Asia/Kolkata');		
	}
	public function index()
	{
			
        $data['view']=$this->postatement_model->select();

			$this->load->view('header');
			$this->load->view('poview_partystatement');
			$this->load->view('footer');
	}
	


  public function view()
  {

    $data['view']=$this->postatement_model->select();

    $this->load->view('header');
    $this->load->view('poview_partystatement',$data);
    $this->load->view('footer1');
  }

      public function autocomplete_name()
  {
    $name=$this->input->post('keyword');
//$cusname='ram';
    $this->db->select('*');
    $this->db->from('purchase_details');
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

  public function ajax_list()
  {
    $list = $this->postatement_model->get_datatables();
    $data = array();
    $no = $_POST['start'];
    $a=1;
     $totalamount[]=array();
    foreach ($list as $person) {
      // $noofitemss=explode('||',$person->itemname);
      // $noofitems=count($noofitemss);
      // $totalamount[]=$person->totalamount;
      $no++;
      $row = array();
      $row[] = $a++;
	  if(!is_null($person->invoicedate))
	  {
		  $row[] = date('d/m/Y',strtotime(str_replace('-','/',$person->invoicedate)));
	  }
	  else
	  {
		  $row[] = '-';
	  }
      
      $row[] =$person->invoiceno;
      $row[] =$person->receiptno;
      $row[] = $person->suppliername;
      $row[] = $person->purchaseamt;
      $row[] = $person->returnamount;

      
      $row[] = $person->receiptamt;
     
      // $row[] = $noofitems;
      $row[] = ucfirst($person->paymentdetails);
      // $row[] = number_format($person->balance,2);
          
          
   
      $data[] = $row;
    }

    $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->postatement_model->count_all(),
            "recordsFiltered" => $this->postatement_model->count_filtered(),
            "data" => $data,
        );
    //output to json format
    echo json_encode($output);
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

                public function billing_reportdownload()
              { 

                $fromdate=$this->input->post('fromdate');
                $todate=$this->input->post('todate');
                $suppliername=$this->input->post('suppliername');
                $invoiceno=$this->input->post('invoiceno');

              $data=array(
                        'realty_fromdate' => $fromdate,
                        'realty_todate' => $todate,
                        'realty_suppliername' => $suppliername,
                        'realty_invoiceno' => $invoiceno,
                        'realty_bill_format' =>'Bill_Download',
                       );
               $this->session->set_userdata($data);

              }

	public function search_reports()
	{   
		$bill_format=$this->session->userdata('rcbio_bill_format');                
		if($bill_format=='Print')
		{
			$data['fromdate']=$this->session->userdata('rcbio_fromdate');
			$data['todate']=$this->session->userdata('rcbio_todate');
			$data['suppliername']=$this->session->userdata('rcbio_suppliername');
			$data['invoiceno']=$this->session->userdata('rcbio_invoiceno');
			if($data['fromdate']=='' && $data['todate']=='' && $data['suppliername']=='' && $data['invoiceno']=='')
			{
	
				$this->load->view('purchasestmt_overall_reports',$data);
			}
			else
			{
				$data['purchase']=$this->postatement_model->search_billing();
				$this->load->view('postatement_reports',$data);
			}
			
		}

		elseif($bill_format=='Bill_Download')
		{
			$this->load->helper('download');
			$this->load->library('mpdf');
			$purchase=$this->postatement_model->search_billing();
			$fromdate=$this->session->userdata('realty_fromdate');
			$todate=$this->session->userdata('realty_todate');
			$suppliername=$this->session->userdata('realty_suppliername');
			$invoiceno=$this->session->userdata('realty_invoiceno');

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

			$html='
			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
				<tr>
					<td height="80" align="center" style=""><p><img src="'.base_url().'logouploads/'. $logo.'" alt="DDD"></p>
					<p style="margin-top: -22px; font-size: 12px;"><h2><strong>'. $title.'</strong></h2></p>
					<p style="margin-top: -22px; font-size: 12px;"><strong>'. $address1.','. $address2.',</strong></p>
					<p style="margin-top: -10px; font-size: 12px;"><strong>Mobile :&nbsp;'. $mobileno.', E-Mail:&nbsp;'.$email.' </strong></p></td>
				</tr>
			</table>

			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
				<tr style="font-size: 14px;">
					<td height="35" width="222" align="left" style="border-bottom:1px solid black;"><strong>Purchase Party Statement </strong></td>';
						if(@$suppliername) { $sup=ucfirst($suppliername); } else { $sup="All Reports"; }
						if(@$fromdate) { $frm='From Date :&nbsp;'. $fromdate.''; } else { }
						if(@$todate){ $to='To Date :&nbsp;'. $todate.''; } else { }
						$html.=' <td height="35" width="424" align="center" style="border-bottom:1px solid black;"><strong>'.$sup.'&nbsp;&nbsp;&nbsp; '.$frm.' &nbsp;&nbsp;'.$to.'
						</strong>
					</td>
					<td height="35" width="64" align="right" style="border-bottom:1px solid black;"><strong></strong></td>
				</tr>
			</table>

			<table width="724" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 18;">
				<tr>
					<td width="90" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
					<td width="97" align="center" style="border-bottom:1px solid black;"><strong>INV No</strong></td>
					<td width="100" align="left" style="border-bottom:1px solid black;"><strong>Receipt No</strong></td>
					<td width="144" align="left" style="border-bottom:1px solid black;"><strong>Supplier Name</strong></td>
					<td width="100" align="right" style="border-bottom:1px solid black;"><strong>Purchase</strong></td>
					<td width="60" align="right" style="border-bottom:1px solid black;"><strong>Receipt</strong></td>
					<td width="60" align="center" style="border-bottom:1px solid black;"><strong>Balance</strong></td>
					<td width="120" align="right" style="border-bottom:1px solid black;"><strong>Payment Details</strong></td>
				</tr>';

			$i=1;
			$totalamount[]=array();
			foreach ($purchase as $row) {
				$invoiceno=$row['invoiceno'];
				$receiptno=$row['receiptno'];
				$suppliername=$row['suppliername'];
				$paymentdetails=$row['paymentdetails'];
				$paid=$row['paid'];
				$receiptdate=date('d-m-Y',strtotime($row['purchasedate']));
				$balance=$row['balance'];
				$purchaseamt=$row['purchaseamt'];
				$receiptamt=$row['receiptamt'];
				$paymentdetails=$row['paymentdetails'];

				$purchases[]=$purchaseamt;
				$pur=array_sum($purchases);
				$receiptamts[]=$receiptamt;
				$rec=array_sum($receiptamts);

				$pay[]=$paid;
				$p=array_sum($pay);

				$unpaid=$pur-$rec;

				$html.='
				<tr>
					<td align="left" style="border-bottom:1px dotted black;">'.$receiptdate.'</td>
					<td align="center" style="border-bottom:1px dotted black;">'.$invoiceno.'</td>
					<td align="left" style="border-bottom:1px dotted black;">'.$receiptno.'</td>
					<td align="left" style="border-bottom:1px dotted black;">'. ucfirst($suppliername).'</td>
					<td align="right" style="border-bottom:1px dotted black;">'.$purchaseamt.'</td>
					<td align="right" style="border-bottom:1px dotted black;">'.number_format($receiptamt
					,2).'</td>
					<td align="center" style="border-bottom:1px dotted black;">'.number_format($balance,2).'</td>
					<td align="right" style="border-bottom:1px dotted black;">'.$paymentdetails.'</td>
				</tr>';
			}
			$html.='
				<tfoot>
				<tr>
					<td width="43" height="29" align="left"><strong></strong></td>
					<td width="116" align="left" ><strong></strong></td>
					<td width="97" align="left" ><strong></strong></td>
					<td width="186" align="left" ><strong></strong></td>
					<td width="144" align="left" ><strong>&nbsp;</strong></td>
					<td width="112" align="center" ><strong>&nbsp;</strong></td>
					<td width="186" align="left" ><strong></strong></td>
				</tr>
				</tfoot>
			</table>

			<table>
				<tr>
					<td width="43" height="29" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="97" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="144" align="left" style="border-bottom:1px solid black;"><strong>Purchase Amount</strong></td>
					<td width="112" align="center" style="border-bottom:1px solid black;"><strong>'. number_format($pur,2).'</strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
				</tr>
				
				<tr>
					<td width="43" height="29" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="97" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="144" align="left" style="border-bottom:1px solid black;"><strong>Receipt Amount</strong></td>
					<td width="112" align="center" style="border-bottom:1px solid black;"><strong>'. number_format($rec,2).'</strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
				</tr>
				
				<tr>
					<td width="43" height="29" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="116" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="97" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
					<td width="144" align="left" style="border-bottom:1px solid black;"><strong>Balance Amount</strong></td>
					<td width="112" align="center" style="border-bottom:1px solid black;"><strong>'. number_format($unpaid,2).'</strong></td>
					<td width="186" align="left" style="border-bottom:1px solid black;"><strong></strong></td>
				</tr>
			</table>'; 
			$suppliername=$this->session->userdata('realty_suppliername');
			if(@$suppliername)
			{
				$sups=$suppliername;
			} 
			else
			{
				
			}
			
			$mpdf->WriteHTML($html);  
			$mpdf->Output($sups.' '.'Purchase Party Statement'.' '.date('d-m-Y').'.pdf','d');

		}
	}  

}

ob_flush();
?>