<?php 
include("database/db_conection.php");//make connection here

if(isset($_POST['suppCodeEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
    $updateSupplierType = "UPDATE `suptype` SET  `suptype` = '".$suptype."',`description` = '".$description."' WHERE `id` =".$suppID;
    if(mysqli_query($dbcon,$updateSupplierType))
    {
		echo "<script>alert('Supplier Type Details Successfully updated')</script>";
		header("location:listSupplierCode.php");
    } else { echo 'Failed to update user';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
}
?><?php include('header.php');?>	
<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Edit Supplier Details</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Edit Supplier Details</li>
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
								<h5><div class="fa-hover col-md-12 col-sm-12"><i class="fa fa-truck smallfonts" aria-hidden="true"></i> Edit Supplier Details
								</div></h5>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="editSupplierCodeMaster.php"  enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>

								<?php
											include("database/db_conection.php");//make connection here
 
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];											  
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "select suptype,description,id from suptype WHERE id=$id");									 
												while($res = mysqli_fetch_array($result))
												{
													//$title = $res['title'];
													//$cname= $res['name'];
													$suptype = $res['suptype'];												
													$description=$res['description'];
													
												}
											}
												
											?>	
								  <div class="form-row">
									<div class="form-group col-md-8">
									  <label >Supplier Type<span class="text-danger"></span></label>
									  <input type="text" class="form-control" name="suptype" value="<?php echo $suptype;?>" />
									</div>
									
									
								  									
									<div class="form-group col-md-8">
									  <label >Description<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="description" value="<?php echo $description;?>" />
									</div>
									</div>	
									
								   
									
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
															<input type="hidden" name="suppID" value="<?=$_GET['id']?>">
                                                       &nbsp;<button class="btn btn-primary" name="suppCodeEdit" type="submit">
                                                            Update
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
	
    
	<?php include('footer.php');?>