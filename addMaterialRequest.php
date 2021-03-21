<?php include('header.php');?>
	<!-- End Sidebar -->


    <div class="content-page">
	
		<!-- Start content -->
   		<!-- Start content -->
        <div class="content">
            
			<div class="container-fluid">
					
						<div class="row">
									<div class="col-xl-12">
											<div class="breadcrumb-holder">
													<h3 class="main-title float-left">Product/Material Inward Movement Register </h3>
													<ol class="breadcrumb float-right">
															<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
														<li class="breadcrumb-item active">Product/Material Inward Movement Register </li>
													</ol>
													<div class="clearfix"></div>
											</div>
									</div>
						</div>
						<!-- end row -->
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
								<h4> <div class="fa-hover col-md-6 col-sm-6"><i class="fa fa-tag bigfonts" aria-hidden="true"></i>
								Product Inward Movement Register</h4>								
							</div>
								
							<div class="card-body">
								
								<!--form autocomplete="off" action="#"-->
								<form autocomplete="off" action="#" enctype="multipart/form-data" method="post">

								
								
								<div class="form-row">
								<div class="form-group col-md-3">
									  <label for="inputState">Requested By</label>
									  <?php 
														//session_start();
														include("database/db_conection.php");
														$userid = $_SESSION['userid'];
														$sq = "select username from userprofile where id='$userid'";
														$result = mysqli_query($dbcon, $sq) or die(mysqli_error($dbcon));
														//$count = mysqli_num_rows($result);
														$rs = mysqli_fetch_assoc($result);
													?>
									   <input type="text" class="form-control form-control-sm" name="handler" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />
									
									 </div>
								<div class="form-group col-md-3">
								<label >Request Date</label>
								<input type="date" class="form-control form-control-sm"  name="reqdate" value="<?php echo date("Y-m-d");?>">
								</div>
								
								</div>
								
								<div class="form-row">			
															
									<!--div class="form-group col-md-3">
									  <label >Requested Qty/Unit</label>
									  <input type="text" class="form-control form-control-sm" name="qtyrqstd" placeholder="Requested Qty" required  autocomplete="off">
									</div-->
									
									
									
									
										<div class="form-group col-md-3">
									  <label for="inputState">Transfer Location</label>
											<select id="compcode" onchange="onvendor(this);" class="form-control form-control-sm"  required name="vendor" autocomplete="off">
												<option selected>--Select Location--</option>
												<?php 
												include("database/db_conection.php");//make connection here
												$sql = mysqli_query($dbcon,"SELECT location_id,warehousename FROM warehouse
																			ORDER BY id ASC
																			");
												  while ($row = $sql->fetch_assoc()){	
													echo $locationid=$row['location_id'];
													echo $warehousename=$row['warehousename'];
													echo '<option onchange="'.$row[''].'" value="'.$locationid.'" >'.$warehousename.'</option>';
												  
												  }
												?>
											</select>
									</div>
									
									<div class="form-group col-md-3">
											<label for="inputState">Category</label>
											<select id="category" onchange="onvendor(this);" class="form-control form-control-sm"  required name="category" autocomplete="off">
												<option selected>Select Category</option>
												<?php 
												include("database/db_conection.php");//make connection here
												$sql = mysqli_query($dbcon,"SELECT code,category FROM itemcategory
																			ORDER BY id ASC
																			");
												  while ($row = $sql->fetch_assoc()){	
													echo $category_code=$row['code'];
													echo $category=$row['category'];
													echo '<option onchange="'.$row[''].'" value="'.$category_code.'" >'.$category.'</option>';
												  
												  }
												?>
											</select>
											</div>
											</div>
									<div class="form-row">	
									<div class="form-group col-md-3">
									  <label >Document Reference#</label>
									  <input type="text" class="form-control form-control-sm" name="docrefno" placeholder="" required  autocomplete="off">
									</div>
									
									<div class="form-group col-md-3" >
                                        <label for="inputState">Status</label>
                                        <select class="form-control form-control-sm" required name="po_status"  id="po_status">
                                            <option value="Open">Open</option>
                                            <option value="Approved">Approved</option>                                            
                                            <option value="Moved">Moved</option>
                                            <option value="Cancelled">Cancelled</option>
                                        </select>											
                                    </div>
                                </div>
									
								
									
									<!--link  rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" /-->
                                <table  class="table table-hover small-text" id="tb">
                                    <tr class="tr-header">
                                        <th width="20%">Item Details</th>
                                        <th width="12%">HSN/SAC</th>
                                        <th width="11%">Avail Qty</th>
                                        <th width="12%">Qty needed</th>
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



                                                        <input class="form-control" onkeypress="update_math_vals();"   onkeyup="update_math_vals();" id="poadjustmentval" type="number" step="any" placeholder="Adjustment ">
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

                                <div class="form-row col-md-8">
                                    <div class="form-group col-md-8">
                                        <textarea rows="2" class="form-control" name="po_notes"  id="po_notes" required placeholder="add a Note"></textarea>
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