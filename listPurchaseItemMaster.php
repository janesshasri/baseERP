<?php include('header.php'); ?>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">
					
						<div class="row">
									<div class="col-xl-12">
											<div class="breadcrumb-holder">
													<h1 class="main-title float-left">List Purchased Items</h1>
													<ol class="breadcrumb float-right">
														<li class="breadcrumb-item">Home</li>
														<li class="breadcrumb-item active">List Purchased Items</li>
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
										<a href="addPurchaseItemMaster.php?entrytype=self" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
										Add Purchase Item</a></span>
								
									<h3<i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b> List Purchased Items </b></h3>
								</div>
								
								<div class="card-body">
									<div class="table-responsive">
									<table id="example1" class="table table-bordered table-hover display">
										<thead>
											<tr>
												<th>Item Code</th>												
												<th>Item Name</th>
												<th>Item Cost</th>
												<th>Taxrate</th>	
												<th>Price</th>
												<th>Stock on Hand</th>
												<th>Stock Value</th>
												<th>UOM</th>												
												<th>Created By</th>																								
												<th>Actions</th>
											</tr>
										</thead>										
										<tbody>
											<?php
													include("database/db_conection.php");//make connection here
													$sql = "SELECT itemcode, itemname,itemcost,taxrate,taxableprice,stockinqty,uom,handler,id
															FROM purchaseitemaster
															WHERE status = '1'
															ORDER BY id DESC ";
													$result = mysqli_query($dbcon,$sql);
													if ($result->num_rows > 0){
													while ($row =$result-> fetch_assoc()){
													echo "<tr>";
													echo '<td>' .$row['itemcode'] . '</td>';
													echo '<td>'.$row['itemname'].' </td>';
													echo '<td>'.$row['itemcost'].' </td>';
													echo '<td>'.$row['taxrate'].' </td>';
													echo '<td>'.$row['taxableprice'].' </td>';
													echo '<td>'.$row['stockinqty'].' </td>';
													echo '<td>'.$row['stockinqty']*$row['taxableprice'].' </td>';

													echo '<td>'.$row['uom'].' </td>';													
													echo '<td>'.$row['handler'].' </td>';
													
													echo '<td><a href="editPurchaseItemMaster.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">
														<i class="fa fa-pencil" aria-hidden="true"></i></a>
													
													<a href="javascript:deleteRecord_8(' . $row['id'] . ');" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete">
													<i class="fa fa-trash-o" aria-hidden="true"></i></a></td>';
													echo "</tr>";
													}
													}
													?>						
															<script>
															function deleteRecord_8(RecordId)
															{
																if (confirm('Confirm delete')) {
																	window.location.href = 'deletePurchaseItemMaster.php?id='+RecordId;
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