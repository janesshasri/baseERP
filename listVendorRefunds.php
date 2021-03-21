<?php include('header.php'); ?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Vendor Refunds list</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">List Vendor Refunds</li>
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
                                <a href="addVendorRefund.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add Refunds</a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b> Vendor Refunds list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th>Credit Ref No.</th>												
                                            <th>Refund Date</th>												
                                            <th>Amount</th>												
                                            <th>Payment Mode</th>												
                                            <th>User</th>												
                                        </tr>
                                    </thead>										
                                    <tbody>
                                        <?php


                                        include("database/db_conection.php");//make connection here
                                        $sql = "SELECT *
										FROM vendor_refund v
										ORDER BY v.id DESC ";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td>' .$row['v_refund_creditsid'] . '</td>';
                                                echo '<td>'.$row['v_refund_paymentdate'].' </td>';
                                                echo '<td>'.$row['v_refund_amount'].' </td>';
                                                echo '<td>'.$row['v_refund_paymentmode'].' </td>';
                                                echo '<td>'.$row['v_refund_handler'].' </td>';
                                        ?>



                                        <?php

                                            }
                                        }
                                        ?>	

                                        <script>
                                            function deleteRecord_8(x)
                                            {
                                                console.log(x);
                                                var RecordId = $(x).attr('data-id');
                                                console.log(RecordId);
                                                console.log($(x).attr('data-id'));
                                                if (confirm('Confirm delete')) {
                                                    window.location.href = 'deleteVendorRefund.php?id='+RecordId;
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

                    function get_print_html(po_code,img){
                        $.ajax ({
                            url: 'assets/po_print_html.php',
                            type: 'post',
                            async :false,
                            data: {
                                po_code:po_code,
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
                        get_print_html(code,img);

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