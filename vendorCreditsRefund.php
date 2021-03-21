<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit'])){
	
	
    $expdate=$_POST['expdate'];//same
    $expacctname=$_POST['expacctname'];//same
	$payee=$_POST['payee'];//same
	$payeetype=$_POST['payeetype'];//same
	$paymentype=$_POST['paymentype'];//same
	$notes=$_POST['notes'];//same
	//$image=$_POST['image'];//same
	$createdby = $_POST['createdby'];
	$amount = $_POST['amount'];//same
			

//$image =base64_encode($image);	
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
		
	} else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	
	$voucherid ="";
	$prefix = "0000";
	
	//Generating VoucherIDS
	$sql="SELECT MAX(id) as latest_id FROM recordexpense ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$voucherid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$voucherid = $prefix.$maxid;
		}
	}

	$sql="INSERT INTO recordexpense(`voucherid`, 	
									`date`, 	
									`accountname`, 	
									`payee`, 	
									`payeetype`, 	
									`paymentype`,
									`amount`,														
									`notes`, 	
									`image`,
									`createdby`)
							VALUES ('$voucherid',
									'$expdate',
									'$expacctname',
									'$payee',
									'$payeetype',
									'$paymentype',
									'$amount',
									'$notes',
									'$target_file',
									'$createdby')";													    
					
	//echo "$insert_recordexpense";
	// Inserting Log details into ExpenseNoteslog
	$sql1= "INSERT into expensenoteslog(`voucherid`,
										`notes`,
										`createdby`,
										`createdon`)
								  VALUES('$voucherid',
								         '$notes',
										 '$createdby',
										 '$expdate')";
										
	if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
	{
		echo "<script>alert('Expense Master creation Successful ')</script>";
		header("location:listExpenses.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
		exit;
		echo "<script>alert('Transport Master creation  unsuccessful ')</script>";
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
                                    <h1 class="main-title float-left">Vendor Credits Refund</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Vendor Credits Refund</li>
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
								 <h3>
								 Record Vendor Credits Refund</h3>								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->							
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action=""  enctype="multipart/form-data" method="post" accept-charset="utf-8">
								
								<div class="form-row">
									<div class="form-group col-md-12">
									 Credit Ref#<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" readonly name="cnno">
									</div>
									</div>
								
								<div class="form-row">
									<div class="form-group col-md-12">
									   <label for="datepicker1">Refunded On</label><span class="text-danger">*</span>
									  <!--input type="date" class="form-control" name="date" value="<?php echo date("d/m/Y") ?>"/-->
									  <input type="date" class="form-control form-control-sm"  name="rfdate" value="<?php echo date("Y-m-d");?>">									
									</div>
									</div>
									
								
								<div class="form-row">      
								<div class="form-group col-md-12">
                                                <label >Payment Mode<span class="text-danger">*</span></label>
                                                <select required id="payment_mode" data-parsley-trigger="change"  class="form-control form-control-sm"  name="payment_mode" >
                                                    <option value="">-- Select Payment Mode --</option>
                                                    <option value="Cash">Cash</option>
                                                    <option value="Cheque">Cheque</option>
                                                    <option value="Credit Card">Credit Card</option>
                                                    <option value="Bank Transfer">Bank Transfer</option>
                                                    <option value="Bank Remittance">Bank Remittance</option>
                                                </select>
                                            </div>
                                        </div>
											  
									 
								    <div class="form-row">
									<div class="form-group col-md-12">
									 Reference #<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="payee" placeholder="" autocomplete="off" required>
									</div>
									</div>							
									
									
									<div class="form-row">
								 <span class="text-danger"> Amount<label >*</span></label>
									<form class="form-inline">	
								  <div class="input-group mb-2 mr-sm-2 mb-sm-0">								  								  
									<div class="input-group-addon">INR</div>
									<input type="text" name="amount" class="form-control form-control-sm" id="inlineFormInputGroupUsername2" placeholder="Enter Amount" required>
								  </div>
									</div>	</br>									
									
									
									<div class="form-row">
									  <div class="form-group col-md-12">
									  <label for="inputState">Handler</label>
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
									<div class="form-group col-md-12">
									 <label>Notes</label></span>
									  <textarea cols="20" rows="2" class="form-control tip redactor" name="notes" placeholder="Max 200 Characters "></textarea>
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

 