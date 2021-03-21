
<?php 
include("database/db_conection.php");//make connection here

if(isset($_POST['taxMasterEdit']))
{ 
	//var_dump($_POST);
	extract($_POST);
	
	//rdio button implementation
	//$salesoption 	= $_POST['salesoption'];
	//$purchaseoption = $_POST['purchaseoption'];
	
	$updateUser = "UPDATE `taxmaster` SET `taxname` = '".$taxname."',`description` = '".$description."',
	                                      `taxtype` = '".$taxtype."',`taxrate` = '".$taxrate."' WHERE `id` =".$taxMasterId;
    if(mysqli_query($dbcon,$updateUser))
    {
		echo "<script>alert('Tax MAster Details Successfully updated')</script>";
		header("location:listTaxMaster.php");
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
                                    <h1 class="main-title float-left">Edit Tax</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Edit Tax </li>
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
								<h3><div class="fa-hover col-md-8 col-sm-8"> <h3<i class="fa fa-percent bigfonts" aria-hidden="true"></i> Edit Tax </h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								<form autocomplete="off" action="editTaxMaster.php" enctype="multipart/form-data" method="post">
								<?php
											include("database/db_conection.php");//make connection here
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM taxmaster WHERE id=$id");
												
												while($res = mysqli_fetch_array($result))
												{
													$taxname = $res['taxname'];
													$description= $res['description'];
													$taxtype= $res['taxtype'];
													$taxrate= $res['taxrate'];													
												}
											}
												
											?>		
									<div class="form-row">
									<div class="form-group col-md-12">
									  <label >Tax Name<span class="text-danger">&nbsp;*</span></label>
									  <input type="text" class="form-control form-control-sm" name="taxname" value="<?php echo $taxname;?>" />
									</div>
									</div>
									
								    <div class="form-row">
									<div class="form-group col-md-12">
									  <label >Description<span class="text-danger"></span></label>
									  <input type="text" class="form-control form-control-sm" name="description" value="<?php echo $description;?>" />
									</div>
									</div>
									
									<div class="form-row">
                                            <div class="form-group col-md-12">                                                	
													<label>Tax Type</label>
													<select name="taxtype" class="form-control form-control-sm" id="taxtype" >
													<option <?php if ($taxtype == "1" ) echo 'selected="selected"' ; ?> value="1">GST</option>
													<option <?php if ($taxtype == "2" ) echo 'selected="selected"' ; ?> value="2">IGST</option>
													</select>
													</div>
                                            </div>
                                      
									
								
									<div class="form-row">
									<div class="form-group col-md-12">
									  <label >Sales Rate</label><span>%</span>
									  <input type="text" class="form-control form-control-sm" name="taxrate" value="<?php echo $taxrate;?>" />	
									</div>									
									</div>
									
									
									 
								    <div class="form-row">
										<div class="form-group text-right m-b-10">
												<input type="hidden" name="taxMasterId" value="<?=$_GET['id']?>">
										   &nbsp;<button class="btn btn-primary" name="taxMasterEdit" type="submit">
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