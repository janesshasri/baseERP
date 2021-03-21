
<?php include('header.php');?>
<!-- End Sidebar -->


<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Customer Payments Receipts</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Customer Payments Receipts</li>
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
                                <i class="fa fa-rupee bigfonts" aria-hidden="true"></i> Record Customer Payments 
                            </h3>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-8">

                                    <!--form autocomplete="off" action="#"-->
                                    <form  autocomplete="off" action="#" id="add_cust_payment_form" enctype="multipart/form-data">

                                        <div class="form-row">
                                            <div class="form-group col-md-8" >
                                                <label for="inputState">Customer Name</label>
                                                <select id="cust_payment_customer" onchange="customer_select(this.value);" class="form-control form-control-sm"  required name="cust_payment_customer" autocomplete="off">
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


                                            <div class="form-group col-md-4">
                                                <label for="inputState"><span class="text-danger">Invoice#*</span></label>
                                                <select id="cust_payment_invoice_no"  class="form-control form-control-sm"  onchange="oninvoice_select(this.value);" required name="cust_payment_invoice_no" autocomplete="off">
                                                    <option selected>Select Invoice</option>

                                                </select>
                                            </div>

                                            <div class="form-group col-md-4">										
                                                <label><span class="text-danger">Enter Amount *<i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;[INR]</span></label>
                                                <input onkeypress="show_credits_input();"   onkeyup="show_credits_input();" type="text" class="form-control form-control-sm" name="cust_payment_amount" id="cust_payment_amount" placeholder="Enter Amount" required class="form-control" autocomplete="off" value="0" />
                                                <input type="checkbox" id="fullpayment" name="fullpayment" value="cust_payment_email">
                                                <label for="subscribeNews">Receive full Payment(<i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;)</label>									

                                            </div>

                                        </div>

                                        <div class="form-row" id="show_credit_div" style="display:none;">


                                            <div class="form-group col-md-4">
                                                <label for="inputState">Total Amount</label>
                                                <p id="total_amount"></p>
                                            </div>

                                            <div class="form-group col-md-4">										
                                                <label><span class="text-danger">Enter Credit Amount*</span><i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;[INR]</label>
                                                <input onkeypress="show_credits_input();"   onkeyup="show_credits_input();" type="text" class="form-control form-control-sm" id="cust_payment_amount_credit" placeholder="Enter Credit Amount" class="form-control" autocomplete="off" />
                                            </div>

                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label>Payment Date<span class="text-danger">*</span></label>									 
                                                <input type="cust_payment_date" class="form-control form-control-sm"  name="cust_payment_date" value="<?php echo date("Y-m-d");?>">					  
                                            </div>

                                            <div class="form-group col-md-4">
                                                <label ><span class="text-danger">Payment Mode*</span></label>
                                                <select required id="cust_payment_mode" data-parsley-trigger="change"  class="form-control form-control-sm"  name="cust_payment_mode" >
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
                                                <label>Reference #</label>
                                                <input type="text" class="form-control form-control-sm" name="cust_payment_ref_no" id="cust_payment_ref_no" placeholder=" Reference Number"  class="form-control" autocomplete="off" />
                                            </div>
                                        </div>


                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label for="inputState">Handler</label>

                                                <input type="text" class="form-control form-control-sm" name="cust_payment_user" id="cust_payment_user" readonly class="form-control form-control-sm" value="<?php echo $session_user; ?>" required />

                                            </div>
                                        </div>

                                        <div class="form-row">
                                            <div class="form-group col-md-8">
                                                <label>Add Payment Notes</label>
                                                <textarea rows="2" class="form-control editor" id="cust_payment_notes" name="cust_payment_notes" placeholder="Internal Notes"></textarea>
                                            </div> 
                                        </div>


                                        <div class="form-row">
                                            <div class="col-md-12 col-md-offset-12">
                                                <input type="checkbox" id="cust_payment_email" name="cust_payment_email" value="payment_email">
                                                <label for="subscribeNews">Send a Payment Made email notification to Customer</label>									
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
                                    <h4>Invoice Details</h4>
                                    <hr>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p><b>Invoice # :</b></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="text_inv_id"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p><b>Sales Order# :</b></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="text_so_code"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p><b>Amount Payable :</b></p>
                                        </div>
                                        <div class="col-md-5">
                                            <p id="text_amount_payable"></p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-7">
                                            <p><b>Balance Due :</b></p>
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
            var page_cust_payment_inv_code = "<?php if(isset($_GET['inv_code'])){ echo $_GET['inv_code']; } ?>";
            var page_cust_payment_v_credits_id = "<?php if(isset($_GET['v_credits_id'])){ echo $_GET['v_credits_id']; } ?>";

            $(function(){
                var customer_params =[];
                Page.load_select_options('cust_payment_customer',customer_params,'customerprofile','Customer','custid','custname'); 

                if(page_action=="add"&&page_cust_payment_inv_code!=''){
                    var edit_data = Page.get_edit_vals(page_cust_payment_inv_code,"invoicesacc","inv_code");
                    $('#cust_payment_customer').val(edit_data.inv_customer);
                    customer_select(edit_data.inv_customer);
                    $('#cust_payment_invoice_no').val(edit_data.inv_code);
                    $('#cust_payment_ref_no').val(edit_data.inv_code);
                    oninvoice_select(edit_data.inv_code);

                }

            });

            function customer_select(val){

                $.ajax ({
                    url: 'workers/getters/get_invoicesacc.php',
                    type: 'post',
                    async:false,
                    data: {cust_payment_customer:val},
                    dataType: 'json',
                    success:function(response){
                        Page.plant("cust_payment_invoice_no",response.status,response.values,"inv_code",null,null,"Invoices");

                    }


                });

                if(page_cust_payment_v_credits_id!=''){
                    var credits_data = Page.get_edit_vals(page_cust_payment_v_credits_id,'vendorcredits','v_credits_id');

                    $('#credit_balance').text(credits_data.v_credits_availcredits);   
                    $('#credit_balance_div').show();   
                    if(credits_data.v_credits_availcredits>0){
                        show_credits_input();
                        $('#show_credit_div').show();
                        $('#cust_payment_amount_credit').val(credits_data.v_credits_availcredits); 
                        show_credits_input();
                    }
                }


            }

            function show_credits_input(){
                var amount = $('#cust_payment_amount').val()?$('#cust_payment_amount').val():0;
                var credit = $('#cust_payment_amount_credit').val()?$('#cust_payment_amount_credit').val():0;
                var curr_total_amt = eval(credit)+eval(amount);
                $('#total_amount').text(curr_total_amt);

            }

            function oninvoice_select(val){

                var inv_data = get_inv_values(val);
                $('#text_inv_id').text(inv_data.inv_code);
                $('#text_so_code').text(inv_data.grn_so_code);
                $('#text_amount_payable').text(inv_data.inv_value); 
                $('#text_balance').text(inv_data.inv_balance_amt); 

            }

            $("#fullpayment").change(function() {
                if(this.checked) {
                    var bal_amount = $('#text_balance').text();
                    $('#cust_payment_amount').val(eval(bal_amount));
                }else{
                    $('#cust_payment_amount').val(0);
                }
            });

            function get_form_values(code){
                var edit_data = Page.get_edit_vals(code,'payments','cust_payment_id');
                return edit_data;
            }

            function get_inv_values(code){
                var edit_data = Page.get_edit_vals(code,'invoicesacc','inv_code');
                return edit_data;
            }

            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){

                    if(n['name']=="id"||n['cust_payment_amount_credit']||n['name']=="fullpayment"){

                    }else{
                        indexed_array[n['name']] = n['value'];

                    }
                });

                return indexed_array;
            }


            $("#cancel-form").click(function(){
                location.href="listPaymentsMade.php";
            });

            $("form#add_cust_payment_form").submit(function(e){
                e.preventDefault();

                var $form = $(this);
                var data = getFormData($form);

                var payable_amount = eval($('#text_amount_payable').text());

                if(page_cust_payment_v_credits_id!=''){
                    var amount = $('#cust_payment_amount').val()?$('#cust_payment_amount').val():0;
                    var credit = $('#cust_payment_amount_credit').val()?$('#cust_payment_amount_credit').val():0;
                    var curr_total_amt = eval(credit)+eval(amount);
                    $('#total_amount').text(curr_total_amt);
                    data.cust_payment_credits_used = credit;
                    data.cust_payment_amount = curr_total_amt;

                    var availabe_credit = eval($('#credit_balance').text());
                    if(data.cust_payment_amount>payable_amount){
                        alert('Total Payment cannot be greater than Payable Amount ');
                        return false;
                    }

                    if(credit>availabe_credit){
                        alert('You are above your credit balance ');
                        return false;
                    }
                }

                if(eval(data.cust_payment_amount)>payable_amount){
                    alert('Total Payment cannot be greater than Payable Amount ');
                    return false;
                }

                data.table = "customer_paymentsacc";
                data.cust_payment_inv_id = $('#text_inv_id').text();
                data.cust_payment_so_code = $('#text_so_code').text();

                $.ajax ({
                    url: 'workers/setters/save_customer_paymentsacc.php',
                    type: 'post',
                    data: {
                        array : JSON.stringify(data),
                        cust_payment_id:"",
                        cust_payment_inv_id:data.cust_payment_inv_id,
                        cust_payment_amount:data.cust_payment_amount,
                        action:"add",table:"customer_paymentsacc",
                        page_cust_payment_v_credits_id:page_cust_payment_v_credits_id
                    },
                    dataType: 'json',
                    success:function(response){
                        location.href="listInvoicesacc.php";
                    }


                });

            });
        </script>

        <?php include('footer.php');?>

