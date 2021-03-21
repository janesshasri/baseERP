<?php include('header.php'); ?>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">
					
						<div class="row">
									<div class="col-xl-12">
											<div class="breadcrumb-holder">
													<h1 class="main-title float-left">List Expenses</h1>
													<ol class="breadcrumb float-right">
														<li class="breadcrumb-item">Home</li>
														<li class="breadcrumb-item active">List Expenses</li>
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
										<a href="recordExpenses.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
										Add Expenses </a></span>
									<h3<i class="fa fa-file-text-o bigfonts" aria-hidden="true"></i> List Expenses Records</h3>
								</div>
								
								<div class="card-body">
									<div class="table-responsive">
									<table id="example1" class="table table-bordered table-hover display">
										<thead>
											<tr>
												<th>Voucher ID</th>	
												<th>Payee</th>												
												<th>Category</th>	
												<th>Description</th>
												<th>Amount</th>
												<th>Payment Mode</th>
												<th>Created On</th>
												<th>Created By</th>
												<th>Status</th>
												<th>ACTIONS </th>
											</tr>
										</thead>										
										<tbody>
										
											<?php
												
													include("database/db_conection.php");//make connection here
													$sql = "SELECT voucherid,payee,category,description,paymentmode,amount,reference,createdon,createdby,status,id FROM recordexpense";
													$result = mysqli_query($dbcon,$sql);
													
													if ($result->num_rows > 0){
													while ($row =$result-> fetch_assoc()){
													echo "<tr>";
													//echo '<td>' .$row['id'] . '</td>';
													echo '<td>'.$row['voucherid'].' </td>';
													echo '<td>'.$row['payee'].' </td>';
													echo '<td>'.$row['category'].' </td>';
													echo '<td>'.$row['description'].' </td>';													
													echo '<td>'.$row['amount'].' </td>';	
													echo '<td>'.$row['paymentmode'].' </td>';
													//echo '<td>'.$row['ref'].' </td>';													
													//echo '<td>'.$row['reference'].' </td>';													
													echo '<td>'.$row['createdon'].' </td>';													 												
													echo '<td>'.$row['createdby'].' </td>';
													?>
													
													
												<?php	
													
													?>
													<td>
													<?php if($row['status']==1){
																	echo 'Active';
																}else if($row['status']==0){
																	echo 'Inactive';
																}
																else{
																	echo "";
																}	
															?>	
													<?php 
														echo '<td><a href="editRecordExpenses.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">
														<i class="fa fa-pencil" aria-hidden="true"></i></a>
													
													<a href="javascript:deleteRecord_8(' . $row['id'] . ');" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete">
													<i class="fa fa-trash-o" aria-hidden="true"></i></a><a class="btn btn-secondary btn-sm" onclick="ToPrint(this);" data-code="'.$row['id'].'" data-img="assets/images/logo.png"  data-id="po_print"><i class="fa fa-print bigfonts" aria-hidden="true"></i></a></td>';
													 echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
										        function ToPrint(el){
												var code= $(el).attr('data-code');
												window.location.href = 'assets/voucherPrint.php?id='+code; 
                                              }

                                            function deleteRecord_8(row_id)
                                            {
                                                console.log(row_id);
                                                // var row_id = $(x).attr('data-id');
                                                if (confirm('Confirm delete')) {
                                                  window.location.href = 'deleteVouchers.php?id='+row_id;
                                               }
                                            }
											 </script>
													
												<!--?php	
												     echo '<td><a href="donationPrint.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">
														<i class="fa fa-pencil" aria-hidden="true"></i></a>
													
													<a href="javascript:deleteRecord_8(' . $row['id'] . ');" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete">
													<i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
													echo '<a class="btn btn-secondary btn-sm" onclick="ToPrint(this);" data-code="'.$row['id'].'" data-img="assets/images/logo.png"  data-id="po_print"><i class="fa fa-print" aria-hidden="true"></i></a></td>';
                                                echo "</tr>";
													
													}
													}
													?-->					
															<!--script>
															
														function ToPrint(el){
														var code= $(el).attr('data-code');
														window.location.href = 'donationPrint.php?id='+id;
                                              }

															function deleteRecord_8(RecordId)
															{
																if (confirm('Confirm delete')) {
																	window.location.href = 'deleteDonationMaster.php?id='+RecordId;
																}
															}
													</script-->
														
									</tbody>
									</table>
									</div>
									
								</div>														
							</div><!-- end card-->			
							</div>

<?php include('footer.php'); ?>