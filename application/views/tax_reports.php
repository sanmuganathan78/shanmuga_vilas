
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

   .success{
        display: none;
    }

     .unsuccess{
        display: none;
    }
</style>
<title>Invoice Reports</title>
<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container">
      <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
      <div class="alert btn-primary alert-micro btn-rounded pastel light dark" >
        <a href="#" class="close" id="delete" data-dismiss="alert">&times;</a>
        <?php print_r($msg); ?>
      </div>
      <?php } ?>


      <?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
      <div class="alert alert-micro btn-rounded alert-danger">
        <a href="#" class="close"  data-dismiss="alert">&times;</a>
        <?php print_r($msg); ?>
      </div>
      <?php } ?>

       <div class="alert btn-info alert-micro btn-rounded pastel light dark success" >
                            <a href="#" class="close" data-dismiss="alert">&times;</a>Invoice Deleted Successfully !
                        </div>

                         <div class="alert btn-info alert-micro btn-rounded pastel light dark unsuccess" >
                            <a href="#" class="close" data-dismiss="alert">&times;</a>Invoice Deleted Unsuccessfully 
                        </div>
      <div class="row">
        <div class="col-sm-12">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-view-headline">&nbsp;Tax Reports</i>
            </header>
            <div class="card-box table-responsive">
              <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                </a>
              </div>

               <form name="from" id="form-filter" method="post" >
					<table >
						<tr>
						<!--   
						<td>
							<div class="col-sm-12">
								<input type="text" class="form-control" name="invoiceno" id="invoiceno" style="font-size:16px;width: 115px;" value="" placeholder="Invoice No">
							</div>
						</td>
						-->

						<td>
							<div class="col-sm-12">
								<select name="gsttype" class="form-control" id="gsttype" onChange="getTaxPercent(this.value);">
									<option value="">Tax Type</option>
									<option value="intrastate">SGST & CGST</option>                  
									<option value="interstate">IGST</option>
								</select>
							</div>
						</td>
						
						<td>
							<select name="tax_percent" class="form-control" id="tax_percent">
								<option value="">Tax %</option>
							</select>
						</td>
						
						<td>
							<div class="col-sm-12">
								<input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="fromdate" style="font-size:16px;width:123px;" value="" placeholder="From Date">
							</div>
						</td>
						
						<td>
							<input type="text" class="form-control datepicker-autoclose" name="todate" id="todate" style="font-size:16px;width:123px;" value="" Placeholder="To Date">
						</td>
						
						<td>&nbsp;</td>      
						
						<td>
							<button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
							<button type="button" id="btn-reset" class="btn btn-default">Reset</button>
						</td>
						</tr>
					</table>
				</form>
     
              <br>
              <table id="table" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>S.No</th>
                    <th>Date</th>
                    <th>Invoice No</th>
                    <th>Company Name</th>
                    <th>Mobile No</th>
                    <th>GSTIN</th>
                    <th>Total</th>
                    
                  </tr>
                </thead>



</table>

              <div align="center">
             <button id="print" class="btn btn-info" value="Print"><i class="fa fa-print"></i>  Print</button>
			<button id="download" class="btn btn-primary" ><i class="fa fa-bar-chart-o"></i> Download as Excel</button>
        </div>
</div>
</div>
</div>
</div>



            <?php if($_POST) {?>
        <form name="form" method="post" action="<?php echo base_url();?>invoice/reports" target="_blank" >
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
                <h4 class="modal-title">Delete Invoice</h4>
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
<script>
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

$( "#name" ).autocomplete({
  source: function(request, response) {
    $.ajax({ 
      url: "<?php echo base_url();?>dcbill/autocomplete_name",
      data: { keyword: $("#name").val()},
      dataType: "json",
      type: "POST",
      success: function(data){              
        response(data);
      }    
    });
  },
});


     $( "#invoiceno" ).autocomplete({
      source: function(request, response) {
        $.ajax({ 
          url: "<?php echo base_url();?>invoice_statement/autocomplete_name",
          data: { keyword: $("#invoiceno").val()},
          dataType: "json",
          type: "POST",
          success: function(data){              
            response(data);
          }    
        });
      },
    });
</script>

      <script type="text/javascript">

  var table;

  $(document).ready(function() {

//datatables
table = $('#table').DataTable({ 

"processing": true, //Feature control the processing indicator.
'bnDestroy' :true,
"serverSide": true, //Feature control DataTables' server-side processing mode.
"order": [], //Initial no order.

// Load data for the table's content from an Ajax source
"ajax": {
  "url": "<?php echo site_url('tax/ajax_list')?>",
  "type": "POST",
  "data": function ( data ) {
     data.invoiceno = $('#invoiceno').val();
     data.gsttype = $('#gsttype').val();
     data.cusname = $('#name').val();
     data.fromdate = $('#fromdate').val();
     data.todate = $('#todate').val();
	 data.tax_percent = $("#tax_percent").val();


  }
},

//Set column definition initialisation properties.
"columnDefs": [
{ 
"targets": [ 0 ], //first column / numbering column
"orderable": false, //set not orderable
},
],

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
  var cusname = $('#name').val();
  var invoiceno = $('#invoiceno').val();
  var gsttype = $('#gsttype').val();
  var tax_percent = $("#tax_percent").val();
  $.post('<?php echo base_url();?>tax/search',{'fromdate':fromdate,'cusname':cusname,'todate':todate,'invoiceno':invoiceno,gsttype:gsttype,tax_percent:tax_percent},function(data)
  {
    window.open('<?php echo base_url();?>tax/search_reports', '_blank');
  });

});





	$('#download').click(function(){
		var fromdate = $('#fromdate').val();
		var todate = $('#todate').val();
		var cusname = $('#name').val();
		var invoiceno = $('#invoiceno').val();
		var gsttype = $('#gsttype').val();
		var tax_percent = $("#tax_percent").val();
		$.post('<?php echo base_url();?>tax/excel_download',{'fromdate':fromdate,'cusname':cusname,'todate':todate,'invoiceno':invoiceno,gsttype:gsttype,tax_percent:tax_percent},function(data){
			window.open('<?php echo base_url();?>tax/search_reports', '_blank');
		});
	});

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


function edit_person(id)
{

//alert(id);

$.post('<?php echo base_url();?>admin/add_billing/viewbilling',{'id':id},function(data){

  $('.viewdetails').html(data);

  $('#view_billing').modal('show');

});
}
function getTaxPercent(gotVal)
{
	$.ajax({ 
	  url: "<?php echo base_url();?>tax/getTaxPercent",
	  data: { gstType: gotVal},
	  //dataType: "json",
	  type: "POST",
	  success: function(data){              
		$("#tax_percent").html(data);
	  }    
	});
}
  </script>      


       