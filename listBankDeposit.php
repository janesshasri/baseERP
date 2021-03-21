
	<?php include('header.php');?>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
						<div class="row">
								<div class="col-xl-12">
									<div class="breadcrumb-holder">
										<h1 class="main-title float-left">List Bank Credits</h1>
										<ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">List Bank Deposits</li>
										</ol>
										<div class="clearfix"></div>
									</div>
								</div>
						</div>
						<!-- end row -->

										
						<!--div class="alert alert-danger" role="alert">
						<h4 class="alert-heading">Important!</h4>
						<p>This section is available in Pike Admin PRO version.</p>
						<p><b>Save over 50 hours of development with our Pro Framework: Registration / Login / Users Management, CMS, Front-End Template (who will load contend added in admin area and saved in MySQL database), Contact Messages Management, manage Website Settings and many more, at an incredible price!</b></p>
						<p>Read more about all PRO features here: <a target="_blank" href="https://www.pikeadmin.com/pike-admin-pro"><b>Pike Admin PRO features</b></a></p>
						</div-->

										
										
						<div class="row">
										
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
											
									<div class="card mb-3">
									
										<div class="card-header">
																											
											<span class="pull-right">
										<a href="addBankDeposit.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
										Add Bank Deposit</a></span>
										
										
								
									<h3<i class="fa fa-bank smallfonts" aria-hidden="true"></i><b> List Bank Credits/Deposits</b></div></h3>
								
										
										<!-- end card-header -->	
										
									
													
										<div class="card-body">
										
												
												
															
												<div class="table-responsive">	
												<table class="table table-bordered">
												<thead>
												  <tr>
												  <th >TransID</th>
													<th >Date</th>
													<th>Org ID</th>
													<th>Bank</th>
													<th>A/C No</th>
													<th>Payment Method</th>
													<th>Reference#</th>
													<th>User</th>
													<th>Amount</th>
													<th>Actions</th>
													</tr>
												</thead>
												<tbody>
												<?php
												
													include("database/db_conection.php");//make connection here
													$sql = "SELECT * FROM bankdeposit ";
													$result = mysqli_query($dbcon,$sql);
													
													if ($result->num_rows > 0){
													while ($row =$result-> fetch_assoc()){
														$row_id=$row['id'];
													echo "<tr>";
													echo '<td>' . $row['transid'] . '</td>';
													echo '<td>'.$row['depositdate'].'<br /></td>';
													echo '<td>'.$row['compcode'].'</td>';													
													echo '<td>'.$row['bankname'].'</td>';
													echo '<td>'.$row['acctno'].'</td>';													
													echo '<td>'.$row['paymethod'].'</td>';
													echo '<td>'.$row['referenceno'].'</td>';													
													echo '<td>'.$row['createdby'].'</td>';
													echo '<td>'.$row['amount'].'</td>';
																									
													echo '<td><a href="editBankDeposit.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">
														<i class="fa fa-pencil" aria-hidden="true"></i></a>
													
													<a onclick="delete_record(this);" id="deletebankDeposit" data-id="' . $row_id . '" class="btn btn-danger btn-sm"  data-title="Delete">
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
                                                  window.location.href = 'deleteBankDeposit.php?id='+row_id;
                                               }
                                            }

                                    
                                        </script>
													</tbody>

									</table>
									
									</div>
									
								</div>		
							
							</div><!-- end card-->			
							</div>
	<?php include('footer.php');?>