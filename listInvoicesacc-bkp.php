<?php include('header.php'); ?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Invoice list</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">List Invoice Items</li>
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
                                <a href="addInvoice2.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add Invoice</a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>  Invoice list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example12324" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">Id#</th>												
                                            <th>Invoice No#</th>												
                                            <th>Invoice Type</th>												
                                            <th>Invoice PHNO</th>												
                                            <th>Invoice Date</th>												
                                            <th>Customer</th>
                                            <th>Amount</th>												
                                            <th>Balance due</th>												
                                            <th>Payment Status</th>												
                                            <th>User</th>												
                                            <th>Actions</th>
                                        </tr>
                                    </thead>										
                                    <tbody>


                                        <?php
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

                                        function status_code($status){
                                            if($status=="Approved"){
                                                $status_text = ' <span class="text-dark">'.$status.'</span>';  
                                                return $status_text;  
                                            }
                                            if($status=="Created"){
                                                $status_text = ' <span class="text-primary">'.$status.'</span>';  
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

                                        $sql = "SELECT i.*,c.* FROM invoicesacc i,customerprofile c where c.custid=i.inv_customer
										ORDER BY i.id DESC ";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td style="display:none;">' .$row['id'] . '</td>';
                                                echo '<td>' .$row['inv_code'] . '</td>';
                                                echo '<td>'.$row['inv_type'].' </td>';
                                                echo '<td>'.$row['inv_cust_ref_phno'].' </td>';
                                                echo '<td>'.$row['inv_date'].' </td>';
                                                echo '<td>'.$row['custname'].' </td>';
                                                echo '<td>'.$row['inv_value'].' </td>';
                                                echo '<td>'.$row['inv_balance_amt'].' </td>';
                                                if($row['inv_type']=="Credit Invoice"){
                                                    echo '<td>'.payment_status($row['inv_payment_status'],date('Y-m-d'),$row['inv_payterm'],$row['inv_date']) .' </td>';

                                                }else{
                                                    echo '<td><span class="text-success">Paid</span> </td>';

                                                }

                                                echo '<td>'.$row['inv_owner'].' </td>';
                                        ?>


                                        <?php


                                                echo '<td>';

                                                echo '    <div class="dropdown">
  <button type="button" class="btn btn-light btn-xs dropdown-toggle" data-toggle="dropdown">

  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item"  href="#" onclick="printContent(this);" data-template="sales_credit_invacc" data-code="'.$row['inv_code'].'" data-img="assets/images/logo.png"  data-id="po_print"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</a>   <a class="dropdown-item"  href="#" onclick="printContent(this);" data-template="dc_printacc" data-code="'.$row['inv_code'].'" data-img="assets/images/logo.png"  data-id="po_print"><i class="fa fa-print" aria-hidden="true"></i>&nbsp; DC Print</a>';


                                                if($row['inv_status']=="Created"){
                                                    echo ' <a class="dropdown-item" href="addInvoice2.php?inv_code=' . $row['inv_code'] . '&action=edit&type=invoicesacc" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</a>';   
                                                    echo '
                                                        <a class="dropdown-item"  href="#" onclick="deleteRecord_8(this);" data-id="'.$row['inv_code'].'" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Delete</a>';


                                                }



                                                    echo '
                                                        <a class="dropdown-item"  href="addCustomerReceiptsacc.php?inv_code=' . $row['inv_code'] . '&action=add&type=customer_paymentsacc" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Recieve Payment"><i class="fa fa-exchange" aria-hidden="true"></i>&nbsp; Recieve payment</a>';


                                                



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
                                            function deleteRecord_8(x)
                                            {
                                                var RecordId = $(x).attr('data-id');
                                                if (confirm('Confirm delete')) {
                                                    window.location.href = 'deleteInvoicesacc.php?inv_code='+RecordId;
                                                }
                                            }
                                        </script>

                                    </tbody>
                                </table>
                            </div>

                        </div>														
                    </div><!-- end card-->	
                    <div id="po_print" style="display:;">


                    </div>
                </div>


                <script>
                    $('#po_print').hide();

                    function get_print_html(inv_code,img,template){
                        $.ajax ({
                            url: 'assets/'+template+'.php',
                            type: 'post',
                            async :false,
                            data: {
                                inv_code:inv_code,
                            },
                            //dataType: 'json',
                            success:function(response){
                                if(response!=0 || response!=""){
                                    $('#po_print').html(response);
                                    $('#po_print').prepend('<img src="'+img+'" width="50px" height="50px"/>');

                                }else{
                                    alert('Something went wrong');
                                }
                            }

                        });
                    }
                    var beforePrint = function () {
                        $('#po_print').show();
                    };

                    var afterPrint = function () {
                        location.reload();
                        $('#po_print').hide();

                    };

                    function printContent(el){
                        var id= $(el).attr('data-id');
                        var code= $(el).attr('data-code');
                        var img= $(el).attr('data-img');
                        var template = $(el).attr('data-template');
                        get_print_html(code,img,template);

                        window.onbeforeprint = beforePrint;
                        window.onafterprint = afterPrint;
                        var restorepage = $('body').html();
                        var printcontent = $('#' + id).clone();
                        $('body').empty().html(printcontent);
                        window.print();
                        $('body').html(restorepage);
                    }

                </script>
                <?php include('footer.php'); ?>