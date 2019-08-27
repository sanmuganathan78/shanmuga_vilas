
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

<title><?php echo $title;?></title>

<table width="1066" border="0" align="center" style="border-collapse:collapse; font-family:Calibri ;font-size:18px;">
<tr >
<td class="heading1" width="1060"><div align="center"><strong><?php echo $title;?></strong></div></td>
<tr align="center">
<td class="padding" style="font-size:13px;" width="1060"><b><?php echo $address1;?><br><?php echo $address2;?>
<br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>GSTIN :&nbsp;<?php echo $gstin;?></b></td>
</tr>
</tr>

</table>


<table width="1066" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
<tr style="font-size: 16px;">
<td height="35" width="273" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Inward Report </strong></td>
<td height="35" width="416" align="left" style="border-bottom:1px solid black;"><strong>Company Name:<?php echo $this->session->userdata('rcbio_suppliername');?></strong>     </td>
<td height="35" width="149" align="left" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $this->session->userdata('rcbio_fromdate');?></strong>     </td>
<td height="35" width="176" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $this->session->userdata('rcbio_todate');?></strong></td>
</tr>
</table>

<table width="1066" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
<tr>

<td width="95" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
<td width="104" align="left" style="border-bottom:1px solid black;"><strong>Invoice No</strong></td>

<td width="155" align="left" style="border-bottom:1px solid black;"><strong>Company Name</strong></td>
<td width="142" align="right" style="border-bottom:1px solid black;"><strong>Customer DC No Amt</strong></td>
<td width="112" align="right" style="border-bottom:1px solid black;"><strong>Customer DC Date</strong></td>


</tr>
<?php
@$suppliername=$this->session->userdata('rcbio_suppliername');
$topSuppliername = $suppliername;
if($suppliername)
{

$openingbalance=$this->db->select('openingbal')->where('name',$suppliername)->where("(type = 'Inter supplier' OR type = 'Intra supplier')")->get('customer_details')->row()->openingbal;
//echo $openingbalance;
//exit;
if(!$openingbalance) { $openingbalance=0; }
$balanceamount=$this->db->select('balanceamount')->where('name',$suppliername)->where("(type = 'Inter supplier' OR type = 'Intra supplier')")->get('customer_details')->row()->balanceamount;

?>


<?php
}
$i=1; 
foreach ($purchase as $row) {



$date=date('d-m-Y',strtotime($row['date']));
$customername=$row['cusname'];
$inwardno=$row['inwardno'];
$customerdcno=$row['customerdcno'];
$customerdcdate=date('d-m-Y',strtotime($row['customerdcdate']));
// $grandtotal=$row['totalamount'];
//$paymentdetails=$row['paymentdetails'];
//$paid=$row['paid'];

?>
<tr>

<td align="left" style="border-bottom:1px dotted black;"><?php echo $date;?></td>
<td align="left" style="border-bottom:1px dotted black;"><?php echo $inwardno;?></td>

<td align="left" style="border-bottom:1px dotted black;"><?php echo ucfirst($customername);?></td>



<td align="right" style="border-bottom:1px dotted black;"><?php echo $customerdcno;?></td> 


<td align="right" style="border-bottom:1px dotted black;"><?php echo ucfirst($customerdcdate);?></strong></td> 

</tr>
<?php }?>




</table>





<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){

// window.print();



});

</script>