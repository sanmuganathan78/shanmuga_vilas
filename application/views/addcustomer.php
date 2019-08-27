<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>
<title>
<?php echo $r->companyname;?>
</title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<style type="text/css">
.forms {}

.forms input {
width: 95%;
}

.forms select {
width: 95%;
}

.uppercase {
text-transform: uppercase;
}
</style>
<div class="content-page">
<!-- Start content -->
<div class="content">
<div class="container">
<!--                                                         <h4 class="page-title">Tax Type</h4>
-->
<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
<div class="alert btn-info alert-micro btn-rounded pastel light dark">
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
<i class="zmdi zmdi-account">&nbsp;Add Party</i> <span style="float: right;"  ><a href="javascript:void()" onclick="upload_excel()" style="color:white;"> <i class="fa fa-plus"></i> Upload Excel</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url();?>assets/Addcustomer.xlsx"  style="color:white;"> <i class="fa fa-download"></i>&nbsp; Sample Excel</a></span>
</header>
<div class="card-box">
<div class="row">
<form class="form-horizontal" role="form" data-parsley-validate novalidate method="post" action="<?php echo base_url();?>customer/insert">
<div class="forms">
<!--ROW 1 -->
<div class="col-lg-4">
<div class="form-group">
<label for="inputStandard">Party Type<span style="color:red;">&nbsp;*</span></label>
<select name="type" id="partytype" required parsley-trigger="change" placeholder="" class="form-control">
<option value="">Select</option>
<option value="Intra customer">Intra Customer ( With in state )</option>
<option value="Inter customer">Inter Customer ( Other State )</option>
<option value="Intra supplier">Intra Supplier ( With in state )</option>
<option value="Inter supplier">Inter Supplier ( Other State )</option>
</select>
<div id="type_valid"></div>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputStandard">Party Name / company Name<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="name" id="customername" class="form-control" required parsley-trigger="change" placeholder="Enter The Party Name" required>
<div id="type_valid"></div>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">E-Mail</label>
<input type="email"   name="email" class="form-control" id="email" placeholder="Enter The E-Mail">
</div>
</div>
<div class="clearfix"></div>

<!--ROW 2 -->
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Mobile No</label>
<input type="text" name="phoneno" class="form-control" id="phoneno" placeholder="Enter The Mobile Number" data-parsley-type="number"  data-parsley-length="[10,12]" >

</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Contact Person</label>
<input type="text" name="contactperson" class="form-control" id="contactperson"   placeholder="Enter the contact person">

</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Address Line 1<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="address1" class="form-control" id="address1" parsley-trigger="change" required placeholder="Enter The Address">

</div>
</div>
<div class="clearfix"></div>

<!--ROW 3 -->
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Address Line 2<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="address2" class="form-control" id="address2" parsley-trigger="change" required placeholder="Enter The Address">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">State<span style="color:red;">&nbsp;*</span></label>
<select  autocomplete="off"  class="form-control decimal"  name="state" id="state">
<option value="">Select state</option>
<?php
$state=$this->db->where('status',1)->get('stateCode')->result_array();
foreach ($state as $rows)
{
echo'<option value="'.$rows['state'].'">'.$rows['state'].'</option>';
}
?>
</select>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">State Code<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="statecode" class="form-control" id="statecode" parsley-trigger="change" readonly required placeholder="Enter State Code">
</div>
</div>
<div class="clearfix"></div>

<!--ROW 4 -->
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">City<span style="color:red;">&nbsp;*</span></label>
<input type="text" parsley-trigger="change" required name="city" class="form-control" id="city" placeholder="Enter The City">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Pincode<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="pincode" class="form-control" onkeypress="return isNumberKey(event)" id="pincode" parsley-trigger="change" required placeholder="Enter The Pincode">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Account Name<span style="color:red;">&nbsp;</span></label>
<input type="text" name="accountname" class="form-control" id="accountname" placeholder="Enter Account Name">
</div>
</div>
<div class="clearfix"></div>

<!--ROW 5 -->
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Print Name<span style="color:red;">&nbsp;</span></label>
<input type="text" name="printname" class="form-control" id="printname" placeholder="Enter Print Name">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">PAN No</label>
<input type="text" name="panno" class="form-control" id="panno" placeholder="Enter The PAN No">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">GSTIN</label>
<input type="text" name="gstno" class="form-control" id="gstno" placeholder="Enter The GSTIN">
<div id="gstno_valid"></div>
</div>
</div>
<div class="clearfix"></div>

<!--ROW 6 -->
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Adhar No</label>
<input type="text" name="adharno" class="form-control" id="adharno" placeholder="Enter The Adhar No">
<div id="adhar_valid"></div>
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Bank Name</label>
<input type="text" name="bankname" class="form-control" id="bankname" placeholder="Enter The Bank Name">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Bank Acc No</label>
<input type="text" name="accountno" class="form-control" id="accountno" placeholder="Enter Bank Account No">
</div>
</div>
<div class="clearfix"></div>

<!--ROW 7 -->
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Cheque Printing Name</label>
<input type="text" name="chequename" class="form-control" id="chequename" placeholder="Enter The Cheque Printing Name">
</div>
</div>
<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Opening Balance</label>
<input type="text" name="openingbalance" class="form-control" id="openingbalance" placeholder="Enter The Opening Balance" value="0.00">
</div>
</div>
<div class="clearfix"></div>

</div>
<br>
<br>
<div class="col-lg-12" align="center">
<button type="submit" id="submit" class="btn btn-primary">Add Party</button>
<button type="reset" class="btn btn-default">Reset</button>
</div>
</form>
</div>
</div>
</section>
</div>
</div>
<!-- end col -->
</div>
</div>
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script>
var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url();?>assets/js/detect.js"></script>
<script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
<!-- Datatables-->
<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
<!-- App js -->
<script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
<script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
<script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$('form').parsley();
});



</script>

<script type="text/javascript">

$('#phoneno').blur(function() {
var phoneno = $('#phoneno').val();
if (phoneno !== '') {
$.post('<?php echo base_url();?>customer/get_phoneno', {
phoneno: phoneno
}, function(res) {
if (res == 'yes') {
alert("already exists");
$('#phoneno').val('');
$('#phoneno').focus();
}
});
}
});

$('#state').click(function() {
var state = $('#state').val();
if (state !== '') {
$.post('<?php echo base_url();?>customer/get_stateCode', {
state: state
}, 
function(data) {

var obj=jQuery.parseJSON(data);
$('#statecode').val(obj.stateCode);
});
}
});

$('#accountname').blur(function(){
var accountname=$(this).val();
if(accountname!="")
{
$('#printname').val(accountname);
}
else
{
//$('#accountname').focus();
}
});


function upload_excel()
{
$('#myModal').modal('show');
}
//
</script>
<script type="text/javascript">
$('#customername').keyup(function() {
var name = $(this).val();
var partytype = $('#partytype').val();
if (partytype == '') {
$('#partytype').focus();
$('#type_valid').html('<div><font color="red">Select the party type</font></div>');
$('#partytype').change(function() {
$('#type_valid').html('');
});
return false
}
if (name != '') {
$.post('<?php echo base_url();?>customer/getname', {
name: name,partytype:partytype
}, function(res) {


if (res > 0) {

$('#customername').focus();
$('#name_valid').html('<span><font color="red">Name already taken!</span>');
$('#submit').attr('disabled', true); //set button enable 
} else {

$('#name_valid').html('<span><font color="green">Available !</span>');
$('#submit').attr('disabled', false); //set button enable     
}
});
return false;
}
});

//   //number..........................
function isNumberKey(evt) {
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}

function onlyAlphabets(evt) {
var charCode;
if (window.event)
charCode = window.event.keyCode; //for IE
else
charCode = evt.which; //for firefox
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


$('.decimal').keyup(function() {
var val = $(this).val();
if (isNaN(val)) {
val = val.replace(/[^a-z^A-Z\.&-]/g, '');
if (val.split('.').length > 2)
val = val.replace(/\.&-+$/, "");
}
$(this).val(val);
});
</script>




<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Upload Party Details In Excel</h4>
</div>
<form action="<?php echo base_url();?>customer/upload_excel" method="post" class="form-horizontal" enctype='multipart/form-data'>
<div class="modal-body form">
<div class="form-body">
<div class="form-group">
<label class="control-label col-md-3">upload</label>
<div class="col-md-9">
<input name="file" id="resume" type="file">
<span id="resume_valid"></span>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="submit" class="btn btn-primary reg">Save</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>

