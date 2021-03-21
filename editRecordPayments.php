<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['expenseEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
	
	
	
	
    $sql = "UPDATE `recordpayments` set 	
										`date` = '".$date."',
	                                    `partyname` = '".$partyname."',
			     						 `place` = '".$place."',
										 `amount`= '".$amount."',
										 `receivedat` = '".$receivedat."',
										 `reference` = '".$reference."',
										 `updatedby` = '".$updatedby."'										
				         				WHERE `id` =".$expID;
										echo  $sql;
										
	// Inserting Log details into ExpenseNoteslog
	//$sql1= "INSERT into expensenoteslog(`voucherid`,
					//					`notes`,
				//						`updatedby`,
						//				`updatedon`)
						//		  VALUES('$voucherid',
							//	         '$notes',
								//		 '$updatedby',
								//		 '$expdate')";									
	//echo $sql1 ;
   if(mysqli_query($dbcon,$sql))
	{
		echo "<script>alert('Payments Successfully updated')</script>";
		header("location:listPaymentsRecords.php");
    } else { 
	die('Error: ' . mysqli_error($dbcon));
		exit;
	echo 'Failed to update user group';
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
                                    <h1 class="main-title float-left">Edit Payment Record</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Edit Payment Records</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>


			
			<div class="row">
			
			
                    

					
					<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								 <h3><div class="fa-hover col-md-8 col-sm-8"><i class="fa fa-inr bigfonts" aria-hidden="true">
								 </i>Edit Payment </div></h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
																
									<form method="post" action="editRecordPayments.php"  enctype="multipart/form-data">
											<?php
											include("database/db_conection.php");//make connection here
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM recordpayments WHERE id=$id");
												while($res = mysqli_fetch_array($result))
												{
													$transid = $res['transid'];
													$date = $res['date'];
													$partyname= $res['partyname'];
													$place = $res['place'];
													//$= $res['payeetype'];
													$amount = $res['amount'];
													$receivedat= $res['receivedat'];
													//$image= $res['image'];
													$reference= $res['reference'];
													
												}
											}
											?>
											
								<div class="form-row">
									<div class="form-group col-md-10">
									  <label>Transid</label>
									  <input type="text" class="form-control form-control-sm" name="transid" readonly value="<?php echo $transid;?>" />
									  </div>
									  </div>
									  
											<div class="form-row">
									<div class="form-group col-md-10">
									   <label for="datepicker1">Date</label><span class="text-danger">*</span>
									  <!--input type="date" class="form-control" name="date" value="<?php echo date("d/m/Y") ?>"/-->
									  <input type="date" class="form-control form-control-sm"  name="date" value="<?php echo $date;?>"/>								
									</div>
									</div>
									
								
								<div class="form-row">
									<div class="form-group col-md-10">
									 Party Name<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="partyname" value="<?php echo $partyname;?>"/>	
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-10">
									 Place<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="place" value="<?php echo $place;?>"/>	
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-10">
									 Update Amount<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="amount" value="<?php echo $amount;?>"/>	
									</div>
									</div>			  
									 
								   
									<div class="form-row">
									<div class="form-group col-md-10">
									  <label >Received at</label>
									 <select required id="inputstate" name="receivedat" data-parsley-trigger="receivedat"  class="form-control form-control-sm"  >	
									    <option <?php if ($receivedat == "Andhra Bank" ) echo 'selected="selected"' ; ?> value="Andhra Bank">Andhra Bank</option>
										<option <?php if ($receivedat == "HDFC Bank" ) echo 'selected="selected"' ; ?> value="HDFC Bank">HDFC Bank</option>
										<option <?php if ($receivedat == "State Bank of India" ) echo 'selected="selected"' ; ?> value="State Bank of India">State Bank of India</option>
										 <option <?php if ($receivedat == "Cash" ) echo 'selected="selected"' ; ?> value="Cash">Cash</option>
										 <option <?php if ($receivedat == "Cheque" ) echo 'selected="selected"' ; ?> value="Cheque">Cheque</option>
										 <option <?php if ($receivedat == "Others" ) echo 'selected="selected"' ; ?> value="Others">Others</option>
										
									</select>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-10">
									 Reference#<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="reference" value="<?php echo $reference;?>"/>	
									</div>
									</div>		
									
									<div class="form-row">
									  <div class="form-group col-md-10">
									  <label for="inputState">Updated By</label>
									  <?php 
														//session_start();
														include("database/db_conection.php");
														$userid = $_SESSION['userid'];
														$sq = "select username from userprofile where id='$userid'";
														$result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
														//$count = mysqli_num_rows($result);
														$rs = mysqli_fetch_assoc($result);
													?>
									   <input type="text" class="form-control form-control-sm" name="updatedby" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" />
									
									 </div>
									 </div>		
								
										<div class="form-row">
								     <div class="modal-footer">
										<input type="hidden" name="expID" value="<?=$_GET['id']?>">
										<button type="submit" name="expenseEdit" value="expenseEdit" class="btn btn-primary">Update</button>
									</div>
									</div>
								
								
								 </form>
                        



            </div>
            <!-- END container-fluid -->

        </div>
        <!-- END content -->

    </div>
    <!-- END content-page -->


    <?php include('footer.php');?>
    

