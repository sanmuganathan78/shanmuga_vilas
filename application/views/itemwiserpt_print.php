<style>
.bbr_dot{	border-bottom:1px dotted black;border-right:1px solid black; }
.bb_dot{	border-bottom:1px dotted black; }
.bbr_solid {	border-bottom:1px solid black;border-right:1px solid black; }
.bb_solid {	border-bottom:1px solid black; }
</style>
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
    <td height="35" width="180" align="left" style="border-bottom:1px solid black;text-transform:uppercase;"><strong>Itemwise Reports</strong></td>
	<td height="35" width="210" align="center" style="border-bottom:1px solid black;"><strong>Item No.:<?php echo $itemno; ?></strong></td>
    <td height="35" width="210" align="center" style="border-bottom:1px solid black;"><strong>Item Name :<?php echo $itemname; ?></strong></td>
  <td height="35" width="200" align="center" style="border-bottom:1px solid black;"><strong>From Date:<?php echo $fromdate;?></strong>     </td>
    <td height="35" width="200" align="left" style="border-bottom:1px solid black;"><strong>To Date:<?php echo $todate;?></strong></td>
  </tr>
</table>

<table width="75%" border="0" align="center" style="border-collapse:collapse; font-family: Arial, Helvetica, sans-serif; font-size: 15px;">
  <tr>
    <td width="51" height="29" align="left" class="bb_solid" rowspan="2"><strong>S.No</strong></td>
    <td width="120" align="left" class="bb_solid"  rowspan="2"><strong>Date</strong></td>
    <td width="240" align="left" class="bb_solid" rowspan="2"><strong>Particulars</strong></td>
     <td width="200" align="left" class="bb_solid" rowspan="2"><strong>VCH Type</strong></td>
     <td width="110" align="left" class="bbr_solid" rowspan="2"><strong>VCH No.</strong></td>
     <td width="110" align="right" class="bbr_solid" colspan="2"><strong>Inward</strong></td>
     <td width="110" align="right" class="bbr_solid" colspan="2"><strong>Outward</strong></td>
     <td width="110" align="right" style="border-bottom:1px solid black;"  colspan="2"><strong>Closing</strong></td>
  </tr>
 <tr>
	<td align="right" class="bbr_solid">Qty</td>
	<td align="right" class="bbr_solid">Price</td>
	<td align="right" class="bbr_solid">Qty</td>
	<td align="right" class="bbr_solid">Price</td>
	<td align="right" class="bbr_solid">Qty</td>
	<td align="right" class="bb_solid">Price</td>
 </tr>
 <?php
 $openQuery = "SELECT * FROM stock_reports WHERE stat='FromAddStock' AND purchaseid IS NULL ";
 $purchaseQuery = "SELECT * FROM purchase_reports WHERE 1=1 ";
 $salesQuery = "SELECT * FROM invoice_reports WHERE 1=1 ";
 $cdQuery = "SELECT * FROM sales_return WHERE 1=1 ";
 if($fromdate!="")
 {
	 $openQuery .=" AND date >= '".date('Y-m-d',strtotime($fromdate))."' ";
	 $purchaseQuery .= " AND purchasedate >= '".date('Y-m-d',strtotime($fromdate))."' ";
	 $salesQuery .= " AND invoicedate >= '".date('Y-m-d',strtotime($fromdate))."' ";
	 $cdQuery .= " AND returndate >= '".date('Y-m-d',strtotime($fromdate))."' ";
 }
 if($todate!="")
 {
	 $openQuery .=" AND date <= '".date('Y-m-d',strtotime($todate))."' ";
	 $purchaseQuery .=" AND purchasedate <= '".date('Y-m-d',strtotime($todate))."' ";
	 $salesQuery .=" AND invoicedate <= '".date('Y-m-d',strtotime($todate))."' ";
	 $cdQuery .=" AND returndate <= '".date('Y-m-d',strtotime($todate))."' ";
 }
 if($itemno!="")
 {
	 $openQuery .=" AND hsnno = '".$itemno."' ";
	 $purchaseQuery .=" AND hsnno LIKE '%".$itemno."%' ";
	 $salesQuery .=" AND hsnno LIKE '%".$itemno."%' ";
	 $cdQuery .=" AND hsnno LIKE '%".$itemno."%' ";
 }
 if($itemname!="")
 {
	 $openQuery .=" AND itemname = '".$itemname."' ";
	 $purchaseQuery .=" AND itemname LIKE '%".$itemname."%' ";
	 $salesQuery .=" AND itemname LIKE '%".$itemname."%' ";
	 $cdQuery .=" AND itemname LIKE '%".$itemname."%' ";
 }
 
 $i=0;
 $closingQty = 0;
 $closingPrice = 0;
 $totalInward = 0;
 $totalOutward = 0;
 //$rootArray =array();
 //OPENING STOCK QUERY
 $openQueryExe = $this->db->query($openQuery);
 if($openQueryExe->num_rows() > 0 )
 {
	 $openQueryRes=$openQueryExe->result();
	 foreach($openQueryRes as $openRes)
	 {
		 $qty =$openRes->updatestock;
		 $getPrice = $this->db->query("SELECT price FROM additem WHERE hsnno='".$openRes->hsnno."' AND itemname='".$openRes->itemname."' ");
		 if($getPrice->num_rows() > 0 )
		 {
			 $priceRes = $getPrice->row();
			 $price = $priceRes->price;
		 }
		 else
		 {
			 $price = 0;
		 }
		 //$rootArray[]=array('date'=>date('d-m-Y',strtotime($openRes->date)),'particulars'=>'Opening Balance','vchtype'=>'&nbsp;','vchnum'=>'&nbsp;','inwQty'=>$qty,'inwPrice'=>$price,'outwQty'=>'0','outwPrice'=>'0');
		 $netAmt = $qty*$price;
		 $closingQty +=$qty;
		 $totalInward +=$qty;
		 $closingPrice +=$netAmt;
		 echo '
		  <tr>
			<td class="bb_dot">'.++$i.'</td>
			<td class="bb_dot">'.date('d-m-Y',strtotime($openRes->date)).'</td>
			<td class="bb_dot">Opening Balance</td>
			<td class="bb_dot">&nbsp;</td>
			<td class="bbr_dot" >&nbsp;</td>
			<td align="right" class="bbr_dot">'.$qty.'</td>
			<td align="right" class="bbr_dot">'.number_format($netAmt,2).'</td>
			<td align="right" class="bbr_dot">0</td>
			<td align="right" class="bbr_dot">0</td>
			<td align="right" class="bbr_dot">'.$closingQty.'</td>
			<td align="right" class="bb_dot">'.number_format($closingPrice,2).'</td>
		 </tr>
		 ';
	 }
	 
 }
 
 //PURCHASE QUERY
 $purchaseExe = $this->db->query($purchaseQuery);
 if($purchaseExe->num_rows() > 0)
 {
	  $disQty=0;
	  $disNetAmt=0;
	 $purchaseRes=$purchaseExe->result();
	 foreach($purchaseRes as $purRes)
	 {
		 $gotItemName = explode("||",$purRes->itemname);
		 $gotQty = explode("||",$purRes->qty);
		 $gotRate = explode("||",$purRes->rate);
		 for($i=0;$i<count($gotItemName);$i++)
		 {
			 if($gotItemName[$i]==$itemname)
			 {
				 $qty =$gotQty[$i];
				 $price = $gotRate[$i];
				 $netAmt = $qty*$price;
				 $closingQty +=$qty;
				 $closingPrice +=$netAmt;
				 $totalInward +=$qty;
				 $disQty +=$qty;
				 $disNetAmt +=$netAmt;
			 }
		 }
		/* $key = array_search($itemname, $gotItemName);
		 $qty =$gotQty[$key];
		 $price = $gotRate[$key];
		 $netAmt = $qty*$price;
		 $closingQty +=$qty;
		 $closingPrice +=$netAmt;
		 $totalInward +=$qty;*/
		
		 echo '
		  <tr>
			<td class="bb_dot">'.++$i.'</td>
			<td class="bb_dot">'.date('d-m-Y',strtotime($purRes->purchasedate)).'</td>
			<td class="bb_dot">'.$purRes->suppliername.'</td>
			<td class="bb_dot">Purchase</td>
			<td class="bbr_dot" >'.$purRes->purchaseno.'</td>
			<td align="right" class="bbr_dot">'.$disQty.'</td>
			<td align="right" class="bbr_dot">'.number_format($disNetAmt,2).'</td>
			<td align="right" class="bbr_dot">0</td>
			<td align="right" class="bbr_dot">0</td>
			<td align="right" class="bbr_dot">'.$closingQty.'</td>
			<td align="right" class="bb_dot">'.number_format($closingPrice,2).'</td>
		 </tr>
		 ';
	 }
 }
//SALES QUERY
 $salesExe = $this->db->query($salesQuery);
 if($salesExe->num_rows() > 0)
 {
	 $insQty = 0;
	 $insNetAmt = 0;
	 $salesRes=$salesExe->result();
	 foreach($salesRes as $salRes)
	 {
		 $gotItemName = explode("||",$salRes->itemname);
		 $gotQty = explode("||",$salRes->qty);
		 $gotRate = explode("||",$salRes->rate);
		 for($i=0;$i<count($gotItemName);$i++)
		 {
			 if($gotItemName[$i]==$itemname)
			 {
				 $qty =$gotQty[$i];
				 $price = $gotRate[$i];
				 $netAmt = $qty*$price;
				 $closingQty -=$qty;
				 $closingPrice -=$netAmt;
				 $totalOutward +=$qty;
				 $insQty +=$qty;
				 $insNetAmt +=$netAmt;
			 }
		 }
		 
		 
		 //$rootArray[]=array('date'=>date('d-m-Y',strtotime($salRes->invoicedate)),'particulars'=>$salRes->customername,'vchtype'=>'Sales','vchnum'=>$salRes->invoiceno,'inwQty'=>'0','inwPrice'=>'0','outwQty'=>$qty,'outwPrice'=>$price);
		 echo '
		  <tr>
			<td class="bb_dot">'.++$i.'</td>
			<td class="bb_dot">'.date('d-m-Y',strtotime($salRes->invoicedate)).'</td>
			<td class="bb_dot">'.$salRes->customername.'</td>
			<td class="bb_dot">Sales</td>
			<td class="bbr_dot" >'.$salRes->invoiceno.'</td>
			<td align="right" class="bbr_dot">0</td>
			<td align="right" class="bbr_dot">0</td>
			<td align="right" class="bbr_dot">'.$insQty.'</td>
			<td align="right" class="bbr_dot">'.number_format($insNetAmt,2).'</td>
			<td align="right" class="bbr_dot">'.$closingQty.'</td>
			<td align="right" class="bb_dot">'.number_format($closingPrice,2).'</td>
		 </tr>
		 ';
	 }
 }
 
 //PURCHASE OR SALES RETURN.
  $cdExe = $this->db->query($cdQuery);
 if($cdExe->num_rows() > 0)
 {
	 $disQty2 = 0; $disQty1 = 0;
	 $disNetAmt2=0; $disNetAmt1=0;
	 $cdRes=$cdExe->result();
	 foreach($cdRes as $cdr)
	 {
		 $gotItemName = explode("||",$cdr->itemname);
		 $gotQty = explode("||",$cdr->qty);
		 $gotRate = explode("||",$cdr->rate);
		 $key = array_search($itemname, $gotItemName);
		 $qty1=0;
		 $netAmt1=0;
		 $qty2=0;
		 $netAmt2=0;
		 $price1=0;
		 $price2=0;
		 if($cdr->types=="Debit")
		 {
			 //SALES RETURN
			 for($i=0;$i<count($gotItemName);$i++)
			 {
				 if($gotItemName[$i]==$itemname)
				 {
					 $qty2 =$gotQty[$i];
					 $price2 = $gotRate[$i];
					 $netAmt2 = $qty2*$price2;
					 $closingQty +=$qty2;
					 $closingPrice +=$netAmt2;
					 $particulars = $cdr->customername;
					 $vchType='Sales Return';
					 $vcNum = ' ( '.$cdr->invoiceno.' )';
					 $totalInward +=$qty2;
					 $disQty2 +=$qty2;
					 $disNetAmt2 +=$netAmt2;
				 }
			 }
			 
		 }
		 else
		 {
			 for($i=0;$i<count($gotItemName);$i++)
			 {
				 if($gotItemName[$i]==$itemname)
				 {
					 $qty1 =$gotQty[$i];
					 $price1 = $gotRate[$i];
					 $netAmt1 = $qty1*$price1;
					 $closingQty -=$qty1;
					 $closingPrice -=$netAmt1;
					 $particulars = $cdr->suppliername;
					 $vchType='Purchase Return';
					 $vcNum = ' ( '.$cdr->purchaseno.' )';
					 $totalOutward +=$qty1;
					 $disQty1 +=$qty1;
					 $disNetAmt1 +=$netAmt1;
				 }
			 }
					 
		 }
		// $rootArray[]=array('date'=>date('d-m-Y',strtotime($cdr->returndate)),'particulars'=>$particulars,'vchtype'=>$vchType,'vchnum'=>$cdr->returnno.$vcNum,'inwQty'=>$qty2,'inwPrice'=>$price2,'outwQty'=>$qty1,'outwPrice'=>$price1);
		 echo '
		  <tr>
			<td class="bb_dot">'.++$i.'</td>
			<td class="bb_dot">'.date('d-m-Y',strtotime($cdr->returndate)).'</td>
			<td class="bb_dot">'.$particulars.'</td>
			<td class="bb_dot">'.$vchType.'</td>
			<td class="bbr_dot" >'.$cdr->returnno.$vcNum.'</td>
			<td align="right" class="bbr_dot">'.$disQty2.'</td>
			<td align="right" class="bbr_dot">'.number_format($disNetAmt2,2).'</td>
			<td align="right" class="bbr_dot">'.$disQty1.'</td>
			<td align="right" class="bbr_dot">'.number_format($disNetAmt1,2).'</td>
			<td align="right" class="bbr_dot">'.$closingQty.'</td>
			<td align="right" class="bb_dot">'.number_format($closingPrice,2).'</td>
		 </tr>
		 ';
	 }
 }
 
 echo '
		  <tr style="font-size: 16px;font-weight: bold;">
			<td colspan="5" align="right" style="border-top:1px solid #000;border-bottom:1px solid #ccc;">TOTAL QTY</td>
			<td align="right" style="border-top:1px solid #000;border-bottom:1px solid #ccc">'.$totalInward.'</td>
			<td align="right" style="border-top:1px solid #000;border-bottom:1px solid #ccc">&nbsp;</td>
			<td align="right" style="border-top:1px solid #000;border-bottom:1px solid #ccc">'.$totalOutward.'</td>
			<td align="right" style="border-top:1px solid #000;border-bottom:1px solid #ccc">&nbsp;</td>
			<td align="right" style="border-top:1px solid #000;border-bottom:1px solid #ccc">'.$closingQty.'</td>
			<td align="right" style="border-top:1px solid #000;border-bottom:1px solid #ccc">&nbsp;</td>
		 </tr>
		 ';
		 
	/*	 print_r($rootArray);
		 function sort_by_date($a, $b) {
		$a = strtotime($a['date']);
		$b = strtotime($b['date']);
		return ($a < $b) ? -1 : 1;
		}
		uasort($rootArray, 'sort_by_date');
		echo '<hr>';
		print_r($rootArray);*/
		 
 ?>


</table>


        <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	window.print();
});

</script>