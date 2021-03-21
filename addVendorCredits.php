
<?php include('header.php');?>
<!-- End Sidebar -->

<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Vendor Credits</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item"><a  href="index.php">Home</a></li>
                            <li class="breadcrumb-item active">Vendor Credits</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-xl-8">						
                    <div class="card mb-3">
                        <div class="card-header">
                            <h5><div class="text-muted font-light"><i class="fa fa-truck smallfonts" aria-hidden="true"></i>&nbsp;Add Vendor Credits<span class="text-muted"></span></div></h5>
                        </div>

                        <div class="card-body">
                            <form autocomplete="off" action="#" enctype="multipart/form-data" id="addcredits_form" method="post">
                                <!--
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Supplier Type</label>
<select required id="v_credits_suptype" onchange="get_vendors(this.value)"  class="form-control form-control-sm" name="v_credits_suptype">
<option value="">Open Supplier Type</option>
</select>	
</div>
</div>
-->


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Vendor Name<span class="text-danger">*</span></label>
                                        <select id="v_credits_vendorid" onchange="print_bill_addr(this.value);" class="form-control form-control-sm" name="v_credits_vendorid">
                                            <option selected>--Select Vendor Code--</option>
                                        </select>

                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6" id="vendor_bill_addr">

                                    </div>											
                                </div>

                                <div class="form-row">      
                                    <div class="form-group col-md-6">
                                        <label >Payment Mode<span class="text-danger">*</span></label>
                                        <select required name="v_credits_paymentmode" id="v_credits_paymentmode" data-parsley-trigger="change"  class="form-control form-control-sm"  name="v_credits_paymentmode" >
                                            <option value="">-- Select Payment Mode --</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="Credit Card">Credit Card</option>
                                            <option value="Bank Transfer">Bank Transfer</option>
                                            <option value="Bank Remittance">Bank Remittance</option>
                                        </select>
                                    </div>
                                </div>


                                <!-- Modal Ends-->	
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputState">Credit Date</label>									
                                        <input type="date" class="form-control form-control-sm"  id="v_credits_paymentdate" name="v_credits_paymentdate" value="<?php echo date("Y-m-d");?>">		
                                    </div>

                                    <div class="form-group col-md-3">									  
                                        <label>Enter Credits</label>
                                        <input type="text" class="form-control form-control-sm" name="v_credits_amount" id="v_credits_amount" placeholder="Credit Amount"  required class="form-control" autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Handler</label>

                                        <input type="text" class="form-control form-control-sm" name="v_credits_handler" id="v_credits_handler" readonly class="form-control form-control-sm" value="<?php echo $session_user; ?>" required />

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Notes Information</h5>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Add Notes</label>
                                        <textarea rows="2" class="form-control editor" id="v_credits_notes" name="v_credits_notes" placeholder="add product/price/stock related notes here"></textarea>
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
                                        <input type="checkbox" id="v_credits_email_notification" name="v_credits_email_notification">
                                        <label for="subscribeNews">Send a Vendor Credit Note information email notification to Vendor</label>									
                                    </div>
                                </div><br/>



                                <div class="form-row">
                                    <div class="modal-footer">
                                        <!--input type="hidden" name="vendorCreditID" value="<?=$_GET['id']?>"-->

                                        <button class="btn btn-primary" name="vendorCredit" value="vendorCredit" type="submit">
                                            Submit
                                        </button>
                                        <button type="reset" name="cancel" class="btn btn-secondary m-l-5">
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
        var page_v_credits_id = "<?php if(isset($_GET['v_credits_id'])){ echo $_GET['v_credits_id']; } ?>";


        $(function(){
            get_vendors();
            $('#message-alert').hide();

            if(page_action=="edit"){
                var credits_data = Page.get_edit_vals(page_v_credits_id,"vendorcredits","v_credits_id");
                $('#v_credits_vendorid').val(credits_data.v_credits_vendorid);
                $('#v_credits_paymentmode').val(credits_data.v_credits_paymentmode);
                $('#v_credits_paymentdate').val(credits_data.v_credits_paymentdate);               $('#v_credits_handler').val(credits_data.v_credits_handler);
                $('#v_credits_amount').val(credits_data.v_credits_amount);
                $('#v_credits_notes').val(credits_data.v_credits_notes);               

            }

        });      
    </script>



    <script>
        function get_vendors(){

            var vendor_params=[];            Page.load_select_options('v_credits_vendorid',vendor_params,'vendorprofile','Vendors','vendorid','supname',null);

        }

        function print_bill_addr(vendorid){
            if(vendorid!=''){
                var vendor_data = Page.get_edit_vals(vendorid,"vendorprofile","vendorid");
                var bill_div = '';
                bill_div+= '<h6>Billing Address</h6>';
                bill_div+= '<p>';
                bill_div+= '<b>'+vendor_data.supname+'</b><br/>';
                bill_div+= vendor_data.address+'<br/>';
                bill_div+= vendor_data.state+'<br/>';
                bill_div+= vendor_data.city+'<br/>';
                bill_div+= vendor_data.zip+'<br/>';
                bill_div+= '</p>';
                $('#vendor_bill_addr').html(bill_div);
            }else{
                $('#vendor_bill_addr').html('');

            }
        }

        function getFormData($form){
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                if(n['name']=="id"||n['name']=="v_credits_email_notification"){

                }else{
                    indexed_array[n['name']] = n['value'];
                }
            });

            return indexed_array;
        }

        $("form#addcredits_form").submit(function(e){
            e.preventDefault();
            var $form = $(this);
            var data = getFormData($form);
            if(page_action=="edit"){

                var credirRefund_arr = Page.get_multiple_vals(page_v_credits_id,"vendor_refund","v_refund_creditsid");
                var refund_sum = 0 ;
                console.log(credirRefund_arr);
                if(credirRefund_arr.length>0){
                    for(r=0;r<credirRefund_arr.length;r++){
                        refund_sum = refund_sum + eval(credirRefund_arr[r].v_refund_amount);
                    }         
                }


                if(data.v_credits_amount<refund_sum){
                    $('#message-alert').show();
                    $('#message-alert').text('Refunds has been made for this Credit , so It cant be lesser than that .');
                    return false;

                }else{
                    $('#message-alert').hide();
                    $('#message-alert').text('');

                }           

            }
            // console.log($('#v_credits_email_notification').is(":checked"));
            data.table = "vendorcredits";
            data.v_credits_email_notification =$('#v_credits_email_notification').is(":checked")?"yes":"no";

            if(page_action!="edit"){
                data.v_credits_availcredits = $('#v_credits_amount').val();
            }

            $.ajax ({
                url: 'workers/setters/save_vendorcredits.php',
                type: 'post',
                data: {array : JSON.stringify(data),v_credits_id:page_v_credits_id,action:page_action?page_action:"add",table:"vendorcredits"},
                dataType: 'json',
                success:function(response){
                    location.href="listVendorCredits.php";
                }


            });

        });
    </script>			


    </body>
</html>