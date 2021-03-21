<?php
include("database/db_conection.php");//make connection here

$custnameFound = '';

if(isset($_POST['submit']))
{
//here getting result from the post array after submitting the form.
	
$title =	$_POST['title'];
$custname 	 =	$_POST['custname'];	
//$portal 	 =	$_POST['portal'];
$custype =	$_POST['custype'];	
$blocation 	 =	$_POST['blocation'];
//$industry 	 =	$_POST['industry'];	
$address  =	$_POST['address'];		
$city 	 =	$_POST['city'];	
echo $country  =	$_POST['country'];		
$state  =	$_POST['state'];		
$zip  =	$_POST['zip'];		
$workphone 	 =	$_POST['workphone'];	
$mobile 	 =	$_POST['mobile'];	
$email 	 =	$_POST['email'];	
$web 	 =	$_POST['web'];	
$gstin 	 =	$_POST['gstin'];	
//$gstregdate 	 =	$_POST['gstregdate'];	
//$primaryflag 	 =	$_POST['primaryflag'];
//$image 	 =	$_POST['image'];
//$openbalance = $_POST['openbalance'];
//$obasofdate = $_POST['obasofdate'];
	

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
$custid ="";
$prefix = "Thuli-0";
 $sql="SELECT MAX(id) as latest_id FROM customerprofile ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$custid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$custid = $prefix.$maxid;
		}
	}	
	 
	$check_custname_query="select custname from customerprofile WHERE custname='$custname'";
    $run_query=mysqli_query($dbcon,$check_custname_query);
	if(mysqli_num_rows($run_query)>0)
    {
        $custnameFound = "Customername: $custname is already exist, Please try another one!";
        //exit;
    }
    else{
	$insert_customerProfile="INSERT INTO customerprofile(custid,title,custname,custype,blocation,address,city,state,country,zip,workphone,mobile,email,web,gstin) 
	VALUES('$custid','$title','$custname','$custype','$blocation','$address','$city','$state','$country','$zip','$workphone','$mobile','$email','$web','$gstin')";

	echo "$insert_customerProfile";
	
	if(mysqli_query($dbcon,$insert_customerProfile))
	{
   
		echo "<script>alert('Customer Profile creation Successful ')</script>";
		header("location:listCustomerProfile.php");
    } else { die('Error: ' . mysqli_error($dbcon));
		exit;
	}
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
                                    <h1 class="main-title float-left">Customer Profile</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Customer Profile</li>
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
								<h5><div class="text-muted font-light"><i class="fa fa-truck smallfonts" aria-hidden="true"></i>&nbsp;Add Customer Details<span class="text-muted"></span></div></h5>
								
								<!--div class="text-muted font-light">Tell us a bit about yourself.</div-->
								<p class="text-danger"><?php echo $custnameFound;?></p>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
							</div>
								
							<div class="card-body">
								
								<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">
								<!--form action="addCompanyTypeMaster.php" class="validation fv-form fv-form-bootstrap" 
								enctype="multipart/form-data" method="post" 
								accept-charset="utf-8" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" 
								style="display: none; width: 0px; height: 0px;"></button-->
														
																
								    <div class="form-row">
								<div class="form-group col-md-3">
									  <label for="inputState">Title</label>
									  <select required id="inputState" class="form-control form-control-sm"  name="title">
										<span class="text-muted"> 
										<option value="" >Salutation</option></span>
										<option value="M/S.">MS.</option>
										<option value="Mr.">Mr.</option>
										<option value="Mrs.">Mrs.</option>
										<option value="Mrs.">Dr.</option>
									  </select>
									</div>
									
									
									<div class="form-group col-md-8">
									  <label >Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control form-control-sm" name="custname" placeholder="Customer Full Name/Display Name" required class="form-control" autocomplete="off">
									</div>
									</div>
									
									 <!--div class="form-row">
									<div class="form-group col-md-11">
									  <label >Portal</label>
									  <input type="text" class="form-control" name="portal" placeholder="https://abc.com" required autocomplete="off">
									</div>
									</div-->
															
								    <div class="form-row">
                                            <div class="form-group col-md-11">
                                                <label for="inputState">Customer Type</label>
                                                <select required id="custype" onchange="onlocode(this)"  class="form-control form-control-sm" name="custype">
                                                    <option value="">Open Customer Type</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT custype FROM custype");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $custype=$row['custype'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$custype.'" >'.$custype.'</option>';
                                                    }
                                                    ?>
                                                </select>
								<!--a style="color:skyblue" data-target="#customModal" data-toggle="modal">
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add New Supplier Type</a-->
								
								<a href="#custom-modal" data-target="#customModalcustype" data-toggle="modal">
								<i class="fa fa-user-plus" aria-hidden="true"></i>New Customer Type</a><br>
								
								<!-- Modal -->
								<div class="modal fade custom-modal" id="customModalcustype" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
								  <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel2">Add Customer Type</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  	<form action="#" enctype="multipart/form-data" method="post">
									  
											<div class="form-group">
												<input type="text" class="form-control" name="addcustype"  id="addcustype"  placeholder="Wholesaler,Retailer,Distributor">
											</div>
											<div class="form-group">
												<input type="text" class="form-control" name="adddescription" id="adddescription"  placeholder="description">
											</div>
										</div>
										
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" name="submitcustype" id="submitcustype" class="btn btn-primary">Save and Associate</button>
									  </div>
									</div>
								  </div>
								</div>
								</div>
								</div>
							
							<!-- Modal Ends-->	
									
									<div class="form-row">
                                            <div class="form-group col-md-11">
                                                <label for="inputState">Business Location</label>
                                                <select id="locname" onchange="onlocode(this)" class="form-control form-control-sm" name="blocation" readonly>
                                                    <option value="">Open Location</option>
                                                    
													<?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT code,description FROM state");
                                                    while ($row = $sql->fetch_assoc()){	
													 $code=$row['code'];
                                                     $description=$row['description'];
                                                    echo '<option  value="'.$description.'" >'.$description.'</option>';                                                      
                                                    }
                                                    ?>
                                                </select>

                                            </div>
                                        </div>
										
									<div class="form-row">
									<div class="form-group col-md-9">
									  <h4 class="col-md-12 text-muted"><b>Customer Address &nbsp;</b></h4>
									  </div>
									</div>
									
									<div class="form-group row">
									<div class="col-md-11"> 
									<input type="text" placeholder="No,Street " name="address" class="form-control form-control-sm"> 
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-11">
									  <input type="text" class="form-control form-control-sm" required name="city"  placeholder="City/town/village *">
									</div>
									</div>
									
									<div class="form-row">
									      <div class="form-group col-md-4">
                                                <select required id="inputState" onchange="onlocode(this)"  class="form-control form-control-sm" name="state">
                                                   <span class="text-muted">  <option value="">State/Union Territory *</option> </span>
                                                   <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT code,description FROM state");
                                                    while ($row = $sql->fetch_assoc()){	
													 $code=$row['code'];
                                                     $description=$row['description'];
                                                    echo '<option  value="'.$code.'" >'.$description.'</option>';                                                      
                                                    }
                                                    ?>
                                                </select>
										  </div>	

									<div class="form-group col-md-4">
                                                <select required id="inputState" onchange="onlocode(this)"  class="form-control form-control-sm" name="country">
                                                   <span class="text-muted"> <option value="">Country *</option> </span>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT code,description FROM country");
                                                    while ($row = $sql->fetch_assoc()){	
                                                     $code=$row['code'];
                                                     $description=$row['description'];
                                                    echo '<option  value="'.$code.'" >'.$description.'</option>';        
                                                    }
                                                    ?>
                                                </select>
										  </div>
									
									  <div class="form-group col-md-3">
									  <input type="text" class="form-control form-control-sm" name="zip"  placeholder="Zip/Postal Code ">
									  </div>
									
									</div>
									
									
									<div class="form-row">
									<div class="form-group col-md-9">
									  <h4 class="col-md-12 text-muted">Contact Details</h4>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-3">
									<label> Work Phone</label>
									  <input type="text" class="form-control form-control-sm" name="workphone"  placeholder="Landline">
									</div>
									
									<div class="form-group col-md-3">
									<label> Mobile <span class="text-danger">*</span></label>
									  <input type="text" class="form-control form-control-sm" name="mobile"  required placeholder="9677573737">
									</div>
									
									<div class="form-group col-md-5">
									<label> Email<span class="text-danger"></span></label>
									  <input type="email" class="form-control form-control-sm" name="email"   placeholder="Optional" autocomplete="off">
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-11">									
									  <input type="text" class="form-control form-control-sm" name="web"  placeholder="Website(Optional)">
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-9">
									  <h4 class="col-md-12 text-muted">Tax Details</h4>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-11">
									<label>GSTIN<span class="text-danger"></span></label>
									  <input type="text" class="form-control form-control-sm" name="gstin"  placeholder="Maximum 15 Digits">
									</div>
									</div>
									
									<!--div class="form-row">
									<div class="form-group col-md-5">
									<label>Opening Balance</label>
									  <input type="text" class="form-control form-control-sm" name="openbalance" >
									</div>
																		
									<div class="form-group col-md-6">
									<label> <span class="text-danger"> As of Date</span></label>
									  <input type="date" class="form-control form-control-sm"  name="obasofdate" value="<?php echo date("Y-m-d");?>">		
									</div>
									</div-->
									
									<!--div class="form-row">
									<div class="form-group col-md-9">
									  <h4 class="col-md-12 text-muted">Logo</h4>
									  </div>
									</div-->
									
									<!--div class="form-row">
                                    <div class="form-group col-md-11">
                                        <label>
                                            <div class="fa-hover col-md-12 col-sm-12">
                                                &nbsp;<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload image like JPG,GIF,PNG..</div>
                                        </label> 
                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control">
                                    </div>
								</div-->
								
								<div class="form-row">
								<div class="col-md-12 col-md-offset-12">
								<div class="checkbox"><label>
								 <input type="checkbox" name="primaryflag" value="0" class="ember-checkbox ember-view">Make this profile as primary for all correspondence</label>
								 
								 </div>
								 </div>
								 </div>		
								
																
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="button" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">Cancel
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
	
 <footer class="footer">
		<span class="text-right">
		Copyright@<a target="_blank" href="#"></a>
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
	$('#submitcustype').click(function(){
		var description = $('#adddescription').val();
		var custype = $('#addcustype').val();
		//alert(custype+description);
		$.ajax ({
           url: 'addCusTypeModal.php',
		   type: 'post',
		   data: {
				  custype:custype,
				  description:description
				},
		   //dataType: 'json',
           success:function(response){
				if(response!=0 || response!=""){
					var new_option ="<option>"+response+"</option>";
					$('#custype').append(new_option);
					 $('#customModalcustype').modal('toggle');
					  window.location.reload(true);
				
				}else{
					alert('Error in inserting customer type,try another one');
				}
			}
        
         });
		 
		 });
});
			
</script>			


</body>
</html>