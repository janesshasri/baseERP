<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
	//$prefix = "DAP/LOC/";
    $custype=$_POST['custype'];//here getting result from the post array after submitting the form.
    $description=$_POST['description'];

   //$image =base64_encode($image);														
														    
	
    $insert_customerType="insert into custype(`custype`,`description`) 
	VALUES ('$custype','$description')";
	
	//echo $insert_location;
	
	if(mysqli_query($dbcon,$insert_customerType))
	{
   		echo "<script>alert('Customer Type created Successfully ')</script>";
		header("location:listCustomerType.php");
    } else {
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
?>
<?php include('header.php'); ?>
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
							<h3> <div class="fa-hover col-md-8 col-sm-8">
							<i class="fa fa-user-circle-o bigfonts" aria-hidden="true">
								</i>Add Customer Type
							<span class="text-muted"></span></div></h3>
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="" enctype="multipart/form-data" method="post" accept-charset="utf-8" >
								
									
									<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Customer Type<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="custype" placeholder="Wholesaler,Distributor,Retailer" required >
									  </div>
									  
									<div class="form-group col-md-10">
									  <label >Description</label>
									  <input type="text" class="form-control" name="description" placeholder="" >
									</div>
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