
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
</style>


<div class="content-page">
  <!-- Start content -->
  <div class="content">
    <div class="container">
<!--                                                         <h4 class="page-title">Tax Type</h4>
-->

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
  </div>
</div>
<div class="row">
  <div class="col-sm-12">
    <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
      <header class="panel-heading" style="color:rgb(255, 255, 255)">
        <i class="zmdi zmdi-view-headline">&nbsp;Job Order Reports</i>
    </header>
    <div class="card-box table-responsive">
        <div class="dropdown pull-right">
          <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
          </a>
      </div>
 <!--      <form name="from" id="form-filter" method="post" >
          <table >
            <tr>
              <td>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="invoiceno" id="invoiceno" style="font-size:16px;width: 140px;" value="" placeholder="Invoice No">
              </div>
          </td>

          <td>
            <div class="col-sm-12">
              <input type="text" class="form-control" name="suppliername" id="suppliername" style="font-size:16px;width: 255px;" value="" placeholder="Party Name">
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
</form> -->
<br>
<table id="table" class="table table-striped table-bordered">
  <thead>
    <tr>
      <th>S.No</th>
      <th>Date</th>
      <th>Type</th>
      <th>Order No</th>
      <th>Completed Date</th>
      <th>Vendor / Operator Name</th>
      <th>Manage</th>
  </tr>
</thead>
<tbody>
<?php
$i=1;
foreach($view as $u)
{?><tr>
<td><?php echo $i++;?></td>
<td><?php echo date('d-m-Y',strtotime($u['joborderdate']));?></td>
<td><?php echo $u['jobtype'];?></td>
<td><?php echo $u['joborderno'];?></td>
<td><?php echo date('d-m-Y',strtotime($u['dateofcompletion']));?></td>
<td><?php echo $u['vendors'];?> <?php echo $u['operatorname'];?></td>

<td><div class="btn-group">
    <button type="button" class="btn
    btn-info dropdown-toggle waves-effect waves-light"
    data-toggle="dropdown" aria-expanded="false">Manage <span
    class="caret"></span></button>
    <ul class="dropdown-menu"
    role="menu" style="background: #23BDCF  none repeat scroll
    0% 0%;width:14px;min-width: 100%;">

         <li><a class="" style="color:white; font-weight: bold;background-color: #23BDCF;" href="javascript:void()" title="View" onclick="view_person(<?php echo $u['id'];?>)">View</a></li></ul>
    </div></td>

</tr>
<?php } ?>
 


</tbody>
</table>

<!-- 
<div align="center">
    <button id="print" class="btn btn-info" value="Print">Print</button>
    <button id="download" class="btn btn-primary" value="Print">Download</button>
</div> -->
</div>
</div>
</div>
</div>



<div id="view_billing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Job List</h4>
            </div>
            <div class="modal-body">

                <div class="viewdetails"></div>


            </div>
            <div align="center">
                <button id="dialogCancel" data-dismiss="modal" class="btn btn-primary waves-effect">Cancel</button>

            </div>
        </div>
    </div>
</div><!-- /.modal -->


<div id="delete_billing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
    <form id="delete_form">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete Inward</h4>
            </div>
            <div class="modal-text">
                <p>Are u sure to delete this data?</p>
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
</div><!-- /.modal -->



<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>

<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
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
</script>
<script type="text/javascript">
  $(document).ready(function(){

    $( "#suppliername" ).autocomplete({
      source: function(request, response) {
        $.ajax({ 
          url: "<?php echo base_url();?>purchase/autocomplete_name",
          data: { keyword: $("#suppliername").val()},
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
          url: "<?php echo base_url();?>purchase_statement/autocomplete_name",
          data: { keyword: $("#invoiceno").val()},
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


<script type="text/javascript">

  var table;

  $(document).ready(function() {

$('#table').DataTable(); // download ends 


});



function view_person(id)
{

    // alert(id);

    $.post('<?php echo base_url();?>joborder/viewbilling',{'id':id},function(data){

        $('.viewdetails').html(data);

        $('#view_billing').modal('show');
        // alert(data);

    });


}

function delete_person(id)
{
    $('#hidden_delete_id').val(id);    
    $('#delete_billing').modal('show'); 

}

</script>      

