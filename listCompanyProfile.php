<?php include('header.php');?>


    <div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">
					
						<div class="row">
									<div class="col-xl-12">
											<div class="breadcrumb-holder">
													<h1 class="main-title float-left">List Company Profile</h1>
													<ol class="breadcrumb float-right">
														<li class="breadcrumb-item">Home</li>
														<li class="breadcrumb-item active">Company Profile List</li>
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
										<a href="addCompanyProfile.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
										Add Company Profile</a></span>
										
									<h3<i class="fa fa-bank smallfonts" aria-hidden="true"></i><b> List Profile </b></h3>
								</div>
								
								<div class="card-body">
									<div class="table-responsive">
									<table id="example1" class="table table-bordered table-hover display">
										<thead>
											<tr>
												  	<th style="width:20px">Logo</th>
													<th style="width:60px">Org ID</th>
													<th style="width:230px">Name</th>
													<th style="width:40px">Type</th>
													<th style="width:20px">Email</th>
													<th style="width:20px">Mobile</th>
													<th style="width:40px">Actions</th>
													</tr>
										</thead>										
										<tbody>
											<?php
													include("database/db_conection.php");//make connection here
													
													//$sql = "select image,compcode,concat(title,name) as name,
													//ctype,location,email,mobile,id from comprofile";
													$sql = "SELECT image,orgid, concat(title,' ',orgname) as orgname,blocation,orgtype,email,mobile,id from comprofile
															order by id asc";
													$result = mysqli_query($dbcon,$sql);
													if ($result->num_rows > 0){
													while ($row =$result-> fetch_assoc()){
														$row_id=$row['id'];
													echo "<tr>";
													echo '<td><img style="max-width:50px; height:35px;" src="'.$row['image'].'"/>';
													echo '<td>'.$row['orgid'] .'</td>';
													echo '<td>'.$row['orgname'].'<br /></td>';
													//echo '<td>'.$row['blocation'].'</td>';
													//echo '<td>'.$row['orgtype'].'</td>';
													?>
													<td><?php if($row['orgtype']==1){
																	echo 'Registred/Corporate';
																}else if($row['orgtype']==2){
																	echo 'Branch Office';
																}else if($row['orgtype']==3){
																	echo 'Partnership';
																}
																else{
																	echo "";
																}	 ?>
													</td>
													
													<?php
													
													echo '<td>'.$row['email'].'</td>';
													echo '<td>'.$row['mobile'].'</td>';
													
													echo '<td><a href="editCompanyProfile.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">
														<i class="fa fa-pencil" aria-hidden="true"></i></a>
													
													<a onclick="delete_record(this);" id="compProfDelete" data-id="' . $row_id . '" class="btn btn-danger btn-sm"  data-title="Delete">
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
                                                  window.location.href = 'compProfDelete.php?id='+row_id;
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