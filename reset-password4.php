<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Reset Your Password</title>

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
			<h4 class="card-header">Reset Your Password</h4>
           
			<div class="card-body">
                    	
                        <form data-toggle="validator" role="form" method="post" action="">
                                
								<div class="row">	
									<div class="col-md-12">    
									<div class="form-group">										
										<p><font color="maroon">To create your new password,provide the following <br>information,and then click Submit</font></p> 
									<div class="input-group">
									  <input type="password" class="form-control" name="password" placeholder="Password" data-error="Input valid email"  required>	
										
									</div>	
										<br>
										<input type="confirmpassword" class="form-control" name="confirmpassword" placeholder="Confirm Password" data-error="Input valid email"  required>	
										<p><font color="grey">Password Must contain at least one number and <br>one uppercase and 
												lowercase letter,and atleast 8 <br>or more characters</p></font>
									
									<div class="help-block with-errors text-danger"></div>
									</div>
									</div>
                                </div>
								
                                <div class="row">
									<div class="col-md-12">
									<input type="hidden" name="redirect" value="" />
									<input type="submit" class="btn btn-primary btn-lg btn-block" value="Submit" name="submit" />
									<input type="cancel" class="btn btn-primary btn-lg btn-block" value="Cancel" name="cancel" />
									</div>
								</div>
                        </form>

                        <div class="clear"></div> 
						
						                        <!--i class="fa fa-user-o fa-fw"></i> No account yet? <a href="register.php">Register new account</a><br /-->
                                                <!--i class="fa fa-undo fa-fw"></i> <a href="index.php">Back to sign in</a-->
            
			</div>	
			
		</div>	
		
	</div>	
</div>

<footer class="footer">
	<div class="container">
     <span class="text-muted">Copyright@Dhiraj Agro Products Pvt. Ltd.,</span>
    </div>
</footer>
	
<!-- Core Scripts -->
<script src="assets/js/jquery-1.10.2.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
	
<!-- Bootstrap validator  -->
<script src="assets/js/validator.min.js"></script>

</body>
</html>