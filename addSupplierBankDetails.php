<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
    $supcode = $_POST['supcode']; 
	$bankname = $_POST['bankname'];
    $acctno=$_POST['acctno'];//same
	$acctname=$_POST['acctname'];//same
    $acctype=$_POST['acctype'];//same
    $branch=$_POST['branch'];//same
    $ifsc=$_POST['ifsc'];//same
    

    //$image =base64_encode($image);		

    $insert_compbank="INSERT INTO suppbank(`supcode`,`bankname`,`acctno`,`acctname`,`acctype`,`branch`,`ifsc`)
	VALUES('$supcode','$bankname','$acctno','$acctname','$acctype','$branch','$ifsc')";

     echo "$insert_compbank";
    if(mysqli_query($dbcon,$insert_compbank))
    {
        echo "<script>alert('Company Bank Details Added Successfully ')</script>";
        header("location:listSupplierBankDetails.php");
    } else {
        exit; 
        echo "<script>alert('Company Bank Details Added unsuccessful ')</script>";
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
                                <h1 class="main-title float-left">Vendor Bank Details</h1>
                                <ol class="breadcrumb float-right">
                                    <a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                                <li class="breadcrumb-item active">Vendor Bank Details</li>
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
                                <h3><div class="fa-hover col-md-8 col-sm-8">
                                    <i class="fa fa-bank bigfonts" aria-hidden="true"></i> Add Vendor Bank Details</h3>
                                    </div>

                                <div class="card-body">
                                    <form method="post" enctype="multipart/form-data">
                                          
										  <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="inputState">Supplier Code</label>
                                                <select id="compcode" onchange="onsupcode(this);" class="form-control" name="supcode">
                                                    <option selected>Open Supplier Code</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"select concat(prefix,postfix,gstin,postfix,id) as supcode from vendorprofile");
                                                      while ($row = $sql->fetch_assoc()){	
                                                        echo $supcode_get=$row['supcode'];
                                                        if($supcode_get==$_GET['supcode']){
                                                                echo '<option value="'.$supcode_get.'"  selected>'.$supcode_get.'</option>';  
                                                        }else{
                                                            echo '<option value="'.$supcode_get.'" >'.$supcode_get.'</option>';      
                                                        }
													  }
                                                    ?>
                                                </select>
                                                <script>
                                                    function onsupcode(x)
                                                    {    
                                                        var supcode=x.value;
                                                        window.location.href = 'addSupplierBankDetails.php?supcode='+supcode;
                                                    }
                                                </script>
                                            </div>
                                        </div>
										
											<div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label ><span class="text-danger">Supplier Name:</span> <?php if (isset($_GET["supcode"])) {
                                                    $sup_code = $_GET["supcode"];
                                                    $sql = mysqli_query($dbcon,"select concat(prefix,postfix,gstin,postfix,id) as supcode,supname,blocation from vendorprofile");
											        while ($row = $sql->fetch_assoc()){	
                                                     if($sup_code==$row['supcode']){
                                                        echo $row['supname']; echo "<br>";echo "<br>";
														echo '<span class="text-danger">Supplier Location:</span>&nbsp;'; echo $row['blocation'];
											         }
											}
												}
											?></label>
                                            </div>
                                        </div>
                                        
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">Bank Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="bankname" placeholder="Name of the Bank" required class="form-control" autocomplete="off">
									</div>
									</div>

                                        <div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">Account#<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="acctno" placeholder="Account Number.." required class="form-control" autocomplete="off">
									</div>
									</div>									
									<div class="form-row">							
									<div class="form-group col-md-8">
									  <label for="inputZip">Account Name<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="acctname" placeholder="Account Name.." required class="form-control" autocomplete="off">
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputState">Account Type <span class="text-danger">*</span></label>
									  <select id="inputState" class="form-control" name="acctype">
										<option selected>-Select-</option>
										<option value="Savings">Savings</option>
										<option value="Current">Current</option>
									  </select>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">Branch<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="branch" placeholder="Branch.." required class="form-control" autocomplete="off">
									</div>
									</div>
									<div class="form-row">
									<div class="form-group col-md-8">
									  <label for="inputZip">IFSC<span class="text-danger">*</span></label>
									  <input type="text" class="form-control" name="ifsc" placeholder="IFSC Code.." required class="form-control" autocomplete="off">
									</div>
									</div>
									
                                <div class="form-row">
                                    &nbsp;<div class="form-group text-right m-b-10">
                                    &nbsp;<button class="btn btn-primary" name="submit" type="submit">
                                    Submit
                                    </button>
                                    <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                        Cancel
                                    </button>
                                    </div>
                                </div>
                                </form>

                        </div>							
                    </div><!-- end card-->					
                </div>
			
				
               <?php include('footer.php');?>