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
</style>
<div class="content-page">
  <div class="content">
    <div class="container">
      <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
      <div class="alert  btn-primary alert-micro btn-rounded pastel light dark" >
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
              <i class="zmdi zmdi-assignment-o">&nbsp;Job Inward - <?php echo $jobinwardno;?></i>
            </header>
            <div class="card-box">
              <div class="row">
                <form class="form-horizontal" data-parsley-validate novalidate  method="post"    action="<?php echo base_url();?>jobinward/insert" >
                  <div class="col-md-12 forms">
                    

                    <div class="col-md-3">
                        <div class="form-group">
                          <label>Job Type</label>
                          <input type="hidden" class="form-control" readonly  name="jobinwardno" id="jobinwardno" value="<?php echo $jobinwardno;?>">
                        <select class="form-control" parsley-trigger="change" required  name="jobtype" id="jobtype">
                          <option value="IN-House">IN-House</option>
                          <option value="Job Order">Job Order</option>
                        </select>
                        </div>
                      </div>

                                            
                      <div class="col-md-3">
                        <div class="form-group">
                          <label>Job Inward Date</label>
                          <input type="text" class="form-control datepicker-autoclose" name="jobinwarddate" parsley-trigger="change" required  id="jobinwarddate" value="<?php echo date('d-m-Y');?>" >
                          
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

                    

                    <div class="col-md-3 vendors">
                        <div class="form-group">
                          <label for="exampleInputEmail1">Job Order No</label>
                          <select name="joborderno" id="joborderno"  class="form-control clears">
                          <option value="">Select Job Order No</option>
                           </select>

                       </div>                
                     </div>


                    <div class="clearfix"></div>
                    <hr>
                    <div class="clearfix"></div>

                      <div class="joborderdetails"></div>
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

      var jobtype=$('#jobtype').val();
      if(jobtype=='IN-House')
      {
        $('.inhouse').show();
        $('.vendors').hide();
        $('.clears').val('');
        $('#operatorname').attr('required',true);
        $('#vendors').attr('required',false);
        $('#vendordetails').attr('required',false);

        $.post('<?php echo base_url();?>jobinward/getinhouseinward',function(data){
            $('.joborderdetails').html(data);
        });
      }
      else
      {
        $('.inhouse').hide();
        $('.vendors').show();
        $('.clears').val('');
        $('#operatorname').attr('required',false);
        $('#vendors').attr('required',true);
        $('#vendordetails').attr('required',true);
        var joborderno=$('#joborderno').val();
      $.post('<?php echo base_url();?>jobinward/getjoborder',{'joborderno':joborderno},function(data){
            $('.joborderdetails').html(data);
        });
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

        $.post('<?php echo base_url();?>jobinward/getinhouseinward',function(data){
            $('.joborderdetails').html(data);
        });
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
        var joborderno=$('#joborderno').val();
      $.post('<?php echo base_url();?>jobinward/getjoborder',{'joborderno':joborderno},function(data){
            $('.joborderdetails').html(data);
        });


        
      }
    });

    $('#joborderno').change(function(){
      var joborderno=$(this).val();
      $.post('<?php echo base_url();?>jobinward/getjoborder',{'joborderno':joborderno},function(data){
            $('.joborderdetails').html(data);
        });

    });


    // $.ajax({
    //     type: "POST",
    //     url: "<?php echo base_url();?>jobinward/get_category",
    //     data:{id:$(this).val()}, 
    //      beforeSend :function(){
    //       $("#category option:gt(0)").remove(); 
    //       $("#category").multiSelect("destroy");
    //       $("#category").multiSelect();
    //       $('#category').find("option:eq(0)").html("Please Wait");
    //       $("#category").multiSelect("destroy");
    //       $("#category").multiSelect();
    //     },                         
    //     success: function (data) {   
    //       $("#category").multiSelect("destroy");
    //       $("#category").multiSelect();     
    //       $('#category').find("option:eq(0)").html("");
    //       $("#category").multiSelect("destroy");
    //       $("#category").multiSelect();
    //       var obj=jQuery.parseJSON(data);       
    //       $("#category").multiSelect("destroy");
    //       $("#category").multiSelect();
    //       $(obj).each(function(){
    //         var option = $('<option />');
    //         option.attr('value', this.value).text(this.label);           
    //         $('#category').append(option);
    //       });       
    //       $("#category").multiSelect("destroy");
    //       $("#category").multiSelect();
    //     }                     
        
    //   });

    $( "#vendors" ).autocomplete({
  source: function(request, response)
   {
    $.ajax({ 
      url: "<?php echo base_url();?>jobinward/autocomplete_name",
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
 $.post('<?php echo base_url();?>jobinward/get_name',{vendors:vendors},function(res){
    var obj=jQuery.parseJSON(res);
    $('#vendordetails').val(obj.address);
  });

 $.post('<?php echo base_url();?>jobinward/get_joborderno',{vendors:vendors},function(res){
              
              //  /*get response as json */
              $('#joborderno').find("option:eq(0)").attr('value', '').text('Select Joborder No');
              var obj=jQuery.parseJSON(res);
              $(obj).each(function()
              {
                var option = $('<option />');
                option.attr('value', this.value).text(this.label);
                $('#joborderno').append(option);
              });            

            });
             
  
          

           }
});
$('#vendors').blur(function(){
  var vendors=$('#vendors').val();
  
  if(vendors !='')
  {
    $.post('<?php echo base_url();?>jobinward/check_vendors',{vendors:vendors},function(res){
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


