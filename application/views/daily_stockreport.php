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
    <td height="35" width="334" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Daily Stock Reports</strong></td>
    <td height="35" width="334" align="center" style="border-bottom:1px solid black;"><strong>Item Name:<?php echo $this->session->userdata('rcbio_itemname');?></strong>     </td>
  <td height="35" width="334" align="center" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $this->session->userdata('rcbio_fromdate');?></strong>     </td>
    <td height="35" width="318" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $this->session->userdata('rcbio_todate');?></strong></td>
  </tr>
</table>

<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    <td width="51" height="29" align="left" style="border-bottom:1px solid black;"><strong>S.No</strong></td>
    <td width="120" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
    <td width="240" align="left" style="border-bottom:1px solid black;"><strong>Item Code</strong></td>
     <td width="200" align="left" style="border-bottom:1px solid black;"><strong>Item Name</strong></td>
     <td width="110" align="right" style="border-bottom:1px solid black;"><strong>Qty</strong></td>
  
    
  </tr>
  <?php
  $i=1; 
  foreach ($purchase as $row) {


     $date=date('d-m-Y',strtotime($row['date']));
     $itemcode=$row['hsnno'];
    // $batchno=$row['batchno'];
    $itemname=$row['itemname'];
    $qty=$row['updatestock'];
   


    $qt[]=$qty;
    $p=array_sum($qt);

   

   ?>
  <tr>

    <td height="22" align="left" style="border-bottom:1px dotted black;"><strong><?php echo $i++;?></strong></td>
    <td align="left" style="border-bottom:1px dotted black;"><strong><?php echo $date;?></strong></td>
    <td align="left" style="border-bottom:1px dotted black;"><strong><?php echo $itemcode;?></strong></td>
    <td align="left" style="border-bottom:1px dotted black;"><strong><?php echo $itemname;?></strong></td>
    <td align="right" style="border-bottom:1px dotted black;"><strong><?php echo $qty;?></strong></td>
   
   
  </tr>
  <?php }?>
  <tr style="font-size: 15px;">
     <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
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