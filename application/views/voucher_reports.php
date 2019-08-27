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


    
<table width="900" border="0" align="center" style="border-collapse:collapse; font-family:Calibri ;font-size:18px;">
 <tr >
      <td class="heading1" width="316"><div align="center"><strong><?php echo $title;?></strong></div></td>
      <tr align="center">
        <td class="padding" style="font-size:13px;" width="134"><b><?php echo $address1;?><br><?php echo $address2;?>
          <br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>GSTIN :&nbsp;<?php echo $gstin;?></b></td>
        </tr>
      </tr>

</table>


<table width="900" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
  <tr style="font-size: 16px;">
    <td height="35" width="175" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Voucher Reports</strong></td>
       <td height="35" width="250" align="left" style="border-bottom:1px solid black;"><strong>Name:<?php echo $this->session->userdata('mac_name');?></strong>     </td>
   <td height="35" width="238" align="left" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $this->session->userdata('mac_fromdate');?></strong>     </td>
    <td height="35" width="237" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $this->session->userdata('mac_todate');?></strong></td>
  </tr>
</table>

<table width="900" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    
    <td width="100" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
    <td width="300" align="left" style="border-bottom:1px solid black;"><strong>Name</strong></td>
    <!--<td width="120"  align="left" style="border-bottom:1px solid black;"><strong>Purpose</strong></td>-->
     <td width="340" align="left" style="border-bottom:1px solid black;"><strong>Payment Details</strong></td>
     <td width="160" align="right" style="border-bottom:1px solid black;"><strong>Voucher Amount</strong></td>
       
    
  </tr>
  <?php
  $i=1; 
  foreach ($purchase as $row) {



     $date=date('d-m-Y',strtotime($row['voucherdate']));
     $suppliername=$row['name'];
    //$purpose=$row['purpose'];
    $paymentdetails=$row['paymentdetails'];
    $amount=$row['overallamount'];

   $purchases[]=$amount;
   @$pur=array_sum($purchases);

  


    // $pay[]=$paid;
    // $p=array_sum($pay);

       
   ?>
  <tr>

    <td align="left" style="border-bottom:1px dotted black;"><?php echo $date;?></td>
    <td align="left" style="border-bottom:1px dotted black;"><?php echo ucfirst($suppliername);?></td>
    <!--<td align="left" style="border-bottom:1px dotted black;"><?php echo ucfirst($purpose);?></td>-->
    <td align="left" style="border-bottom:1px dotted black;"><?php echo $paymentdetails;?></td>
    <td align="right" style="border-bottom:1px dotted black;"><?php echo number_format($amount,2);?></td>

    
    
     
     
  </tr>
  <?php }?>
	<tr>
		<td align="left" style="border-bottom:1px solid black;">&nbsp;</td>
		<td align="left" style="border-bottom:1px solid black;">&nbsp;</td>	
		<td align="right" style="border-bottom:1px solid black;"><strong>Total Voucher Amount</strong></td>	
		<td align="right" style="border-bottom:1px solid black;"><strong><?php echo number_format($pur,2);?></strong></td>
		
	</tr>

</table>

 

        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

                                  // window.print();



                                });

</script>