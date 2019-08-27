<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
//print_r($rows);
//exit;
?>
	<title> <?php echo $r->companyname;?></title>
	<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
	<style type="text/css">
		.forms{ }
		.forms input{ width: 95%; }
		.uppercase { text-transform: uppercase; }
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
						<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
							<header class="panel-heading" style="color:rgb(255, 255, 255)">
								<?php foreach ($result as $rows) {  ?> <i class="zmdi zmdi-assignment-o">&nbsp;Edit Inward (<?php echo $rows['inwardno'];?>)</i><?php } ?>
							</header>
							<div class="card-box">
								<div class="row">
									<?php foreach ($result as $rows) {  ?>
									<form class="form-horizontal" data-parsley-validate novalidate  method="post"    action="<?php echo base_url();?>inward/update" >
										<div class="form-group ">
											<div class="col-md-8 forms">
												<div class="col-md-3">
													<div class="form-group">
														<label class="">Inward Date</label>
														<input type="hidden" class="form-control" name="id" id="id" value="<?php echo $rows['id'];?>" >
														<input type="hidden" class="form-control" name="inwardno" id="inwardno" value="<?php echo $rows['inwardno'];?>" >
														<input type="text" class="form-control datepicker-autoclose" name="inwarddate" id="inwarddate" value="<?php echo date('d-m-Y',strtotime($rows['inwarddate']));?>" >
													</div>
												</div>

												<div class="col-md-6">
													<div class="form-group">
														<label>Customer  Name</label>
														<input type="text" parsley-trigger="change" required class="form-control" name="cusname" id="cusname" value="<?php echo $rows['cusname'];?>">
														<div id="cusname_valid" style="position: absolute;"></div>
													</div>
												</div>

												<div class="col-md-3">
													<div class="form-group">
														<label>Customer DC No</label>
														<input type="text" class="form-control" name="customerdcno" id="customerdcno" value="<?php echo $rows['customerdcno'];?>" style="width:148px;">
														<div id="invoiceno_valid"></div>
													</div>
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label>Customer DC Date</label>
														<input type="text" class="form-control datepicker-autoclose" name="customerdcdate" id="customerdcdate" value="<?php echo date('d-m-Y',strtotime($rows['customerdcdate']));?>" style="width:148px;">
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Address</label>
													<textarea type="text" class="form-control" name="address" id="address" parsley-trigger="change" required  rows="3"><?php echo $rows['address'];?></textarea>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
										<table class="responsive table" width="100%">
											<thead> 
												<tr>
													<!-- <th>&nbsp;&nbsp;&nbsp;&nbsp;Item Code</th> -->
													<th>&nbsp;&nbsp;&nbsp;&nbsp;HSN Code</th>
													<th>&nbsp;&nbsp;&nbsp;&nbsp;Item Name</th>
													<th>&nbsp;&nbsp;UOM</th>
													<th>&nbsp;&nbsp;Qty</th>
													<th>&nbsp;&nbsp;Remarks</th>
												</tr>  
											</thead>
											<tbody>
											<?php
											$hsnno=explode('||',$rows['hsnno']);
											$uom=explode('||',$rows['uom']);
											$itemname=explode('||',$rows['itemname']);
											$item_desc=explode('||',$rows['item_desc']);
											$qty=explode('||',$rows['qty']);
											$remarks=explode('||',$rows['remarks']);
											$inward_delivery_id = explode(",",$rows['inward_delivery_id']);
											$count=count($itemname);
											for ($i=0; $i <$count ; $i++) { 
											?>
												<tr>
													<!-- <td><input class="form-control" id="itemno" type="text" name="itemno[]" value="">
													<div id="itemno_valid"></div>
													</td> -->
													<td><input type="hidden" name="inward_delivery_id[]" value="<?php echo $inward_delivery_id[$i];?>" /><input class="form-control" parsley-trigger="change" readonly id="hsnno<?php echo $i;?>" type="text" name="hsnno[]" value="<?php echo $hsnno[$i];?>">
													<div id="hsnno_valid<?php echo $i;?>"></div></td>

													<td><input class="form-control" parsley-trigger="change" required id="itemname<?php echo $i;?>" type="text" name="itemname[]" value="<?php echo $itemname[$i];?>">
													<div id="itemname_valid<?php echo $i;?>"></div><input type="text" name="item_desc[]" value="<?php echo $item_desc[$i];?>" style="margin-top: 2px;" class="form-control"></td>
													<td><input class="form-control" readonly id="uom<?php echo $i;?>" type="text" name="uom[]" value="<?php echo $uom[$i];?>"  autocomplete="off">
													<div id="qty_valid"></div></td>
													<td><input class="form-control" parsley-trigger="change" required id="qty<?php echo $i;?>" type="text" name="qty[]" value="<?php echo $qty[$i];?>"   autocomplete="off">
													<div id="qty_valid<?php echo $i;?>"></div></td>
													<td><input class="form-control" id="remarks<?php echo $i;?>" type="text" name="remarks[]" value="<?php echo @$remarks[$i];?>"  autocomplete="off">
													<div id="qty_valid"></div></td>
													<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>
												</tr>
											<?php } ?>
											</tbody>
											<tbody id="append"></tbody> 
										</table>
										<div class="col-sm-offset-10">
											<button type="button" class="btn btn-info add"><i class="fa fa-plus"></i></button>
											<input type="hidden"  id="hide" value="1">
										</div>
										
										<br>
										
										<div class="col-sm-offset-4">
											<button  class="btn btn-info" id="submit" name="save" value="save">Update</button>
											<!--  <button  class="btn btn-primary"  name="print" id="print" value="print">Print</button> -->
											<button type="reset"  class="btn btn-default" id="">Reset</button>
										</div>
									</form>
									<?php } ?>
								</div>
							</div>
						</section>
					</div>
				</div><!-- end col -->
			</div>
		</div>
	<script>
	var resizefunc = [];
	</script>
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

	<script type="text/javascript">
	$(document).ready(function() {
		$('form').parsley();
		
		$( "#cusname" ).autocomplete({
			source: function(request, response){
				$.ajax({ 
					url: "<?php echo base_url();?>inward/autocomplete_name",
					data: { keyword: $("#cusname").val()},
					dataType: "json",
					type: "POST",
					success: function(data){              
						response(data);
					}    
				});
			},
		});
		$('#cusname').blur(function(){
			var cusname=$('#cusname').val();
			$.post('<?php echo base_url();?>inward/get_name',{cusname:cusname},function(res){
				var obj=jQuery.parseJSON(res);
				$('#address').val(obj.address);
			});
			if(cusname !='')
			{
				$.post('<?php echo base_url();?>inward/check_cusname',{cusname:cusname},function(res){
					if(res > 0)
					{
						$('#cusname_valid').html('<span><font color="green">Available!</span>');
						$('#submit').attr('disabled',false);
						$('#print').attr('disabled',false);
					}
					else
					{ 
						$('#suppliername').focus();
						$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
						$('#submit').attr('disabled',true); //set button enable 
						$('#print').attr('disabled',true); //set button enable 
					}
				});
				return false;
			}
		}); 
		$('.remove').click(function(){
			$(this).parents('tr').remove();
		});
		$('.add').click(function(){
			var start=$('#hide').val();
			var total=Number(start)+1;
			$('#hide').val(total);
			var tbody=$('#append');
			$('<tr><td><input type="hidden" name="inward_delivery_id[]" value="" /><input class="form-control" readonly id="hsnno'+total+'" parsley-trigger="change" required type="text" name="hsnno[]" required value=""><div id="hsnno_valid'+total+'"></td><td><input class="form-control" parsley-trigger="change" required id="itemname'+total+'" type="text" name="itemname[]" value=""><div id="itemname_valid'+total+'"></div><input type="text" name="item_desc[]" value="" style="margin-top: 2px;" class="form-control"></td> <td><input class="form-control" readonly id="uom'+total+'" type="text" name="uom[]"  autocomplete="off"><div id="qty_valid"></div></td><td><input class="form-control" required id="qty'+total+'" type="text" parsley-trigger="change" required name="qty[]" autocomplete="off" value="" onkeypress="return isNumberKey(event)" required ><div id="qty_valid'+total+'"></td>'
			+'<td><input class="form-control"  id="remarks'+total+'" type="text" name="remarks[]" autocomplete="off" ><div id="qty_valid'+total+'"></td>'
			+'<td><button type="button" class="btn btn-danger remove"> <i class="fa fa-remove"></i></button></td></tr><div id="table'+total+'"></div>').appendTo(tbody);
			$('#itemno'+total+'').focus();
			
			$('.remove').click(function(){
				$(this).parents('tr').remove();
			});

			$( "#itemname"+total+"").autocomplete({
				source: function(request, response) {
					$.ajax({ 
						url: "<?php echo base_url();?>inward/autocomplete_itemname",
						data: { keyword: $("#itemname"+total+"").val()},
						dataType: "json",
						type: "POST",
						success: function(data){              
							response(data);
						}    
					});
				},
				select: function (event, ui) {
					var name=ui.item.value;
					$('#itemname'+total+'').val(ui.item.value);
					$.post('<?php echo base_url();?>inward/get_itemnames',{name:name},function(rest){
						var obj=jQuery.parseJSON(rest);
						$('#hsnno'+total+'').val(obj.hsnno);
						$('#uom'+total+'').val(obj.uom);
						$('#qty'+total+'').val('');
						$('#qty'+total+'').focus();
					}); 

					if(name !='')
					{
						$.post('<?php echo base_url();?>inward/check_itemname',{itemname:name},function(res){
							if(res > 0)
							{
								$('#itemname_valid'+total+'').html('<span><font color="green">Available!</span>');
								$('#submit').attr('disabled',false);
								$('#print').attr('disabled',false);
							}
							else
							{
								$('#itemname_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
								$('#submit').attr('disabled',true); //set button enable 
								$('#print').attr('disabled',true); //set button enable 
								//set button enable     
							}
						});
						return false;
					}
				}
			});

			$('#itemname'+total+'').blur(function(){
				var itemname=$('#itemname'+total+'').val();
				if(itemname !='')
				{
					$.post('<?php echo base_url();?>inward/check_itemname',{itemname:itemname},function(res){
						if(res > 0)
						{
							$('#itemname_valid'+total+'').html('<span><font color="green">Available!</span>');
							$('#submit').attr('disabled',false);
							$('#print').attr('disabled',false);
						}
						else
						{
							$('#itemname_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
							$('#submit').attr('disabled',true); //set button enable 
							$('#print').attr('disabled',true); //set button enable 
							//set button enable     
						}
					});
					return false;
				}
			});
		});
	});
	</script>

	<script>
	$('.colorpicker-default').colorpicker({ 	format: 'hex' });
	$('.colorpicker-rgba').colorpicker();
	// Date Picker
	jQuery('#datepicker').datepicker();
	jQuery('.datepicker-autoclose').datepicker({ autoclose: true, todayHighlight: true 	});
	</script>
	<script type="text/javascript">
	$(document).ready(function(){
	<?php
	for ($i=0; $i <$count ; $i++) { 
	?>

	$( "#itemname<?php echo $i;?>" ).autocomplete({
		source: function(request, response) {
			$.ajax({ 
				url: "<?php echo base_url();?>inward/autocomplete_itemname",
				data: { keyword: $("#itemname<?php echo $i;?>").val()},
				dataType: "json",
				type: "POST",
				success: function(data){              
					response(data);
				}    
			});
		},
		select: function (event, ui) {
			var name=ui.item.value;
			$('#itemname<?php echo $i;?>').val(ui.item.value);
			$.post('<?php echo base_url();?>inward/get_itemnames',{name:name},function(rest){
				var obj=jQuery.parseJSON(rest);
				$('#hsnno<?php echo $i;?>').val(obj.hsnno);
				$('#uom<?php echo $i;?>').val(obj.uom);
				$('#qty<?php echo $i;?>').val('');
				$('#qty<?php echo $i;?>').focus();
			}); 

			if(name !='')
			{
				$.post('<?php echo base_url();?>inward/check_itemname',{itemname:name},function(res){
					if(res > 0)
					{
						$('#itemname_valid<?php echo $i;?>').html('<span><font color="green">Available!</span>');
						$('#submit').attr('disabled',false);
						$('#print').attr('disabled',false);
					}
					else
					{
						$('#itemname_valid<?php echo $i;?>').html('<span><font color="red"> Not Available !</span>');
						$('#submit').attr('disabled',true); //set button enable 
						$('#print').attr('disabled',true); //set button enable 
						//set button enable     
					}
				});
				return false;
			}
		}
	});

	$('#itemname<?php echo $i;?>').blur(function(){
		var itemname=$('#itemname<?php echo $i;?>').val();
		var mobileno=$('#mobileno').val();
		// var qty=$('#qty').val();
		if(itemname !='')
		{
			$.post('<?php echo base_url();?>inward/check_itemname',{itemname:itemname},function(res){
				if(res > 0)
				{
					$('#itemname_valid<?php echo $i;?>').html('<span><font color="green">Available!</span>');
					$('#submit').attr('disabled',false);
					$('#print').attr('disabled',false);
				}
				else
				{ 
					$('#itemname<?php echo $i;?>').focus();
					$('#itemname_valid<?php echo $i;?>').html('<span><font color="red"> Not Available !</span>');
					$('#submit').attr('disabled',true); //set button enable 
					$('#print').attr('disabled',true); //set button enable 
				}
			});
			return false;
		}
	});

	<?php } ?>
	</script>
<?php /* 

	$('.add').click(function(){
	var start=$('#hide').val();
	var total=Number(start)+1;
	$('#hide').val(total);
	var tbody=$('#append');
	$('<tr><td><input class="form-control" readonly id="hsnno'+total+'" parsley-trigger="change" required type="text" name="hsnno[]" required value=""><div id="hsnno_valid'+total+'"></td><td><input class="form-control" parsley-trigger="change" required id="itemname'+total+'" type="text" name="itemname[]" value=""><div id="itemname_valid'+total+'"></td> <td><input class="form-control" readonly id="uom'+total+'" type="text" name="uom[]"  autocomplete="off"><div id="qty_valid"></div></td><td><input class="form-control" required id="qty'+total+'" type="text" parsley-trigger="change" required name="qty[]" autocomplete="off" value="" onkeypress="return isNumberKey(event)" required ><div id="qty_valid'+total+'"></td>'
	+'<td><input class="form-control"  id="remarks'+total+'" type="text" name="remarks[]" autocomplete="off" ><div id="qty_valid'+total+'"></td>'
	+'<td><button type="button" class="btn btn-danger remove"> <i class="fa fa-remove"></i></button></td></tr><div id="table'+total+'"></div>').appendTo(tbody);
	$('#itemno'+total+'').focus();

	$('.remove').click(function(){
	$(this).parents('tr').remove();

	});





	$( "#itemname"+total+"").autocomplete({
	source: function(request, response) {
	$.ajax({ 
	url: "<?php echo base_url();?>inward/autocomplete_itemname",
	data: { keyword: $("#itemname"+total+"").val()},
	dataType: "json",
	type: "POST",
	success: function(data){              
	response(data);
	}    
	});
	},
	select: function (event, ui) {

	var name=ui.item.value;
	$('#itemname'+total+'').val(ui.item.value);
	$.post('<?php echo base_url();?>inward/get_itemnames',{name:name},function(rest){
	var obj=jQuery.parseJSON(rest);
	$('#hsnno'+total+'').val(obj.hsnno);
	$('#uom'+total+'').val(obj.uom);
	$('#qty'+total+'').val('');
	$('#qty'+total+'').focus();
	}); 

	if(name !='')
	{
	$.post('<?php echo base_url();?>inward/check_itemname',{itemname:name},function(res){
	if(res > 0)
	{
	$('#itemname_valid'+total+'').html('<span><font color="green">Available!</span>');
	$('#submit').attr('disabled',false);
	$('#print').attr('disabled',false);
	}
	else
	{

	$('#itemname_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
	$('#submit').attr('disabled',true); //set button enable 
	$('#print').attr('disabled',true); //set button enable 
	//set button enable     
	}
	});
	return false;
	}


	}
	});











	$('#itemname'+total+'').blur(function(){
	var itemname=$('#itemname'+total+'').val();



	if(itemname !='')
	{
	$.post('<?php echo base_url();?>inward/check_itemname',{itemname:itemname},function(res){
	if(res > 0)
	{
	$('#itemname_valid'+total+'').html('<span><font color="green">Available!</span>');
	$('#submit').attr('disabled',false);
	$('#print').attr('disabled',false);
	}
	else
	{

	$('#itemname_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
	$('#submit').attr('disabled',true); //set button enable 
	$('#print').attr('disabled',true); //set button enable 
	//set button enable     
	}
	});
	return false;
	}


	});



	});
	});
	</script>
*/ ?>
	<script type="text/javascript">

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

	$('.decimal').keyup(function(){
		var val = $(this).val();
		if(isNaN(val)){
			val = val.replace(/[^0-9\.-]/g,'');
		if(val.split('.').length>2)
			val =val.replace(/\.-+$/,"");
		}
		$(this).val(val);
	});
	</script>


