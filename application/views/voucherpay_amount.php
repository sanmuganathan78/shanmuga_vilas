  <?php $data=$this->db->get('profile')->result();
  foreach($data as $r)
    ?>
  <title> <?php echo $r->companyname;?></title>
  <link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
  <link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">

  <style>     
    #cash,#mamount,#through,#bank
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

                            <?php foreach($pay as $row)  ?>

              <div class="card-box">
                <div class="row">

       <form class="form-horizontal" role="form" method="post" target="_blank" onsubmit="setTimeout(function () { location.href = '<?php echo base_url();?>invoice/pending';},2000)" action="<?php echo base_url();?>voucher/add">


                    <div class="form-group">
                    <label for="inputPassword" class="col-lg-3 control-label">Date</label>
                    <div class="col-lg-3">
                      <input type="text" name="voucherdate" class="form-control datepicker-autoclose" id="datepicker-autoclose" placeholder=""  value="<?php echo date('d-m-Y');?>" required>
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="inputPassword" class="col-lg-3 control-label">Time</label>
                    <div class="col-lg-3">
                      <input class="form-control" name="time" id="times" type="text" readonly>
                    </div>
                  </div>



                  <div class="form-group">
                    <label for="inputStandard" class="col-lg-3 control-label">Voucher Id</label>
                    <div class="col-lg-3">
                      <input type="text" name="voucherid" id="voucherid" value="<?php echo $voucherid;?>" class="form-control" placeholder="" readonly>
                      <span id="name_valid"></span>
                    </div>
                  </div>






                    <div class="form-group">
                      <label for="inputStandard" class="col-lg-3 control-label">Customer/Company</label>
                      <div class="col-lg-3">
                        <input type="text" name="name" value="<?php echo $row['name'];?>" readonly id="username" class="form-control character" placeholder="" >
                        <span id="name_valid"></span>
                      </div>
                    </div>

             

                      <input type="hidden" name="id" value="<?php echo $row['id'];?>">


                    <div class="form-group">
                      <label for="inputStandard" class="col-lg-3 control-label">Total Amount</label>
                      <div class="col-lg-3">
                        <input type="text" name="totalamount" value="<?php echo $row['salesamount'];?>" id="totalamount"  class="form-control" placeholder="" readonly>
                        <span id="name_valid"></span>
                      </div>
                    </div>

                    <div class="form-group">
                      <label for="inputStandard" class="col-lg-3 control-label"> Paid Amount</label>
                      <div class="col-lg-3">
                        <input type="text" name="paidamount" value="<?php echo $row['paidamount'];?>" id="paidamount"  class="form-control" placeholder="" readonly>
                        <span id="name_valid"></span>
                      </div>
                    </div>



                    <div class="form-group">
                      <label for="inputStandard" class="col-lg-3 control-label">Balance</label>
                      <div class="col-lg-3">
                        <input type="text" name="balance" value="<?php echo $row['balanceamount'];?>" id="balance"  class="form-control" placeholder="" readonly>
                        <span id="name_valid"></span>
                      </div>
                    </div>




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
               <label class="control-label col-sm-3">Bank Name</label>
               <div class="col-lg-3">
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
             <label class="control-label col-sm-3">Cheque No</label>
             <div class="col-lg-3">

              <input type="text"  class="form-control decimal" id="chequeno" name="chequeno" data-provide="typeahead" >
              <span id="chequeno_valid"></span>

            </div>
          </div>

          <div class="form-group">                                
           <label class="control-label col-sm-3">Amount</label>
           <div class="col-lg-3">


            <input type="text"  class="form-control decimal" autocomplete="off" min="0" max="9999999999"  id="chamount" name="chamount" data-provide="typeahead"  >
            <span id="chamount_valid"></span>
            <span id="chamounts_valid"></span>
            <span id="chamountss_valid"></span>


          </div>
        </div>
      </div>


      <div  id="bank" >
       <div class="form-group">                                
         <label class="control-label col-sm-3">Bank Name</label>
         <div class="col-lg-3">

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
       <label class="control-label col-sm-3">Amount</label>
       <div class="col-lg-3">
        <input type="text"  class="form-control decimal" min="0" autocomplete="off" max="9999999999"  id="bamount" name="bamount" data-provide="typeahead"  >
        <span id="bamount_valid"></span>
        <span id="bamounts_valid"></span>
        <span id="bamountss_valid"></span>


      </div>
    </div>
  </div>
  <div id="cash" >
    <div class="form-group">                                
     <label class="control-label col-sm-3">Amount</label>
     <div class="col-lg-3">
      <input type="text"  class="form-control decimal" min="0" max="9999999999" autocomplete="off" id="amount" name="amount" >
      <span id="amount_valid"></span>
      <span id="amounts_valid"></span>
      <span id="amountss_valid"></span>


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

</script>

<script type="text/javascript">



 $('#submit').click(function(){

            var username=$('#username').val();
            var amount=$('#amount').val();
            var tc=$('#tc').val();
            var chequeno=$('#chequeno').val();
            var chamount=$('#chamount').val();
            var bank=$('#ss').val();
            var bamount=$('#bamount').val();

            if(username=='')
            {
                $('#username').focus();
                $('#name_valid').html('<span><font color="red">Please Enter the name</span>');
                $('#username').keyup(function(){
                    $('#name_valid').html('');

                });
                return false;
            }

            if($('#optionsRadios1').prop("checked")==true)
  {
                if(amount=='')
            {
                $('#amount').focus();
                $('#amount_valid').html('<span><font color="red">Please Enter the amount</span>');
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
                $('#tc_valid').html('<span><font color="red">Select the bank name</span>');
                $('#tc').change(function(){
                    $('#tc_valid').html('');

                });
                return false;
            }

              if(chequeno=='')
            {
                $('#chequeno').focus();
                $('#chequeno_valid').html('<span><font color="red">Enter the cheque no</span>');
                $('#chequeno').keyup(function(){
                    $('#chequeno_valid').html('');

                });
                return false;
            }

               if(chamount=='')
            {
                $('#chamount').focus();
                $('#chamount_valid').html('<span><font color="red">Enter the amount</span>');
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
                $('#ss_valid').html('<span><font color="red">Select the bank name</span>');
                $('#ss').change(function(){
                    $('#ss_valid').html('');

                });
                return false;
            }

            if(bamount=='')
            {
                $('#bamount').focus();
                $('#bamount_valid').html('<span><font color="red">Enter the amount</span>');
                $('#bamount').keyup(function(){
                    $('#bamount_valid').html('');

                });
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

            if(username=='')
            {
                $('#username').focus();
                $('#name_valid').html('<span><font color="red">Please Enter the name</span>');
                $('#username').keyup(function(){
                    $('#name_valid').html('');

                });
                return false;
            }

            if($('#optionsRadios1').prop("checked")==true)
  {
                if(amount=='')
            {
                $('#amount').focus();
                $('#amount_valid').html('<span><font color="red">Please Enter the amount</span>');
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
                $('#tc_valid').html('<span><font color="red">Select the bank name</span>');
                $('#tc').change(function(){
                    $('#tc_valid').html('');

                });
                return false;
            }

              if(chequeno=='')
            {
                $('#chequeno').focus();
                $('#chequeno_valid').html('<span><font color="red">Enter the cheque no</span>');
                $('#chequeno').keyup(function(){
                    $('#chequeno_valid').html('');

                });
                return false;
            }

               if(chamount=='')
            {
                $('#chamount').focus();
                $('#chamount_valid').html('<span><font color="red">Enter the amount</span>');
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
                $('#ss_valid').html('<span><font color="red">Select the bank name</span>');
                $('#ss').change(function(){
                    $('#ss_valid').html('');

                });
                return false;
            }

            if(bamount=='')
            {
                $('#bamount').focus();
                $('#bamount_valid').html('<span><font color="red">Enter the amount</span>');
                $('#bamount').keyup(function(){
                    $('#bamount_valid').html('');

                });
                return false;
            }


            }


        });



</script>


<script type="text/javascript">
    //Cash Show

    function cash(){

      jQuery('#bank').hide();
      jQuery('#mamount').hide();
      jQuery('#cash').show(); 
      jQuery('#through').hide();
    }

    //Check Show

    function check(){
      jQuery('#bank').hide();
      jQuery('#cash').hide();
      jQuery('#through').show();
      jQuery('#mamount').hide();
    }
            //bank show
            function bank(){
              jQuery('#cash').hide();
              jQuery('#through').hide();
              jQuery('#bank').show();
              jQuery('#mamount').hide();
            }
            //Moneyorder Show
            function payment()
            {
              jQuery('#receipt').hide();
              jQuery('#payment').show();

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

          $("#amount").keyup(function(){
    var amount=$('#amount').val();
    var balance=$('#balance').val();

    if(balance)
    {

    if(parseFloat(amount) > parseFloat(balance))
    {
      $('#amount').val('');
      $('#amount').focus();
      $("#amountss_valid").html('<div><font color="red">Invalid Amount</font></div>').show().fadeOut(3000);
      return false
    }
  }
  });


   $("#bamount").keyup(function(){

    var bamount=$('#bamount').val();
    var balance=$('#balance').val();

     if(balance)
    {

    if(parseFloat(bamount) > parseFloat(balance))
    {
      $('#bamount').val('');
      $('#bamount').focus();
      $("#bamountss_valid").html('<div><font color="red">Invalid Amount</font></div>').show().fadeOut(3000);
      return false
    }

  }
  });

      $("#chamount").keyup(function(){
    var chamount=$('#chamount').val();
    var balance=$('#balance').val();

      if(balance)
    {


    if(parseFloat(chamount) > parseFloat(balance))
    {
      $('#chamount').val('');
      $('#chamount').focus();
      $("#chamountss_valid").html('<div><font color="red">Invalid Amount</font></div>').show().fadeOut(3000);
      return false
    }
  }
  });

            

          </script>

