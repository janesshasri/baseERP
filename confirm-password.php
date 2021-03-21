<?
include("database/db_conection.php");
$getToken = $_GET['fgtpwd'];
// echo "SELECT email, token FROM `user_forgot_password` WHERE `token`='".$getToken."'";
$tokenCheck=mysqli_query($dbcon,"SELECT * FROM `user_forgot_password` WHERE `token`='".$getToken."'"); // ORDER BY id DESC LIMIT 0,1');
$tokenUserDetails = $tokenCheck->fetch_assoc();
// echo $tokenUserDetails['email'];
$numS = mysqli_num_rows($tokenCheck);

if(isset($_POST['passwordSubmit'])){
	extract($_POST);

   $getUserDetails="SELECT * FROM  `userprofile` where `useremail`='".$tokenUserDetails['email']."'";
	$getUserDetails=mysqli_query($dbcon,$getUserDetails);
	// if(mysqli_num_rows($getUserDetails)>0) {
        $updateQuery = mysqli_query($dbcon, "UPDATE `userprofile` SET `userpassword` = '$confirmPassword', `repass` = '$confirmPassword' WHERE `useremail` ='".$tokenUserDetails['email']."'");
        $successMsg = "Password updated successfully.";
    // } else {
    //     $userNotFound = "User details not found";
    // }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Password Reset Request</title>

    <!-- Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="assets/css/login.css" rel="stylesheet">

    <!-- Checkboxes style -->
    <link href="assets/css/bootstrap-checkbox.css" rel="stylesheet">
    <script>
    var confirmPassword = document.getElementById("confirmPassword")
  , reConfirmPassword = document.getElementById("reConfirmPassword");

function validatePassword(){
  if(confirmPassword.value != reConfirmPassword.value) {
    reConfirmPassword.setCustomValidity("Passwords Don't Match");
  } else {
    reConfirmPassword.setCustomValidity('');
  }
}

confirmPassword.onchange = validatePassword;
reConfirmPassword.onkeyup = validatePassword;
    </script>
</head>

<body>

<div class="login-menu">
      <div class="container">
        <nav class="nav">
          <!--a class="nav-link" href="https://www.pikeadmin.com/demo-pro">Home</a-->
			<img alt="Logo" src="assets/images/logo.png" /> 
          <!--a class="nav-link active" href="reset-password.php">Password Reset Request</a-->
        </nav>
      </div>
</div>

<div class="container h-100">
	<div class="row h-100 justify-content-center align-items-center">
	
		<div class="card">
			<h4 class="card-header">Password Reset Request</h4>
           <? if($numS == 1){ ?>
			<div class="card-body">
                    	
                        <form data-toggle="validator" role="form" method="post">
                                
								<div class="row">	
									<div class="col-md-12">    
									<div class="form-group">										
										<p><font color="maroon">Enter your Email address in the below box </br>we will mail you the password reset instructions</p> </font>
									<div class="input-group">
									  <div class="input-group-prepend">
										<!--span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span-->
                                       <span class="input-group-text" id="basic-addon1"></span>
										</div>
									  <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Enter new Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>								  
									</div>
                                    <div class="input-group">
									  <div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"></span>
										</div>
									  <input type="password" class="form-control" name="reConfirmPassword" id="reConfirmPassword" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{4,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>								  
									</div>	
									<div class="help-block with-errors text-danger"></div>
									</div>
									</div>
                                </div>								
                                <div class="row">
									<div class="col-md-6">
									<input type="hidden" name="redirect" value="" />
									<input type="submit" class="btn btn-primary btn-lg btn-block" value="Request" name="passwordSubmit" />
									</div>
								</div>
                        </form>
						<div style="color:green; font-weight:700;"><?=$successMsg?></div>
                        <div class="clear"></div> 
						                        <!--i class="fa fa-user-o fa-fw"></i> No account yet? <a href="register.php">Register new account</a><br /-->
                                                <i class="fa fa-undo fa-fw"></i> <a href="index.php">Back to sign in</a>
            
			</div>	
           <? } else { ?>
            <div style="color:red; font-weight:700;">User details not found.</div>
            <? } ?>
		</div>	
		
	</div>	
</div>

<footer class="footer">
	<div class="container">
    <span class="text-muted">Copyright2021@Haje Foods</span>
    </div>
</footer>
	
<!-- Core Scripts -->
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
	
<!-- Bootstrap validator  -->
<script src="assets/js/validator.min.js"></script>

</body>
</html>