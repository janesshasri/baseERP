<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Dhiraj Agro Products Pvt Ltd.,</title>
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

<div id="main">

	
	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="index.php" class="logo"><img alt="Logo" src="assets/images/logo.jpg" /> <span>DhirajPro</span></a>
          </div>
		
			

      
		
        <nav class="navbar-custom">
		
		        <ul class="list-inline float-right mb-0">
						
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
                                <a title="Clcik to visit Pike Admin Website" target="_blank" href="" class="dropdown-item notify-item notify-all">
                                    <i class="fa fa-link"></i> Visit FAQs?
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
                                   <i class="fa fa-unlock" aria-hidden="true"></i></span>Change PWD
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
						<a class="active" href="index.php"><i class="fa fa-dashboard"></i><span> Dashboard </span> </a>
						<!--i class="fa fa-fw fa-bars"></i-->
                    </li>

					<li class="submenu">
                        <a href="charts.html"><i class="fa fa-fw fa-area-chart"></i><span> Charts </span> </a>
                    </li>
					
					<li class="submenu">
                        <a href="#"><i class="fa fa-bank bigfonts" aria-hidden="true"></i> <span>Organization</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
							    <li><a href="listCompanyProfile.php"><i class="fa fa-circle-o"></i>list Company Profile</a></li>
                                <li><a href="addCompanyProfile.php"><i class="fa fa-circle-o"></i>add Profile</a></li>
                                <li><a href="addCompanyBankDetails.php"><i class="fa fa-circle-o"></i>add Company Bank</a></li>
								<li><a href="listCompanyBankDetails.php"><i class="fa fa-circle-o"></i>list Company Bank</a></li>
							</ul>
                    </li>
					
                   <li class="submenu">
						<a href="#"><i class="fa fa-truck smallfonts" aria-hidden="true"></i><span>Suppliers</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
							<li><a href="listSupplierCode.php"><i class="fa fa-circle-o"></i>list Supplier Types</a></li>
                                <li><a href="addSupplierCodeMaster.php"><i class="fa fa-circle-o"></i>add Supplier Type</a></li>
								<li><a href="listVendorProfile.php"><i class="fa fa-circle-o"></i>list Vendors</a></li>	
								<li><a href="addVendorProfile.php"><i class="fa fa-circle-o"></i>add Vendor</a></li>
								<li><a href="listSupplierBankDetails.php"><i class="fa fa-circle-o"></i>List Bank Details</a></li>
								<li><a href="addSupplierBankDetails.php"><i class="fa fa-circle-o"></i>add Bank Details</a></li>
						    </ul>
                    </li>
						
								<li class="submenu">
                        <a href="#"><i class="fa fa-th-list bigfonts" aria-hidden="true"></i><span>Masters</span></a>
                            <ul class="list-unstyled">	
							<li><a href="addExpenseAccountMaster.php"><i class="fa fa-circle-o"></i>Expense AcctName</a></li>
                                <li><a href="listTaxMaster.php"><i class="fa fa-circle-o"></i>listTaxMaster</a></li>
								  <li><a href="addTaxMaster.php"><i class="fa fa-circle-o"></i>add Tax(GST)</a></li>
								  <li><a href="listTransportMaster.php"><i class="fa fa-circle-o"></i>list Transport</a></li>
                                <li><a href="addTransportMaster.php"><i class="fa fa-circle-o"></i>add Transport</a></li>	
								<li><a href="listPaymentTermMaster.php"><i class="fa fa-circle-o"></i> list Payment Term</a></li>
								<li><a href="addPaymentTermMaster.php"><i class="fa fa-circle-o"></i> add Payment Term</a></li>
								<li><a href="listItemCategory.php"><i class="fa fa-circle-o"></i>list Item Category</a></li>
                                <li><a href="addItemCategory.php"><i class="fa fa-circle-o"></i>Add Item Category</a></li>
								 <li><a href="addLocationMaster.php"><i class="fa fa-circle-o"></i>add Location</a></li>	
								 <li><a href="listLocation.php"><i class="fa fa-circle-o"></i>list Location</a></li>
								<li><a href="listCustomerType.php"><i class="fa fa-circle-o"></i>list Customer Type</a></li>								
								<li><a href="addCustomerType.php"><i class="fa fa-circle-o"></i>add Customer Type</a></li>	
								 
							</ul>
</li>						

                     <li class="submenu">
						<a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i>Purchase <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
								<li><a href="addPurchaseOrder.php">Purchase Orders</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list PO</a></li>
						   </ul>
                    </li>
					
					<li class="submenu">
						<a href="#"><i class="fa fa-truck smallfonts" aria-hidden="true"></i><span>Goods Received Note(GRN)</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="addGoodsReceiptNote.php"><i class="fa fa-circle-o"></i>add GRN</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>List GRN</a></li>
								<li><a href="stockAdjustment.html"><i class="fa fa-circle-o"></i>Stock Adjustment</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Adjustment</a></li>
						   </ul>
						   </li>
						   
					<li class="submenu">
						<a href="#"><i class="fa fa-building-o"></i>Inventory <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
								li><a href="listPurchaseItemMaster.php"><i class="fa fa-circle-o"></i>list Stock Inward</a></li>
								<li><a href="addPurchaseItemMaster.php"><i class="fa fa-circle-o"></i>add Stock Inward</a></li>
								<a href="#" class=""><span>Stock Movement</span> <span class="menu-arrow"></span> </a>
								<li><a href="addMaterialRequest.html"><i class="fa fa-circle-o"></i>Material Request</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Material Request</a></li>		
						   </ul>
                    </li>
						   
						   
                    	<!--li class="submenu">
						<a href="#"><i class="fa fa-building-o"></i><span>Stock Movement(Materials)</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">                    	
								<li><a href="addMaterialRequest.html"><i class="fa fa-circle-o"></i>Material Request</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Material Request</a></li>								
								<li><a href="stockIssue.html"><i class="fa fa-circle-o"></i>Items Issuance</a></li>								
								<li><a href=""><i class="fa fa-circle-o"></i>list Items Issuance</a></li>
						    </ul>
                    </li-->		

						<li class="submenu">
						<a href="#"><i class="fa fa-barcode"></i><span>Products</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">  
								<li><a href="listSalesItemMaster.php"><i class="fa fa-circle-o"></i>list Sales Products</a> <li>
								<li><a href="addSalesItemMaster.php"><i class="fa fa-circle-o"></i>add Sales Product</a> <li>
								<!--li><a href="listSalesPriceMaster.php"><i class="fa fa-circle-o"></i>list Sales Price</a> <li>
								<li><a href="addSalesPriceMaster.php"><i class="fa fa-circle-o"></i>add Sales Price</a> <li>
								<li><a href="addProductStockMaster.html"><i class="fa fa-circle-o"></i>stock Register</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list stock Register</a> <li>
								<li><a href="salesProductStockAdjustment.html"><i class="fa fa-circle-o"></i>stock Adjustment</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Adjustment</a> <li-->
							</ul>
                    </li>		

		<li class="submenu">
						<a href="#"><i class="fa fa-shopping-cart"></i><span>Sales</span> <span class="menu-arrow"></span></a>
                            
							<ul class="list-unstyled">   
							    <li><a href="listCustomerProfile.php"><i class="fa fa-circle-o"></i>list Customer</a> <li>
								<li><a href="addCustomerProfile.php"><i class="fa fa-circle-o"></i>add Customer</a> <li>
								<li><a href="addSalesOrder.php"><i class="fa fa-circle-o"></i>Sales Orders</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Invoices</a> <li>								
								<li><a href="addSalesInvoice.html"><i class="fa fa-circle-o"></i>Invoices</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Invoices</a> <li>								
							</ul>
                    </li>	

						<li class="submenu">
                        <a href="#"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i><span>Expenses<span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
                                <li><a href="listExpenses.php"><i class="fa fa-circle-o"></i>list Expenses</a></li>								
								<li><a href="addExpenses.php"><i class="fa fa-circle-o"></i>add Expense</a></li>
								<li><a href="addSupplierAccounts.html"><i class="fa fa-circle-o"></i>Supplier Accounts</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Accounts</a></li>
							</ul>
</li>		
						<li class="submenu">
                        <a href="#"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i><span>Accounts Receivables<span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
                                <li><a href="addCustomerBankDetails.html"><i class="fa fa-circle-o"></i>add Bank Details</a></li>								
								<li><a href=""><i class="fa fa-circle-o"></i>list Bank Details</a></li>
								<li><a href="addCustomerAccounts.html"><i class="fa fa-circle-o"></i>Customer Accounts</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Accounts</a></li>
							</ul>
</li>	

						<li class="submenu">
                        <a href="#"><i class="fa fa-bar-chart-o"></i></i>Reports<span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
                                <li><a href=""><i class="fa fa-circle-o"></i><b>Purchase Stock</b></a></li>								
								<li><a href=""><i class="fa fa-circle-o"></i><b>Product Stock</b></a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>Supplier Accounts</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>Customer Accounts</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>Sales</a></li>
								
							</ul>
</li>											
     										
                    
					<li class="submenu">
                        <a class="pro" href="#"><i class="fa fa-users"></i><span>Users & Controls</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
                                <li><a href="listUsers.php"><i class="fa fa-circle-o"></i>list Users</a></li>
								<li><a href="addUsers.php"><i class="fa fa-circle-o"></i>add Users</a></li>
								<li><a href="listUserGroups.php"><i class="fa fa-circle-o"></i>list User Groups</a></li>
								<li><a href="addUserGroup.php"><i class="fa fa-circle-o"></i>add User Groups</a></li>
								<li><a href=""><i class="fa fa-cogs"></i>My Profile</a></li>
								<li><a href="pro-settings.html"><i class="fa fa-circle-o"></i>Settings</a></li>								
                            </ul>
                    </li>
					
            </ul>

            <div class="clearfix"></div>

			</div>
        
			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->