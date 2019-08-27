<?php foreach($pre as $bil) {

$data=$this->db->get('profile')->result();

// $datas=$this->db->order_by('id','desc')->limit(1)->get('image')->result();
// foreach ($datas as $profileimage)

// echo  $profileimage->file_name;


 $customername=$bil->customerId;
 $customernames=$this->db->where('id',$customername)->get('customer_details')->row();
 
                $address1=@$customernames->address1;
                
                $address2=@$customernames->address2;
                $city=@$customernames->city;
                $pincode=@$customernames->pincode;
                $state=@$customernames->state;
//echo $customer_id;
// exit;
 // echo $this->db->last_query();
 // exit;

    foreach($data as $profile)
      // print_r($pr)
      $discountss=explode('||',$bil->discount);
$diccount=array_sum($discountss);
  ?>
<!-- <table width="650" class="topl rightl leftl bottomm" border="0" align="center"> -->
  <!-- <tr>
    <td width="180" rowspan="7" align="center"><img src="<?php //echo base_url();?>uploads/<?php //echo $profileimage->file_name;?>" width="100" height="80"  /></td> 
    <td  align="left"> &nbsp; <strong> <?php //echo @$profile->tinno;?></strong> </td>
    <td width="175" align="center"><span style="font-size: 21px; font-weight: bold; background-color: black; color: rgb(255, 255, 255); -webkit-print-color-adjust: exact;">Estimate BILL</span></td>
    <td width="127" align="right">Mobile No:</td> 
    <td width="115"><strong><?php //echo $profile->phoneno1;?></strong></td>
  </tr> -->
  <!-- <tr>
    <td height="21"  align="left"> &nbsp;<strong><?php //echo $profile->cstno;?></strong> </td>
    <td align="center">&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong><?php //echo $profile->phoneno2;?></strong></td>
  </tr> -->
  <!-- <tr>
    <td width="31">&nbsp;</td>
     <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><strong><?php //echo $profile->phoneno3;?></strong></td>
  </tr> -->
   <!--  <tr>
    <td colspan="4" align="left" style="font-size: 30px;"><strong><?php //echo $profile->companyname;?></strong></td>
  </tr> -->
    <!-- <tr>
    <td colspan="4"><strong><?php //echo $profile->address;?>, <?php //echo $profile->address2;?></strong></td>
  </tr> -->
     <!-- <tr>
    <td height="21" colspan="4" align="center"><strong style="margin-left: -154px;"><?php //echo $profile->city;?> - <?php //echo $profile->pincode;?></strong></td>
  </tr> -->
  <!-- <tr>
 <td height="21" colspan="4" align="center"><strong style="margin-left: -154px;">GSTNO :<?php //echo $profile->gstno;?></strong></td>
  </tr> -->
  <!-- <tr>
    <td height="35" colspan="2" align="left" valign="top">&nbsp;S No.<strong><?php //echo $bil->cusid;?></strong></td>
    <td valign="top">&nbsp;</td>
    <td align="right" valign="top">Date :</td>
    
  </tr> -->
<!-- </table> -->
<table  width="650" height="100"  class="rightl leftl bottomm topl" border="0" align="center">
  <tr>
    <td align="center" style="font-size: 23px;" colspan="6">&nbsp;<b><?php echo $profile->companyname;?></b></td>
    
  </tr>
  <tr>

    <!-- <td>&nbsp;</td>
    <td >&nbsp;</td>
    <td>&nbsp;</td> -->
    <td align="center" style="font-size: 20px;" colspan="6">&nbsp;<b>ESTIMATE&nbsp;BILL</b></td>
    <!-- <td>&nbsp;</td>
    <td>&nbsp;</td> -->

  </tr>
  <tr>
    <td align="left" style="    width: 60px;"> Branch : </td>
    <td><p style="border-bottom: 2px ;  "><strong><?php if($bil->customername){ echo $bil->customername;}else{echo 'CASH';}?></strong></p></td>
    <!-- <td colspan="3">&nbsp;</td> -->
    <td align="right"><p style="border-bottom: 2px ; ">Date&nbsp;:&nbsp;&nbsp;<strong><?php echo date('d-m-Y',strtotime($bil->date));?></strong></p></td>
  <td align="right" class="rights">Bill No : <strong><?php echo $bil->invoiceno;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;<strong><?php //echo date('h:i A');?></strong></td>
    <!-- <td><p style="border-bottom: 2px ; width: 98%; margin-top: -3px; margin-left: 5px;"></p></td><td align="right"></td>
    <td><p style="border-bottom: 2px ; width: 98%; margin-top: -3px; margin-left: 5px;"></p></td> -->
  </tr>
  <!-- <tr> -->

<!--   <td  align="left" valign="top">Address</td>-->
<!--  <?php //if ($bil->customer_id=='') { ?>-->
<!--<td colspan="3"><strong>&nbsp;: <?php //echo $bil->address;?></strong></td> <?php //} else {-->
  ?>-->
<!--    <td colspan="3" ><p style="border-bottom: 2px ;  margin-top: -3px; margin-left: 5px;"><strong><?php //echo $address1;?><br><?php //echo $address2; ?><br><?php //echo $city;?> - <?php //echo $pincode;?><br><?php //echo $state;?></strong></p></td>-->
<!--  <?php //} ?>-->
    <!-- <td>&nbsp;</td>
    <td>&nbsp;</td> -->
<!--     <td  align="left" valign="top">Salesman</td>
    <td><p style="border-bottom: 2px ;  margin-top: -3px; margin-left: 5px;"><strong>: <?php //echo @$bil->staff;?></strong></p></td>
  <td  align="right" colspan="3">&nbsp;</td> -->
    
  <!-- </tr> -->
 <!--<tr>-->
  <!--<td align="left">Mobile No </td>-->
  <!--  <td><p style="border-bottom: 2px ;  margin-top: -3px; margin-left: 5px;"><strong>: <?php //echo $bil->mobileno;?></strong></p></td>-->
  <!--  <td colspan="3">&nbsp;</td>
  <td align="right"><strong><?php //echo $bil->invoiceno;?></strong>&nbsp;<strong><?php //echo date('h:i A');?></strong></td>-->
  <!-- <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td>
  <td>&nbsp;</td> -->
</table>

<table width="650" height="800"  class="rightl leftl bottoms" border="0" align="center">
  <tr   class="bottoms ">
    <td width="43" class="rights" height="31" style="">S.No</td>
    <!-- <td width="120" class="rights" align="center">Item Code</td> -->
    <td width="323" class="rights" align="center">Item Name</td>
    <td width="100" class="rights" align="center" >Rate</td>
    <td width="100" class="rights" align="center">Qty</td>
    <?php 
      $discount=explode('||',$bil->discount);
$diccount=array_sum($discount);
@$discountamt=explode('||',$bil->discountamt);
$diccountamt=array_sum($discountamt);

// echo $discount;
    if($diccount>0) { ?>

    <!-- <td width="81" class="rights" align="center">Discount</td> -->
<?php }?>
<?php
if($diccountamt >0)
{
?>
    <td width="100" class="rights" align="center">Disc. Amount</td>
    <?php } ?>
<?php 
$taxtype=$bil->gsttype;
 if ($taxtype=='withtax') {?>
    <td width="100" class="rights" align="center">GST</td>
<?php } ?>
    <!-- <td width="71" class="rights" align="center">Price</td> -->

    <!-- <td width="81" class="rights" align="center">Discount</td> -->
    <?php } ?>
    <!-- <td width="81" class="rights" align="center">GST</td> -->
    <td width="86"  align="center">Amount</td>
  </tr>
  <?php 
      //$itemcode=explode('|',$bil->itemcode);
      $itemname=explode('||',$bil->itemname);
      $rate=explode('||',$bil->rate);
      $qty=explode('||',$bil->qty);
      $amount=explode('||',$bil->amount);
      //$gst=explode('||',$bil->gst);
      //$gstamount=explode('||',$bil->gstamount);
      $discount=explode('||',$bil->discount);
      @$discountamt=explode('||',$bil->discountamt);
      $cgst=explode('||',$bil->cgst);
      $cgstamount=explode('||',$bil->cgstamount);
      $sgst=explode('||',$bil->sgst);
      $sgstamount=explode('||',$bil->sgstamount);
      $total=explode('||',$bil->total);
     $count=count($itemname);

     $a=1;
     for ($i=0; $i < $count; $i++) { 
 if($discount[$i]==0 || $discount[$i]=='')
{
$discount=0;
}
else
{
$discount=$discount[$i];
}

if($discount[$i]==0 || $discount[$i]=='')
{
$discountamount=0;
}
else
{
$discountamount=0;
}        
   

   if(@$discountamt[$i]==0 || @$discountamt[$i]=='')
{
$discountamout=0;
}
else
{
$discountamout=$discountamt[$i];
}

// if($discountamt[$i]==0 || $discountamt[$i]=='')
// {
// $discountamout=0;
// }
// else
// {
// $discountamout=0;
// }        
      ?>

  <tr style="height: 2px;">
    <td class="rights" align="center"><strong><?php echo $a++;?></strong></td>
    
    <td class="rights" align="left"><strong style="font-size: 14px;">&nbsp;&nbsp;<?php echo $itemname[$i];?></strong></td>
    <td class="rights" align="center"><strong><?php echo @number_format(@$rate[$i],2);?></strong></td>

    <td class="rights" align="center"><strong><?php echo $qty[$i];?></strong></td>
    <?php
if($diccount >0)
{
?>
    <!-- <td class="rights" align="center"><strong><?php //echo $discount;?>%</strong></td> -->
    <?php } ?>
<?php
if($discountamout >0)
{
?>
    <td class="rights" align="center"><strong><?php echo $discountamout;?></strong></td>
    <?php } ?>
<?php
if($taxtype=='withtax')
{
?>
    <td class="rights" align="center"><strong><?php //echo $cgst[$i]+$sgst[$i];?><?php echo $cgstamount[$i];?></strong></td>
    <?php } ?>
     <!-- <td class="rights" align="center"><strong>@<?php //echo $gst[$i];?>%<br><?php //echo $gstamount[$i];?></strong></td>  -->
    <td  align="center"><strong><?php echo @number_format(@$total[$i],2);?></strong></td>
  </tr>
  <?php }?>
  <tr>
    <td class="rights" align="center">&nbsp;</td>
    <td class="rights" align="center">&nbsp;</td>
    <td class="rights" align="left">&nbsp;</td>
    <td class="rights" align="center">&nbsp;</td>
    <?php
if($diccount >0)
{
?>
    <!-- <td class="rights" align="center">&nbsp;</td> -->
    <?php } ?>
    <?php
if($discountamout >0)
{
?>
    <td class="rights" align="center">&nbsp;</td>
    <?php } ?>
    <?php
if($taxtype=="withtax" )
{
?>
    <td class="rights" align="center">&nbsp;</td>
    <?php } ?>
    <!-- <td class="rights" align="center">&nbsp;</td> 
    <td class="rights" align="center">&nbsp;</td> -->
    <td align="center">&nbsp;</td>
  </tr>

    <tr>
    <td class="rights" align="center">&nbsp;</td>
    <td class="rights" align="center">&nbsp;</td>
    <td class="rights" align="left">&nbsp;</td>
    <td class="rights" align="center">&nbsp;</td>
    <?php
if($diccount >0)
{
?>
    <!-- <td class="rights" align="center">&nbsp;</td> -->
    <?php } ?>
    <?php
if($discountamout >0)
{
?>
    <td class="rights" align="center">&nbsp;</td>
    <?php } ?>
    <?php
if($taxtype=="withtax" )
{
?>
    <td class="rights" align="center">&nbsp;</td>
    <?php } ?>
   <!-- <td class="rights" align="center">&nbsp;</td> 
    <td class="rights" align="center">&nbsp;</td> -->
    <td align="center">&nbsp;</td>
  </tr>

     <!-- <tr>
    <td class="rights" align="center">&nbsp;</td>
    <td class="rights" align="center">&nbsp;</td>
    <td class="rights" align="left">&nbsp;</td>
    <td class="rights" align="center">&nbsp;</td> -->
    <?php /*
if($discount >0)
{
?>
    <!-- <td class="rights" align="center">&nbsp;</td> -->
    <?php } ?>
    <?php
if($discountamout >0)
{
?>
    <td class="rights" align="center">&nbsp;</td>
    <?php } ?>
    <?php
if($taxtype=="withtax" )
{
?>
    <td class="rights" align="center">&nbsp;</td>
    <?php } ?>
     <!-- <td class="rights" align="center">&nbsp;</td> 
    <td class="rights" align="center">&nbsp;</td> -->
    <td align="center">&nbsp;</td>
  </tr>
  */ ?>
   <tr class="bottoml">
    <td class="rights" align="center">&nbsp;</td>
    <td class="rights" align="center">&nbsp;</td>
    <td class="rights" align="left">&nbsp;</td>
    <td class="rights" align="center" valign="bottom"><b><?php echo array_sum($qty);?></b> &nbsp;</td>
    <?php
if($discount >0)
{
?>
    <!-- <td class="rights" align="center">&nbsp;</td> -->
    <?php } ?>
    <?php
if($discountamout >0)
{
?>
    <td class="rights" align="center" valign="bottom"><b><?php echo  number_format(array_sum($discountamt),2); ?></b></td>
    <?php } ?>
    <?php
if($taxtype=="withtax" )
{
?>
    <td class="rights" align="center" valign="bottom"><b><?php echo  number_format(array_sum($cgstamount),2); ?></b></td>
    <!-- <td class="rights" align="center">&nbsp;</td> -->
    <?php } ?>
     <!-- <td class="rights" align="center">&nbsp;</td> 
    <td class="rights" align="center">&nbsp;</td> -->
    <td align="right" valign="bottom"><b><?php echo $bil->subtotal; ?></b>&nbsp;&nbsp;</td>
  </tr> 
</table>

<!-- <table width="650"  class="rightl leftl bottomm" border="0" align="center">

 
   <tr>
    <td width="43" height="20" class="">&nbsp;</td>
    <td class="" width="120">&nbsp;</td>
    <td class="" width="323" align="right"></td>
    <td class="" width="10" align="right">&nbsp;:&nbsp;<?php //echo array_sum($qty);?></td>
    <td width="81" align="center" class=""></td>
    <td  width="86" align="right"><strong><?php //echo number_format($bil->subtotal,2);?></strong></td>
  </tr>
</table> -->
<table width="650"  class="rightl leftl bottoml" border="0" align="center">
  <tr>
    
    <td colspan="2" width="327" valign="bottom"><b>Rupees: <?php echo $fin;?> </b></td>
    <td width="219" align="right" valign="middle" > <strong >Total : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;  </strong></td>
    <td align="right" style="font-size: 19px;"><b><?php echo $bil->subtotal;?></b></td>
  </tr>
  <tr>
    <td  colspan="2" valign="bottom"><div style="border-bottom: 2px  width: 100%; margin-left: 14px;margin-bottom: 17px;"></div></td>
    <td align="right"><strong >Round Off :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;</td>
    <td align="right" style="font-size: 19px;"><b><?php echo number_format($bil->roundOff,2);?></b></td>
  </tr>
  <?php if($bil->othercharges>0) {?>
  <tr >
    <td  colspan="2" valign="bottom"><div style="border-bottom: 2px  width: 100%; margin-left: 14px;margin-bottom: 17px;"><b><?php //echo $fin;?> </b></div></td>
    <td align="right"><strong >Othercharges :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;</td>
    <td align="right" style="font-size: 19px;"><b><?php echo number_format($bil->othercharges,2);?></b></td>
  </tr>
  <?php } ?>
  <tr >
    <td  colspan="2" valign="bottom"><div style="border-bottom: 2px  width: 100%; margin-left: 14px;margin-bottom: 17px;"><b><?php //echo $fin;?> </b></div></td>
    <td align="right"><strong >Net Total :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>&nbsp;</td>
    <td align="right" style="font-size: 21px;"><b><?php echo $bil->grandtotal;?></b></td>
  </tr>
</table>
<!-- <table align="center">
  <tr>
    <td ><strong>Thank You For Purchase </strong>&nbsp;</td>
</tr>
</table> -->
<style type="text/css">
@font-face {
    font-family: 'bauhaus_93regular';
    src: url('03983_bauhs93.woff2') format('woff2'),
         url('03983_bauhs93.woff') format('woff');
    font-weight: normal;
    font-style: normal;

}
  .leftl{
    border-left: 2px solid black;
    border-collapse: collapse;
  }

  .rightl{
    border-right: 2px solid black;
     border-collapse: collapse;
  }

  .bottoml{
    border-bottom: 2px solid black;
     border-collapse: collapse;
  }

  .topl{
    border-top: 2px solid black;
     border-collapse: collapse;
  }
  .leftm{
    border-left: 2px solid black;
    border-collapse: collapse;
  }

  .rightm{
    border-right: 2px solid black;
     border-collapse: collapse;
  }

  .bottomm{
    border-bottom: 2px solid black;
     border-collapse: collapse;
  }

  .topm{
    border-top: 2px solid black;
     border-collapse: collapse;
  }
   .lefts{
    border-left: 2px solid black;
    border-collapse: collapse;
  }

  .rights{
    border-right: 2px solid black;
     border-collapse: collapse;
  }

  .bottoms{
    border-bottom: 2px solid black;
     border-collapse: collapse;
  }

  .tops{
    border-top: 2px solid black;
     border-collapse: collapse;
  }
</style>



<?php ?>


<script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">

 $(document).ready(function(){

   window.print();
 });
  
 </script>