<?php
include("database/db_conection.php");
    $emailsent ='';
    $userNotFound ='';

if(isset($_POST['reset_submit'])){
	extract($_POST);
    $getUserDetails="SELECT * FROM  `userprofile` where `useremail`='$email' ";
	$getUserDetails=mysqli_query($dbcon,$getUserDetails);
	if(mysqli_num_rows($getUserDetails)>0) {
		$userDetails = $getUserDetails->fetch_assoc();
		 $tokeInsert = "INSERT INTO `user_forgot_password`(`email`, `token`) VALUES ('".$userDetails['useremail']."','".md5(strtotime("now"))."')";
		mysqli_query($dbcon,$tokeInsert);
        $to = $userDetails['useremail']; //, somebodyelse@example.com";
		$subject = "Reset your e-Schoolz Account Password";
		$message = "
		<html>
		<head>
		<title>Reset your e-Schoolz Account Password</title>
		</head>
		<body>
		<tr>
		<td>Hi ".$userDetails['username']."! </td>
		</tr>
		<tr>
			<td>We have received your request to reset your account password associated with this email address. If you have not placed this request, you can safely ignore this email and we assure you that your account is completely secure.</td>
		</tr>
		<tr><td>If you do need to change your password, you can use the link given below</td></tr>
		<tr><td><a href='http://www.thuli.co.in/confirm-password.php?fgtpwd=".md5(strtotime("now"))."' target='_blank'>RESET PASSWORD</a></td></tr>
		<tr><td>Please contact support@e-schoolz.com for any quries regarding this</td></tr>
		<tr><td>Cheers</td></tr>
		<tr><td>e-Schoolz Team</td></tr>
		<tr><td>www.e-schoolz.in</td></tr>
		</table>
		</body> 
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// More headers
		$headers .= 'From: <hajefoods@gmail.com>' . "\r\n";
		// $headers .= 'Cc: test@e-schoolz.in' . "\r\n";
		//echo '<pre>';
		//echo 'to '. $to.' subject '.$subject.' message '.$message;
		//echo '</pre>';
		mail($to,$subject,$message,$headers);
		$emailsent = "Your Reset Password Mail has been sent Successfully";

    } else {
        $userNotFound = "Email ID not found,please enter valid email id";

    }
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
           
			<div class="card-body">
                    	
                        <form data-toggle="validator" role="form" method="post">
                                
								<div class="row">	
									<div class="col-md-12">    
									<div class="form-group">										
										<p><font color="maroon">Enter your Email address in the below box </br>we will mail you the password reset instructions</p> </font>
									<div class="input-group">
									  <div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
										</div>
									  <input type="email" class="form-control" name="email" placeholder="Enter your registered email here" data-error="Input valid email"  required>								  
									</div>								
									<div class="help-block with-errors text-danger"></div>
									</div>
									</div>
                                </div>
								
                                <div class="row">
									<div class="col-md-6">
									<input type="hidden" name="redirect" value="" />
									<input type="submit" class="btn btn-primary btn-lg btn-block" value="Request" name="reset_submit" />
									</div>
								</div>
                        </form>
						<div id="email-success" style="color:green; font-weight:700;"><?php echo $emailsent;?></div>
			            <div id="user-not-found" style="color:red; font-weight:700;"><?php echo $userNotFound;?></div>

                        <div class="clear"></div> 
						
						                        <!--i class="fa fa-user-o fa-fw"></i> No account yet? <a href="register.php">Register new account</a><br /-->
                                                <i class="fa fa-undo fa-fw"></i> <a href="index.php">Back to sign in</a>
            
			</div>	
			
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