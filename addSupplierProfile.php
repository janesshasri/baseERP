<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
    $suppcode = $_POST['suppcode'];
   
    //$locname=$_POST['locname'];//same
    $address=$_POST['address'];//same
    $city=$_POST['city'];//same
    $state=$_POST['state'];//same
    $country=$_POST['country'];//same
    $zip=$_POST['zip'];//same
    $email=$_POST['email'];//same
    $web=$_POST['web'];//same
    $phone=$_POST['phone'];//same
    $mobile=$_POST['mobile'];//same
    $gst=$_POST['gst'];//same
    $pan=$_POST['pan'];//same
    $image=$_POST['image'];//same

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

    $insert_supprofile="INSERT INTO supprofile(suppcode,address,city,state,country,zip,email,web,phone,mobile,gst,pan,image) 
	VALUES('$suppcode','$address','$city','$state','$country','$zip','$email','$web','$phone','$mobile','$gst','$pan','$target_file')";

    // echo "$insert_comprofile";
    if(mysqli_query($dbcon,$insert_supprofile))
    {
        echo "<script>alert('Supplier Profile creation Successful ')</script>";
       header("location:listSupplierProfile.php");
    } else {
        exit; 
        //echo "<script>alert('User creation unsuccessful ')</script>";
    }

}
?>
<?php include('header.php'); ?>

    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Supplier Profile</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Supplier Profile</li>
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
			
                    

					
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								<h5><div class="fa-hover col-md-12 col-sm-12"><i class="fa fa-truck smallfonts" aria-hidden="true"></i> Add Supplier Profile Details
								</div></h5>
							</div>
								
							<div class="card-body">
								<form method="post" enctype="multipart/form-data">
								<div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputState">Supplier Code</label>
                                                <select id="suppcode" onchange="onsuppcode(this);" class="form-control" name="suppcode">
                                                    <option selected>Open Supplier Code</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"select concat(prefix,postfix,postfix2,id) as scode from suppcode");
                                                      while ($row = $sql->fetch_assoc()){	
                                                        echo $suppcode=$row['scode'];
                                                        if($suppcode==$_GET['suppcode']){
                                                                echo '<option value="'.$suppcode.'"  selected>'.$suppcode.'</option>';  
                                                        }else{
                                                            echo '<option value="'.$suppcode.'" >'.$suppcode.'</option>';      
                                                        }
													  }
                                                    ?>
                                                </select>
                                                <script>
                                                    function onsuppcode(x)
                                                    {    
                                                        var suppcode=x.value;
                                                        window.location.href = 'addSupplierProfile.php?suppcode='+suppcode;
                                                    }
                                                </script>
                                            </div>
                                        </div>
								
											<div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label ><span class="text-danger">Name:&nbsp;</span> <?php if (isset($_GET["suppcode"])) {

                                                    $supp_code = $_GET["suppcode"];
                                                $sql = mysqli_query($dbcon,"select concat(prefix,postfix,postfix2,id) as scode,concat(title,suppname) as sname from suppcode");
											while ($row = $sql->fetch_assoc()){	
                                                if($supp_code==$row['scode']){
                                                    echo $row['sname'];
                                                }
											}
											}?></label>
                                            </div>
                                        </div>
								
								<div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label ><span class="text-danger">Supplier Type:&nbsp;</span><?php if (isset($_GET["suppcode"])) {

                                                    $supp_code = $_GET["suppcode"];
                                                $sql = mysqli_query($dbcon,"select concat(prefix,postfix,postfix2,id) as scode,supptype from suppcode");
											while ($row = $sql->fetch_assoc()){	
                                                if($supp_code==$row['scode']){
                                                    echo $row['supptype'];
                                                }
											}
											}?></label>
                                            </div>
                                        </div>
								
								   <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Address<span class="text-danger">*</span></label>
                                                <div>
                                                    <input type="textarea" name="address" class="form-control" placeholder="Building No,locality,Street ..."
                                                           required class="form-control" autocomplete="off"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="inputCity">City</label>
                                                <input type="text" class="form-control" id="city" name="city" placeholder="City/Town/Village ...">
                                            </div>
                                            <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="example1">
								Select country: 
								</label>
								<select class="form-control select2" id="example1" name="country">    
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
									<option value="IS">Iceland</option>
									<option value="IN">India</option>
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

											
                                            <div class="form-group col-md-6">
                                                <label for="inputState">Select State:</label>
                                                <select id="inputState" class="form-control" name="state">
                                                    
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


                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label>Zip<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="zip" name="zip" required placeholder="600040" autocomplete="off">
                                        </div>	

                                        <div class="form-group col-md-8">
                                            <label>Email<span class="text-danger">*</span></label>
                                            <input type="email" name="email" data-parsley-trigger="change" 
                                                   required placeholder="Enter email address" class="form-control" id="email" name="email">
                                        </div>
                                    </div>		



                                    <div class="form-row">
                                        <div class="form-group col-md-4">
                                            <label>Phone</label>
                                            <input type="text" class="form-control" id="phone" name="phone" placeholder="044-12345678" autocomplete="off">
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label>Mobile<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control" id="mobile" name="mobile" placeholder="9898989898" required autocomplete="off">
                                                </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Web</label>
                                        <input type="text" class="form-control" id="web" name="web" placeholder="www.companyname.com" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label>GST<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="gst" name="gst" placeholder="GST no..." required autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label>PAN</label>
                                        <input type="text" class="form-control" id="pan" name="pan" placeholder="Pan no.." autocomplete="off">
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
                                    &nbsp;<div class="form-group text-right m-b-10">
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
						</div><!-- end card-->					
                    </div>
					</div>
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
<!--script>
                function onsuppcode(){

                    console.log(this);
                }
            </script-->
<!-- END Java Script for this page -->

</body>
</html>