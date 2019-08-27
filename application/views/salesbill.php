
<?php

        $profilesgetdata=$this->db->where('status',1)->get('profile')->result_array();
        foreach ($profilesgetdata as $key => $profilesgetdatas) {
            $title=$profilesgetdatas['companyname'];
            $address=$profilesgetdatas['address1'].', '.$profilesgetdatas['address2'].', '.$profilesgetdatas['city'].', '.$profilesgetdatas['stateCode'].', '.$profilesgetdatas['pincode'];
            // $d->address1.', '.$d->address2.', '.$d->city.', '.$d->state;
             $mobileno=$profilesgetdatas['phoneno'];
        }

    ?>
    <?php foreach ($pre as $row) {
  ?>
<html>
<head>

<title>bill</title>
</head>

<body>
<table width="340"  border="0" align="center"  >

  <tr>
    <th width="231" align="center" style="font-size: 13px;" ><p style="font-size: 25px;"><?php echo $title;?></p><p style="margin-top: -18px;font-family:Arial, Helvetica, sans-serif"><?php echo $address;?></p><p style="margin-top: -11px;font-family:Arial, Helvetica, sans-serif">Phone No: <?php echo $mobileno;?></p></th>
  </tr>
</table>

<table width="310"  border="0" align="center" style="border-bottom:1px dotted black;border-top:1px dotted black;font-family:Arial, Helvetica, sans-serif">
  <tr>
      <td style="font-size: 13px;"></td>
    <td style="font-size: 13px;"><strong>Bill No:&nbsp;<?php echo $row->invoiceno;?></strong></td>
    <!--<td style="font-size: 13px;"><strong><?php //echo $row->invoiceno;?></strong></td>-->
    <!--<td style="font-size: 13px;"></td>
  
    <td style="font-size: 13px;"><strong><?php //echo $time;?></strong></td>-->
    <td style="font-size: 13px;"></td>
    
    <td style="font-size: 13px;"><strong>Date:&nbsp;<?php echo date('d-m-Y',strtotime($row->date));?>
    </strong></td>
  </tr>
</table>
<table width="310"  border="0" align="center"  style="border-bottom:1px dotted black;font-family:Arial, Helvetica, sans-serif">
<?php if($row->customername!=""){?>
  <tr>
    <td width="99" align="left" style="font-size: 13px;" scope="row">Customer Name</td>
    <td width="10" align="left" style="font-size: 13px;" scope="row">:</td>
    <td width="177" align="left" style="font-size: 13px;" scope="row"><?php echo $row->customername;?></td>
  </tr>
  <?php } ?>
  <?php if($row->cust_mobno!=""){?>
  <tr>
    <td scope="row" align="left" style="font-size: 13px;">Mobile </td>
    <td scope="row" align="left" style="font-size: 13px;">: </td>
    <td scope="row" align="left" style="font-size: 13px;"><?php echo $row->cust_mobno;?></td>
  </tr>
  <?php } ?>
</table>
<table width="310"  border="0" align="center"  style="border-bottom:1px dotted black;">
  <tr>
    <th align="center" scope="row" ><b >CASH BILL</b></th>
  </tr>
</table>
<table width="310" align="center" style="border-bottom:1px dotted black;border-collapse:collapse;font-family:Arial, Helvetica, sans-serif"  >
<tr>
  <td> 
    </td>
</tr>
  <tr >
    <td  align="left" width="128" scope="row" style="border-bottom:1px dotted black;border-collapse:collapse;font-weight:bold;font-size: 14px;">Product</td>
    <td  align="center" width="42" style="border-bottom:1px dotted black;border-collapse:collapse;font-weight:bold;font-size: 14px;">Qty</td>
    <td  align="right" width="46" style="border-bottom:1px dotted black;border-collapse:collapse;font-weight:bold;font-size: 14px;">Rate</td>
      <td  align="right" width="64" style="border-bottom:1px dotted black;border-collapse:collapse;font-weight:bold;font-size: 14px;padding-right: 10px;">Amount</td>
  </tr>
  <?php 
  $itemname=explode('||', $row->itemname);
   $qty=explode('||', $row->qty);
    $rate=explode('||', $row->rate);
     $amount=explode('||', $row->amount);
     $discountamount=explode('||', $row->discountamount);
     $count=count($itemname);
     for ($i=0; $i < $count; $i++) { 
    $sub_tot[]= $amount[$i];
    @$disc_tot[]= @$discountamount[$i];
  ?>
  <tr>
    <td  align="left" scope="row" style="font-weight:bold;font-size: 14px;"><?php echo $itemname[$i];?></td>
    <td  align="center" style="font-weight:bold;font-size: 14px;"><?php echo $qty[$i];?></td>
    <td  align="right" style="font-weight:bold;font-size: 14px;"><?php echo $rate[$i];?></td>
    <td  align="right" style="font-weight:bold;font-size: 14px;"><?php echo $amount[$i];?>&nbsp;</td>
  </tr>
 <!-- <tr>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
     <td>&nbsp;</td>
 </tr> -->
  <?php }?>
  </table>
<table width="310" align="center"   style="border-bottom:1px dotted black;font-family:Arial, Helvetica, sans-serif" >
  <tr>
   
    <td width="208"  align="right" style="font-size: 14px;">Subtotal</td>
    <td width="36"  align="right" style="font-size: 14px;"></td>
    <td width="40" align="right"   style="font-size: 14px;"><strong><small style="margin-left: 40px;font-size: 14px;"><?php echo number_format(array_sum($sub_tot),2);?>&nbsp;</small></strong></td>
  </tr>
   <tr>
  
    <td  align="right" style="font-size: 14px;">Discount </td>
    <td  align="center" style="font-size: 14px;"><strong><?php  //if($row->discount){?><?php //echo $row->discount;?><?php //}?></strong></td>
    <td  style="font-size: 14px;" align="right"><strong><?php  if($discountamount==''){?>0.00<?php }?><?php echo number_format(array_sum($disc_tot),2);?>&nbsp;</strong></td>
  </tr>
   <tr>
   
    <td  align="right" style="font-size: 14px;" >Round Off</td>
    <td  align="right" style="font-size: 14px;"></td>
    <td   style="font-size: 14px;" align="right"><strong><?php  if(@$row->roundOff==''){?>0.00<?php }?><?php echo number_format(@$row->roundOff,2);?>&nbsp;</strong></td>
  </tr>
</table>
 <table  border="0" >
  <tr>
    <th scope="row" align="center"></th>
    <th scope="row" align="right"></th>
  </tr>
</table>
 <table width="310"  border="0" align="center"  style="border-bottom:1px dotted black;">
  <tr>
  <th scope="row" align="center"><b ></b></th>
  <th scope="row" align="center"><b ></b></th>
    <th scope="row" align="center"><b style="font-size: 20px;">NET AMOUNT</b></th>
    <th scope="row" align="right"><b style="margin-left: 10px;font-size: 20px;"><?php echo number_format($row->grandtotal,2);?>&nbsp;</b></th>
  </tr>
   <tr>
    <th scope="row" align="center"><b ></b></th>
    <th scope="row" align="right"><b ></b></th>
  </tr>
</table>


<table width="310"  border="0" align="center"  style="border-bottom:1px dotted black;border-top:1px dotted black;">
  <tr>
    <th scope="row" align="center"><b >Thank You for shopping with Us</b></th>
  </tr>
   <tr>
    <th scope="row" align="center"><p><b >Visit Again</b></p>
     <p style="margin-bottom: 3px;margin-top: -13px;"><b></b></p></th>
  </tr>
  <tr>
    <th scope="row" align="center" style="border-top:1px dotted black;"><b >Sold items should not return back</b></th>
  </tr>
</table>
<br>

<table  border="0" hight="10"  >
  <tr>
    <th scope="row" align="center"></th>
  </tr>
   <tr>
    <th scope="row" align="center"></th>
  </tr>
</table>
</body>
</html>
<?php }?>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
   window.print();
//   window.onfocus=function(){ window.close();}
</script>