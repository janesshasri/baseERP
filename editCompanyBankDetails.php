<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['compBankEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
    $updateCompBankDetails = "UPDATE `compbank` SET  `bankname` = '".$bankname."', `acctno` = '".$acctno."',
						`acctname` = '".$acctname."',`acctype`  = '".$acctype."',`branch`  = '".$branch."',`ifsc`  = '".$ifsc."'
						 WHERE `id` =". $compbnkId;
    if(mysqli_query($dbcon,$updateCompBankDetails))
    {
		echo "<script>alert('Profile Successfully updated')</script>";
		header("location:listCompanyBankDetails.php");
    } else { echo 'Failed to update user';
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
}
?>
<?php include('header.php'); ?>

    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Bank Account Details</h1>
                                    <ol class="breadcrumb float-right">
										<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active"> Bank Account Details</li>
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
								<h5><div class="fa-hover col-md-12 col-sm-12"><i class="fa fa-bank smallfonts"  aria-hidden="true"></i> Add Company Bank Account Details
								</div></h5>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="editCompanyBankDetails.php"  enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>

								<?php
											include("database/db_conection.php");//make connection here
 
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];											  
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM compbank WHERE id=$id");									 
												while($res = mysqli_fetch_array($result))
												{
													//$title = $res['title'];
													//$cname= $res['name'];
													$orgid = $res['orgid'];												
													$bankname=$res['bankname'];
													$acctno=$res['acctno'];												 
													$acctname=$res['acctno'];
													$acctype=$res['acctype'];
													$branch=$res['branch'];
													$ifsc=$res['ifsc'];													
												}
											}
											?>	
								
								
									<div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputZip">Organization ID<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="orgid" placeholder="Axis Bank..." readonly  value="<?php echo $orgid;?>" />
									</div>
									</div>
								
								<div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputZip">Bank Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="bankname" placeholder="Axis Bank..." required  value="<?php echo $bankname;?>" />
									</div>
									</div>
								
								<div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputZip">Account#<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="acctno" placeholder="Account Number.." required  value="<?php echo $acctno;?>" />
									</div>
									</div>									
									<div class="form-row">							
									<div class="form-group col-md-6">
									  <label for="inputZip">Account Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="acctname" placeholder="Account Name.." required   value="<?php echo $acctname;?>" />
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-4">
									  <label for="inputState">Account Type <span class="text-danger">*</span></label>
									  <select name="acctype" class="form-control" required>
									   <option <?php if ($acctype == "Savings" ) echo 'selected="selected"' ; ?> value="Savings.">Savings</option>
									    <option <?php if ($acctype == "Current" ) echo 'selected="selected"' ; ?> value="Current">Current</option>
									  </select>
									  </select>
									</div>
									</div>
									
									
									<div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputZip">Branch<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="branch" placeholder="Branch.." value="<?php echo $branch;?>" />
									</div>
									</div>
									<div class="form-row">
									<div class="form-group col-md-6">
									  <label for="inputZip">IFSC<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="ifsc" placeholder="IFSC Code.." value="<?php echo $ifsc;?>" />
									</div>
									</div>
									 
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       <input type="hidden" name="compbnkId" value="<?=$_GET['id']?>">
                                                       &nbsp;<button class="btn btn-primary" name="compBankEdit" type="submit">
                                                            Update
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
<script>
function oncompcode(){
	
	console.log(this);
}
</script>
<!-- END Java Script for this page -->

</body>
</html>