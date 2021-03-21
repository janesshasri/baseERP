<?php include('header.php'); ?>
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
                        <h1 class="main-title float-left">Production list</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">List Production Items</li>
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
                                <a href="addProduction.php?entrytype=self&orgid=THULI1" class="btn btn-primary btn-sm">
                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add Production Entry
                                </a>    </span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b> Production list </b></h3>
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
                                <table id="po_table" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">Id</th>												
                                            <th>Production Id</th>												
                                            <th>Production Date</th>												
                                            <th>Production Name</th>
                                            <th>Production Qty</th>
                                            <th>Production Status</th>												
                                            <th>handler</th>												
                                            <th>Actions</th>
                                        </tr>
                                    </thead>										
                                    <tbody>
                                        <?php

                                        function status_code($status){
                                            if($status=="Approved"){
                                                $status_text = ' <span class="text-muted">'.$status.'</span>';  
                                                return $status_text;  
                                            }
                                            if($status=="Created"){
                                                $status_text = ' <span class="text-primary">'.$status.'</span>';  
                                                return $status_text;  
                                            } 

                                            if($status=="Completed"){
                                                $status_text = ' <span class="text-info">'.$status.'</span>';  
                                                return $status_text;  
                                            } 
                                        }

                                        include("database/db_conection.php");//make connection here
                                        $sql = "select prod.*,c.*,s.* from productionlist prod ,salesitemaster2 s,(select orgid,orgname from comprofile union select custid as orgid, custname as orgname from customerprofile) as c ";
                                        $sql.=" where prod.prod_item=s.itemcode and prod.orgid=c.orgid";
                                        $sql.= $orgidUrl!="" ? " and prod.orgid='".$orgidUrl."' " : ""; 
                                      
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td style="display:none;">' .$row['id'] . '</td>';
                                                echo '<td>' .$row['prod_code'] . '</td>';
                                                echo '<td>' .$row['prod_date'] . '</td>';
                                                echo '<td>' .$row['itemname'] . '</td>';
                                                echo '<td>' .$row['prod_qty'] . '</td>';
                                                echo '<td>'.status_code($row['prod_status']).' </td>';
                                                echo '<td>' .$row['prod_handler'] . '</td>';

                                        ?>


                                        <?php


                                                echo '<td>';

                                                echo '    <div class="dropdown">
  <button type="button" class="btn btn-light btn-xs dropdown-toggle" data-toggle="dropdown">

  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item"  href="#" onclick="ToPrint(this);" data-code="'.$row['prod_code'].'" data-img="assets/images/logo.png"  data-id="po_print"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</a>';

                                                if($row['prod_status']=="Created"){
                                                    echo ' <a class="dropdown-item" href="addProduction.php?prod_code=' . $row['prod_code'] . '&action=edit&type=productionlist&entrytype='.$row['entrytype'].'&orgid='.$row['orgid'].'" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</a>';   
                                                    if($_SESSION['groupname']=="Admin"){
                                                    echo '
                                                        <a class="dropdown-item"  href="deleteProduction.php?id=' . $row['prod_code'] . '" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Delete</a>';
                                                    }
                                                }

                                                if($row['prod_status']=="Approved" && $_SESSION['groupname']=="Admin"){
                                                    echo ' <a class="dropdown-item" href="addProduction.php?prod_code=' . $row['prod_code'] . '&action=edit&type=productionlist&entrytype='.$row['entrytype'].'&orgid='.$row['orgid'].'" class="btn btn-primary btn-sm"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</a>';   

                                                    echo '
                                                        <a class="dropdown-item"  href="deleteProduction.php?id=' . $row['prod_code'] . '" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Delete</a>';


                                                }

                                                echo ' </td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
                                            function deleteRecord_8(RecordId)
                                            {
                                                alert(RecordId);
                                                if (confirm('Confirm delete')) {
                                                    window.location.href = 'deleteProduction.php?id='+RecordId;
                                                }
                                            }
                                        </script>

                                    </tbody>
                                </table>
                            </div>

                        </div>														
                    </div><!-- end card-->	                    
                    <div id="po_print" style="display:none;">
                    </div>
                </div>


                <script>

                function ToPrint(el){
                   var code= $(el).attr('data-code');
                   window.location.href = 'assets/production_print_html.php?prod_code='+code;
                }
                    $(document).ready(function() {
                        // data-tables
                        var table = $('#po_table').DataTable();
                        table
                            .order( [ 1, 'desc' ] )
                            .draw();
                    });	

                    function redirectTo(ele){
                        var orgid = $(ele).val();
                        var orgtype = $(ele).find('option:selected').attr('data-orgtype');
                        location.href='listProductions.php?orgid='+orgid+'&orgtype='+orgtype;
                    }

                </script>
                
                
 
	
                
                <?php include('footer.php'); ?>