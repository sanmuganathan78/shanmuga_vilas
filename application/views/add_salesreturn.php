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

	.forms input{ width: 90%; }
	.forms select{ width: 90%; }
	.parsley-errors-list > li {
		position: absolute;
	}
  </style>
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
                <i class="zmdi zmdi-money-box">&nbsp;Credit / Debit Note</i>
              </header>
              <div class="card-box">


                <div class="row">

                <form class="form-horizontal" role="form" method="post" action="<?php echo base_url();?>salesreturn/add_return" id="add_salesreturn" data-parsley-validate novalidate ><!-- -onsubmit="setTimeout(function () { location.href = '<?php echo base_url();?>salesreturn'; })" -->
                  <div class="forms">
                    <div class="col-sm-12">

                     <div class="col-md-4">
                        <div class="form-group"> 
                          <label for="exampleInputEmail1">Type</label>
                          <select name="types" id="types" class="form-control" required>
                            <option value="">Select Type</option>
                            <option value="Debit">Credit (Sales Return)</option>
                            <option value="Credit">Debit (Purchase Return)</option>
                          </select>
                        
                        </div>                
                      </div>

                      <div class="col-md-4 "  id="returnnos" style="display:none;">
                        <div class="form-group"> 
                          <label for="exampleInputEmail1" > Return No</label>
                          <input type="text" class="form-control" name="returnno" id="returnno"  readonly>
                        </div>                
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Date</label>
                          <input type="text" class="form-control datepicker-autoclose" name="returndate" value="<?php echo date('d-m-Y');?>" required >
                        </div>                
                      </div>

                     



                      <div class="col-md-4 debits" style="display:none;">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Customer Name</label>
                          <input class="form-control debitsInput"  type="text" name="customername" id="customername" >
                            <input class="form-control"  type="hidden" name="customerid" id="customerid"  >
                          <div id="name_valid"></div>
                        </div>                
                      </div>

                      <div class="col-md-4 credits" style="display:none;">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Supplier Name</label>
                          <input class="form-control creditsInput"  type="text" name="suppliername" id="suppliername" >
                            <input class="form-control "  type="hidden" name="supplierid" id="supplierid"  >
                          <div id="name_valid"></div>
                        </div>                
                      </div>

                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Time</label>
                          <input type="text" class="form-control" name="time"  id="times" readonly required>
                        </div>                
                      </div>

                         <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Balance</label>
                          <input class="form-control" readonly type="text" name="openingbal" id="openingbal"  required>
                          
                          <div id="name_valid"></div>
                        </div>                
                      </div>





                      <div class="col-md-4 debits" style="display:none;">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Invoice No</label>
                          <select name="invoiceno" id="invoiceno"  class="form-control debitsInput">
                           <option value="">Select Invoice No</option>
                         </select>

                       </div>                
                     </div>

                     
                       <div class="col-md-4 credits" style="display:none;">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Purchase No</label>
                          <select name="purchaseno" id="purchaseno"  class="form-control creditsInput" >
                           <option value="">Select Purchase No</option>
                         </select>

                       </div>                
                     </div>


                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Description</label>
                          <input class="form-control"  type="text" name="description" id="description" required >
                          
                          <div id="name_valid"></div>
                        </div>                
                      </div>


                       <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Date of issue</label>
                          <input type="text" class="form-control datepicker-autoclose" name="dateofissue" value="<?php echo date('d-m-Y');?>"  required>
                        </div>                
                      </div>

                        <div class="col-md-4">
                        <div class="form-group">
                          <label for="exampleInputEmail1">GST Type</label>
                          <input class="form-control" style="text-transform: uppercase;" readonly  type="text" name="gsttype" id="gsttype"  required>
                          
                          <div id="name_valid"></div>
                        </div>                
                      </div>

                   </div> 


                 </div>

                 <div class="clearfix"></div>
                 <div id="ajaxs" class="myform" ></div>
                 <div id="ajaxspo" class="myform" ></div>

                 <div class="col-sm-offset-4">
                        <button  class="btn btn-info" id="submit" name="save" value="save">Add </button>
                        <button  class="btn btn-primary"  name="print" id="print" value="print">Print </button>
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

<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

	<script type="text/javascript">
	$(document).ready(function() { 
		//$('form').parsley(); 
		$('form').parsley().on('form:validate', function (formInstance) {
			var ok = formInstance.isValid();
			$('.invalid-form-error-message')
			  .html(ok ? '' : 'You must correctly fill *at least one of these two blocks!')
			  .toggleClass('filled', !ok);
			if (!ok)
			{
			  //console.log('Not ok');
			  formInstance.validationResult = false;
			}
			else
			{
				window.open('<?php echo base_url();?>salesreturn','_blank');
				//console.log('yes');
			}
		  });
		$('.decimal').keyup(function(){
			var val = $(this).val();
			if(isNaN(val)){
				val = val.replace(/[^0-9\.]/g,'');
				if(val.split('.').length>2)
				val =val.replace(/\.+$/,"");
			}
			$(this).val(val);
		});
		});
	$('.colorpicker-default').colorpicker({ format: 'hex' });
	$('.colorpicker-rgba').colorpicker();
	// Date Picker
	jQuery('#datepicker').datepicker();
	jQuery('.datepicker-autoclose').datepicker({ autoclose: true, todayHighlight: true });
	//CUSTOMER Name
	$( "#customername" ).autocomplete({
		source: function(request, response) {
			$.ajax({ 
			url: "<?php echo base_url();?>salesreturn/autocomplete_customername",
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
			$('#customerid').val(ui.item.id); 
			$('#openingbal').val(ui.item.balance); 
			$('#outstandingamount').val(ui.item.outstandingamount); 
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

	$( "#suppliername" ).autocomplete({
		source: function(request, response) {
			$.ajax({ 
				url: "<?php echo base_url();?>salesreturn/autocomplete_suppliername",
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
			$('#supplierid').val(ui.item.id); 
			$('#outstandingamount').val(ui.item.outstandingamount); 
			$('#openingbal').val(ui.item.balance); 
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
				$(obj).each(function(){
					var option = $('<option />');
					option.attr('value', this.value).text(this.label);
					$('#invoiceno').append(option);
				});            
			});
		}
	});

	$('#suppliername').blur(function(){
		var suppliername=$('#suppliername').val();
		if(suppliername!="")
		{              
			$.post('<?php echo base_url();?>salesreturn/getpurchaseno',{suppliername:suppliername},function(res){
				//  /*get response as json */
				$('#purchaseno').find("option:eq(0)").attr('value', '').text('Select Purchase No');
				var obj=jQuery.parseJSON(res);
				$(obj).each(function(){
					var option = $('<option />');
					option.attr('value', this.value).text(this.label);
					$('#purchaseno').append(option);
				});            
			});
		}
	});

	$('#types').change(function(){
		var types=$('#types').val();
		// $('#add_salesreturn')[0].reset();
		if(types=='Debit')
		{
			$('#returnnos').show();
			$('#ajaxs').show();
			$('#ajaxspo').hide();
			$('.debits').show();
			$('.credits').hide();
			$(".creditsInput").removeAttr('data-parsley-required');//.parsley().destroy();
			$(".debitsInput").attr('data-parsley-required', 'true');//.parsley();
		}
		else
		{
			$('#returnnos').show();
			$('#ajaxspo').show();
			$('#ajaxs').hide();
			$('.credits').show();
			$('.debits').hide();
			$(".debitsInput").removeAttr('data-parsley-required');//.parsley().destroy();
			$(".creditsInput").attr('data-parsley-required', 'true');//.parsley();
		}
		$.post('<?php echo base_url();?>salesreturn/get_returnno',{types:types},function(res){
			console.log(res);
			$('#returnno').val(res);
		});
	});

	$('#invoiceno').change(function(){
		var invoiceno=$('#invoiceno').val();
		if(invoiceno!="")
		{    
			var invoiceno=$(this).val();
			$.post('<?php echo base_url();?>salesreturn/get_type',{invoiceno:invoiceno},function(rest){
				var obj=jQuery.parseJSON(rest);
				$('#gsttype').val(obj.billtype);
			}); 
			$.post('<?php echo base_url();?>salesreturn/getdetails',{invoiceno:invoiceno},function(res){
				$('#ajaxs').html(res);
			});
		}
		else
		{
			$('#gsttype').val('');
			$('#ajaxs').html('');
		}
	});

	$('#purchaseno').change(function(){
		var purchaseno=$('#purchaseno').val();
		if(purchaseno!="")
		{   
			var purchaseno=$(this).val();
			$.post('<?php echo base_url();?>salesreturn/get_typepo',{purchaseno:purchaseno},function(rest){
				var obj=jQuery.parseJSON(rest);
				$('#gsttype').val(obj.billtype);
			}); 

			$.post('<?php echo base_url();?>salesreturn/getpodetails',{purchaseno:purchaseno},function(res){
				$('#ajaxspo').html(res);
			});
		}
		else
		{
			$('#gsttype').val('');
			$('#ajaxspo').html('');
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