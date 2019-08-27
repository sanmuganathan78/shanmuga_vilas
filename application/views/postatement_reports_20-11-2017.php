

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
    <td height="35" width="273" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Purchase Party Statement </strong></td>
    <td height="35" width="416" align="left" style="border-bottom:1px solid black;"><strong>Company Name:<?php echo $this->session->userdata('rcbio_suppliername');?></strong>     </td>
    <td height="35" width="149" align="left" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $this->session->userdata('rcbio_fromdate');?></strong>     </td>
    <td height="35" width="176" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $this->session->userdata('rcbio_todate');?></strong></td>
  </tr>
</table>

<table width="1066" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    
    <td width="95" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
    <td width="104" align="left" style="border-bottom:1px solid black;"><strong>Purchase No</strong></td>
    <td width="88"  align="left" style="border-bottom:1px solid black;"><strong>Receipt No</strong></td>
     <td width="155" align="left" style="border-bottom:1px solid black;"><strong>Company Name</strong></td>
     <td width="142" align="right" style="border-bottom:1px solid black;"><strong>Purchase Amt</strong></td>
    <td width="112" align="right" style="border-bottom:1px solid black;"><strong>Return Amt</strong></td>
       <td width="119" align="right" style="border-bottom:1px solid black;"><strong>Receipt Amt</strong></td>
    

     <td width="115" align="right" style="border-bottom:1px solid black;"><strong>Payment Details</strong></td>
    
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
    $suppliername=$row['suppliername'];
    $invoiceno=$row['purchaseno'];
    $receiptno=$row['receiptno'];
    // $grandtotal=$row['totalamount'];
    $paymentdetails=$row['paymentdetails'];
    $paid=$row['paid'];
    $purchaseamt=$row['purchaseamt'];
    $returnamount=$row['returnamount'];
    $receiptamt=$row['receiptamt'];
   
   $balance=$row['balance'];

   $purchases[]=$purchaseamt;
   $pur=array_sum($purchases);

   $returns[]=$returnamount;
   $ret=array_sum($returns);

   $receiptamts[]=$receiptamt;
   $rec=array_sum($receiptamts);


    $pay[]=$paid;
    $p=array_sum($pay);

       
    $unpaid=$pur-$rec;
	if($topSuppliername=='')
	{
		$openingbalance=$this->db->select('openingbal')->where('name',$row['suppliername'])->where("(type = 'Inter supplier' OR type = 'Intra supplier')")->get('customer_details')->row()->openingbal;

		if(!$openingbalance) { $openingbalance=0; }
		$balanceamount=$this->db->select('balanceamount')->where('name',$row['suppliername'])->where("(type = 'Inter supplier' OR type = 'Intra supplier')")->get('customer_details')->row()->balanceamount;
	}
   ?>
  <tr>

    <td align="left" style="border-bottom:1px dotted black;"><?php echo $date;?></td>
    <td align="left" style="border-bottom:1px dotted black;"><?php echo $invoiceno;?></td>
    <td align="left" style="border-bottom:1px dotted black;"><?php echo $receiptno;?></td>
    <td align="left" style="border-bottom:1px dotted black;"><?php echo ucfirst($suppliername);?></td>
        <td align="right" style="border-bottom:1px dotted black;"><?php echo $purchaseamt;?></td>
         <td align="right" style="border-bottom:1px dotted black;"><?php echo $returnamount;?></td>
    
    <td align="right" style="border-bottom:1px dotted black;"><?php echo $receiptamt;?></td>
        

    <td align="right" style="border-bottom:1px dotted black;"><?php echo ucfirst($paymentdetails);?></strong></td>
     
  </tr>
  <?php }?>

  <tr>
    <td align="left" style="border-top:1px solid black;">&nbsp;</td>
    <td align="left" style="border-top:1px solid black;">&nbsp;</td>
    <td align="left" style="border-top:1px solid black;">&nbsp;</td>
    <td align="left" style="border-top:1px solid black;">&nbsp;</td>
    <td align="right" style="border-top:1px solid black;">&nbsp;</td>
    <td align="right" style="border-top:1px solid black;">&nbsp;</td>
    <td align="right" style="border-top:1px solid black;">Opening Balance</td>
    <td align="right" style="border-top:1px solid black; padding:5px;"><strong><?php echo number_format($openingbalance,2);?></strong></td>
  </tr>
  <tr>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" > Invoice Amount</td>
    <td align="right" style="padding:5px;"><strong><?php echo number_format(@$pur,2);?></strong></td>
  </tr>
  <tr>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" > Return Amount</td>
    <td align="right" style=" padding:5px;"><strong><?php echo number_format(@$ret,2);?></strong></td>
  </tr>
  <tr>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >Receipt Amount</td>
    <td align="right" style=" padding:5px;"><strong><?php echo number_format(@$rec,2);?></strong></td>
  </tr>
  <tr>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="left" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >&nbsp;</td>
    <td align="right" >Balance Amount</td>
    <td align="right" style=" padding:5px;"><strong><?php echo number_format(@$balanceamount,2);?></td>
  </tr>
 

</table>

  

    

        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

                                  // window.print();



                                });

</script>