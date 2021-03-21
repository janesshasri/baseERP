
<?php include('header.php');?>
<!-- End Sidebar -->


<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Vendor Payments</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Vendor Payments</li>
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


            <div class="row" >					
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">					
                    <div class="card mb-3">
                        <div class="card-header">
                            <!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->

                            <h3>
                                <i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i> Vendor Payments
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">

                                    <!--form autocomplete="off" action="#"-->
                                    <form  autocomplete="off" action="#" id="add_payment_form" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-8" >
                                                <label for="inputState">Vendor Name</label>
                                                <select id="payment_vendor" onchange="onvendor_select(this.value);" class="form-control form-control-sm"  required name="payment_vendor" autocomplete="off">
                                                    <option selected>Open Vendors</option>

                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-row">


                                            <div class="form-group col-md-4">
                                                <label for="inputState">Invoice#</label>
                                                <select id="payment_invoice_no"  class="form-control form-control-sm"  onchange="oninvoice_select(this.value);" required name="payment_invoice_no" autocomplete="off">
                                                    <option selected>Select Invoice</option>

                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">										
                                                <label>Enter Amount <span class="text-danger">*&nbsp;</span><i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;[INR]</label>
                                                <input onkeypress="show_credits_input();"   onkeyup="show_credits_input();" type="text" class="form-control form-control-sm" name="payment_amount" id="payment_amount" placeholder="Enter Amount" required class="form-control" autocomplete="off" value="0" />
                                            </div>

                                        </div>

                                        <div class="form-row" id="show_credit_div" style="display:none;">


                                            <div class="form-group col-md-4">
                                                <label for="inputState">Total Amount</label>
                                                <p id="total_amount"></p>
                                            </div>

                                            <div class="form-group col-md-4">										
                                                <label>Enter Credit Amount <span class="text-danger">*&nbsp;</span><i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;[INR]</label>
                                                <input onkeypress="show_credits_input();"   onkeyup="show_credits_input();" type="text" class="form-control form-control-sm" id="payment_amount_credit" placeholder="Enter Credit Amount" class="form-control" autocomplete="off" />
                                            </div>

                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Payment Date<span class="text-danger">*</span></label>									 
                                                <input type="payment_date" class="form-control form-control-sm"  name="payment_date" value="<?php echo date("Y-m-d");?>">					  
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label >Payment Mode<span class="text-danger">*</span></label>
                                                <select required id="payment_mode" data-parsley-trigger="change"  class="form-control form-control-sm"  name="payment_mode" >
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
                                            <div class="form-group col-md-8">										
                                                <label>Bank Name</label>
                                                <input type="text" class="form-control form-control-sm" name="payment_bank" id="payment_bank" placeholder="Bank Name"  class="form-control" autocomplete="off" />
                                            </div>
                                        </div>

                                        <div class="form-row">								
                                            <div class="form-group col-md-8">										
                                                <label>Reference #</label>
                                                <input type="text" class="form-control form-control-sm" name="payment_ref_no" id="payment_ref_no" placeholder=" Reference Number(optional)"  class="form-control" autocomplete="off" />
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="inputState">Handler</label>

                                                <input type="text" class="form-control form-control-sm" name="payment_user" id="payment_user" readonly class="form-control form-control-sm" value="<?php echo $session_user; ?>" required />

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label>Add Notes</label>
                                                <textarea rows="2" class="form-control editor" id="payment_notes" name="payment_notes" placeholder="Internal Notes"></textarea>
                                            </div> 
                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-12 col-md-offset-12">
                                                <input type="checkbox" id="paymentemail" name="paymentemail" value="payment_email">
                                                <label for="subscribeNews">Send a Payment Made email notification to Vendor</label>									
                                            </div>
                                        </div><br/>




                                        <div class="form-row">
                                            <div class="form-group text-right m-b-12">
                                                <input type="hidden"  >
                                                &nbsp;<button id="submit-form" class="btn btn-primary" name="submit" type="submit">
                                                Submit
                                                </button>

                                                <button id="cancel-form" type="" name="cancel" class="btn btn-secondary m-l-5">
                                                    Cancel
                                                </button>
                                            </div>
                                            <div>

                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-md-4">
                                    <!--grn details-->
                                    <h4>Bill Details</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p><b>GRN # :</b></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="text_grn_id"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p><b>PO # :</b></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="text_po_code"></p>
                                        </div>
                                    </div>
                                    <!--                 <div class="row">
<div class="col-md-7">
<p><b>Credits Available :</b></p>
</div>
<div class="col-md-5">
<p id="text_amount_payable"></p>
</div>
</div>-->
                                    <!--    <div class="row">
<div class="col-md-7">
<p><b>Amount Payable :</b></p>
</div>
<div class="col-md-5">
<p id="text_amount_payable"></p>
</div>
</div>-->
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p><b>Amount Paid :</b></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="text_amount_paid"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p><b>Amount Payable :</b></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="text_balance"></p>
                                        </div>
                                    </div>
                                    <div class="row" id="credit_balance_div" style="display:none;">
                                        <div class="col-md-7">
                                            <p><b>Available Credits :</b></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="credit_balance">

                                            </p>
                                        </div>
                                    </div>
                                    <!--                                    <div class="row" id="use_credits_row" style="display:none;">
<div class="col-md-7">
</div>
<div class="col-md-5">
<a href="#" onclick="show_credits_input();">Use Credits</a>
</div>
</div>-->
                                </div>
                            </div>


                        </div>



                    </div>
                </div>
                <!-- END container-fluid -->
            </div>
            <!-- END content -->
        </div>
        <!-- BEGIN Java Script for this page -->
        <script>


            var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
            var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
            var page_vendor = "<?php if(isset($_GET['vendorid'])){ echo $_GET['vendorid']; } ?>";
            var page_payment_invoice_no = "<?php if(isset($_GET['invoice_no'])){ echo $_GET['invoice_no']; } ?>";
            var page_payment_v_credits_id = "<?php if(isset($_GET['v_credits_id'])){ echo $_GET['v_credits_id']; } ?>";

            $(function(){
                var vendor_params =[];
                Page.load_select_options('payment_vendor',vendor_params,'vendorprofile','Vendor Code','vendorid','supname'); 

                if(page_action=="add"&&page_payment_invoice_no){
                    $('#payment_vendor').val(page_vendor);
                    onvendor_select(page_vendor);
                    $('#payment_invoice_no').val(page_payment_invoice_no);
                    oninvoice_select(page_payment_invoice_no);

                }

            });

            function onvendor_select(val){

                $.ajax ({
                    url: 'workers/getters/get_invoices.php',
                    type: 'post',
                    async:false,
                    data: {payment_vendor:val},
                    dataType: 'json',
                    success:function(response){
                        Page.plant("payment_invoice_no",response.status,response.values,"grn_invoice_no",null,null,"Invoices");

                    }


                });

                if(page_payment_v_credits_id!=''){
                    var credits_data = Page.get_edit_vals(page_payment_v_credits_id,'vendorcredits','v_credits_id');

                    $('#credit_balance').text(credits_data.v_credits_availcredits);   
                    $('#credit_balance_div').show();   
                    if(credits_data.v_credits_availcredits>0){
                        show_credits_input();
                        $('#show_credit_div').show();
                        $('#payment_amount_credit').val(credits_data.v_credits_availcredits); 
                        show_credits_input();
                    }
                }


            }

            function show_credits_input(){
                var amount = $('#payment_amount').val()?$('#payment_amount').val():0;
                var credit = $('#payment_amount_credit').val()?$('#payment_amount_credit').val():0;
                var curr_total_amt = eval(credit)+eval(amount);
                $('#total_amount').text(curr_total_amt);

            }

            function oninvoice_select(val){

                var grn_data = get_grn_values(val);
                $('#text_grn_id').text(grn_data.grn_id);
                $('#text_po_code').text(grn_data.grn_po_code);
                $('#text_amount_payable').text(grn_data.grn_po_value); 
                $('#text_amount_paid').text(eval(grn_data.grn_po_value)-eval(grn_data.grn_balance)); 
                $('#text_balance').text(grn_data.grn_balance); 

            }


            function get_form_values(code){
                var edit_data = Page.get_edit_vals(code,'payments','payment_id');
                return edit_data;
            }

            function get_grn_values(code){
                var edit_data = Page.get_edit_vals(code,'grn_notes','grn_invoice_no');
                return edit_data;
            }

            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){

                    if(n['name']=="id"||n['payment_amount_credit']){

                    }else{
                        indexed_array[n['name']] = n['value'];

                    }
                });

                return indexed_array;
            }


            $("#cancel-form").click(function(){
                location.href="listPaymentsMade.php";
            });

            $("form#add_payment_form").submit(function(e){
                e.preventDefault();

                var $form = $(this);
                var data = getFormData($form);

                var payable_amount = eval($('#text_balance').text());

                if(page_payment_v_credits_id!=''){
                    var amount = $('#payment_amount').val()?$('#payment_amount').val():0;
                    var credit = $('#payment_amount_credit').val()?$('#payment_amount_credit').val():0;
                    var curr_total_amt = eval(credit)+eval(amount);
                    $('#total_amount').text(curr_total_amt);
                    data.payment_credits_used = credit;
                    data.payment_amount = curr_total_amt;

                    var availabe_credit = eval($('#credit_balance').text());
                    if(eval(data.payment_amount)>payable_amount){
                        alert('Total Payment cannot be greater than Payable Amount ');
                        $('#submit-form').show();
                        $('#cancel-form').show();

                        return false;
                    }

                    if(credit>availabe_credit){
                        alert('You are above your credit balance ');
                        $('#submit-form').show();
                        $('#cancel-form').show();

                        return false;
                    }
                }

                if(eval(data.payment_amount)>payable_amount){
                    alert('Total Payment cannot be greater than Payable Amount ');
                    $('#submit-form').show();
                    $('#cancel-form').show();

                    return false;
                }

                data.table = "payments";
                data.payment_grn_id = $('#text_grn_id').text();
                data.payment_po_code = $('#text_po_code').text();

                $.ajax ({
                    url: 'workers/setters/save_payments.php',
                    type: 'post',
                    data: {
                        array : JSON.stringify(data),
                        payment_id:"",
                        payment_grn_id:data.payment_grn_id,
                        payment_amount:data.payment_amount,
                        action:"add",table:"payments",
                        page_payment_v_credits_id:page_payment_v_credits_id
                    },
                    dataType: 'json',
                    success:function(response){
                        if(response.status){
                            location.href="listGoodsReceiptNote.php";
                        }
                    }


                });

            });
        </script>

        <?php include('footer.php');?>

