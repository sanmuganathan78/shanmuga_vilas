<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>
	<title><?php echo $r->companyname;?></title>
	<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
	<style>     
		#cash,#mamount,#through,#bank,#cards{  display:none;  }
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
								<i class="zmdi zmdi-money-box">&nbsp;Expenses</i>  ( <?php echo $result->expensesid;?> )
							</header>
							<div class="card-box">
								<div class="row">
									<form class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>expenses/update" name="updateForm">
										<input type="hidden" name="id" id="id" value="<?php echo $result->id;?>">
										<input type="hidden" name="expensesid" value="<?php echo $result->expensesid;?>" >
										<div class="form-group">
											<label for="inputPassword" class="col-lg-3 control-label">Date</label>
											<div class="col-lg-3">
												<input type="text" name="expensesdate" class="form-control datepicker-autoclose" id="datepicker-autoclose" placeholder=""  value="<?php echo date('d-m-Y',strtotime($result->expensesdate));?>" required>
											</div>
										</div>

										<div class="form-group">
											<label for="inputStandard" class="col-lg-3 control-label">Account Head</label>
											<div class="col-lg-3">
												<select name="headers" class="form-control" required>
													<option value="">Select</option>
													<?php 
													$headers=$this->db->get('headers')->result();
													foreach($headers as $h){
														echo '<option value="'.$h->name.'">'.strtoupper($h->name).'</option>';
													} ?>
												</select>
												<script>document.updateForm.headers.value='<?php echo $result->headers;?>';</script>
											</div>
										</div>

										<div class="form-group">
											<label for="inputStandard" class="col-lg-3 control-label">Name <span style="color:red;font-size:18px;">*</span></label>
											<div class="col-lg-3">
												<input type="text" name="name" id="username" class="form-control character" value="<?php echo $result->name;?>" >
												<span id="name_valid"></span>
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword" class="col-lg-3 control-label">Purpose<span style="color:red;font-size:18px;">&nbsp;*</span></label>
											<div class="col-lg-3">
												<input type="text" name="purpose" class="form-control" id="purpose" value="<?php echo $result->purpose;?>" >
												<div id="purpose_valid"></div>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-sm-3">Payment Mode</label>
											<div class="controls col-sm-1">
												<input type="radio" name="paymentmode" id="optionsRadios1" value="Cash" onchange="cash()" <?php if($result->paymentmode=='Cash') { echo 'checked'; } ?>> Cash
											</div>
											<div class="controls col-sm-1" style="width:100px;">
												<input type="radio" name="paymentmode" id="optionsRadios2" value="Cheque" onchange="check()" <?php if($result->paymentmode=='Cheque') { echo 'checked'; } ?>> Cheque
											</div>
											<div class="controls col-sm-1" style="width:142px;">
												<input type="radio" name="paymentmode" id="optionsRadios3" value="Bank" onchange="bank()" <?php if($result->paymentmode=='Bank') { echo 'checked'; } ?>> RTGS/ Neft
											</div>
											<div class="controls col-sm-1" style="width:142px;">
												<input type="radio" name="paymentmode" id="optionsRadios4" value="Card" onchange="card()" <?php if($result->paymentmode=='Card') { echo 'checked'; } ?>> Card
											</div>
										</div>

										<div  id="through" class="form-group" >
											<div class="form-group">                                
												<label class="control-label col-sm-3">Bank Name</label>
												<div class="col-lg-3">
													<select  name="throughcheck" class="form-control" id="tc" data-rel="chosen1" required>
														<option value="0">--Select--</option>
														<option value="ANDHRA BANK">ANDHRA BANK</option>
														<option value="AXIS">AXIS</option>
														
														<option value="BANK OF AMERICA">BANK OF AMERICA</option>
														<option value="BANK OF BARODA">BANK OF BARODA</option>
														<option value="BANK OF INDIA">BANK OF INDIA</option>
														
														<option value="CANARA BANK">CANARA BANK</option>
														<option value="CATHOLIC SYRIAN BANK">CATHOLIC SYRIAN BANK</option>
														<option value="CENTRAL BANK OF INDIA">CENTRAL BANK OF INDIA</option>
														<option value="CITI BANK">CITI BANK</option>
														<option value="CORPORATION BANK">CORPORATION BANK</option>
														
														<option value="FEDERAL BANKLTD">FEDERAL BANK LTD</option>
														
														<option value="HDFC BANK">HDFC BANK</option>
														<option value="HSBC BANK">HSBC BANK</option>
														
														<option value="ICICI BANK">ICICI BANK</option>
														<option value="INDIAN BANK">INDIAN BANK</option>
														<option value="INDIAN OVERSEAS">INDIAN OVERSEAS</option>
														<option value="ING VYSYA">ING VYSYA</option>
														
														<option value="KARUR VYSYA BANK">KARUR VYSYA BANK</option>
														<option value="KOTAK MAHINDRA">KOTAK MAHINDRA</option>
														
														<option value="SOUTH INDIAN">SOUTH INDIAN</option>    
														<option value="STATE BANK OF HYDRABAD">STATE BANK OF HYDRABAD</option>											
														<option value="STATE BANK OF INDIA">STATE BANK OF INDIA</option>	
														<option value="SYNDICATE">SYNDICATE</option>
														
														<option value="TAMILNADU MERCHANTILE">TAMILNADUMERCHANTILE</option>
														
														<option value="UCO BANK">UCO BANK</option>
														<option value="UNION BANK OF INDIA">UNION BANK OF INDIA</option>
														<option value="UNITED BANK OF INDIAN">UNITED BANK OF INDIAN</option>
														<option value="UNITED BANK OF INDIA">UNITED BANK OF INDIA</option>
													</select>
													<script>document.updateForm.throughcheck.value='<?php echo $result->throughcheck;?>';</script>
													<span id="tc_valid"></span>
												</div>
											</div>


											<div class="form-group">                                
												<label class="control-label col-sm-3">Cheque No</label>
												<div class="col-lg-3">
													<input type="text"  class="form-control decimal" id="chequeno" name="chequeno" data-provide="typeahead" value="<?php echo $result->chequeno;?>" >
													<span id="chequeno_valid"></span>
												</div>
											</div>

											<div class="form-group">                                
												<label class="control-label col-sm-3">Amount</label>
												<div class="col-lg-3">
													<input type="text"  class="form-control decimal" min="0" max="9999999999"  id="chamount" name="chamount" data-provide="typeahead"  value="<?php echo $result->chamount;?>" >
													<span id="chamount_valid"></span>
													<span id="chamounts_valid"></span>
												</div>
											</div>
										</div>

										<div  id="bank" >
											<div class="form-group">                                
												<label class="control-label col-sm-3">Bank Name</label>
												<div class="col-lg-3">
													<select  name="banktransfer" class="form-control"  id="ss" data-rel="chosen1" required>
														<option value="0" >--Select--</option>
														<option value="ANDHRA BANK">ANDHRA BANK</option>
														<option value="AXIS">AXIS</option>
														
														<option value="BANK OF AMERICA">BANK OF AMERICA</option>
														<option value="BANK OF BARODA">BANK OF BARODA</option>
														<option value="BANK OF INDIA">BANK OF INDIA</option>
														
														<option value="CANARA BANK">CANARA BANK</option>
														<option value="CATHOLIC SYRIAN BANK">CATHOLIC SYRIAN BANK</option>
														<option value="CENTRAL BANK OF INDIA">CENTRAL BANK OF INDIA</option>
														<option value="CITI BANK">CITI BANK</option>
														<option value="CORPORATION BANK">CORPORATION BANK</option>
														
														<option value="FEDERAL BANKLTD">FEDERAL BANK LTD</option>
														
														<option value="HDFC BANK">HDFC BANK</option>
														<option value="HSBC BANK">HSBC BANK</option>
														
														<option value="ICICI BANK">ICICI BANK</option>
														<option value="INDIAN BANK">INDIAN BANK</option>
														<option value="INDIAN OVERSEAS">INDIAN OVERSEAS</option>
														<option value="ING VYSYA">ING VYSYA</option>
														
														<option value="KARUR VYSYA BANK">KARUR VYSYA BANK</option>
														<option value="KOTAK MAHINDRA">KOTAK MAHINDRA</option>
														
														<option value="SOUTH INDIAN">SOUTH INDIAN</option>    
														<option value="STATE BANK OF HYDRABAD">STATE BANK OF HYDRABAD</option>											
														<option value="STATE BANK OF INDIA">STATE BANK OF INDIA</option>	
														<option value="SYNDICATE">SYNDICATE</option>
														
														<option value="TAMILNADU MERCHANTILE">TAMILNADUMERCHANTILE</option>
														
														<option value="UCO BANK">UCO BANK</option>
														<option value="UNION BANK OF INDIA">UNION BANK OF INDIA</option>
														<option value="UNITED BANK OF INDIAN">UNITED BANK OF INDIAN</option>
														<option value="UNITED BANK OF INDIA">UNITED BANK OF INDIA</option>
													</select>
													<script>document.updateForm.banktransfer.value='<?php echo $result->banktransfer;?>';</script>
													<div id="ss_valid"></div>
												</div>
											</div>
											<div class="form-group">                                
												<label class="control-label col-sm-3">Transaction ID</label>
												<div class="col-lg-4">
													<input type="text"  class="form-control decimal"   name="transactionid" data-provide="typeahead"  value="<?php echo $result->transactionid;?>">
												</div>
											</div>
											<div class="form-group">                                
												<label class="control-label col-sm-3">Amount</label>
												<div class="col-lg-3">
													<input type="text"  class="form-control decimal" min="0" max="9999999999"  id="bamount" name="bamount" data-provide="typeahead"  value="<?php echo $result->bamount;?>">
													<span id="bamount_valid"></span>
													<span id="bamounts_valid"></span>
												</div>
											</div>
										</div>
										
										<div id="cash" >
											<div class="form-group">                                
												<label class="control-label col-sm-3">Amount</label>
												<div class="col-lg-3">
													<input type="text"  class="form-control decimal" min="0" max="9999999999"  id="amount" name="amount" value="<?php echo $result->amount;?>">
													<span id="amount_valid"></span>
													<span id="amounts_valid"></span>
												</div>
											</div>
										</div>

										<div id="cards" >
											<div class="form-group">                                
												<label class="control-label col-sm-3">Card Type </label>
												<div class="col-lg-3">
													<select type="text"  class="form-control"  name="cardtype">
														<?php 
														$getcard=$this->db->get('card')->result();
														
														foreach($getcard as $g){
															echo '<option value="'.$g->name.'">'.$g->name.'</option>';
														} ?>
													</select>
													<script>document.updateForm.cardtype.value='<?php echo $result->cardtype;?>';</script>
													<span id="cardtype_valid"></span>
												</div>
											</div>
											
											<div class="form-group">                                
												<label class="control-label col-sm-3">Amount</label>
												<div class="col-lg-3">
													<input type="text"  class="form-control decimal" min="0" max="9999999999"  id="cardamount" name="cardamount" value="<?php echo $result->overallamount;?>">
													<span id="cardamount_valid"></span>
												</div>
											</div>
										</div>

										<div class="col-sm-offset-4">
											<button  class="btn btn-info" id="submit" name="save" value="save">Update </button>
											<button type="button" class="btn btn-success"  name="print" onclick="javascript:window.location.href='<?php echo base_url().'expenses/reports';?>';" ><i class="fa fa-chevron-left"></i> Back to Expenses Report </button>
											
										</div>  
									</form>
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

	<script>
	$('.colorpicker-default').colorpicker({ format: 'hex' });
	$('.colorpicker-rgba').colorpicker();
	// Date Picker
	jQuery('#datepicker').datepicker();
	jQuery('#datepicker-autoclose').datepicker({ autoclose: true,todayHighlight: true });
	
	$(document).ready(function(){
		$('.decimal').keyup(function(){
			var val = $(this).val();
			if(isNaN(val)){
				val = val.replace(/[^0-9\.]/g,'');
			if(val.split('.').length>2)
				val =val.replace(/\.+$/,"");
			}
			$(this).val(val);
		});

		$('#submit').click(function()
		{
			var username=$('#username').val();
			var amount=$('#amount').val();
			var tc=$('#tc').val();
			var chequeno=$('#chequeno').val();
			var chamount=$('#chamount').val();
			var bank=$('#ss').val();
			var bamount=$('#bamount').val();
			var purpose=$('#purpose').val();
			var cardtype=$('#cardtype').val();
			var cardamount=$('#cardamount').val();

			if(username=='')
			{
				$('#username').focus();
				$('#name_valid').html('<span><font color="red">Please Enter The name</span>');
				$('#username').keyup(function(){ $('#name_valid').html('');  });
				return false;
			}

			if(purpose=='')
			{
				$('#purpose').focus();
				$('#purpose_valid').html('<span><font color="red">Please Enter The Purpose</span>');
				$('#purpose').keyup(function(){  $('#purpose_valid').html('');  });
				return false;
			}

			if($('#optionsRadios1').prop("checked")==true)
			{
				if(amount=='')
				{
					$('#amount').focus();
					$('#amount_valid').html('<span><font color="red">Please Enter The amount</span>');
					$('#amount').keyup(function(){ $('#amount_valid').html('');  });
					return false;
				}
			}

			if($('#optionsRadios2').prop("checked")==true)
			{
				if(tc=='0')
				{
					$('#tc').focus();
					$('#tc_valid').html('<span><font color="red">Select The Bank Name</span>');
					$('#tc').change(function(){ $('#tc_valid').html('');  });
					return false;
				}

				if(chequeno=='')
				{
					$('#chequeno').focus();
					$('#chequeno_valid').html('<span><font color="red">Enter The Cheque No</span>');
					$('#chequeno').keyup(function(){ $('#chequeno_valid').html('');  });
					return false;
				}

				if(chamount=='')
				{
					$('#chamount').focus();
					$('#chamount_valid').html('<span><font color="red">Enter The Amount</span>');
					$('#chamount').keyup(function(){ $('#chamount_valid').html(''); });
					return false;
				}
			}

			if($('#optionsRadios3').prop("checked")==true)
			{
				if(bank=='0')
				{
					$('#ss').focus();
					$('#ss_valid').html('<span><font color="red">Select The Bank Name</span>');
					$('#ss').change(function(){ $('#ss_valid').html(''); });
					return false;
				}

				if(bamount=='')
				{
					$('#bamount').focus();
					$('#bamount_valid').html('<span><font color="red">Enter The Amount</span>');
					$('#bamount').keyup(function(){ $('#bamount_valid').html(''); });
					return false;
				}
			}

			if($('#optionsRadios4').prop("checked")==true)
			{
				if(cardtype=='')
				{
					$('#cardtype').focus();
					$('#card_valid').html('<span><font color="red">Select The Card Type</span>');
					$('#card').change(function(){ $('#card_valid').html(''); });
					return false;
				}

				if(cardamount=='')
				{
					$('#cardamount').focus();
					$('#cardamount_valid').html('<span><font color="red">Enter The Amount</span>');
					$('#cardamount').keyup(function(){ $('#cardamount_valid').html(''); });
					return false;
				}
			}
		});



		$('#print').click(function(){
			var username=$('#username').val();
			var amount=$('#amount').val();
			var tc=$('#tc').val();
			var chequeno=$('#chequeno').val();
			var chamount=$('#chamount').val();
			var bank=$('#ss').val();
			var bamount=$('#bamount').val();
			var purpose=$('#purpose').val();
			var cardtype=$('#cardtype').val();
			var cardamount=$('#cardamount').val();

			if(username=='')
			{
				$('#username').focus();
				$('#name_valid').html('<span><font color="red">Please Enter The name</span>');
				$('#username').keyup(function(){ $('#name_valid').html(''); });
				return false;
			}

			if(purpose=='')
			{
				$('#purpose').focus();
				$('#purpose_valid').html('<span><font color="red">Please Enter The Purpose</span>');
				$('#purpose').keyup(function(){  $('#purpose_valid').html(''); });
				return false;
			}

			if($('#optionsRadios1').prop("checked")==true)
			{
				if(amount=='')
				{
					$('#amount').focus();
					$('#amount_valid').html('<span><font color="red">Please Enter The amount</span>');
					$('#amount').keyup(function(){ $('#amount_valid').html(''); });
					return false;
				}
			}

			if($('#optionsRadios2').prop("checked")==true)
			{
				if(tc=='0')
				{
					$('#tc').focus();
					$('#tc_valid').html('<span><font color="red">Select The Bank Name</span>');
					$('#tc').change(function(){ $('#tc_valid').html(''); });
					return false;
				}

				if(chequeno=='')
				{
					$('#chequeno').focus();
					$('#chequeno_valid').html('<span><font color="red">Enter The Cheque No</span>');
					$('#chequeno').keyup(function(){ $('#chequeno_valid').html(''); });
					return false;
				}

				if(chamount=='')
				{
					$('#chamount').focus();
					$('#chamount_valid').html('<span><font color="red">Enter The Amount</span>');
					$('#chamount').keyup(function(){  $('#chamount_valid').html(''); });
					return false;
				}
			}

			if($('#optionsRadios3').prop("checked")==true)
			{
				if(bank=='0')
				{
					$('#ss').focus();
					$('#ss_valid').html('<span><font color="red">Select The Bank Name</span>');
					$('#ss').change(function(){ $('#ss_valid').html(''); });
					return false;
				}

				if(bamount=='')
				{
					$('#bamount').focus();
					$('#bamount_valid').html('<span><font color="red">Enter The Amount</span>');
					$('#bamount').keyup(function(){ $('#bamount_valid').html(''); });
					return false;
				}
			}

			if($('#optionsRadios4').prop("checked")==true)
			{
				if(cardtype=='')
				{
					$('#cardtype').focus();
					$('#card_valid').html('<span><font color="red">Select The Card Type</span>');
					$('#card').change(function(){ $('#card_valid').html(''); });
					return false;
				}

				if(cardamount=='')
				{
					$('#cardamount').focus();
					$('#cardamount_valid').html('<span><font color="red">Enter The Amount</span>');
					$('#cardamount').keyup(function(){ $('#cardamount_valid').html(''); });
					return false;
				}
			}
		});
	});
	</script>


	<script type="text/javascript">
	//Cash Show
	<?php if($result->paymentmode=='Cash') { ?> cash(); <?php } ?>
	<?php if($result->paymentmode=='Cheque') { ?>  check(); <?php } ?>
	<?php if($result->paymentmode=='Bank') { ?>  bank(); <?php } ?>
	<?php if($result->paymentmode=='Card') { ?>  card(); <?php } ?>
	
	function cash(){
		jQuery('#bank').hide();
		jQuery('#mamount').hide();
		jQuery('#cash').show(); 
		jQuery('#through').hide();
		jQuery('#cards').hide(); 
	}

	//Check Show

	function check(){
		jQuery('#bank').hide();
		jQuery('#cash').hide();
		jQuery('#through').show();
		jQuery('#mamount').hide();
		jQuery('#cards').hide();  
	}
	//bank show
	function bank(){
		jQuery('#cash').hide();
		jQuery('#through').hide();
		jQuery('#bank').show();
		jQuery('#mamount').hide();
		jQuery('#cards').hide();  
	}
	//Moneyorder Show
	function moneyorder(){
		jQuery('#bank').hide();
		jQuery('#through').hide();
		jQuery('#cash').hide();
		jQuery('#mamount').show();
		jQuery('#cards').hide();    
	}

	function card(){
		jQuery('#bank').hide();
		jQuery('#through').hide();
		jQuery('#cash').hide();
		jQuery('#mamount').hide();
		jQuery('#cards').show();                
	}

	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
		return true;
	}

	</script>
