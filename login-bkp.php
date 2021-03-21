<?php
session_start(); 
include("database/db_conection.php");
if (isset($_POST['login_email']) and isset($_POST['login_password'])){
//3.1.1 Assigning posted values to variables.
$login_email = $_POST['login_email'];
$login_password = $_POST['login_password'];
//3.1.2 Checking the values are existing in the database or not
$query = "SELECT * FROM `userprofile` WHERE useremail='$login_email' and userpassword='$login_password'";

$result = mysqli_query($dbcon, $query) or die(mysqli_error($dbcon));
$count = mysqli_num_rows($result);
//3.1.2 If the posted values are equal to the database values, then session will be created for the user.
//echo $count;
$rs = mysqli_fetch_assoc($result);
if ($count == 1){
$_SESSION['userid'] = $rs['id'];
//$_SESSION['login_email'] = $rs['firstname']." ".$rs['lastname'];
$_SESSION['login_email'] = $rs['username'];

header('location: index.php');

}else{
	$message = "Invalid User/Password Entered,Please enter valid Email/Password";
echo "<script type='text/javascript'>alert('$message');</script>";
//3.1.3 If the login credentials doesn't match, he will be shown with an error message.
//echo "Invalid Login Credentials.";

}

}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Login</title>

    <!-- Core CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/font-awesome.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="assets/css/login.css" rel="stylesheet">

    <!-- Checkboxes style -->
    <link href="assets/css/bootstrap-checkbox.css" rel="stylesheet
	
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<title>Dhiraj Agro Products Pvt Ltd.,</title>
		<meta name="description" content="Free Bootstrap 4 Admin Theme | Pike Admin">
		<meta name="author" content="Pike Web Development - https://www.pikephp.com">

		<!-- Favicon -->
		<link rel="shortcut icon" href="assets/images/favicon.ico">

		<!-- Bootstrap CSS -->
		<link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Font Awesome CSS -->
		<link href="assets/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
		
		<!-- Custom CSS -->
		<link href="assets/css/style.css" rel="stylesheet" type="text/css" />
		
		<!-- BEGIN CSS for this page -->
		<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>
		<!-- END CSS for this page -->
		
		<!-- Line Items Link-->											 
<!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->	
		<script src="assets/js/modernizr.min.js"></script>
		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/moment.min.js"></script>
		
		<!-- BEGIN CSS for this page -->
		<style>
		.parsley-error {
			border-color: #ff5d48 !important;
		}
		.parsley-errors-list.filled {
			display: block;
		}
		.parsley-errors-list {
			display: none;
			margin: 0;
			padding: 0;
		}
		.parsley-errors-list > li {
			font-size: 12px;
			list-style: none;
			color: #ff5d48;
			margin-top: 5px;
		}
		.form-section {
			padding-left: 15px;
			border-left: 2px solid #FF851B;
			display: none;
		}
		.form-section.current {
			display: inherit;
		}
		</style>
		<!-- END CSS for this page -->
				
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/dataTables.bootstrap4.min.css"/>	
		<style>	
		td.details-control {
		background: url('assets/plugins/datatables/img/details_open.png') no-repeat center center;
		cursor: pointer;
		}
		tr.shown td.details-control {
		background: url('assets/plugins/datatables/img/details_close.png') no-repeat center center;
		}
		</style>		

</head>

<body>

<div class="login-menu">
      <div class="container">
        <nav class="nav">
          <a class="nav-link" href="">About Us</a>
		   <a class="nav-link" href="">Our services</a>
          <a class="nav-link active" href="">Login Screen</a>		  
		  <div class="col-md-8 float-right text-right">																
		<a style="color:lightblue"><span><i class="fa fa-phone bigfonts" aria-hidden="true"></i>+91 9677573737</span><br>
		<span><i class="fa fa-envelope-open-o" aria-hidden="true"></i>&nbsp;saravanas.office@gmail.com</span><br/><i class="fa fa-link"></i> Visit e-schoolz.com</a>		
		</div>
        </nav>
      </div>
</div>

<div class="container h-100">
	<div class="row h-100 justify-content-center align-items-center">
	
		<div class="card">
			<h5 class="card-header"><img alt="Logo" src="assets/images/logo.png" /> 
			<div class="invoice-title text-center mb-3">-Bhairava-</a></div></h5>
           
			<div class="card-body">
                    	
                        <form data-toggle="validator" role="form" method="post" action="login.php">
                                
								<div class="row">	
									<div class="col-md-12">    
									<div class="form-group">
									<label>Login Email</label>
									<div class="input-group">
									  <span class="input-group-addon"><i class="fa fa-envelope-open-o" aria-hidden="true"></i></span>
									  <input type="email" class="form-control" name="login_email" data-error="Input valid email" required>								  
									</div>								
									<div class="help-block with-errors text-danger"></div>
									</div>
									</div>
                                </div>
								
								<div class="row">								
									<div class="col-md-12">
									<div class="form-group">
									<label>Password</label>
									<div class="input-group">
										<span class="input-group-addon"><i class="fa fa-unlock" aria-hidden="true"></i></span>
										<input type="password" id="inputPassword" data-minlength="6" name="login_password" class="form-control" data-error="Password to short" required />
									</div>	
									<div class="help-block with-errors text-danger"></div>
									</div>
									</div>
								</div>
								
								<div class="row">								
								<div class="checkbox checkbox-primary">
                                <input id="checkbox_remember" type="checkbox" name="remember">
                                <label for="checkbox_remember"> Remember me</label>
                                </div>    
								</div>
								
                                <div class="row">
									<div class="col-md-12">
									
									<input type="hidden" name="redirect" value="" />	
									<button type="submit" class="btn btn-primary btn-block btn-flat" name="submit"><i class="glyphicon glyphicon-log-in"></i> &nbsp;Sign in</button>									
									<!--input type="submit" class="btn btn-primary btn-lg btn-block" value="Login" name="submit" /-->
									</div>
								</div>
                        </form>

                        <div class="clear"></div> 
						 
						                        <i class="fa fa-user fa-fw"></i> No account yet? 
												<a href="#custom-modal" data-target="#customModal" data-toggle="modal">Register new account</a><br/>
												<i class="fa fa-undo fa-fw"></i> Forgot password? <a href="reset-password.php">click here to Reset password</a>
								
								<!-- Modal -->
								<div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true" >
								<!--div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 70px; margin-bottom:70px;" --> 
															 
								 <div class="modal-dialog" role="document">
									<div class="modal-content">
									  <div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel2">Add User</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										  <span aria-hidden="true">&times;</span>
										</button>
									  </div>
									  <div class="modal-body">
									  	<form action="#" enctype="multipart/form-data" method="post">
										
										<div class="form-group">
                                                        <label>User Name<span class="text-danger">*</span></label>
                                                        <input type="text" name="user_name" id="addusername" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                                    </div>
													 <div class="form-group">
                                                        <label for="firstname">Firstname<span class="text-danger">*</span></label>
                                                        <input type="text" name="firstname" id="addfirstname" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                                    </div>
													 <div class="form-group">
                                                        <label for="Lastname">Lastname<span class="text-danger">*</span></label>
                                                        <input type="text" name="lastname" id="addlastname" data-parsley-trigger="change" required placeholder="Enter user name" class="form-control" >
                                                    </div>						
																						
											
                                                    <div class="form-group">
                                                        <label for="emailAddress">Email address<span class="text-danger">*</span></label>
                                                        <input type="email" name="email" id="addemail" data-parsley-trigger="change" required placeholder="Enter email" class="form-control" id="emailAddress">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="pass1">Password<span class="text-danger">*</span></label>
                                                        <input id="pass1" type="password" name="password" id="addpassword" placeholder="Password" required class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="passWord2">Confirm Password <span class="text-danger">*</span></label>
                                                        <input data-parsley-equalto="#pass1" type="password" name="repassword" id="addrepassword" required placeholder="Password" class="form-control" id="passWord2">
                                                    </div>
                                                   <div class="form-group">
                                                        <label>Mobile<span class="text-danger">*</span></label>
                                                        <div>
                                                            <input data-parsley-type="number" step="any" name="mobile" id="addmobile" type="text" class="form-control" required placeholder="Enter only numbers"/>
                                                        </div>
                                                    </div>  										
									  <div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<button type="button" name="submituser" id="submituser" class="btn btn-primary">Save</button>
									  </div>
									</div>
								  </div>
								</div>
							
								
								
												
                                               
            
			</div>	
			
		</div>	
		
	</div>	
</div>

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.13.0/esm/popper.js"></script>
<!-- END Java Script for this page -->

<script>
$('document').ready(function(){	
	$('#submituser').click(function(){
		var username = $('#addusername').val();
		var firstname = $('#addfirstname').val();
		var lastname = $('#addlastname').val();
		var email = $('#addemail').val();
		var password = $('#addpassword').val();
		var repassword = $('#addrepassword').val();
		var mobile = $('#addmobile').val();	
		//alert(groupname+description);
		$.ajax ({
           url: 'addNewUserModal.php',
		   type: 'post',
		   data: {
			   
					username:username,
					firstname:firstname,
					lastname:lastname,
					useremail:email,
					userpassword:password,
					repass:repassword,
					mobile:mobile
				  
				},
		   //dataType: 'json',
           success:function(response){
				if(response!=0){
					var new_option ="<option>"+response+"</option>";
					$('#useremail').append(new_option);
					 $('#customModal').modal('toggle');
				}else{
					alert('Error in inserting new user,try another user');
				}
			}
        
         });
		 
		 });
});
			
</script>			

</body>
</html>