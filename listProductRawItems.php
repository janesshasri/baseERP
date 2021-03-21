<?php include('header.php');?>
	<!-- End Sidebar -->
<?php
	$orgidUrl = "";
	$orgType = "";
	if(isset($_GET['orgid'])){ $orgidUrl = $_GET['orgid']; } 
	if(isset($_GET['orgtype'])){ $orgType = $_GET['orgtype']; } 

?>

    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
										<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Organization Wise Rawmaterial Input Data List</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Rawmaterial List</li>
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
										<a href="addRawMatItemaster.php?entrytype=self&orgid=THULI1" class="btn btn-primary btn-sm">
										<i class="fa fa-user-plus" aria-hidden="true"></i>
										Add Rawmaterial Master</a></span>
                                    <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"> List Rawmaterial Itemnames </i></h3>
                        </div>

						<div class="form-row px-3 py-2">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Filter By Company<i class="text-danger">*</i></label>
                                        <select id="compcode" 
										onchange="redirectTo(this)" class="form-control form-control-sm select2"  
										required name="orgid" required autocomplete="off">
                                            <option value="">Select Company</option>
                                            <?php 
											include("database/db_conection.php");//make connection here
											 $sql = "SELECT id as oid, orgid as orgid,concat(orgid,'-',orgname) as orgname,'self' as orgtype FROM comprofile
                                            UNION SELECT id as oid, custid as orgid,concat(custid,'-',custname) as orgname,'outsourced' as orgtype FROM customerprofile 
											WHERE custype='Partner'
										    ORDER BY oid ASC;
											";
                                            $exe = mysqli_query($dbcon,$sql); 
                                            while ($row = $exe->fetch_assoc()){	
                                                 $orgid=$row['orgid'];
												 $orgname=$row['orgname'];
												 $orgtype=$row['orgtype'];
												if($orgidUrl!='' && $orgidUrl===$orgid){
													echo '<option data-orgtype="'.$orgtype.'" selected  value="'.$orgid.'" >'.$orgname.' </option>';
												}else{
													echo '<option data-orgtype="'.$orgtype.'" value="'.$orgid.'" >'.$orgname.' </option>';

												}

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th>id</th>
											<th>Company Name</th>											
                                            <th>Production Item</th>
											<th>Product Name</th>											
											<th>Created By</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>										
                                    <tbody>

                                        <?php												
                                        include("database/db_conection.php");//make connection here
							
											$sql = "select rw.handler as rawhandler,rw.*,c.*,s.* from rawitemaster rw ,salesitemaster2 s,(select orgid,orgname from comprofile union select custid as orgid, custname as orgname from customerprofile) as c ";
											$sql.=" where rw.proditemcode=s.itemcode and rw.orgid=c.orgid";
									        $sql.= $orgidUrl!="" ? " and rw.orgid='".$orgidUrl."' " : ""; 


                                        		$result = mysqli_query($dbcon,$sql);
												if ($result->num_rows > 0){
												while ($row =$result-> fetch_assoc()){
													$row_id=$row['rw_code'];
												echo "<tr>";
												echo '<td>' .$row['id']. '</td>';											
												echo '<td>' .$row['orgid'].'-'.$row['orgname'].'</td>';
												echo '<td>' .$row['proditemcode'].'-'.$row['itemname'].'</td>';
												echo '<td>' .$row['itemname'].'</td>';
												echo '<td>' .$row['rawhandler'].'</td>';
											

                                                echo '<td><a href="addRawMatItemaster.php?rw_code=' . $row['rw_code'] . '&action=edit&type=rawitemaster&entrytype='.$row['entrytype'].'&orgid='.$row['orgid'].'" class="btn btn-primary btn-sm">
														<i class="fa fa-pencil" aria-hidden="true"></i></a>

													<a onclick="delete_record(this);" id="deleteItemCategory" data-id="' . $row_id . '" class="btn btn-danger btn-sm mr-1"  data-title="Delete">
													<i class="fa fa-trash-o" aria-hidden="true"></i></a><a data-id="' . $row_id . '" class="btn btn-info btn-sm mr-1" onclick="setRawItems(this);"  data-toggle="modal" data-target="#itemsModal"  data-title="View">
													<i class="fa fa-eye" aria-hidden="true"></i></a>';
													echo '<a class="btn btn-secondary btn-sm" onclick="ToPrint(this);" data-code="'.$row['rw_code'].'" data-img="assets/images/logo.png"  data-id="po_print"><i class="fa fa-print" aria-hidden="true"></i></a></td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
										        function ToPrint(el){
												var code= $(el).attr('data-code');
												window.location.href = 'assets/productRawitemsList.php?rw_code='+code;
                                              }

                                            function delete_record(x)
                                            {
                                                console.log(x);
                                                 var row_id = $(x).attr('data-id');
                                                if (confirm('Confirm delete')) {
                                                  window.location.href = 'deleteProductRawItems.php?id='+row_id;
                                               }
                                            }
											 </script>   
											 </tbody>
                                </table>
                            </div>

                        </div>														
                    </div><!-- end card-->			
                </div>

				<!-- Modal -->
				<div class="modal fade" id="itemsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title">Raw Items List</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
							</div>
							<div class="modal-body" id="modalCon">
								
							</div>
					
						</div>
					</div>
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

<!-- App js -->
<script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>

	<script>
	// START CODE FOR BASIC DATA TABLE 
	$(document).ready(function() {
		$('#example1').DataTable();
	} );
	// END CODE FOR BASIC DATA TABLE 
	
	function setRawItems(ele){

	   var rw_code = $(ele).attr('data-id');
	   var edit_data = Page.get_edit_vals(rw_code,"rawitemaster","rw_code");
	   var items = JSON.parse(edit_data.raw_items);
	   $('#modalCon').html('');
	   var html = '<table class="table"><thead><tr><th>Item</th><th>Qty</th><th>Unit</th></tr></thead><tbody>';
	   for(i=0;i<items.length;i++){
		  html += '<tr><td>('+items[i].item+')'+items[i].itemname+'</td><td>'+items[i].qty+'</td><td>'+items[i].uom+'</td></tr>';
	   }
	   html += '</tbody></table>';
	   $('#modalCon').html(html);

	}
	
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

		function redirectTo(ele){
		 var orgid = $(ele).val();
		 var orgtype = $(ele).find('option:selected').attr('data-orgtype');
		 location.href='listProductRawItems.php?orgid='+orgid+'&orgtype='+orgtype;
	    }


		// END CODE Individual column searching (text inputs) DATA TABLE 	 	
	</script>	
<!-- END Java Script for this page -->
<?php include('footer.php');?>
