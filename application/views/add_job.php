  <?php $data=$this->db->get('profile')->result();
                        foreach($data as $r)
                        ?>
<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
<link href="<?php echo base_url();?>assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?php echo base_url();?>assets/autocomplete/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/multi_select/css/multi-select.css">
<style type="text/css">
  .forms{ }
  .forms input{ width: 98%; }
  .forms select{ width: 98%; }
  .forms textarea{ width: 98%; }
  
  .uppercase {
    text-transform: uppercase;
  }
  .ms-container {
    
    width: 98% !important;
}
.vendors
{
  display: none;
}

input:read-only {
    background-color: rgba(169, 169, 169, 0.21);
    color: #000;
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
              <i class="zmdi zmdi-assignment-o">&nbsp;Create Job Order - <?php echo $joborderno;?></i>
            </header>
            <div class="card-box">
              <div class="row">
                <form class="form-horizontal" data-parsley-validate novalidate  method="post"    action="<?php echo base_url();?>joborder/insert" >
                  <div class="col-md-12 forms">
                    

                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Job Type</label>
                          <input type="hidden" parsley-trigger="change"  class="form-control" readonly  name="joborderno" id="joborderno" value="<?php echo $joborderno;?>">
                        <select class="form-control" parsley-trigger="change" required  name="jobtype" id="jobtype">
                          <option value="IN-House">IN-House</option>
                          <option value="Job Order">Job Order</option>
                        </select>
                        </div>
                      </div>

                                            
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Job Order Date</label>
                          <input type="text" class="form-control datepicker-autoclose" name="joborderdate" parsley-trigger="change" required  id="joborderdate" value="<?php echo date('d-m-Y');?>" >
                          
                        </div>
                      </div>
                         
                    
                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Date of Completion</label>
                          <input type="text" class="form-control datepicker-autoclose" name="dateofcompletion" id="dateofcompletion" value="">
                          
                        </div>
                      </div>

                      <div class="col-md-3 inhouse">
                        <div class="form-group">
                          <label>Operator Name</label>
                         <input type="text" class="form-control clears" name="operatorname" id="operatorname" parsley-trigger="change"   value="" >
                        </div>
                      </div>

                      <div class="col-md-3 vendors">
                        <div class="form-group">
                          <label>Vendors</label>
                         <input type="text" class="form-control clears" name="vendors" id="vendors" value="" parsley-trigger="change"  >
                         <div id="vendors_valid"></div>
                        </div>
                      </div>

                      <div class="col-md-3 vendors">
                      <div class="form-group">
                        <label>Vendor Details</label>
                        <textarea type="text" class="form-control clears" name="vendordetails" id="vendordetails" parsley-trigger="change"   rows="3"></textarea>
                      </div>
                    </div>

                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix"></div>

                      <div class="col-md-5">
                        <div class="form-group">
                          <label>Categories</label>
                        <select id='category' name="category[]" parsley-trigger="change" required  multiple='multiple'></select>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                          <label>Job Description</label>
                        <textarea type="text" class="form-control" name="jobdescription" id="jobdescription" parsley-trigger="change" required  rows="3"></textarea>
                        </div>
                      </div>

                      <div class="col-md-3 vendors">
                        <div class="form-group">
                          <label>Issue By</label>
                            <input type="text"  parsley-trigger="change" class="form-control clears" name="issueby" id="issueby" value="" >
                        </div>
                      </div>


                 
                    
                  </div>
                   <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix"></div>
                  <table class="responsive table" width="100%">
                    <thead> 
                       <tr>
                        <!-- <th>&nbsp;&nbsp;&nbsp;&nbsp;Item Code</th> -->
                        <td align="center" colspan="3" style="border-top: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0;border-left: 1px solid #e0e0e0;"><b style="color: blue;">Job Order Details</b></td>
                        <td align="center" colspan="4" style="border-top: 1px solid #e0e0e0; border-right: 1px solid #e0e0e0;"><b style="color: blue;">Returnable Details</b></td>
                        
                      </tr>
                      <tr>
                        <!-- <th>&nbsp;&nbsp;&nbsp;&nbsp;Item Code</th> -->
                        <th>&nbsp;&nbsp;&nbsp;&nbsp;Item Name</th>
                        <th>&nbsp;&nbsp;Qty</th>
                        <th style="border-right: 1px solid #e0e0e0;">&nbsp;&nbsp;UOM</th>
                        <th>&nbsp;&nbsp;Item Name</th>
                        <th>&nbsp;&nbsp;Qty</th>
                        <th>&nbsp;&nbsp;Scrap</th>
                        
                      </tr>  
                    </thead>
                    <tbody>
                      <tr>
                       
                         <td><input parsley-trigger="change" required id="itemname" type="text" name="itemname[]" value=""></td>
                         <td><input class="decimal" parsley-trigger="change" required id="qty" type="text" name="qty[]" value=""   autocomplete="off"></td>
                         <td style="border-right: 1px solid #e0e0e0;"><input readonly id="uom" type="text" name="uom[]"  autocomplete="off"></td>
                          
                           <td><input parsley-trigger="change" required id="returnitemname" type="text" name="returnitemname[]" value=""></td>

                            <td><input parsley-trigger="change" required id="returnqty" type="text" name="returnqty[]" value=""></td>

                             <td><select name="scrap[]" parsley-trigger="change" required id="scrap">
                                  <option value="">Select Scrap</option>
                                  <option value="Return">Return</option>
                                  <option value="Non Return">Non Return</option>
                             </select></td>     
                              
                          <td><button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button></td>
                            </tr>
                          </tbody>
                          <tbody id="append"></tbody> 
                        </table>
                        <div class="col-sm-offset-10">
                          <button type="button" class="btn btn-info add"><i class="fa fa-plus"></i></button>
                          <input type="hidden"  id="hide" value="1">
                        </div>
                        <div class="clearfix"></div>
                   
                        
                        <br>
                     <div class="col-sm-offset-4">
                     <button  class="btn btn-info"  type="submit" id="submit" name="save" value="save">Save</button>
                       <!--  <button  class="btn btn-primary"  name="print" id="print" value="print">Print</button> -->
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

         <script src="<?php echo base_url();?>assets/multi_select/js/jquery.multi-select.js"></script>

          <script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>

           <script type="text/javascript">
  // run pre selected options
         $('#category').multiSelect();
  </script>

  <script type="text/javascript">
        $(document).ready(function() {
            $('form').parsley();
        });
        </script>

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
          
$( "#cusname" ).autocomplete({
  source: function(request, response)
   {
    $.ajax({ 
      url: "<?php echo base_url();?>joborder/autocomplete_name",
      data: { keyword: $("#cusname").val()},
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
      url: "<?php echo base_url();?>joborder/autocomplete_itemname",
      data: { keyword: $("#itemname").val()},
      dataType: "json",
      type: "POST",
      success: function(data){              
        response(data);
      }    
    });
  },
  select: function (event, ui) {

var name=ui.item.value;
 $('#itemname').val(ui.item.value);
  $.post('<?php echo base_url();?>joborder/get_itemnames',{name:name},function(rest){
    var obj=jQuery.parseJSON(rest);
    $('#hsnno').val(obj.hsnno);
    $('#uom').val(obj.uom);
    $('#qty').val('');
    $('#qty').focus();
  }); 
             
  if(name !='')
  {
    $.post('<?php echo base_url();?>joborder/check_itemname',{itemname:name},function(res){
      if(res > 0)
      {
        $('#itemname_valid').html('<span><font color="green">Available!</span>');
        $('#submit').attr('disabled',false);
        $('#print').attr('disabled',false);
      }
      else
      {

       $('#itemname_valid').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                     }
                                   });
    return false;
  }
          

           }
});
$('#cusname').blur(function(){
  var cusname=$('#cusname').val();
  $.post('<?php echo base_url();?>joborder/get_name',{cusname:cusname},function(res){
    var obj=jQuery.parseJSON(res);
    $('#address').val(obj.address);
  });
  if(cusname !='')
  {
    $.post('<?php echo base_url();?>joborder/check_cusname',{cusname:cusname},function(res){
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
}
});
    return false;
  }
});      




$('#itemname').blur(function(){
  var itemname=$('#itemname').val();
  var mobileno=$('#mobileno').val();
// var qty=$('#qty').val();

if(itemname !='')
        {
          $.post('<?php echo base_url();?>joborder/check_itemname',{itemname:itemname},function(res){
            if(res > 0)
            {
              $('#itemname_valid').html('<span><font color="green">Available!</span>');
              $('#submit').attr('disabled',false);
              $('#print').attr('disabled',false);
            }
            else
            { 
              $('#itemname').focus();
              $('#itemname_valid').html('<span><font color="red"> Not Available !</span>');
$('#submit').attr('disabled',true); //set button enable 
$('#print').attr('disabled',true); //set button enable 
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
  $('<tr><td><input  parsley-trigger="change" required id="itemname'+total+'" type="text" name="itemname[]" value=""><div id="itemname_valid'+total+'"></td> <td><input class="decimal" required id="qty'+total+'" type="text" parsley-trigger="change" required name="qty[]" autocomplete="off" value="" required ><div id="qty_valid'+total+'"></td><td style="border-right: 1px solid #e0e0e0;"><input  readonly id="uom'+total+'" type="text" name="uom[]"  autocomplete="off"><div id="qty_valid"></div></td><td><input parsley-trigger="change" required id="returnitemname" type="text" name="returnitemname[]" value=""></td><td><input parsley-trigger="change" required id="returnqty" type="text" name="returnqty[]" value=""></td><td><select name="scrap[]" parsley-trigger="change" required id="scrap"><option value="">Select Scrap</option><option value="Return">Return</option><option value="Non Return">Non Return</option></select></td>'
    
    +'<td><button type="button" class="btn btn-danger remove"> <i class="fa fa-remove"></i></button></td></tr><div id="table'+total+'"></div>').appendTo(tbody);
  $('#itemno'+total+'').focus();

  $('.remove').click(function(){
    $(this).parents('tr').remove();
        
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
   
  $( "#itemname"+total+"").autocomplete({
    source: function(request, response) {
      $.ajax({ 
        url: "<?php echo base_url();?>joborder/autocomplete_itemname",
        data: { keyword: $("#itemname"+total+"").val()},
        dataType: "json",
        type: "POST",
        success: function(data){              
          response(data);
        }    
      });
    },
    select: function (event, ui) {

var name=ui.item.value;
 $('#itemname'+total+'').val(ui.item.value);
  $.post('<?php echo base_url();?>joborder/get_itemnames',{name:name},function(rest){
    var obj=jQuery.parseJSON(rest);
    $('#hsnno'+total+'').val(obj.hsnno);
    $('#uom'+total+'').val(obj.uom);
    $('#qty'+total+'').val('');
    $('#qty'+total+'').focus();
  }); 
             
  if(name !='')
  {
    $.post('<?php echo base_url();?>joborder/check_itemname',{itemname:name},function(res){
      if(res > 0)
      {
        $('#itemname_valid'+total+'').html('<span><font color="green">Available!</span>');
        $('#submit').attr('disabled',false);
        $('#print').attr('disabled',false);
      }
      else
      {

       $('#itemname_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                     }
                                   });
    return false;
  }
          

           }
  });







   



$('#itemname'+total+'').blur(function(){
  var itemname=$('#itemname'+total+'').val();
 


if(itemname !='')
  {
    $.post('<?php echo base_url();?>joborder/check_itemname',{itemname:itemname},function(res){
      if(res > 0)
      {
        $('#itemname_valid'+total+'').html('<span><font color="green">Available!</span>');
        $('#submit').attr('disabled',false);
        $('#print').attr('disabled',false);
      }
      else
      {

       $('#itemname_valid'+total+'').html('<span><font color="red"> Not Available !</span>');
                                        $('#submit').attr('disabled',true); //set button enable 
                                        $('#print').attr('disabled',true); //set button enable 
                                       //set button enable     
                                     }
                                   });
    return false;
  }

  
});


    
});
});
</script>

<script type="text/javascript">
  $(document).ready(function(){

      var jobtype=$('#jobtype').val();
      if(jobtype=='IN-House')
      {
        $('.inhouse').show();
        $('.vendors').hide();
        $('.clears').val('');
        $('#operatorname').attr('required',true);
        $('#vendors').attr('required',false);
        $('#vendordetails').attr('required',false);
      }
      else
      {
        $('.inhouse').hide();
        $('.vendors').show();
        $('.clears').val('');
        $('#operatorname').attr('required',false);
        $('#vendors').attr('required',true);
        $('#vendordetails').attr('required',true);
      }

    $('#jobtype').change(function(){
      var jobtype=$(this).val();
      if(jobtype=='IN-House')
      {
        $('.inhouse').show();
        $('.vendors').hide();
        $('.clears').val('');
        $('#operatorname').attr('required',true);
        $('#vendors').attr('required',false);
        $('#vendordetails').attr('required',false);
        $('#issueby').attr('required',false);
        $('#uoms').attr('required',false);
      }
      else
      {
        $('.inhouse').hide();
        $('.vendors').show();
        $('.clears').val('');
        $('#operatorname').attr('required',false);
        $('#vendors').attr('required',true);
        $('#vendordetails').attr('required',true);
        $('#issueby').attr('required',true);
        $('#uoms').attr('required',true);
        
      }
    });


    $.ajax({
        type: "POST",
        url: "<?php echo base_url();?>joborder/get_category",
        data:{id:$(this).val()}, 
         beforeSend :function(){
          $("#category option:gt(0)").remove(); 
          $("#category").multiSelect("destroy");
          $("#category").multiSelect();
          $('#category').find("option:eq(0)").html("Please Wait");
          $("#category").multiSelect("destroy");
          $("#category").multiSelect();
        },                         
        success: function (data) {   
          $("#category").multiSelect("destroy");
          $("#category").multiSelect();     
          $('#category').find("option:eq(0)").html("");
          $("#category").multiSelect("destroy");
          $("#category").multiSelect();
          var obj=jQuery.parseJSON(data);       
          $("#category").multiSelect("destroy");
          $("#category").multiSelect();
          $(obj).each(function(){
            var option = $('<option />');
            option.attr('value', this.value).text(this.label);           
            $('#category').append(option);
          });       
          $("#category").multiSelect("destroy");
          $("#category").multiSelect();
        }                     
        
      });

    $( "#vendors" ).autocomplete({
  source: function(request, response)
   {
    $.ajax({ 
      url: "<?php echo base_url();?>joborder/autocomplete_name",
      data: { keyword: $("#vendors").val()},
      dataType: "json",
      type: "POST",
      success: function(data){              
        response(data);
      }    
    });
  },select: function (event, ui) {

var vendors=ui.item.value;
 $('#vendors').val(ui.item.value);
 $.post('<?php echo base_url();?>joborder/get_name',{vendors:vendors},function(res){
    var obj=jQuery.parseJSON(res);
    $('#vendordetails').val(obj.address);
  });
             
  
          

           }
});
$('#vendors').blur(function(){
  var vendors=$('#vendors').val();
  
  if(vendors !='')
  {
    $.post('<?php echo base_url();?>joborder/check_vendors',{vendors:vendors},function(res){
      if(res > 0)
      {
        $('#vendors_valid').html('<span><font color="green">Available!</span>');
        $('#submit').attr('disabled',false);
        
      }
      else
      { 
        $('#vendors').focus();
        $('#vendors_valid').html('<span><font color="red"> Not Available !</span>');
        $('#submit').attr('disabled',true); //set button enable 
         //set button enable 
}
});
    return false;
  }
});

  });
</script>



<script type="text/javascript">



    


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


