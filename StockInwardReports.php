<?php
include('header.php');
include('workers/getters/functions.php');
include('generic_modal.php');

function payment_status($payment_status,$newdate,$po_payterm,$grn_date){
    $curdate=strtotime($newdate);
    $mydate=strtotime('+'.$po_payterm.' day', strtotime($grn_date));

    if($curdate > $mydate)
    {
        return 'Overdue';
    }
}
?>

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left"> Stock Inward Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Stock Inward Report</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Stock Inward Report </b></h3>
                        </div>

                        <div class="card-body">

                            <!-- Start coding here -->
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="po_reports_div"></span>
                                    <table id="po_reports" class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Item Code</th>												
                                                <th>Item Name</th>
                                                <th>Item Cost</th>
                                                <th>Taxrate</th>	
                                                <th>Price</th>
                                                <th>Stock on Hand</th>
                                                <th>Stock Value</th>
                                                <th>UOM</th>												
                                                <th>Created By</th>	
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            $sql = "SELECT itemcode, itemname,itemcost,taxrate,taxableprice,stockinqty,uom,handler,id
															FROM purchaseitemaster
															WHERE status = '1'
															ORDER BY id DESC;";    


                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    echo '<tr>';
                                                    echo '<td>' .$row['itemcode'] . '</td>';
                                                    echo '<td>'.$row['itemname'].' </td>';
                                                    echo '<td>'.$row['itemcost'].' </td>';
                                                    echo '<td>'.$row['taxrate'].' </td>';
                                                    echo '<td>'.$row['taxableprice'].' </td>';
                                                    echo '<td>'.$row['stockinqty'].' </td>';
                                                    echo '<td>'.$row['stockinqty']*$row['taxableprice'].' </td>';

                                                    echo '<td>'.$row['uom'].' </td>';													
                                                    echo '<td>'.$row['handler'].' </td>';
                                                    echo ' </tr>';  
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

 
        var printhead = 'Stock Inward';
        var excel_printhead = 'Stock Inward';
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
                }, 0 ).toFixed(2);


                $( api.column( 0 ).footer() ).html('Total');
                $( api.column( 6 ).footer() ).html(grossval);
              
            },
            buttons: [
                {
                    extend: 'print',
                    title: '',
                    text: '<span class="fa fa-print"></span>',
                    footer: true ,
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'font-size', '10pt' )
                            .prepend(
                            '<p><img src="<?php echo $baseurl;?>assets/images/dhirajLogo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Stock Inward</b><br/></p></div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Stock Inward', footer: true,
                    messageTop: ''   

                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Stock Inward', footer: true,
                    messageTop: ''   

                },
                {
                    extend: 'colvis',
                    text:'Show/Hide', footer: true 
                }
            ]
        } );


        table.buttons().container()
            .appendTo( '#po_reports_div');


    });

/*   function get_po_reports(){
        var st = '';
        var end = '';

        var date_range_val = $('#daterange').val();
        if(date_range_val!=''){
            var date_range = date_range_val.replace(" ","").split('-');
            //var filter = $('#filterby').val();
            st = date_range[0].replace(" ","");
            end = date_range[1].replace(" ","");
        }

        var vendorwise = $('#vendorwise').val();
        var pstatuswise = $('#pstatuswise').val();
        location.href="VendorPayablesReports.php?st="+st+"&end="+end+"&vendorwise="+vendorwise+"&pstatuswise="+pstatuswise;

    }
    function cb(start, end) {
        $('#daterange').val(start+ ' - ' + end);
        $('#daterange').attr('readonly',true); 
        $("#reset-date").show();
    }*/
</script>
<?php
include('footer.php');
?>
