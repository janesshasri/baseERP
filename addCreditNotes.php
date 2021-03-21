
<?php include('header.php');?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Credit Notes</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a  href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Credit Notes</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5><div class="text-muted font-light"><i class="fa fa-rupee bigfonts" aria-hidden="true"></i>&nbsp;New Credit Notes<span class="text-muted"></span></div></h5>
                        </div>

                        <div class="card-body">
                            <form autocomplete="off" action="#" enctype="multipart/form-data" id="addcreditnote_form" method="post">
                                <!--                         <div class="form-row">
<div class="form-group col-md-8">
<label for="inputState">Customer Type</label>
<select required id="v_credits_suptype" onchange="get_vendors(this.value)"  class="form-control form-control-sm" name="v_credits_suptype">
<option value="">Open Customer Type</option>
</select>	
</div>
</div>
-->

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                        <select id="creditnote_comp_code"  class="form-control form-control-sm" name="creditnote_comp_code">
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
                                        <select id="creditnote_customer" onchange="post_address(this.value);" required class="form-control form-control-sm" name="creditnote_customer">
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
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label >Reference #</label>
                                        <input type="text" class="form-control form-control-sm" name="creditnote_cust_ref_no" id="creditnote_cust_ref_no" placeholder="" autocomplete="off" required>
                                    </div>
                                </div>							


                                <!--                  <div class="form-row">      
<div class="form-group col-md-8">
<label ><span class="text-danger">Payment Mode*</span></label>
<select name="creditnote_paymentmode" id="creditnote_paymentmode" data-parsley-trigger="change"  class="form-control form-control-sm"  name="v_credits_paymentmode" >
<option value="">-- Select Payment Mode --</option>
<option value="Cash">Cash</option>
<option value="Cheque">Cheque</option>
<option value="Credit Card">Credit Card</option>
<option value="Bank Transfer">Bank Transfer</option>
<option value="Bank Remittance">Bank Remittance</option>
</select>
</div>
</div>-->

                                <!-- Modal Ends-->	
                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState"><span class="text-danger">Credit Note Date*</span></label>									
                                        <input type="date" class="form-control form-control-sm"  id="creditnote_paymentdate" name="creditnote_paymentdate" value="<?php echo date("Y-m-d");?>">		
                                    </div>

                                    <!--div class="form-group col-md-3">									  
<label><span class="text-danger">Enter Credits*</span></label>
<input type="text" class="form-control form-control-sm" name="v_credits_amount" id="v_credits_amount" placeholder="Credit Amount"  required class="form-control" autocomplete="off">
</div-->
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Handler</label>

                                        <input type="text" class="form-control form-control-sm" name="creditnote_owner" id="creditnote_owner" readonly class="form-control form-control-sm" value="<?php echo $session_user; ?>" required />

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
                                        <input type="text" placeholder="Billing Street"  name="creditnote_billing_street" id="creditnote_billing_street" required class="form-control form-control-sm" > 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping Street" name="creditnote_shipping_street" id="creditnote_shipping_street" required class="form-control form-control-sm"  > 
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" required name="creditnote_billing_city" id="creditnote_billing_city"  placeholder=" Billing City" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping City" name="creditnote_shipping_city" id="creditnote_shipping_city" required class="form-control form-control-sm"> 
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select id="creditnote_billing_state" class="form-control form-control-sm billstate" name="creditnote_billing_state">
                                            <span class="text-muted"><option value="">Billing State</option> </span>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">											
                                        <select id="creditnote_shipping_state" class="form-control form-control-sm" name="creditnote_shipping_state">
                                            <span class="text-muted">  <option selected value="">Shipping State</option> </span>

                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="creditnote_billing_country" required name="creditnote_billing_country"> 
                                            <span class="text-muted">  
                                                <option value="" >Billing Country</option> </span>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="creditnote_shipping_country" required name="creditnote_shipping_country"> 
                                            <span class="text-muted">  
                                                <option value="" selected>Shipping Country</option> </span>

                                        </select>								  
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="creditnote_billing_zip" id="creditnote_billing_zip"  required placeholder="Billing Zip/Postal Code" value="">
                                    </div>	


                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="creditnote_shipping_zip" id="creditnote_shipping_zip"  required placeholder="Shipping Zip/Postal Code">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="creditnote_billing_phone" id="creditnote_billing_phone"  required placeholder="Billing Phone" value="">
                                    </div>	

                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="creditnote_shipping_phone"  id="creditnote_shipping_phone"  required placeholder="Shipping Phone">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="creditnote_billing_gstin" id="creditnote_billing_gstin"  required placeholder="Billing GSTIN No" value="" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="creditnote_shipping_gstin" id="creditnote_shipping_gstin"  required placeholder="Shipping GSTIN No">
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
                                                <?php $qr  = "select * from salesitemaster2  ;";
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



                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Notes Information</h5>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Add Credit Notes</label>
                                        <textarea rows="2" class="form-control editor" id="creditnote_notes" name="creditnote_notes" placeholder="add product/price/stock related notes here"></textarea>
                                    </div> 
                                </div>

                                <!--div class="form-row">
<div class="form-group col-md-6">
<label>
<div class="fa-hover col-md-12 col-sm-12">
&nbsp;<i class="fa fa-folder-open bigfonts" aria-hidden="true"></i>Upload Screen Shots</div>
</label> 
&nbsp;&nbsp;<input type="file" name="image" class="form-control" >
</div>
</div-->

                                <div class="form-row">
                                    <div class="col-md-12 col-md-offset-12">
                                        <input type="checkbox" id="creditnote_email_notification" name="creditnote_email_notification">
                                        <label for="subscribeNews">Send a Credit Note information email notification to Customer</label>									
                                    </div>
                                </div><br/>



                                <div class="form-row">
                                    <div class="modal-footer">
                                        <!--input type="hidden" name="vendorCreditID" value="<?=$_GET['id']?>"-->

                                        <button id="submit-form" class="btn btn-primary" name="vendorCredit" value="vendorCredit" type="submit">
                                            Submit
                                        </button>
                                        <button id="cancel-form" type="reset" name="cancel" class="btn btn-secondary m-l-5">
                                            Cancel
                                        </button>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="alert alert-danger alert-dismissible" id="message-alert" role="alert">

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


    <script>

        var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
        var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
        var page_creditnote_id = "<?php if(isset($_GET['creditnote_id'])){ echo $_GET['creditnote_id']; } ?>";
        var page_inv_code = "<?php if(isset($_GET['inv_code'])){ echo $_GET['inv_code']; } ?>";


        $(function(){

            var suptype_params=[];
            $('#message-alert').hide();

            //comp_params[0]={"primaryflag":"1"};  
            Page.load_select_options('v_credits_suptype',suptype_params,'suptype','Company Code','id','suptype',3);

            var loction_params = [];


            Page.load_select_options('creditnote_billing_state',loction_params,'state','Billing State','code','description',3);            Page.load_select_options('creditnote_shipping_state',loction_params,'state','Shipping State','code','description',3);
            Page.load_select_options('creditnote_shipping_country',loction_params,'country','Shipping Country','code','description',3);
            Page.load_select_options('creditnote_billing_country',loction_params,'country','Billing Country','code','description',3);

            if(page_action=="edit"){
                var credits_data = Page.get_edit_vals(page_v_credits_id,"vendorcredits","v_credits_id");
                $('#v_credits_suptype').val(credits_data.v_credits_suptype);
                get_vendors(credits_data.v_credits_suptype);
                $('#v_credits_vendorid').val(credits_data.v_credits_vendorid);
                $('#v_credits_paymentmode').val(credits_data.v_credits_paymentmode);
                $('#v_credits_paymentdate').val(credits_data.v_credits_paymentdate);
                $('#v_credits_handler').val(credits_data.v_credits_handler);
                $('#v_credits_amount').val(credits_data.v_credits_amount);
                $('#v_credits_notes').val(credits_data.v_credits_notes);               
                $('#v_credits_refno').val(credits_data.v_credits_refno);               

            }


            if(page_action=="add"&&page_inv_code!=''){
                var inv_data = Page.get_edit_vals(page_inv_code,"invoices","inv_code");
                $('#creditnote_customer').val(inv_data.inv_customer);
                $('#creditnote_cust_ref_no').val(inv_data.inv_code);
                $('#creditnote_comp_code').val(inv_data.inv_comp_code);
                $('#creditnote_billing_street').val(inv_data.inv_billing_street);
                $('#creditnote_billing_city').val(inv_data.inv_billing_city);
                $('#creditnote_billing_state').val(inv_data.inv_billing_state);
                $('#creditnote_billing_country').val(inv_data.inv_billing_country);
                $('#creditnote_billing_zip').val(inv_data.inv_billing_zip);
                $('#creditnote_billing_phone').val(inv_data.inv_billing_phone);
                $('#creditnote_billing_gstin').val(inv_data.inv_billing_phone); 

                set_math_vals(JSON.parse(inv_data.inv_items));

            }

            $('#billing_to_shipping').click(function(){
                $('#creditnote_shipping_street').val($('#creditnote_billing_street').val());
                $('#creditnote_shipping_city').val($('#creditnote_billing_city').val());
                $('#creditnote_shipping_state').val($('#creditnote_billing_state').val());
                $('#creditnote_shipping_country').val($('#creditnote_billing_country').val());
                $('#creditnote_shipping_zip').val($('#creditnote_billing_zip').val());
                $('#creditnote_shipping_phone').val($('#creditnote_billing_phone').val());
                $('#creditnote_shipping_gstin').val($('#creditnote_billing_gstin').val());
            });


            $('#shipping_to_billing').click(function(){
                $('#creditnote_billing_street').val($('#creditnote_shipping_street').val());
                $('#creditnote_billing_city').val($('#creditnote_shipping_city').val());
                $('#creditnote_billing_state').val($('#creditnote_shipping_state').val());
                $('#creditnote_billing_country').val($('#creditnote_shipping_country').val());
                $('#creditnote_billing_zip').val($('#creditnote_shipping_zip').val());
                $('#creditnote_billing_phone').val($('#creditnote_shipping_phone').val());
                $('#creditnote_billing_gstin').val($('#creditnote_shipping_gstin').val());
            });

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

        });      
    </script>



    <script>

        function post_address(custid){
            var vals = Page.get_edit_vals(custid,"customerprofile","custid");
            $('#creditnote_billing_street').val(vals.address);
            $('#creditnote_billing_city').val(vals.city);
            $('#creditnote_billing_state').val(vals.state);
            $('#creditnote_billing_country').val(vals.country);
            $('#creditnote_billing_zip').val(vals.zip);
            $('#creditnote_billing_phone').val(vals.mobile);
            $('#creditnote_billing_gstin').val(vals.gstin); 

        }

        $("#cancel-form").click(function(){
            location.href="listVendorCredits.php";
        });


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
                    var tt = eval(podiscount/totalamt)*100;
                    $('#podiscount').val(tt);
                    $('#discoutTypeTextbutton #discoutTypeText').html('%');
                    $('#discoutTypeTextbutton').attr('data-meth','percent');
                }
                $('#poadjustmentval').val(poadjustmentval);

            }

            sales_rowitem.update_math_vals();
        }


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
        $("form#addcreditnote_form").submit(function(e){
            e.preventDefault();
            var $form = $(this);
            var data = getFormData($form);

            var rowCount = $('#tb tr').length;
            var inv_items = [];

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

                var inv_items_ele = {
                    itemdetails : item_details,
                    itemcode : item_select,
                    hsncode : hsncode,
                    rwqty : rwqty,
                    tax_val : tax_val,
                    tax_id : tax_id,
                    tax_method : tax_method,
                    tax_type : tax_type,
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


            // console.log($('#v_credits_email_notification').is(":checked"));
            data.table = "creditnotes";
            data.creditnote_value = $('#pobaltotal').text();
            data.creditnote_items = JSON.stringify(inv_items);
            data.creditnote_inv_code = data.creditnote_cust_ref_no;
            data.creditnote_email_notification =$('#creditnote_email_notification').is(":checked")?"yes":"no";

            $.ajax ({
                url: 'workers/setters/save_creditnote.php',
                type: 'post',
                data: {array : JSON.stringify(data),creditnote_id:page_creditnote_id,action:page_action?page_action:"add",table:"creditnotes"},
                dataType: 'json',
                success:function(response){
                    location.href="listInvoices.php";
                }


            });

        });
    </script>			


    </body>
</html>