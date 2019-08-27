
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
                            <a href="#" class="close" data-dismiss="alert">&times;</a>Proforma Invoice Deleted Successfully !
                        </div>

                         <div class="alert btn-info alert-micro btn-rounded pastel light dark unsuccess" >
                            <a href="#" class="close" data-dismiss="alert">&times;</a>Proforma Invoice Deleted Unsuccessfully 
                        </div>
      <div class="row">
        <div class="col-sm-12">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-view-headline">&nbsp;Proforma Invoice Reports</i>
            </header>
            <div class="card-box table-responsive">
              <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                </a>
              </div>

               <form name="from" id="form-filter" method="post" >
          <table >
            <tr>



              <td>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="invoiceno" id="invoiceno" style="font-size:16px;width: 115px;" value="" placeholder="Invoice No">
                </div>
              </td>

           
              <td>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="customername" id="name" style="font-size:16px;width: 185px;" value="" placeholder="Customer Name">
                </div>
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
              </td>
              <td>&nbsp;&nbsp;&nbsp;</td>
              <td>

                <button type="button" id="btn-filter" class="btn btn-primary">Filter</button>
                <button type="button" id="btn-reset" class="btn btn-default">Reset</button>

              </td>
            </tr>
          </table>
        </form>
      <!--         <form method="post" action="<?php echo base_url();?>invoice/search">
                <table>
                  <td style="width: 88px;">
                    From Date
                  </td>
                  <td>
                    <input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="autoclose" style="font-size:16px;width:143px;" value="<?php echo date('d-m-Y');?>">
                  </td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;
                    To Date &nbsp;&nbsp;
                  </td>
                  <td>    
                    <input type="text" class="form-control datepicker-autoclose" name="todate" id="datepicker2" style="font-size:16px;width:143px;" value="<?php echo date('d-m-Y');?>">
                  </td>
                  <td> &nbsp;&nbsp; &nbsp;&nbsp;<input type="submit" class="btn btn-info" value="Search"></td>
                </table>
              </form> -->
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
                    <th>Bill Age</th>
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
<!--                 <tbody>
                  <?php 
                  $i=1;
                  foreach($invoice as $u)
                    {?><tr>
                  <td><?php echo $i++;?></td>
                  <td><?php echo date('d-m-Y',strtotime($u['invoicedate']));?></td>
                  <td><?php echo $u['invoiceno'];?></td>
                  <td><?php echo $u['customername'];?></td>
                  <td><?php echo $u['grandtotal'];?></td>
                  <td><?php echo $u['paid'];?></td>
                  <td align="">
                    <div class="btn-group">
                      <button type="button" class="btn
                      btn-info dropdown-toggle waves-effect waves-light"
                      data-toggle="dropdown" aria-expanded="false">Manage</button>
                      <ul class="dropdown-menu"
                      role="menu" style="background: #1EBFB9 none repeat scroll
                      0% 0%;width:14px;min-width:100%">                                                           
<!- <li><a href="#edit<?php echo $u['id'];?>" data-toggle="modal" 
data-overlayspeed="100" data-overlaycolor="#36404a" style="color:
white; font-weight: bold; background-color: #1EBFB9" data-toggle="modal">Edit</a></li>
-->    
<!-- <li> <a href="#view<?php echo $u['id'];?>" data-toggle="modal"  style="color:
  white; font-weight: bold; background-color: #57C5A5">View</a></li>
  <li> <a href="#delete<?php echo $u['id'];?>" data-toggle="modal"  style="color:
    white; font-weight: bold; background-color: #57C5A5">Delete</a></li>
  </ul>   
</div>
</td>
</tr>
<?php } ?>
</tbody> --> 


</table>

              <div align="center">
             <button id="print" class="btn btn-info" value="Print">Print</button>

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
  "url": "<?php echo site_url('proforma_invoice/ajax_list')?>",
  "type": "POST",
  "data": function ( data ) {
     data.invoiceno = $('#invoiceno').val();
     data.gsttype = $('#gsttype').val();
     data.cusname = $('#name').val();
     data.fromdate = $('#fromdate').val();
     data.todate = $('#todate').val();


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

  $.post('<?php echo base_url();?>proforma_invoice/search',{'fromdate':fromdate,'cusname':cusname,'todate':todate,'invoiceno':invoiceno,gsttype:gsttype},function(data)
  {

    window.open('<?php echo base_url();?>proforma_invoice/search_reports', '_blank');

  });

});


$('#delete_form').submit(function(){
  var id = $('#hidden_delete_id').val();
  $('#dialogConfirm').text('Processing...');
  $('#dialogConfirm').attr('disabled',true); 
  $.post('<?php echo base_url(); ?>proforma_invoice/delete',{id:id},function(res){
$('#dialogConfirm').text('Confirm');
  $('#dialogConfirm').attr('disabled',false);
    // console.log(res);

      if(res=='yes')
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


// $('#download').click(function(){
//  var fromdate = $('#fromdate').val();
//   var todate = $('#todate').val();
//   var itemno = $('#itemno').val();
//   var itemname = $('#itemname').val();

//   $.post('<?php echo base_url();?>daily_stockreports/billing_reportdownload',{'fromdate':fromdate,'todate':todate,'itemno':itemno,'itemname':itemname},function(data){

//     window.open('<?php echo base_url();?>daily_stockreports/search_reports', '_blank');

//   });

// });

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
  </script>      


       