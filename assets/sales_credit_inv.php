<?php
include("../database/db_conection.php");//make connection here
include("../workers/getters/functions.php");//make connection here

if(isset($_GET['inv_code']))
{
    $inv_code = $_GET['inv_code'];

    $sql = "SELECT * from invoices where inv_code = '$inv_code' ";
    $result = mysqli_query($dbcon,$sql);
    $row =$result-> fetch_assoc();
    //print_r($row);
    $inv_comp_code = $row['inv_comp_code'];
    $inv_customer = $row['inv_customer'];
    $inv_items = $row['inv_items'];
    $inv_bal_amt = $row['inv_balance_amt'];
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

    $ret = "[".$row['itemcode']."]  ".$row['itemname']."&nbsp;|&nbsp;HSN: ".$row['hsncode']."&nbsp;|&nbsp; ";
    $ret.=  "GST@".($row['sales_taxrate']/1)."%";
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

function print_duedate($payterm, $payterm_desc, $inv_date){

    if($payterm_desc=='Advance'){
        $due_date ='';
    }else if($payterm_desc == 'Immediate' || $payterm_desc == 'Due on Receipt'){
        $date=date_create($inv_date);
        $due_date =  date_format($date,"d/m/Y");    
    }else{
        $due_date =  Date('d/m/Y', strtotime($inv_date." + ".$payterm." days"));
    }

 return $due_date;

}

?> 

<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <title>Invoice print</title>
        <style type="text/css">
            .p_table{
                border:1px soid #000;
            }

        </style>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />

    </head>
    <body onload="printInit();">
        <h5 > 
        <img src="images/logo.png" width="70px" height="70px"/>    
        <div style="text-align:center">THULI ICE CREAMS <br>
		ISO 22000:2018 Certified Company</div> </h5>
		
         <h3>   <div style="text-align:center">TAX INVOICE</div>
        </h3>

        <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
            <tbody>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
                        <b>Company Name & Address</b><br/>

                        <?php echo $row1['orgname']; ?>,<br/>
                        <?php echo $row1['address']; ?>,<br/>
                        <?php echo $row1['city']; ?>-<?php echo $row1['zip']; ?>&nbsp;
                        <?php echo $row1['country']; ?>,<?php echo $row1['state']; ?><br/>
                        <b>Mob#:&nbsp;</b><?php echo $row1['mobile'];?><br/>
                        <b>GSTIN</b> - <?php echo $row1['gstin']; ?>
                    </td>
                    <td width="50%" style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">Invoice No#:<b> <?php echo $row['inv_code']; ?></b></td> 
                            </tr> 
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                    Invoice Date: <b><?php echo $row['inv_date']; ?></b>
                                </td> 
                            </tr>    
                               <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                    Payment Term: <b><?php echo $row['inv_payterm_desc']; ?></b>
                                </td> 
                               
                            </tr>   
                            <tr>
                                <td style="padding:5px;">
                            
                                    Due Date: <b><?php echo print_duedate($row['inv_payterm'],$row['inv_payterm_desc'],$row['inv_date']); ?></b>
                                </td> 
                               
                            </tr>   

                        </table>

                    </td>
                </tr>
                <tr>
                    <td width="50%" style="border:1px solid #000;padding:10px;">
					
					  <b>Customer Name & Address</b><br/>

                        <?php echo $row2['custname']; ?>,<br/>

                        <!-- Code updated by jayaprakash - 09042019 -->
                        <?php echo $row['inv_shipping_street']; ?>,<br/>
                        <?php echo $row['inv_shipping_city']; ?>-<?php echo $row['inv_shipping_zip']; ?>&nbsp;<?php echo $row['inv_shipping_country']; ?>,<?php echo $row['inv_shipping_state']; ?><br/>
                       <b>Mob#</b>:&nbsp;<?php echo $row2['mobile']; ?> <br/>
                        
                        <!--?php echo $row2['city']; ?--> <!--?php echo $row2['zip']; ?-->                        
                       <b>GSTIN</b> - <?php echo $row['inv_shipping_gstin']; ?>
					
                       
                    </td>
                    <!-- Code added by Saravanakumar -->
                    <td width="50%" style="border:1px solid #000;padding:0px;">
                        <table width="100%">
                            <tr>
                            <!-- Code updated by jp 09042019 -->
                                <td style="border-bottom:1px solid #000;padding:5px;">Order No#:<b> <?php echo $row['inv_so_code']; ?></b></td> 
                            </tr>
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">Truck No#:<b> <?php echo $row['inv_truck_no']; ?></b></td> 
                            </tr> 
                            <tr>
                                <td style="border-bottom:1px solid #000;padding:5px;">
                                    Driver name: <b><?php echo $row['inv_driver_name']; ?></b>
                                </td> 
                            </tr>    
                        </table>
                    </td>
                    
                    <!-- <td style="border:1px solid #000;padding:10px;">
                        <table>
                            <tbody>

                            </tbody>
                        </table>
                    </td> -->
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
                            <td style="padding:10px;padding-left:1%;border-right:1px solid #000;">
                                <?php echo nf($inv_items_arr[$i]->rwprice);?>

                            </td>    
                            <td style="padding:10px;padding-left:3%;border-right:1px solid #000;">
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
                            <td width="60%" style="border:1px solid #000;padding:10px;">
                            <table>
                                    <tbody>
                                       <!-- <tr>
                                            <td width="40%">
                                                <b>BANK NAME :</b>
                                            </td>
                                            <td width="40%">
                                                <b><?php echo $row3['bankname'];?></b>
                                            </td>

                                        </tr> -->
                                   <!--     <tr>
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
                                        </tr> -->
                                    </tbody>
                                </table>
                            </td> 
                            <td style="border:1px solid #000;width:60%;">
                                <table width="100%" >
                                    <tbody>
                                        <tr>
                                            <td width="61%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                <b>Taxable Value</b>
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf(get_total_notax($inv_items_arr));?>
                                            </td>
                                        </tr>
                                        <?php echo get_taxtype($inv_items_arr); ?>
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
							<!--<h5>Certificate of Warranty</h5>
                                We hereby certify that the goods mentioned in this
								Invoice are warranted to be of the nature and quality
								which they purport to be.
                            </td> -->
							
							<p style="text-align: center;"><b>For Thuli Ice Creams</b></p>
                            <br/>
                            <br/>
                            <p style="text-align: center;"><b>Authorized Signatory</b></p>
                            </td>
							
                            <td style="border:1px solid #000;padding:0px;">
                                <table width="100%" style="padding:0px;" >
                                    <tbody>
                                        <tr>
                                            <td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:0px;">
                                               <b> Sub Total</b>
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
                                            <td width="56%" style="text-align:center;padding:0px;border-bottom:1px solid #000;">
                                                <b>Grand Total</b>
                                            </td>
                                            <?php
                                            $inv_discount = $inv_items_arr[0]->podiscount==""?0:$inv_items_arr[0]->podiscount;

                                            $invadjustmentval = $inv_items_arr[0]->poadjustmentval==""?0:$inv_items_arr[0]->poadjustmentval;
                                            ?>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                                <?php echo nf((get_total($inv_items_arr)-$inv_discount)+($invadjustmentval));?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <!--td width="56%" style="text-align:center;border-bottom:1px solid #000;padding:10px;">
                                                Balance Due
                                            </td>
                                            <td style="text-align:center;padding:10px;border-bottom:1px solid #000;"> 
                                               <?php echo nf($inv_bal_amt); ?>
                                            </td-->
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
                                    $podiscount = $inv_items_arr[0]->podiscount==""?0:$inv_items_arr[0]->podiscount;
                                    $invadjustmentval = $inv_items_arr[0]->poadjustmentval==""?0:$inv_items_arr[0]->poadjustmentval;
                                    $grdttl = (get_total($inv_items_arr)-$podiscount)+($invadjustmentval);
                                    $whole = floor($grdttl);      // 1
                                    $fraction = ($grdttl - $whole)*100; 
                                    $paise = convertNumberToWord(round($fraction));
                                    echo "<b>INVOICE VALUE IN WORDS: </b> ( ";
                                    //echo convertNumberToWord($grdttl)." Rupees ";
                                  // echo "(".convertNumberToWordsForIndia($grdttl).")";
                                  echo ucfirst(displaywords($grdttl)).")"; 
                                    //echo $fraction!=0?"and".$paise."paise":""; ?></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
              <!-- <table class="p_table" width="100%" style="border:1px solid #000;">
                    <tbody>
                        <tr>
                            <td width="50%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                                <p style="text-align: center;"><b>Amount of Tax Subject to Reverse Charge</b></p>
                            </td>
                            <td width="50%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                            </td>
                        </tr>
                    </tbody>
                </table>
                <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                    <thead style="border:1px solid #000;text-align:center;">
                        <th style=" width:10%;padding:10px;border:1px solid #000;"><b>Certificate of Warranty	</b></th>
                        <th style="width:50%;padding:10px;border:1px solid #000;"><b>Electronic Reference Number</b></th>
                    </thead>
                    
                    <tbody>
                        <tr>
                            <td width="50%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                                <b>Certificate of Warranty	</b><br/>
                                <p>We hereby certify that the goods mentioned in this  <br/>                     	 	 	 	 	 	 	 
 Invoice are warranted to  be of  the nature and quality which they purport to be.</p>
                            </td>
                            <td width="50%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                            </td>
                        </tr>
                    </tbody>
                </table>-->
              <!-- <table class="p_table" width="100%" style="border:1px solid #000;padding:10px;">
                   <thead style="border:1px solid #000;text-align:center;">
                        <th style=" width:10%;padding:10px;border:1px solid #000;border-right-color:white;"><h5><b>Terms and Conditions of Sale</b></h5></th>
                        <th style="width:50%;padding:10px;"></th>
                    </thead>
                    <tbody>
                        <tr>
                            <td width="50%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                                <p>1. We declare that this Invoice shows the actual price of the goods described and that all particulars are correct</p>
                                 <p>2. All disputes  Subject to Chennai Jurisdiction only	</p>
 
                            </td>
                            <td width="50%" style="border:1px solid #000;padding-top:10px;padding-left:10px;">
                            <p style="text-align: center;"><b>For Thuli Ice Creams</b></p>
                            <br/>
                            <br/>
                            <p style="text-align: center;"><b>Authorized Signatory</b></p>
                            </td>
                            </tr>
                    </tbody>
                </table> -->
             <!--   <table class="p_table" width="100%" style="border:1px solid #000;">
                    <tbody>
                        <tr>
                            <td width="100%">
                                 <p style="text-align: center;">Regd Office: #321(Old #156), 1st Floor, Linghi Chetty Street, Chennai - 600 001  Tel: 044-25243186   Fax: 044-25218750
                                </p>
                            </td>
                        </tr>
                    </tbody>
                </table> -->
                <table class="p_table" width="100%">
                    <tbody>
                        <tr>
                            <td width="100%" style="padding:10px;">
                                <p style="text-align: center;">***	  This is a Computer Generated Invoice hence seal and signature not required  ***	
                                </p>
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