<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_POST['po_code']))
{
    $po_code = $_POST['po_code'];

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

    return "[".$row['itemcode']."]  ".$row['itemname']."<br/> HSN : ".$row['hsncode'];
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
function convertNumberToWordsForIndia($number){
    //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
    $words = array(
        '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
        '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
        '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
        '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
        '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
        '80' => 'eighty','90' => 'ninty');
    
    //First find the length of the number
    $number_length = strlen($number);
    //Initialize an empty array
    $number_array = array(0,0,0,0,0,0,0,0,0);
    $received_number_array = array();
    
    //Store all received numbers into an array
    for($i=0;$i<$number_length;$i++){
        $received_number_array[$i] = substr($number,$i,1);
    }
    //Populate the empty array with the numbers received - most critical operation
    for($i=9-$number_length,$j=0;$i<9;$i++,$j++){
        $number_array[$i] = $received_number_array[$j];
    }
    $number_to_words_string = "";
    //Finding out whether it is teen ? and then multiply by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
    for($i=0,$j=1;$i<9;$i++,$j++){
        //"01,23,45,6,78"
        //"00,10,06,7,42"
        //"00,01,90,0,00"
        if($i==0 || $i==2 || $i==4 || $i==7){
            if($number_array[$j]==0 || $number_array[$i] == "1"){
                $number_array[$j] = intval($number_array[$i])*10+$number_array[$j];
                $number_array[$i] = 0;
            }
            
        }
    }
    $value = "";
    for($i=0;$i<9;$i++){
        if($i==0 || $i==2 || $i==4 || $i==7){
            $value = $number_array[$i]*10;
        }
        else{
            $value = $number_array[$i];
        }
        if($value!=0)         {    $number_to_words_string.= $words["$value"]." "; }
        if($i==1 && $value!=0){    $number_to_words_string.= "Crores "; }
        if($i==3 && $value!=0){    $number_to_words_string.= "Lakhs ";    }
        if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
        if($i==6 && $value!=0){    $number_to_words_string.= "Hundred &amp; "; }
    }
    if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
    return ucfirst(strtolower($number_to_words_string)." only.");
}

function get_total($po_items_arr){
    $amt = 0;
    for($i=0;$i<count($po_items_arr);$i++){
        $amt = $amt + $po_items_arr[$i]->rwamt;
    }

    return $amt;
}

function get_grandtotal($po_items_arr){
    $grand_amt = 0;
    for($i=0;$i<count($po_items_arr);$i++){
        $amt = $po_items_arr[$i]->rwamt;
        $tax = gettaxamt_print($po_items_arr[$i]);
        $total = $amt+$tax;
        $grand_amt = $grand_amt +$total;
    }

    return $grand_amt;
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
           <img src="../upload/logo.jpg" width="100px"/> <div style="text-align:center">PURCHASE ORDER</div>
        </h5>

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Suppliers Name & Address</b><br/>

                        <?php echo $row2['supname']; ?>,<br/>
                        <?php echo $row2['address']; ?>,<br/>
                        <?php echo $row2['city']; ?>,<?php echo $row2['state']; ?>,<br/>
                        <?php echo $row2['country']; ?>
                        <?php echo $row2['city']; ?> - <?php echo $row2['zip']; ?><br/>
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
                                <td style="padding:5px;"><b>Payment Term: <?php echo $row['po_payterm']>1?$row['po_payterm']."days":$row['po_payterm']."day"; ?></b></td> 
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
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($po_items_arr[$i]->rwprice);?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
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
                                                <?php echo nf(get_total($po_items_arr));?>
                                            </td>
                                        </tr>
                                        <?php
                                        for($i=0;$i<count($po_items_arr);$i++){
                                        ?>
                                        <tr>
                                            <td width="60%" style="text-align:center;border:0px solid #000;padding:10px;">
                                                <?php echo get_taxtype($po_items_arr[$i]); ?>
                                            </td>
                                            <td style="text-align:center;padding:10px;">
                                                <?php echo get_taxvals($po_items_arr[$i]);
                                                 ?>

                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
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
                                                <?php echo nf(get_grandtotal($po_items_arr));?>
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
                                                <?php echo nf((get_grandtotal($po_items_arr)-$po_discount)+($poadjustmentval));?>
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
                                    $grdttl = (get_grandtotal($po_items_arr)-$podiscount)+($poadjustmentval);
                                    $whole = floor($grdttl);      // 1
                                    $fraction = ($grdttl - $whole)*100; 
                                    $paise = convertNumberToWord(round($fraction));
                                    $hundreds = (string)convertNumberToWord($grdttl)." rupees ";
                                    echo "PO Value in Words: ";
                                    //echo $grdttl;
                                    echo convertNumberToWordsForIndia($grdttl);
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
                            <td width="70%" style="padding:10px;">
                            </td> 
                            <td width="" style="padding:10px;">
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
