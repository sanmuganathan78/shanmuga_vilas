<?php
$profilesgetdata=$this->db->where('status',1)->get('profile')->result_array();
foreach ($profilesgetdata as $key => $profilesgetdatas) {
$title=$profilesgetdatas['companyname'];
// $logo=$profilesgetdatas['logo'];
$address1=$profilesgetdatas['address1'];
$address2=$profilesgetdatas['address2'];
$emailid=$profilesgetdatas['emailid'];
$phoneno=$profilesgetdatas['phoneno'];
$gstin=$profilesgetdatas['gstin'];
}

?>


	<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family:Calibri ;font-size:18px;">
		<tr >
			<td class="heading1" width="316"><div align="center"><strong><?php echo $title;?></strong></div></td>
		<tr align="center">
			<td class="padding" style="font-size:13px;" width="134"><b><?php echo $address1;?><br><?php echo $address2;?>
			<br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>GSTIN :&nbsp;<?php echo $gstin;?></b></td>
		</tr>
		</tr>
	</table>
<?php /* print_r($this->input->post()); exit; */ ?>
	<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
		<tr style="font-size: 16px;">
			<td height="35" width="261" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Invoice Party Statement </strong></td>
			<td height="35" width="382" align="left" style="border-bottom:1px solid black;"><strong>Company Name:<?php echo $this->input->post('scustomername');?></strong>     </td>
			<td height="35" width="181" align="left" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $this->input->post('sfromdate');?></strong>     </td>
			<td height="35" width="158" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $this->input->post('stodate');?></strong></td>
		</tr>
	</table>

	<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
		<tr>
			<td width="77" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
			<td width="81" align="left" style="border-bottom:1px solid black;"><strong>Invoice No</strong></td>
			<td width="98"  align="left" style="border-bottom:1px solid black;"><strong>Receipt No</strong></td>
			<td width="133" align="left" style="border-bottom:1px solid black;"><strong>Company Name</strong></td>
			<td width="113" align="right" style="border-bottom:1px solid black;"><strong>Invoice Amt</strong></td>
			<td width="112" align="right" style="border-bottom:1px solid black;"><strong>Return Amt</strong></td>
			<td width="142" align="right" style="border-bottom:1px solid black;"><strong>Receipt Amt</strong></td>
			<td width="210" align="right" style="border-bottom:1px solid black;"><strong>Payment Details</strong></td>
		</tr>
		<?php
		$customername=$this->input->post('scustomername');
		if($customername)
		{
			
			$openingbalance=$this->db->select('openingbal')->where('name',$customername)->where("(type = 'Inter customer' OR type = 'Intra customer')")->get('customer_details')->row()->openingbal;
			$balanceamount=$this->db->select('balanceamount')->where('name',$customername)->where("(type = 'Inter customer' OR type = 'Intra customer')")->get('customer_details')->row()->balanceamount;
		}

		$i=1; 
		if(count($purchase) > 0 )
		{
		foreach ($purchase as $row) {
		$date=date('d-m-Y',strtotime($row['date']));
		$suppliername=$row['customername'];
		$invoiceno=$row['invoiceno'];
		$receiptno=$row['receiptno'];
		// $grandtotal=$row['totalamount'];
		$paymentdetails=$row['paymentdetails'];
		$paid=$row['paid'];
		$purchaseamt=$row['invoiceamt'];
		$returnamount=$row['returnamount'];
		$receiptamt=$row['receiptamt'];
		$receiptamt = ($receiptamt!='')?$receiptamt:'0';
		$balance=$row['balance'];
		$purchases[]=$purchaseamt;
		$returns[]=$returnamount;
		$receiptamts[]=str_replace(",", "", $receiptamt);
		$pay[]=$paid;
		
		
		/*if($customername=="")
		{
			$customername=$suppliername;
			$openingbalance=$this->db->select('openingbal')->where('name',$customername)->where("(type = 'Inter customer' OR type = 'Intra customer')")->get('customer_details')->row()->openingbal;
			$balanceamount=$this->db->select('balanceamount')->where('name',$customername)->where("(type = 'Inter customer' OR type = 'Intra customer')")->get('customer_details')->row()->balanceamount;
		}*/
		?>
		<tr>
			<td align="left" style="border-bottom:1px dotted black;"><?php echo $date;?></td>
			<td align="left" style="border-bottom:1px dotted black;"><?php echo $invoiceno;?></td>
			<td align="left" style="border-bottom:1px dotted black;"><?php echo $receiptno;?></td>
			<td align="left" style="border-bottom:1px dotted black;"><?php echo ucfirst($suppliername);?></td>
			<td align="right" style="border-bottom:1px dotted black;"><?php echo $purchaseamt;?></td>
			<td align="right" style="border-bottom:1px dotted black;"><?php echo $returnamount;?></td>
			<td align="right" style="border-bottom:1px dotted black;"><?php echo @number_format($receiptamt,2);?></td>
			<td align="right" style="border-bottom:1px dotted black; padding:5px;"><?php echo ucfirst($paymentdetails);?></td>
		</tr>
		<?php }
		$pur=array_sum($purchases);
		//print_r($purchases);
		//echo '<br>'.$pur;
		$ret=array_sum($returns);
		//print_r($returns);
	//	echo '<br>'.$ret;
		$rec=array_sum($receiptamts);
		//print_r($receiptamts);
		//echo '<br>'.$rec;
		$p=array_sum($pay);
		$balance=($openingbalance+$pur)-($ret+$rec);
		?>

		<tr>
			<td align="left" style="border-top:1px solid black;">&nbsp;</td>
			<td align="left" style="border-top:1px solid black;">&nbsp;</td>
			<td align="left" style="border-top:1px solid black;">&nbsp;</td>
			<td align="left" style="border-top:1px solid black;">&nbsp;</td>
			<td align="right" style="border-top:1px solid black;">&nbsp;</td>
			<td align="right" style="border-top:1px solid black;">&nbsp;</td>
			<td align="right" style="border-top:1px solid black;">Opening Balance</td>
			<td align="right" style="border-top:1px solid black; padding:5px;"><strong><?php echo number_format($openingbalance,2);?></strong></td>
		</tr>
		
		<tr>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="right" >&nbsp;</td>
			<td align="right" >&nbsp;</td>
			<td align="right" > Invoice Amount</td>
			<td align="right" style="padding:5px;"><strong><?php echo number_format(@$pur,2);?></strong></td>
		</tr>
		
		<tr>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="right" >&nbsp;</td>
			<td align="right" >&nbsp;</td>
			<td align="right" > Return Amount</td>
			<td align="right" style=" padding:5px;"><strong><?php echo number_format(@$ret,2);?></strong></td>
		</tr>
		
		<tr>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="right" >&nbsp;</td>
			<td align="right" >&nbsp;</td>
			<td align="right" >Receipt Amount</td>
			<td align="right" style=" padding:5px;"><strong><?php echo number_format(@$rec,2);?></strong></td>
		</tr>
		
		<tr>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="left" >&nbsp;</td>
			<td align="right" >&nbsp;</td>
			<td align="right" >&nbsp;</td>
			<td align="right" >Balance Amount</td>
			<td align="right" style=" padding:5px;"><strong><?php echo number_format(@$balance,2);?></td>
		</tr>
		<?php 
		}
		else
		{
			echo '<tr><td colspan="8" align="center">Sorry! No Records Found</td></tr>';
		}
		?>
	</table>



<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
// window.print();
});
</script>