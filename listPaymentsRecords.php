<?php include('header.php'); ?>
        <!-- End Sidebar -->


        <div class="content-page">

            <!-- Start content -->
            <div class="content">

                <div class="container-fluid">

                    <div class="row">
                        <div class="col-xl-12">
                            <div class="breadcrumb-holder">
                                <h1 class="main-title float-left">Payment Transactions</h1>
                                <ol class="breadcrumb float-right">
                                    <li class="breadcrumb-item">Home</li>
                                    <li class="breadcrumb-item active">Payment Transactions</li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <!-- end row -->
                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
                            <div class="card mb-3">
                                <div class="card-header">

											
											<span class="pull-right">
										<a href="recordPayments.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
									add Payments</a></span>

                                    <h3"><i class="fa fa-inr bigfonts" aria-hidden="true">
								 </i><b> List Payment Records</b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display">
                                    <thead>
                                         <tr>
													<th >Trans ID</th>
													<th >Date</th>
													<th > Party Name</th>
													<th > Place</th>
													<th > Amount</th>
													<th > Received at</th>
													<th > Reference</th>
													<th > Created By</th>
													<th >Actions</th>
													</tr>
												</thead>
												<tbody>
												<?php
												
													include("database/db_conection.php");//make connection here
													$sql = "SELECT   		transid,date,partyname,place,amount,receivedat,reference,createdby,id 
													FROM recordpayments";
													$result = mysqli_query($dbcon,$sql);
													if ($result->num_rows > 0){
													while ($row =$result-> fetch_assoc()){
												    $row_id=$row['id'];
													echo "<tr>";
													//echo '<td>' . $row['id'] . '</td>';
													//echo '<td><img width="50px"  class="avatar-rounded" style="max-width:40px; height:auto;" src="'.$row['image_name'].'"/>';
													echo '<td>' . $row['transid'] . '</td>';
													echo '<td>' . $row['date'] . '</td>';
													echo '<td>' . $row['partyname'] . '</td>';
													echo '<td>' . $row['place'] . '</td>';
													echo '<td>' . $row['amount'] . '</td>';
													echo '<td>' . $row['receivedat'] . '</td>';
													echo '<td>' . $row['reference'] . '</td>';
													//echo '<td>' . $row['amount'] . '</td>';
													//echo '<td>' . $row['paymentype'] . '</td>';
													?>
													<!--td><?php if($row['paymentype']==1){
																	echo 'Cash';
																}else if($row['paymentype']==2){
																	echo 'Cheque';
																}
																else if($row['paymentype']==3){
																	echo 'NEFT';
																}
																else{
																	echo "";
																}	 ?>
													</td-->
													
													<?php
													echo '<td>' . $row['createdby'] . '</td>';
																									
													echo '<td><a href="editRecordPayments.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">
														<i class="fa fa-pencil" aria-hidden="true"></i></a>
													
													<a onclick="delete_record(this);" id="deleteRecordPayments" data-id="' . $row_id . '" class="btn btn-danger btn-sm"  data-title="Delete">
													<i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
                                            function delete_record(x)
                                            {
                                                console.log(x);
                                                 var row_id = $(x).attr('data-id');
                                               alert(row_id);
                                                if (confirm('Confirm delete')) {
                                                  window.location.href = 'deleteRecordPayments.php?id='+row_id;
                                               }
                                            }

                                        </script>
                                    </tbody>
                                </table>
                            </div>

                        </div>														
                    </div><!-- end card-->			
                </div>

               <?php include('footer.php'); ?>