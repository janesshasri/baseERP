<?php
include("database/db_conection.php");//make connection here
if(isset($_POST['submit']))
{
     $user_name=$_POST['user_name'];//here getting result from the post array after submitting the form.
	 $firstname=$_POST['firstname'];
	 $lastname=$_POST['lastname'];
	$gender = $_POST['gender'];
    $user_email=$_POST['email'];//same
    $user_password=$_POST['password'];//same
	$user_repassword = $_POST['repassword'];//same
	$user_mobile = $_POST['mobile'];
	$user_address = $_POST['address']; 
	$groupname = $_POST['groupname'];
	$groupname = $_POST['groupname'];
	$compcode = $_POST['compcode'];
	


	
	$check_username="select * from userprofile WHERE username='$user_name'";
    $run_query=mysqli_query($dbcon,$check_username);
	if(mysqli_num_rows($run_query)>0)
    {
      echo "<script>alert('User $user_name is already exist in our database, Please try another one!')</script>";
      //$fmsg= "Email already exists";
       exit();
    }
	

    //here query check weather if user already registered so can't register again.
    $check_email_query="select * from userprofile WHERE email='$user_email'";
    $run_query=mysqli_query($dbcon,$check_email_query);

    if(mysqli_num_rows($run_query)>0)
    {
        echo "<script>alert('Email $user_email is already exist in our database, Please try another one!')</script>";
        //$fmsg= "Email already exists";
        
		
		exit();
    }
	if($user_password != $user_repassword)
    {
        echo "<script>alert('Password does not match,please enter correct password')</script>";
        //$fmsg= "Email already exists";
        exit();
    }
	
	//insert the user into the database.
	
	//$image =$_FILES['image']['tmp_name'];
    //$image_name = $_FILES['image']['image_name'];
														
   //$image = file_get_contents($image);
   
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
    $insert_userprofile="insert into userprofile (username,firstname,lastname,gender,email,pass,repass,mobile,address,groupname,compcode,image_name) 
	VALUE ('$user_name','$firstname','$lastname','$gender','$user_email','$user_password','$user_repassword','$user_mobile','$user_address','$groupname','$compcode','$target_file')";
	//echo $insert_userprofile;
    if(mysqli_query($dbcon,$insert_userprofile))
    {
        //echo"<script>window.open('blank.html','_self')</script>";
		//<div class = "alert alert-success">Success! Well done its submitted.</div>
		
		//$smsg = "success";
		
		echo "<script>alert('User creation Successfully created')</script>";
		header("location:listUsers.php");
    } else {
		
		echo "<script>alert('User creation unsuccessful ')</script>";
		exit; 
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
                                <li><a href="listCompanyProfile"><i class="fa fa-circle-o"></i>list Profile</a></li>
                                <li><a href="addCompanyBankDetails.html"><i class="fa fa-circle-o"></i>add Bank Details</a></li>
								<li><a href="listCompanyBankDetails"><i class="fa fa-circle-o"></i>List Bank Details</a></li>
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
								<li><a href="addSalesProductPriceMaster.html"><i class="fa fa-circle-o"></i>add Price</a> <li>
								<li><a href=""><i class="fa fa-circle-o"></i>list Price</a> <li>
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


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">


			<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">User Registration</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Create User</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>
            <!-- end row -->
			

			<!--div class="alert alert-success" role="alert">
				  <h4 class="alert-heading">Parsley JavaScript form validation library</h4>
				  <p>You can find examples and documentation about Parsley form validation library here: <a target="_blank" href="http://parsleyjs.org/">Parsley documentation</a></p>
			</div-->

			
			<div class="row">
			
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
						<div class="card mb-3">
							<div class="card-header">
								<h3><i class="fa fa-hand-pointer-o"></i>Create User</h3>
								</div>
								
							<div class="card-body">
																
										<form data-parsley-validate novalidate method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label>User Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="user_name" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                                    </div>
													 <div class="form-group">
                                                        <label for="firstname">Firstname<span class="text-danger">*</span></label>
                                                        <input type="text" name="firstname" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                                    </div>
													 <div class="form-group">
                                                        <label for="Lastname">Lastname<span class="text-danger">*</span></label>
                                                        <input type="text" name="lastname" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                                    </div>
												
											
											<div class="form-group">
											<label>Gender</label>
											<select name="gender" class="form-control" required>
											<option value="">- Open Gender-</option>
											
																	<option  value="1">Male</option>
																    <option  value="2">Female</option>
											</select>
											</div>
										
											
                                                    <div class="form-group">
                                                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                                        <input type="email" name="email" data-parsley-trigger="change" required placeholder="Enter email" class="form-control" id="emailAddress">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pass1">Password<span class="text-danger">*</span></label>
                                                        <input id="pass1" type="password" name="password" placeholder="Password" required class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                                        <input data-parsley-equalto="#pass1" type="password" name="repassword" required placeholder="Password" class="form-control" id="passWord2">
                                                    </div>
                                                   <div class="form-group">
                                                        <label>Mobile<span class="text-danger">*</span></label>
                                                        <div>
                                                            <input data-parsley-type="number" step="any" name="mobile" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                                        </div>
                                                    </div>                                                    
                                                    <div class="form-group">
                                                        <label>Address<span class="text-danger">*</span></label>
                                                        <div>
                                                            <textarea name="address" class="form-control" data-parsley-trigger="change" required></textarea>
                                                        </div>
                                                    </div>
													
											<div class="form-group">
                                                <label for="inputState">Organization ID<span class="text-danger">*</span></label>
                                                <select id="compcode" onchange="oncompcode(this);" class="form-control" name="compcode">
                                                    <option selected>Open Org ID</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"SELECT concat( prefix,id ) AS compcode
																				FROM comprofile
																				ORDER BY id ASC
																				");
                                                      while ($row = $sql->fetch_assoc()){	
                                                        echo $compcode=$row['compcode'];
														echo '<option onchange="'.$row[''].'" value="'.$compcode.'" >'.$compcode.'</option>';
                                                      
													  }
                                                    ?>
                                                </select>
                                            </div>
													
											
                                            <div class="form-group">
                                                <label for="inputState">Groups<span class="text-danger">*</span></label>
                                                <select id="groupname" onchange="ongroup(this)" class="form-control"  name="groupname">
                                                    <option selected>Open Groups</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT groupname FROM groups");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $groupname=$row['groupname'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$groupname.'" >'.$groupname.'</option>';
                                                    }
                                                    ?>
                                                </select>
												
											
								<!-- Button trigger modal -->
								<!--a role="button" href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
								  User Group
								</a-->
								
								<!--a  href=""  data-toggle="modal" data-target="#exampleModal">
								  <i class="fa fa-user-plus" aria-hidden="true"></i>add User Group
								</a-->

								<!-- Modal -->
								<a href="#custom-modal" data-target="#customModal" data-toggle="modal">
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add User Group</a>
								
								<!-- Modal -->
								<div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel2">Add User Group</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  <?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
	//$prefix = "DAPL/";
	//$postfix = "/";
	
    $groupname=$_POST['groupname'];//same
    $description=$_POST['description'];//same
	
	
	$check_groupname_query="select groupname from groups WHERE groupname='$groupname'";
    $run_query=mysqli_query($dbcon,$check_groupname_query);
	if(mysqli_num_rows($run_query)>0)
    {
        echo "<script>alert('Group $groupname is already exist in our database, Please try another one!')</script>";
        //$fmsg= "Email already exists";
        exit();
    }

   //$image =base64_encode($image);														
	$insert_groups="INSERT INTO groups(`groupname`,`description`) 
	VALUES ('$groupname','$description')";													    

	
	//echo "$insert_usercode";
	
	if(mysqli_query($dbcon,$insert_groups))
	{
		echo "<script>alert('User Group creation Successful ')</script>";
		//header("location:addUsers.php");
    } else {
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>						  <form action="#" enctype="multipart/form-data" method="post">
									  
									   <div class="form-group">
										<input type="text" class="form-control" name="groupname"  placeholder="groupname">
										</div>
										<div class="form-group">
										<input type="text" class="form-control" name="description"  placeholder="description">
										</div>
										</div>
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="submit" name="submit" class="btn btn-primary">Save changes</button>
									  </div>
									</div>
								  </div>
								</div>
													<div class="form-group">
													<label>
													<div class="fa-hover col-md-12 col-sm-12">
													<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload User Profile Image</div></label> 
													<input type="file" name="image" class="form-control">
													</div>
													
								
                                                    <div class="form-group text-right m-b-0">
                                                        <button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                                            Cancel
                                                        </button>
                                                    </div>

                                        </form>
										
							</div>														
						</div><!-- end card-->					
                    </div>

					
					
			
									
									<script >$(function () {
									  var $sections = $('.form-section');

									  function navigateTo(index) {
										// Mark the current section with the class 'current'
										$sections
										  .removeClass('current')
										  .eq(index)
											.addClass('current');
										// Show only the navigation buttons that make sense for the current section:
										$('.form-navigation .previous').toggle(index > 0);
										var atTheEnd = index >= $sections.length - 1;
										$('.form-navigation .next').toggle(!atTheEnd);
										$('.form-navigation [type=submit]').toggle(atTheEnd);
									  }

									  function curIndex() {
										// Return the current index by looking at which section has the class 'current'
										return $sections.index($sections.filter('.current'));
									  }

									  // Previous button is easy, just go back
									  $('.form-navigation .previous').click(function() {
										navigateTo(curIndex() - 1);
									  });

									  // Next button goes forward iff current block validates
									  $('.form-navigation .next').click(function() {
										$('.demo-form').parsley().whenValidate({
										  group: 'block-' + curIndex()
										}).done(function() {
										  navigateTo(curIndex() + 1);
										});
									  });

									  // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
									  $sections.each(function(index, section) {
										$(section).find(':input').attr('data-parsley-group', 'block-' + index);
									  });
									  navigateTo(0); // Start at the beginning
									});
									//# sourceURL=pen.js
									</script>

								
							</div>														
						</div><!-- end card-->					
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
<script src="assets/plugins/parsleyjs/parsley.min.js"></script>
<script>
  $('#form').parsley();
</script>
<!-- END Java Script for this page -->

<!-- BEGIN Java Script for this page -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
$(document).ready(function(){
    
	$('#example1').click(function(){
       swal("Hello world!");
    });
	
	$('#example2').click(function(){
       swal("Here's the title!", "...and here's the text!");
    });
	
	$('#submit').click(function(){
       swal("User Created Successfully!", "Click OK button", "success");
    });
	
	$('#example4').click(function(){
       swal({
			  title: "Are you sure?",
			  text: "Once deleted, you will not be able to recover this imaginary file!",
			  icon: "warning",
			  buttons: true,
			  dangerMode: true,
			})
			.then((willDelete) => {
			  if (willDelete) {
				swal("Poof! Your imaginary file has been deleted!", {
				  icon: "success",
				});
			  } else {
				swal("Your imaginary file is safe!");
			  }
			});
    });
	
	$('#example5').click(function(){
       swal("Write something here:", {
			  content: "input",
			})
			.then((value) => {
			  swal(`You typed: ${value}`);
			});
    });
	
	$('#example6').click(function(){
       swal({
				text: 'Search for a movie. e.g. "Titanic".',
				  content: "input",
				  button: {
					text: "Search!",
					closeModal: false,
				  },
				})
				.then(name => {
				  if (!name) throw null;
				 
				  return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
				})
				.then(results => {
				  return results.json();
				})
				.then(json => {
				  const movie = json.results[0];
				 
				  if (!movie) {
					return swal("No movie was found!");
				  }
				 
				  const name = movie.trackName;
				  const imageURL = movie.artworkUrl100;
				 
				  swal({
					title: "Top result:",
					text: name,
					icon: imageURL,
				  });
				})
				.catch(err => {
				  if (err) {
					swal("Oh noes!", "The AJAX request failed!", "error");
				  } else {
					swal.stopLoading();
					swal.close();
				  }
				});
    });
	
});
</script>
<script>
                function oncompcode(){

                    console.log(this);
                }
            </script>

<!-- END Java Script for this page -->
<script>
                function ongroup(){

                    console.log(this);
                }
            </script>

</body>
</html>