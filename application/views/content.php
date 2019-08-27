	<style>
		.mci
		{
			color: #fcfcfc;
			border: 1px solid #29166f;
			padding: 12px;
			background-color: #29166f;
		}
	</style>
	<?php $data=$this->db->get('profile')->result();
	foreach($data as $r)
	?>
	<title> <?php echo $r->companyname;?></title>
	<div class="content-page">
	<div class="content">
	<div class="container">
	<div class="row">
		<div class="col-sm-12">
			<ul class="nav nav-pills nav-pills-custom display-xs-none pull-right">
				<li role="presentation"><a href="#">Today</a></li>
				<li role="presentation" class="active"><a href="#"><?php  echo date('l jS \of F Y');?></a></li>
			</ul>
			<h4 class="page-title">Dashboard</h4>
		</div>
	</div>
	<?php 
	$count=count($cus);
	$count1=count($sup);?>
	<!-- <div class="row">
		<?php
	/*
		foreach ($invoice as $row) {
			@$sales[]=$row['grandtotal'];
			@$paid[]=$row['paid'];
			@$balance[]=$row['balance'];
		}
		@$sales1=array_sum($sales);
		@$paid1=array_sum($paid);
		@$balance1=array_sum($balance);*/
		?>
		<div class="col-lg-5">
			<div class="card-box">
				<div class="dropdown pull-right"></div>
				<h4 class="header-title m-t-0">Total Sales</h4>
				<div class="row text-center m-t-30">
					<div class="col-xs-3">
						<h3 ><?php echo number_format($sales);?></h3>
						<p class="text-muted text-overflow">Sales</p>
					</div>
					<div class="col-xs-3">
						<h3 ><?php echo number_format($receivable);?></h3>
						<p class="text-muted text-overflow" title="Receivable">Receivable</p>
					</div>
					<div class="col-xs-3">
						<h3 ><?php echo number_format($salesBalance);?></h3>
						<p class="text-muted text-overflow">Balance</p>
					</div>
					<div class="col-xs-3">
						<h3 ><?php echo number_format($curMonthSales);?></h3>
						<p class="text-muted text-overflow">Current Month Sales</p>
					</div>
				</div>
			</div>
		</div>

		<?php
		/*foreach ($purchase as $row) {
			@$saless[]=$row['grandtotal'];
			@$paids[]=$row['paid'];
			@$balances[]=$row['balance'];
		}
		@$sales11=array_sum($saless);
		@$paid11=array_sum($paids);
		@$balance11=array_sum($balances);*/
		?>
		<div class="col-lg-5">
			<div class="card-box">
				<div class="dropdown pull-right"></div>
				<h4 class="header-title m-t-0">Total Purchase</h4>
				<div class="row text-center m-t-30">
					<div class="col-xs-3">
						<h3 ><?php echo number_format($purchase);?></h3>
						<p class="text-muted text-overflow"> Purchase</p>
					</div>
					<div class="col-xs-3">
						<h3 ><?php echo number_format($payable);?></h3>
						<p class="text-muted text-overflow" title="Payable">Payable</p>
					</div>
					<div class="col-xs-3">
						<h3 ><?php echo number_format($purchaseBalance);?></h3>
						<p class="text-muted text-overflow">Balance</p>
					</div>
					<div class="col-xs-3">
						<h3 ><?php echo number_format($curMonthpurchase);?></h3>
						<p class="text-muted text-overflow">This Month Purchase</p>
					</div>
				</div>
			</div>
		</div>
		
		
			<div class="col-lg-2">
			<div class="card-box">
				<div class="dropdown pull-right"></div>
				<h4 class="header-title m-t-0">Expenses</h4>
				<div class="row text-center m-t-30">
					<div class="col-xs-6">
						<h3 ><?php echo number_format($totalExpenses);?></h3>
						<p class="text-muted text-overflow"> Total Expenses</p>
					</div>
					<div class="col-xs-6">
						<h3 ><?php echo number_format($currExpenses);?></h3>
						<p class="text-muted text-overflow" title="This Month Expenses">This Month Expenses</p>
					</div>
				</div>
			</div>
		</div>
		

	</div> -->
	
	<div class="row">
	
		<div class="col-lg-4">
			<div class="card-box">
				<div class="dropdown pull-right"></div>
				<h4 class="header-title m-t-0">Sales</h4>
				<div class="row text-center m-t-30">
					<a href="<?php echo base_url();?>invoice">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-assignment-o mci"></i></h2>
							<p class="text-muted text-overflow">Sales</p>
						</div>
					</a>
					<a href="<?php echo base_url();?>invoice/view">
						<div class="col-xs-6">
							<h2 ><i class="zmdi zmdi-collection-text mci"></i></h2>
							<p class="text-muted text-overflow">Reports</p>
						</div>
					</a>
				</div>
			</div>
		</div>
		
		<div class="col-lg-4">
			<div class="card-box">
				<h4 class="header-title m-t-0">Purchase</h4>
				<div class="row text-center m-t-30">
					<a href="<?php echo base_url();?>purchase">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-shopping-cart mci"></i></h2>
							<p class="text-muted text-overflow">Purchase</p>
						</div>
					</a>
					<a href="<?php echo base_url();?>purchase/view">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
							<p class="text-muted text-overflow">Reports</p>
						</div>
					</a>
				</div>
			</div>
		</div>

		<div class="col-lg-4">
			<div class="card-box">
				<h4 class="header-title m-t-0">Voucher</h4>
				<div class="row text-center m-t-30">
					<a href="<?php echo base_url();?>voucher">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-money-box mci"></i></h2>
							<p class="text-muted text-overflow">Voucher</p>
						</div>
					</a>
					<a href="<?php echo base_url();?>voucher/reports">
						<div class="col-xs-6">
							<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
							<p class="text-muted text-overflow">Reports</p>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div> 
	<div class="row">
	<div class="col-lg-4">
		<div class="card-box">
			<div class="dropdown pull-right"></div>
			<h4 class="header-title m-t-0">Expenses</h4>
			<div class="row text-center m-t-30">
				<a href="<?php echo base_url();?>expenses">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-money-box mci"></i></h2>
						<p class="text-muted text-overflow">Expenses</p>
					</div>
				</a>
				<a href="<?php echo base_url();?>expenses/reports">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
						<p class="text-muted text-overflow">Reports</p>
					</div>
				</a>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="card-box">
			<div class="dropdown pull-right"></div>
			<h4 class="header-title m-t-0">Delivery Challan</h4>
			<div class="row text-center m-t-30">
				<a href="<?php echo base_url();?>dcbill">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-assignment-o mci"></i></h2>
						<p class="text-muted text-overflow">Delivery Challan</p>
					</div>
				</a>
				<a href="<?php echo base_url();?>dcbill/view">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
						<p class="text-muted text-overflow">Reports</p>
					</div>
				</a>
			</div>
		</div>
	</div>
	
	<div class="col-lg-4">
		<div class="card-box">
			<div class="dropdown pull-right"></div>
			<h4 class="header-title m-t-0">Quotation</h4>
			<div class="row text-center m-t-30">
				<a href="<?php echo base_url();?>quotation">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-shopping-basket mci"></i></h2>
						<p class="text-muted text-overflow">Quotation</p>
					</div>
				</a>
				<a href="<?php echo base_url();?>quotation/view">
					<div class="col-xs-6">
						<h2><i class="zmdi zmdi-collection-text mci"></i></h2>
						<p class="text-muted text-overflow">Reports</p>
					</div>
				</a>
			</div>
		</div>
	</div>
	</div>
	</div> 
	</div> 

	</div>
		<div class="side-bar right-bar">
			<a href="javascript:void(0);" class="right-bar-toggle"><i class="zmdi zmdi-close-circle-o"></i></a>
			<h4 class="">Notifications</h4>
			<div class="notification-list nicescroll">
				<ul class="list-group list-no-border user-list">
					<li class="list-group-item">
						<a href="#" class="user-list-item">
							<div class="avatar"><img src="assets/images/users/avatar-2.jpg" alt=""></div>
							<div class="user-desc">
								<span class="name">Michael Zenaty</span>
								<span class="desc">There are new settings available</span>
								<span class="time">2 hours ago</span>
							</div>
						</a>
					</li>
					<li class="list-group-item">
						<a href="#" class="user-list-item">
							<div class="icon"><i class="zmdi zmdi-account"></i></div>
							<div class="user-desc">
								<span class="name">New Signup</span>
								<span class="desc">There are new settings available</span>
								<span class="time">5 hours ago</span>
							</div>
						</a>
					</li>
					<li class="list-group-item">
						<a href="#" class="user-list-item">
							<div class="icon"><i class="zmdi zmdi-comment"></i></div>
							<div class="user-desc">
								<span class="name">New Message received</span>
								<span class="desc">There are new settings available</span>
								<span class="time">1 day ago</span>
							</div>
						</a>
					</li>
					<li class="list-group-item">
						<a href="#" class="user-list-item">
							<div class="avatar">
								<img src="assets/images/users/avatar-3.jpg" alt="">
							</div>
							<div class="user-desc">
								<span class="name">James Anderson</span>
								<span class="desc">There are new settings available</span>
								<span class="time">2 days ago</span>
							</div>
						</a>
					</li>
					<li class="list-group-item active">
						<a href="#" class="user-list-item">
							<div class="icon"><i class="zmdi zmdi-settings"></i></div>
							<div class="user-desc">
								<span class="name">Settings</span>
								<span class="desc">There are new settings available</span>
								<span class="time">1 day ago</span>
							</div>
						</a>
					</li>
				</ul>
			</div>
		</div>
	</div>
	<script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
	<!-- var resizefunc = []; -->
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
	<!--Start of Tawk.to Script-->
<script type="text/javascript">
// var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
// (function(){
// var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
// s1.async=true;
// s1.src='https://embed.tawk.to/57d9511fcccb3b470ce185bf/default';
// s1.charset='UTF-8';
// s1.setAttribute('crossorigin','*');
// s0.parentNode.insertBefore(s1,s0);
// })();
 </script>
<!--End of Tawk.to Script-->
