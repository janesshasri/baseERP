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
                <form action="#" id="purchaseitemform" enctype="multipart/form-data" method="post">

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
                        <h1 class="main-title float-left"><i class="fa fa-cart-plus bigfonts" aria-hidden="true"></i>Purchase Item Master</h1>
                        <ol class="breadcrumb float-right">
                            <li class="breadcrumb-item">Home</li>
                            <li class="breadcrumb-item active">Purchase Item Master</li>
                        </ol>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!-- end row -->


            <div class="row">					
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">					
                    <div class="card mb-3">
                           <div class="card-header">
                            <!--h3><i class="fa fa-check-square-o"></i>Create Company </h3-->
                            <!--h3 class="fa-hover col-md-12 col-sm-12">
                                 Purchase Item Master
                            </h3-->
                            </div>
                        
                     
                        
                        <div class="card-body">

                            <!--form autocomplete="off" action="#"-->
                            <form autocomplete="off" id="purchaseitemasterform">
                                
                                <div class="form-row">
                                    <div class="form-group col-md-6">

                                    <label for="">Select Entry Type</label>
                                    <select class="form-control form-control-sm select2" name="entrytype" id="entrytype"
                                    onchange="location.href='addPurchaseItemMaster.php?entrytype='+this.value">
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
                                            $sql=="";
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
                                                echo $orgid=$row['orgid'];
                                                echo $orgname=$row['orgname'];
                                                echo '<option data-orgname="'.$row['name'].'" value="'.$orgid.'" >'.$row['name'].' </option>';

                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- <div class="form-row" style="display:none">
                                <div class="form-group">
                                  <label for="">hiddenOrgname</label>
                                  <input type="text"
                                    class="form-control form-control-sm select2"
                                     name="hiddenOrgname" 
                                     id="hiddenOrgname" aria-describedby="helpId" placeholder="">
                                </div>
                                </div> -->

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label>Item Name<span class="text-danger">*</span></label>
                                        <input type="text"
                                          onkeypress="checkForItemName();" 
                                          onkeyup="checkForItemName();" 
                                         class="form-control form-control-sm" name="itemname" id="itemname"
                                          placeholder="Product Name" required class="form-control" autocomplete="off" />
                                          <small id="itemNameHelpText" style="display:none;" class="form-text text-danger">Item name already exists</small>
                                    </div>
                                </div>
                                

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Category</label>
                                            <select id="category" onchange="onvendor(this);" class="form-control form-control-sm select2" 
                                             required name="category" autocomplete="off">
                                            <option selected>Select Category</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                            $sql = mysqli_query($dbcon,"SELECT code,category FROM itemcategory
																			ORDER BY id ASC
																			");
                                            while ($row = $sql->fetch_assoc()){	
                                                echo $category_code=$row['code'];
                                                echo $category=$row['category'];
                                                echo '<option value="'.$category_code.'" >'.$category.'</option>';

                                            }
                                            ?>
                                        </select>
                                        <a href="#custom-modal" data-target="#customModal" data-toggle="modal"> 
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>Add New Category</a><br>
                                    </div>
                                </div>
                    

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="inputState">Prefered Supplier Name</label>
                                        <select id="vendor" onchange="onvendor(this);" class="form-control form-control-sm"  
                                        required name="vendor" autocomplete="off">
                                            <option selected>Open Vendors</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                            $sql = mysqli_query($dbcon,"SELECT vendorid,concat(title,' ',supname,'-',blocation) as vendorname FROM vendorprofile
																			ORDER BY id ASC
																			"); 
                                            while ($row = $sql->fetch_assoc()){	
                                                echo $vendorid=$row['vendorid'];
                                                echo $vendorname=$row['vendorname'];
                                                echo '<option value="'.$vendorid.'" >'.$vendorname.'</option>';

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
                                        <label>Price/Qty<span class="text-danger"></span></label>
                                        <input type="number"  step="any" value="0" onchange="gettaxrate()" name="priceperqty" id="priceperqty" class="form-control form-control-sm " placeholder="Price Per Qty"  autocomplete="off" />
                                    </div>

                                    <div class="form-group col-md-2" id="adjust_price" style="display:none">
                                            <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                            <label>Adjust Price</label>
                                            <input type="number" step="any" onkeypress="adjustprice('purchase');"  onkeyup="adjustprice('purchase');" id="purchase_adjpriceperqty" name="purchase_adjpriceperqty" class="form-control form-control-sm"   />
                                    </div>


                                    <div class="form-group col-md-3">
                                        <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                           data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                            <span class="text-danger"></span></label>
                                        <select id="uom" onchange="gettaxrate()"  class="form-control form-control-sm " name="uom">
                                            <option value="0" selected>Select UOM</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here

                                            $sql = mysqli_query($dbcon, "SELECT code,description FROM uom ");
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
                                        <select id="taxid" onchange="gettaxrate();" required class="form-control form-control-sm " name="taxid">
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
                                        <input type="text" name="hsncode" class="form-control form-control-sm"
                                        id="hsncode"  placeholder="Enter a valid HSN Code.."  >
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
                                        <input type="number" step="any" value="0" class="form-control form-control-sm" name="stockinqty" id="stockinqty" placeholder="Current Stock in quantity" required autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-3" id="adjust_stock" style="display:none">
                                        <i class="fa fa-rupee fonts" aria-hidden="true"></i>
                                        <label>Adjust Stock</label>
                                        <input type="number" step="any" onkeypress="adjustprice('stock');" value="0"  onkeyup="adjustprice('stock');" id="adjuststk" name="adjuststk" class="form-control form-control-sm"   />
                                    </div>

                                    
                                    <div class="form-group col-md-3">
                                        <label>UOM&nbsp;<i class="fa fa-question-circle-o bigfonts" aria-hidden="true" data-toggle="popover" 
                                                           data-trigger="focus" data-placement="top" title="The Item will be measured in terms of this UNIT(e.g.:Kgs,dozen,box"></i>
                                            <span class="text-danger">*</span></label>
                                        <select id="stockinuom" onchange="gettaxrate()" required class="form-control form-control-sm " name="stockinuom" id="stockinuom">
                                            <option value="0" selected>Select UOM</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here

                                            $sql = mysqli_query($dbcon, "SELECT code,description FROM uom");
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
                                    <div class="form-group col-md-3">									  
                                        <label>Low Stock Alert<span><i class="text-danger">&nbsp;in %</i></span></label>
                                        <input type="text" value="10" class="form-control form-control-sm" name="lowstockalert" id="lowstockalert" placeholder="eg., 5  or 10 "  required class="form-control" autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputState">As of Date</label>									
                                        <input type="date" class="form-control form-control-sm"  id="stockasofdate" name="stockasofdate" value="<?php echo date("Y-m-d");?>">		
                                    </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <h5>Scrap Information</h5>
                                    </div>
                                </div>
<!-- 
                                <div class="form-row">
                                    <div class="form-group col-md-3">									  
                                        <label>Scrap Qty <span><i class="text-danger"></i></span></label>
                                        <input type="text" id="scrapqty" class="form-control form-control-sm" name="scrapqty" placeholder="Scrap Qty"  required class="form-control" autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="inputState">UOM</label>									
                                        <select id="scrapinuom" required class="form-control form-control-sm " name="scrapinuom">
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
                                </div> -->


               
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
<button type="button" name="cancel" class="btn btn-secondary m-l-5" onclick="window.history.back();">Cancel
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
        var page_priceperqty = 0;
        var page_stockinqty = 0;

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
    
    </script>



    <script>

    function checkForItemName(itemnameEle){
         var itemname = $('#itemname').val();
         var orgid = $('#orgid').val();
         var entrytype = $('#entrytype').val();
         var cond = {itemname:itemname,orgid:orgid};

         var edit_data = Page.get_vals_by_condition("purchaseitemaster",cond);
         if(edit_data.itemname!=undefined){
            $('#itemNameHelpText').show();
         }else{
            $('#itemNameHelpText').hide();
         }
    }

    function adjustprice(type){

      if(type=="purchase"){
            $('#priceperqty').val(page_priceperqty);
            var adj = $('#purchase_adjpriceperqty').val();
            var pri = $('#priceperqty').val();
            var fin = +adj + +pri;
            $('#priceperqty').val(fin);
            gettaxrate();
        }else{
            $('#stockinqty').val(page_stockinqty);
            var adjstk = $('#adjuststk').val();
            var stk = $('#stockinqty').val();
            var fin = +adjstk + +stk;
            $('#stockinqty').val(fin);
        }
    }


    if(page_action=="edit"){
            var edit_data = Page.get_edit_vals(page_item_code,page_table,"itemcode");
            page_priceperqty = edit_data.priceperqty;
            page_stockinqty = edit_data.stockinqty;
            console.log(edit_data);
            set_form_data(edit_data);
            $('#adjust_price').show();
            $('#adjust_stock').show();
            $('#priceperqty').attr('readonly',true);
            $('#uom').attr('readonly',true);
            $('#stockinqty').attr('readonly',true);
        }
       
        function set_form_data(data){
                //// $('#po_owner').val(data.po_owner);
                $.each(data, function(index, value) {

                    if(index=="id"||index=="po_code"){

                    }else{
                      console.log($('#'+index).val(value));
                    }

                }); 
                gettaxrate();

        }


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



            
            $("form#purchaseitemasterform").submit(function(e){
            e.preventDefault();
            var $form = $("#purchaseitemasterform");
            var data = getFormData($form);

            function getFormData($form){
                var unindexed_array = $form.serializeArray();
                var indexed_array = {};

                $.map(unindexed_array, function(n, i){
                    if(n['name']=="id" || n['name']=="disptaxrate" || n['name']=="disptax" || n['name']=="purchase_adjpriceperqty" || n['name']=="adjuststk"){

                    }else{
                        indexed_array[n['name']] = n['value'];
                    }
                });

                return indexed_array;
            }

            var compcode = $('#orgid option:selected').attr('data-orgname');

            data.taxrate = data.disptaxrate;
            data.taxamount = data.disptax ;
            data.itemcost  = data.product_price;
            data.taxableprice = data.final_price;

            let dataObj = data;
            data = {};

            var adjuststk = $('#adjuststk').val();

            Object.keys(dataObj).map((k)=>{
                if(k!='disptaxrate' && k!='disptax' && k!='product_price' && k!='final_price' && k!='purchase_adjpriceperqty' &k!='adjuststk'){
                    console.log(k)
                   data[k] = dataObj[k];
                }
            })

            logObj = {
                entrytype:dataObj.entrytype,
                orgid:dataObj.orgid,
                itemname:dataObj.itemname,
                qtyonhand :dataObj.stockinqty-adjuststk,
                newqty : dataObj.stockinqty,
                qtyadjusted  : adjuststk,
                uom  :dataObj.stockinuom,
                adjustedon  :dataObj.stockasofdate,
                handler   :dataObj.handler,
                notes  :dataObj.notes,
            }


            $.ajax ({
                url: 'workers/setters/save_purchaseitem.php',
                type: 'post',
                data: {
                    array : JSON.stringify(data),
                    logarray : JSON.stringify(logObj),
                    itemcode:page_item_code,
                    action:page_action?page_action:"add",
                    table:"purchaseitemaster",
                    adjstk : adjuststk,
                    compcode: compcode
                    },
                dataType: 'json',
                success:function(response){
                    if(response.status){
                       location.href="listPurchaseItemMaster.php";
                    }
                },
                error: function(ts) { alert(ts.responseText) }



            });

        });


        });

    </script>			


    <?php include('footer.php');?>

