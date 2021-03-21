<?php include('header.php');?>


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
						<div class="row">
								<div class="col-xl-12">
									<div class="breadcrumb-holder">
										<h1 class="main-title float-left">User Groups List</h1>
										<ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">User Groups List</li>
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
										<a href="addUserGroup.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
										add User Groups</a></span>
										<!--h3><i class="fa fa-user"></i> All users </h3-->
										<h3> <div class="fa-hover col-md-3 col-sm-4"><i class="fa fa-users bigfonts" aria-hidden="true"></i> List User Groups</div></h3>
										
										
										<!-- end card-header -->	
										
									
													
										<div class="card-body">
										
												
												
															
												<div class="table-responsive">	
												<table class="table table-bordered">
												<thead>
												  <tr>
													<th style="width:20px">ID</th>
													<th style="width:20px">Group</th>
													<th style="width:30px"> Description</th>
													<th style="width:10px">Actions</th>
													</tr>
												</thead>
												<tbody>
												<?php
												
													include("database/db_conection.php");//make connection here
													$sql = "SELECT groupname,description,id FROM groups";
													$result = mysqli_query($dbcon,$sql);
													if ($result->num_rows > 0){
													while ($row =$result-> fetch_assoc()){
												    $row_id=$row['id'];
													echo "<tr>";
													echo '<td>' . $row['id'] . '</td>';
													//echo '<td><img width="50px"  class="avatar-rounded" style="max-width:40px; height:auto;" src="'.$row['image_name'].'"/>';
													echo '<td>' . $row['groupname'] . '</td>';
													echo '<td>' . $row['description'] . '</td>';
																									
													echo '<td><a href="editUserGroup.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">
														<i class="fa fa-pencil" aria-hidden="true"></i></a>
													
													<a onclick="delete_record(this);" id="deleteUserGroups" data-id="' . $row_id . '" class="btn btn-danger btn-sm"  data-title="Delete">
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
                                                  window.location.href = 'deleteUserGroups.php?id='+row_id;
                                               }
                                            }

                                    
                                        </script>
													</tbody>
													</table>
									
												</div>
																				
															
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
<!-- BEGIN Java Script for this page -->
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

	<script>
	// START CODE FOR BASIC DATA TABLE 
	$(document).ready(function() {
		$('#example1').DataTable();
	} );
	// END CODE FOR BASIC DATA TABLE 
	
	
	// START CODE FOR Child rows (show extra / detailed information) DATA TABLE 
	function format ( d ) {
		// `d` is the original data object for the row
		return '<table cellpadding="5" cellspacing="0" border="0" style="padding-left:50px;">'+
			'<tr>'+
				'<td>Full name:</td>'+
				'<td>'+d.name+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extension number:</td>'+
				'<td>'+d.extn+'</td>'+
			'</tr>'+
			'<tr>'+
				'<td>Extra info:</td>'+
				'<td>And any further details here (images etc)...</td>'+
			'</tr>'+
		'</table>';
	}
 
		$(document).ready(function() {
			var table = $('#example2').DataTable( {
				"ajax": "assets/data/dataTablesObjects.txt",
				"columns": [
					{
						"className":      'details-control',
						"orderable":      false,
						"data":           null,
						"defaultContent": ''
					},
					{ "data": "name" },
					{ "data": "position" },
					{ "data": "office" },
					{ "data": "salary" }
				],
				"order": [[1, 'asc']]
			} );
			 
			// Add event listener for opening and closing details
			$('#example2 tbody').on('click', 'td.details-control', function () {
				var tr = $(this).closest('tr');
				var row = table.row( tr );
		 
				if ( row.child.isShown() ) {
					// This row is already open - close it
					row.child.hide();
					tr.removeClass('shown');
				}
				else {
					// Open this row
					row.child( format(row.data()) ).show();
					tr.addClass('shown');
				}
			} );
		} );
		// END CODE FOR Child rows (show extra / detailed information) DATA TABLE 		
		
				
		
		// START CODE Show / hide columns dynamically DATA TABLE 		
		$(document).ready(function() {
			var table = $('#example3').DataTable( {
				"scrollY": "350px",
				"paging": false
			} );
		 
			$('a.toggle-vis').on( 'click', function (e) {
				e.preventDefault();
		 
				// Get the column API object
				var column = table.column( $(this).attr('data-column') );
		 
				// Toggle the visibility
				column.visible( ! column.visible() );
			} );
		} );
		// END CODE Show / hide columns dynamically DATA TABLE 	
		
		
		// START CODE Individual column searching (text inputs) DATA TABLE 		
		$(document).ready(function() {
			// Setup - add a text input to each footer cell
			$('#example4 thead th').each( function () {
				var title = $(this).text();
				$(this).html( '<input type="text" placeholder="Search '+title+'" />' );
			} );
		 
			// DataTable
			var table = $('#example4').DataTable();
		 
			// Apply the search
			table.columns().every( function () {
				var that = this;
		 
				$( 'input', this.footer() ).on( 'keyup change', function () {
					if ( that.search() !== this.value ) {
						that
							.search( this.value )
							.draw();
					}
				} );
			} );
		} );
		// END CODE Individual column searching (text inputs) DATA TABLE 	 	
	</script>	
<!-- END Java Script for this page -->
<script>
  $(function () {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<!-- END Java Script for this page -->

</body>
</html>
<!-- END Java Script for this page -->

</body>
</html>