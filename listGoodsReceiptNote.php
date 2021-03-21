<?php
include('header.php'); 

?>


<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left"> Goods Received Note list</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">List GRN Notes</li>
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
                                <a href="addGoodsReceiptNote.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add GRN Note</a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>  Goods Received Note list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="grn_table" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">ID#</th>												
                                            <th>GRN#</th>												
                                            <th>PO#</th>												
                                            <th>Invoice#</th>												
                                            <th>Vendor</th>
                                            <th>GRN Status</th>
                                            <th>Amount</th>	
                                            <th>Balance Due</th>												
                                            <th>Due Date</th>												
                                            <th>Payment Status</th>												
                                            <th>Created By</th>												
                                            <th>Actions</th>
                                        </tr>
                                    </thead>										
                                    <tbody>
                                        <?php
                                        function status_code($status){
                                            if($status=="Approved"){
                                                $status_text = ' <span class="text-success">'.$status.'</span>';  
                                                return $status_text;  
                                            }
                                            if($status=="Recorded"){
                                                $status_text = ' <span class="text-primary">'.$status.'</span>';  
                                                return $status_text;  
                                            } 

                                        }

                                        function payment_status($payment_status,$newdate,$po_payterm,$grn_date){
                                            $curdate=strtotime($newdate);
                                            $mydate=strtotime('+'.$po_payterm.' day', strtotime($grn_date));

                                            if($curdate > $mydate)
                                            {
                                                return '<span class="text-danger">Overdue</span>';
                                            }else{
                                                if($payment_status=="Paid"){
                                                    return '<span class="text-success">'.$payment_status.'</span>';

                                                }elseif($payment_status=="Unpaid"){
                                                    return '<span class="text-warning">'.$payment_status.'</span>';

                                                }else{
                                                    return '<span class="text-info">'.$payment_status.'</span>';

                                                }
                                            }
                                        }


                                        include("database/db_conection.php");//make connection here

                                        if(isset($_GET['v_credits_vendorid'])&&isset($_GET['v_credits_id'])){
                                             $sql = "SELECT g.*,v.* from grn_notes g ,vendorprofile v where g.grn_po_vendor = '".$_GET['v_credits_vendorid']."' and v.vendorid = '".$_GET['v_credits_vendorid']."'
										ORDER BY g.id DESC";     
                                        }else{
                                            $sql = "SELECT g.*,v.supname from grn_notes g,vendorprofile v where g.grn_po_vendor=v.vendorid ORDER BY g.id DESC;";    
                                        }


                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){


                                                echo "<tr>";
                                                echo '<td style="display:none;">' .$row['id'] . '</td>';
                                                echo '<td>' .$row['grn_id'] . '</td>';
                                                if($row['grn_po_code']){
                                                    echo '<td>' .$row['grn_po_code']. '</td>';                         
                                                }else{
                                                    echo '<td></td>';
                                                }

                                                echo '<td>' .$row['grn_invoice_no'] . '</td>';
                                                echo '<td>' .$row['supname'] . '</td>';
                                                echo '<td>' .status_code($row['grn_status']) . '</td>';
                                                echo '<td>' .$row['grn_po_value'] . '</td>';
                                                echo '<td>' .$row['grn_balance']. '</td>';
                                                echo '<td>' .date('Y-m-d', strtotime('+'.$row['grn_po_payterm'].' day', strtotime($row['grn_date']))). '</td>';
                                                echo '<td><b>' .payment_status($row['grn_payment_status'],date('Y-m-d'),$row['grn_po_payterm'],$row['grn_date']) . '</b></td>';
                                                echo '<td>' .$row['grn_owner'] . '</td>';
                                                $grn_id = $row['grn_id'];
                                        ?>


                                        <?php
                                                echo ' <td>
                                                <div class="dropdown">
  <button type="button" class="btn btn-light btn-xs dropdown-toggle" data-toggle="dropdown">

  </button>
  <div class="dropdown-menu">';
                                                echo ' <a class="dropdown-item" href="#" onclick="ToPrint(this);" data-img="assets/images/logo.png" data-id="po_print" data-code="'.$row['grn_id'].'"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</a>';

                                                if($row['grn_payment_status']=='Unpaid'){

                                                    echo ' <a class="dropdown-item" href="addGoodsReceiptNote.php?grn_id=' . $row['grn_id'] . '&action=edit&type=grn_notes&vendor='.$row['grn_po_vendor'].'"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</a>';

                                                    echo ' <a class="dropdown-item" href="#" onclick="deleteRecord_8(this);" data-id="'.$grn_id.'"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Delete</a>';
                                                }

                                                if($row['grn_status']=='Recorded'){

                                                    echo ' <a class="dropdown-item" href="workers/setters/grn_convert.php?grn_id=' . $row['grn_id'] . '&grn_status=Approved"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Convert to Approved</a>
';
                                                } if($row['grn_status']=="Approved"&&$row['grn_balance']!=0){

                                                    if(isset($_GET['v_credits_vendorid'])&&isset($_GET['v_credits_id'])){
                                                        echo '<a class="dropdown-item" href="addVendorPayments.php?invoice_no='.$row['grn_invoice_no'].'&vendorid='.$row['grn_po_vendor'].'&action=add&v_credits_id='.$_GET['v_credits_id'].'"><i class="fa fa-rupee" aria-hidden="true"></i>&nbsp; Pay Bill</a>';

                                                    }else{
                                                        echo '<a class="dropdown-item" href="addVendorPayments.php?invoice_no='.$row['grn_invoice_no'].'&vendorid='.$row['grn_po_vendor'].'&action=add"><i class="fa fa-rupee" aria-hidden="true"></i>&nbsp; Pay Bill</a>';

                                                    }


                                                    echo '<a class="dropdown-item" href="addDebitNotes.php?grn_id='.$row['grn_id'].'&action=add&type=debitnotes"><i class="fa fa-file" aria-hidden="true"></i>&nbsp;  Debit Note</a>';



                                                }
                                                echo        '</div></div></td>';
                                                echo ' </td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
                                             var table = $('#grn_table').DataTable();
                                             table.order( [ 1, 'desc' ] ).draw();

                                            function deleteRecord_8(x)
                                            {
                                                console.log(x);
                                                var RecordId = $(x).attr('data-id');
                                                console.log(RecordId);
                                                console.log($(x).attr('data-id'));
                                                if (confirm('Confirm delete')) {
                                                    window.location.href = 'deleteGoodsReceiptNote.php?id='+RecordId;
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
                        window.location.href = 'assets/grn_print_html.php?grn_id='+code;

                     }
                </script>
                <?php include('footer.php'); ?>