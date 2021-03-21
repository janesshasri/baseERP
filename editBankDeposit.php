<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['bankDepositEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
    $updateBankDeposit = "UPDATE `bankdeposit` SET  `depositdate` = '".$depositdate."', `bankname` = '".$bankname."',
						`paymethod` = '".$paymethod."',`paytype`  = '".$paytype."',`referenceno`  = '".$referenceno."',`amount`  = '".$amount."',
						`createdby`  = '".$createdby."'
						 WHERE `id` =". $bankDepositID;
    if(mysqli_query($dbcon,$updateBankDeposit))
    {
		echo "<script>alert('Bank Deposit Updated Successfully')</script>";
		header("location:listBankDeposit.php");
    } else {  die('Error: ' . mysqli_error($dbcon));
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
                                    <h1 class="main-title float-left">Edit Bank Deposit/Credits</h1>
                                    <ol class="breadcrumb float-right">
										<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Edit Bank Deposit/Credits</li>
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
								<h5><div class="fa-hover col-md-12 col-sm-12"><i class="fa fa-bank smallfonts"  aria-hidden="true"></i>Edit Bank Deposit/Credits
								</div></h5>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action="editBankDeposit.php"  enctype="multipart/form-data" method="post" accept-charset="utf-8" novalidate="novalidate"><button type="submit" class="fv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>

								<?php
											include("database/db_conection.php");//make connection here
 
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];											  
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT * FROM bankdeposit WHERE id=$id");									 
												while($res = mysqli_fetch_array($result))
												{
													$transid = $res['transid'];												
													$depositdate = $res['depositdate'];
													$bankname = $res['bankname'];
													$paymethod = $res['paymethod'];
													$paytype = $res['paytype'];
													$referenceno = $res['referenceno'];													
													$createdby = $res['createdby'];
													$amount = $res['amount'];
																										
												}
											}
											?>	
								
								
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">Transaction ID<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="transid" readonly  value="<?php echo $transid;?>" />
									</div>
									</div>
								
								<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">Deposit Date<span class="text-danger">*</span></label>
									  <input type="date" class="form-control"  name="depositdate" required  value="<?php echo $depositdate;?>" />
									</div>
									</div>
									
									
								
								<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">Bank Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="bankname"  required  value="<?php echo $bankname;?>" />
									</div>
									</div>									
									
									<div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="inputState">Payment Method</label>
                                                <select id="locname" onchange="onlocode(this)" class="form-control form-control-sm" name="paymethod">
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT paymethod FROM bankdeposit");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $paymethod_get=$row['paymethod'];
                                                         if($paymethod_get==$paytype){
                                                            echo '<option value="'.$paymethod_get.'" selected>'.$paymethod_get.'</option>';

                                                        }else{
                                                            echo '<option value="'.$paymethod_get.'" >'.$paymethod_get.'</option>';

                                                        }
													}
													?>
                                                    
                                                </select>
                                            </div>
                                        </div>
									
									
									<div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="inputState">Payment Type</label>
                                                <select id="locname" onchange="onlocode(this)" class="form-control form-control-sm" name="paytype">
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT paytype FROM bankdeposit");
                                                    while ($row = $sql->fetch_assoc()){	
                                                        echo $paytype_get=$row['paytype'];
                                                         if($paytype_get==$paytype){
                                                            echo '<option value="'.$paytype_get.'" selected>'.$paytype_get.'</option>';

                                                        }else{
                                                            echo '<option value="'.$paytype_get.'" >'.$paytype_get.'</option>';

                                                        }
													}
													?>
                                                    
                                                </select>
                                            </div>
                                        </div>
									
									
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">Reference#<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="referenceno" value="<?php echo $referenceno;?>" />
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">Amount<span class="text-danger">*</span></label>
									  <input type="text" class="form-control"  name="amount" value="<?php echo $amount;?>" />
									</div>
									</div>
									
									<div class="form-row">
                                    <div class="form-group col-md-8">
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
                                        <input type="text" class="form-control form-control-sm" name="createdby" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />

                                    </div>
                                </div>

									 
								    <div class="form-row">
								    <div class="form-group text-right m-b-10">
                                                       <input type="hidden" name="bankDepositID" value="<?=$_GET['id']?>">
                                                       &nbsp;<button class="btn btn-primary" name="bankDepositEdit" type="submit">
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