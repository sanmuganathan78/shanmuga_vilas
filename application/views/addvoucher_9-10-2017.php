  <?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
        <title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">

<style>     
#cash,#mamount,#through,#bank,#cards
 {
display:none;
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
            <i class="zmdi zmdi-money-box">&nbsp;Voucher</i>
            </header>
            <div class="card-box">
              <div class="row">
                  <form class="form-horizontal" role="form" method="post" onsubmit="setTimeout(function () { location.href = '<?php echo base_url();?>voucher';},2000)" target="_blank" action="<?php echo base_url();?>voucher/insert">




                 <div class="form-group">
                                <label class="control-label col-sm-3">Type</label>
                                <div class="controls col-sm-2">
                                    <input type="radio" name="vouchertype" style="width:50px;" checked onchange="payment()" id="optionsRadios33" value="payment"  required>
                           Receivable                                
                                  </div>

                          <div class="controls col-sm-2">

                                 
                                    <input type="radio" onchange="receipt()" style="width:50px;" name="vouchertype" id="optionsRadios5" value="receipt"  required>
                                   Payable

                          </div>

                              
                             
                </div>
             
          

               <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">Date</label>
                <div class="col-lg-4">
                  <input type="text" name="voucherdate" class="form-control datepicker-autoclose" id="datepicker-autoclose" placeholder=""  value="<?php echo date('d-m-Y');?>" required>
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
                  <input type="text" name="voucherid" id="voucherid" value="<?php echo $voucherid;?>" class="form-control" placeholder=""  readonly>
                  <span id="name_valid"></span>
                </div>
              </div>



              <div id="receipt" style="display:none;">



                <div class="form-group">
                <label for="inputStandard" class="col-lg-3 control-label">Customer/Company</label>
                <div class="col-lg-4">
                  <input type="text" name="name1"   id="username1" class="form-control character" placeholder="" >
                    <input type="hidden" name="customerid1"  id="customerid1" class="form-control character" placeholder="" >
                        <span id="username1_valid"></span>
                </div>
              </div>

             
     <!--             <div class="form-group">
                <label for="inputStandard" class="col-lg-3 control-label">Total Amount</label>
                <div class="col-lg-4">
                  <input type="text" name="totalamount1" id="totalamount"  class="form-control" placeholder="" readonly>
                  <span id="name_valid"></span>
                </div>
              </div>

                <div class="form-group">
                <label for="inputStandard" class="col-lg-3 control-label"> Paid Amount</label>
                <div class="col-lg-4">
                  <input type="text" name="paidamount1" id="paidamount1"  class="form-control" placeholder="" readonly>
                  <span id="name_valid"></span>
                </div>
              </div> -->



              <div class="form-group">
                <label for="inputStandard" class="col-lg-3 control-label">Balance</label>
                <div class="col-lg-4">
                  <input type="text" name="balance1" id="balance1"  class="form-control" placeholder="" readonly>
                  <span id="name_valid"></span>
                </div>
              </div>


            </div>

              <div id="payment">

              <div class="form-group">
                <label for="inputStandard" class="col-lg-3 control-label">Customer/Company</label>
                <div class="col-lg-4">
                  <input type="text" name="name"  id="username" class="form-control character" placeholder="" >
                   
                  <span id="username_valid"></span>
                </div>
              </div>

             <!-- 
                 <div class="form-group">
                <label for="inputStandard" class="col-lg-3 control-label">Total Amount</label>
                <div class="col-lg-4">
                  <input type="text" name="totalamount" id="totalamount"  class="form-control" placeholder="" readonly>
                   <input type="hidden" name="customerid"  id="customerid" class="form-control character" placeholder="" >
                  <span id="name_valid"></span>
                </div>
              </div>

                <div class="form-group">
                <label for="inputStandard" class="col-lg-3 control-label"> Paid Amount</label>
                <div class="col-lg-4">
                  <input type="text" name="paidamount" id="paidamount"  class="form-control" placeholder="" readonly>
                  <span id="name_valid"></span>
                </div>
              </div> -->



              <div class="form-group">
                <label for="inputStandard" class="col-lg-3 control-label">Balance</label>
                <div class="col-lg-4">
                  <input type="text" name="balance" id="balance"  class="form-control" placeholder="" readonly>
                  <span id="name_valid"></span>
                </div>
              </div>



              </div>




              
             
            
           

             <!--   <div class="form-group">
                <label for="inputPassword" class="col-lg-3 control-label">Remarks</label>
                <div class="col-lg-4">
                  <textarea type="text" name="remarks" class="form-control" id="remarks" placeholder="" ></textarea>
                </div>
              </div> -->
                
                 
                 <div class="form-group">
                                <label class="control-label col-sm-3">Payment Mode</label>
                                <div class="controls col-sm-1">
                                    <input type="radio" name="paymentmode" id="optionsRadios1" value="Cash" onchange="cash()" required>
                                    Cash
                                  </label>
                                  </div>
                                  <div class="controls col-sm-1" style="width:100px;">
                                    <input type="radio" name="paymentmode" id="optionsRadios2" value="Cheque" onchange="check()" required>
                                    Cheque
                                  </label>
                                  </div>
                                  <div class="controls col-sm-1" style="width:142px;">
                                    <input type="radio" name="paymentmode" id="optionsRadios3" value="Bank" onchange="bank()" required>
                                    RTGS/ Neft
                                  </label>
                                  </div>
                                   
                              </div>
                                



                  <div  id="through" class="form-group" >
                  <div class="form-group">                                
                                 <label class="control-label col-sm-3">Bank Name<span style="color:red;">*</span></label>
                                <div class="col-lg-4">
                                  <select  name="throughcheck" class="form-control" id="tc" data-rel="chosen1" required>
                                   
                                   <option value="0">--Select--</option>
                                   <option value="FEDERAL BANKLTD">FEDERAL BANK LTD</option>
        <option value="HDFC BANK">HDFC BANK</option>
        <option value="ICICI BANK">ICICI BANK</option>
        <option value="KARUR VYSYA BANK">KARUR VYSYA BANK</option>
        <option value="KOTAK MAHINDRA">KOTAK MAHINDRA</option>
        <option value="ING VYSYA">ING VYSYA</option>
        <option value="SOUTH INDIAN">SOUTH INDIAN</option>                                         <option value="BANK OF AMERICA">BANK OF AMERICA</option>
        <option value="CITI BANK">CITI BANK</option>
        <option value="HSBC BANK">HSBC BANK</option>
        <option value="UNITED BANK OF INDIAN">UNITED BANK OF INDIAN</option>
        <option value="BANK OF BARODA">BANK OF BARODA</option>
        <option value="CANARA BANK">CANARA BANK</option>
        <option value="CORPORATION BANK">CORPORATION BANK</option>
        <option value="SYNDICATE">SYNDICATE</option>
        <option value="ANDHRA BANK">ANDHRA BANK</option>
        <option value="BANK OF INDIA">BANK OF INDIA</option>
        <option value="CENTRAL BANK OF INDIA">CENTRAL BANK OF INDIA</option>
        <option value="UCO BANK">UCO BANK</option>
        <option value="UNION BANK OF INDIA">UNION BANK OF INDIA</option>
        <option value="UNITED BANK OF INDIA">UNITED BANK OF INDIA</option>
        <option value="STATE BANK OF HYDRABAD">STATE BANK OF HYDRABAD</option>
        <option value="CATHOLIC SYRIAN BANK">Catholic Syrian Bank</option>
        <option value="INDIAN BANK">INDIANBANK</option>
        <option value="INDIAN OVERSEAS">INDIANOVERSEAS</option>
        <option value="AXIS">AXIS</option>
        <option value="TAMILNADU MERCHANTILE">TAMILNADUMERCHANTILE</option>
        <option value="STATE BANK OF INDIA">STATEBANKOFINDIA</option>
                                 </select>
                                 <span id="tc_valid"></span>
                                </div>
                              </div>


                               <div class="form-group">                                
                                 <label class="control-label col-sm-3">Cheque No<span style="color:red;">*</span></label>
                                <div class="col-lg-4">
                             
                                <input type="text"  class="form-control decimal" id="chequeno" name="chequeno" data-provide="typeahead" >
                                <span id="chequeno_valid"></span>
                                
                              </div>
                              </div>
                                       <div class="form-group">                                
                                 <label class="control-label col-sm-3">Cheque Date</label>
                                <div class="col-lg-4">
                             
                                <input type="text"  class="form-control decimal" id="chequedate" name="chequedate" data-provide="typeahead" >
                              </div>
                              </div>
                            
                            <div class="form-group">                                
                                 <label class="control-label col-sm-3">Amount <span style="color:red;">*</span></label>
                                <div class="col-lg-4">
                             
                           
                                <input type="text"  class="form-control decimal" min="0" max="9999999999"  id="chamount" name="chamount" data-provide="typeahead"  >
                                <span id="chamount_valid"></span>
                                <span id="chamounts_valid"></span>
                                <span id="chamountss_valid"></span>

                                
                              </div>
                              </div>
                            </div>


                              <div  id="bank" >
                               <div class="form-group">                                
                                 <label class="control-label col-sm-3">Bank Name <span style="color:red;">*</span></label>
                                <div class="col-lg-4">
                               
                                  <select  name="banktransfer" class="form-control"  id="ss" data-rel="chosen1" required>
                                   
                                   <option value="0" >--Select--</option>
                                   <option value="FEDERAL BANKLTD">FEDERAL BANK LTD</option>
        <option value="HDFC BANK">HDFC BANK</option>
        <option value="ICICI BANK">ICICI BANK</option>
        <option value="KARUR VYSYA BANK">KARUR VYSYA BANK</option>
        <option value="KOTAK MAHINDRA">KOTAK MAHINDRA</option>
        <option value="ING VYSYA">ING VYSYA</option>
        <option value="SOUTH INDIAN">SOUTH INDIAN</option>                                        
        <option value="BANK OF AMERICA">BANK OF AMERICA</option>    
        <option value="CITI BANK">CITI BANK</option>
        <option value="HSBC BANK">HSBC BANK</option>
        <option value="UNITED BANK OF INDIAN">UNITED BANK OF INDIAN</option>
        <option value="BANK OF BARODA">BANK OF BARODA</option>
        <option value="CANARA BANK">CANARA BANK</option>
        <option value="CORPORATION BANK">CORPORATION BANK</option>
        <option value="SYNDICATE">SYNDICATE</option>
        <option value="ANDHRA BANK">ANDHRA BANK</option>
        <option value="BANK OF INDIA">BANK OF INDIA</option>
        <option value="CENTRAL BANK OF INDIA">CENTRAL BANK OF INDIA</option>
        <option value="UCO BANK">UCO BANK</option>
        <option value="UNION BANK OF INDIA">UNION BANK OF INDIA</option>
        <option value="UNITED BANK OF INDIA">UNITED BANK OF INDIA</option>
        <option value="STATE BANK OF HYDRABAD">STATE BANK OF HYDRABAD</option>
        <option value="CATHOLIC SYRIAN BANK">Catholic Syrian Bank</option>
        <option value="INDIAN BANK">INDIANBANK</option>
        <option value="INDIAN OVERSEAS">INDIANOVERSEAS</option>
        <option value="AXIS">AXIS</option>
        <option value="TAMILNADU MERCHANTILE">TAMILNADUMERCHANTILE</option>
        <option value="STATE BANK OF INDIA">STATEBANKOFINDIA</option>
        </select>
        <div id="ss_valid"></div>
</div>
</div>
  <div class="form-group">                                
                                 <label class="control-label col-sm-3">Transaction ID <span style="color:red;">*</span></label>
                                <div class="col-lg-4">
                                <input type="text"  class="form-control decimal"   name="transactionid" data-provide="typeahead"  >
                              
                              </div>
                              </div>
                             
                              <div class="form-group">                                
                                 <label class="control-label col-sm-3">Amount <span style="color:red;">*</span></label>
                                <div class="col-lg-4">
                                <input type="text"  class="form-control decimal" min="0" max="9999999999"  id="bamount" name="bamount" data-provide="typeahead"  >
                                <span id="bamount_valid"></span>
                                <span id="bamounts_valid"></span>
                                <span id="bamountss_valid"></span>

                                
                              </div>
                              </div>
                            </div>
                            <div id="cash" >
                              <div class="form-group">                                
                                 <label class="control-label col-sm-3">Amount <span style="color:red;">*</span></label>
                                <div class="col-lg-4">
                                <input type="text"  class="form-control decimal" min="0" max="9999999999"  id="amount" name="amount" >
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
                                <select type="text"  class="form-control"  name="cardtype">
                                <?php 
                                $getcard=$this->db->get('card')->result();
                                foreach($getcard as $g){
                                ?>
                                  <option value="<?php echo $g->name;?>"><?php echo $g->name;?></option>
                              <?php } ?>
                                </select>
                               <span id="cardtype_valid"></span>
                              </div>
                              </div>
                              <div class="form-group">                                
                                 <label class="control-label col-sm-3">Amount <span style="color:red;">*</span></label>
                                <div class="col-lg-3">
                                <input type="text"  class="form-control decimal" min="0" max="9999999999"  id="cardamount" name="cardamount" >
                             <span id="cardamount_valid"></span>
                                
                              </div>
                              </div>
                            </div>



                          <div class="col-sm-offset-4">
                        <button  class="btn btn-info" id="submit" name="save" value="save">Add </button>
                        <button  class="btn btn-success"  name="print" id="print" value="print">Print </button>
                        <button type="reset"  class="btn btn-default" id="">Reset</button>
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

      $('.decimal').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2)
          val =val.replace(/\.+$/,"");
    }
    $(this).val(val);
});


//        $('.character').keyup(function(){
//     var val = $(this).val();
//     if(isNaN(val)){
//          val = val.replace(/[^a-z\.]/g,'');
//          if(val.split('.').length>2)
//           val =val.replace(/\.+$/,"");
//     }
//     $(this).val(val);
// });


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
                $('#amount').keyup(function(){
                    $('#amount_valid').html('');

                });
                return false;
            }




  }



         if($('#optionsRadios2').prop("checked")==true)
  {
         if(tc=='0')
            {
                $('#tc').focus();
                $('#tc_valid').html('<span><font color="red">Select The Bank Name</span>');
                $('#tc').change(function(){
                    $('#tc_valid').html('');

                });
                return false;
            }

              if(chequeno=='')
            {
                $('#chequeno').focus();
                $('#chequeno_valid').html('<span><font color="red">Enter The Cheque No</span>');
                $('#chequeno').keyup(function(){

                });
                return false;
            }

               if(chamount=='')
            {
                $('#chamount').focus();
                $('#chamount_valid').html('<span><font color="red">Enter The Amount</span>');
                $('#chamount').keyup(function(){
                    $('#chamount_valid').html('');

                });
                return false;
            }


            }



         if($('#optionsRadios3').prop("checked")==true)
      {
         if(bank=='0')
            {
                $('#ss').focus();
                $('#ss_valid').html('<span><font color="red">Select The Bank Name</span>');
                $('#ss').change(function(){
                    $('#ss_valid').html('');

                });
                return false;
            }

            if(bamount=='')
            {
                $('#bamount').focus();
                $('#bamount_valid').html('<span><font color="red">Enter The Amount</span>');
                $('#bamount').keyup(function(){
                    $('#bamount_valid').html('');

                });
                return false;
            }


            }

              if($('#optionsRadios4').prop("checked")==true)
  {
         if(cardtype=='')
            {
                $('#cardtype').focus();
                $('#card_valid').html('<span><font color="red">Select The Cart Type</span>');
                $('#card').change(function(){
                    $('#card_valid').html('');

                });
                return false;
            }

            if(cardamount=='')
            {
                $('#cardamount').focus();
                $('#cardamount_valid').html('<span><font color="red">Enter The Amount</span>');
                $('#cardamount').keyup(function(){
                    $('#cardamount_valid').html('');
                });
                return false;
            }


            }


                        if($('#optionsRadios33').prop("checked")==true)
  {
              

                 if(username=='')
            {
                 $('#username').focus();
                $('#username_valid').html('<span><font color="red">Please Enter The Customername</span>');
                $('#username').keyup(function(){
                    $('#username_valid').html('');

                });
                return false;
            }



  }
 





                           if($('#optionsRadios5').prop("checked")==true)
  {
              

                 if(username1=='')
            {
                 $('#username1').focus();
                $('#username1_valid').html('<span><font color="red">Please Enter The Supplier Name</span>');
                $('#username1').keyup(function(){
                    $('#username1_valid').html('');

                });
                return false;
            }



  }



           
    });



    $('#print').click(function(){

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
                $('#amount').keyup(function(){
                    $('#amount_valid').html('');

                });
                return false;
            }




  }



         if($('#optionsRadios2').prop("checked")==true)
  {
         if(tc=='0')
            {
                $('#tc').focus();
                $('#tc_valid').html('<span><font color="red">Select The Bank Name</span>');
                $('#tc').change(function(){
                    $('#tc_valid').html('');

                });
                return false;
            }

              if(chequeno=='')
            {
                $('#chequeno').focus();
                $('#chequeno_valid').html('<span><font color="red">Enter The Cheque No</span>');
                $('#chequeno').keyup(function(){

                });
                return false;
            }

               if(chamount=='')
            {
                $('#chamount').focus();
                $('#chamount_valid').html('<span><font color="red">Enter The Amount</span>');
                $('#chamount').keyup(function(){
                    $('#chamount_valid').html('');

                });
                return false;
            }


            }



         if($('#optionsRadios3').prop("checked")==true)
      {
         if(bank=='0')
            {
                $('#ss').focus();
                $('#ss_valid').html('<span><font color="red">Select The Bank Name</span>');
                $('#ss').change(function(){
                    $('#ss_valid').html('');

                });
                return false;
            }

            if(bamount=='')
            {
                $('#bamount').focus();
                $('#bamount_valid').html('<span><font color="red">Enter The Amount</span>');
                $('#bamount').keyup(function(){
                    $('#bamount_valid').html('');

                });
                return false;
            }


            }


                        if($('#optionsRadios33').prop("checked")==true)
  {
              

                 if(username=='')
            {
                 $('#username').focus();
                $('#username_valid').html('<span><font color="red">Please Enter The Customername</span>');
                $('#username').keyup(function(){
                    $('#username_valid').html('');

                });
                return false;
            }



  }
 





                           if($('#optionsRadios5').prop("checked")==true)
  {
              

                 if(username1=='')
            {
                 $('#username1').focus();
                $('#username1_valid').html('<span><font color="red">Please Enter The Supplier Name</span>');
                $('#username1').keyup(function(){
                    $('#username1_valid').html('');

                });
                return false;
            }



  }


    if($('#optionsRadios4').prop("checked")==true)
  {
         if(cardtype=='')
            {
                $('#cardtype').focus();
                $('#card_valid').html('<span><font color="red">Select The Cart Type</span>');
                $('#card').change(function(){
                    $('#card_valid').html('');

                });
                return false;
            }

            if(cardamount=='')
            {
                $('#cardamount').focus();
                $('#cardamount_valid').html('<span><font color="red">Enter The Amount</span>');
                $('#cardamount').keyup(function(){
                    $('#cardamount_valid').html('');
                });
                return false;
            }


            }



           
    });



    });
</script>


<script type="text/javascript">
    //Cash Show

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



      
         $( "#username" ).autocomplete({
    source: function(request, response) {
      $.ajax({ 
        url: "<?php echo base_url();?>voucher/autocomplete_username",
        data: { keyword: $("#username").val()},
        dataType: "json",
        type: "POST",
        success: function(data){ 
          response(data);
        }            
      });
    }, select: function (event, ui) {
      $("#username").val(ui.item.label); 
    
      $('#totalamount').val(ui.item.totalamount); 
      $('#paidamount').val(ui.item.paidamount); 
      $('#balance').val(ui.item.balance); 
      $('#username').val(ui.item.customername); 
      $('#customerid').val(ui.item.customerid); 


            var name=$(this).val();


      if(name !='')
            {
               
                $.post('<?php echo base_url();?>voucher/getcustomer',{name:name},function(res){

                    if(res > 0)
                    {

                        $('#username_valid').html('<span><font color="green">Available!</span>');

                        $('#submit').attr('disabled',false);
                        $('#print').attr('disabled',false);
                   
                         }

                                else
                                {
                                   
                                   $('#username_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                  }
                              });

                return false;

            }


      // $('#mobileno').val(ui.item.mobileno); 
     
}
  });


             $( "#username1" ).autocomplete({
    source: function(request, response) {
      $.ajax({ 
        url: "<?php echo base_url();?>voucher/autocomplete_username1",
        data: { keyword: $("#username1").val()},
        dataType: "json",
        type: "POST",
        success: function(data){ 
          response(data);
        }            
      });
    }, select: function (event, ui) {
      $("#username1").val(ui.item.label); 
    
      $('#totalamount1').val(ui.item.totalamount); 
      $('#paidamount1').val(ui.item.paidamount); 
      $('#balance1').val(ui.item.balance); 
      $('#username1').val(ui.item.customername); 
      $('#customerid1').val(ui.item.customerid); 


            var name=$(this).val();


      if(name !='')
            {
               
                $.post('<?php echo base_url();?>voucher/getcustomer',{name:name},function(res){

                    if(res > 0)
                    {

                        $('#username_valid').html('<span><font color="green">Available!</span>');

                        $('#submit').attr('disabled',false);
                        $('#print').attr('disabled',false);
                   
                         }

                                else
                                {
                                   
                                   $('#username_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                  }
                              });

                return false;

            }


      // $('#mobileno').val(ui.item.mobileno); 
     
}
  });



 
    </script>


    <script type="text/javascript">
  
$(document).ready(function(){

  // $("#amount").keyup(function(){
  //   var amount=$('#amount').val();
  //   var balance=$('#balance').val();

  //   if(balance)
  //   {

  //   if(parseFloat(amount) > parseFloat(balance))
  //   {
  //     $('#amount').val('');
  //     $('#amount').focus();
  //     $("#amountss_valid").html('<div><font color="red">Invalid Amount</font></div>').show().fadeOut(3000);
  //     return false
  //   }
  // }
  // });
  // $("#cardamount").keyup(function(){
  //   var amount=$('#cardamount').val();
  //   var balance=$('#balance').val();

  //   if(balance)
  //   {

  //   if(parseFloat(amount) > parseFloat(balance))
  //   {
  //     $('#cardamount').val('');
  //     $('#cardamount').focus();
  //     $("#cardamount_valid").html('<div><font color="red">Invalid Amount</font></div>').show().fadeOut(3000);
  //     return false
  //   }
  // }
  // });



  //  $("#bamount").keyup(function(){

  //   var bamount=$('#bamount').val();
  //   var balance=$('#balance').val();

  //    if(balance)
  //   {

  //   if(parseFloat(bamount) > parseFloat(balance))
  //   {
  //     $('#bamount').val('');
  //     $('#bamount').focus();
  //     $("#bamountss_valid").html('<div><font color="red">Invalid Amount</font></div>').show().fadeOut(3000);
  //     return false
  //   }

  // }
  // });

  //     $("#chamount").keyup(function(){
  //   var chamount=$('#chamount').val();
  //   var balance=$('#balance').val();

  //     if(balance)
  //   {


  //   if(parseFloat(chamount) > parseFloat(balance))
  //   {
  //     $('#chamount').val('');
  //     $('#chamount').focus();
  //     $("#chamountss_valid").html('<div><font color="red">Invalid Amount</font></div>').show().fadeOut(3000);
  //     return false
  //   }
  // }
  // });



       $('#username').keyup(function(){ 


    

            var name=$(this).val();

           
 if(name !='')
            {
               
                $.post('<?php echo base_url();?>voucher/getcustomer',{name:name},function(res){

                    if(res > 0)
                    {

                        $('#username_valid').html('<span><font color="green">Available!</span>');

                        $('#submit').attr('disabled',false);
                        $('#print').attr('disabled',false);
                   
                         }

                                else
                                {
                                   
                                   $('#username_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                  }
                              });

                return false;

            }
        });




       $('#username').blur(function(){ 


    

            var name=$(this).val();

           
 if(name !='')
            {
               
                $.post('<?php echo base_url();?>voucher/getinvoiceno',{name:name},function(res){

                    if(res > 0)
                    {

                        $('#invoiceno_valid').html('<span><font color="green">Available!</span>');

                        $('#submit').attr('disabled',false);
                        $('#print').attr('disabled',false);
                   
                         }

                                else
                                {
                                   
                                   $('#invoiceno_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                  }
                              });

                return false;

            }
        });


$('#chequedate').datepicker();

});



</script>


