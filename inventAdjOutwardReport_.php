<?php
include('header.php');
include('workers/getters/functions.php');
include('generic_modal.php');

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
                        <h1 class="main-title float-left">Inventory Adjustment(Outward) Log Report</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Inventory Adjustment(Outward) Log Report</li>
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


                            <h3><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i><b>&nbsp;Inventory Adjustment(Inward) Log Report </b></h3>
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
                                
                                <div class="col-sm-3">
                                    <button type="button" class="btn btn-primary btn-sm" onclick="get_po_reports();">Run Report</button>
                                </div>
                            </div>


                        <div class="card-body">
                            <!-- Start coding here -->
                            <div class="row">
                                <div class="col-md-12">
                                    <span id="outward_log_report_div"></span>
                                    <table id="outward_log_report" class="table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>Item Code</th>												
                                                <th>Item Name</th>
                                                <th>Qty on Hand Before Adjusted</th>
                                                <th>Qty Adjusted</th>
                                                <th>Qty On Hand</th>	
                                                <th>UOM</th>
                                                <th>Adjusted/Added On</th>
                                                <th>Handler</th>
                                                <th>Notes</th>											
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "";
                                                if((isset($_GET['st'])&&$_GET['st']!='')||(isset($_GET['end'])&&$_GET['end']!=''))
                                                   //||(isset($_GET['vendorwise'])&&$_GET['vendorwise'])||
                                                   //(isset($_GET['pstatuswise'])&&$_GET['pstatuswise']!=''))
                                                {
                                                $timestamp = strtotime($_GET['st']);
                                                $st = date('Y-m-d', $timestamp);
                                                $timestamp = strtotime($_GET['end']);
                                                $end = date('Y-m-d', $timestamp);
                                               // $vendorwise = $_GET['vendorwise'];
                                                //$pstatuswise = $_GET['pstatuswise'];

                                               // $sql = "SELECT * from purchaseitemlog where 1=1";
                                                $sql = "SELECT itemcode,itemname,qtyadjusted,qtyonhand,uom,adjustedon,handler,notes,id FROM salesitemlognew where";   


                                                if($_GET['st']!=''){
                                                    if($st==$end){
                                                        $sql.= " adjustedon='$st' ORDER BY id DESC ;";   
                                                    }else{
                                                        $sql.=" (adjustedon BETWEEN '$st' AND '$end') ORDER BY id DESC ;";   
                                                    }
                                                          
                                                }
                                                }
                                                else{
                                                    $sql = "SELECT itemcode,itemname,qtyadjusted,qtyonhand,uom,adjustedon,handler,notes,id FROM salesitemlognew ORDER BY id DESC ;";   
                                                }
                                                //echo $sql; 

                                            
                                            $result = mysqli_query($dbcon,$sql);
                                            //echo $result;
                                            if ($result->num_rows > 0){
                                                while ($row =$result-> fetch_assoc()){
                                                    echo '<tr>';
                                                    echo '<td>' .$row['itemcode'] . '</td>';
                                                    echo '<td>'.$row['itemname'].' </td>';
                                                    echo '<td>'.($row['qtyadjusted']< 0 ? $row['qtyonhand']-$row['qtyadjusted'] :$row['qtyonhand']-$row['qtyadjusted']).' </td>';
                                                    echo '<td>'.$row['qtyadjusted'].' </td>';
                                                    echo '<td>'.$row['qtyonhand'].' </td>';
                                                    echo '<td>'.$row['uom'].' </td>';
                                                    echo '<td>'.$row['adjustedon'].' </td>';
                                                   // echo '<td>'.$row['handler']*$row['taxableprice'].' </td>';

                                                    echo '<td>'.$row['handler'].' </td>';													
                                                    echo '<td>'.$row['notes'].' </td>';
                                                   // echo '<td>'.$row['qtyonhand']-$row['qtyadjusted'].' </td>';
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

    //var page_custwise = "<?php if(isset($_GET['custwise'])){ echo $_GET['custwise']; } ?>";
    var page_st = "<?php if(isset($_GET['st'])){ echo $_GET['st']; } ?>";
    var page_end = "<?php if(isset($_GET['end'])){ echo $_GET['end']; } ?>";
    //var page_pstatuswise = "<?php if(isset($_GET['pstatuswise'])){ echo $_GET['pstatuswise']; } ?>";

    $(document).ready(function() {
        //$("#reset-date").hide();

		var date_range = $('#daterange').val(); 
		var printhead = '';
		
         //$('#custwise').val(page_custwise);
        //$('#pstatuswise').val(page_pstatuswise);
        //printhead = 'Inventory Adjustment(Outward) Log Report';
		printhead+= date_range!=''?'<p><b>Date : </b>'+date_range+'</p>':'';

        var excel_printhead = 'Inventory Adjustment(Outward) Log Report';
        var table = $('#outward_log_report').DataTable( {
            lengthChange: false,
            "order": [[ 0, "desc" ]],
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


              // Comented by Saravanakumar  $( api.column( 0 ).footer() ).html('Total');
              // Comented by Saravanakumar $( api.column( 6 ).footer() ).html(grossval);
              
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
                            '<p><img src="<?php echo $baseurl;?>assets/images/dhirajLogo.png" style="width:50px;height:50px;" /></p><p class="lead text-center"><b>Inventory Adjustment(Outward) Log Report</b><br/></p>'+printhead+'</div>'
                        );

                        $(win.document.body).find( 'table' )
                            .addClass( 'compact' )
                            .css( 'font-size', 'inherit' );
                    }
                }, 
                {
                    extend: 'excel',
                    text:'<span class="fa fa-file-excel-o"></span>',
                    title:'Inventory Adjustment(Outward) Log Report', footer: true,
                    messageTop: ''   

                },
                {
                    extend: 'pdf',
                    text:'<span class="fa fa-file-pdf-o"></span>',
                    title:'Inventory Adjustment(Outward) Log Report', footer: true,
                    messageTop: ''   

                },
                {
                    extend: 'colvis',
                    text:'Show/Hide', footer: true 
                }
            ]
        } );


        table.buttons().container()
            .appendTo( '#outward_log_report_div');


    });
    
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
            alert("Reset")
            $('#daterange').val('');
            $('#daterange').attr('readonly',false); 
            $("#reset-date").hide();
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

       // var vendorwise = $('#vendorwise').val();
       // var pstatuswise = $('#pstatuswise').val();
        location.href="inventAdjOutwardReport.php?st="+st+"&end="+end;/*+"&vendorwise="+vendorwise+"&pstatuswise="+pstatuswise;*/

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
