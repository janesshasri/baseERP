<?php include('header.php'); ?>
	<!-- End Sidebar -->
	<?php 
		if(isset($_POST['edit_profile'])){
			include("database/db_conection.php");
			$userid    = $_SESSION['userid'];
			$firstname = $_POST['firstname'];
			$lastname  = $_POST['lastname'];
			$email 	   = $_POST['email'];
			$password  = $_POST['password'];
			$role  = $_POST['groupname'];
			//$image = $_POST['password'];
			$target_dir  = "upload/";
			$target_file = $target_dir . basename($_FILES["imagefile"]["name"]);
			$uploadOk    = 1;
			$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		   // Check if image file is a actual image or fake image
			//$check = getimagesize($_FILES["imagefile"]["tmp_name"]);
			if(isset($_FILES["imagefile"])){
				if (move_uploaded_file($_FILES["imagefile"]["tmp_name"], $target_file)){
					$q1     = "UPDATE userprofile set firstname='$firstname', lastname='$lastname', useremail='$email', userpassword='$password', image_name='$target_file' WHERE id='$userid'";
					$exc_q1 = mysqli_query($dbcon,$q1)or die(mysqli_error($dbcon));
				}else{
					$q1     = "UPDATE userprofile set firstname='$firstname', lastname='$lastname', useremail='$email', userpassword='$password' WHERE id='$userid'";
					$exc_q1 = mysqli_query($dbcon,$q1)or die(mysqli_error($dbcon));
				}
			}else {
				$qr     = "UPDATE userprofile set firstname='$firstname', lastname='$lastname', useremail='$email', userpassword='$password' WHERE id='$userid'";
				$exc_q1 = mysqli_query($dbcon,$qr)or die(mysqli_error($dbcon));
				
			}
		}
	?>
	<div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
						<div class="row">
								<div class="col-xl-12">
										<div class="breadcrumb-holder">
												<h1 class="main-title float-left">My Profile</h1>
												<ol class="breadcrumb float-right">
													<li class="breadcrumb-item"><a href="index.php">Home</a></li>
													<li class="breadcrumb-item active">Profile</li>
												</ol>
												<div class="clearfix"></div>
										</div>
								</div>
						</div>
						<!-- end row -->
							
						<div class="row">
							
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
										<div class="card mb-3">
											<div class="card-header">
												<h3><i class="fa fa-user"></i> Profile details</h3>								
											</div>
												
											<div class="card-body">																					
												<form action="" method="post" enctype="multipart/form-data">
													<?php 
														//session_start();
														include("database/db_conection.php");
														$userid = $_SESSION['userid'];
														$sq = "select * from userprofile where id='$userid'";
														$result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
														//$count = mysqli_num_rows($result);
														$rs = mysqli_fetch_assoc($result);
													?>
													<div class="row">	
														<div class="col-lg-9 col-xl-9">
														
															<div class="row">				
																<div class="col-lg-6">
																	<div class="form-group">
																	<label>First Name (required)</label>
																	<input class="form-control" name="firstname" type="text" value="<?php echo $rs['firstname']; ?>" required />
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																	<label>Last Name (required)</label>
																	<input class="form-control" name="lastname" type="text" value="<?php echo $rs['lastname']; ?>" required />
																	</div>
																</div>
																<div class="col-lg-6">
																	<div class="form-group">
																	<label>Valid Email</label>
																	<input class="form-control" name="email" type="email" value="<?php echo $rs['useremail']; ?>" readonly />
																	</div>
																</div>  
															</div>
															<!--div class="row">				
																<div class="col-lg-6">
																	<div class="form-group">
																		<label>Password (leave empty not to change)</label>
																		<input class="form-control" name="password" type="password" value="<?php echo $rs['userpassword']; ?>" />
																	</div>
																</div>              			                                
																<!--div class="col-lg-6">
																	<div class="form-group">
																		<label>Role</label>
																		<input class="form-control" name="role" type="text" "<?php echo $rs['groupname']; ?>" />
																	</div>
																</div>   
															</div-->
															<div class="row">
																<!--div class="col-lg-12">
																	<input type="submit" name="edit_profile" class="btn btn-primary" value="Edit profile" />
																</div-->
															</div>
														</div>
														<div class="col-lg-3 col-xl-3 border-left">
															<b>Username:</b><?php echo $rs['username']; ?>
															<br />
															<b>User ID: </b> <?php echo $rs['userid']; ?>
															<br />
															<b>Email: </b> <?php echo $rs['useremail']; ?>	
															<br />
															<b>Registered On: </b> <?php echo $rs['createdon']; ?>
															<br />
															<b>Role: </b> <?php echo $rs['groupname']; ?>
															
															<div class="m-b-10"></div>
															<div id="avatar_image">
																<img alt="image" style="max-width:100px; height:auto;" src="<?php echo $rs['image_name']; ?>" />
																<br />
																<!--i class="fa fa-trash-o fa-fw"></i> <a class="delete_image" href="#">Remove avatar</a>
															</div>  
															<div id="image_deleted_text"></div>                      
															<div class="m-b-10"></div>
																<div class="form-group">
																	<label>Change avatar</label> 
																	<input type="file" name="imagefile" class="form-control" />
																</div-->
														</div>
													</div>								
												</form>										
											</div>	
								<!-- end card-body -->								
									
							</div>
							<!-- end card -->					

						</div>
						<!-- end col -->	
															
					</div>
					<!-- end row -->	


            </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
<?php include('footer.php'); ?>

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