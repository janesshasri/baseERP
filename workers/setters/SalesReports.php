<?php include('header.php'); ?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Sales Reports</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Sales Reports</li>
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
                                <a href="#" class="btn btn-light btn-sm dt-button buttons-print" id="table_print"><i class="fa fa-print" aria-hidden="true"></i>
                                </a></span>
                            
                            <div class="dt-buttons"><button class="dt-button buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button> </div>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>  Sales Reports </b></h3>
                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th>Invoice No#</th>												
                                            <th>Invoice Date</th>												
                                            <th>Customer</th>
                                            <th>Invoice Status</th>												
                                            <th>Amount</th>												
                                            <th>User</th>												
                                        </tr>
                                    </thead>										
                                    <tbody>


                                        <?php


                                        function status_code($status){
                                            if($status=="Approved"){
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

                                        $sql = "SELECT p.* FROM invoices p
										ORDER BY p.id DESC ";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td>' .$row['inv_code'] . '</td>';
                                                echo '<td>'.$row['inv_date'].' </td>';
                                                echo '<td>'.$row['inv_customer'].' </td>';
                                                echo '<td>'.status_code($row['inv_status']).' </td>';
                                                echo '<td>'.$row['inv_value'].' </td>';
                                                echo '<td>'.$row['inv_owner'].' </td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>




                                    </tbody>
                                </table>
                            </div>

                        </div>														
                    </div><!-- end card-->	

                </div>

                <script>
                    $(document).ready(function() {
                        $('#example1').DataTable( {
                            dom: 'Bfrtip',
                            buttons: [
                                'print'
                            ]
                        } );
                    } );
                </script>
                <?php include('footer.php'); ?>