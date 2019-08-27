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
		td,th { font-size: 12px; color:black; }
		textarea.form-control { min-height: 40px !important; }
		.myform {}
		.myform input[type="text"]{ width:100%; border: 1px solid #c1c1c1; border-radius: 4px; padding:8px; color: #435966;}
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
	   <?php foreach($result as $vi)  ?> 
      <div class="row">
        <div class="col-sm-12">
          <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
            <header class="panel-heading" style="color:rgb(255, 255, 255)">
              <i class="zmdi zmdi-shopping-cart">&nbsp;Edit Quotation - <?php echo $vi['quotationno'];?></i>
            </header>
            <div class="card-box">
              <div class="row">
                
            <div class="card-box">
              <div class="row">
                 <form class="form-horizontal"  method="post" action="<?php echo base_url();?>quotation/update" >
             <div class="form-group ">
                      <div class="col-md-8 forms">
<?php /*
                           <div class="col-md-4">
                        <div class="form-group">
                          <label>Quotation No</label>
                          <input type="text" class="form-control" name="quotationno" id="invoiceno" value="<?php echo $vi['quotationno'];?>"  readonly>
                        </div>
                      </div>
*/?>
					 <input type="hidden" name="quotationno" id="invoiceno" value="<?php echo $vi['quotationno'];?>" >
                      <input type="hidden" name="id" value="<?php echo $vi['id'];?>">
                        
                        <div class="col-md-3">
                          <div class="form-group">
                            <label >Date</label>
                            <input type="text" class="form-control" name="quotationdate" parsley-trigger="change" id="datepicker-autoclose" readonly value="<?php echo date('d-m-Y',strtotime($vi['quotationdate']));?>" style="width:148px;">
                          </div>
                        </div>
                     
                        <div class="col-md-5">
                          <div class="form-group">
                            <label>Customer Name</label>
                            <input type="text" class="form-control" parsley-trigger="change" required name="customername" id="customername" value="<?php echo $vi['customername'];?>" readonly>
                               <input type="hidden" class="form-control"  name="supplierid" id="supplierid" value="">
							   <input type="hidden" name="customerId" id="customerId" value="<?php echo $vi['customerId'];?>" />
								<input type="hidden" name="oldAddress" id="oldAddress" />
                            <div id="cusname_valid" style="position: absolute;">
                            </div>
                          </div>
                        </div>
	
						<div class="col-md-3">
							<div class="form-group">
								<label>GST Type</label>
								<input type="text" class="form-control" value="<?php echo $vi['gsttype'];?>" readonly />
								
							</div>
						</div>
                           <!--<div class="col-md-4">
                        <div class="form-group">
                          <label>GSTIN</label>
                          <input type="text" class="form-control" name="gstinno" readonly id="" value="<?php echo $vi['gstinno'];?>" >
                        </div>
                      </div>-->
					<input type="hidden" name="gstinno" value="<?php echo $vi['gstinno'];?>" />
                  

                     
                     
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Address</label>
                          <textarea type="text" class="form-control" name="address" id="address"  rows="4" readonly><?php echo $vi['address'];?></textarea>
                        </div>
                      </div>
                    </div>
					<?php 
					if($vi['gsttype']=='intrastate') { $igstStyle='style="display:none"';   $cgstStyle='';} 
					if($vi['gsttype']=='interstate') { $igstStyle='';   $cgstStyle='style="display:none"';} 
					?>
                  <table class="table myform">
                      <thead> 
                        <tr>
							<th -style="width:70px">HSN Code</th>
							<th >Item Name</th>
							<th -style="width:50px">Qty</th>
							<th -style="width:50px">UOM</th>
							<th -style="width:70px">Rate</th>
							<th -style="width:100px">Amount</th>
							<!--<th -style="width:40px">Disc %</th>
							<th -style="width:100px">&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>-->
							<th class="sgst" <?php echo $cgstStyle;?>>&nbsp;&nbsp;&nbsp;CGST</th>
							<th class="sgst" <?php echo $cgstStyle;?>>&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
							<th class="sgst" <?php echo $cgstStyle;?>>&nbsp;&nbsp;&nbsp;SGST</th>
							<th class="sgst" <?php echo $cgstStyle;?>>&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
							<th <?php echo $igstStyle;?> class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
							<th <?php echo $igstStyle;?>  class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
							<th -style="width:110px">Total</th>
							<th style="width:10px">&nbsp;</th>
                        </tr>  
                      </thead>
                      <tbody>
                      <?php 
					   
                      $hsnno=explode('||',$vi['hsnno']);
                      $itemname=explode('||',$vi['itemname']);
                      $description=explode('||',$vi['description']);
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
                          <td><input class="" id="hsnno<?php echo $i;?>" readonly  type="text" name="hsnno[]" value="<?php echo $hsnno[$i];?>">
                          <input type="hidden" name="priceType[]" id="priceType<?php echo $i;?>" value="<?php echo $item_result->priceType;?>" />
                            <div id="hsnno_valid<?php echo $i;?>"></div>
                          </td>
                          <td><input class="itemname_class" data-id="<?php echo $i;?>" id="itemname<?php echo $i;?>" value="<?php echo $itemname[$i];?>"  type="text" name="itemname[]" value="" readonly>
                            <div id="itemname_valid<?php echo $i;?>"></div>
                          </td>

                           <td><input class="qty_class" id="qty<?php echo $i;?>"  data-id="<?php echo $i;?>"  required type="text" name="qty[]" value="<?php echo $qty[$i];?>"   autocomplete="off" style="width:100px;" readonly>
                            <input type="hidden" name="qtys" id="qtys" value="">
                            <div id="qty_valid<?php echo $i;?>"></div>
                          </td>  

                          <td><input class="" value="<?php echo $uom[$i];?>" id="uom<?php echo $i;?>" readonly style="width:80px;" type="text" name="uom[]"   autocomplete="off">
                          </td>

                          <td><input class="rate_class decimals" data-id="<?php echo $i;?>"  value="<?php echo $rate[$i];?>" id="rate<?php echo $i;?>" required type="text" name="rate[]"   autocomplete="off" readonly>
                            <div id="rate_valid<?php echo $i;?>"></div>
                          </td>
							
							<!-- START -->
							<td><input class="decimals" id="amount<?php echo $i;?>" value="<?php echo $amount[$i];?>" readonly  type="text" name="amount[]" value=""  autocomplete="off"><div id="amount_valid<?php echo $i;?>"></div></td>
														
							<td class="sgst" <?php echo $cgstStyle;?>><input class="decimals cgst_class" data-id="<?php echo $i;?>" value="<?php echo $cgst[$i];?>"  id="cgst<?php echo $i;?>"  type="TEXT" name="cgst[]" onkeypress="return isNumberKey(event)" autocomplete="off" required readonly><div id="cgst_valid<?php echo $i;?>"></div></td>

							<td class="sgst" <?php echo $cgstStyle;?>><input class="decimals" value="<?php echo $cgstamount[$i];?>" id="cgstamount<?php echo $i;?>" required type="text" name="cgstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly ></td>

							<td class="sgst" <?php echo $cgstStyle;?>> <input class="decimals sgst_class" data-id="<?php echo $i;?>"  id="sgst<?php echo $i;?>" value="<?php echo $sgst[$i];?>"  type="text" name="sgst[]" onkeypress="return isNumberKey(event)" autocomplete="off" required readonly ></td>

							<td class="sgst" <?php echo $cgstStyle;?> ><input class="decimals" value="<?php echo $sgstamount[$i];?>" id="sgstamount<?php echo $i;?>" required type="text" name="sgstamount[]" onkeypress="return isNumberKey(event)" autocomplete="off" readonly ></td>

							<td class="igst"  <?php echo $igstStyle;?>><input class="decimals igst_class" data-id="<?php echo $i;?>" id="igst<?php echo $i;?>"  type="text" name="igst[]"  value="<?php echo $igst[$i];?>"  onkeypress="return isNumberKey(event)" autocomplete="off" readonly><div id="igst_valid<?php echo $i;?>"></div></td>

							<td class="igst"  <?php echo $igstStyle;?>><input class="decimals" id="igstamount<?php echo $i;?>" value="<?php echo $igstamount[$i];?>" type="text" name="igstamount[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly ></td>

							<td>
								<input class="" id="total<?php echo $i;?>" type="text" value="<?php echo $total[$i];?>" name="total[]" readonly >
								<input class="decimals" id="discount<?php echo $i;?>" value="<?php echo $discount[$i];?>"  type="hidden" name="discount[]" autocomplete="off">
								<input class="decimals" id="taxableamount<?php echo $i;?>" value="<?php echo $taxableamount[$i];?>" readonly type="hidden" name="taxableamount[]" autocomplete="off">
								<input type="hidden" name="discountamount[]" id="discountamount<?php echo $i;?>">
							</td>
							
							<!-- END -->
                             <?php
                            if($i==0)
                            {
								echo '<td style="width:10px;">&nbsp;</td>';
                            } 
                            else
                            {
                              echo'<td style="width:10px;">&nbsp;</td>';
                            }
                            ?>                   
                      </tr>

                      <?php } ?>
                    </tbody>
                     <tbody id="append"></tbody> 
		
                  </table> 
                 <br>
                       
                     <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Sub Total</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" value="<?php echo $vi['subtotal'];?>" name="subtotal" id="subtotal" readonly  placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br>    

        <?php /*         <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Freight Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" name="freightcharges" value="<?php echo $vi['freightcharges'];?>" id="freightcharges"   placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br>               

                   <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Loading & Packing  Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" value="<?php echo $vi['packingcharges'];?>" name="packingcharges" id="packingcharges"   placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br>  */ ?>

                   <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Other   Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" name="othercharges" id="othercharges"  value="<?php echo $vi['othercharges'];?>" placeholder="0" readonly>
                    </div>
                  </div>
                  <br>
                  <br>  
                                       
                        <div class=" col-sm-offset-5">
                          <label class="col-sm-5  control-label" > Total</label>
                          <div class="col-sm-7">
                            <input class="form-control"  type="text" value="<?php echo $vi['grandtotal'];?>" readonly name="grandtotal" id="grandtotal" >
                            <input class="form-control"  type="hidden" name="taxtotal" id="grandtotal1" value="">
                           
                          </div>                      
                        </div>
                        <div class="col-sm-offset-4">
                          
                          <a href="<?php echo base_url().'quotation/view';?>"><button type="button" class="btn btn-info" id="submit" ><i class="fa fa-chevron-left"></i> Back to Quotation Reports</button></a>
                         
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
		