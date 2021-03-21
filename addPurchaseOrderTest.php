<?php 
include('header.php');
include("database/db_conection.php");//make connection here
if(isset($_GET['po_code']))
{
    $po_code = $_GET['po_code'];
    $action = $_GET['action'];
    $table = $_GET['type'];
}
?>
<!-- End Sidebar -->
<!-- Modal -->
<a href="#custom-modal" data-target="#customModal" data-toggle="modal">to create new group click 
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add User Group</a><br></br>
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
                        <h1 class="main-title float-left">Purchase Order</h1>
                        <ol class="breadcrumb float-right">
                            <li><a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                            <li class="breadcrumb-item active">Purchase Order</li>
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
                                </i>&nbsp;Purchase Order<span class="text-muted"></span></div></h5>

                            <div class="text-muted font-light">Create Purchase Order</div>

                        </div>

                        <div class="card-body">

                            <form id="add_po_form" autocomplete="off" action="#">
                               
							   <div class="form-row">
                                    <div class="invoice-title text-left mb-6">
                                        <h4 class="col-md-12 text-muted">Purchase Order Information &nbsp;</h4>
                                    </div>
                                </div>
								


								
								<div class="form-row">
									  <div class="form-group col-md-8">
									  <label for="inputState">Handler</label>
									  <?php 
														//session_start();
														include("database/db_conection.php");
														$userid = $_SESSION['userid'];
														$sq = "select username from userprofile where id='$userid'";
														$result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
														//$count = mysqli_num_rows($result);
														$rs = mysqli_fetch_assoc($result);
													?>
									   <input type="text" class="form-control form-control-sm" id="po_owner" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />
									
									 </div>
									 </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<span class="text-danger">*</span></label>
                                        <select id="po_comp_code" onchange="oncompcode(this.value);" class="form-control form-control-sm" name="po_comp_code">
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
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Vendor Name<span class="text-danger">*</span></label>
                                        <select id="po_vendor" class="form-control form-control-sm" name="po_vendor">
                                            <option selected>Open Vendor Code</option>
                                        </select>
                                        <!--                         <script>
function onsupcode(x)
{    
var supcode=x.value;
window.location.href = 'addPurchaseOrder.php?supcode='+supcode;
}
</script>-->
                                    </div>
                                </div>

                                <!--div class="form-row">
<div class="form-group col-md-8">
<h5 class="col-md-12 text-muted">Vendor Address</h5>
<?php if (isset($_GET["supcode"])) {
    $sup_code = $_GET["supcode"];
    $sql = mysqli_query($dbcon,"SELECT vendorid,supname,address,city,zip,mobile,email,gstin from vendorprofile");
    while ($row = $sql->fetch_assoc()){	
        if($sup_code==$row['vendorid']){														 

            echo $row['supname']; echo "<br>";
            echo $row['address'];echo "<br>";
            echo $row['city'];echo "<br>";
            echo $row['zip'];echo "<br>";
            echo $row['mobile'];echo "<br>";
            echo $row['email'];echo "<br>";
            echo $row['gstin'];echo "<br>";
        }
    }
}
?></label>
</div>
</div-->

                                <div class="form-row">
                                    <div class="form-group col-md-8">									
                                        <label>Subject<span class="text-danger"></span></label>
                                        <input type="text" class="form-control form-control-sm"  id="po_description"  placeholder="Plastics Requirment"  name="po_description"
                                               autocomplete="off">
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">									
                                        <label>PO Date<span class="text-danger"></span><span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="podate" name="po_date" value="<?php echo date("Y-m-d");?>" required autocomplete="off">
                                    </div>


                                    <div class="form-group col-md-4">											
                                        <label for="inputState">Payment Term<span class="text-danger">*</span></label>
                                        <select id="po_payterm" onchange="ongroup(this)" class="form-control"  name="po_payterm">
                                            <option selected>Open Payment Term</option>
                                        </select>

                                        <!--a style="color:cyan" data-target="#customModal" data-toggle="modal" >
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>Add New Pay Term</a-->
											
											<a href="#custom-modal" data-target="#customModal" data-toggle="modal">
								<i class="fa fa-user-plus" aria-hidden="true"></i>Add New Pay Term</a><br>


                                    </div>
                                </div>

                                <!-- Modal Ends-->


                                <div class="form-row">
                                    <div class="form-group col-md-4">											
                                        <label for="inputState">Shipping Via</label>
                                        <select id="po_shippingvia" onchange="onshpvia(this)" required class="form-control form-control-sm" name="po_shippingvia">
                                            <option selected>Open Shipping Via</option>

                                        </select>	
                                        <!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                    </div>


                                    <div class="form-group col-md-4">											
                                        <label for="inputState">Delivery At</label>
                                        <select id="po_deliveryat" onchange="ondelat(this)" required class="form-control form-control-sm" name="po_deliveryat">
                                            <option selected>Open Location</option>

                                        </select>	
                                        <!--a href="addSupplierCodeMaster.php">add supplier type</a-->												
                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="form-group col-md-4">									
                                        <label>Delivery Date<span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="po_deliverydate" name="po_deliverydate" required autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-4" >
                                        <label for="inputState">Status</label>
                                        <select class="form-control form-control-sm" required name="po_status"  id="po_status">
                                            <option value="Created">Created</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Delivered">Delivered</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>											
                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                    	 <label>Freight<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" required  id="po_freight" name="po_freight">
										 <option value="">--Select Freight--</option>
                                            <option value="Paid">Paid</option>
                                            <option value="To-Pay">To-Pay</option>                                            
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
                                        <input type="text" placeholder="Billing Street"  name="po_billing_street" id="po_billing_street" required class="form-control form-control-sm" > 
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping Street" name="po_shipping_street" id="po_shipping_street" required class="form-control form-control-sm"  > 
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" required name="po_billing_city" id="po_billing_city"  placeholder=" Billing City" >
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" placeholder="Shipping City" name="po_shipping_city" id="po_shipping_city" required class="form-control form-control-sm"> 
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select id="po_billing_state" class="form-control form-control-sm billstate" name="po_billing_state">
                                            <span class="text-muted"><option value="">Billing State</option> </span>
                                            <option value="AS" >Assam</option>
                                            <option value="AP" >Andhra Pradesh</option>
                                            <option value="OR" >Orissa</option>
                                            <option value="PB" >Punjab</option>
                                            <option value="DL" >Delhi</option>
                                            <option value="GJ" >Gujarat</option>
                                            <option value="KA" >Karnataka</option>
                                            <option value="HR" >Haryana</option>
                                            <option value="RJ" >Rajasthan</option>
                                            <option value="HP" >Himachal Pradesh</option>
                                            <option value="UK" >Uttarakhand</option>
                                            <option value="JH" >Jharkhand</option>
                                            <option value="CH" >Chhatisgarh</option>
                                            <option value="KL">Kerala</option>
                                            <option value="TN">Tamilnadu</option>
                                            <option value="MP">Madhiya Pradesh</option>
                                            <option value="WB" >West Bengal</option>
                                            <option value="BR" >Bihar</option>
                                            <option value="MH" >Maharastra</option>
                                            <option value="UP" >Uttar Pradesh</option>
                                            <option value="CH" >Chandigarh</option>
                                            <option value="TG" >Telangana</option>
                                            <option value="JK" >Jammu & Kashmir</option>
                                            <option value="TR" >Tripura</option>
                                            <option value="ML" >Meghalaya</option>
                                            <option value="GA" >Goa</option>
                                            <option value="AR" >Arunachal Pradesh</option>
                                            <option value="MN" >Manipur</option>
                                            <option value="MZ" >Mizoram</option>
                                            <option value="SK">Sikkim</option>
                                            <option value="PY" >Pudhuchery</option>													
                                            <option value="NL" >Nagaland</option>													
                                            <option value="AN">Andaman & Nicobar</option>													
                                            <option value="DH" >Dadra & Nagar Haveli</option>													
                                            <option value="DD">Damen & Diu</option>													
                                            <option value="LD" >Lakshadweep</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">											
                                        <select id="po_shipping_state" class="form-control form-control-sm" name="po_shipping_state">
                                            <span class="text-muted">  <option selected value="">Shipping State</option> </span>
                                            <option value="AS">Assam</option>
                                            <option value="AP">Andhra Pradesh</option>
                                            <option value="OR">Orissa</option>
                                            <option value="PB">Punjab</option>
                                            <option value="DL">Delhi</option>
                                            <option value="GJ">Gujarat</option>
                                            <option value="KA">Karnataka</option>
                                            <option value="HR">Haryana</option>
                                            <option value="RJ">Rajasthan</option>
                                            <option value="HP">Himachal Pradesh</option>
                                            <option value="UK">Uttarakhand</option>
                                            <option value="JH">Jharkhand</option>
                                            <option value="CH">Chhatisgarh</option>
                                            <option value="KL">Kerala</option>
                                            <option value="TN">Tamilnadu</option>
                                            <option value="MP">Madhiya Pradesh</option>
                                            <option value="WB">West Bengal</option>
                                            <option value="BR">Bihar</option>
                                            <option value="MH">Maharastra</option>
                                            <option value="UP">Uttar Pradesh</option>
                                            <option value="CH">Chandigarh</option>
                                            <option value="TG">Telangana</option>
                                            <option value="JK">Jammu & Kashmir</option>
                                            <option value="TR">Tripura</option>
                                            <option value="ML">Meghalaya</option>
                                            <option value="GA">Goa</option>
                                            <option value="AR">Arunachal Pradesh</option>
                                            <option value="MN">Manipur</option>
                                            <option value="MZ">Mizoram</option>
                                            <option value="SK">Sikkim</option>
                                            <option value="PY">Pudhuchery</option>													
                                            <option value="NL">Nagaland</option>													
                                            <option value="AN">Andaman & Nicobar</option>													
                                            <option value="DH">Dadra & Nagar Haveli</option>													
                                            <option value="DD">Damen & Diu</option>													
                                            <option value="LD">Lakshadweep</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="po_billing_country" required name="po_billing_country"> 
                                            <span class="text-muted">  
                                                <option value="" >Billing Country</option> </span>
                                            <option value="IN" >India</option>									
                                            <option value="AR">Argentina</option>
                                            <option value="AU" >Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="BD" >Bangladesh</option>
                                            <option value="BE" >Belgium</option>
                                            <option value="BR" >Brazil</option>
                                            <option value="BG" >Bulgaria</option>
                                            <option value="CA" >Canada</option>
                                            <option value="CN" >China</option>
                                            <option value="CO" >Colombia</option>
                                            <option value="HR" >Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CZ" > Czech Republic</option>
                                            <option value="DK" >Denmark</option>
                                            <option value="EG">Egypt</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="DE">Germany</option>
                                            <option value="GR">Greece</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU" >Hungary</option>
                                            <option value="IS" >Iceland</option>
                                            <option value="ID" >Indonesia</option>
                                            <option value="IE" >Ireland</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT" >Italy</option>
                                            <option value="JP" >Japan</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="MX">Mexico</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NO">Norway</option>
                                            <option value="PK" >Pakistan</option>
                                            <option value="PL" >Poland</option>
                                            <option value="PT" >Portugal</option>
                                            <option value="RO" >Romania</option>
                                            <option value="RU" >Russian Federation</option>
                                            <option value="ES">Spain</option>
                                            <option value="SE" >Sweden</option>
                                            <option value="TR" >Turkey</option>
                                            <option value="GB" >United Kingdom</option>
                                            <option value="US" >United States</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-4">
                                        <select class="form-control form-control-sm" id="po_shipping_country" required name="po_shipping_country"> 
                                            <span class="text-muted">  
                                                <option value="" selected>Shipping Country</option> </span>
                                            <option value="IN">India</option>									
                                            <option value="AR">Argentina</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BR">Brazil</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="CA">Canada</option>
                                            <option value="CN">China</option>
                                            <option value="CO">Colombia</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="EG">Egypt</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="DE">Germany</option>
                                            <option value="GR">Greece</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JP">Japan</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="MX">Mexico</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NO">Norway</option>
                                            <option value="PK">Pakistan</option>
                                            <option value="PL">Poland</option>
                                            <option value="PT">Portugal</option>
                                            <option value="RO">Romania</option>
                                            <option value="RU">Russian Federation</option>
                                            <option value="ES">Spain</option>
                                            <option value="SE">Sweden</option>
                                            <option value="TR">Turkey</option>
                                            <option value="GB">United Kingdom</option>
                                            <option value="US">United States</option>
                                        </select>								  
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="po_billing_zip" id="po_billing_zip"  required placeholder="Billing Zip/Postal Code" value="">
                                    </div>	


                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="po_shipping_zip" id="po_shipping_zip"  required placeholder="Shipping Zip/Postal Code">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="po_billing_phone" id="po_billing_phone"  required placeholder="Billing Phone" value="">
                                    </div>	

                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="po_shipping_phone"  id="po_shipping_phone"  required placeholder="Shipping Phone">
                                    </div>									  
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="po_billing_gstin" id="po_billing_gstin"  required placeholder="Billing GSTIN No" value="" />
                                    </div>
                                    <div class="form-group col-md-4">
                                        <input type="text" class="form-control form-control-sm" name="po_shipping_gstin" id="po_shipping_gstin"  required placeholder="Shipping GSTIN No">
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
                                            <select name="itemcode" class="form-control itemcode" onchange="set_itemrow(this);" id="item_select">
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
                                        <script>
                                            function set_itemrow(ele){
                                                var itemcodeId = $(ele).val();
                                                $.ajax({
                                                    url: "workers/getters/get_itemdata.php?itemcodeId=" + itemcodeId,
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
                                                $(ele).closest('tr').find('#hsncode').val(vals.hsncode);
                                                $(ele).closest('tr').find('#price').val(vals.priceperqty);
                                                $(ele).closest('tr').find('#qty').val(1);
                                                $(ele).closest('tr').find('#amount').val(vals.priceperqty*1);
                                                $(ele).closest('tr').find('#taxname').val(vals.taxname);
                                                $(ele).closest('tr').find('#uom').val(vals.uom);
                                                //                                            $('#price').val(vals.priceperqty);
                                                //                                            $('#qty').val(1);
                                                //                                            $('#amount').val(vals.priceperqty*1);
                                                //                                            $('#taxname').val(vals.taxname);
                                                update_math_vals();
                                            }
                                        </script>


                                        <!--td><input type="text" name="description" placeholder="Item Name" class="form-control"></td
<td><input type="text" name="itemcode" placeholder="Item Details" class="form-control"></td>-->
                                        <td><input readonly id="hsncode" type="text" name="hsncode" placeholder="hsncode"    data-id="" class="form-control hsncode"></td>
                                        <td><input id="qty" type="text" name="qty" onkeypress="update_math_vals();"   onkeyup="update_math_vals();" placeholder="Qty" data-id="" class="form-control qty"></td>                                        <td>
                                        <select class="form-control amount" id="uom"  onchange="update_math_vals();"; name="uom" style="line-height:1.5;">
                                            <option value="" selected>Open Unit</option>
                                            <?php 
                                            $sql = mysqli_query($dbcon, "SELECT * FROM uom ");
                                            while ($row = $sql->fetch_assoc()){	

                                                echo '<option  value="'.$row['code'].'">'.$row['description'].'</option>';
                                            }
                                            ?>
                                        </select>
                                        </td>
                                        <td><input id="price" type="text" name="price" placeholder="Rate/Qty" onkeypress="update_math_vals();"   onkeyup="update_math_vals();"   data-id="" class="form-control price"></td>
                                        <td><input id="amount" type="text" name="amount" placeholder="qtyXprice" data-id="" class="form-control amount"></td>
                                        <!-- <td><input type="text" name="discount[]" class="form-control discount" placeholder="Itm wise Disc"></td> -->
                                        <td>                       <select class="form-control amount" id="taxname"  onchange="update_math_vals();"; name="taxname" style="line-height:1.5;">
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
                                        <td><a href='javascript:void(0);'  class='remove'><span class='fa fa-trash'></span><b></b></a></td>
                                    </tr>
                                </table>
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
                                                    <!--                             <div class="col-md-6">
<div class="input-group">
<input type="text" id="podiscount" class="form-control" aria-label="Text input with dropdown button">
<div class="input-group-append">
<button style="border-radius:none!important;" class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">%</button>
<div class="dropdown-menu">
<a class="dropdown-item" href="#">Action</a>

</div>
</div>
</div>
</div>	-->
                                                    <div id="ember1600" class="input-group ember-view col-md-7" style="padding-left:0px;">
													<input type="text" class="form-control text-right ember-text-field text-right ember-view" id="podiscount" style=".375rem .75rem;" onkeypress="update_math_vals();"   onkeyup="update_math_vals();" placeholder="Discount"> 
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
													<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="Add any other +ve or -ve charges that need to be appliedto adjust the total amount of the transaction Eg. +10 or -10."></i>
								              
												
                                                        <input class="form-control" onkeypress="update_math_vals();"   onkeyup="update_math_vals();" id="poadjustmentval" type="number" step="any" placeholder="Adjustment ">
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



                                        <!--                                       <div class="col-md-10 float-right text-right">
&nbsp;<b>Discount </b>&nbsp;
<h5><input type="text" onkeypress="update_math_vals();"   onkeyup="update_math_vals();" class="form-control form-control-sm col-md-2 float-right" name="podiscount" id="podiscount"  required placeholder="Discount %"></h5>
</div>-->

                                        <!--
<tr>
<div class="col-md-10 float-right text-right">															
<h5>&nbsp;CGST @ <span class="text-danger">9% on 9.00 </span></h5>
</div>
</tr>

<div class="input-group">
<input type="text" class="form-control" aria-label="Text input with dropdown button">
<div class="input-group-append">
<button class="btn btn-outline-secondary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</button>
<div class="dropdown-menu">
<a class="dropdown-item" href="#">Action</a>
<a class="dropdown-item" href="#">Another action</a>
<a class="dropdown-item" href="#">Something else here</a>
<div role="separator" class="dropdown-divider"></div>
<a class="dropdown-item" href="#">Separated link</a>
</div>
</div>
</div>

<tr>
<div class="col-md-10 float-right text-right">															
<h5>&nbsp;SGST @<span class="text-danger"> 9% on 9.00</span></h5>
</div>
</tr>
-->

                                        <!--tr>
<div class="col-md-10 float-right text-right">	
<h5><b>&nbsp;Adjustment</b>&nbsp;<i class="fa fa-rupee fonts" aria-hidden="true"></i></h5>
</div>
</td>
</tr-->

                                        <!--
<div class="col-md-10 float-right text-right">	
<h5>Grand Total(Round off): <span id="pograndtotal" class="text-danger">--</span></h5>
</div>

<div class="col-md-10 float-right text-right">	
<h5>Balance Due: <span id="pobaltotal" class="text-danger">--</span></h5>
</div>-->


                                    </div>
                                </div>
                                <hr>

                                <br>

                                <div class="form-row col-md-8">
                                    <div class="form-group col-md-8">
                                        <textarea rows="2" class="form-control" name="po_notes"  id="po_notes" required placeholder="add a Note"></textarea>
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

<script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/main.js"></script>
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
    var page_po_code = "<?php if(isset($_GET['po_code'])){ echo $_GET['po_code']; } ?>";


    $(function(){


        ////set select options
        var user_params = [];
        var comp_params = [];
        var vendor_params = [];
        var paymentterm_params = [];
        var shippingvia_params = [];
        var loction_params = [];
        var items_params = [];
        comp_params[0]={"primaryflag":"1"};  
        // items_params[0]={"status":"1"};  
        Page.load_select_options('po_owner',user_params,'userprofile','user','username',null);
        Page.load_select_options('po_comp_code',comp_params,'comprofile','Company Code','orgid','orgname');
        Page.load_select_options('po_vendor',vendor_params,'vendorprofile','Vendor Code','vendorid','supname');
        Page.load_select_options('po_shippingvia',shippingvia_params,'transportmaster','Shipping Via','transname',null);  
        Page.load_select_options('po_payterm',paymentterm_params,'paymentterm','Payment  Term','paymentterm',null);
        Page.load_select_options('po_deliveryat',loction_params,'location','Deivery at','locname',null);
        //  Page.load_select_options('item_select',items_params,'purchaseitemaster','ItemCode','itemname');
        //console.log($('#add_po_form').html()); 
        //   }



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
            $('#po_shipping_street').val($('#po_billing_street').val());
            $('#po_shipping_city').val($('#po_billing_city').val());
            $('#po_shipping_state').val($('#po_billing_state').val());
            $('#po_shipping_country').val($('#po_billing_country').val());
            $('#po_shipping_zip').val($('#po_billing_zip').val());
            $('#po_shipping_phone').val($('#po_billing_phone').val());
            $('#po_shipping_gstin').val($('#po_billing_gstin').val());
        });


        $('#shipping_to_billing').click(function(){
            $('#po_billing_street').val($('#po_shipping_street').val());
            $('#po_billing_city').val($('#po_shipping_city').val());
            $('#po_billing_state').val($('#po_shipping_state').val());
            $('#po_billing_country').val($('#po_shipping_country').val());
            $('#po_billing_zip').val($('#po_shipping_zip').val());
            $('#po_billing_phone').val($('#po_shipping_phone').val());
            $('#po_billing_gstin').val($('#po_shipping_gstin').val());
        });


        if(page_action=="edit"){
            var edit_data = Page.get_edit_vals(page_po_code,page_table);
            set_form_data(edit_data);
        }
        function set_form_data(data){
            // console.log(data.po_owner);
            //// $('#po_owner').val(data.po_owner);
            $.each(data, function(index, value) {

                if(index=="id"||index=="po_code"){


                }else if(index=="po_items"){
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

        for(r=0;r<itemrowCount;r++){

            if(r<itemrowCount-1){
                var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");

            }
            //console.log($("#tb tr:eq("+eval(r)+")").html());
            //dataRow.find("input").val('');   

            //dataRow.attr("id",);
            //            var rwqty = $('#tb tr').eq(i).find('#qty').val(po_items_json[r].rwqty);
            //            var rwqty = $('#tb tr').eq(i).find('#qty').val(po_items_json[r].rwqty);
            //            var rwqt  y = $('#tb tr').eq(r-1).find('#qty').val(po_items_json[r-1].rwqty);
            //            var tax_val = $('#tb tr').eq(r-1).find('#taxname').val(po_items_json[r-1].tax_val);
            $('#tb tr').eq(r+1).find('#item_select').val(po_items_json[r].itemcode);
            $('#tb tr').eq(r+1).find('#price').val(po_items_json[r].rwprice);
            $('#tb tr').eq(r+1).find('#qty').val(po_items_json[r].rwqty);
            $('#tb tr').eq(r+1).find('#taxname').val(po_items_json[r].tax_val);
            $('#tb tr').eq(r+1).find('#uom').val(po_items_json[r].uom);


        }
        if(itemrowCount>0){
            var podiscount = po_items_json[0].podiscount;
            var poadjustmentval = po_items_json[0].poadjustmentval;    
            $('#podiscount').val(podiscount);
            $('#poadjustmentval').val(poadjustmentval);

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
                var rwprice = $('#tb tr').eq(i).find('#price').val();
                posubtotal+=rwqty*rwprice;
                $('#tb tr').eq(i).find('#amount').val(rwqty*rwprice);
                var taxsys = {
                    tax_desc : tax_name,
                    tax_val : tax_val,
                    tax_type : tax_type

                };

                taxarray[i-1]=taxsys;

            }

            $('#posubtotal').text(eval(posubtotal).toFixed(2));

            var podiscount = $('#podiscount').val();
            var discmeth = $('#discoutTypeTextbutton').attr('data-meth');
            var podeduction= 0 ;
            if(podiscount!=0){
                if(discmeth=="flat"){
                    podeduction = eval(podiscount);
                }else{
                    podeduction = eval(posubtotal*(podiscount/100)).toFixed(2);
                }  
            }


            $('#podiscountText').text(podeduction);

            var tax_text = gettax_text(taxarray);
            $('#taxdiv').html('');
            $('#taxdiv').html(tax_text.taxhtml);

            var pograndtotal = Math.round(eval(posubtotal - podeduction));
            pograndtotal = (eval(pograndtotal) + eval(tax_text.total_tax_amt_master)).toFixed(2);

            $('#pograndtotal').text(pograndtotal);
            var poadjustmentval = $('#poadjustmentval').val();

            if(poadjustmentval!=0){
                var finalval = (eval(pograndtotal)+eval(poadjustmentval)).toFixed(2);
                $('#poadjustment').text(finalval);
                $('#pobaltotal').text(finalval);   
            }else{
                $('#pobaltotal').text(pograndtotal);   

            }



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
        console.log(globpblist);
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

    function roundTo(n, digits) {
        if (digits === undefined) {
            digits = 0;
        }

        var multiplicator = Math.pow(10, digits);
        n = parseFloat((n * multiplicator).toFixed(11));
        var test =(Math.round(n) / multiplicator);
        return +(test.toFixed(digits));
    }
    $("form#add_po_form").submit(function(e){
        e.preventDefault();

        var rowCount = $('#tb tr').length;
        var po_items = [];

        for(i=1;i<rowCount;i++){ 
            var item_select = $('#tb tr').eq(i).find('#item_select').val();
            var hsncode = $('#tb tr').eq(i).find('#hsncode').val();
            var rwqty = $('#tb tr').eq(i).find('#qty').val();
            var tax_val = $('#tb tr').eq(i).find('#taxname').val();
            var rwprice = $('#tb tr').eq(i).find('#price').val();
            var rwamt = $('#tb tr').eq(i).find('#amount').val();
            var uom = $('#tb tr').eq(i).find('#uom').val();
            var podiscount = $('#podiscount').val();
            var poadjustmentval = $('#poadjustmentval').val();
            var po_items_ele = {
                itemcode : item_select,
                hsncode : hsncode,
                rwqty : rwqty,
                tax_val : tax_val,
                rwprice : rwprice,
                rwamt : rwamt,
                podiscount : podiscount,
                poadjustmentval:poadjustmentval,
                uom : uom
            };

            po_items[i-1]=po_items_ele;

        }

        var $form = $("#add_po_form");
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

        data.table = "purchaseorders";
        data.po_items = JSON.stringify(po_items);
        data.po_value = $('#pobaltotal').text(); 

        $.ajax ({
            url: 'workers/setters/save_po.php',
            type: 'post',
            data: {array : JSON.stringify(data),po_code:page_po_code,action:page_action?page_action:"add",table:"purchaseorders"},
            dataType: 'json',
            success:function(response){
                location.href="listPurchaseOrders.php";
            }


        });

    });



</script>			


</body>
</html>