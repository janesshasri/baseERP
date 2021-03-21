<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_POST['stk_mov_id']))
{
    $stk_mov_id = $_POST['stk_mov_id'];
}
$sql = "SELECT s.*,w.warehousename,c.category  FROM stock_movement s, warehouse w,itemcategory c where s.stk_mov_location = w.location_id and s.stk_mov_category = c.code
			ORDER BY s.id DESC";
$result = mysqli_query($dbcon,$sql);
$row =$result-> fetch_assoc();
$stk_mov_items_arr = json_decode($row['stk_mov_items'],false);
//$po_items_arr = json_decode($row['po_items'],false);

function get_itemDetails($dbcon,$code){
    $sql = "SELECT * from purchaseitemaster where id='$code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();

    return "[".$row['itemcode']."]  ".$row['itemname']."&nbsp;|&nbsp; HSN : ".$row['hsncode'];
}

function get_totalval($items_arr){
    $amt = 0;
    for($i=0;$i<count($items_arr);$i++){
        $amt = $amt + ($items_arr[$i]->rwqty*$items_arr[$i]->rwprice);
    }

    return $amt;
}

?> 

<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <style type="text/css">
            .p_table{
                border:1px soid #000;
            }
        </style>
    </head>
    <body>
        <h5>
            <div style="text-align:center">STOCK TRANSFER</div>
        </h5>

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Stock Transfer Detais</b><br/>

                        <?php echo $row['stk_mov_type']; ?>,<br/>
                        <?php echo $row['warehousename']."(".$row['stk_mov_location'].")"; ?><br/>
                        <?php echo $row['stk_mov_req_date']; ?><br/>
                        <?php echo "Total Stock Value".$row['stk_value']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">Document Ref No. <?php echo $row['stk_mov_docref']; ?></td> 
                            </tr> 
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                    Category  <?php echo $row['category']; ?>
                                </td> 
                            </tr>    

                        </table>

                    </td>
                </tr>
                <tr>


                </tr>
                <table width="100%" style="">
                    <thead style="border:1px solid #000;text-align:center;">
                        <th style=" width:10%;padding:10px;border:1px solid #000;">Item No.</th>
                        <th style="width:50%;padding:10px;border:1px solid #000;">Item Details</th>
                        <th style="width:15%;padding:10px;border:1px solid #000;">Qty - Uom</th>
                        <th style="width:10%;padding:10px;border:1px solid #000;">Rate</th>
                        <th style="width:15%;padding:10px;border:1px solid #000;">Amount</th>
                    </thead>
                    <tbody>
                        <?php
                        for($i=0;$i<count($stk_mov_items_arr);$i++){
                        ?>
                        <tr style="border-right:1px solid #000;border-left:1px solid #000;">
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $i+1;?>
                            </td>     
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo get_itemDetails($dbcon,$stk_mov_items_arr[$i]->itemcode);?>
                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $stk_mov_items_arr[$i]->rwqty." ".$stk_mov_items_arr[$i]->uom ;?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($stk_mov_items_arr[$i]->rwprice);?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($stk_mov_items_arr[$i]->rwqty*$stk_mov_items_arr[$i]->rwprice);?>

                            </td>
                        </tr>
                        <?php
                        }
                        ?>

                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;">
                    <tbody>
                        <tr>
                            <td width="60%" style="border:1px solid #000;padding:10px;">

                            </td>
                            <td style="border:1px solid #000;width:60%;">
                                <table width="100%" >
                                    <tbody>
                                        <tr>
                                            <td width="61%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Total
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf(get_total_notax($stk_mov_items_arr));?>
                                            </td>
                                        </tr>
                                        <?php echo get_taxtype($stk_mov_items_arr); ?>

                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="60%" style="border:1px solid #000;padding:10px;">

                            </td>
                            <td style="border:1px solid #000;padding:0px;">
                                <table width="100%" style="padding:0px;" >
                                    <tbody>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:0px;">
                                                Sub Total
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf(get_total($stk_mov_items_arr));?>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:0px;">
                                                Grand Total
                                            </td>

                                            <td style="text-align:center;border-bottom:1px solid #000;padding:10px;"> 
                                                <?php echo nf(get_total($stk_mov_items_arr)); ?>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>

                        </tr>
                    </tbody>
                </table>

                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="70%" style="padding:10px;">


                            </td> 
                            <td width="" style="padding:10px;"><br/><br/><br/>
                                 Authorized Signatory
                            </td>
                        </tr>
                    </tbody>
                </table>
            </tbody>
        </table>
    </body></html>