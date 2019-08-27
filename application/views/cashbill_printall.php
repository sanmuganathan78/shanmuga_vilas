<?php

        $profilesgetdata=$this->db->where('status',1)->get('profile')->result_array();
        foreach ($profilesgetdata as $key => $profilesgetdatas) {
            $title=$profilesgetdatas['companyname'];
            // $logo=$profilesgetdatas['logo'];
            $address=$profilesgetdatas['address1'].', '.$profilesgetdatas['address2'].', '.$profilesgetdatas['city'].', '.$profilesgetdatas['stateCode'].', '.$profilesgetdatas['pincode'];
            // $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
             $mobileno=$profilesgetdatas['phoneno'];
        }

    ?>


    
<table width="340"  border="0" align="center"  >

  <tr>
    <th width="231" align="center" style="font-size: 13px;" ><p style="font-size: 25px;"><?php echo $title;?></p><p style="margin-top: -18px;font-family:Arial, Helvetica, sans-serif"><?php echo $address;?></p><p style="margin-top: -11px;font-family:Arial, Helvetica, sans-serif">Phone No: <?php echo $mobileno;?></p></th>
  </tr>
</table>




<table width="310" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;border-top: dotted 1px;">
	<tr style="font-size: 16px;">
		<!-- <td height="35" width="173" align="left" style="border-bottom:1px dotted black;text-transform:uppercase;"><strong>CASH BILL REPORT </strong></td>
		<td height="35" width="206" align="left" style="border-bottom:1px dotted black;"><strong><em>Cash Bill No:<?php echo $this->session->userdata('rcbio_invoiceno');?></em></strong>     </td>
		<td height="35" width="206" align="left" style="border-bottom:1px dotted black;"><strong><em>Customer:<?php echo $this->session->userdata('rcbio_cusname');  ?></em></strong>     </td> -->

		<td  align="center" style="border-bottom:1px dotted black;"><strong>Date : <?php echo $this->session->userdata('rcbio_fromdate');?> to <?php echo $this->session->userdata('rcbio_todate');?></strong>     </td>
		<!-- <td  width="208" align="left" style="border-bottom:1px dotted black;"><strong>To Date:<?php echo $this->session->userdata('rcbio_todate');?></strong></td> -->
	</tr>
</table>

<table width="310" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    
    <td width="109" align="left" style="border-bottom:1px dotted black;"><strong>&nbsp;Date</strong></td>
    <td width="80" align="left" style="border-bottom:1px dotted black;"><strong>Invoice No</strong></td>
    <!-- <td width="69" align="left" style="border-bottom:1px dotted black;"><strong>Company Name</strong></td> 
    <td width="85" align="right" style="border-bottom:1px dotted black;"><strong>Basic Amt</strong></td>-->
    <!-- <td width="85" align="right" style="border-bottom:1px dotted black;"><strong>SGST</strong></td>
    <td width="85" align="right" style="border-bottom:1px dotted black;"><strong>CGST</strong></td>
    <td width="148" align="right" style="border-bottom:1px dotted black;"><strong>IGST</strong></td> -->
    <td width="125" align="center" style="border-bottom:1px dotted black;"><strong>Invoice Amt</strong></td>
  </tr>
  <?php

   
  $i=1;
  $total[]=array(); 
  $sgst_amounts[]=array(); 
  $igst_amounts[]=array(); 
  $cgst_amounts[]=array(); 
  $de_amounts[]=array(); 
  foreach ($invoice as $row) {
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


     $date=date('d-m-Y',strtotime($row['invoicedate']));
    
     $total[]=$row['grandtotal'];

     @$gstin=$this->db->select('gstno')->where('id',$row['customerId'])->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->gstno;
     @$phoneno=$this->db->select('phoneno')->where('id',$row['customerId'])->where("(type = 'Intra customer' OR type = 'Inter customer')")->get('customer_details')->row()->phoneno;
  
   ?>
  <tr>

    <td align="left" style="">&nbsp;<?php echo date('d-m-Y',strtotime($row['invoicedate']));?></td>
    <td align="left" style=""><?php echo $row['invoiceno'];?></td>
    <!-- <td align="left" style=""><?php echo ucfirst($row['customername']);?></td> -->
   <!--  <td align="right" style=""><?php echo $de_amount;?></td>
    <td align="right" style=""><?php echo $sgst_amount;?></td>
     <td align="right" style=""><?php  echo $cgst_amount;;?></td>
    <td align="right" style=""><?php   echo $igst_amount;?></td> -->
    
    <td align="right" style=""><?php echo @number_format($row['grandtotal'],2)?>&nbsp;&nbsp;</td>
         
  </tr>
  <?php }
  $totals=array_sum($total);
  
  ?>

   <tr style="font-size: 17px;">
    <td  height="20" style="border-bottom:1px dotted black; border-top:1px dotted black;">&nbsp;</td>
    <td  style="border-bottom:1px dotted black;  border-top:1px dotted black;"><strong>&nbsp;</strong></td>
  <!--   <td  style="border-bottom:1px dotted black;  border-top:1px dotted black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px dotted black;  border-top:1px dotted black;"><strong><?php echo number_format(array_sum($de_amounts));?></strong></td>
    <td  align="right" style="border-bottom:1px dotted black;  border-top:1px dotted black;"><strong><?php echo number_format(array_sum($sgst_amounts));?></strong></td>
     <td  align="right" style="border-bottom:1px dotted black;  border-top:1px dotted black;"><strong>
      <?php  echo number_format(array_sum($cgst_amounts));?>
     </strong></td>
    <td  align="right" style="border-bottom:1px dotted black;  border-top:1px dotted black;"><strong>
      <?php   echo number_format(array_sum($igst_amounts));?> -->
    </strong></td>
    <td  align="right" style="border-bottom:1px dotted black;  border-top:1px dotted black;"><strong><?php echo number_format($totals,2);?>&nbsp;&nbsp;</strong></td>
  </tr>
 

</table>




<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){ });
</script>