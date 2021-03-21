<?php
include("database/db_conection.php");//make connection here

if(isset($_POST['submit']))
{	$itemcode ="";
 $prefix = "DAPL00";
 $itemname=$_POST['itemname'];//here getting result from the post array after submitting the form.
 $category =$_POST['category'];//same
 $hsncode =$_POST['hsncode'];//same
 //$status 	=$_POST['status'];
 $priceperqty 		=$_POST['priceperqty'];
 $uom =$_POST['uom'];
 $pricedatefrom 	=$_POST['pricedatefrom'];   
 $taxmethod 		=$_POST['taxmethod'];
 $taxname	=$_POST['taxname'];
 $disptaxrate = $_POST['taxrate'];
 $disptax = $_POST['taxamount'];
 $product_price = $_POST['productprice'];
 $final_price = $_POST['taxableprice'];

 $p_priceperqty 		=$_POST['p_priceperqty'];
 $p_uom 		=$_POST['p_uom'];
 $p_pricedatefrom 	=$_POST['p_pricedatefrom'];   
 $p_taxmethod 		=$_POST['p_taxmethod'];
 $p_taxname	=$_POST['p_taxname'];
 $p_disptaxrate = $_POST['p_taxrate'];
 $p_disptax = $_POST['p_taxamount'];
 $p_product_price = $_POST['p_product_price'];
 $p_final_price = $_POST['p_final_price'];


 $stockinqty 	=$_POST['stockinqty'];
 //$stockinuom	=$_POST['stockinuom'];
 $lowstockalert	=$_POST['lowstockalert'];
 $stockasofdate =$_POST['stockasofdate'];
 //$qtyondemand=$_POST['qtyondemand'];
 //$usageunit =$_POST['usageunit'];
 $vendor = $_POST['vendor'];
 $handler 	=$_POST['handler'];
 $notes = $_POST['notes'];




 $sql="SELECT MAX(id) as latest_id FROM salesitemaster ORDER BY id DESC";
 if($result = mysqli_query($dbcon,$sql)){
     $row   = mysqli_fetch_assoc($result);
     if(mysqli_num_rows($result)>0){
         $maxid = $row['latest_id'];
         $maxid+=1;

         $itemcode = $prefix.$maxid;
     }else{
         $maxid = 0;
         $maxid+=1;
         $itemcode = $prefix.$maxid;
     }
 }
 $sql1 = "INSERT into salesitemaster(`itemcode` ,
										`itemname` ,
										`category` ,
										`hsncode` ,
										`priceperqty`, 
										`uom`, 
										`pricedatefrom`, 
										`taxmethod` ,
										`taxname` ,
										`taxrate`,
										`taxamount`, 
										`productprice` ,
										`taxableprice`, 
										`p_priceperqty`, 
										`p_uom`, 
										`p_pricedatefrom` ,
										`p_taxmethod` ,
										`p_taxname` ,
										`p_disptaxrate`, 
										`p_disptax` ,
										`p_product_price`, 
										`p_final_price` ,
										`stockinqty` ,
										`lowstockalert`, 
										`stockasofdate` ,
										`vendor` ,
										`handler` ,
										`notes`) 
)
								VALUES ('$itemcode', 
										'$itemname',
										'$category ',
										'$hsncode ',
										'$priceperqty', 
										'$uom ',
										'$pricedatefrom ',
										'$taxmethod ',
										'$taxname ',
										'$taxrate ',
										'$disptax ',
										'$product_price ',
										'$p_final_price', 
										'$p_priceperqty ',
										'$p_uom ',
										'$p_pricedatefrom ',
										'$p_taxmethod ',
										'$p_taxname ',
										'$p_disptaxrate', 
										'$p_disptax ',
										'$p_product_price', 
										'$p_final_price ',
										'$stockinqty ',
										'$lowstockalert', 
										'$stockasofdate ',
										'$vendor ',
										'$handler ',
										'$notes ')";

 if(mysqli_query($dbcon,$sql))	
 {
     //header("location:listSalesItemMaster.php");
 }   else {
     die('Error: ' . mysqli_error($dbcon));
     echo "<script>alert('Sales Item Master Record Creation unsuccessful ')</script>";
 }
}

?>
<?php include('header.php');?>
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
                            <form autocomplete="off" action="#" enctype="multipart/form-data" method="post">			


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Item Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="itemname" placeholder="Product Name" required class="form-control" autocomplete="off" />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
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
                                        <a href="#custom-modal" data-target="#customModal" data-toggle="modal"> 
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>Add New Category</a><br>






                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>HSN Code</label>
                                        <input type="text" name="hsncode" class="form-control form-control-sm"  placeholder="Enter a valid HSN Code.."  >
                                    </div>
                                </div>	


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Sales Price Information</h5>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-1">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Sales Rate/Price<span class="text-danger">*</span></label>
                                        <input type="text" onchange="gettaxrate()" name="priceperqty" id="priceperqty" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" />
                                    </div>

                                    <div class="form-group col-md-1">
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


                                    <div class="form-group col-md-1">
                                        <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                           data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                            <span class="text-danger">*</span></label>
                                        <select id="uom" onchange="gettaxrate()" required class="form-control form-control-sm" name="uom">
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
                                        <input type="date" class="form-control form-control-sm"  name="pricedatefrom" value="<?php echo date("Y-m-d");?>">					  
                                    </div>
                                </div>											


                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputState">Tax Method
                                        </label>
                                        <select id="taxmethod" onchange="gettaxrate()" class="form-control form-control-sm" name="taxmethod">
                                            <option selected>Select Tax Method</option>
                                            <option value="1">Inclusive</option>
                                            <option value="0">Exclusive</option>
                                        </select>
                                    </div>



                                    <div class="form-group col-md-3">
                                        <label for="inputState">Tax Name</label>
                                        <select id="taxname" onchange="gettaxrate()" required class="form-control form-control-sm" name="taxname">
                                            <option value="0" selected>Open Taxrate</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here

                                            $sql = mysqli_query($dbcon, "SELECT taxname,taxrate FROM taxmaster ");
                                            while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                echo '<option  value="'.$taxrate.'" >'.$taxname.'</option>';
                                            }
                                            ?>
                                        </select>	
                                    </div>							
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <!-- <i class="fa fa-rupee fonts" aria-hidden="true"></i> -->
                                        <label>Tax Rate %<span class="text-danger">*</span></label>
                                        <input type="text" name="disptaxrate" id="disptaxrate" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div>

                                    <div class="form-group col-md-3">									
                                        <label>Tax Amount&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                            data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                            </span></label>
                                        <input type="text" name="disptax" id="disptax" class="form-control form-control-sm" autocomplete="off" placeholder="Tax Amount" required readonly />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Actual Product Price<span class="text-danger">*</span></label>
                                        <input type="text" name="product_price" id="product_price" class="form-control form-control-sm"  required placeholder="Actual Product price" autocomplete="off" readonly />
                                    </div>

                                    <div class="form-group col-md-3">									
                                        <label>Final Price&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                             data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                            </span></label>
                                        <input type="text" name="final_price" id="final_price" class="form-control form-control-sm" autocomplete="off" placeholder="Price Including Tax" required readonly>
                                    </div>
                                </div>											


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Purchase Price Information</h5>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Cost<span class="text-danger"></span></label>
                                        <input type="text" onchange="gettaxrate1()" name="p_priceperqty" id="p_priceperqty" class="form-control form-control-sm"  placeholder="Price Per Qty" autocomplete="off" />
                                    </div>

                                    <div class="form-group col-md-2">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Adjust Cost</label>
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


                                    <div class="form-group col-md-2">
                                        <label>UOM&nbsp;<i class="fa fa-question-circle-o bigf="The onts" aria-hidden="true" data-toggle="popover" 
                                            data-trigger="focus" data-placement="top" titleItem will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                            <span class="text-danger"></span></label>
                                        <select id="p_uom" onchange="gettaxrate1()" required class="form-control form-control-sm" name="p_uom">
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
                                        <input type="date" class="form-control form-control-sm"  name="p_pricedatefrom" value="<?php echo date("Y-m-d");?>">					  
                                    </div>
                                </div>											


                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <label for="inputState">Tax Method
                                        </label>
                                        <select id="p_taxmethod" onchange="gettaxrate1()" class="form-control form-control-sm" name="p_taxmethod">
                                            <option selected>Select Tax Method</option>
                                            <option value="1">Inclusive</option>
                                            <option value="0">Exclusive</option>
                                        </select>
                                    </div>



                                    <div class="form-group col-md-3">
                                        <label for="inputState">Tax Name</label>
                                        <select id="p_taxname" onchange="gettaxrate1()"  class="form-control form-control-sm" name="p_taxname">
                                            <option value="0" selected>Open Taxrate</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here

                                            $sql = mysqli_query($dbcon, "SELECT taxname,taxrate FROM taxmaster ");
                                            while ($row = $sql->fetch_assoc()){	
                                                $taxname=$row['taxname'];
                                                $taxrate=$row['taxrate'];
                                                echo '<option  value="'.$taxrate.'" >'.$taxname.'</option>';
                                            }
                                            ?>
                                        </select>	
                                    </div>							
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <!-- <i class="fa fa-rupee fonts" aria-hidden="true"></i> -->
                                        <label>Tax Rate %<span class="text-danger">*</span></label>
                                        <input type="text" name="p_disptaxrate" id="p_disptaxrate" class="form-control form-control-sm"   placeholder="Price Per Qty" autocomplete="off" readonly>
                                    </div>

                                    <div class="form-group col-md-3">									
                                        <label>Tax Amount&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                            data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                            </span></label>
                                        <input type="text" name="p_disptax" id="p_disptax" class="form-control form-control-sm" autocomplete="off" placeholder="Tax Amount"  readonly />
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Actual Product Price<span class="text-danger">*</span></label>
                                        <input type="text" name="p_product_price" id="p_product_price" class="form-control form-control-sm"   placeholder="Actual Product price" autocomplete="off" readonly />
                                    </div>

                                    <div class="form-group col-md-3">									
                                        <label>Final Price&nbsp;<span class="text-danger"><i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                                                             data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this uint(e.g.:Kgs,dozen,box"></i>
                                            </span></label>
                                        <input type="text" name="p_final_price" id="p_final_price" class="form-control form-control-sm" autocomplete="off" placeholder="Price Including Tax"  readonly>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Update Stock Information</h5>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-2">
                                        <label>Qty on Hand<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" name="stockinqty" placeholder="Current Stock in quantity" required autocomplete="off">
                                    </div>	

                                    <div class="form-group col-md-2">									
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


                                    <div class="form-group col-md-2">
                                        <label for="inputState">As of Date</label>									
                                        <input type="date" class="form-control form-control-sm"  name="stockasofdate" value="<?php echo date("Y-m-d");?>">		
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">									  
                                        <label>Low Stock Alert</label>
                                        <input type="text" class="form-control form-control-sm" name="lowstockalert" placeholder="eg., 5  or 10 "  required class="form-control" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-3">									
                                        <label>Adjust Low Stock Alert</label>
                                        <!--input type="text" id="adjstock" name="adjstock" class="form-control form-control-sm"   /-->
                                        <input type="number" step="any" onkeypress="update_math_valsAdjLowAlrt();"   onkeyup="update_math_valsAdjLowAlrt();" id="adjlowstockalert" name="adjlowstockalert" class="form-control form-control-sm"   />


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

                                </div>



                                <!--div class="form-row">
<div class="form-group col-md-6">
<label for="inputState">Handler</label>
<select id="taxrate" onchange="onusername(this)" class="form-control form-control-sm" name="handler">
<option selected>Select Username</option>
<?php 

$sql = mysqli_query($dbcon, "SELECT username FROM userprofile ORDER by id ASC");
while ($row = $sql->fetch_assoc()){	
    echo $username=$row['username'];
    echo '<option onchange="'.$row[''].'" value="'.$username.'" >'.$username.'</option>';
}
?>
</select>
</div>
</div-->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Prefered Supplier Name</label>
                                        <select id="compcode" onchange="onvendor(this);" class="form-control form-control-sm"  required name="vendor" autocomplete="off">
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
                                        <input type="text" class="form-control form-control-sm" name="handler" readonly class="form-control form-control-sm" value="<?php echo $rs['username']; ?>" required />

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
        function gettaxrate(){
            var taxrate = document.getElementById('taxname').value;
            var taxmethod = document.getElementById('taxmethod').value;
            var price   = document.getElementsByName('priceperqty')[0].value;
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

            $('#disptaxrate').val(taxrate);
            $('#disptax').val(percentagedval);

            $('#final_price').val(price);
            $('#product_price').val(product_price);

            //alert("Percentage="+percentagedval);
        }
        $('document').ready(function(){

        });
    </script>
    <script>
        function gettaxrate1(){
            var taxrate = document.getElementById('p_taxname').value;
            var taxmethod = document.getElementById('p_taxmethod').value;
            var price   = document.getElementsByName('p_priceperqty')[0].value;
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

            $('#p_disptaxrate').val(taxrate);
            $('#p_disptax').val(percentagedval);

            $('#p_final_price').val(price);
            $('#p_product_price').val(product_price);

            //alert("Percentage="+percentagedval);
        }
        $('document').ready(function(){

        });
    </script>



    <script>
        $('document').ready(function(){	
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
        });

    </script>			


    <?php include('footer.php');?>

