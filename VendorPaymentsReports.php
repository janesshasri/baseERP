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
                        <h1 class="main-title float-left"> Vendor Payments Made Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Vendor Payments Made Reprot</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Vendor Payments Made Report </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-1 col-form-label">Date </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control-sm" id="daterange" >
                                </div>
                                <div class="form-group col-md-3">
                                    <select id="vendorwise" class="form-control form-control-sm" name="vendorwise" placeholder="Select Date Range">
                                        <option selected>Open Vendor Code</option>
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
                                                <th>Payment ID</th>
                                                <th>Iinvoice#</th>
                                                <th>Paid On</th>
                                                <th>Vendor</th>
                                                <th>Tax</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if((isset($_GET['st'])&&$_GET['st']!='')||(isset($_GET['end'])&&$_GET['end']!='')||(isset($_GET['vendorwise'])&&$_GET['vendorwise'])){
                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d', $timestamp);
                                                $vendorwise = $_GET['vendorwise'];

                                                $sql = "SELECT * from payments p,vendorprofile v,grn_notes g where 1=1 ";
                                                if($_GET['st']!=''){
                                                    if($st==$end){
                                                        $sql.= " and p.payment_date='$st' ";   
                                                    }else{
                                                        $sql.=" and (p.payment_date BETWEEN '$st' AND '$end') ";   
                                                    }
                                                }
                                                if(isset($_GET['vendorwise'])&&$_GET['vendorwise']!=''){
                                                    // echo $_GET['vendorwise'];
                                                    $sql.=" and g.grn_po_vendor='".$_GET['vendorwise']."'";    
                                                }

                                                $sql.=" and p.payment_vendor=v.vendorid and p.payment_invoice_no=g.grn_invoice_no"; 

                                            }else{
                                                $sql = "SELECT * from payments p,vendorprofile v,grn_notes g where p.payment_vendor=v.vendorid and p.payment_invoice_no=g.grn_invoice_no;";    
                                            }

                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    $grn_po_items_arr = json_decode($row['grn_po_items']);
                                                    echo '                           <tr>
                                                <td>'.$row['payment_id'].'</td>
                                                <td>'.$row['payment_invoice_no'].'</td>
                                                <td>'.$row['payment_date'].'</td>
                                                <td>'.$row['supname'].'</td>
                                                <td>'.nf((get_total($grn_po_items_arr))-nf(get_total_notax($grn_po_items_arr))).'</td>
                                                <td>'.nf($row['payment_amount']).'</td>
                                                <td><a class="btn btn-light btn-sm hidden-md" 
                                                onclick="printContent(this);" 
                                                data-img="assets/images/logo.png" 
                                                data-code="'.$row['payment_id'].'"  
                                                data-id="po_print">
                                                <i class="fa fa-print" aria-hidden="true"></i></td>
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
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div><!-- end card-->
                    <div id="po_print" style="display:;">


</div>
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


    $(document).ready(function() {
        var vendor_params =[];
        Page.load_select_options('vendorwise',vendor_params,'vendorprofile','Vendor Code','vendorid','supname');
        $('#vendorwise').val(page_vendorwise);
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
        var vendor_var = $('#vendorwise').val(); 
        var vendor_name_json = Page.get_edit_vals(vendor_var,"vendorprofile","vendorid");
        var vendor_name = vendor_name_json.supname;
        var printhead = vendor_var!=''?'<p><b>Vendor : </b>'+vendor_name+'</p>':'';
        printhead+= date_range!=''?'<p><b>Date : </b>'+date_range+'</p>':'';
        var excel_printhead = vendor_var!=''?'Vendor : '+vendor_name:'';
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
                var grossval = api
                .column( 5 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);


                $( api.column( 0 ).footer() ).html('Total');
                $( api.column( 5 ).footer() ).html(grossval);
                //   $( api.column( 5 ).footer() ).html(taxamt);
                //   $( api.column( 7 ).footer() ).html(netval);
                //  $( api.column( 8 ).footer() ).html(bal);

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
                            '<p><img src="<?php echo $baseurl?>assets/images/dhirajLogo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Vendor Payments</b><br/></p>'+printhead+'</div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Vendor Payments', footer: true ,
                    messageTop: excel_printhead   

                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Vendor Payments', footer: true ,
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
        location.href="VendorPaymentsReports.php?st="+st+"&end="+end+"&vendorwise="+vendorwise;

    }


    function cb(start, end) {
        $('#daterange').val(start+ ' - ' + end);
        $('#daterange').attr('readonly',true); 
        $("#reset-date").show();
    }

    $('#po_print').hide();

function get_print_html(payment_id,img){
    $.ajax ({
        url: 'assets/payment_print_html.php',
        type: 'post',
        async :false,
        data: {
            payment_id:payment_id,
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
<?php
include('footer.php');
?>
