<?php
include("database/db_conection.php");//make connection here


/*$con = mysqli_connect("localhost","root","root","dhirajpro");
	// Check connection
	if(mysqli_connect_errno()){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}*/

if(isset($_POST['submit']))
{	$itemcode ="";
 $prefix = "DAPL00";
 //$postfix = "/";
 //$today = date("dmy");
 $itemname=$_POST['itemname'];//here getting result from the post array after submitting the form.
 $vendor=$_POST['vendor'];//same
 $description=$_POST['description'];//same
 $category=$_POST['category'];//same
 //$status 	=$_POST['status'];
 $priceperqty 		=$_POST['priceperqty'];
 $uom 		=$_POST['uom'];
 $taxmethod 		=$_POST['taxmethod'];
 $taxname	=$_POST['taxname'];
 $taxid	=$_POST['taxid'];
 $taxtype	=$_POST['taxtype'];

 $hsncode =$_POST['hsncode'];
 $pricedatefrom 	=$_POST['pricedatefrom'];
 $stockinqty 	=$_POST['stockinqty'];
 $stockinuom	=$_POST['stockinuom'];
 $lowstockalert	=$_POST['lowstockalert'];
 $stockasofdate =$_POST['stockasofdate'];
 //$qtyondemand=$_POST['qtyondemand'];
 //$usageunit =$_POST['usageunit'];
 $handler 	=$_POST['handler'];
 $notes = $_POST['notes'];
 $disptaxrate = $_POST['disptaxrate'];
 $disptax = $_POST['disptax'];
 $product_price = $_POST['product_price'];
 $final_price = $_POST['final_price'];




 $sql="SELECT MAX(id) as latest_id FROM purchaseitemaster ORDER BY id DESC";
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
 $sql = "INSERT into purchaseitemaster(`itemcode`,
										`itemname`,
										`vendor`,
										`description`,
										`category`,
										`priceperqty`,
										`uom`,
										`taxmethod`,
										`taxname`,
										`taxtype`,
										`taxid`,
										`taxrate`,
										`taxamount`,
										`itemcost`,
										`taxableprice`,
										`hsncode`,
										`pricedatefrom`,
										`stockinqty`,
										`stockinuom`,
										`lowstockalert`,
										`stockasofdate`,
										`handler`,
										`notes`)
								VALUES ('$itemcode',
								        '$itemname',
										'$vendor',
										'$description',
										'$category',
										'$priceperqty',
										'$uom',
										'$taxmethod',
										'$taxname',
										'$taxtype',
										'$taxid',
										'$disptaxrate',
										'$disptax',
										'$product_price', 
										'$final_price',
										'$hsncode',
										'$pricedatefrom',
										'$stockinqty',
										'$stockinuom',
										'$lowstockalert',
										'$stockasofdate',
						                '$handler',
										'$notes')";

 // Inserting Log details into purchaseitemlog
 $sql1= "INSERT into purchaseitemlog(`itemcode`,
										`itemname`,
										`category`,
										`oldpriceqty`,
										`olduom`,
										`oldstock`,
										`taxmethod`,
										`taxname`,
										`taxrate`,
										`taxamount`,
										`itemcost`,
										`taxableprice`,
										`hsncode`,
										`createdby`,
										`createdon`,
										`stockasofdate`,
										`notes`)
								VALUES ('$itemcode',
										'$itemname',
										'$category',
										'$priceperqty',
										'$uom',
										'$stockinqty',
										'$taxmethod',
										'$taxname',
										'$disptaxrate',
										'$disptax',
										'$product_price', 
										'$final_price',
										'$hsncode',
										'$handler',
										'$pricedatefrom',
										'$stockasofdate',
										'$notes')";

 //echo "$insert_purchaseItemMaster";	

 if(mysqli_query($dbcon,$sql)&& mysqli_query($dbcon,$sql1))
 {
     header("location:listPurchaseItemMaster.php");
 }   else {
     die('Error: ' . mysqli_error($dbcon));
     echo "<script>alert('User creation unsuccessful ')</script>";
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
                        <h1 class="main-title float-left">Purchase Item Master</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Purchase Item Master</li>
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
                                <i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i> Purchase Item Master
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
                                        <label>Description</label>
                                        <input type="text"  class="form-control form-control-sm" name="description" placeholder="add product description" />
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Prefered Supplier Name</label>
                                        <select id="compcode" onchange="onvendor(this);" class="form-control form-control-sm"  required name="vendor" autocomplete="off">
                                            <option selected>Open Vendors</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                            $sql = mysqli_query($dbcon,"SELECT vendorid,concat(title,' ',supname,'-',blocation) as vendorname FROM vendorprofile
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
                                        <h5>Purchase Price Information</h5>
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Price/Qty<span class="text-danger">*</span></label>
                                        <input type="text" onchange="gettaxrate()" name="priceperqty" id="priceperqty" class="form-control form-control-sm"  required placeholder="Price Per Qty" autocomplete="off" />
                                    </div>

                                    <div class="form-group col-md-3">
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
                                        <select id="taxmethod" onchange="gettaxrate();" class="form-control form-control-sm" name="taxmethod">
                                            <option selected>Select Tax Method</option>
                                            <option value="1">Inclusive</option>
                                            <option value="0">Exclusive</option>
                                        </select>
                                    </div>



                                    <div class="form-group col-md-3">
                                        <label for="inputState">Tax Name</label>
                                        <select id="taxid" onchange="gettaxrate();" required class="form-control form-control-sm" name="taxid">
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
                                        <label>HSN Code</label>
                                        <input type="text" name="hsncode" class="form-control form-control-sm"  placeholder="Enter a valid HSN Code.."  >
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
                                        <input type="text" class="form-control form-control-sm" name="stockinqty" placeholder="Current Stock in quantity" required autocomplete="off">
                                    </div>


                                    <div class="form-group col-md-3">
                                        <div class="invoice-title text-left mb-6">
                                            <label>Oty in UOM</label>
                                            <input type="text" class="form-control form-control-sm" name="stockinuom" placeholder="Unit of Measure, like boxes,kgs.." class="form-control" autocomplete="off">
                                        </div>
                                    </div>
                                </div>



                                <div class="form-row">
                                    <div class="form-group col-md-3">									  
                                        <label>Low Stock Alert</label>
                                        <input type="text" class="form-control form-control-sm" name="lowstockalert" placeholder="eg., 5  or 10 "  required class="form-control" autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputState">As of Date</label>									
                                        <input type="date" class="form-control form-control-sm"  name="stockasofdate" value="<?php echo date("Y-m-d");?>">		
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

