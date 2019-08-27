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
	</style>


	<div class="content-page">
		<!-- Start content -->
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
							<i class="zmdi zmdi-view-headline">&nbsp;Itemwise  Reports</i>
						</header>
						
							<div class="card-box table-responsive" style="min-height:400px;">
								<div class="dropdown pull-right">
									<a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false"></a>
								</div>
								<form name="from" id="form-filter" method="post" action="<?php echo base_url().'itemwise_report/printReport';?>" onsubmit="return funvalidate();">
									<table>
										<tr>
											<td>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="itemno" id="itemno" style="font-size:16px;width: 140px;" value="" placeholder="HSN No">
												</div>
											</td>

											<td>
												<div class="col-sm-12">
													<input type="text" class="form-control" name="itemname" id="itemname" style="font-size:16px;width: 255px;" value="" placeholder="Item Name">
													<div id="itemname_valid" style="color:red"></div>
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
											<td></td>
											<td>&nbsp;&nbsp;&nbsp;</td>
										
											<td>
												<button type="submit" id="btn-filter" class="btn btn-primary">Print</button>
												<button type="button" id="btn-reset" class="btn btn-default">Reset</button>
											</td>
										</tr>
									</table>
								</form>
							</div><!-- card-box table-responsive -->
						</section>
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
	$('.colorpicker-default').colorpicker({	format: 'hex'	});
	$('.colorpicker-rgba').colorpicker();
	// Date Picker
	jQuery('#datepicker').datepicker();
	jQuery('.datepicker-autoclose').datepicker({autoclose: true,todayHighlight: true});

	
	$(document).ready(function(){
		$( "#itemname" ).autocomplete({
			source: function(request, response) {
				$.ajax({ 
					url: "<?php echo base_url();?>itemwise_report/autocomplete_itemname",
					data: { keyword: $("#itemname").val()},
					dataType: "json",
					type: "POST",
					success: function(data){              
						response(data);
					}    
				});
			},
		});

		$( "#itemno" ).autocomplete({
			source: function(request, response) {
				$.ajax({ 
					url: "<?php echo base_url();?>itemwise_report/autocomplete_itemcode",
					data: { keyword: $("#itemno").val()},
					dataType: "json",
					type: "POST",
					success: function(data){              
						response(data);
					}    
				});
			},
		});
		$('#itemno').blur(function(){
			var itemcode=$('#itemno').val();
			$.post('<?php echo base_url();?>stockmaster/get_itemcode',{itemcode:itemcode},function(res){   
				var obj=jQuery.parseJSON(res);
				$('#itemname').val(obj.itemname);
				$('#itemno').val(obj.hsnno);   
			});
		});
		$('#btn-reset').click(function(){ //button reset event click
			$('#form-filter')[0].reset();
		});
	});//document.ready
	
	function funvalidate()
	{
		if($("#itemname").val()=="")
		{
			$("#itemname_valid").html("Please enter item name!");
			return false;
		}
		else
		{
			$("#itemname_valid").html("");
			return true;
		}
	}
	</script>


	<script type="text/javascript">
/*
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
	"url": "<?php echo site_url('daily_stockreports/ajax_list')?>",
	"type": "POST",
	"data": function ( data ) {
	data.itemno = $('#itemno').val();
	data.itemname = $('#itemname').val();
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
	var itemno = $('#itemno').val();
	var itemname = $('#itemname').val();

	$.post('<?php echo base_url();?>daily_stockreports/search',{'fromdate':fromdate,'itemname':itemname,'todate':todate,'itemno':itemno},function(data){

	window.open('<?php echo base_url();?>daily_stockreports/search_reports', '_blank');

	});

	});

	$('#download').click(function(){
	var fromdate = $('#fromdate').val();
	var todate = $('#todate').val();
	var itemno = $('#itemno').val();
	var itemname = $('#itemname').val();

	$.post('<?php echo base_url();?>daily_stockreports/billing_reportdownload',{'fromdate':fromdate,'todate':todate,'itemno':itemno,'itemname':itemname},function(data){

	window.open('<?php echo base_url();?>daily_stockreports/search_reports', '_blank');

	});

	});

	});

	function edit_person(id)
	{

	//alert(id);

	$.post('<?php echo base_url();?>admin/add_billing/viewbilling',{'id':id},function(data){

	$('.viewdetails').html(data);

	$('#view_billing').modal('show');

	});
	}
	
	*/
	</script>      

