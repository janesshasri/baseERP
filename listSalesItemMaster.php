<?php include('header.php'); ?>
<?php include('workers/getters/functions.php'); ?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Sales item list</h1>
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
                                <a href="addSalesItemMaster.php?entrytype=self" class="btn btn-primary btn-sm"><i class="fa fa-user-plus" aria-hidden="true"></i>
                                    Add Sales Item </a></span>

                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b> Sales Item list </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered table-hover display">
                                    <thead>
                                        <tr>
                                            <th>Item Code</th>												
                                            <th>Item Name</th>												
                                            <th>Item Cost ₹</th>
                                            <th>Taxrate(%)</th>	
											<th>MRP ₹</th>	
											<th>Discount(%)</th>												
                                            <th>Sales rate ₹</th>												
                                            <th>Stock On Hand</th>												
                                            <th>Created By</th>												
                                            <th>Actions</th>
                                        </tr>
                                    </thead>										
                                    <tbody>
                                        <?php


                                        include("database/db_conection.php");//make connection here
                                        $sql = "SELECT * from salesitemaster2";
                                        $result = mysqli_query($dbcon,$sql);
                                        if ($result->num_rows > 0){
                                            while ($row =$result-> fetch_assoc()){
                                               // print_r($row);
                                                $pprice = $row['sales_taxmethod'] == 0 ? $row['itemcost'] : $row['itemcost']*(100/(100+$row['sales_taxrate']));
                                                $pprice = $pprice==""?"NA":$pprice;
                                                $pptax = $row['sales_taxrate'];
                                                $pptax = $pptax==0?"NA":$pptax;
                                                echo "<tr>";
                                                echo '<td>' .$row['itemcode'] . '</td>';
                                                echo '<td>'.$row['itemname'].' </td>';
                                                echo '<td>'.nf($pprice).' </td>';
                                                echo '<td>'.$pptax.' </td>';
												echo '<td>'.$row['sales_mrp'].' </td>';
												echo '<td>'.$row['sales_disc'].' </td>';
                                                echo '<td>'.$row['sales_priceperqty'].' </td>';
                                                echo '<td>'.$row['stockinqty'].' </td>';
                                                echo '<td>'.$row['handler'].' </td>';

                                        ?>


                                        <?php


                                                echo '<td>';

                                                echo '    <div class="dropdown">
  <button type="button" class="btn btn-light btn-xs dropdown-toggle" data-toggle="dropdown">

  </button>
  <div class="dropdown-menu">';

                                                echo ' <a class="dropdown-item" href="addSalesItemMaster.php?itemcode=' . $row['itemcode'] . '&action=edit&type=salesitemaster2" class="btn btn-primary btn-sm" data-target="#modal_edit_user_5"><i class="fa fa-pencil" aria-hidden="true"></i>&nbsp; Edit</a>';   
                                                echo '
                                                        <a class="dropdown-item"  href="javascript:deleteRecord_8(' . $row['id'] . ');" class="btn btn-danger btn-sm" data-placement="top" data-toggle="tooltip" data-title="Delete"><i class="fa fa-trash-o" aria-hidden="true"></i>&nbsp; Delete</a>';


                                                echo '    </div></div>';

                                                echo ' </td>';
                                                echo "</tr>";
                                            }
                                        }
                                        ?>						
                                        <script>
                                            function deleteRecord_8(RecordId)
                                            {
                                                if (confirm('Confirm delete')) {
                                                    window.location.href = 'deleteSalesItemMaster.php?id='+RecordId;
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