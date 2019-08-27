<?php foreach($pre as $bil) {

$data=$this->db->get('profile')->result();

$datas=$this->db->order_by('id','desc')->limit(1)->get('company_logo')->result();
foreach ($datas as $profileimage)

// echo  $profileimage->file_name;

    foreach($data as $profile)

  ?>
<table width="750" align="center" style="border-collapse:collapse;border-top:1px solid black;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
        <tr>
        <td scope="row" rowspan="5" width="3"></td>
          <td scope="row" rowspan="5"  width="62"><img src="<?php echo base_url();?>upload/<?php echo $profileimage->image;?>" width="300" height="100" alt="logo"></td>
          <td align="right"><b><?php echo $profile->companyname;?></b></td>
          <td width="1"></td>
        </tr>
        <tr>
          <td align="right"><?php echo $profile->address1;?>,<?php echo $profile->address2;?></td>
          <td width="1"></td>
        </tr>
        <tr>
          <td align="right"><b>Mob : </b><?php echo $profile->phoneno;?></td>
          <td width="1"></td>
        </tr>
         <tr>
          <td align="right"><?php echo $profile->website;?></td>
          <td width="1"></td>
        </tr>
        <tr>
          <td align="right"><?php echo $profile->emailid;?></td>
          <td width="1"></td>
        </tr>

      </table>
     
      <table width="750" align="center" style="border-collapse:collapse;border-right:1px solid black;border-left:1px solid black;">
        <tr>
        <td rowspan="6" width="10"></td>
          <td scope="row" width="219"><b style="font-size:16px;">To :</b></td>
          <td width="246"></td>
          <td colspan="3" rowspan="2" align="center"  style="font-size:18px;padding:3px;"><b>INVOICE</b></td>
         
        </tr>
        <tr>
          <td scope="row" width="219"><b><?php echo $bil->customername;?></b></td>
          <td width="246"></td>
         </tr>

        <tr>
          <td colspan="2" rowspan="2" valign="top" scope="row"><?php echo $bil->address;?></td>
          <td align="left">Invoice No</td>
          <td align="center">:</td>
          <td><b><?php echo $bil->invoiceno;?></b></td>
        </tr>
        <tr>
         <td width="105" align="left">Date</td>          
          <td width="6" align="center">:</td>
          <td width="136"><b><?php echo date('d-m-Y',strtotime($bil->invoicedate));?></b></td>
        </tr>



         <tr>
         <td width="219">Mob : <strong><?php echo $bil->mobileno;?></strong></td>
        <td width="246">TIN No :<strong><?php echo $bil->tinno;?></strong></td>
          <td align="right">&nbsp;</td>
          <td width="6" align="center">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>


      </table>
      <table width="750"   height="600" align="center" style="border-bottom:1px solid black;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
        <tr>
      


   
          <td width="42" height="30" align="center" style="border-right:1px solid black;border-bottom:1px solid black;" scope="row">S.No</td>
          <td width="115" style="border-right:1px solid black;border-bottom:1px solid black;" align="left">Particular</td>
          <td width="47" style="border-right:1px solid black;border-bottom:1px solid black;" align="center">Qty</td>
          <td width="77" style="border-right:1px solid black;border-bottom:1px solid black;" align="right">Rate</td>
          <td width="77" style="border-right:1px solid black;border-bottom:1px solid black;" align="right">Amount</td>
     
          <!-- <td width="96" style="border-right:1px solid black;border-bottom:1px solid black;" align="right">Total Amt</td> -->
        </tr>


          
     
      <?php foreach ($pre  as  $vob)
     {
      
      $itemno =explode('|',$vob->itemno);
    $itemname =explode('|',$vob->itemname);
    $rate =explode('|',$vob->rate);
    $qty =explode('|',$vob->qty);
    $total =explode('|',$vob->total);
     



        $count=count($itemname);
      for($i=0; $i< $count; $i++){
      $j=$i+1;
      ?>
       <tr>
      <td height="29" align="center" style="border-right: 1px solid black;"><strong><?php echo $j;?></strong></td>
      <td align="left" style="border-right: 1px solid black;"><strong><?php echo $itemname[$i];?></strong></td>
      <td align="center" style="border-right: 1px solid black;"><strong><?php echo $qty[$i];?></strong></td>     
      <td align="right" style="border-right:1px solid black;"><strong><?php echo number_format($rate[$i],2);?></strong></td>
      <td align="right" style="border-right:1px solid black;"><strong><?php echo $total[$i];?></strong></td>
      

    <!--   <td align="right" style="border-right:1px solid black;"><strong><?php echo $total[$i];?></strong></td> -->
      </tr>
      <?php } }?>

              <tr>
      <td height="22" style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>     
      <td align="center" style="border-right:1px solid black;"></td>
      <td align="right" style="border-right:1px solid black;">&nbsp;</td>
 <!--       <td align="right" style="border-right:1px solid black;"><b></b>&nbsp;&nbsp;</td>
 -->      </tr>

       <tr>
      <td height="21" style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>     
      <td align="center" style="border-right:1px solid black;"></td>
      <td align="right" style="border-right:1px solid black;">&nbsp;</td>

<!--       <td align="right" style="border-right:1px solid black;"><b></b>&nbsp;&nbsp;</td>
 -->      </tr>

       <tr>
      <td  style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>
      <td style="border-right: 1px solid black;">&nbsp;</td>     
      <td align="center" style="border-right:1px solid black;"></td>
      <td align="right" style="border-right:1px solid black;">&nbsp;</td>

<!--       <td align="right" style="border-right:1px solid black;"><b></b>&nbsp;&nbsp;</td>
 -->      </tr>
            
         

      </table>
      <table width="750" border="0" align="center" style="border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;border-collapse:collapse;">
        <tr>
          <td width="42" height="33" >&nbsp;</td>
          <td width="115">&nbsp;</td>
          <td width="47" >&nbsp;</td>
          <td width="77" >&nbsp;</td>
          <td width="77" >&nbsp;</td>
          <td width="117">&nbsp;</td>
          <td width="75" align="right" style="border-bottom: 1px dotted black;">Sub Total&nbsp;:&nbsp;</td>
          <td width="64" align="right" style="border-bottom: 1px dotted black;">&nbsp;</td>
          <td width="96" align="right" style="border-bottom: 1px dotted black;"><strong><?php echo $bil->subtotal;?></strong></td>
        </tr>


           <tr>
          <td height="28">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="right" style="border-bottom: 1px dotted black;">Discount&nbsp;:&nbsp;</td>
      <td align="center" style="border-bottom: 1px dotted black;"><strong><?php echo $bil->discount;?></strong></td>
      <td align="right" style="border-bottom: 1px dotted black;"><strong><?php echo $bil->disamount;?></strong></td>
        </tr>

          <tr>
         <td height="28">&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td align="center" style="border-bottom: 1px dotted black;text-transform:uppercase;"><?php echo $bil->taxpercentage;?></td>
      <td align="center" style="border-bottom: 1px dotted black;"><strong></strong></td>
      <td align="right" style="border-bottom: 1px dotted black;"><strong><?php echo $bil->taxamount;?></strong></td>
        </tr>
  
        <tr style="font-size: 20px; border-top: 1px solid black;">
        <td height="44" colspan="7" align="right">Grand Total</td>
          <td colspan="2" align="right" style="border-right:1px solid black;"><strong><?php echo $bil->grandtotal;?></strong></td>
      </tr>
      </table>
      
      <table width="750" height="108" align="center" style="border-collapse:collapse;border-bottom:1px solid black;border-right:1px solid black;border-left:1px solid black;">
        <tr>
          <td width="260" height="40"><b style="font-size:11px;">&nbsp;&nbsp;AMOUNT CHARGEABLE (In Words)</small> :</td>
          <td width="527" align="right" ><b>For <?php echo $profile->companyname;?></b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
        </tr>
          <td height="34" colspan="2" style="font-size:12px;"><strong>&nbsp;&nbsp;<?php echo $fin;?> Only.</strong></td>
        </tr>
      <td width="211">&nbsp;</td>
      <td align="right">Authorised Signatory&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    </tr>
</table>
<?php }?>

 <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
 <script type="text/javascript">
    window.print();
 </script>