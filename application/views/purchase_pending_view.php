
<?php $data=$this->db->get('profile')->result(); 
  foreach($data as $d)
    ?>
<title> <?php echo $d->companyname;?></title>
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">

<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">


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
             <i class="zmdi zmdi-view-headline">&nbsp;Purchase Pending Reports</i>
                                </header>
                                <div class="card-box table-responsive">
                                    <div class="dropdown pull-right">
                                        <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                                        </a>
                                    </div>

                                  <form method="post" action="<?php echo base_url();?>purchase/pending">
                <table>
                
                  <td style="width: 88px;">
                    &nbsp;&nbsp;&nbsp;From Date
                  </td>
                  <td>
                    <input type="text" class="form-control  datepicker-autoclose" name="fromdate" id="datepicker-autoclose" style="font-size:16px;width:143px;" value="<?php echo date('d-m-Y');?>">
                  </td>
                  <td>&nbsp;&nbsp;&nbsp;&nbsp;
                    To Date &nbsp;&nbsp;
                  </td>
                  <td>    
                    <input type="text" class="form-control datepicker-autoclose" name="todate" id="datepicker2" style="font-size:16px;width:143px;" value="<?php echo date('d-m-Y');?>">
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
                                      
                                            <th>Name</th>
                                            <th>Openingbal</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Balance</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        $i=1;
                                        foreach($pending as $u)
                                            {?><tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo date('d-m-Y',strtotime($u['date']));?></td>
                                    
                                        <td><?php echo $u['name'];?></td>
                                        <td><?php echo $u['openingbal'];?></td>
                                        <td><?php echo $u['salesamount'];?></td>
                                        <td><?php echo number_format($u['paidamount'],2);?></td>
                                        <td><?php echo number_format($u['balanceamount'],2);?></td>
                                         

                                             <td ><a href="#"   class="btn btn-rounded  " style="color:#FFFFFF;background-color:#10C47B">Pay</a></td>


                                    </tr>
                                   <?php } ?>
                                </tbody>
                            </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <?php if($_POST) {?>
        <form name="form" method="post" action="<?php echo base_url();?>purchase/reports1" target="_blank" >
            <table>
                <tr>
                    <td><input type="hidden" name="fromdate" class="form-control" 
                        value="<?php if($this->input->post('fromdate')){echo $this->input->post('fromdate');}?>"></td>
                        <td><input type="hidden" name="todate" class="form-control" value="<?php if($this->input->post('todate')){echo $this->input->post('todate');}?>"></td>
                          <td><input type="hidden" name="suppliername" class="form-control" value="<?php if($this->input->post('suppliername')){echo $this->input->post('suppliername');}?>"></td>


                           
                        <td><input type="submit" class="btn btn-info" name="submit" value="Print Reports" style="margin-left:300px;"></td>
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
      url: "<?php echo base_url();?>purchase/autocomplete_customername",
      data: { keyword: $("#suppliername").val()},
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
