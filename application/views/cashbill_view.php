<?php $discountBy=$this->db->select('discountBy')->where('id', '1')->get('preference_settings')->row()->discountBy;
$data=$this->db->get('profile')->result();
     foreach($data as $r)
      ?>
    <title> <?php echo $r->companyname;?></title>
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

      .radio-label {
   display: inline-block;
    vertical-align: top;
    margin-right: 3%;
}
.radio-input {
   display: inline-block;
    vertical-align: top;
}
td,th
{
  font-size: 12px;
  color:black;
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

          <?php foreach($result as $r) ?>
          <div class="row">
            <div class="col-sm-12">
              <section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
                <header class="panel-heading" style="color:rgb(255, 255, 255)">
                  <i class="zmdi zmdi-view-headline">&nbsp;Cash Bill </i> - <?php echo $r['invoiceno'];?>
                </header>
                <div class="card-box">
                  <div class="row">
                    <form class="form-horizontal" >
                      <div class="form-group forms">
                        <div class="col-md-8">
                      
                         
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Date</label>
                              <input type="text" class="form-control  datepicker-autoclose" name="invoicedate" id="datepicker-autoclose" disabled value="<?php echo date('d-m-Y',strtotime($r['invoicedate']));?>" >
                            </div>
                          </div>
                     
                          <div class="col-md-4">
                            <div class="form-group">
                              <label>Customer Name&nbsp;<span style="color:red;">*</span></label>
                              <input type="text" class="form-control" name="customername" value="<?php echo $r['customername'];?>"disabled id="customername" value="" >
                                <input type="hidden" class="form-control" name="customerid"  id="customerid" value="" >
                              <div id="cusname_valid" style="position:absolute;"></div>
                            </div>
                          </div>
                         <!--  <div class="col-md-4">
                            <div class="form-group">
                              <label>GSTIN </label>
                              <input type="text" class="form-control" value="<?php echo $r['tinno'];?>" name="tinno" id="tinno" value="" >
                            </div>
                          </div> -->
                      

                          <div class="col-md-4">
                            <div class="form-group"> 
                              <label>Mobile No</label>
                              <input type="text" class="form-control" disabled name="cust_mobno"  value="<?php echo $r['cust_mobno'];?>">
                            </div>

                          </div>
					
                         



                         <div class="col-md-4">
                          <div class="form-group">
                            <label>GST Type</label>
							<input type="text" name="gsttype" id="gsttype" value="<?php echo $r['gsttype'];?>" />
                            <?php /*<select  class="form-control" name="gsttype" id="gsttype" disabled>
                            <option value="intrastate" <?php if($r['gsttype']=='intrastate')echo 'selected';?>>Intrastate</option>
                            <option value="interstate" <?php if($r['gsttype']=='interstate')echo 'selected';?>>Interstate</option>
                            </select>*/ ?>
                          </div>
                        </div>

                  

                         
                      </div>
                      <div class="col-md-3">
                        <div class="form-group"> 
                          <label>Address</label>
                          <textarea type="text" disabled class="form-control" name="address" id="address" rows="4"><?php echo $r['address'];?></textarea>
                        </div>
                      </div>
                    </div>
                    <div class="table-responsive">
                    <table class="table">
                      <thead> 
                        <tr>
                          <th>HSN Code</th>
                          <th>Item Name</th>
                          <th>Qty</th>
                          <th>UOM</th>
                          <th>Rate</th>
                          <th>Amount</th>
                          <th>Disc <?php if($r['discountBy']=='percent_wise') { echo '%'; } ?></th>
                          <th>&nbsp;&nbsp;&nbsp;Taxable <br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Amount</th>
<?php if($r['gsttype']=='intrastate') { ?>
                            <th class="sgst">&nbsp;&nbsp;&nbsp;CGST</th>
                        <th class="sgst">&nbsp;&nbsp;&nbsp;CGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
                         <th class="sgst">&nbsp;&nbsp;&nbsp;SGST</th>
                        <th class="sgst">&nbsp;&nbsp;&nbsp;SGST <br>&nbsp;&nbsp;&nbsp;Amount</th>
<?php }else {  ?>
                       
                         
                         <th  class="igst">&nbsp;&nbsp;&nbsp;IGST</th>
                        <th  class="igst">&nbsp;&nbsp;&nbsp;IGST <br> &nbsp;&nbsp;&nbsp;Amount</th>
                        <?php } ?>
                        <th>Total</th>

                     

                        </tr>  
                      </thead>
                      <tbody>
                      <?php 
                      $hsnno=explode('||',$r['hsnno']);
                      $itemname=explode('||',$r['itemname']);
                      $qty=explode('||',$r['qty']);
                      $uom=explode('||',$r['uom']);
                      $rate=explode('||',$r['rate']);
                      $totalamount=explode('||',$r['amount']);
                      $discount=explode('||',$r['discount']);
                      $disamount=explode('||',$r['discountamount']);
                      $taxableamt=explode('||',$r['taxableamount']);
                      $cgst=explode('||',$r['cgst']);
                      $cgstamt=explode('||',$r['cgstamount']);
                      $sgst=explode('||',$r['sgst']);
                      $igst=explode('||',$r['igst']);
                      $sgstamt=explode('||',$r['sgstamount']);
                      $igstamt=explode('||',$r['igstamount']);
                      $overalltotal=explode('||',$r['total']);

                      for($i=0;$i<count($itemname);$i++) { 
                      ?>
                        <tr>
                          <td><input class="" id="hsnno" readonly style="width:70px;border:1px solid #605f5f;" type="text" disabled name="hsnno[]" value="<?php echo $hsnno[$i];?>">
                          <input class="form-control"  id="itemno" type="hidden" name="itemno[]" value="">
                            <div id="hsnno_valid"></div>
                          </td>
                          <td><input class="" id="itemname" disabled value="<?php echo $itemname[$i];?>" style="width:150px;border:1px solid #605f5f;" type="text" name="itemname[]" value="" >
                            <div id="itemname_valid"></div>
                          </td>

                            <td><input class="" id="qty"  disabled required type="text" name="qty[]" value="<?php echo $qty[$i];?>"  onkeypress="return isNumberKey(event)" autocomplete="off" style="width:50px;border:1px solid #605f5f;">
                            <input type="hidden" name="qtys" id="qtys" value="">
                            <div id="qty_valid"></div>
                          </td>  

                          <td><input class="" value="<?php echo $uom[$i];?>" id="uom" readonly style="width:50px;border:1px solid #605f5f;" disabled type="text" name="uom[]"   autocomplete="off">
                            <div id="rate_valid"></div>
                          </td>

                          <td><input class=" decimals" disabled value="<?php echo $rate[$i];?>" id="rate" readonly style="width:70px;border:1px solid #605f5f;" type="text" name="rate[]"   autocomplete="off">
                            <div id="rate_valid"></div>
                          </td>

 
                            <td><input class="decimals" disabled id="totalamount" value="<?php echo $totalamount[$i];?>" readonly style="width:100px;border:1px solid #605f5f;" type="text" name="totalamount[]" value=""  autocomplete="off">
                            <input type="hidden" name="gstcal[]" id="gstcal" value="">

                            <div id="rate_valid"></div>
                          </td>

                           <td><input class="decimals" disabled id="discount" value="<?php echo $discount[$i];?>"  style="width:40px;border:1px solid #605f5f;" type="text" name="discount[]" value="0"  autocomplete="off">
                            <div id="rate_valid"></div>
                          </td>

                           <td><input class="decimals" disabled id="taxableamt"  readonly style="width:100px;border:1px solid #605f5f;" type="text" name="taxableamt[]" value="<?php echo $taxableamt[$i];?>"  autocomplete="off">
                           <input type="hidden" name="disamount[]" value="<?php echo $disamount[$i];?>" id="disamount">
                            <div id="rate_valid"></div>
                          </td>
  <?php if($r['gsttype']=='intrastate') { ?>
                            <td class="sgst"><input class="decimals" disabled value="<?php echo $cgst[$i];?>" readonly id="cgst" required type="text" name="cgst[]" value="" style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                 <div id="cgst_valid"></div>

                            </td>


                              <td class="sgst"><input class="decimals" value="<?php echo $cgstamt[$i];?>" id="cgstamt" disabled required type="text" name="cgstamt[]"   onkeypress="return isNumberKey(event)" autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
                            </td>
                        
                       <td class="sgst"><input class="decimals" id="sgst" value="<?php echo $sgst[$i];?>" required type="text" name="sgst[]" disabled value="" readonly style="width:45px;border:1px solid #605f5f;"  onkeypress="return isNumberKey(event)" autocomplete="off" required>
                                 <div id="sgst_valid"></div>
                            </td>


                              <td class="sgst"><input class="decimals" value="<?php echo $sgstamt[$i];?>" id="sgstamt" required type="text" name="sgstamt[]"   onkeypress="return isNumberKey(event)" disabled autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
                            </td>
<?php } else { ?>
                            

                            <td class="igst" ><input class="decimals" id="igst"  type="text" name="igst[]" readonly style="width:45px;border:1px solid #605f5f;" value="<?php echo $igst[$i];?>" disabled onkeypress="return isNumberKey(event)" autocomplete="off" >
                                 <div id="igst_valid"></div>

                            </td>
                              <td class="igst"><input class="decimals" id="igstamt" value="<?php echo $igstamt[$i];?>" type="text" name="igstamt[]"   onkeypress="return isNumberKey(event)" disabled autocomplete="off" readonly style="width:80px;border:1px solid #605f5f;" value="">
                            </td>
                            <?php } ?>
                             <td>
                            <input class="" id="overalltotal" type="text" value="<?php echo $overalltotal[$i];?>" name="overalltotal[]" disabled  value=""  readonly style="width:110px;border:1px solid #605f5f;">
                            </td>                   
                      </tr>
                      <?php } ?>
                    </tbody>
                  </table> 
                  </div>

                   <br>
                  <table class="table">
                   

                      <tr>
                        
                          
                          <td>Freight Charges</td>

                            
                            <td><input class="decimals" id="freightamount" parsley-trigger="change"  placeholder="Amount" style="border:1px solid #605f5f;" type="text" name="freightamount" value="<?php echo $r['freightamount'];?>" disabled  autocomplete="off">
                           
                          </td>

                         

                           <?php if($r['gsttype']=='intrastate') { ?>

                            <td ><input class="decimals"  id="freightcgst"  type="text" name="freightcgst" placeholder="CGST"  value="<?php echo $r['freightcgst'];?>" style="border:1px solid #605f5f;" disabled  autocomplete="off" ></td>


                              <td ><input class="decimals" readonly id="freightcgstamount" placeholder="CGST Amount"  type="text" name="freightcgstamount"   autocomplete="off" disabled style="border:1px solid #605f5f;" value="<?php echo $r['freightcgstamount'];?>">
                            </td>
                        
                       <td ><input class="decimals" id="freightsgst" placeholder="SGST"  type="text" name="freightsgst" disabled value="<?php echo $r['freightsgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" >
                                 <div id="sgst_valid"></div>
                            </td>


                              <td ><input class="decimals" id="freightsgstamount"  type="text" name="freightsgstamount" placeholder="SGST Amount" disabled  autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $r['freightsgstamount'];?>">
                            </td>

                           <?php 
                           } 
                           else 
                           {
                           ?> 

                            <td ><input class="decimals" id="freightigst"  type="text" name="freightigst"  placeholder="IGST" value="<?php echo $r['freightigst'];?>" style="border:1px solid #605f5f;" disabled  autocomplete="off" >
                                 <div id="igst_valid"></div>

                            </td>


                              <td ><input class="decimals" id="freightigstamount"  type="text" name="freightigstamount"  placeholder="IGST Amount" disabled autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $r['freightigstamount'];?>">
                            </td>

                            <?php } ?>

                             <td>
                            <input class="" id="freighttotal" placeholder="Total" type="text" name="freighttotal" value="<?php echo $r['freighttotal'];?>"  disabled style="border:1px solid #605f5f;">
                            </td>

                      
                      </tr>

                       <tr>
                        
                          
                          <td>Loading & Packing Charges</div>
                          </td>

                            
                            <td><input class="decimals" id="loadingamount" parsley-trigger="change" placeholder="Amount" disabled style="border:1px solid #605f5f;" type="text" name="loadingamount" value="<?php echo $r['loadingamount'];?>"  autocomplete="off">
                            <div id="rate_valid"></div>
                          </td>

                         
                           <?php if($r['gsttype']=='intrastate') { ?>
                          

                            <td ><input class="decimals"  id="loadingcgst"  type="text" name="loadingcgst" placeholder="CGST" disabled value="<?php echo $r['loadingcgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" >
                                 <div id="cgst_valid"></div>

                            </td>


                              <td ><input class="decimals" disabled id="loadingcgstamount"  type="text" name="loadingcgstamount"   placeholder="CGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $r['loadingcgstamount'];?>">
                            </td>
                        
                       <td ><input class="decimals" id="loadingsgst" placeholder="SGST"  type="text" name="loadingsgst" disabled value="<?php echo $r['loadingsgst'];?>" style="border:1px solid #605f5f;"   autocomplete="off" >
                                 <div id="sgst_valid"></div>
                            </td>


                              <td ><input class="decimals" id="loadingsgstamount"  type="text" name="loadingsgstamount" disabled  placeholder="SGST Amount" autocomplete="off" readonly style="border:1px solid #605f5f;" value="<?php echo $r['loadingsgstamount'];?>">
                            </td>

                             <?php 
                           } 
                           else 
                           {
                           ?> 

                            <td ><input class="decimals" id="loadingigst"  type="text" name="loadingigst" placeholder="IGST" disabled value="<?php echo $r['loadingigst'];?>"  style="border:1px solid #605f5f;"   autocomplete="off" >
                                 <div id="igst_valid"></div>

                            </td>


                              <td ><input class="decimals" id="loadingigstamount" placeholder="IGST Amount" type="text" name="loadingigstamount"    autocomplete="off" disabled style="border:1px solid #605f5f;" value="<?php echo $r['loadingigstamount'];?>">
                            </td>

                            <?php } ?>

                             <td>
                            <input class="" id="loadingtotal" type="text" placeholder="Total" name="loadingtotal" value="<?php echo $r['loadingtotal'];?>"  disabled style="border:1px solid #605f5f;">
                            </td>

                      
                      </tr>
                    
                  </table>
                 
       

                  <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Sub Total</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" value="<?php echo $r['subtotal'];?>" name="subtotal" id="subtotal" readonly disabled  placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br>    

					 <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Round Off</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" name="roundOff" id="roundOff"  value="<?php echo $r['roundOff'];?>" disabled placeholder="0" >
                    </div>
                  </div>
                  <br>
                  <br>

                   <div class="col-sm-offset-5">
                    <label class="col-sm-5  control-label" >Other Charges</label>
                    <div class="col-sm-7">
                      <input class="form-control"  type="text" name="othercharges" id="othercharges"  value="<?php echo $r['othercharges'];?>" disabled placeholder="0" value="0">
                    </div>
                  </div>
                  <br>
                  <br>  
                                       
                        <div class=" col-sm-offset-5">
                          <label class="col-sm-5  control-label" >Invoice Total</label>
                          <div class="col-sm-7">
                            <input class="form-control" disabled  type="text" value="<?php echo $r['grandtotal'];?>" readonly name="grandtotal" id="grandtotal" >
                            <input class="form-control"  type="hidden" name="taxtotal" id="grandtotal1" value="">
                           
                          </div>                      
                        </div>

                     

                         <input class="form-control decimal" autocomplete="off"  type="hidden" name="adjustment" id="adjustment"  placeholder="0">                      
                        <br>
                        <br>
                        <br>
              
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
jQuery('#datepicker-autoclose1').datepicker({
  autoclose: true,
  todayHighlight: true
});
</script>
