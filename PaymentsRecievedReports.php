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
                        <h1 class="main-title float-left"> Customer Payments Received Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Customer Payments Received Reprot</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Customer Payments Received Report </b></h3>
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
                                <div class="col-sm-2">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="get_cp_reports();">Run Report</button>
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
                                                <th>Recipt ID</th>
                                                <th>Invoice#</th>
                                                <th>Received On</th>
                                                <th>Customer</th>
                                                <th>Tax</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if((isset($_GET['st'])&&$_GET['st']!='')||(isset($_GET['end'])&&$_GET['end']!='')||(isset($_GET['custwise'])&&$_GET['custwise'])){ 

                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d', $timestamp);
                                                $custwise = $_GET['custwise'];

                                             echo   $sql = "SELECT * from customer_payments cp,customerprofile c,invoices i where 1=1 ";
                                                if($_GET['st']!=''){
                                                    if($st==$end){
                                                        $sql.= " and cp.cust_payment_date='$st' ";   
                                                    }else{
                                                        $sql.=" and (cp.cust_payment_date BETWEEN '$st' AND '$end') ";   
                                                    }
                                                }

                                                if(isset($_GET['custwise'])&&$_GET['custwise']!=''){
                                                    // echo $_GET['vendorwise'];
                                                    $sql.=" and cp.cust_payment_customer='".$_GET['custwise']."'";    
                                                }

                                                $sql.=" and cp.cust_payment_customer=c.custid and i.inv_code=cp.cust_payment_invoice_no;";    

                                            }else{
                                                $sql = "SELECT * from customer_payments cp,customerprofile c,invoices i where cp.cust_payment_customer=c.custid and i.inv_code=cp.cust_payment_invoice_no;";    
                                            }

                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    $inv_items_arr = json_decode($row['inv_items']);

                                                    echo '                           <tr>
                                                <td>'.$row['cust_payment_id'].'</td>
                                                <td>'.$row['cust_payment_invoice_no'].'</td>
                                                <td>'.$row['cust_payment_date'].'</td>
                                                <td>'.$row['custname'].'</td>
                                                <td>'.nf((get_total($inv_items_arr))-nf(get_total_notax($inv_items_arr))).'</td>
                                                <td>'.nf($row['cust_payment_amount']).'</td>
                                                <td><a class="btn btn-light btn-sm hidden-md" 
                                                onclick="printContent(this);"  
                                                data-code="'.$row['cust_payment_id'].'"
                                                  data-id="po_print">
                                                <i class="fa fa-print" aria-hidden="true"></i></a></td>
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
    var page_custwise = "<?php if(isset($_GET['custwise'])){ echo $_GET['custwise']; } ?>";
    var page_st = "<?php if(isset($_GET['st'])){ echo $_GET['st']; } ?>";
    var page_end = "<?php if(isset($_GET['end'])){ echo $_GET['end']; } ?>";

    $(document).ready(function() {
        var vendor_params =[];
        Page.load_select_options('custwise',vendor_params,'customerprofile',' Customer','custid','custname');
        $('#custwise').val(page_custwise);
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
        var printhead = cust_var!=''?'<p><b>Customer : </b>'+cust_name+'</p>':'';
        printhead+= date_range!=''?'<p><b>Date : </b>'+date_range+'</p>':'';
        var excel_printhead = cust_var!=''?'Customer : '+cust_name:'';
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

                var taxgrossval = api
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);




                $( api.column( 0 ).footer() ).html('Total');
                $( api.column( 5 ).footer() ).html(grossval);
                $( api.column( 4 ).footer() ).html(taxgrossval);
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
                            '<p><img src="<?php echo $baseurl;?>assets/images/crystalLogo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Payments Received</b><br/></p>'+printhead+'</div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Customer Payments', footer: true ,
                    messageTop: excel_printhead   

                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Customer Payments', footer: true ,
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

            table
            .order( [ 2, 'desc' ] )
            .draw();
    });

    function get_cp_reports(){
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
        location.href="PaymentsRecievedReports.php?st="+st+"&end="+end+"&custwise="+custwise;
    }

    function cb(start, end) {
        $('#daterange').val(start+ ' - ' + end);
        $('#daterange').attr('readonly',true); 
        $("#reset-date").show();
    }

    $('#po_print').hide();

function get_print_html(cust_payment_id,img){
    $.ajax ({
        url: 'assets/customer_payment_print.php',
        type: 'post',
        async :false,
        data: {
            cust_payment_id:cust_payment_id,
            type: 'auto'
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
