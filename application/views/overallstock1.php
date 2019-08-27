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
      <td class="padding" style="font-size:13px;" width="134"><b><?php echo $address1;?><?php echo $address2;?>
        <br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>GSTIN:&nbsp;<?php echo $gstin?></b></td>
  </tr>
    </tr>
</table>
<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
    <tr style="font-size: 16px;">
      <td height="35" width="334" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong> Stock Reports</strong></td>
      <td height="35" width="334" align="center" style="border-bottom:1px solid black;"><strong>From Date:<?php  echo date('d-m-Y',strtotime($this->input->post('fromdate')));?></strong>     </td>
      <td height="35" width="318" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php  echo date('d-m-Y',strtotime($this->input->post('todate')));?></strong></td>
    </tr>
  </table>
  <table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
    <tr>
      <td width="41" height="29" align="left" style="border-bottom:1px solid black;"><strong>S.No</strong></td>
      <td width="99" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
      <td width="141" align="left" style="border-bottom:1px solid black;"><strong>HSN Code</strong></td>
      <td width="174" align="left" style="border-bottom:1px solid black;"><strong>Item Name</strong></td>
      <td width="93" align="center" style="border-bottom:1px solid black;"><strong>Rate</strong></td>
       <td width="73" align="center" style="border-bottom:1px solid black;"><strong>SGST</strong></td>
       <td width="56" align="center" style="border-bottom:1px solid black;"><strong>CGST</strong></td>
       <td width="62" align="center" style="border-bottom:1px solid black;"><strong>IGST</strong></td>
       <td width="107" align="center" style="border-bottom:1px solid black;"><strong>Last Updated</strong></td>
      <td width="112" align="right" style="border-bottom:1px solid black;"><strong>Balance Qty</strong></td>
    </tr>
    <?php
    $i=1; 
    foreach ($stock as $row) {
      $date=date('d-m-Y',strtotime($row['date']));
     
// $batchno=$row['batchno'];
      $itemname=$row['itemname'];
      $hsnno=$row['hsnno'];
      $rate=$row['rate'];
      $sgst=$row['sgst'];
      $cgst=$row['cgst'];
      $igst=$row['igst'];
      $updatestock=$row['updatestock'];
      $qty=$row['balance'];
      $qt[]=$qty;
      $p=array_sum($qt);
      ?>
      <tr>
        <td height="22" align="left" style="border-bottom:1px dotted black;"><strong><?php echo $i++;?></strong></td>
        <td align="left" style="border-bottom:1px dotted black;"><strong><?php echo $date;?></strong></td>
        <td align="left" style="border-bottom:1px dotted black;"><strong><?php echo $hsnno;?></strong></td>
        <td align="left" style="border-bottom:1px dotted black;"><strong><?php echo $itemname;?></strong></td>
        <td align="center" style="border-bottom:1px dotted black;"><strong><?php echo $rate;?></strong></td>
          <td align="center" style="border-bottom:1px dotted black;"><strong><?php echo $sgst;?></strong></td>
           <td align="center" style="border-bottom:1px dotted black;"><strong><?php echo $cgst;?></strong></td>
            <td align="center" style="border-bottom:1px dotted black;"><strong><?php echo $igst;?></strong></td>
             <td align="center" style="border-bottom:1px dotted black;"><strong><?php echo $updatestock;?></strong></td>
        <td align="right" style="border-bottom:1px dotted black;"><strong><?php echo $qty;?></strong></td>
      </tr>
      <?php }?>
      <tr style="font-size: 15px;">
        <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
        <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
        <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
        <td align="center" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
        <td align="center" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
        <td align="center" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
        <td align="center" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
        <td align="center" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
        <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>TOTAL QTY</strong></td>
        <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo @$p;?></strong></td>
      </tr>
    </table>
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script type="text/javascript">
      $(document).ready(function(){
        window.print();
      });
    </script>