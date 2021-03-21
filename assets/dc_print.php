<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_POST['inv_code']))
{
    $inv_code = $_POST['inv_code'];

    $sql = "SELECT * from invoices where inv_code = '$inv_code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();
    $inv_comp_code = $row['inv_comp_code'];
    $inv_customer = $row['inv_customer'];
    $inv_items = $row['inv_items'];
    $inv_items_arr = json_decode($inv_items);
    $sql1 = "SELECT * from comprofile where orgid='$inv_comp_code' limit 1 ";
    $result1 = mysqli_query($dbcon,$sql1);
    $row1 =$result1-> fetch_assoc();
    //print_r($row1);

    $sql2 = "SELECT * from customerprofile where custid = '$inv_customer' limit 1";
    $result2 = mysqli_query($dbcon,$sql2);
    $row2 =$result2-> fetch_assoc();

    $sql3 = "SELECT * from compbank  where orgid ='$inv_comp_code' limit 1";
    $result3 = mysqli_query($dbcon,$sql3);
    $row3 =$result3-> fetch_assoc();

}
function get_itemDetails($dbcon,$code){
    $sql = "SELECT * from salesitemaster2 where id='$code' ";
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
        <h5 >

            <div style="text-align:center">DELIVERY CHALLAN</div>
        </h5>

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Customer Name & Address</b><br/>

                        <?php echo $row2['custname']; ?>,<br/>
                        <?php echo $row2['address']; ?>,<br/>
                        <?php echo $row2['city']; ?>,<?php echo $row2['state']; ?>,<br/>
                        <?php echo $row2['country']; ?>
                        <?php echo $row2['city']; ?> - <?php echo $row2['zip']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row2['gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">Invoice No#:<b> <?php echo $row['inv_code']; ?></b></td> 
                            </tr> 
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                    Invoice Date: <b><?php echo $row['inv_date']; ?></b>
                                </td> 
                            </tr>    
   
                        </table>

                    </td>
                </tr>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Company Name & Address</b><br/>

                        <?php echo $row1['orgname']; ?>,<br/>
                        <?php echo $row1['address']; ?>,<br/>
                        <?php echo $row1['city']; ?>,<?php echo $row1['state']; ?>,<br/>
                        <?php echo $row1['country']; ?>
                        <?php echo $row1['city']; ?> - <?php echo $row1['zip']; ?><br/>
                        <b>GSTIN</b> - <?php echo $row1['gstin']; ?>
                    </td>
                    <td style="border:1px solid #000;padding:10px;">
                        <table>
                            <tbody>
         
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
                        for($i=0;$i<count($inv_items_arr);$i++){
                        ?>
                        <tr style="border-right:1px solid #000;border-left:1px solid #000;">
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $i+1;?>
                            </td>     
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo get_itemDetails($dbcon,$inv_items_arr[$i]->itemcode);?>
                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo $inv_items_arr[$i]->rwqty." ".$inv_items_arr[$i]->uom ;?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($inv_items_arr[$i]->rwprice);?>

                            </td>    
                            <td style="padding:10px;padding-left:5%;border-right:1px solid #000;">
                                <?php echo nf($inv_items_arr[$i]->rwamt);?>

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
                        
                            <td style="border:1px solid #000;width:60%;">
                                <table width="100%" >
                                    <tbody>
                                        <tr>
                                            <td width="58%" style="text-align:center;padding:10px;border-right:1px solid #000;">
                                                Total
                                            </td>
                                            <td style="text-align:right;padding:10px;padding-right:50px;"> 
                                                <?php echo nf(get_total($inv_items_arr));?>
                                            </td>
                                        </tr>
                             
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;display:none;">
                    <tbody>
                        <tr>
                            <td width="60%" style="border:1px solid #000;padding:10px;">
                                <table>
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
                                <table width="100%" style="padding:0px;display:none;" >
                                    <tbody>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:0px;">
                                                Sub Total
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf(get_total($inv_items_arr));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Discount
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf($inv_items_arr[0]->podiscount);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Adjustment
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf($inv_items_arr[0]->poadjustmentval);?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td width="56%" style="text-align:center;padding:0px;">
                                                Grand Total
                                            </td>
                                            <?php
                                            $inv_discount = $inv_items_arr[0]->podiscount==""?0:$inv_items_arr[0]->podiscount;

                                            $invadjustmentval = $inv_items_arr[0]->poadjustmentval==""?0:$inv_items_arr[0]->poadjustmentval;
                                            ?>
                                            <td style="text-align:center;padding:10px;"> 
                                                <?php echo nf((get_total($inv_items_arr)-$inv_discount)+($invadjustmentval));?>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;display:none;">
                    <tbody>
                        <tr>
                            <td width="100%" style="border:1px solid #000;padding:10px;">
                                <p><?php 
                                    $podiscount = $inv_items_arr[0]->podiscount==""?0:$inv_items_arr[0]->podiscount;
                                    $invadjustmentval = $inv_items_arr[0]->poadjustmentval==""?0:$inv_items_arr[0]->poadjustmentval;
                                    $grdttl = (get_total($inv_items_arr)-$podiscount)+($invadjustmentval);
                                    $whole = floor($grdttl);      // 1
                                    $fraction = ($grdttl - $whole)*100; 
                                    $paise = convertNumberToWord(round($fraction));
                                    // echo convertNumberToWord($grdttl)." Rupees ";
                                    // echo $fraction!=0?"and".$paise."paise":""; 
                                    echo ucfirst(displaywords($grdttl)).")";
                                    ?></p><br/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;display:none;">
                    <tbody>
                        <tr>
                            <td width="100%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                                <p><b>Terms & Conditions</b><br/>
                                    <?php echo $row['inv_tc']; ?></p><br/>


                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;display:none;">
                    <tbody>
                        <tr>
                            <td width="100%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                                <p><br/>
                                    <?php echo $row['inv_notes']; ?></p><br/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <tbody>
                        <tr>
                            <td width="70%" style="padding:10px;">


                            </td> 
                            <td width="" style="padding:10px;"><br/><br/>
                                <b><?php echo $row1['orgname']; ?></b><br/>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </tbody>
        </table>
