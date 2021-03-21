<?php
include("database/db_conection.php");//make connection here
$payeeid = '';
$payee = '';
$description ='';
$amount ='';
$mobile ='';
$location ='';


if(isset($_POST['submit'])){	
	$createdon=$_POST['createdon'];//same
    $category=$_POST['category'];//same
	$payee=$_POST['payee'];//same
	//$payeetype=$_POST['payeetype'];//same
	$paymentmode=$_POST['paymentmode'];//same
	$notes=$_POST['notes'];//same
	//$image=$_POST['image'];//same
	$createdby = $_POST['createdby'];
	$amount = $_POST['amount'];//same
	$reference = $_POST['reference'];//same
	$payeeid = $_POST['payeeid'];
	$description = $_POST['description'];//same
	//$payeename = $_POST['payeename'];//same
	//$id = $_POST['id'];
			
			
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
   // }
		
	//} else {
      //  echo "File is not an image.";
        //$uploadOk = 0;
   // }
	
	$voucherid ="";
	$prefix = "THULI-";
	
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
									`payeeid`,
									`createdon`, 	
									`category`, 
									`description`,					
									`payee`, 	
									`amount`,	
									`reference`,
									`paymentmode`,
									`notes`, 	
									
									`createdby`)
							VALUES ('$voucherid',
									'$payeeid',
									'$createdon',
									'$category',
									'$description',
									'$payee',
									'$amount',
									'$reference',
									'$paymentmode',
									'$notes',
									'$createdby')";		

		
//$sql3 = "UPDATE payeemaster set amount = amount- $amount  WHERE payeeid = $payeeid";
//echo $sql3;			
			
	
	//echo "$insert_recordexpense";
	// Inserting Log details into ExpenseNoteslog
	 $sql1= "INSERT into expensenoteslog(`voucherid`,
										`payeeid`,
										`payee`,
										`amount`,
										`reason`,
										`createdby`,
										`createdon`)
								  VALUES('$voucherid',
										  '$payeeid',
										  '$payee',
										  '$amount',
								          '$notes',
										  '$createdby',
										  '$createdon')";
										  
	//Updating paymaster table's amount 								  
	 $updateamount = "UPDATE payeemaster SET amount = amount - '".$amount."' WHERE payeeid='$payeeid'";
		//echo $updateamount;
		$result=mysqli_query($dbcon,$updateamount);
		if (!$result)
		{
			die('Error: '. mysqli_error($dbcon));

		}
       								

										 
		
	if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
	{
		echo "<script>alert('Expense Master creation Successful ')</script>";
		header("location:listVouchers.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
		exit;
		echo "<script>alert('Transport Master creation  unsuccessful ')</script>";
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
									<h1 class="main-title float-left">Add Expenses</h1>
									<ol class="breadcrumb float-right">
									<li class="breadcrumb-item">Home</li>
									<li class="breadcrumb-item">Expenses</li>
									<li class="breadcrumb-item active">Add Expenses</li>
									</ol>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
						<!-- end row -->

							
							
							
						<div class="row">
							
							<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
								
								<div class="card mb-3">
										
									<div class="card-body">
								
										<form action="#" method="post" enctype="multipart/form-data">					
										
										<div class="row">
											<div class="form-group col-xl-7 col-md-6 col-sm-9">
												<div class="form-row">
													<label >Date<span class="text-danger"></span></label>
													<input type="date" class="form-control form-control-sm" name="createdon"  value="<?php print(date("Y-m-d")); ?>"/>
												</div>
											
												<div class="form-group">											
											<label for="inputState">Payee ID<span class="text-danger"></span></label>
                                         <select id="payeeid" onchange="onpayeeid(this);" class="form-control form-control select2"  name="payeeid" >
                                             <option value="">-Select Payee ID-</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT * FROM payeemaster");
                                                   while ($row = $sql->fetch_assoc()){	
                                                        echo $payeeid_get=$row['payeeid'];
                                                        if($payeeid_get==$_GET['payeeid']){
                                                                echo '<option value="'.$payeeid_get.'"  selected>'.$payeeid_get.'</option>';  
                                                        }else{
                                                            echo '<option value="'.$payeeid_get.'" >'.$payeeid_get.'</option>';      
                                                        }
													  }
                                                    ?>
                                                </select>
                                                <script>
                                                    function onpayeeid(x) 
                                                    {    
                                                        var payeeid=x.value;
                                                        window.location.href = 'recordExpenses.php?payeeid='+payeeid;
                                                    }
                                                </script>									
											</div>
									
									
									
										<div class="form-group">	
									<label for="inputState">Payee Name<span class="text-danger"></span></label>
                                         										
												<?php if (isset($_GET["payeeid"])) {
                                                    $payee_id = $_GET["payeeid"];
                                                    $sql = mysqli_query($dbcon,"select * from payeemaster");
											        while ($row = $sql->fetch_assoc()){	
                                                     if($payee_id ==$row['payeeid']){
														 $id =  $row['id']; 
														
													    $payee =  $row['payeename']; 
														$description =  $row['description'];
														$mobile =  $row['mobile']; 
														$location =  $row['location']; 
														$amount =  $row['amount']; 
												}
												}
												}
											?>
											
												<input type="text" class="form-control form-control-sm" name="payee"  placeholder="Enter Payee Name" value="<?php echo $payee;?>" />
									
													</div>
												
												<div class="form-group">
												<label for="inputState">Expense Category<span class="text-danger">*</span></label>
												<select required id="inputState" data-parsley-trigger="change"  class="form-control form-control select2"  name="category" >
												<option value="">-Select Category-</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT accountname FROM expenseacctmaster");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $expensename=$row['accountname'];
                                                        echo '<option onchange="'.$row[''].'" value="'.$expensename.'" >'.$expensename.'</option>';
                                                    }
                                                    ?>
                                                </select><span class="text-danger">Note: Please Select Category as Bills for Selectd Payee ID</span>
									</div>
												<div class="form-group">
												<label>Description</label>
												<input type="text" name="description" class="form-control form-control-sm " placeholder="Enter Expense Detaiails" value="<?php echo $description;?>" />
												</div>
											
											<div class="form-group">	
												<form class="form-inline">
												<label class="sr-only" for="inlineFormInputGroupUsername2">Enter Amount</label>
													<div class="input-group mb-2 mr-sm-2">
													<div class="input-group-prepend">
													<div class="input-group-text">₹</div>
													</div>												
													<input type="text" name="amount" class="form-control" id="amount" placeholder="Enter Amount" required value="<?php echo $amount;?>" />
												</div>
											</div>
											
											 <div class="form-group">								
												<label >Payment Mode<span class="text-danger">*</span></label>
												<select required id="inputState" data-parsley-trigger="change"  class="form-control select2"  name="paymentmode" >
													<!--option value="">-Select Payment Mode-</option-->
														<option value="Cash">Cash</option>
														<option value="Cheque">Cheque</option>
														<option value="Credit Card">Credit Card</option>
														<option value="Net Banking">Net Banking</option>
														<option value="PhonePe">PhonePe</option>
														<option value="GPay">GPay</option>

												</select>
											</div>      
											
								        <div class="form-group">
												<label>Reference</label><br />
												<input type="text" name="reference" class="form-control form-control-sm " placeholder="Cheque No/Payment Transaction Ref No..">
												</div>
											
								
										<div class="form-group">
												<label>Notes</label><br />
												<textarea rows="2" class="form-control  form-control-sm" name="notes" placeholder="Add Expense Notes"></textarea>
										</div>
												<!--div class="form-group">
													<label>Upload Bills </label><br />
													<input type="file" name="image" class="form-control">
												</div-->
												
												 <div class="form-group">
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
													
							
												
												<div class="form-group">
												&nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                                            Submit
                                                        </button>
                                                        </button>
															<button type="button" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">Cancel
                                                        </button>
                                                    </div>
												</div>
											
											<div class="form-group col-xl-4 col-md-4 col-sm-12 border-left">
											
                                                <label ><span class="text-danger"></label>
												<b>Payeename:</b>&nbsp; <?php echo $payee; ?>  <br><br>
												<b>Description:</b>&nbsp;<?php echo $description; ?><br><br>
												<b>Mobile:</b>&nbsp;<?php echo $mobile; ?><br><br>
												<b>Location:</b>&nbsp;<?php echo $location; ?><br><br>
												
												<b>Payable Amount:</b>&nbsp;<?php echo $amount; ?><br>
												
												
														
											        
                                            </div>
                                        </div>
                                        
											
											
											
											
												
												
											</div>
									
											</div><!-- end row -->	
										</form>
								
									</div>	
									<!-- end card-body -->								
								
								</div>
							<!-- end card -->					

							</div>
							<!-- end col -->	
														
						</div>
						<!-- end row -->	



            </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
    
	<?php include('footer.php'); ?>
</div>


</body>
</html>