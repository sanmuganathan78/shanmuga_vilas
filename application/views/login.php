<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="Coderthemes">
		<!-- App title -->
		<?php $data=$this->db->get('profile')->result();
		foreach($data as $r)
		?>
		<title> <?php echo $r->companyname;?></title>
		<!-- App CSS -->
		<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/components.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/pages.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/menu.css" rel="stylesheet" type="text/css" />
		<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
		<script src="<?php echo base_url();?>assets/js/modernizr.min.js"></script>
	</head>
	<body style="background-image: url(assets/images/bakery.jpg);background-size: cover;overflow-y: hidden;">

		<div class="text-center logo-alt-box" style="margin-top: 0px;">
			<a href="#" class="logo"><span><span> &nbsp;</span></span></a>
		</div>
		<div class="wrapper-page">
			<div class="m-t-30 card-box">
				<div class="text-center">
					<h4 class="text-uppercase font-bold m-b-0" style="color: #f40c22;font-size: 21px;"><?php echo $r->companyname;?></h4>            
				</div>
				<br>
				<?php $msg = $this->session->flashdata('msg'); if((isset($msg)) && (!empty($msg))) { ?>
				<div class="alert alert-micro alert-info pastel light dark" >
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php print_r($msg); ?>
				</div>
				<?php } ?>
				<?php $msg = $this->session->flashdata('msg1'); if((isset($msg)) && (!empty($msg))) { ?>
				<div class="alert alert-danger alert-micro">
					<a href="#" class="close" data-dismiss="alert">&times;</a>
					<?php print_r($msg); ?>
				</div>
				<?php } ?>
				<div class="panel-body">
					<form class="form-horizontal m-t-10" method="post" action="<?php echo base_url();?>login/validate" >

						<div class="form-group ">
							<div class="col-xs-12">
								<input class="form-control" type="text"  name="username" id="username" placeholder="Username">
								<span id="username_valid"></span>
							</div>
						</div>

						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" type="password" name="password" id="password"  placeholder="Password">
								<div id="password_valid"></div>
							</div>
						</div>

						<div class="form-group ">
							<div class="col-xs-6">
								<div class="checkbox checkbox-custom">
									<input id="remember" type="checkbox">
									<label for="checkbox-signup">
										Remember me
									</label>
								</div>

							</div>
							<div class="col-xs-6" style="margin-top: 7px;">
								<a href="<?php echo base_url().'reset_password';?>">Reset Password</a>
							</div>
						</div>

						<div class="form-group text-center m-t-30">
							<div class="col-xs-12">
								<button class="btn btn-custom btn-bordred btn-block waves-effect waves-light text-uppercase" id="submit" type="submit"><b>Log In</b></button>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="m-t-30 card-box" style="visibility: hidden;">
			</div>
			<div class="m-t-30 card-box" style="visibility: hidden;">
			</div>
			<div class="m-t-30 card-box" style="visibility: hidden;">
			</div>
			
		</div>
		<script>
		var resizefunc = [];
		</script>

		<!-- jQuery  -->
		<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/detect.js"></script>
		<script src="<?php echo base_url();?>assets/js/fastclick.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.blockUI.js"></script>
		<script src="<?php echo base_url();?>assets/js/waves.js"></script>
		<script src="<?php echo base_url();?>assets/js/wow.min.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.nicescroll.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.scrollTo.min.js"></script>

		<!-- App js -->
		<script src="<?php echo base_url();?>assets/js/jquery.core.js"></script>
		<script src="<?php echo base_url();?>assets/js/jquery.app.js"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#submit').click(function(){
				var username=$('#username');
				var password=$('#password');
				if(username.val()=='')
				{
					username.focus();
					$('#username_valid').html('<span><font color="red">Please Enter the Email</span>');
					username.keyup(function(){ $('#username_valid').html(''); });
					return false;
				}
				if(password.val()=='')
				{
					password.focus();
					$('#password_valid').html('<span><font color="red">Please Enter The Password');
					password.keyup(function(){ $('#password_valid').html(''); });
					return false;
				}

			});
		});
		
		
		$(function() {
			if (localStorage.chkbx && localStorage.chkbx != '') {
				$('#remember').attr('checked', 'checked');
				$('#username').val(localStorage.usrname);
				$('#password').val(localStorage.pass);
			} 
			else
			{
				$('#remember').removeAttr('checked');
				$('#username').val('');
				$('#password').val('');
			}

			$('#remember').click(function() {
				if ($('#remember').is(':checked')) {
					// save username and password
					localStorage.usrname = $('#username').val();
					localStorage.pass = $('#password').val();
					localStorage.chkbx = $('#remember').val();
				} 
				else 
				{
					localStorage.usrname = '';
					localStorage.pass = '';
					localStorage.chkbx = '';
				}
			});
		});
		</script>
	</body>
</html>