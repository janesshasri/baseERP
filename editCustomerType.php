<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['cusTypeEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
	
    $updateCustomerType= "UPDATE `custype` SET `custype` = '".$custype."',`description` = '".$description."'
										WHERE `id` =".$cusTypeID;
	//echo $updatePurItmCtgry;
    if(mysqli_query($dbcon,$updateCustomerType))
    {
		echo "<script>alert('Customer Type Successfully updated')</script>";
     header("location:listCustomerType.php");
    } else { echo 'Failed to update user group';
	exit; //echo "<script>alert('User creation unsuccessful ')</script>";
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
                                    <h1 class="main-title float-left">Customer Type</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Customer Type</li>
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
							<h3> <div class="fa-hover col-md-8 col-sm-8"><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i> Add Purchase Item Category 
							<span class="text-muted"></span></div></h3>
								
							</div>
								
							<div class="card-body">
								
								<form method="post" action="editCustomerType.php"  enctype="multipart/form-data">
											<?php
											include("database/db_conection.php");//make connection here
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM custype WHERE id=$id");
												while($res = mysqli_fetch_array($result))
												{
													$custype = $res['custype'];
													$description= $res['description'];
													
												}
											}
											?>
									
									<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Customer Type</label>
									  <input type="text" class="form-control" name="custype" value="<?php echo $custype;?>"/>
									  </div>
									  
									<div class="form-group col-md-10">
									  <label >Description</label>
									  <input type="text" class="form-control" name="description" value="<?php echo $description;?>"/>
									</div>
									</div>
										
								    <div class="modal-footer">
										<input type="hidden" name="cusTypeID" value="<?=$_GET['id']?>">
										<button type="submit" name="cusTypeEdit" value="userEdit" class="btn btn-primary">Update</button>
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
		Copyright@<a target="_blank" href="#">Dhiraj Agro Products Pvt. Ltd.,</a>
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

</body>
</html>