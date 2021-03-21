<?php 
include('header.php');
include('workers/getters/functions.php');
function get_users_count(){
    global $dbcon;
    $sql_q = "select id from userprofile where status=1";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");
    return mysqli_num_rows($exc_q);
}
function get_po_count(){
    global $dbcon;
    $sql_q = "select id from purchaseorders where po_status='Created'";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");
    return mysqli_num_rows($exc_q);
}

function get_grn_count(){
    global $dbcon;
    $sql_q = "select id from grn_notes where grn_status='Recorded'";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");
    return mysqli_num_rows($exc_q);
}

function get_so_count(){
    global $dbcon;
    $sql_q = "select id from salesorders where so_status='Created'";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");
    return mysqli_num_rows($exc_q);
}

function get_inv_count(){
    global $dbcon;
    $sql_q = "select id from invoices where inv_payment_status='Unpaid'";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");
    return mysqli_num_rows($exc_q);
}

function get_payables(){
    global $dbcon;

    $sql_q = "select SUM(grn_balance) as payables from grn_notes where grn_payment_status!='Paid' and grn_status='Approved' ";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");

    $row=mysqli_fetch_assoc($exc_q);
    echo $row['payables']?$row['payables']:0;

}

function get_payables_overdue(){
    global $dbcon;

    $sql_q = "select SUM(grn_balance) as payables from grn_notes
where grn_payment_status!='Paid' and grn_status='Approved' and DATE_ADD(grn_date, INTERVAL grn_po_payterm DAY) < CURDATE()";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");

    $row=mysqli_fetch_assoc($exc_q);
    echo $row['payables']?$row['payables']:0;

}

function get_recievables(){
    global $dbcon;
    $sql_q = "select SUM(inv_balance_amt) as recievables from invoices where inv_payment_status!='Paid' and inv_status='Approved' ";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");

    $row=mysqli_fetch_assoc($exc_q);
    echo $row['recievables']?$row['recievables']:0;
}

function get_recievables_overdue(){
    global $dbcon;
    $sql_q = "select SUM(inv_balance_amt) as recievables from invoices
where inv_payment_status!='Paid' and inv_status='Approved' and DATE_ADD(inv_date, INTERVAL inv_payterm DAY) < CURDATE()";
    $exc_q = mysqli_query($dbcon,$sql_q)or die("Error");

    $row=mysqli_fetch_assoc($exc_q);
    echo $row['recievables']?$row['recievables']:0;
}

//function get_vendor_openbalance(){
//global $dbcon;
//$sql_q = "select sum(openbalance) from vendorprofile";
//$exc_q = mysqli_query($dbcon,$sql_q)or die("Error");
//	return array_sum($exc_q);
//}


?>
<!-- End Sidebar -->


<div class="content-page">

    <!-- Start content -->
    <div class="content">
        
        <div class="container-fluid">
					
						<div class="row">
									<div class="col-xl-12">
											<div class="breadcrumb-holder">
													<!--h1 class="main-title float-left">Dashboard</h1-->
											<!--img src="assets/images/avatars/logo.png" alt="Profile image" width="80" height="80" class="avatar-rounded"-->
											<!--img src="assets/images/avatars/logo.png" alt="Profile image" width="80" height="80" class="avatar-rounded"-->
											<!--img src="assets/images/avatars/dhirajLogo.jpg" alt="Profile image" width="180" height="60" -->    
                                                <img src="assets/images/logo.png" alt="Profile image" width="160" height="140">  
												<?php if(isset($_SESSION['login_email'])){ echo $_SESSION['login_email']; } ?>
                                                <font face="Hemi Head Rg" color="Apple Red">Logged In</font>
										   </div>
    
									</div>
						</div>
        

        <div class="container">
            <br/>
            <div class="row">
                <div class="col-md-3">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title lead text-center">PO PENDING APPROVALS</h5>
                            <p class="display-4 card-text text-center text-success ">
                                <?php echo get_po_count();?>
                            </p>
                            <!--
<a href="#" class="btn btn-primary">Go somewhere</a>
-->
                        </div>
                    </div>

                </div>
                <div class="col-md-3">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title lead text-center">GRN PENDING APPROVALS</h5>
                            <p class="display-4 card-text text-center text-danger">
                                <?php echo get_grn_count();?>

                            </p>
                            <!--
<a href="#" class="btn btn-primary">Go somewhere</a>
-->
                        </div>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title lead text-center">SO PENDING APPROVALS</h5>
                            <p class="display-4 card-text text-center text-warning">
                                <?php echo get_so_count();?>

                            </p>
                            <!--
<a href="#" class="btn btn-primary">Go somewhere</a>
-->
                        </div>
                    </div>

                </div>

                <div class="col-md-3">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title lead text-center">UNPAID INVOICES</h5>
                            <br/>
                            <p class="display-4 card-text text-center text-info">
                                <?php echo get_inv_count();?>

                            </p>
                            <!--
<a href="#" class="btn btn-primary">Go somewhere</a>
-->
                        </div>
                    </div>

                </div>


            </div>
            <hr>
            <div class="row">
                <div class="col-md-6">

                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6" style="border-right:1px solid #cccccc;">
                                    <h5 class="card-title lead text-center">TOTAL RECIEVABLES</h5>
                                    <br/>
                                    <p class="card-text text-center text-muted">
                                        <span class="pull-right text-danger lead">OVERDUE<br/>
                                             <b><span class="display-5 card-text text-center text-info"><?php echo get_recievables_overdue();?></span></b>
                                        </span>
                                       <b> <span class="display-5 card-text text-center text-info ">
                                            <?php
                                            echo get_recievables()." &#8377;";
                                            ?>
                                           </span> </b>


                                    </p>
                                </div>
                                <div class="col-md-5">
                                    <h5 class="card-title lead text-center">TOTAL PAYABLES</h5>
                                    <br/>
                                    <p class="card-text text-center text-muted">
                                        <span class="pull-right text-danger lead">OVERDUE<br/>
                                            <b><span class="display-5 card-text text-center text-info"><?php echo get_payables_overdue();?></span></b>
                                        </span>
                                       <b> <span class="display-5 card-text text-center text-info" >
                                            <?php
                                            echo get_payables()." &#8377;";
                                            ?>
                                        </span> </b>


                                    </p>

                                </div>

                                <!--
<a href="#" class="btn btn-primary">Go somewhere</a>
-->
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-3">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title lead text-center">USERS</h5>
                            <br/>
                            <p class="display-4 card-text text-center text-info"><?php  print_r(get_users_count());?></p>
                            <!--
<a href="#" class="btn btn-primary">Go somewhere</a>
-->
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <?php include('footer.php');?>