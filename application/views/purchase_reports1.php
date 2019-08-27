<?php

        $profilesgetdata=$this->db->where('status',1)->get('profile')->result_array();
        foreach ($profilesgetdata as $key => $profilesgetdatas) {
            $title=$profilesgetdatas['companyname'];
            // $logo=$profilesgetdatas['logo'];
            $address1=$profilesgetdatas['address1'];
            $address2=$profilesgetdatas['address2'];
            $emailid=$profilesgetdatas['emailid'];
            $phoneno=$profilesgetdatas['phoneno'];
            $tinno=$profilesgetdatas['tinno'];
            $cstno=$profilesgetdatas['cstno'];
        }

    ?>


    <title><?php echo $title;?></title>


    <table width="1000" border="0" align="center" style="border-collapse:collapse; font-family:Calibri ;font-size:18px;">
 <tr >
      <td class="heading1" width="316"><div align="center"><strong><?php echo $title;?></strong></div></td>
      <tr align="center">
        <td class="padding" style="font-size:13px;" width="134"><b><?php echo $address1;?><br><?php echo $address2;?>
          <br>Mobile No :&nbsp;<?php echo $phoneno;?>,&nbsp; Email:&nbsp;<?php echo $emailid;?></b><br><b>TIN No :&nbsp;<?php echo $tinno;?>,CST No:&nbsp;<?php echo $cstno;?></b></td>
        </tr>
      </tr>

</table>

<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif;">
  <tr style="font-size: 16px;">
    <td height="35" width="334" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Purchase Pending Reports </strong></td>
   
    <td height="35" width="334" align="right" style="border-bottom:1px solid black;"><strong>From Date :<?php  echo date('d-m-Y',strtotime($this->input->post('fromdate')));?></strong>     </td>
    <td height="35" width="318" align="center" style="border-bottom:1px solid black;"><strong>To Date :<?php  echo date('d-m-Y',strtotime($this->input->post('todate')));?></strong></td>
  </tr>
</table>

<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    
    <td width="80" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
    <td width="93" align="left" style="border-bottom:1px solid black;"><strong>Purchase No</strong></td>
 
     <td width="160" align="left" style="border-bottom:1px solid black;"><strong>Supplier Name</strong></td>
     <td width="90" align="right" style="border-bottom:1px solid black;"><strong>Purchase Amt</strong></td>
       <td width="90" align="right" style="border-bottom:1px solid black;"><strong>Paid</strong></td>
     
    <td width="100" align="right" style="border-bottom:1px solid black;"><strong>Balance Amt</strong></td>

    
  </tr>
  <?php
  $i=1; 
  foreach ($pending as $row) {



     $date=date('d-m-Y',strtotime($row['invoicedate']));
     $suppliername=$row['suppliername'];
    $invoiceno=$row['purchaseno'];
    // $grandtotal=$row['totalamount'];
    $paid=$row['paid'];
    $purchaseamt=$row['grandtotal'];
    $receipt=$row['paid'];
   
   

    $balance=$row['balance'];

   $purchases[]=$purchaseamt;
   $pur=array_sum($purchases);

   $receiptamts[]=$row['paid'];
   $rec=array_sum($receiptamts);


    $pay[]=$paid;
    $p=array_sum($pay);

       
    $unpaid=$pur-$rec;

  



  
   ?>
  <tr>

    <td align="left" style=""><?php echo $date;?></td>
    <td align="left" style=""><?php echo $invoiceno;?></td>
    <td align="left" style=""><?php echo ucfirst($suppliername);?></td>
        <td align="right" style=""><?php echo $purchaseamt;?></td>
        <td align="right" style=""><?php echo number_format($receipt,2);;?></td>

    

        <td align="right" style="padding:2px;"><?php echo number_format($balance,2);?></td>


     
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

    <td align="center" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong style="margin-left:700px;">Purchase Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format(@$pur,2);?></strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    
  </tr>

   <tr style="font-size: 15px;margin-left:851px;">
    <td style="border-bottom:1px solid black; border-top:1px solid black;" height="20">&nbsp;</td>
    <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
     <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>

    <td align="center" style="border-bottom:1px solid black;  border-top:1px solid black;margin-left:851px;"><strong style="margin-left:700px;">Paid Amount</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format(@$rec,2);?></strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    
  </tr>

   <tr style="font-size: 15px;">
    <td style="border-bottom:1px solid black; border-top:1px solid black;" height="20">&nbsp;</td>
    <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
     <td style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>

    <td align="center" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong style="margin-left:700px;">Balance Amount</strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong><?php echo number_format(@$unpaid,2);?></strong></td>
    <td align="right" style="border-bottom:1px solid black;  border-top:1px solid black;"><strong>&nbsp;</strong></td>
    
  </tr>
  
  </table>

  

    

        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

                                  // window.print();



                                });

</script>