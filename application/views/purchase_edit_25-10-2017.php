	<?php $data=$this->db->get('profile')->result(); 
	foreach($data as $d)
	?>
		<title> <?php echo $d->companyname;?></title>
		<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
		<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
		<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
		<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
		<style type="text/css">
			.forms{ }
			.forms input{ width: 95%; }
			.uppercase { text-transform: uppercase; }
			td,th { font-size: 12px;color:black;}
			textarea.form-control { min-height: 40px !important; }
			.myform {}
			.myform input[type="text"]{ width:100%; border: 1px solid #dcdcdc; border-radius: 4px; padding:8px; color: #435966;}
			.myform input[type="hidden"]{ background:#626262;}
			.parsley-required { color:#f00 !important; }
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
									<i class="zmdi zmdi-shopping-cart">&nbsp;Edit Purchase Receipt</i>
								</header>
								<div class="card-box">
									<div class="row">
									<?php foreach($result as $vi)  ?> 
									<div class="card-box">
									<div class="row">
									<form class="form-horizontal myform"  method="post" action="<?php echo base_url();?>purchase/update" data-parsley-validate novalidate>
										<div class="form-group ">
											<div class="col-md-8 forms">
												<div class="col-md-3">
													<div class="form-group">
														<label >Date</label>
														<input type="text" class="form-control" readonly name="purchasedate" parsley-trigger="change" id="datepicker-autoclose" required="" value="<?php echo date('d-m-Y',strtotime($vi['purchasedate']));?>" style="width:148px;">
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<label>Supplier  Name</label>
														<input type="text" class="form-control" parsley-trigger="change" required name="suppliername" id="suppliername" value="<?php echo $vi['suppliername'];?>">
														<input type="hidden" class="form-control"  name="supplierid" id="supplierid" value="">
														<div id="cusname_valid" style="position: absolute;"></div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Invoice No</label>
														<input type="text" class="form-control" value="<?php echo $vi['invoiceno'];?>"  name="invoiceno" id="invoiceno" value="" style="width:148px;">
														<div id="invoiceno_valid"></div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Invoice Date</label>
														<input type="text" auotocomplete="off" class="form-control datepicker-autoclose" name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y',strtotime($vi['invoicedate']));?>" >
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>GST Type</label>
														<select  class="form-control" parsley-trigger="change" required name="gsttype" id="gsttype" >
															<option value="intrastate" <?php if($vi['gsttype']=='intrastate')echo 'selected';?>>Intrastate</option>
															<option value="interstate" <?php if($vi['gsttype']=='interstate')echo 'selected';?>>Interstate</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Address</label>
													<textarea type="text" class="form-control" name="address" id="address"  rows="4"><?php echo $vi['address'];?></textarea>
												</div>
											</div>
										</div>
										<table class="table">
											<thead> 
												<tr>
													<th>HSN Code</th>
													<th>Item Name</th>
													<th>Qty</th>
													<th>UOM</th>
													<th>Rate</th>
													<th>Amount</th>
													<th>Disc %</th>
													<th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
													<?php if($vi['gsttype']=='intrastate') { ?>
													<th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
													<th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
													<th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
													<th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
													<?php }else {  ?>


													<th  class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
													<th " class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
													<?php } ?>
													<th>Total</th>
												</tr>  
											</thead>
											<tbody>
												<?php 
												$hsnno=explode('||',$vi['hsnno']);
												$itemname=explode('||',$vi['itemname']);
												$qty=explode('||',$vi['qty']);
												$uom=explode('||',$vi['uom']);
												$rate=explode('||',$vi['rate']);
												$amount=explode('||',$vi['amount']);
												$taxableamount=explode('||',$vi['taxableamount']);
												$discount=explode('||',$vi['discount']);
												$discountamount=explode('||',$vi['discountamount']);
												$cgst=explode('||',$vi['cgst']);
												$cgstamount=explode('||',$vi['cgstamount']);
												$sgst=explode('||',$vi['sgst']);
												$igst=explode('||',$vi['igst']);
												$sgstamount=explode('||',$vi['sgstamount']);
												$igstamount=explode('||',$vi['igstamount']);
												$total=explode('||',$vi['total']);

												for($i=0;$i<count($itemname);$i++) { 
												$this->db->select('*');
												$this->db->from('additem');
												$this->db->where('itemname',$itemname[$i]);
												$item_query = $this->db->get();
												$item_result = $item_query->row();
												?>
												<tr>
													<td>
														<input class="" id="hsnno<?php echo $i;?>" readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="<?php echo $hsnno[$i];?>">
														<input class="form-control"  id="itemno" type="hidden" name="itemno[]" value="">
														<input class="form-control"  id="id<?php echo $i;?>" type="hidden"  value="<?php echo $i;?>">
														<div id="hsnno_valid<?php echo $i;?>"></div>
													</td>
													<td>
														<input class="itemname_class" data-id="<?php echo $i;?>" id="itemname<?php echo $i;?>" value="<?php echo $itemname[$i];?>" style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" value="" ><div id="itemname_valid<?php echo $i;?>"></div><input type="hidden" id="priceType<?php echo $i;?>" name="priceType[]" value="<?php echo $item_result->priceType;?>" />
													</td>
													<td>
														<input class="qty_class" data-id="<?php echo $i;?>" id="qty<?php echo $i;?>" required type="text" name="qty[]" value="<?php echo $qty[$i];?>"   autocomplete="off" style="width:50px;border:1px solid #605f5f;"><input type="hidden" name="qtys" id="qtys<?php echo $i;?>" value="<?php echo $qty[$i];?>"><div id="qty_valid<?php echo $i;?>"></div>
													</td>  
													<td><input class="" value="<?php echo $uom[$i];?>" id="uom<?php echo $i;?>" readonly style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]"   autocomplete="off"></td>
													<td><input class="rate_class decimals" data-id="<?php echo $i;?>" value="<?php echo $rate[$i];?>" id="rate<?php echo $i;?>" required style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]"   autocomplete="off"><div id="rate_valid<?php echo $i;?>"></div></td>
													<td><input class="decimals" id="amount<?php echo $i;?>" value="<?php echo $amount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal<?php echo $i;?>" value=""><div id="rate_valid<?php echo $i;?>"></div></td>
													<td><input class="discount_class decimals" data-id="<?php echo $i;?>"  id="discount<?php echo $i;?>" value="<?php echo $discount[$i];?>"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" value="0"  autocomplete="off"><div id="discount_valid<?php echo $i;?>"></div><input type="hidden" id="oldDisc<?php echo $i;?>" value="<?php echo $discount[$i];?>" ></td>
													<td><input class="decimals" id="taxableamount<?php echo $i;?>" value="<?php echo $taxableamount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount<?php echo $i;?>"></td>
													
													<?php if($vi['gsttype']=='intrastate') { ?>
													<td class="sgst"><input class="decimals" value="<?php echo $cgst[$i];?>" readonly id="cgst<?php echo $i;?>" required type="text" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required><div id="cgst_valid<?php echo $i;?>"></div></td>
													<td class="sgst"><input class="decimals" value="<?php echo $cgstamount[$i];?>" id="cgstamount<?php echo $i;?>" required type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>
													<td class="sgst"><input class="decimals" id="sgst<?php echo $i;?>" value="<?php echo $sgst[$i];?>" required type="text" name="sgst[]" value="" readonly style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required><div id="sgst_valid<?php echo $i;?>"></div></td>
													<td class="sgst"><input class="decimals" value="<?php echo $sgstamount[$i];?>" id="sgstamount<?php echo $i;?>" required type="text" name="sgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
													<input type="hidden" id="igst<?php echo $i;?>" value="<?php echo $item_result->igst;?>" />
													</td>
													<?php } else { ?>
													<td class="igst" ><input class="decimals" id="igst<?php echo $i;?>"  type="text" name="igst[]" readonly style="width:45px;border:1px solid #605f5f;" value="<?php echo $igst[$i];?>"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid<?php echo $i;?>"></div></td>
													<td class="igst"><input class="decimals" id="igstamount<?php echo $i;?>" value="<?php echo $igstamount[$i];?>" type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>
													<?php } ?>
													<td><input class="" id="total<?php echo $i;?>" type="text" value="<?php echo $total[$i];?>" name="total[]"  value=""  readonly style="width:110px;border:1px solid #605f5f;"></td>
													<?php
													if($i==0)
													{

													} 
													else
													{
														echo'<td><button type="button" id="remove'.$i.'" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>';
													}
													?>                   
												</tr>
												<?php } ?>
											</tbody>
											<tbody id="append"></tbody> 
										</table> 
										<div class="col-sm-offset-11">
											<button type="button" class="btn btn-info add pull-right" style="margin-right: 10px;"><i class="fa fa-plus"></i></button>
											<input type="hidden"  id="hide" value="<?php echo ($i-1);?>">
										</div>
										<br>
										<table class="table">
											<tr>
												<td>Freight Charges</td>
												<td><input class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="border:1px solid #605f5f;" type="text" name="freightamount" value="<?php echo $vi['freightamount'];?>"  autocomplete="off"></td>
												<?php if($vi['gsttype']=='intrastate') { ?>
												<td ><input class="decimals"  id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="<?php echo $vi['freightcgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
												<td ><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightcgstamount'];?>"></td>
												<td ><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" readonly value="<?php echo $vi['freightsgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="sgst_valid"></div></td>
												<td ><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightsgstamount'];?>"></td>
												<?php 
												} 
												else 
												{
												?> 
												<td ><input class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST" value="<?php echo $vi['freightigst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="igst_valid"></div></td>
												<td ><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightigstamount'];?>"></td>
												<?php } ?>
												<td><input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="<?php echo $vi['freighttotal'];?>"  readonly style="border:1px solid #605f5f;"></td>
											</tr>
											<tr>
												<td>Loading & Packing Charges</td>
												<td><input class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="border:1px solid #605f5f;" type="text" name="loadingamount" value="<?php echo $vi['loadingamount'];?>"  autocomplete="off"><div id="rate_valid"></div></td>
												<?php if($vi['gsttype']=='intrastate') { ?>
												<td ><input class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="<?php echo $vi['loadingcgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="cgst_valid"></div></td>
												<td ><input class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingcgstamount'];?>"></td>
												<td ><input class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" readonly value="<?php echo $vi['loadingsgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="sgst_valid"></div></td>
												<td ><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount" readonly  placeholder="SGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingsgstamount'];?>"></td>
												<?php 
												} 
												else 
												{
												?> 
												<td ><input class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST" value="<?php echo $vi['loadingigst'];?>"  style="border:1px solid #605f5f;"   autocomplete="off" ><div id="igst_valid"></div></td>
												<td ><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingigstamount'];?>"></td>
												<?php } ?>
												<td><input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="<?php echo $vi['loadingtotal'];?>"  readonly style="border:1px solid #605f5f;"></td>
											</tr>
										</table>

										<div class="col-sm-offset-5">
											<label class="col-sm-5  control-label" >Sub Total</label>
											<div class="col-sm-7">
												<input class="form-control"  type="text" value="<?php echo $vi['subtotal'];?>" name="subtotal" id="subtotal" readonly  placeholder="0" value="0">
											</div>
										</div>
										<br>
										<br>    

										<div class="col-sm-offset-5">
											<label class="col-sm-5  control-label" >Round Off</label>
											<div class="col-sm-7">
												<input class="form-control"  type="text" name="othercharges" id="othercharges"  value="<?php echo $vi['othercharges'];?>" placeholder="0" value="0">
											</div>
										</div>
										<br>
										<br>  

										<div class=" col-sm-offset-5">
											<label class="col-sm-5  control-label" >Purchase Total</label>
											<div class="col-sm-7">
												<input class="form-control"  type="text" value="<?php echo $vi['grandtotal'];?>" readonly name="grandtotal" id=	"grandtotal" >
												<input class="form-control"  type="hidden" name="taxtotal" id="grandtotal1" value="">
											</div>                      
										</div>
										<div class="col-sm-offset-4">
											<input type="hidden" name="purchaseno" value="<?php echo $vi['purchaseno'];?>">
											<input type="hidden" name="id" value="<?php echo $vi['id'];?>">
											<button  class="btn btn-info" id="submit">Update</button>
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

		<script src="<?php echo base_url();?>assets/autocomplete/jquery-ui.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js" type="text/javascript"></script>
		<script src="<?php echo base_url();?>assets/plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
		<script src="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
		<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			$('form').parsley();
			});

			$('.colorpicker-default').colorpicker({ format: 'hex' });
			$('.colorpicker-rgba').colorpicker();
			// Date Picker
			jQuery('#datepicker').datepicker();
			jQuery('.datepicker-autoclose').datepicker({ autoclose: true, todayHighlight: true });

			$(document).ready(function(){
				call_keyup();
				$('#gsttype').change(function(){
					var gsttype=$('#gsttype').val();
					$('input[name^="hsnno"]').val('');
					$('input[name^="itemname"]').val('');
					$('input[name^="qty"]').val('');
					$('input[name^="uom"]').val('');
					$('input[name^="rate"]').val('');
					$('input[name^="amount"]').val('');
					$('input[name^="discount"]').val('');
					$('input[name^="taxableamount"]').val('');
					$('input[name^="discountamount"]').val('');
					$('input[name^="cgst"]').val('');
					$('input[name^="cgstamount"]').val('');
					$('input[name^="sgst"]').val('');
					$('input[name^="sgstamount"]').val('');   
					$('input[name^="igst"]').val('');        
					$('input[name^="igstamount"]').val('');
					$('input[name^="total"]').val('');

					$('#hsnno').val('');
					$('#itemname').val('');
					$('#qty').val('');
					$('#uom').val('');
					$('#rate').val('');
					$('#amount').val('');
					$('#discount').val('');
					$('#taxableamount').val('');
					$('#discountamount').val('');
					$('#cgst').val('');
					$('#cgstamount').val('');
					$('#sgst').val('');
					$('#sgstamount').val('');
					$('#igst').val('');
					$('#igstamount').val('');
					$('#total').val('');

					if(gsttype=='interstate')
					{
						$('.sgst').hide();
						$('.igst').show();
						$('#sgst').val('0');
						$('#sgstamount').val('0.00');
						$('#cgst').val('0');
						$('#cgstamount').val('0.00');
					}
					else  if(gsttype=='intrastate')
					{
						$('.sgst').show();
						$('.igst').hide();
						$('#igst').val('0');
						$('#igstamount').val('0.00');
					}
				});

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
					}, select: function (event, ui) {
						$("#suppliername").val(ui.item.label); 
						$('#address').val(ui.item.address); 
						$('#tinno').val(ui.item.tinno); 
						$('#cstno').val(ui.item.cstno); 
						$('#supplierid').val(ui.item.supplierid); 
						var name = $('#suppliername').val();
						if(name !='')
						{
							$.post('<?php echo base_url();?>purchase/getsupplier',{name:name},function(res){
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

				$('#suppliername').keyup(function(){
					var name = $('#suppliername').val();
					if(name !='')
					{
						$.post('<?php echo base_url();?>purchase/getsupplier',{name:name},function(res){
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

				

			$('#suppliername').blur(function(){ 
				var name=$(this).val();
				if(name !='')
				{
					$.post('<?php echo base_url();?>purchase/get_supplier',{name:name},function(res){
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
							//set button enable     
						}
					});
					return false;
				}
			});



			

			$('.add').click(function(){
			  var start=$('#hide').val();
			  var total=Number(start)+1;
			  $('#hide').val(total);
			  var tbody=$('#append');
			  

			   var mod = $('#gsttype').val();
			  var samples,samples1;
			  if (mod == 'intrastate') {
				samples = "none";
				samples1 = "nones";
			  } else {
				samples = "nones";
				samples1 = "none";
			  }


			  $(' <tr>'
				+'<td><input class="" id="hsnno'+total+'" style="width:70px;border:1px solid #605f5f;" readonly type="text" name="hsnno[]" value="" style="width:70px;border:1px solid #605f5f;"><div id="hsnno_valid'+total+'"></div></td>'
				+'<td><input class="itemname_class" data-id="'+total+'"  parsley-trigger="change" required id="itemname'+total+'"  style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" value=""><div id="itemname_valid'+total+'"></div><input type="hidden" name="priceType[]" id="priceType'+total+'" /></td>'
				+'<td><input class="qty_class" data-id="'+total+'" id="qty'+total+'"    parsley-trigger="change" required type="text" name="qty[]"   onkeypress="return isNumberKey(event)" autocomplete="off" style="width:50px;border:1px solid #605f5f;"><div id="qty_valid'+total+'"></div><input type="hidden" id="qtys'+total+'" value="0" /></td>'
				+'<td><input class="" readonly id="uom'+total+'"  style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]"   autocomplete="off"></td>'
				+'<td><input class="rate_class decimals" data-id="'+total+'" id="rate'+total+'"  style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]" required autocomplete="off"><div id="rate_valid'+total+'"></div></td>'
				+'<td><input class="decimals" id="amount'+total+'" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal'+total+'" value=""></td>'
				+'<td><input class="discount_class decimals" data-id="'+total+'" id="discount'+total+'"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" value="0"  autocomplete="off"><input type="hidden" id="oldDisc'+total+'" value="0" ></td>'
				+'<td><input class="decimals" id="taxableamount'+total+'" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount'+total+'"></td>'
				+'<td class="sgst" style="display:'+samples1+';"><input class="decimals" readonly id="cgst'+total+'"  type="text" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="cgst_valid'+total+'"></div></td>'
				+'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="cgstamount'+total+'"  type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>'
				+'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="sgst'+total+'"  type="text" name="sgst[]" readonly value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="sgst_valid'+total+'"></div></td>'
				+'<td class="sgst" style="display:'+samples1+';"><input class="decimals" id="sgstamount'+total+'"  type="text" name="sgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>'
				+'<td class="igst" style="display:'+samples+';"><input class="decimals" id="igst'+total+'"  type="text" name="igst[]"  style="width:45px;border:1px solid #605f5f;" readonly onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid'+total+'"></div></td>'
				+'<td class="igst" style="display:'+samples+';"><input class="decimals" id="igstamount'+total+'" readonly type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>'
				+'<td><input class="" id="total'+total+'" type="text" name="total[]" value=""  readonly style="width:110px;border:1px solid #605f5f;"></td>'
				+'<td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td></tr>').appendTo(tbody);
				call_keyup();

		  
			  
			});
		});

		 </script>

		<script type="text/javascript">
		  $('#document').ready(function(){
			$('#checkbox').click(function(){
			  if($(this).prop("checked")==true)
			  {
				$('#check').show();
				$('#imaddress').show();

			  }
			  else if($(this).prop("checked")==false)
			  {
				$('#check').hide();
				$('#imaddress').hide();
			  }
			});
		  });   


		  function isNumberKey(evt)
		  {
			var charCode = (evt.which) ? evt.which : event.keyCode
			if (charCode > 31 && (charCode < 48 || charCode > 57))
			  return false;
			return true;
		  }
		  function isNumber(evt)
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
				$('.decimals').keyup(function(){
				  var val = $(this).val();
				  if(isNaN(val)){
					val = val.replace(/[^0-9\.-]/g,'');
					if(val.split('.').length>2)
					  val =val.replace(/\.-+$/,"");
				  }
				  $(this).val(val);
				});
				
			function call_keyup()
			{
				$(".itemname_class").keyup(function(){
					var total = $(this).attr('data-id');
					$( "#itemname"+total).autocomplete({
						source: function(request, response) {
							$.ajax({ 
								url: "<?php echo base_url();?>purchase/autocomplete_itemname",
								data: { keyword: $("#itemname"+total).val()},
								dataType: "json",
								type: "POST",
								success: function(data){ 
									response(data);
								}            
							});
						},
						select: function (event, ui) {
							var name=ui.item.value;
							$('#itemname'+total).val(ui.item.value);
							$.post('<?php echo base_url();?>purchase/get_itemnames',{name:name},function(rest){
								var obj=jQuery.parseJSON(rest);
								$('#hsnno'+total).val(obj.hsnno);
								$('#priceType'+total).val(obj.priceType);
								$('#itemno'+total).val(obj.itemno);
								$('#rate'+total).val(obj.price);
								$('#sgst'+total).val(obj.sgst);
								$('#cgst'+total).val(obj.cgst);
								$('#igst'+total).val(obj.igst);
								$('#uom'+total).val(obj.uom);
								$('#qty'+total).val('');
								$('#qty'+total).focus();
							});            
							if(name !='')
							{
								$.post('<?php echo base_url();?>invoice/gets',{name:name},function(res){
									if(res > 0)
									{
										$('#itemname_valid'+total).html('<span><font color="green">Available!</span>');
										$('#submit').attr('disabled',false);
										$('#print').attr('disabled',false);
									}
									else
									{
										$('#itemname_valid'+total).html('<span><font color="red"> Not Available !</span>');
										$('#submit').attr('disabled',true); //set button enable 
										$('#print').attr('disabled',true); //set button enable 
										//set button enable     
									}
								});
								return false;
							}
						}
					});
				});
				$('.qty_class').keyup(function(){
					var rowNumber = $(this).attr('data-id');
					var priceType = $("#priceType"+rowNumber).val();
					var qty=$('#qty'+rowNumber+'').val();
					if(qty != '')
					{
						if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
						//frieght_calculation();
						totalAmt_calculation();
					}
					else
					{
						$('#qty_valid'+rowNumber+'').html('<span><font color="red">Invalid Qty !</span>');
						var oldQty = $("#qtys"+rowNumber).val();
						$('#qty'+rowNumber+'').val(oldQty);
						$('#qty_valid'+rowNumber+'').html('');
						if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
						totalAmt_calculation();
					}
					
				});
				//RATE CHANGE FUNCTION
				$('.rate_class').keyup(function(){
					var rowNumber = $(this).attr('data-id');
					var priceType = $("#priceType"+rowNumber).val();
					var rate=$('#rate'+rowNumber+'').val();
					$('#rate_valid'+rowNumber+'').html('');
					
					if(parseFloat(rate) > 0)
					{
						if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
						//frieght_calculation();
						totalAmt_calculation();
					}
					else
					{
						$('#rate_valid'+rowNumber+'').html('<span><font color="red">Invalid Rate !</span>');
						$('#rate_valid'+rowNumber+'').val('');
					}
				});
				// DISCOUNT CHANGE FUNCTION
				$('.discount_class').keyup(function(){
					var rowNumber = $(this).attr('data-id');
					var priceType = $("#priceType"+rowNumber).val();
					$('#discount_valid'+rowNumber+'').html('');
					var discount=$('#discount'+rowNumber+'').val();
					if(discount!='')
					{
						if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
						//frieght_calculation();
						totalAmt_calculation();
					}
					else
					{
						$('#discount_valid'+rowNumber+'').html('<span><font color="red">Invalid Discount !</span>');
						var oldDisc = $("#oldDisc"+rowNumber).val();
						$('#discount'+rowNumber+'').val('0');
						$('#discount_valid'+rowNumber+'').html('');
						if(priceType=="Inclusive") { Inc_amount_calculation(rowNumber); } else { amount_calculation(rowNumber); }
						totalAmt_calculation();
					}
				});
					//calculation--------------------------------------------------
			
				$('#freightamount').keyup(function(){
					frieght_calculation();
					totalAmt_calculation();
				});

				$('#freightcgst').keyup(function(){
					var freightcgst=$('#freightcgst').val();
					$('#freightsgst').val(freightcgst);
					frieght_calculation();
					totalAmt_calculation();
				});

				$('#freightigst').keyup(function(){
				   frieght_calculation();
					totalAmt_calculation();
				});

				$('#loadingamount').keyup(function(){
				   frieght_calculation();
					totalAmt_calculation();
				});

				$('#loadingcgst').keyup(function(){
					var loadingcgst=$('#loadingcgst').val();
					$('#loadingsgst').val(loadingcgst);
					frieght_calculation();
					totalAmt_calculation();
				});

				$('#loadingigst').keyup(function(){
					frieght_calculation();
					totalAmt_calculation();
				});

				$('#othercharges').keyup(function(){
					//amount_calculation();
					//frieght_calculation();
					totalAmt_calculation();
				});
				//REMOVE FUNCTION
				 $('.remove').click(function(){
					$(this).parents('tr').remove();
					totalAmt_calculation();
				 });
			}
			function amount_calculation(rowNumber)
			{
				var qty=$('#qty'+rowNumber).val();
				var rate=$('#rate'+rowNumber).val();

				if(qty!='' && rate!='')
				var amo=parseFloat(rate)*parseFloat(qty);
				var amou=amo.toFixed(2);
				$('#amount'+rowNumber).val(amou);
				$('#taxableamount'+rowNumber).val(amou);
				$('#total'+rowNumber).val(amou);

				var discount=$('#discount'+rowNumber).val();
				var cgst=$('#cgst'+rowNumber).val();
				var sgst=$('#sgst'+rowNumber).val();
				var igst=$('#igst'+rowNumber).val(); 
				var taxableamount=$('#taxableamount'+rowNumber).val(); 
				var gsttype=$('#gsttype').val(); 
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
				var k=taxableamount;
				var l=0;


				if(discount != '')
				{
					a=((parseFloat(amo)*parseFloat(discount))/100);
					var a1=a.toFixed(2);
					var a2=parseFloat(amo)-parseFloat(a1);
					var a3=a2.toFixed(2);
					k=a3;
					$('#discountamount'+rowNumber).val(a1);
					$('#taxableamount'+rowNumber).val(a3);
					$('#total'+rowNumber).val(a3);
				}
				if(gsttype=='intrastate')
				{
					if(cgst > 0)
					{
						b=((parseFloat(k)*parseFloat(cgst))/100);
						var b1=b.toFixed(2);
						$('#cgstamount'+rowNumber).val(b1);
						var b2=parseFloat(k)+parseFloat(b);
						var b3=b2.toFixed(2);
						$('#total'+rowNumber).val(b3);
					}

					if(sgst > 0)
					{
						c=((parseFloat(k)*parseFloat(sgst))/100);
						var c1=c.toFixed(2);
						$('#sgstamount'+rowNumber).val(c1);
						var c2=parseFloat(k)+parseFloat(b)+parseFloat(c);
						var c3=c2.toFixed(2);
						$('#total'+rowNumber).val(c3);
					}
				}
				else  if(gsttype=='interstate')
				{
					if(igst > 0)
					{
						h=((parseFloat(k)*parseFloat(igst))/100);
						var h1=h.toFixed(2);
						$('#igstamount'+rowNumber).val(h1);
						var h2=parseFloat(k)+parseFloat(h);
						var h3=h2.toFixed(2);
						$('#total'+rowNumber).val(h3);
					}
				}
			}
			
			function Inc_amount_calculation(total)
			{
				var qty=$('#qty'+total).val();
				var rate=$('#rate'+total).val();

				if(qty!='' && rate!='')
				var amo=parseFloat(rate)*parseFloat(qty);
				var amou=amo.toFixed(2);

				var discount=$('#discount'+total).val();
				var cgst=$('#cgst'+total).val();
				var sgst=$('#sgst'+total).val();
				var igst=$('#igst'+total).val(); 
				var gsttype=$('#gsttype').val(); 
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
				var k=0;
				var l=0;
				var taxableamount=0;
				var discountamount=0;
				taxableamount = amou;


				if(discount != '')
				{
					a=(parseFloat(amo)-parseFloat(discount));
					//alert(amo+'\n'+discount);
					var discountamount=a.toFixed(2);
					var a2=parseFloat(amo)-parseFloat(discount);
					taxableamount=a2.toFixed(2);
				}
				k = taxableamount;
				$('#discountamount'+total+'').val(discountamount);
				$('#taxableamount'+total+'').val(taxableamount);
				if(gsttype=='intrastate')
				{
					if(cgst > 0)
					{
						var divideBy = parseFloat(igst)+100;
						b=((parseFloat(k)*parseFloat(igst))/divideBy)/2;
						var b1=b.toFixed(2);
						$('#cgstamount'+total+'').val(b1);
						var b2=parseFloat(k)-parseFloat(b);
						var b3=b2.toFixed(2);
						$('#amount'+total+'').val(b3);
						var totalVal = (parseFloat(b3)+parseFloat(b)).toFixed(2);
						$("#total"+total).val(totalVal);
					}

					if(sgst > 0)
					{
						var divideBy = parseFloat(igst)+100;
						c=((parseFloat(k)*parseFloat(igst))/divideBy)/2;
						var c1=c.toFixed(2);
						$('#sgstamount'+total+'').val(c1);
						var c2=parseFloat(k)-(parseFloat(b)+parseFloat(c));
						var c3=c2.toFixed(2);
						$('#amount'+total+'').val(c3);
						var totalVal = (parseFloat(c3)+(parseFloat(b)+parseFloat(c))).toFixed(2);
						$("#total"+total).val(totalVal);
					}
				}
				else  if(gsttype=='interstate')
				{
					if(igst > 0)
					{
						var divideBy = parseFloat(igst)+100;
						d=((parseFloat(k)*parseFloat(igst))/divideBy);
						var d1=d.toFixed(2);
						$('#igstamount'+total+'').val(d1);
						var d2=parseFloat(k)-parseFloat(d);
						var d3=d2.toFixed(2);
						$('#amount'+total+'').val(d3);
						var totalVal = (parseFloat(d3)+parseFloat(d)).toFixed(2);
						$("#total"+total).val(totalVal);
					}
				}
			}
			
			
			function frieght_calculation()
			{
				
				var gsttype=$('#gsttype').val(); 
				var freightamount=$('#freightamount').val();
				var freightcgst=$('#freightcgst').val();
				var freightsgst=$('#freightsgst').val();
				var freightigst=$('#freightigst').val();
				var loadingamount=$('#loadingamount').val();
				var loadingcgst=$('#loadingcgst').val();
				var loadingsgst=$('#loadingsgst').val();
				var loadingigst=$('#loadingigst').val();
				
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
				//var k=taxableamount;
				var l=0;

				if(freightamount=='')
				{
					var fa=0;
					$('#freightcgst').val('');
					$('#freightsgst').val('');
					$('#freightigst').val('');

					$('#freightcgstamount').val('');
					$('#freightsgstamount').val('');
					$('#freightigstamount').val('');
				} 
				else
				{
					var fa=freightamount;
				}

				if(loadingamount=='')
				{ 
					var la=0;
					$('#loadingcgst').val('');
					$('#loadingsgst').val('');
					$('#loadingigst').val('');

					$('#loadingcgstamount').val('');
					$('#loadingsgstamount').val('');
					$('#loadingigstamount').val('');
				}
				else
				{
					var la=loadingamount;
				}

				if(gsttype=='intrastate')
				{
					if(freightcgst > 0)
					{
						d=((parseFloat(fa)*parseFloat(freightcgst))/100);
						var d1=d.toFixed(2);
						$('#freightcgstamount').val(d1);
						var d2=parseFloat(fa)+parseFloat(d);
						var d3=d2.toFixed(2);
						$('#freighttotal').val(d3);
					}
					else
					{
						$('#freighttotal').val(0);
					}

					if(freightsgst > 0)
					{
						e=((parseFloat(fa)*parseFloat(freightsgst))/100);
						var e1=e.toFixed(2);
						$('#freightsgstamount').val(e1);
						var e2=parseFloat(fa)+parseFloat(d)+parseFloat(e);
						var e3=e2.toFixed(2);
						$('#freighttotal').val(e3);
					}
					else
					{
						$('#freighttotal').val(0);
					}

					if(loadingcgst > 0)
					{
						f=((parseFloat(la)*parseFloat(loadingcgst))/100);
						var f1=f.toFixed(2);
						$('#loadingcgstamount').val(f1);
						var f2=+parseFloat(la)+parseFloat(f);
						var f3=f2.toFixed(2);
						$('#loadingtotal').val(f3);
					}
					else
					{
						$('#loadingtotal').val(0);
					}

					if(loadingsgst > 0)
					{
						g=((parseFloat(la)*parseFloat(loadingsgst))/100);
						var g1=g.toFixed(2);
						$('#loadingsgstamount').val(g1);
						var g2=parseFloat(la)+parseFloat(f)+parseFloat(g);
						var g3=g2.toFixed(2);
						$('#loadingtotal').val(g3);
					}
					else
					{
						$('#loadingtotal').val(0);
					}
				}
				else  if(gsttype=='interstate')
				{
					
					if(freightigst > 0)
					{
						i=((parseFloat(fa)*parseFloat(freightigst))/100);
						var i1=i.toFixed(2);
						$('#freightigstamount').val(i1);
						var i2=parseFloat(fa)+parseFloat(i);
						var i3=i2.toFixed(2);
						$('#freighttotal').val(i3);
					}
					else
					{
						$('#freighttotal').val(0);
					}

					if(loadingigst > 0)
					{
						j=((parseFloat(la)*parseFloat(loadingigst))/100);
						var j1=j.toFixed(2);
						$('#loadingigstamount').val(j1);
						var j2=parseFloat(la)+parseFloat(j);
						var j3=j2.toFixed(2);
						$('#loadingtotal').val(j3);
					}
					else
					{
						$('#loadingtotal').val(0);
					}
				}
			}
			function totalAmt_calculation()
			{
				var othercharges=$('#othercharges').val();
				var sub_tot=0;
				sub_tot +=Number($('#freighttotal').val());
				sub_tot +=Number($('#loadingtotal').val());  
				$('input[name^="total"]').each(function(){
					sub_tot +=Number($(this).val()); 
					var fina=sub_tot.toFixed(2);         
					$('#subtotal').val(fina);
					$('#grandtotal').val(fina); 
				});

				if(othercharges)
				{
					l=parseFloat(sub_tot)+parseFloat(othercharges);
					var l1=l.toFixed(2);
					$('#grandtotal').val(l1);
				}
			}	
		
		</script>

