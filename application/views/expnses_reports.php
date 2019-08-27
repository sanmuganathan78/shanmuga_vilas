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
        <td class="padding" style="font-size:13px;" width="134"><b><?php echo $address1;?><br><?php echo $address2;?>
          <br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>GSTIN :&nbsp;<?php echo $gstin;?></b></td>
        </tr>
      </tr>

</table>

<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
  <tr style="font-size: 16px;">
    <td height="35" width="334" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Expenses Reports</strong></td>
    <td height="35" width="334" align="center" style="border-bottom:1px solid black;"><strong>Name:<?php echo $this->session->userdata('rcbio_name');?></strong>     </td>
   <td height="35" width="334" align="center" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $this->session->userdata('rcbio_fromdate');?></strong>     </td>
    <td height="35" width="318" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $this->session->userdata('rcbio_todate');?></strong></td>
  </tr>
</table>

<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    
    <td width="100" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
    <td width="120" align="left" style="border-bottom:1px solid black;"><strong>Name</strong></td>
    <td width="120"  align="left" style="border-bottom:1px solid black;"><strong>Purpose</strong></td>
     <td width="130" align="left" style="border-bottom:1px solid black;"><strong>Payment Details</strong></td>
     <td width="120" align="center" style="border-bottom:1px solid black;"><strong>Amount</strong></td>
       
    
  </tr>
  <?php
  $i=1; 
  foreach ($purchase as $row) {



     $date=date('d-m-Y',strtotime($row['expensesdate']));
     $suppliername=$row['name'];
    $purpose=$row['purpose'];
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
    <td align="left" style="border-bottom:1px dotted black;"><?php echo ucfirst($purpose);?></td>
    <td align="left" style="border-bottom:1px dotted black;"><?php echo $paymentdetails;?></td>
    <td align="center" style="border-bottom:1px dotted black;"><?php echo number_format($amount,2);?></td>

    
    
     
     
  </tr>
  <?php }?>
 

</table>

  
<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">

  <tr style="font-size: 15px;">
    <td style="border-bottom:1px solid black; border-top:1px solid black;" height="20">&nbsp;</td>
    <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
     <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>

    <td align="left" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong style="margin-left:700px;">Expenses Amount&nbsp;<?php echo number_format(@$pur,2);?></strong></td>
    <td align="left" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong></strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    
  </tr>

  

  </table>
    

        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

                                  // window.print();



                                });

</script>