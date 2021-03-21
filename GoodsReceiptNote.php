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
                                    <h1 class="main-title float-left">Goods Received Note</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Goods Received Note</li>
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
								<h5><div class="text-muted font-light"><i class="fa fa-truck smallfonts" aria-hidden="true"></i>
								&nbsp;Goods Received Note<span class="text-muted"></span></div></h5>
								
								<div class="text-muted font-light">Record Goods Receipt</div>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
								
							</div>
								
							<div class="card-body">
								
								<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">
								<div class="form-row">
									<div class="invoice-title text-left mb-6">
									  <h4 class="col-md-12 text-muted">Goods Received Note &nbsp;</h4>
									  </div>
									</div>
									
									<div class="form-row">
                                            <div class="form-group col-md-8">
											<div class="invoice-title text-left mb-8">
                                                <label for="inputState">Purchase Order Owner</label>
                                                <select id="onshpvia" onchange="onuser(this)" required class="form-control form-control-sm" name="powner">
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
                                                        window.location.href = 'addPurchaseOrderTest2.php?supcode='+supcode;
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
                                            <div class="form-group col-md-8">
                                                 <?php if (isset($_GET["supcode"])) {
                                                    $sup_code = $_GET["supcode"];
                                                    $sql = mysqli_query($dbcon,"SELECT vendorid,supname,address,city,zip,mobile,email,gstin from vendorprofile");
											        while ($row = $sql->fetch_assoc()){	
                                                     if($sup_code==$row['vendorid']){
													    echo $row['supname']; echo "<br>";
														echo $row['address'];echo "<br>";
														echo $row['city'];echo "<br>";
														echo $row['zip'];echo "<br>";
														echo $row['mobile'];echo "<br>";
														echo $row['email'];echo "<br>";
														echo $row['gstin'];echo "<br>";
											         }
											}
												}
											?></label>
                                            </div>
                                        </div>					
									
									
									<div class="form-row">
									<div class="form-group col-md-4">									
									 <label>PO Date<span class="text-danger"><span class="text-danger">*</span></label>
									 <input type="date" class="form-control form-control-sm" id="date" name="podate" required autocomplete="off">
								    </div>
									
								    <div class="col-md-6 float-right text-right">
                                            <div class="form-group col-md-8">
											<div class="invoice-title text-left mb-6">
                                                <label for="inputState">Payment Term</label>
                                                <select id="pterm" onchange="onpterm(this)" required class="form-control form-control-sm" name="payterm">
                                                    <option selected>Open Payment Term</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT paymentterm FROM paymentterm");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $payterm=$row['paymentterm'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$payterm.'" >'.$payterm.'</option>';
                                                    }
                                                    ?>
                                                </select>	
											<!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                            </div>
									</div>
									</div>
									</div>
									
									<div class="form-row">
                                            <div class="form-group col-md-4">
											<div class="invoice-title text-left mb-6">
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
									</div>
									<div class="col-md-6 float-right text-right">
                                            <div class="form-group col-md-8">
											<div class="invoice-title text-left mb-6">
                                                <label for="inputState">Delivery At</label>
                                                <select id="delvat" onchange="ondelat(this)" required class="form-control form-control-sm" name="delivat">
                                                    <option selected>Open Delivery At</option>
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
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-4">									
									 <label>Delivery Date<span class="text-danger"><span class="text-danger">*</span></label>
									 <input type="date" class="form-control form-control-sm" id="duedate" name="delivdate" required autocomplete="off">
								    </div>
									<div class="col-md-6 float-right text-right">
                                            <div class="form-group col-md-8">
											<div class="invoice-title text-left mb-6">
                                                <label for="inputState">Status</label>
										<select id="inputState" class="form-control form-control-sm" required  name="status">
										<option value="1">Created</option>
										<option value="2">Approved</option>
										<option value="3">Delivered</option>
										<option value="4">Cancelled</option>
									  </select>											
                                    </div>
									</div>
									</div>
									</div>
									
									<div class="form-row">
									<div class="invoice-title text-left mb-6">
									  <h4 class="col-md-12 text-muted">Address Information &nbsp;</h4>
									  </div>
									<div class="col-md-6 float-right text-right">
									<!--input type="button" onclick="crmTemplate.showCopyAddressMenu(event);sE(event);" id="copyAddress" name="copyAddress" 
									class="newgraybtndd btn" value="Copy Address"-->
									<div class="btn-group" role="group">
									<a id="btnGroupDrop1" role="button" href="#" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									  Copy Address
									</a>
									<div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
									  <a class="dropdown-item" href="#">Billing to Shipping</a>
									  <a class="dropdown-item" href="#">Shipping to Billing</a>
									  
									</div>
								  </div>
									</div>
									  </div>
									  
									
									<div class="form-group row">
									<div class="col-md-4"> 
									<input type="text" placeholder="Billing Street" name="address" required class="form-control form-control-sm"> 
									</div>
										<div class="col-md-6 float-right text-right">
                                            <div class="form-group col-md-8">
											<div class="invoice-title text-left mb-6">
										<input type="text" placeholder="Shipping Street" name="address" required class="form-control form-control-sm"> 
                                    </div>
									</div>
									</div>
									</div>
																		
									<div class="form-row">
									<div class="form-group col-md-4">
									  <input type="text" class="form-control form-control-sm" required name="city"  placeholder=" Billing City">
									</div>
									<div class="col-md-6 float-right text-right">
                                            <div class="form-group col-md-8">
											<div class="invoice-title text-left mb-6">
										<input type="text" placeholder="Shipping City" name="bcity" required class="form-control form-control-sm"> 
                                    </div>
									</div>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-4">
                                                <select id="inputState" class="form-control form-control-sm" name="state">
												  <span class="text-muted">  <option selected>Billing State</option> </span>
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
											<div class="col-md-6 float-right text-right">
                                            <div class="form-group col-md-8">
											<div class="invoice-title text-left mb-6">
										<select id="inputState" class="form-control form-control-sm" name="state">
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
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-4">
									<select class="form-control form-control-sm" id="example1" required name="country"> 
									<span class="text-muted">  
									<option selected>Billing Country</option> </span>
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
								  
								  <div class="col-md-6 float-right text-right">
                                            <div class="form-group col-md-8">
								  <select class="form-control form-control-sm" id="example1" required name="country"> 
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
								</div>

									<div class="form-row">
									  <div class="form-group col-md-4">
									  <input type="text" class="form-control form-control-sm" name="zip"  required placeholder="Billing Zip/Postal Code">
									  </div>	
										
									<div class="col-md-6 float-right text-right">
									<div class="form-group col-md-8">
									 <input type="text" class="form-control form-control-sm" name="zip"  required placeholder="Shipping Zip/Postal Code">
									</div>									  
									</div>
									</div>
									
																		<div class="form-row">
									<div class="invoice-title text-left mb-6">
									  <h4 class="col-md-12 text-muted">Product 
									  Details &nbsp;</h4>
									  </div>
									  </div>
<!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->										
<table  class="table table-hover small-text" id="tb">
<tr class="tr-header">
<th width="40%">Item Details</th>
<th width="10%"><i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Price</i></th>
<th width="8%">Qty</th>
<th width="10%" > <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Amount</b></i></th>
<th width="8%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Discount</b></i></th>
<th width="10%"> GST@%</th>
<th width="20%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Total</b></i></th>

<th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
<span class="glyphicon glyphicon-plus"></span></a></th>
<tr>

<!--td><select name="itemcode" class="form-control form-control-lg">
  <option value="" name="itemcode" selected>Item Code</option>
    <option value="Cap">Cap</option>
    <option value="Sticker">Sticker</option>
</select></td-->
								
									  
								  
<!--td><input type="text" name="description" placeholder="Item Name" class="form-control"></td-->
<td><input type="text" name="itemcode" placeholder="Item Details" class="form-control"></td>
<td><input type="text" name="price" placeholder="price" class="form-control"></td>
<td><input type="text" name="qty" placeholder="Quantity" class="form-control"></td>
<td><input type="text" name="amount" placeholder="PriceXQty" class="form-control"></td>
<td><input type="text" name="discount" class="form-control" placeholder="Itm wise Disc"></td>
<td><input type="text" name="gst" class="form-control" placeholder="GST if avail Itemwise"></td>
<td><input type="text" name="total" class="form-control" placeholder="Item Total"></td>

<td><a href='javascript:void(0);'  class='remove'><span class='glyphicon glyphicon-remove'></span></a></td>
</tr>
</table>
</div>	

<table>
<tr>
<div class="col-md-10 float-right text-right">																
<h5><b>Sub Total</b>&nbsp;<i class="fa fa-rupee fonts" aria-hidden="true"></i></h5>
</div>
</td>
</tr>

<tr>
<div class="col-md-10 float-right text-right">	
<h5><b>&nbsp;Discount</b>&nbsp;<i class="fa fa-rupee fonts" aria-hidden="true"></i></h5>
</div>
</td>
</tr>

<tr>
<div class="col-md-10 float-right text-right">																
<h5><b>&nbsp;GST%</b>&nbsp;<i class="fa fa-rupee fonts" aria-hidden="true"></i></h5>
</div>
</td>
</tr>

<tr>
<div class="col-md-10 float-right text-right">	
<h5><b>&nbsp;Adjustment</b>&nbsp;<i class="fa fa-rupee fonts" aria-hidden="true"></i></h5>
</div>
</td>
</tr>



<tr>
<div class="col-md-10 float-right text-right">	
<h5><b>Grand Total(Round off)</b>&nbsp;<i class="fa fa-rupee fonts" aria-hidden="true"></i></h5>
</div>
</td>
</tr>
</table>

									<div class="form-row">
									<div class="invoice-title text-left mb-6">
									  <h4 class="col-md-12 text-muted">Terms & Conditions &nbsp;</h4>
									  </div>
									  </div>
									  
									<div class="form-row">
									  <div class="form-group col-md-8">
									  <textarea rows="2" class="form-control" name="tandc"  required placeholder="Terms & Conditions"></textarea>
									</div>
									</div>
									
										<div class="form-row">
									<div class="invoice-title text-left mb-6">
									  <h4 class="col-md-12 text-muted">Notes Information</h4>
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
	
	
<?php include('footer.php');?>

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

</body>
</html>