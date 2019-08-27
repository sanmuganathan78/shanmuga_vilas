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
</head>
<body class="fixed-left">

<div class="clearfix"></div>
    <div id="wrapper">
        <div class="topbar">
            <div class="topbar-left">
                <div class="text-center">
                   <a href="<?php echo base_url();?>dashboard" class="logo">
                        <i class="zmdi zmdi-toys icon-c-logo"></i><span style="font-size:15px;" ><?php echo $r->softwarename;?>
                     </span style="font-size:10px;"></span>
                        <!--<span><img src="assets/images/logo.png" alt="logo" style="height: 20px;"></span>-->
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
                            <span class="clearfix"></span>
                        </div -->
                       
                        <ul class="nav navbar-nav navbar-right pull-right" style="font-weight: bold;">

                            <li><a href="<?php echo base_url();?>customer"><i class="zmdi zmdi-account"></i> <span>Add Party</span> </a></li>

                          <!-- <li><a href="<?php echo base_url();?>dcbill"><i class="zmdi zmdi-assignment-o"></i> <span>Add DC</span> </a></li> -->



                           <li><a href="<?php echo base_url();?>expenses"><i class="zmdi zmdi-money-box"></i> <span>Add Expenses</span> </a></li>

                           <li><a href="<?php echo base_url();?>quotation"><i class="zmdi zmdi-assignment-o"></i> <span>Add Quotation</span> </a></li>

                            <li><a href="<?php echo base_url();?>login/logout"><i class="zmdi zmdi-power"></i> <span>Logout</span> </a></li>
                            
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
                        <ul class="navigation-menu">

                               <li class="has-submenu" id="attendance"> <a href="<?php echo base_url();?>dashboard"><i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span> </a>
                            
                           </li>
                          

                            

                           <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-view-headline"></i> <span>Sales Invoice</span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url();?>invoice">Add Invoice</a></li>
                                <li><a href="<?php echo base_url();?>invoice/view">Invoice Reports</a></li>
                                <!-- <li><a href="<?php echo base_url();?>invoice/pending_view">Pending Amount</a></li>
                                <li><a href="<?php echo base_url();?>collection_amount/view">Collection Amount</a></li> -->
                                <li><a href="<?php echo base_url();?>invoice_statement/view">Party statement</a></li>
                                <li><a href="<?php echo base_url();?>tax/view">Tax Reports</a></li>
                            </ul>
                           </li>

                           <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-cart"></i> <span>Purchase</span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url();?>purchase">Purchase Receipt</a></li>
                                <li><a href="<?php echo base_url();?>purchase/view">Purchase Reports</a></li>
                               <!--  <li><a href="<?php echo base_url();?>purchase/pending">Pending Amount</a></li> -->
                                <!-- <li><a href="<?php echo base_url();?>purchase_pending/view">Paid Amount</a></li> -->

                                  <li><a href="<?php echo base_url();?>purchase_statement/view">Party Statement</a></li>
                                  <li><a href="<?php echo base_url();?>purchasetax/view">Tax Reports</a></li>
                            </ul>
                           </li>

                           <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-assignment-o"></i><span>Voucher</span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url();?>voucher">Add Voucher</a></li>
                                <li><a href="<?php echo base_url();?>voucher/reports">Voucher Reports</a></li>

                                  <li><a href="<?php echo base_url();?>salesreturn">Debit (or) Credit Note</a></li>
                                  <li><a href="<?php echo base_url();?>salesreturn/view">Debit (or) Credit Note Reports</a></li>
                            </ul>
                           </li>

                           <!--<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <span>Inward</span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url();?>inward">Add Inward</a></li>
                                <li><a href="<?php echo base_url();?>inward/view">Inward Reports</a></li>
                                <li><a href="<?php echo base_url();?>inward/pending">Inward Pending</a></li>
                            </ul>
                           </li>-->

                           <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <span>DC</span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url();?>dcbill">Add DC</a></li>
                               <li><a href="<?php echo base_url();?>dcbill/view">DC Reports</a></li>
                                <li><a href="<?php echo base_url();?>dcbill/pending">DC Pending</a></li>
                            </ul>
                           </li>

                          <!--  <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <span>GST Return</span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url();?>inward">GST Return</a></li>
                                <li><a href="#">Inward Reports</a></li>
                                <li><a href="#">Inward Pending</a></li>
                            </ul>
                           </li> -->

                           <!--<li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <span>Job Order</span> </a>
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

                                                     

                           <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-shopping-basket"></i> <span>Stock</span> </a>
                            <ul class="submenu">
                                <li><a href="<?php echo base_url();?>stockmaster">Add Stock</a></li>
                                <li><a href="<?php echo base_url();?>daily_stockreports">Daily Stock Reports</a></li>
                                <li><a href="<?php echo base_url();?>itemwise_report">Itemwise Reports</a></li>
                            </ul>
                           </li>

                           
                           <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-filter-list"></i><span>Reports</span> </a>
                            <ul class="submenu">
                               <li><a href="<?php echo base_url();?>customer/view">Party Reports</a></li>
                                
                                <li><a href="<?php echo base_url();?>expenses/reports">Expenses Reports</a></li>
                                 <li><a href="<?php echo base_url();?>quotation/view">Quotation Reports</a></li>
                            </ul>
                           </li>
                            

                         

                           <li class="has-submenu" id="attendance"> <a href="javascript:void(0);"><i class="zmdi zmdi-settings"></i> <span>Settings</span></a>
                            <ul class="submenu">
                                  <li><a href="<?php echo base_url();?>taxtype">Tax Type</a></li>
                            <li><a href="<?php echo base_url();?>uom">Add UOM</a></li>
                                <li><a href="<?php echo base_url();?>itemmaster">Add Item</a></li>
                               <!--   <li><a href="<?php echo base_url();?>card">Add Card</a></li> -->
                                 <li><a href="<?php echo base_url();?>headers">Account Headers</a></li>  
                                 <li><a href="<?php echo base_url();?>profile">Company Profile</a></li>
                               <!--  <li><a href="<?php echo base_url();?>user">Create User</a></li> -->
                                <li><a href="<?php echo base_url();?>category">Add Category</a></li>
                                <li><a href="<?php echo base_url();?>backup ">Backup Settings</a></li>
								<li><a href="<?php echo base_url();?>support ">Support</a></li>
                            </ul>
                           </li>
                        </ul>
                        <!-- End navigation menu -->
                    </div> <!-- end #navigation -->
                </div> <!-- end container -->
            </div> <!-- end navbar-custom -->
        </header>