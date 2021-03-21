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
                    	
                        <form data-toggle="validator" role="form" method="post" action="reset-password3.php">
                                
								<div class="row">	
									<div class="col-md-12">    
									<div class="form-group">										
										<p><font color="maroon">An Email with password reset link sent to your email address:<br>
											<font color="red">sa......e@g....</font>Follow the instructions in the email to <br>reset your account password
										and get back into your account</font></p> 
									<!--div class="input-group">
									  <div class="input-group-prepend">
										<span class="input-group-text" id="basic-addon1"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
										</div>
									  <input type="email" class="form-control" name="email" placeholder="Enter your registered email here" data-error="Input valid email"  required>								  
									</div-->								
									<div class="help-block with-errors text-danger"></div>
									</div>
									</div>
                                </div>
								
                                <!--div class="row">
									<div class="col-md-6">
									<input type="hidden" name="redirect" value="" />
									<input type="submit" class="btn btn-primary btn-lg btn-block" value="Request" name="submit" />
									</div>
								</div-->
                        </form>

                        <div class="clear"></div> 
						
						                        <!--i class="fa fa-user-o fa-fw"></i> No account yet? <a href="register.php">Register new account</a><br /-->
                                                <i class="fa fa-undo fa-fw"></i> <a href="index.php">Back to home</a>
            
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