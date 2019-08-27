<?php $data=$this->db->get('profile')->result();
$discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
foreach($data as $r)
?>
<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/multiselect/css/bootstrap-select.css">
<style type="text/css">
input:read-only { background-color: rgba(169, 169, 169, 0.21);	color: #000;	}
.forms{ }
.forms input{ width: 95%; }
.uppercase {text-transform: uppercase;}
td,th	{	font-size: 12px;	color:black;	}
.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
width: 89%;
}
.againstdc	{	display: none;	}
</style>
<style type="text/css">
	textarea.form-control { min-height: 40px !important; }
	.myform {}
	.myform input[type="text"]{ width:100%; border: 1.5px solid #29166f; border-radius: 4px; padding:8px; color: #435966;}
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
<div class="row">
<div class="col-sm-12">
<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
<header class="panel-heading" style="color:rgb(255, 255, 255)">
<i class="zmdi zmdi-shopping-cart">&nbsp;Invoice - <?php echo $invoiceno;?></i>
</header>
<div class="card-box" style="min-height: 500px;">
<div class="row">
<form class="horizontal-form"  method="post" action="<?php echo base_url();?>invoice/insert" data-parsley-validate novalidate -target="_blank" -onsubmit="setTimeout(function () { location.href = '<?php echo base_url();?>invoice'; },2000)">
<input type="hidden" id="discountBy" name="hiddenDiscountBy" value="<?php echo $discountBy;?>" />
<input type="hidden" class="form-control" name="invoiceno" id="invoiceno" value="<?php echo $invoiceno;?>"  readonly  >
<div class="form-group ">
<div class="col-md-8 forms">
<div class="col-md-2" hidden>
<div class="form-group">
<label class="">Bill Type</label>
<select name="bill_type" id="bill_type" required class="form-control" style="padding:5px;">
<option value="Sales Invoice">Sales Invoice</option>
<option value="Labour Bill">Labour Bill</option>
</select>
</div>
</div>

<div class="col-md-3">
<div class="form-group">
<label class="">Invoice Type</label>
<select name="invoicetype" id="invoicetype" required class="form-control">
<option value="Direct Invoice">Direct Invoice</option>
<option value="Against DC">Against DC</option>
<!-- <option value="Against PO">Against Purchase Order</option> -->
</select>
</div>
</div>

<div class="col-md-2">
<div class="form-group">
<label >Date</label>
<input type="text" class="form-control datepicker-autoclose" name="invoicedate" parsley-trigger="change" id="datepicker-autoclose" required="" value="<?php echo date('d-m-Y');?>" >
</div>
</div>

<div class="col-md-5">
<div class="form-group">
<label>Customer  Name <a target="_blank" href="<?php echo base_url();?>customer">(Add Customer)</a></label>
<input type="text" class="form-control" parsley-trigger="change" required name="customername" id="customername" value="">
<input type="hidden" class="form-control" name="customerid" id="customerid" value="">
<div id="cusname_valid" style="position: absolute;">
</div>
</div>
</div>


<!-- <div class="col-md-4">
<div class="form-group">
<label>Order No</label>
<input type="text" class="form-control"  name="orderno" id="orderno" value="" >
<div id="invoiceno_valid"></div>
</div>
</div>



<div class="col-md-4">
<div class="form-group">
<label>Order Date</label>
<input type="text" auotocomplete="off" class="form-control datepicker-autoclose"  name="orderdate" id="orderdate" value="" >
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Delivery At</label>
<input type="text" class="form-control"  name="deliveryat" id="deliveryat" value="">
<div id="invoiceno_valid"></div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Transport Mode</label>
<input type="text" class="form-control"  name="transportmode" id="transportmode" value="">
<div id="invoiceno_valid"></div>
</div>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Vehicle No</label>
<input type="text" class="form-control"  name="vehicleno" id="vehicleno" value="">
<div id="invoiceno_valid"></div>
</div>
</div>

<div class="col-md-4" hidden>
<div class="form-group">
<label>GST Type</label>
<select  class="form-control" parsley-trigger="change" required name="gsttype" id="gsttype" >
<option value="intrastate">INTRA-STATE</option>
<option value="interstate">INTER-STATE</option>

</select>
</div>
</div>

<div class="col-md-9 againstdc">
<div class="form-group">
<label>DC No</label>
<div class="clearfix"></div>
<select class="selectpicker" required name="dcno[]" multiple data-live-search="true" id="dcno" data-live-search-placeholder="Search"  data-actions-box="true">
</select>
<button class="btn" type="button" id="dcsearch"><i class="fa fa-search" aria-hidden="true"></i></button>

</div>
</div>

<div class="col-md-9 againstpo">
<div class="form-group">
<label>PO No</label>
<div class="clearfix"></div>
<select class="selectpicker" name="pono[]" required multiple data-live-search="true" id="pono" data-live-search-placeholder="Search"  data-actions-box="true">
</select>
<button class="btn" type="button" id="posearch"><i class="fa fa-search" aria-hidden="true"></i></button>

</div>
</div> -->
</div>



<!-- <div class="col-md-4">
<div class="form-group">
<label>Address</label>
<textarea type="text" class="form-control" name="address" id="address"  rows="4"></textarea>
</div>
</div> -->

<div class="col-md-4 againstdc">
<div class="form-group">
<label>DC Details</label>
<select name="dcnos" multiple="multiple" id="dcnos"  class="form-control" data-actions-box="true">
</select>
</div>
</div>
</div>
<div class="clearfix"></div>

<div class="dcdetails myform"></div>

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
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/multiselect/js/bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$('form').parsley();

});
$('.colorpicker-default').colorpicker({ format: 'hex' });
$('.colorpicker-rgba').colorpicker();
// Date Picker
jQuery('#datepicker').datepicker();
jQuery('.datepicker-autoclose').datepicker({ autoclose: true, todayHighlight: true });

$(document).ready(function(){
$( "#customername" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>invoice/autocomplete_customername",
data: { keyword: $("#customername").val()},
dataType: "json",
type: "POST",
success: function(data){ 
response(data);
}            
});
}, select: function (event, ui) {
$("#customername").val(ui.item.label); 
$('#address').val(ui.item.address); 
$('#tinno').val(ui.item.tinno); 
$('#cstno').val(ui.item.cstno); 
$('#customerid').val(ui.item.customerid); 
var name = $('#customername').val();
if(name !='')
{
$.post('<?php echo base_url();?>invoice/getcustomer',{name:name},function(res){
if(res > 0)
{
$('#cusname_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
});

$('#customername').keyup(function(){
var name = $('#customername').val();
if(name !='')
{
$.post('<?php echo base_url();?>invoice/getcustomer',{name:name},function(res){
if(res > 0)
{
$('#cusname_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}); 

$('#customername').blur(function(){ 
var name=$(this).val();
var invoice_type = $('#invoicetype').val();
if(invoice_type == 'Against DC'){			
$('#dcno').selectpicker();
$('#dcno').val('').selectpicker('refresh');
$.ajax({
type: "POST",
url: "<?php echo base_url();?>invoice/get_dcno",
data:{id:name}, 
beforeSend :function(){
$("#dcno option:gt(0)").remove(); 
$('#dcno').selectpicker('refresh');
$('#dcno').find("option:eq(0)").html("Please wait..");
$('#dcno').selectpicker('refresh');
},                         
success: function (data) {   
$('#dcno').selectpicker('refresh');       
$('#dcno').find("option:eq(0)").html("");
$('#dcno').selectpicker('refresh');
var obj=jQuery.parseJSON(data);       
$('#dcno').selectpicker('refresh');
$(obj).each(function(){
var option = $('<option />');
option.attr('value', this.value).text(this.label);           
$('#dcno').append(option);
});       
$('#dcno').selectpicker('refresh');
}
});

$.ajax({
type: "POST",
url: "<?php echo base_url();?>invoice/getdc_item",
data:{id:name}, 
beforeSend :function(){
$("#dcnos option:gt(0)").remove(); 
$('#dcnos').find("option:eq(0)").html("Please wait..");

},                         
success: function (datas) {   
$('#dcnos').find("option:eq(0)").html("Select dcnos");
var objs=jQuery.parseJSON(datas);       
$(objs).each(function(){
var options = $('<option />');
options.attr('value', this.value).text(this.value);           
$('#dcnos').append(options);
});       

}
});

if(name !='')
{
$.post('<?php echo base_url();?>invoice/get_supplier',{name:name},function(res){
if(res > 0)
{
$('#cusname_valid').html('<span><font color="green">Available!</span>');
$('#submit').attr('disabled',false);
$('#print').attr('disabled',false);
}
else
{
$('#suppliername').focus();
$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
//set button enable     
}
});
return false;
}
}
if(invoice_type == 'Against PO'){
//alert(name);			
$('#pono').selectpicker();
$('#pono').val('').selectpicker('refresh');
$.ajax({
type: "POST",
url: "<?php echo base_url();?>invoice/get_pono",
data:{id:name}, 
beforeSend :function(){
$("#pono option:gt(0)").remove(); 
$('#pono').selectpicker('refresh');
$('#pono').find("option:eq(0)").html("Please wait..");
$('#pono').selectpicker('refresh');
},                         
success: function (data) {
$('#pono').selectpicker('refresh');       
$('#pono').find("option:eq(0)").html("");
$('#pono').selectpicker('refresh');
var obj=jQuery.parseJSON(data);       
$('#pono').selectpicker('refresh');
$(obj).each(function(){
var option = $('<option />');
option.attr('value', this.value).text(this.label);           
$('#pono').append(option);
});       
$('#pono').selectpicker('refresh');
}
});
}
});
});

$(document).ready(function(){
var invoicetype=$('#invoicetype').val();
var gsttype=$('#gsttype').val();
if(invoicetype=='Direct Invoice')
{
$('#dcno').selectpicker();
$('#dcno').val('').selectpicker('refresh');
$('#pono').selectpicker();
$('#pono').val('').selectpicker('refresh');
$('.againstdc').hide();
$('.againstpo').hide();
$('#dcno').attr('required',false);
$('#pono').attr('required',false);
$.post('<?php echo base_url();?>invoice/getdc_details',{'invoicetype':invoicetype,'gsttype':gsttype},function(data){
$('.dcdetails').html(data);
});
}

$('#invoicetype').change(function(){
var invoicetype=$(this).val();
if(invoicetype=='Direct Invoice')
{
//$('.podetails').hide();
$('.dcdetails').show();
$('.againstdc').hide();
$('.againstpo').hide();
$('#dcno').attr('required',false);
$('#pono').attr('required',false);
var gsttype=$('#gsttype').val();
$.post('<?php echo base_url();?>invoice/getdc_details',{'invoicetype':invoicetype,'gsttype':gsttype},function(data){
$('.dcdetails').html(data);
});
}
else if(invoicetype=='Against DC')
{
	//alert(invoicetype);
$('#dcno').selectpicker();
$('#dcno').val('').selectpicker('refresh');
$('.againstdc').show();
$('.againstpo').hide();
$('#dcno').attr('required',true);
$('#pono').attr('required',false);
var dcno=$('#dcno').val();
var gsttype=$('#gsttype').val();
if(dcno=='null')
{
alert('Please Select DC no');
$('#dcno').focus();
}
else
{
$.post('<?php echo base_url();?>invoice/getdcdetails',{'dcno':dcno,'gsttype':gsttype},function(data){
$('.dcdetails').html(data);
});
}
}
else if(invoicetype == 'Against PO')
{
	//alert(invoicetype);
$('#pono').selectpicker();
$('#pono').val('').selectpicker('refresh');
$('.againstpo').show();
$('.againstdc').hide();
$('#stocks').hide();
$('#pono').attr('required',true);
$('#dcno').attr('required',false);
var pono=$('#pono').val();
var gsttype=$('#gsttype').val();				
if(pono=='null')
{
alert('Please Select PO no');
$('#pono').focus();
}
else
{ 

$.post('<?php echo base_url();?>invoice/getpodetails',{'pono':pono,'gsttype':gsttype},function(data){
$('.dcdetails').html(data);
});
}
}
else
{
$('#dcno').selectpicker();
$('#dcno').val('').selectpicker('refresh');
$('.againstdc').hide();
}
});

$('#dcsearch').click(function(){
var dcno=$('#dcno').val();
var gsttype=$('#gsttype').val();
if(dcno=='null')
{
alert('Please Select DC no');
$('#dcno').focus();
}
else
{
$.post('<?php echo base_url();?>invoice/getdcdetails',{'dcno':dcno,'gsttype':gsttype},function(data){
$('.dcdetails').html(data);
});
}
});
$('#posearch').click(function(){
var pono=$('#pono').val();
var gsttype=$('#gsttype').val();
var customerid=$('#customerid').val();
if(pono=='null')
{
alert('Please Select PO no');
$('#pono').focus();
}
else
{

$.post('<?php echo base_url();?>invoice/getpodetails',{'pono':pono,'gsttype':gsttype,'customerid':customerid},function(data){
$('.dcdetails').html(data);
});
$('#savebuttons').show();
}
});


});
</script>
