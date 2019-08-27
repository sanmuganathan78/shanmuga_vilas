<?php $discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy; ?>
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
<link href="<?php echo base_url();?>assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
<style type="text/css">
  .forms{ }
  .forms input{ width: 95%; }
  .uppercase {
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
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-view-headline">&nbsp;View Purchase Receipt</i>
            </header>
            <?php foreach($result as $vi)  ?> 
            <div class="card-box">
			
              <div class="row">
				<!-- NAGOOR START- -->
				<form class="form-horizontal"  method="post" action="<?php echo base_url();?>purchase/update" data-parsley-validate novalidate>
										<div class="form-group ">
											<div class="col-md-8 forms">
												<div class="col-md-3">
													<div class="form-group">
														<label >Date</label>
														<input type="text" class="form-control" disabled name="purchasedate" parsley-trigger="change" id="datepicker-autoclose" required="" value="<?php echo date('d-m-Y',strtotime($vi['purchasedate']));?>" style="width:148px;">
													</div>
												</div>
												<div class="col-md-5">
													<div class="form-group">
														<label>Supplier  Name</label>
														<input type="text" disabled class="form-control" parsley-trigger="change" required name="suppliername" id="suppliername" value="<?php echo $vi['suppliername'];?>">
														<input type="hidden" class="form-control"  name="supplierid" id="supplierid" value="">
														<div id="cusname_valid" style="position: absolute;"></div>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<label>Invoice No</label>
														<input type="text" disabled class="form-control" value="<?php echo $vi['invoiceno'];?>"  name="invoiceno" id="invoiceno" value="" style="width:148px;">
														<div id="invoiceno_valid"></div>
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>Invoice Date</label>
														<input type="text" disabled auotocomplete="off" class="form-control datepicker-autoclose" name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y',strtotime($vi['invoicedate']));?>" >
													</div>
												</div>
												<div class="col-md-4">
													<div class="form-group">
														<label>GST Type</label>
														<select  class="form-control" disabled parsley-trigger="change" required name="gsttype" id="gsttype" >
															<option value="intrastate" <?php if($vi['gsttype']=='intrastate')echo 'selected';?>>Intrastate</option>
															<option value="interstate" <?php if($vi['gsttype']=='interstate')echo 'selected';?>>Interstate</option>
														</select>
													</div>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label>Address</label>
													<textarea disabled type="text" class="form-control" name="address" id="address"  rows="4"><?php echo $vi['address'];?></textarea>
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
													<th>Disc <?php if($discountBy=='percent_wise') { echo '%'; } ?></th>
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
														<input class="" disabled id="hsnno<?php echo $i;?>" readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="<?php echo $hsnno[$i];?>">
														<input class="form-control"  id="itemno" type="hidden" name="itemno[]" value="">
														<input class="form-control"  id="id<?php echo $i;?>" type="hidden"  value="<?php echo $i;?>">
														<div id="hsnno_valid<?php echo $i;?>"></div>
													</td>
													<td>
														<input disabled class="itemname_class" data-id="<?php echo $i;?>" id="itemname<?php echo $i;?>" value="<?php echo $itemname[$i];?>" style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" value="" ><div id="itemname_valid<?php echo $i;?>"></div><input type="hidden" id="priceType<?php echo $i;?>" name="priceType[]" value="<?php echo $item_result->priceType;?>" />
													</td>
													<td>
														<input disabled class="qty_class" data-id="<?php echo $i;?>" id="qty<?php echo $i;?>" required type="text" name="qty[]" value="<?php echo $qty[$i];?>"   autocomplete="off" style="width:50px;border:1px solid #605f5f;"><input type="hidden" name="qtys" id="qtys" value=""><div id="qty_valid<?php echo $i;?>"></div>
													</td>  
													<td><input disabled class="" value="<?php echo $uom[$i];?>" id="uom<?php echo $i;?>" readonly style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]"   autocomplete="off"></td>
													<td><input disabled class="rate_class decimals" data-id="<?php echo $i;?>" value="<?php echo $rate[$i];?>" id="rate<?php echo $i;?>" required style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]"   autocomplete="off"><div id="rate_valid<?php echo $i;?>"></div></td>
													<td><input disabled class="decimals" id="amount<?php echo $i;?>" value="<?php echo $amount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off"><input type="hidden" name="gstcal[]" id="gstcal<?php echo $i;?>" value=""><div id="rate_valid<?php echo $i;?>"></div></td>
													<td><input disabled class="discount_class decimals" id="discount<?php echo $i;?>" value="<?php echo $discount[$i];?>"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" value="0"  autocomplete="off"><div id="discount_valid<?php echo $i;?>"></div></td>
													<td><input disabled class="decimals" id="taxableamount<?php echo $i;?>" value="<?php echo $taxableamount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off"><input type="hidden" name="discountamount[]" id="discountamount<?php echo $i;?>"></td>
													
													<?php if($vi['gsttype']=='intrastate') { ?>
													<td class="sgst"><input disabled class="decimals" value="<?php echo $cgst[$i];?>" readonly id="cgst<?php echo $i;?>" required type="text" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required><div id="cgst_valid<?php echo $i;?>"></div></td>
													<td class="sgst"><input disabled class="decimals" value="<?php echo $cgstamount[$i];?>" id="cgstamount<?php echo $i;?>" required type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>
													<td class="sgst"><input disabled class="decimals" id="sgst<?php echo $i;?>" value="<?php echo $sgst[$i];?>" required type="text" name="sgst[]" value="" readonly style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required><div id="sgst_valid<?php echo $i;?>"></div></td>
													<td class="sgst"><input disabled class="decimals" value="<?php echo $sgstamount[$i];?>" id="sgstamount<?php echo $i;?>" required type="text" name="sgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
													<input type="hidden" id="igst<?php echo $i;?>" value="<?php echo $item_result->igst;?>" />
													</td>
													<?php } else { ?>
													<td class="igst" ><input disabled class="decimals" id="igst<?php echo $i;?>"  type="text" name="igst[]" readonly style="width:45px;border:1px solid #605f5f;" value="<?php echo $igst[$i];?>"  onkeypress="return isNumberKey(event)" autocomplete="off" ><div id="igst_valid<?php echo $i;?>"></div></td>
													<td class="igst"><input disabled class="decimals" id="igstamount<?php echo $i;?>" value="<?php echo $igstamount[$i];?>" type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value=""></td>
													<?php } ?>
													<td><input class="" disabled id="total<?php echo $i;?>" type="text" value="<?php echo $total[$i];?>" name="total[]"  value=""  readonly style="width:110px;border:1px solid #605f5f;"></td>
													            
												</tr>
												<?php } ?>
											</tbody>
											<tbody id="append"></tbody> 
										</table> 
										
										<br>
										<table class="table">
											<tr>
												<td>Freight Charges</td>
												<td><input disabled class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="border:1px solid #605f5f;" type="text" name="freightamount" value="<?php echo $vi['freightamount'];?>"  autocomplete="off"></td>
												<?php if($vi['gsttype']=='intrastate') { ?>
												<td ><input disabled class="decimals"  id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="<?php echo $vi['freightcgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ></td>
												<td ><input disabled class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightcgstamount'];?>"></td>
												<td ><input disabled class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" readonly value="<?php echo $vi['freightsgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="sgst_valid"></div></td>
												<td ><input disabled class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" readonly  autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightsgstamount'];?>"></td>
												<?php 
												} 
												else 
												{
												?> 
												<td ><input disabled class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST" value="<?php echo $vi['freightigst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="igst_valid"></div></td>
												<td ><input disabled class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount"  autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['freightigstamount'];?>"></td>
												<?php } ?>
												<td><input disabled class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="<?php echo $vi['freighttotal'];?>"  readonly style="border:1px solid #605f5f;"></td>
											</tr>
											<tr>
												<td>Loading & Packing Charges</td>
												<td><input disabled class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount"  style="border:1px solid #605f5f;" type="text" name="loadingamount" value="<?php echo $vi['loadingamount'];?>"  autocomplete="off"><div id="rate_valid"></div></td>
												<?php if($vi['gsttype']=='intrastate') { ?>
												<td ><input disabled class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" value="<?php echo $vi['loadingcgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="cgst_valid"></div></td>
												<td ><input disabled class="decimals" readonly id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingcgstamount'];?>"></td>
												<td ><input disabled class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" readonly value="<?php echo $vi['loadingsgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" ><div id="sgst_valid"></div></td>
												<td ><input disabled class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount" readonly  placeholder="SGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingsgstamount'];?>"></td>
												<?php 
												} 
												else 
												{
												?> 
												<td ><input disabled class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST" value="<?php echo $vi['loadingigst'];?>"  style="border:1px solid #605f5f;"   autocomplete="off" ><div id="igst_valid"></div></td>
												<td ><input disabled class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $vi['loadingigstamount'];?>"></td>
												<?php } ?>
												<td><input disabled class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="<?php echo $vi['loadingtotal'];?>"  readonly style="border:1px solid #605f5f;"></td>
											</tr>
										</table>

										<div class="col-sm-offset-5">
											<label class="col-sm-5  control-label" >Sub Total</label>
											<div class="col-sm-7">
												<input disabled class="form-control"  type="text" value="<?php echo $vi['subtotal'];?>" name="subtotal" id="subtotal" readonly  placeholder="0" value="0">
											</div>
										</div>
										<br>
										<br>    

										<div class="col-sm-offset-5">
											<label class="col-sm-5  control-label" >Round Off</label>
											<div class="col-sm-7">
												<input disabled class="form-control"  type="text" name="roundOff" id="roundOff"  value="<?php echo $vi['roundOff'];?>" placeholder="0">
											</div>
										</div>
										<br>
										<br>  
										
										<div class="col-sm-offset-5">
											<label class="col-sm-5  control-label" >Other Charges</label>
											<div class="col-sm-7">
												<input disabled class="form-control"  type="text" name="othercharges" id="othercharges"  value="<?php echo $vi['othercharges'];?>" placeholder="0" value="0">
											</div>
										</div>
										<br>
										<br>  

										<div class=" col-sm-offset-5">
											<label class="col-sm-5  control-label" >Purchase Total</label>
											<div class="col-sm-7">
												<input class="form-control"  disabled type="text" value="<?php echo $vi['grandtotal'];?>" readonly name="grandtotal" id=	"grandtotal" >
												<input class="form-control"  type="hidden" name="taxtotal" id="grandtotal1" value="">
											</div>                      
										</div>
										<div class="col-sm-offset-4">
											<input type="hidden" name="purchaseno" value="<?php echo $vi['purchaseno'];?>">
											<input type="hidden" name="id" value="<?php echo $vi['id'];?>">
											<button  class="btn btn-info" id="submit" onclick="javascript:window.location.href='<?php echo base_url().'index.php/purchase/view';?>';"><i class="fa fa-chevron-left"></i> &nbsp; &nbsp;Back to Report</button>
										</div>
										</form>
									
				<!-- NAGOOR END -->
				<?PHP /*
                <form class="form-horizontal"  method="post"  target="_blank" onsubmit="setTimeout(function () { location.href = '<?php echo base_url();?>invoice'; })" action="<?php echo base_url();?>invoice/insert">
                  <div class="form-group forms">
                    <div class="col-md-8">
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Purchsae No</label>
                          <input type="text" class="form-control" name="invoiceno" id="invoiceno" value="<?php echo $vi['purchaseno'];?>"  readonly>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Date</label>
                          <input type="text" class="form-control datepicker-autoclose" name="invoicedate" readonly value="<?php echo date('d-m-Y',strtotime($vi['purchasedate']));?>" >
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Customer Name</label>
                          <input type="text" class="form-control" name="customername" readonly id="customername" value="<?php echo $vi['suppliername'];?>" >
                          <div id="cusname_valid"></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Invoice No</label>
                          <input type="text" class="form-control" name="invoiceno" readonly id="invoiceno" value="<?php echo $vi['invoiceno'];?>"  >
                          <div id="invoiceno_valid"></div>
                        </div>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Invoice Date</label>
                          <input type="text" class="form-control datepicker-autoclose" readonly name="invoicedate" id="invoicedate" value="<?php echo date('d-m-Y',strtotime($vi['invoicedate']));?>"  >
                        </div>
                      </div>
                    </div>
                    <div class="col-md-3">
                      <div class="form-group"> 
                        <label>Address</label>
                        <textarea type="text" class="form-control" name="address" readonly id="address" rows="4"><?php echo $vi['address'];?></textarea>
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
                          <th>Dis</th>
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
                      ?>
                        <tr>
                          <td><input class="" id="hsnno" readonly style="width:70px;border:1px solid #605f5f;" type="text" name="hsnno[]" value="<?php echo $hsnno[$i];?>">
                          <input class="form-control"  id="itemno" type="hidden" name="itemno[]" value="">
                            <div id="hsnno_valid"></div>
                          </td>
                          <td><input class="" id="itemname" readonly value="<?php echo $itemname[$i];?>" style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" value="" >
                            <div id="itemname_valid"></div>
                          </td>

                            <td><input class="" id="qty"   required type="text" name="qty[]" value="<?php echo $qty[$i];?>" readonly  onkeypress="return isNumberKey(event)" autocomplete="off" style="width:50px;border:1px solid #605f5f;">
                            <input type="hidden" name="qtys" id="qtys" value="">
                            <div id="qty_valid"></div>
                          </td>  

                          <td><input class="" value="<?php echo $uom[$i];?>" id="uom" readonly style="width:50px;border:1px solid #605f5f;" type="text" name="uom[]"   autocomplete="off">
                            <div id="rate_valid"></div>
                          </td>

                          <td><input class=" decimals" value="<?php echo $rate[$i];?>" id="rate" readonly style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]"   autocomplete="off">
                            <div id="rate_valid"></div>
                          </td>


                            <td><input class="decimals" id="amount" value="<?php echo $amount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="amount[]" value=""  autocomplete="off">
                            <input type="hidden" name="gstcal[]" id="gstcal" value="">

                            <div id="rate_valid"></div>
                          </td>

                           <td><input class="decimals" id="discount" value="<?php echo $discount[$i];?>" readonly  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" value="0"  autocomplete="off">
                            <div id="rate_valid"></div>
                          </td>

                           <td><input class="decimals" id="taxableamount" value="<?php echo $taxableamount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamount[]" value=""  autocomplete="off">
                           <input type="hidden" name="discountamount[]" id="discountamount">
                            <div id="rate_valid"></div>
                          </td>
  <?php if($vi['gsttype']=='intrastate') { ?>
                            <td class="sgst"><input class="decimals" value="<?php echo $cgst[$i];?>" readonly id="cgst" required type="text" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                 <div id="cgst_valid"></div>

                            </td>


                              <td class="sgst"><input class="decimals" value="<?php echo $cgstamount[$i];?>" id="cgstamount" required type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
                            </td>
                        
                       <td class="sgst"><input class="decimals" id="sgst" value="<?php echo $sgst[$i];?>" required type="text" name="sgst[]" value="" readonly style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                 <div id="sgst_valid"></div>
                            </td>


                              <td class="sgst"><input class="decimals" value="<?php echo $sgstamount[$i];?>" id="sgstamount" required type="text" name="sgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
                            </td>
<?php } else { ?>
                            

                            <td class="igst" ><input class="decimals" id="igst"  type="text" name="igst[]" readonly style="width:45px;border:1px solid #605f5f;" value="<?php echo $igst[$i];?>"  onkeypress="return isNumberKey(event)" autocomplete="off" >
                                 <div id="igst_valid"></div>

                            </td>
                              <td class="igst"><input class="decimals" id="igstamount" value="<?php echo $igstamount[$i];?>" type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
                            </td>
                            <?php } ?>
                             <td>
                            <input class="" id="total" type="text" value="<?php echo $total[$i];?>" name="total[]"  value=""  readonly style="width:110px;border:1px solid #605f5f;">
                            </td>                   
                      </tr>
                      <?php } ?>
                    </tbody>
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
                    <label class="col-sm-5  control-label" >Freight Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control" readonly type="text" name="freightcharges" value="<?php echo $vi['freightcharges'];?>" id="freightcharges"   placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br>               

                   <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Loading & Packing  Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control" readonly type="text" value="<?php echo $vi['packingcharges'];?>" name="packingcharges" id="packingcharges"   placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br> 

                   <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Other   Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control" readonly type="text" name="othercharges" id="othercharges"  value="<?php echo $vi['othercharges'];?>" placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br>  
                                       
                        <div class=" col-sm-offset-5">
                          <label class="col-sm-5  control-label" >Pruchase Total</label>
                          <div class="col-sm-7">
                            <input class="form-control"  type="text" value="<?php echo $vi['grandtotal'];?>" readonly name="grandtotal" id="grandtotal" >
                            <input class="form-control"  type="hidden" name="taxtotal" id="grandtotal1" value="">
                           
                          </div>                      
                        </div>
                     
                        <br>
                        <br>
                      </form> 
					   */ ?>
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
        <script src="<?php echo base_url();?>assets/plugins/switchery/switchery.min.js"></script>

        <script>
          $('.colorpicker-default').colorpicker({
            format: 'hex'
          });
          $('.colorpicker-rgba').colorpicker();

// Date Picker
jQuery('#datepicker').datepicker();
jQuery('#datepicker-autoclose').datepicker({
  autoclose: true,
  todayHighlight: true
});
</script>

  <script type="text/javascript">
    $(document).ready(function(){
      $('#submit').click(function(){
        var cusname=$('#customername').val();
        var pono=$('#pono').val();
        var itemno=$('#itemno').val();
        var itemname=$('#itemname').val();
        var dcno=$('#dcno').val();
        var qty=$('#qty').val();
        var taxname=$('#taxname').val();
        var qty=$('#qty').val();
        var paidamount=$('#paidamount').val();
        var invoicetype=$('#invoicetype').val();
        var transport=$('#transport').val();
        var deliveryto=$('#deliveryto').val();
        if(cusname=='')
        {
          $('#customername').focus();
          $('#cusname_valid').html('<div><font color="red">Enter The Name</font></div>');
          $('#customername').keyup(function(){
            $('#cusname_valid').html('');
          });
          return false
        }
        if(deliveryto=='')
        {
          $('#deliveryto').focus();
          $('#delivery_valid').html('<div><font color="red">Enter  The Delivery To</font></div>');
          $('#deliveryto').keyup(function(){
            $('#delivery_valid').html('');
          });
          return false
        }
        if(pono=='')
        {
          $('#pono').focus();
          $('#pono_valid').html('<div><font color="red">Select The Po Number</font></div>');
          $('#pono').change(function(){
            $('#pono_valid').html('');
          });
          return false
        }
        if(dcno=='')
        {
          $('#dcno').focus();
          $('#dcno_valid').html('<div><font color="red">select The Dc Number</font></div>');
          $('#dcno').change(function(){
            $('#dcno_valid').html('');
          });
          return false
        }

        if(itemno=='')
        {
          $('#itemno').focus();
          $('#itemno_valid').html('<div><font color="red">Enter The Item Number</font></div>');
          $('#itemno').keyup(function(){
            $('#itemno_valid').html('');
          });
          return false
        }
        if(itemname=='')
        {
          $('#itemname').focus();
          $('#itemname_valid').html('<div><font color="red">Enter The Item Name</font></div>');
          $('#itemname').change(function(){
            $('#itemname_valid').html('');
          });
          return false
        }
        if(qty=='')
        {
          $('#qty').focus();
          $('#qty_valid').html('<div><font color="red">Enter The Qty</font></div>');
          $('#qty').keyup(function(){
            $('#qty_valid').html('');
          });
          return false
        }


        if(transport=='')
        {
          $('#transport').focus();
          $('#transport_valid').html('<div><font color="red">Enter The Transport</font></div>');
          $('#transport').keyup(function(){
            $('#transport_valid').html('');
          });
          return false
        }
        var paymenttype=$('#paymenttype').val();
        if(paymenttype=='credit')
        {
          if(paidamount=='')
          {
            $('#paidamount').focus();
            $('#paid_valid').html('<div><font color="red">Enter The Amount</font></div>');
            $('#paidamount').keyup(function(){
              $('#paid_valid').html('');
            });
            return false
          }
        }
      });
  $('#print').click(function(){
    var cusname=$('#customername').val();
    var pono=$('#pono').val();
    var itemno=$('#itemno').val();
    var itemname=$('#itemname').val();
    var dcno=$('#dcno').val();
    var qty=$('#qty').val();
    var taxname=$('#taxname').val();
    var qty=$('#qty').val();
    var paidamount=$('#paidamount').val();
    var invoicetype=$('#invoicetype').val();
    var transport=$('#transport').val();
    var deliveryto=$('#deliveryto').val();

    if(cusname=='')
    {
      $('#customername').focus();
      $('#cusname_valid').html('<div><font color="red">Enter The Name</font></div>');
      $('#customername').keyup(function(){
        $('#cusname_valid').html('');
      });
      return false
    }

    if(deliveryto=='')
    {
      $('#deliveryto').focus();
      $('#delivery_valid').html('<div><font color="red">Enter  The Delivery To</font></div>');
      $('#deliveryto').keyup(function(){
        $('#delivery_valid').html('');
      });
      return false
    }
    if(pono=='')
    {
      $('#pono').focus();
      $('#pono_valid').html('<div><font color="red">Select The Po Number</font></div>');
      $('#pono').change(function(){
        $('#pono_valid').html('');
      });
      return false
    }
    if(dcno=='')
    {
      $('#dcno').focus();
      $('#dcno_valid').html('<div><font color="red">Select The Dc Number</font></div>');
      $('#dcno').change(function(){
        $('#dcno_valid').html('');
      });
      return false
    }

    if(invoicetype=='directsales')
    {

      if(itemno=='')
      {
        $('#itemno').focus();
        $('#itemno_valid').html('<div><font color="red">Enter The Item Number</font></div>');
        $('#itemno').keyup(function(){
          $('#itemno_valid').html('');
        });
        return false
      }
      if(itemname=='')
      {
        $('#itemname').focus();
        $('#itemname_valid').html('<div><font color="red">Enter The Item Name</font></div>');
        $('#itemname').change(function(){
          $('#itemname_valid').html('');
        });
        return false
      }
      if(qty=='')
      {
        $('#qty').focus();
        $('#qty_valid').html('<div><font color="red">Enter The Qty</font></div>');
        $('#qty').keyup(function(){
          $('#qty_valid').html('');
        });
        return false
      }


    }

    if(transport=='')
    {
      $('#transport').focus();
      $('#transport_valid').html('<div><font color="red">Enter The Transport</font></div>');
      $('#transport').keyup(function(){
        $('#transport_valid').html('');
      });
      return false
    }
    var paymenttype=$('#paymenttype').val();
    if(paymenttype=='credit')
    {

      if(paidamount=='')
      {
        $('#paidamount').focus();
        $('#paid_valid').html('<div><font color="red">Enter The Amount</font></div>');
        $('#paidamount').keyup(function(){
          $('#paid_valid').html('');
        });
        return false
      }
    }
  });

  $( "#customername" ).autocomplete({
    source: function(request, response) {
      $.ajax({ 
        url: "<?php echo base_url();?>invoice/autocomplete_name",
        data: { keyword: $("#customername").val()},
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
        url: "<?php echo base_url();?>invoice/autocomplete_itemno",
        data: { keyword: $("#itemno").val()},
        dataType: "json",
        type: "POST",
        success: function(data){              
          response(data);
        }    
      });
    },
  });



  $( "#itemname" ).autocomplete({
    source: function(request, response) {
      $.ajax({ 
        url: "<?php echo base_url();?>invoice/autocomplete_itemname",
        data: { keyword: $("#itemname").val()},
        dataType: "json",
        type: "POST",
        success: function(data){              
          response(data);
        }    
      });
    },
  });

  $('#customername').blur(function(){
    var cusname=$('#customername').val();

    $.post('<?php echo base_url();?>invoice/get_name',{cusname:cusname},function(res){
      var obj=jQuery.parseJSON(res);
      $('#address').val(obj.address);
    });

    $.post('<?php echo base_url();?>invoice/get_dcno',{cusname:cusname},function(re){
  // var obj=jQuery.parseJSON(re);
  $('#pono').html(re);

  });
  });

  $('#itemno').blur(function(){
    var itemno=$('#itemno').val();
    if(itemno!='')
    {
      $.post('<?php echo base_url();?>invoice/get_itemno',{itemno:itemno},function(res){
        var obj=jQuery.parseJSON(res);
        $('#itemname').val(obj.itemname);
        $('#rate').val(obj.price);
        $('#rate').focus();
      });
    }
  });
  $('#itemname').blur(function(){
    var itemname=$('#itemname').val();
    var mobileno=$('#mobileno').val();
  // var qty=$('#qty').val();
  if(itemname!='')
  {
    $.post('<?php echo base_url();?>invoice/get_itemname',{itemname:itemname},function(res){
      var obj=jQuery.parseJSON(res);
      $('#itemno').val(obj.itemno);
      $('#rate').val(obj.price);
  // $('#rate').focus();
  // alert(res);
  });
  }
  });
  $('#paymenttype').change(function(){
    var paymenttype=$('#paymenttype').val();
    if(paymenttype=='credit')
    {
      $('#paid').show();
    }
    else
    {
      $('#paid').hide();
    }
  });

  $('#pono').change(function(){
    var pono=$('#pono').val();

    if(pono)
    {
      $.post('<?php echo base_url();?>invoice/get_pono',{pono:pono},function(res){
        var obj=jQuery.parseJSON(res);
        $('#podate').val(obj.cuspodate);
      });
    }

    $.post('<?php echo base_url();?>invoice/get_poitem',{pono:pono},function(rest){
  // var obj=jQuery.parseJSON(res);
  $('#table').html(rest);
  });
  });


  $('.add').click(function(){
    var start=$('#hide').val();
    var total=Number(start)+1;
    $('#hide').val(total);
    var tbody=$('#append');
    $('<tr><td><input class="form-control" id="itemno'+total+'" type="text" name="itemno[]" value=""><div id="itemno_valid"></div></td><td><input class="form-control" id="itemname'+total+'" type="text" name="itemname[]" value="" ><div id="itemname_valid'+total+'"></div></td><td><input class="form-control decimal" type="text" name="rate[]" id="rate'+total+'" value=""></td><td><input class="form-control" id="qty'+total+'" type="text" name="qty[]" value="" onkeypress="return isNumberKey(event)"><div id="qty_valid'+total+'"></td><td><input class="form-control" id="total'+total+'" type="text" name="total[]" value="" readonly ></td><td><button type="button" class="btn btn-danger remove"> <i class="fa fa-remove"></i></button></td></tr><div id="table'+total+'"></div>').appendTo(tbody);
    $('.remove').click(function(){
      $(this).parents('tr').remove();
  var tax_id=$("#taxname").val(); // tax id 



  $.post("<?php echo base_url();?>taxtype/get_tax",{tax_id:tax_id},function(res){
    var obj = jQuery.parseJSON(res);
    var taxname = obj.taxname;




    var sub_tot=0;
    $('input[name^="total"]').each(function(){
      sub_tot +=Number($(this).val());
      var fina=sub_tot.toFixed(2); 
      $('#subtotal').val(fina);
      $('#grandtotal').val(fina); 
      $('#grandtotal1').val(fina); 
    });
    var discount=$('#discount').val();
  // var taxname=$('#taxname').val();
  var adjustment=$('#adjustment').val();


  var totaldiscount=$('#grandtotal1').val();
  var a=0;
  var b=0; 
  var c=0;
  var d=0;
  var e=0;
  var f=0;
  var g=0;
  var t=0;
  var s=0;
  var p=0;
  var q=totaldiscount;


  if(qty=='')
  {


    $('#total').val(0);
    $('#subtotal').val(0);
    $('#grandtotal').val(0);
    $('#grandtotal1').val(0);

  }



  if(discount)
  {
    a=((parseFloat(sub_tot)*parseFloat(discount))/100);
    var a1=a.toFixed(2);
    $('#disamount').val(a1);
    var a2=parseFloat(sub_tot)-parseFloat(a1);
    var a3=a2.toFixed(2);
    q=a3;
    $('#totaldiscount').val(a3);
    $('#grandtotal').val(a3);

    if(qty=='')
    {
      $('#disamount').val(0);
      $('#grandtotal').val(0); 


    }
  }



  if(taxname)
  {
    b=((parseFloat(q)*parseFloat(taxname))/100);
    var b1=b.toFixed(2);
    $('#taxamount').val(b1);
    var b2=parseFloat(q)+parseFloat(b);
    var b3=b2.toFixed(2);
    $('#grandtotal').val(b3);

    if(qty=='')
    {
      $('#taxamount').val(0);
      $('#grandtotal').val(0); 


    }
  }

  if(adjustment)
  {
    s=adjustment;
    var d2=parseFloat(q)+parseFloat(b)+parseFloat(adjustment);
    var d3=d2.toFixed(2);
    $('#grandtotal').val(d3);

    if(qty=='')
    {
      $('#adjustment').val(0);
      $('#grandtotal').val(0); 


    }
  }


  });
  });

  $('.decimal').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
      val = val.replace(/[^0-9\.-]/g,'');
      if(val.split('.').length>2)
        val =val.replace(/\.-+$/,"");
    }
    $(this).val(val);
  });

  $( "#itemno"+total+"" ).autocomplete({
    source: function(request, response) {
      $.ajax({ 
        url: "<?php echo base_url();?>invoice/autocomplete_itemno",
        data: { keyword: $("#itemno"+total+"").val()},
        dataType: "json",
        type: "POST",
        success: function(data){              
          response(data);
        }    
      });
    },
  });

  $( "#itemname"+total+"").autocomplete({
    source: function(request, response) {
      $.ajax({ 
        url: "<?php echo base_url();?>invoice/autocomplete_itemname",
        data: { keyword: $("#itemname"+total+"").val()},
        dataType: "json",
        type: "POST",
        success: function(data){              
          response(data);
        }    
      });
    },
  });
  $('#itemno'+total+'').blur(function(){
    var itemno=$('#itemno'+total+'').val();
    if(itemno!='')
    {
      $.post('<?php echo base_url();?>invoice/get_itemno',{itemno:itemno},function(res){
        var obj=jQuery.parseJSON(res);
        $('#itemname'+total+'').val(obj.itemname);
        $('#rate'+total+'').val(obj.price);
        $('#qty'+total+'').focus();
      });
    }
  });
  $('#submit').click(function(){
    var invoicetype=$('#invoicetype').val();
    var itemno=$('#itemno'+total+'').val();
    var itemname=$('#itemname'+total+'').val();
    var qty=$('#qty'+total+'').val();
    if(invoicetype)
    {
      if(itemno=='')
      {
        $('#itemno'+total+'').focus();
        $('#itemno_valid'+total+'').html('<div><font color="red">Enter The Item Number</font></div>');
        $('#itemno'+total+'').keyup(function(){
          $('#itemno_valid'+total+'').html('');
        });
        return false
      }
      if(itemname=='')
      {
        $('#itemname'+total+'').focus();
        $('#itemname_valid'+total+'').html('<div><font color="red">Enter The Item Name</font></div>');
        $('#itemname'+total+'').keyup(function(){
          $('#itemname_valid'+total+'').html('');
        });
        return false
      }
      if(qty=='')
      {
        $('#qty'+total+'').focus();
        $('#qty_valid'+total+'').html('<div><font color="red">Enter The Qty</font></div>');
        $('#qty'+total+'').keyup(function(){
          $('#qty_valid'+total+'').html('');
        });
        return false
      }
    }
  });
  $('#print').click(function(){
    var itemno=$('#itemno'+total+'').val();
    var itemname=$('#itemname'+total+'').val();
    var qty=$('#qty'+total+'').val();
    var invoicetype=$('#invoicetype').val();
    if(invoicetype)
    {
      if(itemno=='')
      {
        $('#itemno'+total+'').focus();
        $('#itemno_valid'+total+'').html('<div><font color="red">Enter The Item Number</font></div>');
        $('#itemno'+total+'').keyup(function(){
          $('#itemno_valid'+total+'').html('');
        });
        return false
      }
      if(itemname=='')
      {
        $('#itemname'+total+'').focus();
        $('#itemname_valid'+total+'').html('<div><font color="red">Enter The Item Name</font></div>');
        $('#itemname'+total+'').keyup(function(){
          $('#itemname_valid'+total+'').html('');
        });
        return false
      }
      if(qty=='')
      {
        $('#qty'+total+'').focus();
        $('#qty_valid'+total+'').html('<div><font color="red">Enter The Qty</font></div>');
        $('#qty'+total+'').keyup(function(){
          $('#qty_valid'+total+'').html('');
        });
        return false
      }
    }
  });
  $('#itemname'+total+'').blur(function(){
    var itemname=$('#itemname'+total+'').val();
    var mobileno=$('#mobileno').val();
  // var qty=$('#qty').val();
  if(itemname!='')
  {
    $.post('<?php echo base_url();?>invoice/get_itemname',{itemname:itemname},function(res){
      var obj=jQuery.parseJSON(res);
      $('#itemno'+total+'').val(obj.itemno);
      $('#rate'+total+'').val(obj.price);
  // $('#qty'+total+'').focus();
  // alert(res);
  });
  }
  });
  $('#qty'+total+'').keyup(function(){

    var rate=$('#rate'+total+'').val();
    var qty=$('#qty'+total+'').val();


  var tax_id=$("#taxname").val(); // tax id 



  $.post("<?php echo base_url();?>taxtype/get_tax",{tax_id:tax_id},function(res){
    var obj = jQuery.parseJSON(res);
    var taxname = obj.taxname;


    var amo=parseFloat(rate)*parseFloat(qty);
    var amou=amo.toFixed(2);
    $('#total'+total+'').val(amou);

    var sub_tot=0;
    $('input[name^="total"]').each(function(){
      sub_tot +=Number($(this).val());
      var fina=sub_tot.toFixed(2); 
      $('#subtotal').val(fina);
      $('#grandtotal').val(fina); 
      $('#grandtotal1').val(fina); 
    });
    var discount=$('#discount').val();
  // var taxname=$('#taxname').val();
  var adjustment=$('#adjustment').val();


  var totaldiscount=$('#grandtotal1').val();
  var a=0;
  var b=0; 
  var c=0;
  var d=0;
  var e=0;
  var f=0;
  var g=0;
  var t=0;
  var s=0;
  var p=0;
  var q=totaldiscount;


  if(qty=='')
  {


    $('#total'+toatl+'').val(0);
    $('#subtotal').val(0);
    $('#grandtotal').val(0);
    $('#grandtotal1').val(0);

  }



  if(discount)
  {
    a=((parseFloat(sub_tot)*parseFloat(discount))/100);
    var a1=a.toFixed(2);
    $('#disamount').val(a1);
    var a2=parseFloat(sub_tot)-parseFloat(a1);
    var a3=a2.toFixed(2);
    q=a3;
    $('#totaldiscount').val(a3);
    $('#grandtotal').val(a3);

    if(qty=='')
    {
      $('#disamount').val(0);
      $('#grandtotal').val(0); 


    }
  }



  if(taxname)
  {
    b=((parseFloat(q)*parseFloat(taxname))/100);
    var b1=b.toFixed(2);
    $('#taxamount').val(b1);
    var b2=parseFloat(q)+parseFloat(b);
    var b3=b2.toFixed(2);
    $('#grandtotal').val(b3);

    if(qty=='')
    {
      $('#taxamount').val(0);
      $('#grandtotal').val(0); 


    }
  }

  if(adjustment)
  {
    s=adjustment;
    var d2=parseFloat(q)+parseFloat(b)+parseFloat(adjustment);
    var d3=d2.toFixed(2);
    $('#grandtotal').val(d3);

    if(qty=='')
    {
      $('#adjustment').val(0);
      $('#grandtotal').val(0); 


    }
  }


  });
  });
  $("#qty"+total+"").blur(function(){
    var rate=$('#rate'+total+'').val();
    var qty=$('#qty'+total+'').val();
    if(rate > 0  && qty > 0 )
    {
      var a=parseFloat(rate)*parseFloat(qty);
      var b=a.toFixed(2);
      $('#total'+total+'').val(b);
      var sub_tot=0;
      $('input[name^="total"]').each(function(){
        sub_tot +=Number($(this).val()); 
        var fina=sub_tot.toFixed(2);
        $('#subtotal').val(fina);
        $('#grandtotal').val(fina);
        $('#grandtotal1').val(fina);
        $('#table1').hide();
        $('#table3').hide();
      });
    }
    else
    {
      $('#total'+total+'').val(0);
      var sub_tot=0;
      $('input[name^="total"]').each(function(){
        sub_tot +=Number($(this).val()); 
        var fina=sub_tot.toFixed(2);
        $('#subtotal').val(fina);
        $('#grandtotal').val(fina);
        $('#grandtotal1').val(fina);
        $('#table1').show();
        $('#table3').show();
      });
    }  
  });
  });
  });
  </script>

  <script type="text/javascript">

    $(document).ready(function(){
      $('#invoicetype').change(function(){
        var invoicetype=$('#invoicetype').val();
        if(invoicetype=='directsales')
        {
          $('#direct').show();
          $('#againstpo').hide();
        }
        else if(invoicetype=='againstpo')
        {
          $('#direct').hide();
          $('#againstpo').show();
        }
      });

      $('#taxname').change(function(){
        var vat=$('#taxname').val();
        if(vat!=='')
        {
          $('#cstname').val('');
          $('#cstamount').val('');
          $('#cstname').attr("disabled","true");
          $('#cstamount').attr("disabled","true");
        }
        else
        {
          $('#cstname').removeAttr("disabled","false");
          $('#cstamount').removeAttr("disabled","false");
        }
      });

      $('#cstname').change(function(){
        var cst=$('#cstname').val();
        if(cst!=='')
        {
          $('#taxname').val('');
          $('#taxamount').val('');
          $('#taxname').attr("disabled","true");
          $('#taxamount').attr("disabled","true");
        }
        else
        {
          $('#taxname').removeAttr("disabled","false");
          $('#taxamount').removeAttr("disabled","false");
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



  <script type="text/javascript">
    $(document).ready(function(){
      $('#qty').keyup(function(){

        var rate=$('#rate').val();
        var qty=$('#qty').val();


  var tax_id=$("#taxname").val(); // tax id 



  $.post("<?php echo base_url();?>taxtype/get_tax",{tax_id:tax_id},function(res){
    var obj = jQuery.parseJSON(res);
    var taxname = obj.taxname;


    var amo=parseFloat(rate)*parseFloat(qty);
    var amou=amo.toFixed(2);
    $('#total').val(amou);

    var sub_tot=0;
    $('input[name^="total"]').each(function(){
      sub_tot +=Number($(this).val());
      var fina=sub_tot.toFixed(2); 
      $('#subtotal').val(fina);
      $('#grandtotal').val(fina); 
      $('#grandtotal1').val(fina); 
    });
    var discount=$('#discount').val();
  // var taxname=$('#taxname').val();
  var adjustment=$('#adjustment').val();


  var totaldiscount=$('#grandtotal1').val();
  var a=0;
  var b=0; 
  var c=0;
  var d=0;
  var e=0;
  var f=0;
  var g=0;
  var t=0;
  var s=0;
  var p=0;
  var q=totaldiscount;


  if(qty=='')
  {


    $('#total').val(0);
    $('#subtotal').val(0);
    $('#grandtotal').val(0);
    $('#grandtotal1').val(0);

  }



  if(discount)
  {
    a=((parseFloat(sub_tot)*parseFloat(discount))/100);
    var a1=a.toFixed(2);
    $('#disamount').val(a1);
    var a2=parseFloat(sub_tot)-parseFloat(a1);
    var a3=a2.toFixed(2);
    q=a3;
    $('#totaldiscount').val(a3);
    $('#grandtotal').val(a3);

    if(qty=='')
    {
      $('#disamount').val(0);
      $('#grandtotal').val(0); 


    }
  }



  if(taxname)
  {
    b=((parseFloat(q)*parseFloat(taxname))/100);
    var b1=b.toFixed(2);
    $('#taxamount').val(b1);
    var b2=parseFloat(q)+parseFloat(b);
    var b3=b2.toFixed(2);
    $('#grandtotal').val(b3);

    if(qty=='')
    {
      $('#taxamount').val(0);
      $('#grandtotal').val(0); 


    }
  }

  if(adjustment)
  {
    s=adjustment;
    var d2=parseFloat(q)+parseFloat(b)+parseFloat(adjustment);
    var d3=d2.toFixed(2);
    $('#grandtotal').val(d3);

    if(qty=='')
    {
      $('#adjustment').val(0);
      $('#grandtotal').val(0); 


    }
  }


  });
  });



  $('#discount').keyup(function(){

  // var rate=$('#rate').val();
  // var qty=$('#qty').val();


  var tax_id=$("#taxname").val(); // tax id 



  $.post("<?php echo base_url();?>taxtype/get_tax",{tax_id:tax_id},function(res){
    var obj = jQuery.parseJSON(res);
    var taxname = obj.taxname;


  // var amo=parseFloat(rate)*parseFloat(qty);
  // var amou=amo.toFixed(2);
  // $('#total').val(amou);

  var sub_tot=0;
  $('input[name^="total"]').each(function(){
    sub_tot +=Number($(this).val());
    var fina=sub_tot.toFixed(2); 
    $('#subtotal').val(fina);
    $('#grandtotal').val(fina); 
    $('#grandtotal1').val(fina); 
  });
  var discount=$('#discount').val();
  // var taxname=$('#taxname').val();
  var adjustment=$('#adjustment').val();


  var totaldiscount=$('#grandtotal1').val();
  var a=0;
  var b=0; 
  var c=0;
  var d=0;
  var e=0;
  var f=0;
  var g=0;
  var t=0;
  var s=0;
  var p=0;
  var q=totaldiscount;


  if(discount=='')
  {


    $('#disamount').val(0);


  }



  if(discount)
  {
    a=((parseFloat(sub_tot)*parseFloat(discount))/100);
    var a1=a.toFixed(2);
    $('#disamount').val(a1);
    var a2=parseFloat(sub_tot)-parseFloat(a1);
    var a3=a2.toFixed(2);
    q=a3;
    $('#totaldiscount').val(a3);
    $('#grandtotal').val(a3);

    if(qty=='')
    {
      $('#disamount').val(0);
      $('#grandtotal').val(0); 


    }
  }



  if(taxname)
  {
    b=((parseFloat(q)*parseFloat(taxname))/100);
    var b1=b.toFixed(2);
    $('#taxamount').val(b1);
    var b2=parseFloat(q)+parseFloat(b);
    var b3=b2.toFixed(2);
    $('#grandtotal').val(b3);

    if(qty=='')
    {
      $('#taxamount').val(0);
      $('#grandtotal').val(0); 


    }
  }

  if(adjustment)
  {
    s=adjustment;
    var d2=parseFloat(q)+parseFloat(b)+parseFloat(adjustment);
    var d3=d2.toFixed(2);
    $('#grandtotal').val(d3);

    if(qty=='')
    {
      $('#adjustment').val(0);
      $('#grandtotal').val(0); 


    }
  }


  });
  });



  $('#taxname').change(function(){

    var rate=$('#rate').val();
    var qty=$('#qty').val();


  var tax_id=$("#taxname").val(); // tax id 



  $.post("<?php echo base_url();?>taxtype/get_tax",{tax_id:tax_id},function(res){
    var obj = jQuery.parseJSON(res);
    var taxname = obj.taxname;


  // var amo=parseFloat(rate)*parseFloat(qty);
  // var amou=amo.toFixed(2);
  // $('#total').val(amou);
  var sub_tot=0;
  $('input[name^="total"]').each(function(){
    sub_tot +=Number($(this).val());
    var fina=sub_tot.toFixed(2); 
    $('#subtotal').val(fina);
    $('#grandtotal').val(fina); 
    $('#bedadjs').val(fina); 
  });
  var discount=$('#discount').val();
  // var bed=$('#bed').val();
  // var taxname=$('#taxname').val();
  var adjustment=$('#adjustment').val();


  var totaldiscount=$('#grandtotal1').val();
  var a=0;
  var b=0; 
  var c=0;
  var d=0;
  var e=0;
  var f=0;
  var g=0;
  var t=0;
  var s=0;
  var p=0;
  var q=totaldiscount;


  if(taxname=='')
  {



    $('#taxamount').val(0);
  }


  if(discount)
  {
    a=((parseFloat(sub_tot)*parseFloat(discount))/100);
    var a1=a.toFixed(2);
    $('#disamount').val(a1);
    var a2=parseFloat(sub_tot)-parseFloat(a1);
    var a3=a2.toFixed(2);
    q=a3;
    $('#totaldiscount').val(a3);
    $('#grandtotal').val(a3);

  }



  if(taxname)
  {
    b=((parseFloat(q)*parseFloat(taxname))/100);
    var b1=b.toFixed(2);
    $('#taxamount').val(b1);
    var b2=parseFloat(q)+parseFloat(b);
    var b3=b2.toFixed(2);
    $('#grandtotal').val(b3);

  }

  else
  {

    $('#taxamount').val(0);
  }

  if(adjustment)
  {
    s=adjustment;
    var d2=parseFloat(q)+parseFloat(b)+parseFloat(adjustment);
    var d3=d2.toFixed(2);
    $('#grandtotal').val(d3);


  }


  });
  });

  $('#adjustment').keyup(function(){

    var rate=$('#rate').val();
    var qty=$('#qty').val();


  var tax_id=$("#taxname").val(); // tax id 



  $.post("<?php echo base_url();?>taxtype/get_tax",{tax_id:tax_id},function(res){
    var obj = jQuery.parseJSON(res);
    var taxname = obj.taxname;


  // var amo=parseFloat(rate)*parseFloat(qty);
  // var amou=amo.toFixed(2);
  // $('#total').val(amou);
  var sub_tot=0;
  $('input[name^="total"]').each(function(){
    sub_tot +=Number($(this).val());
    var fina=sub_tot.toFixed(2); 
    $('#subtotal').val(fina);
    $('#grandtotal').val(fina); 
    $('#bedadjs').val(fina); 
  });
  var discount=$('#discount').val();
  var bed=$('#bed').val();
  // var taxname=$('#taxname').val();
  var adjustment=$('#adjustment').val();


  var totaldiscount=$('#grandtotal').val();
  var a=0;
  var b=0; 
  var c=0;
  var d=0;
  var e=0;
  var f=0;
  var g=0;
  var t=0;
  var s=0;
  var p=0;
  var q=totaldiscount;


  if(taxname=='')
  {



    $('#taxamount').val(0);
  }



  if(discount)
  {
    a=((parseFloat(sub_tot)*parseFloat(discount))/100);
    var a1=a.toFixed(2);
    $('#disamount').val(a1);
    var a2=parseFloat(sub_tot)-parseFloat(a1);
    var a3=a2.toFixed(2);
    q=a3;
    $('#totaldiscount').val(a3);
    $('#grandtotal').val(a3);

  }



  if(taxname)
  {
    b=((parseFloat(q)*parseFloat(taxname))/100);
    var b1=b.toFixed(2);
    $('#taxamount').val(b1);
    var b2=parseFloat(q)+parseFloat(b);
    var b3=b2.toFixed(2);
    $('#grandtotal').val(b3);

  }

  else
  {

    $('#taxamount').val(0);
  }

  if(adjustment)
  {
    s=adjustment;
    var d2=parseFloat(q)+parseFloat(b)+parseFloat(adjustment);
    var d3=d2.toFixed(2);
    $('#grandtotal').val(d3);


  }


  });
  });


  });
  </script>

  <script type="text/javascript">

    $( "#voucher" ).autocomplete({
      source: function(request, response) {
        $.ajax({ 
          url: "<?php echo base_url();?>invoice/autocomplete_voucher",
          data: { keyword: $("#voucher").val()},
          dataType: "json",
          type: "POST",
          success: function(data){ 
            response(data);
          }            
        });
      }, select: function (event, ui) {
        $("#voucher").val(ui.item.label); 

        $('#voucheramount').val(ui.item.advanceamount); 
        $('#paidamount').val(ui.item.advanceamount); 


      }
    });
  </script>