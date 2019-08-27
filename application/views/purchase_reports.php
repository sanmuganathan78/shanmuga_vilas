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
    <td height="35" width="334" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Invoice Reports </strong></td>
    <td height="35" width="334" align="right" style="border-bottom:1px solid black;"><strong>Supplier Name :<php echo $suppliername;?></strong>     </td>
    <td height="35" width="334" align="right" style="border-bottom:1px solid black;"><strong>From Date :<?php  echo date('d-m-Y',strtotime($this->input->post('fromdate')));?></strong>     </td>
    <td height="35" width="318" align="center" style="border-bottom:1px solid black;"><strong>To Date :<?php  echo date('d-m-Y',strtotime($this->input->post('todate')));?></strong></td>
  </tr>
</table>

<table width="1000" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    
    <td width="80" align="left" style="border-bottom:1px solid black;"><strong>Date</strong></td>
    <td width="93" align="left" style="border-bottom:1px solid black;"><strong>Invoice No</strong></td>
 
     <td width="160" align="left" style="border-bottom:1px solid black;"><strong>Party Name</strong></td>
     <td width="90" align="right" style="border-bottom:1px solid black;"><strong>Invoice Amt</strong></td>
       <td width="90" align="right" style="border-bottom:1px solid black;"><strong>Paid</strong></td>
     
    <td width="100" align="right" style="border-bottom:1px solid black;"><strong>Balance</strong></td>

    
  </tr>
  <?php
  $i=1; 
  foreach ($invoice as $row) {



     $date=date('d-m-Y',strtotime($row['invoicedate']));
     $suppliername=$row['customername'];
    $invoiceno=$row['invoiceno'];
    // $grandtotal=$row['totalamount'];
    $paid=$row['paid'];
    $purchaseamt=$row['grandtotal'];
    $receipt=$row['paid'];
   
   $balance=$row['balance'];

  



  
   ?>
  <tr>

    <td align="left" style=""><?php echo $date;?></td>
    <td align="left" style=""><?php echo $invoiceno;?></td>
    <td align="left" style=""><?php echo ucfirst($suppliername);?></td>
        <td align="right" style=""><?php echo $purchaseamt;?></td>
        <td align="right" style=""><?php echo $receipt;?></td>

    

        <td align="right" style=""><?php echo number_format($balance,2);?></td>


     
  </tr>
  <?php }?>
 

</table>

  

    

        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
  $(document).ready(function(){

                                  // window.print();



                                });

</script>