<?php
include('header.php');
include('workers/getters/functions.php');

function payment_status($payment_status,$newdate,$po_payterm,$grn_date){
    $curdate=strtotime($newdate);
    $mydate=strtotime('+'.$po_payterm.' day', strtotime($grn_date));
    if($curdate > $mydate)
    {
        return 'Overdue';
    }
}

function getSaleItemCountCols($getArr, $dbcon){
    $listsql = "SELECT * from salesitemaster2 ";
    $listresult = mysqli_query($dbcon,$listsql);
    $listHtml = '';
    if ($listresult->num_rows > 0){
        while ($listrow = $listresult-> fetch_assoc()){
             $listHtml.= '<td>'.getSaleItemCount($getArr,$listrow['id']).'</td>';                                                        
        }
    }

    return $listHtml;
}


function getSaleItemCountfootercols($dbcon){
    $listsql = "SELECT * from salesitemaster2 ";
    $listresult = mysqli_query($dbcon,$listsql);
    $listHtml = '';
    if ($listresult->num_rows > 0){
        while ($listrow = $listresult-> fetch_assoc()){
             $listHtml.= '<th></th>';                                                        
        }
    }

    return $listHtml;
}


function getSaleItemCount($getArr, $itemCodeId) {
    $itemsCount=0;
    $getArrItems = json_decode($getArr, true);
    for($i=0;$i<count($getArrItems);$i++){
        if($getArrItems[$i]['itemcode'] == $itemCodeId){
            $itemsCount = $getArrItems[$i]['rwqty'];
        }
    }
    return $itemsCount;
}
?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left"> Sales Itemwise Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Sales Itemwise Reprot</li>
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
                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Sales Itemwise Report</b></h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group row">
                                <div class="col-sm-4">
                                    <div class="input-group">
                                        <input type="text" id="daterange" class="form-control" placeholder="Select Date Range">
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" id="reset-date">
                                                <i class="fa fa-times"></i>
                                            </button>
                                        </span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-3">
                                    <select id="custwise" class="form-control form-control-md" name="custwise">
                                        <option value=''>--Select Customer--</option>
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
                                <div class="form-group col-md-3">
                                    <select id="pstatuswise" class="form-control form-control-md" name="pstatuswise">
                                        <option value="" selected>Open Payment Status</option>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Partially Paid">Partially Paid</option>
                                        <option value="Overdue">Overdue</option>
                                        <option value="Paid">Paid</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary" onclick="get_custrec_reports();">Run Report</button>
                                </div>
                            </div>
                            <hr/>
                            <!-- Start coding here -->
                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <span id="po_reports_div"></span>
                                    <table id="po_reports" class="table table-bordered" style="overflow-x:hidden;">
                                        <thead>
                                            <tr>
                                                <th>Invoice#</th>
                                                <th>Invoice Date</th>
                                                <th>Customer</th>

                                            <?php
                                              $listsql = "SELECT * from salesitemaster2 ";
                                              $listresult = mysqli_query($dbcon,$listsql);
                                              $itemVals = array();
                                              if ($listresult->num_rows > 0){
                                                  while ($listrow = $listresult-> fetch_assoc()){
                                                        $itemVals[count($itemVals)] = $listrow;
                                                        echo '<th>'.str_replace("Packaged Drinking Water - ","",$listrow['itemname']).'</th>';                                                        
                                                  }
                                                }
                                            ?>
                                                <!-- <th>250 ml</th>
                                                <th>500 ml</th>
                                                <th>500 ml(20)</th>
                                                <th>500 ml(30)</th>
                                                <th>500 ml(40)</th>
                                                <th>1000 ml Rly</th>
                                                <th>1000 ml</th>
                                                <th>1000 ml(50)</th>
                                                <th>2000 ml(30)</th>
                                                <th>2000 ml(35)</th>
                                                <th>5000 ml</th> -->
                                                <th>Sales By</th>
                                                <th>Truck</th>
                                                <th>Driver Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if((isset($_GET['st'])&&$_GET['st']!='')||(isset($_GET['end'])&&$_GET['end']!='')||(isset($_GET['custwise'])&&$_GET['custwise'])||(isset($_GET['pstatuswise'])&&$_GET['pstatuswise']!='')){ 
                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d', $timestamp);
                                                $custwise = $_GET['custwise'];
                                                $pstatuswise = $_GET['pstatuswise'];
                                                $sql = "SELECT * from (select * from invoices union select * from invoicesacc ) i,customerprofile c where 1=1  ";
                                                if($_GET['st']!=''){
                                                    if($st==$end){
                                                        $sql.= " and i.inv_date='$st' ";   
                                                    }else{
                                                        $sql.=" and (i.inv_date BETWEEN '$st' AND '$end') ";   
                                                    }
                                                }
                                                if(isset($_GET['custwise'])&&$_GET['custwise']!=''){
                                                    $sql.=" and i.inv_customer='".$_GET['custwise']."'";    
                                                }
                                                if(isset($_GET['pstatuswise'])&&$_GET['pstatuswise']!=''){
                                                    if($_GET['pstatuswise']=="Overdue"){
                                                        $sql.=" and (i.inv_payment_status='Unpaid' OR i.inv_payment_status='Partially Paid') and CURDATE()>DATE_ADD(i.inv_date, INTERVAL i.inv_payterm DAY) ";    
                                                    }else{
                                                        $sql.=" and i.inv_payment_status='".$_GET['pstatuswise']."'";    
                                                    }
                                                }
                                                $sql.=" and i.inv_customer=c.custid;";    

                                            }else{
                                                $sql = "SELECT * from (select * from invoices union select * from invoicesacc ) i,customerprofile c where i.inv_customer=c.custid;";    
                                            }
                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row = $result-> fetch_assoc()){
                                                    echo '<tr>
                                                    <td>'.$row['inv_code'].'</td>
                                                    <td>'.$row['inv_date'].'</td>
                                                    <td>'.$row['custname'].'</td>';

                                                    echo getSaleItemCountCols($row['inv_items'],$dbcon);
                                                    // if ($listresult->num_rows > 0){
                                                    //     echo "<td>".$listresult->num_rows."</td>";
                                                    //     while ($listrow = $listresult-> fetch_assoc()){
                                                    //        // print_r($listrow);
                                                    //           echo '<td>sasas</td>';
                                                    //          // echo '<td>'.getSaleItemCount($row['inv_items'],$listrow['id']).'</td>';
                                                        
                                                    //     }
                                                    // }
                                                    
                                                   echo '<td>'.$row['inv_owner'].'</td>
                                                    <td>'.$row['inv_truck_no'].'</td>
                                                    <td>'.$row['inv_driver_name'].'</td>
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
                                              
                                        <?php
                                            echo getSaleItemCountfootercols($dbcon);
                                        ?>
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
    var page_pstatuswise = "<?php if(isset($_GET['pstatuswise'])){ echo $_GET['pstatuswise']; } ?>";
    var items = <?php echo json_encode($itemVals) ?>;
    $(document).ready(function() {
        $('#custwise').val(page_custwise);
        $('#pstatuswise').val(page_pstatuswise);
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
        var status_var = $('#pstatuswise').val(); 
        var printhead = cust_var!=''?'<p><b>Customer : </b>'+cust_name+'</p>':'';
        printhead+= status_var!=''?'<p><b>Payment Status : </b>'+status_var+'</p>':'';
        printhead+= date_range!=''?'<p><b>Date : </b>'+date_range+'</p>':'';
        var excel_printhead = cust_var!=''?'Customer : '+cust_name:'';
        excel_printhead+= '  ';
        excel_printhead+= status_var!=''?'Payment Status : '+status_var:'';
        excel_printhead+= '  ';
        excel_printhead+= date_range!=''?'Date : '+date_range:'';
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
                

                for(var idx = 0; idx < items.length; idx++){
                   items[idx].sum = api.column( idx+3 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                   $( api.column( idx+3 ).footer() ).html(items[idx].sum);

                }

                console.log(items,'items');
                // var _250ml = api.column( 3 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _500ml = api.column( 4 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _500ml20 = api.column( 5 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _500ml30 = api.column( 6 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _500ml40 = api.column( 7 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _1000mlRly = api.column( 8 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _1000ml = api.column( 9 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _1000ml50 = api.column( 10 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _2000ml30 = api.column( 11 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _2000ml35 = api.column( 12 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // var _5000ml = api.column( 13 ).data().reduce( function (a, b) { return intVal(a) + intVal(b); }, 0 );
                // $( api.column( 0 ).footer() ).html('Total');
                // $( api.column( 3 ).footer() ).html(_250ml);
                // $( api.column( 4 ).footer() ).html(_500ml);
                // $( api.column( 5 ).footer() ).html(_500ml20);
                // $( api.column( 6 ).footer() ).html(_500ml30);
                // $( api.column( 7 ).footer() ).html(_500ml40);
                // $( api.column( 8 ).footer() ).html(_1000mlRly);
                // $( api.column( 9 ).footer() ).html(_1000ml);
                // $( api.column( 10 ).footer() ).html(_1000ml50);
                // $( api.column( 11 ).footer() ).html(_2000ml30);
                // $( api.column( 12 ).footer() ).html(_2000ml35);
                // $( api.column( 13 ).footer() ).html(_5000ml);
                
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
                            '<p><img src="<?php echo $baseurl;?>assets/images/dhirajLogo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Sales Itemwise</b><br/></p>'+printhead+'</div>'
                        );
                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Sales Itemwise Reports', footer: true ,
                    messageTop: excel_printhead   
                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Sales Itemwise Reports', footer: true ,
                    messageTop: excel_printhead   
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
    function get_custrec_reports(){
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
        var pstatuswise = $('#pstatuswise').val();
        location.href="salesItemwiseReport.php?st="+st+"&end="+end+"&custwise="+custwise+"&pstatuswise="+pstatuswise;
    }
    function cb(start, end) {
        $('#daterange').val(start+ ' - ' + end);
        $('#daterange').attr('readonly',true); 
        $("#reset-date").show();
    }
</script>
<?php include('footer.php'); ?>
