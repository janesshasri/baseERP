<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
	
    $paymentterm=$_POST['paymentterm'];//same
    $description=$_POST['description'];//same
	//$compcode=$_POST['compcode'];
	
	

   //$image =base64_encode($image);														
	$insert_paymenterm="INSERT INTO paymentterm(`paymentterm`,`description`) 
	VALUES ('$paymentterm','$description')";													    

	
	//echo "$insert_paymenterm";
	
	if(mysqli_query($dbcon,$insert_paymenterm))
	{
		echo "<script>alert('payment Term creation Successful ')</script>";
		header("location:listPaymentTermMaster.php");
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
                                    <h1 class="main-title float-left">Payment Term Master</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Payment Term Master</li>
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
								 <h3><div class="fa-hover col-md-8 col-sm-8"><i class="fa fa-inr bigfonts" aria-hidden="true">
								 </i>Add Payment Term Master </div></h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">
								
										<div class="form-row">
									<div class="form-group col-md-12">
									  <label >Payment Term<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="paymentterm" placeholder="Due on Receipt,Advance,Net 15,Net 30,Net 45,Net60,Due EOM,Due NM,Immediate" required >
									</div>
								  	    <div class="form-group col-md-12">
									  <label >Description</label>
									  <input type="text" class="form-control" name="description"   class="form-control" autocomplete="off">
									</div>
									</div>
									 
								     <div class="form-row">
                                    &nbsp;<div class="form-group text-right m-b-10">
                                    &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                    Submit
                                    </button>
                                    <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                        Cancel
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
	
   <?php include('footer.php'); ?>