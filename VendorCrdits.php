<?php
include("database/db_conection.php");//make connection here

	
	/*$con = mysqli_connect("localhost","root","root","dhirajpro");
	// Check connection
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}*/

if(isset($_POST['submit']))
{	$itemcode ="";
	$prefix = "DAPL00";
	//$postfix = "/";
	//$today = date("dmy");
    $itemname=$_POST['itemname'];//here getting result from the post array after submitting the form.
	$vendor=$_POST['vendor'];//same
    $description=$_POST['description'];//same
	$category=$_POST['category'];//same
    //$status 	=$_POST['status'];
    $priceperqty 		=$_POST['priceperqty'];
    $uom 		=$_POST['uom'];
    $taxmethod 		=$_POST['taxmethod'];
    $taxname	=$_POST['taxname'];
	$hsncode =$_POST['hsncode'];
    $pricedatefrom 	=$_POST['pricedatefrom'];
    $stockinqty 	=$_POST['stockinqty'];
    $stockinuom	=$_POST['stockinuom'];
	$lowstockalert	=$_POST['lowstockalert'];
	$stockasofdate =$_POST['stockasofdate'];
	//$qtyondemand=$_POST['qtyondemand'];
    //$usageunit =$_POST['usageunit'];
    $handler 	=$_POST['handler'];
	$notes = $_POST['notes'];
	$disptaxrate = $_POST['disptaxrate'];
	$disptax = $_POST['disptax'];
	$product_price = $_POST['product_price'];
	$final_price = $_POST['final_price'];
	

	
	
   $sql="SELECT MAX(id) as latest_id FROM purchaseitemaster ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$itemcode = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$itemcode = $prefix.$maxid;
		}
	}
	$sql = "INSERT into purchaseitemaster(`itemcode`,
										`itemname`,
										`vendor`,
										`description`,
										`category`,
										`priceperqty`,
										`uom`,
										`taxmethod`,
										`taxname`,
										`taxrate`,
										`taxamount`,
										`itemcost`,
										`taxableprice`,
										`hsncode`,
										`pricedatefrom`,
										`stockinqty`,
										`stockinuom`,
										`lowstockalert`,
										`stockasofdate`,
										`handler`,
										`notes`)
								VALUES ('$itemcode',
								        '$itemname',
										'$vendor',
										'$description',
										'$category',
										'$priceperqty',
										'$uom',
										'$taxmethod',
										'$taxname',
										'$disptaxrate',
										'$disptax',
										'$product_price', 
										'$final_price',
										'$hsncode',
										'$pricedatefrom',
										'$stockinqty',
										'$stockinuom',
										'$lowstockalert',
										'$stockasofdate',
						                '$handler',
										'$notes')";
									  
   // Inserting Log details into purchaseitemlog
	$sql1= "INSERT into purchaseitemlog(`itemcode`,
										`itemname`,
										`category`,
										`oldpriceqty`,
										`olduom`,
										`oldstock`,
										`taxmethod`,
										`taxname`,
										`taxrate`,
										`taxamount`,
										`itemcost`,
										`taxableprice`,
										`hsncode`,
										`createdby`,
										`createdon`,
										`stockasofdate`,
										`notes`)
								VALUES ('$itemcode',
										'$itemname',
										'$category',
										'$priceperqty',
										'$uom',
										'$stockinqty',
										'$taxmethod',
										'$taxname',
										'$disptaxrate',
										'$disptax',
										'$product_price', 
										'$final_price',
										'$hsncode',
										'$handler',
										'$pricedatefrom',
										'$stockasofdate',
										'$notes')";

//echo "$insert_purchaseItemMaster";	
										
   if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
	{
		header("location:listPurchaseItemMaster.php");
    }   else {
		die('Error: ' . mysqli_error($dbcon));
	    echo "<script>alert('User creation unsuccessful ')</script>";
	}
}

?>
<?php include('header.php');?>
	<!-- End Sidebar -->

   
    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Purchase Item Master</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Purchase Item Master</li>
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
								<h3><class="fa-hover col-md-12 col-sm-12">
								<i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i> Purchase Item Master
								</h3>
							</div>
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">
									
									<div class="form-row">
										<div class="form-group col-md-6">
											<label></i>Item Name<span class="text-danger">*</span></label>
											<input type="text" class="form-control form-control-sm" name="itemname" placeholder="Product Name" required class="form-control" autocomplete="off" />
										</div>
									</div>
									
								<div class="form-row">
										<div class="form-group col-md-6">
											<label for="inputState">Category</label>
											<select id="category" onchange="onvendor(this);" class="form-control form-control-sm"  required name="category" autocomplete="off">
												<option selected>Select Category</option>
												<?php 
												include("database/db_conection.php");//make connection here
												$sql = mysqli_query($dbcon,"SELECT code,category FROM itemcategory
																			ORDER BY id ASC
																			");
												  while ($row = $sql->fetch_assoc()){	
													echo $category_code=$row['code'];
													echo $category=$row['category'];
													echo '<option onchange="'.$row[''].'" value="'.$category_code.'" >'.$category.'</option>';
												  
												  }
												?>
											</select>
											<a href="#custom-modal" data-target="#customModal" data-toggle="modal"> 
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add New Category</a><br>
								
								<!-- Modal -->
								<div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel2">Add New Category</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  	<form action="#" enctype="multipart/form-data" method="post">
									  
											<div class="form-group">
												<input type="text" class="form-control" name="addcategory"  id="addcategory"  placeholder="Add Category">
											</div>											
										</div>
										
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" name="submitcategory" id="submitcategory" class="btn btn-primary">Save and Associate</button>
									  </div>
									</div>
								  </div>
								</div>
							
								
							
											
										</div>
									</div>
									
									<div class="form-row">
										<div class="form-group col-md-6">
											<label for="inputState">Vendor Name</label>
											<select id="compcode" onchange="onvendor(this);" class="form-control form-control-sm"  required name="vendor" autocomplete="off">
												<option selected>Open Vendors</option>
												<?php 
												include("database/db_conection.php");//make connection here
												$sql = mysqli_query($dbcon,"SELECT vendorid,concat(title,' ',supname) as vendorname FROM vendorprofile
																			ORDER BY id ASC
																			");
												  while ($row = $sql->fetch_assoc()){	
													echo $vendorid=$row['vendorid'];
													echo $vendorname=$row['vendorname'];
													echo '<option onchange="'.$row[''].'" value="'.$vendorid.'" >'.$vendorname.'</option>';
												  
												  }
												?>
											</select>
										</div>
									</div>
									  
									<div class="form-row">
										<div class="form-group col-md-6">
											<label>Description</label></span>
											<input type="text"  class="form-control form-control-sm" name="description" placeholder="add product description" />
										</div>
									</div>
									
									<div class="form-row">
										<div class="form-group col-md-6">
											<h5>Purchase Price Information</h5>
										</div>
									</div>
									
									<div class="form-row">
										<div class="form-group col-md-3">
											<i class="fa fa-rupee fonts" aria-hidden="true"></i>
											<label>Price/Qty<span class="text-danger">*</label></span>
											<input type="text" onchange="gettaxrate()" name="priceperqty" id="priceperqty" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" />
										</div>
									
									<div class="form-group col-md-3">
									            <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
										  data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
											<span class="text-danger"></label>
                                                <select id="uom" onchange="gettaxrate()" required class="form-control form-control-sm" name="uom">
                                                    <option value="0" selected>Select UOM</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT code,description FROM uom_lookups ");
                                                    while ($row = $sql->fetch_assoc()){	
                                                         $description=$row['description'];
														 $code=$row['code'];
                                                      echo '<option  value="'.$code.'" >'.$description.'</option>';
                                                    }
                                                    ?>
                                                </select>	
									</div>							
									</div>
									<div class="form-row">
									  <div class="form-group col-md-6">
									  <label for="inputState">Handler</label>
									  <?php 
														//session_start();
														include("database/db_conection.php");
														$userid = $_SESSION['userid'];
														$sq = "select username from userprofile where id='$userid'";
														$result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
														//$count = mysqli_num_rows($result);
														$rs = mysqli_fetch_assoc($result);
													?>
									   <input type="text" class="form-control form-control-sm" name="handler" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />
									
									 </div>
									 </div>
									 
									<div class="form-row">
									<div class="form-group col-md-6">
									  <h5>Notes Information</h5>
									  </div>
									</div>
									
									
								
									
									<div class="form-row">
									<div class="form-group col-md-6">
									 <label>Add Notes</label></span>
									  <textarea rows="2" class="form-control editor" id="notes" name="notes" placeholder="add product/price/stock related notes here"></textarea>
									</div> 
								</div>
									
							
									
									<div class="form-row">
								    <div class="form-group text-right m-b-12">
                                                       <input type="hidden" name="id" >
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
	<!-- BEGIN Java Script for this page -->