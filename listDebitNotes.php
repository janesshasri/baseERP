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
                        <h1 class="main-title float-left">Debit Note list</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">List Debit Notes</li>
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
                                <a href="listInvoices.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add DebitNote</a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b> Debit Note list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th>Id</th>												
                                            <th>Debit Note No#</th>												
                                            <th>Date</th>												
                                            <th>Vendor</th>												
                                            <th>GRN NO#</th>												
                                            <th>Payment Mode</th>
                                            <th>Amount</th>

                                            <th>Actions</th>
                                        </tr>
                                    </thead>										
                                    <tbody>
                                        <?php
                                        include("database/db_conection.php");//make connection here
                                        $sql = "SELECT d.*,c.*,d.id as did
										FROM debitnotes d,comprofile c where c.orgid=d.debitnote_comp_code
										ORDER BY d.debitnote_id DESC ";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td>' .$row['did'] . '</td>';
                                                echo '<td>' .$row['debitnote_id'] . '</td>';
                                                echo '<td>'.$row['debitnote_paymentdate'].' </td>';
                                                echo '<td>'.$row['debitnote_vendor'].' </td>';
                                                echo '<td>'.$row['debitnote_grn_id'].' </td>';
                                                echo '<td>'.$row['debitnote_paymentmode'].' </td>';
                                                echo '<td>'.$row['debitnote_value'].' </td>';

                                                $sql2 = "SELECT c.* from comprofile c ,debitnotes cr where c.orgid=cr.debitnote_comp_code";
                                                $result2 = mysqli_query($dbcon,$sql2);
                                                $row2 =$result2-> fetch_assoc();
                                                //print_r($row2);
                                        ?>


                                        <?php


                                                echo '<td><a class="btn btn-light btn-sm hidden-md" onclick="printContent(this);" data-img="assets/images/logo.png" data-code="'.$row['debitnote_id'].'"  data-id="po_print">
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


                                    </tbody>
                                </table>
                            </div>

                        </div>														
                    </div><!-- end card-->	
                    <div id="po_print" style="display:;">


                    </div>
                </div>


                <script>
                    function get_print_html(debitnote_id,img){
                        $.ajax ({
                            url: 'assets/debitnote_print.php',
                            type: 'post',
                            async :false,
                            data: {
                                debitnote_id:debitnote_id,
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