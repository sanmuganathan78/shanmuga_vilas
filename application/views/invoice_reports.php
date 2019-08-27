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
            $cstno=$profilesgetdatas['cstno'];
        }

    ?>


    
<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family:Calibri ;font-size:18px;">
 <tr >
      <td class="heading1" width="316"><div align="center"><strong><?php echo $title;?></strong></div></td>
  <tr align="center">
        <td class="padding" style="font-size:13px;" width="134"><b><?php echo $address1;?><?php echo $address2;?>
          <br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>GSTIN :&nbsp;<?php echo $gstin;?></b></td>
  </tr>
      </tr>

</table>




<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
	<tr style="font-size: 16px;">
		<td height="35" width="173" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>INVOICE TAX REPORT </strong></td>
		<td height="35" width="206" align="left" style="border-bottom:1px solid black;"><strong><em>Tax Type:<?php echo $this->session->userdata('rcbio_gsttype');?></em></strong>     </td>
		<td height="35" width="206" align="left" style="border-bottom:1px solid black;"><strong><em>Tax Percentage:<?php echo $this->session->userdata('rcbio_tax_percent'); if($this->session->userdata('rcbio_tax_percent')!="") { echo " %"; } else { echo ""; } ?></em></strong>     </td>

		<td height="35" width="207" align="left" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $this->session->userdata('rcbio_fromdate');?></strong>     </td>
		<td height="35" width="208" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $this->session->userdata('rcbio_todate');?></strong></td>
	</tr>
</table>

<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    <?php if($this->session->userdata('rcbio_gsttype')=='intrastate')
     {
      $width="250px;";
    }
      else if($this->session->userdata('rcbio_gsttype')=='interstate') {
          $width="300px;";
           } 
          else {
            $width="400px;";
           } ?>    
    <td width="109" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
    <td width="131" align="left" style="border-bottom:1px solid black;"><strong>Invoice No</strong></td>
    <td width="69" align="left" style="border-bottom:1px solid black;"><strong>Company Name</strong></td>
    <td width="125" align="center" style="border-bottom:1px solid black;"><strong>GSTIN</strong></td>
    <td width="85" align="right" style="border-bottom:1px solid black;"><strong>Basic Amt</strong></td>
    <?php if($this->session->userdata('rcbio_gsttype')=='intrastate') { ?>
    <td width="85" align="right" style="border-bottom:1px solid black;"><strong>SGST</strong></td>
    <td width="85" align="right" style="border-bottom:1px solid black;"><strong>CGST</strong></td>
    <?php }  else if($this->session->userdata('rcbio_gsttype')=='interstate') {?>
    <td width="148" align="right" style="border-bottom:1px solid black;"><strong>IGST</strong></td>
    <?php } ?>
    
    <td width="125" align="right" style="border-bottom:1px solid black;"><strong>Invoice Amt</strong></td>
  </tr>
  <?php

   
  $i=1;
  $total[]=array(); 
  $sgst_amounts[]=array(); 
  $igst_amounts[]=array(); 
  $cgst_amounts[]=array(); 
  $de_amounts[]=array();
  $extraamount = array();
//print_r($invoice);  
  foreach ($invoice as $row) {
    if($row['sgstamount']!="")
    {
      $sgstamount=explode('||',$row['sgstamount']);
      @$sgst_amount=array_sum($sgstamount)+$row['loadingsgstamount']+$row['freightsgstamount'];
      @$sgst_amounts[]=array_sum($sgstamount)+$row['loadingsgstamount']+$row['freightsgstamount'];
    }
    else
    {
      $sgst_amount=0;
    }
       if($row['igstamount']!="")
    {
      $igstamount=explode('||',$row['igstamount']);
      @$igst_amount=array_sum($igstamount)+$row['loadingigstamount']+$row['freightigstamount'];
      @$igst_amounts[]=array_sum($igstamount)+$row['loadingigstamount']+$row['freightigstamount'];
    }
    else
    {
      $igst_amount=0;
    }
       if($row['cgstamount']!="")
    {
      $cgstamount=explode('||',$row['cgstamount']);
      @$cgst_amount=array_sum($cgstamount)+$row['loadingcgstamount']+$row['freightcgstamount'];
      @$cgst_amounts[]=array_sum($cgstamount)+$row['loadingcgstamount']+$row['freightcgstamount'];;
    }
    else
    {
      $cgst_amount=0;
    }
       if($row['amount']!="")
    {
      $amount=explode('||',$row['amount']);	  
	  if($row['freightcgstamount'] == 0.00 || $row['loadingcgstamount'] == 0.00){
		  $de_amount=array_sum($amount);
          $de_amounts[]=array_sum($amount);
	  }else{
	   $de_amount=array_sum($amount)+$row['freightamount']+$row['loadingamount'];
       $de_amounts[]=array_sum($amount)+$row['freightamount']+$row['loadingamount'];
	  }
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

    <td align="left" style=""><?php echo date('d-m-Y',strtotime($row['invoicedate']));?></td>
    <td align="left" style=""><?php echo $row['invoiceno'];?></td>
    <td align="left" style=""><?php echo ucfirst($row['customername']);?></td>
    <td align="center" style=""><?php echo $gstin;?></td>
    <td align="right" style=""><?php echo $de_amount;?></td>
    <?php if($this->session->userdata('rcbio_gsttype')=='intrastate') { ?>
    <td align="right" style=""><?php echo $sgst_amount;?></td>
     <td align="right" style=""><?php  echo $cgst_amount;;?></td>
     <?php }  else if($this->session->userdata('rcbio_gsttype')=='interstate') {?>
    <td align="right" style=""><?php   echo $igst_amount;?></td>
     <?php } ?>
    
    <td align="right" style=""><?php echo @number_format($row['grandtotal'],2)?></td>
         
  </tr>
  <?php }
  $totals=array_sum($total);
  
  ?>

   <tr style="font-size: 17px;">
    <td  height="20" style="border-bottom:1px solid black; border-top:1px solid black;">&nbsp;</td>
    <td  style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td  style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td  style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format(array_sum($de_amounts));?></strong></td>
    <?php if($this->session->userdata('rcbio_gsttype')=='intrastate') { ?>
    <td  align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format(array_sum($sgst_amounts));?></strong></td>
     <td  align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>
      <?php  echo number_format(array_sum($cgst_amounts));?>
     </strong></td>
     <?php }  else if($this->session->userdata('rcbio_gsttype')=='interstate') {?>
    <td  align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>
      <?php   echo number_format(array_sum($igst_amounts));?>
    </strong></td>
     <?php } ?>
    <td  align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format($totals,2);?></strong></td>
  </tr>
 

</table>




<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
  $(document).ready(function(){ });
</script>