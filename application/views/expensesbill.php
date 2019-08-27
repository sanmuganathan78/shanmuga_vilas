<?php foreach($pre as $bil) {

 
$data=$this->db->get('profile')->result();

$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)

// echo  $profileimage->file_name;

    foreach($data as $profile)

  ?>
<table width="700" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
 
  <tr>
<td width="200" ><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="200" height="100" alt="logo" /></td>
<td width="490" align="right" valign="top" style="font-size:14px;"><strong style="font-size: 24px;"><?php echo $profile->companyname;?></strong><br><?php echo $profile->address1;?><br><?php echo $profile->address2;?><br><b>GSTIN : <?php echo $profile->gstin;?></b><br>Phone : <?php echo $profile->phoneno;?>,&nbsp;Mobile : <?php echo $profile->mobileno;?><br>Email id: <?php echo $profile->emailid;?> Website : <?php echo $profile->website;?> </td>
<td width="10"></td>
</tr>
</table>


<table width="700" align="center" style="border-bottom:1px solid black;border-left:1px solid black;border-right:1px solid black;border-collapse:collapse;">
<tr>  <td  style="border-right:1px solid black;border-bottom:1px solid black;padding:5px; text-transform:uppercase; font-size: 20px;" align="center"><strong>Expenses Voucher</strong></td>
</tr>
</table>

<table width="700" align="center" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">
  <tr>
    <td>Expenses No :&nbsp;<b><?php echo $bil->expensesid;?></b></td>
    <td align="right">Date: &nbsp;<b><?php {$a=$bil->expensesdate; $d=date('d/m/Y',strtotime($a)); echo $d;};?></b>&nbsp;&nbsp;</td>
  </tr>
  
</table>


<table width="700" align="center" style="border-collapse:collapse;border-right:1px solid black;border-left:1px solid black;">
        
        <tr>
          <td width="195px;" style="text-align:left;"><div style="margin-left:14px;">Amount Given To</div></td>
          <td style="text-align:left;border-bottom:dotted;"><div style="margin-left:15px;"><b><?php echo ucfirst($bil->name);?> </b></div></td> 


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
       
         
        </table>
        <table width="700" align="center" style="border-collapse:collapse;border-right:1px solid black;border-left:1px solid black;">
        <tr>
          <td width="100px;" >&nbsp;</td>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td width="195px;" style="text-align:left;"><div style="margin-left:14px;">Account Head</div></td>
          <td style="text-align:left;border-bottom:dotted;"><div style="margin-left:15px;"><b><?php echo strtoupper($bil->headers);?> </b></div></td> 


        </tr>
       
         
        </table>
<table width="700" align="center" style="border-collapse:collapse;border-right:1px solid black;border-left:1px solid black;">
        <tr>
          <td width="100px;" >&nbsp;</td>
          <td >&nbsp;</td>
        </tr>
        <tr>
          <td width="195px;" style="text-align:left;"><div style="margin-left:14px;">Purpose</div></td>
          <td style="text-align:left;border-bottom:dotted;"><div style="margin-left:15px;"><b><?php echo ucfirst($bil->purpose);?> </b></div></td> 


        </tr>
       
         
        </table>


<table width="700" align="center" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">
  <tr>
    <td style="font-size: 16px;font-weight: bold;">PAYMENT 
    TYPE :  

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
   <td style="font-size: 14px;">AMOUNT : <b style="font-size: 15px;"><?php echo number_format($bil->overallamount,2);?></b></td>
   </div>
  </tr>

 
  <?php } ?>

</table>

<?php }?>



 <?php  if($bil->paymentmode=="Bank") { ?>
<table width="700" align="center" style="border-collapse: collapse;border-right: 1px solid black;border-left: 1px solid black;" cellpadding="10">



    <?php if($bil->banktransfer!="0") { ?>


   <tr>
   <div align="center">
    <td></td>
   <td align="right">&nbsp;&nbsp;Type</td>
      <td>:

   &nbsp;&nbsp;<b>NEFT / RTGST</b></td>
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
   <td align="right">&nbsp;&nbsp;Bank Name </td>
      <td>:

   &nbsp;&nbsp;<b><?php echo $bil->banktransfer;?></b></td>
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
   <td style="font-size: 14px;">AMOUNT : <b style="font-size: 15px;"><?php echo number_format($bil->overallamount,2);?></b></td>
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
   <b><?php echo $bil->chequeno;?></b></td>
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

<?php }?>
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
