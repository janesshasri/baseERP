<?php include('header.php'); ?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Vendor Credits list</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">List Vendor Credits</li>
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
                                <a href="addVendorCredits.php" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add Vendor Credits</a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b> Vendor Credits list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th>Credit No.</th>												
                                            <th>Credit Date</th>												
                                            <th>Status</th>												
                                            <th>Vendor</th>
                                            <th>Amount</th>												
                                            <th>Credit Balance</th>												
                                            <th>User</th>												
                                            <th>Actions</th>
                                        </tr>
                                    </thead>										
                                    <tbody>
                                        <?php


                                        include("database/db_conection.php");//make connection here
                                        $sql = "SELECT v.*,b.supname
										FROM vendorcredits v,vendorprofile b
										WHERE v.v_credits_vendorid=b.vendorid
										ORDER BY v.id DESC ";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                                echo "<tr>";
                                                echo '<td>' .$row['v_credits_id'] . '</td>';
                                                echo '<td>'.$row['v_credits_paymentdate'].' </td>';
                                                if($row['v_credits_availcredits']==0){
                                                    echo '<td class="text-success"> Closed </td>';

                                                }else{
                                                    echo '<td class="text-danger"> Open </td>';

                                                }
                                                echo '<td>'.$row['supname'].' </td>';
                                                echo '<td>'.$row['v_credits_amount'].' </td>';
                                                echo '<td>'.$row['v_credits_availcredits'].' </td>';
                                                echo '<td>'.$row['v_credits_handler'].' </td>';
                                        ?>



                                        <?php
                                                echo ' <td>
                                                <div class="dropdown">
  <button type="button" class="btn btn-light btn-xs dropdown-toggle" data-toggle="dropdown">

  </button>
  <div class="dropdown-menu">
    <a class="dropdown-item" href="#" onclick="printContent(this);"  data-id="po_print" data-code="'.$row['v_credits_id'].'" data-img="assets/images/logo.png"> <i class="fa fa-print" aria-hidden="true"></i>&nbsp; Print</a>';
                                                if($row['v_credits_availcredits']>0){
                                                    echo '
    <a class="dropdown-item" href="addVendorCredits.php?v_credits_id=' . $row['v_credits_id'] . '&action=edit&type=vendorcredits"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</a>';      

                                                    echo '
                                                    <a class="dropdown-item" href="#" onclick="deleteRecord_8(this);" data-id="'.$row['v_credits_id'].'"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Delete</a>';
                                                    echo '<a class="dropdown-item" href="addVendorRefund.php?v_credits_id=' . $row['v_credits_id'] . '&action=add&type=vendor_refunds"><i class="fa fa-rupee" aria-hidden="true"></i>&nbsp; Add Refund</a>';

                                                    echo '<a class="dropdown-item" href="listGoodsReceiptNote.php?v_credits_vendorid=' . $row['v_credits_vendorid'].'&v_credits_id=' . $row['v_credits_id'].'"><i class="fa fa-rupee" aria-hidden="true"></i>&nbsp; Apply to bills</a>';
                                                }


                                                echo        '</div></div></td>';
                                                echo ' </td>';
                                                echo "</tr>";
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
                                                    window.location.href = 'deleteVendorCredits.php?id='+RecordId;
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

                    function get_print_html(v_credits_id,img){
                        $.ajax ({
                            url: 'assets/credits_print_html.php',
                            type: 'post',
                            async :false,
                            data: {
                                v_credits_id:v_credits_id,
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