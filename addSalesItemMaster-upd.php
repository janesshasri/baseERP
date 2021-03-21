<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
	$prefix = "DAPL/";
	$postfix = "/";
	
	//$today = date("dmy");
    $itemname=$_POST['itemname'];//here getting result from the post array after submitting the form.
    $description=$_POST['description'];//same
	$category=$_POST['category'];//same
    $status 	=$_POST['status'];
    $priceperqty 		=$_POST['priceperqty'];
    $priceperuom 		=$_POST['priceperuom'];
    $taxmethod 		=$_POST['taxmethod'];
    $taxrate 	=$_POST['taxrate'];
    $pricedatefrom 	=$_POST['pricedatefrom'];
    $stockinqty 	=$_POST['stockinqty'];
    $stockinuom	=$_POST['stockinuom'];
    $usageunit 		=$_POST['usageunit'];
    $handler 	=$_POST['handler'];

    
   //$image =base64_encode($image);														

    $insert_salesItemMaster="insert into salesitemaster(`prefix`,`postfix`,`itemname`,`description`,`category`,`status`,
														`priceperqty`,`priceperuom`,`taxmethod`,`taxrate`,`pricedatefrom`,`stockinqty`,
														`stockinuom`,`usageunit`, `handler`)
										VALUES ('$prefix','$postfix','$itemname','$description','$category','$status','$priceperqty','$priceperuom',
										'$taxmethod','$taxrate','$pricedatefrom','$stockinqty','$stockinuom','$usageunit','$handler')";
	
	echo "$insert_salesItemMaster";
	
	if(mysqli_query($dbcon,$insert_salesItemMaster))
	{
   
		echo "<script>alert('Sales Item creation Successful ')</script>";
		header("location:listSalesItemMaster.php");
    } else {
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
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

		<!-- Switchery css -->
		<link href="assets/plugins/switchery/switchery.min.css" rel="stylesheet" />
		
		<!-- Bootstrap CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Font Awesome CSS -->
		<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Custom CSS -->
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />

		<!-- BEGIN CSS for this page -->

		<!-- END CSS for this page -->
				
</head>

<body class="adminbody">

<div id="main">

	<!-- top bar navigation -->
	<!-- top bar navigation -->
	<div class="headerbar">

		<!-- LOGO -->
        <div class="headerbar-left">
			<a href="index.html" class="logo"><img alt="Logo" src="assets/images/logo.jpg" /> <span>DhirajPro</span></a>
        </div>

        <nav class="navbar-custom">

                    <ul class="list-inline float-right mb-0">
					

                        <li class="list-inline-item dropdown notif">
                            <a class="nav-link dropdown-toggle nav-user" data-toggle="dropdown" href="#" 
							role="button" aria-haspopup="false" aria-expanded="false">
                                <img src="assets/images/avatars/admin.jpg" alt="Profile image" class="avatar-rounded">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-item noti-title">
                                    <h5 class="text-overflow"><small>Hello, admin</small> </h5>
                                </div>

                                <!-- item-->
                                <a href="pro-profile.html" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>My Profile</span>
                                </a>
								
								 <a href="changePassword.php" class="dropdown-item notify-item">
                                    <i class="fa fa-user"></i> <span>Change PWD<span>
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
						<a class="active" href="index.html"><i class="fa fa-fw fa-bars"></i><span> Dashboard </span> </a>
                    </li>

					<li class="submenu">
                        <a href="charts.html"><i class="fa fa-fw fa-area-chart"></i><span> Charts </span> </a>
                    </li>
					
					<li class="submenu">
                        <a href="#"><i class="fa fa-bank bigfonts" aria-hidden="true"></i> <span>Company</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="addCompanyTypeMaster.html"><i class="fa fa-circle-o"></i>add Company Type</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>List Company Type</a></li>
								<li><a href="addCompanyProfile.html"><i class="fa fa-circle-o"></i>add Profile</a></li>
                                <li><a href=""><i class="fa fa-circle-o"></i>list Profile</a></li>
                                <li><a href="addCompanyBankDetails.html"><i class="fa fa-circle-o"></i>add Bank Details</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>List Bank Details</a></li>
							</ul>
                    </li>
					
                    <li class="submenu">
						<a href="#"><i class="fa fa-truck smallfonts" aria-hidden="true"></i><span>Suppliers</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="addSupplierCodeMaster.html"><i class="fa fa-circle-o"></i>add Supplier Code</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Supplier Type</a></li>
								<li><a href="addSuppliers.html"><i class="fa fa-circle-o"></i>add Supplier</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Suppliers</a></li>								
						    </ul>
                    </li>
						
								<li class="submenu">
                        <a href="#"><i class="fa fa-th-list bigfonts" aria-hidden="true"></i><span>Masters</span></a>
                            <ul class="list-unstyled">								
                                <li><a href="addTaxMaster.html"><i class="fa fa-circle-o"></i>add Tax(GST)</a></li>
								  <li><a href=""><i class="fa fa-circle-o"></i>list Tax</a></li>
								  <li><a href="addTransportType.html"><i class="fa fa-circle-o"></i>Transport Type</a></li>
                                <li><a href=""><i class="fa fa-circle-o"></i>add Transport</a></li>	
								 <li><a href=""><i class="fa fa-circle-o"></i>list Transport</a></li>	
								<li><a href="addPaymentTypeMaster.html"><i class="fa fa-circle-o"></i> Payment Type</a></li>
							</ul>
</li>						

                     <li class="submenu">
						<a href="#"><i class="fa fa-plus"></i><span>Purchase</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="addPurchaseItemCategory.html"><i class="fa fa-circle-o"></i>Add Item Category</a></li>
								<li><a href="addPurchaseItemMaster.html"><i class="fa fa-circle-o"></i>add Purchase Item</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Items</a></li>
								<li><a href="addPurchasePriceMaster.html"><i class="fa fa-circle-o"></i>Price</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Price</a> <li>
								<li><a href="addPo.html"><i class="fa fa-circle-o"></i>add PO</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list PO</a></li>
						   </ul>
                    </li>
					
					<li class="submenu">
						<a href="#"><i class="fa fa-truck smallfonts" aria-hidden="true"></i><span>Inventory(Purchase)</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="addGRN.html"><i class="fa fa-circle-o"></i>add GRN</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>List GRN</a></li>
								<li><a href="stockAdjustment.html"><i class="fa fa-circle-o"></i>Stock Adjustment</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Adjustment</a></li>
						   </ul>
						   </li>
						   
                    	<li class="submenu">
						<a href="#"><i class="fa fa-building-o"></i><span>Stock Movement</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">                    	
								<li><a href="addMaterialRequest.html"><i class="fa fa-circle-o"></i>Material Request</a></li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Material Request</a></li>								
								<li><a href="stockIssue.html"><i class="fa fa-circle-o"></i>Items Issuance</a></li>								
								<li><a href=""><i class="fa fa-circle-o"></i>list Items Issuance</a></li>
						    </ul>
                    </li>		

						<li class="submenu">
						<a href="#"><i class="fa fa-barcode"></i><span>Products</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">                    	
								<li><a href="addSalesProductEntity.html"><i class="fa fa-circle-o"></i>add Entity/Category</a> <li>
								<li><a href="addSalesProductMaster.html"><i class="fa fa-circle-o"></i>add Product</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Products</a> <li>
								<li><a href="addProductStockMaster.html"><i class="fa fa-circle-o"></i>stock Register</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list stock Register</a> <li>
								<li><a href="salesProductStockAdjustment.html"><i class="fa fa-circle-o"></i>stock Adjustment</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Adjustment</a> <li>
							</ul>
                    </li>		

		<li class="submenu">
						<a href="#"><i class="fa fa-shopping-cart"></i><span>Sales</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">                    	
								<li><a href="addCustomerTypeMaster.html"><i class="fa fa-circle-o"></i>add Customer Type</a> <li>
								<li><a href="addCustomerProfile.html"><i class="fa fa-circle-o"></i>add Customer</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Customer</a> <li>
								<li><a href="addSalesInvoice.html"><i class="fa fa-circle-o"></i>add Invoice</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Invoices</a> <li>								
							</ul>
                    </li>	

						<li class="submenu">
                        <a href="#"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i><span>Accounts Payables<span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
                                <li><a href="addSupplierBankDetails.html"><i class="fa fa-circle-o"></i>add Bank Details</a></li>								
								<li><a href="addSupplierBankDetails.html"><i class="fa fa-circle-o"></i>list Bank Details</a></li>
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
                        <a class="pro" href="#"><i class="fa fa-users"></i><span>Admin Panel</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">								
                                <li><a href="addUsers.php"><i class="fa fa-circle-o"></i>add Users</a></li>
								<li><a href="listUsers.php"><i class="fa fa-circle-o"></i>list Users</a></li>
								<li><a href="pro-settings.html"><i class="fa fa-cogs"></i>Settings</a></li>
								<li><a href="editUser.php"><i class="fa fa-circle-o"></i>My Profile</a></li>								
                            </ul>
                    </li>
					
            </ul>

            <div class="clearfix"></div>

			</div>
        
			<div class="clearfix"></div>

		</div>

	</div>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Sales Items/Product Master</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Sales Items/Product Master</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>
            <!-- end row -->

            
			<!--div class="alert alert-success" role="alert">
					  <h4 class="alert-heading">Company Registrtion Form</h4>
					  <p></a></p>
			</div-->

			
			<div class="row">
			
                    

					
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								<h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-tag bigfonts" aria-hidden="true"></i> Add Sales Item/Product Master 
								</h3>
								
							</div>
							
					
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="" class="validation fv-form fv-form-bootstrap" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
								
								
										 <!--div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="inputState">Category/Entity</label>
                                                <select id="locname" onchange="oncategory(this);" class="form-control" name="category">
                                                    <option selected>Open Category/Entity</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"SELECT category FROM itemcategory");
                                                      while ($row = $sql->fetch_assoc()){	
                                                        echo $category=$row['category'];
                                                        if($category==$_GET['category']){
                                                                echo '<option value="'.$category.'"  selected>'.$category.'</option>';  
                                                        }else{
                                                            echo '<option value="'.$category.'" >'.$category.'</option>';      
                                                        }
													  }
                                                    ?>
                                                </select>
                                                <script>
                                                    function oncategory(x)
                                                    {    
                                                        var category=x.value;
                                                        window.location.href = 'addSalesItemMaster.php?category='+category;

                                                    }


                                                </script>

                                            </div>
                                        </div-->
										<div class="form-row">
										<div class="form-group col-md-3">

                                                <label for="inputState">Product Category</label>
                                                <select id="compcode" onchange="oncategory(this);" class="form-control form-control-sm" name="category">
                                                    <option selected>Open Product Category</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"SELECT category FROM itemcategory
																				ORDER BY id ASC
																				");
                                                      while ($row = $sql->fetch_assoc()){	
                                                        echo $category=$row['category'];
														echo '<option onchange="'.$row[''].'" value="'.$category.'" >'.$category.'</option>';
                                                      
													  }
                                                    ?>
                                                </select>
												<!--script type="text/javascript">
												function oncategory(elm)
												{
													window.location = elm.value+"addPurchaseItemCategory.php";
												}
												</script-->
                                            </div>

									
									<div class="col-md-6 float-right text-right">
									<div class="form-group col-md-6">
									<div class="invoice-title text-left mb-6">
									  <label></i>Item Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control form-control-sm" name="itemname" placeholder="Sales Product Name" required class="form-control" autocomplete="off">
									  </div>
									  </div>
									  </div>
									  </div>
									  
									<!--div class="col-md-6 float-right text-right"-->
									<div class="form-row">
									<div class="form-group col-md-2">
									 <label for="inputState">Product Status</label>
									  <select id="inputState" class="form-control form-control-sm" name="status">
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
									</div>
									  </div>
								
									 <!--div class="form-row">
									<div class="form-group col-md-6">
									  <label >Description</label>
									  <input type="text" class="form-control" name="description" placeholder="Short notes about Product"  required class="form-control" autocomplete="off">
									</div>
									</div-->
									
									 <div class="form-row">
									<div class="form-group col-md-6">
									  <h5>Price Information</h5>
									  
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-2">
									<i class="fa fa-rupee fonts" aria-hidden="true"></i>
									 <label>Price/Qty<span class="text-danger">*</label></span>
									<input type="text" name="priceperqty" class="form-control form-control-sm"  placeholder="Price Per Qty">
									 </div>
									 
									<div class="col-md-6 float-right text-right">
								    <div class="form-group col-md-4">
									<div class="invoice-title text-left mb-6">
									<i class="fa fa-rupee fonts" aria-hidden="true"></i>
									<label>Price/UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
									 </label>
									<input type="text" name="priceperuom" class="form-control form-control-sm"placeholder="Unit of Measure">
									 </div>
									  </div>
									  </div>
									</div>
									 
									  
									  
									 <div class="form-row">
									<div class="form-group col-md-2">
									  <label for="inputState">Tax Method&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="Tax Method - Whether to include TAX or exclude TAX for this Item"></i>
									 </label>
									  <select id="inputState" class="form-control form-control-sm" name="taxmethod">
										<option selected>Select Tax Method</option>
										<option value="1">Inclusive</option>
										<option value="0">Exclusive</option>
									</select>
									</div>
									
									<div class="col-md-6 float-right text-right">
									<div class="form-group col-md-4">
									<div class="invoice-title text-left mb-8">
                                                <label for="inputState">Tax Rate %</label>
                                                <select id="taxrate" onchange="ontaxrate(this)" class="form-control form-control-sm" name="taxrate">
                                                    <option selected>Open Tax Rate</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT taxrate FROM taxmaster ORDER by id ASC");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $taxrate=$row['taxrate'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$taxrate.'" >'.$taxrate.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-2">
									 <label>Date From<span class="text-danger">*</label>&nbsp;</span><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="Date From - is used to set the date of last updated price"></i>
									 </label>
									  <input type="date" name="pricedatefrom" class="form-control form-control-sm"  placeholder="Price Date Since.." required >
									</div> 
								</div>
								
								 <div class="form-row">
									<div class="form-group col-md-6">
									  <h5>Stock Information</h5>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-2">
									 <label>Quantity in Stock<span class="text-danger">*</label></span>
									 <input type="text" class="form-control form-control-sm" name="stockinqty"placeholder="Price per qty" required >
									</div>
									 
									 <div class="col-md-6 float-right text-right">
									<div class="form-group col-md-4">
									<div class="invoice-title text-left mb-6">
										<label>Oty in UOM</label>
									  <input type="text" class="form-control form-control-sm" name="stockinuom" placeholder="Unit of Measure, like boxes,bundles.."  required class="form-control" autocomplete="off">
									 </div>
									  </div>
									  </div>
									  </div>
									  
									 <!--div class="form-row">
									<div class="form-group col-md-2">									  
									  <label>Reorder Level</label>
									  <input type="text" class="form-control form-control-sm" name="description" placeholder="Short notes about Product"  required class="form-control" autocomplete="off">
									</div>
									
									<div class="col-md-6 float-right text-right">
									<div class="form-group col-md-4">
									<div class="invoice-title text-left mb-8">
                                                <label for="inputState">Qty on Demand</label>
									  <input type="text" class="form-control form-control-sm" name="description" placeholder="Short notes about Product"  required class="form-control" autocomplete="off">
									</div>
									</div>
									</div>
									</div-->
									
									<div class="form-row">
									<div class="form-group col-md-2">
                                                <label for="inputState">Usage Unit</label>
									  <select id="inputState" class="form-control form-control-sm" name="usageunit">
										
										<option value="1">Box</option>
										<option value="2">Quantity</option>
										<option value="3">Pieces</option>
									</select>
                                      </div>
									  
									  <div class="col-md-6 float-right text-right">
									<div class="form-group col-md-4">
									<div class="invoice-title text-left mb-8">
									  <label for="inputState">Handler</label>
									  <select id="taxrate" onchange="onusername(this)" class="form-control form-control-sm" name="handler">
                                                    <option selected>Select Username</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT username FROM userprofile ORDER by id ASC");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $username=$row['username'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$username.'" >'.$username.'</option>';
                                                    }
                                                    ?>
                                                </select>
									  </div>
									  </div>
									  </div>
									  </div>
									  
							
										
									
									
									<div class="form-row">
									<div class="form-group col-md-6">
									  <h5>Description Information</h5>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-6">
									 <label>Description</label></span>
									  <textarea rows="2" class="form-control editor" name="description"></textarea>
									  
									</div> 
								</div>
									
							
									
									
									<!--div class="form-row">
									<div class="form-group">
									<label>
									<div class="fa-hover col-md-12 col-sm-12">
									<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload Product Image</div>
									</label> 
									<input type="file" name="image" class="form-control">
									</div>
									</div>
									</div-->
								
										
								    <div class="form-row">
								    <div class="form-group text-right m-b-12">
                                                       &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                                            Cancel
                                                        </button>
                                                    </div>
													</div>
													</div>
													
								</form>
								</div>
								</div>
								</div>
								
								
								
		      </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
	
    
<footer class="footer">
		<span class="text-right">
		Copyright@<a target="_blank" href="#">Dhiraj Agro Products Pvt. Ltd.,</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href=""><span>e-Schoolz</span> </a>
		</span>
	</footer>

</div>
<!-- END main -->

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script>

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->

<!-- END Java Script for this page -->

</body>
</html>