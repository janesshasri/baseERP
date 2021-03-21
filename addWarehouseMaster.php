<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
	$locationid ="";
	$prefix = "LOC00";
	//$prefix = "DAP/LOC/";
    $warehousename=$_POST['warehousename'];//here getting result from the post array after submitting the form.
    $description=$_POST['description'];

   //$image =base64_encode($image);														

  $sql="SELECT MAX(id) as latest_id FROM warehouse ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$locationid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$locationid = $prefix.$maxid;
		}
	}   
	
    $insert_location="insert into warehouse(`location_id`,`warehousename`,`description`) 
	VALUES ('$locationid','$warehousename','$description')";
	
	//echo $insert_location;
	
	if(mysqli_query($dbcon,$insert_location))
	{
   
		echo "<script>alert('Location created Successfully ')</script>";
		header("location:listWarehouse.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
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
                                    <h1 class="main-title float-left">Add Warehouse Details</h1>
                                    <ol class="breadcrumb float-right">
										<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Add Warehouse Details </li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>
            <!-- end row -->

            
			<!--div class="alert alert-success" role="alert">
			
					  <h3 class="alert-heading"></h3>
					  <p></a></p>
			</div-->
	
			
                    

					
					<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								 <h3><div class="fa-hover col-md-8 col-sm-8"><i class="fa fa-truck bigfonts" aria-hidden="true">
								 </i> Add Warehouse Details</div></h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action=""  enctype="multipart/form-data" method="post" 	accept-charset="utf-8" >

								
								<div class="form-row">
								<div class="form-group col-md-8">
								
								
									
									<div class="form-row">							
									<div class="form-group col-md-12">
									  <label >Warehouse Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="warehousename" required placeholder="Raw Material Store,Export Store,Production" autocomplete="off" required>
									</div>
										<div class="form-group col-md-12">
									  <label >Description<span class="text-danger"></span></label>
									  <input type="text" class="form-control" name="description"  autocomplete="off">
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
							
								
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
    
<?php include('footer.php'); ?>