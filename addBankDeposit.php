<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{
    $depositdate = $_POST['depositdate'];
	$compcode = $_POST['compcode'];
    $bankname = $_POST['bankname'];
	$acctno =$_POST['acctno'];
    $amount=$_POST['amount'];//same
    $paymethod=$_POST['paymethod'];//same
    $paytype=$_POST['paytype'];//same
    $referenceno=$_POST['referenceno'];//same
    $notes=$_POST['notes'];//same	
    $createdby=$_POST['createdby'];//same
    

    $transid ="";
    $prefix = "0000";


    $sql="SELECT MAX(id) as latest_id FROM bankdeposit ORDER BY id DESC";
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

    //$image =base64_encode($image);		

    $insert_bankdeposit="INSERT INTO bankdeposit(`transid`,`depositdate`,`compcode`,`bankname`,`acctno`,`amount`,`paymethod`,`paytype`,`referenceno`,`notes`,`createdby`)
	VALUES('$transid','$depositdate','$compcode','$bankname','$acctno','$amount','$paymethod','$paytype','$referenceno','$notes','$createdby')";

    echo "$insert_bankdeposit";
    if(mysqli_query($dbcon,$insert_bankdeposit))
    {
        echo "<script>alert('Bank Deposit Added Successfully ')</script>";
        header("location:listBankDeposit.php");
    } else {  die('Error: ' . mysqli_error($dbcon));
            echo "<script>alert('Bank Deposit creation unsuccessful ')</script>";
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
                        <h1 class="main-title float-left">Bank Credits/Deposit</h1>
                        <ol class="breadcrumb float-right">
                            <a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                        <li class="breadcrumb-item active">Bank Credits/Deposit</li>
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
                            <i class="fa fa-bank bigfonts" aria-hidden="true"></i> Credit Bank Deposit<h3>
                            </div>


                            <div class="card-body">
                                <form method="post" enctype="multipart/form-data">

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="datepicker1">Date</label><span class="text-danger">*</span>
                                            <!--input type="date" class="form-control" name="date" value="<?php echo date("d/m/Y") ?>"/-->
                                            <input type="date" class="form-control form-control-sm"  name="depositdate" value="<?php echo date("Y-m-d");?>">									
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                            <select id="compcode"  class="form-control form-control-sm" name="compcode">
                                                <option selected>Open Company Names</option>
                                                <?php 
                                                $sql = mysqli_query($dbcon,"select * from comprofile");
                                                while ($row = $sql->fetch_assoc()){	
                                                    echo $compname = $row['orgname'];
                                                    echo $compcode=$row['orgid'];
                                                    if($compcode==$_GET['orgid']){
                                                        echo '<option value="'.$compcode.'"  selected>'.$compname.'</option>';  
                                                    }else{
                                                        echo '<option value="'.$compcode.'" >'.$compname.'</option>';      
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputState">Bank Name<span class="text-danger">*</span></label>
                                            <select id="bankname" onchange="onbankname(this.value);" class="form-control form-control-sm" name="bankname">
                                                <option selected>Open Bank Names</option>
                                                <?php 
                                                $sql = mysqli_query($dbcon,"select bankname,id from compbank");
                                                while ($row = $sql->fetch_assoc()){	
                                                    echo $bankname_get=$row['bankname'];
                                                    if($bankname_get==$_GET['bankname']){
                                                        echo '<option value="'.$bankname_get.'"  selected>'.$bankname_get.'</option>';  
                                                    }else{
                                                        echo '<option value="'.$bankname_get.'" >'.$bankname_get.'</option>';      
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputState">Account Number</label>
                                            <input type="text" class="form-control form-control-sm" name="acctno" id="acctno" readonly class="form-control form-control-sm"  />

                                        </div>
                                    </div>									


                                    <div class="form-row">
                                        <span class="text-danger"> Amount<label >*</span></label>
                                        <form class="form-inline">	
                                            <div class="input-group mb-2 mr-sm-2 mb-sm-0">								  								  
                                                <div class="input-group-addon">INR</div>
                                                <input type="text" name="amount" class="form-control form-control-sm" id="amount" placeholder="Enter Amount" required>
                                            </div>
                                            </div></br>										

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label >Payment Method</label>
                                            <select required id="paymethod" data-parsley-trigger="change"  class="form-control form-control-sm"  name="paymethod" >
                                                <option value="">Open Payment Method</option>
                                                <option value="Cash">Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="NEFT">NEFT</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label >Payment Type</label>
                                            <select required id="paytype" data-parsley-trigger="change"  class="form-control form-control-sm"  name="paytype" >
                                                <option value="">Open Payment Type</option>
                                                <option value="Sales">Sales</option>
                                                <option value="Payments">Payments</option>
                                                <option value="Others">Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputZip">Reference#</label>
                                            <input type="text" class="form-control" name="referenceno" placeholder="" class="form-control" autocomplete="off">
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label>Notes</label></span>
                                        <textarea cols="20" rows="2" class="form-control tip redactor" name="notes" placeholder="Max 255 Characters "></textarea>
                                    </div> 
                                    </div>

                                <div class="form-row">
                                    <div class="form-group col-md-12">
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
<div class="form-group col-md-12">
<label>
<div class="fa-hover col-md-12 col-sm-12">
<span class="text-danger"><i class="fa fa-paperclip bigfonts" aria-hidden="true"></span></i>&nbsp;Attach Receipt<span class="text-danger">(not more than 1MB)</span></div>
</label> 
&nbsp;&nbsp;<input type="file" name="image" class="form-control">
</div>
</div-->

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

    <script>

        $(function(){
            var compcode11 =  $('#compcode').val();
            if(compcode11!=''){
                onbankname(compcode11);
            }
        });


        function onbankname(x){
            var compcode = $('#compcode').val();
            var bankname = x;
            var edit_data = Page.get_multiple_vals(compcode,"compbank","orgid");

            for(var i=0;i<edit_data.length;i++){
                if(edit_data[i].bankname==bankname){
                    $('#acctno').val(edit_data[i].acctno);
                }
            }

        }


    </script>
    <?php include('footer.php');?>
