<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['userEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
	
	$target_dir = "upload/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
   // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);

   // $title ="";

    if (!empty($_FILES["image"]["name"])){

        if($check !== false) {


            if (move_uploaded_file($_FILES['image']['tmp_name'], __DIR__.'/'.$target_dir.$_FILES['image']['name'])) {
                //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";

	
    $updateUser = "UPDATE `userprofile` SET `username` = '".$username."',
											`firstname` = '".$firstname."',
											`lastname` = '".$lastname."',
											`designation` = '".$designation."',
											`gender` = '".$gender."', 
											`useremail` = '".$email."',
											`mobile` = '".$mobile."',
											`groupname` = '".$groupname."' ,
											`compcode` = '".$compcode."',
											`status` = '".$userstatus."',
											`emailverified` = '".$emailverified."',
											`image_name` = '".$target_file."' 
										WHERE `id` =".$user_id;
				
				} else {
                echo "Sorry, there was an error uploading your image file.".$updateUser;
            }

        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
		
		 }else{
		$updateUser = "UPDATE `userprofile` SET `username` = '".$username."',
												`firstname` = '".$firstname."',
												`lastname` = '".$lastname."',
												`designation` = '".$designation."',												
												`gender` = '".$gender."',
												`useremail` = '".$email."',
												`mobile` = '".$mobile."',
												`groupname` = '".$groupname."' ,
												`compcode` = '".$compcode."',
												`status` = '".$userstatus."',
												`emailverified` = '".$emailverified."'											 
										WHERE `id` =".$user_id;
	}
		
	if(mysqli_query($dbcon,$updateUser))
    {
        
           // $image=$_POST['image'];//same

    //$image = file_get_contents($image);

   
       // echo "<script>alert('Profile Successfully updated')</script>";
        header("location:listUsers.php");
    } else { echo die('Error: ' . mysqli_error($dbcon).$updateUser );
	    //'Failed to update user';
            exit; //echo "<script>alert('Company Profile creation unsuccessful ')</script>";
           }
   
	die;
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
                                    <h1 class="main-title float-left">Please update the information below</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Edit User</li>
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
						
								<h5><i class="fa fa-pencil-square-o"></i><b>&nbsp;Edit User</b></h5>
								 </div>

	<div class="card-header">
	<div class="container">
   <!--ul class="nav nav-pills">
    <!--li class="active"><a data-toggle="pill" href="edit">Edit</a></li-->
    <!--li><a data-toggle="pill" href="#avatar">Avatar</a></li-->
    <!--li><a data-toggle="pill" href="#menu2">Change Password</a></li-->
   </ul-->
   </div>
  
  
						

							<!--a href="#" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_edit_user_1">
							<i class="fa fa-pencil" aria-hidden="true"></i></a>
							<div class="modal fade custom-modal" tabindex="-1" role="dialog" aria-hidden="true" id="modal_edit_user_1">
							<div class="modal-dialog">
								<div class="modal-content"-->
									
									<form method="post" action="editUser.php"  enctype="multipart/form-data">
											<?php
											include("database/db_conection.php");//make connection here
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM userprofile WHERE id=$id");
												while($res = mysqli_fetch_array($result))
												{
													$userid = $res['userid'];
													$username = $res['username'];
													$firstname= $res['firstname'];
													$lastname= $res['lastname'];
													$designation= $res['designation'];
													$gender= $res['gender'];
													$email= $res['useremail'];
													$mobile =$res['mobile'];
													$group =$res['groupname'];
													$compcode =$res['compcode'];
													$userstatus	=$res['status'];													
													$image =$res['image_name'];
													$emailverified = $res['emailverified'];
													//$uservalidtill = $res['validtill'];
												}
											}
											?>
													
										<div class="form-group">
                                                        <label>User id<span class="text-danger">*</span></label>
                                                        <input type="text" name="userid" data-parsley-trigger="change" readonly class="form-control form-control-sm" value="<?php echo $userid;?>"/>
                                                    </div>
										
											<div class="form-group">
                                                        <label>User Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="username" data-parsley-trigger="change" readonly class="form-control form-control-sm" value="<?php echo $username;?>"/>
                                                    </div>
													
													 <div class="form-group">
                                                        <label for="firstname">Firstname<span class="text-danger">*</span></label>
                                                        <input type="text" name="firstname" data-parsley-trigger="change" required  class="form-control form-control-sm" value="<?php echo $firstname;?>"/>
                                                    </div>
													 <div class="form-group">
                                                        <label for="Lastname">Lastname<span class="text-danger">*</span></label>
                                                        <input type="text" name="lastname" data-parsley-trigger="change" required  class="form-control form-control-sm" value="<?php echo $lastname;?>"/>
                                                    </div>
													<div class="form-group">
                                                        <label for="Lastname">Designation<span class="text-danger">*</span></label>
                                                        <input type="text" name="designation" data-parsley-trigger="change" required  class="form-control form-control-sm" value="<?php echo $designation;?>"/>
                                                    </div>
													
													<div class="form-group">
													<label>Gender</label>
													<select name="gender" class="form-control form-control-sm" >
													<option <?php if ($gender == "1" ) echo 'selected="selected"' ; ?> value="1">Male</option>
													<option <?php if ($gender == "0" ) echo 'selected="selected"' ; ?> value="0">Female</option>
													</select>
													</div>
													
												   <div class="form-group">
                                                   <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                                   <input type="email" name="email" data-parsley-trigger="change" readonly  class="form-control form-control-sm" value="<?php echo $email;?>"/>
                                                   </div>
												   
											       <div class="form-group">
											       <label>Mobile</label>
											       <input class="form-control" name="mobile" type="text" value="<?php echo $mobile;?>" />
											       </div>	
												   
												   
													<div class="form-group">
												    <label for="inputState">Groupname</label>
											       <select id="groupname" onchange="ongroup(this)" class="form-control form-control-sm" name="groupname">
                                                    <?php 
														include("database/db_conection.php");//make connection here
														$sql = mysqli_query($dbcon,"select groupname from groups");
														while ($row = $sql->fetch_assoc()){	

															echo $groupname_get=$row['groupname'];
															if($compcode_get==$groupname){
																echo '<option value="'.$groupname_get.'" selected>'.$groupname_get.'</option>';

															}else{
																echo '<option value="'.$groupname_get.'" >'.$groupname_get.'</option>';

															}
														}
                                                    ?>
													</select>
													</div>
													
													
													<div class="form-group">
												    <label for="inputState">Compcode</label>
											       <select id="compcode" onchange="ongroup(this)" class="form-control form-control-sm" name="compcode">
                                                    <option selected>Open Compcode</option>
													<?php 
														include("database/db_conection.php");//make connection here
														$sql = mysqli_query($dbcon,"SELECT orgid as orgid
																					FROM comprofile
																					ORDER BY id ASC");
														while ($row = $sql->fetch_assoc()){	

															echo $orgid_get=$row['orgid'];
															if($orgid_get==$orgid){
																echo '<option value="'.$orgid_get.'" selected>'.$orgid_get.'</option>';

															}else{
																echo '<option value="'.$orgid_get.'" >'.$orgid_get.'</option>';

															}
														}
                                                    ?>
													</select>
													</div>
													
													<div class="form-group">
													<label>Status</label>
													<select name="userstatus" class="form-control form-control-sm" id="example1" >
													<option <?php if ($userstatus == "1" ) echo 'selected="selected"' ; ?> value="1">Active</option>
													<option <?php if ($userstatus == "0" ) echo 'selected="selected"' ; ?> value="0">Inactive</option>
													</select>
													</div>
													
													<div class="form-group">
													<label>Email Verified</label>
													<select name="emailverified" class="form-control form-control-sm" >
													<option <?php if ($emailverified == "1" ) echo 'selected="selected"' ; ?> value="1">YES</option>
													<option <?php if ($emailverified == "0" ) echo 'selected="selected"' ; ?> value="0">NO</option>
													</select>
													</div>
													
												<!--div class="form-group">
											       <label>Validity till</label>
											       <input type="date" class="form-control form-control-sm" name="mobile" type="text" value="<?php echo $uservalidtill;?>" />
											       </div-->
												
										
										<div class="form-group">
                                       
                                        <img src="<?php echo $image;?>" width="100px" class="avatar-rounded" alt="...">
										 <label>
                                            <div class="fa-hover col-md-12 col-sm-12">
                                                &nbsp;<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Change User Profile Picture</div>
                                        </label> 

                                        &nbsp;&nbsp;<input type="file"  name="image" class="form-control">
                                    </div>
										
									           
									
									<div class="modal-footer">
										<input type="hidden" name="user_id" value="<?=$_GET['id']?>">
										<button type="submit" name="userEdit" value="userEdit" class="btn btn-primary">Update</button>
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