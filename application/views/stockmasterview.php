<?php 
$data=$this->db->get('profile')->result();
foreach($data as $r)
?>

<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
<style type="text/css">
.forms{ }
.forms input{ width: 95%; }

.uppercase {
text-transform: uppercase;
}
.well { background-color: #dbdfe0 !important; border: 1px solid #b7b9b9; }
</style>
<div class="content-page">
<div class="content">
<div class="container"> 
<?php 
$msg = $this->session->flashdata('msg'); 
if((isset($msg)) && (!empty($msg))) { ?>
<div class="alert btn-primary alert-micro btn-rounded pastel light dark" >
<a href="#" class="close" data-dismiss="alert">&times;</a>
<?php print_r($msg); ?>
</div>
<?php } ?>


<?php 
$msg = $this->session->flashdata('msg1'); 
if((isset($msg)) && (!empty($msg))) { ?>
<div class="alert alert-micro btn-rounded alert-danger">
<a href="#" class="close" data-dismiss="alert">&times;</a>
<?php print_r($msg); ?>
</div>
<?php } ?>

<div class="row">
<div class="col-sm-12">
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-reorder"></i>Stock Reports
</div>
<div class="tools">
<a href="javascript:void();" data-toggle="collapse" data-target="#form_div" style="color:white;"> <i class="fa fa-plus"></i> Add Stock</a>&nbsp;
<a href="<?php echo base_url();?>item/download"  style="color:white;"> <i class="fa fa-download"></i>&nbsp; Download Item List Excel</a>
</div>
</div>
<div class="portlet-body form">
<!-- BEGIN FORM-->
<div class="well collapse <?php //if ($id != ""){ echo "in";} ?>" id="form_div">
<form class="horizontal-form" id="form" method="post" action="<?php echo base_url();?>stockmaster/insert">
<div class="form-body">
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Date</label>
<input type="text" class="form-control datepicker-autoclose" required name="date" value="<?php echo date('d-m-Y');?>" >
</div>
</div>
<!--/span-->
<div class="col-md-3">
<div class="form-group">
<label class="control-label">HSN Code</label>
<input type="text" class="form-control" name="hsnno" autocomplete="off" id="hsnno" value="" required>
<div id="hsnno_valid" -style="position:fixed;"></div>
</div>
</div>
<!--/span-->
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Item  Name</label>
<input type="text" class="form-control" name="itemname" autocomplete="off" required id="itemname" value="" >
<div id="itemname_valid"></div>
</div>
</div>
<!--/span-->
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Quantity</label>
<input type="text" autocomplete="off" autocomplete="off" required class="form-control decimal" name="qty" id="qty">
<div id="qty_valid"></div>
</div>
</div>
<!--/span-->
</div>
<!--/row-->

</div>
<div class="form-actions col-sm-offset-4">
<button  class="btn btn-primary" id="submit" type="submit">Add Stock</button>
<input type="button" class="btn btn-default" value="Cancel" data-toggle="collapse" data-target="#form_div" />
</div>
</form>
<!-- END FORM-->
</div>
<div class="row">&nbsp;</div>
<div class="row">&nbsp;</div>
<div class="card-box table-responsive">
<!-- START HERE-->
<form method="post" id="form-filter" action="<?php echo base_url();?>stockmaster/search">
<table>
<td style="width: 88px;">From Date</td>
<td><input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="sfromdate" style="font-size:16px;width:143px;" value="<?php /*echo date('d-m-Y');*/ ?>"></td>
<td>&nbsp;&nbsp;&nbsp;&nbsp;To Date &nbsp;&nbsp;</td>
<td><input type="text" class="form-control datepicker-autoclose" name="todate" id="stodate" style="font-size:16px;width:143px;" value="<?php /*echo date('d-m-Y');*/ ?>"></td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td>
<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
<button type="button" id="btn-reset" class="btn btn-default">Reset</button>
</td>
</table>
</form>
<br>
<table id="s" class="table table-striped table-bordered">
<thead>
<tr>
<th>S.No</th>
<th>Date</th>
<!-- <th> HSN Code</th> -->
<th>Item Name</th>
<th>Rate</th>
<!-- <th>SGST</th>
<th>CGST</th>
<th>IGST</th> -->
<th>Last Updated</th>
<th>Qty/KG</th>
</tr>
</thead>
<tbody>

</tbody>
</table>
<?php //if($_POST) {?>
<form name="form" method="post" action="<?php echo base_url();?>stockmaster/reports" target="_blank" >
<table>
<tr>
<td><input type="hidden" name="fromdate" id="pfromdate" class="form-control" value="<?php if($this->input->post('fromdate')){echo $this->input->post('fromdate');}?>"></td>
<td><input type="hidden" name="todate" id="ptodate" class="form-control" value="<?php if($this->input->post('todate')){echo $this->input->post('todate');}?>"></td>

<!-- <td><input type="submit" class="btn btn-info" name="submit" value="Print Reports" style="margin-left:400px;"> <button id="download" class="btn btn-primary" ><i class="fa fa-bar-chart-o"></i> Download as Excel</button></td> -->
<div align="center">
             <button id="print" class="btn btn-info" value="Print">Print</button>
             <!-- <button id="download" class="btn btn-primary" ><i class="fa fa-bar-chart-o"></i> Download as Excel</button> -->

        </div>
</tr>
</table>
</form>
<?php // }?>
<!-- END HERE -->
</div>
</div>
</div>
</div>
</div>

</div>			
</div>			
</div>			
<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
var save_method; //for save method string
var table;
$(document).ready(function() {
jQuery('.datepicker-autoclose').datepicker({ autoclose: true,todayHighlight: true });
$('#submit').click(function(){
var itemcode=$('#itemcode').val();
var itemname=$('#itemname').val();
var qty=$('#qty').val();
var hsnno=$('#hsnno').val();
if(itemcode=='')
{
$('#itemcode').focus();
$('#itemcode_valid').html('<div><font color="red">Enter the Item Code</font></div>');
$('#itemcode').keyup(function(){
$('#itemcode_valid').html('');
});
return false
}

if(hsnno=='')
{
$('#hsnno').focus();
$('#hsnno_valid').html('<div><font color="red">Enter the hsn no</font></div>');
$('#hsnno').keyup(function(){
$('#hsnno_valid').html('');
});
return false
}

if(itemname=='')
{
$('#itemname').focus();
$('#itemname_valid').html('<div><font color="red">Enter the Item name</font></div>');
$('#itemname').keyup(function(){
$('#itemname_valid').html('');
});
return false
}

if(qty=='')
{
$('#qty').focus();
$('#qty_valid').html('<div><font color="red">Enter the qty</font></div>');
$('#qty').keyup(function(){
$('#qty_valid').html('');
});
return false
}

});

//datatables
table = $('#s').DataTable({ 
"processing": true, //Feature control the processing indicator.
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.
// Load data for the table's content from an Ajax source
"ajax": {
"url": "<?php echo site_url('stockmaster/ajax_list')?>",
"type": "POST",
"data": function ( data ) {
data.fromdate = $('#sfromdate').val();
data.todate = $('#stodate').val();
}
},
//Set column definition initialisation properties.
"columnDefs": [
{ 
"targets": [ -1 ], //last column
"orderable": false, //set not orderable
},
],
});

$('#btn-filter').click(function(){ //button filter event click
$("#pfromdate").val($("#sfromdate").val());
$("#ptodate").val($("#stodate").val());
table.ajax.reload(null,false);  //just reload table
});
$('#btn-reset').click(function(){ //button reset event click
$("#pfromdate").val('');
$("#ptodate").val('');
$('#form-filter')[0].reset();
table.ajax.reload(null,false);  //just reload table
});
});

function reload_table()
{
table.ajax.reload(null,false); //reload datatable ajax 
}

/*function delete_person(id)
{
if(confirm('Are you sure delete this details?'))
{
// ajax delete data to database
$.ajax({
url : "<?php echo site_url('stock/ajax_delete')?>/"+id,
type: "POST",
dataType: "JSON",
success: function(data)
{
//if success reload ajax table
$('#modal_form').modal('hide');
reload_table();
},
error: function (jqXHR, textStatus, errorThrown)
{
alert('Error deleting data');
}
});
}
}
*/
</script>

<script type="text/javascript">

$('form').submit(function(){
//$(this).find(':submit').attr('disabled','disabled');
});
//number..........................
function isNumberKey(evt)
{
var charCode = (evt.which) ? evt.which : event.keyCode
if (charCode > 31 && (charCode < 48 || charCode > 57))
return false;
return true;
}

//alphabets....................
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
val = val.replace(/[^0-9\.]/g,'');
if(val.split('.').length>2) 
val =val.replace(/\.+$/,"");
}
$(this).val(val); 
});
</script>

<script type="text/javascript">

$( "#itemname" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>stockmaster/autocomplete_itemname",
data: { keyword: $("#itemname").val()},
dataType: "json",
type: "POST",
success: function(data){              
response(data);
if(data=='')
{
$('#itemname').focus();
$('#itemname').val('');
$('#itemname_valid').html('<div><font color="red">Invalid Item name</font></div>');
$('#itemname').keyup(function(){
$('#itemname_valid').html('');
});
return false
}
}    
});
},
});

$( "#hsnno" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>stockmaster/autocomplete_itemcode",
data: { keyword: $("#hsnno").val()},
dataType: "json",
type: "POST",
success: function(data){              
response(data);
if(data=='')
{
$('#hsnno').focus();
$('#hsnno').val('');
$('#hsnno_valid').html('<div><font color="red">Invalid Item code</font></div>');
$('#hsnno').keyup(function(){
$('#hsnno_valid').html('');
});
return false
}
}    
});
},
});

 $('#download').click(function(){
    var fromdate = $('#fromdate').val();
    var todate = $('#todate').val();
   
    $.post('<?php echo base_url();?>stockmaster/excel_download',{'fromdate':fromdate,'todate':todate},function(data){
      window.open('<?php echo base_url();?>stockmaster/download', '_blank');
    });
  });

$('#itemname').blur(function(){
var itemname=$('#itemname').val();
$.post('<?php echo base_url();?>stockmaster/get_itemname',{itemname:itemname},function(res){    
var obj=jQuery.parseJSON(res);
$('#hsnno').val(obj.hsnno);
//$('#itemcode').val(obj.itemno);   
});
});

$('#hsnno').blur(function(){
var itemcode=$('#hsnno').val();
$.post('<?php echo base_url();?>stockmaster/get_itemcode',{itemcode:itemcode},function(res){   
var obj=jQuery.parseJSON(res);
$('#itemname').val(obj.itemname);
$('#hsnno').val(obj.hsnno);   
});
});
</script>

