<?php
//include('header.php');
include("database/db_conection.php");//make connection here
$groupfound ='';
$groupNotFound ='';
if(isset($_POST['submit']))
{
	//$prefix = "DAPL/";
	//$postfix = "/";

    $groupname=$_POST['groupname'];//same
    $description=$_POST['description'];//same
	
	$check_groupname_query="select groupname from groups WHERE groupname='$groupname'";
    $run_query=mysqli_query($dbcon,$check_groupname_query);
	if(mysqli_num_rows($run_query)>0)
    {
        $groupfound = "Group $groupname is already exist in our database, Please try another one!";
        //exit;
    }
    else{
	$insert_groups="INSERT INTO groups(`groupname`,`description`) 
	VALUES ('$groupname','$description')";													    

	
	//echo "$insert_groups";
	
	if(mysqli_query($dbcon,$insert_groups))
	{
	    //$groupNotFound = "User Group creation Successful";
	    //echo "<script>alert('User creation unsuccessful ')</script>";	
	   echo ' <script type="text/javascript">
	    alert("User Group creation Successful");
	    location="listUserGroups.php";
	    </script>';
	//header("location:listUserGroups.php");
	} else { die('Error: ' . mysqli_error($dbcon));
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
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
                                    <h1 class="main-title float-left">User Group</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">User Group</li>
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
								<h3><i class="fa fa-check-square-o"></i>Add User Group </h3>
								
								<p class="text-success"><?php echo $groupNotFound;?></p>
								<p class="text-danger"><?php echo $groupfound;?></p>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<form autocomplete="off" action="" enctype="multipart/form-data" method="post">
								
									<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Group Name<span class="text-danger">*</span></label>
									  <input type="text" name="groupname" placeholder="Members,Admin,Manager,Superadmin,Staff" required class="form-control form-control-sm" autocomplete="off">
									</div>
									</div>
											
										<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Description<span class="text-danger"></span></label>
									  <input type="text"  name="description" placeholder="" required class="form-control form-control-sm" autocomplete="off">
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
	
    
	<!--  <footer class="footer">
		<span class="text-right">
		Copyright@<a target="_blank" href="#">Dhiraj Agro Products Pvt. Ltd.,</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href=""><span>e-Schoolz</span> </a>
		</span>
	</footer> -->

</div>
<!-- END main -->

<?php include('footer.php');?>

<!-- <script src="assets/js/modernizr.min.js"></script>
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
<!-- <script src="assets/js/pikeadmin.js"></script> -->

<!-- BEGIN Java Script for this page -->
 
<!-- 
<script>
                function onlocode(){

                    console.log(this);
                }
            </script>
<!-- END Java Script for this page -->
<!--
</body>
</html>
 -->