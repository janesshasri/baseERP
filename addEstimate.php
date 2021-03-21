<?php 
include('header.php');
?>

<!-- End Sidebar -->
<!-- Modal -->
<a href="#custom-modal" data-target="#customModal" data-toggle="modal">to create new group click 
    <i class="fa fa-user-plus" aria-hidden="true"></i>Add User Group</a><br><br>
<div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add Payment Term</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" enctype="multipart/form-data" method="post">

                    <div class="form-group">
                        <input type="text" class="form-control" name="addpaymentterm"  id="addpaymentterm"  placeholder="Due on Receipt,Advance,Net 15,Net 30,Net 45,Net60,Due EOM,Due NM,Immediate">
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" name="adddescription" id="adddescription"  placeholder="description">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="submitpaymentterm" id="submitpaymentterm" class="btn btn-primary">Save and Associate</button>
            </div>
        </div>
    </div>
</div>
<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Estimate</h1>
                        <ol class="breadcrumb float-right">
                            <li><a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                            <li class="breadcrumb-item active">Estimate</li>
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
                                </i>&nbsp;Estimate<span class="text-muted"></span></div></h5>

                            <div class="text-muted font-light">New Estimate</div>

                        </div>

                        <div class="card-body">

                            <form id="add_est_form" autocomplete="off" action="#">

                                <div class="form-row">
                                    <div class="invoice-title text-left mb-6">
                                        <h4 class="col-md-12 text-muted">Estimate Information &nbsp;</h4>
                                    </div>
                                </div>




                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Sales Person</label>
                                        <input type="text" class="form-control form-control-sm"  id="est_owner" name="est_owner" readonly class="form-control form-control-sm" value="<?php echo $session_user; ?>" required />

                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                        <select id="est_comp_code"  class="form-control form-control-sm" name="est_comp_code">
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
                                        <label for="inputState">Customer Name<span class="text-danger">*</span></label>
                                        <select id="est_customer" onchange="post_address(this.value);" class="form-control form-control-sm" name="est_customer">
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

                                        <script>
                                            function post_address(custid){

                                                var vals = Page.get_edit_vals(custid,"customerprofile","custid");

                                                $('#est_cust_billing_street').val(vals.address);
                                                $('#est_cust_billing_city').val(vals.city);
                                                $('#est_cust_billing_state').val(vals.state);
                                                $('#est_cust_billing_country').val(vals.country);
                                                $('#est_cust_billing_zip').val(vals.zip);
                                                $('#est_cust_billing_phone').val(vals.mobile);
                                                $('#est_cust_billing_gstin').val(vals.gstin); 

                                            }
                                        </script>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Reference#</label>
                                        <input type="text" placeholder="Customer Reference No" name="est_cust_ref_no" id="est_cust_ref_no" class="form-control form-control-sm"> 

                                    </div>
                                </div>

                                <div class="form-row">                                
                                    <div class="form-group col-md-4">									
                                        <label>Estimate Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" value="<?php echo date("Y-m-d");?>" id="est_date" name="est_date" required autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">									
                                        <label>Expiry Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="est_expdate" name="est_expdate" required autocomplete="off">

                                    </div>
                                </div>					
                                <div class="form-row">  
                                    <div class="form-group col-md-8" >
                                        <label for="inputState">Status<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" required name="est_status"  id="est_status">
                                            <option value="Created">Created</option>
                                            <option value="Sent">Sent</option>                                            
                                            <option value="Accepted">Accepted</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Invoiced">Invoiced</option>
                                            <option value="Cancelled">Cancelled</option>
                                            <option value="Closed">Closed</option>
                                        </select>											
                                    </div>
                                </div>

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
                                        <input type="text" placeholder="Billing Street"  name="est_cust_billing_street" id="est_cust_billing_street" required class="form-control form-control-sm" > 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping Street" name="est_cust_shipping_street" id="est_cust_shipping_street" required class="form-control form-control-sm"  > 
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" required name="est_cust_billing_city" id="est_cust_billing_city"  placeholder=" Billing City" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping City" name="est_cust_shipping_city" id="est_cust_shipping_city" required class="form-control form-control-sm"> 
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select id="est_cust_billing_state" class="form-control form-control-sm billstate" name="est_cust_billing_state">
                                            <span class="text-muted"><option value="">Billing State</option> </span>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">											
                                        <select id="est_cust_shipping_state" class="form-control form-control-sm" name="est_cust_shipping_state">
                                            <span class="text-muted">  <option selected value="">Shipping State</option> </span>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="est_cust_billing_country" required name="est_cust_billing_country"> 
                                            <span class="text-muted">  
                                                <option value="" >Billing Country</option> </span>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="est_cust_shipping_country" required name="est_cust_shipping_country"> 
                                            <span class="text-muted">  
                                                <option value="" selected>Shipping Country</option> </span>

                                        </select>								  
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="est_cust_billing_zip" id="est_cust_billing_zip"  required placeholder="Billing Zip/Postal Code" value="">
                                    </div>	


                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="est_cust_shipping_zip" id="est_cust_shipping_zip"  required placeholder="Shipping Zip/Postal Code">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="est_cust_billing_phone" id="est_cust_billing_phone"  required placeholder="Billing Phone" value="">
                                    </div>	

                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="est_cust_shipping_phone"  id="est_cust_shipping_phone"  required placeholder="Shipping Phone">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="est_cust_billing_gstin" id="est_cust_billing_gstin"  required placeholder="Billing GSTIN No" value="" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="est_cust_shipping_gstin" id="est_cust_shipping_gstin"  required placeholder="Shipping GSTIN No">
                                    </div>									  
                                </div>
                                <div class="form-row">	
                                    <div class="form-group col-md-8" id="show_errors" style="display:none;">

                                    </div>
                                </div>

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
                                            <select name="itemcode" class="form-control itemcode" onchange="sales_rowitem.set_itemrow(this,'sales');" id="item_select">
                                                <option value="" name="itemcode" selected>Item Code</option>
                                                <?php $qr  = "select * from salesitemaster2;";
                                                $exc = mysqli_query($dbcon,$qr)or die();
                                                while($r = mysqli_fetch_array($exc)){ ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo "[".$r['itemcode']."] ".$r['itemname']; ?></option>
                                                <?php
                                                                                    }
                                                ?>
                                            </select>
                                        </td>


                                        <!--td><input type="text" name="description" placeholder="Item Name" class="form-control"></td
<td><input type="text" name="itemcode" placeholder="Item Details" class="form-control"></td>-->
                                        <td><input id="hsncode" type="text" name="hsncode" placeholder="hsncode"    data-id="" class="form-control hsncode"></td>
                                        <td><input id="qty" type="text" name="qty" onkeypress="sales_rowitem.update_math_vals();"   onkeyup="sales_rowitem.update_math_vals();" placeholder="Qty" data-id="" class="form-control qty"></td>                                        <td>
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
                                                <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger estbaltotal" id="pobaltotal">--</span></div>	
                                            </div>

                                        </div>


                                    </div>
                                </div>
                                <hr>

                                <br>

                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-8">
                                        <textarea rows="2" class="form-control" name="est_tc"  id="est_tc"  placeholder="add Estimates Terms & Conditions to reflect in Invoice"></textarea>

                                    </div>

                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-8">
                                            <textarea rows="2" class="form-control" name="est_cust_notes"  id="est_cust_notes" required placeholder="add a Estimates notes to reflect in sales order"></textarea>
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
                Copyright@<a target="_blank" href="#">Dhiraj Agro Products Pvt. Ltd.,</a>
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
        var page_est_code = "<?php if(isset($_GET['est_code'])){ echo $_GET['est_code']; } ?>";


        $(function(){

            var loction_params = [];
            var lasttc = Page.get_lasttc('estimates');
            $('#est_tc').val(lasttc);
            Page.load_select_options('est_cust_shipping_state',loction_params,'state','Shipping State','code','description',3);
            Page.load_select_options('est_cust_billing_state',loction_params,'state','Billing State','code','description',3);
            Page.load_select_options('est_cust_shipping_country',loction_params,'country','Shipping Country','code','description',3);
            Page.load_select_options('est_cust_billing_country',loction_params,'country','Billing Country','code','description',3);


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
                $('#est_cust_shipping_street').val($('#est_cust_billing_street').val());
                $('#est_cust_shipping_city').val($('#est_cust_billing_city').val());
                $('#est_cust_shipping_state').val($('#est_cust_billing_state').val());
                $('#est_cust_shipping_country').val($('#est_cust_billing_country').val());
                $('#est_cust_shipping_zip').val($('#est_cust_billing_zip').val());
                $('#est_cust_shipping_phone').val($('#est_cust_billing_phone').val());
                $('#est_cust_shipping_gstin').val($('#est_cust_billing_gstin').val());
            });


            $('#shipping_to_billing').click(function(){
                $('#est_cust_billing_street').val($('#est_cust_shipping_street').val());
                $('#est_cust_billing_city').val($('#est_cust_shipping_city').val());
                $('#est_cust_billing_state').val($('#est_cust_shipping_state').val());
                $('#est_cust_billing_country').val($('#est_cust_shipping_country').val());
                $('#est_cust_billing_zip').val($('#est_cust_shipping_zip').val());
                $('#est_cust_billing_phone').val($('#est_cust_shipping_phone').val());
                $('#est_cust_billing_gstin').val($('#est_cust_shipping_gstin').val());
            });


            if(page_action=="edit"){
                var edit_data = Page.get_edit_vals(page_est_code,page_table,"est_code");
                set_form_data(edit_data);
            }
            function set_form_data(data){
                // console.log(data.po_owner);
                //// $('#po_owner').val(data.po_owner);
                $.each(data, function(index, value) {

                    if(index=="id"||index=="po_code"){


                    }else if(index=="est_items"){
                        set_math_vals(JSON.parse(value));

                    }else{

                        $('#'+index).val(value);
                    }

                }); 


            }
        });      




        function set_math_vals(po_items_json){
            var itemrowCount = po_items_json.length;
            var rowCount = $('#tb tr').length;
            var totalamt = 0;

            for(r=0;r<itemrowCount;r++){

                if(r<itemrowCount-1){
                    var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                }

                // console.log(po_items_json[r]);
                $('#tb tr').eq(r+1).find('#item_select').val(po_items_json[r].itemcode);
                $('#tb tr').eq(r+1).find('#hsncode').val(po_items_json[r].hsncode);
                $('#tb tr').eq(r+1).find('#price').val(po_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#price').attr('data-price',po_items_json[r].tax_method==1?po_items_json[r].rwprice_org:po_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#qty').val(po_items_json[r].rwqty);
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

        $("form#add_est_form").submit(function(e){
            e.preventDefault();
            if(sales_rowitem.sales_entry){


                var rowCount = $('#tb tr').length;
                var est_items = [];

                for(i=1;i<rowCount;i++){ 
                    var item_select = $('#tb tr').eq(i).find('#item_select').val();
                    var item_details = $('#tb tr').eq(i).find('#item_select option:selected').text();
                    var hsncode = $('#tb tr').eq(i).find('#hsncode').val();
                    var rwqty = $('#tb tr').eq(i).find('#qty').val();
                    var tax_id = $('#tb tr').eq(i).find('#taxname').val();
                    var tax_val = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-rate');
                    var tax_method = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                    var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');
                    var rwprice = $('#tb tr').eq(i).find('#price').val();
                    var rwprice_org = $('#tb tr').eq(i).find('#price').attr('data-price');
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

                    var est_items_ele = {
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

                    est_items[i-1]=est_items_ele;

                }

                var $form = $("#add_est_form");
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

                data.table = "estimates";
                data.est_items = JSON.stringify(est_items);
                data.est_value = $('.estbaltotal').text(); 

                $.ajax ({
                    url: 'workers/setters/save_est.php',
                    type: 'post',
                    data: {array : JSON.stringify(data),est_code:page_est_code,action:page_action?page_action:"add",table:"estimates"},
                    dataType: 'json',
                    success:function(response){
                        location.href="listEstimates.php";
                    }


                });

            }else{
                $('#show_errors').show();
                $('#show_errors').html("<span class='text-danger'>you cant save with wrong qty entry</span>");
            }
        });



    </script>			


    </body>
</html>