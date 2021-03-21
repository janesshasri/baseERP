<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['suppProfEdit']))
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

    $updateSuprofile = "UPDATE `supprofile` SET `suppcode` = '".$suppcode."', 
						`address`  = '".$address."',`city`  = '".$city."',`country`  = '".$country."',`state`  = '".$state."',`email`  = '".$email."',
						`web`  = '".$web."',`phone`  = '".$phone."',`mobile`  = '".$mobile."',`gst`  = '".$gst."',`pan`  = '".$pan."',`image`  = '".$target_file."'
						 WHERE `id` =". $suppId;
    if(mysqli_query($dbcon,$updateSuprofile))
    {
        
           // $image=$_POST['image'];//same

    //$image = file_get_contents($image);

   
        echo "<script>alert('Profile Successfully updated')</script>";
        header("location:listSupplierProfile.php");
    } else { echo 'Failed to update user';
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
                                <h1 class="main-title float-left">Edit Supplier Profile</h1>
                                <ol class="breadcrumb float-right">
                                    <a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                                <li class="breadcrumb-item active">Edit Supplier Profile</li>
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
                                    <i class="fa fa-bank bigfonts" aria-hidden="true"></i> Edit Supplier Profile</h3>


                                    </div>

                                <div class="card-body">

                                    <form method="post" action="editSupplierProfile.php" enctype="multipart/form-data">


                                        <?php
                                        include("database/db_conection.php");//make connection here

                                        if(isset($_GET['id']))
                                        {
                                            $id=$_GET['id'];

                                            //selecting data associated with this particular id
                                            $result = mysqli_query($dbcon, "SELECT * FROM supprofile WHERE id=$id");

                                            while($res = mysqli_fetch_array($result))
                                            {
                                                
                                                $suppcode = $res['suppcode'];
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
                                        
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="inputState">Supplier Code</label>
                                                <select id="suppcode" onchange="onsuppcode(this)" class="form-control" name="suppcode">
                                                    <option selected>Open Supplier Code</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"select suppcode from supprofile");
                                                    while ($row = $sql->fetch_assoc()){	

                                                        echo $suppcode_get=$row['suppcode'];
                                                        if($suppcode_get==$suppcode){
                                                            echo '<option value="'.$suppcode_get.'" selected>'.$suppcode_get.'</option>';

                                                        }else{
                                                            echo '<option value="'.$suppcode_get.'" >'.$suppcode_get.'</option>';

                                                        }
                                                    }
                                                    ?>
                                                </select>
                                                        <script>
                                                    function onsuppcode(x)
                                                    {    
                                                        var suppcode=x.value;
                                                          $('#suppcode').html(suppcode);

                                                    }
                                                </script>
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
                                    <div class="form-row">
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
</div>								
										
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
                                        <div class="form-group col-md-3">
                                            <label>Zip<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control" id="zip" name="zip" placeholder="600040" required value="<?php echo $zip;?>" />
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
                                        <img src="<?php echo $image;?>" width="100px" class="rounded float-left" alt="...">

                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group text-right m-b-10">
                                        <input type="hidden" name="suppId" value="<?=$_GET['id']?>">
                                        &nbsp;<button class="btn btn-primary" name="suppProfEdit" type="submit">
                                        Update
                                        </button>                                                       
                                    </div>
                                </div>
                                </form>


                        </div>							
                    </div><!-- end card-->					
                </div>
               <?php include('footer.php');?>