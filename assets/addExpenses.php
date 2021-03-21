<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit'])){	
	$expdate=$_POST['expdate'];//same
    $expacctname=$_POST['expacctname'];//same
	$payee=$_POST['payee'];//same
	$payeetype=$_POST['payeetype'];//same
	$paymentype=$_POST['paymentype'];//same
	$notes=$_POST['notes'];//same
	//$image=$_POST['image'];//same
	$createdby = $_POST['createdby'];
	$amount = $_POST['amount'];//same
			

//$image =base64_encode($image);	
$target_dir = "upload/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        //echo "The file ". basename( $_FILES["image"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
		
	} else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
	
	$voucherid ="";
	$prefix = "0000";
	
	//Generating VoucherIDS
	$sql="SELECT MAX(id) as latest_id FROM recordexpense ORDER BY id DESC";
	if($result = mysqli_query($dbcon,$sql)){
		$row   = mysqli_fetch_assoc($result);
		if(mysqli_num_rows($result)>0){
			$maxid = $row['latest_id'];
			$maxid+=1;
			
			$voucherid = $prefix.$maxid;
		}else{
			$maxid = 0;
			$maxid+=1;
			$voucherid = $prefix.$maxid;
		}
	}

	$sql="INSERT INTO recordexpense(`voucherid`, 	
									`date`, 	
									`accountname`, 	
									`payee`, 	
									`payeetype`, 	
									`paymentype`,
									`amount`,														
									`notes`, 	
									`image`,
									`createdby`)
							VALUES ('$voucherid',
									'$expdate',
									'$expacctname',
									'$payee',
									'$payeetype',
									'$paymentype',
									'$amount',
									'$notes',
									'$target_file',
									'$createdby')";													    
					
	//echo "$insert_recordexpense";
	// Inserting Log details into ExpenseNoteslog
	$sql1= "INSERT into expensenoteslog(`voucherid`,
										`notes`,
										`createdby`,
										`createdon`)
								  VALUES('$voucherid',
								         '$notes',
										 '$createdby',
										 '$expdate')";
										
	if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
	{
		echo "<script>alert('Expense Master creation Successful ')</script>";
		header("location:listExpenses.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
		exit;
		echo "<script>alert('Transport Master creation  unsuccessful ')</script>";
	}
	
}
?>
<?php include('header.php');?>
	<!-- End Sidebar -->

<div class="content-page">
	
		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">

					
				<div class="row">
					<div class="col-xl-12">
							<div class="breadcrumb-holder">
                                    <h1 class="main-title float-left">Expense Entry Screen</h1>
                                    <ol class="breadcrumb float-right">
										<li class="breadcrumb-item">Home</li>
										<li class="breadcrumb-item active">Expense Entry Screen</li>
                                    </ol>
                                    <div class="clearfix"></div>
                            </div>
					</div>
			</div>
            <!-- end row -->


            <div class="row">					
					<div class="col-xs-12 col-sm-12 col-md-120 col-lg-12 col-xl-12">						
						<div class="card mb-3">
							<div class="card-header">
								<!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
								 <h3>
								 Record Expense</h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form action=""  enctype="multipart/form-data" method="post" accept-charset="utf-8">
								
								
								
								<div class="form-row">
									<div class="form-group col-md-6">
									   <label for="datepicker1">Date</label><span class="text-danger">*</span>
									  <!--input type="date" class="form-control" name="date" value="<?php echo date("d/m/Y") ?>"/-->
									  <input type="date" class="form-control form-control-sm"  name="expdate" value="<?php echo date("Y-m-d");?>">									
									</div>
									</div>
									
									 
								    <div class="form-row">
									<div class="form-group col-md-6">
									 Payee<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="payee" placeholder="Enter Name of Supplier/Employee/Customer/Others" autocomplete="off" required>
									</div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-6">
									  <label >Payee Type</label>
									 <select required id="payeetype" data-parsley-trigger="change"  class="form-control form-control-sm"  name="payeetype" >
										<option value="">Choose Type</option>
										<option value="Vendor">Vendor</option>
										<option value="Customer">Customer</option>
										<option value="Employee">Employee</option>
										<option value="Others">Others</option>									
									</select>
									</div>
									</div>
									
									<!--div class="form-row">
								 <span class="text-danger"> Amount<label >*</span></label>
									<form class="form-inline">	
								  <div class="input-group mb-2 mr-sm-2 mb-sm-0">								  								  
									<div class="input-group-addon">INR</div>
									<input type="text" name="amount" class="form-control form-control-sm" id="inlineFormInputGroupUsername2" placeholder="Enter Amount" required>
								  </div>
									</div-->		


								    <div class="form-row">
									<div class="form-group col-md-6">
									 Reference#<label ></label><span class="text-danger">*</span>
									  <input type="text" class="form-control form-control-sm" name="referenceno" placeholder="Bill nos,..." autocomplete="off" required>
									</div>
									</div>									
									
									<div class="form-row">
									<div class="form-group col-md-6">
									  <label >Payment Method</label>
									 <select required id="paymentype" data-parsley-trigger="change"  class="form-control form-control-sm"  name="paymentype" >
										<option value="">Open Payment Type</option>
										<option value="Cash">Cash</option>
										<option value="Cheque">Cheque</option>
										<option value="Neft">NEFT</option>
									</select>
									</div>
									</div>		

									
									
									<div class="form-row">
									  <div class="form-group col-md-6">
									  <label for="inputState">Created By</label>
									  <?php 
														//session_start();
														include("database/db_conection.php");
														$userid = $_SESSION['userid'];
														$sq = "select username from userprofile where id='$userid'";
														$result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
														//$count = mysqli_num_rows($result);
														$rs = mysqli_fetch_assoc($result);
													?>
									   <input type="text" class="form-control form-control-sm" name="createdby" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" />
									
									 </div>
									 </div
                                        <!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->
                                   <table  class="table table-hover small-text" id="tb">
                                    <tr class="tr-header">
                                        <th width="20%">Payment Account</th>
                                        <th width="40%">Description</th>
                                        <!--th width="11%">Amount</th-->
                                        <!--th width="12%">Tax Rate</th-->
                                        <!--th width="15%"><i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;Rate</th-->
                                        <th width="20%" > 
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>&nbsp;Amount</th>
                                        <!-- <th width="8%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Discount</b></i></th>-->
                                        <th width="20%"> GST@%</th> 
                                        <!--th width="20%"> <i class="fa fa-rupee fonts" aria-hidden="true"><b>&nbsp;Total</b></i></th-->
                                        <th><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
                                            <span class="fa fa-plus-circle"></span></a></th>

                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="itemcode" class="form-control itemcode" onchange="rowitem.set_itemrow(this,'purchase');" id="item_select">
                                                <option value="" name="itemcode" selected>Account Name</option>
                                                <?php $qr  = "SELECT id,accountname FROM expenseacctmaster ";
                                                $exc = mysqli_query($dbcon,$qr)or die();
                                                while($r = mysqli_fetch_array($exc)){ ?>
                                                <option value="<?php echo $r['id']; ?>"><?php echo  $r['accountname']; ?></option>
                                                <?php
                                                                                    }
                                                ?>
                                            </select>
                                        </td>


                                             <td><input id="description" type="text" name="description" placeholder="Description" onkeypress="rowitem.update_math_vals();"   onkeyup="rowitem.update_math_vals();"   data-id="" class="form-control price"></td>
                                        <td><input id="amount" type="text" name="amount" placeholder="Bill amount" data-id="" class="form-control amount"></td>
                                        <!-- <td><input type="text" name="discount[]" class="form-control discount" placeholder="Itm wise Disc"></td> -->
                                        <td>                       
                                            <select class="form-control amount" id="taxname"  onchange="rowitem.update_math_vals();"; name="taxname" style="line-height:1.5;">
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

                                            <div id="taxdiv"></div>
                                            <br/>
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-8"><p class="h6">Grand Total(Round off): </p></div>
                                                    <div class="col-md-4 text-right"><span style="font-weight:600;"  class="lead text-danger" id="pograndtotal">--</span></div>	
                                                </div>

                                            </div>     


                                        </div>
                                    </div>
                                    <hr>

                                    <br>

                                   <div class="form-row">
                                    <div class="form-group col-md-5">
                                        <label>
                                            <div class="fa-hover col-md-8 col-sm-8">
                                           <span class="text-danger"><i class="fa fa-paperclip bigfonts" aria-hidden="true"></span></i>&nbsp;Attach Receipt<span class="text-danger">(not more than 1MB)</span></div>
                                        </label> 
                                        &nbsp;&nbsp;<input type="file" name="image" class="form-control">
                                    </div>
                                       </br>
								

                               
                                <div class="form-row col-md-9">
                                    <div class="form-group col-md-7">
                                        <textarea rows="2" class="form-control" name="exp_notes"  id="exp_notes" required placeholder="Add Expense Record Notes"></textarea>
                                    </div>
                                </div>
                                    </div>



                                    <div class="form-row">
                                        <div class="form-group text-right m-b-10">
                                            &nbsp;<button class="btn btn-primary" name="submit" type="submit">
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



        <script>
            var error="";
            var stop="";


            var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
            var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
            var page_stk_mov_id = "<?php if(isset($_GET['stk_mov_id'])){ echo $_GET['stk_mov_id']; } ?>";

            $(function(){

                if(page_action=="edit"){
                    var stk_mov_data = Page.get_edit_vals(page_stk_mov_id,"stock_movement","stk_mov_id");
                    $('#stk_mov_owner').val(stk_mov_data.stk_mov_owner);
                    $('#stk_mov_req_date').val(stk_mov_data.stk_mov_req_date);
                    $('#stk_mov_location').val(stk_mov_data.stk_mov_location);
                    $('#stk_mov_category').val(stk_mov_data.stk_mov_category);               $('#stk_mov_docref').val(stk_mov_data.stk_mov_docref);
                    $('#stk_mov_status').val(stk_mov_data.stk_mov_status);
                    $('#stk_mov_notes').val(stk_mov_data.stk_mov_notes);               
                    set_math_vals(JSON.parse(stk_mov_data.stk_mov_items));
                }

            });      

            function set_itemrow(ele,type){
                var itemcodeId = $(ele).val();
                $.ajax({
                    url: "workers/getters/get_itemdata.php?itemcodeId=" + itemcodeId+"&itemType="+type,
                    type: "post",
                    async: false,
                    success: function(x) {
                        var output = JSON.parse(x);
                        if (output.status) {
                            post_itemrow(ele,output.values[0]);
                        } else {
                        }
                    }
                });

                /*       var supcode=x.value;
                                        window.location.href = 'addPurchaseOrder.php?supcode='+supcode;*/
            }

            function post_itemrow(ele,vals){

                if(vals.taxmethod==1){
                    var price = vals.priceperqty - (vals.priceperqty*(vals.taxrate/100));
                }else{
                    var price = vals.priceperqty;
                }
                //console.log(vals);
                $(ele).closest('tr').find('#hsncode').val(vals.hsncode);
                $(ele).closest('tr').find('#price').val(price);
                $(ele).closest('tr').find('#price').attr('data-price',vals.priceperqty);
                $(ele).closest('tr').find('#qty').val(1);
                $(ele).closest('tr').find('#amount').val(price*1);
                $(ele).closest('tr').find('#taxname').val(vals.taxrate);
                $(ele).closest('tr').find('#taxname').attr('data-taxmethod',vals.taxmethod);
                $(ele).closest('tr').find('#uom').val(vals.uom);

                //  update_math_vals();
                $('#posubtotal').text(eval(vals.priceperqty*1).toFixed(2));
                var qty_avaiable = Page.get_edit_vals(vals.itemcode,'purchaseitemaster',"itemcode");
                $(ele).closest('tr').find('#avail_qty').val(qty_avaiable.stockinqty);
                update_math_vals();

            }

            $('#addMore').on('click', function() {
                var data = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                data.attr("id",);
                data.find("input").val('');
            });

            $(document).on('click', '.remove', function() {
                var trIndex = $(this).closest("tr").index();
                if(trIndex>1) {
                    $(this).closest("tr").remove();
                    update_math_vals();
                } else {
                    alert("Sorry!! Can't remove first row!");
                }
            });

            function set_math_vals(stk_items_json){
                var itemrowCount = stk_items_json.length;
                var rowCount = $('#tb tr').length;

                for(r=0;r<itemrowCount;r++){

                    if(r<itemrowCount-1){
                        var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                    }
                    $('#tb tr').eq(r+1).find('#item_select').val(stk_items_json[r].itemcode);
                    $('#tb tr').eq(r+1).find('#price').val(stk_items_json[r].rwprice);
                    $('#tb tr').eq(r+1).find('#price').attr('data-price',stk_items_json[r].tax_method==1?stk_items_json[r].rwprice_org:stk_items_json[r].rwprice);
                    $('#tb tr').eq(r+1).find('#qty').val(stk_items_json[r].rwqty);
                    $('#tb tr').eq(r+1).find('#taxname').val(stk_items_json[r].tax_val);
                    $('#tb tr').eq(r+1).find('#taxname').attr('data-taxmethod',stk_items_json[r].tax_method);
                    $('#tb tr').eq(r+1).find('#uom').val(stk_items_json[r].uom);
                    var qty_avaiable = Page.get_edit_vals(stk_items_json[r].itemcode,'purchaseitemaster',"id");

                    $('#tb tr').eq(r+1).find('#avail_qty').val(qty_avaiable.stockinqty);
                    $('#posubtotal').text(eval(stk_items_json[r].stock_value).toFixed(2));

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
                        var rwqty = $('#tb tr').eq(i).find('#qty').val();
                        var tax_val = $('#tb tr').eq(i).find('#taxname').val();
                        var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');
                        var tax_name = $('#tb tr').eq(i).find('#taxname option:selected').text();
                        var tax_method = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                        var rwprice = $('#tb tr').eq(i).find('#price').val();
                        posubtotal+=rwqty*rwprice;
                        $('#tb tr').eq(i).find('#amount').val(rwqty*rwprice);
                        var taxsys = {
                            tax_desc : tax_name,
                            tax_val : tax_val,
                            tax_type : tax_type,
                            tax_method : tax_method

                        };

                        taxarray[i-1]=taxsys;


                    }

                    $('#posubtotal').text(eval(posubtotal).toFixed(2));
                    var tax_text = gettax_text(taxarray);
                    $('#taxdiv').html('');
                    $('#taxdiv').html(tax_text.taxhtml);
                    var pograndtotal = (eval(posubtotal) + tax_text.total_tax_amt_master).toFixed(2);

                    $('#pograndtotal').text(pograndtotal);
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
                    var itax_val = $('#tb tr').eq(i).find('#taxname').val();
                    var taxmethod = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                    var taxprice = $('#tb tr').eq(i).find('#price').attr('data-price');
                    var taxqty = $('#tb tr').eq(i).find('#qty').val();
                    var taxamt = taxprice*taxqty;


                    if(itax_val==taxval){

                        total_taxval=total_taxval+(eval(taxamt)*(eval(taxval)/100));

                    }
                }
                return total_taxval;
            }


            $("form#add_stk_mov_form").submit(function(e){
                e.preventDefault();

                if(stop){
                    error='<span class="text-danger">You have errors in quantity entry , request cannot be processed</span>';
                    $('#show_errors').html(error);
                    return false;
                }
                var rowCount = $('#tb tr').length;
                var stk_mov_items = [];

                for(i=1;i<rowCount;i++){ 
                    var item_select = $('#tb tr').eq(i).find('#item_select').val();
                    var item_details = $('#tb tr').eq(i).find('#item_select option:selected').text();
                    var taxname = $('#tb tr').eq(i).find('#taxname option:selected').text();
                    var qty_req = $('#tb tr').eq(i).find('#qty').val();
                    var rwprice = $('#tb tr').eq(i).find('#price').val();
                    var rwprice_org = $('#tb tr').eq(i).find('#price').attr('data-price'); 
                    var rwamt = $('#tb tr').eq(i).find('#amount').val();
                    var stockinqty = $('#tb tr').eq(i).find('#avail_qty').val();
                    var uom = $('#tb tr').eq(i).find('#uom').val();
                    var stock_value = $('#posubtotal').text();
                    var tax_val = $('#tb tr').eq(i).find('#taxname').val();
                    var tax_method = $('#tb tr').eq(i).find('#taxname').attr('data-taxmethod');
                    var tax_type = $('#tb tr').eq(i).find('#taxname option:selected').attr('data-type');

                    var stk_mov_items_ele = {
                        itemdetails : item_details,
                        itemcode : item_select,
                        rwqty : qty_req,
                        tax_val : tax_val,
                        tax_type : tax_type,
                        tax_method : tax_method,
                        rwprice : rwprice,
                        rwprice_org : rwprice_org,
                        uom : uom,
                        rwamt : rwamt,
                        stock_value : stock_value
                    };

                    stk_mov_items[i-1]=stk_mov_items_ele;

                }
                var $form = $("#add_stk_mov_form");
                var data = getFormData($form);

                function getFormData($form){
                    var unindexed_array = $form.serializeArray();
                    var indexed_array = {};

                    $.map(unindexed_array, function(n, i){
                        if(n['name']=="itemcode"||n['name']=="qty"||n['name']=="unit"||n['name']=="uom"||n['name']=="qty_req"||n['name']=="stockinqty"||n['name']=="price"||n['name']=="taxname"||n['name']=="amount"||n['name']=="avail_qty"){

                        }else{
                            indexed_array[n['name']] = n['value'];

                        }
                    });

                    return indexed_array;
                }

                data.table = "stock_movement";
                data.stk_mov_type = "Inward";
                data.stk_value = $('#pograndtotal').text();
                data.stk_mov_items = JSON.stringify(stk_mov_items);

                if (rowitem.purchase_entry){

                    $.ajax ({
                        url: 'workers/setters/save_stk_mov.php',
                        type: 'post',
                        data: {array : JSON.stringify(data),stk_mov_id:page_stk_mov_id,action:page_action?page_action:"add",table:"stock_movement"},
                        dataType: 'json',
                        success:function(response){
                            if(response.status){
                                //var sms_stat = Page.send_sms(response.sms_msg);
                                location.href="listtransferProductInward.php";
                            }
                        }


                    });
                }else{
                    return false;
                }

            });
        </script>