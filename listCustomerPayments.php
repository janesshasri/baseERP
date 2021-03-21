<?php include('header.php'); ?>
<!-- End Sidebar -->

<script src="assets/js/jspdf.debug.js"></script>
<script src="assets/js/jspdf.min.js"></script>

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Payments list</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">List CustomerPayments</li>
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
                                <a href="addCustomerReceipts.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add CustomerPayments</a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b> CustomerPayments list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="po_reports" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th style="display:none;">Id</th>												
                                            <th>Payment#</th>												
                                            <th>Date</th>												
                                            <th>Reference#</th>
                                            <th>Customer</th>												
                                            <th>Invoioce#</th>												
                                            <th>Mode</th>												
                                            <th>Amount Received</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>										
                                    <tbody>
                                        <?php
                                        include("database/db_conection.php");//make connection here
                                        $sql = "SELECT 'auto' as type,i.id as pid,i.*,c.* FROM customer_payments i ,customerprofile c where
                                        c.custid=i.cust_payment_customer
                                        UNION
                                        SELECT 'manual' as type,iacc.id as pid,iacc.*,cacc.* FROM
                                        customer_paymentsacc iacc,customerprofile cacc
                                        where cacc.custid=iacc.cust_payment_customer ORDER BY pid DESC ";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td style="display:none;">' .$row['id'] . '</td>';
                                                echo '<td>' .$row['cust_payment_id'] . '</td>';
                                                echo '<td>'.$row['cust_payment_date'].' </td>';
                                                echo '<td>'.$row['cust_payment_ref_no'].' </td>';
                                                echo '<td>'.$row['custname'].' </td>';
                                                echo '<td>'.$row['cust_payment_invoice_no'].' </td>';
                                                echo '<td>'.$row['cust_payment_mode'].' </td>';
                                                echo '<td>'.$row['cust_payment_amount'].' </td>';

                                         
                                        ?>


                                        <?php


                                                echo '<td><a class="btn btn-light btn-sm hidden-md" onclick="printContent(this);" data-type="'.$row['type'].'"  data-code="'.$row['cust_payment_id'].'"  data-id="po_print">
														<i class="fa fa-print" aria-hidden="true"></i></a>
                                                      ';
                                                //                                                <a href="addVendorPayments.php?payment_id=' . $row['payment_id'] . '&action=edit&type=payments" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5">

                                                /*
														<i class="fa fa-pencil" aria-hidden="true"></i></a>
*/

                                                echo ' </td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
                                            function deleteRecord_8(RecordId)
                                            {
                                                if (confirm('Confirm delete')) {
                                                    window.location.href = 'deletepayments.php?id='+RecordId;
                                                }
                                            }
                                        </script>

                                    </tbody>
                                    <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                </table>
                            </div>

                        </div>														
                    </div><!-- end card-->	
                    <div id="po_print" style="display:;">


                    </div>
                </div>


                <script>

var table = $('#po_reports').DataTable( {
            lengthChange: false,
            "footerCallback": function ( row, data, start, end, display ) {
                var api = this.api(), data;
                var intVal = function ( i ) {
                    return typeof i === 'string' ?
                        i.replace(/[\$,]/g, '')*1 :
                    typeof i === 'number' ?
                        i : 0;
                };
                var grossval = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);


                $( api.column( 5 ).footer() ).html('Total');
                $( api.column( 6 ).footer() ).html(grossval);
                //   $( api.column( 5 ).footer() ).html(taxamt);
                //   $( api.column( 7 ).footer() ).html(netval);
                //  $( api.column( 8 ).footer() ).html(bal);

            }

        });
                    $('#po_print').hide();

                    function get_print_html(cust_payment_id,img,type){
                        $.ajax ({
                            url: 'assets/customer_payment_print.php',
                            type: 'post',
                            async :false,
                            data: {
                                cust_payment_id:cust_payment_id,
                                type: type
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
                        var type= $(el).attr('data-type');
                        get_print_html(code,img,type);

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