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

function getAmtvalwithtax($item){
    if($item->tax_method==0){
        $amt= ($item->rwprice + $item->rwamt*($item->tax_val/100));
    }else{
        $amt= ($item->rwqty*$item->rwprice_org);
    }
    return $amt;
}

function getTaxval($item){
    if($item->tax_method==0){
        $ttax= $item->rwamt*($item->tax_val/100);
    }else{
        $ttax= ($item->rwqty*$item->rwprice_org)*(100/($item->tax_val+100))*($item->tax_val/100);
    }
    return $ttax;
}

function getGrossAmt($item){
    if($item->tax_method==0){
        $amt= ($item->rwqty*$item->rwprice_org);
    }else{
        $amt= ($item->rwqty*$item->rwprice_org)*(100/($item->tax_val+100));
    }
    return $amt;
}

function getItemRows($row,$items){
    $cols = '';
   for($i=0;$i<count($items);$i++){
    $cols.= '<tr>';
    $cols.= '<td>'.$row['grn_id'].'</td>';
    $cols.= '<td>'.$row['grn_po_code'].'</td>';
    $cols.= '<td></td>';
    $cols.= '<td>'.$row['grn_date'].'</td>';
    $cols.= '<td>'.$row['supname'].'</td>';
    $cols.= '<td>'.$items[$i]->itemdetails.'</td>';
    $cols.= '<td>'.$items[$i]->rwqty.'</td>';
    $cols.= '<td>'.$items[$i]->rwprice.'</td>';
    $cols.= '<td>'.nf(getGrossAmt($items[$i])).'</td>';
    $cols.= '<td>'.nf(getTaxval($items[$i])).'</td>';
    $cols.= '<td>'.nf(getAmtvalwithtax($items[$i])).'</td>';
    $cols.= '</tr>';
   }

   return $cols;
}
?>

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">

            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left"> Vendor ItemWise Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Vendor ItemWise Report</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Vendor ItemWise Report </b></h3>
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

                                <div class="form-group col-md-3">
                                    <select id="vendorwise" class="form-control form-control-sm" name="vendorwise">
                                        <option selected>Open Vendor Code</option>
                                    </select>

                                </div>

                                <div class="form-group col-md-3">
                                    <select id="pstatuswise" class="form-control form-control-sm" name="pstatuswise">
                                        <option value="" selected>Open Payment Status</option>
                                        <option value="Unpaid">Unpaid</option>
                                        <option value="Partially Paid">Partially Paid</option>
                                        <option value="Overdue">Overdue</option>
                                        <option value="Paid">Paid</option>
                                    </select>

                                </div>

                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="get_po_reports();">Run Report</button>
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
                                                <th>GRN#</th>
                                                <th>PO#</th>
                                                <th>Bill#</th>
                                                <th>GRN Date</th>
                                                <th>Vendor</th>
                                                <th>Item Details</th>
                                                <th>Qty</th>
                                                <th>Price</th>
                                                <th>Gross Amt</th>
                                                <th>Tax</th>
                                                <th>Net Amt</th>
                                  
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if((isset($_GET['st'])&&$_GET['st']!='')||(isset($_GET['end'])&&$_GET['end']!='')||(isset($_GET['vendorwise'])&&$_GET['vendorwise'])||(isset($_GET['pstatuswise'])&&$_GET['pstatuswise']!='')){
                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d', $timestamp);
                                                $vendorwise = $_GET['vendorwise'];
                                                $pstatuswise = $_GET['pstatuswise'];

                                                $sql = "SELECT * from grn_notes g,vendorprofile v where 1=1 ";
                                                if($_GET['st']!=''){
                                                    if($st==$end){
                                                        $sql.= " and grn_date='$st' ";   
                                                    }else{
                                                        $sql.=" and (grn_date BETWEEN '$st' AND '$end') ";   
                                                    }
                                                }


                                                if(isset($_GET['vendorwise'])&&$_GET['vendorwise']!=''){
                                                    // echo $_GET['vendorwise'];
                                                    $sql.=" and g.grn_po_vendor='".$_GET['vendorwise']."'";    
                                                }
                                                if(isset($_GET['pstatuswise'])&&$_GET['pstatuswise']!=''){
                                                    //echo $_GET['pstatuswise'];
                                                    if($_GET['pstatuswise']=="Overdue"){
                                                        $sql.=" and (g.grn_payment_status='Unpaid' OR g.grn_payment_status='Partially Paid') and CURDATE()>DATE_ADD(g.grn_date, INTERVAL g.grn_po_payterm DAY) ";    
                                                    }else{
                                                        $sql.=" and g.grn_payment_status='".$_GET['pstatuswise']."'";    
                                                    }
                                                }
                                                $sql.=" and g.grn_po_vendor=v.vendorid and g.grn_balance>0;";    

                                            }else{
                                                $sql = "SELECT * from grn_notes g,vendorprofile v where g.grn_po_vendor=v.vendorid and g.grn_balance>0;";    
                                            }

                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                $grn_po_items_arr = json_decode($row['grn_po_items']);

                                                echo getItemRows($row,$grn_po_items_arr);

                                            //         echo ' <tr>
                                            //     <td>'.$row['grn_id'].'</td>
                                            //     <td>'.$row['grn_po_code'].'</td>
                                            //     <td>'.$row['grn_invoice_no'].'</td>
                                            //     <td>'.$row['grn_date'].'</td>
                                            //     <td>'.$row['supname'].'</td>
                                            //     <td>'.nf(get_total_notax($grn_po_items_arr)).'</td>
                                            //     <td>'.nf((get_total($grn_po_items_arr))-nf(get_total_notax($grn_po_items_arr))).'</td>
                                            //     <td>'.nf(get_total($grn_po_items_arr)).'</td>
                                            //     <td>'.nf((get_total($grn_po_items_arr))-$row['grn_balance']).'</td>
                                            //     <td>'.nf($row['grn_balance']).'</td>
                                            //     <td> <a class="btn btn-default" onclick="ToPrint(this);" 
                                            //      data-img="assets/images/logo.png" data-id="po_print" data-code="'.$row['grn_id'].'">
                                            //      <i class="fa fa-print" 
                                            //      aria-hidden="true"></i></a></td>
                                            // </tr>';  
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
    var page_vendorwise = "<?php if(isset($_GET['vendorwise'])){ echo $_GET['vendorwise']; } ?>";
    var page_st = "<?php if(isset($_GET['st'])){ echo $_GET['st']; } ?>";
    var page_end = "<?php if(isset($_GET['end'])){ echo $_GET['end']; } ?>";
    var page_pstatuswise = "<?php if(isset($_GET['pstatuswise'])){ echo $_GET['pstatuswise']; } ?>";

    function show_line_items(x){
        var grn_l_id = encodeURI($(x).attr('data-id'));

        $.ajax ({
            url: 'workers/getters/get_line_items_view.php?id='+grn_l_id,
            type: 'GET',
            async :false,
            success:function(x){
                var out = JSON.parse(x);
                if(out.status){
                    $('#genModal .modal-body').html(out.list);
                    $('#genModal .modal-title').html("GRN Items");
                }
            }

        });

        $('#genModal').modal('show');
    }

    $(document).ready(function() {
        var vendor_params =[];
        Page.load_select_options('vendorwise',vendor_params,'vendorprofile','Vendor Code','vendorid','supname');
        $('#vendorwise').val(page_vendorwise);
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
            },

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
        var vendor_var = $('#vendorwise').val(); 
        var vendor_name_json = Page.get_edit_vals(vendor_var,"vendorprofile","vendorid");
        var vendor_name = vendor_name_json.supname;
        var pstatus_var = $('#pstatuswise').val(); 
        var printhead = vendor_var!=''?'<p><b>Vendor : </b>'+vendor_name+'</p>':'';
        printhead+= pstatus_var!=''?'<p><b>Payment Status : </b>'+pstatus_var+'</p>':'';
        printhead+= date_range!=''?'<p><b>Date : </b>'+date_range+'</p>':'';
        var excel_printhead = vendor_var!=''?'Vendor : '+vendor_name:'';
        excel_printhead+= '  ';
        excel_printhead+= pstatus_var!=''?'Payment Status : '+pstatus_var:'';
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
                // var grossval = api
                // .column( 6 )
                // .data()
                // .reduce( function (a, b) {
                //     return intVal(a) + intVal(b);
                // }, 0 ).toFixed(2);

                // var taxamt = api
                // .column( 5 )
                // .data()
                // .reduce( function (a, b) {
                //     return intVal(a) + intVal(b);
                // }, 0 ).toFixed(2);

                // var netval = api
                // .column( 7 )
                // .data()
                // .reduce( function (a, b) {
                //     return intVal(a) + intVal(b);
                // }, 0 ).toFixed(2);

                // var amtpaid = api
                // .column( 8 )
                // .data()
                // .reduce( function (a, b) {
                //     return intVal(a) + intVal(b);
                // }, 0 ).toFixed(2);

                // var bal = api
                // .column( 9 )
                // .data()
                // .reduce( function (a, b) {
                //     return intVal(a) + intVal(b);
                // }, 0 ).toFixed(2);


                // $( api.column( 0 ).footer() ).html('Total');
                // $( api.column( 6 ).footer() ).html(grossval);
                // $( api.column( 5 ).footer() ).html(taxamt);
                // $( api.column( 7 ).footer() ).html(netval);
                // $( api.column( 8 ).footer() ).html(amtpaid);
                // $( api.column( 9 ).footer() ).html(bal);

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
                            '<p><img src="<?php echo $baseurl?>assets/images/logo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Vendor Payables</b><br/></p>'+printhead+'</div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Vendor Item Wise Reoprt', footer: true,
                    messageTop: excel_printhead   

                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Vendor Item Wise Reoprt', footer: true,
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

    function get_po_reports(){
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
        location.href="VendorItemWise.php?st="+st+"&end="+end+"&vendorwise="+vendorwise+"&pstatuswise="+pstatuswise;

    }
    function cb(start, end) {
        $('#daterange').val(start+ ' - ' + end);
        $('#daterange').attr('readonly',true); 
        $("#reset-date").show();
    }


    function ToPrint(el){
                        var code= $(el).attr('data-code');
                        window.location.href = 'assets/grn_print_html.php?grn_id='+code;

                     }


</script>
<?php
include('footer.php');
?>
