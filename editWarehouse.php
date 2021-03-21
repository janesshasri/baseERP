<?php 
include("database/db_conection.php");//make connection here

if(isset($_POST['locEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
    $updateUser = "UPDATE `warehouse` SET `warehousename` = '".$warehouse."' WHERE `id` =".$locID;
    if(mysqli_query($dbcon,$updateUser))
    {
		echo "<script>alert('Location Details Successfully updated')</script>";
		header("location:listWarehouse.php");
    } else { echo 'Failed to update user';
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
                                    <h1 class="main-title float-left">Edit Warehouse</h1>
                                    <ol class="breadcrumb float-right">
										<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Edit Warehouse </li>
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
								 </i> Edit Warehouse Details</div></h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="editWarehouse.php" class="validation fv-form fv-form-bootstrap" enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>

								<?php
											include("database/db_conection.php");//make connection here
 
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];
											  
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM warehouse WHERE id=$id");
									 
												while($res = mysqli_fetch_array($result))
												{
													$warehouse = $res['warehousename'];
													
												}
											}
												
											?>			
								
									
									<div class="form-row">							
									<div class="form-group col-md-12">
									  <label >Location<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="warehouse"  value="<?php echo $warehouse;?>" />
									</div>	

								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
												<input type="hidden" name="locID" value="<?=$_GET['id']?>">
                                                       &nbsp;<button class="btn btn-primary" name="locEdit" type="submit">
                                                            Update
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
 <?php include('footer.php');?>