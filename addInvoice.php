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
                        <h1 class="main-title float-left">Invoice</h1>
                        <ol class="breadcrumb float-right">
                            <li><a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                            <li class="breadcrumb-item active">Invoice</li>
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
                            <h5><div class="text-muted font-light"><i class="fa fa-shopping-cart bigfonts" aria-hidden="true">
                                </i>&nbsp;New Invoice<span class="text-muted"></span></div></h5>

                            <div class="text-muted font-light">Create New Invoice</div>

                        </div>

                        <div class="card-body">

                            <form id="add_inv_form" autocomplete="off" action="#">

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Sales Person</label>
                                        <input type="text" class="form-control form-control-sm"  id="inv_owner" name="inv_owner" value="<?php echo $session_user; ?>" readonly class="form-control form-control-sm"  required />

                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                        <select id="inv_comp_code"  class="form-control form-control-sm select2" name="inv_comp_code">
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
                                        <select id="inv_customer" onchange="post_address(this.value);" class="form-control form-control-sm select2" name="inv_customer" required>
                                            <option selected>--Select Customer--</option>
                                            <?php
                                            $sql = mysqli_query($dbcon,"SELECT * FROM customerprofile");
                                            while ($row = $sql->fetch_assoc()){	
                                                $custid=$row['custid'];
                                                $custname=$row['custname'];
                                                echo '<option  value="'.$custid.'" >'.$custid.' - '.$custname.'</option>';
                                            }
                                            ?>
                                        </select>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Order#</label>
                                        <input type="text" placeholder="Sales Order No" name="inv_so_code" id="inv_so_code" class="form-control form-control-sm" readonly> 

                                    </div>
                                </div>

                                <div class="form-row" id="inv_code_row" style="display:none;">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Invoice#</label>
                                        <input type="text" placeholder="Invoice No" name="inv_code" id="inv_code" class="form-control form-control-sm" readonly> 
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">									
                                        <label><span class="text-danger">Invoice Date*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="inv_date" name="inv_date" value="<?php echo date("Y-m-d");?>" required autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-4">									
                                        <label>Due Date</label>
                                        <input type="date" class="form-control form-control-sm" id="inv_duedate" name="inv_duedate" value="<?php echo date("Y-m-d");?>" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-row">                                
                                    <div class="form-group col-md-4">											
                                        <label for="inputState">Payment Term</label>
                                        <select id="inv_payterm" onchange="ongroup(this)" class="form-control"  name="inv_payterm">
                                            <option selected>Open Payment Term</option>
                                        </select>



                                        <a href="#custom-modal" data-target="#customModal" data-toggle="modal">
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>Add New Pay Term</a><br>


                                    </div>




                                    <div class="form-group col-md-4">											
                                        <label for="inputState">Place of Supply</label>
                                        <select id="inv_deliveryat"  class="form-control form-control-sm" name="inv_deliveryat">
                                            <option selected>--Open State--</option>
                                        </select>	
                                        <!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                    </div>
                                </div>

                                <div class="form-row">  
                                    <div class="form-group col-md-8" >
                                        <label for="inputState"><span class="text-danger">Status*</span></label>
                                        <select class="form-control form-control-sm" required name="inv_status"  id="inv_status" readonly>
                                            <option value="Created">Created</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Closed">Closed</option>
                                        </select>											
                                    </div>
                                </div>
                                
                                <!-- truck no and driver name --->
                                <div class="form-row">	
                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Truck no.(Optional)"  name="inv_truck_no" id="inv_truck_no"  class="form-control form-control-sm" > 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Driver Name (Optional)" name="inv_driver_name" id="inv_driver_name"  class="form-control form-control-sm"  > 
                                    </div>
                                </div>



                                <!--div class="form-row">
<div class="form-group col-md-8">									
<label>Freight<span class="text-danger">*</span></label>
<select class="form-control form-control-sm" required name="inv_freight"  id="inv_freight">
<option value="to-pay">To-Pay</option>
<option value="paid">Paid</option>
</select>	
</div>
</div-->

                                <div class="form-row">								
                                    <h4 class="col-md-8 text-muted">Address Information &nbsp;</h4>
                                    <div class="col-md-8 float-right text-right">		
                                        <div class="btn-group" role="group">
                                            <!--a id="btnGroupDrop1" role="button" href="#" class="btn btn-secondary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"-->
                                            <a id="btnGroupDrop1" role="button" href="#" class="btn btn-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Copy Address
                                            </a>
                                            <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                <a class="dropdown-item" id="billing_to_shipping" >Billing to Shipping</a>
                                                <a class="dropdown-item" id="shipping_to_billing" >Shipping to Billing</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <br/>



                                <div class="form-row">	
                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Billing Street"  name="inv_billing_street" id="inv_billing_street"  class="form-control form-control-sm" > 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping Street" name="inv_shipping_street" id="inv_shipping_street"  class="form-control form-control-sm"  > 
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" required name="inv_billing_city" id="inv_billing_city"  placeholder=" Billing City" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping City" name="inv_shipping_city" id="inv_shipping_city" required class="form-control form-control-sm"> 
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select id="inv_billing_state" class="form-control form-control-sm billstate" name="inv_billing_state">
                                            <span class="text-muted"><option value="">Billing State</option> </span>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">											
                                        <select id="inv_shipping_state" class="form-control form-control-sm" name="inv_shipping_state">
                                            <span class="text-muted">  <option selected value="">Shipping State</option> </span>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="inv_billing_country" required name="inv_billing_country"> 
                                            <span class="text-muted">  
                                                <option value="" >Billing Country</option> </span>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="inv_shipping_country" required name="inv_shipping_country"> 
                                            <span class="text-muted">  
                                                <option value="" selected>Shipping Country</option> </span>

                                        </select>								  
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_billing_zip" id="inv_billing_zip"   placeholder="Billing Zip/Postal Code" value="">
                                    </div>	


                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_shipping_zip" id="inv_shipping_zip"   placeholder="Shipping Zip/Postal Code">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_billing_phone" id="inv_billing_phone"  required placeholder="Billing Phone" value="">
                                    </div>	

                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_shipping_phone"  id="inv_shipping_phone"  required placeholder="Shipping Phone">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_billing_gstin" id="inv_billing_gstin"   placeholder="Billing GSTIN No" value="" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="inv_shipping_gstin" id="inv_shipping_gstin"  placeholder="Shipping GSTIN No">
                                    </div>									  
                                </div>

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
                                            <select name="itemcode" class="form-control  itemcode" onchange="sales_rowitem.set_itemrow(this,'sales');" id="item_select">
                                                <option value="" name="itemcode" selected>Item Code</option>
                                                <?php $qr  = "select * from salesitemaster2;";
                                                $exc = mysqli_query($dbcon,$qr)or die();
                                                while($r = mysqli_fetch_array($exc)){ ?>
                                               <option value="<?php echo $r['id']; ?>"><?php echo $r['itemname']." - [".$r['itemcode']."]"; ?></option> <?php
                                                                                    }
                                                ?>
                                            </select>
                                        </td>


                                        <!--td><input type="text" name="description" placeholder="Item Name" class="form-control"></td
<td><input type="text" name="itemcode" placeholder="Item Details" class="form-control"></td>-->
                                        <td><input id="hsncode" type="text" name="hsncode" placeholder="hsncode"    data-id="" class="form-control hsncode"></td>
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
                                        <td>             
                                                  <select class="form-control amount" id="taxname"  onchange="sales_rowitem.update_math_vals();"; name="taxname" style="line-height:1.5;">
                                            <option data-type="single" value="0" selected>Open Taxrate</option>
                                            <?php 

                                            $sql = mysqli_query($dbcon, "SELECT id,taxname,taxrate,taxtype FROM taxmaster ");
                                            while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                $taxtype=$row['taxtype'];
                                                $taxid=$row['id'];

                                                echo '<option data-type="'.$taxtype.'" data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
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
                                    <!-- <div class="form-group col-md-8">
                                        <textarea rows="2" class="form-control" name="inv_tc"  id="inv_tc" required placeholder="add Invoice Terms & Conditions "></textarea>

                                    </div> -->

                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-8">
                                            <textarea rows="2" class="form-control" name="inv_notes"  id="inv_notes" placeholder="add Invoice notes "></textarea>
                                        </div>
                                    </div>




                                    <div class="form-row">
                                        <div class="form-group text-right m-b-0">
                                            &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-primary" type="submit" >
                                            Submit
                                            </button>
                                            <button type="reset" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">
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
                Copyright@2021<a target="_blank" href="#">Thuli Ice Creams.,</a>
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
        var page_so_code = "<?php if(isset($_GET['so_code'])){ echo $_GET['so_code']; } ?>";
        var page_est_code = "<?php if(isset($_GET['est_code'])){ echo $_GET['est_code']; } ?>";

        var rowarray = [];

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
            //                    $('#inv_tc').val(<?php 
            //                        $sql = mysqli_query($dbcon, "SELECT inv_tc from invoices order by id desc");
            //                        while ($row = $sql->fetch_assoc()){	
            //                            $inv_tc=$row['inv_tc'];
            //
            //                            if($inv_tc==''||$inv_tc==null){
            //                                echo "''";
            //                            }else{
            //                                echo "'".$inv_tc."'";
            //
            //                            }
            //                        }?>);
            // Page.load_select_options('inv_comp_code',comp_params,'comprofile','Company Code','orgid','orgname');
            Page.load_select_options('inv_vendor',vendor_params,'vendorprofile','Vendor Code','vendorid','supname');
            Page.load_select_options('inv_shippingvia',shippingvia_params,'transportmaster','Shipping Via','transname',null);  
            Page.load_select_options('inv_payterm',paymentterm_params,'paymentterm','Payment  Term','noofdays','paymentterm');
            Page.load_select_options('inv_deliveryat',loction_params,'location','Deivery at','locname',null);
            Page.load_select_options('inv_deliveryat',loction_params,'state','Place of Supply','code','description',3);
            Page.load_select_options('inv_billing_state',loction_params,'state','Billing State','code','description',3);           
             Page.load_select_options('inv_shipping_state',loction_params,'state','Shipping State','code','description',3);
            Page.load_select_options('inv_shipping_country',loction_params,'country','Shipping Country','code','description',3);
            Page.load_select_options('inv_billing_country',loction_params,'country','Billing Country','code','description',3);

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

            $('#billing_to_shipping').click(function(){
                $('#inv_shipping_street').val($('#inv_billing_street').val());
                $('#inv_shipping_city').val($('#inv_billing_city').val());
                $('#inv_shipping_state').val($('#inv_billing_state').val());
                $('#inv_shipping_country').val($('#inv_billing_country').val());
                $('#inv_shipping_zip').val($('#inv_billing_zip').val());
                $('#inv_shipping_phone').val($('#inv_billing_phone').val());
                $('#inv_shipping_gstin').val($('#inv_billing_gstin').val());
            });


            $('#shipping_to_billing').click(function(){
                $('#inv_billing_street').val($('#inv_shipping_street').val());
                $('#inv_billing_city').val($('#inv_shipping_city').val());
                $('#inv_billing_state').val($('#inv_shipping_state').val());
                $('#inv_billing_country').val($('#inv_shipping_country').val());
                $('#inv_billing_zip').val($('#inv_shipping_zip').val());
                $('#inv_billing_phone').val($('#inv_shipping_phone').val());
                $('#inv_billing_gstin').val($('#inv_shipping_gstin').val());
            });

            //code updated by jayaprakash -- 08042019
            $('#inv_code_row').show();


            if(page_action!=""){
                if(page_inv_code!=""&&page_action=="edit"){
                    var edit_data = Page.get_edit_vals(page_inv_code,page_table,"inv_code");
                    set_form_data(edit_data);
                    console.log(edit_data);
                    $('#inv_code_row #inv_code').val(edit_data.inv_code);
                }else if(page_so_code!=""&&page_action=="add"){
                    var edit_data2 = Page.get_edit_vals(page_so_code,"salesorders","so_code");
                    $('#inv_so_code').val(edit_data2.so_code);
                    $('#inv_customer').val(edit_data2.so_customer);
                    $('#inv_payterm').val(edit_data2.so_payterm);
                    $('#inv_comp_code').val(edit_data2.so_comp_code);
                    $('#inv_deliveryat').val(edit_data2.so_deliveryat);
                    post_address(edit_data2.so_customer);
                    set_math_vals(JSON.parse(edit_data2.so_items));
                }else if(page_est_code!=""&&page_action=="add"){
                    var edit_data3 = Page.get_edit_vals(page_est_code,"estimates","est_code");
                    $('#inv_so_code').val(edit_data3.est_code);
                    $('#inv_customer').val(edit_data3.est_customer);
                    $('#inv_comp_code').val(edit_data3.est_comp_code);
                    post_address(edit_data3.est_customer);
                    set_math_vals(JSON.parse(edit_data3.est_items));
                }
            }


            function set_form_data(data){
                // console.log(data.inv_owner);
                //// $('#inv_owner').val(data.inv_owner);
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

        function post_address(custid){
            var vals = Page.get_edit_vals(custid,"customerprofile","custid");
            $('#inv_billing_street').val(vals.address);
            $('#inv_billing_city').val(vals.city);
            $('#inv_billing_state').val(vals.state);
            $('#inv_billing_country').val(vals.country);
            $('#inv_billing_zip').val(vals.zip);
            $('#inv_billing_phone').val(vals.mobile);
            $('#inv_billing_gstin').val(vals.gstin); 

        }


        function set_math_vals(inv_items_json){
           // console.log(inv_items_json);
            var itemrowCount = inv_items_json.length;
            var rowCount = $('#tb tr').length;
            var totalamt = 0;

            for(r=0;r<itemrowCount;r++){

                if(r<itemrowCount-1){
                    var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                }

                $('#tb tr').eq(r+1).find('#item_select').val(inv_items_json[r].itemcode);
                $('#tb tr').eq(r+1).find('#hsncode').val(inv_items_json[r].hsncode);
                $('#tb tr').eq(r+1).find('#price').val(inv_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#price').attr('data-price',inv_items_json[r].tax_method==1?inv_items_json[r].rwprice_org:inv_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#qty').val(inv_items_json[r].rwqty);
                rowarray[r] = inv_items_json[r].rwqty

                $('#tb tr').eq(r+1).find('#taxname').val(inv_items_json[r].tax_id);
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
                    var tt = (eval(podiscount/totalamt)*100).toFixed(2);
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

        $("form#add_inv_form").submit(function(e){
            e.preventDefault();

            var rowCount = $('#tb tr').length;
            var inv_items = [];
            var changed_row_qty = false
            var  changed_item_select =[];

            for(i=1;i<rowCount;i++){ 
                var item_select = $('#tb tr').eq(i).find('#item_select').val();
                var item_details = $('#tb tr').eq(i).find('#item_select option:selected').text();
                var hsncode = $('#tb tr').eq(i).find('#hsncode').val();
                var rwqty = $('#tb tr').eq(i).find('#qty').val();

                //code edited by jp for INV to invent report
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

                inv_items[i-1]=inv_items_ele;

            }

            var $form = $("#add_inv_form");
            var data = getFormData($form);
            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    if(n['name']=="itemcode"||n['name']=="inv_code"||n['name']=="hsncode"||n['name']=="qty"||n['name']=="unit"||n['name']=="price"||n['name']=="amount"||n['name']=="taxname"||n['name']=="uom"){

                    }else{
                        indexed_array[n['name']] = n['value'];
                    }
                });

                return indexed_array;
            }
            var today = new Date();
            var yy = today.getFullYear().toString();
            var mm = today.getMonth() + 1;

            mm = mm < 10 ? '0' + mm : '' + mm;
            //  console.log(mm+""+yy.slice(-2)) 
            var dateValue = mm+"/"+yy
            data.table = "invoices";
            data.inv_items = JSON.stringify(inv_items);
            data.inv_value = $('#pobaltotal').text(); 
            data.inv_balance_amt = $('#pobaltotal').text(); 
            data.inv_payment_status = "Unpaid"; 
            data.inv_type = "Credit Invoice"; 
            data.inv_payterm_desc =  $('#inv_payterm option:selected').attr('data-val');
            //console.log(data,"jp")
            var newinvcode_val = $('#inv_code_row #inv_code').val();
            var inv_code_changed = "";
            var inv_action = "";
            if(page_action=='edit'){
                if(newinvcode_val!=page_inv_code){
                inv_code_changed = newinvcode_val;
                inv_action = 'add';
                }else{
                    inv_code_changed = page_inv_code;
                    inv_action = 'edit';
                }

            }else{
                inv_code_changed = newinvcode_val;
                inv_action = "add";
            }

            if (sales_rowitem.sales_entry){

                $.ajax ({
                    url: 'workers/setters/save_inv.php',
                    type: 'post',
                    data: {
                        array : JSON.stringify(data),
                        inv_code    : inv_code_changed,
                        action  :   inv_action,
                        table:"invoices",                    
                        changed_row_qty     : changed_row_qty,
                        prefix      :   dateValue,
                        changed_item_select : JSON.stringify(changed_item_select)
                    },
                    dataType: 'json',
                    success:function(response){
                        location.href="listInvoices.php";
                    }


                });
            }else{
                return false;
            }

        });



    </script>			


    </body>
</html>