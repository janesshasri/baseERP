<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['purchaseItemMasterEdit']))
{ 
	var_dump($_POST);
	extract($_POST);
	
	//Updating Purcahse Item Details to purchaseitemaster table
    $sql = "UPDATE `purchaseitemaster` 
			SET `itemname` = '".$itemname."',
				`category` =  '".$category."',
				`description` = '".$description."',
				`vendor` = '".$vendor."',
				`status` = '".$status."',
				`priceperqty` = '".$priceperqty."',
				`uom`= '".$uom."',
				`taxmethod`='".$taxmethod."',
				`taxname`='".$taxname."',
				`taxid`='".$taxid."',
				`taxtype`='".$taxtype."',
				`taxrate` 	='".$disptaxrate."',
				`taxamount`	='".$disptax."',
				`itemcost`	='".$product_price."',
				`taxableprice` 	='".$final_price."',
				`pricedatefrom`='".$pricedatefrom."',
				`stockinqty`='".$stockinqty."',
				
				`lowstockalert`='".$lowstockalert."', 
				`stockasofdate`='".$stockasofdate."', 
				`handler`='".$handler."'				
			WHERE `id` =".$purchaseItmMasterID;										
										
	//echo $sql;		
	
	if($adjstockinqty !== '') {
	//Delete statement is required for inserting last transaction of stock adjustment
	//$sql3 = "DELETE FROM `purchaseitemlog` WHERE itemcode = '".$itemcode."' OR id = ".$purchaseItmMasterID;
	
	// mysqli_query($dbcon,$sql3);
	
	//echo $sql3;	
	
	//Insering log information to Purchaseitemlog table	
	$sql1="INSERT into purchaseitemlog(`itemcode`,
										`itemname`,
										`qtyonhand`,
										`qtyadjusted`,
										`uom`,
										`adjustedon`,
										`handler`,
										`notes`)
										VALUES('$itemcode',
											   '$itemname',
											   '$stockinqty',
											   '$adjstockinqty',
											   '$uom',
											   '$stockasofdate',
											   '$handler',
											   '$notes')";
	
	//echo $sql1;
	}else{
		header("location:listPurchaseItemMaster.php");
	}
	
	
    if(mysqli_query($dbcon,$sql) && (mysqli_query($dbcon,$sql1)))
    {
		mysqli_commit($dbcon);
		echo "<script>alert('Purchase Item Edit Successfully updated')</script>";
		header("location:listPurchaseItemMaster.php");
    } else {
		die('Error: ' . mysqli_error($dbcon));
		
	    //echo "<script>alert('User creation unsuccessful ')</script>";
	}
	
}
if(isset($_POST['exit']))
{ 
	var_dump($_POST);
	extract($_POST);
	header("location:listPurchaseItemMaster.php");
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
                                    <h1 class="main-title float-left">Edit Purchase Item Master</h1>
                                    <ol class="breadcrumb float-right">
									<a  href="index.php"><li class="breadcrumb-item">Home</a></li>
										<li class="breadcrumb-item active">Edit Purchase Item Master</li>
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
								 <h3><div class="fa-hover col-md-8 col-sm-8">
								 <i class="fa fa-tag bigfonts" aria-hidden="true"></i>&nbsp;Edit Purchase Item Master </div></h3>
								
								<!--h3><class="fa-hover col-md-12 col-sm-12"><i class="fa fa-cart-plus smallfonts" aria-hidden="true">
								</i>Add Transport Master Details
								</h3-->
								
							</div>
								
							<div class="card-body">
								
																
									<form method="post" action="editPurchaseItemMaster.php"  enctype="multipart/form-data">
									<?php
											include("database/db_conection.php");//make connection here
											if(isset($_GET['id']))
											{
												$id=$_GET['id'];
												//selecting data associated with this particular id
												$result = mysqli_query($dbcon, "SELECT *
																				FROM purchaseitemaster WHERE id = $id");
												while($res = mysqli_fetch_array($result))
												{
													$itemcode = $res['itemcode'];
													$itemname = $res['itemname'];
													$category = $res['category'];
													$vendor= $res['vendor'];
													$status =$res['status'];
													$priceperqty =$res['priceperqty'];
													$uom 		=$res['uom'];
													$taxmethod 		=$res['taxmethod'];
                                                    $taxidg 		=$res['taxid'];
													$taxtype 		=$res['taxtype'];
													$disptaxrate 	=$res['taxrate'];
													$disptax	=$res['taxamount'];
													$product_price	=$res['itemcost'];
													$final_price 	=$res['taxableprice'];
													$pricedatefrom 	=$res['pricedatefrom'];
													$stockinqty 	=$res['stockinqty'];
													//$stockinuom	=$res['stockinuom'];
													$lowstockalert	=$res['lowstockalert'];
													$stockasofdate	=$res['stockasofdate'];
													//$usageunit 		=$res['usageunit'];
													$handler 	=$res['handler'];
													$description= $res['description'];
													$notes = $res['notes'];
																									
												}
											}
											?>
											<!--div class="form-row">
											<div class="form-group col-md-3">
                                                <label for="inputState">Material/Item Code</label>
												<input type="text" class="form-control form-control-sm" name="itemname" readonly value="<?php echo $itemcode;?>" />
                                                   <?php 
														include("database/db_conection.php");//make connection here
														$sql = mysqli_query($dbcon,"select category from itemcategory");
														while ($row = $sql->fetch_assoc()){	
															echo $category_get=$row['category'];
															if($category_get==$category){
																echo '<option value="'.$category_get.'" selected>'.$category_get.'</option>';

															}else{
																echo '<option value="'.$category_get.'" >'.$category_get.'</option>';

															}
														}
                                                    ?>
													</select>
													
													
												
                                            </div-->

								<div class="form-row">
									<div class="form-group col-md-6">
									  <label></i>Item Code</label>
									  <input type="text" class="form-control form-control-sm" name="itemcode" readonly value="<?php echo $itemcode;?>" />
									  </div>
									  </div>
																		  
									 <div class="form-row">
									<div class="form-group col-md-6">
									  <label></i>Item Name</label>
									  <input type="text" class="form-control form-control-sm" name="itemname" value="<?php echo $itemname;?>" />
									  </div>
									  </div>
									  
									  <div class="form-row">
										<div class="form-group col-md-6">
											<label for="inputState">Category</label>
											<select id="category" onchange="onvendor(this);" class="form-control form-control-sm"  required name="category" >
											<?php 
												include("database/db_conection.php");//make connection here
												$sql = mysqli_query($dbcon,"SELECT code,category FROM itemcategory
																			ORDER BY id ASC
																			");
												  while ($row = $sql->fetch_assoc()){	
													echo $code=$row['code'];
													echo $category_get=$row['category'];
													if($code==$category){
																echo '<option value="'.$code.'" selected>'.$category_get.'</option>';
															}else{
																echo '<option value="'.$code.'" >'.$category_get.'</option>';

															}
                                                    }
												?>
											</select>
										</div>
									</div>
                            
                            
									 <div class="form-row">
									<div class="form-group col-md-6">
									 <label>Description</label></span>
									  <input type="textarea" rows="2" class="form-control" name="description" value="<?php echo $description;?>" />
									  </div>
									  </div>
									  
									  <div class="form-row">
									<div class="form-group col-md-6">
									 <label for="inputState">Vendor Name</label>
                                                <select id="compcode" onchange="onvendor(this);" class="form-control form-control-sm"  name="vendor" >
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here
                                                    $sql = mysqli_query($dbcon,"SELECT vendorid,concat(title,' ',supname,blocation) as vendorname FROM vendorprofile
																			ORDER BY id ASC
																				");
                                                      while ($row = $sql->fetch_assoc()){	
                                                   // echo $vendor_get=$row['vendorname'];														
													echo $vendorid=$row['vendorid'];
													echo $vendorname=$row['vendorname'];
                                                       if($vendorid==$vendor){
																echo '<option value="'.$vendorid.'" selected>'.$vendorname.'</option>';
															}else{
																echo '<option value="'.$vendorid.'" >'.$vendorname.'</option>';

															}
                                                    }
                                                    ?>
                                                </select>
												</div>
									  </div>
									  
                        
									  
									<!--div class="col-md-6 float-right text-right"-->
									<div class="form-row">
									<div class="form-group col-md-6">
									 <label for="inputState">Product Status</label>
									  <select id="inputState" class="form-control form-control-sm" name="status">
										<option <?php if ($status == "1" ) echo 'selected="selected"' ; ?> value="1">Active</option>
										<option <?php if ($status == "0" ) echo 'selected="selected"' ; ?> value="0">Deactivate</option>
									</select>
									</div>
									  </div>
								
									 <!--div class="form-row">
									<div class="form-group col-md-6">
									  <label >Description</label>
									  <input type="text" class="form-control" name="description" placeholder="Short notes about Product"  required class="form-control" autocomplete="off">
									</div>
									</div-->
									
									<div class="form-row">
									<div class="form-group col-md-6">
									  <h5>Price Information</h5>
									  </div>
									</div>
									
									<!--div class="form-row">
									<div class="form-group col-md-2">
									<i class="fa fa-rupee fonts" aria-hidden="true"></i>
									 <label>Price/Qty </label>
									<input type="number" id="priceperqty" name="priceperqty" class="form-control form-control-sm"   value="<?php echo $priceperqty;?>" />
									 </div>
									 
									 <div class="form-group col-md-2">
									<i class="fa fa-rupee fonts" aria-hidden="true"></i>
									 <label>Adjust Price</label>
									<input type="number" onkeypress="update_math_vals();"   onkeyup="update_math_vals();" id="adjpriceperqty" name="adjpriceperqty" class="form-control form-control-sm"   />
									 </div>
									 
									 <script>
									 function update_math_vals(){
										$('#priceperqty').val(<?php echo $priceperqty;?>);

										 var adj = $('#adjpriceperqty').val();

										 var pri = $('#priceperqty').val();
                                          var fin = +adj + +pri;
								
										 $('#priceperqty').val(fin);
									 }
									 </script-->
									 
									<div class="form-row">
									<div class="form-group col-md-2">
									<i class="fa fa-rupee fonts" aria-hidden="true"></i>
									 <label>Price/Qty </label>
									<input type="number" step="any" id="priceperqty" name="priceperqty" class="form-control form-control-sm" readonly  value="<?php echo $priceperqty;?>" />
									 </div>
									 
									 <div class="form-group col-md-2">
									<i class="fa fa-rupee fonts" aria-hidden="true"></i>
									 <label>Adjust Price</label>
									<input type="number" step="any" onkeypress="update_math_vals1();"   onkeyup="update_math_vals1();" id="adjpriceperqty" name="adjpriceperqty" class="form-control form-control-sm"   />
									 </div>
									 
									 <script>
									 function update_math_vals1(){
										$('#priceperqty').val(<?php echo $priceperqty;?>);

										 var adj = $('#adjpriceperqty').val();

										 var pri = $('#priceperqty').val();
                                          var fin = +adj + +pri;
											$('#priceperqty').val(fin);
								
										 $('#final_price').val(fin);
										 //$('#product_price').val();										 
									 }
									 </script>
									 
									
								    <!--div class="form-group col-md-2">									
									<label>UOM&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
									 <span class="text-danger"></label>
									<input type="text" name="uom" class="form-control form-control-sm" autocomplete="off" value="<?php echo $uom;?>" />
									 </div>
									  </div-->
									  
									  <div class="form-group col-md-2">
									            <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
										  data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
											<span class="text-danger"></label>
                                                <select id="uom"  required class="form-control form-control-sm" name="uom">
                                                    <option value="0" selected>Select UOM</option>
                                                    <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT code,description FROM uom_lookups ");
                                                    while ($row = $sql->fetch_assoc()){	
                                                         $description=$row['description'];
														 $code=$row['code'];
                                                      if($code==$uom){
																echo '<option value="'.$code.'" selected>'.$description.'</option>';
															}else{
																echo '<option value="'.$code.'" >'.$description.'</option>';

															}
                                                    }
													  
													  
                                                    ?>
                                                </select>	
									</div>							
									</div>

								
									
									 <div class="form-row">
									<div class="form-group col-md-3">
									  <label for="inputState">Tax Method&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" o title="Tax Method - Whether to include TAX or exclude TAX for this Item"></i>
									 </label>
									  <select id="taxmethod" onchange="gettaxrateEdit()" class="form-control form-control-sm" name="taxmethod">
										<option <?php if ($taxmethod == "1" ) echo 'selected="selected"' ; ?> value="1">Inclusive</option>
										<option <?php if ($taxmethod == "0" ) echo 'selected="selected"' ; ?> value="0">Exclusive</option>
									</select>
									</div>		
																
									
									<div class="form-group col-md-3">
									 <label for="inputState">Tax Name</label>									 
                                                <select id="taxid"  onchange="gettaxrateEdit()" required class="form-control form-control-sm" name="taxid">                                                                                                     

													 <?php 
                                                    include("database/db_conection.php");//make connection here

                                                    $sql = mysqli_query($dbcon, "SELECT id,taxtype,taxrate,taxname FROM taxmaster ");
                                                    while ($row = $sql->fetch_assoc()){	                                                        
														 $taxrate=$row['taxrate'];
														  $taxname=$row['taxname'];
														  $taxtype=$row['taxtype'];
														  $taxid=$row['id'];
                                                        if($taxid==$taxidg){
                                                         echo '<option  selected data-name="'.$taxname.'" data-type="'.$taxtype.'" data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';						}else{
 echo '<option  data-name="'.$taxname.'" data-type="'.$taxtype.'" data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
												     }
                                                    }												  
													  
                                                    ?>
                                                    
                                                </select>	
												</div>
                                         
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="taxtype" id="taxtype" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div> 
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="taxname" id="taxname" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div> 
                                        </div>
											
								
								<div class="form-row">
									<div class="form-group col-md-3">
										<!-- <i class="fa fa-rupee fonts" aria-hidden="true"></i> -->
										<label>Tax Rate %<span class="text-danger">*</label></span>
										<input type="text" name="disptaxrate" id="disptaxrate" class="form-control form-control-sm"    readonly value="<?php echo $disptaxrate;?>" />
									</div>
																		
									<div class="form-group col-md-3">									
									<label>Tax Amount&nbsp</label>
									<input type="text" name="disptax" id="disptax" class="form-control form-control-sm" autocomplete="off" placeholder="Tax Amount" readonly value="<?php echo $disptax;?>" />
									 </div>
									 </div>
									 
									 <div class="form-row">
									 <div class="form-group col-md-3">
										<i class="fa fa-rupee fonts" aria-hidden="true"></i>
										<label>Actual Product Price<span class="text-danger">*</label></span>
										<input type="text" name="product_price" id="product_price" class="form-control form-control-sm"  required placeholder="Actual Product price" readonly value="<?php echo $product_price;?>" />
									</div>
									
									<div class="form-group col-md-3">									
									<label>Final Price&nbsp;</label>
									<input type="text" name="final_price" id="final_price" class="form-control form-control-sm" autocomplete="off" placeholder="Price Including Tax" readonly value="<?php echo $final_price;?>" />
									 </div>
									</div>
																		
									<div class="form-row">
									<div class="form-group col-md-6">
									 <label>HSN Code</label>
									  <input type="text" name="hsncode" class="form-control form-control-sm"  placeholder="Enter a valid HSN Code.." >
								   </div>
								   </div>	

								<div class="form-row">
									<div class="form-group col-md-6">
									 <label>Update As of Date<span class="text-danger">*</label>&nbsp;</span><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
									  data-trigger="focus" data-placement="top" title="Date From - is used to set the date of last updated price"></i>
									 </label>
									  <input type="date" name="pricedatefrom" class="form-control form-control-sm"  value="<?php echo $pricedatefrom;?>" />
									</div> 
								</div>								   
								
								 <div class="form-row">
									<div class="form-group col-md-6">
									  <h5>Edit Stock Information</h5>
									  </div>
									</div>
									
									<div class="form-row">
									<div class="form-group col-md-3">
									 <label>QTY in Stock</label>
									 <input type="number" step="any" class="form-control form-control-sm" id="stockinqty" name="stockinqty" readonly />
									
									</div>
									
									  <div class="form-group col-md-3">									
									 <label>Adj Stock</label>
									<!--input type="text" id="adjstock" name="adjstock" class="form-control form-control-sm"   /-->
									<input type="number" step="any" onkeypress="update_math_valsAdjStock();"   onkeyup="update_math_valsAdjStock();" id="adjstockinqty" name="adjstockinqty" class="form-control form-control-sm"   />
									 </div>
									 
									 <script>
									 function update_math_valsAdjStock(){
										  $('#stockinqty').val(<?php echo $stockinqty;?>);

										 var adj = $('#adjstockinqty').val();
										// alert(adj);
										 var pri = $('#stockinqty').val();
                                          var fin = +adj + +pri;
										//  alert(pri);
								
										 $('#stockinqty').val(fin);
									 }
									 </script>
									 </div>
									 
									<!--div class="form-row">
									<div class="form-group col-md-3">
									<!--div class="invoice-title text-left mb-6"-->
										<!--label> QTY in UOM</label-->
									  <!--input type="text" class="form-control form-control-sm" id="stockinuom" name="stockinuom" readonly value="<?php echo $stockinuom;?>" /-->
									 <!--/div-->
									 
									  <!--div class="form-group col-md-3">									
									 <label>Adjust UOM</label>
									<!--input type="text" id="adjstock" name="adjstock" class="form-control form-control-sm"   /-->
									<!--input type="number" onkeypress="update_math_valsAdjUom();"   onkeyup="update_math_valsAdjUom();" id="adjstockinuom" name="adjstockinuom" class="form-control form-control-sm"   />
									 </div>
									 
									 <script>
									 function update_math_valsAdjUom(){
										$('#stockinuom').val(<?php echo $stockinuom;?>);

										 var adj = $('#adjstockinuom').val();

										 var pri = $('#stockinuom').val();
                                          var fin = +adj + +pri;
								
										 $('#stockinuom').val(fin);
									 }
									 </script>
									  </div-->	
									  
									<div class="form-row">
									<div class="form-group col-md-3">
									<label>Low Stock Alert</label>
                                        <input type="text" class="form-control form-control-sm" id="lowstockalert" name="lowstockalert" readonly value="<?php echo $lowstockalert;?>" />       
                                      					  
									  
									  </div>
									   <div class="form-group col-md-3">									
									 <label>Adjust Low Stock Alert</label>
									<input type="number" step="any" onkeypress="update_math_valsAdjLowAlrt();"   onkeyup="update_math_valsAdjLowAlrt();" id="adjlowstockalert" name="adjlowstockalert" class="form-control form-control-sm"   />
									 </div>									 
									
									<script>
									 function update_math_valsAdjLowAlrt(){
										$('#lowstockalert').val(<?php echo $lowstockalert;?>);
										 var adj = $('#adjlowstockalert').val();
										 var pri = $('#lowstockalert').val();
                                          var fin = +adj + +pri;								
										 $('#lowstockalert').val(fin);
									 }
									 </script>
									  </div>	
									  
									  <div class="form-row">									  
									  	<div class="form-group col-md-6">
									<label for="inputState">Update As of Date</label>
									  <input type="date" class="form-control form-control-sm" name="stockasofdate" value="<?php echo $stockasofdate;?>" />
									</div>
									</div>
									  
									  
								
									 
									 <div class="form-row">
									  <div class="form-group col-md-6">
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
									   <input type="text" class="form-control form-control-sm" name="handler" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />
									
									 </div>
									 </div>
									 
									<div class="form-group col-md-6">
									  <h5>Notes Information</h5>
									  </div>
									
									
									<div class="form-row">
									<div class="form-group col-md-6">
									 <label> Add Notes</label></span>									
									 <textarea rows="2" class="form-control" id="notes" name="notes" placeholder="write updated notes here"></textarea>
																 
									</div> 
								</div>
								</div>									
									<div class="form-row">
								     <div class="modal-footer">
										<input type="hidden" name="purchaseItmMasterID" value="<?=$_GET['id']?>">
										<button type="submit" name="purchaseItemMasterEdit" value="purchaseItemMasterEdit" class="btn btn-primary">Update</button>
									
									</div>
									</div>	
									</div>
								</form>
							
		      </div>
			<!-- END container-fluid -->

		</div>
		<!-- END content -->

    </div>
	<!-- END content-page -->
	

<script>
	function gettaxrateEdit(){
            //var taxrate = document.getElementById('taxname').value;
            var taxmethod = document.getElementById('taxmethod').value;
            var price   = document.getElementsByName('priceperqty')[0].value;
            var taxtype = $('#taxid option:selected').attr('data-type');
            var taxrate = $('#taxid option:selected').attr('data-rate');
            var taxname = $('#taxid option:selected').attr('data-name');

           // var taxname = document.getElementById('taxname').value;

            var product_price = 0;

            //alert(taxrate+"---"+price);
            if(taxrate == "" || taxrate == null){
                taxrate = 0;
            }
            if(price == "" || price == null ){
                price = 0;
            }
            calcPrice   = (price - ( price * taxrate / 100 )).toFixed(2);
            percentagedval = (parseFloat(price)-parseFloat(calcPrice)).toFixed(2);

            if(taxmethod=='1'){
                product_price = price-percentagedval;

            }else{
                product_price = price;
                price = parseFloat(price)+parseFloat(percentagedval);
            }
            $('#taxname').val(taxname);
            $('#taxtype').val(taxtype);

            $('#disptaxrate').val(taxrate);
            $('#disptax').val(percentagedval);

            $('#final_price').val(price);
            $('#product_price').val(product_price);
	}
	$('document').ready(function(){
		$('#stockinqty').val(<?php echo $stockinqty;?>);

	});
</script>

	<!--footer class="footer">
		<span class="text-right">
		Copyright@<a target="_blank" href="#">Dhiraj Agro Products Pvt. Ltd.,</a>
		</span>
		<span class="float-right">
		Powered by <a target="_blank" href=""><span>e-Schoolz</span> </a>
		</span>
	</footer>

</div>
<!-- END main -->

<!--script src="assets/js/modernizr.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>

<script src="assets/js/detect.js"></script>
<script src="assets/js/fastclick.js"></script>
<script src="assets/js/jquery.blockUI.js"></script>
<script src="assets/js/jquery.nicescroll.js"></script>
<script src="assets/js/jquery.scrollTo.min.js"></script>
<script src="assets/plugins/switchery/switchery.min.js"></script-->

<!-- App js -->
<!--script src="assets/js/pikeadmin.js"></script>

<!-- BEGIN Java Script for this page -->


<!--/body>
</html-->
<?php include('footer.php');?>