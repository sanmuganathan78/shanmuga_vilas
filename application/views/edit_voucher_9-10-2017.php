<?php $data=$this->db->get('profile')->result();
	foreach($data as $r)
	?>
		<title> <?php echo $r->companyname;?></title>
		<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">

		<style>     
			#cash,#mamount,#through,#bank,#cards{display:none;}
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
									<i class="zmdi zmdi-money-box">&nbsp;Voucher</i>
								</header>
								<div class="card-box">
									<div class="row">
									<?php
									foreach ($result as $row) {
									$paymentmode=$row['paymentmode'];
									?>
											<form class="form-horizontal" role="form" method="post"  action="<?php echo base_url();?>voucher/update">
												<div class="form-group">
													<label for="inputPassword" class="col-lg-3 control-label">Type</label>
													<div class="col-lg-4">
														<input type="text" name="vouchertype" id="vouchertype" class="form-control" readonly   value="<?php echo $row['vouchertype'];?>">
													</div>
												</div>

											<div class="form-group">
												<label for="inputPassword" class="col-lg-3 control-label">Date</label>
												<div class="col-lg-4">
													<input type="text" name="voucherdate" class="form-control datepicker-autoclose" id="datepicker-autoclose" placeholder=""  value="<?php echo date('d-m-Y',strtotime($row['voucherdate']));?>" required>
												</div>
											</div>

											<div class="form-group">
												<label for="inputPassword" class="col-lg-3 control-label">Time</label>
												<div class="col-lg-4">
													<input class="form-control" name="time" id="times" type="text" readonly>
												</div>
											</div>

											<div class="form-group">
												<label for="inputStandard" class="col-lg-3 control-label">Voucher Id</label>
												<div class="col-lg-4">
													<input type="text" name="voucherid" id="voucherid" value="<?php echo $row['voucherid'];?>" class="form-control" placeholder="" readonly>
													<input type="hidden" name="id" id="id" value="<?php echo $row['id'];?>" class="form-control" placeholder="" readonly>
													<input type="hidden" name="oldamount" id="oldamount" value="<?php echo $row['voucheramount'];?>" class="form-control" placeholder="" readonly>
												<span id="name_valid"></span>
												</div>
											</div>

											<?php 
											if($row['vouchertype']=='receipt')
											{
											?>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-3 control-label">Customer/Company</label>
												<div class="col-lg-4">
													<input type="text" name="name1" value="<?php echo $row['name'];?>"  id="username1" class="form-control character" placeholder="" >
													<input type="hidden" name="customerid1" readonly=""  id="customerid1" class="form-control character" placeholder="" >
													<span id="username1_valid"></span>
												</div>
											</div>

											<div class="form-group">
												<label for="inputStandard" class="col-lg-3 control-label">Balance</label>
												<div class="col-lg-4">
													<input type="text" name="balance1" id="balance1"  class="form-control" placeholder="" readonly>
													<input type="hidden"  id="oldBalance1" />
													<input type="hidden" id="oldPaid" />
													<span id="name_valid"></span>
												</div>
											</div>

											<?php 
											}
											if($row['vouchertype']=='payment')
											{
											?>
											<div class="form-group">
												<label for="inputStandard" class="col-lg-3 control-label">Customer/Company</label>
												<div class="col-lg-4">
													<input type="text" name="name" value="<?php echo $row['name'];?>"  id="username" class="form-control character" readonly placeholder="" >
													<span id="username_valid"></span>
												</div>
											</div>

											<div class="form-group">
												<label for="inputStandard" class="col-lg-3 control-label">Balance</label>
												<div class="col-lg-4">
													<input type="text" name="balance" id="balance"  class="form-control" placeholder="" readonly>
													<input type="hidden" id="oldBalance" />
													<input type="hidden" id="oldPaid" />
													<span id="name_valid"></span>
												</div>
											</div>

											<?php } ?>

											<div class="form-group">
												<label class="control-label col-sm-3">Payment Mode</label>
												<div class="controls col-sm-1">
													<input type="radio" name="paymentmode" id="optionsRadios1" value="Cash" <?php if($row['paymentmode']=='Cash') echo 'checked';?> onchange="cash()" required>Cash<!--</label>-->
												</div>
												<div class="controls col-sm-1" style="width:100px;">
													<input type="radio" name="paymentmode" id="optionsRadios2" value="Cheque" <?php if($row['paymentmode']=='Cheque') echo 'checked';?> onchange="check()" required>Cheque<!--</label>-->
												</div>
												<div class="controls col-sm-1" style="width:142px;">
													<input type="radio" name="paymentmode" id="optionsRadios3" value="Bank" <?php if($row['paymentmode']=='Bank') echo 'checked';?> onchange="bank()" required>RTGS/ Neft<!--</label>-->
												</div>
											</div>
											<!-- CHEQUE PAYMENT STARTS HERE -->
											<div  id="through" class="form-group" >
												<div class="form-group">                                
													<label class="control-label col-sm-3">Bank Name<span style="color:red;">*</span></label>
													<div class="col-lg-4">
														<select  name="throughcheck" class="form-control clears" id="tc" data-rel="chosen1" >
															<option value="0">--Select--</option>
															<option <?php if($row['throughcheck']=='') echo 'selected';?>  value="FEDERAL BANKLTD">FEDERAL BANK LTD</option>
															<option <?php if($row['throughcheck']=='HDFC BANK') echo 'selected';?> value="HDFC BANK">HDFC BANK</option>
															<option <?php if($row['throughcheck']=='ICICI BANK') echo 'selected';?> value="ICICI BANK">ICICI BANK</option>
															<option <?php if($row['throughcheck']=='KARUR VYSYA BANK') echo 'selected';?> value="KARUR VYSYA BANK">KARUR VYSYA BANK</option>
															<option <?php if($row['throughcheck']=='KOTAK MAHINDRA') echo 'selected';?> value="KOTAK MAHINDRA">KOTAK MAHINDRA</option>
															<option <?php if($row['throughcheck']=='ING VYSYA') echo 'selected';?> value="ING VYSYA">ING VYSYA</option>
															<option <?php if($row['throughcheck']=='SOUTH INDIAN') echo 'selected';?> value="SOUTH INDIAN">SOUTH INDIAN</option>                      
															<option <?php if($row['throughcheck']=='BANK OF AMERICA') echo 'selected';?> value="BANK OF AMERICA">BANK OF AMERICA</option>
															<option <?php if($row['throughcheck']=='CITI BANK') echo 'selected';?> value="CITI BANK">CITI BANK</option>
															<option <?php if($row['throughcheck']=='HSBC BANK') echo 'selected';?> value="HSBC BANK">HSBC BANK</option>
															<option <?php if($row['throughcheck']=='UNITED BANK OF INDIAN') echo 'selected';?> value="UNITED BANK OF INDIAN">UNITED BANK OF INDIAN</option>
															<option <?php if($row['throughcheck']=='BANK OF BARODA') echo 'selected';?> value="BANK OF BARODA">BANK OF BARODA</option>
															<option <?php if($row['throughcheck']=='CANARA BANK') echo 'selected';?> value="CANARA BANK">CANARA BANK</option>
															<option <?php if($row['throughcheck']=='CORPORATION BANK') echo 'selected';?> value="CORPORATION BANK">CORPORATION BANK</option>
															<option <?php if($row['throughcheck']=='SYNDICATE') echo 'selected';?> value="SYNDICATE">SYNDICATE</option>
															<option <?php if($row['throughcheck']=='ANDHRA BANK') echo 'selected';?> value="ANDHRA BANK">ANDHRA BANK</option>
															<option <?php if($row['throughcheck']=='BANK OF INDIA') echo 'selected';?> value="BANK OF INDIA">BANK OF INDIA</option>
															<option <?php if($row['throughcheck']=='CENTRAL BANK OF INDIA') echo 'selected';?> value="CENTRAL BANK OF INDIA">CENTRAL BANK OF INDIA</option>
															<option <?php if($row['throughcheck']=='UCO BANK') echo 'selected';?> value="UCO BANK">UCO BANK</option>
															<option <?php if($row['throughcheck']=='UNION BANK OF INDIA') echo 'selected';?> value="UNION BANK OF INDIA">UNION BANK OF INDIA</option>
															<option <?php if($row['throughcheck']=='UNITED BANK OF INDIA') echo 'selected';?> value="UNITED BANK OF INDIA">UNITED BANK OF INDIA</option>
															<option <?php if($row['throughcheck']=='STATE BANK OF HYDRABAD') echo 'selected';?> value="STATE BANK OF HYDRABAD">STATE BANK OF HYDRABAD</option>
															<option <?php if($row['throughcheck']=='CATHOLIC SYRIAN BANK') echo 'selected';?> value="CATHOLIC SYRIAN BANK">Catholic Syrian Bank</option>
															<option <?php if($row['throughcheck']=='INDIAN BANK') echo 'selected';?> value="INDIAN BANK">INDIANBANK</option>
															<option <?php if($row['throughcheck']=='INDIAN OVERSEAS') echo 'selected';?> value="INDIAN OVERSEAS">INDIANOVERSEAS</option>
															<option <?php if($row['throughcheck']=='AXIS') echo 'selected';?> value="AXIS">AXIS</option>
															<option <?php if($row['throughcheck']=='TAMILNADU MERCHANTILE') echo 'selected';?> value="TAMILNADU MERCHANTILE">TAMILNADUMERCHANTILE</option>
															<option <?php if($row['throughcheck']=='STATE BANK OF INDIA') echo 'selected';?> value="STATE BANK OF INDIA">STATEBANKOFINDIA</option>
														</select>
														<span id="tc_valid"></span>
													</div>
												</div>

												<div class="form-group">                                
													<label class="control-label col-sm-3">Cheque No<span style="color:red;">*</span></label>
													<div class="col-lg-4">
														<input type="text"  class="form-control clears" id="chequeno" name="chequeno" value="<?php echo $row['chequeno'];?>" data-provide="typeahead" >
														<span id="chequeno_valid"></span>
													</div>
												</div>

												<div class="form-group">                                
													<label class="control-label col-sm-3">Cheque Date</label>
													<div class="col-lg-4">
														<input type="text" value="<?php echo $row['chequedate'];?>"  class="form-control clears" id="chequedate" name="chequedate" data-provide="typeahead" >
													</div>
												</div>

												<div class="form-group">                                
													<label class="control-label col-sm-3">Amount <span style="color:red;">*</span></label>
													<div class="col-lg-4">
														<input type="text"  class="form-control decimal clears amtClass" min="0" max="9999999999" value="<?php echo $row['chamount'];?>" id="chamount" name="chamount" data-provide="typeahead"  >
														<span id="chamount_valid"></span>
														<span id="chamounts_valid"></span>
														<span id="chamountss_valid"></span>
													</div>
												</div>
											</div>
											<!-- RTGS/NEFT PAYMENT STARTS HERE -->
											<div  id="bank" >
												<div class="form-group">                                
													<label class="control-label col-sm-3">Bank Name <span style="color:red;">*</span></label>
													<div class="col-lg-4">
														<select  name="banktransfer" class="form-control clears"  id="ss" data-rel="chosen1" >
															<option value="0" >--Select--</option>
															<option <?php if($row['banktransfer']=='') echo 'selected';?>  value="FEDERAL BANKLTD">FEDERAL BANK LTD</option>
															<option <?php if($row['banktransfer']=='HDFC BANK') echo 'selected';?> value="HDFC BANK">HDFC BANK</option>
															<option <?php if($row['banktransfer']=='ICICI BANK') echo 'selected';?> value="ICICI BANK">ICICI BANK</option>
															<option <?php if($row['banktransfer']=='KARUR VYSYA BANK') echo 'selected';?> value="KARUR VYSYA BANK">KARUR VYSYA BANK</option>
															<option <?php if($row['banktransfer']=='KOTAK MAHINDRA') echo 'selected';?> value="KOTAK MAHINDRA">KOTAK MAHINDRA</option>
															<option <?php if($row['banktransfer']=='ING VYSYA') echo 'selected';?> value="ING VYSYA">ING VYSYA</option>
															<option <?php if($row['banktransfer']=='SOUTH INDIAN') echo 'selected';?> value="SOUTH INDIAN">SOUTH INDIAN</option>                      
															<option <?php if($row['banktransfer']=='BANK OF AMERICA') echo 'selected';?> value="BANK OF AMERICA">BANK OF AMERICA</option>
															<option <?php if($row['banktransfer']=='CITI BANK') echo 'selected';?> value="CITI BANK">CITI BANK</option>
															<option <?php if($row['banktransfer']=='HSBC BANK') echo 'selected';?> value="HSBC BANK">HSBC BANK</option>
															<option <?php if($row['banktransfer']=='UNITED BANK OF INDIAN') echo 'selected';?> value="UNITED BANK OF INDIAN">UNITED BANK OF INDIAN</option>
															<option <?php if($row['banktransfer']=='BANK OF BARODA') echo 'selected';?> value="BANK OF BARODA">BANK OF BARODA</option>
															<option <?php if($row['banktransfer']=='CANARA BANK') echo 'selected';?> value="CANARA BANK">CANARA BANK</option>
															<option <?php if($row['banktransfer']=='CORPORATION BANK') echo 'selected';?> value="CORPORATION BANK">CORPORATION BANK</option>
															<option <?php if($row['banktransfer']=='SYNDICATE') echo 'selected';?> value="SYNDICATE">SYNDICATE</option>
															<option <?php if($row['banktransfer']=='ANDHRA BANK') echo 'selected';?> value="ANDHRA BANK">ANDHRA BANK</option>
															<option <?php if($row['banktransfer']=='BANK OF INDIA') echo 'selected';?> value="BANK OF INDIA">BANK OF INDIA</option>
															<option <?php if($row['banktransfer']=='CENTRAL BANK OF INDIA') echo 'selected';?> value="CENTRAL BANK OF INDIA">CENTRAL BANK OF INDIA</option>
															<option <?php if($row['banktransfer']=='UCO BANK') echo 'selected';?> value="UCO BANK">UCO BANK</option>
															<option <?php if($row['banktransfer']=='UNION BANK OF INDIA') echo 'selected';?> value="UNION BANK OF INDIA">UNION BANK OF INDIA</option>
															<option <?php if($row['banktransfer']=='UNITED BANK OF INDIA') echo 'selected';?> value="UNITED BANK OF INDIA">UNITED BANK OF INDIA</option>
															<option <?php if($row['banktransfer']=='STATE BANK OF HYDRABAD') echo 'selected';?> value="STATE BANK OF HYDRABAD">STATE BANK OF HYDRABAD</option>
															<option <?php if($row['banktransfer']=='CATHOLIC SYRIAN BANK') echo 'selected';?> value="CATHOLIC SYRIAN BANK">Catholic Syrian Bank</option>
															<option <?php if($row['banktransfer']=='INDIAN BANK') echo 'selected';?> value="INDIAN BANK">INDIANBANK</option>
															<option <?php if($row['banktransfer']=='INDIAN OVERSEAS') echo 'selected';?> value="INDIAN OVERSEAS">INDIANOVERSEAS</option>
															<option <?php if($row['banktransfer']=='AXIS') echo 'selected';?> value="AXIS">AXIS</option>
															<option <?php if($row['banktransfer']=='TAMILNADU MERCHANTILE') echo 'selected';?> value="TAMILNADU MERCHANTILE">TAMILNADUMERCHANTILE</option>
															<option <?php if($row['banktransfer']=='STATE BANK OF INDIA') echo 'selected';?> value="STATE BANK OF INDIA">STATEBANKOFINDIA</option>
														</select>
														<div id="ss_valid"></div>
													</div>
												</div>
												
												<div class="form-group">                                
													<label class="control-label col-sm-3">Transaction ID <span style="color:red;">*</span></label>
													<div class="col-lg-4">
														<input type="text"  class="form-control decimal clears"   name="transactionid" value="<?php echo $row['transactionid'];?>" data-provide="typeahead"  >
													</div>
												</div>

												<div class="form-group">                                
													<label class="control-label col-sm-3">Amount <span style="color:red;">*</span></label>
													<div class="col-lg-4">
														<input type="text"  class="form-control decimal clears amtClass" min="0" max="9999999999" value="<?php echo $row['bamount'];?>"  id="bamount" name="bamount" data-provide="typeahead"  >
														<span id="bamount_valid"></span>
														<span id="bamounts_valid"></span>
														<span id="bamountss_valid"></span>
													</div>
												</div>
											</div>
											<!--CASH PAYMENT STARTS HERE -->	
											<div id="cash" >
												<div class="form-group">                                
													<label class="control-label col-sm-3">Amount <span style="color:red;">*</span></label>
													<div class="col-lg-4">
														<input type="text"  class="form-control decimal clears amtClass" min="0" max="9999999999"  <?php if($paymentmode=='Cash'){?> value="<?php echo $row['amount'];?>" <?php } ?> id="amount" name="amount" >
														<span id="amount_valid"></span>
														<span id="amounts_valid"></span>
														<span id="amountss_valid"></span>
													</div>
												</div>
											</div>
												
											<div id="cards" >
												<div class="form-group">                                
													<label class="control-label col-sm-3">Cart Type</label>
													<div class="col-lg-3">
														<select type="text"  class="form-control clears"  name="cardtype">
															<?php 
															$getcard=$this->db->get('card')->result();
															foreach($getcard as $g){
																echo '<option value="'.$g->name.'">'.$g->name.'</option>';
															} ?>
														</select>
														<span id="cardtype_valid"></span>
													</div>
												</div>
												
												<div class="form-group">                                
													<label class="control-label col-sm-3">Amount <span style="color:red;">*</span></label>
													<div class="col-lg-3">
														<input type="text"  class="form-control decimal clears" min="0" max="9999999999"  id="cardamount" name="cardamount" >
														<span id="cardamount_valid"></span>
													</div>
												</div>
											</div>

											<div class="col-sm-offset-4">
												<button  class="btn btn-info" id="submit" name="save" value="save">Update </button>
												<button type="reset"  class="btn btn-default" id="">Reset</button>
											</div>
										</form>
									<?php } ?>
									</div><!-- r0w-->
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
		jQuery('#datepicker-autoclose').datepicker({ autoclose: true,todayHighlight: true});
		</script>

		<script type="text/javascript">
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


			$('#submit').click(function(){
				var amount=$('#amount').val();
				var tc=$('#tc').val();
				var chequeno=$('#chequeno').val();
				var chamount=$('#chamount').val();
				var bank=$('#ss').val();
				var bamount=$('#bamount').val();
				var username = $('#username').val();
				var username1 = $('#username1').val();
				// var invoiceno1 = $('#username1').val();

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
						$('#card_valid').html('<span><font color="red">Select The Cart Type</span>');
						$('#card').change(function(){ $('#card_valid').html(''); });
						return false;
					}

					if(cardamount=='')
					{
						$('#cardamount').focus();
						$('#cardamount_valid').html('<span><font color="red">Enter The Amount</span>');
						$('#cardamount').keyup(function(){ $('#cardamount_valid').html(''); 	});
						return false;
					}
				}


				if($('#optionsRadios33').prop("checked")==true)
				{
					if(username=='')
					{
						$('#username').focus();
						$('#username_valid').html('<span><font color="red">Please Enter The Customername</span>');
						$('#username').keyup(function(){ $('#username_valid').html(''); });
						return false;
						}
				}

				if($('#optionsRadios5').prop("checked")==true)
				{
					if(username1=='')
					{
						$('#username1').focus();
						$('#username1_valid').html('<span><font color="red">Please Enter The Supplier Name</span>');
						$('#username1').keyup(function(){ $('#username1_valid').html(''); });
						return false;
					}
				}
			});
		});
		</script>

		<script type="text/javascript">
		//Cash Show
		<?php
		if($paymentmode=='Cash')
		{
		?>
			jQuery("#oldPaid").val('<?php echo $row['amount'];?>');
			jQuery('#bank').hide();
			jQuery('#mamount').hide();
			jQuery('#cash').show(); 
			jQuery('#through').hide();
			jQuery('#cards').hide();  
		<?php  
		}

		if($paymentmode=='Cheque')
		{
		?>
			jQuery("#oldPaid").val('<?php echo $row['chamount'];?>');
			jQuery('#bank').hide();
			jQuery('#cash').hide();
			jQuery('#through').show();
			jQuery('#mamount').hide();
			jQuery('#cards').hide();  
		<?php 
		}

		if($paymentmode=='Bank')
		{
		?>
			jQuery("#oldPaid").val('<?php echo $row['bamount'];?>');
			jQuery('#cash').hide();
			jQuery('#through').hide();
			jQuery('#bank').show();
			jQuery('#mamount').hide();
			jQuery('#cards').hide();  
		<?php 
		}

		if($paymentmode=='Card')
		{
		?>
			jQuery("#oldPaid").val('');
			jQuery('#bank').hide();
			jQuery('#through').hide();
			jQuery('#cash').hide();
			jQuery('#mamount').hide();
			jQuery('#cards').show();   
		<?php 
		}
		?>

		function cash(){
			jQuery('#bank').hide();
			jQuery('#mamount').hide();
			jQuery('#cash').show(); 
			jQuery('#through').hide();
			jQuery('#cards').hide();
			$('.clears').val('');  
		}
		//Check Show

		function check(){
			jQuery('#bank').hide();
			jQuery('#cash').hide();
			jQuery('#through').show();
			jQuery('#mamount').hide();
			jQuery('#cards').hide(); 
			$('.clears').val('');   
		}
		
		//bank show
		function bank(){
			jQuery('#cash').hide();
			jQuery('#through').hide();
			jQuery('#bank').show();
			jQuery('#mamount').hide();
			jQuery('#cards').hide();  
			$('.clears').val('');  
		}
		
		//Moneyorder Show
		function moneyorder(){
			jQuery('#bank').hide();
			jQuery('#through').hide();
			jQuery('#cash').hide();
			jQuery('#mamount').show();
			jQuery('#cards').hide();  
			$('.clears').val('');    
		}

		function card(){
			jQuery('#bank').hide();
			jQuery('#through').hide();
			jQuery('#cash').hide();
			jQuery('#mamount').hide();
			jQuery('#cards').show();   
			$('.clears').val('');               
		}

		function receipt()
		{
			jQuery('#receipt').show();
			jQuery('#payment').hide();
		}

		function isNumberKey(evt)
		{
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			return false;
			return true;
		}
		</script>

		<script type="text/javascript">
		function ontime() {
			now=new Date();
			hour=now.getHours();
			min=now.getMinutes();
			sec=now.getSeconds();
			if (min<=9) { min="0"+min; }
			if (sec<=9) { sec="0"+sec; }
			if (hour>12) { hour=hour-12; add="PM"; }
			else { hour=hour; add="AM"; }
			if (hour==12) { add="PM"; }
			$("#times").val (((hour<=9) ? "0"+hour : hour) + ":" + min + ":" + sec + " " + add);
			setTimeout("ontime()", 1000);
		}
		window.onload = ontime;
		</script>


		<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({ 
				url: "<?php echo base_url();?>voucher/autocomplete_usernames",
				data: { keyword: $("#username").val()},
				type: "POST",
				success: function(data){ 
					var obj=jQuery.parseJSON(data);
					$('#balance').val(obj.balance); 
					$('#oldBalance').val(obj.balance); 
				}            
			});

			$.ajax({ 
				url: "<?php echo base_url();?>voucher/autocomplete_username1s",
				data: { keyword: $("#username1").val()},
				type: "POST",
				success: function(data){ 
					var obj=jQuery.parseJSON(data);
					$('#balance1').val(obj.balance); 
					$("#oldBalance1").val(obj.balance);
				}            
			});
		});
		</script>

		<script type="text/javascript">
		$(document).ready(function(){
			$('#chequedate').datepicker();
			$('.amtClass').keyup(function(){
				var voucherType=$("#vouchertype").val();
				if(voucherType=='receipt')
				{
					var oldBalance = $("#oldBalance1").val();
					var balanceVar = 'balance1';
				}
				else
				{
					var oldBalance = $("#oldBalance").val();
					var balanceVar = 'balance';
				}
				var curPaid = $(this).val();
				var oldPaid = $("#oldPaid").val();
				if(parseFloat(curPaid) >  parseFloat(oldPaid))
				{
					var updatableAmt = parseFloat(curPaid)-parseFloat(oldPaid);
					var newBalance = parseFloat(oldBalance)-parseFloat(updatableAmt);
				}
				else if(parseFloat(oldPaid) >  parseFloat(curPaid))
				{
					var updatableAmt = parseFloat(oldPaid)-parseFloat(curPaid);
					var newBalance = parseFloat(oldBalance)+parseFloat(updatableAmt);
				}
				else
				{
					var newBalance = oldBalance;
				}	
				$("#"+balanceVar).val(newBalance);
				
				
				
			});
		});
		</script>