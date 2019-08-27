<?php foreach($pre as $bil) 
$data=$this->db->get('profile')->result();
$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)
  foreach ($data as $profile)
  //   $taxamount= $bil->taxamount;
  // if($taxamount=="")
  // {
  //   $taxamount=0.00;
  // }
  // $charges=$bil->charges;
  // if($charges=="")
  // {
  //   $charges=0.00;
  // }
  // $charges1=$bil->charges1;
  // if($charges1=="")
  // {
  //   $charges1=0.00;
  // }
  // $adjustment=$bil->adjustment;
  // if($adjustment=="")
  // {
  //   $adjustment=0.00;
  // }
  ?>
  <table width="750" border="0" style="" align="center">
    <tr>
      <td width="250" align="center" style="font-size:20px;font-weight:bold;"></td>
      <td width="250" align="center" style="font-size:20px;font-weight:bold;">INVOICE</td>
      <td width="250" align="center" style="font-size:15px;font-weight:bold;">Original / Duplicate / Triplicate</td>
    </tr>
  </table>
  <table width="750" border="0" style="border:1px solid black;border-collapse: collapse;" align="center">
    <tr>
      <td width="200" ><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="200" height="80" alt="logo" /></td>
      <td width="590" align="right" valign="top" style="font-size:14px;">
        <strong style="font-size: 24px;"><?php echo $profile->companyname;?></strong>
        <br><?php echo $profile->address1;?>
        <br><?php echo $profile->address2;?>, <?php echo $profile->city;?> - <?php echo $profile->pincode;?>
        <br><b>GSTIN: <?php echo $profile->gstin;?><!--  | CST No : --> <!-- <?php echo $profile->cstno;?> --> </b>
		<br>Phone : <?php echo $profile->phoneno;?>,&nbsp;Mobile : <?php echo $profile->mobileno;?><br>Email id : <?php echo $profile->emailid;?>, Website : <?php echo $profile->website;?> </td>
        <td width="10"></td>
    </tr>
</table>
<!--   <table width="700" border="0" style="border-bottom:1px solid black;border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="2">
    <tr>
      <td align="center" style="font-size:17px;font-weight:bold; text-transform:uppercase;"><?php echo $bil->paymenttype;?>&nbsp; BILL</td>
    </tr>
  </table> -->

  <?php 
  $getcusname=$this->db->where('name',$bil->customername)->where('id',$bil->customerId)->get('customer_details')->result();

  foreach($getcusname as $cus)
  {


    $addresss1=$cus->address1;
    $addresss2=$cus->address2;
    $citys=$cus->city;
    $states=$cus->state;
    $gstnos=$cus->gstno;
    $mobileno=$cus->phoneno;
    $pincode=$cus->pincode;
    $statecode=$cus->statecode;
  }

  ?>
<table width="750" border="0" style="border-left:1px solid black;border-collapse: collapse;border-right:1px solid black;" align="center" cellpadding="1">
    <tr>
      <td width="700" style="font-size:14px;border-right:1px solid black;"><b>&nbsp;To: <?php echo $bil->customername;?></b></td>
      <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Invoice No</td>
      <td width="150" style="font-size:14px;" >&nbsp;&nbsp;&nbsp;Order No</td>
    </tr>
    <tr>
        <td width="700" rowspan="4" valign="top" style="font-size:14px;border-right:1px solid black;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$addresss1;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo @$addresss2;?>, <?php echo @$citys;?>, <?php echo @$states;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pin Code : <?php echo @$pincode;?><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mobile No : <?php echo @$mobileno;?></td>
        <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php echo $bil->invoiceno;?></b></td>
        <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php echo $bil->orderno;?></b></td>
    </tr>
      <tr>
        <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Invoice Date</td>
        <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Delivery At</td>
      </tr>
      <tr>
        <td style="font-size:14px;border-right:1px solid black;" ><b>
          &nbsp;&nbsp;&nbsp;
          <?php {$a=$bil->invoicedate; $d=date('d/m/Y',strtotime($a)); echo $d;};?>
        </b></td>
        <td style="font-size:14px;border-right:1px solid black;" ><b>&nbsp;&nbsp;&nbsp;<?php echo $bil->deliveryat;?></b></td>
      </tr>
      <tr>
        <td style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Transport Mode</td>
        <td style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;Vehicle Number</td>
      </tr>
      <tr>
        <td width="700" style="font-size:14px;border-right:1px solid black;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;GSTIN:<?php echo @$gstnos;?><span style="float:right">State Code : <?php echo @$statecode;?></span></b></td>
        <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php echo $bil->transportmode;?></b></td>
        <td width="150" style="font-size:14px;border-right:1px solid black;" >&nbsp;&nbsp;&nbsp;<b><?php echo $bil->vehicleno;?></b></td>
      </tr>
</table>
    
    <?php
       $discountss=explode('||',$bil->discount);
        $diccount=array_sum($discountss);
        $itemwidth=208;
         if($diccount <= 0)
        {
            $itemwidth=95+$itemwidth;
        }
         if($bil->gsttype=='intrastate')
        {
          $itemwidth=94+$itemwidth;
        }
         if($bil->gsttype=='interstate')
        {
          $itemwidth=91+$itemwidth;
        }


    ?>


    <table width="750"   height="470" align="center"  style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
      <tr style="font-size: 13px;">   
        <td width="35" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" ><b>S.No</b></td>
        <td width="<?php echo $itemwidth;?>" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Item Description</b></td>
        <td width="38" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>UOM</strong></td>
         <td width="29" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Qty</b></td>
        <td width="42" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Rate</b></td>
        <td width="66" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Amount</b></td>
        <?php
       
        if($diccount >0)
        {
        ?>
        <td width="40" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Disc</strong></td>
       
        <td width="55" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><strong>Taxable Value</strong></td>
         <?php } ?>
        <?php 
        if($bil->gsttype=='intrastate')
        {
          ?>
        <td width="47" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>CGST</b></td>
        <td width="47" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>SGST</b></td>
        <?php
         }
          if($bil->gsttype=='interstate')
        {
         ?>
        <td width="43" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>&nbsp;IGST</b></td>
        <?php } ?>
        <td width="48" style="border-right:1px solid black;border-bottom:1px solid black;padding:5px;" align="center"><b>Total</b></td>
      </tr>          
      <?php foreach ($pre  as  $vob)
      {

        // echo"<pre>";
        // print_r($vob);

        $itemname=explode('||',$vob->itemname);
        $rate=explode('||',$vob->rate);
        $qty=explode('||',$vob->qty);
        // $amount=explode('||',$vob->total);
        $total=explode('||',$vob->total);
        $amount=explode('||',$vob->amount);
        $uom=explode('||',$vob->uom);
        $discounts=explode('||',$vob->discount);
        $disamounts=explode('||',$vob->discountamount);
        $taxableamt=explode('||',$vob->taxableamount);
        $hsnno=explode('||',$vob->hsnno);
        $sgsts=explode('||',$vob->sgst);
        $igsts=explode('||',$vob->igst);
        $cgsts=explode('||',$vob->cgst);
        $sgstamts=explode('||',$vob->sgstamount);
        $igstamts=explode('||',$vob->igstamount);
        $cgstamts=explode('||',$vob->cgstamount);
        $overalltotal=explode('||',$vob->total);
        $dcnos=explode('||',$vob->dcnos);
    
        $count=count($itemname);
        for($i=0; $i< $count; $i++){
          $j=$i+1;

          if($discounts[$i]==0 || $discounts[$i]=='')
          {
            $discount=0;
          }
          else
          {
            $discount=$discounts[$i];
          }

          if($disamounts[$i]==0 || $disamounts[$i]=='')
          {
            $disamount=0;
          }
          else
          {
            $disamount=$disamounts[$i];
          }

          if($sgsts[$i]==0 || $sgsts[$i]=='')
          {
            $sgst=0;
          }
          else
          {
            $sgst=$sgsts[$i];
          }

          if($igsts[$i]==0 || $igsts[$i]=='')
          {
            $igst=0;
          }
          else
          {
            $igst=$igsts[$i];
          }

          if($cgsts[$i]==0 || $cgsts[$i]=='')
          {
            $cgst=0;
          }
          else
          {
            $cgst=$cgsts[$i];
          }

          if($sgstamts[$i]==0 || $sgstamts[$i]=='')
          {
            $sgstamt=0;
          }
          else
          {
            $sgstamt=$sgstamts[$i];
          }

          if($igstamts[$i]==0 || $igstamts[$i]=='')
          {
            $igstamt=0;
          }
          else
          {
            $igstamt=$igstamts[$i];
          }

          if($cgstamts[$i]==0 || $cgstamts[$i]=='')
          {
            $cgstamt=0;
          }
          else
          {
            $cgstamt=$cgstamts[$i];
          }

          if(@$dcnos[$i]=='')
          {
            $dc_details='';
          }
          else
          {
              @$dcdates=$this->db->select('dcdate')->where('dcno',$dcnos[$i])->get('dcbill_details')->row()->dcdate;
              @$dc_details='&nbsp;&nbsp;<span align="center" style="font-size:9px;">Dcno: '.$dcnos[$i].' Dt: '.date('d-m-y',strtotime($dcdates)).'</span>';

          }




          $dis[]=$disamount;
          $over[]=$overalltotal[$i];
          $taxam[]=$taxableamt[$i];
          $qtyh[]=$qty[$i];
          $totalh[]=$total[$i];
          $sgsth[]=$sgstamt;
          $igsth[]=$igstamt;
          $cgsth[]=$cgstamt;
          $totamt[]=$amount[$i];
		  $bottomTot =array_sum($totamt);	
		  $grandTotCgsth = array_sum($cgsth);
		  $grandTotSgsth = array_sum($sgsth);
		  $grandTotIgsth = array_sum($igsth);




          ?>
          <tr style="height:1px;">
            <td  align="center" style="border-right: 1px solid black;padding:3px;font-size:12px;"><strong><?php echo $j;?></strong></td>


            <td align="left" style="border-right: 1px solid black;padding:3px;font-size:14px;"><strong><?php echo $itemname[$i];?><br>
            <span align="center" style="font-size:12px;">(HSN/SAC :&nbsp;<?php echo $hsnno[$i];?>)</span><?php echo $dc_details;?></strong></td>
             <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;">&nbsp;<b><?php echo$uom[$i];?></b></td><td align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong><?php echo $qty[$i];?></strong></td>
             <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format($rate[$i],2);?></strong></td>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format($amount[$i],2);?></strong></td>
            <?php
            if($diccount >0)
            {
            ?>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">&nbsp;<strong><?php echo number_format($disamount,2);?><br>
              <span style="font-size:13px;"><?php echo number_format($discount,2);?>%</span></strong></td>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">&nbsp;<strong><?php echo number_format($taxableamt[$i],2);?></strong></td>
             <?php 
           }
          if($bil->gsttype=='intrastate')
          {
          ?>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format($cgstamt,2);?>
            <br>
            <span style="font-size:13px;">@<?php echo number_format($cgst,2);?>%</span></strong></td>
              <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format($sgstamt,2);?><br>
              <span style="font-size:13px;">@<?php echo number_format($sgst,2);?>%</span></strong></td>
              <?php
                 }
                  if($bil->gsttype=='interstate')
                {
                 ?>
               <td align="right" style="border-right:1px solid black;padding:3px;font-size:12px;"><strong><?php echo number_format($igstamt,2);?><br>
              <span style="font-size:13px;">@<?php echo number_format($igst,2);?>%</span></strong></td>
         
              <?php } ?>

              <td align="right" style="border-right: 1px solid black;padding:3px;font-size:12px;"><strong><?php echo number_format($overalltotal[$i],2);?></strong></td>                 
      </tr>
            <?php } }?>      
            <tr >
              <td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
               <?php
            if($diccount >0)
            {
            ?>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
               <?php 
             }
              if($bil->gsttype=='intrastate')
              {
              ?>       
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
              <?php }
              if($bil->gsttype=='interstate')
              {
                ?>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;"></td>
              <?php } ?>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            </tr>

            <tr >
              <td  style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="center" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
               <?php
            if($diccount >0)
            {
            ?>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
               <?php 
             }
              if($bil->gsttype=='intrastate')
              {
              ?>       
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
              <?php }
              if($bil->gsttype=='interstate')
              {
                ?>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;"></td>
              <?php } ?>
              <td align="right" style="border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
            </tr>

<?php 
if($vob->freightamount)
{
	$bottomTot +=$vob->freightamount;
  ?>

            <tr style="height:1px;">
            <td  align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong>&nbsp;</strong></td>
            <td align="right" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong>Freight Charges</strong></td>
             <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;">&nbsp;</td>
             <td align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong>&nbsp;</strong></td>
             <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong>&nbsp;</strong></td>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->freightamount,2);?></strong></td>
            <?php
            if($diccount >0)
            {
            ?>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">&nbsp;</td>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;">&nbsp;</td>
             <?php 
           }
          if($bil->gsttype=='intrastate')
          {
			  $grandTotCgsth +=$vob->freightcgstamount;
			  $grandTotSgsth +=$vob->freightsgstamount;
          ?>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->freightcgstamount,2);?>
            <br>
            <span style="font-size:13px;">@<?php echo number_format(@$vob->freightcgst,2);?>%</span></strong></td>
              <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->freightsgstamount,2);?><br>
              <span style="font-size:13px;">@<?php echo number_format(@$vob->freightsgst,2);?>%</span></strong></td>
              <?php
                 }
                  if($bil->gsttype=='interstate')
                {
					$grandTotIgsth +=$vob->freightigstamount;
                 ?>
               <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->freightigstamount,2);?><br>
              <span style="font-size:13px;">@<?php echo number_format(@$vob->freightigst,2);?>%</span></strong></td>
         
              <?php } ?>

              <td align="right" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->freighttotal,2);?></strong></td>                 
      </tr>

      <?php } ?>

      <?php 
if($vob->loadingamount)
{
	$bottomTot +=$vob->loadingamount;
  ?>

            <tr style="height:1px;">
            <td  align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong>&nbsp;</strong></td>
            <td align="right" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong>Loading & Packing Charges</strong></td>
             <td align="center" style="border-right:1px solid black;padding:3px;font-size:13px;text-transform: capitalize;">&nbsp;</td>
             <td align="center" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong>&nbsp;</strong></td>
             <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong>&nbsp;</strong></td>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->loadingamount,2);?></strong></td>
            <?php
            if($diccount >0)
            {
            ?>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:11px;">&nbsp;</td>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:11px;">&nbsp;</td>
             <?php 
           }
          if($bil->gsttype=='intrastate')
          {
			  $grandTotCgsth +=$vob->loadingcgstamount;
			  $grandTotSgsth +=$vob->loadingsgstamount;
          ?>
            <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->loadingcgstamount,2);?>
            <br>
            <span style="font-size:13px;">@<?php echo number_format(@$vob->loadingcgst,2);?>%</span></strong></td>
              <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->loadingsgstamount,2);?><br>
              <span style="font-size:13px;">@<?php echo number_format(@$vob->loadingsgst,2);?>%</span></strong></td>
              <?php
                 }
                  if($bil->gsttype=='interstate')
                {
					$grandTotIgsth +=$vob->loadingigstamount;
                 ?>
               <td align="right" style="border-right:1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->loadingigstamount,2);?><br>
              <span style="font-size:13px;">@<?php echo number_format(@$vob->loadingigst,2);?>%</span></strong></td>
         
              <?php } ?>

              <td align="right" style="border-right: 1px solid black;padding:3px;font-size:13px;"><strong><?php echo number_format(@$vob->loadingtotal,2);?></strong></td>                 
      </tr>

      <?php } ?>
            

            <tfoot>
            <tr >
              <td valign="bottom"  style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td align="center" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>     
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td> 
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>Basic Amount</small></td>
               <?php
              if($diccount >0)
              {
            ?>
             <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>Discount</small></td>
            <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>Taxable Amount</small></td>  
             <?php 
              }
              if($bil->gsttype=='intrastate')
              {
              ?>      
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>CGST</small></td>     
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>SGST</small></td>  
               <?php }
              if($bil->gsttype=='interstate')
              {
                ?>   
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>IGST</small></td>
              <?php } ?>
              <td align="right" valign="bottom" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:13px;font-weight:bold;"><small>Total</small></td>
            </tr>
             <tr >
              <td  style="border-bottom:1px padding:5px;font-size:18px;font-weight:bold;">&nbsp;</td>
              <td colspan="4" align="right" style="border-bottom:1px solid black;padding:5px;font-size:18px;font-weight:bold;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Total&nbsp; </td>
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo  number_format($bottomTot,2); ?></td>
               <?php
              if($diccount >0)
              {
            ?>
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo   number_format(array_sum($dis),2); ?></td>
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo   number_format(array_sum($taxam),2); ?></td> 
                 <?php 
               }
              if($bil->gsttype=='intrastate')
              {
              ?>            
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo  number_format($grandTotCgsth,2); ?></td>     
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo  number_format($grandTotSgsth,2); ?></td>  
               <?php }
              if($bil->gsttype=='interstate')
              {
                ?>      
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;"><?php echo  number_format($grandTotIgsth,2); ?></td>
               <?php } ?>
              <td align="right" style="border-bottom:1px solid black;border-right:1px solid black;padding:5px;font-size:14px;font-weight:bold;">&nbsp;<?php echo  number_format($bil->subtotal,2); ?></td>
            </tr>
          </tfoot>
</table>
    <table width="750" border="0" align="center" style="border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">



      <tr>
            <td colspan="3" rowspan="2" valign="top" style="font-size:14px;font-weight:bold;"><span style="font-size:13px;">Rupees :<b style="font-size:13px;"><?php echo $fin;?> only</b></span></td>
            <td width="201" align="right" style=""><span style="font-size:16px;font-weight:bold;">Sub Total&nbsp;&nbsp;:</span></td>
            <td width="90" align="right" ">&nbsp;<b><?php echo number_format($bil->subtotal,2); ?></b></td>
      </tr>
          <tr>
            <td align="right" style=""><span style="font-size:16px;font-weight:bold;">Roundoff&nbsp;&nbsp;:</span></td>
            <td align="right" "><b><?php echo  number_format($bil->othercharges,2);?></b></td>
          </tr>
          <tr>
            <td width="114" style="font-size:14px;font-weight:bold;">&nbsp;Bank Details</td>
            <td width="195">&nbsp;</td>
            <td width="126" align="right" style="">&nbsp;</td>
            <td align="right" style=""><span style="font-size:16px;font-weight:bold;">Invoice Amount &nbsp;&nbsp;:</span></td>
            <td align="right" "><strong><?php echo number_format(round($bil->grandtotal),2);?></strong>&nbsp;</td>
          </tr>
          <tr>
            <td style="font-size:14px;"><span style="font-size:14px;">&nbsp;Bank Name&nbsp;&nbsp;&nbsp;:</span></td>
            <td><span style="font-size:14px;"><?php echo $profile->bankname;?></span></td>
            <td align="right" style=""><span style="font-size:14px;">&nbsp;Bank Branch&nbsp;:</span></td>
            <td align="left" style=""><span style="font-size:14px;"><?php echo $profile->bankbranch;?></span></td>
            <td align="right" ">&nbsp;</td>
          </tr>
          <tr>
            <td style="font-size:14px;"><span style="font-size:14px;">&nbsp;Account No&nbsp;&nbsp;&nbsp;:</span></td>
            <td><span style="font-size:14px;"><?php echo $profile->accountno;?></span></td>
            <td align="right" style=""><span style="font-size:14px;">&nbsp;IFSC Code&nbsp;&nbsp;&nbsp;&nbsp;:</span></td>
            <td align="left" style=""><span style="font-size:14px;"><?php echo $profile->ifsccode;?></span></td>
            <td align="right" ">&nbsp;</td>
          </tr>

</table>






        <table width="750" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;" cellspacing="5">  
          <tr>
            <td style="font-size:12px;padding:2px;"><p>Certified that the particulars given are true and correct the amount indicated represents the price actually charged and  there is no flow of additional consideration directly or indirectly from the buyer.</p>        
            </td>
          </tr>
</table>
<table width="750"  align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
          <tr>
            <td width="200" style="font-size:13px;border-right:1px solid black;"><b>&nbsp;&nbsp;TERMS AND CONDITIONS</b></td>
            <td width="150" style="font-size:13px;border-right:1px solid black;">&nbsp;</td>  
            <td width="170" style="font-size:13px;border-right:1px solid black;" align="center">For <b style="font-size:15px;"><?php echo $profile->companyname;?></b></td>
          </tr>
          <td width="260" height="95" valign="top" style="font-size:11px;border-right:1px solid black;">&nbsp;&nbsp;1.No Claim For breakage or Loss during transit.<br>&nbsp;&nbsp;2.All disputes subject to Coimbatore Jurisdiction only.<br>&nbsp;&nbsp;3.Our Responsibility Ceases after the goods have been<br>&nbsp;&nbsp;delivered to carriers.</td>
          <td width="90" style="font-size:13px;border-right:1px solid black;" valign="bottom" align="center"><b>Receiver's Signature</b></td>
          <td width="170" style="font-size:14px;border-right:1px solid black;" align="center" valign="bottom"><b>Authorised Signatory</b></td>
        </tr>    
      </table>
<script type="text/javascript" src="<?php echo base_url();?>vendor/jquery/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
        //window.print(); 
     </script>

     <style type="text/css">
       table tr td
       {
        padding: 3px;
       }
     </style>




