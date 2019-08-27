<?php $data=$this->db->get('profile')->result();
foreach($data as $r)
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<meta name="author" content="Coderthemes">
<link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/menu.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/core.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/components.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/icons.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/responsive.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url();?>assets/css/portlet.css" rel="stylesheet" type="text/css" />
<style>
.profile-in-header .dropdown-toggle {
background: #da251c;
}
.profile-in-header .dropdown-toggle {
border-style: none solid;
}

.widget-profile .dropdown-toggle {
padding: 9px 10px;
-moz-border-radius: 0;
-webkit-border-radius: 0;
border-radius: 0;
-moz-box-shadow: none;
-webkit-box-shadow: none;
box-shadow: none;
}
.profile-in-header .name {
width: 130px;
}
.widget-profile .name {
display: inline-block;
padding-right: 10px;
vertical-align: middle;
font-size: 15px;
font-weight:bold;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
color:#fff;
}
.widget-profile img {
max-width: 38px;
-moz-border-radius: 50%;
-webkit-border-radius: 50%;
border-radius: 50%;
}

</style>
</head>
<body class="fixed-left">
<div id="wrapper">
<div class="topbar">
<div class="topbar-left">
<div class="text-center">
<?php $userType =  $this->session->userdata('rcbio_usertype');
if($userType=='A')
{
$dashboardLink='dashboard';
}
else
{
$logMenus=$this->db->where('login_id',$this->session->userdata('rcbio_userid'))->get('user_menu')->row();
$dashboardLink=$logMenus->sub_menu_link;
}
?>
<a href="<?php echo base_url().$dashboardLink;?>" class="logo">
<i class="zmdi zmdi-toys icon-c-logo"></i><strong style="font-size:15px;" ><?php echo $r->softwarename;?>
</strong style="font-size:10px;"></strong>
<!--<strong><img src="assets/images/logo.png" alt="logo" style="height: 20px;"></strong>-->
</a>
</div>
</div>
<div class="navbar navbar-default" role="navigation">
<div class="container">
<div class="">
<!-- <div class="pull-left">
<button class="button-menu-mobile open-left waves-effect waves-light">
<i class="zmdi zmdi-menu"></i>
</button>
<strong class="clearfix"></strong>
</div -->

<ul class="nav navbar-nav navbar-right pull-right" style="font-weight: bold;">
<?php $userType =  $this->session->userdata('rcbio_usertype');
if($userType=='A')
{
?>
<li><a href="<?php echo base_url();?>customer"><i class="zmdi zmdi-account"></i> <strong>Add Party</strong> </a></li>
<!-- <li><a href="<?php echo base_url();?>dcbill"><i class="zmdi zmdi-assignment-o"></i> <strong>Add DC</strong> </a></li> -->
<li><a href="<?php //echo base_url();?>expenses"><i class="zmdi zmdi-money-box"></i> <strong>Add Expenses</strong> </a></li>
<li><a href="<?php echo base_url();?>quotation"><i class="zmdi zmdi-assignment-o"></i> <strong>Add Quotation</strong> </a></li>
<!--<li><a href="<?php echo base_url();?>login/logout"><i class="zmdi zmdi-power"></i> <strong>Logout</strong> </a></li>-->
<?php 
}
else
{
$topMenu=$this->db->where('id',$this->session->userdata('rcbio_userid'))->get('login_details')->row();
if(count($topMenu) > 0 )
{
if($topMenu->add_party=='1')
{
echo '<li><a href="'.base_url().'customer"><i class="zmdi zmdi-account"></i> <strong>Add Party </strong> </a></li>';
}
if($topMenu->add_expenses=='1')
{
echo '<li><a href="'.base_url().'expenses"><i class="zmdi zmdi-money-box"></i> <strong>Add Expenses </strong> </a></li>';
}
if($topMenu->add_quotation=='1')
{
echo '<li><a href="'.base_url().'quotation"><i class="zmdi zmdi-assignment-o"></i> <strong>Add Quotation </strong> </a></li>';
}

}
}
?>
<li>
<div class="widget-profile profile-in-header">
<button type="button" data-toggle="dropdown" class="btn dropdown-toggle"><strong class="name"><?php echo $this->session->userdata('rcbio_username'); ?></strong><img src="<?php echo base_url(); ?>assets/images/profile.jpg"></button>
<ul role="menu" class="dropdown-menu">
<!--<li><a href="<?php echo base_url(); ?>index.php/Index_controller/pwdchange"><i class="fa fa-user"></i>Change Password</a></li>-->
<!--<li><a href="javascript:;">&nbsp;</a></li>-->
<li class="power"><a href="<?php echo base_url();?>login/logout"><i class="fa fa-power-off"></i> &nbsp; Log Out</a></li>
</ul>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
<header id="topnav">


<div class="navbar-custom">
<div class="container">
<div id="navigation">
<!-- Navigation Menu-->
<?php $userType =  $this->session->userdata('rcbio_usertype');
if($userType=='A')
{
?>
<ul class="navigation-menu" style="font-size: 13px;">
<li class="has-submenu" id="attendance"> <a href="<?php echo base_url();?>dashboard"><i class="zmdi zmdi-view-dashboard"></i> <strong>Dashboard</strong> </a></li>

<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-view-headline"></i> <strong>Sales</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>invoice">Add Sales</a></li>
<li><a href="<?php echo base_url();?>invoice/view">Sales Reports</a></li>
<!-- <li><a href="<?php echo base_url();?>invoice/pending_view">Pending Amount</a></li>
<li><a href="<?php echo base_url();?>collection_amount/view">Collection Amount</a></li> -->
<li><a href="<?php echo base_url();?>invoice_statement/view">Party statement</a></li>
<!-- <li><a href="<?php //echo base_url();?>tax/view">Tax Reports</a></li> -->
<!-- <li><a href="<?php //echo base_url();?>proforma_invoice">Add Proforma Invoice</a></li>
<li><a href="<?php //echo base_url();?>proforma_invoice/view">Proforma Invoice Reports</a></li> -->
</ul>
</li>
<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-view-headline"></i> <strong>Cash Bill</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>cashbill">Add Cash Bill</a></li>
<li><a href="<?php echo base_url();?>cashbill/listing">Cash Bill Reports</a></li>
</ul>
</li>

<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-cart"></i> <strong>Purchase</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>purchase">Purchase Receipt</a></li>
<li><a href="<?php echo base_url();?>purchase/view">Purchase Reports</a></li>
<!--  <li><a href="<?php echo base_url();?>purchase/pending">Pending Amount</a></li> -->
<!-- <li><a href="<?php echo base_url();?>purchase_pending/view">Paid Amount</a></li> -->
<li><a href="<?php echo base_url();?>purchase_statement/view">Party Statement</a></li>
<li><a href="<?php echo base_url();?>purchasetax/view">Tax Reports</a></li>
<!-- <li><a href="<?php //echo base_url();?>purchaseorder">Purchase Order</a></li>
<li><a href="<?php //echo base_url();?>purchaseorder/view">Purchase Order Reports</a></li>
<li><a href="<?php //echo base_url();?>purchaseorder/pending">Purchase Order Pending</a></li> -->
</ul>
</li>

<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-assignment-o"></i><strong>Voucher</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>voucher">Add Voucher</a></li>
<li><a href="<?php echo base_url();?>voucher/reports">Voucher Reports</a></li>
<li><a href="<?php echo base_url();?>salesreturn">Debit (or) Credit Note</a></li>
<li><a href="<?php echo base_url();?>salesreturn/view">Debit (or) Credit Note Reports</a></li>
</ul>
</li>

<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <strong>Inward</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>inward">Add Inward</a></li>
<!-- <li><a href="<?php echo base_url();?>inward/view">Inward Reports</a></li> -->
<li><a href="<?php echo base_url();?>inward/pending">Inward Stock</a></li>
<!-- <li><a href="#">Inward Stock</a></li> -->
</ul>
</li>

 <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <strong>DC</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>dcbill">Add DC</a></li>
<li><a href="<?php echo base_url();?>dcbill/view">DC Reports</a></li>
<li><a href="<?php echo base_url();?>dcbill/pending">DC Pending</a></li>
</ul>
</li>
<li class="has-submenu" id="attendance"> <a href=<?php echo base_url();?>material_request><i class="zmdi zmdi-shopping-basket"></i> <strong>Material</strong> </a>
<!-- <ul class="submenu"> -->
<!-- <li><a href="#">Backs</a></li>
<li><a href="#">Sweets</a></li> -->
<!-- <li><a href="<?php //echo base_url();?>dcbill/pending">DC Pending</a></li> -->
<!-- </ul> -->
</li>
<!-- <li class="has-submenu" id="attendance"> <a href=<?php echo base_url();?>expenses><i class="zmdi zmdi-shopping-basket"></i> <strong>Expenses</strong> </a> -->
<!-- <ul class="submenu"> -->
<!-- <li><a href="#">Backs</a></li>
<li><a href="#">Sweets</a></li> -->
<!-- <li><a href="<?php //echo base_url();?>dcbill/pending">DC Pending</a></li> -->
<!-- </ul> -->
<!-- </li> -->
<!--  <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <strong>GST Return</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>inward">GST Return</a></li>
<li><a href="#">Inward Reports</a></li>
<li><a href="#">Inward Pending</a></li>
</ul>
</li> -->

<!--<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <strong>Job Order</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>joborder">Job Order</a></li>
<li><a href="<?php echo base_url();?>joborder/view">Job Order Reports</a></li>
<li><a href="<?php echo base_url();?>joborder/pending">Pending Job Orders</a></li>
<li><a href="<?php echo base_url();?>jobinward">Job Inward</a></li>
<li><a href="<?php echo base_url();?>jobinward/view">Job Inward Reports</a></li>
<li><a href="<?php echo base_url();?>vendor">Add Vendors</a></li>
<li><a href="<?php echo base_url();?>vendor/view">Vendors List</a></li>
<li><a href="javascript:void();">Scrap Reports</a></li>

</ul>
</li>-->

<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <strong>Stock</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>stockmaster">Add Stock</a></li>
<li><a href="<?php echo base_url();?>daily_stockreports">Daily Stock Reports</a></li>
<li><a href="<?php echo base_url();?>itemwise_report" target="_blank">Itemwise Reports</a></li>
</ul>
</li>

<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-filter-list"></i><strong>Reports</strong> </a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>customer/view">Party Reports</a></li>

<li><a href="<?php echo base_url();?>expenses/reports">Expenses Reports</a></li>
<li><a href="<?php echo base_url();?>quotation/view">Quotation Reports</a></li>
<li><a href="<?php echo base_url();?>material_request/view">Material Reports</a></li>
</ul>
</li>

<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-settings"></i> <strong>Settings</strong></a>
<ul class="submenu">
<li><a href="<?php echo base_url();?>taxtype">Tax Type</a></li>
<li><a href="<?php echo base_url();?>uom">Add UOM</a></li>
<li><a href="<?php echo base_url();?>itemmaster">Add Item</a></li>
<!--   <li><a href="<?php echo base_url();?>card">Add Card</a></li> -->
<li><a href="<?php echo base_url();?>headers">Account Headers</a></li>  
<li><a href="<?php echo base_url();?>profile">Company Profile</a></li>
<!--  <li><a href="<?php echo base_url();?>user">Create User</a></li>
<li><a href="<?php echo base_url();?>category">Add Category</a></li> -->
<li><a href="<?php echo base_url();?>backup ">Backup Settings</a></li>
<li><a href="<?php echo base_url();?>support ">Support</a></li>
<li><a href="<?php echo base_url();?>usermaster ">User Manager</a></li>
</ul>
</li>
</ul>
<?php
}
else
{
$havingMenus=$this->db->where('login_id',$this->session->userdata('rcbio_userid'))->order_by("id", "asc")->get('user_menu')->result();
if(count($havingMenus) > 0 )
{
echo '<ul class="navigation-menu">';
$mainMenuQuery = $this->db->where('login_id',$this->session->userdata('rcbio_userid'))->order_by("id", "asc")->group_by('main_menu')->get('user_menu')->result();
if(count($mainMenuQuery) > 0 )
{
foreach($mainMenuQuery as $mm)
{
/*$subMenuQueryq = $this->db->where('login_id',$this->session->userdata('rcbio_userid'))->where('main_menu',$mm->main_menu)->get('user_menu')->result();
if(count($subMenuQueryq) > 1 )
{
$mainMenuLink = 'javascript:void(0);';
}
else
{
$mainMenuLink = $mm->sub_menu;
}*/
echo '<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-view-headline"></i> <strong>'.$mm->main_menu.'</strong> </a>';
$subMenuQuery = $this->db->where('login_id',$this->session->userdata('rcbio_userid'))->where('main_menu',$mm->main_menu)->get('user_menu')->result();
if(count($subMenuQuery) > 0 )
{
echo '<ul class="submenu">';
foreach($subMenuQuery as $sm)
{
echo '<li><a href="'.base_url().$sm->sub_menu_link.'">'.$sm->sub_menu.'</a></li>';
}
echo '</ul>';
}
echo '</li>';
}
}
echo '</ul>';
}

}
?>
<!-- End navigation menu -->
</div> <!-- end #navigation -->
</div> <!-- end container -->
</div> <!-- end navbar-custom -->
</header>