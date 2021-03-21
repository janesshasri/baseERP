<?php include('header.php');
$entrytype = "";
if(isset($_GET['entrytype'])){
    $entrytype = $_GET['entrytype'];
}
?>
<!-- End Sidebar -->

<!-- Modal -->
<div class="modal fade custom-modal" id="customModal" tabindex="-1" role="dialog" aria-labelledby="customModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">Add New Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" enctype="multipart/form-data" method="post">

                    <div class="form-group">
                        <input type="text" class="form-control" name="addcategory"  id="addcategory"  placeholder="Add Category">
                    </div>		
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" name="submitcategory" id="submitcategory" class="btn btn-primary">Save and Associate</button>
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
                        <h1 class="main-title float-left">Sales Item Master</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Sales Item Master</li>
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
                            <h3 class="fa-hover col-md-12 col-sm-12">
                                <i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i> Sales Item Master
                            </h3>
                        </div>
                        <div class="card-body">

                            <!--form autocomplete="off" action="#"-->
                            <form id="salesitemform" autocomplete="off" action="#" enctype="multipart/form-data" method="post">			

                            <div class="form-row">
                                    <div class="form-group col-md-6">

                                    <label for="">Select Entry Type</label>
                                    <select class="form-control form-control-sm select2" name="entrytype" id="entrytype"
                                    onchange="location.href='addSalesItemMaster.php?entrytype='+this.value">
                                            <option value="">Select Type</option>
                                            <option value="self" <?php if($entrytype!="" && $entrytype=="self"){ echo "selected"; } ?> >Self</option>
                                            <option value="outsourced" <?php if($entrytype!="" && $entrytype=="outsourced"){ echo "selected"; } ?> >Outsourced</option>
                                         
                                    </select>
                                    </div>
                            </div>

                            <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Select Company<i class="text-danger">*</i></label>
                                        <select id="orgid" onchange="checkForItemName()" class="form-control form-control-sm select2"  required name="orgid" required autocomplete="off">
                                            <option selected>Open Oranization</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                            if($entrytype=="outsourced"){
                                                $sql = mysqli_query($dbcon,"SELECT custid as orgid,concat(custid,'-',custname) as orgname, custname as name FROM customerprofile
                                                 where custype='Partner'
                                                ORDER BY id ASC
                                                "); 
                                            }else{
                                                $sql = mysqli_query($dbcon,"SELECT orgid,concat(orgid,'-',orgname) as orgname, orgname as name FROM comprofile
                                                ORDER BY id ASC
                                                "); 
                                            }
                                        
                                            while ($row = $sql->fetch_assoc()){	
                                                 $orgid=$row['orgid'];
                                                 $orgname=$row['orgname'];
                                                echo '<option data-orgname="'.$row['name'].'" value="'.$orgid.'" >'.$row['name'].' </option>';

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                      

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Item Name<span class="text-danger">*</span></label>
                                        <input type="text" 
                                        onkeypress="checkForItemName();" 
                                          onkeyup="checkForItemName();" 
                                     class="form-control form-control-sm" name="itemname" id="itemname"
                                      placeholder="Product Name" required class="form-control" 
                                      autocomplete="off" />
                                        <small id="itemNameHelpText" style="display:none;" class="form-text text-danger">Item name already exists</small>

                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Category</label>
                                        <select id="category" onchange="" class="form-control form-control-sm select2"
                                         name="category" id="category" autocomplete="off">
                                         
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
                                        <a href="#custom-modal" data-target="#customModal" data-toggle="modal"> 
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>Add New Category</a><br/>

                                    </div>
                                </div>
								
								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>HSN Code</label>
                                        <input type="text" name="hsncode" id="hsncode" class="form-control form-control-sm"  placeholder="Enter a valid HSN Code.."  >
                                    </div>
                                </div>	
								
								<div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>MRP and Discount Details</h5>
                                    </div>
                                </div>
                                <div id="sales_div">
                                    <div class="form-row">                                        
										<div class="form-group col-md-3">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>MRP<span class="text-danger">*</span></label>
                                            <input type="text"  class="form-control form-control-sm" 
                                                   name="sales_mrp" id="sales_mrp" 
                                                   required placeholder="MRP Per Qty"  
                                                   onkeypress="setDiscountedValue('sales_div');"  
                                                   onkeyup="setDiscountedValue('sales_div');"  />
                                        </div>
										
                                        <div class="form-group col-md-3">                                            
                                            <label>Discount(%)<span class="text-danger">*</span></label>
                                            <input type="number" class="form-control form-control-sm" 
                                                   name="sales_disc" id="sales_disc" 
                                                   required placeholder="Discount per Qty" autocomplete="off" 
                                                   onkeypress="setDiscountedValue('sales_div');"  
                                                   onkeyup="setDiscountedValue('sales_div');"  />
                                        </div>
									</div>
										
										
										<!--div class="form-group col-md-2">
                                            <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                               data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                                <span class="text-danger">*</span></label>
                                            <select id="sales_uom" onchange="gettaxrate('sales_div');" required class="form-control form-control-sm" name="sales_uom">
                                                <option value="0" selected>Select UOM</option>
                                                <?php 
                                                include("database/db_conection.php");//make connection here

                                                $sql = mysqli_query($dbcon, "SELECT code,description FROM uom_lookups ");
                                                while ($row = $sql->fetch_assoc()){	
                                                    $description=$row['description'];
                                                    $code=$row['code'];
                                                    echo '<option  value="'.$code.'" >'.$description.'</option>';
                                                }
                                                ?>
                                            </select>	
                                        </div>							
                                    </div-->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Sales Price Information</h5>
                                    </div>
                                </div>
                                <div id="sales_div">
                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Sales Rate/Price<span class="text-danger">*</span></label>
                                            <input type="text" onchange="gettaxrate('sales_div');" name="sales_priceperqty" id="sales_priceperqty" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly/>
                                        </div>
<!--
                                        <div class="form-group col-md-2" id="adjust_price" style="display:none">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Adjust Price</label> 
                                            <input type="number" step="any" onkeypress="adjustprice('sales');"  onkeyup="adjustprice('sales');" id="sales_adjpriceperqty" name="sales_adjpriceperqty" class="form-control form-control-sm"   />
                                        </div>
-->
                                        <div class="form-group col-md-3">
                                            <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                               data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                                <span class="text-danger">*</span></label>
                                            <select id="sales_uom" onchange="gettaxrate('sales_div');" required class="form-control form-control-sm" name="sales_uom">
                                                <option value="0" selected>Select UOM</option>
                                                <?php 
                                                include("database/db_conection.php");//make connection here

                                                $sql = mysqli_query($dbcon, "SELECT code,description FROM uom_lookups ");
                                                while ($row = $sql->fetch_assoc()){	
                                                    $description=$row['description'];
                                                    $code=$row['code'];
                                                    echo '<option  value="'.$code.'" >'.$description.'</option>';
                                                }
                                                ?>
                                            </select>	
                                        </div>							
                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>As of Date<span class="text-danger">*</span></label>
                                            <i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                               data-trigger="focus" data-placement="top" title="As of Date is price as on date"></i>
                                            <input type="date" class="form-control form-control-sm"  name="sales_pricedatefrom" id="sales_pricedatefrom" value="<?php echo date("Y-m-d");?>">					  
                                        </div>
                                    </div>											


                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Tax Method
                                            </label>
                                            <select id="sales_taxmethod" name="sales_taxmethod" onchange="gettaxrate('sales_div')" class="form-control form-control-sm" name="taxmethod">
                                                <option selected>Select Tax Method</option>
                                                <option value="1">Inclusive</option>
                                                <option value="0">Exclusive</option>
                                            </select>
                                        </div>



                                        <div class="form-group col-md-3">
                                            <label for="inputState">Tax Name</label>
                                            <select id="sales_taxid" onchange="gettaxrate('sales_div');" required class="form-control form-control-sm" name="sales_taxid">
                                                <option value="0" selected>Open Taxrate</option>
                                                <?php 

                                                $sql = mysqli_query($dbcon, "SELECT id,taxtype,taxname,taxrate FROM taxmaster ");
                                                while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                $taxtype=$row['taxtype'];
                                                $taxid=$row['id'];
                                                echo '<option  data-name="'.$taxname.'" data-type="'.$taxtype.'" data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="sales_taxtype" id="sales_taxtype" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div> 
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="sales_taxname" id="sales_taxname" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div>
                                    <div class="form-group" style="display:none;">
                                        <input type="text" name="itemcost" id="itemcost" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div>
                                    </div>




                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <!-- <i class="fa fa-rupee fonts" aria-hidden="true"></i> -->
                                            <label>Tax Rate %<span class="text-danger">*</span></label>
                                            <input type="text" name="sales_taxrate" id="sales_taxrate" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                        </div>

                                        <div class="form-group col-md-3">									
                                            <label>Tax Amount&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                                data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                                </span></label>
                                            <input type="text" name="sales_taxamount" id="sales_taxamount" class="form-control form-control-sm" autocomplete="off" placeholder="Tax Amount" required readonly />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Actual Product Price<span class="text-danger">*</span></label>
                                            <input type="text" name="sales_product_price" id="sales_product_price" class="form-control form-control-sm"  required placeholder="Actual Product price" autocomplete="off" readonly />
                                        </div>

                                        <div class="form-group col-md-3">									
                                            <label>Final Price&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                                 data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                                </span></label>
                                            <input type="text" name="sales_final_price" id="sales_final_price" class="form-control form-control-sm" autocomplete="off" placeholder="Price Including Tax" required readonly>
                                        </div>
                                    </div>
                                </div>											

				


                                <div class="form-row" style="display:none">
                                    <div class="form-group col-md-6">
                                        <h5>Purchase Price Information</h5>
                                    </div>
                                </div>
                                <div id="purchase_div" style="display:none">
                                    <div class="form-row">
                                        <div class="form-group col-md-2">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Cost<span class="text-danger"></span></label>
                                            <input type="text" onchange="gettaxrate('purchase_div');" name="priceperqty" id="priceperqty" class="form-control form-control-sm"  placeholder="Price Per Qty" autocomplete="off" />
                                        </div>
                                        <div class="form-group col-md-2" id="adjust_cost" style="display:none">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Adjust Price</label>
                                            <input type="number" step="any" onkeypress="adjustprice('purchase');"  onkeyup="adjustprice('purchase');" id="adjpriceperqty" name="adjpriceperqty" class="form-control form-control-sm"   />
                                        </div>
                                        <div class="form-group col-md-2">
                                            <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                               data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                                <span class="text-danger">*</span></label>
                                            <select id="uom" onchange="gettaxrate('purchase_div');"  class="form-control form-control-sm" name="uom">
                                                <option value="0" selected>Select UOM</option>
                                                <?php 

                                                $sql = mysqli_query($dbcon, "SELECT code,description FROM uom_lookups ");
                                                while ($row = $sql->fetch_assoc()){	
                                                    $description=$row['description'];
                                                    $code=$row['code'];
                                                    echo '<option  value="'.$code.'" >'.$description.'</option>';
                                                }
                                                ?>
                                            </select>	
                                        </div>	

                                    </div>


                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>As of Date<span class="text-danger">*</span></label>
                                            <i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                               data-trigger="focus" data-placement="top" title="As of Date is price as on date"></i>
                                            <input type="date" class="form-control form-control-sm"  name="pricedatefrom" id="pricedatefrom" value="<?php echo date("Y-m-d");?>">					  
                                        </div>
                                    </div>											


                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <label for="inputState">Tax Method
                                            </label>
                                            <select id="taxmethod" onchange="gettaxrate('purchase_div');" class="form-control form-control-sm" name="taxmethod">
                                                <option value=''>Select Tax Method</option>
                                                <option value="1">Inclusive</option>
                                                <option value="0">Exclusive</option>
                                            </select>
                                        </div>



                                        <div class="form-group col-md-3">
                                            <label for="inputState">Tax Name</label>
                                            <select id="taxid" onchange="gettaxrate('purchase_div');"  class="form-control form-control-sm" name="taxid">
                                                <option value="0" selected>Open Taxrate</option>
                                                <?php 
                                                include("database/db_conection.php");//make connection here
                                                $sql = mysqli_query($dbcon, "SELECT id,taxtype,taxname,taxrate FROM taxmaster ");
                                                while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                $taxtype=$row['taxtype'];
                                                $taxid=$row['id'];
                                                echo '<option  data-name="'.$taxname.'" data-type="'.$taxtype.'" data-rate="'.$taxrate.'" value="'.$taxid.'" >'.$taxname.'</option>';
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
                                            <label>Tax Rate %<span class="text-danger">*</span></label>
                                            <input type="text" name="taxrate" id="taxrate" class="form-control form-control-sm"   placeholder="Price Per Qty" autocomplete="off" readonly>
                                        </div>

                                        <div class="form-group col-md-3">									
                                            <label>Tax Amount&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                                data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                                </span></label>
                                            <input type="text" name="taxamount" id="taxamount" class="form-control form-control-sm" autocomplete="off" placeholder="Tax Amount"  readonly />
                                        </div>
                                    </div>

                                    <div class="form-row">
                                        <div class="form-group col-md-3">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Actual Product Price<span class="text-danger">*</span></label>
                                            <input type="text" name="product_price" id="product_price" class="form-control form-control-sm"   placeholder="Actual Product price" autocomplete="off" readonly />
                                        </div>

                                        <div class="form-group col-md-3">									
                                            <label>Final Price&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                                 data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                                </span></label>
                                            <input type="text" name="final_price" id="final_price" class="form-control form-control-sm" autocomplete="off" placeholder="Price Including Tax"  readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Stock Information</h5>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label>Initial Qty on Hand<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="stockinqty" id="stockinqty" placeholder="Current Stock in quantity" required autocomplete="off">
                                    </div>		 					
                                    <div class="form-group col-md-3" id="adjust_stock" style="display:none">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Adjust Stock</label>
                                        <input type="number" step="any" onkeypress="adjustprice('stock');"  onkeyup="adjustprice('stock');" id="adjuststk" name="adjuststk" class="form-control form-control-sm"   />
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="inputState">As of Date</label>									
                                        <input type="date" class="form-control form-control-sm"  name="stockinqty_date" id="stockinqty_date" value="<?php echo date("Y-m-d");?>">		
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">									  
                                        <label>Low Stock Alert</label>
                                        <input type="text" class="form-control form-control-sm" name="lowstockalert" id="lowstockalert" placeholder="eg., 5  or 10 "  required class="form-control" autocomplete="off">
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Prefered Supplier Name</label>
                                        <select id="sales_vendorid" onchange="" class="form-control form-control-sm"  required name="sales_vendorid" autocomplete="off">
                                            <option selected>Open Vendors</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                            $sql = mysqli_query($dbcon,"SELECT vendorid,concat(title,' ',supname) as vendorname FROM vendorprofile
																			ORDER BY id ASC
																			");
                                            while ($row = $sql->fetch_assoc()){	
                                                echo $vendorid=$row['vendorid'];
                                                echo $vendorname=$row['vendorname'];
                                                echo '<option onchange="'.$row[''].'" value="'.$vendorid.'" >'.$vendorname.'</option>';

                                            }
                                            ?>
                                        </select>
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
                                        <input type="text" class="form-control form-control-sm" name="handler" id="handler" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />

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
                                        <textarea rows="2" class="form-control editor" id="notes" name="notes" placeholder="add product/price/stock related notes here"></textarea>
                                    </div> 
                                </div>



                                <div class="form-row">
                                    <div class="form-group text-right m-b-12">
                                        <input type="hidden" name="id" >
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
    <!-- BEGIN Java Script for this page -->


    <script>
        var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
        var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
        var page_item_code = "<?php if(isset($_GET['itemcode'])){ echo $_GET['itemcode']; } ?>";
        var page_sales_priceperqty = 0;
        var page_sales_mrp = 0;
        var page_sales_disc = 0;
        var page_priceperqty = 0;
        var page_stockinqty = 0;


        $('document').ready(function(){	
            console.log("jp")
            $('#submitcategory').click(function(){
                var category = $('#addcategory').val();
                //var suptype = $('#addsupptype').val();
                //alert(groupname+description);
                $.ajax ({
                    url: 'addCategoryModal.php',
                    type: 'post',
                    data: {
                        category:category,
                        // description:description
                    },
                    //dataType: 'json',
                    success:function(response){
                        if(response!=0 || response!=""){
                            var new_option ="<option>"+response+"</option>";
                            $('#category').append(new_option);
                            $('#customModal').modal('toggle');
                        }else{
                            alert('Error in inserting new Category,try another unique category');
                        }
                    }

                });

            });

            if(page_action=="edit"){
                var edit_data = Page.get_edit_vals(page_item_code,page_table,"itemcode");
                page_sales_priceperqty = edit_data.sales_priceperqty;
                page_sales_mrp = edit_data.sales_mrp;
                page_sales_disc = edit_data.sales_disc;
                page_priceperqty = edit_data.priceperqty;
                page_stockinqty = edit_data.stockinqty;
                set_form_data(edit_data);
                $('#adjust_price').show();
                $('#adjust_cost').show();
                $('#adjust_stock').show();
                $('#sales_priceperqty').attr('readonly',true);
//                $('#sales_mrp').attr('readonly',true);
//                $('#sales_disc').attr('readonly',true);
                $('#sales_uom').attr('readonly',true);
                $('#priceperqty').attr('readonly',true);
                $('#uom').attr('readonly',true);
                $('#stockinqty').attr('readonly',true);
            }
            function set_form_data(data){
                // console.log(data.po_owner);
                //// $('#po_owner').val(data.po_owner);
                $.each(data, function(index, value) {

                    if(index=="id"||index=="po_code"){


                    }else{
                        $('#'+index).val(value);
                    }

                }); 


            }

            
            gettaxrate('sales_div');
            gettaxrate('purchase_div');

        });
        
        function setDiscountedValue(id){
                
            var ele = document.getElementById(id);
            var mrp = "";
            var disc = "";
            mrp = $('#sales_mrp',ele).val();
            disc = $('#sales_disc',ele).val();
            var adjval = mrp - mrp*(disc/100);
            $('#sales_priceperqty',ele).val(adjval);

            gettaxrate('sales_div');                            
        }



        function gettaxrate(id){
            var ele = document.getElementById(id);
            var taxrate = "";
            var taxmethod = "";
            var price   = "";
            var taxtype = "";
            var taxname = "";
       
            if(id=="sales_div"){
                taxid = $('#sales_taxid',ele).val();
                taxtype = $('#sales_taxid option:selected').attr('data-type');
                taxrate = $('#sales_taxid option:selected').attr('data-rate');
                taxname = $('#sales_taxid option:selected').attr('data-name');
                taxmethod = $('#sales_taxmethod',ele).val();
                price   = $('#sales_priceperqty',ele).val();
            }else{
                taxid = $('#taxid',ele).val();
                taxtype = $('#taxid option:selected').attr('data-type');
                taxrate = $('#taxid option:selected').attr('data-rate');
                taxname = $('#taxid option:selected').attr('data-name');
                taxmethod = $('#taxmethod',ele).val();
                price   = $('#priceperqty',ele).val();
            }


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
                $('#itemcost',ele).val(product_price);

            if(id=="sales_div"){
                $('#sales_taxrate',ele).val(taxrate);
                $('#sales_taxtype',ele).val(taxtype);
                $('#sales_taxname',ele).val(taxname);
                $('#sales_taxamount',ele).val(percentagedval);

                $('#sales_final_price',ele).val(price);
                $('#sales_product_price',ele).val(product_price);
            }else{
                $('#taxrate',ele).val(taxrate);
                $('#taxtype',ele).val(taxtype);
                $('#taxname',ele).val(taxname);
                $('#taxamount',ele).val(percentagedval);

                $('#final_price',ele).val(price);
                $('#product_price',ele).val(product_price);
            }

        }
        

        function adjustprice(type){

            if(type=="sales"){
                $('#sales_mrp').val(page_sales_mrp);
                var adj = $('#sales_adjpriceperqty').val();
                var pri = $('#sales_mrp').val();
                var fin = +adj + +pri;
                $('#sales_mrp').val(fin);
                
                setDiscountedValue('sales_div');
                
                //  $('#final_price').val(fin);
            }else if(type=="purchase"){
                $('#priceperqty').val(page_priceperqty);
                var adj = $('#adjpriceperqty').val();
                var pri = $('#priceperqty').val();
                var fin = +adj + +pri;
                $('#priceperqty').val(fin);
                gettaxrate('purchase_div');
            }else{
                $('#stockinqty').val(page_stockinqty);
                var adjstk = $('#adjuststk').val();
                var stk = $('#stockinqty').val();
                var fin = +adjstk + +stk;
                $('#stockinqty').val(fin);
            }
        }

        $("form#salesitemform").submit(function(e){
            e.preventDefault();


            var $form = $("#salesitemform");
            var data = getFormData($form);
    
            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    if(n['name']=="id"||n['name']=="product_price"||n['name']=="final_price"||n['name']=="sales_product_price"||n['name']=="sales_final_price"||n['name']=="sales_adjpriceperqty"||n['name']=="adjpriceperqty"||n['name']=="adjuststk"){

                    }else{
                        indexed_array[n['name']] = n['value'];
                    }
                });

                return indexed_array;
            }
            var adjstk = $('#adjuststk').val();

           

            $.ajax ({
                url: 'workers/setters/save_salesitem.php',
                type: 'post',
                data: {array : JSON.stringify(data),itemcode:page_item_code,action:page_action?page_action:"add",table:"salesitemaster2",adjstk : adjstk },
                dataType: 'json',
                success:function(response){
                   // alert(response)
                    if(response.status){
                        location.href="listSalesItemMaster.php";

                    }
                },
                error: function(ts) { alert(ts.responseText) }



            });

        });

    </script>


    <script>

        $('document').ready(function(){
            $('#submittax').click(function(){
                var taxname=$('#addtaxname').val();
                var description=$('#adddescription').val();//same
                var taxtype=$('#addtaxtype').val();
                var taxrate=$('#addtaxrate').val();
                //alert(groupname+description);
                $.ajax ({
                    url: 'addTaxModal.php',
                    type: 'post',
                    data: {
                        taxname:taxname,
                        description:description,
                        taxtype:taxtype,
                        taxrate:taxrate
                    },
                    //dataType: 'json',
                    success:function(response){
                        if(response!=0 || response!=""){
                            var new_option ="<option>"+response+"</option>";
                            $('#taxname').append(new_option);
                            $('#customModal7').modal('toggle');
                            window.location.reload(true);

                        }else{
                            alert('Error in inserting taxname type,try another one');
                        }
                    }

                });

            });
        });

    </script>	    <?php include('footer.php');?>

