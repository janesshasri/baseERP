<?php 
include('header.php');
?>

<!-- End Sidebar -->
<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Cash Memo/Retail Invoice</h1>
                        <ol class="breadcrumb float-right">
                            <li><a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                            <li class="breadcrumb-item active">Cash Memo/Retail Invoice</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
                            <div class="text-muted font-light"><h5><i class="fa fa-file-text-o bigfonts" aria-hidden="true"></i><b>&nbsp;Retail Invoice</b><span class="text-muted"></span></h5></div>

                            <div class="text-muted font-light">New Retail Invoice</div>

                        </div>

                        <div class="card-body">

                            <form id="add_cashmem_form" autocomplete="off" action="#">

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Sales Person</label>
                                        <input type="text" class="form-control form-control-sm"  id="inv_owner" name="inv_owner" readonly class="form-control form-control-sm"  required />

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                        <select id="inv_comp_code"  class="form-control form-control-sm" name="inv_comp_code">
                                            <option selected>--Select Company--</option>
                                            <?php
                                            $sql = mysqli_query($dbcon,"SELECT * FROM comprofile");
                                            while ($row = $sql->fetch_assoc()){	
                                                $orgid=$row['orgid'];
                                                $orgname=$row['orgname'];
                                                echo '<option  value="'.$orgid.'" >'.$orgid.' '.$orgname.'</option>';

                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState"><span class="text-danger">Customer Name*</span></label>
                                        <select id="inv_customer" class="form-control form-control-sm" name="inv_customer">
                                            <option selected>--Select Customer--</option>
                                            <?php
                                            $sql = mysqli_query($dbcon,"SELECT * FROM customerprofile");
                                            while ($row = $sql->fetch_assoc()){	
                                                $custid=$row['custid'];
                                                $custname=$row['custname'];
                                                echo '<option  value="'.$custid.'" >'.$custname.' - '.$custid.'</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState"><span class="text-danger">Phone</span></label>
                                        <input type="text" placeholder="Mobile#" name="inv_cust_ref_phno" id="inv_cust_ref_phno" class="form-control form-control-sm"> 

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">									
                                        <label>Sales Receipt Date<span class="text-danger"></span><span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="inv_date" name="inv_date" value="<?php echo date("Y-m-d");?>" required autocomplete="off">
                                    </div>
                                    <!--
<div class="form-group col-md-4">									
<label>Sales Receipt#<span class="text-danger"></span><span class="text-danger">*</span></label>
<input type="text" placeholder="INV-000001" name="inv_receipt_no" id="inv_receipt_no" class="form-control form-control-sm"> 
</div>-->
                                </div>

                                <div class="form-row">      
                                    <div class="form-group col-md-8">
                                        <label ><span class="text-danger">Payment Mode*</span></label>
                                        <select required  id="inv_paymentmode" data-parsley-trigger="change"  class="form-control form-control-sm"  name="inv_paymentmode" >
                                            <option value="">-- Select Payment Mode --</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="Bank Remittance">Bank Remittance</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-row">                                
                                    <div class="form-group col-md-4">											
                                        <label for="inputState"><span class="text-danger">Place of Supply*</span></label>
                                        <select id="inv_deliveryat" onchange="ondelat(this)" required class="form-control form-control-sm" name="inv_deliveryat">
                                            <option selected>--Open State list--</option>
                                        </select>	
                                        <!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                    </div>
                                    <div class="form-group col-md-4" >
                                        <label for="inputState">Status<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" required name="inv_status"  id="inv_status" readonly>
                                            <option value="Created">Created</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Billed">Invoiced</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Closed">Closed</option>
                                        </select>											
                                    </div>

                                </div>



                                <!--div class="form-row">
<div class="form-group col-md-8">									
<label>Freight<span class="text-danger">*</span></label>
<select class="form-control form-control-sm" required name="cashmem_freight"  id="cashmem_freight">
<option value="to-pay">To-Pay</option>
<option value="paid">Paid</option>
</select>	
</div>
</div-->


                                <div class="form-row">	
                                    <div class="form-group col-md-8" id="show_errors" style="display:none;font-weight:bold;">

                                    </div>
                                </div>




                                <!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->
                                <table  class="table table-hover small-text" id="tb">
                                    <tr class="tr-header">
                                        <th width="20%">Item Details</th>
                                        <th width="12%">HSN/SAC</th>
                                        <th width="11%">Qty</th>
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
                                            <select name="itemcode" class="form-control itemcode" onchange="sales_rowitem.set_itemrow(this);" id="item_select">
                                                <option value="" name="itemcode" selected>Item Code</option>
                                                <?php $qr  = "select * from salesitemaster2;";
                                                $exc = mysqli_query($dbcon,$qr)or die();
                                                while($r = mysqli_fetch_array($exc)){ ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo $r['itemname']." [".$r['itemcode']."]"; ?></option>
                                                <?php
                                                                                    }
                                                ?>
                                            </select>
                                        </td>


                                        <!--td><input type="text" name="description" placeholder="Item Name" class="form-control"></td
<td><input type="text" name="itemcode" placeholder="Item Details" class="form-control"></td>-->
                                        <td><input readonly id="hsncode" type="text" name="hsncode" placeholder="hsncode"    data-id="" class="form-control hsncode"></td>
                                        <td><input id="qty" type="text" name="qty" onkeypress="sales_rowitem.update_math_vals();sales_rowitem.stkalert(this);"   onkeyup="sales_rowitem.update_math_vals();sales_rowitem.stkalert(this);" placeholder="Qty" data-id="" class="form-control qty"></td>                                        <td>
                                        <select class="form-control amount" id="uom"  onchange="sales_rowitem.update_math_vals();"; name="uom" style="line-height:1.5;">
                                            <option value="" selected>Open Unit</option>
                                            <?php 
                                            $sql = mysqli_query($dbcon, "SELECT * FROM uom ");
                                            while ($row = $sql->fetch_assoc()){	

                                                echo '<option  value="'.$row['code'].'">'.$row['description'].'</option>';
                                            }
                                            ?>
                                        </select>
                                        </td>
                                        <td><input id="price" type="text" name="price" placeholder="Rate/Qty" onkeypress="sales_rowitem.update_math_vals();"   onkeyup="sales_rowitem.update_math_vals();"   data-id="" class="form-control price"></td>
                                        <td><input id="amount" type="text" name="amount" placeholder="qtyXprice" data-id="" class="form-control amount"></td>
                                        <!-- <td><input type="text" name="discount[]" class="form-control discount" placeholder="Itm wise Disc"></td> -->
                                        <td>                       <select class="form-control amount" id="taxname"  onchange="sales_rowitem.update_math_vals();"; name="taxname" style="line-height:1.5;">
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
                                            </select></td>
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
                                                        <input type="text" class="form-control text-right ember-text-field text-right ember-view" id="podiscount" style=".375rem .75rem;" onkeypress="sales_rowitem.update_math_vals();"   onkeyup="sales_rowitem.update_math_vals();" placeholder="Discount"> 
                                                        <!----> <div class="input-group-btn" style="width:20%;"><button type="button" data-toggle="dropdown" class="btn btn-default dropdown-toggle discount-btn" data-meth="flat" id="discoutTypeTextbutton">
                                                        <span id="discoutTypeText">₹</span>  <span class="caret"></span></button> <ul class="dropdown-menu pull-right text-center" style="min-width:4rem;" id="discoutType">
                                                        <li onclick="chgdiscount_tupe(this);" data-meth="percent"><a data-ember-action="" data-ember-action-1602="1602"  >%</a></li> 
                                                        <li onclick="chgdiscount_tupe(this);"  data-meth="flat"><a data-ember-action="" data-ember-action-1603="1603" >₹</a></li></ul></div></div>
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
                                                        <input class="form-control" onkeypress="sales_rowitem.update_math_vals();"   onkeyup="sales_rowitem.update_math_vals();" id="poadjustmentval" type="number" step="any" placeholder="Adjustment ">
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

                                <br>

                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-8">
                                        <textarea rows="2" class="form-control" name="inv_tc"  id="inv_tc" placeholder="add Cash Memo Terms & Conditions to reflect in Invoice"></textarea>

                                    </div>

                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-8">
                                            <textarea rows="2" class="form-control" name="inv_notes"  id="inv_notes" placeholder="add Cash Memo Notes"></textarea>
                                        </div>
                                    </div>




                                    <div class="form-row">
                                        <div class="form-group text-right m-b-0">
                                            &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-primary" type="submit" >
                                            Submit
                                            </button>
                                            <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>




                                </div>
                            </form>

                        </div>
                    </div>



                </div>
                <!-- END container-fluid -->

            </div>
            <!-- END content -->

        </div>
        <!-- END content-page -->


        <!--?php include('footer.php');?-->
        <footer class="footer">
            <span class="text-right">
                Copyright@2021<a target="_blank" href="#">Thuli Ice Creams</a>
            </span>
            <span class="float-right">
                Powered by <a target="_blank" href=""><span>e-Schoolz</span> </a>
            </span>
        </footer>

    </div>
    <!-- END main -->
    <style>
        #discoutType li {

            cursor: pointer;
        }
        #discoutType li:hover {

            background-color:#007BFF;
            color: #ffffff;
        }
    </style>

    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/jquery.nicescroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="assets/plugins/switchery/switchery.min.js"></script>

    <!-- App js -->
    <script src="assets/js/pikeadmin.js"></script>

    <!-- BEGIN Java Script for this page -->

    <!-- END Java Script for this page -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script> 
    <script>       
        var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
        var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
        var page_inv_code = "<?php if(isset($_GET['inv_code'])){ echo $_GET['inv_code']; } ?>";


        $(function(){


            ////set select options
            var user_params = [];
            var comp_params = [];
            var vendor_params = [];
            var paymentterm_params = [];
            var shippingvia_params = [];
            var loction_params = [];
            comp_params[0]={"primaryflag":"1"};  
            $('#inv_owner').val('<?php echo $session_user; ?>');

            Page.load_select_options('inv_deliveryat',loction_params,'state','Place of Supply','code','description',3);

            $('#addMore').on('click', function() {
                var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                data.attr("id",);
                data.find("input").val('');
            });

            $(document).on('click', '.remove', function() {
                var trIndex = $(this).closest("tr").index();
                if(trIndex>1) {
                    $(this).closest("tr").remove();
                    sales_rowitem.update_math_vals();
                } else {
                    alert("Sorry!! Can't remove first row!");
                }
            });

            //addGroupnames_ajax.php
            $('#submitpaymentterm').click(function(){
                var description = $('#adddescription').val();
                var paymentterm = $('#addpaymentterm').val();
                //alert(groupname+description);
                $.ajax ({
                    url: 'addPaymentTermModal.php',
                    type: 'post',
                    data: {
                        paymentterm:paymentterm,
                        description:description
                    },
                    //dataType: 'json',
                    success:function(response){
                        if(response!=0 || response!=""){
                            var new_option ="<option>"+response+"</option>";
                            $('#paymentterm').append(new_option);
                            $('#customModal').modal('toggle');
                        }else{
                            alert('Error in inserting new Payment Term,try another Payment Term');
                        }
                    }

                });

            });




            if(page_action=="edit"){
                var edit_data = Page.get_edit_vals(page_inv_code,page_table,"inv_code");
                set_form_data(edit_data);
            }
            function set_form_data(data){
                // console.log(data.cashmem_owner);
                //// $('#cashmem_owner').val(data.cashmem_owner);
                $.each(data, function(index, value) {

                    if(index=="id"||index=="inv_code"){


                    }else if(index=="inv_items"){
                        set_math_vals(JSON.parse(value));

                    }else{

                        $('#'+index).val(value);
                    }

                }); 


            }
        });      


        function set_math_vals(inv_items_json){
            var itemrowCount = inv_items_json.length;
            var rowCount = $('#tb tr').length;
            var totalamt = 0;

            console.log(inv_items_json)
            for(r=0;r<itemrowCount;r++){

                if(r<itemrowCount-1){
                    var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                }

                $('#tb tr').eq(r+1).find('#item_select').val(inv_items_json[r].itemcode);
                $('#tb tr').eq(r+1).find('#hsncode').val(inv_items_json[r].hsncode);
                $('#tb tr').eq(r+1).find('#price').val(inv_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#price').attr('data-price',inv_items_json[r].tax_method==1?inv_items_json[r].rwprice_org:inv_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#qty').val(inv_items_json[r].rwqty);
                $('#tb tr').eq(r+1).find('#taxname').val(inv_items_json[r].tax_val);
                $('#tb tr').eq(r+1).find('#taxname').attr('data-taxmethod',inv_items_json[r].tax_method);
                $('#tb tr').eq(r+1).find('#uom').val(inv_items_json[r].uom);
                totalamt+=$('#tb tr').eq(r+1).find('#price').val()*$('#tb tr').eq(r+1).find('#qty').val();

            }


            if(itemrowCount>0){
                var podiscount = inv_items_json[0].podiscount;
                var poadjustmentval = inv_items_json[0].poadjustmentval;    
                var podiscount_method = inv_items_json[0].podiscount_method; 
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

            sales_rowitem.update_math_vals();
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
            sales_rowitem.update_math_vals();

        }

        $("form#add_cashmem_form").submit(function(e){
            e.preventDefault();

            var r = confirm("Are you sure you want to save Invoice, once saved you cannot edit");
            if (!r) {
                return false;
            }

            var rowCount = $('#tb tr').length;
            var inv_items = [];

            for(i=1;i<rowCount;i++){ 
                var item_select = $('#tb tr').eq(i).find('#item_select').val();
                var item_details = $('#tb tr').eq(i).find('#item_select option:selected').text();
                var hsncode = $('#tb tr').eq(i).find('#hsncode').val();
                var rwqty = $('#tb tr').eq(i).find('#qty').val();
                var tax_id = $('#tb tr').eq(i).find('#taxname').val();
                var tax_method = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');
                var tax_val = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-rate');
                var rwprice_org = $('#tb tr').eq(i).find('#price').attr('data-price');
                var rwprice = $('#tb tr').eq(i).find('#price').val();
                var rwamt = $('#tb tr').eq(i).find('#amount').val();
                var uom = $('#tb tr').eq(i).find('#uom').val();
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
                        podiscount = subtotal*(podiscount_value/100);

                    }
                }
                var inv_items_ele = {
                    itemdetails : item_details,
                    itemcode : item_select,
                    hsncode : hsncode,
                    rwqty : rwqty,
                    tax_val : tax_val,
                    tax_type : tax_type,
                    tax_id : tax_id,
                    tax_method : tax_method,
                    rwprice : rwprice,
                    rwprice_org : rwprice_org,
                    rwamt : rwamt,
                    podiscount : podiscount,
                    poadjustmentval:poadjustmentval,
                    podiscount_method:podiscount_method,
                    uom : uom
                };

                inv_items[i-1]=inv_items_ele;

            }

            var $form = $("#add_cashmem_form");
            var data = getFormData($form);
            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    if(n['name']=="itemcode"||n['name']=="hsncode"||n['name']=="qty"||n['name']=="unit"||n['name']=="price"||n['name']=="amount"||n['name']=="taxname"||n['name']=="uom"){

                    }else{
                        indexed_array[n['name']] = n['value'];

                    }
                });

                return indexed_array;
            }

            data.table = "invoices";
            data.inv_items = JSON.stringify(inv_items);
            data.inv_value = $('#pobaltotal').text(); 
            data.inv_balance_amt = $('#pobaltotal').text(); 
            data.inv_payment_status = "Paid"; 
            data.inv_type = "Retail Invoice"; 
            data.inv_status = "Closed"; 
            var inv_owner_var = $('#inv_owner').val(); 

            if (sales_rowitem.sales_entry){

                $.ajax ({
                    url: 'workers/setters/save_cashmem.php',
                    type: 'post',
                    data: {array : JSON.stringify(data),inv_code:page_inv_code,inv_owner:inv_owner_var,action:page_action?page_action:"add",table:"invoices"},
                    dataType: 'json',
                    success:function(response){
                        if(page_action==''||page_action=='add'){
                            save_cust_payments(data,response);

                        }else{
                            location.href="listInvoices.php";
                        }
                    }
                });
            }else{
                return false;

            }

            function save_cust_payments(pdata,resp){
                pdata = {};
                pdata.cust_payment_amount=data.inv_value;
                pdata.cust_payment_customer=$('#inv_customer').val();
                pdata.cust_payment_date=$('#inv_date').val();
                pdata.cust_payment_inv_id=resp.inv_code;
                pdata.cust_payment_invoice_no=resp.inv_code;
                pdata.cust_payment_mode=$('#inv_paymentmode').val();
                pdata.cust_payment_notes="";
                pdata.cust_payment_ref_no="";
                pdata.cust_payment_so_code="";
                pdata.cust_payment_user=resp.inv_owner;
                pdata.table="customer_payments";

                $.ajax ({
                    url: 'workers/setters/save_customer_payments.php',
                    type: 'post',
                    data: {
                        array : JSON.stringify(pdata),
                        cust_payment_id:"",
                        cust_payment_inv_id:pdata.cust_payment_inv_id,
                        cust_payment_amount:pdata.cust_payment_amount,
                        action:"add",table:"customer_payments",
                        page_cust_payment_v_credits_id:''
                    },
                    dataType: 'json',
                    success:function(response){
                       location.href="listInvoices.php";
                    }
                });
            }

        });



    </script>			


    </body>
</html>