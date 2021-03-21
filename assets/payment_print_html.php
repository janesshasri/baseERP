<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_POST['payment_id']))
{
    $payment_id = $_POST['payment_id'];
}
$sql = "SELECT g.*,p.*,l.*,v.supname,v.address,v.city,v.state,v.country,v.zip,v.gstin,v.mobile,c.orgname,c.image FROM grn_notes g,purchaseorders p,vendorprofile v,comprofile c,payments l
			WHERE l.payment_id='$payment_id' and l.payment_invoice_no=g.grn_invoice_no
			ORDER BY p.id DESC";
$result = mysqli_query($dbcon,$sql);
$row =$result-> fetch_assoc();
$grn_po_items_arr = json_decode($row['grn_po_items'],false);
$po_items_arr = json_decode($row['po_items'],false);

function get_itemDetails($dbcon,$code){
    $sql = "SELECT * from purchaseitemaster where id='$code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();

    $ret = "[".$row['itemcode']."]  ".$row['itemname']."&nbsp;|&nbsp; HSN:".$row['hsncode']."&nbsp;|&nbsp;";
    $ret.=  "GST@ ".($row['taxrate']/1)."%";
    return $ret;
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
        
        <h5 > <div style="text-align:center">DHIRAJ AGRO PRIVATE LIMITED <br>
		(A Franchisee of Parle Agro Pvt Ltd)</div> </h5>
        <h3><div style="text-align:center">VENDOR PAYMENTS VOUCHER</div></h3> 
       

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Suppliers Name & Address</b><br/>

                        <?php echo $row['supname']; ?>,<br/>
                        <?php echo $row['address']; ?>,<br/>
                        <?php echo $row['city']; ?><br/>
                       <?php echo $row['city']; ?> - <?php echo $row['zip']; ?><br/>
                        <?php echo $row['state']; ?>&nbsp;<?php echo $row['country']; ?><br/>
                        <b>Mob#:</b>&nbsp;<?php echo $row['mobile']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row['gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;"><b>Payment#&nbsp;</b><?php echo $payment_id; ?></td> 
                            </tr> 
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                    <b>Payment Dt.&nbsp;</b><?php echo $row['payment_date']; ?>
                                </td> 
                            </tr>    
                            <tr>
                            <td style="padding:5px;"><b>Payment Term: </b><?php echo $row['po_payterm']>1?$row['po_payterm'].' Day(s)':"Advance"; ?></td> 
                            </tr>    
                            <tr>
                                <td style="padding:5px;"><b>Due Date: </b><?php echo $row['po_payterm']>1? Date('d/m/Y', strtotime("+".$row['po_payterm']." days")) : date("d/m/Y")  ?></td> 
                            </tr>   
                        </table>

                    </td>
                </tr>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Billing & Delivery At:</b><br/>

                        <?php echo $row['orgname']; ?>,<br/>
                        <?php echo $row['po_shipping_street']; ?>,<br/>
                        <?php echo $row['po_shipping_city']; ?>,<?php echo $row['po_shipping_state']; ?>,<br/>
                        <?php echo $row['po_shipping_country']; ?>
                        <?php echo $row['po_shipping_city']; ?> - <?php echo $row['po_shipping_zip']; ?><br/>
                        <b>Mob#</b> - <?php echo $row['po_shipping_phone']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row['po_shipping_gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:10px;">
                        <table style="">
                            <tbody>
                                <tr>
                                    <td width="40%">
                                        <b>Invoice No</b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['payment_invoice_no'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Payment Date</b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['payment_date'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Payment Mode </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['payment_mode'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Reference No </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['payment_ref_no'];?></b>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td width="40%">
                                        <b>Payment Bank </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['payment_bank'];?></b>
                                    </td>
                                </tr>
                                
                                <tr>
                                    <td width="40%">
                                        <b>Payment Made </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['payment_amount'];?></b>
                                    </td>
                                </tr>
                                
                                
                                
                            </tbody>
                        </table>
                    </td>
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
                        for($i=0;$i<count($grn_po_items_arr);$i++){
                           // var_dump($i);
                        ?>
                        <tr style="border-right:1px solid #000;border-left:1px solid #000;">
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $i+1;?>
                            </td>     
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo get_itemDetails($dbcon,$grn_po_items_arr[$i]->itemcode);?>
                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $grn_po_items_arr[$i]->rwqty." ".!empty($po_items_arr[$i])?$po_items_arr[$i]->uom :"";?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($grn_po_items_arr[$i]->rwprice);?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($grn_po_items_arr[$i]->rwamt);?>

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
                                                <b>Sub Total</b>
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf(get_total_notax($grn_po_items_arr));?>
                                            </td>
                                        </tr>
                                        <?php echo get_taxtype($grn_po_items_arr); ?>

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
                                               <b>Total</b>  
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf(get_total($grn_po_items_arr));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Discount
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf($grn_po_items_arr[0]->podiscount);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Adjustment
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php 
                                                //   print_r($po_items_arr);
                                                echo nf($grn_po_items_arr[0]->poadjustmentval);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:0px;">
                                                Grand Total
                                            </td>
                                            <?php
                                            $po_discount = $grn_po_items_arr[0]->podiscount==""?0:$grn_po_items_arr[0]->podiscount;

                                            $poadjustmentval = $grn_po_items_arr[0]->poadjustmentval==""?0:$grn_po_items_arr[0]->poadjustmentval;
                                            ?>

                                            <td style="text-align:center;border-bottom:1px solid #000;padding:10px;"> 
                                                <?php echo nf((get_total($grn_po_items_arr)-$po_discount)+$poadjustmentval);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;padding:10px;">
                                               <b>Balance Due</b> 
                                            </td>
                                            <td style="text-align:center;padding:10px;"> 
                                                <?php echo nf($row['grn_balance']);?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
                <!--table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td  style="padding:10px;">
                                <?php echo $row['payment_notes'];?><br>
                            </td>

                        </tr>
                    </tbody>
                </table-->

                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="70%" style="padding:10px;">
                            </td> 
                        
                            <td width="" style="padding:10px;">
                                <b>For Dhiraj Agro Pvt. Ltd <!-- <?php echo $row['orgname']; ?>--></b><br/><br/><br/><br>
                                <b>&nbsp;&nbsp;Authorized Signatory</b>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </tbody>
        </table>
    </body></html>