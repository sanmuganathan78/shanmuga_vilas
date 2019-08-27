<?php foreach($pre as $bil) {
  $data=$this->db->get('profile')->result();

  foreach($data as $profile)

   ?>
  <table width="700" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
   
    <tr>
      <td width="200" ></td>
      <td width="490" align="right" valign="top" style="font-size:14px;"><strong style="font-size: 24px;"><?php echo $profile->companyname;?></strong><br><?php echo $profile->address1;?><br><?php echo $profile->address2;?><br><b>GSTIN : <?php echo $profile->gstin;?>  </b><br>Phone : <?php echo $profile->phoneno;?>,&nbsp;Mobile : <?php echo $profile->mobileno;?><br>Email id: <?php echo $profile->emailid;?> Website : <?php echo $profile->website;?> </td>
      <td width="10"></td>
    </tr>
  </table>


  <table width="700" align="center" style="border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;border-collapse:collapse;">
    <tr>  <td  style="border-right:1px solid black;border-bottom:1px solid black;padding:5px; text-transform:uppercase; font-size: 20px;" align="center"><strong>Payment Voucher</strong></td>
    </tr>
  </table>




  <table width="700" align="center" border="0" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">
    <tr>
      <td>Voucher No:&nbsp;<b><?php echo $bil->voucherid;?></b></td>
	  <td>Voucher Type:&nbsp;<b><?php if($bil->vouchertype=='receipt') { echo 'Payable'; } else { echo 'Receivable'; }?></b></td>
      <td align="right">Date: &nbsp;<b><?php {$a=$bil->voucherdate; $d=date('d/m/Y',strtotime($a)); echo $d;};?></b></td>
    </tr>
  </table>



  <table width="700" align="center" style="border-collapse:collapse;border-right:1px solid black;border-left:1px solid black;">


   
    <tr>
      <td width="195px;" style="text-align:left;"><div style="margin-left:14px;">
      <?php if($bil->vouchertype=='payment')
       {
          echo'Amount Received From';
        }
        else
        {
          echo'Amount Given To';
        }
        ?>
      
      </div></td>
      <td style="text-align:left;border-bottom:dotted;"><div style="margin-left:15px;"><b><?php echo ucfirst($bil->name);?></b></div></td> 


    </tr>



    
    
    
  </table>

  <table width="700" align="center" style="border-collapse:collapse;border-right:1px solid black;border-left:1px solid black;">
    <tr>
      <td width="195px;" >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    <tr>
      <td width="65px;" style="text-align:left;"><div style="margin-left:14px;">The Sum Of Rupees </div></td>
      <td style="text-align:left;border-bottom:dotted;"><div style="margin-left:15px;font-size:15px;"><b><?php echo $fin;?>Only</b></div></td>     
    </tr>
    <tr>
      <td width="195px;" >&nbsp;</td>
      <td >&nbsp;</td>
    </tr>
    
  </table>



  <table width="700" align="center" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">
    <tr>
      <td style="font-size: 18px;font-weight: bold;">PAYMENT MODE :  

      </tr>
    </table>

    <?php  if($bil->paymentmode=="Cash") { ?>


    <table width="700" align="center" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">



      <?php if($bil->amount!="0") { ?>


      <tr>
       <div align="center">
        <td></td>
        <td align="right">&nbsp;&nbsp;Type</td>
        <td>:

         &nbsp;&nbsp;<b><?php echo $bil->paymentmode;?></b></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         <td style="font-size: 14px;">AMOUNT : <b><?php echo number_format($bil->voucheramount,2);?></b></td>
       </div>
     </tr>

     
     <?php } ?>

   </table>

   <?php }?>



   <?php  if($bil->paymentmode=="Bank") { ?>
   <table width="700" border="0" align="center" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">



    <?php if($bil->banktransfer!="0") { ?>


    <tr>
     <div align="center">
      <td></td>
      <td align="right">&nbsp;&nbsp;Type</td>
      <td>:

       &nbsp;&nbsp;<b><?php echo $bil->paymentmode;?></b></td>
       
       <td style="font-size: 14px;" width="150">AMOUNT : <b><?php echo number_format($bil->voucheramount,2);?></b></td>
     </div>
   </tr>

   <tr>
     <div align="center">
      <td></td>
      <td align="right">&nbsp;&nbsp;Bank Name </td>
      <td>:

       &nbsp;&nbsp;<b><?php echo $bil->banktransfer;?></b> (<?php echo $bil->voucherdate;?>) (<?php echo $bil->transactionid;?>)</td>
       <td>&nbsp;</td>
     </div>
   </tr>
   <?php } ?>

 </table>

 <?php }?>


 <?php  if($bil->paymentmode=="Cheque") { ?>


 <table width="700" align="center" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">

  

  




   <?php if($bil->throughcheck!="0") { ?>

   <tr>
     <div align="center">
      <td></td>
      <td align="right">&nbsp;&nbsp;Type</td>
      <td align="left">:
       &nbsp;&nbsp;<b><?php echo $bil->paymentmode;?></b></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td style="font-size: 14px;">AMOUNT : <b><?php echo number_format($bil->voucheramount,2);?></b></td>
     </div>
   </tr>

   <tr>
     <div align="center">
      <td></td>
      <td align="right">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Bank Name</td>
      <td align="left">:
       &nbsp;&nbsp;<b><?php echo $bil->throughcheck;?></b></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
     </div>
   </tr>

   <?php  }  ?>

   <?php if($bil->chequeno!="") { ?>

   <tr> 
    <div align="right">
      <td></td>
      <td align="right">Cheque No </td>
      <td>:&nbsp;&nbsp;
       <b><?php echo $bil->chequeno;?></b> (<?php echo $bil->chequedate;?>)</td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
       <td></td>
     </div>
   </tr>

   <?php } ?>
</table>
 <?php } ?>
   <?php  if($bil->paymentmode=="Card") { ?>
<table width="700" align="center" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">



    


   <tr>
   <div align="center">
    <td></td>
   <td align="right">&nbsp;&nbsp;Type</td>
      <td>:

   &nbsp;&nbsp;<b><?php echo $bil->paymentmode;?></b></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
  <td></td>
   <td></td>
   <td></td>
   <td style="font-size: 14px;">AMOUNT : <b style="font-size: 15px;"><?php echo number_format($bil->overallamount,2);?></b></td>
   </div>
  </tr>

   <tr>
   <div align="center">
    <td></td>
   <td align="right">&nbsp;&nbsp;Card Type </td>
      <td>:

   &nbsp;&nbsp;<b><?php echo $bil->paymentdetails;?></b></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
   <td></td>
  <td></td>
   <td></td>
   <td></td>
   <td></td>
   </div>
  </tr>
  


 </table>

 <?php }?>





 <table width="700" align="center" style="border-collapse: collapse;border-bottom: 1px solid black;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="8">
  <tr>
    <td width="350" height="50" align="left" valign="bottom"><b>Receiver's Signature</b></td>
    <td width="350" align="right" valign="bottom"><b>Authorised Signatory</b></td>
  </tr>
</table>



<?php }  ?>

<script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
  //window.print();
</script>
