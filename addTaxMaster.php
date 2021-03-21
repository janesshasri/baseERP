<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
	
    $taxname=$_POST['taxname'];//same
    $description=$_POST['description'];//same
	$taxtype=$_POST['taxtype'];
	$taxrate=$_POST['taxrate'];
	
	$insert_taxmaster="INSERT INTO taxmaster(`taxname`,`description`,`taxtype`,`taxrate`) 
	VALUES ('$taxname','$description','$taxtype','$taxrate')";													    

	
	echo "$insert_taxmaster";
	
	if(mysqli_query($dbcon,$insert_taxmaster))
	{
		echo "<script>alert('Tax rate creation Successful ')</script>";
		header("location:listTaxMaster.php");
    } else {
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
                                    <h1 class="main-title float-left">Tax Master</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Tax Master </li>
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
								 <h3><div class="fa-hover col-md-6 col-sm-6"><i class="fa fa-percent bigfonts" aria-hidden="true"></i> 
								 </i>Setting up Tax </div></h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action=""  enctype="multipart/form-data" method="post" accept-charset="utf-8">

								
								<div class="form-row">
									<div class="form-group col-md-12">
									  <label >Tax Name<span class="text-danger">&nbsp;*</span></label>
									  <input type="text" class="form-control form-control-sm" id="taxname" name="taxname" placeholder="18%GST(18%),21%IGST(21%)" autocomplete="off" required>
									</div>
									</div>
									
								    <div class="form-row">
									<div class="form-group col-md-12">
									  <label >Description<span class="text-danger"></span></label>
									  <input type="text" class="form-control form-control-sm" name="description" placeholder="Optional" autocomplete="off" >
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-12">
									<label >Tax Type<span class="text-danger">&nbsp;*</span></label>
                                              <select id="taxtype" class="form-control form-control-sm" name="taxtype"  autocomplete="off" required>
												  <span class="text-muted"> 
												  <option value="">Tax Type</option> </span>
                                                    <option value="single">single</option>
													<option value="split">split</option>
											  </select>
											  <font color="grey">Select single for IGST and split for CGST & SGST</font>
									</div>
									
									</div>
									
								<!--div class="form-row"> Radio button
									<div class="col-md-12 col-md-offset-12">
										<div class="checkbox"><label>Sales : &nbsp;&nbsp;&nbsp;</label>
											Yes <input type="radio" name="salesoption" value="1" class=class="fa fa-check-square-o" checked>							 
											No <input type="radio" name="salesoption" value="0" class=class="fa fa-check-square-o">							 
										</div>
									</div>
								</div-->
								 
									<div class="form-row">
									<div class="form-group col-md-12">
									  <label >Taxrate<span class="text-danger">&nbsp;%*</span></label>
									  <input type="text" class="form-control form-control-sm" name="taxrate" placeholder="Rate in % (just enter the tax rate value, do not use %symbol)" autocomplete="off" required>
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
	
    
<?php include('footer.php');?>