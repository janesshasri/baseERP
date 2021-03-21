<?php
include("database/db_conection.php");//make connection here

$payeeFound ='';


if(isset($_POST['submit']))
{
$payeename =$_POST['payeename'];
$payeetype =$_POST['payeetype'];
$mobile =$_POST['mobile'];
$amount =$_POST['amount'];
$location =$_POST['location'];
$description =$_POST['description'];
$createdon =$_POST['createdon'];
$createdby =$_POST['createdby'];

$payeeid ="";
	$prefix = "THULI-PAYEE-";
	
	//Generating VoucherIDS
	$sql="SELECT MAX(id) as latest_id FROM payeemaster ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$payeeid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$payeeid = $prefix.$maxid;
		}
	}

	// Payeename already exists or not Validation
	 
	$check_payeename_query="select payeename from payeemaster WHERE payeename='$payeename'";
    $run_query=mysqli_query($dbcon,$check_payeename_query);
	if(mysqli_num_rows($run_query)>0)
    {
		//echo '0';
       // echo "<script>alert('Item Name: $itemname is already exist in our database, Please try another one!')</script>";
        //$fmsg= "Email already exists";   
        $payeeFound = "Payee Name: $payeename is already exists in our database, Please try another one!";
       //exit();
        // header("location:addPurchaseItemMaster.php");
    }
    else{	

$sql="insert into payeemaster(`payeeid`,`payeename`,`payeetype`,`mobile`,`amount`,`location`,`description`,`createdon`,`createdby`) 
VALUES ('$payeeid','$payeename','$payeetype','$mobile','$amount','$location','$description','$createdon','$createdby')";

$sql1= "INSERT into payeemasterlog(`payeeid`,
									`payee`,
									`amount`,
									`createdby`,
									`createdon`)
								  VALUES('$payeeid',
										  '$payeename',
										  '$amount',
								         '$createdby',
										 '$createdon')";
										
	
	//echo $sql;
	
	if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
	{
   
		echo "<script>alert('Payee Master added Successfully ')</script>";
		header("location:listPayeeMaster.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
     echo "<script>alert('Type creation unsuccessful ')</script>";
		exit; //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
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
                                    <h1 class="main-title float-left">Add Payee Master</h1>
                                    <ol class="breadcrumb float-right">
										<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Add Payee Master</li>
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
	
			
                    

					
					<div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 col-xl-8">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								 <h3><div> Add Payee Master Entries
								 </div></h3>all * Marked are Mandatory
								 <p class="text-danger"><?php echo $payeeFound;?></p> 
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action=""  enctype="multipart/form-data" method="post" 	accept-charset="utf-8" >

								<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Date<span class="text-danger"></span></label>
									  <input type="date" class="form-control" name="createdon"  value="<?php print(date("Y-m-d")); ?>"/>
									</div>
									</div>
									
								
									<div class="form-row">		
										<div class="form-group col-md-10">
											<label >Payee<span class="text-danger">*</span></label>
											<input type="text" class="form-control form-control-sm" name="payeename" required/>
										</div>
									</div>	
									
								 <div class="form-row">
                                <div class="form-group col-md-10">
                                    <label >Payee Type<span class="text-danger">*</span></label>
                                    <select required id="inputState" data-parsley-trigger="change"  class="form-control form-control-sm"  name="payeetype" >
                                        <option value="">-Select Payee Type</option>
                                        <option value="Contractor">Contractor</option>
                                        <option value="Supplier">Supplier</option>
										<option value="Employee">Employee</option>
										</select>
                                </div>
                            </div>
							
								<div class="form-row">		
										<div class="form-group col-md-10">
											<label >Description<span class="text-danger"></span></label>
											<textarea rows="2" class="form-control" name="description" ></textarea>
										</div>
									</div>	

								
								<div class="form-row">
                                	<div class="form-group col-md-10">	
										<form class="form-inline">
                                        <label class="sr-only" for="inlineFormInputGroupUsername2">Amount</label>
                                        <div class="input-group mb-2 mr-sm-2">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text">₹</div>
											</div>												
											 <input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required>
										</div>
											
											<!--div class="form-group col-md-5">								
											<span class="input-group-text"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i>
											  <input type="text" id="amount" class="form-control" data-inputmask="'alias': 'ip'" data-mask" name="amount" placeholder="You can Edit Your Own Amt" required  >
										</div-->
								</div>
								</div>
							
								
									
									
									<div class="form-row">									
									 <div class="form-group col-md-10">
                                          <label >Mobile<span class="text-danger">*</span></label>
											      <input data-parsley-type="number" type="text" name="mobile" class="form-control" required placeholder="Enter only numbers" />
                                            </div>
                                        </div>
										
									<div class="form-row">									
										<div class="form-group col-md-10">
                                            <label>Place</label>                                          
                                                <input type="text" class="form-control form-control-sm" name="location" />
										</div>
									</div>
												
							<div class="form-row">
                                    <div class="form-group col-md-10">
                                        <label for="inputState">Created By</label>
                                        <?php 
                                        //session_start();
                                        include("database/db_conection.php");
                                        $userid = $_SESSION['userid'];
                                        $sq = "select username from userprofile where id='$userid'";
                                        $result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
                                        //$count = mysqli_num_rows($result);
                                        $rs = mysqli_fetch_assoc($result);
                                        ?>
                                        <input type="text" class="form-control form-control-sm" name="createdby" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" />

                                   
								   </div>
                                </div>												
									
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        </button>
<button type="button" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">Cancel
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