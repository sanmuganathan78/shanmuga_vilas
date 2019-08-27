	<?php $data=$this->db->get('profile')->result();
	foreach($data as $r)
	?>
	<title> <?php echo $r->companyname;?></title>
	<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">

	<style>     
		#cash,#mamount,#through,#bank{ display:none; }
		.forms input{ width: 90%; }
		.forms select{ width: 90%; }
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
								<i class="zmdi zmdi-money-box">&nbsp;View Debit/Credit Note</i>
							</header>
							<?php 
							//print_r($result);
							//exit;
							foreach($result as $ue)
							
							if($ue['gsttype']=='intrastate') 
							{
								$cgstHidStatus='';
								$igstHidStatus='style="display:none;"';
								$freightStat = '';
							} 
							else 
							{
								$cgstHidStatus='style="display:none;"';
								$igstHidStatus='';
								$freightStat = '
								';
							}
							?> 
							<div class="card-box">
								<div class="row">
									<form class="form-horizontal" role="form" method="post" -target="_blank"  action="<?php echo base_url();?>salesreturn/update_return" data-parsley-validate novalidate>
										<input type="hidden" name="id" value="<?php echo $ue['id'];?>" />
										
										<div class="forms">
											<div class="col-sm-12">
												<div class="col-md-4">
													<div class="form-group"> 
														<label for="exampleInputEmail1">Type</label>
														<input type="text" class="form-control" name="returnno" value="<?php echo $ue['types'];?>" readonly>
													</div>                
												</div>
												
												<div class="col-md-4">
													<div class="form-group"> 
														<label for="exampleInputEmail1"> Return No</label>
														<input type="text" class="form-control" name="returnno" value="<?php echo $ue['returnno'];?>" readonly>
													</div>                
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Date</label>
														<input type="text" class="form-control " name="returndate" value="<?php echo date('d-m-Y',strtotime($ue['returndate']));?>"  readonly>
													</div>                
												</div>

												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Time</label>
														<input type="text" class="form-control" name="time" value="<?php echo $ue['time'];?>" readonly>
													</div>                
												</div>

												<?php if($ue['types']=='Debit'){?>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Customer Name</label>
														<input class="form-control"  type="text" readonly value="<?php echo $ue['customername'];?>" name="customername" id="customername"  >
														<input class="form-control" required type="hidden" name="customerid" id="customerid"  >
														<div id="name_valid"></div>
													</div>                
												</div>
												<?php 
												}
												if($ue['types']=='Credit')
												{
												?>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">suppliername Name</label>
														<input class="form-control"  type="text" readonly value="<?php echo $ue['suppliername'];?>" name="customername" id="customername"  >
														<input class="form-control" required type="hidden" name="supplierId" id="supplierId" value="<?php echo $ue['supplierid'];?>"  >
														<div id="name_valid"></div>
													</div>                
												</div>
												<?php } ?>

												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Balance Amount</label>
														<input class="form-control"  type="text" readonly value="<?php echo $ue['openingbal'];?>" name="customername" id="customername"  >
														<input class="form-control" required type="hidden" name="customerid" id="customerid"  >
														<div id="name_valid"></div>
													</div>                
												</div>

												<?php if($ue['types']=='Debit'){?>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Invoice No</label>
														<input type="text" name="invoiceno" readonly class="form-control" value="<?php echo $ue['invoiceno'];?>">
													</div>                
												</div>
												<?php } ?>

												<?php if($ue['types']=='Credit'){?>
												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Purchase No</label>
														<input type="text" name="invoiceno" readonly class="form-control" value="<?php echo $ue['purchaseno'];?>">
													</div>                
												</div>
												<?php } ?>

												<div class="col-md-4">
													<div class="form-group">
														<label for="exampleInputEmail1">Description</label>
														<input type="text" name="description" readonly class="form-control" value="<?php echo $ue['description'];?>">
													</div>                
												</div>

												<div class="clearfix"></div>

												<?php

												echo'<div class="table-responsive">
												<table class="responsive table">
													<thead> 
														<tr>
															<th>HSN Code</th>
															<th>Item Name</th>
															<th>Qty</th>
															<th>UOM</th>
															<th>Rate</th>
															<th>Total</th>
															<th>Disc</th>
															<th>Taxable Amount</th>
															<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
															<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
															<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
															<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
															<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
															<th style="display:none;" class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
															<th>Total</th>
														</tr>  
													</thead>
													<tbody>';
													$hsnno=explode('||', $ue['hsnno']);
													$itemname=explode('||', $ue['itemname']);
													$rate=explode('||', $ue['rate']);
													$qty=explode('||', $ue['qty']);
													$amount=explode('||', $ue['amount']);
													$discount=explode('||', $ue['discount']);
													$discountamount=explode('||', $ue['discountamount']);
													$taxableamount=explode('||', $ue['taxableamount']);
													$sgst=explode('||', $ue['sgst']); 
													$cgst=explode('||', $ue['cgst']); 
													$igst=explode('||', $ue['igst']); 
													$sgstamount=explode('||', $ue['sgstamount']); 
													$cgstamount=explode('||', $ue['cgstamount']); 
													$igstamount=explode('||', $ue['igstamount']); 
													$uom=explode('||', $ue['uom']); 
													$total=explode('||', $ue['total']); 
													$count=count($itemname);
													//echo $count.'<hr>';
													for($i=0; $i< $count; $i++){
														//echo $i.'<br>';
													if($qty[$i]==0)
													{
														$hide="style='display:none'";
													}
													else
													{
														$hide='';
													}

													$itemQuery = $this->db->query("SELECT * FROM additem WHERE hsnno='".$hsnno[$i]."' ");
													$item_results = $itemQuery->result_array();
													/*$this->db->select('*');
													$this->db->from('additem');
													$this->db->where('hsnno',$hsnno[$i]);
													$item_query = $this->db->get();
													$item_result = $item_query->row();*/
													foreach($item_results as $item_result)
													{
														$priceType = $item_result['priceType'];
													}
													/*
													$getPurchasedQty =  $this->db->query("SELECT * FROM purchase_details WHERE purchaseno='".$ue['purchaseno']."' ");
													$purchased_results = $getPurchasedQty->row();
													$purchasedQty = */
													/*$purchasedQtyQry = $this->db->query("SELECT * FROM purchase_details WHERE purchaseno='".$ue['purchaseno']."' ");
													$purchasedQtyRes = $purchasedQtyQry->row();
													
													$pqArray=array();
													$pqitemno=explode('||',$purchasedQtyRes->itemno);
													$pqqty=explode('||',$purchasedQtyRes->qty);
													$pqcount=count($pqitemno);
													for ($i=0; $i < $pqcount; $i++) 
													{
														$pqArray[$pqitemno[$i]]=$pqqty[$i];
													}
													<input class="" id="qtys'.$i.'" type="hidden" name="qtys[]" value="'.$pqArray[$hsnno[$i]].'"><!-- put below qty-->
													*/
													echo'
													<tbody>
														<tr '.$hide.'>
															
															<td><input class="" id="hsnno'.$i.'"  readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="'.$hsnno[$i].'" style="width:70px;"><div id="hsnno_valid"></div><input type="hidden" name="hiddenIgst" id="hiddenIgst'.$i.'" value="'.(@$cgst[$i]+@$sgst[$i]).'" /></td>
															
															<td><input class="" id="itemname'.$i.'"   style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" readonly value="'.$itemname[$i].'" ><div id="itemname_valid"></div><input type="hidden" name="priceType[]" id="priceType'.$i.'" value="'.$priceType.'" ></td>
															
															<td><input class="" id="qty'.$i.'"   parsley-trigger="change" required  type="text" name="qty[]"  value="'.$qty[$i].'"   onkeypress="return isNumberKey(event)" autocomplete="off" style="width:50px;border:1px solid #605f5f;">
															<input class="" id="oldqtys'.$i.'" type="hidden" name="oldqtys[]" value="'.$qty[$i].'"></td>  
																				
															<td><input class="" id="uom'.$i.'"  readonly  style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]" value="'.$uom[$i].'"  autocomplete="off"><div id="rate_valid"></div></td>

															<td><input class=" decimals"  readonly id="rate'.$i.'"  style="width:70px;border:1px solid #605f5f;" value="'.$rate[$i].'" type="text" name="rate[]"   autocomplete="off"><div id="rate_valid"></div></td>

															<td><input class="decimals" id="amount'.$i.'"  readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]"value="'.@$amount[$i].'"  autocomplete="off"><div id="rate_valid"></div></td>

															<td><input class="decimals" id="discount'.$i.'"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" readonly value="'.$discount[$i].'" onkeypress="return isNumber(event)" autocomplete="off"></td>

															<td><input class="decimals" id="taxableamount'.$i.'" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value="'.$taxableamount[$i].'"  autocomplete="off"><input type="hidden" value="'.$discountamount[$i].'" name="discountamount[]" id="discountamount'.$i.'"></td>

															<td class="sgst"><input class="decimals" readonly id="cgst'.$i.'"  type="text" value="'.@$cgst[$i].'" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" >
															<div id="cgst_valid"></div></td>

															<td class="sgst"><input class="decimals" readonly id="cgstamount'.$i.'" value="'.@$cgstamount[$i].'" type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>

															<td class="sgst"><input class="decimals" id="sgst'.$i.'" readonly  type="text" value="'.@$sgst[$i].'" name="sgst[]"  style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" >
															<div id="sgst_valid"></div></td>

															<td class="sgst"><input class="decimals" value="'.@$sgstamount[$i].'" id="sgstamount'.$i.'"  type="text" name="sgstamount[]" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>

															<td class="igst" style="display:none;"><input class="decimals" value="'.@$igst[$i].'" id="igst'.$i.'"  type="text" name="igst[]" readonly  style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid"></div></td>

															<td class="igst" style="display:none;"><input class="decimals" id="igstamount'.$i.'"  type="text" value="'.$igstamount[$i].'" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>

															<td><input class="" id="total'.$i.'" value="'.@$total[$i].'" type="text" name="total[]" value=""  readonly style="width:110px;border:1px solid #605f5f;"></td>

														</tr>
														';
													}
													echo'</tbody>
												</table>
												</div>
												<div class="row">&nbsp;</div>
													<div class="table-responsive">
														<table class="table">
															<tr>
																<th>Charges</th>
																<th>Amount</th>
																<th '.$cgstHidStatus.'>CGST</th>
																<th '.$cgstHidStatus.'>CGST Amount</th>
																<th '.$cgstHidStatus.'>SGST</th>
																<th '.$cgstHidStatus.'>SGST Amount</th>
																<th '.$igstHidStatus.'>IGST</th>
																<th '.$igstHidStatus.'>IGST Amount</th>
																<th>Total</th>
															</tr>
															<tr>
																<td>Freight Charges</td>
																<td><input readonly class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="border:1px solid #605f5f;" type="text" name="freightamount" value="'.$ue['freightamount'].'"  autocomplete="off"></td>
																<td '.$cgstHidStatus.'><input class="decimals"  readonly id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="'.$ue['freightcgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
																<td '.$cgstHidStatus.'><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off"  style="border:1px solid #605f5f;" value="'.$ue['freightcgstamount'].'"></td>
																<td '.$cgstHidStatus.'><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" readonly value="'
																.$ue['freightsgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
																<td '.$cgstHidStatus.'><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['freightsgstamount'].'"></td>
																<td '.$igstHidStatus.'><input readonly class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST" value="'.$ue['freightigst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
																<td '.$igstHidStatus.'><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['freightigstamount'].'"></td>
																<td><input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="'.$ue['freighttotal'].'"  readonly style="border:1px solid #605f5f;"></td>
															</tr>
															<tr>
																<td>Loading & Packing Charges</td>
																<td><input readonly class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="border:1px solid #605f5f;" type="text" name="loadingamount" value="'.$ue['loadingamount'].'"  autocomplete="off"></td>
																<td ><input readonly class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="'.$ue['loadingcgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
																<td '.$cgstHidStatus.'><input class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off"  style="border:1px solid #605f5f;" value="'.$ue['loadingcgstamount'].'"></td>
																<td  '.$cgstHidStatus.'><input  class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" readonly value="'.$ue['loadingsgst'].'" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
																<td  '.$cgstHidStatus.'><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount"   placeholder="SGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['loadingsgstamount'].'"></td>
																<td  '.$igstHidStatus.'><input readonly class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST" value="'.$ue['loadingigst'].'"  style="border:1px solid #605f5f;"   autocomplete="off" ></td>
																<td  '.$igstHidStatus.'><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" readonly style="border:1px solid #605f5f;" value="'.$ue['loadingigstamount'].'"></td>
																<td><input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="'.$ue['loadingtotal'].'"  readonly style="border:1px solid #605f5f;"></td>
															</tr>
															
														</table>
													</div>
												<div class="col-md-12">
												<br><br>
												<br>

												<div class="col-sm-offset-5">
												<label class="col-sm-5  control-label" >Sub Total</label>
												<div class="col-sm-7">
												<input class="form-control"  type="text" value="'.$ue['subtotal'].'" name="subtotal" id="subtotal" readonly  placeholder="0" value="">
												</div>
												</div>
												<br>
												<br>    

												
												<div class="col-sm-offset-5">
												<label class="col-sm-5  control-label" >Round Off</label>
												<div class="col-sm-7">
												<input class="form-control"  type="text" name="othercharges" id="othercharges" readonly  placeholder="0" value="'.$ue['othercharges'].'">
												</div>
												</div>
												<br>
												<br>  

												<div class=" col-sm-offset-5">
												<label class="col-sm-5  control-label" >Grand Total</label>
												<div class="col-sm-7">
												<input class="form-control" readonly type="text" value="'.$ue['grandtotal'].'" value="" name="grandtotal" id="grandtotal" >
												<input class="form-control" readonly type="text" value="'.$ue['grandtotal'].'" value="" name="oldGrandTotal" id="grandtotal" >
												<input class="form-control" readonly type="hidden" value="'.$ue['gsttype'].'" name="gsttypes" id="gsttypes" >
												</div>                      
												</div>
												<br>
												<br>
												</div> 
												</div>
												</div>
												<div class="col-sm-offset-4">
													<!--<button  class="btn btn-info" id="submit" name="save" value="save">Update </button>-->
													<button type="button"  class="btn btn-default" onclick="javascript:window.location.href=\''.base_url().'salesreturn/view\'"><i class="fa fa-chevron-left"></i> Back to Report</button>
											  </div>
												';
												?>
											</div> 
										</div>
										<div class="clearfix"></div>
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
	<!--<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>-->
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
	//$('form').parsley(); 

	var gsttype=$("#gsttypes").val();

	if(gsttype=="interstate")
	{

	$(".sgst").hide();
	$(".igst").show();

	}

	else  if(gsttype=="intrastate")

	{

	$(".sgst").show();
	$(".igst").hide();

	}

	$('.decimal').keyup(function(){
	var val = $(this).val();
	if(isNaN(val)){
	val = val.replace(/[^0-9\.]/g,'');
	if(val.split('.').length>2)
	val =val.replace(/\.+$/,"");
	}
	$(this).val(val);
	});
	<?php for($i=0; $i< $count; $i++){ 
	echo '
		

			$("#qty'.$i.'").keyup(function(){
				
				var qty=$("#qty'.$i.'").val();
				var rate=$("#rate'.$i.'").val();
				var qtys=$("#qtys'.$i.'").val();
				var gsttype=$("#gsttypes").val();
				
				if(parseFloat(qty) > parseFloat(qtys))
				{
					alert("Your Required Qty is : "+qtys+"");
					$("#qty'.$i.'").val(qtys);
					$("#qty'.$i.'").focus("");
				}
				if(qty=="") { alert("Invalid Qty"); $("#qty'.$i.'").val(qtys); }
				/*if(parseInt(qty) == 0) { alert("Invalid Qty"); $("#qty'.$i.'").val(qtys); }*/
				if(qty)
				{
					var amo=parseFloat(rate)*parseFloat(qty);
					var amou=amo.toFixed(2);
					var discount=$("#discount'.$i.'").val();
					var cgst=$("#cgst'.$i.'").val();
					var sgst=$("#sgst'.$i.'").val();
					var igst=$("#igst'.$i.'").val(); 
					var taxableamount=$("#taxableamount'.$i.'").val(); 
					var gsttype=$("#gsttypes").val(); 
					
					var othercharges=$("#othercharges").val();
					var a=0;
					var b=0; 
					var c=0;
					var d=0;
					var e=0;
					var f=0;
					var g=0;
					var h=0;
					var i=0;
					var j=0;
					taxableamount = amou;
						
					var priceType = $("#priceType'.$i.'").val();
					var hiddenIgst = $("#hiddenIgst'.$i.'").val();
					//alert(hiddenIgst);
					if(priceType=="Inclusive")
					{
						var taxableamount=0;
						var discountamount=0;
						var total="'.$i.'";
						taxableamount = amou;
						if(discount > 0)
						{
							a=(parseFloat(amo)-parseFloat(discount));
							var discountamount=a.toFixed(2);
							var a2=parseFloat(amo)-parseFloat(discount);
							taxableamount=a2.toFixed(2);
						}
						k = taxableamount;
						$("#discountamount'.$i.'").val(discountamount);
						$("#taxableamount'.$i.'").val(taxableamount);
						
						if(gsttype=="intrastate")
						{
							if(cgst > 0)
							{
								//alert(k+"\n"+hiddenIgst+"\n");
								var divideBy = parseFloat(hiddenIgst)+100;
								b=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
								var b1=b.toFixed(2);
								$("#cgstamount'.$i.'").val(b1);
								var b2=parseFloat(k)-parseFloat(b);
								var b3=b2.toFixed(2);
								$("#amount'.$i.'").val(b3);
								var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}

							if(sgst > 0)
							{
								var divideBy = parseFloat(hiddenIgst)+100;
								c=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy)/2;
								var c1=c.toFixed(2);
								$("#sgstamount'.$i.'").val(c1);
								var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
								var c3=c2.toFixed(2);
								$("#amount'.$i.'").val(c3);
								var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}
						}
						else  if(gsttype=="interstate")
						{
							if(igst > 0)
							{
								var divideBy = parseFloat(hiddenIgst)+100;
								d=((parseFloat(k)*parseFloat(hiddenIgst))/divideBy);
								var d1=d.toFixed(2);
								$("#igstamount'.$i.'").val(d1);
								var d2=parseFloat(k)-parseFloat(d);
								var d3=d2.toFixed(2);
								$("#amount'.$i.'").val(d3);
								var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
								$("#total'.$i.'").val(totalVal);
							}
						}
					}
					else
					{
						var k=taxableamount;
						$("#amount'.$i.'").val(amou);
						$("#taxableamount'.$i.'").val(amou);
						$("#total'.$i.'").val(amou);
						
						if(discount > 0)
						{
							a=((parseFloat(amo)*parseFloat(discount))/100);
							var a1=a.toFixed(2);
							var a2=parseFloat(amo)-parseFloat(a1);
							var a3=a2.toFixed(2);
							k=a3;
							$("#discountamount'.$i.'").val(a1);
							$("#taxableamount'.$i.'").val(a3);
							$("#total'.$i.'").val(a3);
						}
						
						if(gsttype=="intrastate")
						{
							if(cgst > 0)
							{
								b=((parseFloat(k)*parseFloat(cgst))/100);
								var b1=b.toFixed(2);
								$("#cgstamount'.$i.'").val(b1);
								var b2=parseFloat(k)+parseFloat(b);
								var b3=b2.toFixed(2);
								$("#total'.$i.'").val(b3);
							}
							if(sgst > 0)
							{
								c=((parseFloat(k)*parseFloat(sgst))/100);
								var c1=c.toFixed(2);
								$("#sgstamount'.$i.'").val(c1);
								var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
								var c3=c2.toFixed(2);
								$("#total'.$i.'").val(c3);
							}
						}
						else  if(gsttype=="interstate")
						{
							if(igst > 0)
							{
								d=((parseFloat(k)*parseFloat(igst))/100);
								var d1=d.toFixed(2);
								$("#igstamount'.$i.'").val(d1);
								var d2=parseFloat(k)+parseFloat(d);
								var d3=d2.toFixed(2);
								$("#total'.$i.'").val(d3);
							}
						}
					}
					var othercharges=$("#othercharges").val();
					var sub_tot=0;
					sub_tot +=Number($("#freighttotal").val());
					sub_tot +=Number($("#loadingtotal").val());  
					$("input[name^=total]").each(function(){
						sub_tot +=Number($(this).val()); 
						var fina=sub_tot.toFixed(2);         
						$("#subtotal").val(fina);
						$("#grandtotal").val(fina); 
					});

					if(othercharges)
					{
						l=parseFloat(sub_tot)+parseFloat(othercharges);
						var l1=l.toFixed(2);
						$("#grandtotal").val(l1);
					}
				}
			});';
	}
			?>
															
	});
	</script>



	<script type="text/javascript">


	$( "#customername" ).autocomplete({
	source: function(request, response) {
	$.ajax({ 
	url: "<?php echo base_url();?>invoice/autocomplete_customername",
	data: { keyword: $("#customername").val()},
	dataType: "json",
	type: "POST",
	success: function(data){ 
	response(data);
	}            
	});
	}, select: function (event, ui) {
	$("#customername").val(ui.item.label); 

	$('#address').val(ui.item.address); 
	$('#tinno').val(ui.item.tinno); 
	$('#cstno').val(ui.item.cstno); 
	$('#customerid').val(ui.item.customerid); 

	var name = $('#customername').val();


	if(name !='')
	{

	$.post('<?php echo base_url();?>invoice/getcustomer',{name:name},function(res){

	if(res > 0)
	{

	$('#cusname_valid').html('<span><font color="green">Available!</span>');

	$('#submit').attr('disabled',false);
	$('#print').attr('disabled',false);

	}

	else
	{

	$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
	$('#submit').attr('disabled',true); //set button enable 
	$('#print').attr('disabled',true); //set button enable 
	//set button enable     
	}
	});

	return false;

	}


	}
	});



	$('#customername').keyup(function(){ 




	var name=$(this).val();


	if(name !='')
	{

	$.post('<?php echo base_url();?>invoice/getcustomer',{name:name},function(res){

	if(res > 0)
	{

	$('#cusname_valid').html('<span><font color="green">Available!</span>');

	$('#submit').attr('disabled',false);
	$('#print').attr('disabled',false);

	}

	else
	{

	$('#cusname_valid').html('<span><font color="red"> Not Available !</span>');
	$('#submit').attr('disabled',true); //set button enable 
	$('#print').attr('disabled',true); //set button enable 
	//set button enable     
	}
	});

	return false;

	}
	});



	$('#customername').blur(function(){
	var cusname=$('#customername').val();
	if(cusname!="")
	{              
	$.post('<?php echo base_url();?>salesreturn/getinvoiceno',{cusname:cusname},function(res){

	//  /*get response as json */
	$('#invoiceno').find("option:eq(0)").attr('value', '').text('Select Invoice No');
	var obj=jQuery.parseJSON(res);
	$(obj).each(function()
	{
	var option = $('<option />');
	option.attr('value', this.value).text(this.label);
	$('#invoiceno').append(option);
	});            

	});
	}
	});



	$('#invoiceno').change(function(){
	var invoiceno=$('#invoiceno').val();

	if(invoiceno!="")
	{   


	$.post('<?php echo base_url();?>salesreturn/getdetails',{invoiceno:invoiceno},
	function(res){

	$('#ajaxs').html(res);

	});
	}
	});



	//Cash Show
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
