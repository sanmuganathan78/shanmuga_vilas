
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
        <i class="zmdi zmdi-view-headline">&nbsp;Inward Reports</i>
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
      <th>Inward No</th>
      <th>Company Name</th>
      <th>Item Name</th>
      <th>Qty</th>
      <th>Balance Qty</th>
      <th>Status</th>
      
  </tr>
</thead>
<tbody>
<?php 
$i=1;
foreach($view as $u)
{?><tr>
<td><?php echo $i++;?></td>
<td><?php echo date('d-m-Y',strtotime($u['inwarddate']));?></td>
<td><?php echo $u['inwardno'];?></td>
<td><?php echo $u['cusname'];?></td>
<td><?php echo $u['itemname'];?></td>
<td><?php echo $u['qty'];?></td>
<td><?php echo $u['balanceqty'];?></td>
<td>
<?php 

if($u['balanceqty'] > 0)
{

  echo'<button class="btn btn-warning btn-custom btn-rounded">Pending</button>';


}

else 
{
  echo'<button class="btn btn-success btn-custom btn-rounded">Delivery</button>';
}

?>
</td>

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
$(document).ready(function() {

 $('#table').DataTable();
});


</script>      

