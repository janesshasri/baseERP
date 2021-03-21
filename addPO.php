<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
//here getting result from the post array after submitting the form.
	
$title =	$_POST['title'];
$supname 	 =	$_POST['supname'];	
//$portal 	 =	$_POST['portal'];
$suptype  =	$_POST['suptype'];	
$blocation 	 =	$_POST['blocation'];
//$industry 	 =	$_POST['industry'];	
$address  =	$_POST['address'];		
$city 	 =	$_POST['city'];	
$country  =	$_POST['country'];		
$state  =	$_POST['state'];		
$zip  =	$_POST['zip'];		
$workphone 	 =	$_POST['workphone'];	
$mobile 	 =	$_POST['mobile'];	
$email 	 =	$_POST['email'];	
$web 	 =	$_POST['web'];	
$gstin 	 =	$_POST['gstin'];	
//$gstregdate 	 =	$_POST['gstregdate'];	
//$primaryflag 	 =	$_POST['primaryflag'];
$image 	 =	$_POST['image'];
	

//	$image = file_get_contents($image
//$target_dir = "upload/";
 // $target_file = $target_dir . basename($_FILES["image"]["name"]);
   // $uploadOk = 1;
    //$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    //$check = getimagesize($_FILES["image"]["tmp_name"]);
    //if($check !== false) {
      //  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
        //} else {
          //  echo "Sorry, there was an error uploading your file.";
        //}

    //} else {
      //  echo "File is not an image.";
        //$uploadOk = 0;
    //}
    //$image =base64_encode($image);	

//Generating Vendor ID
$vendorid ="";
$prefix = "DAPL00";
 $sql="SELECT MAX(id) as latest_id FROM vendorprofile ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$vendorid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$vendorid = $prefix.$maxid;
		}
	}	
												    
	
    $insert_vendorprofile="INSERT INTO vendorprofile(vendorid,title,supname,suptype,blocation,address,city,state,country,zip,workphone,mobile,email,web,gstin) 
	VALUES('$vendorid','$title','$supname','$suptype','$blocation','$address','$city','$state','$country','$zip','$workphone','$mobile','$email','$web','$gstin')";
	
	echo "$insert_vendorprofile";
	
	if(mysqli_query($dbcon,$insert_vendorprofile))
	{
   
		echo "<script>alert('Company Code/Type creation Successful ')</script>";
		header("location:listVendorProfile.php");
    } else {
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
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
                                    <h1 class="main-title float-left">Purchase Order</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Purchase Order</li>
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
								<h5><div class="text-muted font-light"><i class="fa fa-shopping-cart bigfonts" aria-hidden="true">
								</i>&nbsp;Purchase Order<span class="text-muted"></span></div></h5>
								
								<div class="text-muted font-light">Create Purchase Order</div>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
								
							</div>
								
							<div class="card-body">
								
								<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">
								<div class="form-row">
									<div class="invoice-title text-left mb-6">
									  <h4 class="col-md-12 text-muted">Purchase Order Information &nbsp;</h4>
									  </div>
									</div>
									
									<div class="form-row">
                                            <div class="form-group col-md-8">
											   <label for="inputState">Purchase Order Owner</label>
                                                <select id="username" onchange="onuser(this)" required class="form-control form-control-sm" name="username">
                                                    <option selected>Open users</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT username FROM userprofile");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $powner=$row['username'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$powner.'" >'.$powner.'</option>';
                                                    }
                                                    ?>
                                                </select>	
											<!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                            </div>
									</div>					
										
										
										<div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="inputState">Vendor Name<span class="text-danger">*</span></label>
                                                <select id="compcode" onchange="onsupcode(this);" class="form-control form-control-sm" name="supcode">
                                                    <option selected>Open Vendor Code</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"select vendorid from vendorprofile");
                                                      while ($row = $sql->fetch_assoc()){	
                                                        echo $supcode_get=$row['vendorid'];
                                                        if($supcode_get==$_GET['vendorid']){
                                                                echo '<option value="'.$supcode_get.'"  selected>'.$supcode_get.'</option>';  
                                                        }else{
                                                            echo '<option value="'.$supcode_get.'" >'.$supcode_get.'</option>';      
                                                        }
													  }
                                                    ?>
                                                </select>
                                                <script>
                                                    function onsupcode(x)
                                                    {    
                                                        var supcode=x.value;
                                                        window.location.href = 'addPurchaseOrder.php?supcode='+supcode;
                                                    }
                                                </script>
                                            </div>
                                        </div>
										
									
										
									<div class="form-row">
									<div class="form-group col-md-8">									
									 <label>Subject<span class="text-danger"></label>
									 <input type="text" class="form-control form-control-sm"  name="subject" required placeholder="Plastics Requirment" 
									 autocomplete="off">
								    </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-4">									
									 <label>PO Date<span class="text-danger"><span class="text-danger">*</span></label>
									 <input type="date" class="form-control form-control-sm" id="date" name="podate" required autocomplete="off">
								    </div>
									
								      
                                            <div class="form-group col-md-4">											
                                                <label for="inputState">Payment Term<span class="text-danger">*</span></label>
                                                <select id="paymentterm" onchange="ongroup(this)" class="form-control"  name="paymentterm">
                                                    <option selected>Open Payment Term</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT paymentterm FROM paymentterm");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $paymentterm=$row['paymentterm'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$paymentterm.'" >'.$paymentterm.'</option>';
                                                    }
                                                    ?>
                                                </select>
								<!-- Button trigger modal -->
								<!--a role="button" href="" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
								  User Group
								</a-->
								<a style="color:cyan" data-target="#customModal" data-toggle="modal" >
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add New Pay Term</a>
								
								<!-- Modal -->
								<div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel2">Add Payment Term</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  	<form action="#" enctype="multipart/form-data" method="post">
									  
											<div class="form-group">
												<input type="text" class="form-control" name="addpaymentterm"  id="addpaymentterm"  placeholder="Due on Receipt,Advance,Net 15,Net 30,Net 45,Net60,Due EOM,Due NM,Immediate">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="adddescription" id="adddescription"  placeholder="description">
											</div>
										</div>
										
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" name="submitpaymentterm" id="submitpaymentterm" class="btn btn-primary">Save and Associate</button>
									  </div>
									</div>
								  </div>
								</div>
								</div>
								</div>
							
							<!-- Modal Ends-->
									
																		
									<div class="form-row">
                                            <div class="form-group col-md-4">											
                                                <label for="inputState">Shipping Via</label>
                                                <select id="onshpvia" onchange="onshpvia(this)" required class="form-control form-control-sm" name="shipvia">
                                                    <option selected>Open Shipping Via</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT transname FROM transportmaster");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $shipvia=$row['transname'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$shipvia.'" >'.$shipvia.'</option>';
                                                    }
                                                    ?>
                                                </select>	
											<!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                            </div>
									
									
                                            <div class="form-group col-md-4">											
                                                <label for="inputState">Delivery At</label>
                                                <select id="delvat" onchange="ondelat(this)" required class="form-control form-control-sm" name="delivat">
                                                    <option selected>Open Location</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT locname FROM location");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $delivat=$row['locname'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$delivat.'" >'.$delivat.'</option>';
                                                    }
                                                    ?>
                                                </select>	
											<!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                            </div>
									</div>
								
								
									
									<div class="form-row">
									<div class="form-group col-md-4">									
									 <label>Delivery Date<span class="text-danger"><span class="text-danger">*</span></label>
									 <input type="date" class="form-control form-control-sm" id="delivdate" name="delivdate" required autocomplete="off">
								    </div>
									
                                       <div class="form-group col-md-4">
										<label for="inputState">Status</label>
										<select id="inputState" class="form-control form-control-sm" required  name="postatus">
										<option value="1">Created</option>
										<option value="2">Approved</option>
										<option value="3">Delivered</option>
										<option value="4">Cancelled</option>
									  </select>											
                                    </div>
									</div>
									
								
									
									<div class="form-row">
									<div class="form-group col-md-8">									
									 <label>Freight<span class="text-danger"><span class="text-danger">*</span></label>
									 <input type="text" class="form-control form-control-sm" id="freight" name="freight" required placeholder="To-Pay or Pay-To" autocomplete="off">
								    </div>
									</div>
									<?php if (isset($_GET["supcode"])) {
                                                    $sup_code = $_GET["supcode"];
                                                    $sql = mysqli_query($dbcon,"SELECT vendorid,supname,address,country,state,city,zip,mobile,email,gstin FROM vendorprofile WHERE vendorid='$sup_code'");
											        $row = $sql->fetch_assoc();
                                                   
											         }
											
												
												?>
									<div class="form-row">								
									  <h4 class="col-md-12 text-muted">Address Information &nbsp;</h4>
									<div class="btn-group" role="group">
									<a id="btnGroupDrop1" role="button" href="#" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									  Copy Address
									</a>
									<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									<a class="dropdown-item" id="shipping_to_billing" href="#">Shipping to Billing</a>
									  <a class="dropdown-item" id="billing_to_shipping" href="#">Billing to Shipping</a>
									  
									  
									</div>
								  </div>
									</div>
									  </div>
									  
									
									<div class="form-row">	
									<div class="form-group col-md-4">
									<input type="text" placeholder="Billing Street"  name="billaddress" id="billaddress" required class="form-control form-control-sm" value="<?php echo $row['address']; ?>"> 
									</div>
										
                                    <div class="form-group col-md-4">
									<input type="text" placeholder="Shipping Street" name="shipaddress" id="shipaddress" required class="form-control form-control-sm"  > 
                                    </div>
									</div>
									
																		
									<div class="form-row">
									<div class="form-group col-md-4">
									  <input type="text" class="form-control form-control-sm" required name="billcity" id="billcity"  placeholder=" Billing City" value="<?php echo $row['city']; ?>">
									</div>
                                            <div class="form-group col-md-4">
										<input type="text" placeholder="Shipping City" name="shipcity" id="shipcity" required class="form-control form-control-sm"> 
                                    </div>
									</div>
									
									
									<div class="form-row">
									<div class="form-group col-md-4">
                                                <select id="billstate" class="form-control form-control-sm billstate" name="billstate">
												  <span class="text-muted"><option >Billing State</option> </span>
                                                    <option value="AS" <?php echo ($row['state']=='AS')?" selected":"";  ?>>Assam</option>
                                                    <option value="AP" <?php echo ($row['state']=='AP')?" selected":"";  ?>>Andhra Pradesh</option>
                                                    <option value="OR" <?php echo ($row['state']=='OR')?" selected":"";  ?>>Orissa</option>
                                                    <option value="PB" <?php echo ($row['state']=='PB')?" selected":"";  ?>>Punjab</option>
                                                    <option value="DL" <?php echo ($row['state']=='DL')?" selected":"";  ?>>Delhi</option>
                                                    <option value="GJ" <?php echo ($row['state']=='GJ')?" selected":"";  ?>>Gujarat</option>
                                                    <option value="KA" <?php echo ($row['state']=='KA')?" selected":"";  ?>>Karnataka</option>
                                                    <option value="HR" <?php echo ($row['state']=='HR')?" selected":"";  ?>>Haryana</option>
													<option value="RJ" <?php echo ($row['state']=='RJ')?" selected":"";  ?>>Rajasthan</option>
													<option value="HP" <?php echo ($row['state']=='HP')?" selected":"";  ?>>Himachal Pradesh</option>
													<option value="UK" <?php echo ($row['state']=='UK')?" selected":"";  ?>>Uttarakhand</option>
													<option value="JH" <?php echo ($row['state']=='JH')?" selected":"";  ?>>Jharkhand</option>
													<option value="CH" <?php echo ($row['state']=='CH')?" selected":"";  ?>>Chhatisgarh</option>
													<option value="KL" <?php echo ($row['state']=='KL')?" selected":"";  ?>>Kerala</option>
													<option value="TN" <?php echo ($row['state']=='TN')?" selected":"";  ?>>Tamilnadu</option>
													<option value="MP" <?php echo ($row['state']=='MP')?" selected":"";  ?>>Madhiya Pradesh</option>
													<option value="WB" <?php echo ($row['state']=='WB')?" selected":"";  ?>>West Bengal</option>
													<option value="BR" <?php echo ($row['state']=='BR')?" selected":"";  ?>>Bihar</option>
													<option value="MH" <?php echo ($row['state']=='MH')?" selected":"";  ?>>Maharastra</option>
													<option value="UP" <?php echo ($row['state']=='UP')?" selected":"";  ?>>Uttar Pradesh</option>
													<option value="CH" <?php echo ($row['state']=='CH')?" selected":"";  ?>>Chandigarh</option>
													<option value="TG" <?php echo ($row['state']=='TG')?" selected":"";  ?>>Telangana</option>
													<option value="JK" <?php echo ($row['state']=='JK')?" selected":"";  ?>>Jammu & Kashmir</option>
													<option value="TR" <?php echo ($row['state']=='TR')?" selected":"";  ?>>Tripura</option>
													<option value="ML" <?php echo ($row['state']=='ML')?" selected":"";  ?>>Meghalaya</option>
													<option value="GA" <?php echo ($row['state']=='GA')?" selected":"";  ?>>Goa</option>
													<option value="AR" <?php echo ($row['state']=='AR')?" selected":"";  ?>>Arunachal Pradesh</option>
													<option value="MN" <?php echo ($row['state']=='MN')?" selected":"";  ?>>Manipur</option>
													<option value="MZ" <?php echo ($row['state']=='MZ')?" selected":"";  ?>>Mizoram</option>
													<option value="SK" <?php echo ($row['state']=='SK')?" selected":"";  ?>>Sikkim</option>
													<option value="PY" <?php echo ($row['state']=='PY')?" selected":"";  ?>>Pudhuchery</option>													
													<option value="NL" <?php echo ($row['state']=='NL')?" selected":"";  ?>>Nagaland</option>													
													<option value="AN" <?php echo ($row['state']=='AN')?" selected":"";  ?>>Andaman & Nicobar</option>													
													<option value="DH" <?php echo ($row['state']=='AS')?" selected":"";  ?>>Dadra & Nagar Haveli</option>													
													<option value="DD" <?php echo ($row['state']=='AS')?" selected":"";  ?>>Damen & Diu</option>													
													<option value="LD" <?php echo ($row['state']=='AS')?" selected":"";  ?>>Lakshadweep</option>
                                                </select>
                                            </div>
											
                                            <div class="form-group col-md-4">											
										<select id="shipstate" class="form-control form-control-sm" name="shipstate">
												  <span class="text-muted">  <option selected>Shipping State</option> </span>
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
									</div>
																		
									<div class="form-row">
									<div class="form-group col-md-4">
									<select class="form-control form-control-sm" id="billcountry" required name="billcountry"> 
									<span class="text-muted">  
									<option >Billing Country</option> </span>
									<option value="IN" <?php echo ($row['country']=='IN')?" selected":"";  ?> >India</option>									
									<option value="AR" <?php echo ($row['country']=='AR')?" selected":"";  ?>>Argentina</option>
									<option value="AU" <?php echo ($row['country']=='AU')?" selected":"";  ?>>Australia</option>
									<option value="AT" <?php echo ($row['country']=='AT')?" selected":"";  ?>>Austria</option>
									<option value="BD" <?php echo ($row['country']=='BD')?" selected":"";  ?>>Bangladesh</option>
									<option value="BE" <?php echo ($row['country']=='BE')?" selected":"";  ?>>Belgium</option>
									<option value="BR" <?php echo ($row['country']=='BR')?" selected":"";  ?>>Brazil</option>
									<option value="BG" <?php echo ($row['country']=='BG')?" selected":"";  ?>>Bulgaria</option>
									<option value="CA" <?php echo ($row['country']=='CA')?" selected":"";  ?>>Canada</option>
									<option value="CN" <?php echo ($row['country']=='CN')?" selected":"";  ?>>China</option>
									<option value="CO" <?php echo ($row['country']=='CO')?" selected":"";  ?>>Colombia</option>
									<option value="HR" <?php echo ($row['country']=='HR')?" selected":"";  ?>>Croatia</option>
									<option value="CU" <?php echo ($row['country']=='CU')?" selected":"";  ?>>Cuba</option>
									<option value="CZ" <?php echo ($row['country']=='CZ')?" selected":"";  ?>> Czech Republic</option>
									<option value="DK" <?php echo ($row['country']=='DK')?" selected":"";  ?>>Denmark</option>
									<option value="EG" <?php echo ($row['country']=='EG')?" selected":"";  ?>>Egypt</option>
									<option value="FI" <?php echo ($row['country']=='FI')?" selected":"";  ?>>Finland</option>
									<option value="FR" <?php echo ($row['country']=='FR')?" selected":"";  ?>>France</option>
									<option value="DE" <?php echo ($row['country']=='DE')?" selected":"";  ?>>Germany</option>
									<option value="GR" <?php echo ($row['country']=='GR')?" selected":"";  ?>>Greece</option>
									<option value="HK" <?php echo ($row['country']=='HK')?" selected":"";  ?>>Hong Kong</option>
									<option value="HU" <?php echo ($row['country']=='IN')?" selected":"";  ?>>Hungary</option>
									<option value="IS" <?php echo ($row['country']=='IS')?" selected":"";  ?>>Iceland</option
									<option value="ID" <?php echo ($row['country']=='ID')?" selected":"";  ?>>Indonesia</option>
									<option value="IE" <?php echo ($row['country']=='IE')?" selected":"";  ?>>Ireland</option>
									<option value="IL" <?php echo ($row['country']=='IL')?" selected":"";  ?>>Israel</option>
									<option value="IT" <?php echo ($row['country']=='IT')?" selected":"";  ?>>Italy</option>
									<option value="JP" <?php echo ($row['country']=='JP')?" selected":"";  ?>>Japan</option>
									<option value="KW" <?php echo ($row['country']=='KW')?" selected":"";  ?>>Kuwait</option>
									<option value="MX" <?php echo ($row['country']=='MX')?" selected":"";  ?>>Mexico</option>
									<option value="NL" <?php echo ($row['country']=='NL')?" selected":"";  ?>>Netherlands</option>
									<option value="NZ" <?php echo ($row['country']=='NZ')?" selected":"";  ?>>New Zealand</option>
									<option value="NO" <?php echo ($row['country']=='NO')?" selected":"";  ?>>Norway</option>
									<option value="PK" <?php echo ($row['country']=='PK')?" selected":"";  ?>>Pakistan</option>
									<option value="PL" <?php echo ($row['country']=='PL')?" selected":"";  ?>>Poland</option>
									<option value="PT" <?php echo ($row['country']=='PT')?" selected":"";  ?>>Portugal</option>
									<option value="RO" <?php echo ($row['country']=='RO')?" selected":"";  ?>>Romania</option>
									<option value="RU" <?php echo ($row['country']=='RU')?" selected":"";  ?>>Russian Federation</option>
									<option value="ES" <?php echo ($row['country']=='ES')?" selected":"";  ?>>Spain</option>
									<option value="SE" <?php echo ($row['country']=='SE')?" selected":"";  ?>>Sweden</option>
									<option value="TR" <?php echo ($row['country']=='TR')?" selected":"";  ?>>Turkey</option>
									<option value="GB" <?php echo ($row['country']=='IN')?" selected":"";  ?>>United Kingdom</option>
									<option value="US" <?php echo ($row['country']=='US')?" selected":"";  ?>>United States</option>
								</select>
                                  </div>
								  
                                 <div class="form-group col-md-4">
								  <select class="form-control form-control-sm" id="shipcountry" required name="shipcountry"> 
									<span class="text-muted">  
									<option selected>Shipping Country</option> </span>
									<option value="IN">India</option>									
									<option value="AR">Argentina</option>
									<option value="AU">Australia</option>
									<option value="AT">Austria</option>
									<option value="BD">Bangladesh</option>
									<option value="BE">Belgium</option>
									<option value="BR">Brazil</option>
									<option value="BG">Bulgaria</option>
									<option value="CA">Canada</option>
									<option value="CN">China</option>
									<option value="CO">Colombia</option>
									<option value="HR">Croatia</option>
									<option value="CU">Cuba</option>
									<option value="CZ">Czech Republic</option>
									<option value="DK">Denmark</option>
									<option value="EG">Egypt</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="DE">Germany</option>
									<option value="GR">Greece</option>
									<option value="HK">Hong Kong</option>
									<option value="HU">Hungary</option>
									<option value="IS">Iceland</option
									<option value="ID">Indonesia</option>
									<option value="IE">Ireland</option>
									<option value="IL">Israel</option>
									<option value="IT">Italy</option>
									<option value="JP">Japan</option>
									<option value="KW">Kuwait</option>
									<option value="MX">Mexico</option>
									<option value="NL">Netherlands</option>
									<option value="NZ">New Zealand</option>
									<option value="NO">Norway</option>
									<option value="PK">Pakistan</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="RO">Romania</option>
									<option value="RU">Russian Federation</option>
									<option value="ES">Spain</option>
									<option value="SE">Sweden</option>
									<option value="TR">Turkey</option>
									<option value="GB">United Kingdom</option>
									<option value="US">United States</option>
								</select>								  
								</div>
								</div>
								

									<div class="form-row">
									  <div class="form-group col-md-4">
									  <input type="text" class="form-control form-control-sm" name="billzip" id="billzip"  required placeholder="Billing Zip/Postal Code" value="<?php echo $row['zip']; ?>">
									  </div>	
										
									
									<div class="form-group col-md-4">
									 <input type="text" class="form-control form-control-sm" name="shipzip" id="shipzip"  required placeholder="Shipping Zip/Postal Code">
									</div>									  
									</div>
									
									
									<div class="form-row">
									  <div class="form-group col-md-4">
									  <input type="text" class="form-control form-control-sm" name="billmobile" id="billmobile"  required placeholder="Billing Phone" value="<?php echo $row['mobile']; ?>">
									  </div>	
									
									<div class="form-group col-md-4">
									 <input type="text" class="form-control form-control-sm" name="shipmobile"  id="shipmobile"  required placeholder="Shipping Phone">
									</div>									  
									</div>
									
									
										<div class="form-row">
									  <div class="form-group col-md-4">
									  <input type="text" class="form-control form-control-sm" name="billgstin" id="billgstin"  required placeholder="Billing GSTIN No" value="<?php echo $row['gstin']; ?>" />
									  </div>
									<div class="form-group col-md-4">
									 <input type="text" class="form-control form-control-sm" name="shipgstin" id="shipgstin"  required placeholder="Shipping GSTIN No">
									</div>									  
									</div>
								
									
								
									 
<!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->
<table  class="table table-hover small-text" id="tb">
<tr class="tr-header">
<th width="30%">Item Details</th>
<th width="15%">HSN/SAC</th>
<th width="10%">Qty</th>
<th width="15%"><i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Rate</i></th>
<th width="15%" > <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Amount</b></i></th>
<!-- <th width="8%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Discount</b></i></th>-->
<th width="15%"> GST@%</th> 
<!--th width="20%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Total</b></i></th-->
<th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
<span class="glyphicon glyphicon-plus"></span>+</a></th>

</tr>
<tr>
	<td>
		<select name="itemcode[]" class="form-control itemcode">
			<option value="" name="itemcode" selected>Item Code</option>
			<?php $qr  = "select * from purchaseitemaster where status ='1' ";
				  $exc = mysqli_query($dbcon,$qr)or die();
				  while($r = mysqli_fetch_array($exc)){ ?>
				  <option value="<?php echo $r['id']; ?>"><?php echo $r['itemname']; ?></option>
			<?php
				}
			?>
			
			<option value="Sticker">Sticker</option>
		</select>
	</td>
								
									  
								  
	<!--td><input type="text" name="description" placeholder="Item Name" class="form-control"></td
	<td><input type="text" name="itemcode" placeholder="Item Details" class="form-control"></td>-->
	<td><input type="text" name="hsncode[]" placeholder="hsncode"    data-id="" class="form-control hsncode"></td>
	<td><input type="text" name="qty[]"   placeholder="Qty" data-id="" class="form-control qty"></td>
	<td><input type="text" name="price[]" placeholder="Rate/Qty"    data-id="" class="form-control price"></td>
	<td><input type="text" name="amount[]" placeholder="qtyXprice" data-id="" class="form-control amount"></td>
	<!-- <td><input type="text" name="discount[]" class="form-control discount" placeholder="Itm wise Disc"></td> -->
	<td><input type="text" name="gst[]" placeholder="GST Rate%" data-id=""  class="form-control gst" ></td>
	<!--td><input type="text" name="total[]" class="form-control total" data-id="" placeholder="Item Total"></td-->
	<td><a href='javascript:void(0);'  class='remove'><span class='glyphicon glyphicon-remove'></span>-</a></td>
</tr>
</table>


<table>
<tr>	
<div class="col-md-10 float-right text-right">										
<h5>Sub Total: <span class="text-danger">164.00</span></h5>
</div>
</td>
</tr>

<tr>
<div class="col-md-10 float-right text-right">	
<h5>&nbsp;Discount</b>&nbsp;</h5>
</div>
</td>
</tr>

<tr>
<div class="col-md-10 float-right text-right">															
<h5>&nbsp;CGST @ <span class="text-danger">9% on 9.00 </span></h5>
</div>
</td>
</tr>

<tr>
	<div class="col-md-10 float-right text-right">															
<h5>&nbsp;SGST @<span class="text-danger"> 9% on 9.00</span></h5>
</div>
</td>
</tr>

<!--tr>
<div class="col-md-10 float-right text-right">	
<h5><b>&nbsp;Adjustment</b>&nbsp;<i class="fa fa-rupee fonts" aria-hidden="true"></i></h5>
</div>
</td>
</tr-->


<tr>
<div class="col-md-10 float-right text-right">	
<h5>Grand Total(Round off): <span class="text-danger">200.00</span></h5>
</div>
</td>
</tr>

<tr>
<div class="col-md-10 float-right text-right">	
<h5>Balance Due: <span class="text-danger">200.00</span></h5>
</div>
</td>
</tr>

</table>
									  <br>
									<div class="form-row">
									  <div class="form-group col-md-8">
									  <textarea rows="2" class="form-control" name="tandc"  required placeholder="Terms & Conditions"></textarea>
									</div>
									</div>
								
									<div class="form-row">
									  <div class="form-group col-md-8">
									  <textarea rows="2" class="form-control" name="notes"  required placeholder="add a Note"></textarea>
									</div>
									</div>
									
									
							                      <div class="form-row">
                                                    <div class="form-group text-right m-b-0">
                                                       &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-primary" name="submit" type="submit">
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
	
	
<!--?php include('footer.php');?-->
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
<script>
$(function(){
    $('#addMore').on('click', function() {
              var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
              data.find("input").val('');
     });
     $(document).on('click', '.remove', function() {
         var trIndex = $(this).closest("tr").index();
            if(trIndex>1) {
             $(this).closest("tr").remove();
           } else {
             alert("Sorry!! Can't remove first row!");
           }
      });
});      
</script>



<script>

$('document').ready(function(){
	//addGroupnames_ajax.php
	$('#submitpaymentterm').click(function(){
		var description = $('#adddescription').val();
		var paymentterm = $('#addpaymentterm').val();
		//alert(groupname+description);
		$.ajax ({
           url: 'addPaymentTermModal.php',
		   type: 'post',
		   data: {
				  paymentterm:paymentterm,
				  description:description
				},
		   //dataType: 'json',
           success:function(response){
				if(response!=0 || response!=""){
					var new_option ="<option>"+response+"</option>";
					$('#paymentterm').append(new_option);
					 $('#customModal').modal('toggle');
				}else{
					alert('Error in inserting new Payment Term,try another Payment Term');
				}
			}
        
         });
		 
		 });
		 
$('#billing_to_shipping').click(function(){
			$('#shipaddress').val($('#billaddress').val());
			$('#shipcity').val($('#billcity').val());
			$('#shipstate').val($('#billstate').val());
			$('#shipcountry').val($('#billcountry').val());
			$('#shipmobile').val($('#billmobile').val());
			$('#shipzip').val($('#billzip').val());
			$('#shipgstin').val($('#billgstin').val());
		});
		
		
			$('#shipping_to_billing').click(function(){
			$('#billaddress').val($('#shipaddress').val());
			$('#billcity').val($('#shipcity').val());
			$('#billstate').val($('#shipstate').val());
			$('#billcountry').val($('#shipcountry').val());
			$('#billmobile').val($('#shipmobile').val());
			$('#billzip').val($('#shipzip').val());
			$('#billgstin').val($('#shipgstin').val());
		});
		
		$('.itemcode').change(function(){
			var id = $(this).val();
			var calcPrice = 0;
			var price     = 0;
			
			//$(this).find("class=price").val('20');
			var row = $(this).closest('tr');
			row.find('.price').attr('id','price'+id);
			row.find('.price').attr('data-id',id);
			
			row.find('.qty').attr('id','qty'+id);
			row.find('.qty').attr('data-id',id);;
			
			row.find('.amount').attr('id','amount'+id);
			row.find('.amount').attr('data-id',id);;
			
			row.find('.discount').attr('id','discount'+id);
			row.find('.discount').attr('data-id',id);
			
			row.find('.gst').attr('id','gst'+id);
			row.find('.gst').attr('data-id',id);
			
			row.find('.total').attr('id','total'+id);
			row.find('.total').attr('data-id',id);
			
			$.ajax ({
			   url: 'getItemDetails.php',
			   type: 'post',
			   data: {
					  itemid:id
					  
					},
			   dataType: 'json',
			   success:function(response){
				   if(response!=null){
						//alert(response.priceperqty);
						$('#price'+id).val(response.priceperqty);
						$('#qty'+id).val(1);
						$('#amount'+id).val(parseFloat(response.priceperqty)*1);
						$('#discount'+id).val(0);
						$('#gst'+id).val(response.salestaxrate);
						
						calcPrice   = (response.priceperqty - ( response.priceperqty * response.salestaxrate / 100 )).toFixed(2);
						percentagedval = (parseFloat(response.priceperqty)-parseFloat(calcPrice)).toFixed(2);
						$('#total'+id).val();
						
					}else{
					   alert('Please select any item');
					   row.find("input").val('');
				   }
				}
			});
		});
});
	function calculate_amount(){
		
	}

</script>			


</body>
</html>