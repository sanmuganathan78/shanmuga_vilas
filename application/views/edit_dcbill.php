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
.uppercase { 	text-transform: uppercase;	}
.bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) { 	width: 89%;	}
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
<?php
foreach ($result as $row) 
{
$dcno=$row['dcno'];
}
?>
<header class="panel-heading" style="color:rgb(255, 255, 255)">
<i class="zmdi zmdi-assignment-o">&nbsp;Edit Dc (<?php echo $dcno;?>)</i>
</header>
<div class="card-box" style="min-height: 500px;">
<div class="row">
<?php foreach ($result as $row) { ?>
<form class="form-horizontal" id="dc_forms" data-parsley-validate novalidate  method="post"   action="<?php echo base_url();?>dcbill/update" >
<div class="form-group ">
<div class="col-md-8 forms">
<div class="col-md-2">
<div class="form-group">
<label class="">Dc Type</label>
<input type="hidden" required class="form-control" name="id" id="id" value="<?php echo $row['id'];?>">
<input type="hidden" required class="form-control" name="dcno" id="dcno" value="<?php echo $row['dcno'];?>">
<input type="text" required class="form-control" name="dctype" id="dctype" value="<?php echo $row['dctype'];?>" readonly>
</div>
</div>

<div class="col-md-2"> 
<div class="form-group">
<label >DC Date</label>
<input type="text" required class="form-control datepicker-autoclose" name="dcdate" id="dcdate" value="<?php echo date('d-m-Y',strtotime($row['dcdate']));?>">
</div>
</div>

<?php 
if($row['dctype']=='Against Inward')
{
$readonly='readonly';
}
else
{
$readonly='';
}
?>

<div class="col-md-6">
<div class="form-group">
<label>Customer  Name</label>
<input type="text" parsley-trigger="change" required readonly class="form-control" name="cusname" <?php echo $readonly;?> id="cusname" value="<?php echo $row['cusname'];?>">
<input type="hidden" name="customerId" id="customerId" value="<?php echo $row['customerId'];?>" />
<div id="cusname_valid" style="position: absolute;"></div>
</div>
</div>

<div class="clearfix"></div>

<div class="col-md-3">
<div class="form-group">
<label>Dispatch Through</label>
<input type="text" class="form-control" name="dispatchthrough" id="dispatchthrough" value="<?php echo $row['dispatchthrough'];?>" style="width:148px;">
<div id="invoiceno_valid"></div>
</div>
</div>

<?php 
if($row['dctype']=='Against Inward')
{
?>
<div class="col-md-9 againstinward">
<div class="form-group">
<label>Inward No</label>
<div class="clearfix"></div>
<input type="hidden" class="form-control" readonly name="inwardno" id="inwardno" value="<?php echo $row['inwardno'];?>">
<input type="text" class="form-control" readonly  value="<?php echo str_replace('||', ',', $row['inwardno']);?>">
</div>
</div>
<?php } ?>
</div>

<div class="col-md-4">
<div class="form-group">
<label>Address</label>
<textarea type="text" class="form-control" name="address" id="address" parsley-trigger="change" required  rows="3"><?php echo $row['address'];?></textarea>
</div>
</div>
</div>
<div class="clearfix"></div>
<div class="inwarddetails"></div>
</form>
<?php } ?>
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

var dctype=$('#dctype').val();
if(dctype=='Direct DC')
{
var id=$('#id').val();
$.post('<?php echo base_url();?>dcbill/geteditinward_details',{'dctype':dctype,'id':id},function(data){
$('.inwarddetails').html(data);
});
}
else if(dctype=='Against Inward')
{
var id=$('#id').val();
$.post('<?php echo base_url();?>dcbill/geteditinwarddetails',{'id':id},function(data){
$('.inwarddetails').html(data);
});
}
else
{
}

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
