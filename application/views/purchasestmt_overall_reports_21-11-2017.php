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


	<table width="90%" border="0" align="center" style="border-collapse:collapse; font-family:Calibri ;font-size:18px;">
		<tr >
			<td class="heading1" width="316"><div align="center"><strong><?php echo $title;?></strong></div></td>
		<tr align="center">
			<td class="padding" style="font-size:13px;" width="134"><b><?php echo $address1;?><br><?php echo $address2;?>
			<br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>GSTIN :&nbsp;<?php echo $gstin;?></b></td>
		</tr>
		</tr>
	</table>


	<table width="90%" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
		<tr style="font-size: 16px;">
			<td height="50" width="100%" align="center" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Invoice Party Statement </strong></td>
		</tr>
	</table>

	<table width="90%" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
		<tr>
			<td width="15%" align="left" style="border-bottom:1px solid black;"><strong>S.No</strong></td>
			<td width="40%" align="left" style="border-bottom:1px solid black;"><strong>Company Name</strong></td>
			<td width="11%" align="right" style="border-bottom:1px solid black;"><strong>Purchase Amt</strong></td>
			<td width="11%" align="right" style="border-bottom:1px solid black;"><strong>Return Amt</strong></td>
			<td width="11%" align="right" style="border-bottom:1px solid black;"><strong>Receipt Amt</strong></td>
			<td width="12%" align="right" style="border-bottom:1px solid black;"><strong>Balance Amt</strong></td>
		</tr>
		<?php
		$custId_query=$this->db->query("SELECT supplierId,suppliername FROM purchase_details GROUP BY supplierId");
		if($custId_query->num_rows() > 0 )
		{
			$custIdRes = $custId_query->result();
			$i=1;
			$totalInvAmt = 0;
			$totalRetAmt = 0;
			$totalRecAmt = 0;
			$totalBalAmt = 0;
			$grandBalAmt = 0;
			foreach($custIdRes as $cR)
			{
				echo '
				<tr>
					<td align="left" style="border-bottom:1px dotted black;">'.$i.'</td>
					<td align="left" style="border-bottom:1px dotted black;">'.$cR->suppliername.'</td>';
				//GET INVOICE AMOUNT	
				$grandInvoiceAmt = $this->db->query("SELECT SUM(`grandtotal`) AS invoiceAmt FROM `purchase_details` WHERE `supplierId`='".$cR->supplierId."' ");
				if($grandInvoiceAmt->num_rows() > 0 )
				{
					$grandInvoiceAmtRes = $grandInvoiceAmt->row();
					$totalInvAmt +=$grandInvoiceAmtRes->invoiceAmt;
					echo '<td align="right" style="border-bottom:1px dotted black;">'.number_format($grandInvoiceAmtRes->invoiceAmt,2).'</td>';
				}
				else
				{
					echo '<td align="right" style="border-bottom:1px dotted black;">0.00</td>';
				}
				//GET RETURN AMOUNT
				$grandRetAmt = $this->db->query("SELECT SUM(`grandtotal`) AS returnAmt FROM `sales_return` WHERE `supplierid`='".$cR->supplierId."' ");
				if($grandRetAmt->num_rows() > 0 )
				{
					$grandRetAmtRes = $grandRetAmt->row();
					$totalRetAmt +=$grandRetAmtRes->returnAmt;
					echo '<td align="right" style="border-bottom:1px dotted black;">'.number_format($grandRetAmtRes->returnAmt,2).'</td>';
				}
				else
				{
					echo '<td align="right" style="border-bottom:1px dotted black;">0.00</td>';
				}
				//GET RECEIPT AMOUNT
				$grandReceiptAmt = $this->db->query("SELECT SUM(`voucheramount`) AS receiptAmt FROM `voucher` WHERE vouchertype='receipt' AND `cus_suppId`='".$cR->supplierId."' ");
				if($grandReceiptAmt->num_rows() > 0 )
				{
					$grandReceiptAmtRes = $grandReceiptAmt->row();
					$totalRecAmt +=$grandReceiptAmtRes->receiptAmt;
					echo '<td align="right" style="border-bottom:1px dotted black;">'.number_format($grandReceiptAmtRes->receiptAmt,2).'</td>';
				}
				else
				{
					echo '<td align="right" style="border-bottom:1px dotted black;">0.00</td>';
				}
				$totalBalAmt = $grandInvoiceAmtRes->invoiceAmt-($grandRetAmtRes->returnAmt+$grandReceiptAmtRes->receiptAmt);
				echo '<td align="right" style="border-bottom:1px dotted black;">'.number_format($totalBalAmt,2).'</td>';
				$grandBalAmt +=$totalBalAmt;
				$i++;
				
			}
			echo '
			<tr>
				<td align="right" style="border-top:1px solid black;font-weight:bold" colspan="2">TOTAL</td>
				<td align="right" style="border-top:1px solid black;font-weight:bold">'.number_format($totalInvAmt,2).'</td>
				<td align="right" style="border-top:1px solid black;font-weight:bold">'.number_format($totalRetAmt,2).'</td>
				<td align="right" style="border-top:1px solid black; padding:5px;"><strong>'.number_format($totalRecAmt,2).'</strong></td>
				<td align="right" style="border-top:1px solid black; padding:5px;"><strong>'.number_format($grandBalAmt,2).'</strong></td>
			</tr>
			';
			
		}
		?>
	</table>



<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
// window.print();
});
</script>