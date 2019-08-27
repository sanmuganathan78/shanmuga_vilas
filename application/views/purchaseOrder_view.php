<?php $data=$this->db->get('profile')->result();
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
.uppercase { text-transform: uppercase; }
.success{ display: none; }
.unsuccess{ display: none; }
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

<div class="alert btn-info alert-micro btn-rounded pastel light dark success" >
<a href="#" class="close" data-dismiss="alert">&times;</a>Purchase Order Deleted Successfully !
</div>

<div class="alert btn-info alert-micro btn-rounded pastel light dark unsuccess" >
<a href="#" class="close" data-dismiss="alert">&times;</a>Purchase Order Deleted Unsuccessfully 
</div>
<div class="row">
<div class="col-sm-12">
&nbsp;
</div>
</div>
<div class="row">
<div class="col-sm-12">
<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
<header class="panel-heading" style="color:rgb(255, 255, 255)">
<i class="zmdi zmdi-shopping-cart">&nbsp;Purchase Order Reports</i>
</header>
<div class="card-box table-responsive">
<div class="dropdown pull-right"><a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false"></a></div>
<form name="from" id="form-filter" method="post" >
<table >
<tr>
<td>
<div class="col-sm-12">
<input type="text" class="form-control" name="purchaseorderno" id="purchaseorderno" style="font-size:16px;width: 140px;" value="" placeholder="PO No">
</div>
</td>

<td>
<div class="col-sm-12">
<input type="text" class="form-control" name="customername" id="customername" style="font-size:16px;width: 255px;" value="" placeholder="Party Name">
</div>
</td>
<td>
<div class="col-sm-12">
<input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="fromdate" style="font-size:16px;width:143px;" value="" placeholder="From Date">
</div>
</td>
<td>
<input type="text" class="form-control datepicker-autoclose" name="todate" id="todate" style="font-size:16px;width:143px;" value="" Placeholder="To Date">
</td>
<td>&nbsp;</td>       
<td>
</td>
<td>&nbsp;&nbsp;&nbsp;</td>
<td>

<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
<button type="button" id="btn-reset" class="btn btn-default">Reset</button>

</td>
</tr>
</table>
</form>
<br>
<table id="s" class="table table-striped table-bordered">
<thead>
<tr>
<th>S.No</th>
<th>Date</th>
<th>PO No</th>
<th>Company Name</th>
<th>Bill Age</th>
<th>Total</th>
<th>Action</th>
</tr>
</thead>
</table>
<div align="center">
<button id="print" class="btn btn-info" value="Print">Print</button>
</div>
</div>
</section>
</div>
</div>
</div>




<?php if($_POST) {?>
<form name="form" method="post" action="<?php echo base_url();?>purchase/reports" target="_blank" >
<table>
<tr>
<td><input type="hidden" name="fromdate" class="form-control" 
value="<?php if($this->input->post('fromdate')){echo $this->input->post('fromdate');}?>"></td>
<td><input type="hidden" name="todate" class="form-control" value="<?php if($this->input->post('todate')){echo $this->input->post('todate');}?>"></td>
<td><input type="submit" class="btn btn-info" name="submit" value="Print Reports" style="margin-left:400px;"></td>
</tr>
</table>
</form>
<?php }?> 


<div id="delete_billing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
<div class="modal-dialog">
<form id="delete_form">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
<h4 class="modal-title">Delete Purchase Details</h4>
</div>
<div class="modal-text">
<p>Are you sure to delete this data?</p>
</div>
<input type="hidden" id="hidden_delete_id">    
<div class="modal-body">
<div class="delete"></div>
</div>
<div align="center">
<button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
<button id="dialogCancel" data-dismiss="modal" class="btn btn-primary waves-effect">Cancel</button>
</div>
</div>
</form>
</div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> 

<script type="text/javascript">
var table;
$(document).ready(function() {
table = $('#s').DataTable({ 
"processing": true, //Feature control the processing indicator.
'bnDestroy' :true,
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.
// Load data for the table's content from an Ajax source
"ajax": {
"url": "<?php echo site_url('purchaseorder/ajax_list')?>",
"type": "POST",
"data": function ( data ) {
data.purchaseorderno = $('#purchaseorderno').val();
data.customername = $('#customername').val();
data.fromdate = $('#fromdate').val();
data.todate = $('#todate').val();
}
},
//Set column definition initialisation properties.
"columnDefs": [{ 
"targets": [ 0 ], //first column / numbering column
"orderable": false, //set not orderable
}],

});

$('#btn-filter').click(function(){ //button filter event click
table.ajax.reload(null,false);  //just reload table
});

$('#btn-reset').click(function(){ //button reset event click
$('#form-filter')[0].reset();
table.ajax.reload(null,false);  //just reload table
});



$('#print').click(function(){
var fromdate = $('#fromdate').val();
var todate = $('#todate').val();
var purchaseorderno = $('#purchaseorderno').val();
var customername = $('#customername').val();
$.post('<?php echo base_url();?>purchaseorder/search',{'fromdate':fromdate,'customername':customername,'todate':todate,'purchaseorderno':purchaseorderno},function(data){
window.open('<?php echo base_url();?>purchaseorder/search_reports', '_blank');
});
});

$('#download').click(function(){
var fromdate = $('#fromdate').val();
var todate = $('#todate').val();
var invoiceno = $('#invoiceno').val();
var customername = $('#customername').val();
$.post('<?php echo base_url();?>purchase/billing_reportdownload',{'fromdate':fromdate,'todate':todate,'invoiceno':invoiceno,'customername':customername},function(data){
window.open('<?php echo base_url();?>purchase/search_reports', '_blank');
});
});

});


</script>      
<script type="text/javascript">
$('.colorpicker-default').colorpicker({ format: 'hex' });
$('.colorpicker-rgba').colorpicker();

// Date Picker
jQuery('#datepicker').datepicker();
jQuery('.datepicker-autoclose').datepicker({ autoclose: true,todayHighlight: true 	});


$('#delete_form').submit(function(){

var id = $('#hidden_delete_id').val();
$('#dialogConfirm').text('Processing...');
$('#dialogConfirm').attr('disabled',true);
$.post('<?php echo base_url(); ?>purchaseorder/delete',{id:id},function(res){
$('#dialogConfirm').text('Confirm');
$('#dialogConfirm').attr('disabled',false);
  console.log(res);

if(res=='	yes')
{
$('#delete_billing').modal('hide');
$('.success').show();

reload_table();

}
else if(res=='no')
{

$('#delete_billing').modal('hide');
$('.success').show();

reload_table();
}
});
return false;
});





function reload_table()
{
table.ajax.reload(null,false); //reload datatable ajax 
}


function delete_person(id)
{
$('#hidden_delete_id').val(id); 
$('#delete_billing').modal('show'); 
}


</script>

<script type="text/javascript">
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
},
});

$( "#purchaseorderno" ).autocomplete({
source: function(request, response) {
$.ajax({ 
url: "<?php echo base_url();?>purchaseorder/autocomplete_purchaseorderno",
data: { keyword: $("#purchaseorderno").val()},
dataType: "json",
type: "POST",
success: function(data){              
response(data);
}    
});
},
});
});

</script>