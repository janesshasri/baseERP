<?php

include("database/db_conection.php");//make connection here


if(isset($_POST['submit'])){
	
	
    $date=$_POST['date'];//same
    $partyname=$_POST['partyname'];//same
	$place=$_POST['place'];//same
	$amount=$_POST['amount'];//same
	//$paymentype=$_POST['paymentype'];//same
	$receivedat=$_POST['receivedat'];//same
	$reference=$_POST['reference'];//same
	//$image=$_POST['image'];//same
	$createdby = $_POST['createdby'];
	//$amount = $_POST['amount'];//same
			

//$image =base64_encode($image);	
//$target_dir = "upload/";
//$target_file = $target_dir . basename($_FILES["image"]["name"]);
//$uploadOk = 1;
//$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
  //  $check = getimagesize($_FILES["image"]["tmp_name"]);
    //if($check !== false) {
      //  if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    //} else {
      //  echo "Sorry, there was an error uploading your file.";
    //}
		
	//} else {
      //  echo "File is not an image.";
        //$uploadOk = 0;
    //}
	
	$transid ="";
	$prefix = "00000";
	
	//Generating Transaction IDs
	$sql="SELECT MAX(id) as latest_id FROM recordpayments ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$transid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$transid = $prefix.$maxid;
		}
	}

	$sql="INSERT INTO recordpayments(`transid`, 	
									`date`, 	
									`partyname`, 	
									`place`, 	
									`amount`, 	
									`receivedat`,														
									`reference`, 	
									
									`createdby`)
							VALUES ('$transid',
									'$date',
									'$partyname',
									'$place',
									'$amount',
									'$receivedat',
									'$reference',									
									'$createdby')";	
	//echo $sql;
					
	//echo "$insert_recordexpense";
	// Inserting Log details into ExpenseNoteslog
	//$sql1= "INSERT into expensenoteslog(`voucherid`,
									//	`notes`,
									//	`createdby`,
									//	`createdon`)
								//  VALUES('$voucherid',
								  //       '$notes',
									//	 '$createdby',
									//	 '$expdate')";
										
	if(mysqli_query($dbcon,$sql))
	{
		echo "<script>alert('Payments Record creation Successful ')</script>";
		header("location:listPaymentsRecords.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
		exit;
		echo "<script>alert('paymnets record  creation  unsuccessful ')</script>";
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
                                    <h1 class="main-title float-left">Payments Entry Screen</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Payments Entry Screen</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>
				
			<div class="row">					
					<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-xl-10">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								 <h3>
								 Record Payments</h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action=""  enctype="multipart/form-data" method="post" accept-charset="utf-8">
								
								
								
								<div class="form-row">
									<div class="form-group col-md-6">
									   <label for="datepicker1">Date</label><span class="text-danger">*</span>
									  <!--input type="date" class="form-control" name="date" value="<?php echo date("d/m/Y") ?>"/-->
									  <input type="date" class="form-control form-control-sm"  name="date" value="<?php echo date("Y-m-d");?>">									
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-6">
									 Party Name<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="partyname" placeholder="Enter Name of party" autocomplete="off" required>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-6">
									 Place<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="place" placeholder="Enter palce of the party" autocomplete="off" required>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-6">
									 Enter Amount<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="amount" placeholder="Enter amount received from the party" autocomplete="off" required>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-6">
									  <label >Received at</label>
									 <select required id="inputState" class="form-control form-control-sm"  name="receivedat" >
										<option value="">Choose Type</option>
										<option value="Andhra Bank">Andhra Bank</option>
										<option value="HDFC Bank">HDFC Bank</option>
										<option value="State Bank of India">State Bank of India</option>
										<option value="Cash">Cash</option>	
										 <option value="Cheque">Cheque</option>
										 <option value="Others">Others</option>
									</select>
									</div>
									</div>
									
									
									
									<div class="form-row">
									<div class="form-group col-md-6">
									 Reference#<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="reference" placeholder="Enter amount received from the party" autocomplete="off" required>
									</div>
									</div>
									
									<div class="form-row">
									  <div class="form-group col-md-6">
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
									
									
									
									 <!--div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>
                                            <div class="fa-hover col-md-10 col-sm-10">
                                           <span class="text-danger"><i class="fa fa-paperclip bigfonts" aria-hidden="true"></span></i>&nbsp;Attach Receipt<span class="text-danger">(not more than 1MB)</span></div>
                                        </label> 
                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control">
                                    </div>
									</div-->
									
                                <div class="form-row">
                                    <div class="form-group text-right m-b-0">
                                         <button  name="submit" class="btn btn-primary" type="submit" >
                                        Submit
                                        </button>
                                        <button id="cancel-form" type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                            Cancel
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
    
</div>
<!-- END main -->
