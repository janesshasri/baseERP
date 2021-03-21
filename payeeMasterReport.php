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
                        <h1 class="main-title float-left">Payee Master Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Payee Master Reprot</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Payee Master Report </b></h3>
                        </div>

                        <div class="card-body">
                            <div class="form-group row">
                                <label for="staticEmail" class="col-sm-1 col-form-label">Date </label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control-sm" id="daterange" >
                                    <span class="input-group-btn">
                                        <button class="btn btn-default" id="reset-date">
                                            <i class="fa fa-times"></i>
                                        </button>
                                    </span>
                                </div>
                                <div class="form-group col-md-3">
                                    <select id="partywise" class="form-control form-control-sm" name="partywise">
                                        <option value=''>--Select Payeename--</option>
                                        <?php
                                        $sql = mysqli_query($dbcon,"SELECT * FROM payeemaster");
                                        while ($row = $sql->fetch_assoc()){	
                                            $partyname=$row['payeename'];
                                            echo '<option  value="'.$partyname.'" >'.$partyname.'</option>';

                                        }
                                        ?>
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
                                                <th>Payee ID</th>
                                                <th> Payee Name</th>
                                                <th> payeetype</th>
                                                <th> Mobile</th>
                                                <th> Balance Due</th>
                                                <th> Place</th>
												<th> Created On</th>
                                                <th> Created By</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if((isset($_GET['st'])&&$_GET['st']!='')||(isset($_GET['end'])&&$_GET['end']!='')||(isset($_GET['partywise'])&&$_GET['partywise'])){
                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d', $timestamp);
                                                $partywise = $_GET['partywise'];

                                                $sql = "SELECT * from payeemaster p where 1=1 ";
                                                if($_GET['st']!=''){
                                                    if($st==$end){
                                                        $sql.= " and p.createdon ='$st' ";   
                                                    }else{
                                                        $sql.=" and (p.created BETWEEN '$st' AND '$end') ";   
                                                    }
                                                }
                                                if(isset($_GET['partywise'])&&$_GET['partywise']!=''){
                                                    // echo $_GET['vendorwise'];
                                                    $sql.=" and p.payeename='".$_GET['partywise']."'";    
                                                }

                                                $sql.=" ;"; 

                                            }else{
                                                $sql = "SELECT * from payeemaster ;";    
                                            }

                                            $result = mysqli_query($dbcon,$sql);
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    echo '                           <tr>
                                                <td>'.$row['payeeid'].'</td>
                                                <td>'.$row['payeename'].'</td>
												<td>'.$row['payeetype'].'</td>
												<td>'.$row['mobile'].'</td>
                                                <td>'.$row['amount'].'</td>
                                                <td>'.$row['location'].'</td>
                                                <td>'.$row['createdon'].'</td>
                                                <td>'.$row['createdby'].'</td>
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
    var page_partywise = "<?php if(isset($_GET['partywise'])){ echo $_GET['partywise']; } ?>";
    var page_st = "<?php if(isset($_GET['st'])){ echo $_GET['st']; } ?>";
    var page_end = "<?php if(isset($_GET['end'])){ echo $_GET['end']; } ?>";


    $(document).ready(function() {
        $('#partywise').val(page_partywise);
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
        var party_var = $('#partywise').val(); 
        var printhead = party_var!=''?'<p><b>Vendor : </b>'+party_var+'</p>':'';
        printhead+= date_range!=''?'<p><b>Date : </b>'+date_range+'</p>':'';
        var excel_printhead = party_var!=''?'Vendor : '+party_var:'';
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
                .column( 4 )
                .data()
                .reduce( function (a, b) {
                    return intVal(a) + intVal(b);
                }, 0 ).toFixed(2);


                $( api.column( 0 ).footer() ).html('Total');
                $( api.column( 4 ).footer() ).html(grossval);
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
                            '<p><img src="<?php echo $baseurl;?>assets/images/logo/logo@0,25x.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Payee Transactions</b><br/></p>'+printhead+'</div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Payment Transactions', footer: true ,
                    messageTop: excel_printhead   

                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Payment Transactions', footer: true ,
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

        var partywise = $('#partywise').val();
        location.href="payeeMasterReport.php?st="+st+"&end="+end+"&partywise="+partywise;

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
