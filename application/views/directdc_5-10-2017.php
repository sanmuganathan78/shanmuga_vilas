	<table class="responsive table" width="100%">
		<thead> 
			<tr>
				<th>&nbsp;&nbsp;&nbsp;&nbsp;HSN Code</th>
				<th>&nbsp;&nbsp;&nbsp;&nbsp;Item Name</th>
				<th>&nbsp;&nbsp;UOM</th>
				<th>&nbsp;&nbsp;Qty</th>
				<th>&nbsp;&nbsp;Remarks</th>
			</tr>  
		</thead>
		<tbody>
			<tr>
				<!-- <td><input class="form-control" id="itemno" type="text" name="itemno[]" value="">
				<div id="itemno_valid"></div>
				</td> -->
				<td><input class="form-control clear" parsley-trigger="change" readonly id="hsnno" type="text" name="hsnno[]" value="">
				<div id="hsnno_valid"></div></td>

				<td><input class="form-control clear" parsley-trigger="change" required id="itemname" type="text" name="itemname[]" value="">
				<div id="itemname_valid"></div></td>
				<td><input class="form-control clear" readonly id="uom" type="text" name="uom[]"  autocomplete="off">
				<div id="qty_valid"></div></td>
				<td><input class="form-control clear" parsley-trigger="change" required id="qty" type="text" name="qty[]" value=""   autocomplete="off">
				<div id="qty_valid"></div></td>
				<td><input class="form-control clear" id="remarks" type="text" name="remarks[]"  autocomplete="off">
				<div id="qty_valid"></div></td>
				<td><!--<button type="button" class="btn btn-danger remove"><i class="fa fa-remove"></i></button>-->&nbsp;</td>
			</tr>
		</tbody>
		<tbody id="append"></tbody> 
		<tfoot>
			<tr>
				<td colspan="5">&nbsp;</td>
				<td><button type="button" class="btn btn-info add"><i class="fa fa-plus"></i></button><input type="hidden"  id="hide" value="1"></td>
			</tr>
		</tfoot>
	</table>

	<br>
	
	<div class="col-sm-offset-4">
		<button  class="btn btn-info" id="submit" name="save" value="save">Save</button>
		<button  class="btn btn-primary"  name="print" id="print" value="print">Print</button>
		<button type="reset"  class="btn btn-default" id="">Reset</button>
	</div>

	<script type="text/javascript">
	$(document).ready(function(){
		$( "#itemname" ).autocomplete({
			source: function(request, response) {
				$.ajax({ 
					url: "<?php echo base_url();?>dcbill/autocomplete_itemname",
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
				$.post('<?php echo base_url();?>dcbill/get_itemnames',{name:name},function(rest){
					var obj=jQuery.parseJSON(rest);
					$('#hsnno').val(obj.hsnno);
					$('#uom').val(obj.uom);
					$('#qty').val('');
					$('#qty').focus();
				}); 
				if(name !='')
				{
					$.post('<?php echo base_url();?>dcbill/check_itemname',{itemname:name},function(res){
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

		$('#itemname').blur(function(){
		var itemname=$('#itemname').val();
		var mobileno=$('#mobileno').val();
		// var qty=$('#qty').val();
		if(itemname !='')
		{
		$.post('<?php echo base_url();?>dcbill/check_itemname',{itemname:itemname},function(res){
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
			$('<tr class="clears"><td><input class="form-control clear" readonly id="hsnno'+total+'" parsley-trigger="change" required type="text" name="hsnno[]" required value=""><div id="hsnno_valid'+total+'"></td><td><input class="form-control clear" parsley-trigger="change" required id="itemname'+total+'" type="text" name="itemname[]" value=""><div id="itemname_valid'+total+'"></td> <td><input class="form-control clear" readonly id="uom'+total+'" type="text" name="uom[]"  autocomplete="off"><div id="qty_valid"></div></td><td><input class="form-control clear" required id="qty'+total+'" type="text" parsley-trigger="change" required name="qty[]" autocomplete="off" value="" onkeypress="return isNumberKey(event)" required ><div id="qty_valid'+total+'"></td>'
			+'<td><input class="form-control clear"  id="remarks'+total+'" type="text" name="remarks[]" autocomplete="off" ><div id="qty_valid'+total+'"></td>'
			+'<td><button type="button" class="btn btn-danger remove"> <i class="fa fa-remove"></i></button></td></tr><div id="table'+total+'"></div>').appendTo(tbody);
			$('#itemno'+total+'').focus();
			
			$('.remove').click(function(){
				$(this).parents('tr').remove();
			});

			$( "#itemname"+total+"").autocomplete({
				source: function(request, response) {
					$.ajax({ 
						url: "<?php echo base_url();?>dcbill/autocomplete_itemname",
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
					$.post('<?php echo base_url();?>dcbill/get_itemnames',{name:name},function(rest){
						var obj=jQuery.parseJSON(rest);
						$('#hsnno'+total+'').val(obj.hsnno);
						$('#uom'+total+'').val(obj.uom);
						$('#qty'+total+'').val('');
						$('#qty'+total+'').focus();
					}); 

					if(name !='')
					{
						$.post('<?php echo base_url();?>dcbill/check_itemname',{itemname:name},function(res){
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
					$.post('<?php echo base_url();?>dcbill/check_itemname',{itemname:itemname},function(res){
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