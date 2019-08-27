<?php
$count=count($pono);
for ($i=0; $i < $count; $i++) { 
$data[]=$this->db->where('purchaseorderno',$pono[$i])->where('qty >',0)->get('purchaseorder_reports')->result_array();

}
// echo "<pre>";
// print_r($data);
// exit();

?>

<input class="" id="gsttypes"  type="hidden" value="<?php echo $gsttype;?>" style="width:70px;">
<div class="table-responsive">
<table class="table">
<thead> 
<tr>
<th>HSN Code</th>
<th>Item Name</th>
<th>Qty</th>
<th>UOM</th>
<th>Rate</th>
<th>Amount</th>
<th>Disc </th>
<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>

<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>



<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
<th>Total</th>



</tr>  
</thead>
<tbody>

<?php
foreach ($data as $datas) {
foreach ($datas as $rows) {
?>
<tr>

<td>
<input class="form-control" parsley-trigger="change" readonly id="purchaseordernos" type="hidden" name="purchaseordernos[]" value="<?php echo $rows['purchaseorderno'];?>">	
<!-- <input class="form-control" parsley-trigger="change" readonly id="insertid" type="text" name="insertid" value="<?php echo @$rows['insertid'];?>"> -->
<input class="form-control" parsley-trigger="change" readonly id="id<?php echo $rows['id'];?>" type="hidden" name="id[]" value="<?php echo $rows['id'];?>"> 

<input class="" id="hsnno" parsley-trigger="change"  readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="<?php echo $rows['hsnno'];?>" style="width:70px;">

<div id="hsnno_valid"></div>
</td>
<td><input class="" id="itemname<?php echo $rows['id'];?>" parsley-trigger="change" readonly  style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" value="<?php echo $rows['itemname'];?>" >
<div id="itemname_valid"></div><input type="text" name="item_desc[]" value="" style="width:150px;border:1px solid #605f5f;margin-top: 2px;" >
</td>

<td><input class="" id="qty<?php echo $rows['id'];?>" value="0"  parsley-trigger="change" type="text" name="qty[]"   autocomplete="off" style="width:50px;border:1px solid #605f5f;">
<input class="" type="hidden" id="balanceqty<?php echo $rows['id'];?>" value="<?php echo $rows['balaceqty'];?>"  parsley-trigger="change" type="text" name="balanceqty[]"   autocomplete="off" style="width:50px;border:1px solid #605f5f;">
<div id="qty_valid" style="color:green;">Qty : <?php echo @$rows['balaceqty'];?></div>
<div id="qty_valid"></div>
</td>  

<td><input class="" id="uom" parsley-trigger="change" required readonly  style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]" value="<?php echo @$rows['uom'];?>"  autocomplete="off">
<div id="rate_valid"></div>
</td>

<td><input class=" decimals" parsley-trigger="change" required id="rate<?php echo $rows['id'];?>"  style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]"   autocomplete="off">
<div id="rate_valid"></div>
</td>


<td><input class="decimals" id="amount<?php echo $rows['id'];?>" parsley-trigger="change" required readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off">
<div id="rate_valid"></div>
</td>

<td><input class="decimals" id="discount<?php echo $rows['id'];?>"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" onkeypress="return isNumberKey_With_Dot(event)" value="0"  autocomplete="off">
<div id="rate_valid"></div>
</td>

<td><input class="decimals" id="taxableamount<?php echo $rows['id'];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off">
<input type="hidden" name="discountamount[]" id="discountamount<?php echo $rows['id'];?>">
<div id="rate_valid"></div>
</td>

<td class="sgst"><input class="decimals" readonly id="cgst<?php echo $rows['id'];?>"  type="text" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" >
<div id="cgst_valid"></div>

</td>


<td class="sgst"><input class="decimals" readonly id="cgstamount<?php echo $rows['id'];?>"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
</td>

<td class="sgst"><input class="decimals" id="sgst<?php echo $rows['id'];?>" readonly  type="text" name="sgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" >
<div id="sgst_valid"></div>
</td>


<td class="sgst"><input class="decimals" id="sgstamount<?php echo $rows['id'];?>"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
</td>



<td class="igst" style="display:none;"><input class="decimals" id="igst<?php echo $rows['id'];?>"  type="text" name="igst[]" readonly  style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" >
<div id="igst_valid"></div>

</td>


<td class="igst" style="display:none;"><input class="decimals" id="igstamount<?php echo $rows['id'];?>"  type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
</td>

<td>
<input class="" id="total<?php echo $rows['id'];?>" type="text" name="total[]" value=""  readonly style="width:110px;border:1px solid #605f5f;">
</td>

<!--   <td>
<button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button>
</td> -->
</tr>
<?php
} 
}
?>
</tbody>

</table> 
</div>

<br>
<br>
<table class="table">


<tr>


<td>Freight Charges</td>


<td><input class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="border:1px solid #605f5f;" type="text" name="freightamount" value=""  autocomplete="off">

</td>





<td class="sgst"><input class="decimals"  id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="" style="border:1px solid #605f5f;"   autocomplete="off" ></td>


<td class="sgst"><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off" readonly style="border:1px solid #605f5f;" value="">
</td>

<td class="sgst"><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" readonly value="" style="border:1px solid #605f5f;"   autocomplete="off" >
<div id="sgst_valid"></div>
</td>


<td class="sgst"><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" readonly style="border:1px solid #605f5f;" value="">
</td>



<td class="igst" style="display:none;"><input class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST"  style="border:1px solid #605f5f;"   autocomplete="off" >
<div id="igst_valid"></div>

</td>


<td class="igst" style="display:none;"><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" readonly style="border:1px solid #605f5f;" value="">
</td>

<td>
<input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value=""  readonly style="border:1px solid #605f5f;">
</td>


</tr>

<tr>


<td>Loading & Packing Charges</div>
</td>


<td><input class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="border:1px solid #605f5f;" type="text" name="loadingamount" value=""  autocomplete="off">
<div id="rate_valid"></div>
</td>





<td class="sgst"><input class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="" style="border:1px solid #605f5f;"   autocomplete="off" >
<div id="cgst_valid"></div>

</td>


<td class="sgst"><input class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="">
</td>

<td class="sgst"><input class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" readonly value="" style="border:1px solid #605f5f;"   autocomplete="off" >
<div id="sgst_valid"></div>
</td>


<td class="sgst"><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount" readonly  placeholder="SGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="">
</td>



<td class="igst" style="display:none;"><input class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST"   style="border:1px solid #605f5f;"   autocomplete="off" >
<div id="igst_valid"></div>

</td>


<td class="igst" style="display:none;"><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" readonly style="border:1px solid #605f5f;" value="">
</td>

<td>
<input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value=""  readonly style="border:1px solid #605f5f;">
</td>


</tr>

</table>

<div class="col-sm-offset-8">
<label class="col-sm-5  control-label" >Sub Total</label>
<div class="col-sm-7">
<input class="form-control"  type="text" name="subtotal" id="subtotal" readonly  placeholder="0" value="0">
</div>
</div>
<br>
<br>    



<div class="col-sm-offset-8">
<label class="col-sm-5  control-label" >Round Off</label>
<div class="col-sm-7">
<input class="form-control"  type="text" name="othercharges" id="othercharges"   placeholder="0" -onkeypress="return isNumber(event)" value="0" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
</div>
</div>
<br>
<br>  

<div class=" col-sm-offset-8">
<label class="col-sm-5  control-label" >Invoice Total</label>
<div class="col-sm-7">
<input class="form-control" readonly type="text" name="grandtotal" id="grandtotal" >


</div>                      
</div>
<div class="col-sm-offset-4">
<button  class="btn btn-info" id="submit" name="save" value="save">Add Invoice</button>
<button  class="btn btn-primary"  name="print" id="print" value="print">Print Invoice</button>
</div>

<?php
foreach ($data as $datas) {
foreach ($datas as $rows) {
?>
<script type="text/javascript">
$(document).ready(function(){

var gsttype=$('#gsttypes').val(); 
if(gsttype=='interstate')
{
$('.sgst').hide();
$('.igst').show();

}
else  if(gsttype=='intrastate')
{

$('.sgst').show();
$('.igst').hide();

}


var name=$('#itemname<?php echo $rows['id'];?>').val();
$.post('<?php echo base_url();?>invoice/get_itemnames',{name:name},function(rest){
var obj=jQuery.parseJSON(rest);
$('#sgst<?php echo $rows['id'];?>').val(obj.sgst);
$('#cgst<?php echo $rows['id'];?>').val(obj.cgst);
$('#igst<?php echo $rows['id'];?>').val(obj.igst);
$('#rate<?php echo $rows['id'];?>').val(obj.price);


var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);

});


$('#qty<?php echo $rows['id'];?>').keyup(function(){


var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);

});

$('#rate<?php echo $rows['id'];?>').keyup(function(){


var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);

});

$('#discount<?php echo $rows['id'];?>').keyup(function(){
var discount=$('#discount<?php echo $rows['id'];?>').val(); 
if(discount =='')
{ 
$('#discountamount<?php echo $rows['id'];?>').val('');
}
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);

});

$('#freightamount').keyup(function(){
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);
});

$('#freightcgst').keyup(function(){

var freightcgst=$('#freightcgst').val();
$('#freightsgst').val(freightcgst);
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);

});



$('#freightigst').keyup(function(){
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);
});

$('#loadingamount').keyup(function(){
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);
});

$('#loadingcgst').keyup(function(){
var loadingcgst=$('#loadingcgst').val();
$('#loadingsgst').val(loadingcgst);
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);
});



$('#loadingigst').keyup(function(){
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);
});

$('#othercharges').keyup(function(){
var totals=$('#id<?php echo $rows['id'];?>').val();
calculations(totals);
});



});
</script>

<?php } } ?>

<script type="text/javascript">

function calculations(totals)
{

var qty=$('#qty'+totals+'').val();
var rate=$('#rate'+totals+'').val();

if(qty!='' && rate!='') 
var amo=parseFloat(rate)*parseFloat(qty);
var amou=amo.toFixed(2);
$('#amount'+totals+'').val(amou);
$('#taxableamount'+totals+'').val(amou);
$('#total'+totals+'').val(amou);


var discount=$('#discount'+totals+'').val();
var cgst=$('#cgst'+totals+'').val();
var sgst=$('#sgst'+totals+'').val();
var igst=$('#igst'+totals+'').val(); 
var taxableamount=$('#taxableamount'+totals+'').val(); 
var gsttype=$('#gsttypes').val(); 
var freightamount=$('#freightamount').val();
var freightcgst=$('#freightcgst').val();
var freightsgst=$('#freightsgst').val();
var freightigst=$('#freightigst').val();
var loadingamount=$('#loadingamount').val();
var loadingcgst=$('#loadingcgst').val();
var loadingsgst=$('#loadingsgst').val();
var loadingigst=$('#loadingigst').val();
var othercharges=$('#othercharges').val();
var a=0;
var b=0; 
var c=0;
var d=0;
var e=0;
var f=0;
var g=0;
var h=0;
var i=0;
var j=0;
var k=taxableamount;
var l=0;



if(freightamount=='')
{
var fa=0;
$('#freightcgst').val('');
$('#freightsgst').val('');
$('#freightigst').val('');

$('#freightcgstamount').val('');
$('#freightsgstamount').val('');
$('#freightigstamount').val('');
} 
else
{
var fa=freightamount;
}

if(loadingamount=='')
{ 
var la=0;
$('#loadingcgst').val('');
$('#loadingsgst').val('');
$('#loadingigst').val('');

$('#loadingcgstamount').val('');
$('#loadingsgstamount').val('');
$('#loadingigstamount').val('');
}
else
{
var la=loadingamount;
}

if(discount > 0)
{

a=((parseFloat(amo)*parseFloat(discount))/100);
var a1=a.toFixed(2);
var a2=parseFloat(amo)-parseFloat(a1);
var a3=a2.toFixed(2);
k=a3;
$('#discountamount'+totals+'').val(a1);
$('#taxableamount'+totals+'').val(a3);
$('#total'+totals+'').val(a3);
}



if(gsttype=='intrastate')

{

if(cgst > 0)
{
b=((parseFloat(k)*parseFloat(cgst))/100);
var b1=b.toFixed(2);
$('#cgstamount'+totals+'').val(b1);
var b2=parseFloat(k)+parseFloat(b);
var b3=b2.toFixed(2);
$('#total'+totals+'').val(b3);

}

if(sgst > 0)
{
c=((parseFloat(k)*parseFloat(sgst))/100);
var c1=c.toFixed(2);
$('#sgstamount'+totals+'').val(c1);
var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
var c3=c2.toFixed(2);
$('#total'+totals+'').val(c3);

}

if(freightcgst > 0)
{
d=((parseFloat(fa)*parseFloat(freightcgst))/100);
var d1=d.toFixed(2);
$('#freightcgstamount').val(d1);
var d2=parseFloat(fa)+parseFloat(d);
var d3=d2.toFixed(2);
$('#freighttotal').val(d3);
}
else
{
$('#freighttotal').val(0);
}

if(freightsgst > 0)
{
e=((parseFloat(fa)*parseFloat(freightsgst))/100);
var e1=e.toFixed(2);
$('#freightsgstamount').val(e1);
var e2=parseFloat(fa)+parseFloat(d)+parseFloat(e);
var e3=e2.toFixed(2);
$('#freighttotal').val(e3);
}
else
{
$('#freighttotal').val(0);
}

if(loadingcgst > 0)
{
f=((parseFloat(la)*parseFloat(loadingcgst))/100);
var f1=f.toFixed(2);
$('#loadingcgstamount').val(f1);
var f2=+parseFloat(la)+parseFloat(f);
var f3=f2.toFixed(2);
$('#loadingtotal').val(f3);
}
else
{
$('#loadingtotal').val(0);
}

if(loadingsgst > 0)
{
g=((parseFloat(la)*parseFloat(loadingsgst))/100);
var g1=g.toFixed(2);
$('#loadingsgstamount').val(g1);
var g2=parseFloat(la)+parseFloat(f)+parseFloat(g);
var g3=g2.toFixed(2);
$('#loadingtotal').val(g3);
}
else
{
$('#loadingtotal').val(0);
}





}

else  if(gsttype=='interstate')
{

if(igst > 0)
{

h=((parseFloat(k)*parseFloat(igst))/100);
var h1=h.toFixed(2);
$('#igstamount'+totals+'').val(h1);
var h2=parseFloat(k)+parseFloat(h);
var h3=h2.toFixed(2);
$('#total'+totals+'').val(h3);

}

if(freightigst > 0)
{

i=((parseFloat(fa)*parseFloat(freightigst))/100);
var i1=i.toFixed(2);
$('#freightigstamount').val(i1);
var i2=parseFloat(fa)+parseFloat(i);
var i3=i2.toFixed(2);
$('#freighttotal').val(i3);

}
else
{
$('#freighttotal').val(0);
}


if(loadingigst > 0)
{

j=((parseFloat(la)*parseFloat(loadingigst))/100);
var j1=j.toFixed(2);
$('#loadingigstamount').val(j1);
var j2=parseFloat(la)+parseFloat(j);
var j3=j2.toFixed(2);
$('#loadingtotal').val(j3);

}
else
{
$('#loadingtotal').val(0);
}

}


var sub_tot=0;
sub_tot +=Number($('#freighttotal').val());
sub_tot +=Number($('#loadingtotal').val());  
$('input[name^="total"]').each(function(){
sub_tot +=Number($(this).val()); 
var fina=sub_tot.toFixed(2);         
$('#subtotal').val(fina);
$('#grandtotal').val(fina); 
});


if(othercharges)
{
l=parseFloat(sub_tot)+parseFloat(othercharges);
var l1=l.toFixed(2);
$('#grandtotal').val(l1);

}

}




$('#document').ready(function(){
$('#checkbox').click(function(){
if($(this).prop("checked")==true)
{
$('#check').show();
$('#imaddress').show();

}
else if($(this).prop("checked")==false)
{
$('#check').hide();
$('#imaddress').hide();
}
});
});   


function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}
function onlyAlphabets(evt) {
var charCode;
if (window.event)
charCode = window.event.keyCode;  //for IE
else
charCode = evt.which;  //for firefox
if (charCode == 32) //for &lt;space&gt; symbol
return true;
if (charCode > 31 && charCode < 65) //for characters before 'A' in ASCII Table
return false;
if (charCode > 90 && charCode < 97) //for characters between 'Z' and 'a' in ASCII Table
return false;
if (charCode > 122) //for characters beyond 'z' in ASCII Table
return false;
return true;
}
$('.decimal').keyup(function(){
var val = $(this).val();
if(isNaN(val)){
val = val.replace(/[^0-9\.-]/g,'');
if(val.split('.').length>2)
val =val.replace(/\.-+$/,"");
}
$(this).val(val);
});
</script>

