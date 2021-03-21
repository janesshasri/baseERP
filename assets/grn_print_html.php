<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here
if(isset($_POST['grn_id']))
{
    $grn_id = $_POST['grn_id'];

    $grn_val_arr1 = findbyand($dbcon,$grn_id,"grn_notes","grn_id");
    if($grn_val_arr1['values'][0]['grn_po_code']){
        $sql = "SELECT g.*,v.*,c.orgname as cname,c.address as caddress,c.city as ccity,c.state as cstate,c.country as ccountry,c.zip as czip,c.gstin as cgstin,p.* from grn_notes g,vendorprofile v , comprofile c ,purchaseorders p where g.grn_id ='$grn_id' and g.grn_po_vendor=v.vendorid and c.orgid=g.grn_comp_code and g.grn_po_code=p.po_code;";
    }else{
        $sql = "SELECT g.*,v.*,c.orgname as cname,c.address as caddress,c.city as ccity,c.state as cstate,c.country as ccountry,c.zip as czip,c.gstin as cgstin from grn_notes g,vendorprofile v , comprofile c where g.grn_id ='$grn_id' and g.grn_po_vendor=v.vendorid and c.orgid=g.grn_comp_code;";
    }

    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();
    $grn_po_items_arr = json_decode($row['grn_po_items'],false);
    //   $po_items_arr = json_decode($row['po_items'],false);     

    // $grn_po_items_arr = json_decode($row['grn_po_items'],false);
    // $po_items_arr = json_decode($row['po_items'],false);
}
function get_itemDetails($dbcon,$code){
    $sql = "SELECT * from purchaseitemaster where id='$code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();

    $ret = "[".$row['itemcode']."]  ".$row['itemname']."&nbsp;|&nbsp; HSN : ".$row['hsncode']."&nbsp;|&nbsp;";
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
    $list1 = array('', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine', 'ten', 'eleven',
                   'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'
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
    </head>
    <body>
        <h5>

        <div style="text-align:center">GOODS RECIEPT NOTE</div>
        </h5>

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Suppliers Name & Address</b><br/>

                        <?php echo $row['supname']; ?>,<br/>
                        <?php echo $row['address']; ?>,<br/>
                        <?php echo $row['city']; ?>,<?php echo $row['state']; ?>,<br/>
                        <?php echo $row['country']; ?>
                        <?php echo $row['city']; ?> - <?php echo $row['zip']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row['gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">GRN No#: <b> <?php echo $row['grn_id']; ?></b></td> 
                            </tr>     
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">Invoive No#:<b> <?php echo $row['grn_invoice_no']; ?></b></td> 
                            </tr> 
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                    Invoice Date. <b><?php echo $row['grn_invoice_date']; ?>
                                    </b></td> 
                            </tr>    
                            <tr>
                                <td style="padding:5px;">Payment Term: <b><?php echo $row['grn_po_payterm']>1?$row['grn_po_payterm']."days":$row['grn_po_payterm'].' day'; ?></b></td> 
                            </tr>    
                            <tr>
                                <td style="padding:5px;"><b>Due Date: </b><?php echo $row['grn_po_payterm']>1? Date('d/m/Y', strtotime("+".$row['grn_po_payterm']." days")) : date("d/m/Y")  ?></td> 
                            </tr> 
                        </table>

                    </td>
                </tr>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Billing & Delivery At:</b><br/>

                        <?php echo $row['cname']; ?>,<br/>
                        <?php echo $row['caddress']; ?>,<br/>
                        <?php echo $row['ccity']; ?>,<?php echo $row['cstate']; ?>,<br/>
                        <?php echo $row['ccountry']; ?>
                        <?php echo $row['ccity']; ?> - <?php echo $row['czip']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row['cgstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:10px;">
                        <?php
                        if($row['grn_po_code']){


                        ?>
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
                                <!--tr>
<td width="40%">
<b>Payment</b>
</td>
<td>
<b>: <?php echo $row['po_payterm'];?></b>
</td>
</tr-->
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
                                        <b>: <?php echo $row['grn_delivery_on'];?></b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                        }
                        ?>
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
                        ?>
                        <tr style="border-right:1px solid #000;border-left:1px solid #000;">
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $i+1;?>
                            </td>     
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo get_itemDetails($dbcon,$grn_po_items_arr[$i]->itemcode);?>
                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $grn_po_items_arr[$i]->rwqty." ".$grn_po_items_arr[$i]->uom ;?>

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
                                                Total
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
                                                Sub Total
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
                                                <?php echo nf($grn_po_items_arr[0]->poadjustmentval);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;padding:0px;">
                                                Grand Total
                                            </td>
                                            <?php
                                            $po_discount = $grn_po_items_arr[0]->podiscount==""?0:$grn_po_items_arr[0]->podiscount;

                                            $poadjustmentval = $grn_po_items_arr[0]->poadjustmentval==""?0:$grn_po_items_arr[0]->poadjustmentval;
                                            ?>

                                            <td style="text-align:center;padding:10px;"> 
                                                <?php echo nf((get_total($grn_po_items_arr)-$po_discount)+$poadjustmentval);?>
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
                            <td width="100%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                                <p><?php echo $row['grn_notes']; ?></p><br/>


                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="70%" style="padding:10px;">


                            </td> 
                            <td width="" style="padding:10px;">
                                <b>Authorised Signatory</b><br/>


                            </td>
                        </tr>
                    </tbody>
                </table>
            </tbody>
        </table>
