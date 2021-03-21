<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['compProfEdit']))
{ 
    var_dump($_POST);
    extract($_POST);
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

    $updateComprofile = "UPDATE `comprofile` SET  
						`address`  = '".$address."',`city`  = '".$city."',`country`= '".$country."',`state`= '".$state."',`email`  = '".$email."',
						`web`  = '".$web."',`phone`  = '".$phone."',`mobile`  = '".$mobile."',`gst`  = '".$gst."',`pan`  = '".$pan."',`image`  = '".$target_file."'
						 WHERE `id` =". $compId;
    if(mysqli_query($dbcon,$updateComprofile))
    {
        
           // $image=$_POST['image'];//same

    //$image = file_get_contents($image);

   
        echo "<script>alert('Profile Successfully updated')</script>";
        header("location:listCompanyProfile.php");
    } else { echo 'Failed to update user';
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
								<li><a href="addSupplierBankDetails.php"><i class="fa fa-circle-o"></i>add Bank Details</a></li>
								<li><a href="listSupplierBankDetails.php"><i class="fa fa-circle-o"></i>List Bank Details</a></li>								
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
                                <h1 class="main-title float-left">Edit Company Profile</h1>
                                <ol class="breadcrumb float-right">
                                    <a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                                <li class="breadcrumb-item active">Edit Company Profile</li>
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
                                <h3><div class="fa-hover col-md-8 col-sm-8">
                                    <i class="fa fa-bank bigfonts" aria-hidden="true"></i> Edit Company Profile</h3>


                                    </div>

                                <div class="card-body">

                                    <form method="post" action="editCompanyProfile.php" enctype="multipart/form-data">


                                        <?php
                                        include("database/db_conection.php");//make connection here

                                        if(isset($_GET['id']))
                                        {
                                            $id=$_GET['id'];

                                            //selecting data associated with this particular id
                                            $result = mysqli_query($dbcon, "SELECT concat(prefix,id) as orgid,title,orgname,portal,orgtype,blocation,
																	industry,address,city,state,zip,workphone,mobile,email,web,gstin,gstregdate,image
											FROM comprofile WHERE id=$id");

                                            while($res = mysqli_fetch_array($result))
                                            {
                                                $orgid = $res['orgid'];
												$title =	$res['title'];
												$orgname 	 =	$res['orgname'];	
												$portal 	 =	$res['portal'];
												$orgtype  =	$res['orgtype'];	
												$blocation 	 =	$res['blocation'];
												$industry 	 =	$res['industry'];	
												$address  =	$res['address'];		
												$city 	 =	$res['city'];	
												//country  =	$_POST['title'];		
												$state  =	$res['state'];		
												$zip  =	$res['zip'];		
												$workphone 	 =	$res['workphone'];	
												$mobile 	 =	$res['mobile'];	
												$email 	 =	$res['email'];	
												$web 	 =	$res['web'];	
												$gstin 	 =	$res['gstin'];	
												$gstregdate 	 =	$res['gstregdate'];	
												//$primaryflag 	 =	$res['primaryflag'];
												$image 	 =	$res['image'];

                                            }
                                        }

                                        ?>	
										
										
                                     <div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputZip">Organization ID</label>
									  <input type="text" class="form-control"  name="orgid"  readonly  value="<?php echo $orgid;?>" />
									</div>
									</div>
									
									   <div class="form-row">
                                            <div class="form-group col-md-3">
                                                <label>Title</label>
                                                <select name="title" class="form-control" required>
                                                    <option <?php if ($title == "MS." ) echo 'selected="selected"' ; ?> value="MS.">MS.</option>
                                                    <option <?php if ($title == "Mr." ) echo 'selected="selected"' ; ?> value="Mr.">Mr.</option>
                                                    <option <?php if ($title == "Mrs." ) echo 'selected="selected"' ; ?> value="Mrs.">Mrs.</option>
													<option <?php if ($title == "Dr." ) echo 'selected="selected"' ; ?> value="Dr.">Dr.</option>
                                                </select>
                                            </div>
											
											
											<div class="form-group col-md-8">
												<label >Name<span class="text-danger"></span></label>
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
									  <label >Organization Type</label>
									 <select id="inputState" class="form-control" name="orgtype">
										 <option <?php if ($orgtype == "Corporate/Registered Office" ) echo 'selected="selected"' ; ?> value="Corporate/Registered Office">Corporate/Registered Office</option>
										<option <?php if ($orgtype == "Branch Office" ) echo 'selected="selected"' ; ?> value="Branch Office">Branch Office</option>
										<option <?php if ($orgtype == "Partnership" ) echo 'selected="selected"' ; ?> value="Partnership">Partnership</option>
									</select>
									</div>
									</div>
									
									<div class="form-row">
                                            <div class="form-group col-md-11">
                                                <label for="inputState">Business Location</label>
                                                <select id="locname" onchange="onlocode(this)" class="form-control" name="blocation">
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon, "SELECT locname FROM location");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $locname_get=$row['blocation'];
                                                        if($locname_get==$blocation){
                                                            echo '<option value="'.$locname_get.'" selected>'.$locname_get.'</option>';

                                                        }else{
                                                            echo '<option value="'.$locname_get.'" >'.$locname_get.'</option>';

                                                        }
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
									</div>

									<div class="form-group col-md-6">
                                            <label for="inputCity">City</label>
                                            <input type="text" class="form-control" id="city" name="city" placeholder="City/Town/Village ..."value="<?php echo $city;?>" />
                                        </div>
                                        </div>
										
								
										
										
							<!--div class="form-row">
							<div class="form-group col-md-4">
                            <label for="inputState">Country</label>
							<select name="country" class="form-control" required>
							<option <?php if ($country == "AR" ) echo 'selected="selected"' ; ?> value="AR">Argentina</option>									
							<option <?php if ($country == "AU" ) echo 'selected="selected"' ; ?> value="AU">Australia</option>
							<option <?php if ($country == "AT" ) echo 'selected="selected"' ; ?> value="AT">Austria</option>									
							<option <?php if ($country == "BD" ) echo 'selected="selected"' ; ?> value="BD">Bangladesh</option>
							<option <?php if ($country == "BE" ) echo 'selected="selected"' ; ?> value="BE">Belgium</option>									
							<option <?php if ($country == "BR" ) echo 'selected="selected"' ; ?> value="BR">Brazil</option>
							<option <?php if ($country == "BG" ) echo 'selected="selected"' ; ?> value="BG">Bulgaria</option>									
							<option <?php if ($country == "CA" ) echo 'selected="selected"' ; ?> value="CA">Canada</option>
							<option <?php if ($country == "CN" ) echo 'selected="selected"' ; ?> value="CN">China</option>									
							<option <?php if ($country == "CO" ) echo 'selected="selected"' ; ?> value="CO">Colombia</option>															
							<option <?php if ($country == "HR" ) echo 'selected="selected"' ; ?> value="HR">Croatia</option>															
							<option <?php if ($country == "CU" ) echo 'selected="selected"' ; ?> value="CU">Cuba</option>															
							<option <?php if ($country == "CZ" ) echo 'selected="selected"' ; ?> value="CZ">Czech Republic</option>
							<option <?php if ($country == "DK" ) echo 'selected="selected"' ; ?> value="DK">Denmark</option>															
							<option <?php if ($country == "EG" ) echo 'selected="selected"' ; ?> value="EG">Egypt</option>
							<option <?php if ($country == "FI" ) echo 'selected="selected"' ; ?> value="FI">Finland</option>															
							<option <?php if ($country == "FR" ) echo 'selected="selected"' ; ?> value="FR">France</option>
							<option <?php if ($country == "DE" ) echo 'selected="selected"' ; ?> value="DE">Germany</option>															
							<option <?php if ($country == "GR" ) echo 'selected="selected"' ; ?> value="GR">Greece</option>
							<option <?php if ($country == "HK" ) echo 'selected="selected"' ; ?> value="HK">Hong Kong</option>															
							<option <?php if ($country == "HU" ) echo 'selected="selected"' ; ?> value="HU">Hungary</option>
							<option <?php if ($country == "IS" ) echo 'selected="selected"' ; ?> value="IS">Iceland</option>															
							<option <?php if ($country == "IN" ) echo 'selected="selected"' ; ?> value="IN">India</option>
							<option <?php if ($country == "ID" ) echo 'selected="selected"' ; ?> value="ID">Indonesia</option>															
							<option <?php if ($country == "IE" ) echo 'selected="selected"' ; ?> value="IE">Ireland</option>
							<option <?php if ($country == "IL" ) echo 'selected="selected"' ; ?> value="IL">Israel</option>															
							<option <?php if ($country == "IT" ) echo 'selected="selected"' ; ?> value="IT">Italy</option>
							<option <?php if ($country == "JP" ) echo 'selected="selected"' ; ?> value="JP">Japan</option>															
							<option <?php if ($country == "KW" ) echo 'selected="selected"' ; ?> value="KW">Kuwait</option>
							<option <?php if ($country == "MX" ) echo 'selected="selected"' ; ?> value="MX">Mexico</option>															
							<option <?php if ($country == "NL" ) echo 'selected="selected"' ; ?> value="NL">Netherlands</option>
							<option <?php if ($country == "NZ" ) echo 'selected="selected"' ; ?> value="NZ">New Zealand</option>															
							<option <?php if ($country == "NO" ) echo 'selected="selected"' ; ?> value="NO">Norway</option>
							<option <?php if ($country == "PK" ) echo 'selected="selected"' ; ?> value="PK">Pakistan</option>															
							<option <?php if ($country == "PO" ) echo 'selected="selected"' ; ?> value="PO">Poland</option>
							<option <?php if ($country == "PT" ) echo 'selected="selected"' ; ?> value="PT">Portugal</option>															
							<option <?php if ($country == "RO" ) echo 'selected="selected"' ; ?> value="RO">Romania</option>
							<option <?php if ($country == "RU" ) echo 'selected="selected"' ; ?> value="RU">Russian Federation</option>															
							<option <?php if ($country == "ES" ) echo 'selected="selected"' ; ?> value="ES">Spain</option>
							<option <?php if ($country == "SE" ) echo 'selected="selected"' ; ?> value="SE">Sweden</option>															
							<option <?php if ($country == "TR" ) echo 'selected="selected"' ; ?> value="TR">Turkey</option>
							<option <?php if ($country == "GB" ) echo 'selected="selected"' ; ?> value="GB">United Kingdom</option>															
							<option <?php if ($country == "US" ) echo 'selected="selected"' ; ?> value="US">United States</option>
							</select>
</div-->								
										
                                            <div class="form-group col-md-4">
                                                <label for="inputState">State</label>
                                                <select name="state" class="form-control" required>                                                    
                                                    <option <?php if ($state == "AS" ) echo 'selected="selected"' ; ?> value="AS">Assam</option>
													<option <?php if ($state== "AP" ) echo 'selected="selected"' ; ?> value="AP">Andhra Pradesh</option>
													<option <?php if ($state == "OR" ) echo 'selected="selected"' ; ?> value="OR">Orissa</option>
													<option <?php if ($state == "PB" ) echo 'selected="selected"' ; ?> value="PB">Punjab</option>
                                                    <option <?php if ($state == "DL" ) echo 'selected="selected"' ; ?> value="DL">Delhi</option>  
													<option <?php if ($state == "GJ" ) echo 'selected="selected"' ; ?> value="GJ">Gujarat</option>
													<option <?php if ($state == "KA" ) echo 'selected="selected"' ; ?> value="KA">Karnataka</option>
													<option <?php if ($state == "HR" ) echo 'selected="selected"' ; ?> value="HR">Haryana</option>
													<option <?php if ($state == "RJ" ) echo 'selected="selected"' ; ?> value="RJ">Rajasthan</option>
													<option <?php if ($state == "HP" ) echo 'selected="selected"' ; ?> value="HP">Himachal Pradesh</option>
                                                    <option <?php if ($state == "UK" ) echo 'selected="selected"' ; ?> value="UK">Uttarakhand</option>
													<option <?php if ($state == "JH" ) echo 'selected="selected"' ; ?> value="JH">Jharkhand</option>
													<option <?php if ($state == "CH" ) echo 'selected="selected"' ; ?> value="CH">Chhatisgarh</option>
													<option <?php if ($state == "KL" ) echo 'selected="selected"' ; ?> value="KL">Kerala</option>
													<option <?php if ($state == "TN" ) echo 'selected="selected"' ; ?> value="TN">Tamilnadu</option>
													<option <?php if ($state == "MP" ) echo 'selected="selected"' ; ?> value="MP">Madhiya Pradesh</option>
													<option <?php if ($state == "WB" ) echo 'selected="selected"' ; ?> value="WB">West Bengal</option>
													<option <?php if ($state == "BR" ) echo 'selected="selected"' ; ?> value="BR">Bihar</option>
												    <option <?php if ($state == "MH" ) echo 'selected="selected"' ; ?> value="MH">Maharastra</option>
													<option <?php if ($state == "UP" ) echo 'selected="selected"' ; ?> value="UP">Uttar Pradesh</option>
												    <option <?php if ($state == "CH" ) echo 'selected="selected"' ; ?> value="CH">Chandigarh</option>
													<option <?php if ($state == "TG" ) echo 'selected="selected"' ; ?> value="TG">Telangana</option>
													<option <?php if ($state == "JK" ) echo 'selected="selected"' ; ?> value="JK">Jammu & Kashmir</option>
													<option <?php if ($state == "TR" ) echo 'selected="selected"' ; ?> value="TR">Tripura</option>
													<option <?php if ($state == "ML" ) echo 'selected="selected"' ; ?> value="ML">Meghalaya</option>
													<option <?php if ($state == "GA" ) echo 'selected="selected"' ; ?> value="GA">Goa</option>
													<option <?php if ($state == "AR" ) echo 'selected="selected"' ; ?> value="AR">Arunachal Pradesh</option>
													<option <?php if ($state == "MN" ) echo 'selected="selected"' ; ?> value="MN">Manipur</option>
													<option <?php if ($state == "MZ" ) echo 'selected="selected"' ; ?> value="MZ">Mizoram</option>
													<option <?php if ($state == "SK" ) echo 'selected="selected"' ; ?> value="SK">Sikkim</option>
													<option <?php if ($state == "PY" ) echo 'selected="selected"' ; ?> value="PY">Pudhuchery</option>
													<option <?php if ($state == "NL" ) echo 'selected="selected"' ; ?> value="NL">Nagaland</option>
													<option <?php if ($state == "AN" ) echo 'selected="selected"' ; ?> value="AN">Andaman & Nicobar</option>
													<option <?php if ($state == "DH" ) echo 'selected="selected"' ; ?> value="DH">Dadra & Nagar Haveli</option>
													<option <?php if ($state == "DD" ) echo 'selected="selected"' ; ?> value="DD">Damen & Diu</option>
													<option <?php if ($state == "LD" ) echo 'selected="selected"' ; ?> value="LD">Lakshadweep</option>
                                                </select>
                                            </div>
                                         </div>
										

                                    
                                <div class="form-row">
                                    <div class="form-group">
                                        <label>
                                            <div class="fa-hover col-md-12 col-sm-12">
                                                &nbsp;<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload Company Logo</div>
                                        </label> 
                                        <img src="<?php echo $image;?>" width="100px" class="rounded float-left" alt="...">

                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group text-right m-b-10">
                                        <input type="hidden" name="compId" value="<?=$_GET['id']?>">
                                        &nbsp;<button class="btn btn-primary" name="compProfEdit" type="submit">
                                        Update
                                        </button>                                                       
                                    </div>
                                </div>
                                </form>


                        </div>							
                    </div><!-- end card-->					
                </div>
				
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
				<script>
                function onState(){

                    console.log(this);
                }
            </script>
            
            <!-- BEGIN Java Script for this page -->
<!--
            <script>
                function oncompcode(){

                    console.log(this);
                }
            </script>
-->
            <!-- END Java Script for this page -->
            </body>
        </html>