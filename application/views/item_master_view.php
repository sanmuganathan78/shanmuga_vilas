<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>
<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<style type="text/css">   
.uppercase{ text-transform: uppercase; }
.success{ display: none; }
.forms{ }
.forms input{ width: 95%; }
.uppercase { text-transform: uppercase; }
.form-control { display: block; width: 99%; }
.error { color:#f00;font-size:12px; }
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
<a href="#" class="close" data-dismiss="alert">&times;</a>Item deleted Successfully !
</div>

<!-- ITEM MASTER -->
<div class="row">
<div class="col-sm-12">
<div class="portlet box blue">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-reorder"></i>Item Reports
</div>
<div class="tools">
<a href="javascript:;" data-toggle="collapse" data-target="#form_div" style="color:white;"><i class="fa fa-plus"></i> Add Item</a>
<a href="javascript:void()" onclick="upload_excel()" style="color:white;"> <i class="fa fa-upload"></i> Upload Excel</a>
<a href="<?php echo base_url();?>assets/ItemImport.xlsx"  style="color:white;"> <i class="fa fa-download"></i>&nbsp; Sample Excel</a>
</div>
</div>
<div class="portlet-body form">
<div class="collapse <?php if ($id != ""){ echo "in";} ?>" id="form_div">
<div class="row-fluid well">
<form name="logoForm" id="logoForm" class="form-horizontal" action="<?php echo $action;?>" method="post" >
<input type="hidden" name="sid" value="<?php echo $this->validation->sid; ?>"/>
<div class="row">
<div class="col-md-3">
<div class="form-group">
<label class="control-label">HSN Code</label>
<input type="text" class="form-control" name="hsnno" autocomplete="off" id="hsnno" value="<?php echo $this->validation->hsnno;?>">
<div id="code_valid"></div>
<?php echo form_error('hsnno'); ?>
</div>
</div>
<!--/span-->
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Item  Name</label>
<input type="text" class="form-control" name="itemname" autocomplete="off" id="itemname" value="<?php echo $this->validation->itemname;?>" >
<input type="hidden" name="oldItemName" value="<?php echo $this->validation->itemname;?>" />
<div id="name_valid"></div>
<?php echo form_error('itemname'); ?>
</div>
</div>
<!--/span-->
<div class="col-md-3">
<div class="form-group">
<label class="control-label">UOM</label>
<select  autocomplete="off"  class="form-control decimal uppercase"  name="uom" id="uom">
<option value="">Select UOM</option>
<?php
$uom=$this->db->where('status',1)->get('uom')->result_array();
foreach ($uom as $urows)
{
echo'<option value="'.$urows['id'].'">'.$urows['uom'].'</option>';
}
?>
</select>
<script>document.logoForm.uom.value='<?php echo $this->validation->uom;?>';</script>
<?php echo form_error('uom'); ?>
</div>
</div>
<!--/span-->
<div class="col-md-3">
<div class="form-group">
<label class="control-label">Price</label>
<input type="text" autocomplete="off" autocomplete="off" placeholder="0" class="form-control decimal" name="price" id="price" value="<?php echo $this->validation->price;?>">
<?php echo form_error('price'); ?>
</div>
</div>
<!--/span-->
</div>

<div class="row">
<div class="col-md-2">
<div class="form-group">
<label class="control-label">Select Tax Type</label>
<select  autocomplete="off"  class="form-control decimal uppercase"  name="taxtype" id="taxtype">
<option value="">Select Tax Type</option>
<?php
$taxtype=$this->db->where('status',1)->get('vat_details')->result_array();
foreach ($taxtype as $rows)
{
echo'<option value="'.$rows['id'].'">'.$rows['taxpercentage'].'</option>';
}
?>
</select>
<script>document.logoForm.taxtype.value='<?php echo $this->validation->taxtype;?>';</script>
<?php echo form_error('taxtype'); ?>
</div>
</div>
<!--/span-->
<div class="col-md-2">
<div class="form-group">
<label class="control-label">SGST</label>
<input type="text" readonly autocomplete="off" autocomplete="off" class="form-control decimal" name="sgst" id="sgst" value="<?php echo $this->validation->sgst;?>">
<?php echo form_error('sgst'); ?>
</div>
</div>
<!--/span-->
<div class="col-md-2">
<div class="form-group">
<label class="control-label">CGST</label>
<input type="text" readonly autocomplete="off" autocomplete="off" class="form-control decimal" name="cgst" id="cgst" value="<?php echo $this->validation->cgst;?>">
<?php echo form_error('cgst'); ?>
</div>
</div>
<!--/span-->
<div class="col-md-2">
<div class="form-group">
<label class="control-label">IGST</label>
<input type="text" readonly="" autocomplete="off" autocomplete="off" class="form-control decimal" name="igst" id="igst" value="<?php echo $this->validation->igst;?>">
<?php echo form_error('igst'); ?>
</div>
</div>
<!--/span-->
<!--<div class="col-md-4">
<div class="form-group">
<label class="control-label">Price type</label>
<div class="radio-list">
<label class="radio-inline">
<div class="radio" id="uniform-optionsRadios1"><span class="checked"><input type="radio" name="priceType" id="optionsRadios1" value="Exclusive" checked="" ></span></div> Exclusive </label>
<label class="radio-inline">
<div class="radio" id="uniform-optionsRadios2"><span><input type="radio" name="priceType" id="optionsRadios2" value="Inclusive" ></span></div> Inclusive</label>
</div>
<?php echo form_error('priceType'); ?>
</div>
</div>-->
<?php 
if($this->validation->priceType=="" || $this->validation->priceType=="Inclusive")
{
$exclusiveCheck='';
$inclusiveCheck='checked';
}
else
{
$exclusiveCheck='checked';
$inclusiveCheck='';
}
?>
<div class="col-md-4">
<div class="form-group">
<label class="control-label">Price type</label><br>
<label class="radio-inline"><input type="radio" name="priceType" value="Inclusive" <?php echo $inclusiveCheck;?>>Inclusive</label>
<label class="radio-inline"><input type="radio" name="priceType" value="Exclusive" <?php echo $exclusiveCheck;?>>Exclusive</label>
<?php echo form_error('priceType'); ?>
</div>
</div>
<!--/span-->
</div>

<div class="row">
<div class="form-actions">
<div class="col-md-offset-4 col-md-10">
<?php if($this->validation->sid!="") { ?>
<button type="submit" id="submit" class="btn btn-success">Update</button>
<input type="button" class="btn btn" value="Cancel" onclick="window.location.href='<?php echo base_url();?>index.php/itemmaster';"/>
<?php } else { ?>
<button type="submit" id="submit" class="btn btn-success" >Save</button>
<input type="button" class="btn btn" value="Cancel" data-toggle="collapse" data-target="#form_div" />
<?php } ?>
</div>
</div>
</div>
</form>
</div>
</div>

<div class="card-box table-responsive">
<div class="row">
<div class="l-col-md-12">
<div  class="AjaxResult"><!--table-responsive-->
<table id="s" class="table table-striped table-bordered">
<thead>
<tr>
<th>S.No</th>
<th>Date</th>
<th>HSN Code</th>
<th>Item Name</th>
<th>UOM</th>
<th>SGST</th>
<th>CGST</th>
<th>IGST</th>
<th>Price</th>
<th>Action</th>
</tr>
</thead>
<tbody>

</tbody>
</table> 
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div><!-- END OF ROW-->
</div>
</div>
</div>
<div id="myModal" class="modal fade" role="dialog">
<div class="modal-dialog">
<!-- Modal content-->
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">&times;</button>
<h4 class="modal-title">Upload Item Details In Excel</h4>
</div>
<form action="<?php echo base_url();?>itemmaster/upload_excel" method="post" class="form-horizontal" enctype='multipart/form-data'>
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
<button type="submit"  class="btn btn-primary reg">Save</button>
<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
</div>
</form>
</div>
</div>
</div>

<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>  
<script>
$(document).ready(function(){
$("input").keyup(function(){
$(this).parent().removeClass('has-error');
$(this).next().empty();
});

$('.decimal').keyup(function(){
var val = $(this).val();
if(isNaN(val)){
val = val.replace(/[^0-9\.]/g,'');
if(val.split('.').length>2)
val =val.replace(/\.+$/,"");
}
$(this).val(val);
});
//AJAX SERVER
table = $('#s').DataTable({ 
"processing": true, //Feature control the processing indicator.
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.
"ajax": {
"url": "<?php echo site_url('itemmaster/ajax_list')?>",
"type": "POST"
},
"columnDefs": [{ "targets": [ -1 ], "orderable": false,}],
});
//TAX TYPE CHANGES.
$('#taxtype').change(function(){
var taxtype=$(this).val();
$.post('<?php echo base_url();?>itemmaster/gettax',{'taxtype':taxtype},function(data){
var obj=jQuery.parseJSON(data);
$('#sgst').val(obj.sgst);
$('#cgst').val(obj.cgst);
$('#igst').val(obj.igst);
});

});
//HSN CODE ONCHANGES
/*$('#hsnno').keyup(function(){ 
var name=$(this).val();
if(name !='')
{
$.post('<?php echo base_url();?>itemmaster/getcode',{name:name},function(res){
if(res > 0)
{
$('#hsnno').focus();
$('#code_valid').html('<span><font color="red">Name already taken!</span>');
$('#submit').attr('disabled',true); //set button enable 
}
else
{
$('#code_valid').html('<span><font color="green">Available !</span>');
$('#submit').attr('disabled',false); //set button enable     
}
});
return false;
}
});*/
//ITEM NAME ON CHANGE.
$('#itemname').keyup(function(){ 
var name=$(this).val();
if(name !='')
{
$.post('<?php echo base_url();?>itemmaster/getname',{name:name},function(res){
if(res > 0)
{
$('#itemname').focus();
$('#name_valid').html('<span><font color="red">Name already taken!</span>');
$('#submit').attr('disabled',true); //set button enable 
}
else
{
$('#name_valid').html('<span><font color="green">Available !</span>');
$('#submit').attr('disabled',false); //set button enable     
}
});
return false;
}
});
//VALIDATION
$("#logoForm").validate({
onfocusout: function (element) {
this.element(element);
},
"onkeyup": false,
"rules": {
/*"hsnno"		: { "required": true	},*/
"itemname"	: { "required": true	},
"uom"		: { "required": true	},
"price"		: { "required": true	},
"taxtype"	: { "required": true	},
"priceType"	: { "required": true	}

},
"messages": {
/*"hsnno"		: { "required": "HSN NO cannot be blank."		},*/
"itemname"	: { "required": "Item Name cannot be blank."	},
"uom"		: { "required": "UOM cannot be blank."			},
"price"		: { "required": "Price cannot be blank."		},
"taxtype"	: { "required": "Tax Type cannot be blank."		},
"priceType"	: { "required": "Price Type cannot be blank."	}
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
function delete_person(id)
{
if(confirm('Are you sure to delete this details?'))
{
$.ajax({
url : "<?php echo site_url('itemmaster/ajax_delete')?>/"+id,
type: "POST",
dataType: "JSON",
success: function(data)
{
$('.success').show();
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
function reload_table()
{
table.ajax.reload(null,false); //reload datatable ajax 
}
function upload_excel()
{
$('#myModal').modal('show');
}
</script>
