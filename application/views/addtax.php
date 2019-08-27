<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>
<title> <?php echo $r->companyname;?></title>
<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">

<style type="text/css">
    .uppercase{
        text-transform: uppercase;
    }
</style>
<div class="content-page">
    <div class="content">
        <div class="container">
            <?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
            <div class="alert btn-info alert-micro btn-rounded pastel light dark" >
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
            </div>
            <?php } ?>

            <?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
            <div class="alert btn-info btn-rounded alert-danger">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <?php print_r($msg); ?>
            </div>
            <?php } ?>
           
                <div class="row">
                    <div class="col-sm-12">
						<div class="portlet box blue">
							<div class="portlet-title">
								<div class="caption">
									<i class="fa fa-reorder"></i>Tax Reports
								</div>
								<div class="tools">
									<a href="javascript:void();" data-toggle="collapse" data-target="#form_div" style="color:white;"> <i class="fa fa-plus"></i> Add Tax</a>&nbsp;
								</div>
							</div>
							<div class="portlet-body form">
								<div class="well collapse <?php //if ($id != ""){ echo "in";} ?>" id="form_div">
									<form class="horizontal-form" id="form" method="post" action="<?php echo base_url();?>taxtype/insert">
										<div class="form-body">
											<div class="row">
												<div class="col-md-3">
													<div class="form-group">
														<label class="control-label">Tax Type</label>
														<input type="text" class="form-control uppercase" name="taxtype" id="taxtype" value="" onkeypress="return onlyAlphabets(event)">
														<div id="tax_valid"></div>
														<div id="tax_valid1"></div>
														<input type="hidden" id="isValidTax" value="0" />
													</div>
												</div>
												<!--/span-->
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">@</label>
														<input type="text" class="form-control decimal" name="taxname" id="taxname" value="" placeholder="%" >
														<div id="taxname_valid"></div>
														<div id="taxname_valid1"></div>
													</div>
												</div>
												<!--/span-->
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">SGST</label>
														<input type="text" class="form-control decimal taxss" readonly="" name="sgst" id="sgst" value="" placeholder="%"  >
													</div>
												</div>
												<!--/span-->
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">CGST</label>
														<input type="text" class="form-control decimal taxss" readonly="" name="cgst" id="cgst" value="" placeholder="%" >
													</div>
												</div>
												<!--/span-->
												<div class="col-md-2">
													<div class="form-group">
														<label class="control-label">IGST</label>
														<input type="text" class="form-control decimal" readonly="" name="igst" id="igst" value="" placeholder="%" >
													</div>
												</div>
											</div>
											
											<div class="col-sm-offset-4">
												<button  class="btn btn-info" id="submit">Add Tax</button>
												<input type="button" class="btn btn-default" value="Cancel" data-toggle="collapse" data-target="#form_div" />
											</div>
										</div>
									</form>
								</div>
								<div class="row">&nbsp;</div>
								<div class="row">&nbsp;</div>
								<div class="card-box table-responsive">
									<table id="datatable-keytable" class="table table-striped">
										<thead>
											<tr>
												<th>S.No</th>
												<th>Date</th>
												<th>Tax </th>
												<th>SGST</th>
												<th>CGST</th>
												<th>IGST</th>
												<th>Action</th>                                            
											</tr>
										</thead>
										<tbody>
											<?php
											$i=1;
											foreach ($vat as  $row) 
											{ ?>
											<tr>
												<td><?php echo $i++;?></td>
												<td><?php echo date('d-m-Y',strtotime($row['date']));?></td>
												<td class="uppercase"><?php echo $row['taxpercentage'];?>&nbsp;&nbsp;</td>


												<td class="uppercase"><?php echo $row['sgst'];?></td>
												<td class="uppercase"><?php echo $row['cgst'];?></td>
												<td class="uppercase"><?php echo $row['igst'];?></td>  
												<td>                        
													<a href="#delete<?php echo $row['id'];?>" data-toggle="modal"  style="color:
												white; font-weight: bold; background-color: #57C5A5" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i></a>
												</td>
											</tr>
											<?php }?>
										</tbody>
									</table>
								</div>
							</div><!--portlet-body form-->
                 
                            </div> <!--portlet box blue-->
                        </div><!--col-sm-12-->
                    </div><!--row-->

<?php foreach($vat as $r) {?>
<div id="delete<?php echo $r['id'];?>" class="modal fade" >
	<div class="modal-dialog" style="width:40%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h4 class="modal-title">Delete </h4>
			</div>
			<div class="modal-text">
				<br>
				<p align="center">Are you sure to delete this data?</p>
			</div>
			<div class="modal-body">
				<div class="row">
					<form name="form" action="<?php echo base_url();?>taxtype/delete" method="post" id="form1">
						<input type="hidden" value="<?php echo $r['id'];?>" name="id">
						<div class="col-offset-4" align="center"></div>
						<div align="center">
							<button id="dialogConfirm" class="btn btn-primary waves-effect waves-light">Confirm</button>
							<button id="dialogCancel" data-dismiss="modal" class="btn btn-default waves-effect">Cancel</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div> 
</div>
<?php }?>



                    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
                    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
                    <script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
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
                            $('#submit').click(function(){
                                var taxtype=$('#taxtype');
                                var taxname=$('#taxname');
                                if(taxtype.val()=='')
                                {
                                    taxtype.focus();
                                    $('#tax_valid').html('<span><font color="red"> Enter the taxtype  </span>');
                                    taxtype.keyup(function(){
                                        $('#tax_valid').html('');
                                    });
                                    return false;
                                }
                                if(taxname.val()=='')
                                {
                                    taxname.focus();
                                    $('#taxname_valid').html('<span><font color="red"> Enter the tax</span>');
                                    taxname.keyup(function(){
                                        $('#taxname_valid').html('');
                                    });
                                    return false;
                                }
								var vatVal = $("#isValidTax").val();
								if(vatVal > 0) 
								{
									$('#taxtype').focus();
									$('#taxname_valid').html('<span><font color="red"> Tax Type Already Exists!</span>');
									return false;
								}
								
                            });
							
							$('#taxname').change(function(){
								var taxtype=$('#taxtype').val();
								var taxname=$('#taxname').val();
								$.post('<?php echo base_url();?>taxtype/checkTax',{'taxtype':taxtype,'taxname':taxname},function(data){
									$("#isValidTax").val(data);
									if(data > 0) 
									{
										$('#taxtype').focus();
										$('#taxname_valid').html('<span><font color="red"> Tax Type Already Exists!</span>');
									}
									else
									{
										$('#taxname_valid').html('');
									}
								});
							});
							
});
</script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#taxname').keyup(function(){
            var taxname=$(this).val();
            if(taxname)
            {
                var taxs=(parseFloat(taxname)/parseFloat(2));
               
                $('.taxss').val(taxs);
                $('#igst').val(taxname);
            }
            else
            {
               $('.taxss').val('');
                $('#igst').val('');
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
</script>
