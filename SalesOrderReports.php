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
                        <h1 class="main-title float-left"> Sales Order Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Sales Order Reprot</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Sales Order Report</b></h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <input type="text" id="daterange" class="form-control-sm" placeholder="Select Date Range">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" id="reset-date">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <select id="custwise" class="form-control form-control-sm" name="custwise">
                                        <option selected>--Select Customer--</option>
                                        <?php
                                        $sql = mysqli_query($dbcon,"SELECT * FROM customerprofile");
                                        while ($row = $sql->fetch_assoc()){	
                                            $custid=$row['custid'];
                                            $custname=$row['custname'];
                                            echo '<option  value="'.$custid.'" >'.$custid.' '.$custname.'</option>';

                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group col-sm-3" >
                                    <select class="form-control form-control-sm" required name="statuswise"  id="statuswise">
                                        <option value="">Select Status</option>
                                        <option value="Created">Created</option>
                                        <option value="Approved">Approved</option>
                                        <option value="Billed">Invoiced</option>
                                        <option value="Cancelled">Cancelled</option>
                                        <option value="Closed">Closed</option>
                                    </select>											
                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="get_sales_reports();">Run Report</button>
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
                                                <th>SO#</th>
                                                <th>SO Date</th>
                                                <th>Customer</th>
                                                <th>Value</th>
                                                <th>Tax</th>
                                                <th>Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if((isset($_GET['st'])&&$_GET['st']!='')||(isset($_GET['end'])&&$_GET['end']!='')||(isset($_GET['custwise'])&&$_GET['custwise'])||(isset($_GET['statuswise'])&&$_GET['statuswise']!='')){
                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d', $timestamp);
                                                $vendorwise = $_GET['custwise'];
                                                $statuswise = $_GET['statuswise'];

                                                $sql = "SELECT * from salesorders s,customerprofile c where 1=1 ";
                                                if($_GET['st']!=''){

                                                    if($st==$end){
                                                        $sql.= " and s.so_date='$st' ";   
                                                    }else{
                                                        $sql.=" and (s.so_date BETWEEN '$st' AND '$end') ";   
                                                    }
                                                }
                                                if(isset($_GET['custwise'])&&$_GET['custwise']!=''){
                                                    // echo $_GET['vendorwise'];
                                                    $sql.=" and s.so_customer='".$_GET['custwise']."'";    
                                                }
                                                if(isset($_GET['statuswise'])&&$_GET['statuswise']!=''){

                                                    $sql.=" and s.so_status='".$_GET['statuswise']."'";    
                                                }
                                                $sql.=" and s.so_customer=c.custid;";    

                                            }else{
                                                $sql = "SELECT * from salesorders s, customerprofile c where s.so_customer=c.custid;";    
                                            }

                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    $so_items_arr = json_decode($row['so_items']);

                                                    echo '                           <tr>
                                                <td>'.$row['so_code'].'</td>
                                                <td>'.$row['so_date'].'</td>
                                                <td>'.$row['custname'].'</td>
                                                <td>'.nf(get_total_notax($so_items_arr)).'</td>
                                                <td>'.nf(get_total($so_items_arr)- get_total_notax($so_items_arr)).'</td>
                                                <td>'.nf(get_total($so_items_arr)).'</td>
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
    var page_custwise = "<?php if(isset($_GET['custwise'])){ echo $_GET['custwise']; } ?>";
    var page_st = "<?php if(isset($_GET['st'])){ echo $_GET['st']; } ?>";
    var page_end = "<?php if(isset($_GET['end'])){ echo $_GET['end']; } ?>";
    var page_statuswise = "<?php if(isset($_GET['statuswise'])){ echo $_GET['statuswise']; } ?>";

    $(document).ready(function() {
        var vendor_params =[];
        Page.load_select_options('custwise',vendor_params,'customerprofile',' Customer','custid','custname');
        $('#custwise').val(page_custwise);
        $('#statuswise').val(page_statuswise);
        $("#reset-date").hide();

        $('#daterange').daterangepicker({
            ranges: {
                'Today': [moment(), moment()],
                'This Quarter': [moment().startOf('quarter'), moment().endOf('quarter')],
                'Last Quarter': [moment().subtract(1, 'quarter').startOf('quarter'), moment().subtract(1, 'quarter').endOf('quarter')],
                'This Year': [moment().startOf('year'), moment().endOf('year')],
                'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            }
        }, function(start, end, label) {
            $('#daterange').attr('readonly',true); 
            $("#reset-date").show();

        });

        if(page_end!=''){
            cb(page_st,page_end);
        }else{
            $('#daterange').val(''); 
        }

        $("#reset-date").click(function(){
            $('#daterange').val('');
            $('#daterange').attr('readonly',false); 
            $("#reset-date").hide();
        });

        var date_range = $('#daterange').val(); 

        var cust_var = $('#custwise').val(); 
        var cust_name_json = cust_var!=''?Page.get_edit_vals(cust_var,"customerprofile","custid"):'';
        var cust_name = cust_name_json.custname;
        var status_var = $('#statuswise').val(); 
        var printhead = cust_var!=''?'<p><b>Customer : </b>'+cust_name+'</p>':'';
        printhead+= status_var!=''?'<p><b>Status : </b>'+status_var+'</p>':'';
        printhead+= date_range!=''?'<p><b>Date : </b>'+date_range+'</p>':'';
        var excel_printhead = cust_var!=''?'Customer : '+cust_name:'';
        excel_printhead+= '  ';
        excel_printhead+= status_var!=''?'Status : '+status_var:'';
        excel_printhead+= '  ';
        excel_printhead+= date_range!=''?'Date : '+date_range:'';

        var table = $('#sales_reports').DataTable( {
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
                }, 0 ).toFixed(2);

                var taxamt = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);

                var netval = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);


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
                            '<p><img src="<?php echo $baseurl;?>assets/images/dhirajLogo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Sales Order Reports</b><br/></p>'+printhead+'</div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Sales Order Reports',footer: true,
                    messageTop: excel_printhead   

                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Sales Order Reports',footer: true,
                    messageTop: excel_printhead
                },
                {
                    extend: 'colvis',
                    text:'Show/Hide',footer: true
                }
            ]
        } );

        table.buttons().container()
            .appendTo( '#sales_reports_div');


    });

    function get_sales_reports(){
        var st = '';
        var end = '';

        var date_range_val = $('#daterange').val();
        if(date_range_val!=''){
            var date_range = date_range_val.replace(" ","").split('-');
            //var filter = $('#filterby').val();
            st = date_range[0].replace(" ","");
            end = date_range[1].replace(" ","");
        }

        var custwise = $('#custwise').val();
        var statuswise = $('#statuswise').val();
        location.href="SalesOrderReports.php?st="+st+"&end="+end+"&custwise="+custwise+"&statuswise="+statuswise;
    }

    function cb(start, end) {
        $('#daterange').val(start+ ' - ' + end);
        $('#daterange').attr('readonly',true); 
        $("#reset-date").show();
    }
</script>
<?php
include('footer.php');
?>
