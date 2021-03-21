<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
//here getting result from the post array after submitting the form.
	
$title =	$_POST['title'];
$orgname 	 =	$_POST['orgname'];	
$portal 	 =	$_POST['portal'];
$orgtype  =	$_POST['orgtype'];	
$blocation 	 =	$_POST['blocation'];
$industry 	 =	$_POST['industry'];	
$address  =	$_POST['address'];		
$city 	 =	$_POST['city'];	
//country  =	$_POST['title'];		
$state  =	$_POST['state'];		
$zip  =	$_POST['zip'];		
$workphone 	 =	$_POST['workphone'];	
$mobile 	 =	$_POST['mobile'];	
$email 	 =	$_POST['email'];	
$web 	 =	$_POST['web'];	
$gstin 	 =	$_POST['gstin'];	
$gstregdate 	 =	$_POST['gstregdate'];	
//$primaryflag 	 =	$_POST['primaryflag'];
$image 	 =	$_POST['image'];
	

	//$image = file_get_contents($image
    $target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }

    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
    //$image =base64_encode($image);		
												    
	
    $insert_comprofile="INSERT INTO comprofile(title,orgname,portal,orgtype,blocation,industry,address,city,state,zip,workphone,mobile,email,web,gstin,gstregdate,image) 
	VALUES('$title','$orgname','$portal','$orgtype','$blocation','$industry','$address','$city','$state','$zip','$workphone','$mobile','$email','$web','$gstin','$gstregdate','$target_file')";
	
	echo "$insert_comprofile";
	
	if(mysqli_query($dbcon,$insert_comprofile))
	{
   
		echo "<script>alert('Company Code/Type creation Successful ')</script>";
		header("location:listCompanyProfile.php");
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
                                <li><a href="addCompanyTypeMaster.php"><i class="fa fa-circle-o"></i>add Company Type</a></li>
								<li><a href="listCompanyType.php"><i class="fa fa-circle-o"></i>List Company Type</a></li>
								<li><a href="addCompanyProfile.php"><i class="fa fa-circle-o"></i>add Profile</a></li>
                                <li><a href="listCompanyProfile.php"><i class="fa fa-circle-o"></i>list Profile</a></li>
                                <li><a href="addCompanyBankDetails.php"><i class="fa fa-circle-o"></i>add Bank Details</a></li>
								<li><a href="listCompanyBankDetails.php"><i class="fa fa-circle-o"></i>List Bank Details</a></li>
							</ul>
                    </li>
					
                    <li class="submenu">
						<a href="#"><i class="fa fa-truck smallfonts" aria-hidden="true"></i><span>Suppliers</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled">
                                <li><a href="addSupplierCodeMaster.php"><i class="fa fa-circle-o"></i>add Supplier Code</a></li>
								<li><a href="listSupplierCode.php"><i class="fa fa-circle-o"></i>list Supplier Type</a></li>
								<li><a href="addSupplierProfile.php"><i class="fa fa-circle-o"></i>add Supplier</a></li>
								<li><a href="listSupplierProfile.php"><i class="fa fa-circle-o"></i>list Suppliers</a></li>	
								<li><a href="addSupplierBankDetails.html"><i class="fa fa-circle-o"></i>add Bank Details</a></li>
								<li><a href="listSupplierBankDetails"><i class="fa fa-circle-o"></i>List Bank Details</a></li>								
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
								 <li><a href="addLocationMaster.php"><i class="fa fa-circle-o"></i>add Location</a></li>	
								 <li><a href="listLocation.php"><i class="fa fa-circle-o"></i>list Location</a></li>
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
                                    <h1 class="main-title float-left">Organization Master</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Organization Master</li>
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
			
                    

					
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								<h5><div class="text-muted font-light"><i class="fa fa-bank smallfonts" aria-hidden="true">
								</i>&nbsp;Add Organization Details<span class="text-muted"></span></div></h5>
								
								<div class="text-muted font-light">Tell us a bit about your organization.</div>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">
								<!--form action="addCompanyTypeMaster.php" class="validation fv-form fv-form-bootstrap" 
								enctype="multipart/form-data" method="post" 
								accept-charset="utf-8" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" 
								style="display: none; width: 0px; height: 0px;"></button-->
														
																
								    <div class="form-row">
								<div class="form-group col-md-3">
									  <label for="inputState">Title</label>
									  <select id="inputState" class="form-control" name="title">
										<span class="text-muted"> <option selected>Salutation</option></span>
										<option value="M/S.">MS.</option>
										<option value="Mr.">Mr.</option>
										<option value="Mrs.">Mrs.</option>
										<option value="Mrs.">Dr.</option>
									  </select>
									</div>
									
									
									<div class="form-group col-md-8">
									  <label >Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="orgname" placeholder="Company Name" required class="form-control" autocomplete="off">
									</div>
									</div>
									
									 <div class="form-row">
									<div class="form-group col-md-11">
									  <label >Portal Name</label>
									  <input type="text" class="form-control" name="portal" placeholder="https://dhirajpro/Bailey" required autocomplete="off">
									</div>
									</div>
															
								    <div class="form-row">
									<div class="form-group col-md-11">
									  <label >Organization Type<span class="text-danger">*</span></label>
									 <select id="inputState" class="form-control" name="orgtype">
										<option selected>Open Organization Type</option>
										<option value="1">Corporate/Registered Office</option>
										<option value="2">Branch Office</option>
										<option value="3">Partnership</option>

									  </select>
									</div>
									</div>
									
									
									<div class="form-row">
                                            <div class="form-group col-md-11">
                                                <label for="inputState">Business Location</label>
                                                <select id="locname" onchange="onlocode(this)" class="form-control" name="blocation">
                                                    <option selected>Open Location</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT locname FROM location");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $locname=$row['locname'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$locname.'" >'.$locname.'</option>';
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
										
									<div class="form-row">
									<div class="form-group col-md-11">
									 <label >Industry</label>
									 <select id="inputState" class="form-control" name="industry">
										<option value="1">Manufacturing</option>
										<option value="2">Consumer Packaged Goods</option>
										<option value="3">Education</option>
										<option value="4">Services</option>
										<option value="5">Construction</option>
										<option value="6">Retail Business</option>
										<option value="7">Mining and Logistics</option>
									  </select></div>
									</div>
										
										<div class="form-row">
									<div class="form-group col-md-9">
									  <h4 class="col-md-12 text-muted">Company Address &nbsp;</h4>
									  </div>
									</div>
									
									<div class="form-group row">
									<div class="col-md-11"> 
									<input type="text" placeholder="Street *" name="address" class="form-control ember-text-field ember-view"> 
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-4">
									  <input type="text" class="form-control" name="city"  placeholder="City *">
									</div>
									
									<div class="form-group col-md-4">
                                                <select id="inputState" class="form-control" name="state">
												  <span class="text-muted">  <option selected>State/Union Territory *</option> </span>
                                                    <option value="AS">Assam</option>
                                                    <option value="AP">Andhra Pradesh</option>
                                                    <option value="OR">Orissa</option>
                                                    <option value="PB">Punjab</option>
                                                    <option value="DL">Delhi</option>
                                                    <option value="GJ">Gujarat</option>
                                                    <option value="KA">Karnataka</option>
                                                    <option value="HR">Haryana</option>
													<option value="RJ">Rajasthan</option>
													<option value="HP">Himachal Pradesh</option>
													<option value="UK">Uttarakhand</option>
													<option value="JH">Jharkhand</option>
													<option value="CH">Chhatisgarh</option>
													<option value="KL">Kerala</option>
													<option value="TN">Tamilnadu</option>
													<option value="MP">Madhiya Pradesh</option>
													<option value="WB">West Bengal</option>
													<option value="BR">Bihar</option>
													<option value="MH">Maharastra</option>
													<option value="UP">Uttar Pradesh</option>
													<option value="CH">Chandigarh</option>
													<option value="TG">Telangana</option>
													<option value="JK">Jammu & Kashmir</option>
													<option value="TR">Tripura</option>
													<option value="ML">Meghalaya</option>
													<option value="GA">Goa</option>
													<option value="AR">Arunachal Pradesh</option>
													<option value="MN">Manipur</option>
													<option value="MZ">Mizoram</option>
													<option value="SK">Sikkim</option>
													<option value="PY">Pudhuchery</option>													
													<option value="NL">Nagaland</option>													
													<option value="AN">Andaman & Nicobar</option>													
													<option value="DH">Dadra & Nagar Haveli</option>													
													<option value="DD">Damen & Diu</option>													
													<option value="LD">Lakshadweep</option>
                                                </select>
                                            </div>
                                     
										
									  <div class="form-group col-md-3">
									  <input type="text" class="form-control" name="zip"  placeholder="Zip/Postal Code *">
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-9">
									  <h4 class="col-md-12 text-muted">Contact Details</h4>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-3">
									<label> Work Phone</label>
									  <input type="text" class="form-control" name="workphone"  placeholder="044-2652608">
									</div>
									
									<div class="form-group col-md-3">
									<label> Mobile <span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="mobile"  required placeholder="9677573737">
									</div>
									
									<div class="form-group col-md-5">
									<label> Email<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="email"  required placeholder="saravanas.office@abc.com">
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-11">									
									  <input type="text" class="form-control" name="web"  placeholder="Website">
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-9">
									  <h4 class="col-md-12 text-muted">Tax Details</h4>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-6">
									<label>GSTIN</label>
									  <input type="text" class="form-control" name="gstin"  placeholder="Maximum 15 Digits">
									</div>
									
									<div class="form-group col-md-5">
									<label> <span class="text-danger"> GST Registred on</span></label>
									  <input type="date" class="form-control" name="gstregdate"  required >
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-9">
									  <h4 class="col-md-12 text-muted">Company Logo</h4>
									  </div>
									</div>
									
									<div class="form-row">
                                    <div class="form-group col-md-11">
                                        <label>
                                            <div class="fa-hover col-md-12 col-sm-12">
                                                &nbsp;<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload image like JPG,GIF,PNG..</div>
                                        </label> 
                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control">
                                    </div>
								</div>
								
								<div class="form-row">
								<div class="col-md-12 col-md-offset-12">
								<div class="checkbox"><label>
								 <input type="checkbox" name="primaryflag" value="0" class="ember-checkbox ember-view">Make this profile as primary for all correspondence</label>
								 
								 </div>
								 </div>
								 </div>		
								</div> 
																
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                                            Cancel
                                                        </button>
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
<script>
                function onlocode(){

                }
            </script>
<!-- END Java Script for this page -->

</body>
</html>