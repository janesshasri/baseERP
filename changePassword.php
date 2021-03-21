<?php
include("database/db_conection.php");//make connection here
include('header.php'); 
if(isset($_POST['submit'])){
	include("database/db_conection.php");
	
	if(count($_POST)>0){
		$userid = $_SESSION["userid"];
		if($_POST['newPassword'] != $_POST['confirmPassword']){
			echo "<script>alert('Password does not match,please enter correct password')</script>";
			//header('Location:changePassword.php');
			
		}else{
			
			$result = mysqli_query($dbcon,"SELECT * from userprofile WHERE id='" .$userid."'")or die(mysqli_error($dbcon));
			$row = mysqli_fetch_array($result);
			if($_POST["currentPassword"] == $row["userpassword"]){
				$q = mysqli_query($dbcon,"UPDATE userprofile set userpassword= '" . $_POST["newPassword"] . "' WHERE id='" . $userid . "'");
				echo "<script>alert('Password Successfully changed');
						 window.location.assign('logout.php');
				</script>";
			}else{
				echo "<script>alert('Current Password is not correct')</script>";
				
			}
		}
	}
}
?>
<?php ?>
<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Change Password</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Change Password</li>
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
							<h3> <div class="fa-hover col-md-8 col-sm-8">
							<span><i class="fa fa-unlock" aria-hidden="true"></i></span>&nbsp;Change User Password
							<span class="text-muted"></span></div></h3>
							</div>
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
																	
									<div class="form-group">
									<label for="exampleInputPassword1">Current Password</label>
									<input type="password" class="form-control" name="currentPassword" id="exampleInputPassword1" placeholder="Enter Current Password" required>
								  </div>
								  
								  <div class="form-group">
									<label for="exampleInputPassword1">New Password</label>
									<input type="password" class="form-control" name="newPassword" id="exampleInputPassword1" placeholder="Enter New Password" required>
								  </div>
								  
								  <div class="form-group">
									<label for="exampleInputPassword1">Confirm Password</label>
									<input type="password" class="form-control" name="confirmPassword" id="exampleInputPassword1" placeholder="Confirm Password" required>
								  </div>
										
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
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
	
    
  <?php include('footer.php'); ?>