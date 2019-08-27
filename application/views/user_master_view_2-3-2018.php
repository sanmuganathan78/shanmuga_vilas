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
				<a href="#" class="close" data-dismiss="alert">&times;</a>User deleted Successfully !
				</div>
				
				<!-- ITEM MASTER -->
				<div class="row">
					<div class="col-sm-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-user"></i>User Manager
								</div>
								<div class="tools">
									<?php if($this->validation->sid!="") { ?>
									<a href="<?php echo base_url().'usermaster/updatetoadd';?>"  style="color:white;"><i class="fa fa-plus"></i> Add User</a>
									<?php } else { ?>
									<a href="javascript:;" data-toggle="collapse" data-target="#form_div" style="color:white;"><i class="fa fa-plus"></i> Add User</a>
									<?php } ?>
									<!--<a href="javascript:void()" onclick="upload_excel()" style="color:white;"> <i class="fa fa-upload"></i> Upload Excel</a>
									<a href="<?php echo base_url();?>assets/ItemImport.xlsx"  style="color:white;"> <i class="fa fa-download"></i>&nbsp; Sample Excel</a>-->
								</div>
							</div>
							<div class="portlet-body form">
								<div class="collapse <?php if ($id != ""){ echo "in";} ?>" id="form_div">
									<div class="row-fluid well">
										<form name="logoForm" id="logoForm" class="form-horizontal" action="<?php echo $action;?>" method="post" onsubmit="return validateForm();">
											<input type="hidden" name="sid" value="<?php echo $this->validation->sid; ?>"/>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">User Name<span style="color:red;">&nbsp;*</span></label>
														<input type="text" class="form-control" name="username" autocomplete="off" id="username" value="<?php echo $this->validation->username;?>">
														<div id="username_valid"></div>
														<?php echo form_error('username'); ?>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Designation<span style="color:red;">&nbsp;*</span></label>
														<input type="text" class="form-control" name="designation" autocomplete="off" id="designation" value="<?php echo $this->validation->designation;?>">
														<div id="designation_valid"></div>
														<?php echo form_error('designation'); ?>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Password<span style="color:red;">&nbsp;*</span></label>
														<input type="text" class="form-control" name="password" autocomplete="off" id="password" value="<?php echo $this->validation->password;?>">
														<div id="password_valid"></div>
														<?php echo form_error('password'); ?>
													</div>
												</div>
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Mobile No</label>
														 <input type="text" class="form-control" name="phoneno" autocomplete="off" id="phoneno" value="<?php echo $this->validation->phoneno;?>" >
														 <div id="phoneno_valid"></div>
														 <?php echo form_error('phoneno'); ?>
													</div>
												</div>
											</div>
											
											<div class="row">
												<!--/span-->
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">E-Mail</label>
														<input type="text" autocomplete="off" placeholder="E-Mail" class="form-control" name="email" id="email" value="<?php echo $this->validation->email;?>">
														 <?php echo form_error('email'); ?>
													</div>
												</div>
												<!--/span-->
												
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Date of Joining</label>
														<input type="text" autocomplete="off" class="form-control datepicker-autoclose" name="doj" id="doj" value="<?php echo $this->validation->doj;?>">
														 <?php echo form_error('doj'); ?>
													</div>
												</div>
												<!--/span-->
											</div>
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Select Menu Privileges</label>
														<div id="treeview-container">
															<ul>
																<li data-value="dashboard" data-alt="dashboard">Dashboard</li>
																<li>Sales Invoice
																	<ul>
																		<li data-value="invoice" data-alt="Sales Invoice">Add Invoice</li>
																		<li data-value="invoice/view"  data-alt="Sales Invoice">Invoice Reports</li>
																		<li data-value="invoice_statement/view"  data-alt="Sales Invoice">Invoice Party Statement</li>
																		<li data-value="tax/view"  data-alt="Sales Invoice">Invoice Tax Reports</li>
																		<li data-value="proforma_invoice" data-alt="Sales Invoice">Add Proforma Invoice</li>
																		<li data-value="proforma_invoice/view"  data-alt="Sales Invoice">Proforma Invoice Reports</li>
																	</ul>
																</li>
																<li>Cash Bill
																	<ul>
																		<li data-value="cashbill"  data-alt="Cash Bill">Add Cash Bill</li>
																		<li data-value="cashbill/listing" data-alt="Cash Bill">Cash Bill Reports</li>
																	</ul>
																</li>

																<li>Purchase
																	<ul>
																		<li data-value="purchase" data-alt="Purchase">Purchase Receipt</li>
																		<li data-value="purchase/reports" data-alt="Purchase">Purchase Reports</li>
																		<li data-value="purchase_statement/view" data-alt="Purchase">Purchase Party Statement</li>
																		<li data-value="purchasetax/view" data-alt="Purchase">Purchase Tax Reports</li>
																	</ul>
																</li>
																<li>Voucher
																	<ul>
																		<li data-value="voucher" data-alt="Voucher">Add Voucher</li>
																		<li data-value="voucher/reports" data-alt="Voucher">Voucher Reports</li>
																		<li data-value="salesreturn" data-alt="Voucher">Debit (or) Credit Note</li>
																		<li data-value="salesreturn/view" data-alt="Voucher">Debit (or) Credit Note Reports</li>
																	</ul>
																</li>
																<li>Inward
																	<ul>
																		<li data-value="inward" data-alt="Inward">Add Inward</li>
																		<li data-value="inward/view" data-alt="Inward">Inward Reports</li>
																		<li data-value="inward/pending" data-alt="Inward">Inward Pending</li>
																		<!--<li data-value="inwardstock" data-alt="Inward">Inward Stock</li>-->
																	</ul>
																</li>
																<li>DC
																	<ul>
																		<li data-value="dcbill" data-alt="DC">Add DC</li>
																		<li data-value="dcbill/view"  data-alt="DC">DC Reports</li>
																		<li data-value="dcbill/pending"  data-alt="DC">DC Pending</li>
																	</ul>
																</li>
																<li>Stock
																	<ul>
																		<li data-value="stockmaster"  data-alt="Stock">Add Stock</li>
																		<li data-value="daily_stockreports"  data-alt="Stock">Daily Stock Reports</li>
																		<li data-value="itemwise_report"  data-alt="Stock">Itemwise Reports</li>
																		<!--<li data-value="jobinward"  data-alt="Job Order">Job Inward</li>
																		<li data-value="jobinward/view"  data-alt="Job Order">Job Inward Reports</li>
																		<li data-value="operatormaster"  data-alt="Job Order">Operator Master</li>
																		<li data-value="vendormaster"  data-alt="Job Order">Vendor Master</li>
																		<li data-value="stockmaster"  data-alt="Job Order">Godown Stock</li>
																		<li data-value="salesstockmaster"  data-alt="Job Order">Sales Stock Reports</li>
																		<li data-value="purchase_statement_jo/view"  data-alt="Job Order">Vendor Party Statement</li>-->
																	</ul>
																</li>
																<li>Reports
																	<ul>
																		<li data-value="customer/view"  data-alt="Reports">Party Reports</li>
																		<li data-value="expenses/reports" data-alt="Reports">Expenses Reports</li>
																		<li data-value="quotation/view" data-alt="Reports">Quotation Reports</li>
																	</ul>
																</li>
																<li>Settings
																	<ul>
																		<li data-value="taxtype" data-alt="Settings">Tax Type</li>
																		<li data-value="uom" data-alt="Settings">Add UOM</li>
																		<li data-value="itemmaster" data-alt="Settings">Add Item</li>
																		<li data-value="headers" data-alt="Settings">Account Headers</li>
																		<li data-value="profile" data-alt="Settings">Company Profile</li>
																		<!--<li data-value="category" data-alt="Settings">Add Category</li>-->
																		<li data-value="backup" data-alt="Settings">Backup Settings</li>
																		<li data-value="support" data-alt="Settings">Support</li>
																		<li data-value="usermaster" data-alt="Settings">User Manager</li>
																	</ul>
																</li>
															</ul>
															<div class="fa-ul">
																<input type="checkbox" class="tw-control" name="add_party" value="1" <?php if($this->validation->add_party=='1') { echo 'checked="checked"'; } ?>> Add Party<br />
																<input type="checkbox" class="tw-control" name="add_expenses" value="1" <?php if($this->validation->add_expenses=='1') { echo 'checked="checked"'; } ?>> Add Expenses<br />
																<input type="checkbox" class="tw-control" name="add_quotation" value="1" <?php if($this->validation->add_quotation=='1') { echo 'checked="checked"'; } ?>> Add Quotation
															</div>
															<input id="sub_menu_link" name="sub_menu_link" type="hidden" value="<?php echo $this->validation->sub_menu_link;?>" />
															<input id="selectedMainMenu" name="selectedMainMenu" type="hidden" value="<?php echo $this->validation->selectedMainMenu;?>"  />
															<input id="selectedSubMenu" name="selectedSubMenu" type="hidden" value="<?php echo $this->validation->selectedSubMenu;?>"  />
														</div>
													</div>
												</div>
											</div>
											<!--<div class="row">selectedMainMenu
											<div class="col-lg-3">
												
												</div>
												<div class="col-lg-6">
												<button type="button" id="show-sub_menu_link" class="btn btn-danger">Get Values</button><br>
										<br>

												<pre id="sub_menu_link" class="well"></pre>
										</div>
										</div>-->
										
											<div class="row">
												<div class="form-actions">
													<div class="col-md-offset-4 col-md-10">
														<?php if($this->validation->sid!="") { ?>
														<button type="submit" id="submit" class="btn btn-success">Update</button>
														<input type="button" class="btn btn" value="Cancel" onclick="window.location.href='<?php echo base_url();?>index.php/usermaster';"/>
														<?php } else { ?>
														<button type="submit" id="submit" class="btn btn-success" >Save</button>
														<input type="button" class="btn btn resetButn" value="Cancel" data-toggle="collapse" data-target="#form_div" />
														<?php } ?>
													</div>
												</div>
											</div>
										</form>
									</div>
								</div>
								
								<div class="card-box table-responsive">
									<!-- START HERE-->
									<form method="post" id="form-filter" action="<?php echo base_url();?>vendormaster/search">
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
									<div class="row">
										<div class="l-col-md-12">
										  <div  class="AjaxResult"><!--table-responsive-->
											 <table id="s" class="table table-striped table-bordered">
												<thead>
													<tr>
														<th>S.No</th>
														<th>Date</th>
														<th>User Name</th>
														<th>Designation</th>
														<th>Mobile No.</th>
														<th>Email</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table> 
										  </div>
										</div>
									</div>
									<!--<form name="form" method="post" action="<?php echo base_url();?>vendormaster/reports" target="_blank" >
									<table>
									  <tr>
										<td><input type="hidden" name="fromdate" id="pfromdate" class="form-control" value="<?php if($this->input->post('fromdate')){echo $this->input->post('fromdate');}?>"></td>
										  <td><input type="hidden" name="todate" id="ptodate" class="form-control" value="<?php if($this->input->post('todate')){echo $this->input->post('todate');}?>"></td>

										  <td><input type="submit" class="btn btn-info" name="submit" value="Print Reports" style="margin-left:400px;"></td>
										</tr>
									  </table>
									</form>-->
								</div>
							</div>
						</div>
					</div>
				</div><!-- END OF ROW-->
			</div>
		</div>
	</div>

	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url('assets/datatables/js/jquery.dataTables.min.js')?>"></script>
	<script src="<?php echo base_url('assets/datatables/js/dataTables.bootstrap.js')?>"></script>
	<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>  
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
	<script>
		$(document).ready(function(){
			$('.resetButn').click(function(){
				$('#logoForm')[0].reset();
				$('#username_valid').html('');
			});
			jQuery('.datepicker-autoclose').datepicker({ autoclose: true,todayHighlight: true });
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
					"url": "<?php echo site_url('usermaster/ajax_list')?>",
					"type": "POST",
					"data": function ( data ) {
						data.fromdate = $('#sfromdate').val();
						data.todate = $('#stodate').val();
					}
				},
				"columnDefs": [{ "targets": [ -1 ], "orderable": false,}],
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
			//ITEM NAME ON CHANGE.
			$('#username').keyup(function(){ 
				var name=$(this).val();
				var id = '<?php echo $this->validation->sid; ?>';
				if(name !='')
				{
					$.post('<?php echo base_url();?>usermaster/getname',{name:name,id:id},function(res){
						if(res > 0)
						{
							$('#username').focus();
							$('#username_valid').html('<span><font color="red">Name already taken!</span>');
							$('#submit').attr('disabled',true); //set button enable 
						}
						else
						{
							$('#username_valid').html('<span><font color="green">Available !</span>');
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
					"username"		: { "required": true	},
					"designation"	: { "required": true	},
					"password"		: { "required": true	}
					
				},
				"messages": {
					"username"		: { "required": "User Name cannot be blank."	},
					"designation"	: { "required": "Designation cannot be blank."		},
					"password"		: { "required": "Password cannot be blank."		}
				}/*,
				submitHandler: function(form) {
				 //do ajax call
				 console.log('yes');
				 validateForm();
			   }
				*/
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
		if(confirm('Are you sure to delete this user?'))
		{
			$.ajax({
				url : "<?php echo site_url('usermaster/ajax_delete')?>/"+id,
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
<script src="<?php echo base_url();?>assets/js/logger.js"></script>
<script src="<?php echo base_url();?>assets/js/treeview.js"></script>
<?php
if($this->validation->sub_menu_link!="")
{
	$seldMenu = "'" . implode ( "', '", explode(",",$this->validation->sub_menu_link) ) . "'";
}
else
{
	$seldMenu = "";
}
?>
<script>
$(document).ready(function(){
	$('#treeview-container').treeview({
		debug : true,
		data : [<?php echo $seldMenu;?>]
	});
	$('#show-sub_menu_link').on('click', function(){
		//$('#sub_menu_link').text($('#treeview-container').treeview('selectedValues'));
		var selectedVal = $('#treeview-container').treeview('selectedValues');
	 console.log(selectedVal);
	 
	$('#sub_menu_link').val(selectedVal[0]);
	$('#selectedMainMenu').val(selectedVal[1]);
	$('#selectedSubMenu').val(selectedVal[2]);
	});
});
function validateForm()
{
	 
	 var selectedVal = $('#treeview-container').treeview('selectedValues');
	 console.log(selectedVal);
	 
	$('#sub_menu_link').val(selectedVal[0]);
	$('#selectedMainMenu').val(selectedVal[1]);
	$('#selectedSubMenu').val(selectedVal[2]);
}
</script>