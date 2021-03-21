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
	//$category=$_POST['category'];//same
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
	$sql = "INSERT into purchaseitemaster(`itemcode`,`itemname`,`vendor`,`description`,
															  `priceperqty`,`uom`,`taxmethod`,`taxname`,`hsncode`,`pricedatefrom`,
														  `stockinqty`,`stockinuom`,`lowstockalert`,`stockasofdate`,`handler`,`notes`)
								      VALUES ('$itemcode','$itemname','$vendor','$description','$priceperqty','$uom',
							              '$taxmethod','$taxname','$hsncode','$pricedatefrom','$stockinqty','$stockinuom','$lowstockalert','$stockasofdate',
						              '$handler','$notes')";
									  
   // Inserting Log details into purchaseitemlog
	$sql1= "INSERT into purchaseitemlog(`itemcode`,`itemname`,`oldpriceqty`,`olduom`,`oldstock`,`createdby`,`createdon`,`stockasofdate`,`notes`)
										VALUES ('$itemcode','$itemname','$priceperqty','$uom','$stockinqty','$handler','$pricedatefrom','$stockasofdate','$notes')";

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
<?php include('header.php'); ?>
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
									
									  <label></i>Material/Item Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control form-control-sm" name="itemname" placeholder="Purchase Product Name" required class="form-control" autocomplete="off">
									  </div>
									  </div>
									  
									  
									  <div class="form-row">
									<div class="form-group col-md-6">
									 <label for="inputState">Vendor Name</label>
                                                <select id="compcode" onchange="onvendor(this);" class="form-control form-control-sm"  required name="vendor" autocomplete="off">
                                                    <option selected>Open Vendors</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"SELECT concat(title,' ',supname) as vendor FROM vendorprofile
																				ORDER BY id ASC
																				");
                                                      while ($row = $sql->fetch_assoc()){	
                                                        echo $vendor=$row['vendor'];
														echo '<option onchange="'.$row[''].'" value="'.$vendor.'" >'.$vendor.'</option>';
                                                      
													  }
                                                    ?>
                                                </select></div>
									  </div>
									  
									  <div class="form-row">
									<div class="form-group col-md-6">
									 <label>Description</label></span>
									  <input type="textarea" rows="2" class="form-control" name="description" placeholder="add product description">
									  </div>
									  </div>
									
									
									  <div class="form-row">
									<div class="form-group col-md-6">
									  <h5>Price Information</h5>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-3">
									<i class="fa fa-rupee fonts" aria-hidden="true"></i>
									 <label>Price/Qty<span class="text-danger">*</label></span>
									<input type="text" name="priceperqty" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off">
									 </div>
									 
									
								    <div class="form-group col-md-3">									
									<label>UOM&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
									 <span class="text-danger"></label>
									<input type="text" name="uom" class="form-control form-control-sm" autocomplete="off" placeholder="Eg.Litters,Kgs.." required>
									 </div>
									  </div>
									
									
							
							<div class="form-row">
									<div class="form-group col-md-3">
									  <label for="inputState">Tax Method&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="Tax Method - Whether to include TAX or exclude TAX for this Item"></i>
									 </label>
									  <select id="inputState" class="form-control form-control-sm" name="taxmethod">
										<option selected>Select Tax Method</option>
										<option value="1">Inclusive</option>
										<option value="0">Exclusive</option>
									</select>
									</div>
							
								
									<div class="form-group col-md-3">
									            <label for="inputState">Tax Name%</label>
                                                <select id="onshpvia" onchange="onshpvia(this)" required class="form-control form-control-sm" name="taxname">
                                                    <option selected>Open Taxrate</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT taxname FROM taxmaster where purchaseoption = '1'");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $taxname=$row['taxname'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$taxname.'" >'.$taxname.'</option>';
                                                    }
                                                    ?>
                                                </select>	
									</div>							
								</div>
								
								
									 
							<div class="form-row">
									<div class="form-group col-md-6">
									 <label>HSN Code</label>
									  <input type="text" name="hsncode" class="form-control form-control-sm"  placeholder="Enter a valid HSN Code.." required >
								   </div>
								   </div>
								   
									<div class="form-row">
									<div class="form-group col-md-6">
									 <label>As of Date<span class="text-danger">*</label>&nbsp;</span><span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="Date From - is used to set the date of last updated price"></i>
									 </span></label>
									  <input type="date" name="pricedatefrom" class="form-control form-control-sm"  placeholder="Price Date Since.." required >
								   </div>
								   </div>

								
								 <div class="form-row">
									<div class="form-group col-md-6">
									  <h5>Stock Information</h5>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-3">
									 <label>Initial Qty on Hand<span class="text-danger">*</label></span>
									 <input type="text" class="form-control form-control-sm" name="stockinqty" placeholder="Current Stock in quantity" required autocomplete="off">
									</div>
									 
								
									 <div class="form-group col-md-3">
									 <div class="invoice-title text-left mb-6">
									 <label>Oty in UOM</label>
									 <input type="text" class="form-control form-control-sm" name="stockinuom" placeholder="Unit of Measure, like boxes,kgs.."  required class="form-control" autocomplete="off">
									 </div>
									 </div>
									 </div>
							
									  
									  
									 <div class="form-row">
									<div class="form-group col-md-3">									  
									  <label>Low Stock Alert</label>
									  <input type="text" class="form-control form-control-sm" name="lowstockalert" placeholder="eg., 5  or 10 "  required class="form-control" autocomplete="off">
									</div>
									
									<div class="form-group col-md-3">
									<label for="inputState">As of Date</label>
									  <input type="date" class="form-control form-control-sm" name="stockasofdate" class="form-control" autocomplete="off">
									</div>
									</div>
									
									
									<!--div class="form-row">
									<div class="form-group col-md-2">
                                                <label for="inputState">Usage Unit</label>
									  <select id="inputState" class="form-control form-control-sm" name="usageunit">
										
										<option value="1">Box</option>
										<option value="2">Quantity</option>
										<option value="3">Pieces</option>
									</select>
                                      </div-->
									  
									  <div class="form-row">
									<div class="form-group col-md-6">
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