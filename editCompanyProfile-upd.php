<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['compProfEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
    $updateComprofile = "UPDATE `comprofile` SET `compcode` = '".$compcode."', `title` = '".$title."', `name` = '".$cname."',
						`location` = '".$locname."',`address`  = '".$address."',`city`  = '".$city."',`email`  = '".$email."',
						`web`  = '".$web."',`phone`  = '".$phone."',`mobile`  = '".$mobile."',`gst`  = '".$gst."',`pan`  = '".$pan."'
						 WHERE `id` =". $compId;
    if(mysqli_query($dbcon,$updateComprofile))
    {
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
												$result = mysqli_query($dbcon, "SELECT * FROM comprofile WHERE id=$id");
									 
												while($res = mysqli_fetch_array($result))
												{
													//$title = $res['title'];
													//$cname= $res['name'];
													$compcode = $res['compcode'];												
													$title=$res['title'];
													$cname=$res['name'];												 
													$locname=$res['location'];
													$address=$res['address'];
													$city=$res['city'];
													$state=$res['state'];
													$country=$res['country'];
													$zip=$res['zip'];
													$email=$res['email'];
													$web=$res['web'];
													$phone=$res['phone'];
													$mobile=$res['mobile'];
													$gst=$res['gst'];
													$pan=$res['pan'];
													$image=$res['image'];
													
												}
											}
												
											?>	
<!--?php
$sql=mysql_query("SELECT id,name FROM table");
if(mysql_num_rows($sql)){
$select= '<select name="select">';
while($rs=mysql_fetch_array($sql)){
    if($rs['name']=="users value"){
              $select.='<option value="'.$rs['name'].'" selected="selected">'.$rs['name'].'</option>';

    }else{
              $select.='<option value="'.$rs['name'].'">'.$rs['name'].'</option>';
    }
  }
}
 $select.='</select>';
?-->
							
										
									<div class="form-row">
									<div class="form-group col-md-4">
									  <label for="inputState">Company Code</label>
									 <select id="locname" onchange="oncompcode(this)" class="form-control" name="compcode">
									<option selected>Open Company Code</option>
										 	<?php 
											include("database/db_conection.php");//make connection here
											$sql = mysqli_query($dbcon,"select compcode from comprofile");
											//$sql = mysqli_query($dbcon, "SELECT locname FROM location");
											while ($row = $sql->fetch_assoc()){	
											echo $compcode=$row['compcode'];
											   echo '<option value="'.$compcode.'" >'.$compcode.'</option>';
											}
											?>
									  </select>
									</div>
									</div>
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label >Company Type:</label>
									  <!--input type="text" class="form-control" name="cname" placeholder="Company Type" required  readonly=""-->
									</div>
									</div>
									
									    <div class="form-row">
										<div class="form-group col-md-3">
										<label>Title</label>
									  <select name="title" class="form-control" required>
									   <option <?php if ($title == "M/S." ) echo 'selected="selected"' ; ?> value="M/S.">M/S.</option>
									    <option <?php if ($title == "Mr." ) echo 'selected="selected"' ; ?> value="Mr.">Mr.</option>
										<option <?php if ($title == "Mrs." ) echo 'selected="selected"' ; ?> value="Mrs.">Mrs.</option>
									  </select>
									</div>
									
									
									<div class="form-group col-md-8">
									  <label >Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="cname" placeholder="Company Name" required  value="<?php echo $cname;?>" />
									</div>
									</div>
								
								
									 <div class="form-row">
									<div class="form-group col-md-4">
									  <label for="inputState">Location</label>
									 <select id="locname" onchange="onlocode(this)" class="form-control" name="locname">
									<option selected>Open Location</option>
										 	<?php 
											include("database/db_conection.php");//make connection here

											$sql = mysqli_query($dbcon, "SELECT locname FROM location");
											while ($row = $sql->fetch_assoc()){	
											echo $locname=$row['locname'];
											   echo '<option value="'.$locname.'" >'.$locname.'</option>';
											}
											?>
									  </select>
									</div>
								</div>
									
									<div class="form-row">
								   <div class="form-group col-md-12">
                                    <label>Address<span class="text-danger">*</span></label>
                                    <div>
                                     <input type="textarea" name="address" class="form-control" placeholder="Building No,locality,Street ..."
									 required class="form-control" value="<?php echo $address;?>" /></textarea>
                                     </div>
									 </div>
								
									
									 
								 
									<div class="form-group col-md-6">
									  <label for="inputCity">City</label>
									  <input type="text" class="form-control" id="city" name="city" placeholder="City/Town/Village ..."value="<?php echo $city;?>" />
									</div>
									 </div>
									<!--div class="form-group col-md-6">
									  <label for="inputState">State</label>
									  <select id="inputState" class="form-control" name="state">
										<option selected>Choose...</option>
										<option value="Tamilnadu">Tamilnadu</option>
										<option value="Andhra">Andhra</option>
										<option value="Kerala">Kerala</option>
										<option value="Karnataka">Karnataka</option>
										<option value="Maharastra">Maharastra</option>
										<option value="Utharapradesh">Utharapradesh</option>
										<option value="Telungana">Telungana</option>
										<option value="Telungana">Pondichery</option>
									  </select>
									</div>
									</div>
									</div-->
									
									<!--div class="form-row">
									<div class="form-group col-md-6">
									  <label>Country</label>
									  <select id="inputState" class="form-control" name="country">
										<option selected>Choose...</option>
										<option value="India">India</option>
										<option value="America">America</option>
									  </select>
									</div>
									</div-->
																	
									
									<div class="form-row">
									<div class="form-group col-md-3">
									  <label>Zip</label>
									  <input type="text" class="form-control" id="zip" name="zip" placeholder="600040" value="<?php echo $zip;?>" />
									</div>	
									
									<div class="form-group col-md-6">
                                     <label>Email<span class="text-danger">*</span></label>
                                    <input type="email" name="email" data-parsley-trigger="change" 
									required placeholder="Enter email address" class="form-control" id="email" name="email" value="<?php echo $email;?>" />
                                     </div>
									 </div>		
									 
								
									
								  <div class="form-row">
									<div class="form-group col-md-3">
									  <label>Phone</label>
									  <input type="text" class="form-control" id="phone" name="phone" placeholder="044-12345678" value="<?php echo $phone;?>" />
									</div>
									
									<div class="form-row">
								  <div class="form-group col-md-12">
									  <label>Mobile<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" id="mobile1" name="mobile" placeholder="9898989898"  value="<?php echo $mobile;?>" />
									</label>
									</div>
								  </div>
								  </div>
								  
								    <div class="form-row">
									<div class="form-group col-md-6">
									<label>Web</label>
									  <input type="text" class="form-control" id="web" name="web" placeholder="www.companyname.com" value="<?php echo $web;?>" />
									</div>
									</div>
								  
								  <div class="form-row">
									<div class="form-group col-md-4">
									  <label>GST<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" id="gst" name="gst" placeholder="GST no..." required value="<?php echo $gst;?>" />
									</div>
									<div class="form-group col-md-4">
									  <label>PAN</label>
									  <input type="text" class="form-control" id="pan" name="pan" placeholder="Pan no.." value="<?php echo $pan;?>" />
									</div>
									</div>
								  <div class="form-group">
									<div class="form-check">
									  <label class="form-check-label">
										<input class="form-check-input" type="checkbox"> Check me out
									  </label>
									</div>
								  </div>
								 <div class="form-row">
									<div class="form-group">
									<label>
									<div class="fa-hover col-md-12 col-sm-12">
									&nbsp;<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload Company Logo</div>
									</label> 
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

<!-- BEGIN Java Script for this page -->
<script>
function oncompcode(){
	
	console.log(this);
}
</script>
<!-- END Java Script for this page -->
<script>
function onlocode(){
	
	console.log(this);
}
</script>
</body>
</html>