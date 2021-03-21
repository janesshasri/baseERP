<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit'])){

    $suptype=$_POST['suptype'];//same
    $description = $_POST['description'];//same
			    
	
    $insert_suptype="insert into suptype(`suptype`,`description`) 
	VALUES ('$suptype','$description')";
	
	echo "$insert_suptype";
	
	if(mysqli_query($dbcon,$insert_suptype))
	{
   		echo "<script>alert('Supplier Type creation Successful ')</script>";
		header("location:listSupplierCode.php");
    } else {
		//exit; 
		echo "<script>alert('supplier type creation unsuccessful ')</script>";
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
                                    <h1 class="main-title float-left">Supplier Type Master</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Supplier Type Master</li>
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
			
                    

					
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								<h5><div class="fa-hover col-md-12 col-sm-12"><i class="fa fa-truck smallfonts" aria-hidden="true"></i> Add Supplier Type </div></h5>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
							<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">
						
						
								    <div class="form-row">
									<div class="form-group col-md-10">
									  <label >Supplier Type<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="suptype" placeholder="Distributor,Wholeseller,Supplier..." required>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Description<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="description" placeholder="a short note about nature of supplier" required>
									</div>
									</div>
								
									
									 
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset"  name="cancel" class="btn btn-secondary">
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
	
   <?php include('footer.php');?>