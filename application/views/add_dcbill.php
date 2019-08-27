<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>
<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
<link rel="stylesheet" href="<?php echo base_url();?>assets/multiselect/css/bootstrap-select.css">

<style type="text/css">
.forms{ }
.forms input{ width: 95%; }
.uppercase {
text-transform: uppercase;
}
.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
width: 89%;
}
.againstinward
{
display: none;
}
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
<i class="zmdi zmdi-assignment-o">&nbsp;Dc (<?php echo $cusno;?>)</i>
</header>
<div class="card-box" style="min-height: 500px;">
<div class="row">
<form class="form-horizontal" id="dc_forms" data-parsley-validate novalidate  method="post" target="_blank" onsubmit="setTimeout(function () { location.href = '<?php echo base_url();?>dcbill'; },2000)"  action="<?php echo base_url();?>dcbill/insert" >
<div class="form-group ">
<div class="col-md-8 forms">
<input type="hidden" required class="form-control" name="dcno" id="dcno" value="<?php echo $cusno;?>">
<!--<input type="hidden" name="dctype" id="dctype" value="Direct DC" />-->
<div class="col-md-3">
<div class="form-group">
<label class="">Dc Type</label>
<select name="dctype" id="dctype" required class="form-control">
<option value="Direct DC">Direct DC</option>
<option value="Against Inward">Against Inward</option>
</select>
</div>
</div>
<div class="col-md-3" style="margin-left:5px;">
<div class="form-group">
<label >DC Date</label>
<input type="text" required class="form-control datepicker-autoclose" name="dcdate" id="dcdate" value="<?php echo date('d-m-Y');?>">
</div>
</div>

<div class="col-md-5">
<div class="form-group">
<label>Customer  Name</label>
<input type="text" parsley-trigger="change" required class="form-control" name="cusname" id="cusname" value="">
<input type="hidden" name="customerId" id="customerId" value="" />
<div id="cusname_valid" style="position: absolute;">
</div>
</div>
</div>
<div class="col-md-3">
<div class="form-group">
<label>Dispatch Through</label>
<input type="text" class="form-control" name="dispatchthrough" id="dispatchthrough" value="" style="width:148px;">
<div id="invoiceno_valid"></div>
</div>
</div>

<div class="col-md-8 againstinward">
<div class="form-group">
<label>DC Details</label>
<select name="dcnos" multiple="multiple" id="dcnos" class="form-control">
</select>
</div>
</div>
<div class="clearfix"></div>


<div class="col-md-9 againstinward">
<div class="form-group">
<label>Inward No</label>
<div class="clearfix"></div>
<select class="selectpicker" required name="inwardno[]" multiple data-live-search="true" id="inwardno" data-live-search-placeholder="Search"  data-actions-box="true">
</select>
<button class="btn" type="button" id="inwardsearch"><i class="fa fa-search" aria-hidden="true"></i></button>

</div>
</div>
</div>
<div class="col-md-4">
<div class="form-group">
<label>Address</label>
<textarea type="text" class="form-control" name="address" id="address" parsley-trigger="change" required  rows="3"></textarea>
</div>
</div>
</div>
<div class="clearfix"></div>

<div class="inwarddetails"></div>
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
</script>

<script>
$('.colorpicker-default').colorpicker({ format: 'hex' });
$('.colorpicker-rgba').colorpicker();
// Date Picker
jQuery('#datepicker').datepicker();
jQuery('.datepicker-autoclose').datepicker({ autoclose: true,todayHighlight: true });
</script>


<script type="text/javascript">
$(document).ready(function(){
$( "#cusname" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>invoice/autocomplete_customername",
data: { keyword: $("#cusname").val()},
dataType: "json",
type: "POST",
success: function(data){ 
response(data);
}            
});
}, select: function (event, ui) {
$("#cusname").val(ui.item.label); 
$('#address').val(ui.item.address); 
//$('#tinno').val(ui.item.tinno); 
//$('#cstno').val(ui.item.cstno); 
$('#customerId').val(ui.item.customerid); 
var name = $('#cusname').val();
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
/*$( "#cusname" ).autocomplete({
source: function(request, response)
{
$.ajax({ 
url: "<?php echo base_url();?>dcbill/autocomplete_name",
data: { keyword: $("#cusname").val()},
dataType: "json",
type: "POST",
success: function(data){              
response(data);
}    
});
}, 
});*/
$('#cusname').blur(function(){
$('#inwardno').selectpicker();
$('#inwardno').val('').selectpicker('refresh');
var cusname=$('#cusname').val();
$.post('<?php echo base_url();?>dcbill/get_name',{cusname:cusname},function(res){
var obj=jQuery.parseJSON(res);
$('#address').val(obj.address);
});

$.ajax({
type: "POST",
url: "<?php echo base_url();?>dcbill/get_inwardno",
data:{id:cusname}, 
beforeSend :function(){
$("#inwardno option:gt(0)").remove(); 
$('#inwardno').selectpicker('refresh');
$('#inwardno').find("option:eq(0)").html("Please wait..");
$('#inwardno').selectpicker('refresh');
},                         
success: function (data) {   
$('#inwardno').selectpicker('refresh');       
$('#inwardno').find("option:eq(0)").html("");
$('#inwardno').selectpicker('refresh');
var obj=jQuery.parseJSON(data);       
$('#inwardno').selectpicker('refresh');
$(obj).each(function(){
var option = $('<option />');
option.attr('value', this.value).text(this.label);           
$('#inwardno').append(option);
});       
$('#inwardno').selectpicker('refresh');
}
});

$.ajax({
type: "POST",
url: "<?php echo base_url();?>dcbill/getdc_item",
data:{id:cusname}, 
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

if(cusname !='')
{
$.post('<?php echo base_url();?>dcbill/check_cusname',{cusname:cusname},function(res){
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
}
});
return false;
}
});  


var dctype=$('#dctype').val();
if(dctype=='Direct DC')
{
$('#inwardno').selectpicker();
$('#inwardno').val('').selectpicker('refresh');
$('.againstinward').hide();
$('#inwardno').attr('required',false);
$.post('<?php echo base_url();?>dcbill/getinward_details',{'dctype':dctype},function(data){
$('.inwarddetails').html(data);
});
}
else if(dctype=='Against Inward')
{
$('#inwardno').selectpicker();
$('#inwardno').val('').selectpicker('refresh');
$('.againstinward').show();
$('#inwardno').attr('required',true);
var inwardno=$('#inwardno').val();
if(inwardno=='null')
{
alert('Please Select inward no');
$('#inwardno').focus();
}
else
{
$.post('<?php echo base_url();?>dcbill/getinwarddetails',{'inwardno':inwardno},function(data){
$('.inwarddetails').html(data);
});
}
}
else
{
$('#inwardno').selectpicker();
$('#inwardno').val('').selectpicker('refresh');
$('.againstinward').hide();
}

$('#dctype').change(function(){
var dctype=$(this).val();
if(dctype=='Direct DC')
{
$('#inwardno').selectpicker();
$('#inwardno').val('').selectpicker('refresh');
$('.againstinward').hide();
$('#inwardno').attr('required',false);
$.post('<?php echo base_url();?>dcbill/getinward_details',{'dctype':dctype},function(data){
$('.inwarddetails').html(data);
});
}
else if(dctype=='Against Inward')
{
$('#inwardno').selectpicker();
$('#inwardno').val('').selectpicker('refresh');
$('.againstinward').show();
$('#inwardno').attr('required',true);
var inwardno=$('#inwardno').val();
if(inwardno=='null')
{
alert('Please Select inward no');
$('#inwardno').focus();
}
else
{
$.post('<?php echo base_url();?>dcbill/getinwarddetails',{'inwardno':inwardno},function(data){
$('.inwarddetails').html(data);
});
}
}
else
{
$('#inwardno').selectpicker();
$('#inwardno').val('').selectpicker('refresh');
$('.againstinward').hide();
}
});

$('#inwardsearch').click(function(){
var inwardno=$('#inwardno').val();
if(inwardno=='null')
{
alert('Please Select inward no');
$('#inwardno').focus();
}
else
{
$.post('<?php echo base_url();?>dcbill/getinwarddetails',{'inwardno':inwardno},function(data){
$('.inwarddetails').html(data);
});
}
});
});
</script>

<script type="text/javascript">
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
})

</script>
