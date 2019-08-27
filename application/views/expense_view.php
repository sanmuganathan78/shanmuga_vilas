<!-- DataTables -->
  <?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
        <title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />

        <link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

        <link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">


    <style type="text/css">
    
    .uppercase{

        text-transform: uppercase;
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
                       

          
                     <div class="row">
                        <div class="col-sm-12">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
                                <header class="panel-heading" style="color:rgb(255, 255, 255)">
             <i class="zmdi zmdi-money-box">&nbsp;Expenses Reports</i>
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
                                                        <input type="text" class="form-control" name="name" id="name" style="font-size:16px;width: 255px;" value="" placeholder="Enter Name">
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
                                                <td> <div class="col-sm-12"><select name="headers" id="headers" class="form-control" required>
                  <option value="">Select Headers</option>
                  <?php 
                  $headers=$this->db->get('headers')->result();

                  foreach($headers as $h){
                   ?>
                   <option value="<?php echo $h->name;?>"><?php echo $h->name;?></option>
                  <?php } ?>
                  <option value="All">All</option>
                </select></div></td>       
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

                         <table id="table" class="table table-striped table-bordered">
                                   <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Header</th>
                                            <th>Purpose</th>
                                            <th>Payment Mode</th>
                                            <th>Payment Details</th>
                                            <th>Amount</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                   <!--      <?php 
                                        $i=1;
                                        foreach($expenses as $u)
                                            {?><tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo date('d-m-Y',strtotime($u['expensesdate']));?></td>
                                        <td><?php echo $u['name'];?></td>
                                        <td><?php echo $u['purpose'];?></td>
                                        <td><?php  $u['paymentmode'];

                                            if($u['paymentmode']=='Cash')
                                            {

                                                
                                                echo $u['amount'];
                                            }



                                            else if($u['paymentmode']=='Cheque')
                                            {

                                              

                                                echo $u['chamount'];
                                            }



                                            else if($u['paymentmode']=='Bank')
                                            {

                                              


                                                echo $u['bamount'];
                                            }
                                            ?>
                                        </td>
                                           <td><?php  $u['paymentmode'];?>

                                            <?php if($u['paymentmode']=='Cash')
                                            {
                                                echo $u['paymentmode'];

                                                echo'<br>';
                                                // echo $u['amount'];
                                            }



                                            else if($u['paymentmode']=='Cheque')
                                            {

                                              echo $u['paymentmode'];

                                                echo"<br>";


                                              echo $u['throughcheck'];

                                                echo'<br>';
                                                echo $u['chequeno'];

                                            }



                                            else if($u['paymentmode']=='Bank')
                                            {
                                                  echo $u['paymentmode'];
                                                echo'<br>';
                                                echo $u['banktransfer'];


                                            }
                                            ?>
                                        </td>
                                    </tr>
                                   <?php } ?> -->
                                </tbody>
                            </table>
                                <div align="center">
             <button id="print" class="btn btn-info" value="Print">Print</button>
            <button id="download" class="btn btn-primary" value="Download">Download</button>

        </div>
                                </div>
                            </div>
                        </div>
                    </div>

		<!-- DELETE EXPENSES-->			
		<div id="delete_billing" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
			<div class="modal-dialog">
				<form id="delete_form">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
							<h4 class="modal-title">Delete Expenses</h4>
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


         <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
        <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>

 <script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>        

 <script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script>
		$('.colorpicker-default').colorpicker({ format: 'hex'  });
		$('.colorpicker-rgba').colorpicker();
		jQuery('#datepicker').datepicker();
		jQuery('.datepicker-autoclose').datepicker({ autoclose: true, todayHighlight: true });
		var table;
		$(document).ready(function(){
			$( "#name" ).autocomplete({
				source: function(request, response) {
					$.ajax({ 
						url: "<?php echo base_url();?>expenses/autocomplete_name",
						data: { keyword: $("#name").val()},
						dataType: "json",
						type: "POST",
						success: function(data){              
							response(data);
						}    
					});
				},
			});

			//DATA TABLES
			table = $('#table').DataTable({ 
				"processing": true, //Feature control the processing indicator.
				'bnDestroy' :true,
				"serverSide": true, //Feature control DataTables' server-side processing mode.
				"order": [], //Initial no order.
				"ajax": {
					"url": "<?php echo site_url('expenses/ajax_list')?>",
					"type": "POST",
					"data": function ( data ) {
						data.name = $('#name').val();
						data.headers = $('#headers').val();
						data.fromdate = $('#fromdate').val();
						data.todate = $('#todate').val();
					}
				},
				"columnDefs": [{  "targets": [ 0 ],"orderable": false,}],
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
				var name = $('#name').val();
				var headers = $('#headers').val();
				$.post('<?php echo base_url();?>expenses/search',{'fromdate':fromdate,'name':name,'headers':headers,'todate':todate},function(data){
					window.open('<?php echo base_url();?>expenses/search_reports', '_blank');
				});
			});
			
			$('#download').click(function(){
				var fromdate = $('#fromdate').val();
				var todate = $('#todate').val();
				var name = $('#name').val();
				var headers = $('#headers').val();
				$.post('<?php echo base_url();?>expenses/billing_reportdownload',{'fromdate':fromdate,'todate':todate,'headers':headers,'name':name},function(data){
					window.open('<?php echo base_url();?>expenses/search_reports', '_blank');
				});
			});
	
			$('#delete_form').submit(function(){
				var id = $('#hidden_delete_id').val();
				$('#dialogConfirm').text('Processing...');
				$('#dialogConfirm').attr('disabled',true); 
				$.post('<?php echo base_url(); ?>expenses/delete',{id:id},function(res){
					$('#dialogConfirm').text('Confirm');
					$('#dialogConfirm').attr('disabled',false);
					if(res=='yes')
					{
						$('#delete_billing').modal('hide');
						$('.success').show();
						table.ajax.reload(null,false);
					}
					else if(res=='no')
					{
						$('#delete_billing').modal('hide');
						$('.success').show();
						table.ajax.reload(null,false);
					}
				});
				return false;
			});
	
		});

	function edit_person(id)
	{
		$.post('<?php echo base_url();?>admin/add_billing/viewbilling',{'id':id},function(data){
			$('.viewdetails').html(data);
			$('#view_billing').modal('show');
		});
	}

	function delete_person(id)
	{
		$('#hidden_delete_id').val(id); 
		$('#delete_billing').modal('show'); 
	}
	</script>      

