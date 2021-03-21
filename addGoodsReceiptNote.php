<?php
include("database/db_conection.php");//make connection here
include('header.php');?>
<!-- End Sidebar -->
<?php 
if(isset($_GET['grn_id']))
{
    $grn_id = $_GET['grn_id'];
    $action = $_GET['action'];
    $table = $_GET['type'];
}


?>
<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Goods Received Note</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a  href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Goods Received Note</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <!--div class="alert alert-success" role="alert">
<h4 class="alert-heading">Company Registrtion Form</h4>
<p></a></p>
</div-->


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
                            <h5><div class="text-muted font-light"><i class="fa fa-truck smallfonts" aria-hidden="true"></i>
                                &nbsp;Goods Received Note<span class="text-muted"></span></div></h5>

                            <div class="text-muted font-light">Record Goods Receipt</div>

                            <!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
</i>Add Transport Master Details
</h3-->


                        </div>

                        <div class="card-body">

                            <form id="add_grn_form" autocomplete="off" action="#">
                                <div class="form-row">
                                    <div class="invoice-title text-left mb-6">
                                        <h4 class="col-md-12 text-muted">Goods Received Details &nbsp;</h4>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <div class="invoice-title text-left mb-8">
                                            <label for="inputState">GRN Owner</label>
                                            <!--           <select id="grn_owner" readonly required class="form-control form-control-sm" name="grn_owner">
<option selected>Open Users</option>

</select>	-->
                                            <input type="text" class="form-control form-control-sm"  id="grn_owner" name="grn_owner" readonly class="form-control form-control-sm"  required />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                        <select id="grn_comp_code" class="form-control form-control-sm" name="grn_comp_code">
                                            <option selected>Open Company Code</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Vendor Name<span class="text-danger">*</span></label>
                                        <select id="grn_po_vendor" onchange="get_po_orders();" class="form-control form-control-sm" name="grn_po_vendor">
                                            <option selected>Open Vendor Code</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">	
                                        <label for="inputState">Purchase Order#<span class="text-danger">*</span></label>
                                        <select id="grn_po_code" onchange="update_grn_form(this.value);"  class="form-control form-control-sm" name="grn_po_code">
                                            <option selected>Open PO#</option>
                                        </select>	
                                        <!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                    </div>
                                    <div class="col-md-6 float-right text-right">
                                        <div class="form-group col-md-8">
                                            <div class="invoice-title text-left mb-6">
                                                <label for="inputState">Enter Invoice#<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" id="grn_invoice_no" name="grn_invoice_no" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">									
                                        <label>PO Date</label>
                                        <input type="date" class="form-control form-control-sm" id="grn_po_date" name="grn_po_date" autocomplete="off">
                                    </div>

                                    <div class="col-md-6 float-right text-right">
                                        <div class="form-group col-md-8">
                                            <div class="invoice-title text-left mb-6">
                                                <label>Invoice Date<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control form-control-sm" id="grn_invoice_date" name="grn_invoice_date" required autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="invoice-title text-left mb-6">
                                            <label for="inputState">Payment Term</label>
                                            <select id="grn_po_payterm" required class="form-control form-control-sm" name="grn_po_payterm">
                                                <option selected>Open Payment Term</option>

                                            </select>	
                                        </div>
                                    </div>

                                    <!--grn_po_shippingvia--->
                                    <div class="col-md-6 float-right text-right">
                                        <div class="form-group col-md-8">
                                            <div class="invoice-title text-left mb-6">
                                                <label for="inputState">Shipped Via<span class="text-danger">*</span></label>
                                                <input type="text" class="form-control form-control-sm" id="grn_po_shippingvia" name="grn_po_shippingvia" required autocomplete="off">

                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!--grn_po_deliveryat-->
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <div class="invoice-title text-left mb-6">
                                            <label for="inputState">Delivered At<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="grn_po_deliveryat" name="grn_po_deliveryat" required autocomplete="off">

                                        </div>
                                    </div>



                                    <div class="col-md-6 float-right text-right">
                                        <div class="form-group col-md-8">	
                                            <div class="invoice-title text-left mb-8">									
                                                <label>Delivered on<span class="text-danger">*</span></label>
                                                <input type="date" class="form-control form-control-sm" id="grn_delivery_on" name="grn_delivery_on" required autocomplete="off" value="<?php echo date("Y-m-d");?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                            <!--        <div class="form-group col-md-4">
                                        <div class="invoice-title text-left mb-6">
                                            <label for="inputState">Freight<span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" id="grn_freight" name="grn_freight" required autocomplete="off">
                                        </div>
                                    </div>-->
                                    <div class="form-group col-md-4">
                                        <div class="invoice-title text-left mb-6">
                                            <label for="inputState">Status</label>
                                            <select id="grn_status" class="form-control form-control-sm" required  name="grn_status">
                                                <option value="Recorded">Recorded</option>
                                                <option value="Approved">Approved</option>
                                                <option value="Cancelled">Cancelled</option>
                                            </select>											
                                        </div>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="invoice-title text-left mb-6">
                                        <h4 class="col-md-12 text-muted">Received Item 
                                            Details &nbsp;</h4>
                                    </div>
                                </div>


                                <!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->										
                                <table  class="table table-hover small-text" id="tb">
                                    <tr class="tr-header">
                                        <th width="20%">Item Details</th>
                                        <th width="12%">qtyordered</th>
                                        <th width="11%">Received Qty</th>
                                        <th width="12%">Unit</th>
                                        <th width="15%"><i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;Rate</th>
                                        <th width="15%" > <i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;Amount</th>
                                        <!-- <th width="8%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Discount</b></i></th>-->
                                        <th width="15%"> GST@%</th> 
                                        <!--th width="20%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Total</b></i></th-->
                                        <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
                                            <span class="fa fa-plus-circle"></span></a></th>

                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="itemcode" class="form-control itemcode" onchange="rowitem.set_itemrow(this,'purchase');" id="item_select">
                                                <option value="" name="itemcode" selected>Item Code</option>
                                                <?php $qr  = "select * from purchaseitemaster where status ='1' ;";
                                                $exc = mysqli_query($dbcon,$qr)or die();
                                                while($r = mysqli_fetch_array($exc)){ ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo "[".$r['itemcode']."] ".$r['itemname']; ?></option>
                                                <?php
                                                                                    }
                                                ?>
                                            </select>
                                        </td>

                                        <td><input id="qtyorded" type="text" name="qtyorded" placeholder="qtyorded"    data-id="" class="form-control hsncode" readonly></td>
                                        <td><input id="qty" type="text" name="qty" onkeypress="rowitem.update_math_vals();"   onkeyup="rowitem.update_math_vals();" placeholder="Qty" data-id="" class="form-control qty"></td>                                        <td>
                                        <select class="form-control amount" id="uom"  onchange="rowitem.update_math_vals();"; name="uom" style="line-height:1.5;">
                                            <option value="" selected>Open Unit</option>
                                            <?php 
                                            $sql = mysqli_query($dbcon, "SELECT * FROM uom ");
                                            while ($row = $sql->fetch_assoc()){	

                                                echo '<option  value="'.$row['code'].'">'.$row['description'].'</option>';
                                            }
                                            ?>
                                        </select>
                                        </td>
                                        <td><input id="price" type="text" name="price" placeholder="Rate/Qty" onkeypress="rowitem.update_math_vals();"   onkeyup="rowitem.update_math_vals();"   data-id="" class="form-control price"></td>
                                        <td><input id="amount" type="text" name="amount" placeholder="qtyXprice" data-id="" class="form-control amount"></td>
                                        <!-- <td><input type="text" name="discount[]" class="form-control discount" placeholder="Itm wise Disc"></td> -->
                                        <td>                       
                                            <select class="form-control amount" id="taxname"  onchange="rowitem.update_math_vals();"; name="taxname" style="line-height:1.5;">
                                                <option data-type="single" value="0" selected>Open Taxrate</option>
                                                <?php 

                                                $sql = mysqli_query($dbcon, "SELECT id,taxname,taxrate,taxtype FROM taxmaster ");
                                                while ($row = $sql->fetch_assoc()){	
                                                    $taxname=$row['taxname'];
                                                    $taxrate=$row['taxrate'];
                                                    $taxtype=$row['taxtype'];
                                                    $taxid=$row['id'];
                                                    echo '<option data-type="'.$taxtype.'"  data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </td>
                                        <!--td><input type="text" name="total[]" class="form-control total" data-id="" placeholder="Item Total"></td-->
                                        <td><a href='javascript:void(0);'  class='remove'><span class='fa fa-trash'></span><b></b></a></td>
                                    </tr>
                                </table>
                                <!---subtotal , dicount , tax etc-->
                                <hr>
                                <div class="row">
                                    <div class="col-md-7"></div>
                                    <div class="col-md-5">

                                        <div class="col-md-12">
                                            <div class="row"><div class="col-md-8"><p class="h6">Sub Total: </p></div>
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="posubtotal">--</span></div>	
                                            </div>

                                        </div>
                                        <div class="col-md-12" id="discountcol">
                                            <div class="row">
                                                <div class="col-md-8">

                                                    <div id="ember1600" class="input-group ember-view col-md-7" style="padding-left:0px;">
                                                        <input type="text" class="form-control text-right ember-text-field text-right ember-view" id="podiscount" style=".375rem .75rem;" onkeypress="rowitem.update_math_vals();"   onkeyup="rowitem.update_math_vals();" placeholder="Discount"> 
                                                        <!----> <div class="input-group-btn" style="width:20%;"><button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle discount-btn" data-meth="flat" id="discoutTypeTextbutton">
                                                        <span id="discoutTypeText">₹</span>  <span class="caret"></span></button> <ul class="dropdown-menu pull-right text-center" style="min-width:4rem;" id="discoutType">
                                                        <li onclick="rowitem.chgdiscount_type(this);" data-meth="percent"><a data-ember-action="" data-ember-action-1602="1602"  >%</a></li> 
                                                        <li onclick="rowitem.chgdiscount_type(this);"  data-meth="flat"><a data-ember-action="" data-ember-action-1603="1603" >₹</a></li></ul></div></div>
                                                </div>
                                                <div class="col-md-4 text-right">
                                                    <span style="font-weight:600;"  class="lead text-danger" id="podiscountText">--</span>
                                                </div>	

                                            </div> 
                                        </div>
                                        <div id="taxdiv"></div>
                                        <br/>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-8"><p class="h6">Grand Total(Round off): </p></div>
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="pograndtotal">--</span></div>	
                                            </div>

                                        </div>     
                                        <div class="col-md-12">										
                                            <div class="row">
                                                <div class="col-md-8">												
                                                    <div class="form-group col-8" style="padding-left:0px;">

                                                        <input class="form-control" onkeypress="rowitem.update_math_vals();"   onkeyup="rowitem.update_math_vals();" id="poadjustmentval" type="number" step="any" placeholder="Adjustment ">
                                                        <i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                           data-trigger="focus" data-placement="top" title="Add any other +ve or -ve charges that need to be appliedto adjust the total amount of the transaction Eg. +10 or -10."></i>
                                                    </div>

                                                </div>

                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="poadjustment">--</span></div>	


                                            </div>

                                        </div>  
                                        <div class="col-md-12">
                                            <div class="row"><div class="col-md-8"><p class="h6">Balance Due: </p></div>
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="pobaltotal">--</span></div>	
                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <hr>

                                <div class="form-row">
                                    <div class="invoice-title text-left mb-6">
                                        <h4 class="col-md-12 text-muted">Notes Information</h4>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <textarea rows="2" class="form-control" id="grn_notes" name="grn_notes"  required placeholder="add a Note"></textarea>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group text-right m-b-0">
                                        &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-primary" name="submit" type="submit">
                                        Submit
                                        </button>
                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">
                                            Cancel
                                        </button>
                                    </div>
                                </div>



                            </form>
                        </div>
                    </div>
                </div>



            </div>
            <!-- END container-fluid -->

        </div>
        <!-- END content -->

    </div>
    <!-- END content-page -->


    <?php include('footer.php');?>

    <!-- END Java Script for this page -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 

    <script>

        var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
        var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
        var page_grn_id = "<?php if(isset($_GET['grn_id'])){ echo $_GET['grn_id']; } ?>";
        var page_vendor = "<?php if(isset($_GET['vendor'])){ echo $_GET['vendor']; } ?>";
        var page_po_code = "<?php if(isset($_GET['po_code'])){ echo $_GET['po_code']; } ?>";

        var rowarray = [];

        $(function(){
            $('#addMore').on('click', function() {
                var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                data.find("input").val('');
            });
            $(document).on('click', '.remove', function() {
                var trIndex = $(this).closest("tr").index();
                if(trIndex>1) {
                    $(this).closest("tr").remove();
                    rowitem.update_math_vals('po');
                } else {
                    alert("Sorry!! Can't remove first row!");
                }

            });

            ////set select options
            var user_params = [];
            var vendor_params = [];
            var comp_params = [];
            var paymentterm_params = [];

            comp_params[0]={"primaryflag":"1"};  
            // Page.load_select_options('grn_owner',user_params,'userprofile','user','username',null);
            $('#grn_owner').val('<?php echo $session_user; ?>');
            Page.load_select_options('grn_comp_code',comp_params,'comprofile','Company Code','orgid','orgname');
            Page.load_select_options('grn_po_vendor',vendor_params,'vendorprofile','Vendor Code','vendorid','supname'); 
            Page.load_select_options('grn_po_payterm',paymentterm_params,'paymentterm','Payment  Term','noofdays','paymentterm');


            if(page_action=="edit"){
                $('#grn_po_vendor').val(page_vendor);
                var grn_data =  get_form_datum_grn_id(page_grn_id,page_table);
                set_grn_values(grn_data);
                if(grn_data.grn_po_code){
                    var po_data = get_po_values(grn_data.grn_po_code);
                    set_po_form_vals(po_data);
                }
                set_math_vals_grn(JSON.parse(grn_data.grn_po_items));
            }

            if(page_action=="add"){
                $('#grn_po_vendor').val(page_vendor);
                get_po_orders();
                $('#grn_po_code').val(page_po_code);
                var po_data = get_po_values(page_po_code);
                set_po_form_vals(po_data);
                set_math_vals_po(JSON.parse(po_data.po_items));
            }

            //            Page.load_select_options('po_shippingvia',shippingvia_params,'transportmaster','Shipping Via','transname',null);  

            //            Page.load_select_options('po_deliveryat',loction_params,'location','Deivery at','locname',null);
        });      

        function update_grn_form(po_code){
            var po_data = get_po_values(po_code);
            set_po_form_vals(po_data);
            set_math_vals_po(JSON.parse(po_data.po_items));
        }
        function set_grn_values(data){
            var purchaseorder_params = [];
            purchaseorder_params[0] = {po_vendor:$('#grn_po_vendor').val()};
            Page.load_select_options('grn_po_code',purchaseorder_params,'purchaseorders','PO Number','po_code',null);  
            $('#grn_comp_code').val(data.grn_comp_code);
            $('#grn_po_code').val(data.grn_po_code);
            $('#grn_invoice_no').val(data.grn_invoice_no);
            $('#grn_invoice_date').val(data.grn_invoice_date);
            $('#grn_notes').val(data.grn_notes);
            $('#grn_po_shippingvia').val(data.grn_po_shippingvia);
            $('#grn_po_deliveryat').val(data.grn_po_deliveryat);
            $('#grn_delivery_on').val(data.grn_delivery_on);
            $('#grn_status').val(data.grn_status);

            $('#grn_po_code').attr('disabled',true);

        }
        
        function get_form_datum_grn_id(page_grn_id,page_table){
            var grn_data = Page.get_edit_vals(page_grn_id,page_table,"grn_id");
            return grn_data;
        }

        function get_po_values(po){
            var edit_data = Page.get_edit_vals(po,'purchaseorders','po_code');
            return edit_data;
        }

        function set_po_form_vals(data){
            $('#grn_comp_code').val(data.po_comp_code);
            $('#grn_po_date').val(data.po_date);
            $('#grn_po_payterm').val(data.po_payterm);
            $('#grn_po_shippingvia').val(data.po_shippingvia);
            $('#grn_po_deliveryat').val(data.po_deliveryat);
        }

        function get_po_orders(){
            if($('#grn_po_vendor').val()!=''){
                var purchaseorder_params = [];
                purchaseorder_params[0] = {po_vendor:$('#grn_po_vendor').val()};
                purchaseorder_params[1] = {po_status:"Delivered"};
                Page.load_select_options('grn_po_code',purchaseorder_params,'purchaseorders','PO Number','po_code',null);  
            }

        }


        function set_math_vals_po(po_items_json){
            var itemrowCount = po_items_json.length;
            var rowCount = $('#tb tr').length;
            var totalamt = 0;

            for(r=0;r<itemrowCount;r++){

                if(r<itemrowCount-1){
                    var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                }

                $('#tb tr').eq(r+1).find('#item_select').val(po_items_json[r].itemcode);
                $('#tb tr').eq(r+1).find('#price').val(po_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#price').attr('data-price',po_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#qty').val(po_items_json[r].rwqty);
                $('#tb tr').eq(r+1).find('#qtyorded').val(po_items_json[r].rwqty);
                rowarray[r] = po_items_json[r].rwqty
                $('#tb tr').eq(r+1).find('#taxname').val(po_items_json[r].tax_id);
                $('#tb tr').eq(r+1).find('#taxname').attr('data-taxmethod',po_items_json[r].tax_method);
                $('#tb tr').eq(r+1).find('#uom').val(po_items_json[r].uom);
                totalamt+=$('#tb tr').eq(r+1).find('#price').val()*$('#tb tr').eq(r+1).find('#qty').val();


            }

            if(itemrowCount>0){
                var podiscount = po_items_json[0].podiscount;
                var poadjustmentval = po_items_json[0].poadjustmentval;    
                var podiscount_method = po_items_json[0].podiscount_method; 
                if(podiscount_method=='flat'){
                    $('#podiscount').val(podiscount);
                    $('#discoutTypeTextbutton #discoutTypeText').html('₹');
                    $('#discoutTypeTextbutton').attr('data-meth','flat');
                }else{
                    var tt = eval(podiscount/totalamt)*100;
                    $('#podiscount').val(tt);
                    $('#discoutTypeTextbutton #discoutTypeText').html('%');
                    $('#discoutTypeTextbutton').attr('data-meth','percent');
                }
                $('#poadjustmentval').val(poadjustmentval);

            }

            rowitem.update_math_vals();
        }

        function set_math_vals_grn(po_items_json){
            var itemrowCount = po_items_json.length;
            var rowCount = $('#tb tr').length;
            var totalamt = 0;

            for(r=0;r<itemrowCount;r++){

                if(r<itemrowCount-1){
                    var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                }

                $('#tb tr').eq(r+1).find('#item_select').val(po_items_json[r].itemcode);
                $('#tb tr').eq(r+1).find('#price').val(po_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#price').attr('data-price',po_items_json[r].tax_method==1?po_items_json[r].rwprice_org:po_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#qty').val(po_items_json[r].rwqty);
                rowarray[r] = po_items_json[r].rwqty;
                $('#tb tr').eq(r+1).find('#taxname').val(po_items_json[r].tax_id);
                $('#tb tr').eq(r+1).find('#taxname').attr('data-taxmethod',po_items_json[r].tax_method);
                $('#tb tr').eq(r+1).find('#uom').val(po_items_json[r].uom);

                totalamt+=$('#tb tr').eq(r+1).find('#price').val()*$('#tb tr').eq(r+1).find('#qty').val();

            }

            if(itemrowCount>0){
                var podiscount = po_items_json[0].podiscount;
                var poadjustmentval = po_items_json[0].poadjustmentval;    
                var podiscount_method = po_items_json[0].podiscount_method; 
                if(podiscount_method=='flat'){
                    $('#podiscount').val(podiscount);
                    $('#discoutTypeTextbutton #discoutTypeText').html('₹');
                    $('#discoutTypeTextbutton').attr('data-meth','flat');
                }else{
                    var tt = (eval(podiscount/totalamt)*100).toFixed(2);
                    $('#podiscount').val(tt);
                    $('#discoutTypeTextbutton #discoutTypeText').html('%');
                    $('#discoutTypeTextbutton').attr('data-meth','percent');
                }
                $('#poadjustmentval').val(poadjustmentval);

            }
            console.log(rowarray,"rowarray")

            rowitem.update_math_vals();
        }

        function chgdiscount_tupe(x){
            var discountMeth = $(x).attr('data-meth');
            if(discountMeth=="flat"){
                $('#discoutTypeTextbutton #discoutTypeText').html('₹');
                $('#discoutTypeTextbutton').attr('data-meth','flat');
            }else{
                $('#discoutTypeTextbutton #discoutTypeText').html('%');
                $('#discoutTypeTextbutton').attr('data-meth','percent');

            }
            rowitem.update_math_vals();

        }

        //save grn
        function formatDate() {
            var d = new Date(),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) month = '0' + month;
            if (day.length < 2) day = '0' + day;

            return [year, month, day].join('-');
        }

        $("form#add_grn_form").submit(function(e){
            e.preventDefault();
            if(page_action=="edit"){
                $('#grn_po_code').attr('disabled',false);
            }

            var rowCount = $('#tb tr').length;
            var grn_po_items = [];
            var  changed_item_select =[];
            var changed_row_qty = false
            for(i=1;i<rowCount;i++){ 
                console.log(i,"loop for submit")
                
                var item_select = $('#tb tr').eq(i).find('#item_select').val();
                var item_details = $('#tb tr').eq(i).find('#item_select option:selected').text();
                var hsncode = $('#tb tr').eq(i).find('#hsncode').val();
                var rwqty = $('#tb tr').eq(i).find('#qty').val();

                //code edited by jp for grn to invent report
               // console.log("current "+rwqty+" past"+rowarray[i-1])
                 if(rwqty != rowarray[i-1])
                 {
                     var item_code_row = {
                        itemcode :  item_select,
                        rwqty   : rowarray[i-1]
                      } ;
                      changed_item_select[i-1] = item_code_row
                      changed_row_qty = true
                 }

                var tax_id = $('#tb tr').eq(i).find('#taxname').val();
                var tax_val = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-rate');
                var tax_method = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');
                var rwprice = $('#tb tr').eq(i).find('#price').val();
                var rwprice_org = $('#tb tr').eq(i).find('#price').attr('data-price');
                var rwamt = $('#tb tr').eq(i).find('#amount').val();
                var uom = $('#tb tr').eq(i).find('#uom').val();
                var podiscount = $('#podiscountText').text();
                var poadjustmentval = $('#poadjustmentval').val();
                var podiscount_method = $('#discoutTypeTextbutton').attr('data-meth');
                var podiscount_value = $('#podiscount').val();
                var podiscount_value = $('#podiscount').val();
                var podiscount = 0;
                var subtotal = $('#posubtotal').text();
                subtotal = eval(subtotal).toFixed(2)
                if(podiscount_value!='')
                {
                    if(podiscount_method=="flat"){
                        podiscount = podiscount_value;
                    }else{
                        //alert(podiscount);
                        podiscount = subtotal*(podiscount_value/100);

                    }
                }
                
                var po_items_ele = {
                    itemdetails : item_details,
                    itemcode : item_select,
                    hsncode : hsncode,
                    rwqty : rwqty,
                    tax_val : tax_val,
                    tax_id : tax_id,
                    tax_type : tax_type,
                    tax_method : tax_method,
                    rwprice : rwprice,
                    rwprice_org : rwprice_org,
                    rwamt : rwamt,
                    podiscount : podiscount,
                    poadjustmentval:poadjustmentval,
                    podiscount_method:podiscount_method,
                    uom : uom
                };

                grn_po_items[i-1]=po_items_ele;

            }



            var $form = $("#add_grn_form");
            var data = getFormData($form);
            function getFormData($form){
                var unindexed_array= $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    if(n['name']=="hsncode"||n['name']=="qty"||n['name']=="unit"||n['name']=="price"||n['name']=="amount"||n['name']=="taxname"||n['name']=="uom"||n['name']=="po_owner"||n['name']=="qtyorded"||n['name']=="qty"||n['name']=="itemcode"){

                    }else{
                        indexed_array[n['name']] = n['value'];
                    }
                });

                return indexed_array;
            }

            data.table = "grn_notes";
            data.grn_po_items = JSON.stringify(grn_po_items);
            data.grn_po_value = $('#pobaltotal').text(); 
            data.grn_balance = $('#pobaltotal').text(); 
            data.grn_date = formatDate(); 
            if(page_action!="edit"){
                data.grn_payment_status = 'Unpaid'; 
            }
            if(data.grn_status=="Approved"){
                var aux_entry_param = {po_status:"Billed"};

            }else{
                var aux_entry_param = {po_status:"Delivered"};
            }

            if(page_action=="edit"){
                $('#grn_po_code').attr('disabled',false);
            }

            $.ajax ({
                url: 'workers/setters/save_grn.php',
                type: 'post',
                data: {
                    array     : JSON.stringify(data),
                    grn_id    : page_grn_id,
                    changed_row_qty : changed_row_qty,
                    changed_item_select : JSON.stringify(changed_item_select),
                    action    : page_action?page_action:"add",
                    table     : "grn_notes",
                    aux_entry : JSON.stringify(aux_entry_param),
                    aux_table : "purchaseorders",
                    aux_id    : data.grn_po_code,grn_items:JSON.stringify(data.grn_po_items)
                },
                dataType: 'json',
                success:function(response){
                    location.href="listGoodsReceiptNote.php";
                }


            });

        });
    </script>

    </body>
</html>