<div class="col-md-6">
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



                        <script type="text/javascript">
  $(document).ready(function(){
          
$( "#cusname" ).autocomplete({
  source: function(request, response)
   {
    $.ajax({ 
      url: "<?php echo base_url();?>jobinward/autocomplete_name",
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
      url: "<?php echo base_url();?>jobinward/autocomplete_itemname",
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
  $.post('<?php echo base_url();?>jobinward/get_itemnames',{name:name},function(rest){
    var obj=jQuery.parseJSON(rest);
    $('#hsnno').val(obj.hsnno);
    $('#uom').val(obj.uom);
    $('#qty').val('');
    $('#qty').focus();
  }); 
             
  if(name !='')
  {
    $.post('<?php echo base_url();?>jobinward/check_itemname',{itemname:name},function(res){
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
  $.post('<?php echo base_url();?>jobinward/get_name',{cusname:cusname},function(res){
    var obj=jQuery.parseJSON(res);
    $('#address').val(obj.address);
  });
  if(cusname !='')
  {
    $.post('<?php echo base_url();?>jobinward/check_cusname',{cusname:cusname},function(res){
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
          $.post('<?php echo base_url();?>jobinward/check_itemname',{itemname:itemname},function(res){
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
        url: "<?php echo base_url();?>jobinward/autocomplete_itemname",
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
  $.post('<?php echo base_url();?>jobinward/get_itemnames',{name:name},function(rest){
    var obj=jQuery.parseJSON(rest);
    $('#hsnno'+total+'').val(obj.hsnno);
    $('#uom'+total+'').val(obj.uom);
    $('#qty'+total+'').val('');
    $('#qty'+total+'').focus();
  }); 
             
  if(name !='')
  {
    $.post('<?php echo base_url();?>jobinward/check_itemname',{itemname:name},function(res){
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
    $.post('<?php echo base_url();?>jobinward/check_itemname',{itemname:itemname},function(res){
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

$.ajax({
        type: "POST",
        url: "<?php echo base_url();?>jobinward/get_category",
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
});
</script>