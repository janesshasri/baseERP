<?php 
include('header.php');
?>
<?php

$entryType = "";
if(isset($_GET['entrytype'])){$entryType = $_GET['entrytype'];}

$orgidUrl = "";
if(isset($_GET['orgid'])){ $orgidUrl = $_GET['orgid']; } 

?>
<div class="content-page">

    <!-- Start content -->
    <div class="content">

        <div class="container-fluid">


            <div class="row">
                <div class="col-xl-12">
                    <div class="breadcrumb-holder">
                        <h1 class="main-title float-left">Production Form</h1>
                        <ol class="breadcrumb float-right">
                            <li><a  href="index.php"><li class="breadcrumb-item">Home</a></li>
                            <li class="breadcrumb-item active">Production Form</li>
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
                                </i>&nbsp;Production<span class="text-muted"></span></div></h5>

                            <div class="text-muted font-light">Production Form</div>

                        </div>

                        <div class="card-body">

                            <form id="add_prod_form" autocomplete="off" action="#">

                                <div class="form-row">
                                    <div class="invoice-title text-left mb-6">
                                        <h4 class="col-md-12 text-muted">Production Form &nbsp;</h4>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Handler</label>
                                        <input type="text" class="form-control form-control-sm"  
                                        id="prod_handler" name="prod_handler" readonly 
                                        class="form-control form-control-sm" 
                                        value="<?php echo $session_user; ?>" required />

                                    </div>
                                </div>

                                <div class="form-row">
                                        <div class="form-group col-md-8">

                                        <label for="">Select Entry Type </label>
                                        <select  name="entrytype"  readonly
                                         id="entrytype"
                                        
                                         <?php if(isset($_GET['action']))
                                         { 
                                            echo  $_GET['action']==="edit" ? 'readonly class="form-control form-control-sm" ' : 'class="form-control form-control-sm select2 ';
                                         }else{
                                             echo ' class="form-control form-control-sm select2 "  ';
                                         }
                                        ?>  
                                        <?php echo $orgidUrl!=='' ? ' data-orgid="'.$orgidUrl.'"' :  '' ?>
                                                >
<!--                                                <option value="">Select Type</option>-->
                                                <option value="self" <?php if($entryType!="" && $entryType=="self"){ echo "selected"; } ?> >Self</option>
<!--                                                <option value="outsourced" <?php if($entryType!="" && $entryType=="outsourced"){ echo "selected"; } ?> >Outsourced</option>-->
                                                
                                        </select>
                                        </div>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-8">
                                        <label for="inputState">Company Name<i class="text-danger">*</i></label>
                                        <select readonly data-entry="<?php echo $entryType;?>"
                                        <?php if(isset($_GET['action']))
                                         {
                                            echo  $_GET['action']=="edit" ? 'readonly class="form-control form-control-sm" ' : 'class="form-control form-control-sm select2';
                                         }else{
                                             echo ' class="form-control form-control-sm select2"  ';
                                         }
                                        ?>  
                                        id="prod_company" name="prod_company"
                                        class="form-control form-control-sm"  
                                        required autocomplete="off">
<!--                                              <option selected>--Select Company--</option>-->
                                            <?php
                                           if($entryType!=""){
                                            $sql = $entryType=="outsourced" ? mysqli_query($dbcon,"SELECT custid as orgid,custname as orgname FROM customerprofile where custype='Partner'") : mysqli_query($dbcon,"SELECT * FROM comprofile");
                                            while ($row = $sql->fetch_assoc()){	
                                                $orgid=$row['orgid'];
                                                $orgname=$row['orgname'];
                                                if($orgidUrl!='' && $orgidUrl==$orgid){
													echo '<option selected data-orgname="'.$orgname.'" value="'.$orgid.'" >'.$orgname.' </option>';
												}else{
													echo '<option data-orgname="'.$orgname.'" value="'.$orgid.'" >'.$orgname.' </option>';
												}
                                            }
                                        }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="inputState">Production Item Name<span class="text-danger">*</span></label>
                                        <select id="prod_item" onchange="post_rawItems(this.value);setUom('salesitemaster2',this)" 
                                        <?php if(isset($_GET['action']))
                                         {
                                            echo  $_GET['action']=="edit" ? 'readonly class="form-control form-control-sm" ' : 'class="form-control form-control-sm select2';
                                         }else{
                                             echo ' class="form-control form-control-sm select2"  ';
                                         }
                                        ?>  
                                        class="form-control form-control-sm select2" name="prod_item">
                                            <option selected value="">--Select item--</option>
                                            <?php 
                                            include("database/db_conection.php");//make connection here
                                              $sql = "SELECT itemcode,concat(itemcode,'-',itemname) as itemname FROM salesitemaster2 s where s.orgid='".$orgidUrl."' AND (SELECT COUNT(*) FROM rawitemaster where proditemcode=s.itemcode )>0 ";
                                            
                                             $exe = mysqli_query($dbcon,$sql);
                                            while ($row = $exe->fetch_assoc()){	
                                                echo $itemcode=$row['itemcode'];
                                                echo $itemname=$row['itemname'];
                                                echo '<option value="'.$itemcode.'" >'.$itemname.' </option>';
                                            }
                                             
                                            ?>
                                        </select>
                                    
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label for="inputState">Qty</label>
                                        <input type="text" placeholder="Qty"
                                        <?php if(isset($_GET['action']))
                                         {
                                           echo  $_GET['action']=="edit" ? "readonly" : "";
                                         }
                                        ?>  
                                        name="prod_qty" id="prod_qty" 
                                        onkeyup="updateRawMaterialsQty(this.value)" onkeypress="updateRawMaterialsQty(this.value)"
                                        class="form-control form-control-sm"> 
                                    </div>
                                    <div class="form-group col-md-2">
                                    <label>Unit</label>
                                    <select id="prod_uom"  
                                    <?php if(isset($_GET['action']))
                                         {
                                            echo  $_GET['action']=="edit" ? 'readonly class="form-control form-control-sm" ' : 'class="form-control form-control-sm select2';
                                         }else{
                                             echo ' class="form-control form-control-sm"  ';
                                         }
                                    ?>  
                                     name="prod_uom">
                                            <option value="">Open Unit</option>
                                            <?php 
                                            $sql = mysqli_query($dbcon, "SELECT * FROM uom");
                                            while ($row = $sql->fetch_assoc()){	

                                                echo '<option  value="'.$row['code'].'">'.$row['description'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                        

                                <div class="form-row">                                
                                    <div class="form-group col-md-4">									
                                        <label>Production Date<span class="text-danger">*</span></label>
                                        <input type="prod_date" class="form-control form-control-sm" value="<?php echo date("Y-m-d");?>" id="prod_date" name="prod_date" required autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-4">									
                                        <label for="inputState">Status<span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm select2" required name="prod_status"  id="prod_status">
                                            <option value="Created">Created</option>
                                            <option value="Approved">Approved</option>
                                            <option value="Completed">Completed</option>
                                        </select>	
                                    </div>
                                </div>					


                                <div class="form-row">	
                                    <div class="form-group col-md-8" id="show_errors" style="display:none;">

                                    </div>
                                </div>

                                <table  class="table table-hover small-text" id="tb">
                                    <tr class="tr-header">
                                        <th width="40%">Item Details</th>
                                        <th width="20%">Qty</th>
                                        <th width="30%">Unit</th>
                                        <th width="10%"><a href="javascript:void(0);" style="font-size:18px;" id="addMore" title="Add More Person">
                                        <span class="fa fa-plus-circle"></span></a></th>

                                    </tr>
                                    <tr>
                                        <td>
                                            <select readonly name="itemcode" class="form-control form-control-sm  itemcode" 
                                             id="item_select">
                                                <option value="" name="itemcode" selected>Item Code</option>
                                                <?php $qr  = "select * from purchaseitemaster;";
                                                $exc = mysqli_query($dbcon,$qr)or die();
                                                while($r = mysqli_fetch_array($exc)){ ?>
                                                <option value="<?php echo $r['itemcode']; ?>"><?php echo "[".$r['itemcode']."] ".$r['itemname']; ?></option>
                                                <?php
                                                                                    }
                                                ?>
                                            </select>
                                        </td>


                                    <td>
                                    <input
                                    <?php
                                          if(isset($_GET['action']))
                                            {
                                               echo  $_GET['action']=="edit" ? "" : "readonly";
                                            }else{
                                                echo "readonly";
                                            }
                                    ?>
                                     id="qty" type="text" name="qty" 
                                     placeholder="Qty" data-id="" class="form-control form-control-sm qty" />
                                     </td>                                        
                                    <td>
                                    <select readonly class="form-control form-control-sm amount" id="uom"  
                                     name="uom" style="line-height:1.5;">
                                            <option value="" selected>Open Unit</option>
                                            <?php 
                                            $sql = mysqli_query($dbcon, "SELECT * FROM uom ");
                                            while ($row = $sql->fetch_assoc()){	

                                                echo '<option  value="'.$row['code'].'">'.$row['description'].'</option>';
                                            }
                                            ?>
                                        </select>
                                    </td>

                                    <td><a href='javascript:void(0);'  class='remove'><span class='fa fa-trash'></span><b></b></a></td>
                                    </tr>
                                </table>
                                <!---subtotal , dicount , tax etc-->
                                <hr>
  

                                <br>

                                <div class="form-row col-md-12">

                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-8">
                                            <textarea rows="2" class="form-control form-control-sm" name="prod_notes"  id="prod_notes" required 
                                            placeholder="add a Production note"></textarea>
                                        </div>
                                    </div>




                                    <div class="form-row">
                                        <div class="form-group text-right m-b-0">
                                            &nbsp;&nbsp;&nbsp;&nbsp; <button class="btn btn-primary" type="submit" >
                                            Submit
                                            </button>
                                            <button type="reset" name="cancel" onclick="location.href='listProductions.php'" class="btn btn-secondary m-l-5">
                                                Cancel
                                            </button>
                                        </div>
                                    </div>


                                </div>

                            </form>
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

    <script>
    var page_action = "<?php if(isset($_GET['action'])){ echo $_GET['action']; } ?>";
    var page_table = "<?php if(isset($_GET['type'])){ echo $_GET['type']; } ?>";
    var page_pro_code = "<?php if(isset($_GET['prod_code'])){ echo $_GET['prod_code']; } ?>";


    function redirectTo(select){
            var entryType = "";
            var redirectOrgid = "";

            if(select=="entrytype"){
                 entryType = $('#'+select).val();
                 redirectOrgid = $('#'+select).attr('data-orgid');

            }else{
                 entryType = $('#'+select).attr('data-entry');
                 redirectOrgid = $('#'+select).val();
            }
            if(page_action!==""){
                location.href="addProduction.php?pro_code="+page_pro_code+"&action="+page_action+"&type="+page_table+"&entrytype="+entryType+"&orgid="+redirectOrgid;
            }else{
                location.href="addProduction.php?entrytype="+entryType+"&orgid="+redirectOrgid;
            }
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
            rowitem.update_math_vals('po');
        } else {
            alert("Sorry!! Can't remove first row!");
        }
    });

    function updateRawMaterialsQty(entered_prod_qty){
            let qty = +entered_prod_qty;
            let prod_item = $('#prod_item').val();
            post_rawItems(prod_item,qty);
    }

    function post_rawItems(productId, qty=1){
        console.log(productId);
        if(productId!=""){
        var prod_company = $('#prod_company').val();
        var entrytype = $('#entrytype').val();
        if(prod_company!==''){
            var cond={proditemcode:productId,orgid:prod_company}; 
            console.log(Page);
            var rawItemList = Page.get_vals_by_condition("rawitemaster",cond);
        }

        $("#tb").find("tr:gt(1)").remove();

        let rawItems = JSON.parse(rawItemList.raw_items).map((item)=>{
             let itemEle = item;
             itemEle.qty = (+item.qty * qty).toString();
             return itemEle;
        })
                
        set_math_vals(rawItems);

        }else{
            $("#tb").find("tr:gt(1)").remove();
        }
    }

    
    function setUom(table,ele){
            var itemCode = $(ele).val();
            if(itemCode!=""){
           var itemData = Page.get_edit_vals(itemCode,table,"itemcode");
           $('#prod_uom').val(itemData.sales_uom);

            }
    }

    if(page_action=="edit"){
            var edit_data = Page.get_edit_vals(page_pro_code,page_table,"prod_code");
            edit_data.prod_company = edit_data.orgid;
            set_form_data(edit_data);
            $("#cancel-form").click(function(){
                if(page_action=="edit"){
                  location.href="listProductions.php";
                }
            });
        }

        function set_form_data(data){

            $.each(data, function(index, value) {

                if(index=="id"||index=="prod_code"){
                }else if(index=="prod_raw_items"){
                    set_math_vals(JSON.parse(value));
                }else{
                    $('#'+index).val(value);
                }
            }); 
        }

        function set_math_vals(po_items_json){
            var itemrowCount = po_items_json.length;
            var rowCount = $('#tb tr').length;
            var totalamt = 0;
                for(r=0;r<itemrowCount;r++){
                    if(r<itemrowCount-1){
                var dataRow = $("#tb tr:eq(1)").clone(true).appendTo("#tb");
                    }
                    $('#tb tr').eq(r+1).find('#item_select').val(po_items_json[r].item);
                    $('#tb tr').eq(r+1).find('#qty').val(po_items_json[r].qty);
                    $('#tb tr').eq(r+1).find('#uom').val(po_items_json[r].uom);

                }
        }

        $("form#add_prod_form").submit(function(e){
        e.preventDefault();


        var rowCount = $('#tb tr').length;
        var pro_raw_items = [];

        for(i=1;i<rowCount;i++){ 
            var item_select = $('#tb tr').eq(i).find('#item_select').val();
            var uom = $('#tb tr').eq(i).find('#uom').val();
            var qty = $('#tb tr').eq(i).find('#qty').val();

            pro_rawitem_ele = {
                item:item_select,
                uom:uom,
                qty:qty
            }; 

            pro_raw_items.push(pro_rawitem_ele);
        }

        var $form = $("#add_prod_form");
        var data = getFormData($form);

        function getFormData($form){
            var unindexed_array = $form.serializeArray();
            var indexed_array = {};

            $.map(unindexed_array, function(n, i){
                if(n['name']=="itemcode"||n['name']=="qty"||n['name']=="uom"){

                }else{
                    indexed_array[n['name']] = n['value'];
                }
            }); 

            return indexed_array;
        }

        data.prod_raw_items = JSON.stringify(pro_raw_items);
        data.prod_created_date = moment().format("YYYY-MM-DD");

        var compname = $('#prod_company option:selected').attr('data-orgname');
        var prod_orgid = $('#prod_company').val();

        data.entrytype = $('#entrytype').val();
        data.orgid = prod_orgid;

        $.ajax ({
            url: 'workers/setters/save_production.php',
            type: 'post',
            data: {array : JSON.stringify(data),
            pro_code:page_pro_code,
            pro_status:data.prod_status,
            compname:compname,
            prod_orgid:prod_orgid,
            action:page_action?page_action:"add",table:"productionlist"},
            dataType: 'json',
            success:function(response){
                if(response.status){
                    if(data.prod_status=="Completed"){
                        window.location.href = 'assets/production_print_html.php?prod_code='+response.code;
                    }else{
                        window.location.href = 'listProductions.php';
                    }
                }
            }


        });

        });

</script>

    <?php include('footer.php');?>
