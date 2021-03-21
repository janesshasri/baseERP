<?php
include('header.php');
include('workers/getters/functions.php');
?>

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left"> Purchase Order Reports</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Purchase Order Reprots</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Purchase Order Reports </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-1 col-form-label">Date </label>
                                <div class="col-sm-4">
                                    <input type="text" class="form-control" id="daterange" >
                                </div>
                      <!--          <label for="staticEmail" class="col-sm-1 col-form-label">Filter By</label>
                                <div class="col-sm-2">
                                    <select class="form-control" id="filterby">
                                        <option value="grn_po_vendor">Customer</option>
                                        <option value="grn_owner">User</option>
                                        <option value="grn_item">Item</option>
                                    </select>
                                </div>-->
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary" onclick="get_sales_reports();">Run Report</button>
                                </div>
                            </div>
                            <hr/>
                            <!-- Start coding here -->
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="po_reports_div"></span>
                                    <table id="po_reports" class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>PO#</th>
                                                <th>PO DATE</th>
                                                <th>VENDOR</th>
                                                <th>GROSS VAL</th>
                                                <th>TAX AMT</th>
                                                <th>NET VAL</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(isset($_GET['st'])&&isset($_GET['end'])){
                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d H:i:s', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d H:i:s', $timestamp);

                                                $sql = "SELECT * from purchaseorders p, vendorprofie v where (so_date BETWEEN '$st' AND '$end') and p.po_vendor=v.vendorid;";    

                                            }else{
                                                $sql = "SELECT * from purchaseorders p , vendorprofile v where p.po_vendor=v.vendorid;";    
                                            }

                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    echo '                           <tr>
                                                <td>'.$row['po_code'].'</td>
                                                <td>'.$row['po_date'].'</td>
                                                <td>'.$row['supname'].'</td>
                                                <td>'.($row['po_value']-gettaxamt_total($row['po_items'])).'</td>
                                                <td>'.gettaxamt_total($row['po_items']).'</td>
                                                <td>'.$row['po_value'].'</td>
                                            </tr>';  
                                                }
                                            }
                                            ?>


                                        </tbody>
                                        <tfoot>
                                            <tr>
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


                        </div>
                    </div><!-- end card-->

                </div>
            </div>
        </div>
    </div>
</div>



<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<script>

    $(document).ready(function() {

        $('#daterange').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'Last Quarter': [moment(), moment().subtract(1, 'month')],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            "startDate": "07/19/2018",
            "endDate": "07/25/2018"
        }, function(start, end, label) {
            /*
            console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
*/
        });
        var date_range = $('#daterange').val(); 

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
                .column( 3 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                var taxamt = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                var netval = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

            
                $( api.column( 0 ).footer() ).html('Total');
                $( api.column( 3).footer() ).html(grossval);
                $( api.column( 4 ).footer() ).html(taxamt);
                $( api.column( 5 ).footer() ).html(netval);
//                $( api.column( 8 ).footer() ).html(bal);

            },
            buttons: [
                {
                    extend: 'print',
                    title: '',
                    text: '<span class="fa fa-print"></span>',footer: true,
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                            '<p><img src="<?php echo $baseurl;?>assets/images/dhirajLogo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Purchase Order Reports</b><br/>'+date_range+'</p></div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Purchase Order Reports',footer: true
                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Purchase Order Reports',footer: true
                },
                {
                    extend: 'colvis',
                    text:'Show/Hide',footer: true
                }
            ]
        } );

        table.buttons().container()
            .appendTo( '#po_reports_div');


    });

    function get_po_reports(){
        var date_range = $('#daterange').val().replace(" ","").split('-');
        //var filter = $('#filterby').val();
        var st = date_range[0].replace(" ","");
        var end = date_range[1].replace(" ","");
        location.href="PurchaseOrderReports.php?st="+st+"&end="+end;
    }
</script>
<?php
include('footer.php');
?>
