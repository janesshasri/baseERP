<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['purpriceEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
	
	
	
    $updateUser = "UPDATE purpricemaster set    `taxmethod` =  '".$taxmethod."'	
												,`taxrate` 	=  '".$taxrate."'
												,`priceperqty` =  '".$priceperqty."'		
												,`priceperuom` =	 '".$priceperuom."'
												,`datefrom` =  '".$datefrom."'
												,`notes`  =  '".$notes."'
										WHERE `id` =".$purpriceID;
	//echo $updateUser;
    if(mysqli_query($dbcon,$updateUser))
    {
		echo "<script>alert('User Successfully updated')</script>";
		header("location:listPurchasePriceMaster.php");
    } else { echo 'Failed to update user';
	exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-
		
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
		
		 <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  
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
                                    <h1 class="main-title float-left">Please update the information below</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Edit Purchase Price Master</li>
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
			
                    <div class="col-xs-10 col-sm-10 col-md-6 col-lg-6 col-xl-6">						
					
						
							<div class="card mb-6">
						<div class="card-header">
						
								<h5><i class="fa fa-pencil-square-o"></i>&nbsp;Edit Purchase Price Master</b></h5>
								 </div>

	<div class="card-header">
	<div class="container">
   <!--ul class="nav nav-pills">
    <!--li class="active"><a data-toggle="pill" href="edit">Edit</a></li-->
    <!--li><a data-toggle="pill" href="#avatar">Avatar</a></li-->
    <!--li><a data-toggle="pill" href="#menu2">Change Password</a></li-->
   </ul-->
   </div>
  
									
									<form method="post" action="editPurchasePriceMaster.php" enctype="multipart/form-data">
                                    <?php
                                        include("database/db_conection.php");//make connection here
										if(isset($_GET['id']))
                                        {
                                            $id=$_GET['id'];
                                            //selecting data associated with this particular id
                                            $result = mysqli_query($dbcon, "SELECT * FROM purpricemaster WHERE id=$id");
                                            while($res = mysqli_fetch_array($result))
                                            {
												$itemcode = $res['itemcode'];
												$taxmethod= $res['taxmethod'];
												$taxrate  = $res['taxrate'];
												$priceperqty = $res['priceperqty'];
												$priceperuom = $res['priceperuom'];
												$datefrom 	 = $res['datefrom'];
												$notes       = $res['notes'];
                                            }
                                        }
                                        ?>
										
									<div class="form-group>
									  <label for="inputZip">Item Code<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="itemcode" readonly  value="<?php echo $itemcode;?>" />
									</div><br>
									
											<div class="form-group">
													<label>Tax Method</label>
													<select name="taxmethod" class="form-control" >
													<option <?php if ($taxmethod == "1" ) echo 'selected="selected"' ; ?> value="1">Inclusive</option>
													<option <?php if ($taxmethod == "0" ) echo 'selected="selected"' ; ?> value="0">Exclusive</option>
													</select>
													</div>
													
													<div class="form-group">
												    <label for="inputState">Taxrate(%)</label>
											       <select id="groupname" onchange="ongroup(this)" class="form-control" name="taxrate">
                                                   <?php 
														include("database/db_conection.php");//make connection here
														$sql = mysqli_query($dbcon,"select taxrate from taxmaster");
														while ($row = $sql->fetch_assoc()){	

															echo $taxrate_get=$row['taxrate'];
															if($taxrate_get==$taxrate){
																echo '<option value="'.$taxrate_get.'" selected>'.$taxrate_get.'</option>';

															}else{
																echo '<option value="'.$taxrate_get.'" >'.$taxrate_get.'</option>';

															}
														}
                                                    ?>
													</select>
													</div>
													
													<div class="form-group">
														<label class="fa fa-rupee bigfonts" aria-hidden="true">&nbsp;Price/Qty</label>
														<input type="text" class="form-control"  name="priceperqty"  value="<?php echo $priceperqty;?>" />
													</div>						
										
													<div class="form-group">
														<label class="fa fa-rupee bigfonts" aria-hidden="true">&nbsp;Price/UOM</label>
														<input type="text" class="form-control"  name="priceperuom"  value="<?php echo $priceperuom;?>" />
													</div>						
													
													<div class="form-group">
														<label>Date From</label>
														<input type="date" class="form-control"  name="datefrom"  value="<?php echo $datefrom;?>" />
													</div>	
													
													<div class="form-group">
														<label>Notes</label>
														<input type="textarea" rows="3" class="form-control"  name="notes"  value="<?php echo $notes;?>" />
													</div>
									           
									
									<div class="modal-footer">
										<input type="hidden" name="purpriceID" value="<?=$_GET['id']?>">
										<button type="submit" name="purpriceEdit" value="purpriceEdit" class="btn btn-primary">Update</button>
									</div>
									</div>
										
									</form>	
									
								</div>
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
<script>	
				
				function ongroup(){

                    console.log(this);
                }
            </script>
</body>
</html>