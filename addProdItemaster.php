<?php
//include('header.php');
include("database/db_conection.php");//make connection here
$itemfound ='';
//$itemNotFound ='';
if(isset($_POST['submit']))
{
	//$prefix = "DAPL/";
	//$postfix = "/";

    $itemname=$_POST['itemname'];//same
    $description=$_POST['description'];//same
	
	$check_itemname_query="select itemname from proditemaster WHERE itemname='$itemname'";
    $run_query=mysqli_query($dbcon,$check_itemname_query);
	if(mysqli_num_rows($run_query)>0)
    {
        $itemfound = "Itemname: $itemname is already exist, Please try another one!";
        //exit;
    }
    else{
	$insert_itemname="INSERT INTO proditemaster(`itemname`,`description`) 
	VALUES ('$itemname','$description')";													    

	
	//echo "$insert_groups";
	
	if(mysqli_query($dbcon,$insert_itemname))
	{
	    //$itemNotfound = "Item created Successfully";
	    //echo "<script>alert('Itemname creation unsuccessful ')</script>";	
	//  echo ' <script type="text/javascript">
	 //   alert("Itemname creation Successful");
	    
	   // </script>';
	header("location:listProdItemaster.php");
	} else { die('Error: ' . mysqli_error($dbcon));
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
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
								<h1 class="main-title float-left"><i class="fa fa-shopping-basket bigfonts">ProductionItemname Master</i></h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a>
										<li class="breadcrumb-item active"> Itemname</li>
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
			
			  <!--div class="alert alert-danger" role="alert">
                <?php echo $itemfound;?>
					  <!--h4 class="alert-heading">Forms</h4-->					  
			    </div--> 

			
			<div class="row">
			
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-shopping-basket bigfonts">Add Itemname</i></h3-->
								<!--h3><div class="fa-hover col-md-8 col-sm-8"><i class="fa fa-user-o bigfonts" aria-hidden="true">
								</i>&nbsp;Add Itemname<span class="text-muted"></span></div></h3-->
								
								<p class="text-danger"><?php echo $itemfound;?></p>
								<!--p class="text-success"><?php echo $itemNotfound;?></p-->
								
							</div>
								
							<div class="card-body">
								
								<form autocomplete="off" action="" enctype="multipart/form-data" method="post">
								
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label >Item/Product Name<span class="text-danger">*</span></label>
									  <input type="text" name="itemname" placeholder="Item/product name" required class="form-control" autocomplete="off">
									</div>
									</div>		
										<div class="form-row">
									<div class="form-group col-md-8">
									  <label >Description<span class="text-danger">*</span></label>
									  <input type="text" name="description" placeholder="description" class="form-control" autocomplete="off">
									</div>
									</div>	
									 
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">Cancel
                                                        </button>
                                                    </div>
													</div>
													
								</form>
							<!--div style="color:green; font-weight:700;"><?php echo $itemNotFound;?></div-->
			           	    <!--div style="color:red; font-weight:700;"><?php echo $itemfound;?></div-->
								
								</div>
								</div>
								</div>
								
								
								
		      </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
	
    
	<!--  <footer class="footer">
		<span class="text-right">
		Copyright@<a target="_blank" href="#">Dhiraj Agro Products Pvt. Ltd.,</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href=""><span>e-Schoolz</span> </a>
		</span>
	</footer> -->

</div>
<!-- END main -->

<?php include('footer.php');?>

<!-- <script src="assets/js/modernizr.min.js"></script>
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
<!-- <script src="assets/js/pikeadmin.js"></script> -->

<!-- BEGIN Java Script for this page -->
 
<!-- 
<script>
                function onlocode(){

                    console.log(this);
                }
            </script>
<!-- END Java Script for this page -->
<!--
</body>
</html>
 -->