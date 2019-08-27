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
                            <a href="#" class="close" data-dismiss="alert">&times;</a>Quotation Deleted Successfully !
                        </div>

                         <div class="alert btn-info alert-micro btn-rounded pastel light dark unsuccess" >
                            <a href="#" class="close" data-dismiss="alert">&times;</a>Quotation Deleted Unsuccessfully 
                        </div>
      <div class="row">
        <div class="col-sm-12">
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-shopping-cart">&nbsp;Quotation Reports</i>
            </header>
            <div class="card-box table-responsive">
              <div class="dropdown pull-right">
                <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                </a>
              </div>
              <form method="post" id="form-filter" action="<?php echo base_url();?>quotation/search">
                <table>
                  <td style="width: 88px;">
                    From Date
                  </td>
                  <td>
                    <input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="sfromdate" style="font-size:16px;width:143px;" value="<?php /*echo date('d-m-Y'); */ ?>">
                  </td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;
                    To Date &nbsp;&nbsp;
                  </td>
                  <td>    
                    <input type="text" class="form-control datepicker-autoclose" name="todate" id="stodate" style="font-size:16px;width:143px;" value="<?php /* echo date('d-m-Y'); */ ?>">
                  </td>
                  <!--<td> &nbsp;&nbsp; &nbsp;&nbsp;<input type="submit" class="btn btn-info" value="Search"></td>-->
					<td>
						<button type="button" id="btn-filter" class="btn btn-primary" style="margin-left:20px;">Filter</button>
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
                    <th>Quotation No</th>
                    <th>Company Name</th>
                 
                    <th>Total</th>
                    <th>Action</th>
                  </tr>
                </thead>
              </table>
            </div>
          </div>
        </div>
      </div>
  <!--     <?php foreach($purchase as $r) {?>
      <div id="delete<?php echo $r['id'];?>" class="modal fade" >
        <div class="modal-dialog" style="width:40%">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
              <h4 class="modal-title">Delete </h4>
            </div>
            <div class="modal-text">
              <br>
              <p align="center">Are you sure to delete this data?</p>
            </div>
            <div class="modal-body">
              <div class="row">
                <form name="form" action="<?php echo base_url();?>purchase/delete" method="post" id="form1">
                  <input type="hidden" value="<?php echo $r['id'];?>" name="id">
                  <div class="col-offset-4" align="center">
                  </div>
                  <div align="center">
                    <button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
                    <button id="dialogCancel" data-dismiss="modal" class="btn btn-default waves-effect">Cancel</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div> </div>
        <?php }?>

 -->


                <?php //if($_POST) {?>
                <form name="form" method="post" action="<?php echo base_url();?>quotation/reports" target="_blank" >
                  <table>
                    <tr>
                      <td><input type="hidden" name="fromdate" id="pfromdate" class="form-control" 
                        value="<?php if($this->input->post('fromdate')){echo $this->input->post('fromdate');}?>"></td>
                        <td><input type="hidden" name="todate" id="ptodate" class="form-control" value="<?php if($this->input->post('todate')){echo $this->input->post('todate');}?>"></td>
                        <td><input type="submit" class="btn btn-info" name="submit" value="Print Reports" style="margin-left:400px;"></td>
                      </tr>
                    </table>
                  </form>
                  <?php //}?> 




           


                  <div id="delete_billing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
          <form id="delete_form">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Delete Quotation Details</h4>
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
                  <script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
                  <script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
                  <script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
                  <script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
                  <script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
                  <script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script> 
                  <script type="text/javascript">
                  var save_method; //for save method string
                  var table;
                  $(document).ready(function() {
                    $("input").keyup(function(){
                      $(this).parent().removeClass('has-error');
                      $(this).next().empty();
                    });
                    $('#itemname').blur(function(){
                      var itemname=$('#itemname').val();
                      $.post('<?php echo base_url();?>item/get_itemname',{itemname:itemname},function(res){
                        if(res=='yes')
                        {
                          alert("already exists");
                          $('#itemname').val('');
                          $('#itemname').focus();
                        }
                      });
                    });
                    table = $('#s').DataTable({ 
                  "processing": true, //Feature control the processing indicator.
                  "serverSide": true, //Feature control DataTables' server-side processing mode.
                  "order": [], //Initial no order.
                  "ajax": {
                    "url": "<?php echo site_url('quotation/ajax_list')?>",
                    "type": "POST",
					"data": function ( data ) {
						data.fromdate = $('#sfromdate').val();
						data.todate = $('#stodate').val();
						}
                  },
                  "columnDefs": [
                  { 
                  "targets": [ -1 ], //last column
                  "orderable": false, //set not orderable
                  },
                  ],
                  });

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


                  $('#delete_form').submit(function(){

  var id = $('#hidden_delete_id').val();
  $('#dialogConfirm').text('Processing...');
  $('#dialogConfirm').attr('disabled',true);
  $.post('<?php echo base_url(); ?>quotation/delete',{id:id},function(res){
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


					$('#btn-filter').click(function(){ //button filter event click
						$("#pfromdate").val($("#sfromdate").val());
						$("#ptodate").val($("#stodate").val());
						table.ajax.reload(null,false);  //just reload table
					});
					$('#btn-reset').click(function(){ //button reset event click
					$('#form-filter')[0].reset();
						$("#pfromdate").val('');
						$("#ptodate").val('');
						table.ajax.reload(null,false);  //just reload table
					});
                  });



                  function validate(event)
                  {
                    event.preventDefault();
                    $.ajax({
                      url : '<?php echo base_url();?>item/insert',
                      type: "POST",
                      data: $('#insert_form').serialize(),
                      dataType: "JSON",
                      success: function(data)
                      {
                  // console.log(data);
                  // return false;

                  if(data.status){
                    $('.success').show();
                    $('#insert_form')[0].reset();
                    $('#itemno').val(data.itemno);
                    reload_table();
                  }
                  else
                  {
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                  $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
                  }          
                  }
                  });
                    return false;
                  }
                  function reload_table()
                  {
                  table.ajax.reload(null,false); //reload datatable ajax 
                  }
                  function save()
                  {
                    event.preventDefault();
                    $.ajax({
                      url : '<?php echo base_url();?>item/update',
                      type: "POST",
                      data: $('#edit_form').serialize(),
                      dataType: "JSON",
                      success: function(data)
                      {
                        if(data.status){

                          $('#success').show();
                          $('#modal_form').modal('hide');
                          reload_table();
                        }else{
                          for (var i = 0; i < data.inputerror.length; i++) 
                          {
                  $('[name="'+data.inputerror[i]+'"]').parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
                  $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
                  }
                  } 
                  }
                  });
                  }
                
                  

                  function delete_person(id)
{

  $('#hidden_delete_id').val(id); 
  $('#delete_billing').modal('show'); 

}

                  function edit_person(id)
                  {
                  $('#edit_form')[0].reset(); // reset form on modals
                  $('.form-group').removeClass('has-error'); // clear error class
                  $('.help-block').empty(); // clear error string
                  $.ajax({
                    url : "<?php echo site_url('item/ajax_edit/')?>/" + id,
                    type: "GET",
                    dataType: "JSON",
                    success: function(data)
                    {
                      $('[name="id"]').val(data.id);
                      $('#itemnos').val(data.itemno);
                      $('#itemnames').val(data.itemname);
                      $('#prices').val(data.price);
                  $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                  $('.modal-title').text('Edit Item'); // Set title to Bootstrap modal title

                  },
                  error: function (jqXHR, textStatus, errorThrown)
                  {
                    alert('Error get data from ajax');
                  }
                  });
                  }
                  </script>