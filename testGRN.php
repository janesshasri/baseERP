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
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Sales Person</label>
                                        <input type="text" class="form-control form-control-sm"  id="po_owner" name="so_owner" readonly class="form-control form-control-sm"  required />

                                    </div>
                                </div>

                                <!--div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                        <select id="so_comp_code" onchange="oncompcode(this.value);" class="form-control form-control-sm" name="so_comp_code">
                                            <option selected>Open Company Code</option>
                                        </select>
                                        <script>
                                            function oncompcode(x)
                                            {    
                                                $.ajax({
                                                    url: "workers/getters/get_address.php?compcode=" + x,
                                                    type: "post",
                                                    async: false,
                                                    success: function(x) {
                                                        var output = JSON.parse(x);
                                                        if (output.status) {
                                                            post_address(output.values[0]);
                                                        } else {
                                                        }
                                                    }
                                                });

                                                /*       var supcode=x.value;
                                        window.location.href = 'addPurchaseOrder.php?supcode='+supcode;*/
                                            }

                                            function post_address(vals){
                                                $('#po_billing_street').val(vals.address);
                                                $('#po_billing_city').val(vals.city);
                                                $('#po_billing_state').val(vals.state);
                                                $('#po_billing_country').val(vals.country);
                                                $('#po_billing_zip').val(vals.zip);
                                                $('#po_billing_phone').val(vals.mobile);
                                                $('#po_billing_gstin').val(vals.gstin); 

                                            }
                                        </script>
                                    </div>
                                </div-->

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Customer Name<span class="text-danger">*</span></label>
                                        <select id="so_customer" class="form-control form-control-sm" name="so_customer">
                                            <option selected>--Select Customer--</option>
                                        </select>

                                    </div>
                                </div>
								
								 <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Reference#</label>
                                         <input type="text" placeholder="Customer Reference No" name="so_cust_ref_no" id="so_cust_ref_no" class="form-control form-control-sm"> 
                                    
                                    </div>
                                </div>

                                 <div class="form-row">                                
                                    <div class="form-group col-md-4">									
                                        <label>Delivery Challan Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="estdate" name="estdate" required autocomplete="off">
                                    </div>
									<div class="form-group col-md-4">									
                                        <label for="inputState">Delivery Challan Type<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" required name="po_status"  id="po_status">
                                            <option value="Created">Job Work</option>
											<option value="Sent">Supply on Approval</option>                                            
                                            <option value="Accepted">Others</option>
                                           </select>											
                                    </div>
                                
								</div>
												
								<div class="form-row">  
								    <div class="form-group col-md-8" >
                                        <label for="inputState">Status<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" required name="po_status"  id="po_status">
                                            <option value="Created">Created</option>
											<option value="Delivered">Delivered</option>
                                            <option value="Invoiced">Invoiced</option>
											<option value="Invoiced">Returned</option>                                            
                                            <option value="Cancelled">Cancelled</option>
											<option value="Closed">Closed</option>
                                        </select>											
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
                                        <th width="30%">Item Details</th>
                                        <th width="15%">Qty(Ordred)</th>
                                        <th width="15%"><i class="fa fa-rupee" aria-hidden="true">&nbsp;Price</i></th>
                                        <th width="5%">Qty(Received)</th>
                                        <th width="15%" > <i class="fa fa-rupee" aria-hidden="true"><b>&nbsp;Amount</b></i></th>
                                        <!--th width="8%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Discount</b></i></th>
<th width="10%"> GST@%</th-->
                                        <th width="30%"> <i class="fa fa-rupee" aria-hidden="true"><b>&nbsp;Total</b></i></th>

                                        <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
                                            <span class="glyphicon glyphicon-plus"></span></a></th>
                                    <tr>

                                        <td>
                                            <div id="itemdetails">

                                            </div>
                                        </td>
                                        <td><input type="text" name="qtyorded" id="qtyorded" readonly placeholder="orderd qty" class="form-control"></td>
                                        <td style="display:none;"><input type="text" name="itemcode" id="itemcode" readonly class="form-control"></td>
                                        <td><input type="text" name="price" id="price" placeholder="price" class="form-control"></td>
                                        <td><input type="text" name="qtydlvrd" id="qtydlvrd" placeholder="qtydlvrd" onkeypress="update_math_vals();"   onkeyup="update_math_vals();" class="form-control"></td>
                                        <td><input type="text" readonly name="amount" id="amount" class="form-control" placeholder="Amount"></td>

                                        <td>                       <select readonly class="form-control amount" id="taxname"  onchange="update_math_vals();"; name="taxname" style="line-height:1.5;">
                                            <option data-type="single" value="0" selected>Open Taxrate</option>
                                            <?php 

                                            $sql = mysqli_query($dbcon, "SELECT taxname,taxrate,taxtype FROM taxmaster ");
                                            while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                $taxtype=$row['taxtype'];
                                                echo '<option data-type="'.$taxtype.'" value="'.$taxrate.'" >'.$taxname.'</option>';
                                            }
                                            ?>
                                            </select></td>
                                        <!--td><input type="text" name="total[]" class="form-control total" data-id="" placeholder="Item Total"></td-->

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

                                                    <p class="h6">Discount: </p>
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

                                                        <p class="h6">Adjustment : </p>
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
                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
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


        $(function(){
            $('#addMore').on('click', function() {
                var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                data.find("input").val('');
            });
            $(document).on('click', '.remove', function() {
                var trIndex = $(this).closest("tr").index();
                if(trIndex>1) {
                    $(this).closest("tr").remove();
                } else {
                    alert("Sorry!! Can't remove first row!");
                }

            });

            ////set select options
            var user_params = [];
            var vendor_params = [];
            var paymentterm_params = [];
            // Page.load_select_options('grn_owner',user_params,'userprofile','user','username',null);
            $('#grn_owner').val('<?php echo $session_user; ?>');
            Page.load_select_options('grn_po_vendor',vendor_params,'vendorprofile','Vendor Code','vendorid','supname'); 
            Page.load_select_options('grn_po_payterm',paymentterm_params,'paymentterm','Payment  Term','noofdays','paymentterm');


            if(page_action=="edit"){
                $('#grn_po_vendor').val(page_vendor);
                var grn_data =  get_form_datum_grn_id(page_grn_id,page_table);
                set_grn_values(grn_data);
                var po_data = get_po_values(grn_data.grn_po_code);
                set_po_form_vals(po_data);
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
            $('#grn_po_code').val(data.grn_po_code);
            $('#grn_invoice_no').val(data.grn_invoice_no);
            $('#grn_invoice_date').val(data.grn_invoice_date);
            $('#grn_notes').val(data.grn_notes);
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
            console.log(data);
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

            for(r=0;r<itemrowCount;r++){

                if(r<itemrowCount-1){
                    var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                }

                $('#tb tr').eq(r+1).find('#itemdetails').html(po_items_json[r].itemdetails+"<br/>hsncode :"+po_items_json[r].hsncode);
                $('#tb tr').eq(r+1).find('#price').val(po_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#itemcode').val(po_items_json[r].itemcode);
                $('#tb tr').eq(r+1).find('#qtyorded').val(po_items_json[r].rwqty);
                $('#tb tr').eq(r+1).find('#qtydlvrd').val(po_items_json[r].rwqty);
                $('#tb tr').eq(r+1).find('#taxname').val(po_items_json[r].tax_val);
                //$('#tb tr').eq(r+1).find('#uom').val(po_items_json[r].uom);
                var po_discount=po_items_json[r].podiscount?po_items_json[r].podiscount:"--";
                var poadjustmentval=po_items_json[r].poadjustmentval?po_items_json[r].poadjustmentval:"--";
                $('#podiscountText').text(po_discount);
                $('#poadjustment').text(poadjustmentval);


            }

            update_math_vals();
        }

        function set_math_vals_grn(po_items_json){
            var itemrowCount = po_items_json.length;
            var rowCount = $('#tb tr').length;

            for(r=0;r<itemrowCount;r++){
                console.log(r);
                if(r<itemrowCount-1){
                    var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                }

                $('#tb tr').eq(r+1).find('#itemdetails').html(po_items_json[r].itemdetails);
                $('#tb tr').eq(r+1).find('#price').val(po_items_json[r].rwprice);
                $('#tb tr').eq(r+1).find('#itemcode').val(po_items_json[r].itemcode);
                $('#tb tr').eq(r+1).find('#qtyorded').val(po_items_json[r].rwqty);
                $('#tb tr').eq(r+1).find('#qtydlvrd').val(po_items_json[r].rwqty);
                $('#tb tr').eq(r+1).find('#taxname').val(po_items_json[r].tax_val);
                //$('#tb tr').eq(r+1).find('#uom').val(po_items_json[r].uom);
                var po_discount=po_items_json[r].podiscount?po_items_json[r].podiscount:"--";
                var poadjustmentval=po_items_json[r].poadjustmentval?po_items_json[r].poadjustmentval:"--";
                $('#podiscountText').text(po_discount);
                $('#poadjustment').text(poadjustmentval);


            }

            update_math_vals();
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
            update_math_vals();

        }

        function update_math_vals(){


            var item_select = $('#tb tr').eq(1).find('#item_select').val();
            if(item_select!=''){


                var rowCount = $('#tb tr').length;
                var posubtotal = 0;
                var taxarray = [];
                for(i=1;i<rowCount;i++){ 
                    var rwqty = $('#tb tr').eq(i).find('#qtyorded').val();
                    var rwqtydlvrd = $('#tb tr').eq(i).find('#qtydlvrd').val();
                    var tax_val = $('#tb tr').eq(i).find('#taxname').val();
                    var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');
                    var tax_name = $('#tb tr').eq(i).find('#taxname option:selected').text();
                    var rwprice = $('#tb tr').eq(i).find('#price').val();
                    if(rwqtydlvrd!=""){
                        $('#tb tr').eq(i).find('#amount').val(rwqtydlvrd*rwprice);
                        posubtotal+=rwqtydlvrd*rwprice;

                    }else{
                        $('#tb tr').eq(i).find('#amount').val(rwqty*rwprice);
                        posubtotal+=rwqty*rwprice;

                    }
                    var taxsys = {
                        tax_desc : tax_name,
                        tax_val : tax_val,
                        tax_type : tax_type

                    };

                    taxarray[i-1]=taxsys;
                }

                $('#posubtotal').text(eval(posubtotal).toFixed(2));

                var podiscount = $('#podiscountText').text();
                var podeduction= podiscount!="--"?eval(podiscount):0;

                var tax_text = gettax_text(taxarray);
                $('#taxdiv').html('');
                $('#taxdiv').html(tax_text.taxhtml);

                var pograndtotal = Math.round(eval(posubtotal - podeduction));
                pograndtotal = (eval(pograndtotal) + eval(tax_text.total_tax_amt_master)).toFixed(2);

                $('#pograndtotal').text(pograndtotal);
                var poadjustmentval = $('#poadjustment').text();
                var poadjustmentvalinput = poadjustmentval!="--"?eval($('#poadjustment').text()):0;
                var finalval = (eval(pograndtotal)+eval(poadjustmentvalinput)).toFixed(2);

                $('#pobaltotal').text(finalval);   

            }
        }
        function gettax_text(taxarray){
            var return_val = {};
            var taxhtml = "";
            globpblist=taxarray;
            var temp=[];
            globpblist=globpblist.filter((x, i)=> {
                if (temp.indexOf(x.tax_val) < 0) {
                    temp.push(x.tax_val);
                    return true;
                }
                return false;
            });
            globpblist2=globpblist;
            var temp=[];
            globpblist2=globpblist2.filter((x, i)=> {
                if (temp.indexOf(x.tax_val) < 0) {
                    temp.push(x.tax_val);
                    return true;
                }
                return false;
            });

            var total_tax_amt_master = 0;
            for(t=0;t<globpblist.length;t++){

                var taxrate_text = eval(globpblist[t].tax_val)/2;
                var taxamt = get_taxamount(globpblist[t].tax_val);
                total_tax_amt_master = total_tax_amt_master+taxamt;
                $('#total_tax_amt').text();
                if(globpblist[t].tax_type=="single"){
                    taxhtml+= '<br/><div class="col-md-12" >'+
                        ' <div class="row">'+
                        ' <div class="col-md-8"><p class="h6">IGST @ '+taxrate_text*2+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+eval(taxamt).toFixed(2)+'</span></div>'+
                        '  </div>';
                }else{
                    taxhtml+= '<br/><div class="col-md-12" >'+
                        ' <div class="row">'+
                        ' <div class="col-md-8"><p class="h6">CGST @ '+taxrate_text+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+eval(taxamt/2).toFixed(2)+'</span></div>'+
                        '  </div>'+
                        ' <div class="row">'+
                        ' <div class="col-md-8"><p class="h6">SGST @ '+taxrate_text+'% </p></div>'+
                        ' <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger"   >'+eval(taxamt/2).toFixed(2)+'</span></div>'+
                        '  </div>'+
                        ' </div> ';   
                }

            }



            return {
                taxhtml:  taxhtml,
                total_tax_amt_master: total_tax_amt_master
            };
        }
        function get_taxamount(taxval){
            var rowCount = $('#tb tr').length;

            total_taxval = 0;
            for(i=1;i<rowCount;i++){ 
                itax_val = $('#tb tr').eq(i).find('#taxname').val();
                if(itax_val==taxval){
                    var taxamt = $('#tb tr').eq(i).find('#amount').val();
                    total_taxval=total_taxval+(eval(taxamt)*(eval(taxval)/100));

                }
            }
            return total_taxval;
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

            for(i=1;i<rowCount;i++){ 
                var item_details = $('#tb tr').eq(i).find('#itemdetails').text();
                var itemcode = $('#tb tr').eq(i).find('#itemcode').val();
                var qtydlvrd = $('#tb tr').eq(i).find('#qtydlvrd').val();
                var tax_val = $('#tb tr').eq(i).find('#taxname').val();
                var rwprice = $('#tb tr').eq(i).find('#price').val();
                var rwamt = $('#tb tr').eq(i).find('#amount').val();
                // var uom = $('#tb tr').eq(i).find('#uom').val();
                var podiscount = $('#podiscountText').text();
                var poadjustmentval = $('#poadjustment').text();
                var po_items_ele = {
                    itemdetails : item_details,
                    itemcode : itemcode,
                    rwqty : qtydlvrd,
                    tax_val : tax_val,
                    rwprice : rwprice,
                    rwamt : rwamt,
                    podiscount : podiscount,
                    poadjustmentval:poadjustmentval
                    // uom : uom
                };

                grn_po_items[i-1]=po_items_ele;

            }
    


            var $form = $("#add_grn_form");
            var data = getFormData($form);
            function getFormData($form){
                var unindexed_array= $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    if(n['name']=="grn_po_vendor"||n['name']=="hsncode"||n['name']=="qty"||n['name']=="unit"||n['name']=="price"||n['name']=="amount"||n['name']=="taxname"||n['name']=="uom"||n['name']=="po_owner"||n['name']=="grn_po_date"||n['name']=="grn_po_payterm"||n['name']=="grn_po_shippingvia"||n['name']=="grn_po_deliveryat"||n['name']=="qtyorded"||n['name']=="qtydlvrd"||n['name']=="itemcode"){

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