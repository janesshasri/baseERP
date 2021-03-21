<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_GET['po_code']))
{
    $po_code = $_GET['po_code'];

    $sql = "SELECT * from purchaseorders where po_code = '$po_code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();
    $po_comp_code = $row['po_comp_code'];
    $po_vendor = $row['po_vendor'];
    $po_items = $row['po_items'];
    $po_items_arr = json_decode($po_items);
    $sql1 = "SELECT * from comprofile where orgid ='$po_comp_code' limit 1 ";
    $result1 = mysqli_query($dbcon,$sql1);
    $row1 =$result1-> fetch_assoc();
    //print_r($row1);

    $sql2 = "SELECT * from vendorprofile where vendorid = '$po_vendor' limit 1";
    $result2 = mysqli_query($dbcon,$sql2);
    $row2 =$result2-> fetch_assoc();

    $sql3 = "SELECT * from compbank  where orgid ='$po_comp_code' limit 1";
    $result3 = mysqli_query($dbcon,$sql3);
    $row3 =$result3-> fetch_assoc();

}


function get_itemDetails($dbcon,$code){
    $sql = "SELECT * from purchaseitemaster where id='$code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();

    $ret = "[".$row['itemcode']."]  ".$row['itemname']." &nbsp;|&nbsp; HSN : ".$row['hsncode']."&nbsp;|&nbsp;";
    $ret.=  "GST@ ".($row['taxrate']/1)."%";
    return $ret;
}
function convertNumberToWord($num = false)
{
    $num = str_replace(array(',', ' '), '' , trim($num));
    if(! $num) {
        return false;
    }
    $num = (int) $num;
    $words = array();
    $list1 = array('', 'One', 'Two', 'Three', 'Four', 'Five', 'Six', 'Seven', 'Eight', 'Nine', 'Ten', 'Eleven',
                   'Twelve', 'Thirteen', 'Fourteen', 'Fifteen', 'Sixteen', 'Seventeen', 'Eighteen', 'Nineteen'
                  );
    $list2 = array('', 'ten', 'twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety', 'hundred');
    $list3 = array('', 'thousand', 'million', 'billion', 'trillion', 'quadrillion', 'quintillion', 'sextillion', 'septillion',
                   'octillion', 'nonillion', 'decillion', 'undecillion', 'duodecillion', 'tredecillion', 'quattuordecillion',
                   'quindecillion', 'sexdecillion', 'septendecillion', 'octodecillion', 'novemdecillion', 'vigintillion'
                  );
    $num_length = strlen($num);
    $levels = (int) (($num_length + 2) / 3);
    $max_length = $levels * 3;
    $num = substr('00' . $num, -$max_length);
    $num_levels = str_split($num, 3);
    for ($i = 0; $i < count($num_levels); $i++) {
        $levels--;
        $hundreds = (int) ($num_levels[$i] / 100);
        $hundreds = ($hundreds ? ' ' . $list1[$hundreds] . ' hundred' . ' ' : '');
        $tens = (int) ($num_levels[$i] % 100);
        $singles = '';
        if ( $tens < 20 ) {
            $tens = ($tens ? ' ' . $list1[$tens] . ' ' : '' );
        } else {
            $tens = (int)($tens / 10);
            $tens = ' ' . $list2[$tens] . ' ';
            $singles = (int) ($num_levels[$i] % 10);
            $singles = ' ' . $list1[$singles] . ' ';
        }
        $words[] = $hundreds . $tens . $singles . ( ( $levels && ( int ) ( $num_levels[$i] ) ) ? ' ' . $list3[$levels] . ' ' : '' );
    } //end for loop
    $commas = count($words);
    if ($commas > 1) {
        $commas = $commas - 1;
    }
    
    return implode(' ', $words);
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

<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body onload="printInit();">
             <img src="images/logo.png" width="200px" height="100px"/>
       <h5 > <div style="text-align:center">Dhiraj Agro Private Linited<br>
		(A Franchisee of Parle Agro Pvt Ltd)</div> </h5>
        <h3>
            <div style="text-align:center;">PURCHASE ORDER</div>
        </h3>

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Suppliers Name & Address</b><br/>

                        <?php echo $row2['supname']; ?>,<br/>
                        <?php echo $row2['address']; ?>,<br/>
                        <?php echo $row2['city']; ?>-<?php echo $row2['zip']; ?><br/>
                        <?php echo $row2['state']; ?>&nbsp;<?php echo $row2['country']; ?><br/>
                        <b>Mob#:</b>&nbsp;<?php echo $row2['mobile']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row2['gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">Purchase Order#:<b> <?php echo $row['po_code']; ?></b></td> 
                            </tr> 
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                    PO Date: <b><?php echo $row['po_date']; ?></b>
                                </td> 
                            </tr>    
                            <tr>
                                <td style="padding:5px;">
                                Payment Term: <b><?php echo $row['po_payterm_desc']; ?></b>
                                </td> 
                            </tr>  
                            <tr>
                                <td style="padding:5px;"></td> 
                            </tr>    
                        </table>

                    </td>
                </tr>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Billing & Delivery At:</b><br/>

                        <?php echo $row1['orgname']; ?>,<br/>
                        <?php echo $row['po_shipping_street']; ?>,<br/>
                        <?php echo $row['po_shipping_city']; ?>,<?php echo $row['po_shipping_state']; ?>,<br/>
                        <?php echo $row['po_shipping_country']; ?>
                        <?php echo $row['po_shipping_city']; ?> - <?php echo $row['po_shipping_zip']; ?><br/>
                        <b>Mob#:&nbsp;</b><?php echo $row['po_shipping_phone']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row['po_shipping_gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:10px;">
                        <table>
                            <tbody>
                                <tr>
                                    <td width="40%">
                                        <b>Transporter</b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['po_shippingvia'];?></b>
                                    </td>
                                </tr>

                                <tr>
                                    <td width="40%">
                                        <b>Delivery At </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['po_deliveryat'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Freight</b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['po_freight'];?></b>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="40%">
                                        <b>Delivery Date </b>
                                    </td>
                                    <td>
                                        <b>: <?php echo $row['po_deliverydate'];?></b>
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
                        for($i=0;$i<count($po_items_arr);$i++){
                        ?>
                        <tr style="border-right:1px solid #000;border-left:1px solid #000;">
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $i+1;?>
                            </td>     
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo get_itemDetails($dbcon,$po_items_arr[$i]->itemcode);?>
                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $po_items_arr[$i]->rwqty." ".$po_items_arr[$i]->uom ;?>

                            </td>    
                            <td style="padding:10px;padding-left:1%;border-right:1px solid #000;">
                                <?php echo nf($po_items_arr[$i]->rwprice);?>

                            </td>    
                            <td style="padding:10px;padding-left:3%;border-right:1px solid #000;">
                                <?php echo nf($po_items_arr[$i]->rwamt);?>

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
                                                <?php echo nf(get_total_notax($po_items_arr));?>
                                            </td>
                                        </tr>
                                     
                                                <?php echo get_taxtype($po_items_arr); ?>
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
                                <table style="display:none;">
                                    <tbody>
                                        <tr>
                                            <td width="40%">
                                                <b>BANK NAME :</b>
                                            </td>
                                            <td width="40%">
                                                <b><?php echo $row3['bankname'];?></b>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <b>A/C NO:</b> 
                                            </td>
                                            <td width="40%">
                                                <b><?php echo $row3['acctno'];?></b>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <b>A/C NAME  :</b>

                                            </td>
                                            <td width="40%">
                                                <b><?php echo $row3['acctname'];?></b>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <b>A/C TYPE :</b>
                                            </td>
                                            <td width="40%">
                                                <b><?php echo $row3['acctype'];?></b>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <b>BRANCH :</b>
                                            </td>
                                            <td width="40%">
                                                <b><?php echo $row3['branch'];?></b>
                                            </td>

                                        </tr>
                                        <tr>
                                            <td width="40%">
                                                <b>IFSC CODE :</b>
                                            </td>
                                            <td width="40%">
                                                <b><?php echo $row3['ifsc'];?></b>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>



                            </td>
                            <td style="border:1px solid #000;padding:0px;">
                                <table width="100%" style="padding:0px;" >
                                    <tbody>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:0px;">
                                                Sub Total
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf(get_total($po_items_arr));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Discount
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf($po_items_arr[0]->podiscount);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Adjustment
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf($po_items_arr[0]->poadjustmentval);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;padding:0px;">
                                                Grand Total
                                            </td>
                                            <?php
                                            $po_discount = $po_items_arr[0]->podiscount==""?0:$po_items_arr[0]->podiscount;

                                            $poadjustmentval = $po_items_arr[0]->poadjustmentval==""?0:$po_items_arr[0]->poadjustmentval;
                                            ?>
                                            <td style="text-align:center;padding:10px;"> 
                                                <?php echo nf((get_total($po_items_arr)-$po_discount)+($poadjustmentval));?>
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
                            <td width="100%" style="border:1px solid #000;padding:10px;">
                                <p><?php 
                                    $podiscount = $po_items_arr[0]->podiscount!=""?$po_items_arr[0]->podiscount:0;
                                    $poadjustmentval = $po_items_arr[0]->poadjustmentval!=""?$po_items_arr[0]->poadjustmentval:0;
                                    $grdttl = (get_total($po_items_arr)-$podiscount)+($poadjustmentval);
                                    $whole = floor($grdttl);      // 1
                                    $fraction = ($grdttl - $whole)*100; 
                                    $paise = convertNumberToWord(round($fraction));
                                    $hundreds = (string)convertNumberToWord($grdttl)." rupees ";
                                    echo "<b>PO Value in Words: </b> ( ";
                                    //echo $grdttl;
                                   // echo "(".convertNumberToWordsForIndia($grdttl).")";
                                   echo ucfirst(displaywords($grdttl)).")";

                                    //echo $fraction!=0?"and".$paise."paise":""; ?></p><br/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="100%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                                <p><?php echo $row['po_tc']; ?></p><br/>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="100%" style="border:1px solid #000;padding:10px;text-align:right;">
                            <b>For <?php echo $row1['orgname']; ?></b><br/>
                            <br/>
                            <br/>
                            <b>Authorized Signatory</b>
                            </td>
                        </tr>
                    </tbody>
                </table>
                
            </tbody>
        </table>

<script>

               function printInit(){
               window.print();
               window.onbeforeprint = beforePrint;
               window.onafterprint = afterPrint;

               }

                        
                   var beforePrint = function () {
                       // alert('start');
                    };

                    var afterPrint = function () {
                        window.history.back();
                    };
</script>