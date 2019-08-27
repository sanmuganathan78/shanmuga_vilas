<!-- DataTables -->
<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>
<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<style type="text/css">
.forms{ }
.forms input{ width: 95%; }
.forms select{ width: 95%; }

.uppercase {
text-transform: uppercase;
}
.panel-heading
{
margin-top: 50px;
}
</style>

<div class="content-page">
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
<div class="col-sm-12"></div>
</div>

<div class="row">
<div class="col-sm-12">
<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
<header class="panel-heading" style="color:rgb(255, 255, 255)">
<i class="zmdi zmdi-account">&nbsp;Party Reports</i>
</header>
<div class="card-box table-responsive">
<div class="dropdown pull-right"><a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false"></a></div>
<form method="post" action="<?php echo base_url();?>customer/search" name="searchForm">
<table>
<td style="width: 02px;"><!--From Date--></td>
<td><input type="hidden" class="form-control  datepicker-autoclose" name="fromdate" id="datepicker-autoclose" style="font-size:16px;width:143px;" value="<?php /*echo date('d-m-Y'); */?>"></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;<!--To Date--> &nbsp;&nbsp;</td>                 
<td><input type="hidden" class="form-control datepicker-autoclose" name="todate" id="datepicker2" style="font-size:16px;width:143px;" value="<?php /*echo date('d-m-Y');*/ ?>"></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;Party Type &nbsp;&nbsp;</td>
<td>    
<select name="type" id="partytype" placeholder="" class="form-control">
<option value="">Select</option>
<option value="Intra customer">Intra Customer ( With in state )</option>
<option value="Inter customer">Inter Customer ( Other State )</option>
<option value="Intra supplier">Intra Supplier ( With in state )</option>
<option value="Inter supplier">Inter Supplier ( Other State )</option>
</select>
<script>document.searchForm.type.value='<?php echo $this->input->post('type');?>';</script>
</td>
<td> &nbsp;&nbsp; &nbsp;&nbsp;<input type="submit" class="btn btn-info" value="Search"></td>
</table>
</form>
<br>
<table id="datatable" class="table table-striped table-bordered">
<thead>
<tr>
<th>S.No</th>
<th>Date</th>
<th>Type</th>
<th>Company Name</th>
<th>Contact Person</th>
<th>Mobile No</th>
<th>Action</th>
</tr>
</thead>
<tbody>
<?php 
$i=1;
foreach($customer as $u)
{?>
<tr>
<td><?php echo $i++;?></td>
<td><?php echo date('d-m-Y',strtotime($u['date']));?></td>
<td><?php echo $u['type'];?></td>
<td><?php echo $u['name'];?></td>
<td><?php echo $u['contactperson'];?></td>
<td><?php echo $u['phoneno'];?></td>
<td align="">
<div class="btn-group">
<button type="button" class="btn btn-info dropdown-toggle waves-effect waves-light" data-toggle="dropdown" aria-expanded="false">Manage</button>
<ul class="dropdown-menu" role="menu" style="background: #2196F3 none repeat scroll 0% 0%;width:14px;min-width:100%">
<li> <a href="#view<?php echo $u['id'];?>" data-toggle="modal"  style="color:white; font-weight: bold; background-color: #2196F3">View</a></li>
<li><a href="#edit<?php echo $u['id'];?>" data-toggle="modal" data-overlayspeed="100" data-overlaycolor="#36404a" style="color:white; font-weight: bold; background-color: #2196F3" data-toggle="modal">Edit</a></li>
<li> <a href="#delete<?php echo $u['id'];?>" data-toggle="modal"  style="color:white; font-weight: bold;background-color: #2196F3">Delete</a></li>
</ul>   
</div>
</td>
</tr>
<?php } ?>
</tbody>
</table>
</div>
</section>
</div>
</div>
</div>




<?php foreach($customer as $r) {?>
<div id="delete<?php echo $r['id'];?>" class="modal fade" >
<div class="modal-dialog" style="width:40%">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button><h4 class="modal-title">Delete Party</h4>
</div>
<div class="modal-text">
<br>
<p align="center">Are you sure to delete this data?</p>
</div>
<div class="modal-body">
<div class="row">
<form name="form" action="<?php echo base_url();?>customer/delete" method="post" id="form1">
<input type="hidden" value="<?php echo $r['id'];?>" name="id">
<div class="col-offset-4" align="center"></div>
<div align="center">
<button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
<button id="dialogCancel" data-dismiss="modal" class="btn btn-default waves-effect">Cancel</button>
</div>
</form>
</div>
</div>
</div>
</div> 
</div>
<?php }?>

<?php foreach($customer as $v) {?>
<div id="view<?php echo $v['id'];?>" class="modal fade" >
<div class="modal-dialog" style="width:60%">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title">View Party</h4>
</div>

<div class="modal-body">
<div class="row">
<form class="form-horizontal" role="form" data-parsley-validate novalidate method="post" action="<?php echo base_url();?>customer/update">
<div class="forms">
<div class="col-lg-4">      
<div class="form-group">
<label for="inputStandard">Party  Type<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="name" id="name" class="form-control decimal"  placeholder="Enter The Party Name" value="<?php echo $v['type'];?>" disabled>
<div id="type_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputStandard">Party Name / company Name<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="name" id="name" class="form-control decimal"  placeholder="Enter The Party Name" value="<?php echo $v['name'];?>" disabled>
<div id="name_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">E-Mail<span style="color:red;">&nbsp;*</span></label>
<input type="email" name="email" class="form-control"  id="email" placeholder="Enter The E-Mail" onblur="validateEmail(this);" value="<?php echo $v['email'];?>" disabled>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Mobile No<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="phoneno" class="form-control" id="alloptions" placeholder="Enter The Mobile Number" maxlength="10" onkeypress="return isNumberKey(event)" value="<?php echo $v['phoneno'];?>" disabled>
<div id="phoneno_valid"></div>
<div id="phonenos_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Contact Person<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="contactperson"  class="form-control" id="contactperson" placeholder="Enter the contact person"  onkeypress="return onlyAlphabets(event)"  value="<?php echo $v['contactperson'];?>" disabled>
<div id="contactperson_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Address Line1<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="address1" class="form-control"  id="address1" placeholder="Enter The Address" value="<?php echo $v['address1'];?>" disabled>
<div id="address1_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Address Line2<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="address2" class="form-control"  id="address2" placeholder="Enter The Address" value="<?php echo $v['address2'];?>" disabled>
<div id="address2_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">State</label>
<input type="text" name="state"  class="form-control" id="state" placeholder="Enter The State" onkeypress="return onlyAlphabets(event)" value="<?php echo $v['state'];?>" disabled>
<div id="location_valid"></div>
</div>
</div> 

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">State Code<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="statecode" value="<?php echo $v['statecode'];?>" class="form-control" id="statecode" required placeholder="Enter State Code" disabled>
<div id="statecode_valid" style="position:absolute;"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">City</label>
<input type="text" name="city" value="<?php echo $v['city'];?>" class="form-control"  parsley-trigger="change" required id="city" placeholder="Enter The City" disabled>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Pincode<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="pincode" class="form-control" onkeypress="return isNumberKey(event)" id="pincode" placeholder="Enter The Pincode" value="<?php echo $v['pincode'];?>" disabled>
</div> 
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Account Name<span style="color:red;">&nbsp;</span></label>
<input type="text" name="accountname" value="<?php echo $v['accountname'];?>" class="form-control" id="accountname" placeholder="Enter Account Name" disabled>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Print Name<span style="color:red;">&nbsp;</span></label>
<input type="text" name="printname" value="<?php echo $v['printname'];?>" class="form-control" id="printname" placeholder="Enter Print Name" disabled>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword" >PAN No</label>
<input type="text" name="panno" class="form-control"  id="panno" placeholder="Enter The PAN No" value="<?php echo $v['panno'];?>" disabled>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">GST No</label>
<input type="text" name="gstno" class="form-control" value="<?php echo $v['gstno'];?>" id="gstno" placeholder="Enter The GST No" disabled>
<div id="gstno_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Adhar No</label>
<input type="text" name="adharno" class="form-control" value="<?php echo $v['adharno'];?>" id="adharno" placeholder="Enter The Adhar No" disabled>
<div id="adhar_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Bank Name</label>
<input type="text" name="bankname" class="form-control" value="<?php echo $v['bankname'];?>" id="bankname" placeholder="Enter The Bank Name" disabled>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Bank Acc No</label>
<input type="text" name="accountno" class="form-control" value="<?php echo $v['accountno'];?>" id="accountno" placeholder="Enter Bank Account No" disabled>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Cheque Printing Name</label>
<input type="text" name="chequename" class="form-control" value="<?php echo $v['chequeno'];?>" id="chequename" placeholder="Enter The Cheque Printing Name" disabled>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Opening Balance</label>
<input type="text" name="openingbalance" value="<?php echo $v['openingbal'];?>" class="form-control" id="openingbalance" placeholder="Enter The Opening Balance"  disabled>
</div>
</div>
</div>
<div class="clearfix">&nbsp;</div>
<div class="col-sm-offset-5">
<button type="reset"   id="submit" class="btn btn-primary" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>
</div> </div>
<?php }?>




<!-- EDIT SECTION -->
<?php foreach($customer as $s) {?>
<div id="edit<?php echo $s['id'];?>" class="modal fade" >
<div class="modal-dialog" style="width:60%">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title"> Edit Party</h4>
</div>

<div class="modal-body">
<div class="row">
<!-- here -->
<form class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>customer/update">
<div class="forms">
<div class="col-lg-4">
<div class="form-group">
<label for="inputStandard">Party Type<span style="color:red;">&nbsp;*</span></label>
<select name="type" id="partytype" required parsley-trigger="change" placeholder="" class="form-control">
<option value="">Select</option>
<option value="Intra customer" <?php if($s['type']=='Intra customer')echo'selected';?>>Intra Customer ( With in state )</option>
<option value="Inter customer" <?php if($s['type']=='Inter customer')echo'selected';?>>Inter Customer ( Other State )</option>
<option value="Intra supplier" <?php if($s['type']=='Intra supplier')echo'selected';?>>Intra Supplier ( With in state )</option>
<option value="Inter supplier" <?php if($s['type']=='Inter supplier')echo'selected';?>>Inter Supplier ( Other State )</option>
</select>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputStandard">Party Name / company Name<span style="color:red;">&nbsp;*</span></label>
<input type="text" required parsley-trigger="change" name="name" id="name" class="form-control decimal"  placeholder="Enter The Party Name" value="<?php echo $s['name'];?>"><input type="hidden" name="oldName" value="<?php echo $s['name'];?>" />
<input type="hidden" name="id" value="<?php echo $s['id'];?>">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">E-Mail</label>
<input  type="text"  name="email" class="form-control"  id="email" placeholder="Enter The E-Mail"  value="<?php echo $s['email'];?>" >
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Mobile No</label>
<input type="text" name="phoneno"     class="form-control" id="alloptions" placeholder="Enter The Mobile Number" data-parsley-type="number" parsley-trigger="change" data-parsley-length="[10,12]"  value="<?php echo $s['phoneno'];?>" >
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Contact Person</label>
<input type="text" name="contactperson"  class="form-control" id="contactperson" placeholder="Enter the contact person"     value="<?php echo $s['contactperson'];?>">
<div id="contactperson_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Address Line1<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="address1" class="form-control"  id="address1" placeholder="Enter The Address"  parsley-trigger="change" required value="<?php echo $s['address1'];?>">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Address Line2<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="address2" class="form-control"  id="address2" placeholder="Enter The Address"  parsley-trigger="change" required value="<?php echo $s['address2'];?>">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">State<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="state"  class="form-control" id="state" placeholder="Enter The State"  parsley-trigger="change" required value="<?php echo $s['state'];?>">
</div>
</div> 

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">State Code<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="statecode"  value="<?php echo $s['statecode'];?>" class="form-control" id="statecode"  parsley-trigger="change" required placeholder="Enter State Code">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">City</label>
<input type="text" name="city" value="<?php echo $s['city'];?>" class="form-control"  parsley-trigger="change" required id="city" placeholder="Enter The City">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Pincode<span style="color:red;">&nbsp;*</span></label>
<input type="text" name="pincode" class="form-control" onkeypress="return isNumberKey(event)"  id="pincode"  parsley-trigger="change" required placeholder="Enter The Pincode" value="<?php echo $s['pincode'];?>">
</div> 
</div> 

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Account Name<span style="color:red;">&nbsp;</span></label>
<input type="text" value="<?php echo $s['accountname'];?>" name="accountname" class="form-control" id="accountname" placeholder="Enter Account Name">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Print Name<span style="color:red;">&nbsp;</span></label>
<input type="text" value="<?php echo $s['printname'];?>" name="printname" class="form-control" id="printname" placeholder="Enter Print Name">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword" >PAN No</label>
<input type="text" name="panno" class="form-control"  id="panno" placeholder="Enter The PAN No" value="<?php echo $s['panno'];?>">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">GST No</label>
<input type="text" name="gstno" class="form-control" value="<?php echo $s['gstno'];?>" id="gstno" placeholder="Enter The GST No">
<div id="gstno_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Adhar No</label>
<input type="text" name="adharno" class="form-control" value="<?php echo $s['adharno'];?>" id="adharno" placeholder="Enter The Adhar No">
<div id="adhar_valid"></div>
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Bank Name</label>
<input type="text" name="bankname" class="form-control" value="<?php echo $s['bankname'];?>" id="bankname" placeholder="Enter The Bank Name">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Bank Acc No</label>
<input type="text" name="accountno" class="form-control" value="<?php echo $s['accountno'];?>" id="accountno" placeholder="Enter Bank Account No">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Cheque Printing Name</label>
<input type="text" name="chequename" class="form-control"  value="<?php echo $s['chequeno'];?>" id="chequename" placeholder="Enter The Cheque Printing Name">
</div>
</div>

<div class="col-lg-4">
<div class="form-group">
<label for="inputPassword">Opening Balance</label>
<input type="text" name="openingbalance" value="<?php echo $s['openingbal'];?>" class="form-control" id="openingbalance" placeholder="Enter The Opening Balance" value="0.00">
</div>
</div>
<div class="clearfix">&nbsp;</div>
<div class="col-sm-offset-4">
<button  class="btn btn-info" id="submit" style="margin-top: 50px;">Update</button>
<button  class="btn btn-default" style="margin-top: 50px;" data-dismiss="modal" id="submit">Cancel</button>
</div>
</div>
</form>
<!-- end of here -->
</div>
</div>
</div>
</div> 
</div>
<?php }?>

<!-- END OF EDIT SECTION -->
<?php if($_POST) {?>
<form name="form" method="post" action="<?php echo base_url();?>customer/reports" target="_blank" >
<table>
<tr>
<td><input type="hidden" name="fromdate" class="form-control" 
value="<?php if($this->input->post('fromdate')){echo $this->input->post('fromdate');}?>"></td>
<td><input type="hidden" name="todate" class="form-control" value="<?php if($this->input->post('todate')){echo $this->input->post('todate');}?>">
<input type="hidden" name="type" class="form-control" 
value="<?php if($this->input->post('type')){echo $this->input->post('type');}?>">
</td>


<td><input type="submit" class="btn btn-info" name="submit" value="Print Reports" style="margin-left:400px;"></td>
</tr>
</table>
</form>
<?php }?>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>

<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

<script type="text/javascript">
$(document).ready(function() {
$('form').parsley();
});



</script>

<script>

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
$('.colorpicker-default').colorpicker({
format: 'hex'
});
$('.colorpicker-rgba').colorpicker();

// Date Picker
jQuery('#datepicker').datepicker();
jQuery('.datepicker-autoclose').datepicker({
autoclose: true,
todayHighlight: true
});
</script>