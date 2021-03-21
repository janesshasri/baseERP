<?php include('header.php'); ?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Sales Estimate list</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">List Sales Estimates</li>
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
                                <a href="addEstimate.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add Sales Estimate</a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>  Sales Estimate list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">ID#</th>												
                                            <th>Est code#</th>												
                                            <th>Est Date</th>												
                                            <th>Est ExpiryDate</th>												
                                            <th>Customer</th>												
                                            <th>Est Amount</th>												
                                            <th>Est Status</th>												
                                            <th>Actions</th>												
                                        </tr>
                                    </thead>										
                                    <tbody>


                                        <?php

                                        function status_code($status){
                                            if($status=="Accepted"){
                                                $status_text = ' <span class="text-dark">'.$status.'</span>';  
                                                return $status_text;  
                                            }
                                            if($status=="Created"){
                                                $status_text = ' <span class="text-primary">'.$status.'</span>';  
                                                return $status_text;  
                                            } 

                                            if($status=="Delivered"){
                                                $status_text = ' <span class="text-success">'.$status.'</span>';  
                                                return $status_text;  
                                            } 

                                            if($status=="Sent"){
                                                $status_text = ' <span class="text-warning">'.$status.'</span>';  
                                                return $status_text;  
                                            } 

                                            if($status=="Invoiced"){
                                                $status_text = ' <span class="text-info">'.$status.'</span>';  
                                                return $status_text;  
                                            } 
                                            if($status=="Cancelled"){
                                                $status_text = ' <span class="text-secondary">'.$status.'</span>';  
                                                return $status_text;  
                                            } 
                                            if($status=="Closed"){
                                                $status_text = ' <span class="text-muted">'.$status.'</span>';  
                                                return $status_text;  
                                            } 
                                        }

                                        $sql = "SELECT i.*,c.* FROM estimates i,customerprofile c where c.custid=i.est_customer
										ORDER BY i.id DESC ";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td style="display:none;">' .$row['id'] . '</td>';
                                                echo '<td>' .$row['est_code'] . '</td>';
                                                echo '<td>'.$row['est_date'].' </td>';
                                                echo '<td>'.$row['est_expdate'].' </td>';
                                                echo '<td>'.$row['custname'].' </td>';
                                                echo '<td>'.$row['est_value'].' </td>';
                                                echo '<td>'.status_code($row['est_status']).' </td>';


                                        ?>




                                        <?php


                                                echo '<td>';

                                                echo '    <div class="dropdown">
  <button type="button" class="btn btn-light btn-xs dropdown-toggle" data-toggle="dropdown">

  </button>
  <div class="dropdown-menu">';
                                                echo '     <a class="dropdown-item"  href="#" onclick="ToPrint(this);" data-code="'.$row['est_code'].'" data-img="assets/images/logo.png"  data-id="po_print" data-template="est_print_html"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</a>';

                                                if($row['est_status']=="Created"){
                                                    echo ' <a class="dropdown-item" href="addEstimate.php?est_code=' . $row['est_code'] . '&action=edit&type=estimates" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</a>';   
                                                    echo '
                                                       <a class="dropdown-item" href="#" onclick="deleteRecord_8(this);" data-id="'.$row['est_code'].'"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Delete</a>';

                                                    echo '
                                                       <a class="dropdown-item" href="workers/setters/estconvert.php?est_code='.$row['est_code'].'&est_status=Sent"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Convert to Sent</a>';

                                                }

                                                if($row['est_status']=="Sent"){
                                                    echo '
                                                       <a class="dropdown-item" href="workers/setters/estconvert.php?est_code='.$row['est_code'].'&est_status=Accepted"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Convert to Accepted</a>';
                                                }

                                                if($row['est_status']=="Accepted"){
                                                    echo '
                                                       <a class="dropdown-item" href="addSalesOrder.php?est_code='.$row['est_code'].'&action=add&type=salesorders"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Convert to Sales Order</a>';
                                                    echo '
                                                       <a class="dropdown-item" href="addInvoice.php?est_code='.$row['est_code'].'&action=add&type=invoices"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Convert to Invoice</a>';
                                                }

                                                /*    if($row['est_status']=="Accepted"){

                                                }
*/

                                                echo '    </div></div>';

                                                echo ' </td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
                                            function deleteRecord_8(x)
                                            {
                                                var RecordId = $(x).attr('data-id');
                                                if (confirm('Confirm delete')) {
                                                    window.location.href = 'deleteEstimates.php?id='+RecordId;
                                                }
                                            }
                                        </script>

                                    </tbody>
                                </table>
                            </div>

                        </div>														
                    </div><!-- end card-->	
        
                </div>


                <script>
                    function ToPrint(el){
                        var code= $(el).attr('data-code');
                        var template= $(el).attr('data-template');
                        window.location.href = 'assets/'+template+'.php?est_code='+code;
                     }
                </script>
                <?php include('footer.php'); ?>