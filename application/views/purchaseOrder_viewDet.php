<?php $data=$this->db->get('profile')->result(); 
$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
foreach($data as $d)
?>
<title> <?php echo $d->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<style type="text/css">
.forms{ }
.forms input{ width: 95%; }
.uppercase { text-transform: uppercase; }
td,th { font-size: 12px;color:black;}
textarea.form-control { min-height: 40px !important; }
.myform {}
.myform input[type="text"]{ width:100%; border: 1px solid #dcdcdc; border-radius: 4px; padding:8px; color: #435966;}
.myform input[type="hidden"]{ background:#626262;}
.parsley-required { color:#f00 !important; }
</style>
<div class="content-page">
<div class="content">
<div class="container">
<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
<div class="alert btn-primary alert-micro btn-rounded pastel light dark" >
<a href="#" class="close" data-dismiss="alert">&times;</a>
<?php print_r($msg); ?>
</div>
<?php } ?>

<?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
<div class="alert alert-micro btn-rounded alert-danger">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<?php print_r($msg); ?>
</div>
<?php } ?>
<?php foreach($result as $vi)  ?> 
<div class="row">
<div class="col-sm-12">
<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
<header class="panel-heading" style="color:rgb(255, 255, 255)">
<i class="zmdi zmdi-shopping-cart">&nbsp;View Purchase Order</i> - <?php echo $vi['purchaseorderno'];?>
</header>
<div class="card-box">
<div class="row">

<div class="card-box">
<div class="row">
<form class="horizontal-form myform" id="dc_forms"  method="post" action="<?php echo base_url();?>purchaseorder/view" data-parsley-validate novalidate>
<input type="hidden" id="discountBy" name="hiddenDiscountBy" value="<?php echo $discountBy;?>" />
<div class="form-group ">
<div class="col-md-8 forms">
<div class="row">
<div class="col-md-12">
<div class="col-md-2">
<div class="form-group">
<label >Date</label>
<input type="text" class="form-control" readonly name="purchasedate" parsley-trigger="change" id="datepicker-autoclose" required="" value="<?php echo date('d-m-Y',strtotime($vi['purchasedate']));?>" style="width:148px;">
</div>
</div>
<div class="col-md-2">
<div class="form-group">
<label>Invoice Date</label>
<input type="text" auotocomplete="off" class="form-control datepicker-autoclose" name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y',strtotime($vi['invoicedate']));?>" >
</div>
</div>

<!-- <div class="col-md-2">
<label>PO Type</label>
<select  class="form-control" parsley-trigger="change" required name="potype" id="potype" >
<option value="<?php echo $vi['potype'];?>"><?php echo $vi['potype'];?></option>
</select>
</div> -->
<div class="col-md-6">
<div class="form-group">
<label>Supplier Name</label>
<input type="text" class="form-control" name="customername" id="customername" value="<?php echo $vi['customername'];?>">
<input type="hidden" class="form-control"  name="customerid" id="customerid" value="<?php echo $vi['customerId'];?>">
<div id="cusname_valid" style="position: absolute;"></div>
</div>
</div>

</div>
</div>
<div class="row">
<div class="col-md-2">
<div class="form-group">
<label>GST Type</label>
<select  class="form-control" parsley-trigger="change" required name="gsttype" id="gsttype" >
<option value="<?php echo $vi['gsttype'];?>" selected="selected"><?php echo $vi['gsttype'];?></option>
<?php /* <option value="interstate" <?php if($vi['gsttype']=='interstate')echo 'selected';?>>Interstate</option> */ ?>
</select>
</div>
</div>
</div>

</div>
<div class="col-md-4">
<div class="form-group">
<label>Address</label>
<textarea type="text" class="form-control" name="address" id="address"  rows="4"><?php echo $vi['address'];?></textarea>
</div>
</div>
</div>
<div class="clearfix"><hr /></div>
<div class="row bomClass" <?php if($vi['potype']!='BOM') { echo 'style="display:none"'; } ?>>
<div class="col-md-12">
<div class="col-md-6">
<label>BOM No</label>
<div class="clearfix"></div>
<input type="text" readonly name="selected_bom[]" id="selected_bom" value="<?php echo str_replace('||',',',$vi['selected_bom']);?>" />
</div>
</div>
</div>

<table class="table">
<thead> 
<tr>
<th>HSN Code</th>
<th>Item Name</th>
<th>Qty</th>
<th>UOM</th>
<th>Rate</th>
<th>Amount</th>
<th>Disc <?php if($discountBy=='percent_wise') { echo '%'; } ?></th>
<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
<?php if($vi['gsttype']=='intrastate') { ?>
<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
<?php }else {  ?>
<th  class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
<th " class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
<?php } ?>
<th>Total</th>
</tr>  
</thead>
<tbody>
<?php 
$hsnno=explode('||',$vi['hsnno']);
$itemname=explode('||',$vi['itemname']);
$qty=explode('||',$vi['qty']);
$uom=explode('||',$vi['uom']);
$rate=explode('||',$vi['rate']);
$amount=explode('||',$vi['amount']);
$taxableamount=explode('||',$vi['taxableamount']);
$discount=explode('||',$vi['discount']);
$discountamount=explode('||',$vi['discountamount']);
$cgst=explode('||',$vi['cgst']);
$cgstamount=explode('||',$vi['cgstamount']);
$sgst=explode('||',$vi['sgst']);
$igst=explode('||',$vi['igst']);
$sgstamount=explode('||',$vi['sgstamount']);
$igstamount=explode('||',$vi['igstamount']);
$total=explode('||',$vi['total']);

for($i=0;$i<count($itemname);$i++) { 
$this->db->select('*');
$this->db->from('additem');
$this->db->where('itemname',$itemname[$i]);
$item_query = $this->db->get();
$item_result = $item_query->row();
?>
<tr>
<td>
<input class="" id="hsnno<?php echo $i;?>" readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="<?php echo $hsnno[$i];?>">
<input class="form-control"  id="itemno" type="hidden" name="itemno[]" value="">
<input class="form-control"  id="id<?php echo $i;?>" type="hidden"  value="<?php echo $i;?>">
<div id="hsnno_valid<?php echo $i;?>"></div>
</td>
<td>
<input class="itemname_class" data-id="<?php echo $i;?>" id="itemname<?php echo $i;?>" value="<?php echo $itemname[$i];?>" style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" value="" ><div id="itemname_valid<?php echo $i;?>"></div><input type="hidden" id="priceType<?php echo $i;?>" name="priceType[]" value="<?php echo @$item_result->priceType;?>" />
</td>
<td>
<input class="qty_class" data-id="<?php echo $i;?>" id="qty<?php echo $i;?>" required type="text" name="qty[]" value="<?php echo $qty[$i];?>"   autocomplete="off" style="width:50px;border:1px solid #605f5f;"><input type="hidden" name="qtys[]" id="qtys<?php echo $i;?>" value="<?php echo $qty[$i];?>"><div id="qty_valid<?php echo $i;?>"></div>
</td>  
<td><input class="" value="<?php echo $uom[$i];?>" id="uom<?php echo $i;?>" readonly style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]"   autocomplete="off"></td>
<td><input class="rate_class decimals" data-id="<?php echo $i;?>" value="<?php echo $rate[$i];?>" id="rate<?php echo $i;?>" required style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]"   autocomplete="off"><div id="rate_valid<?php echo $i;?>"></div></td>
<td><input class="decimals" id="amount<?php echo $i;?>" value="<?php echo $amount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal<?php echo $i;?>" value=""><div id="rate_valid<?php echo $i;?>"></div></td>
<td><input class="discount_class decimals" data-id="<?php echo $i;?>"  id="discount<?php echo $i;?>" value="<?php echo $discount[$i];?>"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" value="0"  autocomplete="off"><div id="discount_valid<?php echo $i;?>"></div><input type="hidden" id="oldDisc<?php echo $i;?>" value="<?php echo $discount[$i];?>" ></td>
<td><input class="decimals" id="taxableamount<?php echo $i;?>" value="<?php echo $taxableamount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount<?php echo $i;?>"></td>

<?php if($vi['gsttype']=='intrastate') { ?>
<td class="sgst"><input class="decimals" value="<?php echo $cgst[$i];?>" readonly id="cgst<?php echo $i;?>" required type="text" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required><div id="cgst_valid<?php echo $i;?>"></div></td>
<td class="sgst"><input class="decimals" value="<?php echo $cgstamount[$i];?>" id="cgstamount<?php echo $i;?>" required type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>
<td class="sgst"><input class="decimals" id="sgst<?php echo $i;?>" value="<?php echo $sgst[$i];?>" required type="text" name="sgst[]" value="" readonly style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required><div id="sgst_valid<?php echo $i;?>"></div></td>
<td class="sgst"><input class="decimals" value="<?php echo $sgstamount[$i];?>" id="sgstamount<?php echo $i;?>" required type="text" name="sgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
<input type="hidden" id="igst<?php echo $i;?>" value="<?php echo @$item_result->igst;?>" />
</td>
<?php } else { ?>
<td class="igst" ><input class="decimals" id="igst<?php echo $i;?>"  type="text" name="igst[]" readonly style="width:45px;border:1px solid #605f5f;" value="<?php echo $igst[$i];?>"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid<?php echo $i;?>"></div></td>
<td class="igst"><input class="decimals" id="igstamount<?php echo $i;?>" value="<?php echo $igstamount[$i];?>" type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>
<?php } ?>
<td><input class="" id="total<?php echo $i;?>" type="text" value="<?php echo $total[$i];?>" name="total[]"  value=""  readonly style="width:110px;border:1px solid #605f5f;"></td>

</tr>
<?php } ?>
</tbody>
<tbody id="append"></tbody> 
</table> 
<div class="col-sm-offset-11">
<button type="button" class="btn btn-info add pull-right" style="margin-right: 10px;"><i class="fa fa-plus"></i></button>
<input type="hidden"  id="hide" value="<?php echo ($i-1);?>">
</div>
<br>
<table class="table">
<tr>
<td>Freight Charges</td>
<td><input class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="border:1px solid #605f5f;" type="text" name="freightamount" value="<?php echo $vi['freightamount'];?>"  autocomplete="off"></td>
<?php if($vi['gsttype']=='intrastate') { ?>
<td ><input class="decimals"  id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="<?php echo $vi['freightcgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
<td ><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightcgstamount'];?>"></td>
<td ><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" readonly value="<?php echo $vi['freightsgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="sgst_valid"></div></td>
<td ><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightsgstamount'];?>"></td>
<?php 
} 
else 
{
?> 
<td ><input class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST" value="<?php echo $vi['freightigst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="igst_valid"></div></td>
<td ><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightigstamount'];?>"></td>
<?php } ?>
<td><input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="<?php echo $vi['freighttotal'];?>"  readonly style="border:1px solid #605f5f;"></td>
</tr>
<tr>
<td>Loading & Packing Charges</td>
<td><input class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="border:1px solid #605f5f;" type="text" name="loadingamount" value="<?php echo $vi['loadingamount'];?>"  autocomplete="off"><div id="rate_valid"></div></td>
<?php if($vi['gsttype']=='intrastate') { ?>
<td ><input class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="<?php echo $vi['loadingcgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="cgst_valid"></div></td>
<td ><input class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingcgstamount'];?>"></td>
<td ><input class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" readonly value="<?php echo $vi['loadingsgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="sgst_valid"></div></td>
<td ><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount" readonly  placeholder="SGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingsgstamount'];?>"></td>
<?php 
} 
else 
{
?> 
<td ><input class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST" value="<?php echo $vi['loadingigst'];?>"  style="border:1px solid #605f5f;"   autocomplete="off" ><div id="igst_valid"></div></td>
<td ><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingigstamount'];?>"></td>
<?php } ?>
<td><input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="<?php echo $vi['loadingtotal'];?>"  readonly style="border:1px solid #605f5f;"></td>
</tr>
</table>

<div class="col-sm-offset-5">
<label class="col-sm-5  control-label" >Sub Total</label>
<div class="col-sm-7">
<input class="form-control"  type="text" value="<?php echo $vi['subtotal'];?>" name="subtotal" id="subtotal" readonly  placeholder="0" value="0">
</div>
</div>
<br>
<br>    

<div class="col-sm-offset-5">
<label class="col-sm-5  control-label" >Round Off</label>
<div class="col-sm-7">
<input class="form-control decimals"  type="text" name="roundOff" id="roundOff"   placeholder="0" value="<?php echo $vi['roundOff'];?>" onfocus="if(this.value == '0') { this.value = ''; }" onblur="if(this.value == '') { this.value = '0'; }">
</div>
</div>
<br>
<br>  
<div class="clearfix"></div> 

<div class="col-sm-offset-5">
<label class="col-sm-5  control-label" >Other Charges</label>
<div class="col-sm-7">
<input class="form-control"  type="text" name="othercharges" id="othercharges"  value="<?php echo $vi['othercharges'];?>" placeholder="0" value="0">
</div>
</div>
<br>
<br>  

<div class=" col-sm-offset-5">
<label class="col-sm-5  control-label" >Purchase Total</label>
<div class="col-sm-7">
<input class="form-control"  type="text" value="<?php echo $vi['grandtotal'];?>" readonly name="grandtotal" id=	"grandtotal" >
<input class="form-control"  type="hidden" name="taxtotal" id="grandtotal1" value="">
</div>                      
</div>
<div class="col-sm-offset-4">
<a  class="btn btn-info" href="javascript:reportFun();"><i class="fa fa-chevron-left"></i> Back to Reports</a>
</div>
</form>
</div>
</div>
</section>
</div>
</div><!-- end col -->
</div>
</div>
<script>
var resizefunc = [];
</script>

<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
$("#dc_forms :input").prop("disabled", true);
$( '#dc_forms :input[type="reset"]' ).hide();
//$('#submit').html('<i class="fa fa-chevron-left"></i> Back to Reports').attr('type','button').prop('disabled',false).attr('onclick', 'reportFun()');
$(".add").hide();
});
function reportFun()
{
window.location.href="<?php echo base_url().'purchaseorder/view';?>";
}
</script>

