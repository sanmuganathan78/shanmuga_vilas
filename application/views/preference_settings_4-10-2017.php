	<!-- DataTables -->


	<?php $data=$this->db->get('profile')->result();
	foreach($data as $r)
	?>
	<title> <?php echo $r->companyname;?></title>
	<link href="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
	<link href="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.css" rel="stylesheet">
	<link href="<?php echo base_url();?>assets/plugins/fileuploads/css/dropify.min.css" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css" />
	<style type="text/css">
		.uppercase{	text-transform: uppercase; }
		.panel .panel-body {
			border: 1px solid rgba(69, 176, 226, 0.75);
		}
		.panel.panel-info {
			border: none;
		}
		#myImg {
			border-radius: 5px;
			cursor: pointer;
			transition: 0.3s;
		}

		#myImg:hover {opacity: 0.7;}

		/* The Modal (background) */
		.modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			padding-top: 100px; /* Location of the box */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgb(0,0,0); /* Fallback color */
			background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
		}

		/* Modal Content (image) */
		.modal-content {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
		}

		/* Caption of Modal Image */
		#caption {
			margin: auto;
			display: block;
			width: 80%;
			max-width: 700px;
			text-align: center;
			color: #ccc;
			padding: 10px 0;
			height: 150px;
		}

		/* Add Animation */
		.modal-content, #caption {    
			-webkit-animation-name: zoom;
			-webkit-animation-duration: 0.6s;
			animation-name: zoom;
			animation-duration: 0.6s;
		}

		@-webkit-keyframes zoom {
			from {-webkit-transform:scale(0)} 
			to {-webkit-transform:scale(1)}
		}

		@keyframes zoom {
			from {transform:scale(0)} 
			to {transform:scale(1)}
		}

		/* The Close Button */
		.close {
			position: absolute;
			*top: 15px;
			*right: 35px;
			top: 89px;
			right: 293px;
			color: #f1f1f1;
			font-size: 40px;
			font-weight: bold;
			transition: 0.3s;
		}

		.close:hover,
		.close:focus {
			color: #bbb;
			text-decoration: none;
			cursor: pointer;
		}

		/* 100% Image Width on Smaller Screens */
		@media only screen and (max-width: 700px){
			.modal-content {
				width: 100%;
			}
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
				<div class="alert alert-micro btn-rounded alert-danger">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php print_r($msg); ?>
				</div>
				<?php } ?>


				<div class="row">
					<div class="col-sm-12">
						<section class="panel" style="background: #267296 none repeat scroll 0% 0%;border: 1px solid #267296;">
							<header class="panel-heading" style="color:rgb(255, 255, 255)">
								<i class="zmdi zmdi-account">&nbsp;Preference Settings</i>
							</header>

							<div class="card-box">
								<div class="row">
									<form class="form-horizontal"  enctype='multipart/form-data' method="post" action="<?php echo base_url();?>preference/insert" data-parsley-validate novalidate>
										<div class="form-group">
											<label class="col-md-2 control-label">Quotation</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="quotation"  value="<?php echo $row['quotation'];?>" id="quotation"  maxlength="35" onkeypress="return isNumberKey(event)" >
											</div>
											<label class="col-md-2 control-label">Expenses</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="expenses" id="expenses" maxlength="35"  value="<?php echo $row['expenses'];?>" onkeypress="return isNumberKey(event)" >
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">DC</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="dc"  value="<?php echo $row['dc'];?>" id="dc"  maxlength="35" onkeypress="return isNumberKey(event)" >
											</div>
											<label class="col-md-2 control-label">Voucher</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="voucher" id="voucher" maxlength="35"  value="<?php echo $row['voucher'];?>" onkeypress="return isNumberKey(event)" >
											</div>
										</div>
										
										<div class="form-group">
											<label class="col-md-2 control-label">Debit</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="debit" id="debit" value="<?php echo $row['debit'];?>" onkeypress="return isNumberKey(event)" maxlength="35" >
											</div>
											<label class="col-md-2 control-label">Credit</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="credit" id="credit" value="<?php echo $row['credit'];?>" onkeypress="return isNumberKey(event)" maxlength="35" >
											</div>
										</div>

										<div class="form-group">
											<label class="col-md-2 control-label">Purchase Receipt</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="purchase" id="purchase" value="<?php echo $row['purchase'];?>" onkeypress="return isNumberKey(event)" maxlength="35" >
											</div>
											<label class="col-md-2 control-label">Invoice</label>
											<div class="col-md-4">
												<input type="text" class="form-control" name="invoice" id="invoice" value="<?php echo $row['invoice'];?>" onkeypress="return isNumberKey(event)" maxlength="35" >
											</div>
										</div>

									
											<!--<div class="col-sm-offset-5">
												<button  class="btn btn-info" id="submit">Save</button>
											</div>
										</form>
										
										<div class="clearfix">&nbsp;</div>-->
										
										<div class="panel panel-info">
											<div class="panel-heading" style="color:#000;font-size:14px;font-weight:bold;"><i class="fa fa-home"></i> Company Details</div>
											<div class="panel-body">
												<!--<form class="form-horizontal"  method="post" action="<?php echo base_url();?>profile/insert">-->
													<div class="form-group">
														<label class="col-md-2 control-label">Company Name</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_companyname"  value="<?php echo $row['cmp_companyname'];?>" id="alloptions"  maxlength="35" onkeypress="return onlyAlphabets(event)" >
														</div>
														<label class="col-md-2 control-label">Phone No</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_phoneno" id="moreoptions" maxlength="12"  value="<?php echo $row['cmp_phoneno'];?>" >
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Mobile No</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_mobileno" id="moreoptions" maxlength="10"  value="<?php echo $row['cmp_mobileno'];?>" >
														</div>
														<label class="col-md-2 control-label">Address Line1</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_address1" value="<?php echo $row['cmp_address1'];?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Address Line2</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_address2" id="address2" value="<?php echo $row['cmp_address2'];?>">
														</div>
														<label class="col-md-2 control-label">Location</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_city" value="<?php echo $row['cmp_city'];?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Pincode</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_pincode" id="pincode" value="<?php echo $row['cmp_pincode'];?>" onkeypress="return isNumberKey(event)">
														</div>
														<label class="col-md-2 control-label">State Code</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_stateCode" id="stateCode" value="<?php echo $row['cmp_stateCode'];?>" onkeypress="return isNumberKey(event)">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Website</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_website" value="<?php echo $row['cmp_website'];?>">
														</div>
														<label class="col-md-2 control-label">Email Id</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cmp_emailid" id="emailid" value="<?php echo $row['cmp_emailid'];?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Logo</label>
														<div class="col-md-4">
															<input type="file" name="cmp_logo" >
															<input type="hidden" name="old_cmp_logo" value="<?php echo $row['cmp_logo'];?>" />
														</div>
														<?php if($row['cmp_logo']!="") { ?>
														<label class="col-md-2 control-label">Uploaded Logo</label>
														<div class="col-md-4">
															<img id="myImg" src="<?php echo base_url().'upload/'.$row['cmp_logo'];?>" alt="<?php echo $row['cmp_companyname'];?>" width="150" height="100">

															<!-- The Modal -->
															<div id="myModalcmp" class="modal">
															  <span id="close1" class="close">&times;</span>
															  <img class="modal-content" id="img01">
															  <div id="caption"></div>
															</div>
														</div>
														<?php } ?>
													</div>
													<!--<div class="col-sm-offset-5">
														<button  class="btn btn-info" id="submit">Add Profile</button>
													</div>
												</form>-->
											</div><!--PANEL BODY -->
										</div>
										
										<div class="clearfix">&nbsp;</div>
										
										<div class="panel panel-info">
											<div class="panel-heading" style="color:#000;font-size:14px;font-weight:bold;"><i class="fa fa-phone"></i> Contact Details</div>
											<div class="panel-body">
												<!--<form class="form-horizontal"  method="post" action="<?php echo base_url();?>profile/insert">-->
													<div class="form-group">
														<label class="col-md-2 control-label">Company Name</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_companyname"  value="<?php echo $row['cont_companyname'];?>" id="alloptions"  maxlength="35" onkeypress="return onlyAlphabets(event)">
														</div>
														<label class="col-md-2 control-label">Phone No</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_phoneno" id="moreoptions" maxlength="12"  value="<?php echo $row['cont_phoneno'];?>" >
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Mobile No</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_mobileno" id="moreoptions" maxlength="10"  value="<?php echo $row['cont_mobileno'];?>" >
														</div>
														<label class="col-md-2 control-label">Address Line1</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_address1" value="<?php echo $row['cont_address1'];?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Address Line2</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_address2" id="address2" value="<?php echo $row['cont_address2'];?>">
														</div>
														<label class="col-md-2 control-label">Location</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_city" value="<?php echo $row['cont_city'];?>">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Pincode</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_pincode" id="pincode" value="<?php echo $row['cont_pincode'];?>" onkeypress="return isNumberKey(event)">
														</div>
														<label class="col-md-2 control-label">State Code</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_stateCode" id="stateCode" value="<?php echo $row['cont_stateCode'];?>" onkeypress="return isNumberKey(event)">
														</div>
													</div>

													<div class="form-group">
														<label class="col-md-2 control-label">Website</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_website" value="<?php echo $row['cont_website'];?>">
														</div>
														<label class="col-md-2 control-label">Email Id</label>
														<div class="col-md-4">
															<input type="text" class="form-control" name="cont_emailid" id="emailid" value="<?php echo $row['cont_emailid'];?>">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-2 control-label">Logo</label>
														<div class="col-md-4">
															<input type="file" name="cont_logo">
															<input type="hidden" name="old_cont_logo" value="<?php echo $row['cont_logo'];?>" />
														</div>
														<?php if($row['cont_logo']!="") { ?>
														<label class="col-md-2 control-label">Uploaded Logo</label>
														<div class="col-md-4">
															<img id="myImgCmp" src="<?php echo base_url().'upload/'.$row['cont_logo'];?>" alt="<?php echo $row['cont_companyname'];?>" width="150" height="100">

															<!-- The Modal -->
															<div id="myModalCmp" class="modal">
															  <span id="closeCmp" class="close">&times;</span>
															  <img class="modal-content" id="img01Cmp">
															  <div id="captionCmp"></div>
															</div>
														</div>
														<?php } ?>
													</div>
													
												<!--</form>-->
											</div><!--PANEL BODY -->
										</div>
										<div class="clearfix">&nbsp;</div>
										<div class="col-sm-offset-5">
											<button  class="btn btn-info" id="submit">Save</button>
										</div>
									</form>
								</div>
							</div>
						</section>
					</div><!-- sm-12 -->
				</div><!--row-->
				<!-- end col -->

			</div>
		</div>


	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<script>
	var resizefunc = [];
	</script>
	<!-- jQuery  -->
	<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/detect.js"></script>
	<script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
	<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
	<!-- Datatables-->
	<!--<script src="<?php echo base_url();?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.bootstrap.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/datatables/dataTables.buttons.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js"></script>-->
	<!-- App js -->
	<script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
	<script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/custombox/dist/custombox.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/custombox/dist/legacy.min.js"></script>
	<script src="<?php echo base_url();?>assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>  
	<!--<script src="<?php echo base_url();?>assets/plugins/fileuploads/js/dropify.min.js"></script>-->
	<script type="text/javascript" src="<?php echo base_url();?>assets/plugins/parsleyjs/dist/parsley.min.js"></script>
	<script type="text/javascript">
	
	$(document).ready(function()
	{
		$("input").keyup(function(){
				$(this).parent().removeClass('has-error');
				$(this).next().empty();
			});
		$('form').parsley();
	})

	$('input#defaultconfig').maxlength()

	$('.form-control').maxlength({
		alwaysShow: true,
		warningClass: "label label-success",
		limitReachedClass: "label label-danger",
		separator: ' out of ',
		preText: 'You typed ',
		postText: '&nbsp;&nbsp;&nbsp;chars available.',
		validate: true
	});

	$('.form-control').maxlength({
		alwaysShow: true,
		warningClass: "label label-success",
		limitReachedClass: "label label-danger"
	});

	</script>

	<script type="text/javascript">
	//   //number..........................
	function isNumberKey(evt)
	{
		var charCode = (evt.which) ? evt.which : event.keyCode
		if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
		return true;
	}

	</script>
	<script>
		// Get the modal
		var modal = document.getElementById('myModal');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById('myImg');
		var modalImg = document.getElementById("img01");
		var captionText = document.getElementById("caption");
		img.onclick = function(){
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementById("close1");

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
			modal.style.display = "none";
		}
		
		//Company Logo
		// Get the modal
		var modal = document.getElementById('myModalCmp');

		// Get the image and insert it inside the modal - use its "alt" text as a caption
		var img = document.getElementById('myImgCmp');
		var modalImg = document.getElementById("img01Cmp");
		var captionText = document.getElementById("captionCmp");
		img.onclick = function(){
			modal.style.display = "block";
			modalImg.src = this.src;
			captionText.innerHTML = this.alt;
		}

		// Get the <span> element that closes the modal
		var span = document.getElementById("closeCmp");

		// When the user clicks on <span> (x), close the modal
		span.onclick = function() { 
			modal.style.display = "none";
		}
	</script>