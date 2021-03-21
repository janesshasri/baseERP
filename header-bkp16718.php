<?php
include("database/db_conection.php");//make connection here

session_start();
//include('login.php'); // Includes Login Script

// This Code will not allow user without login 
if($_SESSION['userid']==""){
    header('Location:login.php');
}
// Login Check end

if(isset($_SESSION['login_email'])){
    $userid = $_SESSION['userid'];
    $sq = "select username from userprofile where id='$userid'";
    $result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
    //$count = mysqli_num_rows($result);
    $rs = mysqli_fetch_assoc($result);
    $session_user = $rs['username'];
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>MyProj </title>
        <meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
        <meta name="author" content="Pike Web Development - https://www.pikephp.com">

        <!-- Favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- Bootstrap CSS -->
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

        <!-- Font Awesome CSS -->
        <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />

        <!-- Custom CSS -->
        <link href="assets/css/style.css" rel="stylesheet" type="text/css" />

        <!-- BEGIN CSS for this page -->
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
        <!-- END CSS for this page -->

        <!-- Line Items Link-->											 
        <!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->	
        <script src="assets/js/modernizr.min.js"></script>
        <script src="assets/js/jquery.min.js"></script>
        <script src="assets/js/moment.min.js"></script>
        <script src="assets/js/main.js"></script>



        <!-- BEGIN CSS for this page -->
        <style>
            .parsley-error {
                border-color: #ff5d48 !important;
            }
            .parsley-errors-list.filled {
                display: block;
            }
            .parsley-errors-list {
                display: none;
                margin: 0;
                padding: 0;
            }
            .parsley-errors-list > li {
                font-size: 12px;
                list-style: none;
                color: #ff5d48;
                margin-top: 5px;
            }
            .form-section {
                padding-left: 15px;
                border-left: 2px solid #FF851B;
                display: none;
            }
            .form-section.current {
                display: inherit;
            }
        </style>
        <!-- END CSS for this page -->

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>	
        <style>	
            td.details-control {
                background: url('assets/plugins/datatables/img/details_open.png') no-repeat center center;
                cursor: pointer;
            }
            tr.shown td.details-control {
                background: url('assets/plugins/datatables/img/details_close.png') no-repeat center center;
            }
        </style>		

    </head>

    <body class="adminbody">
				<!-- Large modal -->
								<div class="modal fade bd-example-modal-lg2" tabindex="-1" role="dialog" aria-hidden="true">
								  <div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
										<h5 class="modal-title">Large title</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
										</div>
										<div class="modal-body">
										  <a title="Clcik to visit Pike Admin Website" target="_blank" href="helpDocs.php" 
										  >
                                     Visit FAQs?
                                </a>

</div>
										<div class="modal-footer">
										<button type="button" class="btn btn-primary">Save changes</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									  </div>
									</div>
								  </div>
								</div>
        <div id="main">


            <!-- top bar navigation -->
            <div class="headerbar">

                <!-- LOGO -->
                <div class="headerbar-left">
                    <a href="index.php" class="logo"><img alt="Logo" src="assets/images/logo.jpg" /> <span>MyProj</span></a>
                </div>



                <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">                        

						
								<li class="list-inline-item dropdown notif">
								
                            <a class="nav-link dropdown-toggle arrow-none" data-target=".bd-example-modal-lg2"  data-toggle='modal' href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-plus-circle bigfonts" aria-hidden="false"></i></a>
                           	
								<!--a href="#custom-modal" data-target=".bd-example-modal-lg" data-toggle="modal"> 
								<i class="fa fa-plus-circle bigfonts" aria-hidden="false"></i></a-->
								
				

								
								
								</li>
								
								

								
								
								
								<li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-cog bigfonts" aria-hidden="true"></i></a>


                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-question-circle"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small>Help and Support</small></h5>
                                </div>

                                <!-- item-->
                                <a target="_blank" href="" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Do you need help ? Please do contact</b>
                                        <span>Contact Us</span>
                                    </p>
                                </a>

                                <!-- item-->
                                <a target="_blank" href="" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Mobile: +91 9677573737</b><br/>
                                        Email: saravanas.office@gmail.com
                                        <span></span>
                                    </p>
                                </a>                               

                                <!-- All-->
                                <a title="Clcik to visit Pike Admin Website" target="_blank" href="helpDocs.php" class="dropdown-item notify-item notify-all">
                                    <i class="fa fa-link"></i> Visit FAQs?
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-envelope-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-arrow-success dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger pull-xs-right">12</span>Contact Messages</small></h5>
                                </div>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Jokn Doe</b>
                                        <span>New message received</span>
                                        <small class="text-muted">2 minutes ago</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Michael Jackson</b>
                                        <span>New message received</span>
                                        <small class="text-muted">15 minutes ago</small>
                                    </p>
                                </a>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">                                    
                                    <p class="notify-details ml-0">
                                        <b>Foxy Johnes</b>
                                        <span>New message received</span>
                                        <small class="text-muted">Yesterday, 13:30</small>
                                    </p>
                                </a>

                                <!-- All-->
                                <a href="#" class="dropdown-item notify-item notify-all">
                                    View All
                                </a>

                            </div>
                        </li>

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle arrow-none" data-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <i class="fa fa-fw fa-bell-o"></i><span class="notif-bullet"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-arrow dropdown-lg">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5><small><span class="label label-danger pull-xs-right">5</span>Allerts</small></h5>
                                </div>

                                <!-- item-->
                                <a href="#" class="dropdown-item notify-item">
                                    <div class="notify-icon bg-faded">
                                        <img src="assets/images/avatars/avatar2.png" alt="img" class="rounded-circle img-fluid">
                                    </div>
                                    <p class="notify-details">
                                        <b>John Doe</b>
                                        <span>User registration</span>
                                        <small class="text-muted">3 minutes ago</small>
                                    </p>
                                </a>
                            </div>
                        </li>

                        <li class="list-inline-item dropdown notif">						
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" 
                               role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/avatars/admin.png" alt="Profile image" class="avatar-rounded"></a>



                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small><?php if(isset($_SESSION['login_email'])){ echo $_SESSION['login_email']; } ?></small> </h5>
                                </div>

                                <!-- item-->
                                <a href="myProfile.php" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>My Profile</span>
                                </a>

                                <a href="changePassword.php" class="dropdown-item notify-item">
                                    <i class="fa fa-unlock" aria-hidden="true"></i><span>Change PWD</span>
                                </a>

                                <!-- item-->
                                <a href="logout.php" class="dropdown-item notify-item">
                                    <i class="fa fa-power-off"></i><span>Logout</span>  
                                </a>


                                <!-- item-->
                            </div>
                        </li>

                    </ul>

                    <ul class="list-inline menu-left mb-0">
                        <li class="float-left">
                            <button class="button-menu-mobile open-left">
                                <i class="fa fa-fw fa-bars"></i>
                            </button>
                        </li>                        
                    </ul>

                </nav>

            </div>
            <!-- End Navigation -->


            <!-- Left Sidebar -->
            <div class="left main-sidebar">

                <div class="sidebar-inner leftscroll">

                    <div id="sidebar-menu">

                        <ul>

                            <li class="submenu">
                                <a  href="index.php"><i class="fa fa-dashboard"></i><span> Dashboard </span> </a>
                                <!--i class="fa fa-fw fa-bars"></i-->
                            </li>

                            <li class="submenu">
                                <a href="charts.html"><i class="fa fa-fw fa-area-chart"></i><span> Charts </span> </a>
                            </li>

                            <li class="submenu">
                                <a href="#"><i class="fa fa-users"></i>People<span class="menu-arrow"></span></a>						
                                <ul class="list-unstyled">  
                                    <li><a href="listCustomerProfile.php"><i class="fa fa-circle-o"></i>list Customer</a> <li>
                                    <li><a href="addCustomerProfile.php"><i class="fa fa-user-plus bigfonts" aria-hidden="true"></i>Customer Profile</a> <li>										

                                    </li>
                                    <li class="submenu">
                                        <a href="#"><i class="fa fa-truck smallfonts" aria-hidden="true"></i><span>Suppliers</span> <span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">
                                            <li><a href="listSupplierCode.php"><i class="fa fa-circle-o"></i>list Supp Types</a></li>
                                            <li><a href="addSupplierCodeMaster.php"><i class="fa fa-user-plus bigfonts" aria-hidden="true"></i> Supplier Type</a></li>
                                            <li><a href="listVendorProfile.php"><i class="fa fa-circle-o"></i>list Vendors</a></li>	
                                            <li><a href="addVendorProfile.php"><i class="fa fa-user-plus bigfonts" aria-hidden="true"></i>Vendor Profile</a></li>
                                            <li><a href="listSupplierBankDetails.php"><i class="fa fa-circle-o"></i>List Bank Details</a></li>
                                            <li><a href="addSupplierBankDetails.php"><i class="fa fa-circle-o"></i>add Bank Details</a></li>
                                        </ul>
                                    </li>
                                </ul>

                            <li class="submenu">
                                <a href="#"><i class="fa fa-th-list bigfonts" aria-hidden="true"></i><span>Masters</span></a>
                                <ul class="list-unstyled">	
                                    <li><a href="addExpenseAccountMaster.php"><i class="fa fa-plus-circle"></i>Expense AcctName</a></li>
                                    <li><a href="listTaxMaster.php"><i class="fa fa-circle-o"></i>listTaxMaster</a></li>
                                    <li><a href="addTaxMaster.php"><i class="fa fa-plus-circle"></i>add Tax(GST)</a></li>
                                    <li><a href="listTransportMaster.php"><i class="fa fa-circle-o"></i>list Transport</a></li>
                                    <li><a href="addTransportMaster.php"><i class="fa fa-plus-circle"></i>add Transport</a></li>	
                                    <li><a href="listPaymentTermMaster.php"><i class="fa fa-circle-o"></i> list Payment Term</a></li>
                                    <li><a href="addPaymentTermMaster.php"><i class="fa fa-plus-circle"></i> add Payment Term</a></li>
                                    <li><a href="listItemCategory.php"><i class="fa fa-circle-o"></i>list Item Category</a></li>
                                    <li><a href="addItemCategory.php"><i class="fa fa-plus-circle"></i>Add Item Category</a></li>
                                    <li><a href="addLocationMaster.php"><i class="fa fa-plus-circle"></i>add Location</a></li>	
                                    <li><a href="listLocation.php"><i class="fa fa-circle-o"></i>list Location</a></li>
                                    <li><a href="addWarehouseMaster.php"><i class="fa fa-plus-circle"></i>add Warehouse</a></li>	
                                    <li><a href="listWarehouse.php"><i class="fa fa-circle-o"></i>list Warehouses</a></li>
                                    <li><a href="listCustomerType.php"><i class="fa fa-circle-o"></i>list Customer Type</a></li>								
                                    <li><a href="addCustomerType.php"><i class="fa fa-plus-circle"></i>add Customer Type</a></li>	

                                </ul>
                            </li>

                            <li class="submenu">
                                <a href="#"><i class="fa fa-building-o bigfonts" aria-hidden="true"></i>Inventory <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">								
                                    <li><a href="listPurchaseItemMaster.php"><i class="fa fa-circle-o"></i>list Product Inward</a></li>
                                    <li><a href="addPurchaseItemMaster.php"><i class="fa fa-plus-circle"></i>Product Inward</a></li>
                                    <li><a href="listSalesItemMaster.php"><i class="fa fa-circle-o"></i>list Product Outward</a></li>
                                    <li><a href="addSalesItemMaster.php"><i class="fa fa-plus-circle"></i>Product Outward</a></li>
                                    <li class="submenu">
                                        <a href="#" >STOCK TRANSFERS<span class="menu-arrow"></span> </a>
                                        <ul class="list-unstyled">	
                                            <li><a href="transferProductInward.php"><i class="fa fa-plus-circle"></i>Transfer Stock Inward</a></li>
                                            <li><a href="listtransferProductInward.php"><i class="fa fa-circle-o"></i>list Transfers</a></li>
                                            <!--li><a href="MaterialTransfer.php"><i class="fa fa-plus-circle"></i>Transfers</a></li>	
<li><a href=""><i class="fa fa-circle-o"></i>list Transfers</a></li-->								
                                        </ul>
                                </ul>
                            </li>



                            <li class="submenu">
                                <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Purchase <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">								
                                    <li><a href="addPurchaseOrder.php"><i class="fa fa-plus-circle"></i>Purchase Orders</a></li>
                                    <li><a href="listPurchaseOrders.php"><i class="fa fa-circle-o"></i>list Purchase Order</a></li>

                                    <li class="submenu">
                                        <a href="#"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i><span>Expenses</span><span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">								
                                            <li><a href="listExpenses.php"><i class="fa fa-circle-o"></i>list Expenses</a></li>								
                                            <li><a href="addExpenses.php"><i class="fa fa-plus-circle"></i>add Expense</a></li>								
                                            <!--li><a href=""><i class="fa fa-circle-o"></i>list Accounts</a></li-->
                                        </ul>
                                    </li>		
                                </ul>

                            <li class="submenu">
                                <a href="#"><i class="fa fa-truck smallfonts" aria-hidden="true"></i><span>GRN</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">
                                    <li><a href="addGoodsReceiptNote.php"><i class="fa fa-plus-circle"></i>add GRN</a></li>
                                    <li><a href="listGoodsReceiptNote.php"><i class="fa fa-circle-o"></i>List GRN</a></li>      
                                    <li><a href="listDebitNotes.php"><i class="fa fa-circle-o"></i>List Debit Notes</a></li>
                                    <li class="submenu">
                                        <a href="#"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i> <span><b>Payments</b></span> <span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">								
                                            <li>
                                                <a href="addVendorPayments.php"><b><i class="fa fa-plus-circle"></i>Make Payments</b></a>
                                            </li>
                                            <li><a href="listPaymentsMade.php"><b><i class="fa fa-circle-o"></i>Payments Made</b></a></li>						
                                        </ul>					

                                    <li class="submenu">
                                        <a href="addVendorCredits.php"> <span><b><i class="fa fa-plus-circle"></i>Vendor Credits</b></span> <span class="menu-arrow"></span></a>
                                        <a href="listVendorCredits.php"><b><i class="fa fa-circle-o"></i>List Vendor Credits</b></a>
                                        <a href="listVendorRefunds.php"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i><b>Refund History</b></a>
                                    </li>

                                </ul>

                            <li class="submenu">
                                <a href="#"><i class="fa fa-shopping-cart"></i><span>Sales</span> <span class="menu-arrow"></span></a>

                                <ul class="list-unstyled">
                                    <li><a href="addEstimate.php"><i class="fa fa-plus-circle"></i>Estimates</a> <li>
                                    <li><a href="listEstimates.php"><i class="fa fa-circle-o"></i>List Estimates</a> <li>
                                    <li><a href="addSalesOrder.php"><i class="fa fa-plus-circle"></i>Sales Orders</a> <li>
                                    <li><a href="listSalesOrders.php"><i class="fa fa-circle-o"></i>list Sales Orders</a> <li>	

                                    <li class="submenu">
                                        <a href="#"><i class="fa fa-file-text-o bigfonts" aria-hidden="true"></i><b> Invoices </b><span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">								
                                            <li><a href="addInvoice.php"><b><i class="fa fa-plus-circle"></i>Invoice</b></a></li>						
                                            <li><a href="listInvoices.php"><b><i class="fa fa-circle-o"></i>list Invoices</b>	</a></li>
                                            <li><a href="addCashMemo.php"><b><i class="fa fa-plus-circle"></i>Cash Memo</b></a></li>						
                                            <li><a href="#"><i class="fa fa-circle-o"></i>list Cash Memos</a></li>											
                                        </ul>	

                                    <li class="submenu">
                                        <a href="#"><i class="fa fa-truck smallfonts" aria-hidden="true"></i> <span><b>Delivery Challan</b></span> <span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">								
                                            <li><a href="addDeliveryChallan.php"><b><i class="fa fa-plus-circle"></i>Delivery Challan</b></a></li>						
                                            <li><a href="listDeliveryChallan.php"><b><i class="fa fa-circle-o"></i>list Delivery Challan</b></a></li>						
                                        </ul>					

                                    <li class="submenu">
                                        <a href="#"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i><b>CustomerPayment</b><span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">								
                                            <li><a href="addCustomerReceipts.php"><i class="fa fa-plus-circle"></i>Receive Payment</a></li>
                                            <li><a href="listCustomerPayments.php"><i class="fa fa-circle-o"></i>Payments Made</a></li>						
                                        </ul>	
                                    <li class="submenu">
                                        <a href="#"> <i class="fa fa-user-plus bigfonts" aria-hidden="true"></i><b>Credit Notes</b> <span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">
                                            <li> <a href="addCreditNotes.php"> <i class="fa fa-plus-circle"></i><b>Credit Notes</b></a> </li>
                                            <li><a href="listCreditNotes.php"><i class="fa fa-circle-o"></i>list Credit Notes</a></li>
                                            <li><a href="addCustomerRefund.php"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i>Refund History</a></li>
                                        </ul>


                                        <ul class="list-unstyled">								

                                        </ul>										
                                </ul>
                            </li>	


                            <!--li class="submenu">
<a href="#"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i><span>Accounts Receivables<span class="menu-arrow"></span></a>
<ul class="list-unstyled">								
<li><a href="addCustomerBankDetails.html"><i class="fa fa-circle-o"></i>add Bank Details</a></li>								
<li><a href=""><i class="fa fa-circle-o"></i>list Bank Details</a></li>
<li><a href="addCustomerAccounts.html"><i class="fa fa-circle-o"></i>Customer Accounts</a> <li>
<li><a href=""><i class="fa fa-circle-o"></i>list Accounts</a></li>
</ul>
</li-->	

                            <li class="submenu">
                                <a href="#"><i class="fa fa-bar-chart-o"></i><span>Reports</span><span class="menu-arrow"></span></a>	
                                <ul class="list-unstyled">								
                                    <li><a href=""><i class="fa fa-circle-o"></i><b>Purchase Stock</b></a></li>						
                                    <li><a href=""><i class="fa fa-circle-o"></i><b>Product Stock</b></a></li>
                                    <li><a href=""><i class="fa fa-circle-o"></i>Supplier Accounts</a> <li>
                                    <li><a href=""><i class="fa fa-circle-o"></i>Customer Accounts</a></li>
                                    <li><a href=""><i class="fa fa-circle-o"></i>Sales</a></li>

                                </ul>
                            </li>											


                            <li class="submenu">
                                <a class="pro" href="#"><i class="fa fa-user bigfonts" aria-hidden="true"></i><span>Users & Controls</span> <span class="menu-arrow"></span></a>
                                <ul class="list-unstyled">								
                                    <li><a style="color:orange" href="listUsers.php"><i class="fa fa-circle-o"></i>list Users</a></li>
                                    <li><a style="color:orange" href="addUsers.php"><i class="fa fa-user-plus bigfonts" aria-hidden="true"></i>add Users</a></li>
                                    <li><a style="color:orange"  href="addUserGroup.php"><i class="fa fa-chain"></i>add User Groups</a></li>
                                    <li><a style="color:orange" href="listUserGroups.php"><i class="fa fa-circle-o"></i><b>list User Groups</b></a></li>        
                                    <li><a style="color:orange" href="myProfile.php"><i class="fa fa-user-circle-o bigfonts" aria-hidden="true"></i>My Profile</a></li>	
                                    <li><a style="color:orange" href="pro-settings.html"><i class="fa fa-cogs"></i>Settings</a></li>										
                                    <li class="submenu">
                                        <a style="color:orange" href="#"><i class="fa fa-bank bigfonts" aria-hidden="true"></i> <span>Org Profile</span> <span class="menu-arrow"></span></a>
                                        <ul class="list-unstyled">								
                                            <li><a a style="color:orange" href="listCompanyProfile.php"><i class="fa fa-circle-o"></i>list Profile</a></li>
                                            <li><a a style="color:orange" href="addCompanyProfile.php"><i class="fa fa-plus-circle"></i>Company Profile</a></li>	
                                            <li><a a style="color:orange" href="listCompanyBankDetails.php"><i class="fa fa-circle-o"></i>list Bank</a></li>
                                            <li><a style="color:orange" href="addCompanyBankDetails.php"><i class="fa fa-plus-circle"></i>Company Bank</a></li>

                                        </ul>
                                </ul>
                            </li>

                        </ul>




                        <div class="clearfix"></div>

                    </div>

                    <div class="clearfix"></div>

                </div>

            </div>
            <!-- End Sidebar -->
			
			<!-- END main -->

