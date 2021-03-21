<?php include('header.php'); ?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Purchase Orders list</h1>
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
                                <a href="addPurchaseOrder.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add Purchase Order</a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b> Purchase Orders list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="po_table" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">Id</th>												
                                            <th>PO Number</th>												
                                            <th>PO Date</th>												
                                            <th>Vendor</th>
                                            <th>PO Status</th>												
                                            <th>Amount</th>												
                                            <th>User</th>												
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

                                            if($status=="Delivered"){
                                                $status_text = ' <span class="text-success">'.$status.'</span>';  
                                                return $status_text;  
                                            } 

                                            if($status=="Billed"){
                                                $status_text = ' <span class="text-warning">'.$status.'</span>';  
                                                return $status_text;  
                                            } 

                                            if($status=="Closed"){
                                                $status_text = ' <span class="text-info">'.$status.'</span>';  
                                                return $status_text;  
                                            } 
                                        }

                                        include("database/db_conection.php");//make connection here
                                        $sql = "SELECT p.*,v.supname,c.image,(SELECT COUNT(*) FROM grn_notes where grn_po_code=p.po_code) as grncount
										FROM purchaseorders p,vendorprofile v,comprofile c
										WHERE p.po_vendor=v.vendorid and p.po_comp_code = c.orgid
										ORDER BY p.id DESC ";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td style="display:none;">' .$row['id'] . '</td>';
                                                echo '<td>' .$row['po_code'] . '</td>';
                                                echo '<td>'.$row['po_date'].' </td>';
                                                echo '<td>'.$row['supname'].' </td>';
                                                echo '<td>'.status_code($row['po_status']).' </td>';
                                                echo '<td>'.$row['po_value'].' </td>';
                                                echo '<td>'.$row['po_owner'].' </td>';
                                        ?>


                                        <?php


                                                echo '<td>';

                                                echo '    <div class="dropdown">
  <button type="button" class="btn btn-light btn-xs dropdown-toggle" data-toggle="dropdown">

  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item"  href="#" onclick="ToPrint(this);" data-code="'.$row['po_code'].'" data-img="assets/images/logo.png"  data-id="po_print"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</a>';

                                                if($row['po_status']=="Created"){
                                                    echo ' <a class="dropdown-item" href="addPurchaseOrder.php?po_code=' . $row['po_code'] . '&action=edit&type=purchaseorders" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</a>';   
                                                    echo '
                                                        <a class="dropdown-item"  href="javascript:deleteRecord_8(' . $row['id'] . ');" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Delete</a>';
                                                    echo '
                                                        <a class="dropdown-item"  href="workers/setters/po_convert.php?po_code=' . $row['po_code'] . '&po_status=Approved" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Convert to Delivered"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Convert to Approved</a>';

                                                }

                                                if($row['po_status']=="Approved"){

                                                    echo '
                                                        <a class="dropdown-item"  href="workers/setters/convert_to.php?id=' . $row['po_code'] . '" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Convert to Delivered"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Convert to Delivered</a>';

                                                }

                                                if($row['po_status']=="Delivered" && $row['grncount']==0){
                                                    echo '  <a class="dropdown-item" href="addGoodsReceiptNote.php?po_code=' . $row['po_code'] . '&action=add&vendor='.$row['po_vendor'].'" class="btn btn-secondary btn-sm" data-placement="top" data-toggle="tooltip" data-title="Enter GRN">
                                                    <i class="fa fa-truck" aria-hidden="true"></i>&nbsp; Record GRN</a>';
                                                }

                                                echo '    </div></div>';




                                                //                                                echo '    <a class="btn btn-light btn-sm" onclick="printContent(this);" data-code="'.$row['po_code'].'" data-img="'.$row['image'].'"  data-id="po_print">
                                                //                                                    <i class="fa fa-print" aria-hidden="true"></i></a>';
                                                //                                                if($row['po_status']=="Created" || $row['po_status']=="Approved"){
                                                //                                                    echo ' <a href="addPurchaseOrder.php?po_code=' . $row['po_code'] . '&action=edit&type=purchaseorders" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">'; 
                                                //
                                                //                                                    echo '
                                                //                                                    <i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                //                                                    <a href="javascript:deleteRecord_8(' . $row['id'] . ');" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete">
                                                //                                                    <i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                //                                                    ';
                                                //                                                }  
                                                //
                                                //
                                                //                                                if($row['po_status']=="Delivered"){
                                                //                                                    echo '  <a href="addGoodsReceiptNote.php?po_code=' . $row['po_code'] . '&action=add&vendor='.$row['po_vendor'].'" class="btn btn-secondary btn-sm" data-placement="top" data-toggle="tooltip" data-title="Enter GRN">
                                                //                                                    <i class="fa fa-truck" aria-hidden="true"></i></a>';
                                                //                                                }


                                                echo ' </td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
                                            function deleteRecord_8(RecordId)
                                            {
                                                if (confirm('Confirm delete')) {
                                                    window.location.href = 'deletePurchaseOrder.php?id='+RecordId;
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

                    window.location.href = 'assets/po_print_html.php?po_code='+code;

                }
                    //$('#po_print').hide();

                    // function get_print_html(po_code,img){
                    //     $.ajax ({
                    //         url: 'assets/po_print_html.php',
                    //         type: 'post',
                    //         async :false,
                    //         data: {
                    //             po_code:po_code,
                    //         },
                    //         //dataType: 'json',
                    //         success:function(response){
                    //             if(response!=0 || response!=""){
                    //                 $('#po_print').html(response);
                    //                 //   $('#po_print').prepend('<img src="'+img+'" width="50px" height="50px"/>');

                    //             }else{
                    //                 alert('Something went wrong');
                    //             }
                    //         }

                    //     });
                    // }
                    // var beforePrint = function () {
                    //     $('#po_print').show();
                    // };

                    // var afterPrint = function () {
                    //     location.reload();

                    //     $('#po_print').hide();
                    // };

                    // function printContent(el){
                    //     var id= $(el).attr('data-id');
                    //     var code= $(el).attr('data-code');
                    //     var img= $(el).attr('data-img');
                    //     get_print_html(code,img);

                    //     window.onbeforeprint = beforePrint;
                    //     window.onafterprint = afterPrint;
                    //     var restorepage = $('body').html();
                    //     var printcontent = $('#' + id).clone();
                    //     $('body').empty().html(printcontent);
                    //     window.print();
                    //     $('body').html(restorepage);

                    // }

                    $(document).ready(function() {
                        // data-tables
                        var table = $('#po_table').DataTable();
                        table
                            .order( [ 1, 'desc' ] )
                            .draw();
                    });	
                </script>
                
                
 
	
                
                <?php include('footer.php'); ?>