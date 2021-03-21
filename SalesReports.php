<?php
include('header.php');

function gettaxamt_total($arr){
    $ttax=0;
    $items = json_decode($arr, true);

    for($i=0;$i<count($items);$i++){
        if($items[$i]['tax_method']==0){
            $ttax+= $items[$i]['rwamt']*($items[$i]['tax_val']/100);
        }else{
            $ttax+= ($items[$i]['rwqty']*$items[$i]['rwprice_org'])*($items[$i]['tax_val']/100);
        }
    }

    return $ttax;

}
?>

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left"> Sales Reports</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Sales Reprots</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Sales Reports </b></h3>
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
                                    <span id="sales_reports_div"></span>
                                    <table id="sales_reports" class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>GRN#</th>
                                                <th>PO#</th>
                                                <th>INVOICE#</th>
                                                <th>GRN DATE</th>
                                                <th>VENDOR</th>
                                                <th>GROSS VAL</th>
                                                <th>TAX AMT</th>
                                                <th>NET VAL</th>
                                                <th>BALANCE DUE</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if(isset($_GET['st'])&&isset($_GET['end'])){
                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d H:i:s', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d H:i:s', $timestamp);

                                                $sql = "SELECT * from grn_notes where (grn_date BETWEEN '$st' AND '$end');";    

                                            }else{
                                                $sql = "SELECT * from grn_notes;";    
                                            }

                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    echo '                           <tr>
                                                <td>'.$row['grn_id'].'</td>
                                                <td>'.$row['grn_po_code'].'</td>
                                                <td>'.$row['grn_invoice_no'].'</td>
                                                <td>'.$row['grn_date'].'</td>
                                                <td>'.$row['grn_po_vendor'].'</td>
                                                <td>'.($row['grn_po_value']-gettaxamt_total($row['grn_po_items'])).'</td>
                                                <td>'.gettaxamt_total($row['grn_po_items']).'</td>
                                                <td>'.$row['grn_po_value'].'</td>
                                                <td>'.$row['grn_balance'].'</td>
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
                .column( 6 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                var taxamt = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                var netval = api
                .column( 7 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

                var bal = api
                .column( 8 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 );

              //  $( api.column( 0 ).footer() ).html('Total');
                $( api.column( 6 ).footer() ).html(grossval);
                $( api.column( 5 ).footer() ).html(taxamt);
                $( api.column( 7 ).footer() ).html(netval);
                $( api.column( 8 ).footer() ).html(bal);

            },
            buttons: [
                {
                    extend: 'print',
                    title: 'Purchase Reports',
                    text: '<span class="fa fa-print"></span>',
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                            '<img src="http://datatables.net/media/images/logo-fade.png" style="position:absolute; top:0; left:0;" />'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Purchase Reports'
                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Purchase Reports'
                },
                {
                    extend: 'colvis',
                    text:'Show/Hide'
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
        location.href="PurchaseReports.php?st="+st+"&end="+end;
    }
</script>
<?php
include('footer.php');
?>
